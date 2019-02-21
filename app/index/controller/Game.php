<?php

namespace app\index\controller;

use think\Exception;
use think\Request;
use app\index\model\RedList;
use app\index\model\Open;
use app\index\model\Member;
use think\Controller;
use think\Db;

use think\cache\driver\Redis as RedisModel;

class Game extends Fater {
    protected $config=[
        'host'       => 'r-wz902c70019fd004.redis.rds.aliyuncs.com',
        'port'       => 6379,
        'password'   => 'Zz2381788',
        'select'     => 0,
        'timeout'    => 0,
        'expire'     => 0,
        'persistent' => false,
        'prefix'     => '',
    ];
    public function _initialize(){
        parent::_initialize();
        if(!UID) {
            $this->redirect(url('Weixin/index'));
        }
        $status=(new Member)->where('user_id',UID)->value('status');
        if($status!=1){
            $this->redirect(url('index/check'));
        }
    }

    /*
     * 红包页面
     * */
    public function honbao(){
        return view();
    }
    public function my_honbao(){
        $Redis=new RedisModel($this->config);
        $maximum=$Redis->zScore('red_count',UID);

        return view('',[
            'maximum'=>$maximum?$maximum:0
        ]);
    }

    /*
    * 抽红包
    * */
    public function put_honbao(Request $request,RedList $redlist){
        try{
            $Redis=new RedisModel($this->config);
            $list=$Redis->lpop('honbao');
            $data=json_decode($list,true);
            $game_status=cache('game_status');
            $game_status2=cache('game_status2');

            if($game_status!=1 && $game_status2!=1){
                return json([
                    'code'=>0,
                ]);
            }

            if(!empty($data)){
                if($game_status==1){
                    $has_i=$Redis->zScore('in_red1', UID); //是否参与游戏
                    if(!$has_i){
                        $Redis->Zadd('in_red1',1.0,UID);
                    }
                    $Redis->Zincrby('red_count1',(float)$data['amount'],UID); //红包总数
                    $Redis->Zincrby('red_list1',1,UID); //红包个数
                    $one_v= $Redis->zScore('red_one1', UID); //红包单个最大

                    $Redis->Zincrby('all1',1,'count');  //所有-个数
                    $Redis->Zincrby('all1',(float)$data['amount'],'amount'); //所有-金额

                    if(empty($one_v) || (float)$data['amount']>$one_v ){
                        $Redis->Zadd('red_one1',(float)$data['amount'],UID);
                    }
                }else if($game_status2==1){
                    $has_i=$Redis->zScore('in_red2', UID); //是否参与游戏
                    if(!$has_i){
                        $Redis->Zadd('in_red2',1.0,UID);
                    }
                    $Redis->Zincrby('red_count2',(float)$data['amount'],UID); //红包总数
                    $Redis->Zincrby('red_list2',1,UID); //红包个数
                    $one_v= $Redis->zScore('red_one2', UID); //红包单个最大

                    $Redis->Zincrby('all2',1,'count');  //所有-个数
                    $Redis->Zincrby('all2',(float)$data['amount'],'amount'); //所有-金额

                    if(empty($one_v) || (float)$data['amount']>$one_v ){
                        $Redis->Zadd('red_one2',(float)$data['amount'],UID);
                    }
                }
                return json([
                    'code'=>1,
                    'amount'=>$data['amount']
                ]);
            }
            return json([
                'code'=>0
            ]);
        }catch (Exception $e){
            return rejson(0,$e->getMessage());
        }
    }
    public function rank_honbao(RedList $list){
        //总额最多

        $Redis=new RedisModel($this->config);

        $res=$Redis->Zrevrange('red_count',0,0);
        $maximum=$Redis->zScore('red_count',$res[0]);

        //数量最多
        $res=$Redis->Zrevrange('red_list',0,0);
        $most=$Redis->zScore('red_list',$res[0]);

        //单个最大
        $res=$Redis->Zrevrange('red_one',0,0);
        $total=$Redis->zScore('red_one',$res[0]);

        return json([
            'maximum'=>$maximum,
            'most'=>$most,
            'total'=>$total,
        ]);
    }
    public function money(){

//        $Redis=new RedisModel($this->config);
       
        return view();
    }

    public function money_rank(Open $open,Member $member){

        if(request()->isAjax()){
            $Redis=new RedisModel($this->config);
            $rank_list=$Redis->Zrevrange('money',0,9);
            $data=[];
            foreach ($rank_list as $key=>$value){
                $r=$Redis->zScore('money',$value);
                $face=$open->where('id',$value)->value('open_face');
                $m=$member->where('user_id',$value)->field('image,username')->find();
                $data[$key]['num']=$r;
                $data[$key]['face']=$face;
                $data[$key]['image']=$m['image'];
                $data[$key]['username']=$m['username'];
            }
            return json([
                'data'=>$data
            ]);
        }

    }
    public function my_money(){
        $Redis=new RedisModel($this->config);
        $maximum=$Redis->zScore('money',UID);
        if(request()->isAjax()){
            return json([
                'num'=>$maximum?$maximum:0
            ]);
        }

        return view('',[
            'num'=>$maximum?$maximum:0
        ]);
    }
    public function put_money(){
        try{
            $game_status=cache('money_status');
            if($game_status!=1){
                return json([
                    'code'=>0,
                ]);
            }
            $Redis=new RedisModel($this->config);
            $has_i=$Redis->zScore('in_money',UID); //是否参与游戏
            if(!$has_i){
                $Redis->Zadd('in_money',1.0,UID);
            }
            $Redis->Zincrby('money',1,UID);
            $Redis->Zincrby('all',1,'mcount');
        }catch (Exception $e){
            return json([
                'code'=>0,
                'msg'=>$e->getMessage()
            ]);
        }
    }
    public function money_status(){
        $Redis=new RedisModel($this->config);

        $has_i=$Redis->zScore('in_money',UID); //是否参与游戏

        if($has_i==1.0){
            return json([
                'code'=>0,
                'msg'=>'您已经玩过了，留点机会给别人吧'
            ]);
        }

        $game_status=cache('money_status');
        if($game_status!=1){
            return json([
                'code'=>0,
                'msg'=>'游戏尚未开始'
            ]);
        }
        return json([
            'code'=>1,
            'msg'=>''
        ]);
    }


    public function game_status(){
        $game_status=cache('game_status');
        $game_status2=cache('game_status2');
        $Redis=new RedisModel($this->config);
        $has_i=$Redis->zScore('in_red', UID);
        if($has_i==1.0){
            return json([
                'code'=>0,
                'msg'=>'您已经玩过了，留点机会给别人吧'
            ]);
        }
        if($game_status!=1 && $game_status2!=1){
            return json([
                'code'=>0,
                'msg'=>'游戏尚未开始'
            ]);
        }

        return json([
            'code'=>1,
            'msg'=>''
        ]);
    }
}
?>