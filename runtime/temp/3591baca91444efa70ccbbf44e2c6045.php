<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:75:"F:\wamp\www\yjnh\public/../app/admin\view\..\..\common\view\from\index.html";i:1512381084;}*/ ?>
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
<body>
<div class="x-body">
    <form action="<?php echo $addAction; ?>" method="post" class="layui-form layui-form-pane">
        <input class="layui-input" type="hidden" name="__token__" value="<?php echo $token; ?>">
        <input class="layui-input" type="hidden" name="id" value="<?php echo $id; ?>">
        <?php if(is_array($from) || $from instanceof \think\Collection || $from instanceof \think\Paginator): $i = 0; $__LIST__ = $from;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
            <?php echo $v['field']; endforeach; endif; else: echo "" ;endif; ?>

        <div class="layui-form-item">
            <button class="layui-btn" lay-submit="" lay-filter="add">提交</button>
        </div>
    </form>
</div>
<script>
    layui.use(['form','layer'], function(){
        $ = layui.jquery;
        var form = layui.form
            ,layer = layui.layer;

        //监听提交
        form.on('submit(add)', function(data){
            <?php
                if(!$addAction){

                    echo ' AjaxP("'.$save_url.'","POST",data.field,false,false); return false;';
                }
            ?>


        });


    });

    function loadRegion(sel,type_id,selName,url,oldId){

    }
</script>
</body>
</html>