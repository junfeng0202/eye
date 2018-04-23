@extends('layout.index')

@section('title','入库管理')

@section('css')
    {{--<style type="text/css">
        .layui-form-item .layui-inline{ width:33.333%; float:left; margin-right:0; }
        @media(max-width:1240px){
            .layui-form-item .layui-inline{ width:100%; float:none; }
        }

    </style>--}}
@endsection
@section('tab-title')
    <a href="/putin">入库管理</a> >> @if($info->id) 编辑 @else 添加 @endif
@endsection
@section('content')


<form class="layui-form" style="width:80%;">
    {{ csrf_field() }}
    <div class="layui-form-item">
        <label class="layui-form-label">品牌*</label>
        <div class="layui-input-block">
            <select name="goods_id" lay-verify="required" lay-search>
                <option value="">请选择或搜索品牌名称</option>
                <optgroup label="镜框">
                @foreach($goods_frame as $v)
                    <option value="{{ $v->id }}" @if($info->goods_id == $v->id) selected @endif>{{ $v->brand }}</option>
                @endforeach
                </optgroup>
                <optgroup label="镜片">
                @foreach($goods_glass as $v)
                    <option value="{{ $v->id }}" @if($info->goods_id == $v->id) selected @endif>{{ $v->brand }}</option>
                @endforeach
                </optgroup>
            </select>

        </div>
    </div>
    <div class="layui-form-item">
        <label class="layui-form-label">入库数量*</label>
        <div class="layui-input-block">
            <input type="number" class="layui-input" lay-verify="required|number" name="num" placeholder="请输入入库数量" value="{{ $info->num }}">
        </div>
    </div>
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


