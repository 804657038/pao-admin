<?php

namespace app\index\model;

use think\Model;
class Msg extends Model
{
    //
    protected $pk = 'id';
    protected $table = 'admin_msg';
    protected $field = ['member_id','content','score','status','addTime','updateTime'];
    public function getMemberIdAttr($value){
        $open=(new Open)->where('id',$value)->field('open_name,open_face')->find();
        return $open;
    }

}