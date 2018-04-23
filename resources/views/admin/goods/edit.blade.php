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
    <a href="/goods">商品管理</a> >> @if($info->id) 编辑 @else 添加 @endif
@endsection
@section('content')


<form class="layui-form" style="width:80%;">
    {{ csrf_field() }}
    <div class="layui-form-item">
        <label class="layui-form-label">品牌*</label>
        <div class="layui-input-block">
            <input type="text" class="layui-input" lay-verify="required" name="brand" placeholder="请输入品牌名称" value="{{ $info->brand }}">
        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">类型*</label>
        <div class="layui-input-block">
            @foreach(\App\Model\Goods::getType() as $k=>$v)
            <input type="radio" name="type" value="{{ $k }}" title="{{ $v }}" @if($info->type == $k || \App\Model\Goods::INIT == $k) checked @endif>
            @endforeach
        </div>
    </div>

    {{--<div class="layui-form-item">
        <label class="layui-form-label">参考价*</label>
        <div class="layui-input-block">
            <input type="number" class="layui-input" lay-verify="required|number" name="price" placeholder="请输入参考价" value="{{ $info->price }}">
        </div>
    </div>--}}
    {{--<div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">库存</label>
            <div class="layui-input-block">
                <input type="text" class="layui-input" value="{{ $info->stock }}" disabled>
            </div>
        </div>

    </div>--}}
    {{--<div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">积分</label>
            <div class="layui-input-block">
                <input type="number" class="layui-input" name="integral" value="{{ $info->integral }}">
            </div>
        </div>
    </div>--}}
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


