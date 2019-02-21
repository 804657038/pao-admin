<?php
/*
 * 表单生成
 * */
namespace app\common\controller;
use think\Controller;
use think\Request;
use app\common\controller\Field;
use app\admin\model\Log;
class From extends Field{
    protected $addAction;
    public function __construct(Request $request = null)
    {
        parent::__construct($request);
        $controller=request()->controller();
        $save_url=$controller.'/'.'save';
        $this->save=url($save_url);
    }
    /*
     * 初始化
     * */
    public function init($model){
        session('ruls',[]);
        $this->model=$model;
    }
    /*
     * 设置字段类型
     * $type：字段类型
     * */
    public function field($type){

        $this->field=$type;
        return $this;
    }
    /*
     * 设置字段名称
     * $name:字段名称
     * $alias:字段别名
     * */
    public function render($name,$alias){
        $from=$this->from;
        $type=$this->field;
        $this->name=$name;
        $this->alias=$alias;

        if(!empty($this->id)){
            $model=$this->model;
            $pk=$model->getPk();
            $value=$model->where($pk,$this->id)->value($this->name);
            $this->default=$value;
        }

        $new =[
            'field'=>$this->$type()
        ];
        array_push($from,$new);
        $this->from=$from;
        $this->clear();
        return $this;
    }
    /*
     * 设置字段可否为空
     * */
    public function bank($bank){
        $this->bank=$bank;
        return $this;
    }
    /*
     * 设置字段默认值
     * */
    public function defaults($default){
        $this->default=$default;
        return $this;
    }
    /*
     * 设置id
     */
    public function id($id){
        $this->id=$id;
        return $this;
    }
    /*设置提交的链接
     * $url："admin/index"
     * */
    public function submit($url){
        $this->save=url($url);
        return $this;
    }
    /*
     * 选项 单选，多选，下拉选择通用。格式：key=>value
     * */
    public function option($option){
        $this->option=$option;
        return $this;
    }
    /*
     * 设置验证规则
     * */
    public function ruls($value){
        $ruls=session('ruls');
        if(!$ruls)$ruls=[];

        $ruls[$this->name.'|'.$this->alias]=$value;

        session('ruls',$ruls);
        return $this;
    }

    /*
   * 自定义提交操作
   * */
    public function addAction($url){
        $this->addAction=$url;
    }
    /*
     * 初始化表单，输出表单视图
     * */
    public function start(){
         return view('../../common/view/from/index',[
            'from'=>$this->from,
            'token'=>request()->token(),
            'id'=>$this->id,
            'save_url'=>$this->save,
            'addAction'=>$this->addAction
        ]);
    }
    /*
     * 通用提交
     * */
    public function save($param,$model){
        try{
            $adminLog=new Log;
            $ruls=session('ruls');

            if(isset($param['id'])&& !empty($param['id'])){
                $pk=$model->getPk();
                $result = $model->allowField(true)->validate($ruls)->save($param,[$pk=>$param['id']]);
                if(false === $result){
                    // 验证失败 输出错误信息
                    return rejson(0,$model->getError());
                }
                return $adminLog->admin_log(1,'修改成功','edit',$param,UID);
            }else{
                $result =$model->allowField(true)->validate($ruls)->save($param);
                if(false === $result){
                    // 验证失败 输出错误信息
                    return rejson(0,$model->getError());
                }
                return $adminLog->admin_log(1,'提交成功','add',$param,UID);
            }
        }catch (\Exception $e){
            return rejson(0,$e->getMessage());
        }
    }

    /*
     * 通用删除
     * */
    public function dele($param,$model){
        try{
            $adminLog=new Log;
            $ids=implode(',',$param);
            $mode=$model;
            $mode::destroy($ids);
            return $adminLog->admin_log(1,'删除成功','delete',$param,UID);
        }catch (\Exception $e){
            return rejson(0,$e->getMessage());
        }
    }

}