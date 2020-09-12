        <style>
            .text1{ text-indent: 5px; width:160px; height:28px; border:2px dashed #57a0ff; }
            .setInside{ width:95%; height:auto; margin:20px auto;}
            .d_biaoti{ height:auto; padding-top:10px;}
            .registerform input{ width:230px; height:30px; line-height:30px; border:2px dashed #57A0FF;}
            table tr{ height:45px; line-height: 45px;}
            .getCode{ background: #FC772D ; border: none; border-radius: 5px; color:#fff; cursor: pointer;}
        </style>
        <!--第一次设置安全码-->
        <?php
            $userInfo=User::model()->findByPk(Yii::app()->user->getId());
        ?>
        <form class="registerform">
        <div class="setInside">
            <table>
                <input type="hidden" name="setPhon" value="Done" />
                <tr>
                  <td><input type="text" value="<?php echo $userInfo->Phon;?>" style="text-indent: 10px; background:#e9e8e8;" name="Phon" placeholder="手机号码" readonly="readonly" class="inputxt phone" datatype="m" errormsg="手机号码格式不正确" nullmsg="请输入您的手机号码"></td>
                  <td><div class="Validform_checktip"></div></td>
                </tr>
                <tr>
                  <td><input type="text" style="text-indent: 10px; width:100px;" name="safePwdagain" placeholder="输入验证码"  class="regInput inputxt phoneCode" datatype="*" nullmsg="请输入验证码" errormsg="请输入验证码" />
                  <input type="button" id="btn" class="getCode" style="width: 125px; border: none;" value="获取验证码" onclick="settime(this)" />
                  </td>
                  <td><div class="Validform_checktip">请输入验证码</div></td>
                </tr>
                <tr>
                  <td colspan="2"><input type="submit" style="border-radius:5px; cursor: pointer; height:35px; line-height:35px; color:#fff; background:#57A0FF; margin-top:10px;" value="确认提交" /></td>
                </tr>
                <tr>
            </table>
        </div>
        </form>
<!--第一次设置安全码-->
 <!--layer插件-->
<script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>
<script src="<?php echo ASSET_URL;?>layer/layer.js"></script>
<script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>
<link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" />

<link rel="stylesheet" href="<?php echo ASSET_URL;?>Validform/css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="<?php echo ASSET_URL;?>Validform/js/Validform_v5.3.2_min.js"></script>
<script type="text/javascript" src="<?php echo ASSET_URL;?>Validform/plugin/passwordStrength/passwordStrength-min.js"></script>
<script type="text/javascript">
    $(function(){
        $(".registerform").Validform({
    		tiptype:2,
            beforeSubmit:function(curform){
                //发送手机号与验证码去验证正确性
                $.ajax({
        			type:"POST",
        			url:"<?php echo $this->createUrl('user/userCheckPhoneAndCode');?>",
        			data:{"phone":$(".phone").val(),"phoneCode":$(".phoneCode").val()},
        			success:function(msg)
        			{
        				if(msg=="SUCCESS")
                        {
                            //找回安全码即设置新的安全码开始
                            layer.confirm('输入新安全码：<input type="password" name="newSafepwd" class="text1 newSafepwd" style="margin-left:5px;" /><br/>再次确认输入：<input type="password" name="newSafepwd" class="text1 newSafepwdagain" style="margin-left:5px;" /><br/>', {
                        	btn: ['确定修改','取消修改'] //按钮
                        },function(){
                            if($(".newSafepwd").val()=="")
                            {
                                layer.tips('新的安全码不能为空', '.newSafepwd');
                                exit;
                            }
                            if($(".newSafepwdagain").val()=="")
                            {
                                layer.tips('确认安全码不能为空', '.newSafepwdagain');
                                exit;
                            }
                            if($(".newSafepwd").val()!=$(".newSafepwdagain").val())//两次输入的密码不相等
                            {
                                layer.tips('两次输入的安全码不一致', '.newSafepwdagain');
                                exit;
                            }
                            
                            //检查通过修改密码
                            $.ajax({
                    			type:"POST",
                    			url:"<?php echo $this->createUrl('user/changSafepwd');?>",
                    			data:{"newSafepwd":$(".newSafepwd").val()},
                    			success:function(msg)
                    			{
                                    if(msg=="SUCCESS")
                                    {
                        				layer.confirm('安全码修改成功', {
                                        	btn: ['知道了'] //按钮
                                        },function(){
                                            window.parent.location.reload();//刷新父级页面
                                    	    var index = parent.layer.getFrameIndex(window.name);//获取窗口索引
                                    	    parent.layer.close(index);//关闭父级
                                        });
                                    }else
                                    {
                                        layer.confirm('<span style="color:red;">安全码修改失败，您可以联系我们的客服人员</span>', {
                                        	btn: ['知道了'] //按钮
                                        },function(){
                                            window.parent.location.reload();//刷新父级页面
                                    	    var index = parent.layer.getFrameIndex(window.name);//获取窗口索引
                                    	    parent.layer.close(index);//关闭父级
                                        });
                                    }
                    			}
                    		});
                            
                        },function(){
                            location.reload();//重新加载当前页面
                        });
                            //找回安全码即设置新的安全码结束
                        }else if(msg=="CODEFAIL")
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
                return false;
            }
    	});  
    })
    
    var countdown=60; 
    function settime(obj) { 
    if (countdown == 0) { 
        obj.removeAttribute("disabled");    
        obj.value="免费获取验证码"; 
        countdown = 60; 
        return;
    } else {
        if(countdown==60)//只发送1次
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