<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>玩转各大电商-诚信通，为你解开电商成功的密码！</title>

<link rel="stylesheet" type="text/css" href="<?php echo ZXJY_CSS_URL;?>css.css"/>
<script src="<?php echo ZXJY_JS_URL;?>jquery.js" type="text/javascript"></script>
</head>

<body>
<div class="topOut" style="height: 26px; overflow: hidden; border-bottom: 3px solid #f6bc87;"><!--topOut start-->
    <div class="topMain"><!--topMain start-->
    	<div class="topInfo">
        	<div class="topInfoLeft">为您解开电商的成功密码，诚信通因为你的电商传奇而存在!</div>
            <div class="topInfoRight">
                <?php
                    if(Yii::app()->user->getIsGuest())
                        echo "您好，加入诚信通电商俱乐部！";
                    else
                        echo "亲爱的".Yii::app()->user->getName().",欢迎登录您";
                ?>
                <?php
                    if(Yii::app()->user->getId())
                    {
                ?>
                <a href="<?php echo $this->createUrl('user/index');?>">【我的诚信通】</a>
                <a href="<?php echo $this->createUrl('site/loginout');?>">【退出】</a>
                <?php
                    }
                ?>
            <?php
                if(Yii::app()->user->getIsGuest())
                {
            ?>
                <a href="<?php echo $this->createUrl('passport/login');?>" style="padding-left:20px;">【请登录】</a>　<a href="<?php echo $this->createUrl('passport/regist');?>">【免费注册】</a>
            <?php
                }
            ?>
            </div>
        </div>
        <div class="clear"></div>
     </div>
</div>
<?php echo $content;?>
<script src="<?php echo WEB_SITE_JS_URL?>loginWindow.js" type="text/javascript"></script><!--登录弹窗JS-->
<!--注册登录检测-->
<link rel="stylesheet" href="<?php echo FORM_CSS_URL;?>style.css" type="text/css" media="all" />
<script type="text/javascript" src="<?php echo FORM_JS_URL;?>Validform_v5.3.2_min.js"></script>
<script type="text/javascript" src="<?php echo ASSET_URL;?>/checkForm/plugin/passwordStrength/passwordStrength-min.js"></script>
<script type="text/javascript">
$(function(){
    /*用户意见建议*/
    $(".advice").click(function(){
		$(".boxOut").show();
		var boxHeight=$(".bookBox").height();
		var boxWidth=$(".bookBox").width();
		var topVal=($(window).height()-boxHeight)/2;
		var leftVal=($(window).width()-boxWidth)/2;
		$(".bookBox").css({"top":topVal,"left":leftVal});
	});
    /*关闭弹出窗*/
    $(".closeBox").click(function(){
		$(".boxOut").fadeOut(500);
	});
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
		},
		datatype:{//传入自定义datatype类型【方式二】;
			"idcard":function(gets,obj,curform,datatype){
				//该方法由佚名网友提供;
			
				var Wi = [ 7, 9, 10, 5, 8, 4, 2, 1, 6, 3, 7, 9, 10, 5, 8, 4, 2, 1 ];// 加权因子;
				var ValideCode = [ 1, 0, 10, 9, 8, 7, 6, 5, 4, 3, 2 ];// 身份证验证位值，10代表X;
			
				if (gets.length == 15) {   
					return isValidityBrithBy15IdCard(gets);   
				}else if (gets.length == 18){   
					var a_idCard = gets.split("");// 得到身份证数组   
					if (isValidityBrithBy18IdCard(gets)&&isTrueValidateCodeBy18IdCard(a_idCard)) {   
						return true;   
					}   
					return false;
				}
				return false;
				
				function isTrueValidateCodeBy18IdCard(a_idCard) {   
					var sum = 0; // 声明加权求和变量   
					if (a_idCard[17].toLowerCase() == 'x') {   
						a_idCard[17] = 10;// 将最后位为x的验证码替换为10方便后续操作   
					}   
					for ( var i = 0; i < 17; i++) {   
						sum += Wi[i] * a_idCard[i];// 加权求和   
					}   
					valCodePosition = sum % 11;// 得到验证码所位置   
					if (a_idCard[17] == ValideCode[valCodePosition]) {   
						return true;   
					}
					return false;   
				}
				
				function isValidityBrithBy18IdCard(idCard18){   
					var year = idCard18.substring(6,10);   
					var month = idCard18.substring(10,12);   
					var day = idCard18.substring(12,14);   
					var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));   
					// 这里用getFullYear()获取年份，避免千年虫问题   
					if(temp_date.getFullYear()!=parseFloat(year) || temp_date.getMonth()!=parseFloat(month)-1 || temp_date.getDate()!=parseFloat(day)){   
						return false;   
					}
					return true;   
				}
				
				function isValidityBrithBy15IdCard(idCard15){   
					var year =  idCard15.substring(6,8);   
					var month = idCard15.substring(8,10);   
					var day = idCard15.substring(10,12);
					var temp_date = new Date(year,parseFloat(month)-1,parseFloat(day));   
					// 对于老身份证中的你年龄则不需考虑千年虫问题而使用getYear()方法   
					if(temp_date.getYear()!=parseFloat(year) || temp_date.getMonth()!=parseFloat(month)-1 || temp_date.getDate()!=parseFloat(day)){   
						return false;   
					}
					return true;
				}
				
			},
		"z2-4" : /^[\u4E00-\u9FA5\uf900-\ufa2d]{2,4}$/,
		}
	});
    
    //登录表单检测
    $(".loginArea").Validform({
		 tiptype:2,
         /*ajaxPost:true,
         callback:function(data){
			if(data.status=="y"){
				location.reload();//如果登录成功刷新当前页面
			}
            if(data.status=="n"){
                alert("ok");
				$(".warning").show().html("帐号或密码错误");
                setTimeout(function(){
                    $(".warning").fadeOut();
                },1000);
			}
		}  */  
	});
})
    //登录输入检测
    /*function checkLoginForm()
    {
        return true;
        if($(".loginUsername").val()=="")
        {
            alert('用户名不能为空！');
            $(".loginPassWord").focus();
            return false;
        } 
        
        if($(".loginPassWord").val()=="")  
        {
            alert('密码不能为空！');
            $(".loginUsername").focus();
            return false;
        }
        
        if($(".loginUsername").val()=="" && ".loginPassWord").val()!="")  
        {
            return false;
        }
    }*/
    
</script>
<!-- JiaThis Button BEGIN -->
<script type="text/javascript" src="http://v3.jiathis.com/code/jiathis_r.js?move=0&amp;btn=r1.gif" charset="utf-8"></script>
<!-- JiaThis Button END -->
</body>
</html>
