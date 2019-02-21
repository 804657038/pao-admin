<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:55:"F:\wamp\www\yjnh\public/../app/admin\view\user\add.html";i:1512459862;s:60:"F:\wamp\www\yjnh\public/../app/admin\view\common\common.html";i:1512367574;}*/ ?>
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
        <form action="" method="post" class="layui-form layui-form-pane">
            <input class="layui-input" type="hidden" name="__token__" value="<?php echo $token; ?>">
            <div class="layui-form-item">
                <label class="layui-form-label">头像</label>
                <input type="hidden" name="image" id="logo" value="">
                <div class="layui-input-block">
                    <div class="layui-upload">
                        <button type="button" class="layui-btn layui-btn-primary" id="logoBtn"><i class="icon icon-upload3"></i>点击上传</button>
                        <div class="layui-upload-list" style="margin: 10px 12px;">
                            <img class="layui-upload-img" id="cltLogo">
                            <p id="demoText"></p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="name" class="layui-form-label">
                    <span class="x-red">*</span>姓名
                </label>
                <div class="layui-input-inline">
                    <div class="layui-input-inline">
                        <input type="text" id="name" value="" name="username" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="name" class="layui-form-label">
                    <span class="x-red">*</span>电话
                </label>
                <div class="layui-input-inline">
                    <div class="layui-input-inline">
                        <input type="text" value="" name="phone" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="name" class="layui-form-label">
                    <span class="x-red">*</span>性别
                </label>
                <div style="line-height: 38px">
                    <input style="margin-left: 12px" lay-ignore type="radio" value="1" name="sex" autocomplete="off" checked >男
                    <input style="margin-left: 12px" lay-ignore type="radio" value="0" name="sex" autocomplete="off" >女
                    <input style="margin-left: 12px" lay-ignore type="radio" value="2" name="sex" autocomplete="off" >保密
                </div>
            </div>
            <div class="layui-form-item">
                <label for="name" class="layui-form-label">
                    <span class="x-red">*</span>门店名
                </label>
                <div class="layui-input-inline">
                    <div class="layui-input-inline">
                        <input type="text" value="" name="store_name" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="name" class="layui-form-label">
                    <span class="x-red">*</span>省
                </label>
                <div class="layui-input-inline">
                    <select name="province" onchange="loadRegion('province',2,'city','<?php echo url('getAddrs'); ?>')" id="province" lay-ignore style="height: 38px;float: left;margin-right: 10px;border-color: #D2D2D2!important;">
                        <?php if(is_array($province) || $province instanceof \think\Collection || $province instanceof \think\Paginator): $i = 0; $__LIST__ = $province;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $vo['id']; ?>" ><?php echo $vo['name']; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="name" class="layui-form-label">
                    <span class="x-red">*</span>市
                </label>
                <div class="layui-input-inline">
                    <select name="city" onchange="loadRegion('city',3,'area','<?php echo url('getAddrs'); ?>')" id="city" lay-ignore style="height: 38px;float: left;margin-right: 10px;border-color: #D2D2D2!important;">

                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="name" class="layui-form-label">
                    <span class="x-red">*</span>区
                </label>
                <div class="layui-input-inline">
                    <select name="area" id="area" lay-ignore style="height: 38px;float: left;margin-right: 10px;border-color: #D2D2D2!important;">

                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <label for="name" class="layui-form-label">
                    <span class="x-red">*</span>详细地址
                </label>
                <div class="layui-input-inline">
                    <div class="layui-input-inline">
                        <input type="text" value="" name="addr" autocomplete="off" class="layui-input">
                    </div>
                </div>
            </div>

            <div class="layui-form-item">
                <button id="cubt" class="layui-btn" lay-submit="" lay-filter="add">提交</button>
            </div>
        </form>
    </div>
    <script>
        //省市区三级联动
        function loadRegion(sel,type_id,selName,url){
            jQuery("#"+selName+" option").each(function(){
                jQuery(this).remove();
            });
            jQuery("<option value=0>请选择</option>").appendTo(jQuery("#"+selName));
            if(jQuery("#"+sel).val()==0){
                return;
            }
            jQuery.getJSON(url,{pid:jQuery("#"+sel).val(),type:type_id},
                function(data){
                    if(data){
                        jQuery.each(data,function(idx,item){
                            jQuery("<option value="+item.id+">"+item.name+"</option>").appendTo(jQuery("#"+selName));
                        });
                    }else{
                        jQuery("<option value='0'>请选择</option>").appendTo(jQuery("#"+selName));
                    }
                }
            );
        }


        layui.use(['form', 'layer','upload'], function () {
            var form = layui.form,layer = layui.layer,upload = layui.upload,$ = layui.jquery;
            //普通图片上传
            var uploadInst = upload.render({
                elem: '#logoBtn'
                ,url: '<?php echo url("Fater/upload"); ?>'
                ,before: function(obj){
                    //预读本地文件示例，不支持ie8
                    obj.preview(function(index, file, result){
                        $('#cltLogo').attr('src', result); //图片链接（base64）
                    });
                }
                ,done: function(res){
                    //上传成功
                    if(res.code>0){
                        $('#logo').val(res.url);
                    }else{
                        //如果上传失败
                        return layer.msg('上传失败');
                    }
                }
                ,error: function(){
                    //演示失败状态，并实现重传
                    var demoText = $('#demoText');
                    demoText.html('<span style="color: #FF5722;">上传失败</span> <a class="layui-btn layui-btn-mini demo-reload">重试</a>');
                    demoText.find('.demo-reload').on('click', function(){
                        uploadInst.upload();
                    });
                }
            });

            //监听提交
            form.on('submit(add)', function(data){
                data.field.province = $('#province option:selected').text();
                data.field.city = $('#city option:selected').text();
                data.field.area = $('#area option:selected').text();
                var index = parent.layer.getFrameIndex(window.name);
                $.post("<?php echo url('user/insert'); ?>", data.field, function (res) {
                    if (res.code > 0) {
                        layer.msg(res.msg, {time: 6000, icon: 1}, function () {
                            //关闭当前frame
                            parent.layer.close(index);
                            window.parent.location.reload();
                        });
                    } else {
                        layer.msg(res.msg, {time: 6000, icon: 2});
                    }
                });
            });
        });

    </script>

    </body>

</html>