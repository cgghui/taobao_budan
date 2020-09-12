            <!-- start: Main Menu -->
            <div class="sidebar ">
								
				<div class="sidebar-collapse">
					<p style="text-align: center;font-family: verdana; text-align: center; padding: 15px 0 0 0; color: #343434; font-weight: 800; font-size: 24px; text-shadow: 0px 1px 1px #464646, 0px -1px 1px #1b1b1b;">
                            <strong>YUUMAA</strong>
                    </p>									
					<div class="sidebar-menu">						
						<ul class="nav nav-sidebar">
                            <li><a href="<?php  echo $this->createUrl('/site/index');?>" target="_blank"><i class="fa fa-laptop"></i><span class="text"> 平台首页</span></a></li>
							<li><a href="<?php  echo $this->createUrl('default/index');?>"><i class="fa fa-laptop"></i><span class="text"> 后台首页</span></a></li>
							<li>
								<a href="javascript:;"><i class="fa fa-file-text"></i><span class="text"> 文档管理系统</span> <span class="fa fa-angle-down pull-right"></span></a>
								<ul class="nav sub" <?php echo Yii::app()->controller->id=="article"?"style='display:block;'":"";?>>
                                    <li <?php echo $this->getAction()->getId()=="articleCatlogAdd" || $this->getAction()->getId()=="articleCatlogAddMore"?"class='active opened'":"";?>><a href="<?php echo $this->createUrl('article/articleCatlogAdd');?>"><i class="fa fa-car"></i><span class="text"> 添加栏目</span></a></li>
									<li <?php echo $this->getAction()->getId()=="articlecatalog"?"class='active opened'":"";?>><a href="<?php echo $this->createUrl('article/articlecatalog');?>"><i class="fa fa-car"></i><span class="text"> 文档栏目管理</span></a></li>
									<li <?php echo $this->getAction()->getId()=="articleList" || $this->getAction()->getId()=="articleEdit" || $this->getAction()->getId()=="articleDyEdit"?"class='active opened'":"";?>><a href="<?php echo $this->createUrl('article/articleList');?>"><i class="fa fa-envelope"></i><span class="text"> 文档列表</span></a></li>
									<li <?php echo $this->getAction()->getId()=="articleAdd" || $this->getAction()->getId()=="articleDyAdd"?"class='active opened'":"";?>><a href="<?php echo $this->createUrl('article/articleAdd');?>"><i class="fa fa-credit-card"></i><span class="text"> 添加文档</span></a></li>						
									<li <?php echo $this->getAction()->getId()=="articleReserverList"?"class='active opened'":"";?>><a href="<?php echo $this->createUrl('article/articleReserverList');?>"><i class="fa fa-heart-o"></i><span class="text"> 文档回收站</span></a></li>
								</ul>	
							</li>
							<li>
								<a href="javascript:;"><i class="fa fa-list-alt"></i><span class="text"> 用户充值、提现</span> <span class="fa fa-angle-down pull-right"></span></a>
								<ul class="nav sub" <?php echo Yii::app()->controller->id=="moneyman"?"style='display:block;'":"";?>>
									<li <?php echo $this->getAction()->getId()=="moneylist"?"class='active opened'":"";?>><a href="<?php echo $this->createUrl('moneyman/moneylist');?>"><i class="fa fa-tags"></i><span class="text"> 用户充值中心</span></a></li>
									<li <?php echo $this->getAction()->getId()=="txlist"?"class='active opened'":"";?>><a href="<?php echo $this->createUrl('moneyman/txlist');?>"><i class="fa fa-plus-square-o"></i><span class="text"> 用户提现管理</span></a></li>
								    <li <?php echo $this->getAction()->getId()=="finance"?"class='active opened'":"";?>><a href="<?php echo $this->createUrl('moneyman/finance');?>"><i class="fa fa-plus-square-o"></i><span class="text"> 财务报表</span></a></li>
								</ul>
							</li>
							<li>
								<a href="javascript:;"><i class="fa fa-signal"></i><span class="text"> 会员管理中心</span> <span class="fa fa-angle-down pull-right"></span></a>
								<ul class="nav sub" <?php echo Yii::app()->controller->id=="membercenter"?"style='display:block;'":"";?>>
                                    <li <?php echo in_array($this->getAction()->getId(),array("memberlist","membeDetailInfos"))?"class='active opened'":"";?>><a href="<?php echo $this->createUrl('membercenter/memberlist');?>"><i class="fa fa-random"></i><span class="text"> 会员管理</span></a></li>
                                    <li <?php echo in_array($this->getAction()->getId(),array("authperson"))?"class='active opened'":"";?>><a href="<?php echo $this->createUrl('membercenter/authperson');?>"><i class="fa fa-random"></i><span class="text">  威客实名认证审核</span></a></li>
                                    <li <?php echo in_array($this->getAction()->getId(),array("buyerlist"))?"class='active opened'":"";?>><a href="<?php echo $this->createUrl('membercenter/buyerlist');?>"><i class="fa fa-random"></i><span class="text">  买号管理</span></a></li>
                                    <li <?php echo in_array($this->getAction()->getId(),array("sellerlist"))?"class='active opened'":"";?>><a href="<?php echo $this->createUrl('membercenter/sellerlist');?>"><i class="fa fa-random"></i><span class="text">  掌柜号管理</span></a></li>
								</ul>
							</li>
                            <li>
								<a href="javascript:;"><i class="fa fa-briefcase"></i><span class="text"> 任务管理中心</span> <span class="fa fa-angle-down pull-right"></span></a>
								<ul class="nav sub" <?php echo Yii::app()->controller->id=="taskcenter"?"style='display:block;'":"";?>>
									<li <?php echo $this->getAction()->getId()=="tasklist"?"class='active opened'":"";?>><a href="<?php echo $this->createUrl('taskcenter/tasklist');?>"><i class="fa fa-list"></i><span class="text">平台任务总览</span></a></li>
								</ul>
							</li>
                            <li>
								<a href="javascript:;"><i class="fa fa-briefcase"></i><span class="text"> 投诉管理中心</span> <span class="fa fa-angle-down pull-right"></span></a>
								<ul class="nav sub" <?php echo Yii::app()->controller->id=="compliancenter"?"style='display:block;'":"";?>>
									<li <?php echo $this->getAction()->getId()=="complianlist"?"class='active opened'":"";?>><a href="<?php echo $this->createUrl('compliancenter/complianlist');?>"><i class="fa fa-list"></i><span class="text">任务投诉总览</span></a></li>
								</ul>
							</li>
                            <li>
								<a href="javascript:;"><i class="fa fa-bolt"></i><span class="text"> 平台配置管理</span> <span class="fa fa-angle-down pull-right"></span></a>
								<ul class="nav sub" <?php echo Yii::app()->controller->id=="system"?"style='display:block;'":"";?>>
                                    <li <?php echo $this->getAction()->getId()=="exam"?"class='active opened'":"";?>><a href="<?php echo $this->createUrl('system/exam');?>"><i class="fa fa-meh-o"></i><span class="text"> 新手考试管理</span></a></li>
									<li <?php echo $this->getAction()->getId()=="blackaccount"?"class='active opened'":"";?>><a href="<?php echo $this->createUrl('system/blackaccount');?>"><i class="fa fa-meh-o"></i><span class="text"> 黑名单管理</span></a></li>
                                    <li <?php echo $this->getAction()->getId()=="baseset"?"class='active opened'":"";?>><a href="<?php echo $this->createUrl('system/baseset');?>"><i class="fa fa-meh-o"></i><span class="text"> 系统基本参数</span></a></li>
								</ul>
							</li>
							<li>
								<a href="javascript:;"><i class="fa fa-briefcase"></i><span class="text"> 管理员中心</span> <span class="fa fa-angle-down pull-right"></span></a>
								<ul class="nav sub" <?php echo Yii::app()->controller->id=="acl"?"style='display:block;'":"";?>>
									<li <?php echo $this->getAction()->getId()=="manageradd"?"class='active opened'":"";?>><a href="<?php echo $this->createUrl('acl/manageradd');?>"><i class="fa fa-list"></i><span class="text"> 添加管理员</span></a></li>
                                    <li <?php echo $this->getAction()->getId()=="managerlist" || $this->getAction()->getId()=="managerinfochange"?"class='active opened'":"";?>><a href="<?php echo $this->createUrl('acl/managerlist');?>"><i class="fa fa-align-left"></i><span class="text"> 管理员列表</span></a></li>
                                    <li <?php echo $this->getAction()->getId()=="aclmanager"?"class='active opened'":"";?>><a href="<?php echo $this->createUrl('acl/aclmanager');?>"><i class="fa fa-list"></i><span class="text"> 添加用户组</span></a></li>
									<li <?php echo $this->getAction()->getId()=="aclgrouplist" || $this->getAction()->getId()=="aclgroupeditpower"?"class='active opened'":"";?>><a href="<?php echo $this->createUrl('acl/aclgrouplist');?>"><i class="fa fa-outdent"></i><span class="text"> 用户组列表</span></a></li>
									<li <?php echo $this->getAction()->getId()=="acltranslate"?"class='active opened'":"";?>><a href="<?php echo $this->createUrl('acl/acltranslate');?>"><i class="fa fa-list-alt"></i><span class="text"> 用户组操作翻译</span></a></li>
								</ul>
							</li>
                            <li><a href="<?php echo $this->createUrl('default/loginout');?>"><i class="fa fa-calendar"></i><span class="text"> 退出系统</span></a></li>
							<li><a href="<?=SITE_URL?>" target="_blank"><i class="fa fa-picture-o"></i><span class="text"> 官方网站</span></a></li>
						</ul>
					</div>					
				</div>
				<div class="sidebar-footer">					
					
					<div class="sidebar-brand">
						YUUMAA
					</div>
					
					<ul class="sidebar-terms">
						<li><a href="<?=SITE_URL?>" target="_blank">关于</a></li>
                        <li><a href="<?=SITE_URL?>" target="_blank">购买</a></li>
						<li><a href="<?=SITE_URL?>" target="_blank">帮助</a></li>
                        <li><a href="<?=SITE_URL?>" target="_blank">联系</a></li>
					</ul>
					
					<div class="copyright text-center">
						<small>SUPPORT <i class="fa fa-coffee"></i> <a href="<?=SITE_URL?>" title="www.dev.com" target="_blank">DEV.CN</a></small>
					</div>					
				</div>	
				
			</div>
            <!-- start: Main end -->
            <script src="<?php echo VERSION2;?>js/jquery.js"></script>
            <!--layer插件-->
            <!--<script src="http://libs.baidu.com/jquery/1.9.1/jquery.min.js"></script>
            <script src="http://res.layui.com/lay/lib/layer/layer.js"></script>
            <script src="http://res.layui.com/lay/lib/laycode/laycode.min.js"></script>-->
            <script>
                $(function(){
                    $(".panel-actions").find(".btn-default").click(function(){
                        location.reload();
                        //layer.msg('页面重新加载中...', {icon: 16});
                    });
                })
            </script>