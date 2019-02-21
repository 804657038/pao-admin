var backLayer,redWrapLayer,countSound,bgmSound,readyTimer;
var STAGE_STEP = 5;
var readyNum = 3;
var speedStage = 0;
var imglist = {};
var imgData = new Array(

    {name:'redbar',path:parth+'/img/redbar.png'}

);

function main(){

    // 背景层初始化
    backLayer = new LSprite();
    addChild(backLayer);

    LLoadManage.load(

        imgData,

        function(progress){},

        gameInit

    );
}

function gameInit(result){

    imglist = result;

    backLayer.die();
    backLayer.removeAllChild();

    redWrapLayer = new LSprite();
    backLayer.addChild(redWrapLayer);

    countSound = new LSound();
    countSound.load(imglist['countSound']);

    bgmSound = new LSound();
    bgmSound.load(imglist['bgmSound']);
    
    bgmSound.play();

    // startInit();

}
var courseTime;
var link="http://snm.hengdikeji.com/nh2018/public";
var img_link="http://archie.hengdikeji.com/nh2017/public";
var c_amout=0;
var starttime;
function startInit(){
//  starttime=setInterval(function () {
//      $.get(link+'/index.php/index/pc/game_end',function(res){
//          if(res.code==1){
//              $('.div1191').find('span').html(res.count_open);
//              strs=res.hbnumber.toString(); //字符分割
//              var span='';
//              for (i=0;i<strs.length ;i++ )
//              {
//                  span +='<span>'+strs[i]+'</span>';
//              }
//              $('.hbnumber').html(span+'<sub>个</sub>');
//              $('#amount').text(res.hbcount+'元');
//              var obj=res.reb;
//              if(obj){
//                  window.parent.showPop(obj.open_name,obj.open_face,obj.amount);
//              }
//
//              // clearInterval(window.parent.msg);
//          }
//      });
//  },2000);

    backLayer.addEventListener(LEvent.ENTER_FRAME,onframe);
}

function onframe(){

    if (speedStage--<0) {
        speedStage = 10;
        addRed();
    }

    for(var i = 0;i<redWrapLayer.childList.length;i++){

        redWrapLayer.childList[i].onframe();
    }

}

// 增加红包
function addRed(){

    var msRedbar;

    msRedbar = new RedWrap();

    redWrapLayer.addChild(msRedbar);

}
function gameend() {
    clearInterval(starttime);
    $('.hbs').fadeOut();
    $('.bigreb').fadeIn();
    setTimeout(function () {
        $('#mylegend').hide();
    },500)
}
function RedWrap(){

    base(this,LSprite,[]);
    var self = this;

    self.bitmap = new LBitmap(new LBitmapData(imglist['redbar']));
    self.bitmap.scaleX = 0.6;
    self.bitmap.scaleY = 0.6;
    self.bitmap.x = fnRand(0,LGlobal.width-self.bitmap.getWidth());
    self.bitmap.y = -self.bitmap.getHeight();
    self.accspeed = fnRand(10,20);
    self.addChild(self.bitmap);

}

RedWrap.prototype.onframe = function(){
    var self = this;
    self.bitmap.y += self.accspeed;
    if (self.bitmap.y > LGlobal.height) {
        self.remove();
    }
}

//随机数
function fnRand(min,max){
    return parseInt(Math.random()*(max-min)+min);
}



$(function(){

    document.onkeydown = function(event){

        var e = event || window.event || arguments.callee.caller.arguments[0];

        // alert(e.keyCode);

        switch(e.keyCode)
        {
            case 87:  //键盘
                gameend();
                break;
        }

    };


    var oView = document.getElementById('view');
    var oLogoIcons = document.getElementById('logoIcons');
    var aSpan = oLogoIcons.getElementsByTagName('span');

    var spanNum = 50;


    for(var i = 0;i<spanNum;i++){

        var span = document.createElement('span');

        var xDeg = Math.round(Math.random()*360);
        var xR = 20+Math.round(Math.random()*240);

        var yR = 10+Math.round(Math.random()*240);
        var yDeg = Math.round(Math.random()*360);

        css(span,"rotateY",xDeg);
        css(span,"translateZ",xR);

        css(span,"rotateX",yDeg);
        css(span,"translateY",yR);

        span.style.backgroundImage = "url("+parth+"/img/loadIco"+i%9+".png)";

        oLogoIcons.appendChild(span);

    }

    /*
     键盘Q => 倒数页面
     键盘E => 结果页面
     */
        readyTimer = setTimeout(function(){
            startInit();
        },500);

    // setTimeout(function () {
    //     $('.countDown').show();
    //     // countSound.play();
    //
    //     readyTimer = setInterval(function(){
    //
    //         readyNum --;
    //         if (readyNum <= 0) {
    //             readyNum = '开始';
    //             clearInterval(readyTimer);
    //             setTimeout(function(){
    //                 $('.startBg').show();
    //                 // 开始游戏
    //
    //             },50);
    //
    //         }
    //         $('.frame p').text(readyNum+'!');
    //         $('.frame p').addClass('starRotate');
    //     },50);
    // },200);



})























