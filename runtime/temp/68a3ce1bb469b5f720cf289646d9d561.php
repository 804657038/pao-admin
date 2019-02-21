<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:59:"F:\wamp\www\yjnh\public/../app/admin\view\user\add_csv.html";i:1512466701;s:60:"F:\wamp\www\yjnh\public/../app/admin\view\common\common.html";i:1512367574;}*/ ?>
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
        <div style="line-height: 50px">
            <p>温馨提示：请上传csv格式的excel文件</p>
        </div>
        <div style="line-height: 50px">
            <p>模板文件：下载模板，按模板格式上传。<span><a id="down" style="text-decoration: underline;" href="__ROOT__/uploads/模板.csv">点击下载</a></span></p>
        </div>
        <form action="<?php echo url('save_csv'); ?>" method="post" class="layui-form layui-form-pane" enctype="multipart/form-data">
            <input class="layui-input" type="hidden" name="__token__" value="<?php echo $token; ?>">
            <div style="line-height: 50px">
                <label>上传文件：</label>
                <input type="file" name="file">
            </div>
            <div class="layui-form-item" style="margin-top: 25px">
                <button id="cubt" class="layui-btn" lay-submit="" lay-filter="add">上传</button>
            </div>
        </form>
    </div>
    <script>

    </script>

    </body>

</html>