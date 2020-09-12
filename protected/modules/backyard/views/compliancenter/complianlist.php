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
            		<h3 class="page-header"><i class="fa fa-laptop"></i> 投诉中心</h3>
            		<ol class="breadcrumb">
            			<li><i class="fa fa-home"></i><a href="<?php  echo $this->createUrl('default/index');?>">首页</a></li>
            			<li><i class="fa fa-laptop"></i>投诉管理中心</li>						  	
            		</ol>
            	</div>
            </div>
            <form method="post" action="<?php echo $this->createUrl("compliancenter/complianlist")?>">
                <input type="text" name="keyword" placeholder="投诉id号" style="text-indent: 5px; color: #666; font-size:14px; width:260px;" />　<button type="submit" class="btn btn-sm btn-success" border="0" id="reg_submit"><i class="fa fa-dot-circle-o"></i>&nbsp;搜索</button>
            </form>
            <br />
            <div class="panel panel-default"><!--theBody start-->
                <div class="panel-heading">
                    <i class="fa fa-indent red"></i>
                    <span>投诉总览</span>
                    <div class="panel-actions">
    					<button class="btn btn-default"><span class="fa fa-refresh"></span></button>
    				</div>
                </div>
                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th><div align="center">投诉人信息</div></th>
                                <th><div align="center">被投诉人信息</div></th>
                                <th><div align="center">任务id</div></th>
                                <th><div align="center">投诉原因</div></th>
                                <th><div align="center">证据</div></th>
                                <th><div align="center">投诉时间</div></th>
                                <th><div align="center">开始处理时间</div></th>
                                <th><div align="center">处理完成时间</div></th>
                                <th><div align="center">胜诉方信息</div></th>
                                <th><div align="center">处理状态</div></th>
                                <th><div align="center">仲裁</div></th>
                            </tr>
                        </thead>
                    <tbody>
                        <?php
                            foreach($proInfo as $item){
                                //任务信息
                                $taskInfo=Companytasklist::model()->findByPk($item->taskid);
                                //投诉人信息
                                $doinfo=User::model()->findByPk($item->douid);
                                //被投诉人信息
                                $uinfo=User::model()->findByPk($item->uid);
                        ?>
                        <tr style="color:#666; <?php echo $taskInfo==false?"background:#f3bc82;":"";?>">
                            <td><?php echo $item->id;?></td>
                            <td>
                                <div align="center">
                                    ID:<?php echo @$item->douid;?><br />
                                    姓名：<?php echo @$doinfo->Username;?><br />
                                    QQ：<?php echo @$doinfo->QQToken;?><br />
                                    手机：<?php echo @$doinfo->Phon;?><br />
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    ID:<?php echo @$item->uid;?><br />
                                    姓名：<?php echo @$uinfo->Username;?><br />
                                    QQ：<?php echo @$uinfo->QQToken;?><br />
                                    手机：<?php echo @$uinfo->Phon;?><br />
                                </div>
                            </td>
                            <td><div align="center"><?php echo @$taskInfo->time.'*'.$item->taskid;?></div></td>
                            <td><div align="center"><a href="javascript:;" class="lookupReason" alt="<?php echo $item->reason;?>">查看原因</a></div></td>
                            <td><div align="center"><a href="javascript:;" class="lookupReasonImg" alt="<?php echo $item->reasonImg;?>">查看证据</a></div></td>
                            <td><div align="center"><?php echo date('Y-m-d H:i:s',$item->time);?></div></td>
                            <td>
                                <div align="center">
                                    <?php
                                        if($item->handleBeginTime=="")
                                            echo "<span style='color:red;'>未处理完成</span>";
                                        else
                                            echo date('Y-m-d H:i:s',$item->handleBeginTime);
                                    ?>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <?php
                                        if($item->handleCompleteTime=="")
                                            echo "<span style='color:red;'>未开始处理</span>";
                                        else if($item->handleCompleteTime!="" && $item->status==1)
                                        {
                                            echo "<span style='color:red;'>处理中，暂未完成</span>";
                                        }
                                        else
                                            echo date('Y年m月d日 H:i:s',$item->handleCompleteTime);
                                    ?>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <?php
                                        if($item->status==2)
                                        {
                                            if($item->winid==$item->douid)
                                                echo "投诉方胜";
                                            else if($item->winid==$item->uid)
                                                echo "被投诉方胜";
                                            else
                                                echo "平手";
                                        }
                                        else
                                            echo "<span style='color:red; font-weight:bold;'>暂无结果</span>";
                                    ?>
                                </div>
                            </td>
                            <td>
                                <div align="center">
                                    <?php
                                        switch($item->status)
                                        {
                                            case 0:
                                                echo "<span style='color:red; font-weight:bold;'>等待处理</span>";
                                                break;
                                            case 1:
                                                echo "<span style='color:black; font-weight:bold;'>处理中</span>";
                                                break;
                                            case 2:
                                                echo "<span style='color:green; font-weight:bold;'>处理完成</span>";
                                        }
                                    ?>
                                </div>
                            </td>
                            <td>
                                <?php
                                    if(@$item->status==0){
                                ?>
                                    <div align="center"><a href="javascript:;" class="startHandle" lang="<?php echo @$item->id;?>">开始处理</a></div>
                                <?php
                                    }else if(@$item->status==1){
                                ?>
                                    <div align="center"><a href="javascript:;" class="completeHandle" lang="<?php echo @$item->id;?>" alt="<?php echo @$item->douid;?>" taskerid="<?php echo @$taskInfo->taskerid;?>" publishid=<?php echo @$taskInfo->publishid;?>>进行仲裁</a></div>
                                <?php
                                    }else{
                                ?>
                                    <div align="center"><span style='color:green; font-weight:bold;' lang="<?php echo @$item->id;?>">仲裁结束</span></div>
                                <?php }?>
                            </td>
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
    <script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>
    <script src="<?php echo ASSET_URL;?>layer/layer.js"></script>
    <script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>
    <link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" />
    <script>
        $(function(){
            //点击查看投诉原因
            $(".lookupReason").click(function(){
                layer.confirm('<div style="text-align:center; line-height:40px; font-size:18px; font-weight:bold;">《投诉原因》</div><div style="color:red;">'+$(this).attr("alt")+'</div>', {
                    btn: ['知道了'] //按钮
                });
            }); 
            
            //点击查看图片证据
            $(".lookupReasonImg").click(function(){
                var imgArr=$(this).attr('alt').split("@");
                if(imgArr.length==1)
                {
                    layer.tips('投诉方没有上传图片证据', '.lookupReasonImg', {
                        tips: [1, '#0FA6D8'] //还可配置颜色
                    });
                }else
                {
                    var imgStr='';//初始化图片html连接字符串
                    for(var i=0;i<imgArr.length-1;i++)//处理连接后的图片html字符串
                    {
                        imgStr=imgStr+'<img src="'+imgArr[i]+'" /><br/>';
                    }
                    layer.open({
                        type: 1,
                        title: false,
                        closeBtn: 1,
                        area: ['95%','80%'],
                        shadeClose: true,
                        content: '<div style="text-align:center;">'+imgStr+'</div>'
                    });
                }
                
                /*layer.open({
                    type: 1,
                    title: false,
                    closeBtn: 1,
                    area: ['95%','80%'],
                    shadeClose: true,
                    content: '<div style="text-align:center;"><img src="'+imgUrl+'"></div>'
                });*/
            });
            
            //开始处理投诉，改变投诉的状态为处理中
            $(".startHandle").click(function(){
               //开始处理
               $.ajax({
        			type:"POST",
        			url:"<?php echo $this->createUrl('compliancenter/startHandle');?>",
        			data:{"id":$(this).attr("lang")},
        			success:function(msg)
        			{
        				if(msg=="SUCCESS")//操作成功
                        {
                            //询问框
                        	layer.confirm('投诉状态已经变为处理中，请尽快进行仲裁', {
                        		btn: ['知道了'] //按钮
                        	},function(){
                        	    window.location.reload();
                        	});
                        }
                        else//操作失败
                        {
                            //询问框
                        	layer.confirm('操作失败，请联系相关技术人员', {
                        		btn: ['确定'] //按钮
                        	});
                        }
        			}
        		});
               //开始处理 
            });
            
            //进行仲裁
            $(".completeHandle").click(function(){
                var douid=$(this).attr("alt");//投诉人id
                var publishid=$(this).attr("publishid");//相关任务发布人id
                var taskerid=$(this).attr("taskerid");//相关任务发布人id
                var complianid=$(this).attr("lang");//投诉id号
                if(douid!=publishid)//由威客发起的投诉
                {
                    //询问框
                	layer.confirm('<div style="font-weight:bold; font-size:18px; text-align:center; line-height:45px;">《威客发起的投诉》</div><span style="color:red;">请查明投诉原因、证据等相关信息后谨慎操作，仲裁后将无法修改投诉结果!</span>', {
                		btn: ['威客胜诉','商家胜诉','取消操作'] //按钮
                	},function(){//威客胜诉
                	    //威客胜诉处理结果
                        var complianStyle=1;//由威客发起的投诉
                        $.ajax({
                			type:"POST",
                			url:"<?php echo $this->createUrl('compliancenter/endHandle');?>",
                			data:{"id":complianid,"complianStyle":complianStyle,"taskerid":taskerid},
                			success:function(msg)
                			{
                				if(msg=="SUCCESS")//操作成功
                                {
                                    //询问框
                                	layer.confirm('仲裁完成', {
                                		btn: ['知道了'] //按钮
                                	},function(){
                                	    window.location.reload();
                                	});
                                }
                                else//操作失败
                                {
                                    //询问框
                                	layer.confirm('操作失败，请联系相关技术人员', {
                                		btn: ['确定'] //按钮
                                	});
                                }
                			}
                		});
                        //威客胜诉处理结果
                	},function(){//威客败诉
                	    var complianStyle=1;//由威客发起的投诉-威客败诉
                        $.ajax({
                			type:"POST",
                			url:"<?php echo $this->createUrl('compliancenter/endHandleFail');?>",
                			data:{"id":complianid,"complianStyle":complianStyle,"publishid":publishid},
                			success:function(msg)
                			{
                				if(msg=="SUCCESS")//操作成功
                                {
                                    //询问框
                                	layer.confirm('仲裁完成', {
                                		btn: ['知道了'] //按钮
                                	},function(){
                                	    window.location.reload();
                                	});
                                }
                                else//操作失败
                                {
                                    //询问框
                                	layer.confirm('操作失败，请联系相关技术人员', {
                                		btn: ['确定'] //按钮
                                	});
                                }
                			}
                		});
                	});
                }else//由商家发起的投诉
                {
                    //询问框
                	layer.confirm('<div style="font-weight:bold; font-size:18px; text-align:center; line-height:45px;">《商家发起的投诉》</div><span style="color:red;">请查明投诉原因、证据等相关信息后谨慎操作，仲裁后将无法修改投诉结果!</span>', {
                		btn: ['商家胜诉','威客胜诉','取消操作'] //按钮
                	},function(){//商家胜诉
                	    //商家胜诉处理结果
                        var complianStyle=2;//由商家发起的投诉
                        $.ajax({
                			type:"POST",
                			url:"<?php echo $this->createUrl('compliancenter/endHandle');?>",
                			data:{"id":complianid,"complianStyle":complianStyle,"publishid":publishid},
                			success:function(msg)
                			{
                				if(msg=="SUCCESS")//操作成功
                                {
                                    //询问框
                                	layer.confirm('仲裁完成', {
                                		btn: ['知道了'] //按钮
                                	},function(){
                                	    window.location.reload();
                                	});
                                }
                                else//操作失败
                                {
                                    //询问框
                                	layer.confirm('操作失败，请联系相关技术人员', {
                                		btn: ['确定'] //按钮
                                	});
                                }
                			}
                		});
                        //商家胜诉处理结果
                	},function(){//威客胜诉
                	    var complianStyle=2;//由商家发起的投诉-威客胜诉
                        $.ajax({
                			type:"POST",
                			url:"<?php echo $this->createUrl('compliancenter/endHandleFail');?>",
                			data:{"id":complianid,"complianStyle":complianStyle,"taskerid":taskerid},
                			success:function(msg)
                			{
                				if(msg=="SUCCESS")//操作成功
                                {
                                    //询问框
                                	layer.confirm('仲裁完成', {
                                		btn: ['知道了'] //按钮
                                	},function(){
                                	    window.location.reload();
                                	});
                                }
                                else//操作失败
                                {
                                    //询问框
                                	layer.confirm('操作失败，请联系相关技术人员', {
                                		btn: ['确定'] //按钮
                                	});
                                }
                			}
                		});
                	},function(){
                	   location.reload();
                	});
                }
            });
        })
    </script>
	<style>
        .layui-layer-setwin{ display: none;}
    </style>
</body>
</html>