        <style>

            .bankItem{ width:146px; height:46px; margin:0 auto; position: relative; cursor: pointer;}

            span.bankItem{ width:auto; border:none;}

            .bankDel{ position:absolute; width:auto; color:red; left:0; bottom:0; font-size:14px; font-weight:bold; cursor: pointer;}

            .bankCount{ position: absolute; width:auto; height:18px; line-height:18px; left:10; bottom:0; color:red; font-size:12px;}

            .selectBank{ position: absolute; width:auto; right:0; bottom:0; display: none;}

            .bankItemSelect{ border-color:#3792c6;}

            .certainMoney{ margin-top: 15px;}

            .sendTxMoney{ width:147px; height:45px; line-height:45px; border: 1px solid #ee3333; text-align: center; border-radius: 5px; margin:20px 90px; cursor: pointer;}

            .sendTxMoney a{ color:#ee3333; display: block;}

            .sendTxMoney a:hover{ background:#ff0000; color:#fff;}

            .addNewBank{ width:60px; float:left; cursor: pointer;}

            .bankItemBefore{ width:auto; height:56px; float:left; margin-right:10px;}

        </style>

        <?php

            echo $this->renderPartial('/user/usercenterTopNav')

        ?>

        <div class="d_qie2">

            <?php echo $this->renderPartial('/user/userPayDetailNav');?>

            <div class="d_n" style="padding-bottom: 10px;">

                <table style="width: 100%; text-align: center; color:#666; font-size:12px; line-height:55px; margin-top:20px;">

                    <tr style="background: #57A0FF; color:#fff; height:40px; line-height:40px;">

                        <td>序列号</td>

                        <td>说明</td>

                        <td>数量及单位</td>

                        <td>状态</td>

                        <td>时间</td>

                    </tr>

                    <?php

                        foreach($proInfo as $item){

                    ?>

                    <tr style="border-bottom: 1px dashed #57A0FF;">

                        <td><?php echo $item->id;?></td>

                        <td>

                            <?php

                                switch($item->catalog)

                                {

                                    case 3:

                                        echo '发布任务使用的金额';

                                        break;

                                    case 4:

                                        echo '发布任务使用的金币';

                                        break;

                                    case 5:

                                        echo '接任务获得的金额';

                                        break;

                                    case 6:

                                        echo '接手任务获得的金币';

                                        break;

									case 16:

                                        echo '删除任务退回的金额';

                                        break;

                                    case 17:

                                        echo '删除任务退回金币';

                                        break;

                                    case 13:

                                        echo '发布任务使用的短信费用';

                                        break;

									case 14:

                                        echo '商家在投诉中获胜退回的金额';

                                        break;

                                    case 15:

                                        echo '商家在投诉中获胜退回的金币';

                                        break;

                                }

                            ?>

                        </td>

                        <td style="color: #F60; font-size:16px;">

                            <?php echo $item->number;?>

                            <?php

                                switch($item->catalog)

                                {

                                    case 3:

                                        echo '元';

                                        break;

                                    case 4:

                                        echo '个';

                                        break;

                                    case 5:

                                        echo '元';

                                        break;

                                    case 6:

                                        echo '个';

                                        break;

									case 16:

                                        echo '元';

                                        break;

                                    case 17:

                                        echo '个';

                                        break;

                                    case 13:

                                        echo '元';

                                        break;

									case 14:

                                        echo '元';

                                        break;

                                    case 15:

                                        echo '个';

                                        break;

                                }

                                

                                if($item->catalog==6)

                                {

                                    $taskMinliToPlatform=System::model()->findByAttributes(array("varname"=>"taskMinliToPlatform"));

                                    echo "　消耗".$item->number*($taskMinliToPlatform->value/100)."个金币";

                                }

                            ?>

                        </td>

                        <td>

                            成功

                        </td>

                        <td><?php echo date('Y-m-d H:i:s',$item->time);?></td>

                    </tr>

                    <?php }?>

                </table>

            </div>

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