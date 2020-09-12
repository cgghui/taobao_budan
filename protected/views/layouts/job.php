<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>亿课人才网</title>
<link rel="stylesheet" type="text/css" href="<?php echo JOB_CSS_URL;?>css.css"/>
<script type="text/javascript" src="<?php echo JOB_JS_URL;?>jquery.js"></script>
<script type="text/javascript" src="<?php echo JOB_JS_URL;?>js.js"></script>
<script>
	$(function(){
		$(".loginTitle ul li").hover(function(){
			var thisIndex=$(this).index();
			
			$(".loginTitle ul li").css({"color":"#fff","background":"#d24500"});
			$(this).css({"color":"#666","background":"none"});
			$(".loginConOut").hide();
			$(".loginConOut").eq(thisIndex).show();
		});	
	})
</script>
</head>

<body>
	<div class="headOut"><!--headOut start-->
    	<div class="head"><!--head start-->
        	<div class="headLeft"><!--headLeft start-->
            	<ul>
                	<li><a href="<?php echo $this->createUrl('site/index');?>" style="font-size: 14px; font-weight:bold;">亿课首页</a></li>
                    <li><a href="#">您好，欢迎来到亿才网</a></li>
                    <li><a href="#">用户登录▼</a></li>
                    <li><a href="#">免费注册▼</a></li>
                </ul>
            </div><!--headLeft end-->
            <div class="headRight"><!--headRight start-->
            	<ul>
                    <li><a href="#">服务热线：<span>400-800-8088</span></a></li>
                    <li><a href="#">帮助中心</a></li>
                </ul>
            </div><!--headRight end-->
        </div><!--head end-->
    </div><!--headOut end-->
    <div class="clear"></div>
    <div class="logoSearch"><!--logoSearch start-->
    	<div class="logo"><!--logo start-->
        	<a href="#"><img src="<?php echo JOB_IMG_URL;?>logo.png" /></a>
        </div><!--logo end-->
        <div class="search"><!--search start-->
            <div class="searchCon"><!--searchCon start-->
                <form>
                    <input type="text" class="keyword" border="0" />
                    <input type="submit" class="searchBtn" border="0" value="" />
                </form>  
            </div><!--searchCon end-->
            <span class="heightSearch"><a href="#">高级搜索</a></span>
            <div class="clear"></div>
            <div class="hotWork"><!--hotWork start-->
                <span>热门职位：</span><a href="#">会计</a><a href="#">PHP程序员</a><a href="#">营销经理</a><a href="#">设计</a>
            </div><!--hotWork end-->
        </div><!--search end-->
    </div><!--logoSearch end-->
    <div class="clear"></div>
    <div class="menu"><!--menu start-->
    	<div class="nav"><!--nav start-->
        	<ul>
            	<li class="navSelected"><a href="#">首页</a></li>
                <li><a href="#">找工作</a></li>
                <li><a href="#">找人才</a></li>
                <li><a href="#">职场指南</a></li>
                <li><a href="/">学无止境</a></li>
            </ul>
        </div><!--nav end-->
    </div><!--menu end-->
    <div class="clear"></div>
    <div class="indexCon"><!--indexCon start-->
        <?php echo $content;?>
        <div class="clear"></div>
        <div class="friendLink"><!--friendLink start-->
        	<a href="#">网站导航</a>|<a href="#">关于我们</a>|<a href="#">联系我们</a>|<a href="#">广告投放</a>|<a href="#">收费标准</a>|<a href="#">法律声明</a>|<a href="#">隐私说明</a>|<a href="#">合作伙伴</a>
        </div><!--friendLink end-->
        <div class="foot"><!--foot start-->
        	客服热线：400-800-8888 Copyright @ 2013-2018 版权所有 上海亿才服务有限公司 All Rights Reserved
        </div><!--foot end-->
    </div><!--indexCon end-->
</body>
</html>


