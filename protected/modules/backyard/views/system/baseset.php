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
            		<h3 class="page-header"><i class="fa fa-laptop"></i> 系统基本参数</h3>
            		<ol class="breadcrumb">
            			<li><i class="fa fa-home"></i><a href="<?php  echo $this->createUrl('default/index');?>">首页</a></li>
            			<li><i class="fa fa-laptop"></i>系统基本参数设置</li>						  	
            		</ol>
            	</div>
            </div>
            <div class="mainRightCon"><!--mainRightCon start-->
                <div class="panel panel-default"><!--theBody start-->
                <div class="panel-heading">
                    <i class="fa fa-indent red"></i>
                    <span>系统基本参数</span>
                    <div class="panel-actions">
    					<button class="btn btn-default"><span class="fa fa-refresh"></span></button>
    				</div>
                </div>
                <style>
                    .answer{ position: relative; top:2px; left:10px;}
                </style>
                <?php
                    $webtitle=System::model()->findByAttributes(array("varname"=>"webtitle"));
                    $webkeywords=System::model()->findByAttributes(array("varname"=>"webkeywords"));
                    $webdes=System::model()->findByAttributes(array("varname"=>"webdes"));
                    $registneedToKnow=System::model()->findByAttributes(array("varname"=>"registneedToKnow"));
                    
                    $jdfsMinLi=System::model()->findByAttributes(array("varname"=>"jdfsMinLi"));
                    $ltMinLi=System::model()->findByAttributes(array("varname"=>"ltMinLi"));
                    $gwscMinLi=System::model()->findByAttributes(array("varname"=>"gwscMinLi"));
                    $phoneMinLi=System::model()->findByAttributes(array("varname"=>"phoneMinLi"));
                    $wwshMinLi=System::model()->findByAttributes(array("varname"=>"wwshMinLi"));
                    $llddMinLi=System::model()->findByAttributes(array("varname"=>"llddMinLi"));
                    $hpMinLi=System::model()->findByAttributes(array("varname"=>"hpMinLi"));
                    $tlsjoneMinLi=System::model()->findByAttributes(array("varname"=>"tlsjoneMinLi"));
                    $tlsjtwoMinLi=System::model()->findByAttributes(array("varname"=>"tlsjtwoMinLi"));
                    $tlsjthreeMinLi=System::model()->findByAttributes(array("varname"=>"tlsjthreeMinLi"));
                    $hpnrMinLi=System::model()->findByAttributes(array("varname"=>"hpnrMinLi"));
                    $shjsMinLin=System::model()->findByAttributes(array("varname"=>"shjsMinLin"));
                    $smrzMinLi=System::model()->findByAttributes(array("varname"=>"smrzMinLi"));
                    $sbyhMinLi=System::model()->findByAttributes(array("varname"=>"sbyhMinLi"));
                    $xzjsoneMinLi=System::model()->findByAttributes(array("varname"=>"xzjsoneMinLi"));
                    $xzjstwoMinLi=System::model()->findByAttributes(array("varname"=>"xzjstwoMinLi"));
                    $xzjsthreeMinLi=System::model()->findByAttributes(array("varname"=>"xzjsthreeMinLi"));
                    $zddqMinLi=System::model()->findByAttributes(array("varname"=>"zddqMinLi"));
                    
                    $xzdj1MinLi=System::model()->findByAttributes(array("varname"=>"xzdj1MinLi"));
                    $xzdj2MinLi=System::model()->findByAttributes(array("varname"=>"xzdj2MinLi"));
                    $xzdj3MinLi=System::model()->findByAttributes(array("varname"=>"xzdj3MinLi"));
                    $xzdj4MinLi=System::model()->findByAttributes(array("varname"=>"xzdj4MinLi"));
                    $xzdj5MinLi=System::model()->findByAttributes(array("varname"=>"xzdj5MinLi"));
                    $xzdj6MinLi=System::model()->findByAttributes(array("varname"=>"xzdj6MinLi"));
                    $xzdj7MinLi=System::model()->findByAttributes(array("varname"=>"xzdj7MinLi"));
                    $xzdj8MinLi=System::model()->findByAttributes(array("varname"=>"xzdj8MinLi"));
                    $xzdj9MinLi=System::model()->findByAttributes(array("varname"=>"xzdj9MinLi"));
                    $xzdj10MinLi=System::model()->findByAttributes(array("varname"=>"xzdj10MinLi"));
                    $gljsMinLi=System::model()->findByAttributes(array("varname"=>"gljsMinLi"));
                    $zsqsMinLi=System::model()->findByAttributes(array("varname"=>"zsqsMinLi"));
                    $shdzMinLi=System::model()->findByAttributes(array("varname"=>"shdzMinLi"));
                    $buyMinLiPrice=System::model()->findByAttributes(array("varname"=>"buyMinLiPrice"));
					
					$appendMinLi=System::model()->findByAttributes(array("varname"=>"appendMinLi"));
					$gaijiaMinLi=System::model()->findByAttributes(array("varname"=>"gaijiaMinLi"));
					$sxtcMoney=System::model()->findByAttributes(array("varname"=>"sxtcMoney"));
                    
                    $backMinLiPriceVIP0=System::model()->findByAttributes(array("varname"=>"backMinLiPriceVIP0"));
                    $backMinLiPriceVIP1=System::model()->findByAttributes(array("varname"=>"backMinLiPriceVIP1"));
                    $backMinLiPriceVIP2=System::model()->findByAttributes(array("varname"=>"backMinLiPriceVIP2"));
                    $backMinLiPriceVIP3=System::model()->findByAttributes(array("varname"=>"backMinLiPriceVIP3"));
                    
                    $VIP1price1month=System::model()->findByAttributes(array("varname"=>"VIP1price1month"));
                    $VIP1price3month=System::model()->findByAttributes(array("varname"=>"VIP1price3month"));
                    $VIP1price6month=System::model()->findByAttributes(array("varname"=>"VIP1price6month"));
                    $VIP1price12month=System::model()->findByAttributes(array("varname"=>"VIP1price12month"));
                    
                    $VIP2price1month=System::model()->findByAttributes(array("varname"=>"VIP2price1month"));
                    $VIP2price3month=System::model()->findByAttributes(array("varname"=>"VIP2price3month"));
                    $VIP2price6month=System::model()->findByAttributes(array("varname"=>"VIP2price6month"));
                    $VIP2price12month=System::model()->findByAttributes(array("varname"=>"VIP2price12month"));
                    
                    $VIP3price1month=System::model()->findByAttributes(array("varname"=>"VIP3price1month"));
                    $VIP3price3month=System::model()->findByAttributes(array("varname"=>"VIP3price3month"));
                    $VIP3price6month=System::model()->findByAttributes(array("varname"=>"VIP3price6month"));
                    $VIP3price12month=System::model()->findByAttributes(array("varname"=>"VIP3price12month"));
                    $taskMinliToPlatform=System::model()->findByAttributes(array("varname"=>"taskMinliToPlatform"));
                    $taskMinliToPlatformVIP1=System::model()->findByAttributes(array("varname"=>"taskMinliToPlatformVIP1"));
                    $taskMinliToPlatformVIP2=System::model()->findByAttributes(array("varname"=>"taskMinliToPlatformVIP2"));
                    $taskMinliToPlatformVIP3=System::model()->findByAttributes(array("varname"=>"taskMinliToPlatformVIP3"));
                    
                    $spreadPrice=System::model()->findByAttributes(array("varname"=>"spreadPrice"));
                    $copyright=System::model()->findByAttributes(array("varname"=>"copyright"));
                    $reglock=System::model()->findByAttributes(array("varname"=>"reglock"));
                    $authperson=System::model()->findByAttributes(array("varname"=>"authperson"));
                    
                    $lgoods1=System::model()->findByAttributes(array("varname"=>"lgoods1"));
                    $lgoods2=System::model()->findByAttributes(array("varname"=>"lgoods2"));
                    
                    $contrast1=System::model()->findByAttributes(array("varname"=>"contrast1"));
                    $contrast2=System::model()->findByAttributes(array("varname"=>"contrast2"));
                    $contrast3=System::model()->findByAttributes(array("varname"=>"contrast3"));
					
					$taskUpMoney=System::model()->findByAttributes(array("varname"=>"taskUpMoney"));
					$taskUpSmsMoney=System::model()->findByAttributes(array("varname"=>"taskUpSmsMoney"));
                    
                ?>
                <div class="panel-body">
                    <div class="form-group">
                        <form method="post" action="<?php echo $this->createUrl('system/baseset');?>" class="form-horizontal">
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width: auto;">网站名称　</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="webtitle" id="input-small" name="input-small" class="form-control input-sm" value="<?php echo $webtitle->value;?>"/>
    		                    </div>
                            </div><br /><br />
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width: auto;">网站关键词</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="webkeywords" id="input-small" name="input-small" class="form-control input-sm" style="width: 600px;" value="<?php echo $webkeywords->value;?>"/>
    		                    </div>
                            </div><br /><br />
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width: auto;">网站描述　</label>
                                <div class="col-sm-3" style="height: 100px;">
    		                        <textarea name="webdes" id="input-small" name="input-small" class="form-control input-sm" style="width: 600px; height:100px;"><?php echo $webdes->value;?></textarea>
    		                    </div>
                            </div><br /><br /><br /><br /><br /><br />
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width: auto;">版权说明　</label>
                                <div class="col-sm-3" style="height: 100px;">
    		                        <textarea name="copyright" id="input-small" name="input-small" class="form-control input-sm" style="width: 600px; height:100px;"><?php echo $copyright->value;?></textarea>
    		                    </div>
                            </div><br /><br /><br /><br /><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width: auto;">注册协议　</label>
                                <div class="col-sm-3">
    		                        <textarea name="registneedToKnow" id="input-small" name="input-small" class="form-control input-sm" style="width: 600px; height:100px"><?php echo $registneedToKnow->value;?></textarea>
    		                    </div>
                            </div><br /><br /><br /><br /><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">新会员冻结　　　</label>
                                <div class="col-sm-3" style="position: relative; left:-36px; top:5px;">
    		                        <select name="reglock">
                                        <?php
                                            if($reglock->value==0)
                                            {
                                        ?>
                                                <option value="0">否</option>
                                                <option value="1">是</option>
                                        <?php }else{?>
                                                <option value="1">是</option>
                                                <option value="0">否</option>
                                        <?php }?>
                                    </select><span style="padding-left: 10px; color:red;">新注册会员是否为冻结锁定状态</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">威客实名认证　　　</label>
                                <div class="col-sm-3" style="position: relative; left:-48px; top:5px;">
    		                        <select name="authperson">
                                        <?php
                                            if($authperson->value==0)
                                            {
                                        ?>
                                                <option value="0">否</option>
                                                <option value="1">是</option>
                                        <?php }else{?>
                                                <option value="1">是</option>
                                                <option value="0">否</option>
                                        <?php }?>
                                    </select><span style="padding-left: 10px; color:red;">是否要求威客绑定买号前实名认证</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">聊天　　　</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="ltMinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $ltMinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">购物收藏　</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="gwscMinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $gwscMinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">手机订单　</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="phoneMinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $phoneMinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">旺旺收货　</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="wwshMinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $wwshMinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">浏览到底　</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="llddMinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $llddMinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">好评截图　</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="hpMinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $hpMinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">浏览商品　</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="lgoods1" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $lgoods1->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆（浏览1件商品）</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">浏览商品　</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="lgoods2" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $lgoods2->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆（浏览2件商品）</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">货比商家　</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="contrast1" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $contrast1->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆（货比1家）</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">货比商家　</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="contrast2" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $contrast2->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆（货比2家）</span>
    		                    </div>
                            </div><br /><br />
                            
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">货比商家　</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="contrast3" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $contrast3->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆（货比3家）</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">停留时间　</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="tlsjoneMinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $tlsjoneMinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆（1分钟）</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">停留时间　</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="tlsjtwoMinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $tlsjtwoMinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆（2分钟）</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">停留时间　</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="tlsjthreeMinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $tlsjthreeMinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆（3分钟）</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">指定好评　</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="hpnrMinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $hpnrMinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">审核接手　</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="shjsMinLin" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $shjsMinLin->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">实名认证　</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="smrzMinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $smrzMinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">商保用户　</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="sbyhMinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $sbyhMinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆</span>
    		                    </div>
                            </div><br /><br />
                            
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">限制接手　</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="xzjsoneMinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $xzjsoneMinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆（1天接1单）</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">限制接手　</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="xzjstwoMinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $xzjstwoMinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆（1天接2单）</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">限制接手　</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="xzjsthreeMinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $xzjsthreeMinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆（1周接1单）</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">指定地区　</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="zddqMinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $zddqMinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆（1周接1单）</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">限制等级　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="xzdj1MinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $xzdj1MinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆（淘宝一心会员，京东注册会员）</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">限制等级　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="xzdj2MinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $xzdj2MinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆（淘宝二心会员，京东铜牌会员）</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">限制等级　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="xzdj3MinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $xzdj3MinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆（淘宝三心会员，京东银牌会员）</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">限制等级　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="xzdj4MinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $xzdj4MinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆（淘宝四心会员，京东金牌会员）</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">限制等级　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="xzdj5MinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $xzdj5MinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆（淘宝五心会员，京东钻石会员）</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">限制等级　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="xzdj6MinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $xzdj6MinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆（淘宝一钻会员）</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">限制等级　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="xzdj7MinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $xzdj7MinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆（淘宝二钻会员）</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">限制等级　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="xzdj8MinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $xzdj8MinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆（淘宝三钻会员）</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">限制等级　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="xzdj9MinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $xzdj9MinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆（淘宝四钻会员）</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">限制等级　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="xzdj10MinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $xzdj10MinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆（淘宝五钻会员）</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">过滤接手　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="gljsMinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $gljsMinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">真实签收　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="zsqsMinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $zsqsMinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">收货地址　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="shdzMinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $shdzMinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆</span>
    		                    </div>
                            </div><br /><br />
							
							<div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">来路搜索附加价格　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="appendMinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $appendMinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆</span>
    		                    </div>
                            </div><br /><br />
							
							<div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">改价价格　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="gaijiaMinLi" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $gaijiaMinLi->value;?>"/><span style="padding-left: 10px; color:red;">个豆豆</span>
    		                    </div>
                            </div><br /><br />
                            
							<div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto;">下线做任务时上线的提成　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="sxtcMoney" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $sxtcMoney->value;?>"/><span style="padding-left: 10px; color:red;">元</span>
    		                    </div>
                            </div><br /><br />
							
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:green;">购买VIP1价格　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="VIP1price1month" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $VIP1price1month->value;?>"/><span style="padding-left: 10px; color:red;">元/1个月</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:green;">购买VIP1价格　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="VIP1price3month" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $VIP1price3month->value;?>"/><span style="padding-left: 10px; color:red;">元/3个月</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:green;">购买VIP1价格　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="VIP1price6month" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $VIP1price6month->value;?>"/><span style="padding-left: 10px; color:red;">元/6个月</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:green;">购买VIP1价格　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="VIP1price12month" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $VIP1price12month->value;?>"/><span style="padding-left: 10px; color:red;">元/12个月</span>
    		                    </div>
                            </div><br /><br />
                            
                            <!--start-->
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:green;">购买VIP2价格　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="VIP2price1month" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $VIP2price1month->value;?>"/><span style="padding-left: 10px; color:red;">元/1个月</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:green;">购买VIP2价格　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="VIP2price3month" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $VIP2price3month->value;?>"/><span style="padding-left: 10px; color:red;">元/3个月</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:green;">购买VIP2价格　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="VIP2price6month" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $VIP2price6month->value;?>"/><span style="padding-left: 10px; color:red;">元/6个月</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:green;">购买VIP2价格　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="VIP2price12month" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $VIP2price12month->value;?>"/><span style="padding-left: 10px; color:red;">元/12个月</span>
    		                    </div>
                            </div><br /><br />
                            <!--end-->
                            
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:green;">购买VIP3价格　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="VIP3price1month" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $VIP3price1month->value;?>"/><span style="padding-left: 10px; color:red;">元/1个月</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:green;">购买VIP3价格　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="VIP3price3month" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $VIP3price3month->value;?>"/><span style="padding-left: 10px; color:red;">元/3个月</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:green;">购买VIP3价格　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="VIP3price6month" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $VIP3price6month->value;?>"/><span style="padding-left: 10px; color:red;">元/6个月</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:green;">购买VIP3价格　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="VIP3price12month" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $VIP3price12month->value;?>"/><span style="padding-left: 10px; color:red;">元/12个月</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:red;">购买豆豆价格　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="buyMinLiPrice" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $buyMinLiPrice->value;?>"/><span style="padding-left: 10px; color:red;">元1个豆豆</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:red;">回收豆豆价格　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="backMinLiPriceVIP0" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $backMinLiPriceVIP0->value;?>"/><span style="padding-left: 10px; color:red;">元1个豆豆（普通会员）</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:red;">回收豆豆价格　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="backMinLiPriceVIP1" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $backMinLiPriceVIP1->value;?>"/><span style="padding-left: 10px; color:red;">元1个豆豆（VIP1会员）</span>
    		                    </div>
                            </div><br /><br />
                            
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:red;">回收豆豆价格　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="backMinLiPriceVIP2" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $backMinLiPriceVIP2->value;?>"/><span style="padding-left: 10px; color:red;">元1个豆豆（VIP2会员）</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:red;">回收豆豆价格　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="backMinLiPriceVIP3" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $backMinLiPriceVIP3->value;?>"/><span style="padding-left: 10px; color:red;">元1个豆豆（VIP3会员）</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:orange;">任务消耗豆豆　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="taskMinliToPlatform" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $taskMinliToPlatform->value;?>"/><span style="padding-left: 10px; color:red;">% 豆豆(普通会员)</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:orange;">任务消耗豆豆　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="taskMinliToPlatformVIP1" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $taskMinliToPlatformVIP1->value;?>"/><span style="padding-left: 10px; color:red;">% 豆豆(VIP1会员)</span>
    		                    </div>
                            </div><br /><br />
                            
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:orange;">任务消耗豆豆　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="taskMinliToPlatformVIP2" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $taskMinliToPlatformVIP2->value;?>"/><span style="padding-left: 10px; color:red;">% 豆豆(VIP2会员)</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:orange;">任务消耗豆豆　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="taskMinliToPlatformVIP3" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $taskMinliToPlatformVIP3->value;?>"/><span style="padding-left: 10px; color:red;">% 豆豆(VIP3会员)</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:orange;">推广返现金额　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="spreadPrice" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $spreadPrice->value;?>"/><span style="padding-left: 10px; color:red;">元</span>
    		                    </div>
                            </div><br /><br />
							
							<div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:orange;">发布任务时需要验证短信的限额　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="taskUpMoney" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $taskUpMoney->value;?>"/><span style="padding-left: 10px; color:red;">元</span>
    		                    </div>
                            </div><br /><br />
							
							<div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width:auto; color:orange;">发布任务时的短信费用　</label>
                                <div class="col-sm-3" style="width: auto;">
    		                        <input type="text" name="taskUpSmsMoney" id="input-small" name="input-small" class="form-control input-sm" style="width: 100px; display: inline;" value="<?php echo $taskUpSmsMoney->value;?>"/><span style="padding-left: 10px; color:red;">元</span>
    		                    </div>
                            </div><br /><br />
                            
                            <div class="examItem">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-sm btn-success" border="0" id="reg_submit" style=" margin-left:87px; margin-top: 10px;"><i class="fa fa-dot-circle-o"></i>&nbsp;确认修改</button>
                                    <span style="padding-left: 30px; color:green; position: relative; top:6px;"><?php echo @$addWarning;?></span>
                                </div>
                            </div>
                        </form>
                    </div>
                 </div>
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
    <script src="<?php echo VERSION2;?>js/jquery.js"></script>
</body>
</html>
