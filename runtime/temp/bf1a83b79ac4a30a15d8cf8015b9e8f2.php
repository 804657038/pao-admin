<?php if (!defined('THINK_PATH')) exit(); /*a:3:{s:58:"F:\wamp\www\yjnh\public/../app/admin\view\admin\index.html";i:1510664696;s:60:"F:\wamp\www\yjnh\public/../app/admin\view\common\common.html";i:1512367574;s:57:"F:\wamp\www\yjnh\public/../app/admin\view\common\nav.html";i:1512360455;}*/ ?>
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
        <div class="layui-row">
            <form method="get" action="<?php echo url('admin/index'); ?>" class="layui-form layui-col-md12 x-so">
                <div class="layui-input-inline" style="width: 100px">
                    <select name="type" lay-verify="required">
                        <?php if(is_array($types) || $types instanceof \think\Collection || $types instanceof \think\Paginator): $i = 0; $__LIST__ = $types;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                            <option value="<?php echo $vo[0]; ?>" <?php if($sreach['type'] == $vo[0]): ?>selected<?php endif; ?>><?php echo $vo[1]; ?></option>
                        <?php endforeach; endif; else: echo "" ;endif; ?>
                    </select>
                </div>
                <div class="layui-input-inline">
                    <input type="text" name="key" value="<?php echo $sreach['key']; ?>" placeholder="请输入用户名" autocomplete="off" class="layui-input">
                </div>

                <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
            </form>
        </div>
        <xblock>
            <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
            <button class="layui-btn" onclick="x_admin_show('添加用户','<?php echo url('admin/create'); ?>')"><i class="layui-icon"></i>添加</button>

        </xblock>

        <input class="layui-input" type="hidden" name="__token__" value="<?php echo $token; ?>">
        <table class="layui-table">
            <thead>
            <tr>
                <th>
                    <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
                </th>
                <th>用户名称</th>
                <th>所属角色</th>
                <th>姓名</th>
                <th>联系方式</th>
                <th>登录次数</th>
                <th>创建时间</th>
                <th>操作</th>
            </tr>
            </thead>
            <tbody>
            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td>
                        <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo $vo['id']; ?>'><i class="layui-icon">&#xe605;</i></div>
                    </td>
                    <td>
                        <?php echo $vo['username']; ?>
                    </td>
                    <td><?php echo $vo['group_id']['name']; ?></td>
                    <td><?php echo $vo['name']; ?></td>
                    <td>
                        邮箱:<?php echo $vo['email']; ?> <br>
                        手机:<?php echo $vo['mobile']; ?> <br>
                    </td>
                    <td><?php echo $vo['login_num']; ?></td>
                    <td><?php echo $vo['add_time']; ?></td>
                    <td class="td-manage" >
                        <a title="编辑"  onclick="x_admin_show('编辑角色','<?php echo url('admin/edit',['id'=>$vo['id']]); ?>')" href="javascript:;">
                            编辑
                        </a>
                        <a title="删除" onclick="delAll('<?php echo $vo['id']; ?>')" href="javascript:;">
                            删除
                        </a>
                    </td>
                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>
            </tbody>
        </table>

        <div class="page">
            <?php echo $list->render(); ?>
        </div>
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
            layer.confirm('确认删除这条数据？',function(index){
                //捉到所有被选中的，发异步进行删除
                //捉到所有被选中的，发异步进行删除
                var url="<?php echo url('admin/delete'); ?>";
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