    <!--推广赚钱-->
   	<div class="d_tui">
        <?php
            $spreadPrice=System::model()->findByAttributes(array("varname"=>"spreadPrice"));
        ?>
    	<div class="d_guize">
        	<p class="d_p1">推广规则：通过推广链接注册成功后</p>
            <p class="d_p2">发布或接手10个任务为有效推广</p>
            <p class="d_p3">即奖励您<span><?php echo $spreadPrice->value;?></span>元现金</p>
            <!--推广链接-->
            <p class="getMyTgLink" style="width:395px; height: 100px; text-indent: -10000px; position: absolute; top:370px; left:310px; cursor: pointer;">
                获取我的专属推广链接
            </p>
            <style>
            td.d_lbtd{ padding: 0 4px; border-radius: 5px;}
            </style>
            <?php
                $spreadinfo=User::model()->findAll(array(
                    'order'=>'SpreadMoney desc',
                    'limit'=>10
                ));
            ?>
            <div class="d_liebiao">
            	<table class="d_lbttable">
                	<tr>
                    	<th class="th1" style="padding-left:5px;">排名	</th>
                        <th class="th2">用户名</th>
                        <th class="th3">获得返现</th>
                    </tr>
                    <?php
                        $count=1;
                        foreach($spreadinfo as $v){
                    ?>
                    <tr>
                    	<td class="d_lbtd"><?php echo $count;?></td>
                        <td class="d_lbtd1"><?php echo $v->Username;?></td>
                        <td class="d_lbtd2"><?php echo $v->SpreadMoney.' 元';?></td>
                    </tr>
                    <?php
                            $count++;
                        }
                    ?>
                </table>
            </div>
        </div>
        <style>
            #spread li{ color:#fc9c3a; font-weight:bold;}
        </style>
       <div class="d_tg">
       		<div class="d_tghy">
                <ul class="d_tgul clearfix" id="spread">
                	<li class="d_tgul1">推广会员</li>
                    <li class="d_tgul2">注册时间</li>
                    <li class="d_tgul3">接任务数据(已接/完成)</li>
                    <li class="d_tgul4">发任务数据(已发/完成)</li>
                    <li class="d_tgul5">领取推广佣金(元)</li>
                </ul>
                <?php
                    foreach($proInfo as $item){
                        //接任务相关
                        $TakeTaskWwcCount=Companytasklist::model()->findAll(array(
                            'condition'=>'taskerid='.$item->id
                        ));
                        $TakeTaskWcCount=Companytasklist::model()->findAll(array(
                            'condition'=>'taskerid='.$item->id.' and status=5'
                        ));
                        
                        $PublishTaskWwcCount=Companytasklist::model()->findAll(array(
                            'condition'=>'publishid='.$item->id
                        ));
                        
                        $PublishTaskWcCount=Companytasklist::model()->findAll(array(
                            'condition'=>'publishid='.$item->id.' and status=5'
                        ));
                ?>
            	<ul class="d_tgul clearfix" style="border-top: none;">
                	<li class="d_tgul1"><?php echo $item->Username;?></li>
                    <li class="d_tgul2"><?php echo date('Y-m-d H:i:s',$item->RegTime);?></li>
                    <li class="d_tgul3"><?php echo count($TakeTaskWwcCount).'/'.count($TakeTaskWcCount);?></li>
                    <li class="d_tgul4"><?php echo count($PublishTaskWwcCount).'/'.count($PublishTaskWcCount);?></li>
                    <li class="d_tgul5">
                        <?php
                            $spreadRecord=Recordlist::model()->findByAttributes(array(
                                'userid'=>Yii::app()->user->getId(),
                                'spreadid'=>$item->id
                            ));
                            $spreadPrice=System::model()->findByAttributes(array("varname"=>"spreadPrice"));
                            if($spreadRecord)
                                echo $spreadPrice->value.'元';
                            else
                                echo '0 元';
                        ?>
                    </li>
                </ul>
                <?php
                    }
                ?>
            </div>
                <div class="breakpage" style="margin: 10px 0;"><!--分页开始-->
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
                <p style="text-align: center; color:#fff;">( 总推荐人数：<span style="color: #fff; font-size: 20px; font-weight:bold; font-style: italic;"><?php echo $total;?></span>人 )</p>
       </div>
    </div>
    <!--推广赚钱-->
<!--layer插件-->
<script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>
<script src="<?php echo ASSET_URL;?>layer/layer.js"></script>
<script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>
<link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" />
<script>
    $(function(){
        $(".getMyTgLink").click(function(){
            layer.open({
                type: 2,
                title:'您的专属推广链接',
                area: ['566px','230px'],
                skin: 'layui-layer-rim', //加上边框
                content: ['<?php echo $this->createUrl('user/userSpreadLink');?>', 'no']
            });
        });
    })
</script>