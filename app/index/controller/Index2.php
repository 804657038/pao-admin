<?php

namespace app\index\controller;

use think\Controller;
use think\Exception;
use think\Request;
use think\Loader;
use think\Db;
use app\index\model\Open;
use app\index\model\RedList;
use app\index\model\Prize;
class Index2 extends Fater
{
    public function _initialize(){
        parent::_initialize();
        if(!UID) {
            $this->redirect(url('Weixin/index'));
        }
        if (strpos($_SERVER['HTTP_USER_AGENT'], 'MicroMessenger') == false) {
            return "<h1 style='font-size: 40px'>请用微信浏览器打开</h1>";
        }
        define('WX_APPID',  'wx76d1aa542b3d83da');
        define('WX_MCHID', '1367286402');
        define('WX_KEY', '0Bd8mLaTyXjfJdRF1R1NaDLm0rSxV179');
        define('WX_APPSECRET', 'e08938754b2cc199627f424b17c5bf25');
        define('SSLCERT_PATH', "../extend/cert2/apiclient_cert.pem");
        define('SSLKEY_PATH', "../extend/cert2/apiclient_key.pem");
        define('SSLCA_PATH', "");

        define('NOTIFY_URL', '');
        define('WX_CURL_TIMEOUT', 30);
    }

    //手机端首页
    public function index(){

        $strPol = "ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789abcdefghijklmnopqrstuvwxyz_";
        $max = strlen($strPol)-1;
        $strPol = str_split($strPol);
        $string = '';
        for ($i = 0; $i < 8; $i++) {
            $string .= $strPol[mt_rand(0, $max)];
        }
        $wxapi=new \org\Wxapi;
        $url='http://snm.hengdikeji.com/nh2018/public/index.php/jbh';
        $signPackage=$wxapi->getSignPackage($url);
        $this->assign('signPackage',$signPackage);
        session('rc',$string);
        $this->assign('rc',$string);
        return $this->fetch();
    }


    //我的红包
    public function my_red_list(RedList $redList){
        $my = $redList->where('user_id',UID)->select();
        return json_encode($my);
    }

    //领取红包
    public function send_red(RedList $redList){
        Db::startTrans();
        try{



            $rc=input('post.rc','');
            if(session('rc')!=$rc || !$rc){
                return json([
                    'code'=>0,
                    'msg'=>'网络错误，请关闭页面重新打开'
                ]);
            }

            //游戏时间
            $gameTime = $this->game_time();
//            //是否领过
//            $MC=$redList->where('user_id',UID)->count();
//            if($MC>=1)return json(['code' => 0, 'msg' => '感谢您对诗尼曼家居的关注<br/>本活动限参与1次哦~']);
            //红包缓存
            $redList = cache('red');
            //是否还有红包
            $user = new RedList;
            $redCount = $user->count();
            if($redCount>=$redList['number']){
                return json(['code' => 0, 'msg' => '红包已经领完了']);
            }
            //微信id、微信昵称
            $open_id = session('user')['open_id'];
            $open_name = session('user')['open_name'];
            //红包金额
            $money = rand($redList['min']*100,$redList['max']*100)/100;
            //当前时间
            $nowTime = time();
            $toDay=strtotime(date('Y-m-d'));
            $group = 0;
            $record = 0;

            $MC= db('red_list')->where('user_id',UID)->where('add_time','egt',$toDay)->field('record')->find();

            if($gameTime['one_start'] <= $nowTime && $nowTime <= $gameTime['one_end']){
                //是否领过
                if($MC['record']==1)return json(['code' => 0, 'msg' => '本轮红包您已领取<br/>请等待下一轮哦~']);
                $record = 1;
                //第一轮
                $time1=floor(($nowTime-$gameTime['one_start'])/60);//游戏开始后1分钟
                if($time1 >= 1){
                    $g1 = db('red_list')
                        ->where('group',1)
                        ->where('add_time','>=',$toDay)
                        ->lock(true)
                        ->count();
                    if($g1<1){
                        $money = 188;
                        $group = 1;
                    }
                }

                $time2=floor(($gameTime['one_end']-$nowTime)/60);//游戏结束前10分钟

                if($time2 <= 10){
                    $g2 = db('red_list')
                        ->where('group',2)
                        ->where('add_time','>=',$toDay)
                        ->lock(true)
                        ->count();
                    if($g2<1){
                        $money = 188;
                        $group = 2;
                    }
                }

            }else if($gameTime['two_start'] <= $nowTime && $nowTime <= $gameTime['two_end']){
                //第二轮
                //是否领过
                if($MC['record']==2)return json(['code' => 0, 'msg' => '本轮红包您已领取<br/>请等待下一轮哦~']);
                $record = 2;
                $time3=floor(($nowTime-$gameTime['two_start'])/60);//游戏开始后1分钟
                if($time3 >= 1){
                    $g3 = db('red_list')->where('group',3)
                        ->where('add_time','>=',$toDay)
                        ->lock(true)
                        ->count();
                    if($g3<1){
                        $money = 188;
                        $group = 3;
                    }
                }
                $time4=floor(($gameTime['two_end']-$nowTime)/60);//游戏结束前10分钟
                if($time4 <= 10){
                    $g4 = db('red_list')->where('group',4)
                        ->where('add_time','>=',$toDay)
                        ->lock(true)
                        ->count();
                    if($g4<1){
                        $money = 188;
                        $group = 4;
                    }
                }

            }else if($gameTime['three_start'] <= $nowTime && $nowTime <= $gameTime['three_end']){
                //第三轮
                if($MC['record']==3)return json(['code' => 0, 'msg' => '本轮红包您已领取<br/>请等待下一轮哦~']);
                $record = 3;
                $time5=floor(($nowTime-$gameTime['three_start'])/60);//游戏开始后1分钟
                if($time5 >= 1){
                    $g5 = db('red_list')
                        ->where('group',5)
                        ->where('add_time','>=',$toDay)
                        ->lock(true)
                        ->count();
                    if($g5<1){
                        $money = 188;
                        $group = 5;
                    }
                }
                $time6=floor(($gameTime['three_end']-$nowTime)/60);//游戏结束前10分钟
                if($time6 <= 10){
                    $g6 = db('red_list')
                        ->where('group',6)
                        ->where('add_time','>=',$toDay)
                        ->lock(true)
                        ->count();
                    if($g6<1){
                        $money = 188;
                        $group = 6;
                    }
                }

            }else if($gameTime['four_start'] <= $nowTime && $nowTime <= $gameTime['four_end']){
                //第四轮
                if($MC['record']==4)return json(['code' => 0, 'msg' => '感谢您对诗尼曼家居的关注<br/>本活动已结束了哦~']);
                $record = 4;
                $time7=floor(($nowTime-$gameTime['four_start'])/60);//游戏开始后1分钟
                if($time7 >= 1){
                    $g7 = db('red_list')
                        ->where('group',7)
                        ->where('add_time','>=',$toDay)
                        ->lock(true)
                        ->count();
                    if($g7<1){
                        $money = 188;
                        $group = 7;
                    }
                }
                $time8=floor(($gameTime['four_end']-$nowTime)/60);//游戏结束前10分钟
                if($time8 <= 10){
                    $g8 = db('red_list')
                        ->where('group',8)
                        ->where('add_time','>=',$toDay)
                        ->lock(true)
                        ->count();
                    if($g8<1){
                        $money = 188;
                        $group = 8;
                    }
                }

            }else{
                return json(['code' => 0, 'msg' => '游戏暂未开放!']);
            }

            $re = $this->fhb($money,$open_id,$open_name);
            if ($re['code'] == 1) {
                $reds = [
                    'user_id'=>UID,
                    'add_time' =>time(),
                    'amount' => $money,
                    'status'=>1,
                    'group'=>$group,
                    'record'=>$record,
                    'mch_billno'=>$re['mch_billno'],
                ];
                db('red_list')->insert($reds);
                if($group>0){
                    $data=[
                        'open_name'=>$open_name,
                        'open_face'=>session('user')['open_face'],
                        'money'=>188,
                    ];
                    $this->sendMsg(json_encode($data));
                }
                Db::commit();
                return json(['code' => 1, 'msg' => '红包领取成功!', 'amount' => $money]);
            } else {
                Db::commit();
                return json(['code' => 0, 'msg' => '红包已经发完了!']);
            }

        }catch(Exception $e){
            Db::rollback();
            return json(['code' => 0, 'msg' => $e->getMessage()]);
        }
    }

    //$amount  红包钱总数
    public function fhb($amount,$open_id,$username){
        if($open_id){
            Loader::import('wx.WxPayPubHelper');
            $redpack = new \Redpack_pub($open_id);
            $username=$username?$username:'亲爱的家人';
            $total_amount=$amount*100;
            $mch_billno=UID.date('YmdHis').rand(1000, 9999);
            $redpack->setParameter("mch_billno","$mch_billno");//流水账号
            $redpack->setParameter("send_name",'诗尼曼家居');//红包名称
            $redpack->setParameter("nick_name",$username);//昵称
            $redpack->setParameter("min_value",1);//红包最小金额
            $redpack->setParameter("max_value",$total_amount);//红包最大金额
            $redpack->setParameter("total_amount",$total_amount);//红包钱总数
            $redpack->setParameter("total_num",1);//红包数量
            $redpack->setParameter("amt_type",'ALL_RAND');
            $redpack->setParameter("wishing",' ');//祝福语
            $redpack->setParameter("act_name",'诗尼曼家居');//活动名称
            $redpack->setParameter("remark",'红包流星雨');//备注
            $res=$redpack->sendRedpack();
            if($res['return_code']=="FAIL"){
                return [
                    'code'=>0,
                    'msg'=>$res['err_code_des']
                ];
            }
            if($res['result_code']=="FAIL"){
                return [
                    'code'=>0,
                    'msg'=>$res['err_code_des']
                ];
            }
            if($res['result_code']=="SUCCESS"&&$res['return_code']=="SUCCESS"){
                $json=array(
                    'code'=>1,
                    'mch_billno'=>$mch_billno
                );
                return $json;
            }else{
                $json=array(
                    'code'=>0,
                    'msg'=>'领取失败'
                );
                return $json;
            }
        }
    }

    //游戏时间
    public function game(RedList $redList){
        $toDay=strtotime(date('Y-m-d'));
        //是否领过
        $MC=$redList->where('user_id',UID)->where('add_time','>=',$toDay)->count();
        if($MC>=4)return json(['code' => 0, 'msg' => '感谢您对诗尼曼家居的关注<br/>您今天领红包已经到上限了~']);
        $gameTime = $this->game_time();
        $time = time();
        if($time<$gameTime['one_start']){
            return json(['code' => 0, 'msg' => '游戏未开始']);
        }elseif($time>=$gameTime['one_end'] && $time<$gameTime['two_start']){
            return json(['code' => 0, 'msg' => '第一轮已结束，等待下一轮']);
        }elseif($time>=$gameTime['two_end'] && $time<$gameTime['three_start']){
            return json(['code' => 0, 'msg' => '第二轮已结束，等待下一轮']);
        }elseif($time>=$gameTime['three_end'] && $time<$gameTime['four_start']){
            return json(['code' => 0, 'msg' => '第三轮已结束，等待下一轮']);
        }elseif($time>=$gameTime['four_end']){
            return json(['code' => 1, 'msg' => '游戏结束']);
        }else{
            return json(['code' => 1, 'msg' => '游戏开始']);
        }
    }


    public function sendMsg($data){
        try{
            // 指明给谁推送，为空表示向所有在线用户推送
            $to_uid = 221;
            // 推送的url地址，使用自己的服务器地址
            $push_api_url = "http://0.0.0.0:2121/";
            $post_data = array(
                "type" => "publish",
                "content" => $data,
                "to" => $to_uid,
            );
            $ch = curl_init ();
            curl_setopt ( $ch, CURLOPT_URL, $push_api_url );
            curl_setopt ( $ch, CURLOPT_POST, 1 );
            curl_setopt ( $ch, CURLOPT_HEADER, 0 );
            curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
            curl_setopt ( $ch, CURLOPT_POSTFIELDS, $post_data );
            curl_setopt ($ch, CURLOPT_HTTPHEADER, array("Expect:"));
            $return = curl_exec ( $ch );
            var_dump($return);
            curl_close ( $ch );
        }catch(Exception $e){
            var_dump($e->getMessage());
        }
    }



}
