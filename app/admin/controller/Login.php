<?php

namespace app\admin\controller;
use think\Controller;
use think\Request;
use app\admin\model\Log as AdminLog;
use app\admin\model\Admin;
class Login extends Controller
{
    public function login(Request $request){
        return view('index/login',['token'=>$request->token()]);
    }

    public function login_do(Request $request,AdminLog $adminLog,Admin $admin){
        try{
            if($request->isAjax()){
                $param=$request->post();
                $result = $this->validate(
                    $param,
                    [
                        'username|用户名'  => 'require|max:25|token',
                        'password|密码'   => 'require|length:6,20',
                        'captcha|验证码'=>'require|captcha'
                    ]);
                if(true !== $result){
                    // 验证失败 输出错误信息
                    return rejson(0,$result);
                }

                $user=$admin::get(['username'=>$param['username']]);

                $log_erro=session('logErro');
                if($log_erro && $log_erro['number']>=6 && $log_erro['time']>time()){
                    return $adminLog->admin_log(0,'密码连续输入错误次数超过6次，请15分钟后再尝试。','login','',$user->id);
                }
                if(!$user){
                    return rejson(0,'用户名错误');
                }

                if(empty($log_erro)){
                    $log_erro=['number'=>0];
                }else if($log_erro['number']>=6){
                    $log_erro['number']=0;
                }
                if($param['password']!=decrypt($user->password)){
                    $erro=[
                        'time'=>time()+900,
                        'number'=>$log_erro['number']+1
                    ];

                    session('logErro',$erro);
                    if($erro['number']>=3){
                        $msg="密码错误，还有".(6-$erro['number'])."次输入机会";
                    }else if($erro['number']>=8){
                        $msg="密码连续输入错误次数超过6次，请15分钟后再尝试。";
                    }else{
                        $msg='密码错误，请重新输入';
                    }

                    return $adminLog->admin_log(0,$msg,'login','',$user->id);
                }
                $id=$user->id;
                $user->login_num=$user->login_num+1;
                $user->last_ip=$request->ip();

                $user->save();

                $user_login=[
                    'user_id'=>$id,
                    'username'=>$user->username,
                    'login_num'=>$user->login_num
                ];

                session('admin_user',$user_login);
                return $adminLog->admin_log(1,'登录成功','login',$param,$id,url('index/index'));
            }
        }catch (\Exception $e){
            return rejson(0,$e->getMessage());
        }
    }
}
