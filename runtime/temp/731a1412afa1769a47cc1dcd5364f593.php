<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:57:"F:\wamp\www\yjnh\public/../app/admin\view\menu\index.html";i:1510633168;s:60:"F:\wamp\www\yjnh\public/../app/admin\view\common\common.html";i:1512367574;s:57:"F:\wamp\www\yjnh\public/../app/admin\view\common\nav.html";i:1512360455;}*/ ?>
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

    <if>
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
            <button class="layui-btn" onclick="x_admin_show('添加菜单','<?php echo url('menu/create'); ?>',400,500)"><i class="layui-icon">&#xe61f;</i>添加</button>

        </xblock>

        <input class="layui-input" type="hidden" name="__token__" value="<?php echo $token; ?>">
        <table class="layui-table">
            <thead>
                <tr>
                    <th>
                        <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
                    </th>
                    <th>ID</th>
                    <th>菜单名称</th>
                    <th>菜单路由</th>
                    <th>权限标示</th>
                    <th>操作</th>
                </tr>
            </thead>
            <tbody>
                <?php if($list): if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <tr>
                        <td>
                            <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo $vo['id']; ?>'><i class="layui-icon">&#xe605;</i></div>
                        </td>
                        <td>
                            <?php echo $vo['id']; ?>
                        </td>
                        <td><?php echo $vo['name']; if($vo['icon']): ?>
                                <i class="layui-icon"><?php echo $vo['icon']; ?></i>
                            <?php endif; ?>
                        </td>
                        <td>
                            <?php if(!(empty($vo['route']) || (($vo['route'] instanceof \think\Collection || $vo['route'] instanceof \think\Paginator ) && $vo['route']->isEmpty()))): ?>
                                <a href="<?php echo url($vo['route']); ?>"><?php echo url($vo['route']); ?></a>
                            <?php endif; ?>
                        </td>
                        <td><?php echo $vo['auth']; ?></td>
                        <td class="td-manage">
                            <a title="编辑"  onclick="x_admin_show('编辑菜单','<?php echo url('menu/edit',['id'=>$vo['id']]); ?>',400,500)" href="javascript:;">
                                编辑
                            </a>
                            <a title="删除" onclick="delAll('<?php echo $vo['id']; ?>')" href="javascript:;">
                                删除
                            </a>
                        </td>
                    </tr>
                    <?php if($vo['child']): if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                            <tr>
                                <td>
                                    <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo $v['id']; ?>'><i class="layui-icon">&#xe605;</i></div>
                                </td>
                                <td>
                                    <?php echo $v['id']; ?>
                                </td>
                                <td>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <?php echo $v['name']; if($v['icon']): ?>
                                        <i class="layui-icon"><?php echo $v['icon']; ?></i>
                                    <?php endif; ?>
                                </td>
                                <td>
                                    <?php if(!(empty($v['route']) || (($v['route'] instanceof \think\Collection || $v['route'] instanceof \think\Paginator ) && $v['route']->isEmpty()))): ?>
                                        <a href="<?php echo url($v['route']); ?>"><?php echo url($v['route']); ?></a>
                                    <?php endif; ?>
                                </td>
                                <td><?php echo $v['auth']; ?></td>
                                <td class="td-manage">
                                    <a title="编辑"  onclick="x_admin_show('编辑菜单','<?php echo url('menu/edit',['id'=>$v['id']]); ?>',400,500)" href="javascript:;">
                                        编辑
                                    </a>
                                    <a title="删除" onclick="delAll('<?php echo $v['id']; ?>')" href="javascript:;">
                                        删除
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center">暂无数据</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <script type="text/javascript">
        layui.use(['layer'], function(){
            $ = layui.jquery;
            var layer = layui.layer;
        });

        function delAll(argument) {
            var data;
            if(argument){
                data =[argument];
            }else{
                data = tableCheck.getData();
            }
            var token=$('[name="__token__"]').val();
            layer.confirm('确认要删除吗？',function(index){
                //捉到所有被选中的，发异步进行删除
                //捉到所有被选中的，发异步进行删除
                var url="<?php echo url('menu/delete'); ?>";
                AjaxP(url,'POST',{"ids":data,"__token__":token},function(res){
                    if(res.code==1){
                        deleCall();
                    }

                });

            });
        }

    </script>
    </body>

</html>