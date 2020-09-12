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
            		<h3 class="page-header"><i class="fa fa-laptop"></i> 新手考试管理</h3>
            		<ol class="breadcrumb">
            			<li><i class="fa fa-home"></i><a href="<?php  echo $this->createUrl('default/index');?>">首页</a></li>
            			<li><i class="fa fa-laptop"></i>平台配置管理</li>						  	
            		</ol>
            	</div>
            </div>
            <div class="mainRightCon"><!--mainRightCon start-->
                <div class="panel panel-default"><!--theBody start-->
                <div class="panel-heading">
                    <i class="fa fa-indent red"></i>
                    <span>新手考试管理</span>
                    <div class="panel-actions">
    					<button class="btn btn-default"><span class="fa fa-refresh"></span></button>
    				</div>
                </div>
                <style>
                    .answer{ position: relative; top:2px; left:10px;}
                </style>
                <div class="panel-body">
                    <div class="form-group">
                        <form method="post" action="<?php echo $this->createUrl('system/exam');?>" class="form-horizontal">
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width: auto;">考试题目</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="Question" id="input-small" name="input-small" class="form-control input-sm" placeholder="考试题目"/>
    		                    </div>
                            </div><br /><br />
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width: auto;">答案选项</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="answerA" id="input-small" name="input-small" class="form-control input-sm" placeholder="请输入答案选项"/>
    		                    </div>
                            </div><br /><br />
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width: auto;">答案选项</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="answerB" id="input-small" name="input-small" class="form-control input-sm" placeholder="请输入答案选项"/>
    		                    </div>
                            </div><br /><br />
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width: auto;">答案选项</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="answerC" id="input-small" name="input-small" class="form-control input-sm" placeholder="请输入答案选项"/>
    		                    </div>
                            </div><br /><br />
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width: auto;">答案选项</label>
                                <div class="col-sm-3">
    		                        <input type="text" name="answerD" id="input-small" name="input-small" class="form-control input-sm" placeholder="请输入答案选项"/>
    		                    </div>
                            </div><br /><br />
                            <div class="examItem">
                                <label class="col-sm-3 control-label" for="input-small" style="width: auto;">正确答案</label>
                                <div class="col-sm-3">
    		                        <input type="radio" checked="checked" value="1" name="answer" class="answer" /> 　选项1<input type="radio" value="2" name="answer" class="answer" /> 　选项2<input type="radio" value="3" name="answer" class="answer" /> 　选项3<input type="radio" value="4" name="answer" class="answer" /> 　选项4
    		                    </div>
                            </div><br /><br />
                            <div class="examItem">
                                <div class="col-sm-10">
                                    <button type="submit" class="btn btn-sm btn-success" border="0" id="reg_submit" style=" margin-left:87px; margin-top: 10px;"><i class="fa fa-dot-circle-o"></i>&nbsp;添加考题</button>
                                    <span style="padding-left: 30px; color:green; position: relative; top:6px;"><?php echo @$addWarning;?></span>
                                </div>
                            </div>
                        </form>
                    </div>
                    
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>题目</td>
                                <th>正常答案</th>
                                <th>添加时间</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                        </thead>
                        <?php
                            foreach($proInfo as $item){
                                $answer=Exam::model()->find(array(
                                    'condition'=>'q_id='.$item->id.' and answer=1'
                                ));
                        ?>
                        <tbody>
                            <tr>
                                <td><?php echo $item->text;?></td>
                                <td>
                                    <?php
                                        echo $answer->text;
                                    ?>
                                </td>
                                <td><?php echo date('Y-m-d H:i:s',$item->time);?></td>
                                <td>
                                    <?php
                                        echo $item->status==1?"使用中":"暂停中";
                                    ?>
                                </td>
                                <td><a href="<?php echo $this->createUrl('system/examDel',array('examid'=>$item->id));?>">删除</a></td>
                            </tr>
                        </tbody>
                        <?php }?>
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
	<script>
        $(function(){
            //继续封杀
            /*$(".startBlackaccount").click(function(){
                $.ajax({
        			type:"POST",
        			url:"/backyard/system/blackaccount.html",
        			data:{"doAction":"start","id":$(this).attr("alt")},
        			success:function(msg)
        			{
        				location.reload();
        			}
        		});
            });
            
            //停止封杀
            $(".stopBlackaccount").click(function(){
                $.ajax({
        			type:"POST",
        			url:"/backyard/system/blackaccount.html",
        			data:{"doAction":"stop","id":$(this).attr("alt")},
        			success:function(msg)
        			{
        				location.reload();
        			}
        		});
            });*/
        })
    </script>
</body>
</html>
