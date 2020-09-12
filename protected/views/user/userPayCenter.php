         <?php

            echo $this->renderPartial('/user/usercenterTopNav')

         ?>

         <!--账号充值-->

         <div class="d_qie3">

         	<ul class="d_zhcz clearfix">

            	<!--<li class="d_zhcz_li1"><p>网银充值</p><span>（需要手续费）</span></li>-->

				

				<li class="yh"><p>支付宝充值（手机免手续费）</p></li>

				<li class="d_zhcz_li1"><p>财付通充值（手机免手续费）</p></li>

            </ul>

            <div class="d_yhyinchang">

            	<div class="d_cz clearfix">

                    <div class="d_cz_left">

                        <div class="d_czzhanghao clearfix"><p class="d_zhp">支付宝收款账号：</p><span class="d_zhspan">heehuh181@163.com</span><span class="d_name1">平台定期更换账号</span></div>

                        <div class="d_czxingming clearfix"><p>支付宝收款姓名：</p><span class="d_czn">徐克露</span><span class="d_name1">转账时请核实收款姓名</span></div>

                        <div class="d_czjiaoyihao clearfix">

                            <p>支付宝交易号：</p>

                                <input type="text" class="d_jiaoyihao_input businessRecord" placeholder="付款成功后交易明细里的32位数字交易号"/>

								<input type="hidden" name="type" value="2"/>

                        </div>

                        <a class="d_zca" href="#">转账成功后复制交易号验证充值,什么是交易号？</a>

                        <div class="d_yzh payMoneyTo"><a>验证交易号充值</a></div>

                        <p class="d_czjieguo1">如充值成功却验证失败,请等待一分钟后再试。</p>

                        <p class="d_czjieguo2">如若还不能充值成功,请联系客服处理。</p>

                    </div>

                    <div class="d_cz_right">

                        <a href="https://www.alipay.com" target="_blank"><img src="<?php echo VERSION2;?>img/tx.jpg" /></a>

                    </div>

                </div>

                <div class="d_cz clearfix d_yhhide">

                    <div class="d_cz_left">

                        <div class="d_czzhanghao clearfix"><p class="d_zhp">财付通收款账号：</p><span class="d_zhspan">2820307959</span><span class="d_name1">平台定期更换账号</span></div>

                        <div class="d_czxingming clearfix"><p>财付通收款姓名：</p><span class="d_czn">李发光（奋斗）</span><span class="d_name1">转账时请核实收款姓名</span></div>

                        <div class="d_czjiaoyihao clearfix">

                            <p>财付通交易号：</p>

                                <input type="text" class="d_jiaoyihao_input businessRecord3" placeholder="付款成功后交易明细里的28或30位数字交易号"/>

								<input type="hidden" name="type" value="3"/>

                        </div>

                        <a class="d_zca" href="#">转账成功后复制交易号验证充值,什么是交易号？</a>

                        <div class="d_yzh payMoneyTo3"><a>验证交易号充值</a></div>

                        <p class="d_czjieguo1">如充值成功却验证失败,请等待一分钟后再试。</p>

                        <p class="d_czjieguo2">如若还不能充值成功,请联系客服处理。</p>

                    </div>

                    <div class="d_cz_right">

                        <a href="https://www.alipay.com" target="_blank"><img src="<?php echo VERSION2;?>img/tx.jpg" /></a>

                    </div>

                </div>

                

            </div>

            <div class="d_shuoming">

            	<p class="d_shuoming-1">①、支付宝/财付通充值目前为自助入账。</p>

                <p>②、转账充值时请备注您的用户名。</p>

                <p>③、转账完毕后，在此页面验证支付宝/财付通交易号将会自动到账。</p>

                <p>④、充值金额不限，您可以任意转账，手机支付宝/手机QQ转账免手续费。</p>

                <p>⑤、充值没有任何赠送活动，谨防上当受骗。</p>

            </div>

			

         </div>

         <!--账号充值-->

 <!--layer插件-->

<script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>

<script src="<?php echo ASSET_URL;?>layer/layer.js"></script>

<script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>

<link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" />

<script>

    $(function(){

        //支付宝充值

        $(".payMoneyTo").click(function(){

            if($(".businessRecord").val()=="")

            {

                //询问框

            	layer.tips('支付宝交易号不能为空', '.businessRecord');

            }

            else{

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

                                    //检查通过提交交易号充值

                                    $.ajax({

                            			type:"POST",

                            			url:"<?php echo $this->createUrl('user/userPayCenter');?>",

                            			data:{"businessRecord":$(".businessRecord").val(),"type":2},

                            			success:function(msg)

                            			{

                            			     if(msg=="SUCCESS")//充值成功

                                             {

                                				//询问框

                                            	layer.confirm('恭喜您充值成功，请注意查收您的帐户余额', {

                                           		   btn: ['知道了'] //按钮

                                            	},function(){

                                            	   location.reload();//重新加载当前页面

                                            	});

                                             }else if(msg=="NOPNO")

                                             {

                                                //询问框

                                            	layer.confirm('<span style="color:red;">该交易号不存在，请检查</span>', {

                                           		   btn: ['知道了'] //按钮

                                            	},function(){

                                            	   location.reload();//重新加载当前页面

                                            	});

                                             }else if(msg=="EXIST")

                                             {

                                                //询问框

                                            	layer.confirm('<span style="color:red;">该交易号已经充值使用过，无法重复使用</span>', {

                                           		   btn: ['知道了'] //按钮

                                            	},function(){

                                            	   location.reload();//重新加载当前页面

                                            	});

                                             }

                                             else

                                             {

                                                //询问框

                                            	layer.confirm("<span style='color:red;'>充值失败</span><br/><span style='color:red;'>原因1</span>：请检查您填写的支付宝交易号是否正确，如果交易号正确，30秒后再尝试一次，如果仍无法完成充值，请联系客服人员<br/><span style='color:red;'>原因2</span>：该交易号已被充值使用过，禁止重复使用", {

                                           		   btn: ['知道了'] //按钮

                                            	},function(){

                                            	   location.reload();//重新加载当前页面

                                            	});

                                             }

                            			}

                            		});

                                    //检查通过提交交易号充值

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

            }

        });

		//财付通充值

        $(".payMoneyTo3").click(function(){

            if($(".businessRecord3").val()=="")

            {

                //询问框

            	layer.tips('财付通交易号不能为空', '.businessRecord3');

            }

            else{

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

                                    //检查通过提交交易号充值

                                    $.ajax({

                            			type:"POST",

                            			url:"<?php echo $this->createUrl('user/userPayCenter');?>",

                            			data:{"businessRecord":$(".businessRecord3").val(),"type":3},

                            			success:function(msg)

                            			{

                            			     if(msg=="SUCCESS")//充值成功

                                             {

                                				//询问框

                                            	layer.confirm('恭喜您充值成功，请注意查收您的帐户余额', {

                                           		   btn: ['知道了'] //按钮

                                            	},function(){

                                            	   location.reload();//重新加载当前页面

                                            	});

                                             }else if(msg=="NOPNO")

                                             {

                                                //询问框

                                            	layer.confirm('<span style="color:red;">该交易号不存在，请检查</span>', {

                                           		   btn: ['知道了'] //按钮

                                            	},function(){

                                            	   location.reload();//重新加载当前页面

                                            	});

                                             }else if(msg=="EXIST")

                                             {

                                                //询问框

                                            	layer.confirm('<span style="color:red;">该交易号已经充值使用过，无法重复使用</span>', {

                                           		   btn: ['知道了'] //按钮

                                            	},function(){

                                            	   location.reload();//重新加载当前页面

                                            	});

                                             }

                                             else

                                             {

                                                //询问框

                                            	layer.confirm("<span style='color:red;'>充值失败</span><br/><span style='color:red;'>原因1</span>：请检查您填写的财付通交易号是否正确，如果交易号正确，30秒后再尝试一次，如果仍无法完成充值，请联系客服人员<br/><span style='color:red;'>原因2</span>：该交易号已被充值使用过，禁止重复使用", {

                                           		   btn: ['知道了'] //按钮

                                            	},function(){

                                            	   location.reload();//重新加载当前页面

                                            	});

                                             }

                            			}

                            		});

                                    //检查通过提交交易号充值

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

            }

        });

    })

</script>