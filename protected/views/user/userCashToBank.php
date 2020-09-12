        <?php
            echo $this->renderPartial('/user/usercenterTopNav')
        ?>
        <div class="d_qie2">
            <div class="d_menu">
            	<ul>
                	<li class="now" onclick="window.location.href='<?php echo $this->createUrl('user/userCashToBank');?>'">
                    	银行卡提现
                    </li>
                    <li onclick="window.location.href='<?php echo $this->createUrl('user/userTxList');?>'">
                    	提现记录
                    </li>
                </ul>
            </div>
            <style>
                .bankItem{ width:146px; height:56px; border:2px solid #f3f3f3; float:left; position: relative; cursor: pointer; margin-right: 10px;}
                span.bankItem{ width:auto; border:none;}
                .bankEdit{ position:absolute; width:auto; color:red; left:0; bottom:0; font-size:14px; font-weight:bold; cursor: pointer;}
                .bankCount{ position: absolute; width:auto; left:40px; bottom:0; color:red; font-size:12px;}
                .selectBank{ position: absolute; width:auto; right:0; bottom:0; display: none;}
                .bankItemSelect{ border-color:#3792c6;}
                .certainMoney{ margin-top: 15px;}
                .sendTxMoney{ width:147px; height:45px; line-height:45px; border: 1px solid #ee3333; text-align: center; border-radius: 5px; margin:20px 90px; cursor: pointer;}
                .sendTxMoney a{ color:#ee3333; display: block;}
                .sendTxMoney a:hover{ background:#ff0000; color:#fff;}
                .addNewBank{ width:60px; float:left; cursor: pointer;}
                .bankItemBefore{ width:auto; height:56px; float:left; margin-right:10px;}
            </style>
            <div class="d_n">
                <div class="d_new1"><!--d_new1 start-->
                    <span class="bankItemBefore">提现方式：</span>
                    <input type="hidden" name="bankid" class="bankid" />
                    <!--bankItem start-->
                    <?php
                        $userInfo=User::model()->findByPk(Yii::app()->user->getId());
                        $bankInfo=Banklist::model()->findAll(array(
                            'condition'=>'userid='.Yii::app()->user->getId(),
                            'order'=>'id desc'
                        ));
                        foreach($bankInfo as $item){
                    ?>
                    <div class="bankItem" lang="<?php echo $item->id;?>" style="background: url(<?php echo VERSION2.'img/bankimg/'.$item->bankCatalog.'.jpg';?>) no-repeat center top;">
                        <div class="bankEdit">修改</div>
                        <div class="bankCount">(<?php echo substr_replace($item->bankAccount,'***',3,13);?>)</div>
                        <div class="selectBank"><img src="<?php echo VERSION2.'img/gou.png';?>"/></div>
                    </div>
                    <?php }?>
                    <div class="addNewBank"><img src="<?php echo VERSION2.'img/addBank.png';?>" width="62"/></div>
                    <!--bankItem end-->
                    <div class="clear"></div>
                    <div class="certainMoney"><!--certainMoney start-->
                        <font style="margin-right: 10px;">提现金额：</font><input type="text" class="txMoneyNum" style=" width:145px; height:30px; line-height:30px; border:2px dashed #57A0FF; text-indent: 10px;"/>&nbsp;&nbsp;元<span style="padding-left: 20px;">当前余额：<font class=remaindMoney" style="color:red; font-size:16px; font-weight:bold;"><?php echo $userInfo->Money;?></font>元</span>
                    </div><!--certainMoney end-->
                    <div class="sendTxMoney"><a href="javascript:;">申请提现</a></div>
                </div>
                
                <div class="d_new1 new clearfix">
                    提现记录
                </div>
            </div>
         <br />
        </div>
        
<!--layer插件-->
<script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>
<script src="<?php echo ASSET_URL;?>layer/layer.js"></script>
<script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>
<link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" /> 
<script>
    $(function(){
        $("div>.bankItem").eq(0).addClass("bankItemSelect");
        $("div>.bankItem").eq(0).find(".selectBank").show();
        $(".bankid").val($("div>.bankItem").eq(0).attr("lang"));
        
        //选择银行卡
        $("div>.bankItem").click(function(){
            $(".bankid").val($(this).attr("lang"));
            
            $("div>.bankItem").removeClass("bankItemSelect");
            $(".selectBank").hide();
            
            $(this).addClass("bankItemSelect");
            $(this).find(".selectBank").show();
        });
        
        //申请提现
        $(".sendTxMoney").click(function(){
            if($(".txMoneyNum").val()=="")
            {
                layer.tips('提现金额不能为空', '.txMoneyNum');
                exit;
            }
            if(isNaN($(".txMoneyNum").val()))
            {
                layer.tips('提现金额必须为数字', '.txMoneyNum');
                exit;
            }
            if(parseFloat($(".txMoneyNum").val())>parseFloat($(".MoneyOwn").html()))
            {
                layer.tips('提现金额不能大于您的余额', '.txMoneyNum');
                exit;
            }
            
            if($(".bankItem").length==0)
            {
                layer.tips('请先添加银行卡信息', '.addNewBank');
                exit;
            }
            
            
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
                                //检查通过申请提现
                                $.ajax({
                        			type:"POST",
                        			url:"<?php echo $this->createUrl('user/userCashToBank');?>",
                        			data:{"txMoneyNum":$(".txMoneyNum").val(),"bankid":$(".bankid").val()},
                        			success:function(msg)
                        			{
                        				if(msg=="SUCCESS")
                                        {
                                            //询问框
                                        	layer.confirm('申请提现成功', {
                                        		btn: ['知道了'] //按钮
                                        	},function(){
                                        	    location.reload();//刷新当前页面
                                        	});
                                        }else if(msg=="MONEYTOOMATCH")
                                        {
                                            //询问框
                                        	layer.confirm('<span style="color:red;">余额不足</span>', {
                                        		btn: ['知道了'] //按钮
                                        	},function(){
                                        	    location.reload();//刷新当前页面
                                        	});
                                        }else
                                        {
                                            //询问框
                                        	layer.confirm('<span style="color:red;">提现失败，您可以联系我们的客服人员</span>', {
                                        		btn: ['知道了'] //按钮
                                        	},function(){
                                        	    location.reload();//刷新当前页面
                                        	});
                                        }
                        			}
                        		});
                                //检查通过申请提现
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
        
    
        //添加新的银行卡信息
        $(".addNewBank").click(function(){
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
                                $(".layui-layer-shade").hide();
                                $(".layui-layer").hide();
                                //检查通过添加银行卡
                                layer.open({
                                    type: 2,
                                    title:'添加提现卡号',
                                    area: ['468px','350px'],
                                    skin: 'layui-layer-rim', //加上边框
                                    content: ['<?php echo $this->createUrl('user/userAddBank');?>', 'no']
                                });
                                //检查通过添加银行卡
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
		//修改银行卡信息
        $(".bankEdit").click(function(){
			bankid=$(this).parent().attr("lang");
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
                                $(".layui-layer-shade").hide();
                                $(".layui-layer").hide();
                                //检查通过添加银行卡
                                layer.open({
                                    type: 2,
                                    title:'修改银行卡号',
                                    area: ['468px','350px'],
                                    skin: 'layui-layer-rim', //加上边框
                                    content: ['<?php echo $this->createUrl('user/userEditBank');?>?bankid='+bankid, 'no']
                                });
                                //检查通过添加银行卡
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
		//删除银行卡信息
        $(".bankDel").click(function(){
			bankid=$(this).parent().attr("lang");
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
                                $(".layui-layer-shade").hide();
                                $(".layui-layer").hide();
                                //检查通过删除银行卡
                                $.ajax({
                            			type:"POST",
                            			url:"<?php echo $this->createUrl('user/userDelBank');?>",
                            			data:{"bankid":bankid},
                            			success:function(msg)
                            			{
                                            if(msg=="SUCCESS")
                                            {
                                				 layer.confirm("银行卡删除成功", {
                                                	btn: ['知道了'] //按钮
                                                },function(){
                                                    location.reload();
                                                });
                                            }else
                                            {
                                                layer.confirm(msg, {
                                                	btn: ['知道了'] //按钮
                                                },function(){
                                                    location.reload();
                                                });
                                            }
                            			}
                            		});
                                //检查通过删除银行卡
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
    })
</script>