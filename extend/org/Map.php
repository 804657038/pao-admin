<?php
namespace org;
class Map{
    const GETTABLE_NAME = 'shop2'; //表名
    const GEOTABLE_ID   = 169840;//geotable_id
    const AK            = 'GYpHWF0YvqvvVgU0nMyqdGGZalA7ZdBp';
    const URL           = 'http://api.map.baidu.com/';


    public function httpsRequest($url, $data = null)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
        if (!empty($data)){
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $output = curl_exec($curl);
        curl_close($curl);
        return $output;
    }
    /**
     * 创建数据
     */
    public function getOne($id){
        $url=self::URL . 'geodata/v3/poi/detail?id='.$id.'&geotable_id='.self::GEOTABLE_ID."&ak=".self::AK;
        $data=[];
//
//        $data['geotable_id'] = self::GEOTABLE_ID;
//        $data['ak']          = self::AK;

        $res=$this->httpsRequest($url);

        return json_decode($res,true);
    }
    public function poiCreate($create)
    {
        $url=self::URL . 'geodata/v3/poi/create';
        $data=[];
        $data['title']=$create['shopname'];
        $data['coord_type']=3;
        $data['tags']=$create['shopname'];
        $data['address']=$create['addres'];
        $data['longitude']=$create['location_x'];
        $data['latitude']=$create['location_y'];
        $data['phone']=$create['phone'];
        $data['username']=$create['username'];

        $data['geotable_id'] = self::GEOTABLE_ID;
        $data['ak']          = self::AK;

        $res=$this->httpsRequest($url,$data);

        return json_decode($res,true);
    }
    /**
     * 修改数据
     */

    public function poiUpdate($create)
    {
        $data=[];
        $data['coord_type']=3;
        $data['id']= $create['lbs_id'];
        $data['title']=$create['shopname'];
        $data['tags']=$create['shopname'];
        $data['address']=$create['addres'];
        $data['longitude']=$create['location_x'];
        $data['latitude']=$create['location_y'];
        $data['phone']=$create['phone'];
        $data['username']=$create['username'];

        $data['geotable_id'] = self::GEOTABLE_ID;
        $data['ak']          = self::AK;

        $url=self::URL . 'geodata/v3/poi/update';

        $res=$this->httpsRequest($url,$data);

        return json_decode($res,true);

    }
    /**
     * 删除数据
     */
    public function poiDelete($del)
    {
        $url=self::URL . 'geodata/v3/poi/delete';
        $data['id']          = $del['id'];
        $data['ak']          = self::AK;
        $data['geotable_id'] = self::GEOTABLE_ID;

        $res=$this->httpsRequest($url,$data);

        return json_decode($res,true);
    }

    /**
     * 周边搜索
     */
    public function geosearch($search)
    {
        $url=self::URL . 'geosearch/v3/nearby?';

        $data['geotable_id'] = self::GEOTABLE_ID;
        $data['ak']          = self::AK;
        $data['location']    = $search['location'];//用户位置
        $data['sortby']      = 'distance:1'; //按照距离排序
        $data['radius']      = 20000; //单位 米


        foreach($data as $key=>$val){
            $url.=$key.'='.$val.'&';
        }
        $url=rtrim($url,'&');

        $info=$this->httpsRequest($url);

        return json_decode($info,true);
    }
    /**
     * 搜索，添加城市
     * @return [type] [description]
     */
    public function geosearchCity($search)
    {

        $url=self::URL . 'geosearch/v3/nearby?';

        $data['geotable_id'] = self::GEOTABLE_ID;
        $data['ak']          = self::AK;
        $data['location']    = $search['location'];//城市位置
        $data['region']      = $search['address'];
        $data['sortby']      = 'distance:1'; //按照距离排序
        $data['radius']      = 100000; //单位 米
        $data['filter']      = 'store_status:1'; //设置为启用
        $data['page_index']  = $search['page_index']-1;

        foreach($data as $key=>$val){
            $url.=$key.'='.$val.'&';
        }
        $url=rtrim($url,'&');

        $info=$this->httpsRequest($url);

        return json_decode($info,true);
    }
}
?>