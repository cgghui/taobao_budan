<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>GOD COOL</title>
<link rel="stylesheet" href="<?php echo BACKYARD_CSS_URL;?>reset.css" type="text/css" media="screen" />
<!-- Main Stylesheet -->
<link rel="stylesheet" href="<?php echo BACKYARD_CSS_URL;?>style.css" type="text/css" media="screen" />
<!-- Invalid Stylesheet. This makes stuff look pretty. Remove it if you want the CSS completely valid -->
<link rel="stylesheet" href="<?php echo BACKYARD_CSS_URL;?>invalid.css" type="text/css" media="screen" />
<!--                       Javascripts                       -->
<!-- jQuery -->
<script type="text/javascript" src="<?php echo BACKYARD_JS_URL;?>jquery-1.3.2.min.js"></script>
<!-- jQuery Configuration -->
<script type="text/javascript" src="<?php echo BACKYARD_JS_URL;?>simpla.jquery.configuration.js"></script>
</head>
<body>
<div id="body-wrapper">
  <!-- Wrapper for the radial gradient background -->
  <?php
    $this->renderPartial("/leftmenu/menu");
  ?>
  <div id="main-content">
    <!-- End .clear -->
    <div class="content-box">
      <!-- Start Content Box -->
      <div class="content-box-header">
        <h3 style="width: 450px;">刷手申请代付列表</h3>
        <ul class="content-box-tabs">
          <li><a href="#tab1" class="default-tab">申请代付列表</a></li>
          <!-- href must be unique and match the id of target div -->
        </ul>
        <div class="clear"></div>
      </div>
      <!-- End .content-box-header -->
      <div class="content-box-content">
        <div class="tab-content default-tab" id="tab1">
          <!-- This is the target div. id must match the href of this div's tab -->
          <div class="notification information png_bg"> <a href="#" class="close"><img src="<?php echo BACKYARD_IMG_URL;?>icons/cross_grey_small.png" title="Close this notification" alt="close" /></a>
            <div>这里展现了申请平台代付的列表，希望能够方便您的浏览</div>
          </div>
          <!--添加内容部分开始-->
            <style>
            .breakpage{ text-align: center;}
            .breakpage ul li{ height: 30px; display:inline; line-height: 30px;}
            .breakpage a{ display:inline; text-decoration: none; font-size: 6px; background:none; padding: 0 5px; font-size:12px; color: #666;}
            .selected{ color: #000; font-weight: bold; font-size:14px;}
            .selected{ font-size:14px;}
            </style>
            <div class="mainRight"><!--mainRight start-->
                    <div class="mainRightCon"><!--mainRightCon start-->
                        <div class="introduce">
                            <span>平台代付列表</span>
                        </div><br />
                        <div class="clear"></div>
                        <div class="theBody"><!--theBody start-->
                            <table style=" width:100%; line-height:34px; color:#666;">
                                <tr style="border-top:1px solid #afdbe9; border-bottom:1px solid #afdbe9; background:url(<?php echo YOU_IMG_URL;?>fieldbg.jpg) repeat-x; font-size:14px; color:#666;">
                                    <td width="18%"><span style="padding-left:15px;">任务编号</span></td>
                                    <td width="12%">发布人QQ</td>
                                    <td width="10%">任务价格</td>
                                    <td width="20%">申请时间</td>
                                    <td width="10%">申请人</td>
                                    <td width="22%" style="text-align: center;">我的任务提示</td>
                                    <td width="16%" style="text-align: center;">操作</td>
                                </tr>
                                
                                <?php
                                    foreach($proInfo as $item){
                                        $taskInfo=Companytasklist::model()->findByPk($item->taskid);
                                ?>
                                <tr class="taskRecord" style="line-height:22px;">
                                    <td>
                                        <span style="padding-left:15px;"><strong>TB<?php echo date("His",$taskInfo->time)."-".$item->id;?></strong><br />　 <font style="color:#7c7366;">publish time： <?php echo date("H:i:s",$taskInfo->time);?></font></span>
                                    </td>
                                    <td>
                                        QQ:<?php echo $taskInfo->qq;?><br /><a target="_blank" href="tencent://message/?uin=<?php echo $taskInfo->qq;?>"><img border="0" src="http://wpa.qq.com/pa?p=2:<?php echo $taskInfo->qq;?>:8" alt="点这里给我发消息" /></a><br /><font style="color:#3390db">点击联系商家</font>
                                    </td>
                                    <td>
                                        <span style="color:red; font-weight:bold;"><?php echo $item->productprice;?>.00</span>
                                    </td>
                                    <td>
                                        <font style="color:green;">
                                        <?php
                                            echo date("Y-m-d H:i:s",$item->dftime);
                                        ?>
                                        </font>
                                    </td>
                                    <td>
                                        <font style="color:red; font-weight:bold;">
                                            <?php
                                                $userinfo=Personrealname::model()->find(array(
                                                    'condition'=>'userid='.$item->userid
                                                ));
                                                echo $userinfo->realname;
                                            ?>
                                        </font>
                                    </td>
                                    <td style="text-align: center;">
                                        <?php
                                            
                                            
                                            if($item->dfcomplete==1)
                                            {
                                                echo "代付成功，";
                                            }
                                            else{
                                                echo "未完成";
                                            }
                                        ?>
                                    </td>
                                    <td style="text-align: center;">
                                       <?php
                                            if($item->dfcomplete==0)
                                            {
                                        ?>
                                        <a onclick="if(confirm('您确认该任务已经完成代付吗？')) return true; else return false;" href="<?php echo $this->createUrl('moneyman/DFOK',array('id'=>$item->id));?>" style="color:blue">点击完成代付</a>
                                        <?php
                                            }else{
                                                echo "完成代付";
                                            }
                                        ?>
                                    </td>
                                </tr>
                                <?php }?>
                            </table>
                            <div class="breakpage"><!--分页开始-->
                                <?php
                                    $this->widget('CLinkPager', array(
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
                    </div><!--mainRightCon end-->
            </div><!--mainRight end-->
          <!--添加内容部分结束-->
        </div>
        <!-- End #tab1 -->
      </div>
      <!-- End .content-box-content -->
    </div>
    <!-- End .content-box -->
    <div id="footer"> <small>
      <!-- Remove this notice or replace it with whatever you want -->
      CopyRight &copy; 2014-2018 版权所有 | <a href="#">Top</a> </small> </div>
    <!-- End #footer -->
  </div>
  <!-- End #main-content -->
</div>
</body>
<!-- Download From www.exet.tk-->
</html>
