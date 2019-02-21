<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: 流年 <liu21st@gmail.com>
// +----------------------------------------------------------------------

// 应用公共文件
// 通用加密
function encrypt($txt){
    $key=config('env')['APP_KEY'];
    srand((double)microtime() * 1000000);
    $encrypt_key = md5(rand(0, 32000));
    $ctr = 0;
    $tmp = '';
    for($i = 0;$i < strlen($txt); $i++) {
        $ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
        $tmp .= $encrypt_key[$ctr].($txt[$i] ^ $encrypt_key[$ctr++]);
    }
    return base64_encode(passport_key($tmp, $key));
}
// 通用解密
function decrypt($txt){
    $key=config('env')['APP_KEY'];
    $txt = passport_key(base64_decode($txt), $key);
    $tmp = '';
    for($i = 0;$i < strlen($txt); $i++) {
        $md5 = $txt[$i];
        $tmp .= $txt[++$i] ^ $md5;
    }
    return $tmp;
}
//加密解密解析函数
function passport_key($txt, $encrypt_key) {
    $encrypt_key = md5(md5($encrypt_key));
    $ctr = 0;
    $tmp = '';
    for($i = 0; $i < strlen($txt); $i++) {
        $ctr = $ctr == strlen($encrypt_key) ? 0 : $ctr;
        $tmp .= $txt[$i] ^ $encrypt_key[$ctr++];
    }
    return $tmp;
}
/**用户权限列表**/
function user_action_list($uid){
    $auth=db('admin')->where('id',$uid)->value('auth');
    if($auth){
        return explode(',',$auth);
    }
    return [];
}
function rejson($code,$msg){
    return json(['code'=>$code,'msg'=>$msg,'token'=>request()->token()]);
}
function tree_list($list,$parent_id){
    $tree=[];
    foreach ($list as $key=>$value){
        if($value['parent_id']==$parent_id){
            $value['child']=tree_list($list,$value['id']);
            $tree[]=$value;
        }
    }
    return $tree;
}
//去掉 地区后缀
function rempca($str){
    return str_replace(['省','市','区','县'],'',$str);
}
//curl获取请求文本内容
function get_curl_contents($url, $method ='GET', $data = array(),$headers='') {
    if ($method == 'POST') {
        //使用crul模拟
        $ch = curl_init();
        //禁用https
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        //允许请求以文件流的形式返回
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
        curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_URL, $url);
        if(!empty($headers)){
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        }
        $result = curl_exec($ch); //执行发送

        curl_close($ch);
    }else {
        if (ini_get('allow_fopen_url') == '1') {
            $result = file_get_contents($url);
        }else {
            //使用crul模拟
            $ch = curl_init();
            //允许请求以文件流的形式返回
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            //禁用https
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_URL, $url);
            $result = curl_exec($ch); //执行发送
            curl_close($ch);
        }
    }
    return $result;
}

function get_rand($proArr) {
    $result = '';
    //概率数组的总概率精度

    $arr=array();
    foreach ($proArr as $key => $val) {
        $arr[$val['id']] = $val['v'];
    }
    $proSum = array_sum($arr);
    //概率数组循环
    foreach ($arr as $key => $proCur) {
        $randNum = mt_rand(1, $proSum);
        if ($randNum <= $proCur) {
            $result = $key;
            break;
        } else {
            $proSum -= $proCur;
        }
    }
    unset ($proArr);
    return $result;
}
function togbk($str){
    return iconv('utf-8','GB2312//TRANSLIT//IGNORE',$str);
}

//省市区三级联动
function getLocation($table,$pid,$type){
    $region = db($table);
    $map['pid']=$pid;
    $map['type']=$type;
    $list=$region->where($map)->select();
    return $list;
}

function openWindow($msg,$url=''){
    $html='<script src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>';
    $html .='<script src="https://cdn.bootcss.com/layer/3.0.3/layer.min.js"></script>';
    $html .='<script type="text/javascript">layer.msg(\''.$msg.'\',{time:3000},function(){window.location.href="'.$url.'"})</script>';
    echo $html;
}

function webMsg($data,$uid){
    $to_uid = $uid;
// 推送的url地址，使用自己的服务器地址
    $push_api_url = "http://127.0.0.1:2121/";
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

    curl_close ( $ch );

}

function format_date($time){
    $t=time()-$time;
    $f=array(
        '31536000'=>'年',
        '2592000'=>'个月',
        '604800'=>'星期',
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