<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">

<head>

<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<?php

    $webtitle=System::model()->findByAttributes(array("varname"=>"webtitle"));

    $webkeywords=System::model()->findByAttributes(array("varname"=>"webkeywords"));

    $webdes=System::model()->findByAttributes(array("varname"=>"webdes"));

?>

<title><?php echo $webtitle->value;?></title>

<meta name="Keywords" content="<?php echo $webkeywords->value;?>" />

<meta name="description" content="<?php echo $webdes->value;?>" />

<link href="<?php echo VERSION2;?>css/css.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.a001 {
	color: #F00;
	font-size: 14px;
}
.top .topCen.clearfix .topCen_lf .line .gg .a001 {
	color: #F00;
}
.b001 {
	color: #F00;
}
</style>
<script src="<?php echo VERSION2;?>js/jquery.js"></script>

</head>

<body>

    <div class="top"><!--顶部信息栏-->

        <div class="topCen clearfix">

            <div class="topCen_lf">

                <ul class="line">

                    <?php

                        $articleInfo=Article::model()->findAll(array(

                            'condition'=>'cat_id=38 and is_delete=0',

                            'select'=>'goods_id,goods_name,cat_id',

                            'limit'=>'5'

                        ));

                        foreach($articleInfo as $item){

                    ?>

                    <li class="gg"class="a001">
                    <span class="a001">注意事项：</span><a title=""class="a001" href="<?php echo $this->createUrl('news/deatailInfo',array('id'=>$item->goods_id,'catlogid'=>$item->cat_id));?>"><?php

                        echo $item->goods_name;

                    ?></a></li>

                    <?php

                        }

                    ?>

                </ul>

            </div>

            <div class="topCen_r">

                <div class="ml_nologin">

                    <?php if(Yii::app()->user->isGuest){ ?>

                      <div class="ml_login" id="bg"><a href="<?php echo $this->createUrl('passport/login');?>" rel="nofollow" >立即登录</a></div>

                      <!--<div class="ml_login"><a href="#" rel="nofollow" >QQ登录</a></div>-->

                      <div class="ml_login"><a href="<?php echo $this->createUrl('passport/regist');?>" style="text-decoration:none" rel="nofollow" >注册</a></div>

                    <?php }?>

                </div>

                <div class="t_user" <?php if(Yii::app()->user->getIsGuest()) echo "style='background:none;'";?>>

                    <p class="t_userInf"><?php echo Yii::app()->user->getName()=="Guest"?"游客您好":"<a href='".$this->createUrl('user/index')."' style='color:#fff;'>".Yii::app()->user->getName()."</a>";?></p>

                    <?php

                        if(Yii::app()->user->getId()){

                            $userInfo=User::model()->findByPk(Yii::app()->user->getId());

                    ?>

                    <ul class="t_user_down hide">

                        <li class="bt_1">

                            存款：

                            <span class="or_wz">

                                ￥<span class="MoneyOwn"><?php echo $userInfo->Money;?></span>

                            </span>

                            <span class="dow_rInf">

                                <a href="<?php echo $this->createUrl('user/userPayCenter');?>">充值</a>

                                <a href="<?php echo $this->createUrl('user/userCashToBank');?>">提现</a>

                                <a href="<?php echo $this->createUrl('user/userPayDetail');?>" class="linkIco1"><img src="<?php echo VERSION2;?>img/ico02.png" alt="" /></a>

                            </span>

                        </li>

                        <li class="bt_1">

                            金币：

                            <span class="or_wz">

                                <span class="MinLinOwn"><?php echo $userInfo->MinLi;?></span>

                            </span>

                            <span class="dow_rInf">

                                <a href="<?php echo $this->createUrl('user/userBuyPoint');?>">购买</a>

                                <a href="<?php echo $this->createUrl('user/userMiliToCash');?>">兑换</a>

                                <a href="<?php echo $this->createUrl('user/userPayDetail');?>" class="linkIco1"><img src="<?php echo VERSION2;?>img/ico02.png" alt="" /></a>

                            </span>

                        </li>

                        <li class="bt_1">

                            等级：

                            <span class="or_wz">

                                <span>

                                    <?php

                                        switch($userInfo->VipLv)

                                        {

                                            case 0:

                                                echo '新手会员';

                                                break;

                                            case 1:

                                                echo 'Vip1';

                                                break;

                                            case 2:

                                                echo 'Vip2';

                                                break;

                                            case 3:

                                                echo 'Vip3';

                                                break;

                                        }

                                        

                                        if($userInfo->VipLv<>0)//如果是vip会员

                                        {

                                            echo "<span style='padding-left:12px;'>";

                                            if($userInfo->VipStopTime<time())

                                            {

                                                echo "已到期"."<a href='".$this->createUrl('user/userBuyPoint')."' style='color:red; padding-left:8px;'>立即续费</a>";

                                            }else

                                            {

                                                echo date('Y-m-d',$userInfo->VipStopTime)."到期";

                                            }

                                            echo "</span>";

                                        }

                                    ?>

                                </span>

                            </span>

                            <!--<span class="jfspa">

                                积分:

                                <span class="or_wz"><?php echo $userInfo->Score;?></span>

                            </span>-->

                        </li>

                        <li class="t_user_downlast">

                            <a href="<?php echo $this->createUrl('user/userAccountCenter');?>" class="cl">账号设置</a>

                            <a href="<?php echo $this->createUrl('site/loginout');?>" class="bk">退出</a>

                        </li>

                    </ul>

                    <?php

                        }

                    ?>

                </div>

                <?php

                    if(Yii::app()->user->getId()){

                ?>

                <div class="sjx">

                    收信信箱

                    <div class="sjxDown hide">

                        <li><a href="<?php echo $this->createUrl('user/userMessage');?>">官方信息</a></li>

                        <li><a href="<?php echo $this->createUrl('user/userMessageWarning');?>">提醒设置</a></li>

                    </div>

                </div>

                <div class="sjx">

                    我是商家

                    <div class="sjxDown hide">

                        <li><a href="<?php echo $this->createUrl('user/taskPublishPT');?>">发布任务</a></li>

                        <li><a href="<?php echo $this->createUrl('user/taobaoOutTask');?>">已发任务</a></li>

                        <li><a href="<?php echo $this->createUrl('user/taobaoBindSeller');?>">绑定掌柜</a></li>

                        <li><a href="<?php echo $this->createUrl('user/userTsCenter');?>">我的申诉</a></li>

                    </div>

                </div>

                <div class="sjx">

                    我是接手

                    <div class="sjxDown hide">

                        <li><a href="<?php echo $this->createUrl('site/taobaoTask');?>">任务大厅</a></li>

                        <li><a href="<?php echo $this->createUrl('user/taobaoInTask');?>">已接任务</a></li>

                        <li><a href="<?php echo $this->createUrl('user/taobaoBindBuyer');?>">绑定买号</a></li>

                        <li><a href="<?php echo $this->createUrl('user/userTsCenter');?>">我的申诉</a></li>

                    </div>

                </div>

                <?php }?>

            </div>

        </div>

    </div><!--顶部信息栏 end-->

    <div class="nav"><!--主导航-->

        <div class="navCen">

            <a href="<?php echo $this->createUrl('site/index');?>" class="logo"><img src="<?php echo VERSION2;?>img/logo1.png" alt="" /></a>

            <ul class="navList">

                <li <?php echo Yii::app()->controller->id=="site" && $this->getAction()->getId()=="index"?"class='selected'":"";?>><a href="<?php echo $this->createUrl('site/index');?>">首页</a></li>

                <li <?php echo Yii::app()->controller->id=="site" && $this->getAction()->getId()=="taobaoTask"?"class='selected'":"";?>><a href="<?php echo $this->createUrl('site/taobaoTask');?>">任务大厅</a></li>

                <li <?php echo $this->getAction()->getId()=="userBuyPoint"?"class='selected'":"";?>><a href="<?php echo $this->createUrl('user/userBuyPoint');?>">金币购买</a></li>

                <li <?php echo in_array(Yii::app()->controller->id,array('user')) && in_array($this->getAction()->getId(),array('userSpread'))?"class='selected'":"";?>><a href="<?php echo $this->createUrl('user/userSpread');?>">我要推广</a></li>

                <li <?php echo in_array(Yii::app()->controller->id,array('site','news')) && in_array($this->getAction()->getId(),array('help','list','deatailInfo'))?"class='selected'":"";?>><a href="<?php echo $this->createUrl('site/help');?>">帮助与公告</a></li>

                <li <?php echo Yii::app()->controller->id=="user"?"class='selected'":"";?>><a href="<?php echo $this->createUrl('user/index');?>">会员中心</a></li>

            </ul>

        </div>

    </div><!--主导航 end-->

    <?php

        echo $content;

    ?>

    <div class="foot">

        <div class="footCen clearfix">

            <div class="footLink2" style="width: 100%; text-align:center;">

                <?php

                    //版权说明

                    $copyright=System::model()->findByAttributes(array("varname"=>"copyright"));

                ?>

                <p>

                    <?php

                        echo $copyright->value;

                    ?>

                    <!--百度统计-->

                    <script>

                        var _hmt = _hmt || [];

                        (function() {

                            var hm = document.createElement("script");

                            hm.src = "//hm.baidu.com/hm.js?90d787a186d7e05e0b87bd37f6007c45";

                            var s = document.getElementsByTagName("script")[0];

                            s.parentNode.insertBefore(hm, s);

                        })();

                    </script>

                
                </p>

<hr />
<table width="790" border="1" cellspacing="5" cellpadding="5">
  <tr>
    <td width="70"><a href="https://www.taobao.com/" target="_parent">友情链接</a></td>
    <td width="70"><a href="https://www.taobao.com/" target="_blank">淘 &nbsp; 宝</a></td>
    <td width="70"><a href="https://www.taobao.com/" target="_blank">淘 &nbsp; 宝</a></td>
    <td width="70"><a href="https://www.alipay.com/" target="_blank">支&nbsp; 付&nbsp; 宝</a></td>
    <td width="70"><a href="https://www.tenpay.com/" target="_blank">财&nbsp; 付&nbsp; 通</a><a href="https://www.tenpay.com/" target="_blank"></a></td>
    <td width="70"><a href="http://www.taonienie.com/" target="_blank">淘&nbsp; 捏&nbsp; 捏</a></td>
    <td width="70"><a href="http://www.taodaxiang.com/" target="_blank">淘&nbsp; 大&nbsp; 象</a></td>
    <td width="70"><a href="https://www.taobao.com/" target="_blank">淘 &nbsp; 宝</a></td>
    <td width="70"><a href="https://www.taobao.com/" target="_blank">淘 &nbsp; 宝</a><a href="http://youmei789.com/" target="_parent"></a></td>
  </tr>
</table>

                <style>

                    .footsafeAuth img{ margin-left:5px;}

                </style>

                <div class="footsafeAuth" style="margin-top: 20px;"><!--footsafeAuth start-->

                    <img src="/assets/footimg/1.png" />

                    <img src="/assets/footimg/2.png" />

                    <img src="/assets/footimg/3.png" />

                    <img src="/assets/footimg/4.png" />

                    <img src="/assets/footimg/5.png" />

                    <img src="/assets/footimg/6.png" />

                    <img src="/assets/footimg/7.png" />

                    <img src="/assets/footimg/8.png" />

                </div>

            </div>

        </div>

    </div>

    <!--侧栏客服start-->

    <div class="im_main" id="im_main" style=" height: auto; top:150px;">

      <div id="close_im" class="close-im"><a href="javascript:void(0);" title="点击关闭">&nbsp;</a></div>

      <a href="http://wpa.qq.com/msgrd?v=3&uin=774542969&site=qq&menu=yes" target="_blank" class="im-qq qq-a">

      <div class="qq-container"></div>

      <div class="qq-hover-c"><img class="img-qq" src="<?php echo VERSION2;?>img/qq.png"></div>

      <span>QQ在线咨询</span></a>

      <div class="im-tel" style="height: auto; padding-bottom:10px;">
	  <div><a href="<?php echo $this->createUrl('');?>">客服在线时间</a></div>
	  <div><a href="<?php echo $this->createUrl('');?>">09:00-12:00</a></div>
	  <div><a href="<?php echo $this->createUrl('');?>">14:00-18:00</a></div>

                <div><a href="/news/deatailInfo/id/141/catlogid/38.html" class="0000" target="_blank">新手常见问题</a></div>
        <div><a href="/news/deatailInfo/id/147/catlogid/41.html" class="0000" target="_blank">接手任务必知</a></div>
        <div><a href="/news/deatailInfo/id/192/catlogid/38.html" class="0000" target="_blank">充值与提现</a></div>
                <div><a href="/news/deatailInfo/id/195/catlogid/38.html" class="jsbz" target="_blank">商家远程防骗</a></div>
               <div><a href="/news/deatailInfo/id/195/catlogid/38.html" class="jsbz" target="_blank">请用招商兴业</a></div>

      </div>

      <div class="im-tels">

        <div><a target="_blank" href="http://shang.qq.com/wpa/qunwpa?idkey=95cf3584cd80965e9b0501f8dbc6fd1b19135f94bb65952ae06b7d02ee48f6a0"><img border="0" src="//pub.idqqimg.com/wpa/images/group.png" alt="优美店铺优化" title="优美店铺优化"></a>

      </div>

      <div class="im-footer" style="position:relative">

        <div class="weixing-container"><a href="#" class="wb"><img src="<?php echo VERSION2;?>img/weixing-icon.png"></a></div>

        <div class="go-top"><a href="javascript:;" title="返回顶部"></a> </div>

        <div style="clear:both"></div>

      </div>

    </div>

    <!--侧栏客服end-->

    <script src="<?php echo VERSION2;?>js/responsiveslides.min.js"></script>

    <script src="<?php echo VERSION2;?>js/slide.js"></script>

    <script src="<?php echo VERSION2;?>js/index.js"></script>

    <script>

        $(function(){

            //关闭客服

            $(".close-im").click(function(){

                $("#im_main").hide();

            });

            

            //返回顶部

            $(".go-top").click(function(){

                var speed=200;//滑动的速度

                $('body,html').animate({ scrollTop: 0 }, speed);

            });

            

            $('.why_main a').hover(function(){

            	var iMgf = $(this).attr("lang");

            	$('.why_main a').each(function(){

            		var iMgf = $(this).attr("lang");

            		$(this).find("img").attr("src","<?php echo VERSION2;?>img/"+iMgf+".png");

            	});

            	$(this).find("img").attr("src","<?php echo VERSION2;?>img/"+iMgf+"2.png");

            });

            

            //显示个人资料

            $(".allRw_pro1").hover(function(){

                $(this).find(".person-info").show();

            },function(){

                $(this).find(".person-info").hide();

            });

            

            <?php

                $uinfo=User::model()->findByPk(Yii::app()->user->getId());

                if($uinfo)

                {

                    if($uinfo->Status==1)

                    {

            ?>

                        location.href="<?php echo $this->createUrl('site/loginout');?>";

            <?php

                    }

                }

            ?>

        })

    </script>

    <style>

    .layui-layer-title{ background:#57A0FF; color:#fff;}

    </style>

</body>

</html>

