<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:58:"F:\wamp\www\yjnh\public/../app/admin\view\index\login.html";i:1512367338;s:60:"F:\wamp\www\yjnh\public/../app/admin\view\common\common.html";i:1512367574;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>雅洁年会后台管理系统</title>
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,user-scalable=yes, minimum-scale=0.4, initial-scale=0.8,target-densitydpi=low-dpi" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />

    <link rel="stylesheet" href="__STYLE__/css/font.css">
    <link rel="stylesheet" href="__STYLE__/css/xadmin.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="__STYLE__/lib/layui/layui.js" charset="utf-8"></script>
    <script type="text/javascript" src="__STYLE__/js/xadmin.js"></script>
    
    <style>
        .captcha_input{width: 30% !important;float: left}
        .captcha{width: 70%;float: left;height:50px;}
    </style>

</head>

    <body class="login-bg">

    <div class="login">
        <div class="message" style="background: #52207B">欢迎登录雅洁年会报名管理系统</div>
        <div id="darkbannerwrap"></div>

        <form method="post" class="layui-form" >
            <input class="layui-input" type="hidden" name="__token__" value="<?php echo $token; ?>">
            <input name="username" placeholder="用户名"  type="text" lay-verify="required" class="layui-input" >
            <hr class="hr15">
            <input name="password" lay-verify="required" placeholder="密码"  type="password" class="layui-input">
            <hr class="hr15">
            <div>
                <input type="text" name="captcha" lay-verify="required" placeholder="验证码" class="layui-input captcha_input">
                <img src="<?php echo captcha_src(); ?>" alt="captcha" class="captcha" onclick="captcha(this)"/>
            </div>

            <hr class="hr15">
            <input value="登录" lay-submit lay-filter="login" style="width:100%;background: #52207B" type="submit">
            <hr class="hr20" >
        </form>
    </div>
    <script>
        
        $(function  () {
            layui.use('form', function(){
                var form = layui.form;

                //监听提交
              
                form.on('submit(login)', function(data){
                    $.ajax({
                        url:"<?php echo url('login/login_do'); ?>",
                        cache: false,
                        dataType: 'JSON',
                        type: 'POST',
                        data: data.field,
                        success:function(res){
                            $('[name="__token__"]').attr('value',res.token);
                            if(res.code==1){
                                window.location.href=res.url;
                            }else{
                                layer.msg(res.msg, {icon: 5,time:1000});
                                var $src=$('.captcha').attr('src');
                                $('.captcha').attr('src',$src+'?v='+Math.random());
                            }
                        }
                    });
                    return false;
                });
            });
            $('.captcha').on('click',function(){
                var $src=$(this).attr('src');
                $(this).attr('src',$src+'?v='+Math.random());
            })
        })


    </script>
    </body>


</html>