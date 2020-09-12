    <!--申诉-->
  	<div class="d_shensu">
    	<div class="d_sl clearfix">
        	<p class="d_slp">您共发起<span class="d_slspan"><?php echo $total;?></span>次投诉</p>
        </div>
        <ul class="d_faqi clearfix">
        	<li class="d_shensu" onclick="location.href='<?php echo $this->createUrl('user/userTsCenter');?>'">我发起的申诉</li>
            <li onclick="location.href='<?php echo $this->createUrl('user/userTsCenterGet');?>'">我收到的申诉</li>
        </ul>
        <div class="d_xinxi clearfix" style="width: 100%;">
            <div class="d_t" style="width: 100%;">
            <table>
                <tr class="d_xinxi_ul" style="background:#57A0FF ; width: 100%; color:#fff;">
                    <td class="d_xxli1">任务ID</td>
                    <td class="d_xxli5">胜诉情况</td>
                    <td class="d_xxli2">被投诉人</td>
                    <td class="d_xxli3">投诉原因</td>
                    <td class="d_xxli4">提交时间</td>
                    <td class="d_xxli5">申诉状态</td>
                    <td class="d_xxli6">操作</td>
                </tr>
                <?php
                    foreach($proInfo as $item){
                        $taskInfo=Companytasklist::model()->findByPk($item->taskid);
                        $userInfo=User::model()->findByPk($item->uid);
                ?>
                <tr class="d_xinxi_ul ulItem" style="border: none; font-size:14px; border-bottom: 1px dashed #99C1F5;">
                    <td class="d_xxli1"><?php echo $taskInfo->time.'*'.$item->taskid;?></td>
                    <td style="text-align: center;">
                        <?php
                            if($item->winid<>0)
                            {
                                if($item->winid==Yii::app()->user->getId())
                                    echo "<font style='color:green; font-weight:bold;'>我胜诉</font>";
                                else
                                    echo "<font style='color:red; font-weight:bold;'>对方胜诉</font>";
                            }else
                                echo "暂无结果";
                        ?>
                    </td>
                    <td class="d_xxli2">
                        <span style="color:red;">
                            <?php 
                                echo $userInfo->Username;
                            ?>
                        </span>
                    </td>
                    <td class="d_xxli3"><span style="color: #000;"><?php echo $item->reason;?></span></td>
                    <td class="d_xxli4"><?php echo date('Y-m-d H:i:s',$item->time);?></td>
                    <td class="d_xxli5">
                        <?php
                            switch($item->status)
                            {
                                case 0:
                                    echo "等待处理";
                                    break;
                                case 1:
                                    echo "<span style='color:red;'>处理中</span>";
                                    break;
                                case 2:
                                    echo "<span style='color:green;'>处理完成</span>";
                                    break;
                            }
                        ?>
                    </td>
                    <td class="d_xxli6"><a href="" style="color: #57A0FF;">查看详细</a></td>
                </tr>
                <?php }?>
                </table>
                <div class="breakpage" style="margin-bottom: 10px;"><!--分页开始-->
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
            </div>
        </div>
    </div>
    <!--申诉-->
    <style>
        .d_xinxi_ul li{ color:#fff;}
        .ulItem li{ color:#666;}
    </style>