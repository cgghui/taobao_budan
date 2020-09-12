        <style>

            .setInside{ width:95%; height:auto; margin:20px auto;}

            .d_biaoti{ height:auto; padding-top:10px;}

            .registerform input{ width:230px; height:30px; border: 1px dashed #99C1F5;}

            table tr{ height:45px; line-height: 45px;}

            .getCode{ background: #FC772D ; border: none; border-radius: 5px; color:#fff; cursor: pointer;}

        </style>

        <!--第一次设置安全码-->

        <?php

            $userInfo=User::model()->findByPk(Yii::app()->user->getId());

        ?>

        <div class="d_qie8">

            <ul class="d_zhannei clearfix">

            	<li class="d_znli">手机绑定激活</li>

            </ul>

            <div class="d_biaoti clearfix">

                <div class="setInside">

                    <span style="color: red; line-height: 40px;">为您帐号安全，请将您的帐号绑定您的手机号码</span>

           	        <form class="registerform" method="post" action="<?php echo $this->createUrl('user/userPhonActive');?>">

                        <table>

                            <input type="hidden" name="setPhon" value="Done" />

                            <tr>

                              <td><input type="text" value="<?php echo $userInfo->Phon;?>" style="text-indent: 10px;" name="Phon" placeholder="手机号码" class="inputxt phone" datatype="m" errormsg="手机号码格式不正确" nullmsg="请输入您的手机号码"></td>

                              <td><div class="Validform_checktip">请输入您的手机号码</div></td>

                            </tr>

                            <tr>

                              <td><input type="text" style="text-indent: 10px; width:100px;" name="safePwdagain" placeholder="输入验证码"  class="regInput inputxt phoneCode" datatype="*" nullmsg="请输入验证码" errormsg="请输入验证码" />

                              <input type="button" id="btn" class="getCode" style="width: 125px;" value="获取验证码" onclick="settime(this)" />

                              </td>

                              <td><div class="Validform_checktip">请输入验证码</div></td>

                            </tr>

                            <tr>

                              <td colspan="2"><input type="submit" style="border-radius:5px; cursor: pointer; height:35px; line-height:35px; color:#fff; background:#57A0FF; margin-top:10px;" value="确认提交" /></td>

                            </tr>

                            <tr>

                        </table>

                    </form>

                </div>

            </div>

            <div class="clear"></div>

        </div>

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

        			url:"<?php echo $this->createUrl('user/userPhonActive');?>",

        			data:{"phone":$(".phone").val(),"phoneCode":$(".phoneCode").val()},

        			success:function(msg)

        			{

        				if(msg=="SUCCESS")

                        {

                            //询问框

                        	layer.confirm('恭喜您手机绑定激活成功', {

                       		   btn: ['知道了'] //按钮

                        	},function(){

                        	   window.location.href='<?php echo $this->createUrl('user/index');?>';

                        	});

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