@extends('layout.index')

@section('title','用户管理')
@section('tab-title')
    用户管理
@endsection
@section('css')
@endsection

@section('content')
<blockquote class="layui-elem-quote news_search">
    <form action="">
    <div class="layui-inline">
        <div class="layui-input-inline">
            <input type="text" value="{{ old('phone') }}" placeholder="请输入手机号" class="layui-input search_input" name="phone">
        </div>
        <button class="layui-btn search_btn">查询</button>
    </div>

    <div class="layui-inline">
        <a class="layui-btn layui-btn-normal usersAdd_btn" href="/user/edit">添加用户</a>
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
            <th>姓名</th>
            <th>性别</th>
            <th>手机号</th>
            <th>积分</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody class="users_content">
        @foreach($users as $v)
            <tr>
                <td><input type="checkbox" name="" lay-skin="primary" lay-filter="choose"></td>
                <td>{{ $v->id }}</td>
                <td>{{ $v->name }}</td>
                <td>{{ $v->getGender($v->gender) }}</td>
                <td>{{ $v->phone }}</td>
                <td>{{ $v->integral }}</td>
                <td>
                    <a class="layui-btn layui-btn-sm" href="/user/edit?id={{ $v->id }}">修改</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
<div id="page">
    {{ $users->links() }}
</div>
@endsection

@section('js')
    <script>

    </script>
@endsection