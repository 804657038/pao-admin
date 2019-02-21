<?php

namespace app\admin\controller;

use think\Controller;
use think\Request;
use app\common\controller\Table;
use app\common\controller\From;
use app\common\controller\Search;
use app\common\controller\Tool;
use app\admin\model\Member as MemberModel;
use app\admin\model\Log;
class User extends Fater
{
    public function index(Table $table,MemberModel $member,Search $search,Tool $tool){
        $this->userauth('activity');
        $table->init($member);  //传入一个模型
        $table->createAction=false; //禁用添加按钮
        $table->column('image','头像');
        $table->column('username','姓名');
        $table->column('phone','电话');
        $table->column('sex','性别');
        $table->column('store_name','门店名');
        $table->column('area','地区');
        $table->column('add_time','添加时间');
        $table->searchs(function() use ($search){
            $search->set_name('username','姓名')->rule('LIKE')->text();
            $search->set_name('phone','电话')->rule('=')->text();
        },$search);
//        $table->tool(function() use ($tool){
//            $tool->export_add(url('add_csv'));
//        },$tool);
        $table->tool(function() use ($tool){
            $tool->export(url('e_csv'));
        },$tool);
        return $table->start();

    }
    public function create(Request $request,MemberModel $member){
        $id=$request->param('id');
        if($id == ''){
            $this->redirect(url('add'));
        }
        $data = $member::get($id);
        $image = db('member')->where('id',$id)->field('image')->find();
        $list = $this->get_regData();
        return view('',[
            'token'=>$request->token(),
            'list'=>$list,
            'data'=>$data,
            'image'=>$image['image'],
        ]);
    }

    public function get_regData(){  //三级分类
        if(is_file('region.json')){
            $region= file_get_contents('region.json');
            return $region;
        }else{
            $list = getLocation('region',1,1);
            foreach($list as $k=>$v){
                $list[$k]['city'] = getLocation('region',$v['id'],2);
                foreach($list[$k]['city'] as $key=>$val){
                    $list[$k]['city'][$key]['area'] = getLocation('region',$val['id'],3);
                }
            }
            $region = json_encode($list);
            file_put_contents('region.json',$region);
            return $region;
        }
    }

    public function add(Request $request){
        $list = $this->get_regData();
        $this->assign('token',$request->token());
        $this->assign('list',$list);
        return $this->fetch();
    }
    public function insert(Request $request,MemberModel $member){
        try {
            $data = $request->param();
            return $member->addData($data);
        } catch (\Exception $e) {
            return rejson(0,$e->getMessage());
        }
    }


    public function save(Request $request,Log $log){
        try {
            $data = $request->param();
            $result = $this->validate(
                $data,
                [
                    'username|姓名' => 'require|max:25',
                    'phone|手机号码' => ['require', "regex:/^1[34578]{1}[0-9]{9}$/"],
                    'sex|性别' => 'require',
                    'store_name|门店名' => 'require|max:255',
                    'area|地区' => 'require|max:255',
                ]);
            if (true !== $result) {
                // 验证失败 输出错误信息
                return json(['code'=>0, 'msg'=>$result,'token'=>Request::instance()->token()]);
            }
            $m = db('member')->where('id',$data['id'])->find();
            if(!$m) return rejson(0,'您查询的数据不存在');
            unset($data['__token__']);
            unset($data['token']);
            unset($data['file']);
            $re = db('member')->where('id',$data['id'])->update($data);
            if($re !== false){
                return $log->admin_log(1,'修改成功','edit',$data,UID);
            }else{
                return $log->admin_log(0,'修改失败','edit',$data,UID);
            }
        } catch (\Exception $e) {
            return rejson(0,$e->getMessage());
        }
    }


    public function dele(Request $request,From $from,MemberModel $member){
        $param=$request->param()['ids'];
        return $from->dele($param,$member);
    }

    //导入数据
    public function add_csv(Request $request){
        return view('',[
            'token'=>$request->token(),
        ]);
    }
    public function save_csv(Request $request){
        if($_FILES['file']['error'] == 0){
            $member = db('member');
            $path = $_FILES['file']['tmp_name'];
            $handle=fopen($path,"r");
            while($data=fgetcsv($handle,10000,",")){
                foreach($data as $k=>$v){
                    $data[$k] = mb_convert_encoding($v, "UTF-8", "GBK");
                }
                $content[] = $data;
            }
            fclose($handle);
            unset($content[0]);
            foreach($content as $key=>$val){
                $arr = [
                    'username'=>$val[0],
                    'phone'=>$val[1],
                    'sex'=>$val[2],
                    'store_name'=>$val[3],
                    'area'=>$val[4],
                    'status'=>0,
                    'add_time'=>date('Y-m-d H:i:s'),
                    'ip'=>request()->ip(),
                    'image'=>''
                ];
                $m = $member->where('phone',$val[1])->find();
                if($m){
                    continue;
                }
                $re = $member->insert($arr);
                if($re){
                    openWindow('导入成功',url('add_csv'));
                }else{
                    openWindow('导入失败',url('add_csv'));
                }
            }

        }
    }



    //导出数据
    public function e_csv(){
        $file_name='雅洁年会报名.csv';
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='.$file_name);
        header('Cache-Control: max-age=0');
        //接收条件，查询表
        $user = db("member");
        $data='姓名,手机,性别,门店,地区'."\r\n";
        $arr = $user->order('id desc')->select();
        if(!$arr){
            $data .='没有找到相应的数据'."\r\n";
        }
        foreach($arr as $k=>$v){
            $area=$this->strG($v['area']);
            $data .= "{$v['username']},{$v['phone']},{$v['sex']},{$v['store_name']},{$area}"."\r\n";
        }
        return $data;
    }

    public function strG($data){
        $data=str_replace(',','，',$data);
        $data=str_replace("\r\n",'',$data);
        $data=str_replace("\r",'',$data);
        $data=str_replace("\n",'',$data);
        $data=str_replace("\"",'',$data);
        return $data;
    }

}