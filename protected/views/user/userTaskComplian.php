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
    .hbitemTip{ color: #000;}
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
        width:500px;
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
        top:15px;      
     }
     #image3,#image4,#image5,#image6,#image7,#image8,.imagewarning{ cursor: pointer; border-radius: 4px;}
</style>
<body>
<!--接手付款步骤区域iframe-->
    <div class="PaystepArea"><!--PaystepArea start-->
        <p>以下为上传有利于您的投诉证据，如旺旺聊天记录或者其他相关证据，最多传6张图片</p>
        <!--货比第1家-->
        <div class="hbitemTip">上传投诉证据1：</div>
        <div class="hbitem">
          <li>
            <input type="text" id="url3" name="goodsImgPosition" class="pc11 inputp s36_ts" readonly="readonly" placeholder="上传投诉证据1" style="background: #F0F0F0; height:30px; line-height:30px;">
            <input type="button" id="image3" value="开始上传" style="font-weight: normal; padding:0 8px; border:none; background:#3498db; color:#fff; width:auto; height:30px; font-size:12px;">
            <span id="imagewarning3" style="color: green; padding-left:10px;"><font style="color:#666; font-weight:normal;">选择性上传</font></span>
          </li>
        </div>
        <!--货比第2家-->
        <div class="hbitemTip">上传投诉证据2：</div>
        <div class="hbitem">
          <li>
            <input type="text" id="url4" name="goodsImgPosition" class="pc11 inputp s36_ts" readonly="readonly" placeholder="上传投诉证据2" style="background: #F0F0F0; height:30px; line-height:30px;">
            <input type="button" id="image4" value="开始上传" style="font-weight: normal; padding:0 8px; border:none; background:#3498db; color:#fff; width:auto; height:30px; font-size:12px;">
            <span id="imagewarning4" style="color: green; padding-left:10px;"><font style="color:#666; font-weight:normal;">选择性上传</font></span>
          </li>
        </div>
        <!--货比第3家-->
        <div class="hbitemTip">上传投诉证据3：</div>
        <div class="hbitem">
          <li>
            <input type="text" id="url5" name="goodsImgPosition" class="pc11 inputp s36_ts" readonly="readonly" placeholder="上传投诉证据3" style="background: #F0F0F0; height:30px; line-height:30px;">
            <input type="button" id="image5" value="开始上传" style="font-weight: normal; padding:0 8px; border:none; background:#3498db; color:#fff; width:auto; height:30px; font-size:12px;">
            <span id="imagewarning5" style="color: green; padding-left:10px;"><font style="color:#666; font-weight:normal;">选择性上传</font></span>
          </li>
        </div>
        <div class="hbitemTip">上传投诉证据4：</div>
        <div class="hbitem">
          <li>
            <input type="text" id="url6" name="goodsImgPosition" class="pc11 inputp s36_ts" readonly="readonly" placeholder="上传投诉证据4" style="background: #F0F0F0; height:30px; line-height:30px;">
            <input type="button" id="image6" value="开始上传" style="font-weight: normal; padding:0 8px; border:none; background:#3498db; color:#fff; width:auto; height:30px; font-size:12px;">
            <span id="imagewarning6" style="color: green; padding-left:10px;"><font style="color:#666; font-weight:normal;">选择性上传</font></span>
          </li>
        </div>
        <div class="hbitemTip">上传投诉证据5：</div>
        <div class="hbitem">
          <li>
            <input type="text" id="url7" name="goodsImgPosition" class="pc11 inputp s36_ts" readonly="readonly" placeholder="上传投诉证据5" style="background: #F0F0F0; height:30px; line-height:30px;">
            <input type="button" id="image7" value="开始上传" style="font-weight: normal; padding:0 8px; border:none; background:#3498db; color:#fff; width:auto; height:30px; font-size:12px;">
            <span id="imagewarning7" style="color: green; padding-left:10px;"><font style="color:#666; font-weight:normal;">选择性上传</font></span>
          </li>
        </div>
        <div class="hbitemTip" style="color: red; font-size:14px; font-weight:bold;">投诉原因(请认真且属实填写，否则您的帐号可能受到处罚甚至会被永久封号)：</div>
        <div class="hbitem">
          <li>
            <textarea name="reason" class="reason" style="width:410px; height:50px; line-height:20px;" placeholder="请填写投诉原因"></textarea>
            <font style="color:red;">*必须填写</font></span>
          </li>
        </div>
        <button class="cetainStepComplete" lang="<?php echo $_GET['taskid'];?>" alt="<?php echo $_GET['userStyle'];?>">确认提交投诉资料</button>
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
        
        K('#image4,#url4').click(function() {
			editor.loadPlugin('image', function() {
				editor.plugin.imageDialog({
					showRemote : false,
					imageUrl : K('#url4').val(),
					clickFn : function(url, title, width, height, border, align) {
					    K('#imagewarning4').html('图片上传成功');
						K('#url4').val(url);
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
					    K('#imagewarning5').html('图片上传成功');
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
					    K('#imagewarning6').html('图片上传成功');
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
					    K('#imagewarning7').html('图片上传成功');
						K('#url7').val(url);
						editor.hideDialog();
					}
				});
			});
		});
        
	});
    
    $(function(){
        //确认提交投诉资料
        $(".cetainStepComplete").click(function(){
            var taskid=$(this).attr("lang");//投诉的对应任务id
            var userStyle=$(this).attr("alt");//userStyle发起投诉的人的类型，0为商家发起的投诉，1为接手发起的投诉
            if($(".reason").val()=="")
            {
                layer.tips('投诉原因必须填写', '.reason', {
                    tips: [1, '#0FA6D8'] //还可配置颜色
                });
                exit;
            }
            //检查通过
            var reasonImg='';//投诉图片证据
            $(".inputp").each(function(){
                if($(this).val()!="")
                {
                    reasonImg=reasonImg+$(this).val()+'@';
                }
            });
            var reason=$(".reason").val();//投诉原因
            //提交投诉申请
            $.ajax({
    			type:"POST",
    			url:"<?php echo $this->createUrl('user/userTaskComplian');?>",
    			data:{"taskid":taskid,"reasonImg":reasonImg,"reason":reason,"userStyle":userStyle},
    			success:function(data)
    			{
    				if(data=="SUCCESS")
                    {
                        layer.confirm('投诉申请已成功提交', {
                    		btn: ['确定'] //按钮
                    	}, function(){
                    	    window.parent.location.reload();//刷新父级页面
                    	    var index = parent.layer.getFrameIndex(window.name);//获取窗口索引
                    	    parent.layer.close(index);//关闭父级
                    	});
                    }else if(data=="EXIST")
                    {
                        layer.confirm('<span style="color:red;">该任务已被投诉，无须重新投诉，请可以查看投诉管理中心</span>', {
                    		btn: ['知道了'] //按钮
                    	}, function(){
                    	    window.parent.location.reload();//刷新父级页面
                    	    var index = parent.layer.getFrameIndex(window.name);//获取窗口索引
                    	    parent.layer.close(index);//关闭父级
                    	});
                    }else
                    {
                        layer.confirm('<span style="color:red;">投诉申请提交失败，请联系客服人员</span>', {
                    		btn: ['知道了'] //按钮
                    	}, function(){
                    	    window.parent.location.reload();//刷新父级页面
                    	    var index = parent.layer.getFrameIndex(window.name);//获取窗口索引
                    	    parent.layer.close(index);//关闭父级
                    	}); 
                    }
    			}
    		});
        });
    })
</script>
</body>
</html>