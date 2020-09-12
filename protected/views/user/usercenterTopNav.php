
    <?php
        $txActionArr=array('userTxList','userCashToBank');
        $mxActionArr=array('userPayDetail','userPayDetailMinLi','userPayDetailTask','userPayDetailTX','userLoginDetail');
    ?>
    <div class="d_hy">
        <div class="d_ul">
            <ul>
                <li <?php echo Yii::app()->controller->id=="user" && $this->getAction()->getId()=="index"?"class='on'":"";?>>
                    <a href="<?php echo $this->createUrl('user/index');?>">总览</a>
                </li>
                <li <?php echo Yii::app()->controller->id=="user" && $this->getAction()->getId()=="userAccountCenter"?"class='on'":"";?>>
                    <a href="<?php echo $this->createUrl('user/userAccountCenter');?>">维护资料密码</a>
                </li>
                <li <?php echo Yii::app()->controller->id=="user" && $this->getAction()->getId()=="userPayCenter"?"class='on'":"";?>>
                    <a href="<?php echo $this->createUrl('user/userPayCenter');?>">账号充值</a>
                </li>
                <li <?php echo Yii::app()->controller->id=="user" && in_array($this->getAction()->getId(),$txActionArr)?"class='on'":"";?>>
                    <a href="<?php echo $this->createUrl('user/userCashToBank');?>">申请提现</a>
                </li>
                </li>
                <li <?php echo Yii::app()->controller->id=="user" && in_array($this->getAction()->getId(),$mxActionArr)?"class='on'":"";?>>
                    <a href="<?php echo $this->createUrl('user/userPayDetail');?>">收支明细</a>
                </li>
                <li <?php echo Yii::app()->controller->id=="user" && $this->getAction()->getId()=="userMiliToCash"?"class='on'":"";?>>
                    <a href="<?php echo $this->createUrl('user/userMiliToCash');?>">金币回收</a>
                </li>
                <li <?php echo Yii::app()->controller->id=="user" && $this->getAction()->getId()=="userBlackAccountList"?"class='on'":"";?>>
                    <a href="<?php echo $this->createUrl('user/userBlackAccountList');?>">黑名单</a>
                </li>
                <!--<li <?php echo Yii::app()->controller->id=="user" && $this->getAction()->getId()=="userMessage"?"class='on'":"";?>>
                    <a href="<?php echo $this->createUrl('user/userMessage');?>">站内提醒</a>
                </li>-->
            </ul>
        </div>
    </div>
    <script src="<?php echo VERSION2;?>js/qiehuan.js"></script>
    <!--layer插件-->
    <script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>
    <script src="<?php echo ASSET_URL;?>layer/layer.js"></script>
    <script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>
    <link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" />
    <?php
        $userInfo=User::model()->findByPk(Yii::app()->user->getId());
        if($userInfo->SafePwd==""){ 
    ?>
    <script>
        $(function(){
            //询问框
        	layer.confirm('为了您的帐号安全，请先设置你的<a style="color:red;">安全操作码</a>', {
        		btn: ['设置安全码','暂时不设置'] //按钮
        	},function(){
        	   window.location.href='<?php echo $this->createUrl('user/userSafePwdFirstSet');?>';
        	},function(){
        	   window.location.href='<?php echo $this->createUrl('site/index');?>';
        	});
        })
    </script>
    <?php
        }
        if($userInfo->TrueName=="" && Yii::app()->controller->id=="user" && $this->getAction()->getId()!="userAccountCenter"){
    ?>
    <script>
        $(function(){
            //询问框
        	layer.confirm('<span style="color:red;">请完善您的真实姓名，否则很多操作会受到限制</span>', {
        		btn: ['立即设置','暂不设置'] //按钮
        	},function(){
        	   window.location.href='<?php echo $this->createUrl('user/userAccountCenter');?>';
        	},function(){
        	   window.location.href='<?php echo $this->createUrl('site/index');?>';
        	});
        })
    </script>
    <?php }?>