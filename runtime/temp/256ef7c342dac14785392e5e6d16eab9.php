<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:56:"F:\wamp\www\yjnh\public/../app/admin\view\set\index.html";i:1511941214;s:60:"F:\wamp\www\yjnh\public/../app/admin\view\common\common.html";i:1512367574;s:57:"F:\wamp\www\yjnh\public/../app/admin\view\common\nav.html";i:1512360455;}*/ ?>
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
    
</head>


    <div class="x-nav">
     <?php 

         $action=request()->action();
         $controller=request()->controller();
         $route=$controller.'/'.$action;

         $menu=db('menu')->where(['route'=>$route])->find();
         if($menu['parent_id']!=0){
         $menu2=db('menu')->where('id',$menu['parent_id'])->value('name');
         }
      ?>
      <span class="layui-breadcrumb">

        <a href="javascript:;"><?php echo $menu2; ?></a>

        <a><cite><?php echo $menu['name']; ?></cite></a>
      </span>

    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="<?php echo url($route); ?>" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i>
    </a>
</div>
    <div class="x-body">
        <div class="layui-tab">
            <ul class="layui-tab-title">
                <li class="layui-this">域名设置</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <blockquote class="layui-elem-quote">敲钟人数=实际人数+设定的人数</blockquote>
                    <form class="layui-form" action="">
                        <input class="layui-input" type="hidden" name="__token__" value="<?php echo $token; ?>">
                        <div class="layui-form-item">
                            <label class="layui-form-label">输入框</label>
                            <div class="layui-input-inline">
                                <input type="number" class="layui-input" name="value" value="<?php echo $data; ?>">
                            </div>

                        </div>
                        <div class="layui-form-item">
                            <div class="layui-input-block">
                                <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                            </div>

                        </div>

                    </form>
                </div>
            </div>
        </div>


    </div>
    <script type="text/javascript">
        layui.use(['layer','form'], function(){
            $ = layui.jquery;
            var layer = layui.layer;
            var form = layui.form;
            form.on('submit(formDemo)', function(data){
                AjaxP("<?php echo url('set/save'); ?>",'POST',data.field,function(res){
                    if(res.code==1){
                        layer.msg(res.msg, {icon: 6,time:1000},function(){
                            window.location.reload();
                        });
                    }else{
                        layer.msg(res.msg, {icon: 5,time:1000});
                    }
                },false);
                return false;
            });
        });


    </script>
    </body>

</html>