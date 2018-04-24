<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>视野联行-@yield('title')</title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta http-equiv="Access-Control-Allow-Origin" content="*">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" href="/favicon.ico">
    <link rel="stylesheet" href="/layui/css/layui.css" media="all"/>
    <link rel="stylesheet" href="/css/font_eolqem241z66flxr.css" media="all"/>
    <link rel="stylesheet" href="/css/main.css" media="all"/>
    @yield('css')
</head>
<body class="main_body">
<div class="layui-layout layui-layout-admin">
    <!-- 顶部 -->
    <div class="layui-header header">
        <div class="layui-main">
            <a href="#" class="logo">视野联行数据管理</a>

        </div>
    </div>
    <!-- 左侧导航 -->
    <div class="layui-side layui-bg-black">
        <div class="user-photo">
            <p>菜单栏</p>
        </div>
        <div class="navBar layui-side-scroll">
            <ul class="layui-nav layui-nav-tree">
                {{--<li class="layui-nav-item @if($active=='index') layui-this @endif">
                    <a href="/">
                        <i class="iconfont icon-computer" data-icon="icon-computer"></i>
                        <cite>首页</cite>
                    </a>
                </li>--}}
                <li class="layui-nav-item @if($active=='goods') layui-this @endif">
                    <a href="/goods">
                        <i class="layui-icon layui-icon-chuangkou"></i>
                        <cite>商品管理</cite>
                    </a>
                </li>
                <li class="layui-nav-item @if($active=='user') layui-this @endif">
                    <a href="/user">
                        <i class="iconfont icon-zhanghu"></i>
                        <cite>用户列表</cite>
                    </a>
                </li>

                <li class="layui-nav-item @if($active=='putin') layui-this @endif">
                    <a href="/putin">
                        <i class="layui-icon"></i><cite>入库管理</cite>
                    </a>
                </li>
                <li class="layui-nav-item @if($active=='putout') layui-this @endif">
                    <a href="/putout">
                        <i class="layui-icon"></i>
                        <cite>出库管理</cite>
                    </a>
                </li>
                <li class="layui-nav-item @if($active=='static') layui-nav-itemed @endif">
                    <a href="javascript:;">
                        <i class="layui-icon" data-icon=""></i>
                        <cite>数据统计</cite>
                        <span class="layui-nav-more"></span>
                    </a>
                    <dl class="layui-nav-child">
                        <dd @if(isset($active_child) && $active_child=='staticIndex') class="layui-this" @endif>
                            <a href="/static">
                                <i class="layui-icon "></i>
                                <cite>销量统计</cite>
                            </a>
                        </dd>
                        <dd @if(isset($active_child) && $active_child=='profit') class="layui-this" @endif>
                            <a href="/static/profit">
                                <i class="layui-icon"></i>
                                <cite>金额统计</cite>
                            </a>
                        </dd>
                    </dl>
                </li>
                <span class="layui-nav-bar" style="top: 202.5px; height: 0px; opacity: 0;"></span>
            </ul>
        </div>
    </div>
    <!-- 右侧内容 -->
    <div class="layui-body layui-form">
        <div class="layui-tab marg0" lay-filter="bodyTab">
            <ul class="layui-tab-title top_tab">
                <li class="layui-this" lay-id="">{{--<i class="iconfont icon-computer"></i>--}} <cite>@yield('tab-title')</cite></li>
            </ul>
            <div class="layui-tab-content clildFrame">
                <div class="layui-tab-item layui-show">
                    @section('content')
                    @show
                </div>
            </div>
        </div>
    </div>
    <!-- 底部 -->
    {{--<div class="layui-footer footer">
        <p>copyright @2017 请叫我马哥 更多模板：<a href="http://www.mycodes.net/" target="_blank">源码之家</a>　　<a onclick="donation()" class="layui-btn layui-btn-danger l·ayui-btn-small">捐赠作者</a></p>
    </div>--}}
</div>

<!-- 移动导航 -->
<div class="site-tree-mobile layui-hide"><i class="layui-icon">&#xe602;</i></div>
<div class="site-mobile-shade"></div>

<script type="text/javascript" src="/layui/layui.js"></script>
<script type="text/javascript" src="/js/index.js"></script>

@yield('js')
</body>
</html>