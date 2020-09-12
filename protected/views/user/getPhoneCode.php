        <style>
            *{ font-size:14px;}
            .text1{ text-indent: 5px; width:160px; height:28px; border:2px dashed #57a0ff; }
            .setInside{ width:95%; height:auto; margin:20px auto;}
            .d_biaoti{ height:auto; padding-top:10px;}
            .registerform input{ width:230px; height:30px; line-height:30px; border:2px dashed #57A0FF;}
            table tr{ height:40px; line-height: 40px;}
            .getCode{ background: #FC772D ; border: none; border-radius: 5px; color:#fff; cursor: pointer;}
        </style>
        <!--第一次设置安全码-->
        <?php
            $userInfo=User::model()->findByPk(Yii::app()->user->getId());
        ?>
        <form class="registerform">
        <div class="setInside">
            <table>
                <tr>
                    <td>手机号码：</td>
                    <td><input type="text" value="<?php echo $userInfo->Phon;?>" style="text-indent: 10px; background:#e9e8e8;" name="Phon" placeholder="手机号码" readonly="readonly" class="inputxt phone" datatype="m" errormsg="手机号码格式不正确" nullmsg="请输入您的手机号码"></td>
                    <td></td>
                </tr>
                <tr>
                    <td>验证码：</td>
                    <td><input type="text" style="text-indent: 10px; width:100px;" name="safePwdagain" placeholder="输入验证码"  class="regInput inputxt phoneCode" datatype="*" nullmsg="请输入验证码" errormsg="请输入验证码" />
                    <input type="button" id="btn" class="getCode" style="width: 125px; border: none;" value="获取验证码" onclick="settime(this)" />
                    </td>
                    <td></td>
                </tr>
                <tr>
                  <td colspan="2"><span class="addBankBtn" style=" padding:8px 60px; border:none; border-radius:5px; cursor: pointer; height:35px; line-height:35px; color:#fff; background:#57A0FF; margin-top:10px;" />确认提交</span></td>
                </tr>
                <tr>
            </table>
        </div>
        </form>
 <!--layer插件-->
<script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>
<script src="<?php echo ASSET_URL;?>layer/layer.js"></script>
<script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>
<link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" /> 

<script type="text/javascript">
    $(function(){
        //提交银行卡信息
        $(".addBankBtn").click(function(){
            if($(".bankAccount").val()=="")//卡号不能为空
            {
                layer.tips('银行卡号不能为空', '.bankAccount');
                exit;
            }
            if(parseFloat($("#bankCatalog").val())<15)
            {
                if(isNaN($(".bankAccount").val()))//卡号必须为数字
                {
                    layer.tips('卡号必须为数字', '.bankAccount');
                    $(".bankAccount").val("");
                    exit;
                }
            }
            if($(".phoneCode").val()=="")
            {
                layer.tips('验证码不能为空', '.phoneCode');
                exit;
            }
            //都通过后，验证手机验证码
            $.ajax({
    			type:"POST",
    			url:"<?php echo $this->createUrl('user/userCheckPhoneAndCode');?>",
    			data:{"phone":$(".phone").val(),"phoneCode":$(".phoneCode").val()},
    			success:function(msg)
    			{
    				if(msg=="SUCCESS")//手机验证码正确
                    {
                        //储存银行卡信息
                        $.ajax({
                			type:"POST",
                			url:"<?php echo $this->createUrl('user/userAddBankCertain');?>",
                			data:$(".registerform").serialize(),
                			success:function(msg)
                			{
                				if(msg=="SUCCESS")
                                {
                                    //询问框
                                	layer.confirm('银行卡添加成功', {
                               		   btn: ['知道了'] //按钮
                                	},function(){
                                        window.parent.location.reload();//刷新父级页面
                                	    var index = parent.layer.getFrameIndex(window.name);//获取窗口索引
                                	    parent.layer.close(index);//关闭父级
                                	});
                                }else if(msg=="BANKACCOUNTEXIT")//银行卡已存在
                                {
                                    //询问框
                                	layer.confirm('<span style="color:red;">银行卡号已存在</span>，请不要重复添加', {
                               		   btn: ['知道了'] //按钮
                                	});
                                }else//添加失败
                                {
                                    //询问框
                                	layer.confirm('<span style="color:red;">银行卡添加失败</span>您可以联系我们的客服人员', {
                               		   btn: ['知道了'] //按钮
                                	});
                                }
                			}
                		});
                        //储存银行卡信息
                    }else if(msg=="CODEFAIL")//验证码不正确
                    {
                        //询问框
                    	layer.confirm('<span style="color:red;">验证码不正确</span>，请检查您收到的短信验证码', {
                   		   btn: ['知道了'] //按钮
                    	});
                    }else
                    {
                        //询问框
                    	layer.confirm('<span style="color:red;">手机号请不要更改</span>，请使用接收短信的手机号码', {
                   		   btn: ['知道了'] //按钮
                    	});
                    }
    			}
    		});
            //验证手机验证码结束
        });
    })
    
    var countdown=300; 
    function settime(obj) { 
    if (countdown == 0) { 
        obj.removeAttribute("disabled");    
        obj.value="免费获取验证码"; 
        countdown = 300; 
        return;
    } else {
        if(countdown==300)//只发送1次
        {
            //发送验证码
            $.ajax({
    			type:"POST",
    			url:"<?php echo $this->createUrl('site/sms');?>",
    			data:{"phone":$(".phone").val(),"phoneCode":$(".phoneCode").val()},
    			success:function(msg)
    			{
                    if(msg=="SUCCESS")
                    {
        				//询问框
                    	layer.confirm('短信发送成功，请注意查看您的手机', {
                   		   btn: ['知道了'] //按钮
                    	});
                    }else
                    {
                        //询问框
                    	layer.confirm('<span style="color:red;">短信发送失败</span>，您可以联系客服人员', {
                   		   btn: ['知道了'] //按钮
                    	});
                    }
    			}
    		});
        }
        obj.setAttribute("disabled", true); 
        obj.value="重新发送(" + countdown + ")"; 
        countdown--; 
    } 
    setTimeout(function() { 
        settime(obj) }
        ,1000) 
    }
</script>