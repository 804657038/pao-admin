<?php

namespace app\index\model;

use think\Model;

class Sign extends Model
{
    //
    protected $pk = 'id';
    protected $table = 'admin_sign';
    protected $field =['open_id','sign_img','add_time'];

}
