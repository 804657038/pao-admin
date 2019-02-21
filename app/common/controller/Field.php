<?php
/*
 * 表单字段设置
 * */
namespace app\common\controller;
use think\Controller;
use think\Request;
class Field extends Controller{
    protected $id='';
    protected $save;
    protected $field;
    protected $name;
    protected $alias;
    protected $from=[];
    protected $model;
    public $bank=true;
    public $default=null;
    public $option=[];

    /*单行文本*/
    public function text(){

        $laber=$this->bank?'<span class="x-red">*</span>':'';
        $required=$this->bank?'required  lay-verify="required"':'';
        $html=<<<EOF
<div class="layui-form-item">
    <label class="layui-form-label">
         {$laber}   
         {$this->alias}
    </label>
    <div class="layui-input-inline">
        <input type="text" name="{$this->name}"
               value="{$this->default}"
               placeholder="请输入{$this->alias}" autocomplete="off" class="layui-input"
            {$required}
        >
    </div>
</div>
EOF;
    return $html;
    }
    /*多文本*/
    public function textarea(){

        $laber=$this->bank?'<span class="x-red">*</span>':'';
        $required=$this->bank?'required  lay-verify="required"':'';
        $html=<<<EOF
<div class="layui-form-item layui-form-text">
    <label class="layui-form-label">
         {$laber}   
         {$this->alias}
    </label>
    <div class="layui-input-block">
    <textarea name="{$this->name}" placeholder="请输入{$this->alias}" autocomplete="off" class="layui-textarea"
     {$required}
    >{$this->default}</textarea>
      
    </div>
</div>
EOF;
        return $html;
    }

    /*数字*/
    public function number(){
        $laber=$this->bank?'<span class="x-red">*</span>':'';
        $required=$this->bank?'required':'';
        $html=<<<EOF
<div class="layui-form-item">
    <label class="layui-form-label">
         {$laber}   
         {$this->alias}
    </label>
    <div class="layui-input-inline">
        <input type="number" name="{$this->name}"
               value="{$this->default}"
               placeholder="请输入{$this->alias}" autocomplete="off" class="layui-input"
            {$required}
        >
    </div>
</div>
EOF;
        return $html;
    }
    /*单选*/
    public function radio(){
        $option_str='';
        $option=$this->option;
        foreach ($option as $key=>$value){
            if($this->default ==$value['value']){
                $option_str .='<input type="radio" name="'.$this->name.'" value="'.$value['value'].'" title="'.$value['name'].'" checked>';
            }else if($key==0){
                $option_str .='<input type="radio" name="'.$this->name.'" value="'.$value['value'].'" title="'.$value['name'].'" checked>';
            }else{
                $option_str .='<input type="radio" name="'.$this->name.'" value="'.$value['value'].'" title="'.$value['name'].'">';
            }

        }
        $html=<<<EOF
  <div class="layui-form-item">
    <label class="layui-form-label">{$this->alias}</label>
    <div class="layui-input-block">
        {$option_str}
    </div>
  </div>
EOF;
        return $html;
    }
    /*下拉选择*/
    public function select(){
        $option_str='';
        $option=$this->option;
        foreach ($option as $key=>$value){
            if($this->default ==$value['value']){
                $option_str .='<option type="radio"  value="'.$value['value'].'" selected>'.$value['name'].'</option>';
            }else{
                $option_str .='<option type="radio"  value="'.$value['value'].'">'.$value['name'].'</option>';
            }

        }
        $html=<<<EOF
  <div class="layui-form-item">
    <label class="layui-form-label">{$this->alias}</label>
    <div class="layui-input-inline">
         <select name="{$this->name}" lay-verify="required">
                {$option_str}
         </select>
    </div>
  </div>
EOF;
        return $html;
    }
    /*图片上传*/
    public function image(){
        $laber=$this->bank?'<span class="x-red">*</span>':'';
        $required=$this->bank?'required':'';
        $html=<<<EOF
<div class="layui-form-item">
    <label class="layui-form-label">
         {$laber}   
         {$this->alias}
    </label>
    <div class="layui-input-block">
       <button type="button" class="layui-btn" id="{$this->name}">
            <i class="layui-icon">&#xe67c;</i>上传图片
       </button>
       <script>
          layui.use('upload', function(){
          var upload = layui.upload;
           
          //执行实例
          var uploadInst = upload.render({
            elem: '#{$this->name}' //绑定元素
            ,url: '/upload/' //上传接口
            ,done: function(res){
              //上传完毕回调
            }
            ,error: function(){
              //请求异常回调
            }
          });
});
       </script>   
    </div>
</div>
EOF;
        return $html;
    }


    public function l_date(){
        $html=<<<EOF
  <div class="layui-form-item">
    <label class="layui-form-label">{$this->alias}</label>
    <div class="layui-input-inline">
         <input type="text" class="layui-input" name="{$this->name}" id="{$this->name}">
    </div>
    <script>
    layui.use('laydate', function(){
      var laydate = layui.laydate;
      
      //执行一个laydate实例
      laydate.render({
        elem: '#{$this->name}' //指定元素
      });
    });
    </script>
  </div>
EOF;
        return $html;
    }


    public function clear(){
        $this->bank=true;
        $this->default=null;
        $this->option=[];
    }
}
