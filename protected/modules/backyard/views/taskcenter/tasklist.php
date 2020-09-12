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
            		<h3 class="page-header"><i class="fa fa-laptop"></i> 平台任务列表</h3>
            		<ol class="breadcrumb">
            			<li><i class="fa fa-home"></i><a href="<?php  echo $this->createUrl('default/index');?>">首页</a></li>
            			<li><i class="fa fa-laptop"></i>平台任务管理</li>					  	
            		</ol>
            	</div>
            </div>
            <form onsubmit="return checkForm()" method="get" action="<?php echo $this->createUrl("taskcenter/tasklist")?>">
                <input name="act_start_time" type="text" class="text-box" value="<?php echo isset($_GET['act_start_time'])?$_GET['act_start_time']:"";?>" placeholder="开始时间" title="开始时间" readonly="readonly" style="cursor:pointer;"/>&nbsp;-&nbsp;
                <input name="act_stop_time" type="text" class="text-box" value="<?php echo isset($_GET['act_start_time'])?$_GET['act_stop_time']:"";?>" placeholder="结束时间" title="结束时间" readonly="readonly" style="cursor:pointer;"/>&nbsp;-&nbsp;
                <select name="status" class="text-box" style="height: 32px; line-height:30px; color:red; position: relative; top: 1px;">
                    <option value="8">不限制</option>
                    <option value="0" <?php echo @$_GET['status']==0 && isset($_GET['status'])?"selected='selected'":"";?>>等待威客接手</option>
                    <option value="1" <?php echo @$_GET['status']==1?"selected='selected'":"";?>>等待商家审核</option>
                    <option value="2" <?php echo @$_GET['status']==2?"selected='selected'":"";?>>等待威客付款</option>
                    <option value="3" <?php echo @$_GET['status']==3?"selected='selected'":"";?>>等待商家发货</option>
                    <option value="4" <?php echo @$_GET['status']==4?"selected='selected'":"";?>>等待威客收货好评</option>
                    <option value="5" <?php echo @$_GET['status']==5?"selected='selected'":"";?>>等待商家确认完成</option>
                </select>
                <input class="text-box" name="taskNumber" id="taskNumber" placeholder="任务编号" style="height: 32px; line-height:30px; " value="" />
                <input class="text-box" name="Username" id="Username" placeholder="用户名" style="height: 32px; line-height:30px; " />
                <button type="submit" class="btn btn-sm btn-success" border="0" id="reg_submit" style="position:relative; top:-1px;"><i class="fa fa-dot-circle-o"></i>&nbsp;确认搜索</button>
            </form>
            <br />
            <div class="panel panel-default"><!--theBody start-->
                <div class="panel-heading">
                    <i class="fa fa-indent red"></i>
                    <span>平台任务列表</span>
                    
                    <div class="panel-actions">
    					<button class="btn btn-default"><span class="fa fa-refresh"></span></button>
    				</div>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>任务编号</th>
                                <th>发布人信息</th>
                                <th>威客信息</th>
                                <th>发布时间</th>
                                <th>商品价格</th>
                                <th>消耗豆豆</th>
                                <th>任务状态</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php
                            foreach($proInfo as $item){
                                $publishInfo=User::model()->findByPk($item->publishid);//发布人信息
                                $taskerInfo=User::model()->findByPk($item->taskerid);//接手信息
                        ?>
                            <tr>
                                <td><?php echo $item->time.'*'.$item->id;?></td>
                                <td>
                                    <?php
									    if($publishInfo){
											echo '会员名'.$publishInfo->Username.'&nbsp;&nbsp;&nbsp;&nbsp;姓名：'.$publishInfo->TrueName;
										}else{
											echo '发布者不存在或者发布者账号已删除';
										}
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        if($taskerInfo)
                                            echo '会员名'.$taskerInfo->Username.'&nbsp;&nbsp;&nbsp;&nbsp;姓名：'.$taskerInfo->TrueName;
                                        else
                                            echo " 暂无接手";
                                    ?>
                                </td>
                                <td>
                                    <?php
                                        echo date('Y-m-d H:i:s',$item->time);
                                    ?>
                                </td>
                                <td><span style="font-size: 14px; font-weight:bold; color:red;"><?php echo $item->txtPrice;?></span>&nbsp;&nbsp;元</td>
                                <td><span style="font-size: 14px; font-weight:bold; color:red;"><?php echo $item->MinLi;?></span>&nbsp;&nbsp;个</td>
                                <td>
                                    <?php
                                        if($item->taskCompleteStatus==1)
                                        {
                                            echo "<span style='color:green; font-weight:bold;'>任务已完成</span>";
                                        }
                                        else
                                        {
                                            switch($item->status)
                                            {
                                                case 0:
												    if($item->endtime >= time() or $item->endtime==0){
														echo "等待威客接手";
													}else{
														echo "已过期";
													}
                                                    break;
                                                case 1:
                                                    echo "等待商家审核";
                                                    break;
                                                case 2:
                                                    echo "等待威客付款";
                                                    break;
                                                case 3:
                                                    echo "等待商家发货";
                                                    break;
                                                case 4:
                                                    echo "等待威客收货好评";
                                                    break;
                                                case 5:
                                                    echo "等待商家确认完成";
                                                    break;
                                                case 6:
                                                    echo "任务暂停";
                                                    break;
                                                
                                            }
                                        }
                                    ?>
                                </td>
                                <td>
                                    <a class="taskDetail" alt="<?php echo $item->id;?>" href="javascript:;">查看详情</a>　
                                    <a onclick="if(confirm('您确定要删除吗？删除后将无法恢复')) return true; else return false;" href="<?php echo $this->createUrl('taskcenter/taskdel',array('id'=>$item->id));?>">删除</a>
                                </td>
                            </tr>
                        <?php }?>
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
    
    <!--日期选择器-->
    <script type="text/javascript" src="<?php echo ASSET_URL;?>/datapicker/js/jquery-1.11.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo ASSET_URL;?>/datapicker/css/jquery-ui.css" />
    <script type="text/javascript" src="<?php echo ASSET_URL;?>/datapicker/js/jquery-ui-1.10.4.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo ASSET_URL;?>/datapicker/js/jquery.ui.datepicker-zh-CN.js"></script>
    <script type="text/javascript" src="<?php echo ASSET_URL;?>/datapicker/js/jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript" src="<?php echo ASSET_URL;?>/datapicker/js/jquery-ui-timepicker-zh-CN.js"></script>
    <style type="text/css">
    body{font:12px/21px "microsoft yahei";color:#404040;background-position:center 31px;background-repeat:no-repeat;}
    .ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
    .ui-timepicker-div dl { text-align: left; }
    .ui-timepicker-div dl dt { float: left; clear:left; padding: 0 0 0 5px; }
    .ui-timepicker-div dl dd { margin: 0 10px 10px 45%; }
    .ui-timepicker-div td { font-size: 90%; }
    .ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }
    
    .ui-timepicker-rtl{ direction: rtl; }
    .ui-timepicker-rtl dl { text-align: right; padding: 0 5px 0 0; }
    .ui-timepicker-rtl dl dt{ float: right; clear: right; }
    .ui-timepicker-rtl dl dd { margin: 0 45% 10px 10px; }
    .text-box{ text-align: center;}
    </style>
    <!--layer插件-->
    <script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>
    <script src="<?php echo ASSET_URL;?>layer/layer.js"></script>
    <script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>
    <link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript">
	   $( "input[name='act_start_time'],input[name='act_stop_time']" ).datetimepicker();
    </script>
    <script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>
    <script>
        function checkForm()
        {
            if($("#taskNumber").val()!="")
            {
                var numberArr=$("#taskNumber").val().split('*');
                if(numberArr.length>1)
                    return true;
                else
                {
                    alert("任务编号格式不正确");
                    $("#taskNumber").val("");
                    return false;
                } 
            }
        }
        
        $(function(){
            $(".taskDetail").click(function(){
                var taskid=$(this).attr("alt");
                layer.open({
                    type: 2,
                    title:'任务详情',
                    shadeClose: true,
                    shade: false,
                    move:false,
                    maxmin: true, //开启最大化最小化按钮
                    area: ['1100px','100%'],
                    skin: 'layui-layer-rim', //加上边框
                    content: ['/backyard/taskcenter/taskdetail.html?taskid='+taskid+'']
                });
            });
        })
    </script>
	
</body>
</html>