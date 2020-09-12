<!DOCTYPE html>
<html lang="en">
	<head>
    	<meta charset="utf-8">
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <meta name="viewport" content="width=device-width, initial-scale=1">
	    <title>数据分析中心</title>		
		
		<!-- Import google fonts - Heading first/ text second -->
        <link rel='stylesheet' type='text/css' href='http://fonts.useso.com/css?family=Open+Sans:400,700|Droid+Sans:400,700' />
        <!--[if lt IE 9]>
<link href="http://fonts.useso.com/css?family=Open+Sans:400" rel="stylesheet" type="text/css" />
<link href="http://fonts.useso.com/css?family=Open+Sans:700" rel="stylesheet" type="text/css" />
<link href="http://fonts.useso.com/css?family=Droid+Sans:400" rel="stylesheet" type="text/css" />
<link href="http://fonts.useso.com/css?family=Droid+Sans:700" rel="stylesheet" type="text/css" />
<![endif]-->

		<!-- Fav and touch icons -->
		<link rel="shortcut icon" href="<?php echo ASSET_URL;?>ico/favicon.ico" type="image/x-icon" />    

	    <!-- Css files -->
	    <link href="<?php echo ASSET_URL;?>css/bootstrap.min.css" rel="stylesheet">		
		<link href="<?php echo ASSET_URL;?>css/jquery.mmenu.css" rel="stylesheet">		
		<link href="<?php echo ASSET_URL;?>css/font-awesome.min.css" rel="stylesheet">
		<link href="<?php echo ASSET_URL;?>css/climacons-font.css" rel="stylesheet">
		<link href="<?php echo ASSET_URL;?>plugins/xcharts/css/xcharts.min.css" rel=" stylesheet">		
		<link href="<?php echo ASSET_URL;?>plugins/fullcalendar/css/fullcalendar.css" rel="stylesheet">
		<link href="<?php echo ASSET_URL;?>plugins/morris/css/morris.css" rel="stylesheet">
		<link href="<?php echo ASSET_URL;?>plugins/jquery-ui/css/jquery-ui-1.10.4.min.css" rel="stylesheet">
		<link href="<?php echo ASSET_URL;?>plugins/jvectormap/css/jquery-jvectormap-1.2.2.css" rel="stylesheet">	    
	    <link href="<?php echo ASSET_URL;?>css/style.min.css" rel="stylesheet">
		<link href="<?php echo ASSET_URL;?>css/add-ons.min.css" rel="stylesheet">		

	    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
	    <!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
	    <![endif]-->
	</head>
</head>

<body>
	<!-- start: Header -->
	<?php $this->renderPartial("/baseLayout/header");?>
	<!-- end: Header -->
	
	<div class="container-fluid content">
	
		<div class="row">
				
			<!-- start: Main Menu -->
			<?php $this->renderPartial("/baseLayout/mainmenu");?>
			<!-- end: Main Menu -->
		
		<!-- start: Content -->
		<div class="main">
            <div class="row">
				<div class="col-lg-12">
					<h3 class="page-header"><i class="fa fa-laptop"></i> 文档栏目</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="<?php  echo $this->createUrl('default/index');?>">首页</a></li>
						<li><i class="fa fa-laptop"></i>文档管理系统</li>						  	
					</ol>
				</div>
			</div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-indent red"></i>
                    <span>
                        文档栏目列表
                    </span>
                </div>
                <div class="panel-body">
        	        <?php
                        echo $this->CatlogTree_arr(0,0,$class_arr);
                    ?>
                </div>
            </div>
		</div>
		<!-- end: Content -->
		<br><br><br>
		
		
		<!-- start: usage -->
		<?php $this->renderPartial("/baseLayout/usage");?>
		<!-- end: usage Menu -->	
		
	</div><!--/container-->
		
	
	<div class="modal fade" id="myModal">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					<h4 class="modal-title">Warning Title</h4>
				</div>
				<div class="modal-body">
					<p>Here settings can be configured...</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Save changes</button>
				</div>
			</div><!-- /.modal-content -->
		</div><!-- /.modal-dialog -->
	</div><!-- /.modal -->
	
	<div class="clearfix"></div>
	
		
	<!-- start: JavaScript-->
	<!--[if !IE]>-->

			<script src="<?php echo ASSET_URL;?>js/jquery-2.1.1.min.js"></script>

	<!--<![endif]-->

	<!--[if IE]>
	
		<script src="<?php echo ASSET_URL;?>js/jquery-1.11.1.min.js"></script>
	
	<![endif]-->

	<!--[if !IE]>-->

		<script type="text/javascript">
			window.jQuery || document.write("<script src='<?php echo ASSET_URL;?>js/jquery-2.1.1.min.js'>"+"<"+"/script>");
		</script>

	<!--<![endif]-->

	<!--[if IE]>
	
		<script type="text/javascript">
	 	window.jQuery || document.write("<script src='<?php echo ASSET_URL;?>js/jquery-1.11.1.min.js'>"+"<"+"/script>");
		</script>
		
	<![endif]-->
	<script src="<?php echo ASSET_URL;?>js/jquery-migrate-1.2.1.min.js"></script>
	<script src="<?php echo ASSET_URL;?>js/bootstrap.min.js"></script>	
	
	
	<!-- page scripts -->
	<script src="<?php echo ASSET_URL;?>plugins/jquery-ui/js/jquery-ui-1.10.4.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/touchpunch/jquery.ui.touch-punch.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/moment/moment.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/fullcalendar/js/fullcalendar.min.js"></script>
	<!--[if lte IE 8]>
		<script language="javascript" type="text/javascript" src="<?php echo ASSET_URL;?>plugins/excanvas/excanvas.min.js"></script>
	<![endif]-->
	<script src="<?php echo ASSET_URL;?>plugins/flot/jquery.flot.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/flot/jquery.flot.pie.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/flot/jquery.flot.stack.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/flot/jquery.flot.resize.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/flot/jquery.flot.time.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/flot/jquery.flot.spline.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/xcharts/js/xcharts.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/autosize/jquery.autosize.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/placeholder/jquery.placeholder.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/datatables/js/jquery.dataTables.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/datatables/js/dataTables.bootstrap.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/raphael/raphael.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/morris/js/morris.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/jvectormap/js/jquery-jvectormap-1.2.2.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/jvectormap/js/jquery-jvectormap-world-mill-en.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/jvectormap/js/gdp-data.js"></script>	
	<script src="<?php echo ASSET_URL;?>plugins/gauge/gauge.min.js"></script>
	
	
	<!-- theme scripts -->
	<script src="<?php echo ASSET_URL;?>js/SmoothScroll.js"></script>
	<script src="<?php echo ASSET_URL;?>js/jquery.mmenu.min.js"></script>
	<script src="<?php echo ASSET_URL;?>js/core.min.js"></script>
	<script src="<?php echo ASSET_URL;?>plugins/d3/d3.min.js"></script>	
	
	<!-- inline scripts related to this page -->
	<script src="<?php echo ASSET_URL;?>js/pages/index.js"></script>	
	
	<!-- end: JavaScript-->
	
</body>
</html>
<style>
body{ font-family:"微软雅黑";}
a{ text-decoration: none;}
.CataLog{ width:100%; height:30px; line-height:30px; font-size:12px; font-weight:bold; color:#fff; margin-top:5px; display:none;}
#CataTop{ display:block}
#theCataTop{ display:block;}
.CataLeft{ width:60%; float:left; background:gainsboro;}
.CataLeft span{ padding-left:5px;}
.Catacenter{ width:13%; float:left; text-align:center; background:gainsboro;}
.Catacenter1{ width:14%; float:left; text-align:center; background:gainsboro;}
.CataRight{ width:13%; float:left; text-align:center; background:gainsboro;}
.CataOperation{ width:40%; float:left; text-align:center;}
#theCataTop{ background:url(<?php echo IMG_URL;?>thebg.png); color:cadetBlue;}
</style>
<script type="text/javascript" src="<?php echo JS_URL;?>jquery.min.js"></script>
<script>
    $(function(){
        $(".topMenu").click(function(){
            var imgUrl=$(this).find("img").attr("src");
            var idname=$(this).attr("alt");
            if(imgUrl=="<?php echo IMG_URL;?>plus.gif")
            {
                $(this).find("img").attr("src","<?php echo IMG_URL;?>jian.gif");
                $("."+idname).show();
            }
            else
            {
                if($(this).attr("id")=="topMenuTrue")
                {
                    $(".topMenu").find("img").attr("src","<?php echo IMG_URL;?>plus.gif");
                    $(".CataLog").hide();
                    $(".CataTop").show();
                    $("#theCataTop").show();
                }
                else
                {
                    $(this).find("img").attr("src","<?php echo IMG_URL;?>plus.gif");
                    var idname=$(this).attr("alt");
                    $("."+idname).hide();
                }
            }
        });
    })
</script>


<div class="showMsg" style="height:50px; padding-left:5px; padding-right:5px; display:none; line-height:50px; background:#68ac00; color:#fff; _position:absolute;  position:fixed; text-align:center; border:5px solid #ccc; font-size:12px; overflow:hidden;">
    <form id="chaneForm" method="post" action="<?php echo $this->createUrl('article/ArticleCatlogChangeInfo');?>">
    	<label id="getLabel" style="display: inline;"></label><input type="text" name="name" /><input type="submit" value="确定" />　<span id="closeBa" style=" cursor:pointer;">关闭</span>
    </form>
</div>

<div class="showMsgAddSon" style="width:auto; height:50px; line-height: 50px; padding-left:5px; padding-right:5px; display:none; background:#68ac00; color:#fff; _position:absolute;  position:fixed; text-align:center; border:5px solid #ccc; font-size:12px; overflow:hidden;">
    <form id="AddSonTypeForm" method="post" action="<?php echo $this->createUrl('article/ArticleCatlogAddSonType');?>">
    	<label id="getLabelAddSon" style="display: inline;"></label><input type="text" name="name" style=" height:25px; line-height: 25px; border:none;" /><select name="type"><option value="1">文章列表</option><option value="0">单页</option></select><input type="submit" value="确定" border="0" />　<span id="closeBaAddSonType" style=" cursor:pointer;">关闭</span>
    </form>
</div>
<script>
$(function(){
	var LeftValue=($(window).width()-$(".showMsg").width()-200)/2;
	var topValue=($(window).height()-$(".showMsg").height())/2;
	$(".showMsg").css({"left":LeftValue,"top":topValue});
	
	$("#closeBa").click(function(){
		$(".showMsg").fadeOut(1000);	
		$(".showMsgAddSon").fadeOut(1000);	
	});
	
	$("#closeBaAddSonType").click(function(){
		$(".showMsgAddSon").fadeOut(1000);	
	});
	
	$(".ChangeInfo").click(function(){
		var name=$(this).parents(".CataLog").find(".CataLeft span a").html();
		var id=$(this).parents(".CataLog").find(".CataLeft font").html();
		$("#getLabel").html("栏目["+name+"]名称修改为：");
		$("#chaneForm").append('<input type="hidden" name="id" value='+id+'>');
		$(".showMsg").fadeIn(1000);		
	});
	
	var LeftValue=($(window).width()-$(".showMsgAddSon").width()-200)/2;
	var topValue=($(window).height()-$(".showMsgAddSon").height())/2;
	$(".showMsgAddSon").css({"left":LeftValue,"top":topValue});
	
	$(".AddSonType").click(function(){
		var name=$(this).parents(".CataLog").find(".CataLeft span a").html();
		var id=$(this).parents(".CataLog").find(".CataLeft font").html();
		$("#getLabelAddSon").html("添加["+name+"]子类，名称为：");
		$("#AddSonTypeForm").append('<input type="hidden" name="id" value='+id+'>');
		$(".showMsgAddSon").fadeIn(1000);		
	});
	
	$(".CataRight a").click(function(){
		if(confirm('您确定要删除吗？删除后将无法恢复！')) return true;else return false;	
	});
})
</script>
<style>
    select{ height:25px; line-height: 23px; margin:0; padding:0; position: relative; top:1px;}
    input[type=submit]{ height:25px; line-height: 25px; background: none; border:none; margin:0; padding:0; margin-left:10px; color:white;}
    input[name=name]{ height:25px; line-height: 25px;}
    form{ margin:0; padding:0; position: relative; top:-5px;}
    input{ color:#000;}
</style>
</body>
<!-- Download From www.exet.tk-->
</html>
