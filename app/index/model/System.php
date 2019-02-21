<?php

namespace app\index\model;

use think\Model;

class System extends Model
{
    //
    protected $pk = 'id';
    protected $table = 'admin_system';
    protected $field =['ip_num','year_num','code_num','red_num'];

}
