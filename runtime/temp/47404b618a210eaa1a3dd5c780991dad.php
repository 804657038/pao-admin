<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:56:"/Users/Web/snmnh/public/../app/index/view/msg/index.html";i:1513819461;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>雅洁朋友圈</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" type="text/css" href="http://assets.yangyue.com.cn/css/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="http://assets.yangyue.com.cn/css/animate.min.css">
    <link rel="stylesheet" type="text/css" href="__MSG__/css/style.css?v=1">
    <!-- JQ -->
    <script src="http://cdn.bootcss.com/jquery/1.12.3/jquery.min.js"></script>
    <!--移动端版本兼容 -->
    <script type="text/javascript" src='http://assets.yangyue.com.cn/js/mobile.js'></script>
    <script type="text/javascript" src='http://assets.yangyue.com.cn/js/swiper.min.js'></script>
    <script type="text/javascript" src='http://assets.yangyue.com.cn/js/swiper.animate1.0.2.min.js'></script>
    <script type="text/javascript" src='__MSG__/js/main.js'></script>
    <script type="text/javascript" src="https://static.runoob.com/assets/vue/1.0.11/vue.min.js"></script>
    <script type="text/javascript" src="__MSG__/lib/layui.js"></script>
    <script type="text/javascript" src="__MSG__/lib/tools.js"></script>
    <script src="https://res.wx.qq.com/open/js/jweixin-1.2.0.js"></script>
    <!-- 自适应屏幕 -->
    <script type="text/javascript">
        var layer;
        layui.use('layer', function(){
            layer = layui.layer;

        });
        $(function(){
            wHeight=$(window).height();
            if(wHeight<975){
                wHeight=975;
            }
            $('.page').height(wHeight).css('background-position','center '+(wHeight-1334)/2+'px');
            $('.h832').css('padding-top',(wHeight-975)/2+'px');
        })
    </script>
    <style>
        .layui-flow-more{
            text-align: center !important;
            font-size: 28px !important;
            color: #666666 !important;
            margin: 50px auto 0 !important;
        }
        .layui-flow-more a{
            color: #666666 !important;
        }
    </style>
</head>
<body id="vueMain">
<!-- 添加音乐 -->
<div style="display: none">
    <audio id="bgmusic" class="yue" controls preload="auto" loop="loop" src="__MSG__/music/bgm.mp3"></audio>
</div>

<!-- loading -->
<div class="mains">
    <div class="loading">
        <div class="page">
            <div class="h832" style="padding-top: 0px;">
                <div class="innerDiv">
                    <p class="press">0%</p>
                </div>
            </div>
        </div>
    </div>
    <div class="wrap">

        <div class="bannerBg" style="position: relative">
<!--            <img src="http://hyimg.hengdikeji.com/static/yue.png" alt="" class="mus rotate">-->
            <img src="__MSG__/img/banner.png" alt="">
        </div>

        <div class="contentBg">

            <!-- 头像 -->
            <div class="portraitBg">

                <div class="porWrap">
                    <img src="__MSG__/img/logo.png" alt="">
                </div>

                <!--            <p>{{auth.name}}</p>-->

            </div>

            <div style="height: 82px">
                <div class="news" v-show="news" v-on:click="newsList()">
                    <img src="{{auth.ga.gf}}" alt="">
                    <template v-if="auth.ga.tc<=99">
                        <p>{{auth.ga.tc}}条新信息</p>
                    </template>
                    <template v-else>
                        <p>(99+)条新信息</p>
                    </template>
                    <div class="more">
                        <img src="__MSG__/img/more.png" class="" alt="">
                    </div>

                </div>
            </div>
            <ul class="listBg" id="msglist">

                <template v-for="(key1,item) in dataList">

                    <li>
                        <div class="headIcon">
                            <img src="{{item.face}}" alt="">
                        </div>

                        <div class="listDate">
                            <span>{{item.name}}</span>
                            <p v-html="item.content"></p>


                            <template v-if="item.video ">
                                <div class="imgBig2" onclick="videoPaly('{{item.video}}')">
                                    <div class="playPop">
                                        <a href="javascript:;" id="playzero"><img src="http://huiya.hengdikeji.com/api/mobile/img/play.png" /></a>
                                    </div>
                                    <img src="{{item.images[0]}}" alt="">
                                </div>
                            </template>
                            <template v-else>
                                <template v-if="item.images.length > 1">
                                    <div class="imgList tuBg">
                                        <template v-for="img in item.images">
                                            <div class="imgListBox">
                                                <img src="{{img}}" alt="">
                                            </div>

                                        </template>
                                    </div>
                                </template>
                                <template v-else>
                                    <template v-if="item.images.length > 0">
                                        <div class="imgBig tuBg">
                                            <template v-for="img in item.images">
                                                <img src="{{img}}" alt="">
                                            </template>
                                        </div>
                                    </template>
                                </template>
                            </template>



                            <div class="mis">
                                <i>{{item.time}}</i>
                                <img src="http://hyimg.hengdikeji.com/static/xinIcon1.png" alt="false" class="xinIcon">
                                <div class="kuang">
                                    <img src="http://hyimg.hengdikeji.com/static/fabIcon.png" alt="" class="fabIcon" v-on:click="praise(item.id,key1)">
                                    <img src="http://hyimg.hengdikeji.com/static/comIcon.png" alt="" class="comIcon" v-on:click="comment(key1)">
                                </div>
                            </div>
                            <div class="interaction" v-show="item.interaction">
                                <img src="http://hyimg.hengdikeji.com/static/jiao.png" alt="" class="jiao">
                                <template v-if="item.PraiseList.length > 0">
                                    <div class="liveBg" style="display:block;">
                                        <img src="http://hyimg.hengdikeji.com/static/live.png" alt="" class="live">
                                        <template v-for="(key,pra) in item.PraiseList">
                                            <template v-if="key == 0">
                                                <small>{{pra.member_id.open_name}}</small>
                                            </template>
                                            <template v-else>
                                                ，<small>{{pra.member_id.open_name}}</small>
                                            </template>

                                        </template>

                                    </div>
                                </template>

                                <div class="messageBg" style="display:block;">
                                    <template v-for="cItem in item.commont">

                                        <template v-if="cItem.member_id.member_id == auth.member_id">
                                            <div>
                                                <small>{{cItem.member_id.open_name}}</small>
                                                <template v-if="cItem.to_member_id.member_id != item.member_id">
                                                    回复<small>{{cItem.to_member_id.open_name}}</small><em>
                                                </template>
                                                ：{{cItem.commont}}</em>
                                            </div>
                                        </template>
                                        <template v-else>
                                            <div v-on:click="comment(key1,cItem.member_id.member_id,cItem.member_id.open_name)">
                                                <small>{{cItem.member_id.open_name}}</small>
                                                <template v-if="cItem.to_member_id.member_id != item.member_id">
                                                    回复<small>{{cItem.to_member_id.open_name}}</small><em>
                                                </template>
                                                ：{{cItem.commont}}</em>
                                            </div>
                                        </template>

                                    </template>
                                </div>
                            </div>

                        </div>
                    </li>
                </template>

            </ul>

            <!--            <p class="di"></p>-->
            <div style="height: 120px"></div>

        </div>

    </div>

    <!-- fu -->
    <div class="fuBg">
        <div class="imgBg">
            <img src="" alt="">
        </div>
    </div>

    <!-- 我要留言 -->
    <div class="leavBg">

        <div class="headBg">
            <span class='cancel'>取消</span>
            <i>我要留言</i>
            <small class='release' v-on:click="submitT()">发表</small>
        </div>

        <div class="content">

            <textarea id="content" placeholder='这一刻的想法...'></textarea>

            <div class="addImg">
                <template v-for="(key,item) in uploadImgs">
                    <div class="images">
                        <img src="http://hyimg.hengdikeji.com/static/dele1.png" class="dele" v-on:click="dele(key)" alt="" >
                        <img src="{{item}}" alt="">
                        <!--                        <input type="hidden" name="img" value="{{item.substr(22)}}">-->
                        <input type="hidden" name="img" value="{{item}}">

                    </div>
                </template>
                <div class="addIcon"  v-show="addIcon">
                    <input type="file" name="file" v-on:click="upload()" id="filed">
                </div>

            </div>

        </div>

    </div>

    <!-- 退出发布 -->
    <div class="tuiBg">

        <div class="tips">

            <p>退出此次编辑？</p>

            <span>取消</span>
            <i v-on:click="cancel()">退出</i>
        </div>

    </div>

    <!-- 消息 -->
    <div class="newBg">

        <div class="headBg">
            <span class='returnBtn' v-on:click="newsHide()"> 朋友圈</span>
            <i>消息</i>
            <small style='opacity: 0;'>发布</small>
        </div>

        <div class="newWrap">
            <ul class="newList">
                <template v-for="item in newList">

                    <li v-on:click="descNews(item.msgId)">
                        <img src="{{{item.to_member_id.open_face}}}" alt="" class="headImg">

                        <div class="context">
                            <template v-if="item.commont">
                                <span>{{item.to_member_id.open_name}}</span>
                                <p>{{item.commont}}</p>
                                <i>{{item.addTime}}</i>
                            </template>
                            <template v-else>
                                <span>{{item.to_member_id.open_name}}</span>
                                <img src="http://hyimg.hengdikeji.com/static/live2.png" alt="">
                                <i>{{item.addTime}}</i>
                            </template>
                        </div>

                        <div class="context2">
                            <template v-if="item.thumb">
                                <img src="{{item.thumb}}" alt="">
                            </template>
                            <template v-else>
                                {{item.content}}
                            </template>
                        </div>

                    </li>
                </template>



            </ul>

            <!--        <p class="more">查看更早的消息...</p>-->
        </div>

    </div>

    <!-- 详细页 -->
    <div class="detaBg">

        <div class="headBg">
            <span class='newBtn' v-on:click="newBtn()"> 消息</span>
            <i>详情</i>
            <small style='opacity: 0;'>发布</small>
        </div>

        <div class="detaWrap" v-show="descNewsBox">
            <div class="headIcon">
                <img src="{{descNewsList.face}}" alt="">
            </div>

            <div class="listDate">
                <span>{{descNewsList.name}}</span>
                <p v-html="descNewsList.content"></p>
                <template v-if="descNewsList.images.length > 1">
                    <div class="imgList tuBg">
                        <template v-for="img in descNewsList.images">
                            <div class="imgListBox">
                                <img src="{{img}}" alt="">
                            </div>

                        </template>
                    </div>
                </template>
                <template v-else>
                    <template v-if="descNewsList.images >0">
                        <div class="imgBig tuBg">
                            <template v-for="img in descNewsList.images">
                                <img src="{{img}}" alt="">
                            </template>
                        </div>
                    </template>
                </template>

                <div class="mis">
                    <i>{{descNewsList.time}}</i>

                    <img src="http://hyimg.hengdikeji.com/static/xinIcon.png" alt="false" class="xinIcon">
                    <div class="kuang">
                        <img src="http://hyimg.hengdikeji.com/static/fabIcon.png" alt="" class="fabIcon" v-on:click="Descpraise()">
                        <img src="http://hyimg.hengdikeji.com/static/comIcon.png" alt="" class="comIcon" v-on:click="Desccomment()">
                    </div>
                </div>

                <div class="interaction" v-show="descNewsList.interaction">
                    <img src="http://hyimg.hengdikeji.com/static/jiao.png" alt="" class="jiao">
                    <div class="liveBg" style="display:block;">
                        <template v-if="descNewsList.PraiseList.length > 0">
                            <div class="liveBg" style="display:block;">
                                <img src="http://hyimg.hengdikeji.com/static/live.png" alt="" class="live">
                                <template v-for="(key,pra) in descNewsList.PraiseList">
                                    <template v-if="key == 0">
                                        <small>{{pra.member_id.open_name}}</small>
                                    </template>
                                    <template v-else>
                                        ，<small>{{pra.member_id.open_name}}</small>
                                    </template>

                                </template>

                            </div>
                        </template>
                    </div>

                    <div class="messageBg" style="display:block;">

                        <template v-for="cItem in descNewsList.commont">

                            <template v-if="cItem.member_id.member_id != descNewsList.member_id">
                                <div>
                                    <small>{{cItem.member_id.open_name}}</small>
                                    <template v-if="cItem.to_member_id.member_id != descNewsList.member_i">
                                        回复<small>{{cItem.to_member_id.open_name}}</small><em>
                                    </template>
                                    ：{{cItem.commont}}</em>
                                </div>
                            </template>
                            <template v-else>
                                <div v-on:click="Desccomment(cItem.member_id.member_id,cItem.member_id.open_name)">
                                    <small>{{cItem.member_id.open_name}}</small>
                                    <template v-if="cItem.to_member_id.member_id != descNewsList.member_id">
                                        回复<small>{{cItem.to_member_id.open_name}}</small><em>
                                    </template>
                                    ：{{cItem.commont}}</em>
                                </div>
                            </template>

                        </template>

                    </div>
                </div>
            </div>
        </div>


    </div>
    <!--评论用表单-->
</div>
<div class="comment dt" style="display: none">
    <div class="dr">
        <div class="inputBox dd">
            <input type="hidden" name="to_member_id" id="to_member_id" value="">
            <input type="hidden" name="msgId" id="msgId" value="">
            <input type="hidden" name="index" id="index" value="">
            <input type="text" id="commont" placeholder="">
        </div>
        <div class="buBox dd">
            <button id="subCommont" disabled v-on:click="commontPost()">发送</button>
        </div>
    </div>

</div>
<button class="btn1">
    我要留言
</button>

<div class="video_box" style="position: fixed">
    <video  controls="controls"
            width="100%"
            height="100%"
            webkit-playsinline="true"
            x-webkit-airplay="true"
            playsinline="true"
            x5-video-player-type="h5"
            x5-video-player-fullscreen="true"
            preload="auto"
    >
        您的浏览器不支持 video 标签。
    </video>
    <div class="video_close" style="position: absolute">X</div>
</div>

</body>
<script type="text/javascript" src="__MSG__/js/vue.js?v=26"></script>
<!--<script type="text/javascript" src="js/lib.js?v=5"></script>-->
<script type="text/javascript">

    $(function(){

        //视频播放按钮垂直居中
        $('#video .videoplay').css('padding-top',($('#video').height()-$('#video .videoplay').height())/2);

        function videoPaly(url){
            $("#bgmusic")[0].pause();
            $(".video_box").animate({top:0,opacity:1}).find("video").attr("src",url)[0].play();
        }

        $(".video_box .video_close").on("click",function(){
            $("#bgmusic")[0].play();
            $(".video_box").animate({top:'-100%',opacity:0}).find("video")[0].pause();
        });

        // 音乐功能
        document.addEventListener("WeixinJSBridgeReady", function () {
//            $("#bgmusic")[0].play();
//            $('.mus')[0].src='img/yue.png';
        }, false);
        $('.mus').click(function(){
            if (open==0) {
                $('.mus')[0].src='img/yue2.png';
                $("#bgmusic")[0].pause();
                $('.sliderWrap').addClass();
                $('.mus').removeClass('rotate');
                open=1;
            }else if (open==1) {
                $('.mus')[0].src='img/yue.png';
                $("#bgmusic")[0].play();
                $('.mus').addClass('rotate');
                open=0;
            }
        });

        $.ajax({
            type:'GET',
            url:'http://archie.hengdikeji.com/nh2017/public/index.php/index/Index/jssdk_all/',
            dataType:'JSON',
            success:function(res){

                wx.config({
                    debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
                    appId:res.appId, // 必填，公众号的唯一标识

                    timestamp: res.timestamp, // 必填，生成签名的时间戳

                    nonceStr:res.nonceStr, // 必填，生成签名的随机串

                    signature:res.signature,// 必填，签名，见附录1

                    jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage','openLocation'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2

                });
                wx.ready(function () {
                    wx.onMenuShareTimeline({
                        title: '雅洁五金2018第19届经销年会-朋友圈',
                        desc: '聚变未来，共筑雅洁新时代',
                        link: res.url,
                        imgUrl: 'http://archie.hengdikeji.com/nh2017/public/static/home/fenxiang.png',//archie.hengdikeji.com/nh2017/public/index.php
                        trigger: function (res) {
                        },
                        success: function (res) {
                        },
                        cancel: function (res) {
                        },
                        fail: function (res) {
                            alert(JSON.stringify(res));
                        }
                    });
                    wx.onMenuShareAppMessage({
                        title: '雅洁五金2018第19届经销年会-朋友圈',
                        desc: '聚变未来，共筑雅洁新时代',
                        link: res.url,
                        imgUrl: 'http://archie.hengdikeji.com/nh2017/public/static/home/fenxiang.png',//archie.hengdikeji.com/nh2017/public/index.php
                        trigger: function (res) {
                        },
                        success: function (res) {
                        },
                        cancel: function (res) {
                        },
                        fail: function (res) {
                            alert(JSON.stringify(res));
                        }
                    });

                })
            }
        });
    })
</script>
</html>