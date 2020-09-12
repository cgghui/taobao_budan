<html>
<style>
    *{ margin:0; padding:0; font-size:12px; font-family:"微软雅黑"}
    a{ text-decoration: none;}
    li{ list-style:none;}
    .payContent{ width:auto; position: relative;}
    .PaystepArea{ width:500px; min-height:480px; margin: 0 auto; line-height: 25px; margin-top:10px; position:relative;}
    .HB{ display: block;}
    .lastStep{ display: none;}
    #image3,#url3,#image4,#url4,#url55,#image55{ border-radius: 3px; cursor: pointer; cursor: pointer;}
    #url3,#url4,#url55,#url5,#url6,#url7,#url8{ width:200px;}
    .hbitem{ width: 100%; height: auto; border:1px dashed #57a0ff; padding: 10px 0;}
    .hbitemTip{ color: red; font-weight: bold;}
    .hbitem li{ width:95%; line-height:25px; margin:0 auto;}
    .hbitem font{ color:#57a0ff; font-weight:bold;}
    .hbitem span{ color:#ff5940;}
    .importantWarning{ line-height: 40px; font-weight:bold; color:red; text-align: center;}
    .firstStep{
        width:480px;
        margin:0 auto;
        height: 35px;
    	text-align: center;
    	line-height: 35px;
        border:none;
    	color: #fff;
    	background: #fc772d;
    	border-radius: 5px;
        cursor: pointer;
        font-size:14px;
        font-weight:bold;
        position: relative;
        left:13px;  
     }
     .cetainStepComplete{
        width:480px;
        margin:0 auto;
        height: 35px;
    	text-align: center;
    	line-height: 35px;
        border:none;
    	color: #fff;
    	background: #fc772d;
    	border-radius: 5px;
        cursor: pointer;
        font-size:14px;
        font-weight:bold;
        position: relative;
        left:13px;         
     }
     #image3,#image4,#image5,#image6,#image7,#image8,.imagewarning{ cursor: pointer; border-radius: 4px;}
</style>
<body>
<!--接手付款步骤区域iframe-->
    <?php
        if($taskInfo->isCompare && $taskInfo->taskCatalog){//如果要求货比，同时为来路搜索任务
    ?>
    <div class="PaystepArea HB"><!--PaystepArea start-->
        <p>该任务属于商品来路任务，且需要接手方<a style="color: red;">货比<?php echo $taskInfo->contrast;?>家</a>后才能验证商品来路　<a style="color: red;">帮助教程</a></p>
        <?php
            if($taskInfo->contrast>0){//货比1家
        ?>
		<div class="hbitemTip">验证商品：</div>
		<div class="hbitem">
          <li><font>验证商品</font>：复制商品页面地址栏的地址，并粘贴到下面，然后点击【验证商品】按钮；<br />
            <input type="text" id="txtGoodsUrl" name="txtGoodsUrl" checkRes="0" class="pc11 inputp s36_ts" placeholder="商品链接地址" style=" width:300px; text-indent: 10px; height:30px; line-height:30px;" />
            <span id="checkTxtGoodsUrl" style="font-weight: normal; padding:7px 8px; border:none; background:#3498db; color:#fff; text-indent: 10px; width:auto; height:30px; font-size:12px; cursor: pointer;" lang="<?php echo $taskInfo->id;?>">验证商品</span>
            <span id="imagewarning" style="color: green; padding-left:10px;"><font style="color:red;">必须验证</font></span>
          </li>
        </div>
        <!--货比第1家-->
        <div class="hbitemTip">货比1家商品：</div>
        <div class="hbitem">
          <li><font>第一步</font>：请在淘宝首页搜索：<span><?php echo $taskInfo->divKey;?></span></li>
          <li><font>第二步</font>：根据搜索结果列表，打开其中一个商品</li>
          <li><font>第三步</font>：
            <input type="text" id="url3" value="" name="goodsImgPosition" class="pc11 inputp s36_ts" readonly="readonly" placeholder="上传商品位置截图" style="background: #F0F0F0; height:30px; line-height:30px;">
            <input type="button" id="image3" value="上传货比商品截图" style="font-weight: normal; padding:0 8px; border:none; background:#3498db; color:#fff; width:auto; height:30px; font-size:12px;">
            <span id="imagewarning3" style="color: green; padding-left:10px;"><font style="color:red;">*必须上传</font></span>
          </li>
          <li><font>提示：</font><span>请不要上传重复的商品地址截图和掌柜名名为<font style="color:green;"><?php echo XUtils::cutstr($taskInfo->ddlZGAccount,4).'***';?></font>的商品</span></li>
        </div>
        <?php 
            } 
            if($taskInfo->contrast>1){//货比2家
        ?>
        <!--货比第2家-->
        <div class="hbitemTip">货比2家商品：</div>
        <div class="hbitem">
          <li><font>第一步</font>：请在淘宝首页搜索：<span><?php echo $taskInfo->divKey;?></span></li>
          <li><font>第二步</font>：根据搜索结果列表，打开其中一个商品</li>
          <li><font>第三步</font>：
            <input type="text" id="url4" value="" name="goodsImgPosition" class="pc11 inputp s36_ts" readonly="readonly" placeholder="上传商品位置截图" style="background: #F0F0F0; height:30px; line-height:30px;">
            <input type="button" id="image4" value="上传货比商品截图" style="font-weight: normal; padding:0 8px; border:none; background:#3498db; color:#fff; width:auto; height:30px; font-size:12px;">
            <span id="imagewarning4" style="color: green; padding-left:10px;"><font style="color:red;">*必须上传</font></span>
          </li>
          <li><font>提示：</font><span>请不要上传重复的商品地址截图和掌柜名名为<font style="color:green;"><?php echo XUtils::cutstr($taskInfo->ddlZGAccount,4).'***';?></font>的商品</span></li>
        </div>
        <?php 
            } 
            if($taskInfo->contrast>2){//货比3家
        ?>
        <!--货比第3家-->
        <div class="hbitemTip">货比3家商品：</div>
        <div class="hbitem">
          <li><font>第一步</font>：请在淘宝首页搜索：<span><?php echo $taskInfo->divKey;?></span></li>
          <li><font>第二步</font>：根据搜索结果列表，打开其中一个商品</li>
          <li><font>第三步</font>：
            <input type="text" id="url55" value="" name="goodsImgPosition" class="pc11 inputp s36_ts" readonly="readonly" placeholder="上传商品位置截图" style="background: #F0F0F0; height:30px; line-height:30px;">
            <input type="button" id="image55" value="上传货比商品截图" style="font-weight: normal; padding:0 8px; border:none; background:#3498db; color:#fff; width:auto; height:30px; font-size:12px;">
            <span id="imagewarning55" style="color: green; padding-left:10px;"><font style="color:red;">*必须上传</font></span>
          </li>
          <li><font>提示：</font><span>请不要上传重复的商品地址截图和掌柜名名为<font style="color:green;"><?php echo XUtils::cutstr($taskInfo->ddlZGAccount,4).'***';?></font>的商品</span></li>
        </div>
        <div class="importantWarning">请注意：请接手一定在通过验证商品后再淘宝拍下支付，否则将无法继续任务</div>
        <?php }?>
        <button class="firstStep">确定并进入下一步</button>
    </div><!--PaystepArea end-->
    <?php
        }
    ?>
    <?php
        if($taskInfo->isCompare==false){//如果没有货比要求，则显示最后一步
    ?>
    <style>
        .lastStep{ display: block;}
    </style>
    <?php }?>
    <div class="PaystepArea lastStep"><!--PaystepArea start-->
        <p>完成第一步、第二步商家要求完成任务并提交(这是最终购买商品，请拍下)</p>
        <div class="hbitem">
          <li><font>第一步</font>：请在淘宝首页搜索：<span><?php echo $taskInfo->divKey;?></span></li>
          <li><font>第二步</font>：根据搜索提示打开列表中掌柜名为<font><?php echo XUtils::cutstr($taskInfo->ddlZGAccount,4).'***';?></font>的商品</li>
		  <?php
             if(!$taskInfo->isCompare || !$taskInfo->taskCatalog){//如果要求货比，同时为来路搜索任务
          ?>
          <input type="hidden" id="txtGoodsUrlbak" name="txtGoodsUrlbak" checkRes="1" class="pc11 inputp s36_ts" placeholder="商品链接地址" style=" width:300px; text-indent: 10px; height:30px; line-height:30px;" />
          <li><font>第三步</font>：复制商品页面地址栏的地址，并粘贴到下面，然后点击【验证商品】按钮；<br />
            <input type="text" id="txtGoodsUrl" name="txtGoodsUrl" checkRes="0" class="pc11 inputp s36_ts" placeholder="商品链接地址" style=" width:300px; text-indent: 10px; height:30px; line-height:30px;" />
            <span id="checkTxtGoodsUrl" style="font-weight: normal; padding:7px 8px; border:none; background:#3498db; color:#fff; text-indent: 10px; width:auto; height:30px; font-size:12px; cursor: pointer;" lang="<?php echo $taskInfo->id;?>">验证商品</span>
            <span id="imagewarning" style="color: green; padding-left:10px;"><font style="color:red;">必须验证</font></span>
          </li>
			 <?php } ?>
          <li><font style="color:green; font-weight:bold;">搜索提示1：<?php echo $taskInfo->txtSearchDes;?></font></li>
          <li><font style="color:green; font-weight:bold;">搜索提示2：<a href="javascript:;" class="goodPositionImgTip" lang="<?php echo $taskInfo->goodsImgPosition;?>">点击查看图片</a></font></li>
          <?php
            if($taskInfo->isViewEnd){//如果要求浏览到底截图
          ?>
          <li><font>浏览到底</font>：<span>此任务需要上传商品底部截图</span></li>
          <li><font>底部截图</font>：
            <input type="text" id="url5" name="goodsImgPosition" class="pc11 inputp s36_ts" readonly="readonly" placeholder="商品底部截图" style="background: #F0F0F0; height:30px; line-height:30px;">
            <input type="button" id="image5" value="上传商品底部截图" style="font-weight: normal; padding:0 8px; border:none; background:#3498db; color:#fff; width:auto; height:30px; font-size:12px;">
            <span id="imagewarning5" style="color: green; padding-left:10px;"><font style="color:red;">*必须上传</font></span>
          </li>
          <?php }?>
          <?php
            if($taskInfo->shopcoller){//如果要求商品收藏截图
          ?>
          <li><font>收藏商品</font>：<span>此任务需要上传商品收藏截图</span></li>
          <li><font>收藏截图</font>：
            <input type="text" id="url6" name="goodsImgPosition" class="pc11 inputp s36_ts" readonly="readonly" placeholder="商品收藏截图" style="background: #F0F0F0; height:30px; line-height:30px;">
            <input type="button" id="image6" value="上传商品收藏截图" style="font-weight: normal; padding:0 8px; border:none; background:#3498db; color:#fff; width:auto; height:30px; font-size:12px;">
            <span id="imagewarning6" style="color: green; padding-left:10px;"><font style="color:red;">*必须上传</font></span>
          </li>
          <?php }?>
          <?php
            if($taskInfo->shopBrGoods){//要求浏览店里其他商品要求
          ?>
                <?php
                    if($taskInfo->lgoods>0){
                ?>
                <li><font>商品浏览</font>：<span>此任务需要额外浏览店内其他<?php echo $taskInfo->lgoods;?>件商品，浏览后进行截图</span></li>
                <li><font>商品截图</font>：
                <input type="text" id="url7" name="goodsImgPosition" class="pc11 inputp s36_ts" readonly="readonly" placeholder="上传浏览店内其他商品1截图" style="background: #F0F0F0; color:red; font-weight:bold; height:30px; line-height:30px;">
                <input type="button" id="image7" value="上传浏览商品1截图" style="font-weight: normal; padding:0 8px; border:none; background:#3498db; color:#fff; width:auto; height:30px; font-size:12px;">
                <span id="imagewarning7" style="color: green; padding-left:10px;"><font style="color:red;">*必须上传</font></span>
                </li><br />
                <?php }?>
                <?php
                    if($taskInfo->lgoods>1){
                ?>
                <li><font>商品截图</font>：
                <input type="text" id="url8" name="goodsImgPosition" class="pc11 inputp s36_ts" readonly="readonly" placeholder="上传浏览店内其他商品2截图" style="background: #F0F0F0; color:red; font-weight:bold; height:30px; line-height:30px;">
                <input type="button" id="image8" value="上传浏览商品2截图" style="font-weight: normal; padding:0 8px; border:none; background:#3498db; color:#fff; width:auto; height:30px; font-size:12px;">
                <span id="imagewarning8" style="color: green; padding-left:10px;"><font style="color:red;">*必须上传</font></span>
                </li><br />
                <?php }?>
          <?php }?>
          <li style="margin-top: 10px;"><font>订单编号</font>：
            <input type="text" id="orderNumber" name="orderNumber" class="pc11 inputp s36_ts" placeholder="商品订单编号" style=" width:300px; text-indent: 10px; height:30px; line-height:30px;" />
          </li>
          <div class="importantWarning">请注意：请接手一定在通过验证商品后再淘宝拍下支付，否则将无法继续任务</div>
          <button class="cetainStepComplete" lang="<?php echo $taskInfo->id;?>">确定完成任务</button>
        </div>
    </div>
<!--上传商品图片截图-->
<script src="<?php echo VERSION2;?>js/jquery.js"></script>
<link rel="stylesheet" href="<?php echo ASSET_URL;?>kindeditor/themes/default/default.css" />
<script src="<?php echo ASSET_URL;?>kindeditor/kindeditor.js"></script>
<script src="<?php echo ASSET_URL;?>kindeditor/lang/zh_CN.js"></script>
<!--layer插件-->
<script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>
<script src="<?php echo ASSET_URL;?>layer/layer.js"></script>
<script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>
<link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" />
<script>
	KindEditor.ready(function(K) {
		var editor = K.editor({
			allowFileManager : true
		});
		K('#image3,#url3').click(function() {
			editor.loadPlugin('image', function() {
				editor.plugin.imageDialog({
					showRemote : false,
					imageUrl : K('#url3').val(),
					clickFn : function(url, title, width, height, border, align) {
					    K('#imagewarning3').html('上传成功');
						K('#url3').val(url);
						editor.hideDialog();
					}
				});
			});
		});
        
        K('#image4,#url4').click(function() {
			editor.loadPlugin('image', function() {
				editor.plugin.imageDialog({
					showRemote : false,
					imageUrl : K('#url4').val(),
					clickFn : function(url, title, width, height, border, align) {
					    K('#imagewarning4').html('上传成功');
						K('#url4').val(url);
						editor.hideDialog();
					}
				});
			});
		});
        
        K('#image55,#url55').click(function() {
			editor.loadPlugin('image', function() {
				editor.plugin.imageDialog({
					showRemote : false,
					imageUrl : K('#url55').val(),
					clickFn : function(url, title, width, height, border, align) {
					    K('#imagewarning55').html('上传成功');
						K('#url55').val(url);
						editor.hideDialog();
					}
				});
			});
		});
        
        K('#image5,#url5').click(function() {
			editor.loadPlugin('image', function() {
				editor.plugin.imageDialog({
					showRemote : false,
					imageUrl : K('#url5').val(),
					clickFn : function(url, title, width, height, border, align) {
					    K('#imagewarning5').html('上传成功');
						K('#url5').val(url);
						editor.hideDialog();
					}
				});
			});
		});
        
        
        K('#image6,#url6').click(function() {
			editor.loadPlugin('image', function() {
				editor.plugin.imageDialog({
					showRemote : false,
					imageUrl : K('#url6').val(),
					clickFn : function(url, title, width, height, border, align) {
					    K('#imagewarning6').html('上传成功');
						K('#url6').val(url);
						editor.hideDialog();
					}
				});
			});
		});
        
        K('#image7,#url7').click(function() {
			editor.loadPlugin('image', function() {
				editor.plugin.imageDialog({
					showRemote : false,
					imageUrl : K('#url7').val(),
					clickFn : function(url, title, width, height, border, align) {
					    K('#imagewarning7').html('上传成功');
						K('#url7').val(url);
						editor.hideDialog();
					}
				});
			});
		});
        
        K('#image8,#url8').click(function() {
			editor.loadPlugin('image', function() {
				editor.plugin.imageDialog({
					showRemote : false,
					imageUrl : K('#url8').val(),
					clickFn : function(url, title, width, height, border, align) {
					    K('#imagewarning8').html('上传成功');
						K('#url8').val(url);
						editor.hideDialog();
					}
				});
			});
		});
	});
    
    $(function(){
		var txtGoodsUrlIsRight=0;
        //上传完货比截图进入下一步
        <?php
            if($taskInfo->isCompare){
        ?>
            $(".firstStep").click(function(){
				if(txtGoodsUrlIsRight!=1){
				    alert("商品尚未验证成功");
				    $("#txtGoodsUrl").focus();
				    return false;
			    }
                <?php
                     if($taskInfo->isCompare && $taskInfo->contrast>0)//货比1家判断
                     {
                ?>
                if($("#url3").val()=="")
                {
                    alert('请上传第1家货比截图');
                    exit;
                }
                <?php }?>
                <?php
                     if($taskInfo->isCompare && $taskInfo->contrast>1)//货比2家判断
                     {
                ?>
                else if($("#url4").val()=="")
                {
                    alert('请上传第2家货比截图');
                    exit;
                }
                <?php }?>
                <?php
                     if($taskInfo->isCompare && $taskInfo->contrast>2)//货比3家判断
                     {
                ?>
                else if($("#url55").val()=="")
                {
                    alert('请上传第3家货比截图');
                    exit;
                }
                <?php }?>
                else
                {
                    $(".HB").hide();//第一步隐藏
                    $(".lastStep").show();//第一步显示
                }
            });
        <?php }?>
        //通过链接地址验证商品
        $("#checkTxtGoodsUrl").click(function(){
            if($("#txtGoodsUrl").val()=="")
            {
                alert("商品地址不能为空，否则无法验证");
                $("#txtGoodsUrl").focus();
            }
            else//通过接手填写的商品地址验证商品是否正确
            {
                $.ajax({
        			type:"POST",
        			url:"<?php echo $this->createUrl('site/buyerToPay');?>",
        			data:{"txtGoodsUrl":$("#txtGoodsUrl").val(),"id":$(this).attr("lang")},
        			success:function(msg)
        			{
        				if(msg=="SUCCESS")
                        {
							txtGoodsUrlIsRight=1;
                            $("#imagewarning font").html("<font style='color:green;'>商品验证成功</font>");//验证成功提示
                            $("#txtGoodsUrl").attr("checkRes","1").css("background","#ccc");//验证成功后将文本域设置为只读
                        }else{
                            $("#imagewarning font").html("商品验证失败");//验证失败提示
                            $("#txtGoodsUrl").val("");//验证失败，将文本清空
                        }
        			}
        		});
            }
        });
        
        //点击查看商品位置图片提示
        $(".goodPositionImgTip").click(function(){
            layer.open({
                type: 1,
                title: '<span style="color:green; font-weight:bold; font-size:14px;">商品位置提示</span>',
                skin: 'layui-layer-rim', //加上边框
                area: ['480px', '460px'], //宽高
                content: '<img src="'+$(this).attr("lang")+'">'
            });
        })
        
        //最后一步确认提交
        $(".cetainStepComplete").click(function(){
			if(txtGoodsUrlIsRight!=1){
				alert("商品尚未验证成功");
				$("#txtGoodsUrl").focus();
				return false;
			}
            <?php
                  if($taskInfo->isCompare && $taskInfo->contrast==3)//货比1家判断
                  {
            ?>
                    var url3=$("#url3").val();//货比3家1截图
                    var url4=$("#url4").val();//货比3家2截图
                    var url55=$("#url55").val();//货比3家3截图
            <?php } ?>
            <?php
                  if($taskInfo->isCompare && $taskInfo->contrast==2)//货比1家判断
                  {
            ?>
                    var url3=$("#url3").val();//货比3家1截图
                    var url4=$("#url4").val();//货比3家2截图
                    var url55="";//货比3家3截图
            <?php } ?>
            <?php
                  if($taskInfo->isCompare && $taskInfo->contrast==1)//货比1家判断
                  {
            ?>
                    var url3=$("#url3").val();//货比3家1截图
                    var url4="";//货比3家2截图
                    var url55="";//货比3家3截图
            <?php } ?>
            <?php
                if($taskInfo->isCompare==false){
            ?>
                    var url3="";//货比3家1截图
                    var url4="";//货比3家2截图
                    var url55="";//货比3家3截图
            <?php } ?>
            <?php
                if($taskInfo->isViewEnd){//如果要求浏览到底截图
            ?>
                    var url5=$("#url5").val();//浏览底部截图
                    if(url5==""){
                        alert("浏览到商品底部截图不能为空");
                        exit;
                    }
            <?php }?>
            <?php
                if($taskInfo->isViewEnd==false){//如果不要求浏览到底截图
            ?>
            var url5="";//浏览底部截图
            <?php }?>
            <?php
                if($taskInfo->shopcoller){//如果要求商品收藏截图
            ?>
                    var url6=$("#url6").val();//收藏截图
                    if(url6==""){
                        alert("收藏截图不能为空");
                        exit;
                    }
            <?php }?>
            <?php
                if($taskInfo->shopcoller==false){//如果不要求商品收藏截图
            ?>
            var url6="";//收藏截图
            <?php }?>
            <?php
                if($taskInfo->shopBrGoods){//如果要求浏览店内其他商品
            ?>
                var url7=$("#url7").val();//店内其他商品1截图
                if(url7==""){
                    alert("浏览店内其他商品1截图不能为空");
                    exit;
                }
                    <?php
                        if($taskInfo->lgoods>1){
                    ?>
                        var url8=$("#url8").val();//店内其他商品2截图
                        if(url8==""){
                            alert("浏览店内其他商品2截图不能为空");
                            exit;
                        }
                    <?php
                        }else{
                    ?>
                        var url8="";
                    <?php }?>
            <?php
                }else//不要求浏览店内其他商品
                {
            ?>
                    var url7="";
                    var url8="";
            <?php }?>
            var orderNumber=$("#orderNumber").val();//订单编号
            if($("#orderNumber").val()==""){
                alert("订单编号不能为空");
                exit;
            }
            //检测全部通过
            $.ajax({
    			type:"POST",
    			url:"<?php echo $this->createUrl('site/buyerToPayCertain');?>",
    			data:{"url3":url3,"url4":url4,"url55":url55,"url5":url5,"url6":url6,"url7":url7,"url8":url8,"taskid":$(this).attr("lang"),"orderNumber":orderNumber,'txtGoodsUrlIsRight':txtGoodsUrlIsRight},
    			success:function(data)
    			{
    				if(data=="SUCCESS")
                    {
                        layer.confirm('恭喜您付款成功', {
                    		btn: ['确定'] //按钮
                    	}, function(){
                    	    window.parent.location.reload();//刷新父级页面
                    	    var index = parent.layer.getFrameIndex(window.name);//获取窗口索引
                    	    parent.layer.close(index);//关闭父级
                    	});
                    }else
                    {
                        layer.confirm('付款失败，请联系客服人员', {
                    		btn: ['确定'] //按钮
                    	}, function(){
                    	    window.parent.location.reload();//刷新父级页面
                    	    var index = parent.layer.getFrameIndex(window.name);//获取窗口索引
                    	    parent.layer.close(index);//关闭父级
                    	}); 
                    }
    			}
    		});
            //检测全部通过
        });
    })
</script>
</body>
</html>