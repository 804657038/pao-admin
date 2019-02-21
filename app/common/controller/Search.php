<?php
/*
 * 搜索过滤器设置
 * */
namespace app\common\controller;
use think\Controller;
use think\Request;
class Search{
    protected $name;
    protected $option;
    protected $from=[];
    public $where=[];
    protected $as;
    public function set_name($name,$as=''){
        $this->name=$name;
        $this->as=$as;
        return $this;
    }
    public function option($option){
        $this->option=$option;
        return $this;
    }
    public function select(){
        $option='';
        $data=$this->option;

        $keyword=input('get.'.$this->name,'');

        foreach ($data as $key=>$value){
            if($keyword==$value['value']){
                $option .='<option value="'.$value['value'].'" selected>'.$value['name'].'</option>';
            }else{
                $option .='<option value="'.$value['value'].'">'.$value['name'].'</option>';
            }

        }
        $html=<<<EOF
 <div class="layui-input-inline">
        <select name="{$this->name}" class="search_input">
          {$option}
        </select>
 </div>
EOF;
        array_push($this->from,$html);

    }
    public function text(){
        $key=input('get.'.$this->name,'');
        $html=<<<EOF
 <div class="layui-input-inline">
     
        <input type="text" name="{$this->name}" value="{$key}" placeholder="请输入{$this->as}" autocomplete="off" class="layui-input search_input">
 </div>
EOF;
        array_push($this->from,$html);
    }
    /*
     * 设置搜索规则
     * */
    public function rule($rule){
        $value=input('get.'.$this->name,'');
        switch ($rule){
            case 'LIKE':
                if(!empty($value)){
                    $attr=[$rule,'%'.$value.'%'];
                    $this->where[$this->name]=$attr;
                }
                break;
            default:
                if(!empty($value)){
                    $attr=[$rule,$value];
                    $this->where[$this->name]=$attr;
                }

                break;
        }
        return $this;
    }
    /*
     * 获取搜索表单
     * */
    public function get_from(){
        return $this->from;
    }
    /*
     * 获取搜索条件
     * */
    public function get_where(){
        return $this->where;
    }
}