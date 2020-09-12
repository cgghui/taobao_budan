            <!--收支明细导航开始-->
            <div class="d_menu">
            	<ul>
                	<li <?php echo $this->getAction()->getId()=="userPayDetail"?"class='now'":"";?> onclick="window.location.href='<?php echo $this->createUrl('user/userPayDetail');?>'">
                    	充值
                    </li>
                    <li <?php echo $this->getAction()->getId()=="userPayDetailMinLi"?"class='now'":"";?> onclick="window.location.href='<?php echo $this->createUrl('user/userPayDetailMinLi');?>'">
                    	金币
                    </li>
                    <li <?php echo $this->getAction()->getId()=="userPayDetailTask"?"class='now'":"";?> onclick="window.location.href='<?php echo $this->createUrl('user/userPayDetailTask');?>'">
                    	任务
                    </li>
                    <li <?php echo $this->getAction()->getId()=="userPayDetailTX"?"class='now'":"";?> onclick="window.location.href='<?php echo $this->createUrl('user/userPayDetailTX');?>'">
                    	提现
                    </li>
                    <li <?php echo $this->getAction()->getId()=="userLoginDetail"?"class='now'":"";?> onclick="window.location.href='<?php echo $this->createUrl('user/userLoginDetail');?>'">
                    	登录
                    </li>
					<li <?php echo $this->getAction()->getId()=="userSpreadDetail"?"class='now'":"";?> onclick="window.location.href='<?php echo $this->createUrl('user/userSpreadDetail');?>'">
                    	推广提成
                    </li>
                </ul>
            </div>
            <!--收支明细导航结束-->