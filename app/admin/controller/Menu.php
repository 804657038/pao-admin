<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Menu as AdminMenu;
use app\admin\model\Auth as AdminAuth;
class Menu extends Fater
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {
        //
        $this->userauth('menu');
        $list=tree_list((new AdminMenu)->order('listorder asc ,id asc')->select(),0);

        return view('',['list'=>$list,'token'=>$request->token()]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create(Request $request,AdminMenu $menu)
    {
        //
        $this->userauth('menu-add');

        $list=(new AdminAuth)->where('parent_id',0)->select();
        return view('',[
            'token'=>$request->token(),
            'menu_list'=>$menu->where('parent_id',0)->order('listorder asc,id asc')->select(),
            'auth_list'=>$list
        ]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request,AdminMenu $menu)
    {
        //
        $param=$request->post();
        return $menu->add($param);
    }

    /**
     * 显示指定的资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function read($id)
    {
        //
    }

    /**
     * 显示编辑资源表单页.
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function edit(Request $request,AdminMenu $menu)
    {
        $this->userauth('menu-edit');
        $id=$request->param()['id'];
        $data=AdminMenu::get($id);
        if(empty($data)){
            $this->error('您查询的数据不存在',url('auth/index'));
        }

        $list=(new AdminAuth)->where('parent_id',0)->select();
        return view('',[
            'data'=>$data,
            'token'=>$request->token(),
            'menu_list'=>$menu->where('parent_id',0)->order('listorder asc,id asc')->select(),
            'auth_list'=>$list
        ]);
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete(Request $request,AdminMenu $menu)
    {
        //
        $this->userauth('menu-delete');
        $param=$request->param()['ids'];
        return $menu->dele($param);
    }
}
