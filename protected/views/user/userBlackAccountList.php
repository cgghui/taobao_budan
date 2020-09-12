        <?php
            echo $this->renderPartial('/user/usercenterTopNav')
        ?>
        <!--黑名单-->
         <div class="d_qie6">
         	<div class="d_hei">
            	<p class="heimingdan">用户黑名单</p>
            </div>
            <div class="d_tianjia">
                	<p>您是新手会员，可以添加8个用户到黑名单</p>
            </div>
            <div class="d_lahei">
                	<label>拉黑用户名：<input type="text" class="d_laheiin blackerusername" placeholder="被拉黑者用户名" /></label><br />
                    <label class="d_lala"><span style="padding-right: 5px;">拉黑的原因：</span>
                        <textarea class="d_reason reason" placeholder="为了避免恶意拉黑,请填写拉黑原因！"></textarea>
                    </label>
                <div class="d_jiaru">
                	<a href="javascript:;" class="addMyBlackList">加入黑名单</a>
                </div>
                <ul class="d_tongji clearfix" style="height: 45px; margin:0; background: #57A0FF; color:#fff;">
                    <li>拉黑用户名</li>
                    <li>拉黑原因</li>
                    <li>拉黑时间</li>
                    <li>操作</li>
                </ul>
                <?php
                    foreach($proInfo as $item){
                ?>
                        <ul class="d_tongji clearfix" style=" background: none; margin: 0; border-bottom: 1px dashed #57A0FF;">
                            <li><?php echo $item->blackerusername;?></li>
                            <li><?php echo $item->reason;?></li>
                            <li><?php echo date('Y-m-d H:i:s',$item->time);?></li>
                            <li><a style="color: #57A0FF;" href="javascript:;" class="delBlackName" lang="<?php echo $item->id;?>">删除</a></li>
                        </ul>
                <?php }?>
                <div class="breakpage" style="margin-bottom: 10px;"><!--分页开始-->
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
            </div>
         </div>
         <!--黑名单-->
 <!--layer插件-->
<script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>
<script src="<?php echo ASSET_URL;?>layer/layer.js"></script>
<script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>
<link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" />
<script>
    $(function(){
        //添加黑名单
        $(".addMyBlackList").click(function(){
            if($(".blackerusername").val()=="")//拉黑用户名不能为空
            {
                layer.tips('拉黑用户名不能为空', '.blackerusername');
                exit;
            }
            if($(".reason").val()=="")//拉黑原因不能为空
            {
                layer.tips('拉黑原因不能为空', '.reason');
                exit;
            }
            
            //输入安全码
            layer.confirm('输入安全码<input type="password" name="safePwd" class="text1 safePwd" style="margin-left:5px;" />', {
            	btn: ['确定'] //按钮
            },function(){
                if($(".safePwd").val()=="")//安全码必填
                {
                    layer.tips('请输入安全码', '.safePwd');
                }else
                {
                    $.ajax({
            			type:"POST",
            			url:"<?php echo $this->createUrl('user/checkSafePwd');?>",
            			data:{"safePwd":$(".safePwd").val()},
            			success:function(msg)
            			{
            				if(msg=="SUCCESS")//安全码正确
                            {
                                //检查通过提交黑名单
                                $.ajax({
                        			type:"POST",
                        			url:"<?php echo $this->createUrl('user/userBlackAccountList');?>",
                        			data:{"blackerusername":$(".blackerusername").val(),"reason":$(".reason").val()},
                        			success:function(msg)
                        			{
                        				if(msg=="SUCCESS")
                                        {
                                            //询问框
                                        	layer.confirm('黑名单添加成功', {
                                        		btn: ['知道了'] //按钮
                                        	},function(){
                                        	    location.reload();//刷新当前页面
                                        	});
                                        }else if(msg=="EXIST"){
                                            //询问框
                                        	layer.confirm('<span style="color:red;">该黑名单已存在</span>', {
                                        		btn: ['知道了'] //按钮
                                        	},function(){
                                        	    location.reload();//刷新当前页面
                                        	});
                                        }else
                                        {
                                            //询问框
                                        	layer.confirm('<span style="color:red;">黑名单添加失败，您可以联系我们的客服人员</span>', {
                                        		btn: ['知道了'] //按钮
                                        	},function(){
                                        	    location.reload();//刷新当前页面
                                        	});
                                        }
                        			}
                        		});
                                //检查通过提交黑名单
                            }else
                            {
                                $(".safePwd").val("");
                                layer.tips('安全码不正确', '.safePwd');
                            }
            			}
            		});
                }
            });
            //输入安全码
        });
        
        //删除黑名单
        $(".delBlackName").click(function(){
            $.ajax({
    			type:"POST",
    			url:"<?php echo $this->createUrl('user/userBlackDel');?>",
    			data:{"blackid":$(this).attr("lang")},
    			success:function(msg)
    			{
    				if(msg=="SUCCESS")
                    {
                        //询问框
                    	layer.confirm('黑名单删除成功', {
                    		btn: ['知道了'] //按钮
                    	},function(){
                    	    location.reload();//刷新当前页面
                    	});
                    }else
                    {
                        //询问框
                    	layer.confirm('<span style="color:red;">黑名单删除失败，您可以联系我们的客服人员</span>', {
                    		btn: ['知道了'] //按钮
                    	},function(){
                    	    location.reload();//刷新当前页面
                    	});
                    }
    			}
    		});
        });
    })
</script>