<?php
namespace wx;
class Wxapi {
    private $APPID;
    private $APPSECRET;
    //构造函数
    public function __construct($option = array()) {
        $this->APPID="wxe51333b9199fa330";
        $this->APPSECRET="5b5334a627ccc6a461005dfb89e7aaa9";
    }

    //生成临时二维码
    public function qrcode_ticket($scene="",$str="") {
        $url = sprintf("https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token=%s", $this->get_token());
        $data = array(
            'expire_seconds' => 2591000,//该二维码有效时间，以秒为单位。 最大不超过2592000（即30天），此字段如果不填，则默认有效期为30秒
            'action_name' => 'QR_SCENE',//二维码类型，QR_SCENE为临时,QR_LIMIT_SCENE为永久,QR_LIMIT_STR_SCENE为永久的字符串参数值
            'action_info' => array(
                'scene'=>array(
                    'scene_id' =>$scene?$scene:mt_rand(10,1000),//场景值ID，临时二维码时为32位非0整型，永久二维码时最大值为100000（目前参数只支持1--100000）
//                    'scene_str' => ''//场景值ID（字符串形式的ID），字符串类型，长度限制为1到64，仅永久二维码支持此字段
                )
            ),//二维码详细信息

        );
        $res = $this->curl_contents($url, 'POST', $data,1);
        $res = json_decode($res, true);
        return $res;
    }
    //构建模板消息
    public function get_template_msg($data){
        $token=$this->get_token();
        $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$token."";
        $res=$this->curl_contents($url,'POST',$data,2);
        return json_encode($res,true);
    }
    public function getSignPackage() {
        $jsapiTicket = $this->get_jsapi_ticket();

        // 注意 URL 一定要动态获取，不能 hardcode.
        $protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off' || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
        $url = "$protocol$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

        $timestamp = time();
        $nonceStr = $this->createNonceStr();

        // 这里参数的顺序要按照 key 值 ASCII 码升序排序
        $string = "jsapi_ticket=$jsapiTicket&noncestr=$nonceStr&timestamp=$timestamp&url=$url";
        $signature = sha1($string);

        $signPackage = array(
            "appId"     => $this->APPID, //ID
            "nonceStr"  => $nonceStr, //
            "timestamp" => $timestamp, //时间戳
            "url"       => $url,
            "signature" => $signature,
            "rawString" => $string
        );
        return $signPackage;
    }
    private function createNonceStr($length = 16) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789";
        $str = "";
        for ($i = 0; $i < $length; $i++) {
            $str .= substr($chars, mt_rand(0, strlen($chars) - 1), 1);
        }
        return $str;
    }
    //获取jsapi_ticket，有效期7200 s
    public function get_jsapi_ticket() {
        if (!cache('wx_ticket')) {
            $url = sprintf("https://api.weixin.qq.com/cgi-bin/ticket/getticket?access_token=%s&type=jsapi", $this->get_token());
            $res = $this->curl_contents($url);
            $res = json_decode($res, true);
            cache('wx_ticket', $res['ticket'], 5000);
        }
        $ticket = cache('wx_ticket');
        return $ticket;
    }
    //获取微信公从号access_token，有效期7200 s
    public function get_token() {
        if (!cache('wx_access_token')) {
            $url = 'https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid='.$this->APPID.'&secret='.$this->APPSECRET;
            //$url='http://api.npurl.cn/cgi-bin/token?grant_type=client_credential&appid='.$this->APPID.'&secret=APPSECRET';
            $res = $this->curl_contents($url);
            $res = json_decode($res, true);
            cache('wx_access_token', $res['access_token'], 5000);
        }
        $token = cache('wx_access_token');
        return $token;
    }
    //curl获取请求文本内容
    private function curl_contents($url, $method ='GET', $data = array(),$qcode="") {
        if ($method == 'POST') {
            //使用crul模拟
            $ch = curl_init();
            //禁用https
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            //允许请求以文件流的形式返回
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($ch, CURLOPT_POST, 1);
            if(empty($qcode)){
                curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
            }elseif($qcode==2){
                curl_setopt($ch, CURLOPT_POSTFIELDS, urldecode(json_encode($data)));
            }else{
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            }
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 30);
            curl_setopt($ch, CURLOPT_DNS_CACHE_TIMEOUT, 30);
            curl_setopt($ch, CURLOPT_URL, $url);
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
}
?>