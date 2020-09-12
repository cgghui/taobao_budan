        <style>
            .setInside{ width:95%; height:auto; margin:20px auto;}
            .d_biaoti{ height:auto; padding-top:10px;}
            .registerform input{ width:230px; height:30px; border: 1px dashed #99C1F5;}
            table tr{ height:35px; line-height: 35px;}
        </style>
        <!--第一次设置安全码-->
        <div class="d_qie8">
            <ul class="d_zhannei clearfix">
            	<li class="d_znli">设置安全操作码</li>
            </ul>
            <div class="d_biaoti clearfix">
                <div class="setInside">
                    <span style="color: red; line-height: 40px;">为您帐号安全，请设置您的操作安全码</span>
           	        <form class="registerform" method="post" action="<?php echo $this->createUrl('user/userSafePwdFirstSet');?>">
                        <table>
                            <input type="hidden" name="setSafePwd" value="Done" />
                            <tr>
                              <td><input type="password" style="text-indent: 10px;" name="safePwd" placeholder="输入安全码" class="inputxt zhuceItem" plugin="passwordStrength" datatype="*" errormsg="请输入安全码" nullmsg="请输入安全码"></td>
                              <td><div class="Validform_checktip">请输入会员密码</div></td>
                            </tr>
                            <tr style="line-height: 18px;">
                                <td><div class="passwordStrength" style="position: relative; left: 40px;"><span>弱</span><span>中</span><span class="last">强</span></div></td>
                                <td></td>
                            </tr>
                            <tr>
                              <td><input type="password" style="text-indent: 10px;" name="safePwdagain" placeholder="确认安全码"  class="regInput inputxt zhuceItem" datatype="*" recheck="safePwd" nullmsg="请再次输入安全码" errormsg="您两次输入的安全码不一致。" /></td>
                              <td><div class="Validform_checktip">请再次输入安全</div></td>
                            </tr>
                            <tr>
                              <td colspan="2"><input type="submit" style="border-radius:5px; cursor: pointer; height:35px; line-height:35px; color:#fff; background:#57A0FF; margin-top:10px;" value="确认提交" /></td>
                            </tr>
                            <tr>
                        </table> 
                    </form>
                </div>
            </div>
            <div class="clear"></div>
        </div>
<!--第一次设置安全码-->
<link rel="stylesheet" href="<?php echo ASSET_URL;?>Validform/css/style.css" type="text/css" media="all" />
<script type="text/javascript" src="<?php echo ASSET_URL;?>Validform/js/Validform_v5.3.2_min.js"></script>
<script type="text/javascript" src="<?php echo ASSET_URL;?>Validform/plugin/passwordStrength/passwordStrength-min.js"></script>
<script type="text/javascript">
$(function(){
    $(".registerform").Validform({
		tiptype:2,    
        usePlugin:{
			passwordstrength:{
				minLen:6,
				maxLen:20
			}
		}
	});
    
})
    
</script>