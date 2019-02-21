<?php

namespace app\admin\controller;

use think\Request;
use app\admin\model\Auth as AdminAuth;
class Auth extends Fater
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {
        //
        $this->userauth('auth');
        $list=tree_list(AdminAuth::all(),0);

        return view('',['list'=>$list,'token'=>$request->token()]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create(Request $request,AdminAuth $adminAuth)
    {
        //
        $this->userauth('auth-add');
        return view('',[
            'token'=>$request->token(),
            'auth_list'=>$adminAuth->where('parent_id',0)->select()
        ]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request,AdminAuth $adminAuth)
    {
        //

        $param=$request->post();
        return $adminAuth->add($param);
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
    public function edit(Request $request,AdminAuth $adminAuth)
    {
        $this->userauth('auth-edit');
        $id=$request->param()['id'];
        $data=AdminAuth::get($id);
        if(empty($data)){
            $this->error('您查询的数据不存在',url('auth/index'));
        }
        return view('',[
            'data'=>$data,
            'token'=>$request->token(),
            'auth_list'=>$adminAuth->where('parent_id',0)->select()
        ]);
    }

    /**
     * 保存更新的资源
     *
     * @param  \think\Request  $request
     * @param  int  $id
     * @return \think\Response
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * 删除指定资源
     *
     * @param  int  $id
     * @return \think\Response
     */
    public function delete(Request $request,AdminAuth $adminAuth)
    {
        //
        $this->userauth('auth-delete');
        $param=$request->param()['ids'];
        return $adminAuth->dele($param);
    }
}
