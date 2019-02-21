<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Admin as Admin;
use app\admin\model\Menu;

class Fater extends Controller
{
    public function _initialize()
    {
        $member_id=session('admin_user')['user_id'];
        define('UID',$member_id);
        if(!UID){
            $this->redirect('login/login');
        }
        $Admin=new Admin;
        $login_num=$Admin->where('id',UID)->value('login_num');
        $action=Request::instance()->action();
        if($action!="loginout"){
            if(session('admin_user')['login_num']!=$login_num){
                $this->error('您的账号已在别处登录',url('index/loginout'));
            }
        }
        if(Request::instance()->isPost()){

            $result = $this->validate(
                [
                    '__token__'=>input('post.__token__')
                ],
                [
                    '__token__|令牌数据'=>'require|token'
                ]);

            if(true !== $result){
                return rejson(0,$result);
            }
        }

    }
    //用户权限验证
    protected function userauth($action_code) {
        //判断是否是系统用户，如果是，则不用验证权限，否则验证
        $action_list=user_action_list(UID);
        if(!in_array($action_code,$action_list)){
            $this->error('对不起，您没有该项操作权限','');
        }

    }
    public function get_region(TpRegion $region){
        $pid=request()->param()['pid'];
        $list=$region->where('parent_id',$pid)->select();
        return $list;
    }

    public function upload(){
        try{
            // 获取上传文件表单字段名
            $fileKey = array_keys(request()->file());
            // 获取表单上传文件
            $file = request()->file($fileKey['0']);
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
                $result['code'] = 1;
                $result['info'] = '图片上传成功!';
                $path=str_replace('\\','/',$info->getSaveName());
                $result['url'] = '/uploads/'. $path;
                return $result;
            }else{
                // 上传失败获取错误信息
                $result['code'] =0;
                $result['info'] = '图片上传失败!';
                $result['url'] = '';
                return $result;
            }
        }catch(\Exception $e){
            return ['code'=>0,'msg'=>$e->getMessage()];
        }
    }

}
