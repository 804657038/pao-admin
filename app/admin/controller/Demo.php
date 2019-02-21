<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\controller\Table;
use app\common\controller\From;
use app\common\controller\Search;
use app\common\controller\Tool;
use app\admin\model\Log;

use app\admin\model\Demo as DemoModel;
class Demo extends Fater
{
    /*
     * 生成一个表格页面
     * */
    public function index(Table $table,DemoModel $from,Search $search,Tool $tool){
        $table->init($from);  //传入一个模型
        $table->column('id','编号');
        $table->column('name','名称');
        $table->column('text','说明');
        $table->searchs(function() use ($search){
            $search->set_name('name','名称')->rule('LIKE')->text();
        },$search);

        return $table->start();
    }
    public function dele(Request $request,From $from,DemoModel $user){

        $param=$request->param()['ids'];
        return $from->dele($param,$user);
    }
    /*
     * 生成一个表单页面
     * */
    public function create(Request $request,From $from,DemoModel $adminPrize){
        $id=$request->param('id',null);

        $from->init($adminPrize);  //实例化一个类
        $from->id($id);
        $from->field('text')->bank(false)->render('name','名称')->ruls('require|max:255');

        $from->field('textarea')->render('text','说明')->ruls('require|max:255');

        $from->field('image')->render('thumb','图片');
        $from->field('select')->option([
            [
                'name'=>'选项1',
                'value'=>'值1'
            ]
        ])->render('select','多项选择');

        return $from->start();
    }
    public function save(Request $request,From $from,DemoModel $adminPrize){
        $param=$request->param();
        return $from->save($param,$adminPrize);
    }

}