
    <div class="banNer"><!--首页幻灯-->
        <ul class="rslides" id="slider">
          <li style="background: url(<?php echo VERSION2;?>img/b1.jpg) no-repeat center top;">
          </li>
          <li style="background: url(<?php echo VERSION2;?>img/003.jpg) no-repeat center top;">
          </li>
          <li style="background: url(<?php echo VERSION2;?>img/banner_tg.jpg) no-repeat center top;">
          </li>
        </ul>
        <!--登录区域-->
        <div class="login_frame_bg" <?php if(Yii::app()->user->getId())echo 'style="display:none;"';?>>
            <div class="login_frame">
            <span class="warningSpan"<?php if(isset($_GET['loginStatus']) && $_GET['loginStatus']=='fail') echo 'style="display:block;"';?>>用户名或密码错误</span>
            <div id="myForm">
            <table>
                <form method="post" onsubmit="return checkLogin()" action="<?php echo $this->createUrl('passport/login');?>">
                <tbody>
                    <tr>
                        <td>
                            <div class="login_mailbox">
                                <input type="hidden" name="User[position]" value="index" />
                                <input id="lusername" type="text"  name="User[Username]" autocomplete="off" placeholder="用户名">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p class="zq" id="miaoname" style="margin:-15px 0px 10px;"></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="login_ps">
                                <input id="lpassword" type="password" name="User[PassWord]" name="LoginForm[password]" placeholder="请输入密码">
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <p id="miaopwd" class="zq" style="margin:-15px 0px 10px;"></p>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <li style=" color:#fff; font-size:12px;"><input name="User[rememberMe]" type="checkbox" style="position: relative; top: 3px; width:12px;" /> 下次自动登录<a href="javascript:;" class="forgetPwd" style=" float:right; margin-right:28px; color:white;">忘记密码?</a></li><br />
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <button class="login-btn" id="login_btn">登录</button>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <span><a href="<?php echo $this->createUrl('passport/regist');?>" id="a">还没有账号？点击注册>></a></span>
                        </td>
                    </tr>
                </tbody>
                <form>
            </table>
            </div>
            </div>
        </div>
    <div class="indIntr" style="background="chose.png"><!--系统优势-->
        <div class="why_main clearfix">
            <a href="#" class="why_main1" lang="lock"><img src="<?php echo VERSION2;?>img/lock.png" alt="" /></a>
            <a href="#" class="why_main2" lang="kekao"><img src="<?php echo VERSION2;?>img/kekao.png" alt="" /></a>
            <a href="#" class="why_main3" lang="tiexin"><img src="<?php echo VERSION2;?>img/tiexin2.png" alt="" /></a>
        </div>
        <div class="whyy">
            <div class="whyy1">
                <p class="whyy1t" id="z2" >安&nbsp;&nbsp;&nbsp;全</p>
                <p id="z25"><span>资金安全：</span>威客购买您店铺宝贝完成任务后</p>
                <p id="z26">平台会将此资金100%放款给威客</p>
                <p><span>来源真实：</span>全国各地真实IP用户帮您完成任务</p>
            </div>
            <div class="whyy1" id="z3" >
                <p class="whyy1t" id="z4" >可&nbsp;&nbsp;&nbsp;靠</p>
                <p  id="z5" ><span>减少降权：</span>结合旺旺聊天、搜索来路、停留时长</p>
                <p id="z6" >等特定条件有效减少80%降权风险</p>
                <p><span>杜绝纠纷：</span>平台作为中介在整个任务过程中为双方提供担保</p>
            </div>
            <div class="whyy1 tx">
                <p class="whyy1t">贴&nbsp;&nbsp;&nbsp;心</p>
                <p class="wd"><span>7×24 </span>小时系统稳定</p>
                <p class="zx"><span>7×24 </span>小时客服在线</p>
                <p class="zc"><span>7×24 </span>小时技术支持</p>
            </div>
        </div>
    </div>
    <div id="task">
      <div class="task_main_bg">
        <div class="plane"> <img src="<?php echo VERSION2;?>img/plane.gif" alt=""/> </div>
        <div class="t1">
          <div class="t11 frw1"> <img id="z7"  src="<?php echo VERSION2;?>img/t11.png" alt="">
            <div class="t111"> <img  class="tfimg" src="<?php echo VERSION2;?>img/t12.png" alt="" /> <span class="taskf" id="bei1">注册</span>
              <div class="bei1"  ><img src="<?php echo VERSION2;?>img/bei1.png" alt="" class="mimg"/></div>
            </div>
          </div>
          <div class="t11 frw2"> <img src="<?php echo VERSION2;?>img/t21.jpg" alt="" /><br />
            <div class="t111"> <img  class="tfimg" src="<?php echo VERSION2;?>img/t22.jpg" alt="" /> <span class="taskf" id="bei2">绑定掌柜名</span>
              <div class="bei2" ><img src="<?php echo VERSION2;?>img/bei2.png" alt="" class="mimg"/></div>
            </div>
          </div>
          <div class="t11 jrw jrw1"> <img src="<?php echo VERSION2;?>img/t31.jpg" alt="" class="jrw_img"/><br />
            <div class="t111"> <img  class="tfimg" src="<?php echo VERSION2;?>img/t32.jpg" alt="" /> <span class="taskf" id="bei7">注册</span>
              <div class="bei7" ><img src="<?php echo VERSION2;?>img/bei7.png" alt="" class="mimg"/></div>
            </div>
          </div>
          <div class="t11 jrw2"> <img src="<?php echo VERSION2;?>img/t41.jpg" alt="" /><br />
            <div class="t111"> <img  class="tfimg" src="<?php echo VERSION2;?>img/t42.jpg" alt="" /> <span class="taskf" id="bei8">绑定买号</span>
              <div class="bei8" ><img src="<?php echo VERSION2;?>img/bei8.png" alt="" class="mimg"/></div>
            </div>
          </div>
        </div>
        <div id="z8" class="t1">
          <div class="t11 frw3"   id="z9"> <img class="jrw_img" src="<?php echo VERSION2;?>img/t51.jpg" alt="">
            <div class="t111"> <img  class="tfimg" src="<?php echo VERSION2;?>img/t52.jpg" alt="" /> <span class="taskf" id="bei3">发布任务</span>
              <div class="bei3" ><img src="<?php echo VERSION2;?>img/bei3.png" alt="" class="mimg"/></div>
            </div>
          </div>
          <div class="t11 frw4"> <img src="<?php echo VERSION2;?>img/t61.jpg" alt="" /><br />
            <div class="t111"> <img  class="tfimg" src="<?php echo VERSION2;?>img/t62.jpg" alt="" /> <span class="taskf" id="bei4">等待接手</span>
              <div class="bei4" ><img src="<?php echo VERSION2;?>img/bei4.png" alt=""  class="mimg"/></div>
            </div>
          </div>
          <div class="t11 jrw jrw3"> <img src="<?php echo VERSION2;?>img/t71.jpg" alt="" class="jrw_img"/><br />
            <div class="t111"> <img  class="tfimg" src="<?php echo VERSION2;?>img/t72.jpg" alt="" /> <span class="taskf" id="bei9">接手任务</span>
              <div class="bei9" ><img src="<?php echo VERSION2;?>img/bei9.png" alt="" class="mimg"/></div>
            </div>
          </div>
          <div class="t11 jrw4" id="z11"> <img src="<?php echo VERSION2;?>img/t81.jpg" alt="" /><br />
            <div class="t111" id="z10"> <img  class="tfimg" src="<?php echo VERSION2;?>img/t82.jpg" alt="" /> <span class="taskf" id="bei10">拍下付款</span>
              <div class="bei10" ><img src="<?php echo VERSION2;?>img/bei10.png" alt="" class="mimg" /></div>
            </div>
          </div>
        </div>
        <div id="z12" class="t1">
          <div class="t11 frw5" id="z14"> <img id="z13" src="<?php echo VERSION2;?>img/t91.jpg" alt="">
            <div class="t111"> <img  class="tfimg" src="<?php echo VERSION2;?>img/t92.jpg" alt="" /> <span class="taskf" id="bei5">验收确认</span>
              <div class="bei5" ><img src="<?php echo VERSION2;?>img/bei5.png" alt="" class="mimg" /></div>
            </div>
          </div>
          <div class="t11 frw6"> <img src="<?php echo VERSION2;?>img/t121.jpg" alt="" /><br />
            <div class="t111" id="z15"> <img  class="tfimg" src="<?php echo VERSION2;?>img/t122.jpg" alt="" /> <span class="taskf" id="bei6">信誉提升</span>
              <div class="bei6" ><img src="<?php echo VERSION2;?>img/bei6.png" alt=""  class="mimg"/></div>
            </div>
          </div>
          <div class="t11 jrw jrw5"> <img src="<?php echo VERSION2;?>img/t101.jpg" alt="" class="jrw_img"/><br />
            <div class="t111"> <img  class="tfimg" src="<?php echo VERSION2;?>img/t102.jpg" alt="" /> <span class="taskf" id="bei11">定时收货 </span>
              <div class="bei11" ><img src="<?php echo VERSION2;?>img/bei11.png" alt="" class="mimg" /></div>
            </div>
          </div>
          <div class="t11 jrw6" id="z16"> <img src="<?php echo VERSION2;?>img/t111.jpg" alt="" /><br />
            <div class="t111"> <img  class="tfimg" src="<?php echo VERSION2;?>img/t112.jpg" alt="" /> <span class="taskf" id="bei12">得佣金</span>
              <div class="bei12" ><img src="<?php echo VERSION2;?>img/bei12.png" alt="" class="mimg"/></div>
            </div>
          </div>
        </div>
        <div class="outmessage"> <a href="<?php echo $this->createUrl('user/taskPublishPT');?>" ><img id="outmessage" src="<?php echo VERSION2;?>img/outmessage.jpg" alt=""  /></a> <a href="<?php echo $this->createUrl('site/taobaoTask');?>"><img id="outmoney"  src="<?php echo VERSION2;?>img/outmoney.jpg" alt="" /></a> </div>
      </div>
      <div class="task_main">
        <div class="task_mainbody"> <span><a href="#"></a></span> <span><a href="#"></a></span> </div>
      </div>
    </div>
    
    <div id="question">
      <div class="rank_main_1"><span class="rank_main_1_span">新手答疑</span></div>
      <div class="question_mainbody" >
        <div class="answer_question_abstract"> <span id="answer_question_abstract"> 让您更快速了解接手方、发布方任务流程相关疑问</span> </div>
        <div class="question_table">
          <div class="question_table_left">
            <div class="question_nav">
              <div class="fb_title"><a href="<?php echo $this->createUrl('news/list',array('catlogid'=>38));?>">发布方疑问解析</a></div>
              <ul>
                <?php
                    $articleInfo=Article::model()->findAll(array(
                        'condition'=>'cat_id=38 and is_delete=0',
                        'select'=>'goods_id,goods_name,cat_id',
						'order'=>'add_time desc',
                        'limit'=>'6'
                    ));
                    foreach($articleInfo as $item){
                ?>
                <li><a title="" href="<?php echo $this->createUrl('news/deatailInfo',array('id'=>$item->goods_id,'catlogid'=>$item->cat_id));?>"><?php
                    echo $item->goods_name;
                ?></a></li>
                <?php
                    }
                ?>
              </ul>
            </div>
          </div>
          <div class="question_table_right">
            <div class="question_nav">
              <div class="fb_title"><a href="<?php echo $this->createUrl('news/list',array('catlogid'=>39));?>">接任务疑问解析</a></div>
              <ul>
                <?php
                    $articleInfo=Article::model()->findAll(array(
                        'condition'=>'cat_id=39 and is_delete=0',
                        'select'=>'goods_id,goods_name,cat_id',
						'order'=>'add_time desc',
                        'limit'=>'6'
                    ));
                    foreach($articleInfo as $item){
                ?>
                <li><a title="" href="<?php echo $this->createUrl('news/deatailInfo',array('id'=>$item->goods_id,'catlogid'=>$item->cat_id));?>"><?php
                    echo $item->goods_name;
                ?></a></li>
                <?php
                    }
                ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--layer插件-->
    <script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>
    <script src="<?php echo ASSET_URL;?>layer/layer.js"></script>
    <script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>
    <link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" />
    <script>
        //登录表单检测
        function checkLogin()
        {
            if($("#lusername").val()=="")
            {
                layer.tips('用户名不能为空', '#lusername');
                return false;
            }else if($("#lpassword").val()=="")
            {
                layer.tips('密码不能为空', '#lpassword');
                return false;
            }else
            {
                var submitStatus=0;//提交状态初始化
                var phone=0;//手机号码初始化
                //检查是否开启异地登录
                $.ajax({
        			type:"POST",
        			url:"<?php echo $this->createUrl('passport/placeOtherLogin');?>",
        			data:{"username":$("#lusername").val(),"pwd":$("#lpassword").val()},
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
                    layer.tips('用户名或密码不正确', '#lusername', {
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
                                            			data:{"username":$("#lusername").val(),"pwd":$("#lpassword").val()},
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
    </script>
    <!-- JiaThis Button BEGIN -->
    <!--<script type="text/javascript" src="http://v3.jiathis.com/code/jiathis_r.js?type=left&amp;move=0&amp;btn=l3.gif" charset="utf-8"></script>-->
    <!-- JiaThis Button END -->
    <script>
        $(function(){
            $(".jiathis_style").css("top","96px");
            $(".ckepopBottom").hide();
        })
    </script>