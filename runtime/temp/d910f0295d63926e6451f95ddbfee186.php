<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:68:"/Users/Web/snmnh/app/index/../../public/temp/index/index2/index.html";i:1521704790;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
	<meta content="yes" name="apple-mobile-web-app-capable"/>
	<meta content="black" name="apple-mobile-web-app-status-bar-style"/>
	<meta content="telephone=no" name="format-detection"/>
	<title>财富新势力，创变赢未来</title>
	<link rel="stylesheet" type="text/css" href="__HOME__/css/reset.css">
	<link rel="stylesheet" type="text/css" href="__HOME__/css/animate.min.css">
	<link rel="stylesheet" type="text/css" href="__HOME__/css/all.css?v=12">
	<link rel="stylesheet" type="text/css" href="__HOME__/css/popWindow.css" />
    <script type="text/javascript" src="__HOME__/js/jquery-3.2.1.min.js"></script>
    <script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script type="text/javascript">
        //微信分享
        $.ajax({
            type:'GET',
            url:"<?php echo url('Index2/jssdk_all'); ?>",
            dataType:'JSON',
            success:function(res){
                wx.config({
                    debug: false, // 开启调试模式,调用的所有api的返回值会在客户端alert出来，若要查看传入的参数，可以在pc端打开，参数信息会通过log打出，仅在pc端时才会打印。
                    appId:res.appId, // 必填，公众号的唯一标识

                    timestamp: res.timestamp, // 必填，生成签名的时间戳

                    nonceStr:res.nonceStr, // 必填，生成签名的随机串

                    signature:res.signature,// 必填，签名，见附录1
                    jsApiList: ['hideMenuItems'] // 必填，需要使用的JS接口列表，所有JS接口列表见附录2

                });
                wx.ready(function () {
                    wx.hideMenuItems({
                        menuList:[
                            "menuItem:share:appMessage",
                            "menuItem:share:timeline",
                            "menuItem:share:qq",
                            "menuItem:share:weiboApp",
                            "menuItem:favorite",
                            "menuItem:copyUrl",
                            "menuItem:openWithQQBrowser",
                            "menuItem:openWithSafari",
                            "menuItem:share:QZone"
                        ]
                    });

                    wx.onMenuShareTimeline({
                        title: '财富新势力，创变赢未来',
                        desc: '诗尼曼邀您创变财富赢好礼',
                        link: res.url,
                        imgUrl: 'http://snm.hengdikeji.com/nh2018/public/temp/index/index/image/fenxiang.png',
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
                        title: '财富新势力，创变赢未来',
                        desc: '诗尼曼邀您创变财富赢好礼',
                        link: res.url,
                        imgUrl: 'http://snm.hengdikeji.com/nh2018/public/temp/index/index/image/fenxiang.png',
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
<body>
<!--加载页面-->
<div id="loading">
	<div class="loadBox">
		<img src="__HOME__/image/loading.png" />
	</div>
	<div class="spanPar">
		<div></div>
		<p>0%</p>
	</div>
</div>
<!-- 首页 -->
<div id="page1" class="container" style="display: none;">
		<div class="musice">
			<audio controls="controls" autoplay="autoplay" loop="loop"  id="musicAbtn" style="display: none;">
			  	<source src="__HOME__/bgm.mp3" type="audio/mp3" ></source>
			</audio>

			<!-- <div class="rotateClass">
				<img src="http://hyimg.hengdikeji.com/snmnh/music.png" style="width: 0.5rem;">
			</div> -->
		</div>
		<div id="topLogo">
			<div class="logoImg"><img src="__HOME__/image/logo.png"></div>
			<div class="myAward"><img src="__HOME__/image/myAward.png"></div>
		</div>
		<div class="footButton">
            <!--马上发布-->
			<img src="__HOME__/image/anniu.png" class="animated pulse infinite">
		</div>
</div>
<!-- 抽奖操作页 -->
<div id="page2"  class="container page2" style="display: none">
		<div class="awardOpen animated bounceIn">
			<div class="openBg"><img src="__HOME__/image/background.png"></div>
			<div class="name"><p>恭喜您获得<span id="m_red">188.00</span>元红包</p></div>
			<div class="imgDea">
                <ul class="redmsg">
                    <li class="li1">
                        <span class="bigfont" id="score">10</span>元
                    </li>
                    <li  class="li2">
                        温馨提示：不要走开还有更多红包等着你哦！
                    </li>
                </ul>
            </div>
            <a href="###" class="backHome">
            	<img src="__HOME__/image/backHome.png" />
            </a>
		</div>
</div>
<!-- 抽奖操作页 -->
<div id="page21"  class="container page2" style="display: none;">
		<div class="awardOpen animated bounceIn">
			<div class="openBg"><img src="__HOME__/image/background.png"></div>
			<div class="name"><p>差一点就拿到红包啦~</p></div>
			<div class="imgDea">
                <ul class="redmsg">
                    <li class="li1">
                        <p>恭喜发财</p>
                        <p>谢谢参与</p>
                    </li>
                    <li  class="li2">
                        温馨提示：不要走开还有更多红包等着你哦！
                    </li>
                </ul>
            </div>
            <a href="###" class="backHome">
            	<img src="__HOME__/image/backHome.png" />
            </a>
		</div>
</div>
<!-- 抽奖结果页 -->
<div id="page3" class="container " style="display: none;">
        <div class="star"></div>
		<!-- 实物奖品 -->
		<div class="awardOpen not animated bounceIn" style="display: none">
			<div class="openBg"><img src="http://hyimg.hengdikeji.com/snmnh/background.png"></div>
			<div class="name"><p>恭喜您获得U型抱枕</p></div>
			<div class="imgDea imgThing"><img src="http://hyimg.hengdikeji.com/snmnh/pillow.png" class=""></div>

			<div class="tipGet"><p>*请前往舞台左侧领奖区兑奖</p></div>
		</div>
		<!-- 红包或者没中奖 -->

		<div class="awardOpen has animated bounceIn" style="display: none">
			<div class="openBg"><img src="http://hyimg.hengdikeji.com/snmnh/background.png"></div>
			<div class="name"><p>恭喜您获得<span>20</span>元红包</p></div>
			<div class="imgDea">
                <ul class="redmsg">
                    <li class="li1">
                        <span class="bigfont ">10</span>
                        元
                    </li>
                    <li>
                        温馨提示：还可以继续发 <br />
                        祝福语抢红包与奖品
                    </li>
                </ul>
            </div>
		</div>
		<div class="footButton animated bounceIn" style="margin-top: 0.3rem;">
			<img src="http://hyimg.hengdikeji.com/snmnh/continueAbtn.png" class="">
		</div>
</div>
<!-- 奖品详情页 -->
<div id="page4" style="display: none;"  class="container">
        <div class="star"></div>
		<div id="awardTip">
			<div class="openBg"><img src="http://hyimg.hengdikeji.com/snmnh/background.png"></div>
			<div class="name"><p>恭喜您获得U型抱枕</p></div>
			<div class="imgDea imgThing"><img src="http://hyimg.hengdikeji.com/snmnh/pillow2.png" style="width: 60%;margin-left: 20%;margin-top: -0.7rem"></div>
			<div class="tipGet" style="bottom:0.9rem;font-size: 0.25rem"><p>请前往舞台左侧领奖区兑奖</p></div>
		</div>
		<div class="footButton">
			<img src="http://hyimg.hengdikeji.com/snmnh/toget.png" class="">
		</div>
</div>
<!-- 我的奖品 -->
<div id="page5"  class="container" style="display: none;">
<!--	<div>-->
        <div class="mylists">
            <div id="title" style="width: 100%;text-align: center">
                <div class="items" style="position: relative">
                    <img src="__HOME__/image/title.png" style="width:80%">
                </div>

            </div>
            <!-- 没有奖品时 -->
            <div id="mainAward" class="noPadding" style="height: 6rem;display: none;">
                <div class="nothing"><img src="http://hyimg.hengdikeji.com/snmnh/nothing.png"></div>
                <div class="tipFont">
                    <p>您还没抢到红包哦！</p>
                </div>
            </div>

            <!-- 有奖品时 -->
            <div id="mainAward" class="haveThing">
                <div id="mylist" style="height: 6.4rem!important;margin-top: 0.25rem">
                	<div class="box">
                		<div class="awardList">
	                        <div class="items listLeft"><img src="http://hyimg.hengdikeji.com/snmnh/redWatch.png"></div>
	                        <div class="items listRight">
	                            <h4>20元红包</h4>
	                            <p class="status"><button>已领取</button></p>
	                        </div>
	                    </div>
	                    <div class="awardList">
	                        <div class="items listLeft"><img src="http://hyimg.hengdikeji.com/snmnh/redWatch.png"></div>
	                        <div class="items listRight">
	                            <h4>20元红包</h4>
	                            <p class="status"><button>已领取</button></p>
	                        </div>
	                    </div>
	                    <div class="awardList">
	                        <div class="items listLeft"><img src="http://hyimg.hengdikeji.com/snmnh/redWatch.png"></div>
	                        <div class="items listRight">
	                            <h4>20元红包</h4>
	                            <p class="status"><button>已领取</button></p>
	                        </div>
	                    </div>
                	</div>
                    
                    <!--<div class="awardList">
                        <div class="items listLeft"><img src="http://hyimg.hengdikeji.com/snmnh/awardTwo.png"></div>
                        <div class="items listRight">
                            <h4>U型抱枕</h4>
                            <p>请前往舞台左侧领奖区兑奖</p>
                            <p class="status"><button class="toGet">立即领取</button></p>
                        </div>
                    </div>-->
                </div>
            </div>
            <div class="twoBtn">
            	<a href="###"><img src="__HOME__/image/btn01.png" /></a>
            	<a href="http://m.snimay.com/mobile.php/join"><img src="__HOME__/image/btn02.png" /></a>
            	<div class="cleatBoth"></div>
            </div>
            

        </div>


        <div class="details awardOpen" style="display: none">
            <div class="awardTip" style="position: relative">
                <div class="openBg"><img src="http://hyimg.hengdikeji.com/snmnh/background.png"></div>
                <div class="name"><p>恭喜您获得U型抱枕</p></div>
                <div class="imgDea imgThing" style="width: 3.5rem"><img src="http://hyimg.hengdikeji.com/snmnh/pillow2.png" style="width: 100%;margin-top: -0.3rem;margin-left: 0"></div>
                <div class="tipGet" style="bottom:1.2rem;font-size: 0.22rem;color: #fff"><p>请前往舞台左侧领奖区兑奖</p></div>
                <div class="tipGet" style="opacity: 1">
                    <input type="hidden" name="key" id="key" value="">
                    <input type="text" id="dhm" placeholder="由工作人员填兑换码" class="dhm">
                </div>
            </div>
            <div class="" style="margin: 0 auto;margin-top: 0.5rem;width: 40%">
                <img src="http://hyimg.hengdikeji.com/snmnh/toget.png" class="" onclick="sumit()" style="width: 100%">
            </div>
        </div>
</div>
<!--摇一摇-->
<div id="shank" class="container"  style="display: none">
	<div class="logoImg"><img src="__HOME__/image/logo.png"></div>
	<div class="circleBox">
		<div class="circle1">
			<img src="__HOME__/image/circle1.png" />
		</div>
		<div class="circle2">
			<img src="__HOME__/image/circle2.png" />
		</div>
		<div class="circle3">
			<img src="__HOME__/image/circle3.png" />
		</div>
		<div class="circle4">
			<img src="__HOME__/image/circle4.png" />
		</div>
	</div>
	<p class="phoneShank">手机摇起来</p>
</div>
<audio id="shank1" autoplay="autoplay"  preload  src="__HOME__/music/shank.mp3" hidden="hidden"></audio >
<script type="text/javascript" src="__HOME__/js/rem.js"></script>
<script type="text/javascript" src="__HOME__/js/popWin.js"></script>
<script>
/*page1*/
	/*音乐停止按钮*/
	/*var audio = document.getElementById('musicAbtn');
	$('.rotateClass').click(function(){
		if(audio.paused){
          audio.play();
          return;
        }else{
           audio.pause();
       }
    })*/
    //加载
	var re = 0;
	var start=0;
	var reTween = setInterval(function(){
		re++;
		if(re==101)
		{
			clearInterval(reTween);
			$('#loading').hide();
       		$('#page1').show();
        	$('#page1 #topicFont').addClass('animated bounceIn');
		}else{
			$('#loading .spanPar div').css('width',re+'%');
			$('#loading .spanPar p').text(re+'%');
		}
		
	},30);
//	$('#loading').hide();
//	$('#page1').hide();
 	//返回首页
 	$('#page2 .backHome').on('click',function(){
 		$('#shank').hide();
 		$('#page2').hide();
 		$('#page1').show();
 		
 	});
 	$('#page21 .backHome').on('click',function(){
 		$('#shank').hide();
 		$('#page21').hide();
 		$('#page1').show();
 		
 	});
 	$('#shank').on('click',function(){
        //请求后台，领红包
//        deviceMotionHandler();

        //请求后台，领红包
        $.post("<?php echo url('index2/send_red'); ?>",{rc:'<?php echo $rc; ?>'},function(res){
            shankOpen=true;
            if(res.code == 1){
                $('#m_red').html(res.amount);
                $('#score').html(res.amount);
                $('#page2').show();
            }else{
                popw('温馨提示',res.msg,1);
            }

        });
 	});
	//摇一摇数据
	var shankOpen = true;
	var u = navigator.userAgent, app = navigator.appVersion;
	var isiOS = !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/);	
	var SHAKE_THRESHOLD = 2000;
	if(isiOS==true){
	    SHAKE_THRESHOLD=500;
	}
	var last_update = 0;  
	var x = y = z = last_x = last_y = last_z = 0;  
	/*
	* @手机运动监听，摇一摇开始
	* */
	(function init() {
        if (window.DeviceMotionEvent) {  
             window.addEventListener('devicemotion', deviceMotionHandler, false);  
         } else {  
            alert('not support mobile event');  
   		}  
    })();
    function deviceMotionHandler(eventData) {

            if(start==0){
                return false;
            }

            var acceleration = eventData.accelerationIncludingGravity;  
            var curTime = new Date().getTime();  
            if ((curTime - last_update) > 100) {  
                var diffTime = curTime - last_update;  
                last_update = curTime;  
                x = acceleration.x;  
                y = acceleration.y;  
                z = acceleration.z;  
                var speed = Math.abs(x + y + z - last_x - last_y - last_z) / diffTime * 10000;  
                if (speed > SHAKE_THRESHOLD) {  
                    if(shankOpen==true)
                    {
                        document.getElementById('shank1').play();
                    	shankOpen=false;

                        //请求后台，领红包
                        $.post("<?php echo url('index/index2/send_red'); ?>",{rc:'<?php echo $rc; ?>'},function(res){
                            shankOpen=true;
                            if(res.code == 1){
                                $('#m_red').html(res.amount);
                                $('#score').html(res.amount);
                                $('#page2').show();
                            }else{
                                popw('温馨提示',res.msg,1);
                            }

                        });
                    }
                }  
                last_x = x; 
                last_y = y;  
                last_z = z;  
            }  
        }
    //
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
    audioAutoPlay('shank1',0);

    $('.twoBtn').find('a').eq(0).on('click',function(){
    	$('#page5').hide();
    	$('#page1').show();
    });
    
    /*点击跳转*/
    function myAward(){
        $.get("<?php echo url('index2/my_red_list'); ?>",function(res){
            var data = JSON.parse(res);
            $('#page5').show();
            $('#page5').siblings().hide();
            var len = data.length;
            if(len>=1){
                var html="";
                html +='<div class="box">';
                for(item in data){
                    html +='<div class="awardList">';
                    html +='<div class="items listLeft"><img src="http://hyimg.hengdikeji.com/snmnh/redWatch.png"></div>';
                    html +='<div class="items listRight">';
                    html +='<h4>'+data[item].amount+'元红包'+'</h4>';
                    html +='<p class="status"><button>已领取</button></p>';
                    html +='</div>';
                    html +='</div>';
                }
                html +='</div>';

                $('.haveThing').show().children('#mylist').html(html);
                $(".noPadding").hide();
                $(".haveThing").animate({
                    height:'7rem',
                },500);
            }else{
                $(".haveThing").hide();
                $(".noPadding").show();
            }

        },'JSON');
    }

	$('.myAward').click(function(){
		$('#page5').show();
        myAward();
	});
	
    /*抢红包*/
	$('#page1 .footButton').click(function(){

	    $.get("<?php echo url('index2/game'); ?>",function(res){
	        if(res.code==0){
                popw('温馨提示',res.msg,1);
                start=0;
            }else{
                start=1;
                $('#page1').hide();
                $('#shank').show();
            }
        },"JSON");
	})
/*page2*/

    function openred() {

        $.post("<?php echo url('msg/lottery'); ?>",{id:msgId},function(res){
            /**
             * code:1-中奖了，2-谢谢参与，0-出错了
             */
            if(res.code==0){
                popw('温馨提示',res.msg);
            }else if(res.code==2){
                $('#page3').show();
                $('#page3').siblings().hide();
                $('#page3').find('.awardOpen').hide();
                var name="差一点就拿到红包啦～";
                $('.name').text(name);
//                $('#page3').find('.name').children('p').text(name);
                $('#page3').find('.has').show().find('.imgDea').removeClass('redbag').addClass('notredbag');
            }else if(res.code==1){
                $('#page3').show();
                $('#page3').siblings().hide();
                $('#page3').find('.awardOpen').hide();
                if(res.prize_id==3){
                    var name="健康催眠U型枕";
                    $('.name').text(name);
                    $('#page3').find('.has').hide();
                    $('#page3').find('.not').show();
                }else{
                    var name="恭喜您获得"+res.amount+'元红包';
                    $('.name').text(name);

                    $('#page3').find('.name').children('p').children('span').text(res.amount);
                    $('#page3').find('.bigfont').text(res.amount);

                    $('#page3').find('.has').show().find('.imgDea').removeClass('notredbag').addClass('redbag');
                }
            }
        });

        /*
         * redbag：红包
         * notredbag：没有红包
         * */
    }

/*page3*/
	$('#page3 .footButton').click(function(){
        $('#content').val("");
		$('#page1').show();

		$('#page1').siblings().hide();
	})
/*page4*/
	$('#page4 .footButton').click(function(){
//		$('.toGet').eq(award_index).text('已领取');
//		$('.toGet').eq(award_index).removeClass('toGet');
		$('#page5').show();
		$('#page5').siblings().hide();
	})
/*page5*/
    function toGet(key,obj){
        if($(obj).attr('date-id')==0){
            $('.details').show();
            $('.mylists').hide();
            $('#key').val(key);

        }
    }
    function sumit() {
        var key=$('#key').val();
        var dhm=$('#dhm').val();
        $.post("<?php echo url('msg/putStatu'); ?>",{key:key,dhm:dhm},function(res){
            if(res.code==1){
                popw('温馨提示','领取成功',1,function(){
                    $('.details').hide();
                    $('.mylists').show();
                    myAward();
                });

            }else{
                popw('温馨提示',res.msg);
            }
        })
    }
	$('#page5 .footButton').click(function(){

        $(".noPadding").animate({
            height:'0.1rem',
        },500);
        $(".haveThing").animate({
            height:'0.1rem',
        },500);
		$('#page1').show();
		$('#page1').siblings().hide();

	})
/*星星闪烁*/
	function miao(){
		var startTime = new Date().getSeconds();
		if (startTime%2 ==0) {
			$("#page1 .container").addClass('star') 
		}else{
			$("#page1 .container").removeClass('star')  
		}
	}
	$(document).ready(function () {

        //判断诗苹果还是安卓
        var browser = {
            versions: function () {
                var u = navigator.userAgent, app = navigator.appVersion;
                return {//移动终端浏览器版本信息
                    trident: u.indexOf('Trident') > -1, //IE内核
                    presto: u.indexOf('Presto') > -1, //opera内核
                    webKit: u.indexOf('AppleWebKit') > -1, //苹果、谷歌内核
                    gecko: u.indexOf('Gecko') > -1 && u.indexOf('KHTML') == -1, //火狐内核
                    mobile: !!u.match(/AppleWebKit.*Mobile/i) || !!u.match(/MIDP|SymbianOS|NOKIA|SAMSUNG|LG|NEC|TCL|Alcatel|BIRD|DBTEL|Dopod|PHILIPS|HAIER|LENOVO|MOT-|Nokia|SonyEricsson|SIE-|Amoi|ZTE/), //是否为移动终端
                    ios: !!u.match(/\(i[^;]+;( U;)? CPU.+Mac OS X/), //ios终端
                    android: u.indexOf('Android') > -1 || u.indexOf('Linux') > -1, //android终端或者uc浏览器
                    iPhone: u.indexOf('iPhone') > -1 || u.indexOf('Mac') > -1, //是否为iPhone或者QQHD浏览器
                    iPad: u.indexOf('iPad') > -1, //是否iPad
                    webApp: u.indexOf('Safari') == -1 //是否web应该程序，没有头部与底部
                };
            }(),
            language: (navigator.browserLanguage || navigator.language).toLowerCase()
        }
//如果是苹果手机
        if (browser.versions.iPhone || browser.versions.iPad || browser.versions.ios) {
            $('body').height($('body')[0].clientHeight);
        }

//如果是安卓手机
        if (browser.versions.android) {
            $('#username').on('click', function () {
                var target = this;
                setTimeout(function(){
                    target.scrollIntoViewIfNeeded();

                },300);
            });
        }

    });
//	setInterval(miao,1000)
</script>
</body>
</html>