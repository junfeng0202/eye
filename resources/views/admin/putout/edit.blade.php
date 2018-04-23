@extends('layout.index')

@section('title','出库管理')

@section('css')
    <link href="http://apps.bdimg.com/libs/bootstrap/3.0.3/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.bootcss.com/bootstrap-select/2.0.0-beta1/css/bootstrap-select.min.css" rel="stylesheet">
    <style type="text/css">
        .layui-form-item .layui-input-block{ margin-left: 120px; }
        .layui-form-label{width:120px;}
        #user-contain .layui-form-select{display: none;}
        .bootstrap-select{ position: absolute ;background: rgba(0,0,0,.3); }
        .bootstrap-select button{ z-index: 11; line-height: 1.3em; border-width: 1px; border-style: solid; background-color: #fff; border-radius: 2px; height:38px;background:#fff;}
        .dropdown-menu>.active>a{ background-color:#009688;}

    </style>
@endsection
@section('tab-title')
    <a href="/putout">出库管理</a> >> @if($info->id) 编辑 @else 添加 @endif
@endsection
@section('content')


<form class="layui-form" style="width:80%;">
    {{ csrf_field() }}
    @if($info->id)
    <div class="layui-form-item">
        <label class="layui-form-label">单号</label>
        <div class="layui-input-block">
            <input type="text" class="layui-input"  value="{{ $info->number }}" disabled>
        </div>
    </div>
    @endif

    <div class="layui-form-item" id="user-contain">
        <label class="layui-form-label">顾客*</label>
        <div class="layui-input-block">
            <select name="user_id" lay-verify="required" class="selectpicker show-tick form-control" data-live-search="true">
                <option value="" >请选择或搜索顾客手机号</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" @if($info->user_id == $user->id) selected @endif>{{ '手机：'.$user->phone.' 姓名：'.$user->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="layui-form-item">

        <div class="layui-inline">
            <label class="layui-form-label">右眼视力*</label>
            <div class="layui-input-inline">
                <input type="text" name="right_eye" lay-verify="required" autocomplete="off" class="layui-input" value="{{ $info->right_eye }}">
            </div>
        </div>

        <div class="layui-inline">
            <label class="layui-form-label">左眼视力*</label>
            <div class="layui-input-inline">
                <input type="text" name="left_eye" lay-verify="required" autocomplete="off" class="layui-input" value="{{ $info->left_eye }}">
            </div>
        </div>

        <div class="layui-inline">
            <label class="layui-form-label">瞳距*</label>
            <div class="layui-input-inline">
                <input type="text" name="pd" lay-verify="required" autocomplete="off" class="layui-input" value="{{ $info->pd }}">
            </div>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">镜框</label>
            <div class="layui-input-inline">
                <select name="frame_id" id="">
                    <option value="0">请选择镜框品牌</option>
                    @foreach($frame as $v)
                        <option value="{{ $v->id }}" @if($info->frame_id == $v->id ) selected @endif>{{ $v->brand }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">规格</label>
            <div class="layui-input-inline">
                <input type="text" name="frame_type" autocomplete="off" class="layui-input" value="{{ $info->frame_type }}">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">数量</label>
            <div class="layui-input-inline">
                <input type="text" name="frame_num" autocomplete="off" class="layui-input" value="{{ $info->frame_num or 1 }}">
            </div>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">右镜片</label>
            <div class="layui-input-inline">
                <select name="right_glass_id" id="">
                    <option value="0">请选择镜片品牌</option>
                    @foreach($glass as $v)
                        <option value="{{ $v->id }}" @if($info->glass_id == $v->id ) selected @endif>{{ $v->brand }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">规格</label>
            <div class="layui-input-inline">
                <input type="text" name="right_glass_type" autocomplete="off" class="layui-input" value="{{ $info->right_glass_type }}">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">数量</label>
            <div class="layui-input-inline">
                <input type="text" name="right_glass_num" autocomplete="off" class="layui-input" value="{{ $info->right_glass_num or 1}}">
            </div>
        </div>
    </div>

    <div class="layui-form-item">
        <div class="layui-inline">
            <label class="layui-form-label">左镜片</label>
            <div class="layui-input-inline">
                <select name="left_glass_id" id="">
                    <option value="0">请选择镜片品牌</option>
                    @foreach($glass as $v)
                        <option value="{{ $v->id }}" @if($info->glass_id == $v->id ) selected @endif>{{ $v->brand }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">规格</label>
            <div class="layui-input-inline">
                <input type="text" name="left_glass_type" autocomplete="off" class="layui-input" value="{{ $info->glass_type }}">
            </div>
        </div>
        <div class="layui-inline">
            <label class="layui-form-label">数量</label>
            <div class="layui-input-inline">
                <input type="text" name="left_glass_num" autocomplete="off" class="layui-input" value="{{ $info->left_glass_num or 1 }}">
            </div>
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">总售价*</label>
        <div class="layui-input-block">
            <input type="number" class="layui-input" lay-verify="required|number" name="price" placeholder="" value="{{ $info->price }}">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">使用积分数*</label>
        <div class="layui-input-block">
            <input type="number" class="layui-input" lay-verify="required|number" name="integral_use" placeholder="" value="{{ $info->integral_use or 0}}">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">总成本*</label>
        <div class="layui-input-block">
            <input type="number" class="layui-input" lay-verify="required|number" name="cost" placeholder="" value="{{ $info->cost }}">
        </div>
    </div>

    <div class="layui-form-item">
        <label class="layui-form-label">支付方式*</label>
        <div class="layui-input-block">
            <select name="pay_type" lay-verify="required" id="pay_type" lay-filter="pay_type">
                <option value="">请选择支付方式</option>
                @foreach(\App\Model\Putout::getPayType() as $k=>$v)
                    <option value="{{ $k }}" @if($info->pay_type == $k) selected @endif>{{ $v }}</option>
                @endforeach
            </select>

        </div>
    </div>

    <div class="layui-form-item" id="code">
        <label class="layui-form-label">券码</label>
        <div class="layui-input-block">
            <input type="text" class="layui-input" name="code" value="{{ $info->code }}">
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
    <script src="https://cdn.bootcss.com/jquery/3.3.0/jquery.min.js"></script>
    <script src="http://apps.bdimg.com/libs/bootstrap/3.0.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.bootcss.com/bootstrap-select/2.0.0-beta1/js/bootstrap-select.min.js"></script>
    <script type="text/javascript" src="/js/addUser.js"></script>

    <script>

        layui.use(['form','jquery'],function () {
            var $ = layui.jquery
                ,form = layui.form;

            function showCode() {
                var pay_type = $('#pay_type').val();

                if(pay_type == {{ \App\Model\Putout::MT }}){
                    $('#code').fadeIn();
                }else{
                    $('#code').fadeOut();
                }
            }
            form.on('select(pay_type)',function () {
                showCode();
            })
            showCode();

            $('#user-contain').on('keyup','input.form-control',function () {
                var _this = $(this)
                    ,val = _this.val();
                console.log(val);
                $.get('/user/getuser',{phone:val},function(res){
                    //console.log(res);
                    html = '<option value="" >请选择或搜索顾客手机号</option>';
                    res.forEach(function (elem) {
                        // console.log(elem);
                        html += '<option value="' + elem.id + '">手机：' + elem.phone+ ' 姓名：' + elem.name + '</option>'
                    })
                    $('#user-contain select').html(html);

                    $('.selectpicker').selectpicker('refresh');
                })
            })
        })
    </script>
@endsection


