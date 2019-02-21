<?php
return [
// 视图输出字符串内容替换
    'view_replace_str'       => [
        '__STYLE__'=>__ROOT__.'/temp/index/msg',
        '__YEAR__'=>__ROOT__.'/temp/index/year',
        '__HOME__'=>__ROOT__.'/temp/index/index2',
        '__PC__'=>__ROOT__.'/temp/index/pc',
    ],
    'app_debug' => true,
    'template'               => [
        // 模板引擎类型 支持 php think 支持扩展
        'type'         => 'Think',
        // 模板路径
        'view_path'    => '',
        // 模板后缀
        'view_suffix'  => 'html',
        // 模板文件名分隔符
        'view_depr'    => DS,
        // 模板引擎普通标签开始标记
        'tpl_begin'    => '<{',
        // 模板引擎普通标签结束标记
        'tpl_end'      => '}>',
        // 标签库标签开始标记
        'taglib_begin' => '<',
        // 标签库标签结束标记
        'taglib_end'   => '>',
        'view_base'=>__DIR__.'/../../public/temp/', //入口文件在public下
    ],
];
