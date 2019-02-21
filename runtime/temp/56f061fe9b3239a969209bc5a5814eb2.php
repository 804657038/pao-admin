<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:65:"/Users/Web/snmnh/app/index/../../public/temp/index/msg/index.html";i:1515377750;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
	<meta content="yes" name="apple-mobile-web-app-capable"/>
	<meta content="black" name="apple-mobile-web-app-status-bar-style"/>
	<meta content="telephone=no" name="format-detection"/>
	<title>新经营 新营销 2018诗尼曼家居经销大会</title>
	<link rel="stylesheet" type="text/css" href="__STYLE__/css/reset.css">
	<link rel="stylesheet" type="text/css" href="__STYLE__/css/animate.min.css">
	<link rel="stylesheet" type="text/css" href="__STYLE__/css/all.css?v=12">
	<link rel="stylesheet" type="text/css" href="__STYLE__/css/popWindow.css" />
    <script type="text/javascript" src="__STYLE__/js/jquery-3.2.1.min.js"></script>
    <script src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
    <script type="text/javascript">
        //微信分享

        $.ajax({
            type:'GET',
            url:"<?php echo url('Index/jssdk_all'); ?>",
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
                        menuList: [
                            "menuItem:share:appMessage",
                            "menuItem:share:timeline",
                            "menuItem:share:qq",
                            "menuItem:share:weiboApp",
                            "menuItem:favorite",
                            "menuItem:share:facebook",
                            "menuItem:share:QZone",
                            "menuItem:copyUrl",
                            "menuItem:openWithQQBrowser",
                            "menuItem:openWithSafari"
                        ]
                    });
                })
            }
        });
    </script>
</head>
<body>
<!--加载页面-->
<div class="loadBox" style="z-index: 10;">
	<!-- 进度条 -->
	<div id="loading">
		<ul>
			<li><img src="__STYLE__/image/loading.png?V=1"></li>
			<li class="spanPar">
				<span class="bottom"></span>
				<span class="top"></span>
			</li>
		</ul>
	</div>
</div>
<!-- 首页 -->
<div id="page1" class="container" style="display: none;">
		<div class="star"></div>
		<div class="musice">
			<audio controls="controls" autoplay="autoplay" loop="loop"  id="musicAbtn" style="display: none;">
			  	<source src="__STYLE__/bgm.mp3" type="audio/mp3" />
			</audio>
			<!-- <div class="rotateClass">
				<img src="__STYLE__/image/music.png" style="width: 0.5rem;">
			</div> -->
		</div>
		<div id="topLogo">
			<div class="logoImg"><img src="__STYLE__/image/logo.png"></div>
			<div class="myAward"><img src="__STYLE__/image/myAward.png"></div>
		</div>
		<div id="topicFont" style="margin-top: -0.1rem"><img src="__STYLE__/image/topicFont.png"></div>
		<div id="centerInput">
			<textarea id="content" placeholder="请输入您对诗尼曼15周年的祝福或者您的新年愿望..."></textarea>
		</div>
		<div class="footButton">
            <!--马上发布-->
			<img src="__STYLE__/image/anniu.png" class="animated pulse infinite">
		</div>
</div>
<!-- 抽奖操作页 -->
<div id="page2"  style="display: none;" class="container">
        <div class="star"></div>
		<div class="awardOpen animated bounceIn" onclick="openred()">
			<div class="openBg"><img src="__STYLE__/image/background.png"></div>
			<div class="name"><p>恭喜您获得1个红包</p></div>
			<div class="imgDea">
                <ul class="redmsg">
                    <li class="li1">
                        <span class="bigfont" id="score">10</span>
                        分
                    </li>
                    <li>
                        您的祝福语评分
                    </li>
                </ul>
            </div>
		</div>
<!--		<div class="footButton animated bounceIn" style="margin-top: 0.3rem;">-->
<!--			<img src="__STYLE__/image/openRed.png" class="animated pulse infinite">-->
<!--		</div>-->
</div>
<!-- 抽奖结果页 -->
<div id="page3" class="container " style="display: none;">
        <div class="star"></div>
		<!-- 实物奖品 -->
		<div class="awardOpen not animated bounceIn" style="display: none">
			<div class="openBg"><img src="__STYLE__/image/background.png"></div>
			<div class="name"><p>恭喜您获得U型抱枕</p></div>
			<div class="imgDea imgThing"><img src="__STYLE__/image/pillow.png" class=""></div>

			<div class="tipGet"><p>*请前往舞台左侧领奖区兑奖</p></div>
		</div>
		<!-- 红包或者没中奖 -->

		<div class="awardOpen has animated bounceIn" style="display: none">
			<div class="openBg"><img src="__STYLE__/image/background.png"></div>
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
			<img src="__STYLE__/image/continueAbtn.png" class="">
		</div>
</div>
<!-- 奖品详情页 -->
<div id="page4" style="display: none;"  class="container">
        <div class="star"></div>
		<div id="awardTip">
			<div class="openBg"><img src="__STYLE__/image/background.png"></div>
			<div class="name"><p>恭喜您获得U型抱枕</p></div>
			<div class="imgDea imgThing"><img src="__STYLE__/image/pillow2.png" style="width: 60%;margin-left: 20%;margin-top: -0.7rem"></div>
			<div class="tipGet" style="bottom:0.9rem;font-size: 0.25rem"><p>请前往舞台左侧领奖区兑奖</p></div>
		</div>
		<div class="footButton">
			<img src="__STYLE__/image/toget.png" class="">
		</div>
</div>
<!-- 我的奖品 -->
<div id="page5" style="display: none;"  class="container">
<!--	<div>-->
        <div class="mylists">
            <div class="star"></div>
            <div class="musicOpen">
                <audio id="open"  style="display: none;">
                    <source src="__STYLE__/open.mp3" type="audio/mp3" />
                </audio>
            </div>
            <div id="title">
                <div class="items"><img src="__STYLE__/image/title.png" ></div>
            </div>
            <!-- 没有奖品时 -->
            <div id="mainAward" class="noPadding" style="display: none;height: 6rem">
                <div class="nothing"><img src="__STYLE__/image/nothing.png"></div>
                <div class="tipFont">
                    <p>您还没抢到奖品哦</p>
                    <p>赶紧行动吧!</p>
                </div>
            </div>

            <!-- 有奖品时 -->
            <div id="mainAward" class="haveThing" style="display: none">
                <div id="mylist" style="height: 6.4rem!important;overflow-y: scroll;margin-top: 0.25rem">
                    <div class="awardList">
                        <div class="items listLeft"><img src="__STYLE__/image/redWatch.png"></div>
                        <div class="items listRight">
                            <h4>20元红包</h4>
                            <p class="status"><button>已领取</button></p>
                        </div>
                    </div>
                    <div class="awardList">
                        <div class="items listLeft"><img src="__STYLE__/image/awardTwo.png"></div>
                        <div class="items listRight">
                            <h4>U型抱枕</h4>
                            <p>请前往舞台左侧领奖区兑奖</p>
                            <p class="status"><button class="toGet">立即领取</button></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footButton" style="margin: 0 auto;margin-top: 0.5rem">
                <img src="__STYLE__/image/backAbtn.png" class="">
            </div>

        </div>


        <div class="details awardOpen" style="display: none">
            <div class="awardTip" style="position: relative">
                <div class="openBg"><img src="__STYLE__/image/background.png"></div>
                <div class="name"><p>恭喜您获得U型抱枕</p></div>
                <div class="imgDea imgThing" style="width: 3.5rem"><img src="__STYLE__/image/pillow2.png" style="width: 100%;margin-top: -0.3rem;margin-left: 0"></div>
                <div class="tipGet" style="bottom:1.2rem;font-size: 0.22rem;color: #fff"><p>请前往舞台左侧领奖区兑奖</p></div>
                <div class="tipGet" style="opacity: 1">
                    <input type="hidden" name="key" id="key" value="">
                    <input type="text" id="dhm" placeholder="请输入兑换码" class="dhm">
                </div>
            </div>
            <div class="" style="margin: 0 auto;margin-top: 0.5rem;width: 40%">
                <img src="__STYLE__/image/toget.png" class="" onclick="sumit()" style="width: 100%">
            </div>
        </div>
</div>

<script type="text/javascript" src="__STYLE__/js/rem.js"></script>
<script type="text/javascript" src="__STYLE__/js/popWin.js"></script>
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
	/*进度条*/
    var bottomWidth=$('span.bottom').width();
    var myVar = setInterval(function(){spanWidth()},5);
    var msgId;
    function spanWidth(){
        var topWidth=$('span.top').width();
        topWidth+=1;
        $('span.top').width(topWidth);
        if (topWidth>=bottomWidth) {
            stopLoading();
        }
    }
    function stopLoading() {
        clearInterval(myVar);
        $('.loadBox').hide();
        $('#page1').show();
        $('#page1 #topicFont').addClass('animated bounceIn');
    }
	/*进度居中 */
    function setDivCenter(){   
        var top = ($(window).height() - $('#loading ul').height())/2-$('#loading ul').height(); 
        $('#loading').css( { 'padding-top' : top} );  
    }  
    setDivCenter();
    /*点击跳转*/
    function myAward(){
        $.get("<?php echo url('msg/myprize'); ?>",function(res){
            var datalist=res.list;
            $('#page5').show();
            $('#page5').siblings().hide();

            var arr = Object.keys(datalist);
            var len = arr.length;

            if(len>=1){
                var html="";

                for(item in datalist){
                    html +='<div class="awardList">';
                    if(datalist[item].id==2){
                        html +='<div class="items listLeft"><img src="__STYLE__/image/redWatch.png"></div>';
                    }else{
                        html +='<div class="items listLeft"><img src="__STYLE__/image/awardTwo.png"></div>';
                    }
                    html +='<div class="items listRight">';
                    if(datalist[item].id==2){
                        html +='<h4>'+datalist[item].amount+'元红包'+'</h4>';
                        html +='<p class="status"><button>已领取</button></p>';
                    }else{
                        html +='<h4>U型抱枕</h4>';
                        html +='<p>请前往舞台左侧领奖区兑奖</p>';
                        if(datalist[item].status==1){
                            html +='<p class="status"><button>已领取</button></p>';
                        }else{
                            html +='<p class="status"><button date-id="0" onclick="toGet('+datalist[item].key+',this)">立即领取</button></p>';
                        }
                    }

                    html +='</div>';

                    html +='</div>';
                }
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

        myAward();


	})

    /*马上发布*/
	$('#page1 .footButton').click(function(){
        var data=$('#content').val();
	    $.post("<?php echo url('msg/add'); ?>",{data:data},function(res){
	        if(res.code==1){
	            msgId=res.id;
                $('.name').text("恭喜您获得1个红包");
	            $('#score').text(res.score);
                $('#page2').show();
                $('#page2').siblings().hide();
            }else{
                popw('温馨提示',res.msg);
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