@extends('layout.index')

@section('title','商品管理')
@section('tab-title')
    商品管理
@endsection
@section('css')
@endsection

@section('content')
<blockquote class="layui-elem-quote news_search">
    <form action="">
    <div class="layui-inline">
        <div class="layui-input-inline">
            <input type="text" value="{{ old('kw') }}" placeholder="请输入品牌名" class="layui-input search_input" name="kw">
        </div>
        <button class="layui-btn search_btn">查询</button>
    </div>

    <div class="layui-inline">
        <a class="layui-btn layui-btn-normal usersAdd_btn" href="/{{ $active }}/edit">添加商品</a>
    </div>
    </form>
    {{--<div class="layui-inline">
        <a class="layui-btn layui-btn-danger batchDel">批量删除</a>
    </div>--}}
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
            {{--<th>参考价</th>--}}
            <th>库存</th>
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
                {{--<td>{{ $list->price }}</td>--}}
                <td>{{ $list->stock }}</td>
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