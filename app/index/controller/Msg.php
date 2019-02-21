<?php
namespace app\index\controller;
use phpDocumentor\Reflection\DocBlock\Tags\Var_;
use think\Db;
use think\Exception;
use think\Request;

use app\index\model\Msg as MsgModel;
use think\cache\driver\Redis as RedisModel;

class Msg extends Fater{

    protected $config=[
        'host'       => 'r-wz910041cc1de5f4.redis.rds.aliyuncs.com',
//        'host'       => '127.0.0.1',
        'port'       => 6379,
        'password'   => 'Zz2381788',
//        'password'   => '',
        'select'     => 0,
        'timeout'    => 0,
        'expire'     => 0,
        'persistent' => false,
        'prefix'     => '',
    ];

    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $hasAjax=Request::instance()->isAjax();
        if(!UID){
            return json(['code'=>408]);
        }
    }

    public function index(){
        return view();
    }
    public function add(MsgModel $msg){
        try{
            $game_statu=cache('game_status');
            if($game_statu!=1){
                return json([
                    'code'=>0,
                    'msg'=>'活动还没开始'
                ]);
            }
            $Redis=new RedisModel($this->config);
            $content=input('post.data','');
            if(is_numeric($content)){
                return json([
                    'code'=>0,
                    'msg'=>'不能是纯数字哦'
                ]);
            };
            $result = $this->validate([
                'content'=>$content
            ], [
                'content|留言内容' =>'require|min:4',
            ],[
                'content.min'=>'请输入四个以上的字'
            ]);
            if(true !== $result){
                // 验证失败 输出错误信息
                return rejson(0,$result);
            }
            $strlen=mb_strlen($content, 'UTF-8');

            switch ($strlen){
                case ($strlen>=4 && $strlen<7):
                    $score=rand(1,3);
                    break;
                case ($strlen>=7 && $strlen<15):
                    $score=rand(3,5);
                    break;
                case ($strlen>=15 && $strlen<20):
                    $score=rand(5,7);
                    break;
                case $strlen>=20:
                    $score=rand(7,10);
                    break;
            }

            $data=[
                'member_id'=>UID,
                'content'=>$content,
                'score'=>$score,
                'addTime'=>time()
            ];
            $id=$msg->insertGetId($data);

            $Redis->Zincrby('msglist',$score,$id);
            return json([
                'score'=>$score,
                'code'=>1,
                'id'=>$id
            ]);

        }catch (Exception $e){
            return json([
                'code'=>0,
                'msg'=>'网络太差了，请刷新页面'
            ]);
        }
    }
  

    public function lottery(){
        try{

            $Redis=new RedisModel($this->config);
            $id=request()->post('id');

            if(!$id){
                return json([
                    'code'=>2,
                    'msg'=>'谢谢参与'
                ]);
            }
            $score=$Redis->zScore('msglist',$id);
            $prizeArr=[
                1=>[
                    'id'=>1,
                    'v'=>10,
                    'name'=>'谢谢参与'
                ]
            ];
            //查询第一阶段
            $money1=$Redis->get('money1');

            $money2=$Redis->get('money2');

            $money3=$Redis->get('money3');

            $money32=$Redis->get('money32');

            $sw1=$Redis->get('sw1');

            if($money1>0){
                $prizeArr[2]=[
                    'id'=>2,
                    'v'=>75,
                    'money'=>$money1,
                    'min'=>50,
                    'max'=>100,
                    'name'=>'红包1',
                    'group'=>'money1'
                ];



            }else if($money1<=0 && $money2>0){
                $prizeArr[2]=[
                    'id'=>2,
                    'v'=>75,
                    'money'=>$money2,
                    'min'=>188,
                    'max'=>188,
                    'name'=>'红包2',
                    'group'=>'money2'
                ];

            }else if($money2<=0 && $money3>0){
                $prizeArr[2]=[
                    'id'=>2,
                    'v'=>75,
                    'money'=>$money3,
                    'min'=>1,
                    'max'=>10,
                    'name'=>'红包3',
                    'group'=>'money3'
                ];

            }else if($money2<=0 && $money32>0){
                $prizeArr[4]=[
                    'id'=>4,
                    'v'=>75,
                    'money'=>$money32,
                    'min'=>128,
                    'max'=>128,
                    'name'=>'红包128',
                    'group'=>'money32'
                ];

            }
            if($sw1>0){
                $prizeArr[3]=[
                    'id'=>3,
                    'v'=>20,
                    'money'=>0,
                    'group'=>'sw1'
                ];
            }
       
            $prize_id=get_rand($prizeArr);


//            $prize_id=2;
            if($prize_id==1){
                return json([
                    'code'=>2,
                    'msg'=>'谢谢参与'
                ]);
            }

            $amount=0;
            if($prize_id==2 || $prize_id==4){
                $data=$prizeArr[$prize_id];
                if($data['min']==$data['max']){
                    $amount=$data['min'];
                }else{
                    if($data['money']<=$data['min']){
                        $amount=$data['money'];
                    }else if($data['money']>=$data['max']){
                        if($data['min']>=50){
                            switch ($score){
                                case 1:
                                    $amount=rand(50,55);
                                    break;
                                case 2:
                                    $amount=rand(55,60);
                                    break;
                                case 3:
                                    $amount=rand(60,65);
                                    break;
                                case 4:
                                    $amount=rand(65,70);
                                    break;
                                case 5:
                                    $amount=rand(70,75);
                                    break;
                                case 6:
                                    $amount=rand(75,80);
                                    break;
                                case 7:
                                    $amount=rand(80,85);
                                    break;
                                case 8:
                                    $amount=rand(85,90);
                                    break;
                                case 9:
                                    $amount=rand(90,95);
                                    break;
                                case 10:
                                    $amount=rand(95,100);
                                    break;
                            }
                        }else{

                            switch ($score){
                                case 1:
                                    $amount=rand(1,2);
                                    break;
                                case 2:
                                    $amount=rand(2,3);
                                    break;
                                case 3:
                                    $amount=rand(3,4);
                                    break;
                                case 4:
                                    $amount=rand(4,5);
                                    break;
                                case 5:
                                    $amount=rand(5,6);
                                    break;
                                case 6:
                                    $amount=rand(6,7);
                                    break;
                                case 7:
                                    $amount=rand(7,8);
                                    break;
                                case 8:
                                    $amount=rand(8,9);
                                    break;
                                case 9:
                                    $amount=rand(9,10);
                                    break;
                                case 10:
                                    $amount=rand(10,10);
                                    break;
                            }
                        }

                    }else if($data['money']>$data['min'] && $data['money']<=$data['max']){
                        $amount=rand($data['min'],$data['money']);
                    }
                }


                if($amount>=120){
                    $put=[
                        'code'=>1,
                        'amount'=>$amount,
                        'open_name'=>session('user')['open_name'],
                        'open_face'=>session('user')['open_face'],
                    ];
                    $Redis->rpush('bigreb',json_encode($put));
                }


                $Redis->dec($data['group'],$amount);

                $Redis->Zincrby('prize',(float)$amount,'hbcount'); //发出的红包总额
                $Redis->Zincrby('prize',1,'hbnumber'); //发出的红包总数

                $Redis->Zincrby('rank_count',(float)$amount,UID); //个人红包总额排行榜
                $Redis->Zincrby('rank_num',1,UID);  //个数红包数量排行榜
                $prize_id=2;
            }else if($prize_id==3){
                $data=$prizeArr[$prize_id];
                $Redis->dec($data['group'],1);
                $Redis->Zincrby('prize',1,'swcount'); //实物上限+1
                $Redis->Zincrby('prize',1,'mysw_'.UID);
            }else{
                return json([
                    'code'=>2,
                    'msg'=>'谢谢参与'
                ]);
            }
            $prize=[
                'id'=>$prize_id,
                'status'=>0,
                'amount'=>$amount
            ];
            $key=$Redis->inc(UID);
            $Redis->set('prize_'.UID.'_'.$key,$prize);
            $k=$Redis->Zincrby('my_'.UID,$key,$key);
            return json([
                'code'=>1,
                'msg'=>'成功',
                'prize_id'=>$prize_id,
                'amount'=>$amount
            ]);
        }catch (Exception $e){
            return json([
                'code'=>0,
                'msg'=>'网络太差了，请刷新页面'
            ]);
        }
    }

    public function myprize(){
        $Redis=new RedisModel($this->config);
        $list=$Redis->Zrevrange('my_'.UID,0,-1);
        $relist=[];
        foreach ($list as $key=>$value){
            $prize=$Redis->get('prize_'.UID.'_'.$value);
            $prize['key']=$value;
            $relist[$value]=$prize;

        }
        return ['list'=>$relist];
    }
    public function putStatu(){
        $key=input('post.key','');
        $dhm=input('post.dhm','');
        if(!$key){
            return json([
                'code'=>0,
                'msg'=>'网络错误，请刷新页面再次尝试'
            ]);
        }
        if($dhm!='2018'){
            return json([
                'code'=>0,
                'msg'=>'兑换码错误'
            ]);
        }

        $Redis=new RedisModel($this->config);
        $prize=$Redis->get('prize_'.UID.'_'.$key);
        if($prize){
            $prize['status']=1;
            $Redis->set('prize_'.UID.'_'.$key,$prize);
            return json([
                'code'=>1,
                'msg'=>''
            ]);
        }else{
            return json([
                'code'=>0,
                'msg'=>'网络错误，请刷新页面再次尝试'
            ]);
        }

    }
//    /*
//       * 设置奖品
//       * */
//    public function setPrize(){
//        $Redis=new RedisModel($this->config);
//        $res=$Redis->set('money1',1600,86400); //50-100
//        var_dump($res);
//        $res=$Redis->set('sw1',100,86400);
//        var_dump($res);
//        $res=$Redis->set('money2',1880,86400); //188
//        var_dump($res);
////        $res=$Redis->set('sw2',30,86400);
////        var_dump($res);
//        $res=$Redis->set('money3',1700,86400); //1-10
//        var_dump($res);
//        $res=$Redis->set('money32',1920,86400); //128
//        var_dump($res);
////        $res=$Redis->set('sw3',50,86400);
////        var_dump($res);
//        $this->success('设置成功',url('prize/index'),3);
//    }
//    public function rm(){
//        $Redis=new RedisModel($this->config);
//        $Redis->clear();
//    }
}
?>