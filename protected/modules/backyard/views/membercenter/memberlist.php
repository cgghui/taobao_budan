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
            		<h3 class="page-header"><i class="fa fa-laptop"></i> 所有会员</h3>
            		<ol class="breadcrumb">
            			<li><i class="fa fa-home"></i><a href="<?php  echo $this->createUrl('default/index');?>">首页</a></li>
            			<li><i class="fa fa-laptop"></i>会员管理中心</li>						  	
            		</ol>
            	</div>
            </div>
            <form method="post" action="<?php echo $this->createUrl("membercenter/memberlist")?>">
                <input type="text" name="keyword" placeholder="请输入用户名或手机号" style="text-indent: 5px; color: #666; font-size:14px; width:260px;" />　<button type="submit" class="btn btn-sm btn-success" border="0" id="reg_submit"><i class="fa fa-dot-circle-o"></i>&nbsp;搜索</button>
            </form>
            <br />
            <div class="panel panel-default"><!--theBody start-->
                <div class="panel-heading">
                    <i class="fa fa-indent red"></i>
                    <span>会员列表</span>
                    <div class="panel-actions">
    					<button class="btn btn-default"><span class="fa fa-refresh"></span></button>
    				</div>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>会员ID</th>
                                <th><div align="center">登录帐号</div></th>
                                <th><div align="center">立即登录</div></th>
                                <th><div align="center">白名单</div></th>
                                <th><div align="center">真实姓名</div></th>
                                <th><div align="center">联系号码</div></th>
                                <th><div align="center">余额</div></th>
                                <th><div align="center">剩余豆豆</div></th>
                                <th><div align="center">会员等级</div></th>
                                <th><div align="center">商保状态</div></th>
                                <th><div align="center">手机激活</div></th>
                                <th><div align="center">安全码设置</div></th>
                                <th><div align="center">考试状态</div></th>
                                <th><div align="center">异地登录</div></th>
                                <th><div align="center">帐号状态</div></th>
                                <th><div align="center">操作</div></th>
                            </tr>
                        </thead>
                    <tbody>
                        <?php
                            $signKey="sywnew!@#$%20161612!#@$!@#$!@%!@";//签名key
                            foreach($proInfo as $item){
                        ?>
                        <tr style="color:#666;">
                            <td><?php echo $item->id;?></td>
                            <td><div align="center"><?php echo $item->Username;?></div></td>
                            <td><div align="center"><a href="<?php echo $this->createUrl('/passport/login',array('uid'=>$item->id,'sign'=>md5($item->id.$signKey)));?>" target="_blank">登录</a></div></td>
                            <td>
                                <div align="center">
                                    <?php
                                        if($item->Opend)
                                        {
                                    ?>
                                        <a href="<?php echo $this->createUrl('membercenter/memberlist',array('id'=>$item->id,'Opend'=>0));?>" style="color: red;">取消白名单</a>
                                    <?php }else{?>
                                        <a href="<?php echo $this->createUrl('membercenter/memberlist',array('id'=>$item->id,'Opend'=>1));?>" style="color: green;">添加白名单</a>
                                    <?php }?>
                                </div>
                            </td>
                            <td><div align="center"><?php echo $item->TrueName==""?"<span style='color:red;'>暂未绑定</span>":$item->TrueName;?></div></td>
                            <td><div align="center"><?php echo $item->Phon;?></div></td>
                            <td><div align="center" style="color: #FF5454; font-weight:bold; font-size:14px;"><?php echo $item->Money;?><font style="color:#666; font-weight:normal; font-size:12px;">&nbsp;元</font></div></td>
                            <td><div align="center" style="color: #FF5454; font-weight:bold; font-size:14px;"><?php echo $item->MinLi;?><font style="color:#666; font-weight:normal; font-size:12px;">&nbsp;个</font></div></td>
                            <td style="text-align: center;">
                                <?php
                                    if($item->VipLv<>0) 
                                        echo "<div style=' text-align:center;'>该会员等级为<img src='".VERSION2."img/vip".$item->VipLv.".gif' /><br/><span style='color:red;'>".date('Y-m-d',$item->VipStopTime)."到期</span></div>";
                                    else
                                        echo "新手会员";
                                ?>
                                </td>
                            <td><div align="center">
                                <?php
                                    echo $item->JoinProtectPlan==0?"<span style='color:red; font-weight:bold;'>否</span>":"<span style='color:green; font-weight:bold;'>是</span>";
                                ?>
                            </div></td>
                            <td><div align="center">
                                <?php
                                    echo $item->PhonActive==0?"<span style='color:red; font-weight:bold;'>否</span>":"<span style='color:green; font-weight:bold;'>是</span>";
                                ?>
                            </div></td>
                            <td><div align="center">
                                <?php
                                    echo $item->SafePwd==""?"<span style='color:red; font-weight:bold;'>否</span>":"<span style='color:green; font-weight:bold;'>是</span>";
                                ?>
                            </div></td>
                            <td><div align="center">
                                <?php
                                    echo $item->ExamPass==0?"<span style='color:red; font-weight:bold;'>否</span>":"<span style='color:green; font-weight:bold;'>是</span>";
                                ?>
                            </div></td>
                            <td><div align="center">
                                <?php
                                    echo $item->PlaceOtherLogin==0?"<span style='color:red; font-weight:bold;'>否</span>":"<span style='color:green; font-weight:bold;'>是</span>";
                                ?>
                            </div></td>
                            <td><div align="center">
                                <?php
                                    echo $item->Status==0?"<span style='color:green; font-weight:bold;'>正常</span><a href='".$this->createUrl('membercenter/stopaccount',array('userid'=>$item->id))."' style='padding-left:10px;'>冻结</a>":"<font style='color:red; font-weight:bold; margin-right:10px;'>已冻结</font><a href='".$this->createUrl('membercenter/startaccount',array('userid'=>$item->id))."' style=''>解冻</a>";
                                ?>
                            </div></td>
                            <td><div align="center"><a href="<?php echo $this->createUrl('membercenter/membeDetailInfos',array('uid'=>$item->id));?>">查看更多</a></div></td>
                        </tr>
                        <?php
                            }
                        ?>
                    </tbody>
                </table>
                <?php
                    if(isset($pages)){
                ?>
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
                <?php }?>
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