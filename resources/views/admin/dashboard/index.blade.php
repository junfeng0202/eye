@extends('layout.index')

@section('title','首页')
@section('tab-title')
    首页
@endsection
@section('css')
    <link rel="stylesheet" href="/css/main.css" media="all" />
@endsection
@section('content')
    <div class="panel_box row">
        <div class="panel col">
            <a href="javascript:;" data-url="page/message/message.html">
                <div class="panel_icon">
                    <i class="layui-icon" data-icon="&#xe63a;">&#xe63a;</i>
                </div>
                <div class="panel_word newMessage">
                    <span></span>
                    <cite>新消息</cite>
                </div>
            </a>
        </div>

        <div class="panel col">
            <a href="javascript:;" data-url="page/user/allUsers.html">
                <div class="panel_icon" style="background-color:#009688;">
                    <i class="layui-icon" data-icon="&#xe613;">&#xe613;</i>
                </div>
                <div class="panel_word userAll">
                    <span></span>
                    <cite>用户总数</cite>
                </div>
            </a>
        </div>
        <div class="panel col">
            <a href="javascript:;" data-url="page/img/images.html">
                <div class="panel_icon" style="background-color:#5FB878;">
                    <i class="layui-icon" data-icon="&#xe64a;">&#xe64a;</i>
                </div>
                <div class="panel_word imgAll">
                    <span></span>
                    <cite>图片总数</cite>
                </div>
            </a>
        </div>
        <div class="panel col">
            <a href="javascript:;" data-url="page/news/newsList.html">
                <div class="panel_icon" style="background-color:#F7B824;">
                    <i class="iconfont icon-wenben" data-icon="icon-wenben"></i>
                </div>
                <div class="panel_word waitNews">
                    <span></span>
                    <cite>待审核文章</cite>
                </div>
            </a>
        </div>
        <div class="panel col max_panel">
            <a href="javascript:;" data-url="page/news/newsList.html">
                <div class="panel_icon" style="background-color:#2F4056;">
                    <i class="iconfont icon-text" data-icon="icon-text"></i>
                </div>
                <div class="panel_word allNews">
                    <span></span>
                    <em>文章总数</em>
                    <cite>文章列表</cite>
                </div>
            </a>
        </div>
        <div class="panel col">
            <a href="javascript:;" data-url="page/user/allUsers.html">
                <div class="panel_icon" style="background-color:#FF5722;">
                    <i class="iconfont icon-dongtaifensishu" data-icon="icon-dongtaifensishu"></i>
                </div>
                <div class="panel_word userAll">
                    <span></span>
                    <cite>新增人数</cite>
                </div>
            </a>
        </div>
    </div>

@endsection

@section('js')
@endsection
