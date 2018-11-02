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
<div class="margin clearfix">
    <div class="article_style">
    <form action="{{route('admin_goods_brandadd')}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="add_content" id="form-article-add">
            <ul>
                <li class="clearfix Mandatory">
                    <label class="label_name"><i>*</i>品牌名称</label>
                    <span class="formControls col-10"><input name="brand_name" type="text" id="form-field-1" class="col-xs-10 col-sm-5 "></span>
                </li>
                <li class="clearfix Mandatory">
                    <label class="label_name"><i>*</i>品牌LOGO</label>
                    <span class="formControls col-10"><input name="brand_logo" type="file" id="form-field-1" class="col-xs-10 col-sm-6 "></span>
                </li>
            </ul>
            <br>
            <div class="Button_operation">
                <button style="margin-left:-300px;" class="btn btn-primary radius" type="submit">保存并提交</button>
            </div>
        </div>
    </form>
        
    </div>
</div>
</body>
</html>
<script type="text/javascript" src="/Widget/ueditor/1.4.3/ueditor.config.js"></script>
<script type="text/javascript" src="/Widget/ueditor/1.4.3/ueditor.all.min.js"> </script>
<script type="text/javascript" src="/Widget/ueditor/1.4.3/lang/zh-cn/zh-cn.js"></script> 
<script type="text/javascript">
/**提交操作**/
// function article_save_submit(){
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
