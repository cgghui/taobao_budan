            <?php
                //统计各个状态的任务数量
                
                //1.我发布的-可处理的任务数量
                $taobaoOutTaskCount=Companytasklist::model()->findAll(array(
                    'condition'=>'publishid='.Yii::app()->user->getId().' and taskCompleteStatus<>1 and complian_status<>3 and status<>0'
                ));
                
                //2.我发布的-暂停中的任务数量
                $taobaoOutTaskStopCount=Companytasklist::model()->findAll(array(
                    'condition'=>'publishid='.Yii::app()->user->getId().' and status=6'
                ));
                
                //3.我发布的-已完成的任务数量
                $taobaoOutTaskCompleteCount=Companytasklist::model()->findAll(array(
                    'condition'=>'publishid='.Yii::app()->user->getId().' and taskCompleteStatus=1'
                ));
                
                //4.我发布的-全部的任务数量
                $taobaoOutTaskAllListCount=Companytasklist::model()->findAll(array(
                    'condition'=>'publishid='.Yii::app()->user->getId()
                ));
                
            ?>
            <ul class="yfrwPro clearfix">
                <li <?php echo Yii::app()->controller->id=="user" && $this->getAction()->getId()=="taobaoOutTask"?"class='yjrwProSelected'":"";?>><a href="<?php echo $this->createUrl('user/taobaoOutTask');?>">可处理<span><?php echo count($taobaoOutTaskCount);?></span></a></li>
                <li <?php echo Yii::app()->controller->id=="user" && $this->getAction()->getId()=="taobaoOutTaskStop"?"class='yjrwProSelected'":"";?>><a href="<?php echo $this->createUrl('user/taobaoOutTaskStop');?>">暂停中<span><?php echo count($taobaoOutTaskStopCount);?></span></a></li>
                <li <?php echo Yii::app()->controller->id=="user" && $this->getAction()->getId()=="taobaoOutTaskComplete"?"class='yjrwProSelected'":"";?>><a href="<?php echo $this->createUrl('user/taobaoOutTaskComplete');?>">已完成任务<span><?php echo count($taobaoOutTaskCompleteCount);?></span></a></li>
                <li <?php echo Yii::app()->controller->id=="user" && $this->getAction()->getId()=="taobaoOutTaskAllList"?"class='yjrwProSelected'":"";?>><a href="<?php echo $this->createUrl('user/taobaoOutTaskAllList');?>">全部任务<span><?php echo count($taobaoOutTaskAllListCount);?></span></a></li>
            </ul>