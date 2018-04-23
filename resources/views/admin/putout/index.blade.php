@extends('layout.index')

@section('title','出库管理')
@section('tab-title')
    出库管理
@endsection
@section('css')
    <style>
        .layui-layout-left{ left:0;}
    </style>
@endsection

@section('content')
    <div class="layui-elem-quote">
        <div class="layui-inline">
            <span class="layui-btn layui-btn-danger">出库总售价 : {{ $total_sale }}</span>
            <span class="layui-btn layui-btn-warm">积分使用总数 : {{ $total_integral }}</span>
            <span class="layui-btn layui-btn">总成本 : {{ $total_cost }}</span>
            <span class="layui-btn layui-btn-normal">总利润 : {{ $total_profit }}</span>
        </div>
    </div>
<blockquote class="layui-elem-quote news_search">
    <form action="" class="layui-form" style="position: relative;height:100%;">
        <div class="layui-inline">
            <div class="layui-input-inline">
                <input type="text" value="{{ old('date') }}" placeholder="时间段选择" class="layui-input" name="date" id="datepicker">
            </div>
            <div class="layui-input-inline">
                <input type="text" value="{{ old('kw') }}" placeholder="请输入品牌名或手机号" class="layui-input search_input" name="kw">
            </div>
            <button class="layui-btn search_btn">查询</button>
            <div class="layui-inline">
                <a class="layui-btn layui-btn-normal usersAdd_btn" href="/{{ $active }}/edit">添加</a>
            </div>
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
            <th>单号</th>
            <th>客户信息</th>
            <th>视力</th>
            <th>瞳距</th>
            <th>商品</th>
            <th>售价(元)</th>
            <th>使用积分</th>
            <th>成本</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody class="users_content">
        @foreach($lists as $list)
            <tr>
                <td><input type="checkbox" name="" lay-skin="primary" lay-filter="choose"></td>
                <td>{{ $list->id }}</td>
                <td>{{ $list->number }}</td>
                <td>姓名：{{ $list->name }}<br/>手机号：{{ $list->phone }}</td>
                <td>左眼：{{ $list->left_eye }}<br>右眼：{{ $list->right_eye }}</td>
                <td>{{ $list->pd }}</td>
                <td>镜框：@if($list->frame_id){{ $list->frame_brand }} {{ $list->frame_type }} （{{ $list->frame_num }}副）@endif<br>右镜片：@if($list->left_glass_id){{ $list->right_glass_brand }} {{ $list->right_glass_type }} （{{$list->right_glass_num}}片）@endif<br>左镜片：@if($list->left_glass_id){{ $list->left_glass_brand }} {{ $list->left_glass_type }} （{{$list->left_glass_num}}片）@endif</td>
                <td>{{ $list->price}}</td>
                <td>{{ $list->integral_use }}</td>
                <td>{{ $list->cost }}</td>
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
        layui.use(['laydate','layer'],function () {
            var laydate = layui.laydate
                ,layer = layui.layer;

            var option = {
                elem: '#datepicker' //指定元素
                ,range: '~'
            }
            //执行一个laydate实例
            laydate.render(option);
        })
    </script>
@endsection