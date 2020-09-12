    <!--加入商保-->
  	<div class="d_shangb">
        <div class="d_sbtopwidth">
            <ul class="d_sbtop clearfix">
                <li><span>加入商保的好处</span>：缴纳保证金后即成为金币网商保会员，能接手更多任务，赚取更高佣金。</li>
                <li><span>商保金扣除规则</span>：当接手人触犯平台规定行为时，发布方有权提起申诉，如接手方行为过失，则需赔偿发布方损失。</li>
                <li><span>商保退出规则</span>：无任何未完成任务15天后可提现。申请退出时请联系客服登记处理。</li>
                <li><span>商保索赔流程</span>：发起商保索赔-双方协商-客服介入处理-五日内给出处理结果。</li>
            </ul>
        </div>
        <?php
            $myinfo=User::model()->findByPk(Yii::app()->user->getId());
            $exitProtectPlanRecord=Exitprotectplanrecord::model()->findByAttributes(array(
                'uid'=>Yii::app()->user->getId(),
                'status'=>0
            ));
        ?>
        <div class="d_sbchongzhi clearfix">
        	<ul class="d_szleft">
                <?php
                    //提交过退出商保申请
                    if($exitProtectPlanRecord){
                ?> 
                <li class="d_leftcolor" style="color: red;">
                    您已于<?php echo date('Y年m月d日 H时i分',$exitProtectPlanRecord->time);?>提交退出商保申请
                </li>
                <?php }?>
                <?php
                    if($myinfo->JoinProtectPlan==1){
                ?>
                <li class="d_leftcolor" style="color: #0FA6D8;">
                    您已于<?php echo date('Y年m月d日 H时i分',$myinfo->JoinProtectPlanTime);?>加入商保
                </li>
                <?php }?>
            	<li class="d_leftcolor">您已缴纳了：<span><?php echo $myinfo->JoinProtectPlanMoney;?> </span>元保证金</li>
                <?php
                    if($myinfo->JoinProtectPlan==0){
                ?>
                <li class="d_timecolor">本次需缴纳：<span>300 </span>元保证金</li>
                <li class="shengyu">您剩余的存款：<span><?php echo $myinfo->Money;?> </span>元</li>
                <?php
                    }
                ?>
            </ul>
            <?php
                if($myinfo->JoinProtectPlan==0){
            ?>
            <a class="d_szright clearfix" href="<?php echo $this->createUrl('user/userPayCenter');?>" target="_blank">
            	充值
            </a>
            <?php }?>
            <div class="clear"></div>
            <div class="d_xian"></div>
            <?php
                if($myinfo->JoinProtectPlan==0){
            ?>
            <div class="tiaokuan">
            	<p class="xuanze"><input type="checkbox" class="clearRules" style="position: relative; top:1px;" /> 我已清楚商保规则并严格遵守。</p>
            </div>
            <?php }?>
            <div class="d_enter">
                <?php
                    if($myinfo->JoinProtectPlan==0){
                ?>
            	<a href="javascript:;" class="joinProtectPlan">我要加入</a>
                <?php }?>
                
                <?php
                    if($myinfo->JoinProtectPlan==1 && !$exitProtectPlanRecord){
                ?>
                <a href="javascript:;" class="exitProtectPlan">申请退出</a>
                <?php
                    }else{
                ?>
                <a href="javascript:;" class="DelexitProtectPlan">取消申请</a>
                <?php }?>
            </div>
        </div>
    </div>
    <!--加入商保-->
<!--layer插件-->
<script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>
<script src="<?php echo ASSET_URL;?>layer/layer.js"></script>
<script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>
<link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" />
<script>
    $(function(){
        //加入商保
        $(".joinProtectPlan").click(function(){
           if(!$(".clearRules").is(":checked"))
           {
                layer.tips('清楚规则后请勾选复选框', '.clearRules', {
                    tips: [1, '#0FA6D8'] //还可配置颜色
                });
           }else
           {
                //判断余额是否充足
                if(300>parseFloat($(".MoneyOwn").html()))//余额不足
                {
                    layer.tips('您的余额不足', '.shengyu', {
                        tips: [1, '#0FA6D8'] //还可配置颜色
                    });
                }else//余额充足
                {
                    //输入安全码
                    layer.confirm('输入安全码<input type="password" name="safePwd" class="text1 safePwd" style="margin-left:5px;" />', {
                    	btn: ['确定'] //按钮
                    },function(){
                        if($(".safePwd").val()=="")//安全码必填
                        {
                            layer.tips('请输入安全码', '.safePwd');
                        }else
                        {
                            $.ajax({
                    			type:"POST",
                    			url:"<?php echo $this->createUrl('user/checkSafePwd');?>",
                    			data:{"safePwd":$(".safePwd").val()},
                    			success:function(msg)
                    			{
                    				if(msg=="SUCCESS")//安全码正确
                                    {
                                        //加入商保开始
                                        $.ajax({
                                			type:"POST",
                                			url:"<?php echo $this->createUrl('user/userSBcenter');?>",
                                			data:{"joinProtectPlan":"DONE"},
                                			success:function(msg)
                                			{
                                                if(msg=="SUCCESS")
                                                {
                                                    layer.confirm('恭喜您成功加入商保', {
                                                		btn: ['知道了'] //按钮
                                                	},function(){
                                                	   location.reload();
                                                	});
                                                }else if(msg=="JOINYET"){
                                                    layer.confirm('您已加入商保，无须重复加入', {
                                                		btn: ['知道了'] //按钮
                                                	},function(){
                                                	   location.reload();
                                                	});
                                                }else
                                                {
                                                    layer.confirm('加入商保失败，您可以联系我们的客服人员', {
                                                		btn: ['知道了'] //按钮
                                                	},function(){
                                                	   location.reload();
                                                	});
                                                }
                                			}
                                		});
                                        //加入商保开始
                                    }else
                                    {
                                        $(".safePwd").val("");
                                        layer.tips('安全码不正确', '.safePwd');
                                    }
                    			}
                    		});
                        }
                    });
                    //输入安全码
                }
           }
        });
        
        //申请退出商保
        $(".exitProtectPlan").click(function(){
            layer.confirm('您确定要申请退出商保吗？', {
        		btn: ['确定','不退出'] //按钮
        	},function(){
        	   //输入安全码
                layer.confirm('输入安全码<input type="password" name="safePwd" class="text1 safePwd" style="margin-left:5px;" />', {
                	btn: ['确定'] //按钮
                },function(){
                    if($(".safePwd").val()=="")//安全码必填
                    {
                        layer.tips('请输入安全码', '.safePwd');
                    }else
                    {
                        $.ajax({
                			type:"POST",
                			url:"<?php echo $this->createUrl('user/checkSafePwd');?>",
                			data:{"safePwd":$(".safePwd").val()},
                			success:function(msg)
                			{
                				if(msg=="SUCCESS")//安全码正确
                                {
                                    //申请退出商开始
                                    $.ajax({
                            			type:"POST",
                            			url:"<?php echo $this->createUrl('user/userSBcenter');?>",
                            			data:{"exitProtectPlan":"DONE"},
                            			success:function(msg)
                            			{
                                            if(msg=="SUCCESS")
                                            {
                                                layer.confirm('成功提交退出商保申请', {
                                            		btn: ['知道了'] //按钮
                                            	},function(){
                                            	   location.reload();
                                            	});
                                            }else if(msg=="NOTJOINYET"){
                                                layer.confirm('您还没有加入商保，无法申请', {
                                            		btn: ['知道了'] //按钮
                                            	},function(){
                                            	   location.reload();
                                            	});
                                            }else
                                            {
                                                layer.confirm('申请失败，您可以联系我们的客服人员', {
                                            		btn: ['知道了'] //按钮
                                            	},function(){
                                            	   location.reload();
                                            	});
                                            }
                            			}
                            		});
                                    //申请退出商开始
                                }else
                                {
                                    $(".safePwd").val("");
                                    layer.tips('安全码不正确', '.safePwd');
                                }
                			}
                		});
                    }
                });
                //输入安全码
        	});
        });
        
        //取消申请退出
        $(".DelexitProtectPlan").click(function(){
            layer.confirm('您确定要取消申请吗？', {
        		btn: ['确定','不退出'] //按钮
        	},function(){
        	   //输入安全码
                layer.confirm('输入安全码<input type="password" name="safePwd" class="text1 safePwd" style="margin-left:5px;" />', {
                	btn: ['确定'] //按钮
                },function(){
                    if($(".safePwd").val()=="")//安全码必填
                    {
                        layer.tips('请输入安全码', '.safePwd');
                    }else
                    {
                        $.ajax({
                			type:"POST",
                			url:"<?php echo $this->createUrl('user/checkSafePwd');?>",
                			data:{"safePwd":$(".safePwd").val()},
                			success:function(msg)
                			{
                				if(msg=="SUCCESS")//安全码正确
                                {
                                    //申请退出商开始
                                    $.ajax({
                            			type:"POST",
                            			url:"<?php echo $this->createUrl('user/userSBcenter');?>",
                            			data:{"DelexitProtectPlan":"DONE"},
                            			success:function(msg)
                            			{
                                            if(msg=="SUCCESS")
                                            {
                                                layer.confirm('成功取消申请', {
                                            		btn: ['知道了'] //按钮
                                            	},function(){
                                            	   location.reload();
                                            	});
                                            }else if(msg=="NOTEXIT"){
                                                layer.confirm('您没有提交过申请', {
                                            		btn: ['知道了'] //按钮
                                            	},function(){
                                            	   location.reload();
                                            	});
                                            }else
                                            {
                                                layer.confirm('取消申请失败，您可以联系我们的客服人员', {
                                            		btn: ['知道了'] //按钮
                                            	},function(){
                                            	   location.reload();
                                            	});
                                            }
                            			}
                            		});
                                    //申请退出商开始
                                }else
                                {
                                    $(".safePwd").val("");
                                    layer.tips('安全码不正确', '.safePwd');
                                }
                			}
                		});
                    }
                });
                //输入安全码
        	});
        });
    })
</script>