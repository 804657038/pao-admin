<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\admin\model\Set as AdminSet;

class Set extends Fater
{
    /**
     * 显示资源列表
     *
     * @return \think\Response
     */
    public function index(Request $request,AdminSet $adminSet)
    {
        //


        $this->userauth('set');

        $data=$adminSet->where('id',1)->value('value');

        return view('',[
            'token'=>$request->token(),
            'data'=>unserialize($data)
        ]);
    }

    /**
     * 显示创建资源表单页.
     *
     * @return \think\Response
     */
    public function create()
    {
        //
    }

    /**
     * 保存新建的资源
     *
     * @param  \think\Request  $request
     * @return \think\Response
     */
    public function save(Request $request,AdminSet $adminSet)
    {
        //
        $this->userauth('set-edit');
        $param=$request->param();
        return $adminSet->add($param);
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
    public function edit($id)
    {
        //
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
    public function delete($id)
    {
        //
    }
}
