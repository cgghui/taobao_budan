    <!--会员中心-->
    <?php
        echo $this->renderPartial('/user/usercenterTopNav');
        $userInfo=User::model()->findByPk(Yii::app()->user->getId());
    ?>
   <!--点击内容-->
	<div class="d_qie1 clearfix">
    	<div class="d_qtop clearfix">
            <a title="个人资料中心" href="<?php echo $this->createUrl('user/userAccountCenter');?>"><img class="d_t_img myheadImg" src="<?php echo $userInfo->MyPhoto!=""?$userInfo->MyPhoto:VERSION2.'img/avatar.png';?>"/></a>
            <div class="d-t-center">
                <ul class="d_t_cen">
                    <li class="d_num"><?php echo Yii::app()->user->getName();?><img class="d_n_img" src="<?php echo VERSION2;?>img/d_red.gif" /></li>
                    <li class="jingyan">经验值：</li>
                    <li class="d_jyt">
                        <span><font class="exprenceNumber"><?php echo $userInfo->Experience;?></font>/1000</span>
                    </li>
                </ul>
                <div class="clear"></div>
                <ul class="d_t_cen1">
                    <li><a class="AuthPerson" alt="<?php echo $userInfo->Phon;?>" lang="<?php echo $userInfo->AuthPerson;?>">实名认证</a><p class="<?php echo $userInfo->AuthPerson!=0?'bg_img2':'bg_img3';?>"></p></li>
                    <li><a class="phoneActive" alt="<?php echo $userInfo->Phon;?>" lang="<?php echo $userInfo->PhonActive;?>">手机绑定激活</a><p class="<?php echo $userInfo->PhonActive!=0?'bg_img2':'bg_img3';?>"></p></li>
                    <li><a class="safePwd" lang="<?php echo $userInfo->SafePwd!=""?1:0;?>">安全码设置</a><p class="<?php echo $userInfo->SafePwd!=""?'bg_img2':'bg_img3';?>"></p></li>
                    <li><a class="userExam" lang="<?php echo $userInfo->ExamPass;?>">新手考试</a><p class="<?php echo $userInfo->ExamPass!=0?'bg_img2':'bg_img3';?>"></p></li>
                    <li><a class="otherPlaceLogin" lang="<?php echo $userInfo->PlaceOtherLogin;?>">异地登录验证</a><p class="<?php echo $userInfo->PlaceOtherLogin!=0?'bg_img2':'bg_img3';?>"></p></li>
                </ul>
            </div>
            <div class="d_t_right">
            	<ul>
                	<li><a href="<?php echo $this->createUrl('user/taobaoInTask');?>"><img src="<?php echo VERSION2;?>img/per6.jpg" /><p>可处理任务</p></a></li>
                    <li class="d_t_li"><a href="<?php echo $this->createUrl('user/userTsCenter');?>"><img src="<?php echo VERSION2;?>img/per7.jpg" /><p style=" overflow-x: visible;">可处理投诉</p></a></li>
                </ul>
            </div>
        </div>
   
        <div class="d_con clearfix">
            <div class="d_conall clearfix">
                <div class="d_con_left">
                	<div class="d_con_left_top">
                        <p class="cunkuan1">存款</p>
                        <p class="shuzhi1"><?php echo $userInfo->Money;?></p>
                        <span>元</span>
                    </div>
                    <div class="d_con_left_bottom">
                    	<ul>
                        	<li><a href="<?php echo $this->createUrl('user/userPayCenter');?>">充值</a></li>
                            <li><a class="d_tan"  href="<?php echo $this->createUrl('user/userCashToBank');?>">提现</a></li>
                            <li class="li3"><a href="<?php echo $this->createUrl('user/userPayDetail');?>">明细</a></li>
                        </ul>
                    </div>
                </div>
                <div class="d_con_right">
                	<div class="d_con_right_top">
                        <p class="cunkuan1">金币</p>
                        <p class="shuzhi1"><?php echo $userInfo->MinLi;?></p>
                        <span>个</span>
                    </div>
                    <div class="d_con_right_bottom">
                    	<ul>
                        	<li><a href="<?php echo $this->createUrl('user/userBuyPoint');?>">购买</a></li>
                            <li><a href="<?php echo $this->createUrl('user/userMiliToCash');?>">回收</a></li>
                            <li class="li3"><a href="<?php echo $this->createUrl('user/userPayDetail');?>">明细</a></li>
                        </ul>
                    </div>
                </div>
             </div>
             <style>
                .d_tisheng ul li{  margin:0 90px 0 30px;}
             </style>
             <div class="d_tisheng clearfix">
             	<ul class="d_tsul">
                	<li><a href="<?php echo $this->createUrl('user/userSBcenter');?>"><img src="<?php echo VERSION2;?>img/d-sq_18.png" /><p>加入商保</p></a></li>
                    <!--<li><a href="<?php echo $this->createUrl('user/userZYWK');?>"><img src="<?php echo VERSION2;?>img/d-sq_20.png" /><p>成为职业威客</p></a></li>-->
                    <li><a href="<?php echo $this->createUrl('user/userBuyPoint');?>"><img src="<?php echo VERSION2;?>img/d-sq_22.png" /><p>申请VIP</p></a></li>
                    <li><a href="<?php echo $this->createUrl('user/taskPublishLU');?>"><img src="<?php echo VERSION2;?>img/d-sq_24.png" /><p>我要提升信誉</p></a></li>
                    <li><a href="<?php echo $this->createUrl('user/userSpread');?>"><img src="<?php echo VERSION2;?>img/d-sq_26.png" /><p>我要推广赚钱</p></a></li>
                </ul>
             </div>
         </div>
     </div>
    <!--点击内容-->
    <div class="clear"></div>
 <!--会员中心-->
 <!--layer插件-->
<script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>
<script src="<?php echo ASSET_URL;?>layer/layer.js"></script>
<script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>
<link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" />
<script>
    $(function(){
        //新手通知
        if(parseFloat($(".exprenceNumber").html())<11)//经验大于10则不做提醒
        {
            layer.open({
                type: 1,
                title:'<div style="color:#fff; background:url(/assets/version2/img/notice.png) no-repeat left center;"><span style="padding-left:40px; font-size:15px;s">新手必知（情节严重直接封号！）</span></div>',
                area: ['606px','400px'],
                skin: 'layui-layer-rim', //加上边框
                content: '<div style="font-size:14px; width:580px; margin:0 auto; line-height:27px; padding-top:15px;"><font style=" font-size:16px; font-weight:bold; color:red;">接手任务六大注意事项</font><br/>一、严禁通过旺旺联系商家或旺旺聊天中带有平台、刷钻、刷单等忌讳字眼 ；<br/>二：禁止在任务过程中，辱骂任务一方，出言不逊；<br/>三、禁止使用花呗、淘金币、天猫积分、返利网、淘宝客、信用卡支付；<br/>四、必须物流信息签收后才能在淘宝确认收货！（无法获取物流信息的联系商家）；<br/>五、禁止以任何理由给对方差评及非五星好评等行为：<br/>六、严禁好评乱写评语，广告评语或恶意乱写评语。<br/><font style=" font-size:16px; font-weight:bold; color:red;">发布任务三大注意事项</font><br/>一、禁止发布方发布不实任务，骗取流量！<br/>二、禁止发布一个任务却以各种理由让接手方拍淘宝多个商品/链接；<br/>三、禁止发布方不勾选对应要求却在留言中要求接手完成，如"货比三家"。<br/><div style="text-align:center; color:red;">说明：以上信息 经验 > 10 将不再显示</div></div>'
            });
        }
        
        //实名认证
        $(".AuthPerson").click(function(){
            if($(this).attr("lang")==1)//手机绑定已激活
            {
                //询问框
            	layer.confirm('您已通过实名认证', {
            		btn: ['知道了'] //按钮
            	});
            }
            else//手机绑定未激活
            {
                //询问框
            	layer.confirm('您还没有通过实名认证', {
            		btn: ['立即认证','暂时不认证'] //按钮
            	},function(){
            	   window.location.href='<?php echo $this->createUrl('user/authPerson');?>';
            	});
            }
        });
        
        //手机激活提醒
        $(".phoneActive").click(function(){
            if($(this).attr("lang")==1)//手机绑定已激活
            {
                //询问框
            	layer.confirm('您的帐号已经成功与您的手机号<span style="color:red;">'+$(this).attr("alt")+"</span>进行绑定，如需修改请联系客服人员", {
            		btn: ['知道了'] //按钮
            	});
            }
            else//手机绑定未激活
            {
                //询问框
            	layer.confirm('您的手机还没有绑定激活', {
            		btn: ['立即激活','暂时不激活'] //按钮
            	},function(){
            	   window.location.href='<?php echo $this->createUrl('user/userPhonActive');?>';
            	});
            }
        });
        
        //安全码设置提醒
        $(".safePwd").click(function(){
            if($(this).attr("lang")==1)//手机绑定已激活
            {
                //询问框
            	layer.confirm('您的安全操作码已设置', {
            		btn: ['知道了'] //按钮
            	});
            }
        });
        
        //新手考试提醒
        $(".userExam").click(function(){
            if($(this).attr("lang")==1)//手机绑定已激活
            {
                //询问框
            	layer.confirm('您已成功通过新手考试', {
            		btn: ['知道了'] //按钮
            	});
            }
            else//手机绑定未激活
            {
                //询问框
            	layer.confirm('您还没有通过新手考试，<span style="color:red;">暂时无法接任务</span>', {
            		btn: ['参加考试','暂时不参加'] //按钮
            	},function(){
            	   window.location.href='<?php echo $this->createUrl('user/userExam');?>';
            	});
            }
        });
        
        //开启异地登录提醒
        $(".otherPlaceLogin").click(function(){
            if($(this).attr("lang")==1)//手机绑定已激活
            {
                //询问框
            	layer.confirm('您已开启异地登录验证，<span style="color:red;">需要关闭吗</span>？为了您的帐户安全，系统建议保持开启状态', {
            		btn: ['关闭验证','继续开启'] //按钮
            	},function(){
            	   $.ajax({
            			type:"POST",
            			url:"<?php echo $this->createUrl('user/index');?>",
            			data:"otherPlaceLoginClose=Done",
            			success:function(msg)
            			{
           				     if(msg=="SUCCESS")
                             {
                                layer.confirm('异地登录验证已关闭，系统建议您开启，为了您的帐户更加安全', {
                            		btn: ['知道了'] //按钮
                            	},function(){
                            	   location.reload();//重新刷新当前页面
                            	});
                             }else
                             {
                                layer.confirm('<span style="color:red;">异地登录验证关闭失败，您可以联系客服人员</span>', {
                            		btn: ['知道了'] //按钮
                            	},function(){
                            	   location.reload();//重新刷新当前页面
                            	});
                             }
            			}
            		});
            	});
            }
            else//手机绑定未激活
            {
                //询问框
            	layer.confirm('您是否要开启异地登录验证，这将有效保护您的帐户安全', {
            		btn: ['立即开启','暂不开启'] //按钮
            	},function(){
            	   $.ajax({
            			type:"POST",
            			url:"<?php echo $this->createUrl('user/index');?>",
            			data:"otherPlaceLogin=Done",
            			success:function(msg)
            			{
           				     if(msg=="SUCCESS")
                             {
                                layer.confirm('异地登录成功开启', {
                            		btn: ['确定'] //按钮
                            	},function(){
                            	   location.reload();//重新刷新当前页面
                            	});
                             }else
                             {
                                layer.confirm('<span style="color:red;">异地登录开启失败，您可以联系客服人员</span>', {
                            		btn: ['知道了'] //按钮
                            	},function(){
                            	   location.reload();//重新刷新当前页面
                            	});
                             }
            			}
            		});
            	});
            }
        });
    })
</script>