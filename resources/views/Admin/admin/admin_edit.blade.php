<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Cache-Control" content="no-siteapp" />
        <link href="/assets/css/bootstrap.min.css" rel="stylesheet" />
        <link rel="stylesheet" href="/css/style.css"/>       
        <link href="/assets/css/codemirror.css" rel="stylesheet">
        <link rel="stylesheet" href="/assets/css/ace.min.css" />
        <link rel="stylesheet" href="/font/css/font-awesome.min.css" />
        <!--[if lte IE 8]>
		  <link rel="stylesheet" href="/assets/css/ace-ie.min.css" />
		<![endif]-->
		<script src="/js/jquery-1.9.1.min.js"></script>
        <script src="/assets/js/bootstrap.min.js"></script>
		<script src="/assets/js/typeahead-bs2.min.js"></script>  	         	
        <script src="/assets/layer/layer.js" type="text/javascript" ></script>          
        <script src="/assets/laydate/laydate.js" type="text/javascript"></script>
        <script src="/js/H-ui.js" type="text/javascript"></script>
<title>添加文章</title>
</head>

<body>
<div class="margin clearfix" style="padding-left:450px;">
    <div class="article_style">
    <form action="{{route('admin_adminupdate',['id'=>$admin['id']])}}" method="post">
        @csrf
        <div class="add_content" id="form-article-add">
		<div class="form-group">
					<label class="form-label"><span class="c-red">*</span>管理员：</label>
					<div class="formControls">
						<input type="text" class="input-text" value="{{$admin['adminname']}}" placeholder="" id="user-name" name="adminname" datatype="*2-16"
						 nullmsg="用户名不能为空">
					</div>
					<div class="col-4"> <span class="Validform_checktip"></span></div>
				</div>
				<div class="form-group">
					<label class="form-label "><span class="c-red">*</span>性别：</label>
					<div class="formControls  skin-minimal">
						
							<label><input name="sex" type="radio" class="ace" value="0" {{ $admin['sex']==0 ? 'checked' : ''  }}><span class="lbl">保密</span></label>&nbsp;&nbsp;
							<label><input name="sex" type="radio" class="ace" value="1" {{ $admin['sex']==1 ? 'checked' : ''  }}> <span class="lbl">男</span></label>&nbsp;&nbsp;
							<label><input name="sex" type="radio" class="ace" value="2" {{ $admin['sex']==2 ? 'checked' : ''  }}><span class="lbl">女</span></label>
					</div>
					<div class="col-4"> <span class="Validform_checktip"></span></div>
				</div>
				<div class="form-group">
					<label class="form-label "><span class="c-red">*</span>手机：</label>
					<div class="formControls ">
						<input type="text" class="input-text" value="{{$admin['phone']}}" placeholder="" id="user-tel" name="phone" datatype="m" nullmsg="手机不能为空">
					</div>
					<div class="col-4"> <span class="Validform_checktip"></span></div>
				</div>
				<div class="form-group">
					<label class="form-label"><span class="c-red">*</span>邮箱：</label>
					<div class="formControls ">
						<input type="text" class="input-text" value="{{$admin['email']}}" placeholder="@" name="email" id="email" datatype="e" nullmsg="请输入邮箱！">
					</div>
					<div class="col-4"> <span class="Validform_checktip"></span></div>
				</div>
				<div class="form-group">
					<label class="form-label"><span class="c-red">*</span>QQ：</label>
					<div class="formControls ">
						<input type="text" class="input-text" placeholder="" value="{{$admin['qq']}}" name="qq" id="qq" datatype="" nullmsg="请输入qq号码！">
					</div>
					<div class="col-4"> <span class="Validform_checktip"></span></div>
				</div>
				<div class="form-group">
					<label class="form-label">角色：</label>
					<span class="select-box" style="width:150px;">
						@foreach($role as $k)
							@if(in_array($k['id'],$role_id))
								<input name="role_id[]" type="checkbox" checked="checked" class="ace" value="{{$k['id']}}"><span class="lbl">{{$k['role_name']}}</span>
							@else
								<input name="role_id[]" type="checkbox" class="ace" value="{{$k['id']}}"><span class="lbl">{{$k['role_name']}}</span>
							@endif
						@endforeach
					</span>
				</div>
				<div>
					<input class="btn btn-primary radius" type="submit" id="Add_Administrator" value="&nbsp;&nbsp;提交&nbsp;&nbsp;">
				</div>
        </div>
    </form>
        
    </div>
</div>
</body>
</html>
<script type="text/javascript">
/**提交操作**/
function article_save_submit(){
	     var num=0;
		 var str="";
    $(".Mandatory input[type$='text']").each(function(n){
        if($(this).val()=="")
        {
           
		    layer.alert(str+=""+$(this).attr("name")+"不能为空！\r\n",{
                title: '提示框',				
                icon:0,								
            }); 
		num++;
        return false;            
        } 
	});
	if(num>0)
    {  
        return false;
    }	 	
    else
    {
	    layer.alert('添加成功！',{
            title: '提示框',				
            icon:1,		
	    });
	    layer.close(index);	
	}		  		     					
	}
$(function(){
	var ue = UE.getEditor('editor');
});
/*radio激发事件*/
function Enable(){ $('.date_Select').css('display','block');}
function closes(){$('.date_Select').css('display','none')}
/**日期选择**/
var start = {
    elem: '#start',
    format: 'YYYY/MM/DD',
    min: laydate.now(), //设定最小日期为当前日期
    max: '2099-06-16', //最大日期
    istime: true,
    istoday: false,
    choose: function(datas){
         end.min = datas; //开始日选好后，重置结束日的最小日期
         end.start = datas //将结束日的初始值设定为开始日
    }
};
var end = {
    elem: '#end',
    format: 'YYYY/MM/DD',
    min: laydate.now(),
    max: '2099-06-16 ',
    istime: true,
    istoday: false,
    choose: function(datas){
        start.max = datas; //结束日选好后，重置开始日的最大日期
    }
};
laydate(start);
laydate(end);
</script>
