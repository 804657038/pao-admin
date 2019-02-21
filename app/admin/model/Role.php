<?php

namespace app\admin\model;

use think\Model;

class Role extends Model
{
    //
    //
    protected $pk = 'id';

    protected $field = ['name','auth','desc'];
    protected $veri=[
        'name|菜单名称'   => 'require|max:255',
        'auth|权限标识'=>'require',
        'desc|简介'=>'max:255',
    ];
    public function add($param){
        try{
            $adminLog=new Log;
            if(isset($param['id'])){
                $result = $this->allowField(true)->validate($this->veri)->save($param,['id'=>$param['id']]);
                if(false === $result){
                    // 验证失败 输出错误信息
                    return rejson(0,$this->getError());
                }
                return $adminLog->admin_log(1,'修改成功','edit',$param,UID);
            }else{
                $result =$this->allowField(true)->validate($this->veri)->save($param);
                if(false === $result){
                    // 验证失败 输出错误信息
                    return rejson(0,$this->getError());
                }
                return $adminLog->admin_log(1,'提交成功','add',$param,UID);
            }
        }catch (\Exception $e){
            return rejson(0,$e->getMessage());
        }
    }
    public function dele($param){
        try{
            $adminLog=new AdminLog;
            $this::destroy($param);
            return $adminLog->admin_log(1,'删除成功','delete',$param,UID);
        }catch (\Exception $e){
            return rejson(0,$e->getMessage());
        }
    }
}
