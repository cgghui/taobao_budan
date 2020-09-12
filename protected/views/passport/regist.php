<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>会员注册</title>
<link href="<?php echo VERSION2;?>css/mlw.css" rel="stylesheet" type="text/css" />
</head>
<script src="<?php echo VERSION2;?>js/jquery.min.js"></script>
<script src="<?php echo VERSION2;?>js/tanchu.js"></script>
<style>
tr{ line-height: 58px;}
</style>
<body>
	<div class="d_bg">
    	<div class="d_center" style="margin-top: 50px; position: relative;">
            <div style="position:absolute; top:12px;"><span style="padding-left: 42px; font-size:18px; color:#57a0ff; font-weight:bold;">您当前IP：<?php echo XUtils::getClientIP();?></span></div>
        	<div class="d_logo">
            	<div class="d_logo_left"><img src="<?php echo VERSION2;?>img/logo.png" /></div>
                <div class="d_logo_right"><img src="<?php echo VERSION2;?>img/slogan.png" /></div>
            </div>
            <div class="clear"></div>
            <form class="registerform" method="post" action="<?php echo $this->createUrl('passport/regist');?>" style="color: #fff;">
              <table border="0" cellspacing="0" cellpadding="0">
                <tr>
                  <td width="60%">
                    <input type="text" name="User[Username]" placeholder="会员名" class="inputxt zhuceItem"  ajaxurl="<?php echo $this->createUrl('passport/checkUser');?>" datatype="s4-20" nullmsg="请输入会员帐号" errormsg="请输入会员帐号"/>
                    <input type="hidden" name="userid" value="<?php if(isset($_GET['userid'])) echo @$_GET['userid'];?>" />  
                  </td>
                  <td width="36%"><div class="Validform_checktip">请输入会员帐号</div></td>
                </tr>
                <tr>
                  <td><input type="password" name="User[PassWord]" placeholder="登录密码" class="inputxt zhuceItem" plugin="passwordStrength" datatype="*" errormsg="请输入会员密码" nullmsg="请输入会员密码"></td>
                  <td><div class="Validform_checktip">请输入会员密码</div></td>
                </tr>
                <tr style="line-height: 18px;">
                    <td><div class="passwordStrength" style="position: relative; left: 40px;"><span>弱</span><span>中</span><span class="last">强</span></div></td>
                    <td></td>
                </tr>
                <tr>
                  <td><input type="password" name="certainPWD" placeholder="确认密码"  class="regInput inputxt zhuceItem" datatype="*" recheck="User[PassWord]" nullmsg="请再次输入密码" errormsg="您两次输入的账号密码不一致。" /></td>
                  <td><div class="Validform_checktip">请再次输入密码</div></td>
                </tr>
                <tr>
                  <td><input type="text" name="User[Phon]" placeholder="手机号码" class="zhuceItem"  ajaxurl="<?php echo $this->createUrl('passport/checkMobile');?>"  datatype="m" errormsg="您的手机格式不正确" nullmsg="请输入手机号码"/></td>
                  <td><div class="Validform_checktip">请输入手机号码</div></td>
                </tr>
                <tr>
                  <td><input type="text" name="User[QQToken]" onBlur="pubEamil()" placeholder="QQ号" ajaxurl="<?php echo $this->createUrl('passport/checkQQ');?>" id="qq" class="zhuceItem" datatype="n" errormsg="QQ格式不正确" nullmsg="请输入QQ号"/></td>
                  <td><div class="Validform_checktip">请填写您的QQ号</div></td>
                </tr>
                <tr>
                  <td><input type="text" name="User[Email]" id="email" placeholder="邮箱" class="zhuceItem"  ajaxurl="<?php echo $this->createUrl('passport/checkEmail');?>" datatype="e" errormsg="您的邮箱格式不正确" nullmsg="请输入邮箱"/></td>
                  <td><div class="Validform_checktip">请输入邮箱</div></td>
                </tr>
                <tr style="line-height:15px;">
                  <td colspan="2">
                    <a class="d_xieyi"><<注册服务协议>></a>
                  </td>
                </tr>
                <tr style="text-align: center;">
                  <td colspan="2">
                    <div align="cneter">
                        <input type="submit" class="d_anniu" border="0"  value="同意协议并注册" style="border: none; margin-left: 40px;"/>
                        <a class="d_zhanghao" onclick="window.location.href='<?php echo $this->createUrl('passport/login');?>'">已有账号，登录 >></a>
                    </div>
                  </td>
                </tr>
              </table>
            </form>
        </div>
        <div class="d_fuwuxieyi">
        	<div class="d_fuwuxieyi_top">
            	<div class="d_left"><img src="<?php echo VERSION2;?>img/logo-s.png" /></div>
                <p class="mili">《注册服务协议》</p>
                <a class="f_right">×</a>
            </div>
            <?php
                $registneedToKnow=System::model()->findByAttributes(array("varname"=>"registneedToKnow"));
            ?>
            <div class="d_content">
            	<?php 
                    echo $registneedToKnow->value;
                ?>
            </div>
        </div>
    </div>
</body>
 <!--layer插件-->
<script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>
<script src="<?php echo ASSET_URL;?>layer/layer.js"></script>
<script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>
<link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" />
<!--注册登录检测-->
<link rel="stylesheet" href="<?php echo ASSET_URL;?>Validform/css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="<?php echo ASSET_URL;?>Validform/js/Validform_v5.3.2_min.js"></script>
<script type="text/javascript" src="<?php echo ASSET_URL;?>Validform/plugin/passwordStrength/passwordStrength-min.js"></script>
<script type="text/javascript">
$(function(){
	/*$(".registerform").Validform({
		tiptype:2,
		callback:function(form){
			if(check=1){
				form[0].submit();
			}
			return false;
		}
	});*/
    $(".registerform").Validform({
		tiptype:2,    
        usePlugin:{
			passwordstrength:{
				minLen:6,
				maxLen:20
			}
		}
	});
    
})

function pubEamil()
{
    $("#email").val($("#qq").val()+'@qq.com');
}
    
</script>
<style>
.Validform_checktip{ color:#ccc;}
.Validform_wrong{ color:red;}
</style>
<?php 
    //如果注册成功
    if(isset($_GET['regist']) && $_GET['regist']=="registDONE"){
?>
    <script>
        $(function(){
            //询问框
        	layer.confirm('<span style="color:red;">恭喜您注册成功！</span>', {
       		   btn: ['立即登录','再逛逛'] //按钮
        	},function(){
        	   window.location.href='<?php echo $this->createUrl('passport/login');?>';
        	});
        })
    </script>
<?php }?>
</html>
