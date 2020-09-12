<div class="myLink" style="width: 546px; border:2px dashed #99C1F5; margin:20px auto;">
    <div style="width: 536px; line-height:25px; color:red; margin:0 auto; padding: 10px 0; font-weight:bold;">
        您的推广链接为：<br />
        <?php
            echo 'http://'.$_SERVER['HTTP_HOST'].$this->createUrl('passport/regist',array('userid'=>Yii::app()->user->getId()))
        ?>
    </div>
</div>
<div class="bbg6">随手分享到社交网络，社交圈也能赚钱<br>
	<div class="bbg7">
		&nbsp;&nbsp;&nbsp;发送给好友或QQ空间，更容易邀请到好友哟~
	</div>
</div>
<style>
.bbg6{width:536px;height:100%; margin:0 auto; margin-top:10px;font-size:12px;color:#959595;text-align:left;}
.bbg7{background:#fff url(<?php echo VERSION2;?>img/bbg7.jpg) no-repeat left;width:277px;height:41px;color:#ff8a3f;font-size:12px;line-height:47px;}
</style>