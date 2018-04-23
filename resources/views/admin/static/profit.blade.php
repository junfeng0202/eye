@extends('layout.index')

@section('title','统计')
@section('tab-title')
    数据统计
@endsection
@section('css')
    <style>
        /*.chart{ float: left;width: 50%;}*/
        .layui-tab-ul{ margin: 20px auto; width: 40%; height:30px;
            border:1px solid #eeeeee;background-color: #eee;}
        .layui-tab-ul .layui-tab-li{ float: left;height:30px;width: 50%;text-align: center;line-height: 30px;}
    </style>
@endsection

@section('content')

<div class="layui-form news_list">
    <div>
        <div class="layui-tab">
            <ul class="layui-tab-ul">
                <li class="layui-tab-li layui-bg-green" data-type="month">月</li>
                <li class="layui-tab-li" data-type="year">年</li>
            </ul>

        </div>
        <form action="" class="layui-form" style="position: relative; width: 40%;margin: auto;">
            <div class="layui-block">
                <input type="hidden" name="type" value="Y-m">
                <input type="text" value="{{ old('date') }}" placeholder="月份选择" class="layui-input search_input" name="date" id="datepicker" style="width: 50%;display: inline-block;">

                <button class="layui-btn search_btn" type="button">查询</button>
            </div>

        </form>
        <form action="" class="layui-form" style="position: relative; width: 40%;margin: auto;display: none;">
            <div class="layui-block">
                <input type="hidden" name="type" value="Y">
                <input type="text" value="" placeholder="年份选择" class="layui-input search_input" name="date" id="Ydatepicker" style="width: 50%;display: inline-block;">

                <button class="layui-btn search_btn" type="button">查询</button>
            </div>

        </form>
    <div class="chart" id="chart" style="min-height: 800px;margin-top: 20px;"></div>
</div>

@endsection

@section('js')
    <script src="/js/jquery-2.2.min.js"></script>
    <script src="/js/highcharts.js"></script>
    <script src="/js/highcharts-3d.js"></script>
    <script>
        layui.use(['form','laydate','layer','jquery'],function () {
            var laydate = layui.laydate
                ,form = layui.form
                ,layer = layui.layer
                ,$ = layui.jquery;

            var option = {
                elem: '#datepicker' //指定元素
                ,type:'month'
                ,max:0
                ,value:new Date()
            },optionY = {
                elem: '#Ydatepicker' //指定元素
                ,type:'year'
                ,max:0
                ,value:new Date()
            };
            //执行一个laydate实例
            laydate.render(option);
            laydate.render(optionY);

            $('.layui-tab-ul li').on('click',function () {
                $('.layui-tab-ul li').removeClass('layui-bg-green')
                $(this).addClass('layui-bg-green');
                var ind = $(this).index();
                $('form.layui-form').hide().eq(ind).show();

            })
        });
        $(function () {
            var options = {
                chart: {
                    type: 'column',
                    inverted:true,

                    options3d: {
                        enabled: true,
                        alpha: 5,
                        beta: 5,
                        depth: 70,
                        //viewDistance: 100,      // 视图距离，它对于计算角度影响在柱图和散列图非常重要。此值不能用于3D的饼图
                        frame: {                // Frame框架，3D图包含柱的面板，我们以X ,Y，Z的坐标系来理解，X轴与 Z轴所形成
                            // 的面为bottom，Y轴与Z轴所形成的面为side，X轴与Y轴所形成的面为back，bottom、
                            // side、back的属性一样，其中size为感官理解的厚度，color为面板颜色
                            bottom: {
                                size: 10,
                                color: 'transparent'
                            },
                            side: {
                                size: 1,
                                color: 'transparent'
                            },
                            back: {
                                size: 1,
                                color: 'transparent'
                            }
                        }
                    },
                },
                title: {
                    text: '销售额统计'
                    ,style:{
                        color:"#009688",
                    }
                },

                plotOptions: {
                    column: {
                        depth: 25,
                    }
                },
                xAxis: {
                    tickmarkPlacement:'on',
                    categories: []
                },
                yAxis: {
                    pointStart:0,
                    min:0,
                    title: {
                        text: '金额(￥)'
                    }
                },
                series: [{
                        name: '销售额',
                        color:'#ED551A',
                        data: []
                    },
                    {
                        name: '利润',
                        color:'#50B432',
                        data: []
                    }]
            };
            var Profit = function () {

                this.getData = function() {
                    var _this = this;
                    //console.log(_this);
                    $('.search_btn').on('click', function() {
                        //console.log($(ele));
                        var data = $(this).parents('form').serialize();
                        //console.log(data);
                        _this.ajaxM(data);
                    })
                }
                this.ajaxM = function (data) {
                    $.ajax({
                        type: 'get',
                        data: data,
                        success: function (res) {
                            console.log(res);
                            console.log(options);
                            options.chart.inverted = res.inverted;
                            options.xAxis.categories = res.date_x;
                            options.series[0].data = res.price;
                            options.series[1].data = res.profit;
                            $('#chart').highcharts(options);
                        }
                    });
                }
                this.init = function () {
                    var data = $('form').eq(0).serialize();
                    this.ajaxM(data);
                    this.getData();
                };
            }

            var profit = new Profit();
            profit.init();
                // $('#chart').highcharts(options);
        });
    </script>
@endsection