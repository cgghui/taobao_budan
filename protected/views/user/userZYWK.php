    <!--成为职业威客-->
  	<div class="d_do clearfix">
    	<div class="d_dotop clearfix">
        	<ul class="d_dotop_ul">
            	<li>
                    1、申请职业威客可以获得更高的金币回收价格、更多的同时接手任务次数、更多的买号绑定、申请时限为一个月，到期后将自动恢复到当前积分对应等级；
                    一旦申请成功，无法返回原始的会员等级，必须到期后才能取消，请申请前一定重视！
                </li>
                <li>
                	2、为了保障商家（发布方）的利益，杜绝新手在毫无接手任务经验的情况下就加入职业威客.<a>申请条件：经验值大于等于200点，并且无有效投诉记录。</a>
                </li>
            </ul>
            <div class="clear"></div>
            <div class="paihang clearfix">
            	<ul>
                	<li class="ph1">等级</li>
                    <li class="ph2">普通会员</li>
                    <li class="ph3">职业威客</li>
                </ul>
                <ul>
                	<li class="ph11">绑定买号数量</li>
                    <li class="ph22"><span>20</span></li>
                    <li class="ph33">280</li>
                </ul>
                <ul>
                	<li class="ph11">同时接任务数</li>
                    <li class="ph22"><span>20</span></li>
                    <li class="ph33">1000</li>
                </ul>
                <ul>
                	<li class="ph11">同时发任务数</li>
                    <li class="ph22"><span>20</span></li>
                    <li class="ph33">10</li>
                </ul>
                <ul>
                	<li class="ph11">每周接手任务500个以上</li>
                    <li class="ph22">无奖励</li>
                    <li class="ph33">前三名分别奖励：300元，200元，100元。4-10名奖励100金币 <a class="chakan" href="<?php echo $this->createUrl('user/userTop10');?>" target="_blank">查看排行榜</a></li>
                </ul>
            </div>
        </div>
        <a href="javascript:;" class="dianjishenqing">
            	点击申请
         </a>
    </div>
    <!--成为职业威客-->
<!--layer插件-->
<script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>
<script src="<?php echo ASSET_URL;?>layer/layer.js"></script>
<script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>
<link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" />
<script>
    $(function(){
        //点击申请成为职业威客
        $(".dianjishenqing").click(function(){
            layer.confirm('您目前不符合申请条件', {
        		btn: ['知道了'] //按钮
        	});
        });
    })
</script>