<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:76:"F:\wamp\www\yjnh\public/../app/admin\view\..\..\common\view\table\index.html";i:1512444047;}*/ ?>
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
        <?php if($search): ?>
            <form method="get" action="<?php echo url($route); ?>" class="layui-form layui-col-md12 x-so">
                <?php if(is_array($search) || $search instanceof \think\Collection || $search instanceof \think\Paginator): $i = 0; $__LIST__ = $search;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                    <?php echo $v; endforeach; endif; else: echo "" ;endif; ?>
                <button class="layui-btn"  lay-submit="" lay-filter="sreach"><i class="layui-icon">&#xe615;</i></button>
            </form>
        <?php endif; ?>
    </div>
    <xblock>
        <?php if(isset($operate['deleteAction'])): ?>
            <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>
        <?php endif; if($createAction): ?>
            <button class="layui-btn" onclick="x_admin_show('新增数据','<?php echo url($create_url); ?>')"><i class="layui-icon"></i>新增</button>
        <?php endif; if(is_array($tool) || $tool instanceof \think\Collection || $tool instanceof \think\Paginator): $i = 0; $__LIST__ = $tool;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
            <?php echo $v; endforeach; endif; else: echo "" ;endif; ?>
        <span class="x-right" style="line-height:40px">共有数据： <?php echo $list->total(); ?> 条</span>
        <div style="clear: both"></div>
    </xblock>

    <input class="layui-input" type="hidden" name="__token__" value="<?php echo $token; ?>">
    <table class="layui-table">
        <thead>
        <tr>
            <th>
                <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
            </th>
            <?php if(is_array($thead) || $thead instanceof \think\Collection || $thead instanceof \think\Paginator): $i = 0; $__LIST__ = $thead;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                <th><?php echo $v['name']; ?></th>
            <?php endforeach; endif; else: echo "" ;endif; if($operate): ?>
                <th>操作</th>
            <?php endif; ?>
        </tr>
        </thead>
        <tbody>

            <?php if(is_array($list) || $list instanceof \think\Collection || $list instanceof \think\Paginator): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$value): $mod = ($i % 2 );++$i;?>
                <tr>
                    <td>
                        <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id='<?php echo $value['id']; ?>'><i class="layui-icon">&#xe605;</i></div>
                    </td>


                    <?php if(is_array($thead) || $thead instanceof \think\Collection || $thead instanceof \think\Paginator): $i = 0; $__LIST__ = $thead;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>

                        <td>

                            <?php if($v['btn']): ?>
                                <a href="javascript:;" class="layui-btn layui-btn-xs <?php echo $v['btn'][$value[$v['id']]]; ?>">
                                    <?php echo $value[$v['id']]; ?>
                                </a>
                            <?php else: ?>
                                <?php echo $value[$v['id']]; endif; ?>

                        </td>
                    <?php endforeach; endif; else: echo "" ;endif; if($operate): ?>
                        <td>
                            <?php if(isset($operate['editAction'])): ?>
                                <a title="编辑"  onclick="x_admin_show('编辑内容','<?php echo url($create_url,['id'=>$value['id']]); ?>')" href="javascript:;">
                                    编辑
                                </a>
                            <?php endif; if(isset($operate['deleteAction'])): ?>
                                <a title="删除" onclick="delAll('<?php echo $value['id']; ?>')" href="javascript:;">
                                    删除
                                </a>
                            <?php endif; ?>

                        </td>
                    <?php endif; ?>

                </tr>
            <?php endforeach; endif; else: echo "" ;endif; ?>

        </tbody>
    </table>

<div class="page">
    <?php echo $list->render(); ?>
</div>
</div>
<div id="pop" class="hide" style="display: none">
    <img src=""/>
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
            var url="<?php echo $dele_url; ?>";
            AjaxP(url,'POST',{"ids":data,"__token__":token},function(res){
                if(res.code==1){
                    deleCall();
                }

            });

        });
    }

    $('img').bind('click',function(){
        var src=$(this).attr('src');
        $('#pop').find('img').attr('src',src);
        layer.open({
            type: 1,
            title: false,
            closeBtn: 0,
            area: '600px',
            skin: 'layui-layer-nobg', //没有背景色
            shadeClose: true,
            content: $('#pop')
        });
    })

</script>
</body>
</html>