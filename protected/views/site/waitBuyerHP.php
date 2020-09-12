<html>
<style>
    *{ margin:0; padding:0; font-size:12px; font-family:"微软雅黑"}
    a{ text-decoration: none;}
    li{ list-style:none;}
    .payContent{ width:auto; position: relative;}
    .PaystepArea{ width:500px; min-height:480px; margin: 0 auto; line-height: 25px; margin-top:10px; position:relative;}
    .HB{ display: block;}
    .lastStep{ display: none;}
    #image3,#url3,#image4,#url4{ border-radius: 3px; cursor: pointer; cursor: pointer;}
    #url3,#url4,#url5,#url6,#url7,#url8{ width:200px;}
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
    <div class="PaystepArea HB"><!--PaystepArea start-->
        <div class="hbitemTip">此任务需要上传好评截图：</div>
        <div class="hbitem">
            <li>
                <input type="text" id="url3" name="goodsImgPosition" class="pc11 inputp s36_ts" readonly="readonly" placeholder="上传好评截图" style="background: #F0F0F0; height:30px; line-height:30px;">
                <input type="button" id="image3" value="上传好评截图" style="font-weight: normal; padding:0 8px; border:none; background:#3498db; color:#fff; width:auto; height:30px; font-size:12px;">
                <span id="imagewarning3" style="color: green; padding-left:10px;"><font style="color:red;">*必须上传</font></span>
            </li>
            <button class="firstStep" lang="<?php echo $taskInfo->id;?>" style="margin-top: 10px;">确定提交</button>
        </div>
    </div><!--PaystepArea end-->
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
					    K('#imagewarning3').html('图片上传成功');
						K('#url3').val(url);
						editor.hideDialog();
					}
				});
			});
		});
	});
    
    $(function(){
        //确认提交
        $(".firstStep").click(function(){
            var url3=$("#url3").val();//好评截图
            if(url3!="")//检测是否上传了好评截图
            {
                //检测全部通过
                var taskid=$(this).attr("lang");
				layer.confirm('您确认收货吗？', {
            	btn: ['确认','取消'] //按钮
            	},function(){
                $.ajax({
        			type:"POST",
        			url:"<?php echo $this->createUrl('site/waitBuyerHPDone');?>",  
        			data:{"taskid":taskid,"url3":url3},
        			success:function(data)
        			{
                        if(data=="SUCCESS")
                        {
                            layer.confirm('收货好评成功', {
                        		btn: ['确定'] //按钮
                        	}, function(){
                        	    window.parent.location.reload();//刷新父级页面
                        	    var index = parent.layer.getFrameIndex(window.name);//获取窗口索引
                        	    parent.layer.close(index);//关闭父级
                        	});
                        }else
                        {
                            layer.confirm('收货好评失败，请联系客服人员', {
                        		btn: ['确定'] //按钮
                        	}, function(){
                        	    window.parent.location.reload();//刷新父级页面
                        	    var index = parent.layer.getFrameIndex(window.name);//获取窗口索引
                        	    parent.layer.close(index);//关闭父级
                        	}); 
                        }
        			}
        		});
				});
                
            }else//不通过
            {
                alert("请先上传好评截图");
            }
        });
    })
</script>
</body>
</html>