<link rel="stylesheet" type="text/css" href="<?php echo ASSET_URL;?>Auth/css/css.css"/>

<div class="main" style="margin-bottom: 20px;"><!--main start-->

    <div class="rzTitle"><!--rzTitle start-->

        <ul>

            <li><a class="titleActive">绑定掌柜号</a></li>

            <li><a href="javascript:;" onclick="history.go(-1)" style="cursor: pointer;" >返回绑定掌柜</a></li>

        </ul>

    </div><!--rzTitle end-->

    <?php

        $userInfo=User::model()->findByPk(Yii::app()->user->getId()); 

        $authStoreinfo=Blindwangwang::model()->find(array(

            'condition'=>'userid='.Yii::app()->user->getId().' and authStoreStatus=0'

        ));

    ?>

    <div class="rzProcess"><!---rzProcess start-->

    	<ul>

        	<a class="processActive"><font>1</font>绑定店铺掌柜号认证</a>

            

            <a <?php echo $authStoreinfo && $authStoreinfo->authStoreStatus==1?'class="itemgreen"':'';?>><font>2</font>审核成功</a>

        </ul>

        <div class="clear"></div>

    </div><!---rzProcess end-->

    <div class="pointStep"><img src="<?php echo ASSET_URL;?>Auth/images/arrowtop.png" style="margin-left:220px;" width="22" /></div>

    <div class="rzContent"><!--rzContent start-->

    	 <div class="topWarning"><!--topWarning start-->

         	<span>在此页面提交掌柜号后，请联系客服人工审核；请（返回绑定掌柜）查询结果；</span>

         </div><!--topWarning end-->

         <div class="fillInfo"><!--fillInfo start-->

              <form id="autoStoreInfo">

              <?php

                if($authStoreinfo && $authStoreinfo->authStoreStep1==0 || $authStoreinfo==false){

              ?>

         	  <img src="<?php echo ASSET_URL;?>Auth/images/bangding.png" style=" margin:20px 0 0 210px;" />

              <table border="0" class="personRzStep1" cellspacing="0" cellpadding="0" style="width:65%; margin:0 auto; line-height:40px; margin-top:20px; background:url(<?php echo ASSET_URL;?>Auth/images/wangwang.png) no-repeat 330px 0px;">

                <tr>

                  <td width="150"><div align="right"><font>* </font>所属平台：</div></td>

                  <td width="325">

                    <select name="platform" style="width: 200px; height:30px; font-weight: bold; text-indent: 3px; border: 1px solid #ccc; border-radius: 5px; font-size:14px;"><!--所属平台-->

                        <option value="1">淘宝</option>

                        <option value="2">京东</option>

                    </select>

                  </td>

                  <td width="487">&nbsp;</td>

                  <td width="11">&nbsp;</td>

                </tr>

                <tr>

                  <td width="150"><div align="right"><font>* </font>掌柜号：</div></td>

                  <td width="325">

                    <input type="text" name="wangwang" id="wangwang" class="normalInput" />

                  </td>

                  <td width="487">&nbsp;</td>

                  <td width="11">&nbsp;</td>

                </tr>

                <tr>

                  <td><div align="right"><font>* </font>当前ip地址：</div></td>

                  <td><input type="text" name="authStoreIP" id="authStoreIP" class="normalInput" value="<?php echo XUtils::getClientIP();?>" readonly="readonly" style="font-size: 16px; font-weight:bold;" /></td>

                  <td>&nbsp;</td>

                  <td>&nbsp;</td>

                </tr>

                <tr>

                  <td><div align="right"><font>* </font>QQ：</div></td>

                  <td><input type="text" name="authStoreQQ" id="authStoreQQ" readonly="readonly" class="normalInput" value="<?php echo $userInfo->QQToken;?>" style="background: #ccc;" /></td>

                  <td>&nbsp;</td>

                  <td>&nbsp;</td>

                </tr>

                <tr>

                  <td><div align="right"><font>* </font>手机号码：</div></td>

                  <td><input type="text" name="telephone" id="telephone" readonly="readonly" class="normalInput" value="<?php echo $userInfo->Phon;?>" style="background: #ccc;" /></td>

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

                  <td colspan="4"><div style="padding:10px;"><a href="javascript:;" class="sendStep1">确认提交</a></div></td>

                </tr>

              </table>

              </form>

              <?php

                }

                if($authStoreinfo && $authStoreinfo->authStoreStep1==1 && $authStoreinfo->authStoreStep2==0 && $authStoreinfo->authStoreStatus==0){

              ?>

              <div class="storeRzStep2">

              	

              <?php

                }

              ?>

         </div><!--fillInfo end-->

    </div><!--rzContent end-->

</div><!--main end-->

<script src="<?php echo VERSION2;?>js/jquery.js"></script>

<!--layer插件-->

<script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>

<script src="<?php echo ASSET_URL;?>layer/layer.js"></script>

<script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>

<link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" />

<script>

    //点击提交店铺掌柜号信息

    $(function(){

        $(".sendStep1").click(function(){

            if($("#wangwang").val()=="")

            {

                $("html,body").animate({scrollTop: $("#wangwang").offset().top-100}, 300);

                layer.tips('掌柜名不能为空', '#wangwang');

                exit;

            }

            if($("#telephone").val()=="")

            {

                $("html,body").animate({scrollTop: $("#telephone").offset().top-100}, 300);

                layer.tips('手机号码不能为空', '#telephone');

                exit;

            }

            if($("#authStoreQQ").val()=="")

            {

                $("html,body").animate({scrollTop: $("#authStoreQQ").offset().top-100}, 300);

                layer.tips('QQ号码不能为空', '#authStoreQQ');

                exit;

            }

            if($("#phonecode").val()=="")

            {

                $("html,body").animate({scrollTop: $("#phonecode").offset().top-100}, 300);

                layer.tips('验证码不能为空', '#phonecode');

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

                			url:"<?php echo $this->createUrl('user/authStore');?>",

                			data:$("#autoStoreInfo").serialize(),

                			success:function(msg)

                			{

                                if(msg=='SUCCESS')//提成成功

                                {

                                    //询问框

                                	layer.confirm('资料提交成功，请联系客服进行人工审核', {

                                		btn: ['知道了'] //按钮

                                	},function(){

                                	  location.reload();

                                	});

                                }else if(msg=="EXIST"){

                                    layer.confirm('<span style="color:red;">该掌柜号已经被绑定过</span>', {

                                		btn: ['知道了'] //按钮

                                	});

                                }

                                else//提成失败

                                {

                                    layer.confirm('<span style="color:red;">绑定掌柜号失败，请联系管理人员</span>', {

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

                    	    $("#phonecode").val("");

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

        //第一步提交掌柜号基本信息结束



        //第二步验证店铺地址

        $(".sendStep2").click(function(){

            var wangwangid=$(this).attr("alt");

            if($("#authStoreUrl").val()=="")

            {

                $("html,body").animate({scrollTop: $("#authStoreUrl").offset().top-100}, 300);

                layer.tips('商品链接地址不能为空', '#authStoreUrl');

                exit;

            }

            $.support.cors = true;

            $.ajax({

                url:"http://www.1kzx.com/site/player.html?callback=?",

                dataType:'jsonp',

                data:{"authStoreUrl":$("#authStoreUrl").val(),"storeCode":$(".storeCode").html(),"storeWangwang":$(".storeWangwang").html()},

                jsonp:'callback',

                success:function(result) {

                    //返回结果开始

                    if(result[0]=='SUCCESS')//jsonp审核通过，通过ajax改变审核状态

                    {

                        $.ajax({

                            type:"POST",

                            url:"<?php echo $this->createUrl('user/authStroeJsonp');?>",

                            data:{"authStoreUrl":$("#authStoreUrl").val(),"id":wangwangid},

                            success:function(msg)

                            {

                                if(msg=="SUCCESS")

                                {

                                    //询问框

                                    layer.confirm('恭喜您审核通过', {

                                        btn: ['知道了'] //按钮

                                    },function(){

                                        location.reload();

                                    });

                                }else

                                {

                                    //询问框

                                    layer.confirm('审核失败，请联系管理员', {

                                        btn: ['知道了'] //按钮

                                    },function(){

                                        location.reload();

                                    });

                                }

                            }

                        });//ajax

                    }else if(result[0]=="authStoreCodeNO")//提成失败

                    {

                        layer.confirm('<span style="color:red;">验证码在您的商品链接页面中不存在，请先添加</span>', {

                            btn: ['知道了'] //按钮

                        });

                    }else if(result[0]=="wangwangNO")

                    {

                        layer.confirm('<span style="color:red;">掌柜号在您的商品链接页面中不存在，请检验您的链接是否正确</span>', {

                            btn: ['知道了'] //按钮

                        });

                    }else if(result[0]=="bothNO")

                    {

                        layer.confirm('<span style="color:red;">掌柜号与验证码在您的商品链接页面中都不存在，请检验您的链接是否正确</span>', {

                            btn: ['知道了'] //按钮

                        });

                    }

                    //返回结果结束

                },

                timeout:50000

            });

        });

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

    

    //移除掌柜号前询问

    function askCertain()

    {

        if (confirm("确认要删除？")) { 

            location.href=''+$("#askCertain").attr("lang")+'';

        } 

        else

            return false;

    }

</script>