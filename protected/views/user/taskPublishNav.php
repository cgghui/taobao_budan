        <div id="menu_div" data-step="1" data-intro="您可以选择您想发布的任务类型" class=""> 
            <a <?php echo Yii::app()->controller->id=="user" && $this->getAction()->getId()=="taskPublishLU"?"class='on'":"";?> href="<?php echo $this->createUrl('user/taskPublishLU');?>" style="border-left:none">来路搜索任务</a> 
            <a <?php echo Yii::app()->controller->id=="user" && $this->getAction()->getId()=="taskPublishPT"?"class='on'":"";?> href="<?php echo $this->createUrl('user/taskPublishPT');?>">普通任务</a> 
            <a style="display: none;" <?php echo Yii::app()->controller->id=="user" && $this->getAction()->getId()=="taskPublishTC"?"class='on'":"";?> href="<?php echo $this->createUrl('user/taskPublishTC');?>">套餐任务</a> 
            <a style="display: none;" <?php echo Yii::app()->controller->id=="user" && $this->getAction()->getId()=="taskPublishGWC"?"class='on'":"";?> href="<?php echo $this->createUrl('user/taskPublishGWC');?>">购物车任务</a> 
          <!--<a href="#publish/souTask"	>搜索任务</a>		--> 
          <a <?php echo Yii::app()->controller->id=="user" && $this->getAction()->getId()=="taskPublishTemplete"?"class='on'":"";?> href="<?php echo $this->createUrl('user/taskPublishTemplete');?>">任务模板</a>
          <a href="<?php echo $this->createUrl('user/taobaoOutTask');?>">已发任务</a> 
          <span style="width:133px;height: 52px;border-bottom: 2px dashed #57a0ff;display: block;float: left;"></span>
        </div>