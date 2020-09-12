            <?php
                //统计各个状态的任务数量
                
                //1.我接手的-可处理的任务数量
                $taobaoInTaskCount=Companytasklist::model()->findAll(array(
                    'condition'=>'taskerid='.Yii::app()->user->getId().' and status<>6 and complian_status<>3 and taskCompleteStatus<>1'
                ));
                //2.我接手的-等待我商品付款任务数量
                $taobaoInTaskWaitPay=Companytasklist::model()->findAll(array(
                    'condition'=>'taskerid='.Yii::app()->user->getId().' and status<>6 and status=2'
                ));
                //3.我接手的-等待我收货好评任务数量
                $taobaoInTaskWaitSHHP=Companytasklist::model()->findAll(array(
                    'condition'=>'taskerid='.Yii::app()->user->getId().' and status<>6 and status=4'
                ));
                
                //4.我接手的-已完成的任务数量
                $taobaoInTaskComplete=Companytasklist::model()->findAll(array(
                    'condition'=>'taskerid='.Yii::app()->user->getId().' and taskCompleteStatus=1'
                ));
                
                //5.我接手的全部任务数量
                $taobaoInTaskAllList=Companytasklist::model()->findAll(array(
                    'condition'=>'taskerid='.Yii::app()->user->getId()
                ));
                
            ?>
            
            <ul class="yjrwPro clearfix">
                <li <?php echo Yii::app()->controller->id=="user" && $this->getAction()->getId()=="taobaoInTask"?"class='yjrwProSelected'":"";?>><a href="<?php echo $this->createUrl('user/taobaoInTask');?>">可处理<span><?php echo count($taobaoInTaskCount);?></span></a></li>
                <li <?php echo Yii::app()->controller->id=="user" && $this->getAction()->getId()=="taobaoInTaskWaitPay"?"class='yjrwProSelected'":"";?>><a href="<?php echo $this->createUrl('user/taobaoInTaskWaitPay');?>">等待我商品付款<span><?php echo count($taobaoInTaskWaitPay);?></span></a></li>
                <li <?php echo Yii::app()->controller->id=="user" && $this->getAction()->getId()=="taobaoInTaskWaitSHHP"?"class='yjrwProSelected'":"";?>><a href="<?php echo $this->createUrl('user/taobaoInTaskWaitSHHP');?>">等待我收货好评<span><?php echo count($taobaoInTaskWaitSHHP);?></span></a></li>
                <li <?php echo Yii::app()->controller->id=="user" && $this->getAction()->getId()=="taobaoInTaskComplete"?"class='yjrwProSelected'":"";?>><a href="<?php echo $this->createUrl('user/taobaoInTaskComplete');?>">已完成任务<span><?php echo count($taobaoInTaskComplete);?></span></a></li>
                <li <?php echo Yii::app()->controller->id=="user" && $this->getAction()->getId()=="taobaoInTaskAllList"?"class='yjrwProSelected'":"";?>><a href="<?php echo $this->createUrl('user/taobaoInTaskAllList');?>">全部任务<span><?php echo count($taobaoInTaskAllList);?></span></a></li>
            </ul>