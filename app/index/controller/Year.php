<?php
namespace app\index\controller;
use think\Controller;
use think\Exception;
use think\Request;
use app\index\model\System;
use app\index\model\Record;
use app\index\model\Sign;
use app\index\model\Open;
class Year extends Fater
{
    public function _initialize(){
        parent::_initialize();
        if(!UID) {
            $this->redirect(url('Weixin/index'));
        }
    }

    public function index(Record $record, System $system, Sign $sign, Open $open){
        //首页的uv
        $ip = request()->ip();
        $r = $record->where('open_id',UID)->where('ip',$ip)->find();
        if(!$r){
            //添加
            $data = [
                'open_id'=>UID,
                'ip'=>$ip,
                'add_time'=>time()
            ];
            $record->insert($data);
            //自增
            $system->where('id',1)->setInc('ip_num');
        }
        //二维码扫码数
        $m = input('m');
        if(!isset($m)){
            //自增
            $system->where('id',1)->setInc('code_num');
        }
        if(isset($m) && $m == 1){
            //首页链接自增
            $system->where('id',1)->setInc('home_num');
        }
        if(isset($m) && $m == 2){
            //分享链接自增
            $system->where('id',1)->setInc('fen_num');
        }
        //微信头像、昵称
        $open = $open::get(['id'=>UID]);
        if(mb_strlen($open['open_name'],'utf-8')>=5){
            $open['open_name'] = mb_substr($open['open_name'],0,5,'utf-8').'..';
        }
        $file=UID.'.png';
        $path="static/head/";
        if(is_file($path.$file)==false){
            $this->put_file_from_url_content($open['open_face'],$file,$path);
        };
        $open['head']='http://snm.hengdikeji.com/nh2018/public/'.$path.$file;
        $this->assign('opens',$open);
        $this->assign('open',json_encode($open));
        //人数
        $u = $system->where('id',1)->value('user_num');
        $this->assign('u',$u);

        return view();
    }
    //有没有生成过年签
    public function getS(Sign $sign){
        //有没有生成过年签
        $sArr = $sign->where('open_id',UID)->find();
        if($sArr){
            $ms = json_encode($sArr);
        }else{
            $ms = '';
        }
        return $ms;
    }


    //保存年签
    public function save_sign(Sign $sign, System $system){
        $data['sign_img']=input('num');
        $data['open_id']=UID;
        $data['add_time']=time();
        $where="`open_id`=".UID." AND sign_img>0";
        $sArr = $sign->where($where)->find();
        if(!$sArr){
            $sign->insert($data);
            //自增
            $system->where('id',1)->setInc('year_num');
            return json(['code'=>1,'msg'=>'年签生成成功']);
        }else{
            $sign->where('open_id',UID)->update(['add_time'=>time()]);
            return json(['code'=>1,'msg'=>'年签生成成功']);
        }
    }

    //年签轮播
    public function sign_list(Sign $sign, Open $open){
        $sArr = $sign->where("sign_img!=0")->order('add_time desc')->limit(10)->select();
        foreach($sArr as $key=>$val){
            $sArr[$key]['open'] = $open->where('id',$val['open_id'])->find();
            $sArr[$key]['content'] = format_date($val['add_time']);
        }
        return json_encode($sArr);
    }

    function format_date($time){
        $t=time()-$time;
        $f=array(
            '86400'=>'天',
            '3600'=>'小时',
            '60'=>'分钟',
            '1'=>'秒'
        );
        foreach ($f as $k=>$v)    {
            if (0 !=$c=floor($t/(int)$k)) {
                return $c.$v.'前';
            }
        }
    }

    //红包icon
    public function red(System $system){
        $m = input('m');
        if($m && $m == 1){
            //自增
            $system->where('id',1)->setInc('red_num');
        }
        return json(['code'=>1,'msg'=>'保存成功']);
    }

    //微信分享
    public function jssdk_all(){
        $wxapi=new \org\Wxapi;
        $url=$_SERVER['HTTP_REFERER'];
        $signPackage=$wxapi->getSignPackage($url);
        return json($signPackage);
    }
    public function put_file_from_url_content($url, $saveName, $path) {
        // 设置运行时间为无限制
        set_time_limit ( 0 );
        $url = trim ( $url );
        $curl = curl_init ();
        // 设置你需要抓取的URL
        curl_setopt ( $curl, CURLOPT_URL, $url );
        // 设置header
        curl_setopt ( $curl, CURLOPT_HEADER, 0 );
        // 设置cURL 参数，要求结果保存到字符串中还是输出到屏幕上。
        curl_setopt ( $curl, CURLOPT_RETURNTRANSFER, 1 );
        // 运行cURL，请求网页
        $file = curl_exec ( $curl );
        // 关闭URL请求
        curl_close ( $curl );
        // 将文件写入获得的数据

        $filename = $path . $saveName;
        $write = @fopen ( $filename, "w" );
        if ($write == false) {
            return false;
        }
        if (fwrite ( $write, $file ) == false) {
            return false;
        }
        if (fclose ( $write ) == false) {
            return false;
        }
    }
}
