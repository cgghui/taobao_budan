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
                        <td>详细信息</td>
                        <td>ip地址</td>
                        <td>登录时间</td>
                    </tr>
                    <?php
                        foreach($proInfo as $item){
                            $userInfo=User::model()->findByPk($item->userid);
                    ?>
                    <tr style="border-bottom: 1px dashed #57A0FF;">
                        <td><?php echo $item->id;?></td>
                        <td><?php echo $item->username;?>使用账号登陆网站|<?php echo $userInfo->PlaceOtherLogin==0?"<span style='color:red;'>未开启异地登录</span>":"<span style='color:green;'>已开启异地登录</span>";?>|<?php echo $item->loginplace;?></td>
                        <td><?php echo $item->loginip;?></td>
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