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
					<h3 class="page-header"><i class="fa fa-laptop"></i> 数据分析中心</h3>
					<ol class="breadcrumb">
						<li><i class="fa fa-home"></i><a href="index.html">首页</a></li>
						<li><i class="fa fa-laptop"></i>数据统计</li>						  	
					</ol>
				</div>
			</div>
			
			<div class="row">
				<?php
                    $totleUser=User::model()->findAll(array(
                        'select'=>'id'
                    ));
                    $totalTask=Companytasklist::model()->findAll(array(
                        'select'=>'id'
                    ));
                    $totalTaskComplete=Companytasklist::model()->findAll(array(
                        'condition'=>'taskCompleteStatus=1',
                        'select'=>'id'
                    ));
                ?>
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box red-bg">
						<i class="fa fa-thumbs-o-up"></i>
						<div class="count"><?php echo count($totalTask);?></div>
						<div class="title">任务总数</div>						
					</div><!--/.info-box-->			
				</div><!--/.col-->
				
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box green-bg">
						<i class="fa fa-cubes"></i>
						<div class="count"><?php echo count($totalTaskComplete);?></div>
						<div class="title">已完成任务</div>						
					</div><!--/.info-box-->			
				</div><!--/.col-->
				
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box blue-bg">
						<i class="fa fa-cloud-download"></i>
						<div class="count"><?php echo count($totleUser);?></div>
						<div class="title">商家总数</div>					
					</div><!--/.info-box-->			
				</div><!--/.col-->
				
				<div class="col-lg-3 col-md-3 col-sm-12 col-xs-12">
					<div class="info-box magenta-bg">
						<i class="fa fa-shopping-cart"></i>
						<div class="count"><?php echo count($totleUser);?></div>
						<div class="title">威客总数</div>						
					</div><!--/.info-box-->			
				</div><!--/.col-->		
				
			</div><!--/.row-->		
			
				
			<div class="row" style="display:none;">			
				
				<div class="col-lg-6 col-md-12">
					
					<div class="panel panel-default">
						<div class="panel-heading">
							<h2><i class="fa fa-spinner red"></i><strong>In Progress</strong></h2>
							<div class="panel-actions">
								<a href="index.html#" class="btn-setting"><i class="fa fa-rotate-right"></i></a>
								<a href="index.html#" class="btn-minimize"><i class="fa fa-chevron-up"></i></a>
								<a href="index.html#" class="btn-close"><i class="fa fa-times"></i></a>
							</div>
							<ul class="nav nav-tabs" id="recent">
							  	<li class="active"><a href="index.html#tasks">Tasks</a></li>
							  	<li><a href="index.html#tickets">Tickets</a></li>
							</ul>
						</div>
						<div class="panel-body">
							<div class="tab-content">
								<div class="tab-pane active" id="tasks">
									<table class="table bootstrap-datatable datatable small-font">
										<thead>
											  <tr>
												  <th>Task</th>
												  <th>Assigned to</th>
												  <th>Progress</th>
												  <th class="center">Status</th>
											  </tr>
										  </thead>   
										  <tbody>
											<tr>
												<td>Package Usage</td>
												<td>Jenny Coe</td>
												<td>
													<div class="progress thin">
													  	<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="73" aria-valuemin="0" aria-valuemax="100" style="width: 73%">
													    	<span class="sr-only">73% Complete (success)</span>
													  	</div>
													</div>
												</td>
												<td class="text-center text-info">
													Active
												</td>
											</tr>
											<tr>
												<td>Payment Process</td>
												<td>Jack Key</td>
												<td>
													<div class="progress thin">
													  	<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="95" aria-valuemin="0" aria-valuemax="100" style="width: 95%">
													    	<span class="sr-only">95% Complete (success)</span>
													  	</div>
													</div>
												</td>
												<td class="text-center text-success">
													Active
												</td>
											</tr>
											<tr>
												<td>Web Development</td>
												<td>Jossy</td>
												<td>
													<div class="progress thin">
													  	<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="27" aria-valuemin="0" aria-valuemax="100" style="width: 27%">
													    	<span class="sr-only">27% Complete (success)</span>
													  	</div>
													</div>
												</td>
												<td class="text-center text-warning">
													Pending
												</td>
											</tr>
											<tr>
												<td>Web Error</td>
												<td>Alex Bram</td>
												<td>
													<div class="progress thin">
													  	<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%">
													    	<span class="sr-only">50% Complete (success)</span>
													  	</div>
													</div>
												</td>
												<td class="text-center text-primary">
													Active
												</td>
											</tr>
											<tr>
												<td>Storage Capacity</td>
												<td>Jimmy Doe</td>
												<td>
													<div class="progress thin">
													  	<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="73" aria-valuemin="0" aria-valuemax="100" style="width: 73%">
													    	<span class="sr-only">73% Complete (success)</span>
													  	</div>
													</div>
												</td>
												<td class="text-center text-danger">
													Canceled
												</td>
											</tr>
											<tr>
												<td>Disk Performance</td>
												<td>Marcell</td>
												<td>
													<div class="progress thin">
													  	<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%">
													    	<span class="sr-only">40% Complete (success)</span>
													  	</div>
													</div>
												</td>
												<td class="text-center text-primary">
													Active
												</td>
											</tr>
											<tr>
												<td>Yearly Services</td>
												<td>Morgan</td>
												<td>
													<div class="progress thin">
													  	<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="27" aria-valuemin="0" aria-valuemax="100" style="width: 27%">
													    	<span class="sr-only">27% Complete (success)</span>
													  	</div>
													</div>
												</td>
												<td class="text-center text-warning">
													Pending
												</td>
											</tr>											
										</tbody>
									</table>
								</div>	
							  	<div class="tab-pane" id="tickets">
									<table class="table bootstrap-datatable datatable small-font">
										<thead>
											<tr>
												<th>Status</th>
												<th>Date</th>
												<th>Description</th>
												<th>User</th>
												<th>Number</th>
											</tr>
										</thead>   
										<tbody>
											<tr>
												<td><span class="label label-success">Complete</span></td>
												<td>May 10, 2014 18:05</td>
												<td>Disk problem</td>
												<td>Gerry</td>
												<td><b>[#26915]</b></td>
											</tr>
											<tr>
												<td><span class="label label-warning">Suspended</span></td>
												<td>May 10, 2014 18:05</td>
												<td>Hosting Update</td>
												<td>Sarah</td>
												<td><b>[#25986]</b></td>
											</tr>
											<tr>
												<td><span class="label label-danger">Rejected</span></td>
												<td>May 10, 2014 18:05</td>
												<td>Trouble Connection</td>
												<td>Smith</td>
												<td><b>[#23695]</b></td>
											</tr>
											<tr>
												<td><span class="label label-info">In progress</span></td>
												<td>May 10, 2014 18:05</td>
												<td>Domain Performance </td>
												<td>George</td>
												<td><b>[#24587]</b></td>
											</tr>
											<tr>
												<td><span class="label label-success">Complete</span></td>
												<td>May 10, 2014 18:05</td>
												<td>Paypal Registration</td>
												<td>Justin</td>
												<td><b>[#25698]</b></td>
											</tr>
											<tr>
												<td><span class="label label-success">Complete</span></td>
												<td>May 10, 2014 18:05</td>
												<td>Server Problem</td>
												<td>Elie</td>
												<td><b>[#25367]</b></td>
											</tr>
											<tr>
												<td><span class="label label-info">In progress</span></td>
												<td>May 10, 2014 18:05</td>
												<td>Design Error</td>
												<td>Reinald</td>
												<td><b>[#25639]</b></td>
											</tr>
																					
										</tbody>
									</table>
							  	</div>
							</div>	 	
						</div>
					</div>
					
				</div><!--/col-->
				<div class="col-md-3">
					
					<div class="social-box facebook">
						<i class="fa fa-facebook"></i>
						<ul>
							<li>
								<strong>256k</strong>
								<span>friends</span>
							</li>
							<li>
								<strong>359</strong>
								<span>feeds</span>
							</li>
						</ul>
					</div><!--/social-box-->			
					
				</div><!--/col-->
				
				<div class="col-md-3">
					
					<div class="social-box twitter">
						<i class="fa fa-twitter"></i>
						<ul>
							<li>
								<strong>1562k</strong>
								<span>followers</span>
							</li>
							<li>
								<strong>2562</strong>
								<span>tweets</span>
							</li>
						</ul>
					</div><!--/social-box-->			
					
				</div><!--/col-->
				
				<div class="col-md-3">
					
					<div class="social-box linkedin">
						<i class="fa fa-linkedin"></i>
						<ul>
							<li>
								<strong>8926</strong>
								<span>contacts</span>
							</li>
							<li>
								<strong>6253</strong>
								<span>feeds</span>
							</li>
						</ul>
					</div><!--/social-box-->			
					
				</div><!--/col-->
				
				<div class="col-md-3">
					
					<div class="social-box google-plus">
						<i class="fa fa-google-plus"></i>
						<ul>
							<li>
								<strong>962</strong>
								<span>followers</span>
							</li>
							<li>
								<strong>256</strong>
								<span>circles</span>
							</li>
						</ul>
					</div><!--/social-box-->			
					
				</div><!--/col-->
					
			</div><!--/row--> 
					
		</div>
		<!-- end: Content -->
		<br><br><br>
		
		
		<div id="usage">
			<ul>
				<li>
					<div class="title">Memory</div>
					<div class="bar">
						<div class="progress">
						  	<div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%"></div>
						</div>
					</div>			
					<div class="desc">4GB of 8GB</div>
				</li>
				<li>
					<div class="title">HDD</div>
					<div class="bar">
						<div class="progress">
						  	<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="width: 25%"></div>
						</div>
					</div>			
					<div class="desc">250GB of 1TB</div>
				</li>
				<li>
					<div class="title">SSD</div>
					<div class="bar">
						<div class="progress">
					  		<div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%"></div>
						</div>
					</div>			
					<div class="desc">700GB of 1TB</div>
				</li>
				<li>
					<div class="title">Bandwidth</div>
					<div class="bar">
						<div class="progress">
					  		<div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100" style="width: 90%"></div>
						</div>
					</div>			
					<div class="desc">90TB of 100TB</div>
				</li>				
			</ul>	
		</div>			
		
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