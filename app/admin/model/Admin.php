<?php

namespace app\admin\model;

use think\Model;

class Admin extends Model
{
    //
    protected $pk = 'id';

    protected $insert = ['add_time'];
    protected $update = ['password'];
    protected function setAddTimeAttr()
    {
        return date('Y-m-d H:i:s');
    }
    protected $field = ['username','password','group_id','auth','email','name','mobile','add_time','login_num','last_ip'];
    protected $veri=[
        'username|用户名'   => 'require|max:255|unique:admin,username',
        'password|登录密码'=>'require',
        'group_id|分组'=>'require',
        'auth|权限'=>'require',
        'email|邮箱'=>'email',
        'name|姓名'=>'max:255'
    ];

    public function getGroupIdAttr($value)
    {
        $role=Role::get($value);
        return ['id'=>$role['id'],'name'=>$role['name']];
    }
    public function add($param){
        try{
            $param['mobile']=trim($param['mobile']);
            if(!empty($param['mobile'])){
                $this->veri['mobile|手机号码']='regex:/^1[34578]\d{9}$/';

            }
            if($param['password']!=$param['password_confirm']){
                return rejson(0,'两次密码输入不一致');
            }
            if(strlen($param['password'])<6 ||strlen($param['password'])>16){
                return rejson(0,'登录密码的长度应该是6-16位');
            }
            $param['password']=encrypt($param['password']);
            $adminLog=new Log;

            if(isset($param['id'])){

                $result = (new Admin)
                    ->allowField(true)
                    ->validate($this->veri)
                    ->save($param,['id'=>$param['id']]);

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
            $adminLog=new Log;
            $ids=implode(',',$param);
            $this::destroy($ids);
            return $adminLog->admin_log(1,'删除成功','delete',$param,UID);
        }catch (\Exception $e){
            return rejson(0,$e->getMessage());
        }
    }
}
