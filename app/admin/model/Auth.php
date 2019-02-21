<?php

namespace app\admin\model;

use think\Model;
use think\Request;
use app\admin\model\AdminLog;
class Auth extends Model
{

    //
    protected $pk = 'id';

    protected $field = ['parent_id','name','auth'];
    protected $veri=[
        'parent_id|上级权限'  => 'require|number',
        'name|权限名称'   => 'require|max:255',
        'auth|权限标识'=>'require|max:255|unique:admin_auth,auth'
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
            $ids=implode(',',$param);
            $parent_id=$this->where('parent_id','IN',$ids)->field('id')->select();

            foreach ($parent_id as $key=>$value){
                array_push($param,$value['id']);
            }
            $ids=implode(',',$param);
            $this::destroy($ids);
            return $adminLog->admin_log(1,'删除成功','delete',$param,UID);
        }catch (\Exception $e){
            return rejson(0,$e->getMessage());
        }
    }
}
