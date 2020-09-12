    <style>
    .arcList{ width:1000px; min-height: 500px; margin:0 auto;}
    .arcTitleInfo{ height:60px; line-height:60px; text-align: center; font-size:20px; font-weight:bold; }
    .arcDetailInfo{ font-size:14px;}
    </style>
    <div class="arcList"><!--arcList start-->
        <div class="arcDetail" style="padding-bottom: 20px;"><!--arcDetail start-->
        	<div class="arcTitleInfo"><?php echo $articleInfo['goods_name'];?></div>
            <div class="arcDetailInfo"><!--arcDetailInfo start-->
            	<?php echo $articleInfo['goods_desc'];?>
                <!-- JiaThis Button BEGIN -->
                <div class="jiathis_style" style="margin-top: 15px;">
                	<span class="jiathis_txt">分享到：</span>
                	<a class="jiathis_button_qzone">QQ空间</a>
                	<a class="jiathis_button_tsina">新浪微博</a>
                	<a class="jiathis_button_tqq">腾讯微博</a>
                	<a class="jiathis_button_weixin">微信</a>
                	<a class="jiathis_counter_style"></a>
                </div>
                <script type="text/javascript" src="http://v3.jiathis.com/code/jia.js" charset="utf-8"></script>
                <!-- JiaThis Button END -->
            </div><!--arcDetailInfo end-->
            <div class="clear"></div>
        </div><!--arcDetail end-->
    </div><!--arcList start-->