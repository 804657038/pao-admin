<?php

namespace app\admin\controller;

use think\Request;
use think\Cache;
use app\admin\model\Menu;
use app\admin\model\Admin;

use think\cache\driver\Redis;


class Index extends Fater
{

    public function index()
    {
        $list=(new Menu)->order('listorder asc,id asc')->select();
        $admin=Admin::get(UID);
        $auth=explode(',',$admin->auth);
        foreach ($list as $key=>$value){
            if(!in_array($value['auth'],$auth)){
                unset($list[$key]);
            }
        }

        $menu_list=tree_list($list,0);
        return view('index/index',[
            'menu_list'=>$menu_list
        ]);
    }
    public function welcome(){
        //查询留言数量


        return view('');
    }
    public function loginout(){
        session(null);
        $this->redirect(url('login/login'));
    }
    public function clear(){
        Cache::clear();


        return json(['code'=>1,'msg'=>"清除成功"]);
    }
}
