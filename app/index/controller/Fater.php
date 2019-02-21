<?php

namespace app\index\controller;

use think\Controller;
use think\Request;
use app\index\model\Info;
class Fater extends Controller
{
    public function _initialize()
    {
        $member_id=session('user')['user_id'];
        define('UID',$member_id);
        if(!UID){
            session('history',request()->url(true));
            $this->redirect(url('Weixin/index'));
        }

        //红包缓存
        $redList = cache('red');
        if(!$redList){
            $reds=db('prize')->where('id',2)->field('number,min,max')->find();
            cache('red',$reds);
        }


        $set=cache('set');
        if(!$set){
            $value=db('set')->where('id',1)->value('value');
            cache('set',unserialize($value));
        }
    }

    //游戏时间
    public function game_time(){
        $info = (new Info)->where('id',1)->find();
        $game_info = [
            'one_start'=>strtotime($info['one_start']),
            'one_end'=>strtotime($info['one_end']),
            'two_start'=>strtotime($info['two_start']),
            'two_end'=>strtotime($info['two_end']),
            'three_start'=>strtotime($info['three_start']),
            'three_end'=>strtotime($info['three_end']),
            'four_start'=>strtotime($info['four_start']),
            'four_end'=>strtotime($info['four_end']),
        ];
        return $game_info;
    }







}
