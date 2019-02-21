<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\Route;
Route::get([
    'award'=>'index/index/award',
    'gift'=>'index/index/gift',
    'map'=>'index/map/shoplist',
    'numbers'=>'index/index/numbers',
    'game_status'=>'index/game/game_status',
    'jbh'=>'index/index2/index',
]);
Route::post([
    'lottery1$'=>'index/lottery/lottery1', //抽奖控制器
    'lottery2$'=>'index/lottery/lottery2', //红利控制器
    'share$'=>'index/index/share', //抽奖控制器
    'addres$'=>'index/index/addres', //抽奖控制器
    'exchange'=>'index/index/change',
//    'hongbao'=>'index/game/put_honbao', //红包
    'hb'=>'index/index2/send_red'
]);

