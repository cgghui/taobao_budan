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
            		<h3 class="page-header"><i class="fa fa-laptop"></i> 用户充值中心</h3>
            		<ol class="breadcrumb">
            			<li><i class="fa fa-home"></i><a href="<?php  echo $this->createUrl('default/index');?>">首页</a></li>
            			<li><i class="fa fa-laptop"></i>用户充值、提现</li>						  	
            		</ol>
            	</div>
            </div>
			<div class="panel panel-default"><!--theBody start-->
                <div class="panel-heading">
                    <i class="fa fa-indent red"></i>
                    <span>添加新的充值记录</span>
                    <div class="panel-actions">
    					<button class="btn btn-default"><span class="fa fa-refresh"></span></button>
    				</div>
                </div>
                <div class="panel-body">
				    <form action="<?php echo $this->createUrl('moneyman/addOrder');?>" method="post" onsubmit="return addcheck();">
					<style>
					    .addorder td input.tno{
							width:300px;
						}
					</style>
                    <table class="table table-hover addorder">
                        <tbody>
                            <tr>
                                <td  class="long">交易号：<input type="text" name="tno" id="tno" class="tno"/></td>
                                <td class="short">金额：<input type="text" name="money" id="money"/></td>
                                <td class="short">类型：<select name="type" id="type"><option value="">---选择---</option><option value="2">支付宝</option><option value="3">财付通</option><option value="4">手机qq</option></select>
                                <td class="short">备注：<input type="text" name="payno" id="payno" placeholder="必须填用户名"/></td>
								<td class="short" style="width:30%"><input type="submit" value="添加"/></td>
                            </tr>
                        </tbody>
                    </table>
					</form>
					<script>
					    function addcheck(){
							if($.trim($("#tno").val())==''){
								alert("交易号不能为空");
								$("#tno").focus();
								return false;
							}
							if($.trim($("#money").val())==''){
								alert("金额不能为空");
								$("#money").focus();
								return false;
							}
							if($.trim($("#type").val())==''){
								alert("类型不能为空");
								$("#type").focus();
								return false;
							}
							if($.trim($("#payno").val())==''){
								alert("备注不能为空");
								$("#payno").focus();
								return false;
							}
						}
					</script>
              </div><!--theBody end-->
                <div class="clear"></div>
		</div>
            <div class="panel panel-default"><!--theBody start-->
                <div class="panel-heading">
                    <i class="fa fa-indent red"></i>
                    <span>用户充值中心</span>
                    <div class="panel-actions">
    					<button class="btn btn-default"><span class="fa fa-refresh"></span></button>
    				</div>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th><div>ID号</div></th>
                                <th><div><div align="center">用户id</div></th>
                                <th><div><div align="center">登录帐号</div></th>
                                <th><div align="center">交易号</div></th>
                                <th><div align="center">交易金额(单位：元)</div></th>
                                <th><div align="center">编号备注 一般是用户名</div></th>
                                <th><div align="center">支付状态</div></th>
                                <th><div align="center">支付时间</div></th>
                                <th><div align="center">完成帐户充值时间</div></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($proInfo as $item){
                                    $userinfo=User::model()->findByPk($item->uid);
                            ?>
                            <tr style="color:#666;">
                                <td><?php echo $item->id;?></td>
                                <td><div align="center"><?php echo $item->uid!=""?$item->uid:"<font style='font-weight:bold; color:red;'>暂无</font>";?></div></td>
                                <td><div align="center"><?php echo $userinfo!=false?$userinfo->Username:"<font style='font-weight:bold; color:red;'>暂无</font>";?></div></td>
                                <td><div align="center" style="color: red;"><?php echo $item->tno;?></div></td>
                                <td><div align="center"><font style='font-weight:bold; color:red; font-size:14px;'><?php echo $item->money;?></font>&nbsp;&nbsp;元</div></td>
                                <td><div align="center"><?php echo $item->payno!=""?$item->payno:"<font style='font-weight:bold; color:red;'>暂无</font>";?></div></td>
                                <td><div align="center">
                                    <?php
                                        echo $item->status!=0?"<font style='font-weight:bold; color:green;'>已完成</font>":"<font style='font-weight:bold; color:red;'>未完成</font>";
                                    ?>
                                </div></td>
                                <td><div align="center"><?php echo date('Y年m月d日 H:i:s',$item->addtime);?></div></td>
                                <td><div align="center">
                                    <?php echo $item->addtime!=""?date('Y年m月d日 H:i:s',$item->addtime):"暂无";?>
                                </div></td>
                            </tr>
                            <?php
                                }
                            ?>
                        </tbody>
                    </table>
                    <div class="breakpage"><!--分页开始-->
                        <?php
                            $this->widget('CLinkPager', array(
                                'selectedPageCssClass'=>'active',
                                'pages' => $pages,
                                'lastPageLabel' => '最后一页',
                                'firstPageLabel' => '第一页',
                                'header' => false,
                                'nextPageLabel' => ">>",
                                'prevPageLabel' => "<<",
                            ));
                        ?>
                    </div><!--分页结束-->
              </div><!--theBody end-->
                <div class="clear"></div>
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