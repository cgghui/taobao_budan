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
            		<h3 class="page-header"><i class="fa fa-laptop"></i> 用户组权限修改</h3>
            		<ol class="breadcrumb">
            			<li><i class="fa fa-home"></i><a href="<?php  echo $this->createUrl('default/index');?>">首页</a></li>
            			<li><i class="fa fa-laptop"></i>管理员中心</li>						  	
            		</ol>
            	</div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-indent red"></i>
                    <span>用户组权限修改</span>
                </div>
                <div class="panel-body">
                    <div class="clear"></div>
                    <div class="theBody"><!--theBody start-->
                        <div style=" padding:0; margin:0; margin-bottom:20px;">
                        <span><a href="#" class="choseall">全选</a></span>　<span><a href="#" class="chosenothing">全不选</a></span>
                    </div>
                    <!--添加内容开始-->
                        <font style="font-size:14px; color:#000; font-weight:bold;">用户组名称：</font><input class="groupname" value="<?php echo $aclgroupinfo->groupname;?>" style='border-radius: 8px; text-indent: 10px;' name="groupname"/>　<button class="changegroupBtn">确认修改权限</button><br /><br />
                        <?php
                            $folder='protected/modules/backyard/controllers';
                            $handler = opendir($folder);
                            while( ($filename = readdir($handler))!== false ) 
                            {
                              if($filename != "." && $filename != "..")
                              {
                                preg_match('/(.*)Controller/', $filename, $controllerid);
                                if($controllerid[1]!="User" && $controllerid[1]!="Default" && $controllerid[1]!="Leftmenu" && $controllerid[1]!="BaseLayout")
                                {
                                    $filepath=$folder."/".$filename;/*获取文件所有目录详细信息*/
                                    $fileCon=file_get_contents($filepath);
                                    preg_match_all('/action(.*)\(\)/', $fileCon, $actionArr);
                                    $controllidInfo=Translatecontrollerid::model()->findByAttributes(array("controllerid"=>$controllerid[1]));
                                    echo "<span style='font-size:14px; font-weight:bold; line-height:25px;'>".$controllidInfo['controlleridChinaese']."</span><br />";
                                    foreach($actionArr[1] as $key=>$value)
                                    {
                                        if(strpos($value,"::")==null && $value!="Passfail")//方法名条件
                                        {
                                            $actionInfo=Translateactionid::model()->findByAttributes(array("actionid"=>$value,"controllerid"=>$controllerid[1]));
                                            echo '<ul class="belongcheckbox" style=" width:160px; height:auto; display:inline; padding:0;"><input name="chkItem" class="aclcheck" type="checkbox" value='.strtolower($controllerid[1]).'/'.strtolower($value).'>'.$actionInfo['actionidChinaese']."</ul>　";
                                        }
                                    }
                                    echo "<div class='clear' style='height:0; line-height:0; font-size:0;'></div><hr style='height:5px;' /><br />";
                                 }
                                    
                              }
                            }
                            closedir($handler);
                        ?>
                    </div><!--theBody end-->
                    <div class="clear"></div>
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
    <script src="<?php echo ASSET_URL;?>js/jquery-2.1.1.min.js"></script>	
	
	<!-- end: JavaScript-->
    <script>
        $(function(){
            /*
                给该用户拥有的权限选项打钩
            */
            var mypower="<?php echo $aclgroupinfo->acllist;?>";
            $("[name = chkItem]:checkbox").each(function(){
                var thisval=$(this).val();
                if(mypower.indexOf(thisval)>=0)
                {
                    $(this).attr("checked",true);
                }
            });
            
            /*
                修改用户组权限
            */
            $(".changegroupBtn").click(function(){
                var acllist="";
                $('input:checked').each(function(){
                    acllist=acllist+$(this).val()+",";
                });
                var groupname=$(".groupname").val();
                if(groupname!="")
                {
                    $.ajax({
                        url: '<?php echo $this->createUrl('acl/aclgroupeditpower');?>',
                        type: 'POST',
                        data:{"acllist":acllist,"groupname":groupname,"groupid":<?php echo $aclgroupinfo->id;?>},
                        success: function(msg){
                            if(msg=="groupnameexist")
                            {
                                alert("用户组名称已存在");
                            }
                            else if(msg=="save")
                            {
                                location.reload();
                            }
                            else if(msg=="savefail")
                            {
                                alert("用户组修改失败，请联系管理员");
                                location.reload();
                            }
                            else
                            {
                                alert("您没有权限执行此操作");
                                location.reload();
                            }
                        }
                    });
                }
                else
                {
                    alert("请添加用户组名称");
                }
            });
            
            $(".choseall").bind("click", function () {
                    $("[name = chkItem]:checkbox").attr("checked", true);
                });
    
            // 全不选
            $(".chosenothing").bind("click", function () {
                $("[name = chkItem]:checkbox").attr("checked", false);
            });
        })
    </script>	
</body>
</html>