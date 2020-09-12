    <?php
        echo $this->renderPartial('/user/taobaoTaskNav');//载入淘宝大厅导航
    ?>
    <div class="yjrw">
        <div class="yjrwCen">
            <?php
                echo $this->renderPartial('/user/taobaoOutTaskNav');//载入淘宝大厅导航
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
                    <form action="<?php echo $this->createUrl('user/taobaoOutTaskComplete');?>" method="post">
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
                        <a class="qcrw">等待接手</a>
                    <?php
                        }
                        if($item->status==1){
                    ?>
                        <a href="javascript:;" class="qcrw buyerPass" lang="<?php echo $item->taskerid;?>" alt="<?php echo $item->id;?>">审核通过</a><a href="javascript:;" class="qcrw buyerFail" lang="<?php echo $item->taskerid;?>" alt="<?php echo $item->id;?>">审核不通过</a>
                        <div class="clear"></div>
                        <span style="width: auto; position: relative; top:-30px; left:805px;" class="settime" lang="<?php echo $item->taskerid;?>" alt="<?php echo $item->id;?>" endTime="<?php echo date("Y-m-d H:i:s",$item->taskfristTime+720);?>"></span>
                    <?php
                        }
                        if($item->status==2){
                    ?>
                         <a href="javascript:;" class="qcrw waiterBuyerPayWarning" style="width: auto; padding:0 8px; cursor: pointer;" title="点击查看提醒">等待威客付款</a>
                         <div class="clear"></div>
                         <span style="width: auto; position: relative; top:-30px; left:805px;" class="settime" action="waiterBuyerPay" lang="<?php echo $item->taskerid;?>" alt="<?php echo $item->id;?>" endTime="<?php echo date("Y-m-d H:i:s",$item->tasksecondTime+1800);?>"></span>
                    <?php
                        }
                        if($item->status==3){
                    ?>
                        <a href="javascript:;" class="qcrw sellerCertainSendGood" lang="<?php echo $item->id;?>" style="width: auto; padding:0 8px; cursor: pointer;">威客已付款，等待您发货</a>
                        <div class="clear"></div>
                        <span style="width: auto; position: relative; top:-30px; left:805px;" class="settime" action="waiteSellerSendGood" lang="<?php echo $item->taskerid;?>" alt="<?php echo $item->id;?>" endTime="<?php echo date("Y-m-d H:i:s",$item->taskthirdTime+10800);?>"></span>
                    <?php
                        }
                        if($item->status==4){
                    ?>
                        <a href="javascript:;" class="qcrw" lang="<?php echo $item->id;?>" style="width: auto; padding:0 8px; cursor: pointer;">等待威客收货好评</a>
                    <?php
                        }
                        if($item->status==5 && $item->taskCompleteStatus==0){
                    ?>
                        <a href="javascript:;" class="qcrw sellerLastCertain" lang="<?php echo $item->id;?>" style="width: auto; padding:0 8px; cursor: pointer;">威客已收货好评，等待审核</a>
                    <?php
                        }
                        if($item->taskCompleteStatus==1){
                    ?>
                        <a href="javascript:;" class="qcrw" style="width: auto; padding:0 8px; cursor: pointer;">任务已完成</a>
                    <?php
                        }
                        if($item->status==6){
                    ?>
                         <a href="javascript:;" class="qcrw startTask" lang="<?php echo $item->taskerid;?>" alt="<?php echo $item->id;?>">取消暂停</a>
                    <?php
                        }
                    ?>
                </div>
                <div class="clear"></div>
                <?php
                    if($item->status<>0 && $item->status<>6){
                        $buyerinfo=Blindwangwang::model()->findByAttributes(array(
                            'wangwang'=>$item->taskerWangwang
                        ));
                        $usermsg=User::model()->findByPk($item->taskerid);
                ?>
                <div class="takerInfo"><!--taskFunMan start-->
                    <span>威客(接手方)：</span><?php echo $usermsg->Username;?>　<img src="<?php echo VERSION2?>img/wang.jpg" width="20" style="position: relative; top:5px;" />&nbsp;采用买号：<?php echo $item->taskerWangwang;?>&nbsp;<img src="<?php echo VERSION2;?>img/level/<?php echo $buyerinfo->wangwanginfo;?>.gif" style="position:relative; top:3px;"/>　　　　　联系对方：&nbsp;<a title="点击添加对方为好友" target=blank href=http://wpa.qq.com/msgrd?V=3&uin=<?php echo $usermsg->QQToken;?>&Site=点击添加好友&Menu=yes><img border="0" SRC=http://wpa.qq.com/pa?p=1:<?php echo $usermsg->QQToken;?>:4 alt="点击这里给我发消息" style="position: relative; top:2px; left:-3px" /></a>
                    <span style="color: red;"><?php
                        if($item->orderNumber)
                            echo "订单编号：".$item->orderNumber."<font style='color:#000'>(购买商品订单编号)</font>";
                    ?></span>
                </div><!--taskFunMan end-->
                <?php
                    }
                ?>
                <div class="taskFunMan"><!--taskFunMan start-->
                    <span style="cursor: pointer;" class="lookuptxtGoodsUrl" alt="<?php echo $item->txtGoodsUrl;?>">查看淘宝地址</span>
                    
                    <!--已发任务功能操作-->
                    <!--<font><a href="javascript:;" class="delTask">取消</a></font>-->
                    <?php
                        //状态为无人接手，刚可以暂停
                        if($item->status==0){
                    ?>
                    <font><a href="javascript:;" class="stopTask" lang="<?php echo $item->taskerid;?>" alt="<?php echo $item->id;?>">暂停</a></font>
                    <?php }?>
                    <?php
                        //任务没有完成的状态下，商家都可以进行追加豆豆
                        if($item->taskCompleteStatus==0){
                    ?>
                    <font><a href="javascript:;" class="addMinLi" lang="<?php echo $item->taskerid;?>" alt="<?php echo $item->id;?>">追加金币</a></font>
                    <?php }?>
                    <?php
                        //接手收货好评完成之前，商家都可以修改好评内容
                        if($item->status<4 && $item->cbxIsMsg==1){
                    ?>
                    <font><a href="javascript:;" class="changeTxtMessage" lang="<?php echo $item->txtMessage;?>" alt="<?php echo $item->id;?>">修改好评内容</a></font>
                    <?php }?>
                    <?php
                        if($item->status<2 && $item->cbxIsAddress==1){
                    ?>
                    <font><a href="javascript:;" class="changeCbxIsAddressContent" lang="<?php echo $item->cbxIsAddressContent;?>" alt="<?php echo $item->id;?>">修改收货地址</a></font>
                    <?php }?>
                </div><!--taskFunMan end-->
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
                    var actionName="";
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
                else//倒计时结束业务操作
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
            //商家查看淘宝地址
            $(".lookuptxtGoodsUrl").click(function(){
                layer.confirm('<span style="color:red;">任务地址：</span><br/>'+$(this).attr("alt")+'', {
            		btn: ['知道了'] //按钮
            	},function(){
            	   location.reload();//重新刷新当前页面
            	});
            });
            
            //商家审核接手信息通过
            $(".buyerPass").click(function(){
                var taskerid=$(this).attr("lang");
                var id=$(this).attr("alt");
                layer.confirm('您确定审核通过吗？', {
            		btn: ['确定'] //按钮
            	},function(){
            	   $.ajax({
            			type:"POST",
            			url:"<?php echo $this->createUrl('site/buyerPass');?>",
            			data:{"taskerid":taskerid,"id":id},
            			success:function(msg)
            			{
                            if(msg=="SUCCESS")
                            {
           			            layer.confirm('审核成功通过', {
                            		btn: ['知道了'] //按钮
                            	},function(){
                            	   location.reload();//重新刷新当前页面
                            	});
                            }
                            else
                            {
                                layer.confirm('审核通过失败，您可以联系客服人员', {
                            		btn: ['知道了'] //按钮
                            	},function(){
                            	   location.reload();//重新刷新当前页面
                            	});
                            }
            			}
            		});
            	});
            });
            
            //商家审核接手信息不通过
            $(".buyerFail").click(function(){
                var taskerid=$(this).attr("lang");
                var id=$(this).attr("alt");
                layer.confirm('您确定审核<span style="color:red;">不通过</span>吗？', {
            		btn: ['确定','取消'] //按钮
            	},function(){
            	   $.ajax({
            			type:"POST",
            			url:"<?php echo $this->createUrl('site/buyerFail');?>",
            			data:{"taskerid":taskerid,"id":id},
            			success:function(msg)
            			{
                            if(msg=="SUCCESS")
                            {
           			            layer.confirm('操作成功，任务已返回任务大厅', {
                            		btn: ['知道了'] //按钮
                            	},function(){
                            	   location.reload();//重新刷新当前页面
                            	});
                            }
                            else
                            {
                                layer.confirm('操作失败，您可以联系客服人员', {
                            		btn: ['知道了'] //按钮
                            	},function(){
                            	   location.reload();//重新刷新当前页面
                            	});
                            }
            			}
            		});
            	});
            });
            
            //商家暂停任务
            $(".stopTask").click(function(){
                var taskerid=$(this).attr("lang");
                var id=$(this).attr("alt");
                layer.confirm('您确定要暂停任务吗？', {
            		btn: ['确定暂停','不暂停'] //按钮
            	},function(){
            	   $.ajax({
            			type:"POST",
            			url:"<?php echo $this->createUrl('site/stopTask');?>",
            			data:{"taskerid":taskerid,"id":id},
            			success:function(msg)
            			{
                            if(msg=="SUCCESS")
                            {
           			            layer.confirm('任务已成功暂停', {
                            		btn: ['知道了'] //按钮
                            	},function(){
                            	   location.reload();//重新刷新当前页面
                            	});
                            }
                            else
                            {
                                layer.confirm('任务已被暂停或进行中无法执行操作', {
                            		btn: ['知道了'] //按钮
                            	},function(){
                            	   location.reload();//重新刷新当前页面
                            	});
                            }
            			}
            		});
            	});
            });
            
            //商家取消暂停任务
            $(".startTask").click(function(){
                var taskerid=$(this).attr("lang");
                var id=$(this).attr("alt");
                layer.confirm('您确定要开启任务吗？', {
            		btn: ['确定开启','不开启'] //按钮
            	},function(){
            	   $.ajax({
            			type:"POST",
            			url:"<?php echo $this->createUrl('site/startTask');?>",
            			data:{"taskerid":taskerid,"id":id},
            			success:function(msg)
            			{
                            if(msg=="SUCCESS")
                            {
           			            layer.confirm('任务已成功开始且返回任务大厅', {
                            		btn: ['知道了'] //按钮
                            	},function(){
                            	   location.reload();//重新刷新当前页面
                            	});
                            }
                            else
                            {
                                layer.confirm('任务开启失败，如有疑问可以联系我们的客服人员', {
                            		btn: ['知道了'] //按钮
                            	},function(){
                            	   location.reload();//重新刷新当前页面
                            	});
                            }
            			}
            		});
            	});
            });
            
            //商家取消任务即删除任务
            $(".delTask").click(function(){
                layer.confirm('取消任务功能稍后开放，您可以先使用<span style="color:red;">暂停</span>任务功能', {
            		btn: ['知道了'] //按钮
            	});
            });
            
            //商家追加金币
            $(".addMinLi").click(function(){
                var id=$(this).attr("alt");//任务id
                
                layer.confirm('<span style="color:red; line-height:25px;">您剩余金币'+$(".MinLinOwn").html()+'个</span><br/>'+'追加金币数：<input type="text" class="text1 addMinLiNum" style="width:50px; text-align:center; margin:0;" />&nbsp;个', {
            		btn: ['确定追加','取消'] //按钮
            	},function(){
            	   if($(".addMinLiNum").val()=="")//不能为空
                   {
                        layer.tips('<span>不能为空<span>', '.addMinLiNum');
                        exit;
                   }
                   if(isNaN(parseFloat($(".addMinLiNum").val())))//金币数量必须为数字
                   {
                        layer.tips('<span>必须为数字<span>', '.addMinLiNum');
                        exit;
                   }
                   if(parseFloat($(".addMinLiNum").val())<0)//金币数量必须大于0
                   {
                        layer.tips('<span>必须大于0<span>', '.addMinLiNum');
                        exit;
                   }
                   
                   if(parseFloat($(".addMinLiNum").val())>parseFloat($(".MinLinOwn").html()))//金币剩余数量不足
                   {
                        layer.tips('<span>金币数量不足，您剩余金币'+$(".MinLinOwn").html()+'个<span>', '.addMinLiNum');
                        exit;
                   }
                   
                   //检查通过开始追加金币
                   $.ajax({
            			type:"POST",
            			url:"<?php echo $this->createUrl('site/addMinLi');?>",
            			data:{"addMinLiNum":$(".addMinLiNum").val(),"id":id},
            			success:function(msg)
            			{
                            if(msg=="SUCCESS")
                            {
           			            layer.confirm('金币追加成功', {
                            		btn: ['知道了'] //按钮
                            	},function(){
                            	   location.reload();//重新刷新当前页面
                            	});
                            }else if(msg=="MINLINOTENOUGH")
                            {
                                layer.confirm('金币数量不足', {
                            		btn: ['知道了'] //按钮
                            	});
                            }
                            else
                            {
                                layer.confirm('金币追加失败，请联系我们的客服人员', {
                            		btn: ['知道了'] //按钮
                            	});
                            }
            			}
            		});
                    //检查通过开始追加金币
            	});
            });
            
            //商家修改好评内容
            $(".changeTxtMessage").click(function(){
                var id=$(this).attr("alt");//任务id
                
                layer.confirm('好评内容：<input type="text" class="text1 TxtMessageCon" style=" margin:0;" value='+$(this).attr("lang")+' />', {
            		btn: ['确定修改','取消'] //按钮
            	},function(){
                   
                   //检查通过开始追加金币
                   $.ajax({
            			type:"POST",
            			url:"<?php echo $this->createUrl('site/changeTxtMessage');?>",
            			data:{"txtMessage":$(".TxtMessageCon").val(),"id":id},
            			success:function(msg)
            			{
                            if(msg=="SUCCESS")
                            {
           			            layer.confirm('修改成功', {
                            		btn: ['知道了'] //按钮
                            	},function(){
                            	   location.reload();//重新刷新当前页面
                            	});
                            }else if(msg=="NOTALLOW")
                            {
                                layer.confirm('任务已在进行中无法修改', {
                            		btn: ['知道了'] //按钮
                            	});
                            }
                            else
                            {
                                layer.confirm('修改好评内容失败，请联系我们的客服人员', {
                            		btn: ['知道了'] //按钮
                            	});
                            }
            			}
            		});
                    //检查通过开始追加金币
            	});
            });
            
            //商家修改收货地址
            $(".changeCbxIsAddressContent").click(function(){
                var id=$(this).attr("alt");//任务id
                var addArr=$(this).attr("lang").split("|");//原来地址解析
                
                layer.confirm('姓名：<input type="text" class="text1 addName" style=" margin:0;" value='+addArr[0]+' /><br/><br/>手机：<input type="text" class="text1 addTel" style=" margin:0;" value='+addArr[1]+' /><br/><br/>邮编：<input type="text" class="text1 addCode" style=" margin:0;" value='+addArr[2]+' /><br/><br/>地址：<input type="text" class="text1 addAddress" style=" margin:0;" value='+addArr[3]+' />', {
            		btn: ['确定修改','取消'] //按钮
            	},function(){
                   
                   //检查通过开始追加金币
                   $.ajax({
            			type:"POST",
            			url:"<?php echo $this->createUrl('site/changeCbxIsAddressContent');?>",
            			data:{"addName":$(".addName").val(),"addTel":$(".addTel").val(),"addCode":$(".addCode").val(),"addAddress":$(".addAddress").val(),"id":id},
            			success:function(msg)
            			{
                            if(msg=="SUCCESS")
                            {
           			            layer.confirm('修改成功', {
                            		btn: ['知道了'] //按钮
                            	},function(){
                            	   location.reload();//重新刷新当前页面
                            	});
                            }else if(msg=="NOTALLOW")
                            {
                                layer.confirm('任务已经到接手付款阶段，系统不允许修改', {
                            		btn: ['知道了'] //按钮
                            	});
                            }
                            else
                            {
                                layer.confirm('修改失败，请联系我们的客服人员', {
                            		btn: ['知道了'] //按钮
                            	});
                            }
            			}
            		});
                    //检查通过开始追加金币
            	});
            });
            
            //等待接手付款提醒
            $(".waiterBuyerPayWarning").click(function(){
            	layer.confirm('倒计时结束，如果接手没有完成付款，任务将返回任务大厅，您可以通过<span style="color:red;">买家信息中的买家QQ添加好友或电话联系已接手您任务的买家</span>！', {
            		btn: ['知道了'] //按钮
            	});
            });
            
            //商家确认发货
            $(".sellerCertainSendGood").click(function(){
                var taskid=$(this).attr("lang");//任务id
                layer.confirm('您确认发货吗？', {
            		btn: ['确认','取消'] //按钮
            	},function(){
            	   $.ajax({
            			type:"POST",
            			url:"<?php echo $this->createUrl('site/sellerCertainSendGood');?>",
            			data:{"taskid":taskid},
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
            	});
            });
            
            //商家最后确认
            $(".sellerLastCertain").click(function(){
                var taskid=$(this).attr("lang");
                layer.confirm('<span style="font-size:12px;"><p style="font-size:14px; font-weight:bold; text-align:center; color:red;">请注意！您即将要确认付款给对方了</p>请确认您已经在淘宝收到接手的货款与好评，并且完成了您的任务，确定后，任务担保金和金币将到达对方平台帐户！<p style="color:red; font-weight:bold; font-size:14px; text-align:center;">如果对方未付款，请勿确认，请直接发布申诉。</p></span>', {
            		btn: ['确认','取消'] //按钮
            	},function(){
                    $.ajax({
                    type:"POST",
                    url:"<?php echo $this->createUrl('site/taskCompleteDone');?>",
                    data:{"taskid":taskid},
                    success:function(msg)
                    {
                        if(msg=="SUCCESS")
                        {
                            layer.confirm('审核成功，任务完成', {
                        		btn: ['知道了'] //按钮
                        	},function(){
                        	   location.reload();//重新刷新当前页面
                        	});
                        }
                        else
                        {
                            layer.confirm('审核失败，请联系我们的客服人员', {
                        		btn: ['知道了'] //按钮
                        	},function(){
                        	   location.reload();//重新刷新当前页面
                        	});
                        }
                    }
                    });
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