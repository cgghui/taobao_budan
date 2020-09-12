        <style>
            .setInside{ width:100%; height:auto;}
            .d_biaoti{ height:auto;}
            table tr{ height:35px; line-height: 35px;}
            .examQ{ width:1048px; height:35px; line-height: 35px; background: #57A0FF ; border: 1px dashed #99C1F5; color:#fff; text-indent: 15px;}
            .examA{ width:97%; margin: 0 auto; line-height: 35px; padding: 10px 0;}
            .examA input{ width:15px; height:15px; position:relative; top:2px;}
            .sendMyExam{ width:100%; height: 45px; line-height: 45px; background: #F60; color:#fff; text-align: center; border:none; border-radius: 5px; cursor: pointer;}
        </style>
        <!--新手考试-->
        <div class="d_qie8">
            <ul class="d_zhannei clearfix">
            	<li class="d_znli" style="font-size: 18px;">新手考场</li>
            </ul>
            <div class="d_biaoti clearfix" style="background: none;">
                <div class="setInside"><!--setInside start-->
                    <?php
                        $count=1;
                        $question=Exam::model()->findAll(array(
                            'condition'=>'is_question=1',
                            'order'=>'id asc'
                        ));
                        foreach($question as $item){
                            $answer=Exam::model()->findAll(array(
                                'condition'=>'q_id='.$item->id
                            ));
                    ?>
                    <div class="examItem"><!--examItem start-->
                        <div class="examQ">第<?php echo $count?>题：<?php echo $item->text;?></div>
                        <div class="examA">
                            <?php
                                foreach($answer as $k=>$v){
                            ?>
                            <input type="radio" <?php echo $k==0?'checked="checked"':'';?> name="exam#<?php echo $item->id;?>" value="<?php echo $v->id;?>" lang="<?php echo $item->id;?>"/>&nbsp;
                                <?php 
                                    echo $v->text;
                                ?>
                            <br />
                            <?php }?>
                        </div>
                    </div><!--examItem end-->
                    <?php
                            $count++;
                        }
                    ?>
                    <button class="sendMyExam">完成答题,提交试卷</button>
                </div><!--setInside end-->
            </div>
            <div class="clear"></div>
        </div>
        <!--新手考试-->
 <!--layer插件-->
<script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>
<script src="<?php echo ASSET_URL;?>layer/layer.js"></script>
<script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>
<link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" />
<script>
    $(function(){
        $(".sendMyExam").click(function(){
            //询问框
        	layer.confirm('您确认提交您的试卷吗？', {
        		btn: ['确认提交','再检查一下'] //按钮
        	},function(){
        	   
               var res="";
               var Qarr = [];//题目数组
               var Aarr = [];//答案数组
               var key=0;
               $("input:radio:checked").each(function(){
                    Qarr[key]=$(this).attr("lang");
                    Aarr[key]=$(this).val();//答案存入数组
                    key=key+1;
               });
               
        	   //提交试卷
        	   $.ajax({
        			type:"POST",
        			url:"<?php echo $this->createUrl('user/userExam');?>",
        			data:{"qeustion":Qarr,'answer':Aarr},
        			success:function(msg)
        			{
                        if(msg=='SUCCESS')//通过考试
                        {
                            //询问框
                        	layer.confirm('恭喜您通过新手考试', {
                        		btn: ['知道了'] //按钮
                        	},function(){
                        	   window.location.href='<?php echo $this->createUrl('user/index');?>';
                        	});
                        }else//考试失败
                        {
                            layer.confirm('<span style="color:red;">很遗憾，考试未通过</span>', {
                        		btn: ['重新考试','以后再说'] //按钮
                        	},function(){
                        	   location.reload();//刷新当前页面
                        	},function(){
                        	   window.location.href='<?php echo $this->createUrl('user/index');?>';
                        	});
                        }
        			}
        		});
        	});
        });
    })
</script>