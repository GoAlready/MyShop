<!DOCTYPE>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="renderer" content="webkit|ie-comp|ie-stand">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/style.css" />
    <link href="/assets/css/codemirror.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/ace.min.css" />
    <link rel="stylesheet" href="/assets/css/font-awesome.min.css" />
    <link rel="stylesheet" href="/font/css/font-awesome.min.css" />
    <!--[if lte IE 8]>
		  <link rel="stylesheet" href="/assets/css/ace-ie.min.css" />
		<![endif]-->
    <script src="/js/jquery-1.9.1.min.js"></script>
    <script src="/assets/js/typeahead-bs2.min.js"></script>
    <script src="/js/lrtk.js" type="text/javascript"></script>
    <script src="/assets/js/jquery.dataTables.min.js"></script>
    <script src="/assets/js/jquery.dataTables.bootstrap.js"></script>
    <script src="/assets/layer/layer.js" type="text/javascript"></script>
    <script src="/assets/dist/echarts.js"></script>
    <script src="/assets/dist/chart/funnel.js"></script>
    <script src="/assets/dist/chart/pie.js"></script>
    <title>会员等级</title>
</head>

<body>
    <div class="grading_style">
        <div id="category">
            <div id="scrollsidebar" class="left_Treeview">
                <div class="show_btn" id="rightArrow"><span></span></div>
                <div class="widget-box side_content">
                    <div class="side_title"><a title="隐藏" class="close_btn"><span></span></a></div>
                    <div class="side_list">
                        <div class="widget-header header-color-green2">
                            <h4 class="lighter smaller">会员等级</h4>
                        </div>
                        <div class="widget-body">
                            <ul class="b_P_Sort_list">
                                <li><i class="orange  fa fa-user-secret"></i><a href="#">全部({{count($UserPoints)}})</a></li>
                                @foreach ($UserPoints as $item)
                                <li><i class="fa fa-diamond pink "></i> <a href="#">{{$item->name}}({{$item->count}})</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!--右侧样式-->
            <div class="page_right_style right_grading">
                <div class="Statistics_style" id="Statistic_pie">
                    <div class="type_title">等级统计
                        <span class="top_show_btn Statistic_btn">显示</span>
                        <span class="Statistic_title Statistic_btn"><a title="隐藏" class="top_close_btn">隐藏</a></span>
                    </div>
                    <div id="Statistics" class="Statistics"></div>
                </div>
                <!--列表样式-->
                <div class="grading_list">
                    <div class="type_title">全部会员等级列表</div>
                    <div class="table_menu_list">
                        <table class="table table-striped table-bordered table-hover" id="sample-table">
                            <thead>
                                <tr>
                                    <th width="80">ID</th>
                                    <th width="100">用户名</th>
                                    <th width="80">性别</th>
                                    <th width="120">手机</th>
                                    <th width="150">邮箱</th>

                                    <th width="180">加入时间</th>
                                    <th width="100">等级</th>
                                    <th width="100">积分</th>
                                    <th width="70">状态</th>
                                    <th width="250">操作</th>
                                </tr>
                            </thead>
                            <tbody>
                                {{-- 用户列表 --}}
                            @foreach ($users as $item)
                            <tr>
                                <td>{{$item->id}}</td>
                                <td><u style="cursor:pointer" class="text-primary" onclick="member_show('{{$item->username}}','member-show.html','10001','500','400')">{{$item->username}}</u></td>
                                <td>{{$item->gender==0?"保密":($item->gender==1?"男":($item->gender==2?"女":""))}}</td>
                                <td>{{$item->mobile}}</td>
                                <td>{{$item->email?:"未设置"}}</td>
                                <td class="text-l">{{$item->created_at}}</td>
                                <td>{{$item->points['name']}}</td>
                                <td>{{$item->points['points']}}</td>
                                <td class="td-status"><span class="label {{$item->status?'label-success':'label-default'}} radius">{{$item->status?"已激活":'已停用'}}</span></td>
                                <td class="td-manage">
                                <a onClick='{{$item->status?"member_stop(this,$item->id)":"member_start(this,$item->id)"}}' href="javascript:;" title="{{$item->status?'停用':'激活'}}" class="btn btn-xs {{$item->status?'btn-default':'btn-success'}}"><i class="{{$item->status?'icon-ban-circle':'icon-key'}} bigger-120"></i></a>
                                <a title="删除" href="javascript:;" onclick="member_del(this,{{$item->id}})" class="btn btn-xs btn-warning"><i class="icon-trash  bigger-120"></i></a>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
<script type="text/javascript">
    $(function () {
        $("#category").fix({
            float: 'left',
            //minStatue : true,
            skin: 'green',
            durationTime: false,
            spacingw: 20,
            spacingh: 240,
            set_scrollsidebar: '.right_grading',
        });
    });
    $(function () {
        $("#Statistic_pie").fix({
            float: 'top',
            //minStatue : true,
            skin: 'green',
            durationTime: false,
            spacingw: 0,
            spacingh: 0,
            close_btn: '.top_close_btn',
            show_btn: '.top_show_btn',
            side_list: '.Statistics',
            close_btn_width: 80,
            side_title: '.Statistic_title',
        });
    });
    /*用户-查看*/
    function member_show(title, url, id, w, h) {
        layer_show(title, url + '#?=' + id, w, h);
    }
  /*用户-停用*/
  function member_stop(obj, id) {
    layer.confirm('确认要停用吗？', function (index) {
      $.get("/admin/member/disableorenable/",{id:id,action:0} ,function(res){
        if(res)
        {
          $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" class="btn btn-xs btn-success" onClick="member_start(this,id)" href="javascript:;" title="激活"><i class="icon-key bigger-120"></i></a>');
          $(obj).parents("tr").find(".td-status").html('<span class="label label-defaunt radius">已停用</span>');
          $(obj).remove();
          layer.msg('已停用!', { icon: 5, time: 1000 });
        }else{
          layer.msg('用户不存在!', { icon: 5, time: 1000 });
        }
      })
    })
  }
  /*用户-激活*/
  function member_start(obj, id) {
    layer.confirm('确认要激活吗？', function (index) {
      $.get("/admin/member/disableorenable/",{id:id,action:1} ,function(res){
        if(res)
        {
          $(obj).parents("tr").find(".td-manage").prepend('<a style="text-decoration:none" class="btn btn-xs" onClick="member_stop(this,id)" href="javascript:;" title="停用"><i class="icon-ban-circle bigger-120"></i></a>');
          $(obj).parents("tr").find(".td-status").html('<span class="label label-success radius">已激活</span>');
          $(obj).remove();
          layer.msg('已激活!', { icon: 6, time: 1000 });
        }else{
          layer.msg('用户不存在!', { icon: 5, time: 1000 });
        }
      })
    })
  }
    /*用户-删除*/
  function member_del(obj, id) {
    layer.confirm('确认要删除吗？', function (index) {
      $.get("/admin/member/delete",{id:[id]},((res)=>{
        if(!res.error){
          $(obj).parents("tr").remove();
          layer.msg('已删除!', { icon: 1, time: 1000 });
        }else{
          layer.msg(res.error, { icon: 2, time: 1000 });
        }
      }))
    })
  }
</script>
<script type="text/javascript">
    //初始化宽度、高度  
    $(".widget-box").height($(window).height());
    $(".page_right_style").width($(window).width() - 220);
    //$(".table_menu_list").width($(window).width()-240);
    //当文档窗口发生改变时 触发  
    $(window).resize(function () {
        $(".widget-box").height($(window).height());
        $(".page_right_style").width($(window).width() - 220);
        //$(".table_menu_list").width($(window).width()-240);
    })
    /**************/
    require.config({
        paths: {
            echarts: './assets/dist'
        }
    });
    require(
        [
            'echarts',
            'echarts/theme/macarons',
            'echarts/chart/pie',   // 按需加载所需图表，如需动态类型切换功能，别忘了同时加载相应图表
            'echarts/chart/funnel'
        ],
        function (ec, theme) {
            var myChart = ec.init(document.getElementById('Statistics'), theme);

            option = {
                title: {
                    text: '用户等级统计',
                    subtext: '实时更新最新等级',
                    x: 'center'
                },
                tooltip: {
                    trigger: 'item',
                    formatter: "{a} <br/>{b} : {c} ({d}%)"
                },
                legend: {

                    x: 'center',
                    y: 'bottom',
                    data: [@foreach ($UserPoints as $v)"{{ $v->name }}",@endforeach]
                },
                toolbox: {
                    show: true,
                    feature: {
                        mark: { show: false },
                        dataView: { show: false, readOnly: true },
                        magicType: {
                            show: true,
                            type: ['pie', 'funnel'],
                            option: {
                                funnel: {
                                    x: '25%',
                                    width: '50%',
                                    funnelAlign: 'left',
                                    max: 6200
                                }
                            }
                        },
                        restore: { show: true },
                        saveAsImage: { show: true }
                    }
                },
                calculable: true,
                series: [
                    {
                        name: '品牌数量',
                        type: 'pie',
                        radius: '55%',
                        center: ['50%', '60%'],
                        data: [
                            @foreach ($UserPoints as $v)
                            { value: {{$v->count}}, name: '{{$v->name}}' },
                            @endforeach
                        ]
                    }
                ]
            };
            myChart.setOption(option);
        }
    );
</script>
<script type="text/javascript">
    $(function ($) {
        var oTable1 = $('#sample-table').dataTable({
            "aaSorting": [[1, "desc"]],//默认第几个排序
            "bStateSave": true,//状态保存
            "aoColumnDefs": [
                //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
                { "orderable": false, "aTargets": [0, 2, 3, 4, 5, 6, 7, 9] }// 制定列不参与排序
            ]
        });


        $('table th input:checkbox').on('click', function () {
            var that = this;
            $(this).closest('table').find('tr > td:first-child input:checkbox')
                .each(function () {
                    this.checked = that.checked;
                    $(this).closest('tr').toggleClass('selected');
                });

        });


        // $('[data-rel="tooltip"]').tooltip({ placement: tooltip_placement });
        // function tooltip_placement(context, source) {
        //     var $source = $(source);
        //     var $parent = $source.closest('table')
        //     var off1 = $parent.offset();
        //     var w1 = $parent.width();

        //     var off2 = $source.offset();
        //     var w2 = $source.width();

        //     if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) return 'right';
        //     return 'left';
        // }
    });
</script>
