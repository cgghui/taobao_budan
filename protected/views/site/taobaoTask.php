    <?php

        echo $this->renderPartial('/user/taobaoTaskNav');//载入淘宝大厅导航

    ?>

    <?php

        $GetConditionArr=$_GET;//查询条件整理

        //初始化

        if(!isset($_GET['platform']))

            $GetConditionArr['platform']='noVal';

            

        if(!isset($_GET['payWay']))

            $GetConditionArr['payWay']='noVal';

            

        if(!isset($_GET['BuyerJifen']))

            $GetConditionArr['BuyerJifen']='noVal';

            

        if(!isset($_GET['isMobile']))

            $GetConditionArr['isMobile']='noVal';

            

        if(!isset($_GET['task_type']))

            $GetConditionArr['task_type']='noVal';

            

        if(!isset($_GET['MinLi']))

            $GetConditionArr['MinLi']='noVal';

            

        if(!isset($_GET['txtPrice']))

            $GetConditionArr['txtPrice']='noVal';

            

        if(!isset($_GET['ddlOKDay']))

            $GetConditionArr['ddlOKDay']='noVal';

        //var_dump(@$GetConditionArr);

    ?>

    <div class="dtSort">

        <div class="dtSortCen">

            <div class="dtSortLis">

                <div class="dtSortLis_t">任务平台：</div>

                <div class="<?php echo !isset($_GET['platform']) || @$_GET['platform']=='noVal' || @$_GET['platform']==''?'dtSortLis_pro':'dtSortLis_proBeore';?>"><a href="<?php

                        @$GetConditionArr['platform']='noVal';

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">不限</a></div>

                <ul class="dtSortList">

                    <li><a <?php echo @$_GET['platform']==1?'class="searchOn"':'';?> href="<?php

                        @$GetConditionArr['platform']=1;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">淘宝</a></li>

                    <li><a <?php echo @$_GET['platform']==2?'class="searchOn"':'';?> href="<?php

                        @$GetConditionArr['platform']=2;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">京东</a></li>

                    <li><a <?php echo @$_GET['platform']==3?'class="searchOn"':'';?> href="<?php

                        @$GetConditionArr['platform']=3;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">阿里巴巴</a></li>

                </ul>

                <?php @$GetConditionArr['platform'] = $_GET['platform'];?>

            </div>

            <div class="dtSortLis">

                <div class="dtSortLis_t">付款方式：</div>

                <div class="<?php echo !isset($_GET['payWay']) || @$_GET['payWay']=='noVal' || @$_GET['payWay']==''?'dtSortLis_pro':'dtSortLis_proBeore';?>"><a href="<?php

                        @$GetConditionArr['payWay']='noVal';

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">不限</a></div>

                <ul class="dtSortList">

                    <li><a <?php echo @$_GET['payWay']==1?'class="searchOn"':'';?> href="<?php

                        @$GetConditionArr['payWay']=1;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">威客垫付</a></li>

                    <li><a <?php echo @$_GET['payWay']==2?'class="searchOn"':'';?> href="<?php

                        @$GetConditionArr['payWay']=2;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">远程代付</a></li>

                </ul>

                <?php @$GetConditionArr['payWay'] = $_GET['payWay'];?>

            </div>

            <div class="dtSortLis">

                <div class="dtSortLis_t">星级要求：</div>

                <div class="<?php echo !isset($_GET['BuyerJifen']) || @$_GET['BuyerJifen']=='noVal' || @$_GET['BuyerJifen']==''?'dtSortLis_pro':'dtSortLis_proBeore';?>"><a href="<?php

                        @$GetConditionArr['BuyerJifen']='noVal';

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">不限</a></div>

                <ul class="dtSortList" id="dtSortListOth">

                    <li><a <?php echo @$_GET['BuyerJifen']==1?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['BuyerJifen']=1;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">一心以上</a></li>

                    <li><a <?php echo @$_GET['BuyerJifen']==2?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['BuyerJifen']=2;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">二心以上</a></li>

                    <li><a <?php echo @$_GET['BuyerJifen']==3?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['BuyerJifen']=3;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">三心以上</a></li>

                    <li><a <?php echo @$_GET['BuyerJifen']==4?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['BuyerJifen']=4;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">四心以上</a></li>

                    <li><a <?php echo @$_GET['BuyerJifen']==5?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['BuyerJifen']=5;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">五心以上</a></li>

                    <li><a <?php echo @$_GET['BuyerJifen']==6?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['BuyerJifen']=6;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">一钻以上</a></li>

                    <li><a <?php echo @$_GET['BuyerJifen']==7?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['BuyerJifen']=7;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">二钻以上</a></li>

                    <li><a <?php echo @$_GET['BuyerJifen']==8?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['BuyerJifen']=8;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">三钻以上</a></li>

                    <li><a <?php echo @$_GET['BuyerJifen']==9?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['BuyerJifen']=9;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">四钻以上</a></li>

                    <li><a <?php echo @$_GET['BuyerJifen']==10?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['BuyerJifen']=10;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">五钻以上</a></li>

                </ul>

                <?php @$GetConditionArr['BuyerJifen'] = $_GET['BuyerJifen'];?>

            </div>

            <div class="dtSortLis">

                <div class="dtSortLis_t">任务类型：</div>

                <div class="<?php echo !isset($_GET['isMobile']) || @$_GET['isMobile']=='noVal' || @$_GET['isMobile']==''?'dtSortLis_pro':'dtSortLis_proBeore';?>"><a href="<?php

                        @$GetConditionArr['isMobile']='noVal';

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">不限</a></div>

                <ul class="dtSortList">

                    <li><a <?php echo @$_GET['isMobile']==1?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['isMobile']=1;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">手机任务</a></li>

                    <li><a <?php echo @$_GET['isMobile']==2?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['isMobile']=2;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">电脑任务</a></li>

                </ul>

                <?php @$GetConditionArr['isMobile'] = $_GET['isMobile'];?>

            </div>

            <div class="dtSortLis">

                <div class="dtSortLis_t">商品类型：</div>

                <div class="<?php echo !isset($_GET['task_type']) || @$_GET['task_type']=='noVal' || @$_GET['task_type']==''?'dtSortLis_pro':'dtSortLis_proBeore';?>"><a href="<?php

                        @$GetConditionArr['task_type']='noVal';

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">不限</a></div>

                <ul class="dtSortList">

                    <li><a <?php echo isset($_GET['task_type']) && @$_GET['task_type']!=1 && @$_GET['task_type']!='' && @$_GET['task_type']!='noVal'?'class="searchOn"':'';?>  href="<?php

                        $GetConditionArr['task_type']=0;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">虚拟商品</a></li>

                    <li><a <?php echo @$_GET['task_type']==1?'class="searchOn"':'';?>  href="<?php

                        $GetConditionArr['task_type']=1;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">实物商品</a></li>

                </ul>

                <?php @$GetConditionArr['task_type'] = $_GET['task_type'];?>

            </div>

            <div class="dtSortLis">

                <div class="dtSortLis_t">佣金奖励：</div>

                <div class="<?php echo !isset($_GET['MinLi']) || @$_GET['MinLi']=='noVal' || @$_GET['MinLi']==''?'dtSortLis_pro':'dtSortLis_proBeore';?>"><a href="<?php

                        @$GetConditionArr['MinLi']='noVal';

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">不限</a></div>

                <ul class="dtSortList">

                    <li><a <?php echo @$_GET['MinLi']==1?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['MinLi']=1;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">1-10金币</a></li>

                    <li><a <?php echo @$_GET['MinLi']==2?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['MinLi']=2;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">11-20金币</a></li>

                    <li><a <?php echo @$_GET['MinLi']==3?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['MinLi']=3;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">21-30金币</a></li>

                    <li><a <?php echo @$_GET['MinLi']==4?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['MinLi']=4;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">31-40金币</a></li>

                    <li><a <?php echo @$_GET['MinLi']==5?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['MinLi']=5;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">41金币以上</a></li>

                </ul>

                <?php @$GetConditionArr['MinLi'] = $_GET['MinLi'];?>

            </div>

            <div class="dtSortLis">

                <div class="dtSortLis_t">任务金额：</div>

                <div class="<?php echo !isset($_GET['txtPrice']) || @$_GET['txtPrice']=='noVal' || @$_GET['txtPrice']==''?'dtSortLis_pro':'dtSortLis_proBeore';?>"><a href="<?php

                        @$GetConditionArr['txtPrice']='noVal';

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">不限</a></div>

                <ul class="dtSortList">

                    <li><a <?php echo @$_GET['txtPrice']==1?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['txtPrice']=1;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">0-100元</a></li>

                    <li><a <?php echo @$_GET['txtPrice']==2?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['txtPrice']=2;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">100-200元</a></li>

                    <li><a <?php echo @$_GET['txtPrice']==3?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['txtPrice']=3;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">200-300元</a></li>

                    <li><a <?php echo @$_GET['txtPrice']==4?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['txtPrice']=4;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">300-400元</a></li>

                    <li><a <?php echo @$_GET['txtPrice']==5?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['txtPrice']=5;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">400-500元</a></li>

                    <li><a <?php echo @$_GET['txtPrice']==6?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['txtPrice']=6;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">500-600元</a></li>

                    <li><a <?php echo @$_GET['txtPrice']==7?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['txtPrice']=7;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">600-700元</a></li>

                    <li><a <?php echo @$_GET['txtPrice']==8?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['txtPrice']=8;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">700-800元</a></li>

                    <li><a <?php echo @$_GET['txtPrice']==9?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['txtPrice']=9;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">800-900元</a></li>

                    <li><a <?php echo @$_GET['txtPrice']==10?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['txtPrice']=10;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">900以上</a></li>

                </ul>

                <?php @$GetConditionArr['txtPrice'] = $_GET['txtPrice'];?>

            </div>

            <div class="dtSortLis">

                <div class="dtSortLis_t">收货时长：</div>

                <div class="<?php echo !isset($_GET['ddlOKDay']) || @$_GET['ddlOKDay']=='noVal' || @$_GET['ddlOKDay']==''?'dtSortLis_pro':'dtSortLis_proBeore';?>"><a href="<?php

                        @$GetConditionArr['ddlOKDay']='noVal';

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">不限</a></div>

                <ul class="dtSortList">

                    <li><a <?php echo @$_GET['ddlOKDay']==1?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['ddlOKDay']=1;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">立刻确认</a></li>

                    <li><a <?php echo @$_GET['ddlOKDay']==2?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['ddlOKDay']=2;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">1天后确认</a></li>

                    <li><a <?php echo @$_GET['ddlOKDay']==3?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['ddlOKDay']=3;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">2天后确认</a></li>

                    <li><a <?php echo @$_GET['ddlOKDay']==4?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['ddlOKDay']=4;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">3天后确认</a></li>

                    <li><a <?php echo @$_GET['ddlOKDay']==5?'class="searchOn"':'';?> href="<?php

                        $GetConditionArr['ddlOKDay']=5;

                        echo $this->createUrl('site/taobaoTask',$GetConditionArr);

                    ?>">大于4天确认</a></li>

                </ul>

                <?php @$GetConditionArr['ddlOKDay'] = $_GET['ddlOKDay'];?>

            </div>

        </div>

    </div>

    <div class="dtrw"><!--大厅任务-->

        <div class="dtrwCen">

            <div class="dtrwCen_t">

                <div class="rwso">

                    <form action="<?php echo $this->createUrl('site/taobaoTask');?>" method="post">

                        <input type="text" name="keywords" class="rwsoInp" placeholder="任务编号搜索">

                        <input type="submit" class="rwsoImg" value="&nbsp">

                    </form>

                </div>

                <a class="rwsoNo" href="/news/deatailInfo/id/147/catlogid/41.html" target="_blank">接任务必看，违者封号</a>

                <a href="<?php echo $this->createUrl('user/taskPublishLU');?>" class="rw_fb1">发布任务</a>

                <a href="javascript:window.location.href='<?php echo Yii::app()->request->url;?>';" class="rw_sx1">刷新任务</a>

            </div>

        </div>

        <ul class="dtrwLis">

            <?php

                foreach($proInfo as $item){

            ?>

            <li class="taskItem" style="min-height: 132px;">

                <div class="rebh">

                    <img class="payWay" width="30" src="<?php 

                        switch($item->payWay)

                        {

                            case 1://接手垫付

                                echo VERSION2."/img/ykdf.jpg";

                                break;

                            default://远程单

                                echo VERSION2."/img/df.jpg";

                                break;

                        }

                    ?>" lang='<?php echo $item->payWay;?>' title="<?php

                    

                        switch($item->payWay)

                        {

                            case 1://接手垫付

                                echo "此任务为威客垫付任务";

                                break;

                            default://远程单

                                echo "此任务为远程单任务";

                                break;

                        }

                    ?>" />

                    <img class="platform" width="30" src="<?php 

                        switch($item->platform)

                        {

                            case 1:

                                echo VERSION2."/img/tm.jpg";

                                break;

                            case 2:

                                echo VERSION2."/img/jd.jpg";

                                break;

                            default:

                                echo VERSION2."/img/1688.jpg";

                                break;

                        }

                    ?>" lang='<?php echo $item->platform;?>' title="<?php 

                        switch($item->platform)

                        {

                            case 1:

                                echo "此任务为淘宝任务";

                                break;

                            case 2:

                                echo "此任务为京东任务";

                                break;

                            default:

                                echo "此任务为阿里巴巴任务";

                                break;

                        }

                    ?>" />

                    

                    <font>任务编号</font>：<span><?php echo $item->time.'*'.$item->id;?></span>

                    <font style="color:#000; maring-left:10px;">小号信誉要求：</font>

                    <?php

                        if($item->BuyerJifen<>0){

                    ?>

                    <img title="<?php 

                        switch($item->BuyerJifen)

                        {

                            case 1:

                                $dj="一心";

                                break;

                            case 2:

                                $dj="二心";

                                break;

                            case 3:

                                $dj="三心";

                                break;

                            case 4:

                                $dj="四心";

                                break;

                            case 5:

                                $dj="五心";

                                break;

                            case 6:

                                $dj="一钻";

                                break;

                            case 7:

                                $dj="二钻";

                                break;

                            case 8:

                                $dj="三钻";

                                break;

                            case 9:

                                $dj="四钻";

                                break;

                            default:

                                $dj="五钻";

                                break;

                        }

                        echo "卖家要求威客买号等级在".$dj;

                    ;?>"  class="BuyerJifen" lang="<?php echo $item->BuyerJifen;?>" src="<?php if($item->platform!=2) { echo VERSION2;?>img/level/<?php echo $item->BuyerJifen.".gif";} else { echo VERSION2;?>img/level/jd<?php echo $item->BuyerJifen.".png";} ?>" style="vertical-align: text-top;cursor:pointer;" />

                    <?php

                        }else{

                            echo "无要求";

                        }

                    ?>

                </div>

                <div class="allRw_pro">

                    <img src="<?php echo VERSION2;?>img/p<?php echo $item->taskCatalog==0?2:1;?>.jpg" alt="" title="<?php echo $item->taskCatalog==0?"普通任务":"来路搜索任务";?>" class="allRw_proImg" />

                    <div class="allRw_pros">

                        <div class="allRw_prosLis">

                            <div class="allRw_pro_intr clearfix">

                                <div class="allRw_pro1">

                                    掌柜：<span><?php echo XUtils::cutstr($item->ddlZGAccount,4)."***";?></span>

                                    <!--掌柜个人信息-->

                                    <?php

                                        $myinfo=User::model()->findByPk($item->publishid);

                                        //好评

                                        $hp=Appraise::model()->findAllByAttributes(array(

                                            'uid'=>$item->publishid,

                                            'status'=>2

                                        ));

                                        //中评

                                        $zp=Appraise::model()->findAllByAttributes(array(

                                            'uid'=>$item->publishid,

                                            'status'=>1

                                        ));

                                        //差评

                                        $cp=Appraise::model()->findAllByAttributes(array(

                                            'uid'=>$item->publishid,

                                            'status'=>0

                                        ));

                                        //被拉黑名单次数

                                        $countBlack=Myblackerlist::model()->findAllByAttributes(array(

                                            'blackerusername'=>$myinfo->Username

                                        ));

                                    ?>

                                    <div class="person-info">

                                      <ul style="padding-top: 15px;">

                                          <li class="xf_name" title="经验值越高，代表会员越熟悉任务流程">经验：<b><?php echo $myinfo->Experience;?></b><span>好评率：<b><?php

                                            if((count($hp)+count($zp)+count($cp))==0)

                                                echo "100%";

                                            else  if((count($zp)+count($cp))==0)

                                            {

                                                echo "100%";

                                            }

                                            else

                                                echo (count($hp)/(count($zp)+count($cp)))."%";

                                          ?></b></span></li>

                                          <!--<li class="xf_hzc"><span class="hp">好评：<b><?php echo count($hp);?></b></span><span class="zp">中评：<b><?php echo count($zp);?></b></span><span class="cp">差评：<b><?php echo count($cp);?></b></span></li>-->

                                          <li class="xf_hmd">已被<b><?php echo count($countBlack);?></b>人加入黑名单<a class="jh_btn button border-blue jrhmd" href="<?php echo $this->createUrl('user/userBlackAccountList');?>" target="_blank">加入黑名单</a></li>

                                      </ul>

                                  </div>

                                </div>

                                <ul class="othallRw_pro clearfix">

                                    <li title="在拍下商品并支付后，<?php echo $item->ddlOKDay*24==0?"立即":"在".($item->ddlOKDay*24)."小时后";?>且物流信息显示已签收后确认收货五星好评！">

                                        收货时长： 

                                        <span>

                                            <?php echo $item->ddlOKDay*24==0?"立即":($item->ddlOKDay*24)."小时立即";?>

                                        </span>

                                        五星好评

                                    </li>

                                    <li title="平台担保：此任务卖家已缴纳全额担保存款，接手可放心购买，任务完成后，买家平台账号自动获得相应存款">

                                        任务金额： <span><?php echo $item->txtPrice;?></span>元

                                    </li>

                                    <li title="完成任务后，您能获得的任务奖励，可兑换成RMB">

                                    悬赏金币： <span><?php echo $item->MinLi;?></span>个

                                    </li>

                                </ul>

                            </div>

                            <div class="allRw_proLink">

                                <?php

                                    if($item->cbxIsSB)

                                        echo '<a style="border-color:red; color:red;" title="卖家要求接手加入商保">商保</a>';

                                    if($item->isLimitCity)

                                        echo '<a style="border-color:red; color:red;" title="卖家要求接手所在地区为'.$item->Province.'">'.$item->Province.'</a>';

                                    if($item->isMobile)

                                        echo '<a style="border-color:red; color:red;" title="卖家要求接手使用手机接单">手机</a>';

                                    if($item->isSign)

                                        echo '<a style="border-color:red; color:red;" title="卖家要求接手真实签收货物">真签</a>';

                                    if($item->cbxIsAudit)

                                        echo '<a style="background: #FF0000;color:#fff;" title="接任务者需要发布者审核买号资料">审核</a>'; 

                                    if($item->isReal)

                                        echo '<a style="background: #FF1493;color:#fff;" title="接手买号必须通过支付宝实名认证">实名</a>';

                                    if($item->cbxIsWW)

                                        echo '<a style="background: #32CD32;color:#fff;" title="任务需要模拟咨询再拍下">客服聊天</a>';

                                    if($item->stopDsTime)

                                        echo '<a style="background: #2E8B57;color:#fff;" title="购买前需要停留1-5分钟，接手后可查看">停留</a>';

                                    if($item->cbxIsLHS)

                                        echo '<a style="background: #00BFFF;color:#fff;" title="确认收货时在旺旺与商家确认，如已收到货，下次还会再来等语句">旺收</a>';

                                    if($item->cbxIsMsg)

                                        echo '<a style="background: #4169E1;color:#fff;" title="按发布者要求的评语进行评价">评语</a>';

                                    if($item->shopcoller)

                                    {

                                        $itemImg=$item->taskerSCImg!=""?$item->taskerSCImg:"";

                                        echo '<a style="background: #FF6347;color:#fff;" class="bueryImg" alt="'.$itemImg.'" title="收藏发布者店铺和宝贝" >收藏</a>';

                                    }

                                    if($item->isViewEnd)

                                    {

                                        $itemImg=$item->taskerBottomImg!=""?$item->taskerBottomImg:"";

                                        echo '<a style="background: #FFA500;color:#fff;" class="bueryImg" alt="'.$itemImg.'" title="按任务者需要上传商品底部截图">底图</a>';

                                    }

                                ?>

								<?php

                                    if($item->isGaijia){//改价

                                ?>

                                <a class="bueryImg" lang="" title="商家改价后再行付款">

                                    改价

                                </a>

                                <?php }?>

                                <?php

                                    if($item->isCompare){

                                ?>

                                <a style="background: #FF6347;color:#fff;" class="bueryImg" alt="<?php echo $item->taskerOtheroneImg!=""?$item->taskerOtheroneImg:"";?>" title="接任务者需要根据任务提示上传货比<?php echo $item->contrast;?>家截图">

                                    货比<?php echo $item->contrast;?>家

                                </a>

                                <?php }?>

                                

                                <?php

                                    if($item->shopBrGoods){

                                ?>

                                <a style="background: #7B68EE;color:#fff;" class="bueryImg" alt="<?php echo $item->taskerOtheroneImg!=""?$item->taskerOtheroneImg:"";?>" title="接任务者需要根据任务提示浏览店内其他<?php echo $item->lgoods;?>件商品并截图">

                                    浏览商品

                                </a>

                                <?php }?>

                                

                                <?php

                                    if($item->pinimage){

                                ?>

                                <a style="background: #8A2BE2;color:#fff;" class="bueryImg" alt="<?php echo $item->taskerHPingImg!=""?$item->taskerHPingImg:"";?>" title="接任务者需要根据任务提示上传好评截图">好评截图</a>

                                <?php }?>

                                <?php

                                if($item->txtRemind){

                                    ?>

                                    <p style=" font-size:15px; height:25px; line-height: 25px; color:red; overflow: hidden;" title="<?php echo $item->txtRemind;?>">商家提醒：<?php echo $item->txtRemind!=""?$item->txtRemind:"请按要求完成任务";?></p>

                                <?php }?>

                            </div>

                        </div>

                    </div>

                    <a href="javascript:;" class="qcrw taskTask" lang="<?php echo $item->id;?>" alt="<?php echo $item->publishid;?>" platform="<?php echo $item->platform;?>">抢此任务</a>

                </div>

            </li>

            <?php }?>

        </ul>

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

    </div><!--大厅任务 end-->

    <!--layer插件-->

    <script src="<?php echo ASSET_URL;?>layer/jquery.min.js"></script>

    <script src="<?php echo ASSET_URL;?>layer/layer.js"></script>

    <script src="<?php echo ASSET_URL;?>layer/laycode.min.js"></script>

    <link href="<?php echo ASSET_URL;?>layer/layer.css" rel="stylesheet" type="text/css" />

    <script>

        $(function(){

            //选手抢任务

            $(".taskTask").click(function(){

                var platform=$(this).attr("platform");//所属平台

                var taskid=$(this).attr("lang");//任务id

            

                if($(this).attr("alt")==<?php echo Yii::app()->user->getId()==true?Yii::app()->user->getId():"'noLogin'";?>)

                {

                    //询问框

                	layer.confirm('您不能接自己的任务', {

                		btn: ['确定'] //按钮

                	});

                }

                else{

                    $.ajax({

            			type:"POST",

            			url:"<?php echo $this->createUrl('site/takeTask');?>",

            			data:"checkBase=DOIT&platform="+platform,

            			success:function(msg)

            			{

            				if(msg=="GUEST")//没有登录，提示登录

                            {

                                //询问框

                            	layer.confirm('您还没有登录，请先登录', {

                            		btn: ['立即登录'] //按钮

                            	}, function(){

                            		window.location.href="<?php echo $this->createUrl('passport/login');?>";

                            	});

                            }else if(msg=="NOBUYSER")//没有绑定买号，去绑定

                            {

                                //询问框

                            	layer.confirm('您还没有符合条件的买号，去绑定吗？', {

                            		btn: ['确定','取消'] //按钮

                            	}, function(){

                            		window.location.href="<?php echo $this->createUrl('user/taobaoBindBuyer');?>";

                            	});

                            }

                            else//相应买号供选择并且去绑定且返回绑定结果

                            {

                                //询问框

                            	layer.confirm(msg, {

                            		btn: ['确定','取消'] //按钮

                            	}, function(){//任务绑定接手选择的旺旺

                            	    $.ajax({

                            			type:"POST",

                            			url:"<?php echo $this->createUrl('site/takeTask');?>",

                            			data:{"taskerWangwang":$('input:radio[name="buyerSelected"]:checked').val(),"taskid":taskid},

                            			success:function(msg)

                            			{

                            				if(msg=="SUCCESS")//绑定成功

                                            {

                                                //询问框

                                            	layer.confirm('<span style="color:red;">您已经成功绑定了买号，如果您已经在淘宝上给对方支付了金额，请务必在平台的30分钟读秒完成前点击【等待您对商品付款】，否则将可能损失在淘宝上支付给对方的金额</span>', {

                                            		btn: ['我知道了，去查看任务'] //按钮

                                            	}, function(){

                                            		window.location.href="<?php echo $this->createUrl('user/taobaoInTask');?>";

                                            	});

                                            }else if(msg=="NOJoinProtectPlan"){//没有加入商保

                                                //询问框

                                            	layer.confirm('<span style="color:red;">该任务要求接手加入商保，您还没有加入商保</span>', {

                                            		btn: ['现在去加入商保','知道了'] //按钮

                                            	},function(){

                                            	   location.href="<?php echo $this->createUrl('user/userSBcenter');?>";

                                            	});

                                            }else if(msg=="NOBuyerJifen"){//等级不符合要求

                                                layer.confirm('<span style="color:red;">您选择的买号等级没有达到该任务的要求</span>', {

                                            		btn: ['知道了'] //按钮

                                            	});

                                            }else if(msg=="NOProvince"){//不符合任务的区域要求

                                                layer.confirm('<span style="color:red;">您所在的区域不符合该任务的区域要求</span>', {

                                            		btn: ['知道了'] //按钮

                                            	});

                                            }else if(msg=="INBlack"){

                                                layer.confirm('<span style="color:red;">你在该商家的黑名单中，无法接其任务</span>', {

                                            		btn: ['知道了'] //按钮

                                            	});

                                            }else if(msg=="TASKSTOP")//任务被商家暂停

                                            {

                                                //询问框

                                            	layer.confirm('亲，此任务刚被商家暂停，抢接它任务吧', {

                                            		btn: ['确定'] //按钮

                                            	},function(){

                                            	   location.reload();//重新刷新当前页面

                                            	});

                                            }

                                            else if(msg=="MAXNUM")//任务限制接手任务数量

                                            {

                                                //询问框

                                            	layer.confirm('您的当天或本周接任务的数量不符合商家的要求', {

                                            		btn: ['确定'] //按钮

                                            	},function(){

                                            	   location.reload();//重新刷新当前页面

                                            	});

                                            }

                                            else//绑定失败

                                            {

                                                //询问框

                                            	layer.confirm('买号绑定失败，请联系客服人员', {

                                            		btn: ['确定'] //按钮

                                            	});

                                            }

                            			}

                            		});

                            	});

                            }

            			}

            		});

                }

            });

        })

    </script>

    <script>

        $(function(){

            //垫付或者远程单提示

            $(".payWay").click(function(){

                if($(this).attr("lang")==1)

                {

                    layer.confirm('此任务为<a href="javascript:;" style="color:red;">全程垫付</a>，等任务结束后垫付金额与佣金将到达您的帐户中。<a href="javascript:;" style="color:red;">[全程垫付详情介绍]</a>', {

                    	btn: ['知道了'] //按钮

                    });

                }

                 

                if($(this).attr("lang")==2)

                {

                    layer.confirm('此任务为<a href="javascript:;" style="color:red;">远程单</a>，等任务结束佣金将到达您的帐户。<a href="javascript:;" style="color:red;">[平台详情介绍]</a>', {

                    	btn: ['知道了'] //按钮

                    });

                }

            });

            

            //所属平台提示

            $(".platform").click(function(){

                if($(this).attr("lang")==1)

                {

                    layer.confirm('此任务为<a href="javascript:;" style="color:red;">淘宝任务</a>', {

                    	btn: ['知道了'] //按钮

                    });

                }

                 

                if($(this).attr("lang")==2)

                {

                    layer.confirm('此任务为<a href="javascript:;" style="color:red;">京东任务</a>', {

                    	btn: ['知道了'] //按钮

                    });

                }

                 

                if($(this).attr("lang")==3)

                {

                    layer.confirm('此任务为<a href="javascript:;" style="color:red;">阿里巴巴任务</a>', {

                    	btn: ['知道了'] //按钮

                    });

                }

            });

            

            //接手等级要求提示

            $(".BuyerJifen").click(function(){

                var dj;

                switch(parseInt($(this).attr("lang")))

                {

                    case 1:

                        dj="一心";

                        break;

                    case 2:

                        dj="二心";

                        break;

                    case 3:

                        dj="三心";

                        break;

                    case 4:

                        dj="四心";

                        break;

                    case 5:

                        dj="五心";

                        break;

                    case 6:

                        dj="一钻";

                        break;

                    case 7:

                        dj="二钻";

                        break;

                    case 8:

                        dj="三钻";

                        break;

                    case 9:

                        dj="四钻";

                        break;

                    default:

                        dj="五钻";

                        break;

                }

                layer.confirm('此任务对威客帐号等级要求为：<a href="javascript:;" style="color:red;">'+dj+'以上</a>', {

                	btn: ['知道了'] //按钮

                });

            });

        })

    </script>

