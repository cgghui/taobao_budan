<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员登录</title>
<link href="<?php echo VERSION2;?>css/mlw.css" rel="stylesheet" type="text/css" />
</head>

<body>
	<div class="d_bg">
        <div class="d_zc_con">
        	<div class="d_zc_top"><a href="/"><img src="<?php echo VERSION2;?>img/logo.png" /></a></div>
            <div class="d_zc_top1"><img src="<?php echo VERSION2;?>img/slogan.png" /></div>
            <div class="d_zc_input">
            	<form class="loginArea" method="post" onsubmit="return checkLogin()" action="<?php echo $this->createUrl('passport/login');?>">
                	<ul>
                    	<li><input type="text" name="User[Username]" class="zhuce lusername" placeholder="用户名" /></li>
                        <li><input type="password" name="User[PassWord]" class="zhuce lpassword" placeholder="密码" /></li>
                        <li style=" color:#fff;"><input name="User[rememberMe]" type="checkbox" style="position: relative; top: 1px; width:12px; height:12px;" /> 下次自动登录<a href="javascript:;" class="forgetPwd" style=" float:right; margin-right:28px; color:white;">忘记密码?</a></li>
                        <li><button class="dl" style=" border:none; margin: 0;">登录</button></li>
                        <li style="color: #197cfd; font-size: 14px; font-weight: bold;"><?php echo @$wrongWaring;?></li>
                    </ul>
                </form>
            </div>
            <div class="d_dianwo">
            	<a href="<?php echo $this->createUrl('passport/regist');?>">还没有账号？点击注册>> </a>
            </div>
        </div>
    </div>
</body>
<!--layer插件-->
<script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>
<script src="<?php echo ASSET_URL;?>layer/layer.js"></script>
<script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>
<link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" />
<script>
    $(function(){
        //忘记密码
        $(".forgetPwd").click(function(){
            layer.open({
                type: 2,
                title:'找回密码',
                area: ['368px','220px'],
                skin: 'layui-layer-rim', //加上边框
                content: ['<?php echo $this->createUrl('passport/forgetPwd');?>', 'no']
            });
        });
    })

    //登录表单检测
    function checkLogin()
    {
        if($(".lusername").val()=="")
        {
            layer.tips('用户名不能为空', '.lusername');
            return false;
        }else if($(".lpassword").val()=="")
        {
            layer.tips('密码不能为空', '.lpassword');
            return false;
        }else
        {
            var submitStatus=0;//提交状态初始化
            var phone=0;//手机号码初始化
            //检查是否开启异地登录
            $.ajax({
    			type:"POST",
    			url:"<?php echo $this->createUrl('passport/placeOtherLogin');?>",
    			data:{"username":$(".lusername").val(),"pwd":$(".lpassword").val()},
                async:false,
    			success:function(msg)
    			{
    				if(msg=="true")//不用检测
                    {
                        submitStatus=1;
                    }else if(msg=="FAIL")//用户名或密码不正确
                    {
                        
                    }
                    else if(msg=="LOCK")//用户帐户被冻结
                    {
                        submitStatus=3;
                    }else//需要发送手机验证码
                    {
                        phone=msg;//赋值用户手机号
                        submitStatus=2;
                    }
    			}
    		});
            /*alert(submitStatus);
            exit;*/
            //检查是否开启异地登录
            if(submitStatus==0)//用户名密码不正确
            {
                layer.tips('用户名或密码不正确', '.lusername', {
                    tips: [1, '#0FA6D8'] //还可配置颜色
                });
                return false;
            }else if(submitStatus==3)
            {
                //询问框
            	layer.confirm('<span style="color:red;">您的帐户已被冻结，如有需要请联系客服人员</span>', {
           		   btn: ['知道了'] //按钮
            	});
                return false;
            }else if(submitStatus==1)//直接提交
            {
                return true;
            }else//2表示需要发送短信验证码
            {
                //发送验证码
                $.ajax({
        			type:"POST",
        			url:"<?php echo $this->createUrl('site/sms');?>",
        			data:{"phone":phone,"phoneCode":"DONE"},
                    async:false,
        			success:function(msgCode)
        			{
                        if(msgCode=="SUCCESS")
                        {
            				//询问框
                        	layer.confirm('<span style="color:red;">短信发送成功(异地登录请输入手机验证码)</span><br/>验证码<input class="text1 phoneCodeVal" name="phoneCodeVal" />', {
                       		   btn: ['确定提交'] //按钮
                        	},function(){
                        	   if($(".phoneCodeVal").val()=="")//验证码不为空
                               {
                                    layer.tips('验证码不能为空', '.phoneCodeVal');
                               }else{
                            	   //发送手机号与验证码去验证正确性
                                    $.ajax({
                            			type:"POST",
                            			url:"<?php echo $this->createUrl('passport/userCheckPhoneAndCode');?>",
                            			data:{"phone":phone,"phoneCode":$(".phoneCodeVal").val()},
                                        async:false,
                            			success:function(msgCertain)
                            			{
                            				if(msgCertain=="SUCCESS")//手机验证码检测通过
                                            {
                                                //验证通过直接进行提交登录
                                                $.ajax({
                                        			type:"POST",
                                        			url:"<?php echo $this->createUrl('passport/codePassLogin');?>",
                                        			data:{"username":$(".lusername").val(),"pwd":$(".lpassword").val()},
                                                    async:false,
                                        			success:function(msglogin)
                                        			{
                                        				if(msglogin=="SUCCESS")//登录成功刷新当前页面
                                                        {
                                                            location.reload();
                                                        }else//登录异常刷新当前页面
                                                        {
                                                            //询问框
                                                        	layer.confirm('<span style="color:red;">登录异常</span>，您可以联系客服人员', {
                                                       		   btn: ['知道了'] //按钮
                                                        	});
                                                        }
                                        			}
                                        		});
                                                //验证通过直接进行提交登录
                                            }else if(msgCertain=="CODEFAIL")//验证不正确
                                            {
                                            	layer.tips('验证码不正确', '.phoneCodeVal');
                                            }else//手机号异常
                                            {
                                                layer.tips('手机号码异常', '.phoneCodeVal');
                                            }
                            			}
                            		});
                                    //发送手机号与验证码去验证正确性
                                }
                        	});
                        }else
                        {
                            //询问框
                        	layer.confirm('<span style="color:red;">异地登录验证-短信发送失败，可能发送次数过多</span>，您可以联系客服人员', {
                       		   btn: ['知道了'] //按钮
                        	});
                            phoneAndCodeCheckStatus=0;
                        }
        			}
        		});
                //发送短信验证码结束
                return false;
            }
        }  
    }
</script>
</html>
