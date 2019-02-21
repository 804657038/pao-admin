<?php

namespace app\index\model;

use think\Model;
class Member extends Model
{
    //
    protected $pk = 'id';
    protected $table = 'admin_member';
    protected $field = ['username','phone','sex','store_name','area','addr','add_time','ip','status','user_id','image'];

    public function getUserIdAttr($value)
    {
        $pro=Open::get($value);
        return $pro['open_face'];
    }

}