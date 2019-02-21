<?php
namespace org;
class Express
{
    private $EBusinessID;
    private $AppKey;
    private $ReqURL;
    //快递鸟接口类
    //构造函数
    public function __construct()
    {
        $this->EBusinessID = "1313429";//电商ID
        $this->AppKey = "0e81cf54-9362-484b-8572-f68a559d8156";//秘钥
        $this->ReqURL = "http://api.kdniao.cc/Ebusiness/EbusinessOrderHandle.aspx";//接口URL
    }
    /**
     * Json方式 查询订单物流轨迹
     * @param  string $OrderCode 订单编号 默认空
     * @param  string $code 快递公司编码
     * @param  string $number 物流单号
     */
    function getOrderTracesByJson($code, $number){
        $requestData= "{'OrderCode':'','ShipperCode':'".$code."','LogisticCode':'".$number."'}";
        $datas = array(
            'EBusinessID' => $this->EBusinessID,
            'RequestType' => '1002',
            'RequestData' => urlencode($requestData) ,
            'DataType' => '2',
        );
        $datas['DataSign'] = $this->encrypt($requestData, $this->AppKey);
        $result=$this->sendPost($this->ReqURL, $datas);

        return $result;
    }

    /**
     *  post提交数据
     * @param  string $url 请求Url
     * @param  array $datas 提交的数据
     * @return url响应返回的html
     */
    function sendPost($url, $datas) {
        $temps = array();
        foreach ($datas as $key => $value) {
            $temps[] = sprintf('%s=%s', $key, $value);
        }
        $post_data = implode('&', $temps);
        $url_info = parse_url($url);
        if(empty($url_info['port']))
        {
            $url_info['port']=80;
        }
        $httpheader = "POST " . $url_info['path'] . " HTTP/1.0\r\n";
        $httpheader.= "Host:" . $url_info['host'] . "\r\n";
        $httpheader.= "Content-Type:application/x-www-form-urlencoded\r\n";
        $httpheader.= "Content-Length:" . strlen($post_data) . "\r\n";
        $httpheader.= "Connection:close\r\n\r\n";
        $httpheader.= $post_data;
        $fd = fsockopen($url_info['host'], $url_info['port']);
        fwrite($fd, $httpheader);
        $gets = "";
        $headerFlag = true;
        while (!feof($fd)) {
            if (($header = @fgets($fd)) && ($header == "\r\n" || $header == "\n")) {
                break;
            }
        }
        while (!feof($fd)) {
            $gets.= fread($fd, 128);
        }
        fclose($fd);

        return $gets;
    }

    /**
     * 电商Sign签名生成
     * @param data 内容
     * @param appkey Appkey
     * @return DataSign签名
     */
    function encrypt($data, $appkey) {
        return urlencode(base64_encode(md5($data.$appkey)));
    }

}