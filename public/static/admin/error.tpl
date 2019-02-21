<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
        "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <title>提示页面</title>

    <script type="text/javascript" src="<?php echo __ROOT__?>/static/admin/lib/layui/layui.js"></script>
</head>
<body>

</body>
<script type="text/javascript">
    layui.use('layer', function(){
        var layer = layui.layer;
        layer.msg('<?php echo(strip_tags($msg));?>', {icon: 5,time:<?php echo $wait*1000?>},function(){
            <?php if($url){ ?>
            var href = "<?php echo $url?>";
            location.href = href;
            <?php } ?>

        });
    });
</script>
</html>