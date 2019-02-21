<?php
namespace app\index\controller;
use think\Db;
use app\index\model\Commont;
use app\index\model\Member;
use app\index\model\Open;
use think\Exception;
use think\Request;
use think\Controller;
use app\index\model\RedList;
class Pc extends Controller{

    public function index(){
        return $this->fetch();
    }

    public function game_end(Open $open){
        try{
            $count_open=$open->count(); //参与人数
            $user = new RedList;
            $redCount = $user->count();//发出的红包总数
            return [
                'code'=>1,
                'count_open' => $count_open,
                'count_red'=>$redCount,
            ];
        }catch (Exception $e){
            return [
                'code'=>0,
                'count_open' => $e->getMessage()
            ];
        }
    }

    public function red(){
        $red = (new RedList)->where('group','>',0)->order('add_time desc')->find();
        $red['open'] = (new Open)->where("id",$red['user_id'])->field('open_name,open_face')->find();
        return $red?$red:0;
    }

}
