<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:66:"/Users/Web/archie/yajienh/public/../app/index/view/game/money.html";i:1513915619;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>雅洁数钱</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <link rel="stylesheet" type="text/css" href="__MONERY__/css/style.css">
    <link rel="stylesheet" type="text/css" href="__MONERY__/css/swiper.min.css">
    <link rel="stylesheet" type="text/css" href="__MONERY__/css/animate.min.css">
    <script type="text/javascript" src="__MONERY__/js/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src='__MONERY__/js/lufylegend-1.10.1.js'></script>
    <script type="text/javascript">
        var _monery="__MONERY__";
    </script>
    <!--移动端版本兼容 -->
    <script type="text/javascript" src='__MONERY__/js/mobile.js'></script>
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
    </script>
    <script src="https://cdn.staticfile.org/PreloadJS/0.6.0/preloadjs.min.js"></script>
    <script src="https://cdn.staticfile.org/SoundJS/0.6.0/soundjs.min.js"></script>
    <script type="text/javascript" src='__MONERY__/js/loading.js'></script>


</head>
<body>

<!-- 添加音乐 -->
<audio id="bgmusic" class="yue" controls preload="auto" loop="loop">
    <source src="__MONERY__/music/bgm.mp3" type="audio/mpeg">
</audio>
<div class="loading">
    <div class="page">
        <div class="h832" style="padding-top: 0px;">
            <div class="innerDiv">

                <div class="loading_c">
                    <img src="__MONERY__/img/logo.png" alt="" class="logoImg">
                    <p class="progress">0%</p>
                </div>

            </div>
        </div>
    </div>
</div>

<img src="__MONERY__/img/yue.png" alt="" class="mus rotate">

<!-- wrap -->
<div class="wrap page">
    <div class="h832" style="padding-top: 0px;">
        <div class="innerDiv">

            <img src="__MONERY__/img/logo.png" alt="" class="logo bounceInLeft">
            <img src="__MONERY__/img/moneybg.png" alt="" class="moneybg bounceIn">
            <img src="__MONERY__/img/banner.png" alt="" class="banner bounceInDown">
            <img src="__MONERY__/img/banner2.png" alt="" class="banner2 bounceInUp">
            <img src="__MONERY__/img/startBtn.png" alt="" class="startBtn bounceInUp">


        </div>
    </div>
</div>
<!-- 游戏说明 -->
<div class="ruleBg">

    <div class="ruleBg_c">
        <img src="__MONERY__/img/letGo.png" alt="" class="letGo">
    </div>

</div>

<!-- 游戏页面 -->
<div id="mylegend"></div>

<!-- 准备开始 -->
<div class="readyBg">

    <div class="kuang bounceInDown">
        <p>3!</p>
    </div>

    <img src="__MONERY__/img/hore.png" alt="" class="hore bounceInUp">
</div>

<!-- 输出结果 -->
<div class="resultBg">
    <div class="page">
        <div class="h832" style="padding-top: 0px;">
            <div class="innerDiv">
                <img src="__MONERY__/img/logo.png" alt="" class="logo">

                <img src="__MONERY__/img/zi1.png" alt="" class="zi1">

                <img src="__MONERY__/img/decorate.png" alt="" class="decorate">
                <p class="result_c">
                    <span>恭喜您,数到“毛爷爷”</span>
                    <i>1500元</i>
                </p>

                <img src="__MONERY__/img/zi.png" alt="" class="zi">

                <img src="__MONERY__/img/paiBtn.png" alt="" class="paiBtn">
            </div>
        </div>
    </div>
</div>

<!-- 排行榜 -->
<div class="rankingBg">
    <div class="kuang2">
        <img src="__MONERY__/img/rankingTit.png" alt="" class="rankingTit">
        <ul class="rank_list">
            <li>
                <div>
                    <img src="__MONERY__/img/1.png" alt="">
                </div>
                <div>
                    <img src="img/headerImg.png" alt="" class="headerImg">
                    <span>张三</span>
                </div>
                <div>
                    6800元
                </div>
            </li>
            <li>
                <div>
                    <img src="__MONERY__/img/2.png" alt="">
                </div>
                <div>
                    <img src="img/headerImg.png" alt="" class="headerImg">
                    <span>张三</span>
                </div>
                <div>
                    6800元
                </div>
            </li>
            <li>
                <div>
                    <img src="__MONERY__/img/3.png" alt="">
                </div>
                <div>
                    <img src="img/headerImg.png" alt="" class="headerImg">
                    <span>张三</span>
                </div>
                <div>
                    6800元
                </div>
            </li>
            <li>
                <div>
                    4
                </div>
                <div>
                    <img src="img/headerImg.png" alt="" class="headerImg">
                    <span>张三</span>
                </div>
                <div>
                    6800元
                </div>
            </li>
            <li>
                <div>
                    5
                </div>
                <div>
                    <img src="img/headerImg.png" alt="" class="headerImg">
                    <span>张三</span>
                </div>
                <div>
                    6800元
                </div>
            </li>

        </ul>

        <img src="__MONERY__/img/queBtn.png" alt="" class="queBtn">
    </div>


</div>



<script type="text/javascript">
    window.onload=function(){
        var hh = document.body.clientHeight;
        var ww = document.body.clientWidth;
        LGlobal.align = LStageAlign.MIDDLE;
        LGlobal.stageScale = LStageScaleMode.EXACT_FIT ;
        LSystem.screen(LStage.FULL_SCREEN);
        init(26,'mylegend',ww,hh,main,LEvent.INIT);
    }
</script>


<script type="text/javascript" src='__MONERY__/js/voucher.js'></script>
<script type="text/javascript" src='__MONERY__/js/money.js'></script>
<script type="text/javascript" src='__MONERY__/js/main.js'></script>


</body>
</html>