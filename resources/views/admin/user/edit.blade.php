@extends('layout.index')

@section('title','用户管理')

@section('css')
    <style type="text/css">
        .layui-form-item .layui-inline{ width:33.333%; float:left; margin-right:0; }
        @media(max-width:1240px){
            .layui-form-item .layui-inline{ width:100%; float:none; }
        }

    </style>
@endsection
@section('tab-title')
    <a href="/user">用户管理</a> >> @if($user->id) 编辑 @else 添加 @endif
@endsection
@section('content')


<form class="layui-form" style="width:80%;">
    {{ csrf_field() }}
    <div class="layui-form-item">
        <label class="layui-form-label">客户姓名*</label>
        <div class="layui-input-block">
            <input type="text" class="layui-input userName" lay-verify="required" name="name" placeholder="请输入客户姓名" value="{{ $user->name }}">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">手机号*</label>
        <div class="layui-input-block">
            <input type="number" class="layui-input userEmail" lay-verify="required|phone|number" name="phone" placeholder="请输入手机号" value="{{ $user->phone }}">
        </div>
    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">性别*</label>
            <div class="layui-input-block userSex">
                @foreach($user->getGender() as $v)
                    <input type="radio" name="gender" value="{{ $v['value'] }}" title="{{ $v['name'] }}" @if($user->gender==$v['value'] || $v['default']) checked @endif>
                @endforeach
            </div>
        </div>

    </div>
    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">积分</label>
            <div class="layui-input-block">
                <input type="number" class="layui-input" name="integral" value="{{ $user->integral or 0 }}">
            </div>
        </div>
    </div>
    {{--<div class="layui-form-item">
        <label class="layui-form-label">备注</label>
        <div class="layui-input-block">
            <textarea placeholder="请输入站点描述" class="layui-textarea linksDesc"></textarea>
        </div>
    </div>--}}
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button class="layui-btn" lay-submit="" lay-filter="addUser" type="button">立即提交</button>
            <button type="button" class="layui-btn layui-btn-primary back">返回</button>
        </div>
    </div>
</form>

@endsection

@section('js')
    <script type="text/javascript" src="/js/addUser.js"></script>
@endsection


