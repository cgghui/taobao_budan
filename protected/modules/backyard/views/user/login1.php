<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>游戏平台管理后台</title>
<link rel="stylesheet" type="text/css" href="<?php echo WEB_ADMIN_CSS_URL;?>style.css"/>
<link href="<?php echo IMG_URL;?>skin.css" rel="stylesheet" type="text/css">
<script src="<?php echo WEB_ADMIN_JS_URL;?>jquery.js" type="text/javascript"></script>
<style>
.boxOut{ width:100%; height:1000px; background:url(<?php echo WEB_ADMIN_IMG_URL;?>boxout.png); position:fixed; z-index:1000; left:0; top:0;}
.bookBox{ width:460px; height:auto; background:#fff; position:fixed; _position:absolute; padding-bottom:15px;}
.enterArea{width:263px; height:36px; text-indent:10px; font-size:14px; line-height:36px; display:inline; color:#666; border:none; background:url(<?php echo WEB_ADMIN_IMG_URL;?>inputbg.jpg) no-repeat;}
.yzm{width:163px; height:36px; text-indent:10px; font-size:14px; line-height:36px; display:inline; color:#666; position:relative; left:25px; border:none; background:url(<?php echo WEB_ADMIN_IMG_URL;?>inputbgyzm.jpg) no-repeat;}
.errorMessage{ color:red;}
</style>
<script language="JavaScript">
function correctPNG()
{
    var arVersion = navigator.appVersion.split("MSIE")
    var version = parseFloat(arVersion[1])
    if ((version >= 5.5) && (document.body.filters)) 
    {
       for(var j=0; j<document.images.length; j++)
       {
          var img = document.images[j]
          var imgName = img.src.toUpperCase()
          if (imgName.substring(imgName.length-3, imgName.length) == "PNG")
          {
             var imgID = (img.id) ? "id='" + img.id + "' " : ""
             var imgClass = (img.className) ? "class='" + img.className + "' " : ""
             var imgTitle = (img.title) ? "title='" + img.title + "' " : "title='" + img.alt + "' "
             var imgStyle = "display:inline-block;" + img.style.cssText 
             if (img.align == "left") imgStyle = "float:left;" + imgStyle
             if (img.align == "right") imgStyle = "float:right;" + imgStyle
             if (img.parentElement.href) imgStyle = "cursor:hand;" + imgStyle
             var strNewHTML = "<span " + imgID + imgClass + imgTitle
             + " style=\"" + "width:" + img.width + "px; height:" + img.height + "px;" + imgStyle + ";"
             + "filter:progid:DXImageTransform.Microsoft.AlphaImageLoader"
             + "(src=\'" + img.src + "\', sizingMethod='scale');\"></span>" 
             img.outerHTML = strNewHTML
             j = j-1
          }
       }
    }    
}
window.attachEvent("onload", correctPNG);
</script>
<script type="text/javascript">
/*<![CDATA[*/
jQuery(function($) {

jQuery(document).on('click', '#yw1', function(){
	jQuery.ajax({
		url: "/index.php/admin\/user\/captcha\/refresh\/1",//验证码配置，域名为当前域名，如果不正确则无法刷新
		dataType: 'json',
		cache: false,
		success: function(data) {
			jQuery('#yw1').attr('src', data['url']);
			jQuery('body').data('captcha.hash', [data['hash1'], data['hash2']]);
		}
	});
	return false;
});

});
/*]]>*/
</script>
</head>

<body>
<div class="boxOut"><!--boxOut start-->
    <div class="bookBox"><!--bookBox start-->
        <div class="closeBox" lang="boxOut"><img src="<?php echo WEB_ADMIN_IMG_URL;?>close.jpg"  style="cursor:pointer;"/></div>
        <div class="clear"></div>
        <div class="loginArea"><!--loginArea start-->
        	<?php $form=$this->beginWidget('CActiveForm');?>
            	<table style="font-size:14px; line-height:46px; width:460px; margin:0 auto; text-align:center; color:#999;">
                	<tr>
                    	<td><div align="center">帐　号</div></td>
                        <td colspan="2"><?php echo $form->textField($userLoginObj,'username',array("class"=>"enterArea"));?></td>
                        <td width="21%"><?php echo $form->error($userLoginObj,'username');?></td>
                    </tr>
                    <tr>
                    	<td><div align="center">密　码</div></td>
                        <td colspan="2"><?php echo $form->passwordField($userLoginObj,'password',array("class"=>"enterArea"));?></td>
                        <td><?php echo $form->error($userLoginObj,'password');?></td>
                    </tr>
                    <!--验证码开始-->
                      <?php if(extension_loaded('gd')): //if(CCaptcha::checkRequirements()):?>
                      <tr>
                        <td width="14%" height="35" class="top_hui_text"><div align="center">验证码</div></td>
                        <td width="31%" height="35" class="top_hui_text" style="text-align:center;">
							<?php echo $form->textField($userLoginObj,'verifyCode',array("class"=>"yzm")); ?></td>
                        <td width="33%" class="top_hui_text"><?php $this->widget('CCaptcha',array('showRefreshButton'=>false,'clickableImage'=>true,'imageOptions'=>array('alt'=>'点击换图','title'=>'点击换图','style'=>'cursor:pointer'))); ?></td>
                        <td class="top_hui_text">
							<?php echo $form->error($userLoginObj,'verifyCode');?>
                        </td>
                        <td width="1%"></td>
                      </tr>
                      <?php endif; ?>
                      <!--验证码结束-->
                    <tr>
                    	<td></td>
                        <td colspan="2"><input type="submit" border="" value="" style="width:263px; height:38px; background:url(<?php echo WEB_ADMIN_IMG_URL;?>loginBtn.jpg) no-repeat; border:0; cursor:pointer;" /></td>
                        <td></td>
                    </tr>
                    <tr>
                    	<td></td>
                        <td colspan="2"></td>
                        <td></td>
                    </tr>
                </table>
            </form>
        </div><!--loginArea end-->
    </div><!--bookBox end-->
</div><!--boxOut end-->
<?php $this->endWidget();?>
<script>
	$(function(){
		setTimeout("showBox()",10);
	})
	function showBox(){
		$(".boxOut").css("display","block");
		var boxHeight=$(".bookBox").height();
		var boxWidth=$(".bookBox").width();
		var topVal=($(window).height()-boxHeight)/2;
		var leftVal=($(window).width()-boxWidth)/2;
		$(".bookBox").css({"top":topVal,"left":leftVal});	
	}
</script>
</body>
</html>
