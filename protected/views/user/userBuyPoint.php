    <div id="body" style="min-height: 480px;"><!--body start-->
        <div class="zbuy1">
            <div class="zbuy11">
                <?php
                    $VIP1price1month=System::model()->findByAttributes(array("varname"=>"VIP1price1month"));
                    $VIP1price3month=System::model()->findByAttributes(array("varname"=>"VIP1price3month"));
                    $VIP1price6month=System::model()->findByAttributes(array("varname"=>"VIP1price6month"));
                    $VIP1price12month=System::model()->findByAttributes(array("varname"=>"VIP1price12month"));
                    
                    $VIP2price1month=System::model()->findByAttributes(array("varname"=>"VIP2price1month"));
                    $VIP2price3month=System::model()->findByAttributes(array("varname"=>"VIP2price3month"));
                    $VIP2price6month=System::model()->findByAttributes(array("varname"=>"VIP2price6month"));
                    $VIP2price12month=System::model()->findByAttributes(array("varname"=>"VIP2price12month"));
                    
                    $VIP3price1month=System::model()->findByAttributes(array("varname"=>"VIP3price1month"));
                    $VIP3price3month=System::model()->findByAttributes(array("varname"=>"VIP3price3month"));
                    $VIP3price6month=System::model()->findByAttributes(array("varname"=>"VIP3price6month"));
                    $VIP3price12month=System::model()->findByAttributes(array("varname"=>"VIP3price12month"));
                ?>
                <div class="zbuy12">
                    <span class="zbuy111">
                        购买金币
                    </span>
                    <div class="zbuy112">
                        <img src="<?php echo VERSION2;?>img/zbuy111.jpg" alt="" />
                        <span class="zbuy113">拥有金币，就可以发布自己的任务，获得好评</span>
                    </div>
                    <?php 
                        $buyMinLiPrice=System::model()->findByAttributes(array("varname"=>"buyMinLiPrice"));
                    ?>
                    <div class="zbuy114">
                        购买数量 :<input type="text" class="ez-bo1s MinLinNum" name='buymd'/>个<span>( <em><?php echo $buyMinLiPrice->value;?></em>元/个 )</span>
                    </div>
                    <a href="javascript:;" id="buymd"><div class="zbuy116 buyMinLi">立即购买</div></a>
                </div>
                <div class="zbuy13">
                    <span class="zbuy111">
                        升级VIP
                    </span>
                    <?php
                        $vipInfo=User::model()->findByPk(Yii::app()->user->getId());
                        //VIP已到期或者不是VIP
                        $vipInfo->VipStopTime!=""?$vipInfo->VipStopTime:0;//VIP到期时间处理
                        if($vipInfo->VipStopTime<time() or $vipInfo->VipLv==0){
                    ?>
                    <div class="zbuy112">
                        <img src="<?php echo VERSION2;?>img/vip.jpg" alt="" />
                        <span class="zbuy113">拥有VIP刷钻更高效 <a href="<?php echo $this->createUrl('site/userLeveldoc');?>" target="_blank" style="color:#57a0ff;margin-left:20px;font-size:14px">查看VIP特权</a></span>
                    </div>
                    <div class="zbuy114">
                        <select id="viptype">
                            <option value="1">一级VIP客户</option>
                            <option value="2">二级VIP客户</option>
                            <option value="3">三级VIP客户</option>
                        </select> 
                        <select id="months">
                            <option value="1">一个月<?php echo $VIP1price1month->value;?>元</option>
                            <option value="3">三个月<?php echo $VIP1price3month->value;?>元</option>
                            <option value="6">半年<?php echo $VIP1price6month->value;?>元</option>
                            <option value="12">一年<?php echo $VIP1price12month->value;?>元</option>
                        </select>
                        <input type="hidden" name="hash2" value="eA==">
                    </div>
                    <a href="javascript:;" id="buyvip"><div class="zbuy116">立即购买</div></a>
                    <?php }
                        else
                        {
                            echo "<div style=' margin-top:80px; text-align:center;'>您的会员等级为<img src='".VERSION2."img/vip".$vipInfo->VipLv.".gif' /><span style='padding-left:10px; color:red;'>".date('Y-m-d',$vipInfo->VipStopTime)."到期</span></div>";
                    ?>
                        <div style="text-align: center; line-height:45px;"><a href="<?php echo $this->createUrl('site/userLeveldoc'); ?>" target="_blank" style="color: #57A0FF;">查看会员特权</a></div>
                    <?php
                        }
                    ?>
                </div>
            </div>
        </div>
        <!--<div class="cart">
          <div class="cart_nav" id='list'>
              <ul >
                <li><a href="#" type='1'><img src="<?php echo VERSION2;?>img/cart_a.jpg"/></a></li>
                <li class="cart_mar"><a href="#" type='2'><img src="<?php echo VERSION2;?>img/cart_b.jpg"/></a></li>
                <li class="cart_mar"><a href="#" type='3'><img src="<?php echo VERSION2;?>img/cart_c.jpg"/></a></li>
              </ul>
          </div>
        </div>-->
    </div><!--body end-->
<!--layer插件-->
<script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>
<script src="<?php echo ASSET_URL;?>layer/layer.js"></script>
<script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>
<link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" />
<script>
    $(function(){
        //点击购买金币
        $(".buyMinLi").click(function(){
            if($(".MinLinNum").val()=="")//检查是否为空
            {
                layer.tips('购买金币数量不能为空', '.MinLinNum');
                exit;
            }
            if(isNaN($(".MinLinNum").val()))//检查是否为数字
            {
                $(".MinLinNum").val("");
                layer.tips('必须为数字', '.MinLinNum');
                exit;
            }
            if(parseFloat($(".MinLinNum").val())*0.63>parseFloat($(".MoneyOwn").html()))//余额检查
            {
                //询问框
            	layer.confirm('<span style="color:red;">余额不足</span>，购买'+$(".MinLinNum").val()+'个金币需要<span style="color:red;">'+parseFloat($(".MinLinNum").val())*0.63+'</span>元。您现在的余额为<span style="color:red;">'+$(".MoneyOwn").html()+'</span>元。', {
            		btn: ['知道了'] //按钮
            	});
                exit;
            }
            
            //输入安全码
            layer.confirm('输入安全码<input type="password" name="safePwd" class="text1 safePwd" style="margin-left:5px;" />', {
            	btn: ['确定'] //按钮
            },function(){
                if($(".safePwd").val()=="")//安全码必填
                {
                    layer.tips('请输入安全码', '.safePwd');
                }else
                {
                    $.ajax({
            			type:"POST",
            			url:"<?php echo $this->createUrl('user/checkSafePwd');?>",
            			data:{"safePwd":$(".safePwd").val()},
            			success:function(msg)
            			{
            				if(msg=="SUCCESS")//安全码正确
                            {
                                //检查通过申请提现
                                $.ajax({
                        			type:"POST",
                        			url:"<?php echo $this->createUrl('user/userBuyPoint');?>",
                        			data:{"MinLinNum":$(".MinLinNum").val()},
                        			success:function(msg)
                        			{
                        				if(msg=="SUCCESS")
                                        {
                                            //询问框
                                        	layer.confirm('金币购买成功', {
                                        		btn: ['知道了'] //按钮
                                        	},function(){
                                        	    location.reload();//刷新当前页面
                                        	});
                                        }else if(msg=="MONEYNOTENOUGH")
                                        {
                                            //询问框
                                        	layer.confirm('<span style="color:red;">余额不足</span>', {
                                        		btn: ['知道了'] //按钮
                                        	},function(){
                                        	    location.reload();//刷新当前页面
                                        	});
                                        }else
                                        {
                                            //询问框
                                        	layer.confirm('<span style="color:red;">购买金币失败，您可以联系我们的客服人员</span>', {
                                        		btn: ['知道了'] //按钮
                                        	},function(){
                                        	    location.reload();//刷新当前页面
                                        	});
                                        }
                        			}
                        		});
                                //检查通过申请提现
                            }else
                            {
                                $(".safePwd").val("");
                                layer.tips('安全码不正确', '.safePwd');
                            }
            			}
            		});
                }
            });
            //输入安全码
        });
        
        //vip二级联动
        $("#viptype").change(function(){
            var vipType=$(this).val();
            if(vipType==1)
                optionHtml='<option value="1">一个月<?php echo $VIP1price1month->value;?>元</option><option value="3">三个月<?php echo $VIP1price3month->value;?>元</option><option value="6">半年<?php echo $VIP1price6month->value;?>元</option><option value="12">一年<?php echo $VIP1price12month->value;?>元</option>';
            else if(vipType==2)
                optionHtml='<option value="1">一个月<?php echo $VIP2price1month->value;?>元</option><option value="3">三个月<?php echo $VIP2price3month->value;?>元</option><option value="6">半年<?php echo $VIP2price6month->value;?>元</option><option value="12">一年<?php echo $VIP2price12month->value;?>元</option>';
            else
                optionHtml='<option value="1">一个月<?php echo $VIP3price1month->value;?>元</option><option value="3">三个月<?php echo $VIP3price3month->value;?>元</option><option value="6">半年<?php echo $VIP3price6month->value;?>元</option><option value="12">一年<?php echo $VIP3price12month->value;?>元</option>';
            $("#months").html(optionHtml);
        });
        
        //点击购买vip
        $("#buyvip").click(function(){
            var MoneyOwn=parseFloat($(".MoneyOwn").html());//余额
            var vipType=parseInt($("#viptype").val());//vip等级
            var month=parseInt($("#months").val());//购买月数
            var vipPriceArr=new Array();
            vipPriceArr[1]=new Array();
            vipPriceArr[1][1]=<?php echo $VIP1price1month->value;?>;//vip1 一个月价格
            vipPriceArr[1][3]=<?php echo $VIP1price3month->value;?>;//vip1 三个月价格
            vipPriceArr[1][6]=<?php echo $VIP1price6month->value;?>;//vip1 半年价格
            vipPriceArr[1][12]=<?php echo $VIP1price12month->value;?>;//vip1 一年价格
            
            vipPriceArr[2]=new Array();
            vipPriceArr[2][1]=<?php echo $VIP2price1month->value;?>;//vip2 一个月价格
            vipPriceArr[2][3]=<?php echo $VIP2price3month->value;?>;//vip2 三个月价格
            vipPriceArr[2][6]=<?php echo $VIP2price6month->value;?>;//vip2 半年价格
            vipPriceArr[2][12]=<?php echo $VIP2price12month->value;?>;//vip2 一年价格
            
            vipPriceArr[3]=new Array();
            vipPriceArr[3][1]=<?php echo $VIP3price1month->value;?>;//vip3 一个月价格
            vipPriceArr[3][3]=<?php echo $VIP3price3month->value;?>;//vip3 三个月价格
            vipPriceArr[3][6]=<?php echo $VIP3price6month->value;?>;//vip3 半年价格
            vipPriceArr[3][12]=<?php echo $VIP3price12month->value;?>;//vip3 一年价格
            
            if(vipPriceArr[vipType][month]>MoneyOwn)
            {
                layer.tips('余额不足，您的余额为'+MoneyOwn+'元', '#months');
            }
            else
            {
                //检查通过申请提现
                $.ajax({
        			type:"POST",
        			url:"<?php echo $this->createUrl('user/userBuyVipLevel');?>",
        			data:{"vipType":vipType,"month":month,"vipPrice":vipPriceArr[vipType][month]},
        			success:function(msg)
        			{
        				if(msg=="SUCCESS")
                        {
                            //询问框
                        	layer.confirm('VIP购买成功', {
                        		btn: ['知道了'] //按钮
                        	},function(){
                        	    location.reload();//刷新当前页面
                        	});
                        }else
                        {
                            //询问框
                        	layer.confirm('<span style="color:red;">购买VIP失败，您可以联系我们的客服人员</span>', {
                        		btn: ['知道了'] //按钮
                        	},function(){
                        	    location.reload();//刷新当前页面
                        	});
                        }
        			}
        		});
            }
        });
    })
</script>