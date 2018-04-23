@extends('layout.index')

@section('title','统计')
@section('tab-title')
    数据统计
@endsection
@section('css')
    <style>
        .layui-layout-left{ left:0;}
        .chart{ float: left;width: 50%;}
    </style>
@endsection

@section('content')
<blockquote class="layui-elem-quote news_search">
    <form action="" class="layui-form" style="position: relative;height:100%;">
        <div class="layui-block">
            <input type="text" value="{{ old('date') }}" placeholder="时间段选择" class="layui-input search_input" name="date" id="datepicker" style="width: 50%;display: inline-block;">

            <button class="layui-btn search_btn">查询</button>
        </div>

    </form>
    {{--<div class="layui-inline">
        <div class="layui-form-mid layui-word-aux">　本页面刷新后除新添加的文章外所有操作无效，关闭页面所有数据重置</div>
    </div>--}}

</blockquote>
<div class="layui-form news_list">
    <div class="chart" id="chart" style="height: 400px"></div>
    <div class="chart" id="chart2" style="height: 400px"></div>
</div>

@endsection

@section('js')
    <script src="/js/jquery-2.2.min.js"></script>
    <script src="/js/highcharts.js"></script>
    <script src="/js/highcharts-3d.js"></script>
    <script>
        layui.extend().use(['laydate','layer','jquery'],function () {
            var laydate = layui.laydate
                ,layer = layui.layer
                ,$ = layui.jquery;

            var option = {
                elem: '#datepicker' //指定元素
                ,range: '~'
            }
            //执行一个laydate实例
            laydate.render(option);
        });
        $(function(){
            var data_str = '{!! $data !!}'
                ,data_frame_str = '{!! $data_frame !!}';

            var data = JSON.parse(data_str)
                ,data_frame = JSON.parse(data_frame_str);
            // console.log(data);
            var option = {
                chart: {
                    type: 'pie',
                    options3d: {
                        enabled: true,
                        alpha: 45,
                        beta: 0
                    }
                },
                credits:{
                    enabled: false // 禁用版权信息
                },
                title: {
                    text: '出货量统计'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        depth: 35,
                        dataLabels: {
                            enabled: true,
                            format: '{point.name} 销量：{point.y}'
                        }
                    }
                },
                series: [{
                    type: 'pie',
                    name: '销量占比',
                    data: ''
                }]
            }
            option.title.text = '镜片销售量统计';
            option.series[0].data = data;
            $('#chart').highcharts(option);

            option.title.text = '镜框销售量统计';
            option.series[0].data = data_frame;
            $('#chart2').highcharts(option);
        })
    </script>
@endsection