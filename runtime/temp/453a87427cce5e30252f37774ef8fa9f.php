<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:58:"/Users/Web/snmnh/public/../app/index/view/index/check.html";i:1514257900;}*/ ?>
<!DOCTYPE html>
<html lang="en" style="overflow: hidden;">
<head>
    <meta charset="UTF-8">
    <title>签到</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <link rel="stylesheet" href="__HOME__/css/photoClip/photoClip.css" />
    <link rel="stylesheet" type="text/css" href="__QD__/css/style.css?v=1">
    <link rel="stylesheet" type="text/css" href="__QD__/css/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="__QD__/css/animate.min.css">
    <script type="text/javascript" src="__QD__/js/jquery-1.11.0.min.js"></script>
    <!--移动端版本兼容 -->
    <link rel="stylesheet" href="__HOME__/css/demo.css" />

    <link rel="stylesheet" href="__QD__/lib/css/LArea.css">

    <script type="text/javascript" src='__QD__/js/mobile.js'></script>
    <link rel="stylesheet" href="__QD__/css/popWindow.css" />

    <script type="text/javascript" src="__HOME__/js/popWin.js?V=2" ></script>
    <script type="text/javascript" src="__HOME__/load/js/bemLoad.js" ></script>

    <script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>


    <script type="text/javascript">
        var app_url="127.0.0.1/archie/yajienh/public/";
        var img_path="http://archie.hengdikeji.com/nh2017/public";
    </script>
    <!-- 自适应屏幕 -->
    <script type="text/javascript">
        $(function(){
            wHeight=$(window).height();
            if(wHeight<975){
                wHeight=975;
            }
            $('.page').height(wHeight).css('background-position','center '+(wHeight-1334)/2+'px');
            $('.h832').css('padding-top',(wHeight-975)/2+'px');
        })

        //微信分享
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

                    jsApiList: ['onMenuShareTimeline','onMenuShareAppMessage'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2

                });
                wx.ready(function () {
                    wx.onMenuShareTimeline({
                        title: '雅洁五金2018第19届经销年会-现场签到',
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
                        title: '雅洁五金2018第19届经销年会-现场签到',
                        desc: '聚变未来，共筑雅洁新时代',
                        link: res.url,
                        imgUrl: 'http://archie.hengdikeji.com/nh2017/public/static/home/fenxiang.png',
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
    </script>
</head>
<body style="overflow: hidden;">

<!-- 添加音乐 -->
<!--<audio id="bgmusic" class="yue" controls preload="auto" loop="loop">-->
<!--    <!-- <source src="music/bgm.mp3" type="audio/mpeg"> -->
<!--</audio>-->
<audio id="bgmusic"  class="yue" controls preload="auto" loop="loop" preload  src="http://m.gani.com.cn/activity/newProduct/music/bg.mp3" hidden="hidden"></audio >
<audio id="pressed" preload  src="__HOME__/music/press.mp3" hidden="hidden"></audio >

<div class="loading">
    <div class="page">
        <div class="h832" style="padding-top: 0px;">
            <div class="innerDiv">

                <div class="loading_c">
                    <p class="progress">0%</p>
                </div>

            </div>
        </div>
    </div>
</div>

<!-- <img src="img/yue.png" alt="" class="mus rotate"> -->

<!-- wrap -->
<div class="wrap page">
    <div class="h832" style="padding-top: 0px;">
        <div class="innerDiv">

            <img src="__QD__/img/logo.png" alt="" class="logo">

            <div class="content">

                <img src="__QD__/img/banner.png" alt="" class="banner">

                <div class="circularBg">

                    <img src="__QD__/img/circular1.png" alt="" class="circular1">
                    <img src="__QD__/img/circular2.png" alt="" class="circular2">
                    <img src="__QD__/img/circular3.png" alt="" class="circular3">
                    <img src="__QD__/img/circular4.png" alt="" class="circular4">
                    <img src="__QD__/img/circular5.png" alt="" class="circular5">

                    <div class="circular6">

                        <img src="__QD__/img/fingerprint.png" alt="" class="fingerprint shan">

                        <div class="frame">
                            <img src="__QD__/img/light.png" alt="" class="light lightMove">
                        </div>

                    </div>

                </div>

                <div class="tispBg">
                    <img src="__QD__/img/tips1.png" alt="" style="display:block;">
                    <img src="__QD__/img/tips2.png" alt="" style="display:none;">
                </div>

            </div>

        </div>
    </div>
</div>

<!-- 确认信息 -->
<div class="messageBg">
    <img src="__QD__/img/logo.png" alt="" class="logo">
    <h2>请确认个人信息</h2>
    <div class="bg2">

        <div class="headerBg">
            <img class="open_face" src="__QD__/img/headerImg.jpg" alt="">
        </div>

        <ul class="message_list">
            <li>
                <p class="p1 name">张 三</p>
            </li>
            <li>
                <p class="p2 sex">男</p>
            </li>
            <li>
                <p class="p3 store_name">所属经销商</p>
            </li>
            <li>
                <p class="p4 phone">131 1232 5896</p>
            </li>
            <li>
                <p class="p5 addr">广东省广州市海珠区</p>
            </li>
        </ul>

        <button class="queBtn">确定签到</button>
        <button class="xiuBtn">修改信息</button>

    </div>
</div>
<div id="clipArea" style="display: none;">
    <button id="clipBtn">截取</button>
    <button id="clipClose">取消</button>
</div>
<!-- 修改信息 -->
<div class="modifyBg">
    <div class="h832" style="padding-top: 0px;">
        <div class="innerDiv">
            <ul class="modify_c">
                <li>
                    <span>头像</span>
                    <div class="winTX">
                        <img class="open_face" id="open_face" src="" alt="">
                        <input type="hidden" id="imge" value="">
                        <input type="file" id="file" />

                    </div>
                </li>
                <li>
                    <input type="text" class='icon1' name="name" placeholder='请输入姓名' value="">
                </li>

                <li style="position: relative">
                    <input type="text" class='icon2' name="sex" placeholder='请选择' value="">
                    <select class="slt" name="slt">
                        <option value="请选择">请选择</option>
                        <option value="男">男</option>
                        <option value="女">女</option>
                    </select>
                </li>
                <li>
                    <input type="text" class='icon3' name="store_name" placeholder='所属经销商'>
                </li>
                <li>
                    <input type="text" class='icon4' name="phone" placeholder='请输入手机号码'>
                </li>
                <li>
                    <input type="text" class='icon5' id="city"  name="addr" placeholder='请选择您所在的地区'>
                </li>
            </ul>

            <button class="retrunBtn">返 回</button>
            <button class="xiuBtn2">提交</button>

        </div>
    </div>
</div>

<!-- mengBg -->
<div class="mengBg">
    <div class="h832" style="padding-top: 0px;">
        <div class="innerDiv">

            <img src="__QD__/img/shareImg.png" alt="" class="shareImg">

            <img src="__QD__/img/okBtn.png" alt="" class="okBtn">
        </div>

    </div>
</div>

<div class="wrap page" id="success">
    <div class="h832" style="padding-top: 0px;">
        <div class="innerDiv">

            <img src="__QD__/img/logo.png" alt="" class="logo">

            <div class="content">

                <img src="__QD__/img/banner.png" alt="" class="banner">

                <div class="open">
                    <div class="open_face">
                        <img id="upic" class="open_face" src="http://hyimg.hengdikeji.com/yajie/head.png" />
                    </div>
                    <div class="open_name">张三</div>
                </div>
                <div class="success_info">
                    <img src="__QD__/img/success.png" alt="" style="margin: 0 auto">
                    <p id="check_time" style="margin-top: 15px">2017-12-09 14:00</p>
                </div>
                <div class="tispBg success_t">
                    <p>我要发朋友圈</p>
                </div>

            </div>

        </div>
    </div>
</div>

<!--选择地区弹层-->
<section id="areaLayer" class="express-area-box">
    <header>
        <h3>选择地区</h3>
        <a id="backUp" class="back" href="javascript:void(0)" title="返回"></a>
        <a id="closeArea" class="close" href="javascript:void(0)" title="关闭"></a>
    </header>
    <article id="areaBox">
        <ul id="areaList" class="area-list"></ul>
    </article>
</section>
<!--遮罩层-->
<div id="areaMask" class="mask"></div>

<input type="hidden" id="cv" value="">

<script type="text/javascript" src="__HOME__/js/photoClip/jquery-2.1.1.min.js" type="text/javascript"></script>
<script type="text/javascript" src="__HOME__/js/photoClip/iscroll-zoom.js"></script>
<script type="text/javascript" src="__HOME__/js/photoClip/hammer.js"></script>
<script type="text/javascript" src="__HOME__/js/photoClip/jquery.photoClip.min.js"></script>

<script type="text/javascript" src='__QD__/js/main.js'></script>

<script src="__QD__/lib/js/LAreaData1.js"></script>
<script src="__QD__/lib/js/LAreaData2.js"></script>
<script src="__QD__/lib/js/LArea.js"></script>

<script type="text/javascript">
    window.addEventListener('contextmenu', function(e){
        e.preventDefault();
    });
    $(function(){

        var area1 = new LArea();
        area1.init({
            'trigger': '#city', //触发选择控件的文本框，同时选择完毕后name属性输出到该位置
            'valueTo': '#cv', //选择完毕后id属性输出到该位置
            'keys': {
                id: 'id',
                name: 'name'
            }, //绑定数据源相关字段 id对应valueTo的value属性输出 name对应trigger的value属性输出
            'type': 1, //数据源类型
            'data': LAreaData //数据源
        });
        $('.frame').on('touchstart',function(){
            $('#pressed')[0].play();
            $('.light').show();
            var url="<?php echo url('index/get_sing'); ?>";

            $('.tispBg img').eq(0).hide();
            $('.tispBg img').eq(1).fadeIn();
            setTimeout(function(){
                $('#pressed')[0].pause();
                $.get(url,function(res){
                    if(res.code==0){
                        popw("温馨提示","您还未报名,请先报名",1,function(){
                            $('.retrunBtn').hide();
                            $('.xiuBtn2').addClass('xiuBtnTJ');
                            $('.open_face').attr('src',res.open_face);
                            $('.messageBg').fadeIn();
                            $('.modifyBg').show();
                            $('.modifyBg').fadeIn();

                        });
                    }else{
                        $('[name="name"]').attr('value',res.data.username);
                        $('[name="sex"]').attr('value',res.data.sex);
                        $('[name="store_name"]').attr('value',res.data.store_name);
                        $('[name="phone"]').attr('value',res.data.phone);
                        $('[name="addr"]').attr('value',res.data.area);

                        if(res.data.image){
                            $('.open_face').attr('src',img_path+res.data.image);
                        }else{
                            $('.open_face').attr('src',res.open_face);
                        }
                        $('.name').text(res.data.username);
                        $('.sex').text(res.data.sex);
                        $('.store_name').text(res.data.store_name);
                        $('.phone').text(res.data.phone);
                        $('.addr').text(res.data.area);

                        $('.open_name').text(res.data.username);
                        $('.messageBg').fadeIn();
                    }

                });
            },1000);


        });
        var hasC=0;
        $('.queBtn').click(function(){ //去签到

            hasC++;
            if(hasC==1){
                $.ajax({
                    url:"<?php echo url('Index/edit'); ?>",
                    type:"post",
                    success:function(res){
                        hasC=0;
                        if(res.code == 1){
                            $('.open_name').text(res.username);
                            $('#check_time').text(res.time);
                            $('#success').fadeIn();

                        }else{
                            popw("温馨提示",res.msg,1,function(){

                            });
                        }
                    },
                    error:function(){
                        hasC=0;
                        popw("温馨提示",res.msg,1,function(){

                        });
                    }
                });
            }


        });
        $('.success_t').click(function(){

            $('.mengBg').fadeIn();
        });
        $('.xiuBtn').click(function(){
            $('.retrunBtn').show();
            $('.xiuBtn2').removeClass('xiuBtnTJ');
            $('.modifyBg').show();
        });

        $('.retrunBtn').click(function(){
            $('.modifyBg').hide();
        });

        $('.xiuBtn2').click(function(){
            var username =$('[name="name"]').val();
            var sex = $('[name="sex"]').val();
            var store_name =$('[name="store_name"]').val();
            var phone = $('[name="phone"]').val();
            var area = $("#city").val();
            var img = $("#imge").val();
            var image = img.substr(22);


            var load = new bemLoad(200,0.75,64);
            $.ajax({
                url:"<?php echo url('Index/add'); ?>",
                type:"post",
                data:{"username":username,"sex":sex,"store_name":store_name,"phone":phone,"area":area,"images":image},
                success:function(res){
                    load.close();
                    if(res.code == 1){
                        $('.open_face').attr('src',res.data.image);
                        $('.open_name').text(res.data.name);

                        $('.modifyBg').hide();
                        $('.p1').text($('.icon1').val());
                        $('.p2').text($('.icon2').val());
                        $('.p3').text($('.icon3').val());
                        $('.p4').text($('.icon4').val());
                        $('.p5').text($('.icon5').val());
                    }else{
                        popw("温馨提示",res.msg,1,function(){

                        });
                    }
                }
            });
//            if(img==""){
//                popw("温馨提示","您还未上传头像<br/>系统将默认微信头像",2,function(){
//                    var load = new bemLoad(200,0.75,64);
//                    $.ajax({
//                        url:"<?php echo url('Index/add'); ?>",
//                        type:"post",
//                        data:{"username":username,"sex":sex,"store_name":store_name,"phone":phone,"area":area,"images":image},
//                        success:function(res){
//                            load.close();
//                            if(res.code == 1){
//                                $('.open_face').attr('src',res.data.image);
//                                $('.open_name').text(res.data.name);
//                                $('.modifyBg').hide();
//                                $('.p1').text($('.icon1').val());
//                                $('.p2').text($('.icon2').val());
//                                $('.p3').text($('.icon3').val());
//                                $('.p4').text($('.icon4').val());
//                                $('.p5').text($('.icon5').val());
//                            }else{
//                                popw("温馨提示",re.msg,2,function(){
//
//                                });
//                            }
//                        }
//                    });
//                },'直接提交','返回上传');
//            }else{
//
//            }


        });

        $('.okBtn').click(function(){

//            $('.mengBg').hide();
            window.location.href="<?php echo url('msg/index'); ?>";
        })

//        $('.sex').focus(function(){
//            $(this).blur();
//            $('.slt').focus();
//        });

        $('.slt').change(function(){
            $('[name="sex"]').val($(this).children('option:selected').val());
        });

        //失去焦点
        $('#city').bind('focusin',function(){
            $(this).blur();
        })


        function audioAutoPlay(id,v){
            var audio = document.getElementById(id);
            audio.play();
            if(v==0)
            {
                audio.pause();
            }
            document.addEventListener("WeixinJSBridgeReady", function () {
                audio.play();
                if(v==0)
                {
                    audio.pause();
                }
            }, false);
        }
        audioAutoPlay('pressed',0);

        //截取图片
        $("#clipArea").photoClip({
            width: 300,
            height: 300,
            file: "#file",
            view: ".view",
            ok: "#clipBtn",
            loadStart: function() {
                $('#clipArea').show();
                $('#clipClose').on('click',function(){
                    $('#clipArea').hide();
                });
                //开启加载页面
            },
            loadComplete: function() {
                console.log("照片读取完成");
                //关闭加载页面
            },
            clipFinish: function(dataURL) {
                $('#clipArea').hide();
                $('#imge').attr('value',dataURL);
                $(".open_face").attr('src',dataURL);

            }
        });
    })
</script>
</body>
</html>