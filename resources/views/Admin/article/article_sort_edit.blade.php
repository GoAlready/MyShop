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
<title>修改文章分类</title>
</head>

<body>
<div class="margin clearfix">
 <div class="article_style">
    <form action="{{route('admin_artsort_update',['id' => $message['id']])}}" method="post">
    {{csrf_field()}}
        <div class="add_content" id="form-article-add">
            <ul>
                <li class="clearfix Mandatory">
                    <label class="label_name"><i>*</i>分类名称</label>
                    <span class="formControls col-10">
                        <input name="catename" type="text" id="form-field-1" class="col-xs-10 col-sm-5" value="<?=$message['catename']?>">
                    </span>
                </li>
                <li class="clearfix Mandatory">
                    <label class="label_name"><i>*</i>是否启用</label>
                    <span class="formControls col-10">
                        <input name="is_enable" type="text" id="form-field-1" class="col-xs-10 col-sm-5" value="<?=$message['is_enable']?>">
                    </span>
                </li>
                <li class="clearfix Mandatory"><label class="label_name"><i>*</i>简介</label>
                    <span class="formControls col-10">
                        <input name="descrip" type="text" id="form-field-1" class="col-xs-10 col-sm-6" value="<?=$message['descrip']?>">
                    </span>
                </li>
            </ul>
            <div class="Button_operation">
                    <button class="btn btn-primary radius" type="submit">保存并提交</button>
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
