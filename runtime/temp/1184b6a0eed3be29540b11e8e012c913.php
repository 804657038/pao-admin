<?php if (!defined('THINK_PATH')) exit(); /*a:2:{s:75:"/Users/Web/archie/yajienh/public/../application/admin/view/index/index.html";i:1512703227;s:77:"/Users/Web/archie/yajienh/public/../application/admin/view/common/common.html";i:1512703227;}*/ ?>
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
    <!-- 顶部开始 -->
    <div class="container">
        <div class="logo"><a href="<?php echo url('index/index'); ?>">雅洁年会后台管理系统</a></div>
        <div class="left_open">
            <i title="展开左侧栏" class="iconfont">&#xe65f;</i>
        </div>

        <ul class="layui-nav right" lay-filter="">
            <li class="layui-nav-item">
                <a href="javascript:;"><?php echo session('admin_user')['username']; ?></a>
                <?php 
                   $userid=session('admin_user')['user_id'];
                 ?>
                <dl class="layui-nav-child"> <!-- 二级菜单 -->
                    <dd><a onclick="x_admin_show('个人信息','<?php echo url('admin/edit',['id'=>$userid]); ?>')">个人信息</a></dd>
                    <dd><a href="<?php echo url('index/loginout'); ?>">退出</a></dd>
                </dl>
            </li>
            <li class="layui-nav-item to-index"><a href="javascript:;" onclick="clear_all(22)">清除缓存</a></li>
        </ul>

    </div>
    <!-- 顶部结束 -->
    <!-- 中部开始 -->
    <!-- 左侧菜单开始 -->
    <div class="left-nav">
        <div id="side-nav">
            <ul id="nav">
                <?php if(is_array($menu_list) || $menu_list instanceof \think\Collection || $menu_list instanceof \think\Paginator): $i = 0; $__LIST__ = $menu_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>
                    <li>
                        <?php if($vo['child']): ?>
                            <a href="javascript:;" >
                        <?php else: ?>
                            <a _href="<?php echo url($vo['route']); ?>" class="sub-menu-a">
                        <?php endif; ?>
                            <i class="iconfont"><?php echo $vo['icon']; ?></i>
                            <cite><?php echo $vo['name']; ?></cite>
                        <?php if($vo['child']): ?>
                            <i class="iconfont nav_right">&#xe603;</i>
                        <?php endif; ?>
                        </a>
                        <ul class="sub-menu">
                            <?php if(is_array($vo['child']) || $vo['child'] instanceof \think\Collection || $vo['child'] instanceof \think\Paginator): $i = 0; $__LIST__ = $vo['child'];if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$v): $mod = ($i % 2 );++$i;?>
                                <li>
                                    <a _href="<?php echo url($v['route']); ?>">
                                        <i class="iconfont">&#xe602;</i>
                                        <cite><?php echo $v['name']; ?></cite>
                                    </a>
                                </li >
                            <?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </li>
                <?php endforeach; endif; else: echo "" ;endif; ?>
            </ul>
        </div>
    </div>
    <!-- <div class="x-slide_left"></div> -->
    <!-- 左侧菜单结束 -->
    <!-- 右侧主体开始 -->
    <div class="page-content">
        <div class="layui-tab tab" lay-filter="xbs_tab" lay-allowclose="false">
            <ul class="layui-tab-title">
                <li>我的桌面</li>
            </ul>
            <div class="layui-tab-content">
                <div class="layui-tab-item layui-show">
                    <iframe src="<?php echo url('index/welcome'); ?>" frameborder="0" scrolling="yes" class="x-iframe"></iframe>
                </div>
            </div>
        </div>
    </div>
    <div class="page-content-bg"></div>
    <!-- 右侧主体结束 -->
    <!-- 中部结束 -->
    <!-- 底部开始 -->
    <div class="footer">
        <div class="copyright">Copyright ©2017 恒帝信息科技有限公司</div>
    </div>
    <!-- 底部结束 -->
    <script type="text/javascript">
        function clear_all(){

            var url="<?php echo url('index/clear'); ?>";
            AjaxP(url,'GET',false,function(res){
                layer.msg(res.msg,function(){
                    window.location.reload();
                });
            });
        }

    </script>
    </body>

</html>