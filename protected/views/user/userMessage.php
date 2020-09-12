        <?php
            echo $this->renderPartial('/user/usercenterTopNav')
        ?>
        <!--站内提醒-->
        <div class="d_qie8">
            <ul class="d_zhannei clearfix">
            	<li class="d_znli">官方收件箱</li>
                <li onclick="window.open('<?php echo $this->createUrl('user/userMessageWarning');?>','_self');">站内提醒</li>
            </ul>
            <div class="d_biaoti clearfix">
                 <table style="width: 100%; text-align: center; color:#666; font-size:12px; line-height:55px; margin-top:20px;">
                    <tr style="background: #57A0FF; color:#fff; height:40px; line-height:40px;">
                        <td>序列号</td>
                        <td>标题</td>
                        <td>发送人</td>
                        <td>内容</td>
                        <td>发送时间</td>
                    </tr>
                    <?php
                        $i=1;
                        foreach($proInfo as $item){
                    ?>
                        <tr>
                            <td><?php echo $i;?></td>
                            <td style="color: #57A0FF; font-size: 14px;"><?php echo $item->goods_name;?></td>
                            <td style="color: #F00; font-weight:bold;">平台管理员</td>
                            <td><a href="<?php echo $this->createUrl('news/deatailInfo',array('id'=>$item->goods_id,'catlogid'=>$item->cat_id));?>" target="_blank" style="color: #57A0FF; font-size: 14px;">查看详细</a></td>
                            <td><?php echo date('Y-m-d H:i:s',$item->add_time);?></td>
                        </tr>
                    <?php $i++;}?>
                 </table>
            </div>
            <div class="breakpage" style="text-align: center; margin-top:15px;"><!--breakpage start-->
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
            </div><!--breakpage end-->
        </div>
         <!--站内提醒-->
         <style>
         .d_qie8>ul>li>a:hover{ color:#fff;}
         </style>