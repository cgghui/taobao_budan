    <?php
        echo $this->renderPartial('/user/taobaoTaskNav');//载入淘宝大厅导航
    ?>
    <div class="yjrw">
        <div class="yjrwCen">
            <?php
                echo $this->renderPartial('/user/taobaoInTaskNav');//载入已接任务-状态导航
            ?>
            <div class="rwsj"><!--任务搜索开始-->
                <div class="rwfbsj clearfix">
                    <form action="" method="">
                        <div class="rwfbsj_t">任务发布时间：</div>
                        <input type="hidden" name="taskCata" value="taskOut" />
                        <input type="text" name="act_start_time" class="rwfbsj1" placeholder="开始时间" readonly="readonly" />
                        <div style="float:left;">&nbsp&nbsp-</div>
                        <input type="text" name="act_stop_time" class="rwfbsj1" placeholder="结束时间" readonly="readonly" />
                        <input type="submit" class="rwss" value="搜索">
                    </form>
                </div>
                <div class="rwjssj clearfix">
                    <form action="" method="">
                        <div class="rwfbsj_t">任务接手时间：</div>
                        <input type="hidden" name="taskCata" value="taskIn" />
                        <input type="text" name="act_start_time" class="rwfbsj1" placeholder="开始时间" readonly="readonly" />
                        <div style="float:left;">&nbsp&nbsp-</div>
                        <input type="text" name="act_stop_time" class="rwfbsj1" placeholder="结束时间" readonly="readonly" />
                        <input type="submit" class="rwss" value="搜索" />
                    </form>
                </div>
            </div><!--任务搜索结束-->
        </div>
    </div>
    <div class="dtrw"><!--大厅任务-->
        <div class="dtrwCen">
            <div class="dtrwCen_t">
                <div class="rwso">
                    <form action="<?php echo $this->createUrl('user/taobaoInTaskWaitPay');?>" method="post">
                        <input type="text" name="keywords" class="rwsoInp" placeholder="任务编号搜索">
                        <input type="submit" class="rwsoImg" value="&nbsp">
                    </form>
                </div>
                <a class="rwsoNo" href="/news/deatailInfo/id/147/catlogid/41.html" target="_blank">接任务必看，违者封号</a>
                <a href="<?php echo $this->createUrl('user/taskPublishPT');?>" class="rw_fb1">发布任务</a>
                <a href="javascript:window.location.href='<?php echo Yii::app()->request->url;?>';" class="rw_sx1">刷新任务</a>
            </div>
        </div>
        <ul class="dtrwLis">
            <?php
                foreach($proInfo as $item){
            ?>
            <li class="taskItem">
                <div class="rebh">
                    <img class="payWay" width="30" src="<?php 
                        switch($item->payWay)
                        {
                            case 1://接手垫付
                                echo VERSION2."/img/ykdf.jpg";
                                break;
                            default://远程单
                                echo VERSION2."/img/df.jpg";
                                break;
                        }
                    ?>" lang='<?php echo $item->payWay;?>' />
                    <img class="platform" width="30" src="<?php 
                        switch($item->platform)
                        {
                            case 1:
                                echo VERSION2."/img/tm.jpg";
                                break;
                            case 2:
                                echo VERSION2."/img/jd.jpg";
                                break;
                            default:
                                echo VERSION2."/img/1688.jpg";
                                break;
                        }
                    ?>" lang='<?php echo $item->platform;?>' />
                    
                    <font>任务编号</font>：<span><?php echo $item->time.'*'.$item->id;?></span>
                    <font style="color:#000; maring-left:10px;">小号信誉要求：</font>
                    <?php
                        if($item->BuyerJifen<>0){
                    ?>
                    <img title="<?php 
                        switch($item->BuyerJifen)
                        {
                            case 1:
                                $dj="一心";
                                break;
                            case 2:
                                $dj="二心";
                                break;
                            case 3:
                                $dj="三心";
                                break;
                            case 4:
                                $dj="四心";
                                break;
                            case 5:
                                $dj="五心";
                                break;
                            case 6:
                                $dj="一钻";
                                break;
                            case 7:
                                $dj="二钻";
                                break;
                            case 8:
                                $dj="三钻";
                                break;
                            case 9:
                                $dj="四钻";
                                break;
                            default:
                                $dj="五钻";
                                break;
                        }
                        echo "卖家要求威客买号等级在".$dj;
                    ;?>"  class="BuyerJifen" lang="<?php echo $item->BuyerJifen;?>" src="<?php if($item->platform!=2) { echo VERSION2;?>img/level/<?php echo $item->BuyerJifen.".gif";} else { echo VERSION2;?>img/level/jd<?php echo $item->BuyerJifen.".png";} ?>" style="vertical-align: text-top;cursor:pointer;" />
                    <?php
                        }else{
                            echo "无要求";
                        }
                    ?>
                </div>
                <div class="allRw_pro">
                    <img src="<?php echo VERSION2;?>img/p<?php echo $item->taskCatalog==0?2:1;?>.jpg" alt="" title="<?php echo $item->taskCatalog==0?"普通任务":"来路搜索任务";?>" class="allRw_proImg" />
                    <div class="allRw_pros">
                        <div class="allRw_prosLis">
                            <div class="allRw_pro_intr clearfix">
                                <div class="allRw_pro1">
                                    掌柜：<span><?php echo XUtils::cutstr($item->ddlZGAccount,4)."***";?></span>
                                    <!--掌柜个人信息-->
                                    <?php
                                        $myinfo=User::model()->findByPk($item->publishid);
                                        //好评
                                        $hp=Appraise::model()->findAllByAttributes(array(
                                            'uid'=>$item->publishid,
                                            'status'=>2
                                        ));
                                        //中评
                                        $zp=Appraise::model()->findAllByAttributes(array(
                                            'uid'=>$item->publishid,
                                            'status'=>1
                                        ));
                                        //差评
                                        $cp=Appraise::model()->findAllByAttributes(array(
                                            'uid'=>$item->publishid,
                                            'status'=>0
                                        ));
                                        //被拉黑名单次数
                                        $countBlack=Myblackerlist::model()->findAllByAttributes(array(
                                            'blackerusername'=>$myinfo->Username
                                        ));
                                    ?>
                                    <div class="person-info">
                                      <ul style="padding-top: 15px;">
                                          <li class="xf_name" title="经验值越高，代表会员越熟悉任务流程">经验：<b><?php echo $myinfo->Experience;?></b><span>好评率：<b><?php
                                            if((count($hp)+count($zp)+count($cp))==0)
                                                echo "100%";
                                            else  if((count($zp)+count($cp))==0)
                                            {
                                                echo "100%";
                                            }
                                            else
                                                echo (count($hp)/(count($zp)+count($cp)))."%";
                                          ?></b></span></li>
                                          <!--<li class="xf_hzc"><span class="hp">好评：<b><?php echo count($hp);?></b></span><span class="zp">中评：<b><?php echo count($zp);?></b></span><span class="cp">差评：<b><?php echo count($cp);?></b></span></li>-->
                                          <li class="xf_hmd">已被<b><?php echo count($countBlack);?></b>人加入黑名单<a class="jh_btn button border-blue jrhmd" href="<?php echo $this->createUrl('user/userBlackAccountList');?>" target="_blank">加入黑名单</a></li>
                                      </ul>
                                  </div>
                                </div>
                                <ul class="othallRw_pro clearfix">
                                    <li title="在拍下商品并支付后，<?php echo $item->ddlOKDay*24==0?"立即":"在".($item->ddlOKDay*24)."小时后";?>且物流信息显示已签收后确认收货五星好评！">
                                        收货时长： 
                                        <span>
                                            <?php echo $item->ddlOKDay*24==0?"立即":($item->ddlOKDay*24)."小时立即";?>
                                        </span>
                                        五星好评
                                    </li>
                                    <li title="平台担保：此任务卖家已缴纳全额担保存款，接手可放心购买，任务完成后，买家平台账号自动获得相应存款">
                                        任务金额： <span><?php echo $item->txtPrice;?></span>元
                                    </li>
                                    <li title="完成任务后，您能获得的任务奖励，可兑换成RMB">
                                    悬赏金币： <span><?php echo $item->MinLi;?></span>个
                                    </li>
                                </ul>
                            </div>
                            <div class="allRw_proLink">
                                <?php
                                    if($item->cbxIsSB)
                                        echo '<a style="border-color:red; color:red;">商保</a>';
                                    if($item->isLimitCity)
                                        echo '<a style="border-color:red; color:red;">'.$item->Province.'</a>';
                                    if($item->isMobile)
                                        echo '<a style="border-color:red; color:red;">手机</a>';
                                    if($item->isSign)
                                        echo '<a style="border-color:red; color:red;">真签</a>';
                                    if($item->cbxIsAudit)
                                        echo '<a>审核</a>'; 
                                    if($item->isReal)
                                        echo '<a>实名</a>';
                                    if($item->cbxIsWW)
                                        echo '<a>旺聊</a>';
                                    if($item->stopDsTime)
                                        echo '<a>停留</a>';
                                    if($item->cbxIsLHS)
                                        echo '<a>旺收</a>';
                                    if($item->cbxIsMsg)
                                        echo '<a>评语</a>';
                                    if($item->shopcoller)
                                    {
                                        $itemImg=$item->taskerSCImg!=""?$item->taskerSCImg:"";
                                        echo '<a class="bueryImg" alt="'.$itemImg.'">收藏</a>';
                                    }
                                    if($item->isViewEnd)
                                    {
                                        $itemImg=$item->taskerBottomImg!=""?$item->taskerBottomImg:"";
                                        echo '<a class="bueryImg" alt="'.$itemImg.'">底图</a>';
                                    }
                                ?>
								<?php
                                    if($item->isGaijia){//改价
                                ?>
                                <a class="bueryImg" lang="" title="商家改价后再行付款">
                                    改价
                                </a>
                                <?php }?>
                                <?php
                                    if($item->isCompare){//货比截图
                                ?>
                                <a class="bueryImg" lang="<?php echo $item->taskerHBoneImg.'|'.$item->taskerHBsecondImg.'|'.$item->taskerHBthirdImg;?>" title="接任务者需要根据任务提示上传货比<?php echo $item->contrast;?>家截图">
                                    货比<?php echo $item->contrast;?>家
                                </a>
                                <?php }?>
                                <?php
                                    if($item->shopBrGoods){
                                ?>
                                <a class="bueryImg"  lang="<?php echo $item->taskerOtheroneImg.'|'.$item->taskerOthersecondImg;?>" title="接任务者需要根据任务提示浏览店内其他<?php echo $item->lgoods;?>件商品并截图">
                                    浏览商品
                                </a>
                                <?php }?>
                                <?php
                                    if($item->pinimage){
                                ?>
                                <a class="bueryImg" alt="<?php echo $item->taskerHPingImg!=""?$item->taskerHPingImg:"";?>" title="接任务者需要根据任务提示上传好评截图">好评截图</a>
                                <?php }?>
                            </div>
                        </div>
                    </div>
                    <?php
                        if($item->status==0){
                    ?>
                    <a href="#" class="qcrw">等待接手</a>
                    <?php
                        }
                        if($item->status==1){
                    ?>
                        <a class="qcrw waitSeller" style="width: auto; padding:0 8px; cursor: pointer;" title="点击查看提醒">等待商家审核</a>
                        <div class="clear"></div>
                        <span style="width: auto; position: relative; top:-30px; left:805px;" class="settime" lang="<?php echo $item->taskerid;?>" alt="<?php echo $item->id;?>" endTime="<?php echo date("Y-m-d H:i:s",$item->taskfristTime+760);?>"></span>
                    <?php
                        }
                        if($item->status==2){
                    ?>
                         <a href="javascript:;" class="qcrw certainGoToPay" alt="<?php echo $item->id;?>" style="width: auto; padding:0 8px; cursor: pointer;">等待您对商品付款</a>
                         <div class="clear"></div>
                         <span style="width: auto; position: relative; top:-30px; left:805px;" class="settime" action="waiterBuyerPay" lang="<?php echo $item->taskerid;?>" alt="<?php echo $item->id;?>" endTime="<?php echo date("Y-m-d H:i:s",$item->tasksecondTime+1800);?>"></span>
                    <?php
                        }
                        if($item->status==3){
                    ?>
                        <a href="javascript:;" class="qcrw sellerSendGood" alt="<?php echo $item->id;?>" style="width: auto; padding:0 8px; cursor: pointer;">您已付款，等待商家发货</a>
                        <div class="clear"></div>
                        <span style="width: auto; position: relative; top:-30px; left:805px;" class="settime" action="waiteSellerSendGood" lang="<?php echo $item->taskerid;?>" alt="<?php echo $item->id;?>" endTime="<?php echo date("Y-m-d H:i:s",$item->taskthirdTime+10800);?>"></span>
                    <?php
                        }
                        if($item->status==4){
                    ?>
                        <a href="javascript:;" class="qcrw waitBuyerHP" alt="<?php echo $item->id;?>" style="width: auto; padding:0 8px; cursor: pointer;">等待您收货好评</a>
                    <?php
                        }
                        if($item->status==5 && $item->taskCompleteStatus==0){
                    ?>
                        <a href="javascript:;" class="qcrw waitSellerLastCertain" lang="<?php echo $item->id;?>" style="width: auto; padding:0 8px; cursor: pointer;">等待商家审核完成</a>
                    <?php
                        }
                        if($item->taskCompleteStatus==1){
                    ?>
                        <a href="javascript:;" class="qcrw" style="width: auto; padding:0 8px; cursor: pointer;">任务已完成</a>
                    <?php
                        }
                    ?>
                </div>
                <div class="clear"></div>
                <?php
                    if($item->status<>0){
                        $buyerinfo=Blindwangwang::model()->findByAttributes(array(
                            'wangwang'=>$item->ddlZGAccount
                        ));
                        $usermsg=User::model()->findByPk($item->publishid);
                ?>
                <div class="takerInfo"><!--taskFunMan start-->
                    <span>商家信息：</span><?php echo $usermsg->Username;?>　<img src="<?php echo VERSION2?>img/wang.jpg" width="20" style="position: relative; top:5px;" />&nbsp;采用买号：<?php echo $item->ddlZGAccount;?>　　　　　联系对方：&nbsp;<a title="点击添加对方为好友" target=blank href=http://wpa.qq.com/msgrd?V=3&uin=<?php echo $usermsg->QQToken;?>&Site=点击添加好友&Menu=yes><img border="0" SRC=http://wpa.qq.com/pa?p=1:<?php echo $usermsg->QQToken;?>:4 alt="点击这里给我发消息" style="position: relative; top:2px; left:-3px" /></a>　
                    <span style="color: red;"><?php
                        if($item->orderNumber)
                            echo "订单编号：".$item->orderNumber."<font style='color:#000'>(我购买的订单编号)</font>";
                    ?></span>
                    <?php
                        if($item->status==1){
                    ?>
                    <a href="javascript:;" class="taskBack" lang="<?php echo $item->taskerid;?>" alt="<?php echo $item->id;?>" style="border: 1px solid red; border-radius: 3px; padding:3px 5px; color:red;">退出任务</a>
                    <?php }?>
                </div><!--taskFunMan end-->
                <?php
                    }
                ?>
                <div class="introduce"><!--introduce start-->
                    <?php
                        if($item->txtMessage){
                    ?>
                    <p>规定好评内容：<?php echo $item->txtMessage;?></p>
                    <?php
                        }
                    ?>
                    <?php
                        $addressInfoArr=explode('|',$item->cbxIsAddressContent);
                        if(count($addressInfoArr) && $addressInfoArr[0]){
                    ?>
                    <p>
                        规定收货地址：
                        姓名：<?php echo $addressInfoArr['0'];?>　地址：<font style='color:#e99f4b;'><?php echo $addressInfoArr['3'];?></font>　邮编：<?php echo $addressInfoArr['2'];?>　电话：<?php echo $addressInfoArr['1'];?>
                    </p>
                    <?php }?>
                    <?php
                        if($item->txtRemind){
                    ?>
                    <p>卖家留言提醒：<?php echo $item->txtRemind!=""?$item->txtRemind:"请按要求完成任务";?></p>
                    <?php }?>
                </div><!--introduce end-->
            </li>
            <?php }?>
        </ul>
        <div class="breakpage"><!--分页开始-->
            <?php
                $this->widget('CLinkPager', array(
                    'selectedPageCssClass'=>'active',
                    'pages' => $pages,
                    'lastPageLabel' => '最后一页',
                    'firstPageLabel' => '第一页',
                    'header' => false,
                    'nextPageLabel' => ">>",
                    'prevPageLabel' => "<<",
                ));
            ?>
        </div><!--分页结束-->
    </div><!--大厅任务 end-->
    <!--日期选择器-->
    <script type="text/javascript" src="<?php echo ASSET_URL;?>/datapicker/js/jquery-1.11.0.min.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo ASSET_URL;?>/datapicker/css/jquery-ui.css" />
    <script type="text/javascript" src="<?php echo ASSET_URL;?>/datapicker/js/jquery-ui-1.10.4.custom.min.js"></script>
    <script type="text/javascript" src="<?php echo ASSET_URL;?>/datapicker/js/jquery.ui.datepicker-zh-CN.js"></script>
    <script type="text/javascript" src="<?php echo ASSET_URL;?>/datapicker/js/jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript" src="<?php echo ASSET_URL;?>/datapicker/js/jquery-ui-timepicker-zh-CN.js"></script>
    <style type="text/css">
    body{font:12px/21px "microsoft yahei";color:#404040;background-position:center 31px;background-repeat:no-repeat;}
    .ui-timepicker-div .ui-widget-header { margin-bottom: 8px; }
    .ui-timepicker-div dl { text-align: left; }
    .ui-timepicker-div dl dt { float: left; clear:left; padding: 0 0 0 5px; }
    .ui-timepicker-div dl dd { margin: 0 10px 10px 45%; }
    .ui-timepicker-div td { font-size: 90%; }
    .ui-tpicker-grid-label { background: none; border: none; margin: 0; padding: 0; }
    
    .ui-timepicker-rtl{ direction: rtl; }
    .ui-timepicker-rtl dl { text-align: right; padding: 0 5px 0 0; }
    .ui-timepicker-rtl dl dt{ float: right; clear: right; }
    .ui-timepicker-rtl dl dd { margin: 0 45% 10px 10px; }
    .text-box{ text-align: center;}
    </style>
    <script type="text/javascript">
	$( "input[name='act_start_time'],input[name='act_stop_time']" ).datetimepicker();
    </script>
    <script language="javascript">
        /*
            **审核任务倒计时
        */
        $(function(){
            updateEndTime();
        });
        //倒计时函数
        function updateEndTime()
        {
            var date = new Date();
            var time = date.getTime(); //当前时间距1970年1月1日之间的毫秒数
            
            $(".settime").each(function(i){
                var endDate =this.getAttribute("endTime"); //结束时间字符串
                //转换为时间日期类型
                var endDate1 = eval('new Date(' + endDate.replace(/\d+(?=-[^-]+$)/, function (a) { return parseInt(a, 10) - 1; }).match(/\d+/g) + ')');
                
                var endTime = endDate1.getTime(); //结束时间毫秒数
                
                var lag = (endTime - time) / 1000;
                if(lag > 0)
                {
                    var second = Math.floor(lag % 60); 
                    var minite = Math.floor((lag / 60) % 60);
                    var hour = Math.floor((lag / 3600) % 24);
                    var day = Math.floor((lag / 3600) / 24);
                    if($(this).attr("action")=="waiterBuyerPay")//倒计时提示方案根据任务状态进行调整
                    {
                        actionName="您付款";
                    }else if($(this).attr("action")=="waiteSellerSendGood")
                    {
                        actionName="自动发货";
                    }
                    else
                    {
                        actionName="商家审核";
                    }
                    $(this).html("<span style='line-height:30px; color:#666;'>"+actionName+"剩余时间：<font style='color:red; font-weight:bold;'>"+hour+"小时"+minite+"分"+second+"秒</font></span>");
                }
                else
                {
                    if($(this).attr("action")=="waiterBuyerPay")//等待接手付款倒计时结束后将任务重置且刷新当前页面
                    {
                        var taskerid=$(this).attr("lang");
                        var id=$(this).attr("alt");
                        //$(this).html(taskerid+'->'+id);
                        $.ajax({
                			type:"POST",
                			url:"<?php echo $this->createUrl('site/taskAutoBackWaitBueryPay');?>",
                			data:{"taskerid":$(this).attr("lang"),"id":$(this).attr("alt")},
                			success:function(msg)
                			{
                				location.reload();//重新刷新当前页面
                			}
                		});
                    }
                    else if($(this).attr("action")=="waiteSellerSendGood")//完成付款，等待商家发货倒计时
                    {
                        $.ajax({
                			type:"POST",
                			url:"<?php echo $this->createUrl('site/sellerCertainSendGood');?>",
                			data:{"taskid":$(this).attr("alt")},
                			success:function(msg)
                			{
                                if(msg=="SUCCESS")
                                {
               			            layer.confirm('发货成功', {
                                		btn: ['知道了'] //按钮
                                	},function(){
                                	   location.reload();//重新刷新当前页面
                                	});
                                }
                                else
                                {
                                    layer.confirm('发货失败，请联系我们的客服人员', {
                                		btn: ['知道了'] //按钮
                                	},function(){
                                	   location.reload();//重新刷新当前页面
                                	});
                                }
                			}
                		});
                    }
                    else{
                        //审核倒计时结束后将任务重置且刷新当前页面
                        var taskerid=$(this).attr("lang");
                        var id=$(this).attr("alt");
                        //$(this).html(taskerid+'->'+id);
                        $.ajax({
                			type:"POST",
                			url:"<?php echo $this->createUrl('site/taskAutoBack');?>",
                			data:{"taskerid":$(this).attr("lang"),"id":$(this).attr("alt")},
                			success:function(msg)
                			{
                				location.reload();//重新刷新当前页面
                			}
                		});
                    }
                }
            });
            setTimeout("updateEndTime()",1000);
        }
    </script>
    
    <!--layer插件-->
    <script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>
    <script src="<?php echo ASSET_URL;?>layer/layer.js"></script>
    <script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>
    <link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" />
    <script>
        $(function(){
            //点击等待商家审核友情提醒
            $(".waitSeller").click(function(){
            	layer.confirm('倒计时结束，如果商家没有完成审核，任务将返回任务大厅，您可以通过<span style="color:red;">商家信息中的商家QQ添加好友或电话联系商家进行审核</span>！', {
            		btn: ['知道了'] //按钮
            	});
            });
            
            //接手退出任务
            $(".taskBack").click(function(){
                var taskerid=$(this).attr("lang");
                var id=$(this).attr("alt");
                layer.confirm('您确定要退出任务？退出任务的次数将影响你的信息评级', {
            		btn: ['确定退出','不退出'] //按钮
            	},function(){
            	   $.ajax({
            			type:"POST",
            			url:"<?php echo $this->createUrl('site/taskAutoBack');?>",  
            			data:{"taskerid":taskerid,"id":id},
            			success:function(msg)
            			{
       			            layer.confirm('任务退出成功返回任务大厅', {
                        		btn: ['知道了'] //按钮
                        	},function(){
                        	   location.reload();//重新刷新当前页面
                        	});
            			}
            		});
            	});
            });
            
            //接手执行付款操作
            $(".certainGoToPay").click(function(){
                layer.open({
                    type: 2,
                    title:'聚宝盆任务提示',
                    area: ['526px','560px'],
                    skin: 'layui-layer-rim', //加上边框
                    content: ['/site/buyerToPay.html?taskid='+$(this).attr('alt')+'', 'no']
                });
            });
            
            //接手执行收货好评操作
            $(".waitBuyerHP").click(function(){
                layer.open({
                    type: 2,
                    title:'收货好评',
                    area: ['526px','360px'],
                    skin: 'layui-layer-rim', //加上边框
                    content: ['/site/waitBuyerHP.html?taskid='+$(this).attr('alt')+'', 'no']
                });
            });
            
            //商家查看接手上传截图
            $("a.bueryImg").click(function(){
                var imgUrl=$(this).attr("alt");
                if($(this).attr("alt")!="" && !$(this).attr("lang"))
                {
                    if(imgUrl!="")
                    {
                        layer.open({
                            type: 1,
                            title: false,
                            closeBtn: 1,
                            area: ['95%','80%'],
                            shadeClose: true,
                            content: '<div style="text-align:center;"><img src="'+imgUrl+'"></div>'
                        });
                    }
                    else
                    {
                        layer.confirm('任务还没有完成，暂无截图', {
                    		btn: ['知道了'] //按钮
                    	});
                    }
                }
                
                if($(this).attr("lang")!="" && !$(this).attr("alt"))//货比与浏览店内其他商品
                {
                    var imgUrl=$(this).attr("lang");//图片路径连接符
                    var imgSrc="";
                    var urlArr=imgUrl.split("|");
                    if(urlArr[0]!="" && urlArr.length>0)
                    {
                        imgSrc+='<div style="text-align:center;"><img src="'+urlArr[0]+'"></div>';
                    }
                    
                    if(urlArr[1]!="" && urlArr.length>1)
                    {
                        imgSrc+='<div style="text-align:center;"><img src="'+urlArr[1]+'"></div>';
                    }
                    
                    if(urlArr[2]!="" && urlArr.length>2)
                    {
                        imgSrc+='<div style="text-align:center;"><img src="'+urlArr[2]+'"></div>';
                    }
                    if(imgSrc!="")
                    {
                        layer.open({
                            type: 1,
                            title: false,
                            closeBtn: 1,
                            area: ['95%','80%'],
                            shadeClose: true,
                            content: ''+imgSrc+''
                        });
                    }
                    else
                    {
                        layer.confirm('任务还没有完成，暂无截图', {
                    		btn: ['知道了'] //按钮
                    	});
                    }
                }
            });
            
            //垫付或者远程单提示
            $(".payWay").click(function(){
                if($(this).attr("lang")==1)
                {
                    layer.confirm('此任务为<a href="javascript:;" style="color:red;">全程垫付</a>，等任务结束后垫付金额与佣金将到达您的帐户中。<a href="javascript:;" style="color:red;">[全程垫付详情介绍]</a>', {
                    	btn: ['知道了'] //按钮
                    });
                }
                 
                if($(this).attr("lang")==2)
                {
                    layer.confirm('此任务为<a href="javascript:;" style="color:red;">远程单</a>，等任务结束佣金将到达您的帐户。<a href="javascript:;" style="color:red;">[平台详情介绍]</a>', {
                    	btn: ['知道了'] //按钮
                    });
                }
            });
            
            //所属平台提示
            $(".platform").click(function(){
                if($(this).attr("lang")==1)
                {
                    layer.confirm('此任务为<a href="javascript:;" style="color:red;">淘宝任务</a>', {
                    	btn: ['知道了'] //按钮
                    });
                }
                 
                if($(this).attr("lang")==2)
                {
                    layer.confirm('此任务为<a href="javascript:;" style="color:red;">京东任务</a>', {
                    	btn: ['知道了'] //按钮
                    });
                }
                 
                if($(this).attr("lang")==3)
                {
                    layer.confirm('此任务为<a href="javascript:;" style="color:red;">阿里巴巴任务</a>', {
                    	btn: ['知道了'] //按钮
                    });
                }
            });
            
            //接手等级要求提示
            $(".BuyerJifen").click(function(){
                var dj;
                switch(parseInt($(this).attr("lang")))
                {
                    case 1:
                        dj="一心";
                        break;
                    case 2:
                        dj="二心";
                        break;
                    case 3:
                        dj="三心";
                        break;
                    case 4:
                        dj="四心";
                        break;
                    case 5:
                        dj="五心";
                        break;
                    case 6:
                        dj="一钻";
                        break;
                    case 7:
                        dj="二钻";
                        break;
                    case 8:
                        dj="三钻";
                        break;
                    case 9:
                        dj="四钻";
                        break;
                    default:
                        dj="五钻";
                        break;
                }
                layer.confirm('此任务对威客帐号等级要求为：<a href="javascript:;" style="color:red;">'+dj+'以上</a>', {
                	btn: ['知道了'] //按钮
                });
            });
        })
    </script>