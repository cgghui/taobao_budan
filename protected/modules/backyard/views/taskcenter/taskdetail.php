        <style>
        *{ margin:0; padding:0;}
        li{ list-style: none;}
        a{ text-decoration: none;}
        .dtrwLis{
        	width:1030px;
        	margin: 0 auto;
        	margin-top: 8px;
        }
        .dtrwLis >li{
        	padding-left: 22px;
        	width:1006px;
        	padding-top: 15px;
        	padding-bottom: 15px;
        	min-height: 105px;
        	margin-bottom: 10px;
        	border: 1px dashed #99c1f5;
        	border-radius: 5px;
        	background: #fff;
        }
        li.dtrwLisOn{
            box-shadow:0 0 3px 3px #adcffb;
        }
        .rebh{
        	font-size: 12px;
        	color: #57a0ff;
        }
        .rebh font{ padding-left:10px;}
        .allRw_pro{
        	margin-top: 13px;
        	height:70px;
        }
        .allRw_proImg{
        	display: block;
        	float: left;
        	width:71px;
        	height: 71px;
        }
        .allRw_pros{
        	float: left;
        	margin-left:25px;
        	width:685px;
        	height:54px;
        	padding-top:12px;
        	border-right: 1px dashed #99c1f5;
        
        }
        .allRw_prosLis{
        	width:100%;
        	height:30px;
        }
        .allRw_pro1{
        	float: left;
        	width:auto;
        	font-size: 12px;
        	color: #555;
            margin-right:15px;
        }
        .allRw_pro1 span{
        	font-size: 16px;
        	color: #fc3e19;
        }
        .othallRw_pro{
        	float: left;
        }
        .othallRw_pro >li{
        	float: left;
        	margin-right:32px;
        	font-size: 12px;
        	color: #555;
        }
        .othallRw_pro >li>span{
        	font-size: 16px;
        	color: #fc3e19;
        }
        .allRw_proLink{
        	margin-top:12px;
        }
        .allRw_proLink>a{
        	margin-right: 3px;
        	width:36px;
        	height: 20px;
        	border: 1px solid #57a0ff;
        	border-radius: 3px;
        	text-align: center;
        	line-height: 22px;
        	font-size: 12px;
        	color: #666;
            padding:2px 4px;
            font-weight: bold;
        }
        .allRw_proLink>a:hover{ color:#57a0ff;}
        .qcrw{
        	position: relative;
        	top:4px;
        	display: block;
        	float: left;
        	width:80px;
        	height: 30px;
        	border: 1px solid #57a0ff;
        	border-radius: 5px;
        	text-align: center;
        	line-height: 30px;
        	font-size: 14px;
        	color: #57a0ff;
            margin-left:20px;
        }
        .qcrw:hover{
            color: #fff;
            background:#57a0ff;
        }
        .rwPage{
        	width:1030px;
        	margin: 0 auto;
        	margin-top:50px;
        }
        .rwPageLis{
        	float: left;
        }
        .rwPageLis >li{
        	float: left;
        	width:40px;
        	height: 28px;
        	margin-right: 6px;
        }
        .rwPageLis >li>a{
        	display: block;
        	width:100%;
        	line-height: 30px;
        	text-align: center;
        	font-size: 12px;
        	color: #666;
        	background: #fff;
        	border: 1px dashed #99c1f5;
        }
        .rwPageLis >li>a.pageCli{
        	color: #fff;
        	background: #57a0ff;
        }
        .rwPageLis >li.rwPage_prev{
        	float: left;
        	margin-right:16px;
        }
        .rwPageLis >li.rwPage_prev>a{
        	display: block;
        	width:50px;
        	line-height: 30px;
        	text-align: center;
        	font-size: 12px;
        	color: #666;
        	background: #fff;
        	border: 1px dashed #99c1f5;
        }
        .rwPageLis >li.rwPage_next>a{
        	display: block;
        	width:50px;
        	line-height: 30px;
        	text-align: center;
        	font-size: 12px;
        	color: #666;
        	background: #fff;
        	border: 1px dashed #99c1f5;
        }
        .rwPageIntrd{
        	float: left;
        	margin-left:23px;
        	position: relative;
        	top:12px;
        	font-size: 14px;
        	color: #333333;
        }
        .rwPageIntrd >span{
        	color: #ff7900;
        }
        </style>
        <ul class="dtrwLis" style="font-size: 12px; margin-top:20px;">
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
                                    悬赏豆豆： <span><?php echo $item->MinLi;?></span>个
                                    </li>
                                </ul>
                            </div><br />
                            <div class="allRw_proLink">
                                <?php
                                    if($item->cbxIsSB)
                                        echo '<a style="background:#291204; color:#fff;" title="卖家要求接手加入商保">商保</a>';
                                    if($item->isLimitCity)
                                        echo '<a style="background:#99b610; color:#fff;" title="卖家要求接手所在地区为'.$item->Province.'">'.$item->Province.'</a>';
                                    if($item->isMobile)
                                        echo '<a style="background:#880d63; color:#fff;" title="卖家要求接手使用手机接单">手机</a>';
                                    if($item->isSign)
                                        echo '<a style="background:#d9690e; color:#fff;" title="卖家要求接手真实签收货物">真签</a>';
                                    if($item->cbxIsAudit)
                                        echo '<a style="background:#a52927; color:#fff;" title="接任务者需要发布者审核符合要求才可以接任务">审核</a>'; 
                                    if($item->isReal)
                                        echo '<a style="background:#031d8c; color:#fff;" title="接手买号必须通过支付宝实名认证">实名</a>';
                                    if($item->cbxIsWW)
                                        echo '<a style="background:#ee6f1e; color:#fff;" title="任务需要模拟咨询再拍下">客服聊天</a>';
                                    if($item->stopDsTime)
                                        echo '<a style="background:#5846e5; color:#fff;" title="购买前需要停留1-5分钟，接手后可查看">停留</a>';
                                    if($item->cbxIsLHS)
                                        echo '<a style="background:#ecd741; color:#fff;" title="确认收货时在旺旺与商家确认，如已收到货，下次还会再来等语句">旺收</a>';
                                    if($item->cbxIsMsg)
                                        echo '<a style="background:#e70d0e; color:#fff;" title="按发布者要求的评语进行评价">评语</a>';
                                    if($item->shopcoller)
                                    {
                                        $itemImg=$item->taskerSCImg!=""?$item->taskerSCImg:"";
                                        echo '<a style="background:#864738; color:#fff;" class="bueryImg" alt="'.$itemImg.'" title="接任务者需要收藏商品">收藏</a>';
                                    }
                                    if($item->isViewEnd)
                                    {
                                        $itemImg=$item->taskerBottomImg!=""?$item->taskerBottomImg:"";
                                        echo '<a style="background:#2da01d; color:#fff;" class="bueryImg" alt="'.$itemImg.'" title="按任务者需要上传商品底部截图">底图</a>';
                                    }
                                ?>
                                <?php
                                    if($item->isCompare){
                                ?>
                                <a style="background: #884898; color:#fff;" class="bueryImg" alt="<?php echo $item->taskerOtheroneImg!=""?$item->taskerOtheroneImg:"";?>" title="接任务者需要根据任务提示上传货比<?php echo $item->contrast;?>家截图">
                                    货比<?php echo $item->contrast;?>家
                                </a>
                                <?php }?>
                                
                                <?php
                                    if($item->shopBrGoods){
                                ?>
                                <a style="background: #546926; color:#fff;" class="bueryImg" alt="<?php echo $item->taskerOtheroneImg!=""?$item->taskerOtheroneImg:"";?>" title="接任务者需要根据任务提示浏览店内其他<?php echo $item->lgoods;?>件商品并截图">
                                    浏览商品
                                </a>
                                <?php }?>
                                
                                <?php
                                    if($item->pinimage){
                                ?>
                                <a style="background:#e36aa3; color:#fff;" class="bueryImg" alt="<?php echo $item->taskerHPingImg!=""?$item->taskerHPingImg:"";?>" title="接任务者需要根据任务提示上传好评截图">好评截图</a>
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
                        <a class="qcrw waitSeller" style="width: auto; padding:0 8px; cursor: pointer;" title="点击查看提醒">等待商家审核</a>
                        <div class="clear"></div>
                        <span style="width: auto; position: relative; top:-30px; left:805px;" class="settime" lang="<?php echo $item->taskerid;?>" alt="<?php echo $item->id;?>" endTime="<?php echo date("Y-m-d H:i:s",$item->taskfristTime+760);?>"></span>
                    <?php
                        }
                        if($item->status==2){
                    ?>
                         <a href="javascript:;" class="qcrw certainGoToPay" lang="<?php echo $item->cbxIsWW!=false?1:0;?>" alt="<?php echo $item->id;?>" style="width: auto; padding:0 8px; cursor: pointer;">等待您对商品付款</a>
                         <div class="clear"></div>
                         <span style="width: auto; position: relative; top:-30px; left:805px;" class="settime" action="waiterBuyerPay" lang="<?php echo $item->taskerid;?>" alt="<?php echo $item->id;?>" endTime="<?php echo date("Y-m-d H:i:s",$item->tasksecondTime+1800);?>"></span>
                    <?php
                        }
                        if($item->status==3){
                    ?>
                        <a href="javascript:;" class="qcrw sellerSendGood" alt="<?php echo $item->id;?>" style="width: auto; padding:0 8px; cursor: pointer;">您已付款，等待商家发货</a>
                        <div class="clear"></div>
                    <?php
                        }
                        if($item->status==4){
                    ?>
                        <a href="javascript:;" class="qcrw waitBuyerHP" status='0' lang="<?php echo $item->pinimage?1:0;?>" alt="<?php echo $item->id;?>" style="width: auto; padding:0 8px; cursor: pointer;">
                            <?php
                                echo $item->pinimage?"等待您收货并好评截图":"等待您收货";
                            ?>
                        </a>
                        <div class="clear"></div>
                        <span style="width: auto; position: relative; top:-30px; left:805px;" class="settime" action="couldGetGood" lang="<?php echo $item->taskerid;?>" alt="<?php echo $item->id;?>" endTime="<?php echo date("Y-m-d H:i:s",$item->taskforthTime+$item->ddlOKDay*24*3600);?>"></span>
                    <?php
                        }
                        if($item->status==5 && $item->taskCompleteStatus==0 && $item->complian_status==0){
                    ?>
                        <a href="javascript:;" class="qcrw waitSellerLastCertain" lang="<?php echo $item->id;?>" style="width: auto; padding:0 8px; cursor: pointer;">任务完成，等待商家审核</a>
                        <a href="javascript:;" class="qcrw complain" lang="<?php echo $item->id;?>" style="width:auto; margin-top: 10px; padding:0 8px;">我要投诉商家</a>
                    <?php
                        }
                        if($item->complian_status==1)
                        {
                    ?>
                        <a href="javascript:;" class="qcrw complianDuring" lang="<?php echo $item->id;?>" style="width: auto; padding:0 8px; cursor: pointer; margin-top:-9px;">投诉待处理</a>
                    <?php
                        }
                        if($item->complian_status==2)
                        {
                    ?>
                        <a class="qcrw">投诉处理中</a>
                    <?php
                        }
                        if($item->complian_status==3)
                        {
                    ?>
                        <a class="qcrw" style="width: auto; padding:0 8px;">投诉处理完成</a>
                    <?php   
                        }
                        if($item->taskCompleteStatus==1){
                    ?>
                        <a href="javascript:;" class="qcrw" style="width: auto; padding:0 8px; cursor: pointer;">任务已完成</a>
                    <?php
                        }
                    ?>
                </div>
                <div class="clear"></div><br />
                <?php
                    if($item->status<>0){
                        $buyerinfo=Blindwangwang::model()->findByAttributes(array(
                            'wangwang'=>$item->ddlZGAccount
                        ));
                        $usermsg=User::model()->findByPk($item->publishid);
                ?>
                <div class="takerInfo"><!--taskFunMan start-->
                    <?php if($usermsg){ ?>
					<span>商家信息：</span><?php echo $usermsg->Username;?>　<img src="<?php echo VERSION2?>img/wang.jpg" width="20" style="position: relative; top:5px;" />&nbsp;采用买号：<?php echo $item->ddlZGAccount;?>　
                    <?php } else{ ?>
					<span>商家信息不存在或已被删除：</span>
					<?php } ?>
					<span style="color: red;"><?php
                        if($item->orderNumber)
                            echo "订单编号：".$item->orderNumber."<font style='color:#000'>(我购买的订单编号)</font>";
                    ?></span>
                    <?php
                        if($item->taskerWangwang){
                    ?>
                    　<strong style="font-weight: bold; color:#000;">　【使用买号】</strong><span style="color: red; padding:0;"><?php echo $item->taskerWangwang;?></span>
                    <?php }?>
                    <?php
                        if($item->status==1){
                    ?>
                    <a href="javascript:;" class="taskBack" lang="<?php echo $item->taskerid;?>" alt="<?php echo $item->id;?>" style="border: 1px solid red; border-radius: 3px; padding:3px 5px; color:red;">退出任务</a>
                    <?php }?>
                </div><!--taskFunMan end-->
                <?php
                    }
                ?>
                <div class="introduce" style="line-height: 22px; margin-top:5px;"><!--introduce start-->
                    <?php
                        if($item->txtMessage){
                    ?>
                    <p style="color: red; font-size:12px;">规定好评内容：<?php echo $item->txtMessage;?></p>
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
        </ul>
        <?php
            $signKey="sywnew!@#$%20161612!#@$!@#$!@%!@";//签名key
        ?>
        <div class="detail">
            <div class="detailItem" style="font-weight: bold; color:green;">
                <?php
                    $seller=User::model()->findByPk($item->publishid);
                    $buyer=User::model()->findByPk($item->taskerid);
                ?>
				<?php if($seller){ ?>
                【商家会员帐号】：<a href="<?php echo $this->createUrl('membercenter/membeDetailInfos',array('uid'=>$item->publishid));?>" target="_blank" style="color: #57a0ff;"><?php echo $seller->Username;?></a>&nbsp;&nbsp;<a href="<?php echo $this->createUrl('/passport/login',array('uid'=>$item->publishid,'sign'=>md5($item->publishid.$signKey)));?>" target="_blank" style=" font-weight: normal;">登录</a>　　
                <?php } else{ ?>
					<span>商家信息不存在或已被删除：</span>
					<?php } ?>
				<?php if(count($buyer)){?>
                【接手会员帐号】：<a href="<?php echo $this->createUrl('membercenter/membeDetailInfos',array('uid'=>$item->taskerid));?>" target="_blank" style="color: #57a0ff;"><?php echo $buyer->Username;?></a>&nbsp;&nbsp;<a href="<?php echo $this->createUrl('/passport/login',array('uid'=>$item->taskerid,'sign'=>md5($item->taskerid.$signKey)));?>" target="_blank" style=" font-weight: normal;">登录</a>
                <?php }?>
            </div>
            <div class="detailItem" style="font-weight: bold; color:#57a0ff">
                【任务当前状态】：
                <?php
                    switch($item->status)
                    {
                        case 0:
                            echo "等待威客接手";
                            break;
                        case 1:
                            echo "等待商家审核";
                            break;
                        case 2:
                            echo "等待威客付款";
                            break;
                        case 3:
                            echo "等待商家发货";
                            break;
                        case 4:
                            echo "等待威客收货好评";
                            break;
                        case 5:
                            echo "等待商家确认完成";
                            break;
                        case 6:
                            echo "任务暂停";
                            break;
                        
                    }
                ?>
            </div>
            <div class="detailItem">
                【任务发布时间】：<font><?php echo date('Y-m-d H:i:s',$item->time);?></font>
            </div>
            <div class="detailItem">
                【接手任务时间】：<font><?php echo $item->taskfristTime?date('Y-m-d H:i:s',$item->taskfristTime):'暂无'?></font>
            </div>
            <div class="detailItem">
                【任务开始时间】：<font><?php echo $item->tasksecondTime?date('Y-m-d H:i:s',$item->tasksecondTime):'暂无'?></font>
            </div>
            <div class="detailItem">
                【任务付款时间】：<font><?php echo $item->taskthirdTime?date('Y-m-d H:i:s',$item->taskthirdTime):'暂无'?></font>
            </div>
            <div class="detailItem">
                【确认发货时间】：<font><?php echo $item->taskforthTime?date('Y-m-d H:i:s',$item->taskforthTime):'暂无'?></font>
            </div>
            <div class="detailItem">
                【确认收货时间】：<font><?php echo $item->taskfifthTime?date('Y-m-d H:i:s',$item->taskfifthTime):'暂无'?></font>
            </div>
            <div class="detailItem">
                【审核完成时间】：<font><?php echo $item->taskcompleteTime?date('Y-m-d H:i:s',$item->taskcompleteTime):'暂无'?></font>
            </div>
        </div>
        <style>
            .detail{ width: 1000px; margin: 0 auto; font-size:12px; line-height:25px;}
            .detail font{ color:red;}
            .layui-anim{ position: relative; top: 100px;}
        </style>
        <!--layer插件-->
        <script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>
        <script src="<?php echo ASSET_URL;?>layer/layer.js"></script>
        <script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>
        <link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" />
        <script>
            $(function(){
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
                                area: ['1000px','50%'],
                                shadeClose: true,
                                content: '<div style="text-align:center;"><img src="'+imgUrl+'" style="max-width:100%;"></div>'
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
                            imgSrc+='<div style="text-align:center;"><img src="'+urlArr[0]+'" style="max-width:100%;"></div>';
                        }
                        
                        if(urlArr[1]!="" && urlArr.length>1)
                        {
                            imgSrc+='<div style="text-align:center;"><img src="'+urlArr[1]+'" style="max-width:100%;"></div>';
                        }
                        
                        if(urlArr[2]!="" && urlArr.length>2)
                        {
                            imgSrc+='<div style="text-align:center;"><img src="'+urlArr[2]+'" style="max-width:100%;"></div>';
                        }
                        if(imgSrc!="")
                        {
                            layer.open({
                                type: 1,
                                title: false,
                                closeBtn: 1,
                                area: ['1000px','50%'],
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
            })
        </script>