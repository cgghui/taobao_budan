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
            		<h3 class="page-header"><i class="fa fa-laptop"></i> 用户提现中心</h3>
            		<ol class="breadcrumb">
            			<li><i class="fa fa-home"></i><a href="<?php  echo $this->createUrl('default/index');?>">首页</a></li>
            			<li><i class="fa fa-laptop"></i>用户充值、提现</li>						  	
            		</ol>
            	</div>
            </div>
            <div class="panel panel-default"><!--theBody start-->
                <div class="panel-heading">
                    <i class="fa fa-indent red"></i>
                    <span>用户提现管理</span>
                    <div class="panel-actions">
    					<button class="btn btn-default"><span class="fa fa-refresh"></span></button>
    				</div>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID号</th>
                                <th><div align="center">用户id</div></th>
                                <th><div align="center">手机号</div></th>
                                <th><div align="center" style="color: red;">是否异常</div></th>
                                <th><div align="center">提现银行卡号</div></th>
								<th><div align="center">收款人姓名</div></th>
								<th><div align="center">提现银行</div></th>
								<th><div align="center">提现金额</div></th>
								<th><div align="center">收款人状态</div></th>
                                <th><div align="center">提现状态</div></th>
                                <th><div align="center">申请时间</div></th>
                                <th><div align="center">操作</div></th>
                            </tr>
                        </thead>
                        <?php
                            foreach($proInfo as $item){
                                $userinfo=User::model()->findByPk($item->userid);
                                $bankInfo=Banklist::model()->findByPk($item->bankid);
								$bankarr=array(
								    '2'=>'中国工商银行',
									'3'=>'中国银行',
									'4'=>'中国建设银行',
									'5'=>'中国招商银行',
									'6'=>'中国交通银行',
									'7'=>'中国农业银行',
									'8'=>'中国邮政银行',
									'9'=>'浦东银行',
									'10'=>'广发银行',
									'11'=>'兴业银行',
									'12'=>'华夏银行',
									'13'=>'光大银行',
									'14'=>'民生银行',
									'15'=>'支付宝',
								);
                        ?>
                            <tr>
                                <td><?php echo $item->id;?></td>
                                <td><div align="center"><?php echo $item->userid;?></div></td>
                                <td><div align="center"><?php echo @$userinfo->Phon;?></div></td>
                                <td><div align="center">
                                    <a href="<?php echo $this->createUrl('moneyman/userDetail',array('uid'=>$item->userid));?>">明细</a>
									<br />
									<?php
                                        if($userinfo->Money>500)
                                            echo "<span style='color:red; font-weight:bold;'>帐户异常<br><font style='color:#666;'>余额</font>：".$userinfo->Money."元</span>";
                                    ?>
                                    
                                </td>
                                <td><div align="center">
                                    <div class="bankItembak" lang="<?php echo $bankInfo->id;?>">
                                        <div class="bankCount1bak"><?php echo $bankInfo->bankAccount;?></div>
                                    </div>
                                </div></td>
								<td><div align="center">
                                    <?php echo @$bankInfo->truename;?>
                                </div></td>
								<td><div align="center">
                                    <div class="bankItembak" lang="<?php echo $bankInfo->id;?>">
                                        <?php echo $bankarr[$bankInfo->bankCatalog];?>
                                    </div>
                                </div></td>
								<td><div align="center"><font style="color:red; font-size:14px; foint-weight:bold;"><?php echo $item->number;?></font></div></td>
								<td><div align="center">
                                    <?php
                                    echo $userinfo->Status==0?"<span style='color:green; font-weight:bold;'>正常</span><a href='".$this->createUrl('membercenter/stopaccount',array('userid'=>$item->userid))."' style='padding-left:10px;'>冻结</a>":"<font style='color:red; font-weight:bold; margin-right:10px;'>已冻结</font><a href='".$this->createUrl('membercenter/startaccount',array('userid'=>$item->userid))."' style=''>解冻</a>";
                                ?>
                                </div></td>
                                
                                <td><div align="center">
                                    <?php
                                        switch($item->txStatus)
                                        {
                                            case 1:
                                                echo "<span style='color:red; font-weight;bold;'>申请中</span>";
                                                break;
                                            case 2:
                                                echo "<span style='color:green; font-weight:bold;'>提现成功</span>";
                                                break;
                                            case 3:
                                                echo "<span style='color:red; font-weight:bold;'>提现异常</span>";
                                                break;
                                        }
                                    ?>
                                </div></td>
                                <td><div align="center"><?php echo date('Y年m月d日 H:i:s',$item->time);?></div></td>
                                <td>
                                    <div align="center">
                                        <?php
                                            if($item->txStatus==1 || $item->txStatus==3){
                                        ?>
                                        <a href="<?php echo $this->createUrl('moneyman/txlist',array('txid'=>$item->id,'txStatus'=>2));?>">提现成功</a>&nbsp;&nbsp;
                                        <a href="<?php echo $this->createUrl('moneyman/txlist',array('txid'=>$item->id,'txStatus'=>3));?>">提现异常</a>
                                        <?php }else{?>
                                        <a style="text-decoration: none; color:green; font-weight:bold;">提现结束</a>
                                        <?php }?>
                                    </div></td>
                            </tr>
                        <?php
                            }
                        ?>
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
	<style>
        .bankItem{ width:146px; height:46px; margin:0 auto; position: relative; cursor: pointer;}
        span.bankItem{ width:auto; border:none;}
        .bankDel{ position:absolute; width:auto; color:red; left:0; bottom:0; font-size:14px; font-weight:bold; cursor: pointer;}
        .bankCount{ position: absolute; width:auto; height:18px; line-height:18px; left:10; bottom:0; color:red; font-size:12px;}
        .selectBank{ position: absolute; width:auto; right:0; bottom:0; display: none;}
        .bankItemSelect{ border-color:#3792c6;}
        .certainMoney{ margin-top: 15px;}
        .sendTxMoney{ width:147px; height:45px; line-height:45px; border: 1px solid #ee3333; text-align: center; border-radius: 5px; margin:20px 90px; cursor: pointer;}
        .sendTxMoney a{ color:#ee3333; display: block;}
        .sendTxMoney a:hover{ background:#ff0000; color:#fff;}
        .addNewBank{ width:60px; float:left; cursor: pointer;}
        .bankItemBefore{ width:auto; height:56px; float:left; margin-right:10px;}
    </style>
</body>
</html>