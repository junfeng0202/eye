@extends('layout.index')

@section('title','入库管理')
@section('tab-title')
    入库管理
@endsection
@section('css')
@endsection

@section('content')
<blockquote class="layui-elem-quote news_search">
    <form action="" class="layui-form" style="position: relative;">
    <div class="layui-inline">
        <div class="layui-input-inline">
            <select class="layui-input search_input" name="type">
                <option value="">请选择商品类型...</option>
                @foreach(\App\Model\Goods::getType() as $k=>$v)
                <option value="{{ $k }}" @if(old('type')==$k) selected @endif>{{ $v }}</option>
                @endforeach
            </select>
        </div>
        <div class="layui-input-inline">
            <input type="text" value="{{ old('kw') }}" placeholder="请输入品牌名" class="layui-input search_input" name="kw">
        </div>
        <button class="layui-btn search_btn">查询</button>
    </div>

    <div class="layui-inline">
        <a class="layui-btn layui-btn-normal usersAdd_btn" href="/{{ $active }}/edit">添加</a>
    </div>

    <div class="layui-inline layui-layout-right">
        <a class="layui-btn layui-btn-danger">入库总数量 : {{ $total }}</a>
    </div>
    </form>
    {{--<div class="layui-inline">
        <div class="layui-form-mid layui-word-aux">　本页面刷新后除新添加的文章外所有操作无效，关闭页面所有数据重置</div>
    </div>--}}
</blockquote>
<div class="layui-form news_list">
    <table class="layui-table">
        {{--<colgroup>
            <col width="50">
            <col>
            <col width="18%">
            <col width="8%">
            <col width="12%">
            <col width="12%">
            <col width="18%">
            <col width="15%">
        </colgroup>--}}
        <thead>
        <tr>
            <th><input type="checkbox" name="" lay-skin="primary" lay-filter="allChoose" id="allChoose"></th>
            <th>ID</th>
            <th>品牌</th>
            <th>类型</th>
            <th>数量</th>
            <th>入库时间</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody class="users_content">
        @foreach($lists as $list)
            <tr>
                <td><input type="checkbox" name="" lay-skin="primary" lay-filter="choose"></td>
                <td>{{ $list->id }}</td>
                <td>{{ $list->brand }}</td>
                <td>@if($list->type == \App\Model\Goods::FRAME) <span class="layui-btn layui-btn-sm layui-btn-danger">{{ \App\Model\Goods::getType($list->type) }}</span> @else <span class="layui-btn layui-btn-sm layui-btn-warm">{{ \App\Model\Goods::getType($list->type) }}</span> @endif</td>
                <td>{{ $list->num }}</td>
                <td>{{ $list->created_at }}</td>
                <td>
                    <a class="layui-btn layui-btn-sm" href="/{{ $active }}/edit?id={{ $list->id }}">修改</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div id="page">
    {{ $lists->links() }}
</div>
@endsection

@section('js')
    <script>

    </script>
@endsection