<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Admin as AdminModel;
use app\admin\model\Role as AdminRole;
use app\admin\model\Auth as AdminAuth;
class Admin extends Fater
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request)
    {
        //
        $this->userauth('user');
        $type=$request->get('type');
        $where=[];
        $sreach=[
            'type'=>'',
            'key'=>'',
        ];

        if($type){
            $key=$request->get('key');
            $where[$type]=['LIKE','%'.$key.'%'];
            $sreach['type']=$type;
            $sreach['key']=$key;
        }

        $list=(new AdminModel)->where($where)->order('id asc')->paginate(15);
        $types=[
            ['username','用户名'],
            ['name','姓名'],
            ['email','邮箱'],
            ['mobile','手机'],
        ];
        return view('',[
            'list'=>$list,
            'token'=>$request->token(),
            'types'=>$types,
            'sreach'=>$sreach
        ]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create(Request $request)
    {
        //
        $this->userauth('user-add');
        $auth_list=tree_list(AdminAuth::all(),0);
        $role_list=AdminRole::all();
        return view('',[
            'token'=>$request->token(),
            'auth_list'=>$auth_list,
            'role_list'=>$role_list,
        ]);
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request,AdminModel $adminModel)
    {
        //

        $param=$request->post();
        if(empty($param['auth'])){
            $role= AdminRole::get($param['group_id']);
            $param['auth']=$role['auth'];
        }else{
            $param['auth']=implode(',',$param['auth']);
        }

        return $adminModel->add($param);
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
    public function edit(Request $request)
    {
        //
        //
        $this->userauth('user-edit');

        $id=$request->param()['id'];
        $data=AdminModel::get($id);

        if(!$data){
            $this->error('查询的数据为空');
        }
        $data['auth']=explode(',',$data['auth']);
        $auth_list=tree_list(AdminAuth::all(),0);
        $role_list=AdminRole::all();
        return view('',[
            'token'=>$request->token(),
            'auth_list'=>$auth_list,
            'role_list'=>$role_list,
            'data'=>$data
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
    public function delete(Request $request,AdminModel $adminModel)
    {
        //
        $this->userauth('role-delete');
        $param=$request->param()['ids'];
        return $adminModel->dele($param);
    }
}
