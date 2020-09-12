        <style>
            *{ font-size:14px;}
            .text1{ text-indent: 5px; width:160px; height:28px; border:2px dashed #57a0ff; }
            .setInside{ width:95%; height:auto; margin:20px auto;}
            .d_biaoti{ height:auto; padding-top:10px;}
            .registerform input{ width:230px; height:30px; line-height:30px; border:2px dashed #57A0FF;}
            table tr{ height:40px; line-height: 40px;}
            .getCode{ background: #FC772D ; border: none; border-radius: 5px; color:#fff; cursor: pointer;}
            .setNewPwd{ display: none;}
        </style>
        <!--第一次设置安全码-->
        <form class="registerform">
        <div class="setInside">
            <table class="setCode">
                <input type="hidden" name="setPhon" value="Done" />
                <tr>
                    <td>手机号码：</td>
                    <td><input type="text" value="" style="text-indent: 10px;" name="Phon" placeholder="手机号码" class="inputxt phone" datatype="m" errormsg="手机号码格式不正确" nullmsg="请输入您的手机号码"></td>
                    <td></td>
                </tr>
                <tr>
                    <td>验证码：</td>
                    <td><input type="text" style="text-indent: 10px; width:100px;" name="safePwdagain" placeholder="输入验证码"  class="regInput inputxt phoneCode" datatype="*" nullmsg="请输入验证码" errormsg="请输入验证码" />
                    <input type="button" id="btn" class="getCode" style="width: 125px; border: none;" value="获取验证码" />
                    </td>
                    <td></td>
                </tr>
                <tr>
                  <td colspan="2"><span class="addBankBtn" style=" padding:8px 125px; border:none; border-radius:5px; cursor: pointer; height:35px; line-height:35px; color:#fff; background:#57A0FF; margin-top:10px;" />确认提交</span></td>
                </tr>
                <tr>
            </table>
            <table class="setNewPwd">
                <tr>
                    <td>输入新密码：</td>
                    <td><input type="password" value="" style="text-indent: 10px;" name="newpwd" class="inputxt newpwd" placeholder="输入您的新密码" /></td>
                    <td></td>
                </tr>
                <tr>
                    <td>请再次输入：</td>
                    <td><input type="password" value="" style="text-indent: 10px;" name="newpwdAgain" placeholder="再次输入确认" class="inputxt newpwdAgain" />
                    </td>
                    <td></td>
                </tr>
                <tr>
                  <td colspan="2"><span class="setNewPwdBtn" style=" padding:8px 110px; border:none; border-radius:5px; cursor: pointer; height:35px; line-height:35px; color:#fff; background:#57A0FF; margin-top:10px;" />确认设置新密码</span></td>
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
        var phone=0;//手机号码初始化
        
        //获取手机验证码
        $(".addBankBtn").click(function(){
            if($(".phoneCode").val()=="")
            {
                layer.tips('验证码不能为空', '.phoneCode');
                exit;
            }
            //都通过后，验证手机验证码
            $.ajax({
    			type:"POST",
    			url:"<?php echo $this->createUrl('passport/userCheckPhoneAndCode');?>",
    			data:{"phone":$(".phone").val(),"phoneCode":$(".phoneCode").val()},
    			success:function(msg)
    			{
    				if(msg=="SUCCESS")//手机验证码正确，显示设置新密码
                    {
                        phone=$(".phone").val();//配置手机号码
                        $(".setCode").hide();
                        $(".setNewPwd").show();//显示设置新密码区域
                    }else if(msg=="CODEFAIL")//验证码不正确
                    {
                        //询问框
                    	layer.tips('验证码不正确，请检查', '.phoneCode', {
                            tips: 1
                        });
                    }else
                    {
                        //询问框
                    	layer.tips('手机号请不要更改，请使用接收短信的手机号码', '.phone', {
                            tips: 1
                        });
                    }
    			}
    		});
            //验证手机验证码结束
        });
        
        //点击设置新密码
        $(".setNewPwdBtn").click(function(){
            if($(".newpwd").val()=="")
            {
                layer.tips('新密码不能为空', '.newpwd', {
                    tips: 1
                });
                exit;
            }
            if($(".newpwdAgain").val()=="")
            {
                layer.tips('确认密码不能为空', '.newpwdAgain', {
                    tips: 1
                });
                exit;
            }
            if($(".newpwdAgain").val()!=$(".newpwd").val())//两次密码不一致
            {
                layer.tips('两次密码不一致，请检查', '.newpwdAgain', {
                    tips: 1
                });
                exit;
            }
            //检查通过，提交新密码
            $.ajax({
    			type:"POST",
    			url:"<?php echo $this->createUrl('passport/forgetPwd');?>",
    			data:{"phone":phone,"newpwd":$(".newpwd").val()},
    			success:function(msgSet)
    			{
                    if(msgSet=="SUCCESS")//设置新密码成功
                    {
        				//询问框
                    	layer.confirm('新密码设置成功', {
                   		   btn: ['立即登录','再逛逛'] //按钮
                    	},function(){
                            window.parent.location.reload();//刷新父级页面
                            var index = parent.layer.getFrameIndex(window.name);//获取窗口索引
                            window.location.href='<?php echo $this->createUrl('passport/login');?>';
                    	},function(){
                    	    window.parent.location.reload();//刷新父级页面
                            var index = parent.layer.getFrameIndex(window.name);//获取窗口索引
                    	});
                    }else if(msgSet=="PHONENOTEXIST"){
                        //询问框
                    	layer.confirm('手机号码不存在', {
                   		   btn: ['知道了'] //按钮
                    	},function(){
                    	    window.parent.location.reload();//刷新父级页面
                            var index = parent.layer.getFrameIndex(window.name);//获取窗口索引
                            window.location.href='<?php echo $this->createUrl('passport/login');?>';
                    	});
                    }else
                    {
                        //询问框
                    	layer.confirm('<span style="color:red;">新密码设置失败</span>，您可以联系客服人员', {
                   		   btn: ['知道了'] //按钮
                    	},function(){
                    	    window.parent.location.reload();//刷新父级页面
                            var index = parent.layer.getFrameIndex(window.name);//获取窗口索引
                            window.location.href='<?php echo $this->createUrl('passport/login');?>';
                    	});
                    }
    			}
    		});
            //检查通过，提交新密码
        });
        
        //获取手机验证码
        $(".getCode").click(function(){
            var phoneExist=0;
            //检查手机号码是否存在
            $.ajax({
    			type:"POST",
    			url:"<?php echo $this->createUrl('passport/checkPhoneExist');?>",
    			data:{"phone":$(".phone").val()},
                async:false,
    			success:function(msg)
    			{
                    if(msg=="SUCCESS")//手机号码存在
                    {
                        phoneExist=1;
                    }
                    else//不存在
                    {
                        phoneExist=0;
                    }
    			}
    		});
            if(phoneExist==0)//手机号码不存在
            {
                layer.tips('该手机号码不存在，无法发送短信验证码', '.phone', {
                    tips: [1, '#0FA6D8'] //还可配置颜色
                });
            }else//手机号码存在
            {
                settime(this);//发送短信验证码
            }
        });
    })
    
    var countdown=300;
    function settime(obj) {
    if (countdown == 0) { 
        obj.removeAttribute("disabled");    
        obj.value="免费获取验证码"; 
        countdown = 300; 
        return;
    }else if($(".phone").val()==""){
        layer.tips('手机号码不能为空', '.phone', {
            tips: 1
        });
        exit;
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
                        //提示框
                        layer.tips('验证码发送成功，注意查看', '.phoneCode', {
                            tips: [1, '#0FA6D8'] //还可配置颜色
                        });
                    }else
                    {
                        //提示框
                    	layer.tips('短信验证码发送失败，可能由于发送次数超出限制', '.phoneCode', {
                            tips: [1, '#0FA6D8'] //还可配置颜色
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