<?php

namespace app\index\model;

use think\Model;

class Record extends Model
{
    //
    protected $pk = 'id';
    protected $table = 'admin_record';
    protected $field =['open_id','ip','add_time'];

}
