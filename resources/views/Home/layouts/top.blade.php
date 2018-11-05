<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
	<title>品优购，优质！优质！</title>
	 <link rel="icon" href="/assets/img/favicon.ico">

    <link rel="stylesheet" type="text/css" href="/css/webbase.css" />
    <link rel="stylesheet" type="text/css" href="/css/pages-JD-index.css" />
    <link rel="stylesheet" type="text/css" href="/css/widget-jquery.autocomplete.css" />
    <link rel="stylesheet" type="text/css" href="/css/widget-cartPanelView.css" />
</head>

<body>
	<!-- 头部栏位 -->                    
	<!--页面顶部--> 
<!--head-->
<div class="top">
	<div class="py-container">
		<div class="shortcut">
			<ul class="fl">
				<li class="f-item">品优购欢迎您！</li>
				@if(session('id'))
					<li class="f-item"><a href="#">{{session('username')}}</a>&nbsp;&nbsp;&nbsp;<span><a href="{{route('home_logout')}}">退出</a></span></li>
				@else
					<li class="f-item"><a href="{{route('home_login')}}">登录</a>&nbsp;&nbsp;&nbsp;<span><a href="{{route('home_logout')}}">免费注册</a></span></li>
				@endif
				</ul>
			<ul class="fr">
				<li class="f-item">我的订单</li>
				<li class="f-item space"></li>
				<li class="f-item">我的品优购</li>
				<li class="f-item space"></li>
				<li class="f-item">品优购会员</li>
				<li class="f-item space"></li>
				<li class="f-item">企业采购</li>
				<li class="f-item space"></li>
				<li class="f-item">关注品优购</li>
				<li class="f-item space"></li>
				<li class="f-item">客户服务</li>
				<li class="f-item space"></li>
				<li class="f-item">网站导航</li>
			</ul>
		</div>
	</div>
</div>



