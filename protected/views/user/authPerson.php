<link rel="stylesheet" type="text/css" href="<?php echo ASSET_URL;?>Auth/css/css.css"/>

<div class="main" style="margin-bottom: 20px;"><!--main start-->

    <div class="rzTitle"><!--rzTitle start-->

        <ul>

            <li><a class="titleActive">威客实名认证</a></li>

            <li><a href="javascript:;" class="taoneimoAuth"></a></li>

            <li><a href="javascript:;" onclick="history.go(-1)" style="cursor: pointer;" >暂不进行认证</a></li>

        </ul>

    </div><!--rzTitle end-->

    <?php

        $userInfo=User::model()->findByPk(Yii::app()->user->getId()); 

        $arrowPos=320;

        if($userInfo->AuthPersonStep1==0)

            $arrowPos=320;

        else if($userInfo->AuthPersonStep2==0)

            $arrowPos=530;

        else

            $arrowPos=710;

    ?>

    <style>

    .rzProcess ul a.itemgreen{ background:#76b010;}

    </style>

    <div class="rzProcess"><!---rzProcess start-->

    	<ul>

        	<a class="processActive"><font>1</font>实名资料填写上传</a>

            <a <?php echo $userInfo->AuthPersonStep1==1?'class="itemgreen"':'';?>><font>2</font>视频认证</a>

            <a <?php echo $userInfo->AuthPersonStep2==1?'class="itemgreen"':'';?>><font>3</font>审核成功</a>

        </ul>

        <div class="clear"></div>

    </div><!---rzProcess end-->

    <div class="pointStep"><img src="<?php echo ASSET_URL;?>Auth/images/arrowtop.png" style="margin-left:<?php echo $arrowPos;?>px;" width="22" /></div>

    <div class="rzContent"><!--rzContent start-->

    	 <div class="topWarning"><!--topWarning start-->

         	<span>当前是会员认证：本站已工信部备案，平台将严格保密会员资料；</span>

         </div><!--topWarning end-->

         <form id="autoPersonInfo">

         <div class="fillInfo"><!--fillInfo start-->

              <?php

                  if($userInfo->AuthPerson==0 && $userInfo->AuthPersonStep1==0){ 

              ?>

              <table border="0" class="personRzStep1" cellspacing="0" cellpadding="0" style="width:95%; margin:0 20px; line-height:40px; margin-top:20px; background:url(<?php echo ASSET_URL;?>Auth/images/warning.png) no-repeat 560px 0px;">

                <tr>

                  <td width="150"><div align="right"><font>* </font>姓名：</div></td>

                  <td width="325"><input type="text" name="username" id="username" class="normalInput" /></td>

                  <td width="487">&nbsp;</td>

                  <td width="11">&nbsp;</td>

                </tr>

                <tr>

                  <td><div align="right"><font>* </font>身份证号 ：</div></td>

                  <td><input type="text" name="idcardnumber" id="idcardnumber" class="normalInput" /></td>

                  <td>&nbsp;</td>

                  <td>&nbsp;</td>

                </tr>

                <tr>

                  <td><div align="right"><font>* </font>本人财付通帐号：</div></td>

                  <td><input type="text" name="cftaccount" id="cftaccount" class="normalInput" /></td>

                  <td>&nbsp;</td>

                  <td>&nbsp;</td>

                </tr>

                <tr>

                  <td><div align="right"><font>* </font>本人支付宝帐号：</div></td>

                  <td><input type="text" name="zfbaccount" id="zfbaccount" class="normalInput" /></td>

                  <td>&nbsp;</td>

                  <td>&nbsp;</td>

                </tr>

                <tr>

                  <td><div align="right"><font>* </font>QQ：</div></td>

                  <td><input type="text" name="qq" id="qq" class="normalInput" readonly="readonly" value="<?php echo $userInfo->QQToken;?>" style="background: #ccc;" /></td>

                  <td>&nbsp;</td>

                  <td>&nbsp;</td>

                </tr>

                <tr>

                  <td><div align="right"><font>* </font>地址：</div></td>

                  <td>

                  	<select class="select" name="province" id="s1">

                      <option></option>

                    </select>

                    <select class="select" name="city" id="s2">

                      <option></option>

                    </select>

                    <select class="select" name="town" id="s3">

                      <option></option>

                    </select>

                  </td>

                  <td>&nbsp;</td>

                  <td>&nbsp;</td>

                </tr>

                <tr>

                  <td><div align="right">详细街道：</div></td>

                  <td><input type="text" name="street" id="yqcode" class="normalInput" /></td>

                  <td>&nbsp;</td>

                  <td>&nbsp;</td>

                </tr>

                <tr>

                  <td><div align="right"><font>* </font>手机号码：</div></td>

                  <td><input type="text" name="telephone" id="telephone" readonly="readonly" class="normalInput" value="<?php echo $userInfo->Phon;?>" style="background: #ccc;"/></td>

                  <td>&nbsp;</td>

                  <td>&nbsp;</td>

                </tr>

                <tr>

                  <td><div align="right"><font>* </font>验证码：</div></td>

                  <td>

                    <div style="position: relative;">

                        <input type="text" name="phonecode" id="phonecode" class="normalInput" />

                        <input type="button" id="btn" class="getCode" style="width: 95px; height:30px; position:absolute; top:0px; left:200px; border: none;" value="获取验证码" onclick="settime(this)" />

                    </div>

                  </td>

                  <td>&nbsp;</td>

                  <td>&nbsp;</td>

                </tr>

                <tr>

                  <td><div align="right"><font>* </font>身份证正面：</div></td>

                  <td><input type="text" placeholder="点击上传" name="zmidcard" id="zmidcard" class="normalInput" readonly="readonly" style="background: #F0F0F0; cursor: pointer;" /><input type="button" id="bt1" value="上传身份证" style="font-weight: normal; padding:0 8px; border:none; background:#3498db; color:#fff; width:auto; height:30px; font-size:12px; cursor: pointer;"></td>

                  <td><img src="<?php echo ASSET_URL;?>Auth/images/rzimg01.jpg" style="margin-bottom:20px;" align="left" />　<span class="introduceinfo">请上传身份证正面扫描件，不可涂抹模糊！</span></td>

                  <td>&nbsp;</td>

                </tr>

                <tr>

                  <td><div align="right"><font>* </font>手持身份证：</div></td>

                  <td><input type="text" placeholder="点击上传" name="handwithidcard" id="handwithidcard" class="normalInput" readonly="readonly"  style="background: #F0F0F0; cursor: pointer;" /><input type="button" id="bt2" value="上传身份证" style="font-weight: normal; padding:0 8px; border:none; background:#3498db; color:#fff; width:auto; height:30px; font-size:12px; cursor: pointer;"></td>

                  <td><img src="<?php echo ASSET_URL;?>Auth/images/rzimg02.jpg" style="margin-bottom:20px;" align="left" />　<span class="introduceinfo">本人手持身份证正面拍照！身份证离相机近一点</span></td>

                  <td>&nbsp;</td>

                </tr>

                <tr>

                  <td><div align="right"><font>* </font>身份证反面照：</div></td>

                  <td><input type="text" placeholder="点击上传" name="lifephoto" id="lifephoto" class="normalInput" readonly="readonly" style="background: #F0F0F0; cursor: pointer;"/><input type="button" id="bt3" value="上传身份证" style="font-weight: normal; padding:0 8px; border:none; background:#3498db; color:#fff; width:auto; height:30px; font-size:12px; cursor: pointer;"></td>

                  <td><img src="<?php echo ASSET_URL;?>Auth/images/rzimg03.jpg" style="margin-bottom:20px;" align="left" />　<span class="introduceinfo">身份证反面照</span></td>

                  <td>&nbsp;</td>

                </tr>

                <tr>

                  <td colspan="4"><div style="padding:10px;"><a href="javascript:;" class="sendStep1">实名认证提交</a></div></td>

                </tr>

              </table>

              <?php

                }

                if($userInfo->AuthPerson==0 && $userInfo->AuthPersonStep1==1 && $userInfo->AuthPersonStep2==0){ 

              ?>

              <div class="personRzStep2">

              	请加管理员QQ进行视频认证

              </div>

              <?php 

                }

                if($userInfo->AuthPerson==1 && $userInfo->AuthPersonStep1==1 && $userInfo->AuthPersonStep2==1){ 

              ?>

              <div class="personRzStep3">

              	<img src="<?php echo ASSET_URL;?>Auth/images/pass.png" width="50" />　恭喜您已成功通过个人实名认证

              </div>

              <?php }?>

         </div><!--fillInfo end-->

         </form>

    </div><!--rzContent end-->

</div><!--main end-->

<script src="<?php echo VERSION2;?>js/jquery.js"></script>

<!--上传图片-->

<link rel="stylesheet" href="<?php echo ASSET_URL;?>kindeditor/themes/default/default.css" />

<script src="<?php echo ASSET_URL;?>kindeditor/kindeditor.js"></script>

<script src="<?php echo ASSET_URL;?>kindeditor/lang/zh_CN.js"></script>



<script>

    KindEditor.ready(function(K) {

		var editor = K.editor({

			allowFileManager : true

		});

		K('#zmidcard,#bt1').click(function() {

			editor.loadPlugin('image', function() {

				editor.plugin.imageDialog({

					showRemote : false,

					imageUrl : K('#zmidcard').val(),

					clickFn : function(url, title, width, height, border, align) {

						K('#zmidcard').val(url);

						editor.hideDialog();

					}

				});

			});

		});

        

        K('#handwithidcard,#bt2').click(function() {

			editor.loadPlugin('image', function() {

				editor.plugin.imageDialog({

					showRemote : false,

					imageUrl : K('#handwithidcard').val(),

					clickFn : function(url, title, width, height, border, align) {

						K('#handwithidcard').val(url);

						editor.hideDialog();

					}

				});

			});

		});

        

        K('#lifephoto,#bt3').click(function() {

			editor.loadPlugin('image', function() {

				editor.plugin.imageDialog({

					showRemote : false,

					imageUrl : K('#lifephoto').val(),

					clickFn : function(url, title, width, height, border, align) {

						K('#lifephoto').val(url);

						editor.hideDialog();

					}

				});

			});

		});

	});

</script>



<!--地区三级联动-->

<script src="<?php echo ASSET_URL;?>Auth/js/Area.js" type="text/javascript"></script>

<script>

setup();preselect('江苏省');promptinfo();

function promptinfo()

{

	var address = document.getElementById('address');

	var s1 = document.getElementById('s1');

	var s2 = document.getElementById('s2');

	var s3 = document.getElementById('s3');

	address.value = s1.value + s2.value + s3.value;

}



</script>





<!--layer插件-->

<script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>

<script src="<?php echo ASSET_URL;?>layer/layer.js"></script>

<script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>

<link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" />

<script>

    $(function(){

        $(".sendStep1").click(function(){

            if($("#username").val()=="")

            {

                $("html,body").animate({scrollTop: $("#username").offset().top-100}, 300);

                layer.tips('真实姓名不能为空', '#username');

                exit;

            }

            if($("#idcardnumber").val()=="")

            {

                $("html,body").animate({scrollTop: $("#idcardnumber").offset().top-100}, 300);

                layer.tips('身份证号码不能为空', '#idcardnumber');

                exit;

            }

            if($("#cftaccount").val()=="")

            {

                $("html,body").animate({scrollTop: $("#cftaccount").offset().top-100}, 300);

                layer.tips('帐号不能为空', '#cftaccount');

                exit;

            }

            if($("#zfbaccount").val()=="")

            {

                $("html,body").animate({scrollTop: $("#zfbaccount").offset().top-100}, 300);s

                layer.tips('支付宝帐号不能为空', '#zfbaccount');

                exit;

            }

            if($("#qq").val()=="")

            {

                $("html,body").animate({scrollTop: $("#qq").offset().top-100}, 300);

                layer.tips('QQ号不能为空', '#qq');

                exit;

            }

            if($("#telephone").val()=="")

            {

                $("html,body").animate({scrollTop: $("#telephone").offset().top-100}, 300);

                layer.tips('手机号不能为空', '#telephone');

                exit;

            }

            if($("#phonecode").val()=="")

            {

                $("html,body").animate({scrollTop: $("#phonecode").offset().top-100}, 300);

                layer.tips('手机验证码不能为空', '#phonecode');

                exit;

            }

            if($("#zmidcard").val()=="")

            {

                $("html,body").animate({scrollTop: $("#zmidcard").offset().top-100}, 300);

                layer.tips('身份证正面照片不能为空', '#zmidcard');

                exit;

            }

            if($("#handwithidcard").val()=="")

            {

                $("html,body").animate({scrollTop: $("#handwithidcard").offset().top-100}, 300);

                layer.tips('手持身份证照片不能为空', '#handwithidcard');

                exit;

            }

            if($("#lifephoto").val()=="")

            {

                $("html,body").animate({scrollTop: $("#lifephoto").offset().top}, 1000);

                layer.tips('身份证反面照片不能为空', '#lifephoto');

                exit;

            }

            

            //发送手机号与验证码去验证正确性

            $.ajax({

    			type:"POST",

    			url:"<?php echo $this->createUrl('user/userCheckPhoneAndCode');?>",

    			data:{"phone":$("#telephone").val(),"phoneCode":$("#phonecode").val()},

    			success:function(msg)

    			{

    				if(msg=="SUCCESS")//手机验证码成功

                    {

                        //ajax提交个人认证所需资料

                        $.ajax({

                			type:"POST",

                			url:"<?php echo $this->createUrl('user/authPerson');?>",

                			data:$("#autoPersonInfo").serialize(),

                			success:function(msg)

                			{

                                if(msg=='SUCCESS')//通过考试

                                {

                                    //询问框

                                	layer.confirm('资料提交成功，下一步请与管理员联系进行视频认证', {

                                		btn: ['知道了'] //按钮

                                	},function(){

                                	  location.reload();

                                	});

                                }else//考试失败

                                {

                                    layer.confirm('<span style="color:red;">资料提交失败，请联系管理人员</span>', {

                                		btn: ['知道了'] //按钮

                                	});

                                }

                			}

                		});//ajax

                    }else if(msg=="CODEFAIL")

                    {

                        //询问框

                    	layer.confirm('<span style="color:red;">验证码不正确</span>，请检查您收到的短信验证码', {

                            btn: ['知道了'] //按钮

                    	},function(){

                    	    $(".layui-layer-shade").hide();

                            $(".layui-layer").hide();

                            $("html,body").animate({scrollTop: $("#phonecode").offset().top-100}, 300);

                            layer.tips('手机验证码不能为空', '#phonecode');

                    	});

                    }else

                    {

                        //询问框

                    	layer.confirm('<span style="color:red;">手机号请不要更改</span>，请使用接收短信的手机号码', {

                   		   btn: ['知道了'] //按钮

                    	},function(){

                    	    $("html,body").animate({scrollTop: $("#telephone").offset().top-100}, 300);

                            layer.tips('请填写接收短信的手机号码', '#telephone');

                            exit;

                    	});

                    }

    			}

    		});  

            //发送手机号与验证码去验证正确性 

        });  

        //提交资料结束

    })

    

    

    //发送验证码

    var countdown=300; 

    function settime(obj) { 

    if($("#telephone").val()=="")//手机号码为空

    {

        layer.tips('请输入新的手机号码', '#telephone');

        exit;

    }

    else if (countdown == 0) { 

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

    			data:{"phone":$("#telephone").val(),"phoneCode":"DOIT"},

    			success:function(msg)

    			{

                    if(msg=="SUCCESS")

                    {

                        $("#telephone").attr("readyonle","readyonle");

                        $("#telephone").css("background","#ccc");

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

    

    //淘内幕认证

    $(".taoneimoAuth").click(function(){

        $.ajax({

			type:"POST",

			url:"<?php echo $this->createUrl('user/authPerson');?>",

			data:{"taoneimo":"DOIT"},

			success:function(msg)

			{

                if(msg=='SUCCESS')//通过考试

                {

                    //询问框

                	layer.confirm('您已提交淘内幕审核', {

                		btn: ['知道了'] //按钮

                	},function(){

                	  location.reload();

                	});

                }else//考试失败

                {

                    layer.confirm('<span style="color:red;">提交失败，请联系管理人员</span>', {

                		btn: ['知道了'] //按钮

                	});

                }

			}

		});//ajax

    });

</script>