<?php

class PassportController extends Controller
{       
    public function filters()
    {
        return array(
            'accessControl',
        );
    }
    
    public function accessRules()
    {
        return array(
                array('allow',  // 允许所有用户访问 'login' 动作.
                        'users'=>array('*'),
                ),
                array('allow', // 允许认证用户访问所有动作
                        'users'=>array('@'),
                ),
                array('deny',  // 拒绝所有的用户。
                        'users'=>array('*'),
                ),
        );
    }
    
    /*
        用户忘记密码-发送短信前检测号码是否存在
    */
    public function actionCheckPhoneExist()
    {
        if(isset($_POST['phone']) && $_POST['phone']!="")
        {
            $userinfo=User::model()->findByAttributes(array('Phon'=>$_POST['phone']));
            if($userinfo)
            {
                echo "SUCCESS";
            }
            else//手机号码不存在
            {
                echo "FAIL";
            }
        }
    }
    
    /*
        用户忘记密码-找回密码
    */
    public function actionForgetPwd()
    {
        if(isset($_POST['phone']) && $_POST['phone']!="" && isset($_POST['newpwd']) && $_POST['newpwd']!="")
        {
            $userinfo=User::model()->findByAttributes(array('Phon'=>$_POST['phone']));
            if($userinfo)
            {
                $userinfo->PassWord=md5($_POST['newpwd']);//新密码
                if($userinfo->save())
                    echo "SUCCESS";
                else
                    echo "FAIL";
            }
            else//手机号码不存在
            {
                echo "PHONENOTEXIST";
            }
            Yii::app()->end();
        }
        $this->renderPartial('forgetPwd');
    }
    
    /*用户注册模块*/
	public function actionRegist()
	{
        if(isset($_POST['User']))
        {
            //注册前先经过黑名单数据库过滤
            $blackInfoCheck=Blackaccount::model()->findAll(array(
                'condition'=>'blackaccountinfo='.$_POST['User']['QQToken'].' or blackaccountinfo='.$_POST['User']['Phon'].' and status=1'
            ));
            if(count($blackInfoCheck)>0)//用户注册的QQ或手机号在黑名单数据库中有记录
            {
                $this->redirect_message('黑名单中有您信息的记录，如有疑问请联系我们的客服人员','success',5,$this->createUrl('passport/regist'));
                Yii::app()->end();
            }
            
            $checkexist=User::model()->findByAttributes(array(
                'Username'=>$_POST['User']['Username']
            ));
            
            if($checkexist)//如果用户名已经存在，阻止重复注册
            {
                $this->redirect(array('passport/regist','regist'=>"registDONE"));
                Yii::app()->end();
            }
            
            $userRegModel=new User();
            foreach($_POST['User'] as $key=>$value)//给字段赋值
            {
                $userRegModel->$key=$value;
            }
            $userRegModel->PassWord=md5($userRegModel->PassWord);//密码md5加密
            $userRegModel->RegIp=XUtils::getClientIP();//注册IP
            $userRegModel->RegTime=time();//注册时间
            
            $reglock=System::model()->findByAttributes(array("varname"=>"reglock"));//检查系统设置中的新用户注册状态
            $userRegModel->Status=$reglock->value;//新注册用户默认状态为冻结
            
            
            /*
                ***判断是否为推广链接
            */
            if(isset($_POST['userid']) && !empty($_POST['userid']))
            {
               @$userinfo=User::model()->findByPk($_POST['userid']);
               if($userinfo)
               {
                    $userRegModel->IdNumber=$_POST['userid'];
               }
            }
            
            //保存数据
            if($userRegModel->save())//添加数据
            {
                $this->redirect(array('passport/regist','regist'=>"registDONE"));
            }
            Yii::app()->end();
        }
		$this->render('regist');
	}
    
    /*检查注册的帐号是否存在*/
    public function actionCheckUser(){
        $userModel=User::model()->findByAttributes(array('Username'=>$_POST["param"]));
        if($_POST["param"]=="admin")
        {
            echo '{
    			"info":"admin为系统保留帐号，不能注册",
    			"status":"n"
    		 }';
        }
        elseif($userModel==false)
        {
            echo '{
    			"info":"帐号可以使用",
    			"status":"y"
    		 }';
       }
       else
       {
            echo '{
    			"info":"该帐号已被注册",
    			"status":"n"
    		 }';
       }
    }
    
    /*检查真实姓名*/
    public function actionCheckTrueName()
    {
        $userModel=User::model()->findByAttributes(array('TrueName'=>$_POST["param"]));
        if($userModel==false)
        {
            echo '{
    			"info":"通过验证",
    			"status":"y"
    		 }';
       }
       else
       {
            echo '{
    			"info":"该姓名已存在",
    			"status":"n"
    		 }';
       }
    }
    
    /*检查注册的QQ是否存在*/
    public function actionCheckQQ(){
        $userModel=User::model()->findByAttributes(array('QQToken'=>$_POST["param"]));
        if($userModel==false)
        {
            echo '{
    			"info":"该QQ号可以使用",
    			"status":"y"
    		 }';
       }
       else
       {
            echo '{
    			"info":"该QQ号已被注册",
    			"status":"n"
    		 }';
       }
    }
    
    /*检查注册的邮箱是否存在*/
    public function actionCheckEmail(){
        $userModel=User::model()->findByAttributes(array('Email'=>$_POST["param"]));
        if($userModel==false)
        {
            echo '{
    			"info":"该邮箱可以使用",
    			"status":"y"
    		 }';
       }
       else
       {
            echo '{
    			"info":"该邮箱已被注册",
    			"status":"n"
    		 }';
       }
    }
    
    /*检查注册的手机号是否存在*/
    public function actionCheckMobile(){
        $userModel=User::model()->findByAttributes(array('Phon'=>$_POST["param"]));
        if($userModel==false)
        {
            echo '{
    			"info":"该手机号可以使用",
    			"status":"y"
    		 }';
       }
       else
       {
            echo '{
    			"info":"该手机号已被注册",
    			"status":"n"
    		 }';
       }
    }
    
    /*检查注册的手机验证码是否正确*/
    public function actionCheckMobileCode(){
        if($_POST["param"]!=$_SESSION['mobile_code'] or empty($_POST['param'])){
            echo '{
    			"info":"验证码不正确",
    			"status":"n"
 		     }';
        }
        else{
            //$_SESSION['mobile'] = '';
            //$_SESSION['mobile_code'] = '';	
            echo '{
    			"info":"验证码正确，请不要修改",
    			"status":"y"
 		     }';	
        }
    }
	
	//找回密码
    public function actionForgetpassword()
    {
        if(isset($_POST['mobile_code']))
        {   
            if($_POST["mobile_code"]==$_SESSION['mobile_code'])
            {
                $this->redirect(array('passport/forgetpasswordnext'));
                Yii::app()->end();
            }
            else
            {
                $this->redirect_message('您填写的验证码信息不正确','success',3,$this->createUrl('site/index'));
                Yii::app()->end();
            }
        }
        $this->renderPartial('forgetpassword');
    }
    
    //找回密码下一步
    public function actionForgetpasswordnext()
    {
        if(isset($_POST['User']))
        {
            $checkPhone=User::model()->findByAttributes(array(
                'Phon'=>$_SESSION['mobile']
            ));
            if($checkPhone)
            {
                $checkPhone->PassWord=md5($_POST['User']['PassWord']);
                if($checkPhone->save())
                {
                    $this->redirect_message('密码修改成功','success',3,$this->createUrl('site/index'));
                    Yii::app()->end();
                }
                else
                {
                    $this->redirect_message('密码修改失败，请联系网站管理员','success',3,$this->createUrl('site/index'));
                    Yii::app()->end();
                }
            }
            else
            {
                $this->redirect_message('您填写的手机号不存在，请确认您填写的手机号为注册时填写的手机号','success',3,$this->createUrl('site/index'));
                Yii::app()->end();
            }
        }  
		$checkPhone=User::model()->findByAttributes(array(
			'Phon'=>$_SESSION['mobile']
		));
        
        if($checkPhone)
        {
            $this->renderPartial('forgetpasswordnext',array(
    			'checkPhone'=>$checkPhone
    		));
        }
        else
        {
            $this->redirect_message('您填写的手机号不存在','success',3,$this->createUrl('site/index'));
            Yii::app()->end();
        }
    }
    
    /*
        异地登录检测
    */
    public function actionPlaceOtherLogin()
    {
        if(isset($_POST['username']) && $_POST['username']!="" && isset($_POST['pwd']) && $_POST['pwd'])
        {
            $siteLogin=new SiteLoginForm;
            $siteLogin->username=$_POST['username'];
            $siteLogin->password=$_POST['pwd'];
            $siteLogin->rememberMe=false;
            if($siteLogin->validate())//用户名密码正确
            {
                $userinfo=User::model()->findByAttributes(array(
                    'Username'=>$_POST['username'],
                    'PassWord'=>md5($_POST['pwd'])
                ));
                if($userinfo->Status==0)//用户帐号没有被冻结，处于正常状态
                {
                    if($userinfo->PlaceOtherLogin==0)//用户没有开启异地登录，则允许用户直接提交登录
                    {
                        echo "true";
                    }else//开启异地登录
                    {
                        //1.检查此次登录的ip与最近一次登录的ip是否相同
                        $lastLoginLog=Loginlog::model()->find(array(
                            'condition'=>'userid='.$userinfo->id,
                            'order'=>'id desc'
                        ));
                        if($lastLoginLog->loginip===XUtils::getClientIP())//如果本次登录ip与最近一次登录ip相同则允许用户直接提交
                        {
                            echo "true";
                        }else//如果不同则返回通知使用短信验证
                        {
                            echo $userinfo->Phon;//需要手机接手短信验证码,返回手机号码，以便发送短信进行验证
                        }
                    }
                }else//帐号被冻结
                {
                    echo "LOCK";
                }
            }else
                echo "FAIL";
        }
    }
    
    /*
        用户中心-检测手机与接收到的验证码是否正确
    */
    public function actionUserCheckPhoneAndCode()
    {
        if(isset($_POST['phone']) && isset($_POST['phoneCode']))
        {
            if($_POST['phoneCode']==Yii::app()->session['code'])
            {
                if($_POST['phone']==Yii::app()->session['phone'])
                {
                    unset(Yii::app()->session['code']);//清除验证码
                    unset(Yii::app()->session['phone']);//清除手机号
                    echo "SUCCESS";
                }
                else
                {
                    echo "PHONEFAIL";
                }
            }else
            {
                echo "CODEFAIL";//验证码不正确
            }
        }
        else
        {
            echo "FAIL";
        }
    }
    
    /*
        用户异地登录-手机验证码检测通过-提交登录
    */
    public function actionCodePassLogin()
    {
        $siteLogin=new SiteLoginForm;
        $siteLogin->username=$_POST['username'];
        $siteLogin->password=$_POST['pwd'];
        $siteLogin->rememberMe=false;
        if(@$siteLogin->validate() && @$siteLogin->login())//数据验证与判断登录
        {
            //存储登录日志
            $loginlog=new Loginlog();
            $loginlog->loginip=XUtils::getClientIP();//登录ip
            //登录地址
            $ipinfo=file_get_contents('http://ip.taobao.com/service/getIpInfo.php?ip='.$loginlog->loginip);
            if($ipinfo)
            {
                $loginlog->userid=Yii::app()->user->getId();//登录id
                $loginlog->username=Yii::app()->user->getName();//登录帐户
                
                $placeinfo=json_decode($ipinfo,true);
                $loginlog->loginplace=$placeinfo['data']['region'].$placeinfo['data']['city']!=""?$placeinfo['data']['city']:"本地";//登录地址
                //登录地址
                $loginlog->time=time();
                $loginlog->save();//保存登录日志
            }
            echo "SUCCESS";//登录成功
        }else
            echo "FAIL";
    }
    
    /*用户登录验证模块*/
    public function actionLogin()
    {
        if(Yii::app()->user->getId())//判断如果用户已经登录
        {
            if(isset($_GET['uid']))//用户登录情况下销毁前一个用户
            {
                Yii::app()->user->logout(false); //当前应用用户退出
                $signKey="sywnew!@#$%20161612!#@$!@#$!@%!@";//签名key
                if($_GET['sign']==md5($_GET['uid'].$signKey)){
                    $userinfo=User::model()->findByPk($_GET['uid']);
                    $siteLogin=new SiteLoginForm;
                    $siteLogin->username=$userinfo->Username;//用户名
                    $siteLogin->password=$userinfo->PassWord;//密码
                    $siteLogin->rememberMe=false;//获取用户是否点击了记住我的选择框
                    
                    if(@$siteLogin->login())//数据验证与判断登录
                    {
                        $this->redirect(array('site/index'));
                    }
                    else
                        echo "FAIL";
                }
                {
                    echo "FAIL";
                }
            }else
            {
                $this->redirect(array('site/index'));
                Yii::app()->end();
            }
        }
        if(isset($_GET['uid']))
        {
            $signKey="sywnew!@#$%20161612!#@$!@#$!@%!@";//签名key
            if($_GET['sign']==md5($_GET['uid'].$signKey)){
                $userinfo=User::model()->findByPk($_GET['uid']);
                $siteLogin=new SiteLoginForm;
                $siteLogin->username=$userinfo->Username;//用户名
                $siteLogin->password=$userinfo->PassWord;//密码
                $siteLogin->rememberMe=false;//获取用户是否点击了记住我的选择框
                
                if(@$siteLogin->login())//数据验证与判断登录
                {
                    $this->redirect(array('site/index'));
                }
                else
                    echo "FAIL";
            }
            {
                echo "FAIL";
            }
        }
        if(isset($_POST['User']))
        {
            $siteLogin=new SiteLoginForm;
            $siteLogin->username=$_POST['User']['Username'];
            $siteLogin->password=$_POST['User']['PassWord'];
            $siteLogin->rememberMe=@$_POST['User']['rememberMe']=="on"?true:false;//获取用户是否点击了记住我的选择框
            if(@$siteLogin->validate() && @$siteLogin->login())//数据验证与判断登录
            {
                //$this->redirect_message("登录成功","success",2,$this->createUrl('site/index'));
                /*$resArr=array(
                   'resData'=>'infomation',
                   "status"=>"y",
                );*/
                //存储登录日志
                $loginlog=new Loginlog();
                $loginlog->loginip=XUtils::getClientIP();//登录ip
                //登录地址
                $ipinfo=file_get_contents('http://ip.taobao.com/service/getIpInfo.php?ip='.$loginlog->loginip);
                if($ipinfo)
                {
                    $loginlog->userid=Yii::app()->user->getId();//登录id
                    $loginlog->username=Yii::app()->user->getName();//登录帐户
                    
                    $placeinfo=json_decode($ipinfo,true);
                    $loginlog->loginplace=$placeinfo['data']['region'].$placeinfo['data']['city']!=""?$placeinfo['data']['city']:"本地";//登录地址
                    //登录地址
                    $loginlog->time=time();
                    $loginlog->save();//保存登录日志
                }
                    
                $this->redirect(array('site/index'));
                //$this->redirect(array('default/index'));//成功后进行跳转
                //Yii::app()->end();
            }
            else
            {
                /*$resArr=array(
                   "info"=>"用户名或者密码正确",
                   "status"=>"n",
                );*/
                /*echo json_encode($resArr);*/
                $wrongWaring="帐号或密码错误";
                if(isset($_POST['User']['position']) && $_POST['User']['position']=="index")
                {
                    $this->redirect(array('site/index','loginStatus'=>'fail'));
                    Yii::app()->end();
                }
                else
                {
                    $this->render('login',array(
                        'wrongWaring'=>$wrongWaring,
                    ));
                    Yii::app()->end();
                }
            }
        }
        $this->render('login');
    }
    
    
    /*用户邮箱激活*/
    public function actionEmailActive()
    {
        if(isset($_GET['userid']) && isset($_GET['email']))//判断传递的参数是否正确
        {
            $emailChangeActive=User::model()->findByPk($_GET['userid']);
            if($emailChangeActive->emailActive==0)//判断是否已经激活过
            {
                if($emailChangeActive)
                {
                    if(md5($emailChangeActive->Email)==$_GET['email'])//匹配与邮箱地址加密信息是否一致
                    {
                        $emailChangeActive->emailActive=1;
                        if($emailChangeActive->save())
                        {
                            if(Yii::app()->user->getId() && Yii::app()->user->getId()==$_GET['userid'])
                                $this->redirect_message('您的邮箱已激活','success',3,$this->createUrl('user/countSafe'));
                            else
                                $this->redirect_message('您的邮箱已激活','success',3,$this->createUrl('site/index'));
                        }
                    }
                    else
                    {
                        if(Yii::app()->user->getId() && Yii::app()->user->getId()==$_GET['userid'])
                                $this->redirect_message('您的邮箱链接已失效','success',3,$this->createUrl('user/countSafe'));
                            else
                                $this->redirect_message('您的邮箱链接已失效','success',3,$this->createUrl('site/index'));
                    }
                }
                else
                {
                    $this->redirect(array('site/index'));
                }
            }
            else
            {
                if(Yii::app()->user->getId() && Yii::app()->user->getId()==$_GET['userid'])
                    $this->redirect_message('您的邮箱已激活','success',3,$this->createUrl('user/countSafe'));
                else
                    $this->redirect_message('您的邮箱已激活','success',3,$this->createUrl('site/index'));
            }
        }
        else
        {
            $this->redirect(array('site/index'));
        }
    }
    
    public function actionEmail()
    {
        //配置发送信息
        $config=array(
            'SMTP_HOST'=>'smtp.qq.com',//smtp服务器
            'SMTP_PORT'=>'465',//端口
            'SMTP_USER'=>'1352259486@qq.com',//邮箱帐号
            'SMTP_PASS'=>'227228zx',//密码
            'FROM_EMAIL'=>'1352259486@qq.com',
            'FROM_NAME'=>'366k官方',
            
        );
        $mail=Yii::createComponent('application.extensions.mailer.EMailer');//实例化对象
        $mail->CharSet    = 'UTF-8'; //设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
        $mail->IsSMTP();  // 设定使用SMTP服务
        $mail->SMTPDebug  = 0;                     // 关闭SMTP调试功能
                                                   // 1 = errors and messages
                                                   // 2 = messages only
        $mail->SMTPAuth   = true;                  // 启用 SMTP 验证功能
        $mail->SMTPSecure = 'ssl';                 // 使用安全协议
        $mail->Host       = $config['SMTP_HOST'];  // SMTP 服务器
        $mail->Port       = $config['SMTP_PORT'];  // SMTP服务器的端口号
        $mail->Username   = $config['SMTP_USER'];  // SMTP服务器用户名
        $mail->Password   = $config['SMTP_PASS'];  // SMTP服务器密码
        $mail->SetFrom($config['FROM_EMAIL'], $config['FROM_NAME']);
        //$replyEmail       = $config['REPLY_EMAIL']?$config['REPLY_EMAIL']:$config['FROM_EMAIL'];
        //$replyName        = $config['REPLY_NAME']?$config['REPLY_NAME']:$config['FROM_NAME'];
        //$mail->AddReplyTo($replyEmail, $replyName);
        $mail->Subject    = '找回密码-366k游戏平台';
        $mail->MsgHTML("尊敬的366k用户请点击以下链接！<a href='http://game.366k.com/index.php/passport/forgetPwd'>http://game.366k.com/index.php/passport/forgetPwd</a>，找回您的密码，此邮件由系统发出，无须回复！");
        $mail->AddAddress('753104948@qq.com', '开心一生');
        /*if(is_array($attachment)){ // 添加附件
            foreach ($attachment as $file){
                is_file($file) && $mail->AddAttachment($file);
            }
        }*/
        echo @$mail->Send() ? '发送成功' : $mail->ErrorInfo;//发送邮件
    }


 }