<?php

namespace app\admin\model;

use think\Model;
use think\Request;

class Log extends Model
{
    //
    protected $pk = 'id';

    protected $insert = ['ip'];
    protected $update = ['ip'];
    protected function setIpAttr()
    {
        return request()->ip();
    }
    public function admin_log($code,$msg,$type,$data='',$user_id='',$url=''){
        $method=Request::instance()->method();
        $route=Request::instance()->controller().'/'.Request::instance()->action();

        $r=$this->allowField(true)->save([
            'type'=>$type,
            'status'=>$code==1?"success":"error",
            'dataJson'=>$code==1?json_encode($data):'',
            'err_msg'=>$code==0?$msg:'',
            'method'=>$method,
            'route'=>$route,
            'user_id'=>$user_id?$user_id:UID
        ]);

        return json(['code'=>$code,'msg'=>$msg,'url'=>$url,'token'=>Request::instance()->token()]);
    }

}
