    <?php
        echo $this->renderPartial('/user/taobaoTaskNav');//载入淘宝大厅导航
    ?>
    <div class="bdmhIntr">
        <p>1、该页面用来绑定和维护用来接任务、购买任务商品的淘宝买号</p>
        <p>2、一个买号一天只可以接手6个任务，接手高于6个任务，系统将挂起买号，第二天才进行继续接手任务</p>
        <p>3、您目前是新手会员用户,<a href="<?php echo $this->createUrl('user/userBuyPoint');?>" target="_blank">申请VIP</a>最高可绑定100个买号！ <a href="<?php echo $this->createUrl('site/userLeveldoc');?>" target="_blank">查看VIP限权</a></p>
    </div>
    <div class="bdmh">
        <form action="<?php $this->createUrl('user/taobaoBindBuyer');?>" method="post">
                <input type="hidden" name="platform" value="1" />
            <div class="bd_zh clearfix">
                <img src="<?php echo VERSION2;?>img/wang.jpg" alt="" class="wang">
                <div class="bd_zht">淘宝买家账号</div>
                <input type="text" name="bdmh" class="zhsr">
                <select name="wangwanginfo" id="" class="zhSort">
                    <option value="0">白号(0-3分)</option>
                    <option value="1">一心(4-10分)</option>
                    <option value="2">二心(11-40分)</option>
                    <option value="3">三心(41-90分)</option>
                    <option value="4">四心(90-150分)</option>
                    <option value="5">五心(151-250分)</option>
                    <option value="6">一钻(251-500分)</option>
                    <option value="7">二钻(501-1000分)</option>
                    <option value="8">三钻(1001-2000分)</option>
                    <option value="9">四钻(2001-5000分)</option>
                    <option value="10">五钻(5001-10000分)</option>
                </select>
                <select name="taotaorz" id="" class="zhSort_s">
                    <option value="1">已通过淘宝实名认证</option>
                    <option value="0">未通过淘宝实名认证</option>
                </select>
                <button class="bdtbmh">绑定淘宝买号</button><br />
                <span class="span" style=" text-align: right; color: red; position: relative; left: 920px; top: -35px;"><?php echo @$warning;?></span>
            </div>
        </form>
        <br />
        <form action="<?php $this->createUrl('user/taobaoBindBuyer');?>" method="post">
                <input type="hidden" name="platform" value="2" />
            <div class="bd_zh clearfix">
                <img src="<?php echo VERSION2;?>img/jd.jpg" alt="" class="wang">
                <div class="bd_zht">京东买家账号</div>
                <input type="text" name="bdmh" class="zhsr">
                <input type="hidden" name="wangwanginfo" value="0" />
                <select name="wangwanginfo" id="" class="zhSort">
                    <option value="0">注册会员(无)</option>
                    <option value="1">铜牌会员(0-1999分)</option>
                    <option value="2">银牌会员(2000-9999分)</option>
                    <option value="3">金牌会员(10000-29999分)</option>
                    <option value="4">钻石会员(30000-元上限)</option>
                </select>
                <input type="hidden" name="taotaorz" value="1" />
                <select name="taotaorz" id="" class="zhSort_s">
                    <option value="1">已通过京东实名认证</option>
                    <option value="0">未通过京东实名认证</option>
                </select>
                <button class="bdtbmh">绑定京东买号</button>
            </div>
        </form>
            <div class="bdzhzy">注意：买号信息绑定数据务必真实填写，一旦发现虚假，罚金10元/次。【查处达三次，永久封号】</div>
            <!--买号列表-->
            <table class="t4" style="width: 100%;">
                <tbody>
                <tr>
                    <td><table cellpadding="0" style="width: 100%;">
                        <tbody>
                        <tr id="row-head" style="color: #0099cc; font-weight: bold;">
                            <td width="10" height="37" class="txjl_bg1"></td>
                            <td width="15%" height="37" align="center" valign="middle" class="txjl_bg2" style="font-size:14px">买家账号</td>
                            <td width="25%" height="37" align="center" valign="middle" class="txjl_bg2" style="font-size:14px" "="">信誉</td>
                            <td width="20%" height="37" align="center" valign="middle" class="txjl_bg2" style="font-size:14px" "="">已接任务数/已完成任务数</td>
                            <td width="10%" height="37" align="center" valign="middle" class="txjl_bg2" style="font-size:14px" "="">买号状态</td>
                            <td width="10%" height="37" align="center" valign="middle" class="txjl_bg2" style="font-size:14px" "="">是否启用</td>
                            <!--<td width="15%" height="37" align="center" valign="middle" class="txjl_bg2" style="font-size:14px" "="">操作</td>-->
                            <td width="10" height="37" class="txjl_bg3"></td>
                        </tr>
                        <?php
                            foreach($proInfo as $item){
                        ?>
                        <tr>
                             <td>&nbsp;</td>
                             <td height="80" align="center" valign="middle" class="mh_xxian maihao" style="position: relative;">
                                 <p style="height:25px">
                                 <?php
                                    if($item->platform==1){
                                 ?>
                                    <img src="<?php echo VERSION2;?>img/wang.jpg" width="20" style="position: absolute; left:-3px;" />
                                 <?php }else{?>
                                    <img src="<?php echo VERSION2;?>img/jd.jpg" width="20" style="position: absolute; left:-3px;"/>
                                 <?php }?>
                                 <span class="blue"><?php echo $item->wangwang;?> </span> 
                                 <?php
                                    if($item->taotaorz){
                                 ?>
                                    <img src="<?php echo VERSION2;?>img/sm.jpg" width="34" height="17" title="通过支付宝实名认证用户" align="absmiddle"/>
                                 <?php }else
                                    {
                                        echo "<span style='color:red;'>未实名</span>";
                                    }
                                 ?>
                                 </p>
                                 <p style="height:25px" alt='<?php echo $item->id;?>'>
                                 <select name="realnameOn" class="mh_bk realnameOn" id="realnameOn" style="width:150px;">
                                    <option value="1" <?php echo $item->taotaorz==0?'selected="selected"':"";?>>已经过<?php echo $item->platform==1?"淘宝":"京东";?>实名认证</option>
                                    <option value="0" <?php echo $item->taotaorz==0?'selected="selected"':"";?>>未经过<?php echo $item->platform==1?"淘宝":"京东";?>实名认证</option>
                                 </select>
                                 </p>
                             </td>
                             <td align="center" valign="middle" class="mh_xxian">
                                 <p style="height:25px;line-height:25px;">当前信誉等级：
                                    <?php
                                        if($item->platform==1){
                                    ?>
                                    <img src="<?php echo VERSION2;?>img/level/<?php echo $item->wangwanginfo;?>.gif" style="vertical-align: text-top;cursor:pointer;" />
                                    <?php }else{?>
                                    <img src="<?php echo VERSION2;?>img/level/jd<?php echo $item->wangwanginfo;?>.png" style="vertical-align: text-top;cursor:pointer;" />
                                    <?php }?>
                                 </p>
                                 <p style="height:25px" alt='<?php echo $item->id;?>'>
                                 <select name="taobaoScoreOn" class="mh_bk taobaoScoreOn" id="taobaoScoreOn" style="width:150px;">
                                  <?php
                                    if($item->platform==1){//淘宝
                                  ?>
                                     <option value="0" <?php echo $item->wangwanginfo==0?'selected="selected"':"";?>>白号(0-3分)</option>
                                     <option value="1" <?php echo $item->wangwanginfo==1?'selected="selected"':"";?>>一心(4-10分)</option>
                                     <option value="2" <?php echo $item->wangwanginfo==2?'selected="selected"':"";?>>二心(11-40分)</option>
                                     <option value="3" <?php echo $item->wangwanginfo==3?'selected="selected"':"";?>>三心(41-90分)</option>
                                     <option value="4" <?php echo $item->wangwanginfo==4?'selected="selected"':"";?>>四心(90-150分)</option>
                                     <option value="5" <?php echo $item->wangwanginfo==5?'selected="selected"':"";?>>五心(151-250分)</option>
                                     <option value="6" <?php echo $item->wangwanginfo==6?'selected="selected"':"";?>>一钻(251-500分)</option>
                                     <option value="7" <?php echo $item->wangwanginfo==7?'selected="selected"':"";?>>二钻(501-1000分)</option>
                                     <option value="8" <?php echo $item->wangwanginfo==8?'selected="selected"':"";?>>三钻(1001-2000分)</option>
                                     <option value="9" <?php echo $item->wangwanginfo==9?'selected="selected"':"";?>>四钻(2001-5000分)</option>
                                     <option value="10" <?php echo $item->wangwanginfo==10?'selected="selected"':"";?>>五钻(5001-10000分)</option>
                                     <?php }else{//京东?>
                                     <option value="0" <?php echo $item->wangwanginfo==0?'selected="selected"':"";?>>注册会员(无)</option>
                                     <option value="1" <?php echo $item->wangwanginfo==1?'selected="selected"':"";?>>铜牌(0-1999分)</option>
                                     <option value="2" <?php echo $item->wangwanginfo==2?'selected="selected"':"";?>>银牌(2000-9999分)</option>
                                     <option value="3" <?php echo $item->wangwanginfo==3?'selected="selected"':"";?>>金牌(10000-29999分)</option>
                                     <option value="4" <?php echo $item->wangwanginfo==4?'selected="selected"':"";?>>钻石(30000-无上线)</option>
                                     <?php }?>
                                 </select>
                                 </p>
                             </td>
                             <?php
                                $TakeTaskWwcCount=Companytasklist::model()->findAll(array(
                                    'condition'=>'taskerWangwang="'.$item->wangwang.'" and status<>5'
                                ));
                                $TakeTaskWcCount=Companytasklist::model()->findAll(array(
                                    'condition'=>'taskerWangwang="'.$item->wangwang.'" and status=5'
                                ));
                             ?>
                             <td align="center" valign="middle" class="t42">
                                <?php
                                    echo count($TakeTaskWwcCount).'/'.count($TakeTaskWcCount);
                                ?>
                             </td>
                             <td align="center" valign="middle" class="mh_xxian">
                                <span class="green">
                                    <?php
                                        echo $item->statue==1?"<span style='color:green;'>正常</span>":"<span style='color:red;'>已停用</span>";
                                    ?>
                                </span>
                             </td>
                             <td align="center" class="mh_xxian">
                                <p alt='<?php echo $item->id;?>'>
                                    <input type="checkbox" class="changeStatusOn" id="changeStatusOn" value="<?php echo $item->statue;?>" <?php echo $item->statue==1?'checked="checked"':"";?>/>
                                </p>
                             </td>
                             <!--<td align="center" class="mh_xxian">
                                <a onclick="if(confirm('您确定要删除吗？')) return true; else return false;" href="<?php echo $this->createUrl('user/taobaoBindBuyerDel',array('id'=>$item->id));?>" class="del_seller">删除买号</a>
                             </td>-->
                             <td>&nbsp;</td>
                        </tr>
                        <?php }?>
                        </tbody>
                    </table></td>
                    </tr>
                </tbody>
            </table>
            
            <div class="breakpage"><!--分页开始-->
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
    
        </div><!--任务列表翻页 end-->
        </form>
    </div>
    <script>
        $(function(){
            //修改买号相关状态
            $(".realnameOn,.changeStatusOn,.taobaoScoreOn").change(function(){
                $.ajax({
        			type:"POST",
        			url:"<?php echo $this->createUrl('user/taobaoBindBuyerChangeInfo');?>",
        			data:{"id":$(this).parent().attr('alt'),"value":$(this).val(),"action":$(this).attr('id')},
        			success:function(msg)
        			{
        				if(msg)
                            location.reload();
                        else
                        {
                            alert("信息修改失败，请联系网站客服");
                        }
        			}
        		});
            });
        })
    </script>
    
    <?php
        $authinfo=User::model()->findByPk(Yii::app()->user->getId());
        $authperson=System::model()->findByAttributes(array("varname"=>"authperson"));//检测是否要求实名认证
        if($authinfo->AuthPerson==0 && $authperson->value==1){
    ?>
    <!--layer插件-->
    <script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>
    <script src="<?php echo ASSET_URL;?>layer/layer.js"></script>
    <script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>
    <link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" />
    <script>
        $(function(){
            //询问框
        	layer.confirm('<span style="color:red;">绑定买号您需要先通过威客实名认证</span>', {
        		btn: ['立即认证','暂不认证'] //按钮
        	},function(){
        	   window.location.href='<?php echo $this->createUrl('user/authPerson');?>';
        	},function(){
        	   window.location.href='<?php echo $this->createUrl('site/index');?>';
        	});
        })
    </script>
    <?php }?>