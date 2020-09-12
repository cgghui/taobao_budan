    <?php
        //发布任务方法名数组
        $taskPublistActionArr=array('taskPublishPT','taskPublishLU','taskPublishTC','taskPublishGWC','taskPublishTemplete');
        
        //已接任务方法名数组
        $taobaoInTaskActionArr=array('taobaoInTask','taobaoInTaskWaitPay','taobaoInTaskWaitSHHP','taobaoInTaskComplete','taobaoInTaskAllList');
        
        //已发任务方法名数组
        $taobaoOutTaskActionArr=array('taobaoOutTask','taobaoOutTaskStop','taobaoOutTaskComplete','taobaoOutTaskAllList');
    ?>
    <div class="dtNav">
        <div class="dtNav_cen clearfix">
            <img src="<?php echo VERSION2;?>img/tm.jpg" alt="" class="tm" />
            <ul class="dtLis">
                <li <?php echo Yii::app()->controller->id=="site" && $this->getAction()->getId()=="taobaoTask"?"class='on'":"";?>><a href="<?php echo $this->createUrl('site/taobaoTask');?>">任务大厅</a></li>
                <li <?php echo Yii::app()->controller->id=="user" && in_array($this->getAction()->getId(),$taobaoInTaskActionArr)?"class='on'":"";?>><a href="<?php echo $this->createUrl('user/taobaoInTask');?>">已接任务</a></li>
                <li <?php echo Yii::app()->controller->id=="user" && in_array($this->getAction()->getId(),$taobaoOutTaskActionArr)?"class='on'":"";?>><a href="<?php echo $this->createUrl('user/taobaoOutTask');?>">已发任务</a></li>
                <li <?php echo Yii::app()->controller->id=="user" && $this->getAction()->getId()=="taobaoBindBuyer"?"class='on'":"";?>><a href="<?php echo $this->createUrl('user/taobaoBindBuyer');?>">绑定买号</a></li>
                <li <?php echo Yii::app()->controller->id=="user" && $this->getAction()->getId()=="taobaoBindSeller"?"class='on'":"";?>><a href="<?php echo $this->createUrl('user/taobaoBindSeller');?>">绑定掌柜</a></li>
                <li <?php echo Yii::app()->controller->id=="user" && in_array($this->getAction()->getId(),$taskPublistActionArr)?"class='on'":"";?>><a href="<?php echo $this->createUrl('user/taskPublishLU');?>">发布任务</a></li>
            </ul>
            <!--<a class="kqqq">开启QQ临时会话，双方及时沟通</a>-->
        </div>
    </div>