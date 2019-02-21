<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Role as AdminRole;
use app\admin\model\Auth as AdminAuth;
class Role extends Fater
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {
        //
        $this->userauth('role');
        $list=(new AdminRole)->order('id asc')->paginate(15);
        return view('',['list'=>$list,'token'=>$request->token()]);

    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create(Request $request)
    {
        //
        $this->userauth('role-add');
        $list=tree_list(AdminAuth::all(),0);

        return view('',[
            'token'=>$request->token(),
            'auth_list'=>$list
        ]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request,AdminRole $adminRole)
    {
        //
        $param=$request->post();
        $param['auth']=implode(',',$param['auth']);
        return $adminRole->add($param);
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
    public function edit(Request $request,AdminRole $adminRole)
    {
        //
        $this->userauth('role-edit');
        $id=$request->param()['id'];
        $data=$adminRole::get($id);
        $data['auth']=explode(',',$data['auth']);
        if(empty($data)){
            $this->error('您查询的数据不存在',url('auth/index'));
        }
        $list=tree_list(AdminAuth::all(),0);
        return view('',[
            'data'=>$data,
            'token'=>$request->token(),
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
    public function delete(Request $request,AdminRole $adminRole)
    {
        //
        //
        $this->userauth('role-delete');
        $param=$request->param()['ids'];
        return $adminRole->dele($param);
    }
}
