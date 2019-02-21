<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:57:"F:\wamp\www\yjnh\public/../app/admin\view\auth\index.html";i:1510541094;s:60:"F:\wamp\www\yjnh\public/../app/admin\view\common\common.html";i:1512367574;s:57:"F:\wamp\www\yjnh\public/../app/admin\view\common\nav.html";i:1512360455;}*/ ?>
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
        <xblock>
            <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon">&#xe640;</i>批量删除</button>
            <button class="layui-btn" onclick="x_admin_show('添加权限','<?php echo url('auth/create'); ?>',400,500)"><i class="layui-icon">&#xe61f;</i>添加</button>

        </xblock>
        <form action="" method="post" class="layui-form layui-form-pane">
            <input class="layui-input" type="hidden" name="__token__" value="<?php echo $token; ?>">
            <div class="layui-form-item layui-form-text">
                <table  class="layui-table layui-input-block">
                    <tbody>
                        <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <tr>
                                <td>
                                    <?php if($vo['child']): ?>
                                        &nbsp; &nbsp; &nbsp; &nbsp;
                                    <?php endif; ?>
                                    <div class="action" onclick="x_admin_show('权限修改','<?php echo url('auth/edit',['id'=>$vo['id']]); ?>',400,400)"><?php echo $vo['name']; ?>-<?php echo $vo['auth']; ?></div>
                                    <input name="id[]" type="checkbox" lay-filter="chaeckALl" class="chaeckALl chaeck" value="<?php echo $vo['id']; ?>">
                                </td>
                                <td>
                                    <div class="layui-input-block">
                                        <?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                            <input name="id[]" type="checkbox" class="chaeckChren<?php echo $vo['id']; ?> chaeck" value="<?php echo $v['id']; ?>">&nbsp;
                                            <div class="action" onclick="x_admin_show('权限修改','<?php echo url('auth/edit',['id'=>$v['id']]); ?>',400,400)"><?php echo $v['name']; ?>-<?php echo $v['auth']; ?></div>
                                        <?php endforeach; endif; else: echo "" ;endif; ?>

                                    </div>
                                </td>
                            </tr>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </tbody>
                </table>
            </div>
        </form>
    </div>
    <script type="text/javascript">
        layui.use(['form','layer'], function(){
            $ = layui.jquery;
            var form = layui.form
                ,layer = layui.layer;
            //监听提交
            form.on('submit(add)', function(data){
                console.log(data);
                //发异步，把数据提交给php
                layer.alert("增加成功", {icon: 6},function () {
                    // 获得frame索引
                    var index = parent.layer.getFrameIndex(window.name);
                    //关闭当前frame
                    parent.layer.close(index);
                });
                return false;
            });


        });
        function delAll (argument) {
            var ids=[];
            $('.chaeck').each(function(){
               if($(this).is(':checked')){
                   ids.push($(this).val());
               }
            });
            var token=$('[name="__token__"]').val();
            layer.confirm('此操作可能会导致系统故障，请谨慎处理！',function(index){
                //捉到所有被选中的，发异步进行删除
                var url="<?php echo url('auth/delete'); ?>";
                AjaxP(url,'POST',{"ids":ids,"__token__":token},function(){
                    deleCall();
                });
            });
        }
    </script>
    </body>

</html>