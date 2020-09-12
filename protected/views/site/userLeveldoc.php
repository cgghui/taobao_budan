    <!--等级权限-->

    <div class="d_dj">

    	<div class="d_djbg">

        	<div class="d_djcon">

            	<a class="d_vip1" href="#">金币网VIP</a>

                <a class="d_vip2" href="#">申请VIP</a>

            </div>

        </div>

        <?php

        

            $backMinLiPriceVIP0=System::model()->findByAttributes(array("varname"=>"backMinLiPriceVIP0"));

            $backMinLiPriceVIP1=System::model()->findByAttributes(array("varname"=>"backMinLiPriceVIP1"));

            $backMinLiPriceVIP2=System::model()->findByAttributes(array("varname"=>"backMinLiPriceVIP2"));

            $backMinLiPriceVIP3=System::model()->findByAttributes(array("varname"=>"backMinLiPriceVIP3"));

        ?>

        <div class="d_djhy">

        	<div class="d_djhycon">

            	<table style="width:100%;">

                	<tr>

                    	<th class="d_thjh">等级</th>

                        <th class="d_thwidth">普通会员</th>

                        <th class="d_thwidth">一级VIP</th>

                        <th class="d_thwidth">二级VIP</th>

                        <th class="d_thwidth">三级VIP</th>

                    </tr>

                    <tr>

                    	<td class="first">图标</td>

                        <td>无</td>

                        <td class="d_djcolor"><img src="<?php echo VERSION2;?>img/vip.gif" /></td>

                        <td class="d_djcolor"><img src="<?php echo VERSION2;?>img/vip2.gif" /></td>

                        <td class="d_djcolor"><img src="<?php echo VERSION2;?>img/vip3.gif" /></td>

                    </tr>

                    <tr>

                    	<td class="first">任务排名靠前</td>

                        <td>无</td>

                        <td class="d_djcolor">是</td>

                        <td class="d_djcolor">是</td>

                        <td class="d_djcolor">是</td>

                    </tr>

                     <tr>

                    	<td class="first">提现优先处理</td>

                        <td>无</td>

                        <td class="d_djcolor">是</td>

                        <td class="d_djcolor">是</td>

                        <td class="d_djcolor">是</td>

                    </tr>

                    <tr>

                    	<td class="first">金币回收价格</td>

                        <td><?php echo $backMinLiPriceVIP0->value;?>元</td>

                        <td class="d_djcolor"><?php echo $backMinLiPriceVIP1->value;?>元</td>

                        <td class="d_djcolor"><?php echo $backMinLiPriceVIP2->value;?>元</td>

                        <td class="d_djcolor"><?php echo $backMinLiPriceVIP3->value;?>元</td>

                    </tr>

                    <?php

                        $taskMinliToPlatform=System::model()->findByAttributes(array("varname"=>"taskMinliToPlatform"));

                        $taskMinliToPlatformVIP1=System::model()->findByAttributes(array("varname"=>"taskMinliToPlatformVIP1"));

                        $taskMinliToPlatformVIP2=System::model()->findByAttributes(array("varname"=>"taskMinliToPlatformVIP2"));

                        $taskMinliToPlatformVIP3=System::model()->findByAttributes(array("varname"=>"taskMinliToPlatformVIP3"));

                    ?>

                    <tr>

                    	<td class="first">任务消耗金币比例</td>

                        <td><?php echo $taskMinliToPlatform->value;?>%</td>

                        <td class="d_djcolor"><?php echo $taskMinliToPlatformVIP1->value;?>%</td>

                        <td class="d_djcolor"><?php echo $taskMinliToPlatformVIP2->value;?>%</td>

                        <td class="d_djcolor"><?php echo $taskMinliToPlatformVIP3->value;?>%</td>

                    </tr>

                    <?php

                        $VIP1price1month=System::model()->findByAttributes(array("varname"=>"VIP1price1month"));

                        $VIP1price3month=System::model()->findByAttributes(array("varname"=>"VIP1price3month"));

                        $VIP1price6month=System::model()->findByAttributes(array("varname"=>"VIP1price6month"));

                        $VIP1price12month=System::model()->findByAttributes(array("varname"=>"VIP1price12month"));

                        

                        $VIP2price1month=System::model()->findByAttributes(array("varname"=>"VIP2price1month"));

                        $VIP2price3month=System::model()->findByAttributes(array("varname"=>"VIP2price3month"));

                        $VIP2price6month=System::model()->findByAttributes(array("varname"=>"VIP2price6month"));

                        $VIP2price12month=System::model()->findByAttributes(array("varname"=>"VIP2price12month"));

                        

                        $VIP3price1month=System::model()->findByAttributes(array("varname"=>"VIP3price1month"));

                        $VIP3price3month=System::model()->findByAttributes(array("varname"=>"VIP3price3month"));

                        $VIP3price6month=System::model()->findByAttributes(array("varname"=>"VIP3price6month"));

                        $VIP3price12month=System::model()->findByAttributes(array("varname"=>"VIP3price12month"));

                    ?>

                     <tr>

                    	<td class="first">费用</td>

                        <td>无</td>

                        <td class="d_djcolor">

                            一个月:<?php echo $VIP1price1month->value;?>元<br />

                            三个月:<?php echo $VIP1price3month->value;?>元<br />

                            半年:<?php echo $VIP1price6month->value;?>元<br />

                            一年:<?php echo $VIP1price12month->value;?>元<br />

                        </td>

                        <td class="d_djcolor">

                            一个月:<?php echo $VIP2price1month->value;?>元<br />

                            三个月:<?php echo $VIP2price3month->value;?>元<br />

                            半年:<?php echo $VIP2price6month->value;?>元<br />

                            一年:<?php echo $VIP2price12month->value;?>元<br />

                        </td>

                        <td class="d_djcolor">

                            一个月:<?php echo $VIP3price1month->value;?>元<br />

                            三个月:<?php echo $VIP3price3month->value;?>元<br />

                            半年:<?php echo $VIP3price6month->value;?>元<br />

                            一年:<?php echo $VIP3price12month->value;?>元<br />

                        </td>

                    </tr>

                </table>

            </div>

        </div>

    </div>

    <!--等级权限-->