<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="/css/style.css" />
  <link href="/assets/css/codemirror.css" rel="stylesheet">
  <link rel="stylesheet" href="/assets/css/ace.min.css" />
  <link rel="stylesheet" href="/assets/css/font-awesome.min.css" />
  <!--[if IE 7]>
		  <link rel="stylesheet" href="/assets/css/font-awesome-ie7.min.css" />
		<![endif]-->
  <!--[if lte IE 8]>
		  <link rel="stylesheet" href="/assets/css/ace-ie.min.css" />
		<![endif]-->
  <script src="/assets/js/jquery.min.js"></script>

  <!-- <![endif]-->

  <!--[if IE]>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<![endif]-->

  <!--[if !IE]> -->

  <script type="text/javascript">
    window.jQuery || document.write("<script src='/assets/js/jquery-2.0.3.min.js'>" + "<" + "/script>");
  </script>

  <!-- <![endif]-->

  <!--[if IE]>
<script type="text/javascript">
 window.jQuery || document.write("<script src='/assets/js/jquery-1.10.2.min.js'>"+"<"+"/script>");
</script>
<![endif]-->

  <script type="text/javascript">
    if ("ontouchend" in document) document.write("<script src='/assets/js/jquery.mobile.custom.min.js'>" + "<" + "/script>");
  </script>
  <script src="/assets/js/bootstrap.min.js"></script>
  <script src="/assets/js/typeahead-bs2.min.js"></script>
  <!-- page specific plugin scripts -->
  <script src="/assets/js/jquery.dataTables.min.js"></script>
  <script src="/assets/js/jquery.dataTables.bootstrap.js"></script>
  <script type="text/javascript" src="/js/H-ui.js"></script>
  <script type="text/javascript" src="/js/H-ui.admin.js"></script>
  <script src="/assets/layer/layer.js" type="text/javascript"></script>
  <script src="/assets/laydate/laydate.js" type="text/javascript"></script>
  <title>用户列表</title>
</head>

<body>
  <div class="page-content clearfix">
    <div id="Member_Ratings">
      <div class="d_Confirm_Order_style">
        <div class="search_style">

          <ul class="search_content clearfix">
            <li><label class="l_f">会员名称</label><input name="" type="text" class="text_add" placeholder="输入会员名称、电话、邮箱"
                style=" width:400px" /></li>
            <li><label class="l_f">添加时间</label><input class="inline laydate-icon" id="start" style=" margin-left:10px;"></li>
            <li style="width:90px;"><button type="button" class="btn_search"><i class="icon-search"></i>查询</button></li>
          </ul>
        </div>
        <!---->
        <div class="border clearfix">
          <span class="l_f">
            <a href="javascript:;" id="member_add" class="btn btn-warning"><i class="icon-plus"></i>添加用户</a>
            <a href="javascript:;" onclick="member_del_batch(this)" class="btn btn-danger"><i class="icon-trash"></i>批量删除</a>
          </span>
          <span class="r_f">共：<b>{{$users->count()}}</b>条</span>
        </div>
        <!---->
        <div class="table_menu_list">
          <table class="table table-striped table-bordered table-hover" id="sample-table">
            <thead>
              <tr>
                <th width="25"><label><input type="checkbox" class="ace"><span class="lbl"></span></label></th>
                <th width="80">ID</th>
                <th width="100">用户名</th>
                <th width="80">性别</th>
                <th width="120">手机</th>
                <th width="150">邮箱</th>
                <th width="">地址</th>
                <th width="180">加入时间</th>
                <th width="100">等级</th>
                <th width="70">状态</th>
                <th width="250">操作</th>
              </tr>
            </thead>
            <tbody>
              {{-- 用户列表 --}}
              @foreach ($users as $item)
              <tr>
                <td><label><input type="checkbox" class="ace member_del_batch"  value="{{$item->id}}"><span class="lbl"></span></label></td>
                <td>{{$item->id}}</td>
                <td><u style="cursor:pointer" class="text-primary" onclick="member_show('{{$item->username}}','member-show.html','10001','500','400')">{{$item->username}}</u></td>
                <td>{{$item->gender==0?"保密":($item->gender==1?"男":($item->gender==2?"女":""))}}</td>
                <td>{{$item->mobile}}</td>
                <td>{{$item->email?:"未设置"}}</td>
                <td class="text-l">北京市 海淀区</td>
                <td>{{$item->created_at}}</td>
                <td>普通用户</td>
                <td class="td-status"><span class="label {{$item->status?'label-success':'label-default'}} radius">{{$item->status?"已激活":'已停用'}}</span></td>
                <td class="td-manage">
                  <a onClick='{{$item->status?"member_stop(this,$item->id)":"member_start(this,$item->id)"}}' href="javascript:;" title="{{$item->status?'停用':'激活'}}" class="btn btn-xs {{$item->status?'btn-default':'btn-success'}}"><i class="{{$item->status?'icon-ban-circle':'icon-key'}} bigger-120"></i></a>
                  <a title="编辑" onclick="member_edit({{$item->id}})" href="javascript:;" class="btn btn-xs btn-info"><i class="icon-edit bigger-120"></i></a>
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
  <!--添加用户图层-->
  <div class="add_menber" id="add_menber_style" style="display:none">
    <ul class=" page-content">
      <li><label class="label_name">用&nbsp;&nbsp;户 &nbsp;名：</label><span class="add_name"><input value="" name="用户名"
            type="text" class="text_add" /></span>
        <div class="prompt r_f"></div>
      </li>
      <li><label class="label_name">真实姓名：</label><span class="add_name"><input name="真实姓名" type="text" class="text_add" /></span>
        <div class="prompt r_f"></div>
      </li>
      <li><label class="label_name">性&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;别：</label><span class="add_name">
          <label><input name="form-field-radio" type="radio"  class="gender ace" value=0><span class="lbl">保密</span></label>
          <label><input name="form-field-radio" type="radio" class="gender ace" value=1><span class="lbl">男</span></label>&nbsp;&nbsp;&nbsp;
          <label><input name="form-field-radio" type="radio" class="gender ace"  checked="checked" value=2><span class="lbl">女</span></label>&nbsp;&nbsp;&nbsp;
        </span>
        <div class="prompt r_f"></div>
      </li>
      <li><label class="label_name">移动电话：</label><span class="add_name"><input name="移动电话" type="text" class="text_add" /></span>
        <div class="prompt r_f"></div>
      </li>
      <li><label class="label_name">电子邮箱：</label><span class="add_name"><input name="电子邮箱" type="text" class="text_add" /></span>
        <div class="prompt r_f"></div>
      </li>
      <li><label class="label_name">密码：</label><span class="add_name"><input name="密码" type="password" class="text_add" /></span>
        <div class="prompt r_f"></div>
      </li>
      <li><label class="label_name">状&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;态：</label>
        <span class="add_name">
          <label><input name="form-field-radio1" type="radio" class="status ace" value=0><span class="lbl">关闭</span></label>&nbsp;&nbsp;&nbsp;
          <label><input name="form-field-radio1" type="radio" class="status ace" checked="checked" value=1><span class="lbl">开启</span></label>
           {{ csrf_field() }}
        </span>
        <div class="prompt r_f"></div>
      </li>
    </ul>
  </div>
</body>

</html>
<script>
  jQuery(function ($) {
    var oTable1 = $('#sample-table').dataTable({
      "aaSorting": [[1, "desc"]],//默认第几个排序
      "bStateSave": true,//状态保存
      "aoColumnDefs": [
        //{"bVisible": false, "aTargets": [ 3 ]} //控制列的隐藏显示
        { "orderable": false, "aTargets": [0, 8, 9] }// 制定列不参与排序
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


    $('[data-rel="tooltip"]').tooltip({ placement: tooltip_placement });
    function tooltip_placement(context, source) {
      var $source = $(source);
      var $parent = $source.closest('table')
      var off1 = $parent.offset();
      var w1 = $parent.width();

      var off2 = $source.offset();
      var w2 = $source.width();

      if (parseInt(off2.left) < parseInt(off1.left) + parseInt(w1 / 2)) return 'right';
      return 'left';
    }
  })
  /*用户-添加*/
  $('#member_add').on('click', function () {
    document.getElementsByName("用户名")[0].value = ''
    document.getElementsByName('移动电话')[0].value = ''
    document.getElementsByName('电子邮箱')[0].value = ''
    document.getElementsByName('真实姓名')[0].value = ''
    document.getElementsByName('密码')[0].value = ''
    layer.open({
      type: 1,
      title: '添加用户',
      maxmin: true,
      shadeClose: true, //点击遮罩关闭层
      area: ['800px', ''],
      content: $('#add_menber_style'),
      btn: ['提交', '取消'],
      yes: function (index, layero) {
        var num = 0;
        var str = "";
        $(".add_menber input[type$='text']").each(function (n) {
          if ($(this).val() == "") {
            layer.alert(str += "" + $(this).attr("name") + "不能为空！\r\n", {
              title: '提示框',
              icon: 0,
            });
            num++;
            return false;
          }
        });
        if (num > 0) { return false; }
        else {
          // 提交表单
          $.post('/admin/member/insert',{
            _token:document.getElementsByName('_token')[0].value,
            username:document.getElementsByName("用户名")[0].value,
            gender:$('.gender:checked')[0].value,
            status:$('.status:checked')[0].value,
            mobile:document.getElementsByName('移动电话')[0].value,
            email:document.getElementsByName('电子邮箱')[0].value,
            password:document.getElementsByName('密码')[0].value,
            real_name:document.getElementsByName('真实姓名')[0].value
          },((res)=>{
            if(!res.error){
              layer.alert('添加成功！', {
                title: '提示框',
                icon: 1,
              });
            layer.close(index);
            }else{
              layer.alert(res.error, {
                title: '提示框',
                icon: 2,
              });
            }
          }))
        }
      }
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
  /*用户-编辑*/
  function member_edit(id) {
    document.getElementsByName('密码')[0].value = ''
    $.get('/admin/member/info',{id:id},((res)=>{
      if(!res)
      {
        layer.msg('用户不存在!', { icon: 5, time: 1000 });
      }else{
        layer.open({
        type: 1,
        title: '修改用户信息',
        maxmin: true,
        shadeClose: false, //点击遮罩关闭层
        area: ['800px', ''],
        content: $('#add_menber_style'),
        btn: ['提交', '取消'],
        yes: function (index, layero) {
          var num = 0;
          var str = "";
          $(".add_menber input[type$='text']").each(function (n) {
            if ($(this).val() == "") {
              layer.alert(str += "" + $(this).attr("name") + "不能为空！\r\n", {
                title: '提示框',
                icon: 0,
              });
              num++;
              return false;
            }
          });
          if (num > 0) { return false; }
          else {
            // 提交表单
            $.post('/admin/member/info/update',{
              _token:document.getElementsByName('_token')[0].value,
              id:id,
              username:document.getElementsByName("用户名")[0].value,
              gender:$('.gender:checked')[0].value,
              status:$('.status:checked')[0].value,
              mobile:document.getElementsByName('移动电话')[0].value,
              email:document.getElementsByName('电子邮箱')[0].value,
              password:document.getElementsByName('密码')[0].value,
              real_name:document.getElementsByName('真实姓名')[0].value
            },((res)=>{
              if(!res.error){
                layer.alert('修改成功！', {
                  title: '提示框',
                  icon: 1,
                });
              layer.close(index);
              }else{
                layer.alert(res.error, {
                  title: '提示框',
                  icon: 2,
                });
              }
            }))
          }
        }
      });
      // 写入数据
      document.getElementsByName("用户名")[0].value = res.username
      document.getElementsByName('form-field-radio')[res.gender].setAttribute('checked','checked')
      document.getElementsByName('移动电话')[0].value = res.mobile
      document.getElementsByName('电子邮箱')[0].value = res.email
      document.getElementsByName('真实姓名')[0].value = res.real_name
      document.getElementsByName('form-field-radio1')[res.status].setAttribute('checked','checked')
      }
    }))
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
  // 批量删除
  function member_del_batch(obj){
    layer.confirm('确认要删除吗？', function (index) {
      let id = [];
      for (let i = 0; i < $(".member_del_batch:checked").length; i++) {
        id[i] = $(".member_del_batch:checked")[i].value
      }
      $.get("/admin/member/delete",{id:id},((res)=>{
        if(!res.error){
          $(".member_del_batch:checked").parents("tr").remove();
          layer.msg('已删除!', { icon: 1, time: 1000 });
        }else{
          layer.msg(res.error, { icon: 2, time: 1000 });
        }
      }))
    })
  }
</script>