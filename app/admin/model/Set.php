<?php

namespace app\admin\model;

use think\Model;

class Set extends Model
{
    //
    protected $pk = 'id';

    protected $field = ['name','value'];
    public function add($param){
        try{
            $adminLog=new Log;
            $param['value']=serialize($param['value']);
            $result = $this->allowField(true)->save($param,['id'=>1]);
            if(false === $result){
                // 验证失败 输出错误信息
                return rejson(0,$this->getError());
            }
            return $adminLog->admin_log(1,'修改成功','edit',$param,UID);
        }catch (\Exception $e){
            return rejson(0,$e->getMessage());
        }
    }
}
