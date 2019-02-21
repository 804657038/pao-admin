<?php
/*
 * 工具按钮
 * */
namespace app\common\controller;
class Tool{
    protected $export_url;
    protected $tool=[];
    public function __construct()
    {
        $controller=request()->controller();

        $url=url($controller.'/export');
        $this->export_url=$url.'?';
    }
    //导出数据
    public function export($url){
        $html=<<<EOF
        <a href="{$url}"><button class="layui-btn">导出数据</button></a>
EOF;
        array_push($this->tool,$html);//e_csv
    }
    //导入数据
    public function export_add($url){
        $html=<<<EOF
        <button class="layui-btn" onclick="x_admin_show('导入数据','{$url}',500,400)">导入数据</button>
EOF;
        array_push($this->tool,$html);//e_csv
    }
    //一个自定义按钮
    public function tool($name,$url,$class="layui-btn-primary"){
        $html=<<<EOF
        <a href="{$url}"><button class="layui-btn {$class}">{$name}</button></a>
EOF;
        array_push($this->tool,$html);//e_csv
    }
    /*
   * 获取按钮
   * */
    public function get_tool(){
        return $this->tool;
    }

}
