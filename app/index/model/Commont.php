<?php
namespace app\index\model;
use think\Model;
class Commont extends Model
{

    protected $pk = 'id';
    protected $table = 'admin_commont';
    public function getMemberIdAttr($value)
    {
//        $open=db('open')->where('id',$value)->value('open_name');
        $open=db('member')->where('user_id',$value)->value('username');
        return [
            'member_id'=>$value,
            'open_name'=>$open
        ];
    }
    public function getToMemberIdAttr($value)
    {
        $open=db('open')->where('id',$value)->value('open_face');
        $member=db('member')->where('user_id',$value)->field('username,image')->find();
        return [
            'member_id'=>$value,
            'open_name'=>$member['username'],
            'open_face'=>$member['image']?IMG_PATH.$member['image']:$open
        ];
    }
}
?>