<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:80:"/Users/Web/archie/yajienh/app/index/../../public/template/index/index/index.html";i:1512703227;}*/ ?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="__ADMIN__/lib/layui/css/layui.css">
    <script type="text/javascript" src="https://cdn.bootcss.com/jquery/3.2.1/jquery.min.js"></script>
    <script src="__ADMIN__/lib/layui/layui.js" charset="utf-8"></script>
</head>
<body>
    <h1>签到</h1>
<div>

    <div>
        <label>电话：</label>
        <input type="text" name="phone">
    </div>
    <div>
        <input type="hidden" name="token" value="<?php echo $token; ?>">
        <button onclick="add()">签到</button>
    </div>
</div>
</body>
</html>

<script>

    layui.use('layer', function(){
        var layer = layui.layer;
    });

    //添加
    function add(){

        var phone=$('[name="phone"]').val();
        var token=$('[name="token"]').val();
        $.ajax({
            url:"<?php echo url('index/edit'); ?>",
            type:"post",
            data:{
                "phone":phone,
                "__token__":token
            },
            success:function(re){
                if(re.code == 1){
                    layer.msg(re.msg);
                    location.reload();
                }else{
                    layer.msg(re.msg);
                }
            }
        })
    }

</script>


