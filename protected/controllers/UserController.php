<?php
/*
    用户中心
*/
class UserController extends Controller
{
    
    /*public function init()  
    {     
        //parent::init();     
        Yii::app()->clientScript->registerCssFile(WEB_SITE_CSS_URL.'user.css'); 
        Yii::app()->clientScript->registerCssFile(SBT_CSS_URL.'css.css'); 
        
    }*/
    
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
					'actions'=>array('error'),
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
        会员中心-威客实名认证
    */
    public function actionAuthPerson()
    {
        //淘内幕实名认证
        if(isset($_POST['taoneimo']) && $_POST['taoneimo']=="DOIT")
        {
            $authcheck=Authperson::model()->findByAttributes(array('uid'=>Yii::app()->user->getId()));
            if($authcheck)//已经提交过
            {
                echo "EXIST";
            }else
            {
                $authinfo=new Authperson;
                $authinfo->uid=Yii::app()->user->getId();
                $authinfo->time=time();
                if($authinfo->save())
                {
                    $userinfo=User::model()->findByPk(Yii::app()->user->getId());
                    $userinfo->AuthPersonStep1=1;//资料已经提交
                    $userinfo->save();
                    echo "SUCCESS";
                }
                else
                {
                    echo "FAIL";
                }
            }
            Yii::app()->end();
        }
        
        //威客实名认证
        if(isset($_POST['username']))
        {
            $authcheck=Authperson::model()->findByAttributes(array('uid'=>Yii::app()->user->getId()));
            if($authcheck)//已经提交过
            {
                echo "EXIST";
            }else{
                $authinfo=new Authperson;
                $authinfo->uid=Yii::app()->user->getId();
                $authinfo->username=$_POST['username'];
                $authinfo->idcardnumber=$_POST['idcardnumber'];
                $authinfo->cftaccount=$_POST['cftaccount'];
                $authinfo->zfbaccount=$_POST['zfbaccount'];
                $authinfo->qq=$_POST['qq'];
                if($_POST['province']==$_POST['city'])
                    $authinfo->address=$_POST['province'].$_POST['town'].$_POST['street'];
                else
                    $authinfo->address=$_POST['province'].$_POST['city'].$_POST['town'].$_POST['street'];
                $authinfo->telephone=$_POST['telephone'];
                $authinfo->zmidcard=$_POST['zmidcard'];
                $authinfo->handwithidcard=$_POST['handwithidcard'];
                $authinfo->lifephoto=$_POST['lifephoto'];
                $authinfo->time=time();
                if($authinfo->save())
                {
                    $userinfo=User::model()->findByPk(Yii::app()->user->getId());
                    $userinfo->AuthPersonStep1=1;//资料已经提交
                    $userinfo->save();
                    echo "SUCCESS";
                } 
                else
                    echo "FAIL";
            }
            Yii::app()->end();
        }else
            $this->render('authPerson');
    }

    /*
        会员中心-绑定掌柜号认证
    */
    public function actionAuthStore()
    {
        if(isset($_POST['platform']))
        {
            $wangwangcheck=Blindwangwang::model()->findByAttributes(array('wangwang'=>$_POST['wangwang']));
            if($wangwangcheck)//该掌柜号已经被绑定过
            {
                echo "EXIST";
            }else
            {
                $wangwang=new Blindwangwang;
                $wangwang->userid=Yii::app()->user->getId();
                $wangwang->wangwang=trim($_POST['wangwang']);
                $wangwang->catalog=2;
                $wangwang->blindtime=time();
                $wangwang->platform=$_POST['platform'];
                $wangwang->ip=$_POST['authStoreIP'];
                $wangwang->authStoreIP=$_POST['authStoreIP'];
                $wangwang->authStoreQQ=$_POST['authStoreQQ'];
                $wangwang->authStorePhone=$_POST['telephone'];

                $randStr = str_shuffle('1234567890');//由数字组成
                $wangwang->authStoreCode=substr($randStr,0,6);

                $wangwang->authStoreStep1=1;//基本资料已提交

                $wangwang->authStoreStatus=0;
                if($wangwang->save())
                    echo "SUCCESS";
                else
                    echo "FAIL";
            }
            Yii::app()->end();
        }
        $this->render('authStore');
    }

    /*
        验证商品链接地址
    */
    public function actionAuthStoreUrl()
    {
        if(isset($_POST['authStoreUrl']) && isset($_POST['id']))
        {
            $wangwanginfo=Blindwangwang::model()->findByPk($_POST['id']);

            $pageinfo=file_get_contents($_POST['authStoreUrl']);

            //验证商品链接中是否有验证码
            $checkauthStoreCode=strpos($pageinfo,iconv("utf-8","gb2312",$wangwanginfo->authStoreCode));

            //验证商品链接中的掌柜号是否正确
            $checkwangwang=strpos($pageinfo,iconv("utf-8","gb2312",$wangwanginfo->wangwang));

            /*$wangwanginfo->authStoreUrl=$_POST['authStoreUrl'];
            $wangwanginfo->authStoreStep2=1;*/
            if($checkauthStoreCode==false && $checkwangwang==true)
                echo "authStoreCodeNO";
            else if($checkwangwang==false && $checkauthStoreCode==true)
                echo "wangwangNO";
            else if($checkauthStoreCode==false && $checkwangwang==false)
                echo "bothNO";
            else
            {
                $wangwanginfo->authStoreUrl=$_POST['authStoreUrl'];
                $wangwanginfo->authStoreStep2=1;
                $wangwanginfo->authStoreStatus=1;//审核通过
                $wangwanginfo->authStorepasstime=time();
                $wangwanginfo->save();
                echo "SUCCESS";
            }
        }else
        {
            echo "FAIL";
        }
    }

    /*
        绑定掌柜号-使用jsonp请求成功后-通过此方法改变审核状态
    */
    public function actionAuthStroeJsonp()
    {
        if(isset($_POST['authStoreUrl']) && isset($_POST['id']))
        {
            $wangwanginfo=Blindwangwang::model()->findByPk($_POST['id']);
            $wangwanginfo->authStoreUrl=$_POST['authStoreUrl'];
            $wangwanginfo->authStoreStep2=1;
            $wangwanginfo->authStoreStatus=1;//审核通过
            $wangwanginfo->authStorepasstime=time();
            if($wangwanginfo->save())
                echo "SUCCESS";
            else
                echo "FAIL";
        }
    }
    
    /*
        任务大厅-任务投诉
    */
    public function actionUserTaskComplian()
    {
        if(isset($_POST['taskid']) && $_POST['taskid']!="" && isset($_POST['reason']) && $_POST['reason']!="" && isset($_POST['userStyle']))
        {
            $checkExist=Complianlist::model()->findByAttributes(array('taskid'=>$_POST['taskid']));
            if($checkExist)//对该任务已经投诉过
            {
                echo "EXIST";
            }else{
                $taskinfo=Companytasklist::model()->findByPk($_POST['taskid']);
                $taskinfo->complian_status=1;//改变状态为投诉
                $taskinfo->complian_introduce=$_POST['reason'];//投诉原因说明
                $taskinfo->save();
                
                $complianinfo=new Complianlist;
                if($_POST['userStyle']==0)//发起投诉的人为商家
                {
                    $complianinfo->uid=$taskinfo->taskerid;//则被投诉人为接手
                }else//发起人为威客
                {
                    $complianinfo->uid=$taskinfo->publishid;//则被投诉人为商家
                }
                $complianinfo->douid=Yii::app()->user->getId();//发起投诉的人的id
                $complianinfo->taskid=$_POST['taskid'];//投诉对应的任务id
                $complianinfo->reason=$_POST['reason'];//投诉原因说明
                $complianinfo->reasonImg=$_POST['reasonImg'];//投诉的图片证据
                $complianinfo->time=time();//发起投诉的时间
                if($complianinfo->save())
                    echo "SUCCESS";
                else
                    echo "FAIL";
            }
            Yii::app()->end();
        }
        $this->renderPartial('userTaskComplian');
    }
    
    /*
        用户中心-购买米粒
    */
    public function actionUserBuyPoint()
    {
        if(isset($_POST['MinLinNum']) && $_POST['MinLinNum']!="")
        {
            $buyMinLiPrice=System::model()->findByAttributes(array("varname"=>"buyMinLiPrice"));//米粒回收价格
            $userinfo=User::model()->findByPk(Yii::app()->user->getId());
            if($_POST['MinLinNum']*$buyMinLiPrice->value>$userinfo->Money)//余额不足
            {
                echo "MONEYNOTENOUGH";
            }
            else//余额充足
            {
                //更新平台余额
				$criteria = new CDbCriteria;
                $criteria->condition='catalog in (2,7)';
                $criteria->order ="id desc";
			    $yuerow = Recordlist::model()->find($criteria);
				if($yuerow){
					$yue=$yuerow['yue']+$_POST['MinLinNum'];
				}else{
					$yue=$_POST['MinLinNum'];
				}
				//更新平台余额结束
				//添加流水
                //1.保存米粒回收流水
                $record=new Recordlist();
                $record->userid=Yii::app()->user->getId();//用户id
                $record->catalog=2;//购买米粒类型
                $record->number=$_POST['MinLinNum'];//购买米粒数量
				$record->yue=$yue;
                $record->time=time();//操作时间
                $record->save();//保存流水
                
                //2.改变购买米粒后帐户的余额与米粒数量
                $userinfo->Money=$userinfo->Money-$_POST['MinLinNum']*$buyMinLiPrice->value;//在原有余额基本上减去购买米粒使用掉的金额
                $userinfo->MinLi=$userinfo->MinLi+$_POST['MinLinNum'];//在原有米粒基础上加上购买的米粒
                $userinfo->save();
                echo "SUCCESS";
            }
            Yii::app()->end();
        }
        else
            $this->render('userBuyPoint');
    }
    
    /*
        用户中心-购买vip等级
    */
    public function actionUserBuyVipLevel()
    {
        if(isset($_POST['vipType']) && isset($_POST['month']) && isset($_POST['vipPrice']))
        {
            $userinfo=User::model()->findByPk(Yii::app()->user->getId());
            $userinfo->VipLv=$_POST['vipType'];//VIP等级
            $userinfo->VipBuyTime=time();//VIP购买时间
            $userinfo->VipStopTime=$userinfo->VipBuyTime+$_POST['month']*30*24*3600;//VIP购买多久
            $userinfo->Money=$userinfo->Money-$_POST['vipPrice'];//余额发生变化
            
            if($userinfo->save())
            {
                //保存金额流水
                $record=new Recordlist();
                $record->userid=Yii::app()->user->getId();//用户id
                $record->catalog=3;//发布任务使用金额
                $record->number=$_POST['vipPrice'];//操作数量
                $record->time=$userinfo->VipBuyTime;//操作时间
                $record->save();//保存金额流水
                echo "SUCCESS";
            }else
                echo "FAIL";
        }
    }
    
    /*
        用户中心-加入商保
    */
    public function actionUserSBcenter()
    {
        //加入商保
        if(isset($_POST['joinProtectPlan']) && $_POST['joinProtectPlan']=="DONE")
        {
            $userinfo=User::model()->findByPk(Yii::app()->user->getId());
            if($userinfo->JoinProtectPlan==0)//未加入商保
            {
                $userinfo->JoinProtectPlan=1;//将商保状态改变为加入
                $userinfo->JoinProtectPlanMoney=300;//将商保金额改变300
                $userinfo->Money=$userinfo->Money-300;//余额减少300
                $userinfo->JoinProtectPlanTime=time();//加入商保的时间
                
                if($userinfo->save())
                {
                    //保存金额流水
                    $record=new Recordlist();
                    $record->userid=Yii::app()->user->getId();//用户id
                    $record->catalog=11;//加入商保使用的金额
                    $record->number=300;//操作数量
                    $record->time=$userinfo->JoinProtectPlanTime;//操作时间
                    $record->save();//保存金额流水
                    
                    echo "SUCCESS";
                }
                else
                    echo "FAIL";
                
            }else//已加入商保，无法
            {
                echo "JOINYET";
            }
            Yii::app()->end();
        }
        
        //退出商保申请
        if(isset($_POST['exitProtectPlan']) && $_POST['exitProtectPlan']=="DONE")
        {
            $userinfo=User::model()->findByPk(Yii::app()->user->getId());
            if($userinfo->JoinProtectPlan==1)//已加入商保，可以申请退出
            {
                //保存申请记录
                $exitProtectPlanRecord=new Exitprotectplanrecord();
                $exitProtectPlanRecord->uid=Yii::app()->user->getId();//用户id
                $exitProtectPlanRecord->status=0;//申请中
                $exitProtectPlanRecord->time=time();//申请提交时间
                if($exitProtectPlanRecord->save())
                    echo "SUCCESS";
                else
                    echo "FAIL";
                
            }else//未加入商保，无法申请
            {
                echo "NOTJOINYET";
            }
            Yii::app()->end();
        }
        
        //取消退出商保
        if(isset($_POST['DelexitProtectPlan']) && $_POST['DelexitProtectPlan']=="DONE")
        {
            $exitProtectPlanRecord=Exitprotectplanrecord::model()->findByAttributes(array(
                'uid'=>Yii::app()->user->getId(),
                'status'=>0
            ));
            if($exitProtectPlanRecord)//存在即可以取消申请
            {
                if($exitProtectPlanRecord->delete())
                    echo "SUCCESS";
                else
                    echo "FAIL";
            }
            else
            {
                echo "NOTEXIT";
            }
            Yii::app()->end();   
        }
        
        $this->render('userSBcenter');
    }
    
    /*
        用户中心-成为职业威客
    */
    public function actionUserZYWK()
    {
        $this->render('userZYWK');
    }
    
    /*
        用户中心-查看排行榜
    */
    public function actionUserTop10()
    {
        $this->render('userTop10');
    }
    
    /*
        用户中心-用户推广赚钱
    */
    public function actionUserSpread()
    {
        $criteria = new CDbCriteria;
        $criteria->order ="id desc";
        $criteria->addCondition('IdNumber='.Yii::app()->user->getId());//查询我发起的投诉
    
        //分页开始
        $total = User::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proInfo = User::model()->findAll($criteria);
        //分页结束
        $this->render('userSpread',array(
            'proInfo' =>$proInfo,
            'pages' => $pages,
            'total'=>$total
        ));
    }
    
    /*
        用户中心-生成用户推广的专属链接
    */
    public function actionuserSpreadLink()
    {
        $this->renderPartial('userSpreadLink');
    }
    
    public function actionGetTitle()
    {
        
        if(isset($_POST['url']) && $_POST['url']!="")
        {
            $url=$_POST['url'];
            if(@preg_match('/(<div class="tb-detail-hd">)(.*)(<\/div>)/is',file_get_contents($url), $matches) && strpos($url,"detail.tmall.com")){
                $arrNew=explode("</h1>",$matches[0]);
                $promotionlisttitle=strip_tags($arrNew[0]);
            } 
            else if(@preg_match('/(<h3 class="tb-main-title">)(.*)(<\/h3>)/is',file_get_contents($url), $matches) && strpos($url,"item.taobao.com"))
            {
                $protitle=strip_tags($matches[0]);
            }
            else   
            {
                $protitle=0;
            }
            
            echo iconv("gbk//TRANSLIT","UTF-8",trim($protitle));
        }
    }
    
    /*
        用户中心-手机号码绑定激活
    */
    public function actionUserPhonActive()
    {
        if(isset($_POST['phone']) && isset($_POST['phoneCode']))
        {
            if($_POST['phoneCode']==Yii::app()->session['code'])
            {
                if($_POST['phone']==Yii::app()->session['phone'])
                {
                    unset(Yii::app()->session['code']);//清除验证码
                    unset(Yii::app()->session['phone']);//清除手机号
                    $userinfo=User::model()->findByPk(Yii::app()->user->getId());
                    $userinfo->Phon=$_POST['phone'];//重新配置用户的手机号码
                    $userinfo->PhonActive=1;//改变用户手机激活的状态
                    $userinfo->save();
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
            $this->render('userPhonActive');
    }
    
    /*
        用户中心-检查安全码是否正确
    */
    public function actionCheckSafePwd()
    {
        if(isset($_POST['safePwd']) && $_POST['safePwd']!="")
        {
            $userinfo=User::model()->findByPk(Yii::app()->user->getId());
            if($userinfo->SafePwd==md5($_POST['safePwd']))
                echo "SUCCESS";
            else
                echo "FAIL";
        }else
            echo "FAIL";
    }
    
    /*
        用户中心-修改安全操作码
    */
    public function actionUserSafePwdFirstSet()
    {
        $userInfo=User::model()->findByPk(Yii::app()->user->getId());
        if(isset($_POST['setSafePwd']) && $_POST['setSafePwd']=="Done" && isset($_POST['safePwd']))
        { 
            if($userInfo->SafePwd=="")//没有设置过安全码
            {
                $userInfo->SafePwd=md5($_POST['safePwd']);
                if($userInfo->save())
                {
                    $this->redirect(array('user/index'));
                }
                else
                {
                    $this->redirect_message('安全码设置失败，请联系客服人员！','success',10,$this->createUrl('site/index'));
                }
            }else
            {
                $this->redirect_message('您已经设置过安全码！','success',10,$this->createUrl('site/index'));
            }
        }
        else{
            if($userInfo->SafePwd=="")//没有设置过安全码
                $this->render('userSafePwdFirstSet');
            else
                $this->redirect_message('您已经设置过安全码！','success',10,$this->createUrl('user/index'));
        }
    }
    
    /*
        用户中心-修改绑定手机号码
    */
    public function actionUserChangPhone()
    {
        if(isset($_POST['phone']) && $_POST['phone']!="")//修改手机号码
        {
            $userinfo=User::model()->findByPk(Yii::app()->user->getId());
            $userinfo->Phon=$_POST['phone'];//修改为新的手机号码
            if($userinfo->save())
                echo "SUCCESS";
            else
                echo "FAIL";
        }
        else
            $this->renderPartial('userChangPhone');
    }
    
    /*
        用户中心-投诉中心-发起的投诉
    */
    public function actionUserTsCenter()
    {
        $criteria = new CDbCriteria;
        $criteria->order ="time desc";
        $criteria->addCondition('douid='.Yii::app()->user->getId());//查询我发起的投诉
    
        //分页开始
        $total = Complianlist::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Complianlist::model()->findAll($criteria);
        //分页结束
        
        $this->render('userTsCenter',array(
            'proInfo' => $proreg,
            'pages' => $pages,
            'total'=>$total
        ));
    }
    
    /*
        用户中心-投诉中心-收到的投诉
    */
    public function actionUserTsCenterGet()
    {
        $criteria = new CDbCriteria;
        $criteria->order ="time desc";
        $criteria->addCondition('uid='.Yii::app()->user->getId());//查询我发起的投诉
    
        //分页开始
        $total = Complianlist::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Complianlist::model()->findAll($criteria);
        //分页结束
        
        $this->render('userTsCenterGet',array(
            'proInfo' => $proreg,
            'pages' => $pages,
            'total'=>$total
        ));
    }
    /*
        用户中心-添加卡号
    */
    public function actionGetPhoneCode()
    {
        $this->renderPartial('getPhoneCode');
    }
    /*
        用户中心-添加卡号
    */
    public function actionUserAddBank()
    {
        $this->renderPartial('userAddBank');
    }
    /*
        用户中心-修改卡号
    */
    public function actionUserEditBank()
    {
		if(isset($_GET['bankid'])){
			$bankInfo=Banklist::model()->findByPk(intval($_GET['bankid']));
			if($bankInfo){
				$this->renderPartial('userEditBank',array(
                   'bankInfo' => $bankInfo
               ));
			}else{
				$this->renderPartial('userEditBank');
			}
            
		}
		
    }
    /*
        用户中心-确认添加银行卡
    */
    public function actionUserAddBankCertain()
    {
        if(isset($_POST['truename']) && $_POST['truename']!="" && isset($_POST['bankAccount']) && $_POST['bankAccount']!="")
        {
            $checkBank=Banklist::model()->findByAttributes(array('bankAccount'=>$_POST['bankAccount']));
            if($checkBank)//银行卡已存在
            {
                echo "BANKACCOUNTEXIT";
            }else//不存在则进行添加
            {
                $bankInfo=new Banklist();
                $bankInfo->userid=Yii::app()->user->getId();//用户id
                $bankInfo->truename=$_POST['truename'];//真实姓名
                $bankInfo->phone=$_POST['Phon'];//添加银行卡时绑定的手机号码
                $bankInfo->bankCatalog=$_POST['bankCatalog'];//银行卡的类型即银行名称
                $bankInfo->bankAccount=$_POST['bankAccount'];//银行卡号
                $bankInfo->time=time();//添加银行卡时间
                if($bankInfo->save())
                    echo "SUCCESS";
                else
                    echo "FAIL";
            }
        }
        else
            echo "FAIL";
    }
	/*
        用户中心-修改银行卡
    */
    public function actionUserEditBankCertain()
    {
        if(isset($_POST['truename']) && $_POST['truename']!="" && isset($_POST['bankAccount']) && $_POST['bankAccount']!="" && isset($_POST['id']) && $_POST['id']>0)
        {
			$bankInfo=Banklist::model()->findByAttributes(array('id'=>intval($_POST['id']),'userid'=>Yii::app()->user->getId()));
			if($bankInfo){
				$bankInfo->truename=$_POST['truename'];//真实姓名
                $bankInfo->phone=$_POST['Phon'];//添加银行卡时绑定的手机号码
                $bankInfo->bankCatalog=$_POST['bankCatalog'];//银行卡的类型即银行名称
                $bankInfo->bankAccount=$_POST['bankAccount'];//银行卡号
                $bankInfo->time=time();//添加银行卡时间
				if($bankInfo->save())
                    echo "SUCCESS";
                else
                    echo "FAIL";
			}else{
				echo '银行卡不存在';
			}
        }
        else
            echo "FAIL";
    }
           
	/*
        用户中心-删除银行卡
    */
    public function actionUserDelBank()
    {
        if(isset($_POST['bankid']))
        {
            $checkBank=Banklist::model()->findByAttributes(array('id'=>$_POST['bankid'],'userid'=>Yii::app()->user->getId()));
            if($checkBank)//银行卡已存在
            {
                if($checkBank->delete())
                    echo "SUCCESS";
                else
                    echo "FAIL";
            }else//不存在则进行添加
            {
                echo '银行卡不存在';
            }
        }
        else
            echo "FAIL";
    }
	
    /*
        用户中心-用户中心首页-总览
    */
    public function actionIndex()
    {
        //开启异地登录验证
        if(isset($_POST['otherPlaceLogin']) && $_POST['otherPlaceLogin']=="Done")
        {
            $userInfo=User::model()->findByPk(Yii::app()->user->getId());
            $userInfo->PlaceOtherLogin=1;//开启异常登录
            if($userInfo->save())
                echo 'SUCCESS';
            else
                echo 'FAIL';
            Yii::app()->end();
        }
        
        //关闭异地登录验证
        if(isset($_POST['otherPlaceLoginClose']) && $_POST['otherPlaceLoginClose']=="Done")
        {
            $userInfo=User::model()->findByPk(Yii::app()->user->getId());
            $userInfo->PlaceOtherLogin=0;//关闭异常登录
            if($userInfo->save())
                echo 'SUCCESS';
            else
                echo 'FAIL';
            Yii::app()->end();
        }
        
        $this->render('index');
    }
    
    
    /*
        用户中心-新手考试
    */
    public function actionUserExam()
    {
        //提交试卷
        if(isset($_POST['qeustion']) && isset($_POST['answer']))
        {
            $total=count($_POST['qeustion']);//题目总数
            $answerCount=0;//计算答对数量
            foreach($_POST['answer'] as $k=>$v)
            {
                $exam=Exam::model()->find(array(
                    'condition'=>'id='.$v.' and answer=1'
                ));
                if($exam)
                    $answerCount++;
            }
            
            //如果答对数量超过60%则通过考试
            if($answerCount/$total>0.6 || $answerCount/$total==0.6)
            {
                $userInfo=User::model()->findByPk(Yii::app()->user->getId());
                $userInfo->ExamPass=1;//考试通过，改变考试状态
                $userInfo->save();
                echo "SUCCESS";
            }
            else
            {
                echo "FAIL";
            }
            Yii::app()->end();
        }
        
        $this->render('userExam');
    }
    
    /*
        用户中心-淘宝大厅-已接任务
    */
    public function actionTaobaoInTask()
    {
        //关键词搜索
        if(isset($_POST['keywords']) && $_POST['keywords']!="")
        {
            $keywordsArr=explode('*',$_POST['keywords']);//分解关键词
            //任务大厅
    	    $criteria = new CDbCriteria;
            if(is_array($keywordsArr) && count($keywordsArr)==2)
                $criteria->condition='status=0 and time='.trim($keywordsArr[0]).' and id='.trim($keywordsArr[1]);
            else
                $criteria->condition='status=-1';//给出不存在的条件
            $criteria->order ="time desc";
        
            //分页开始
            $total =Companytasklist::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=10;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Companytasklist::model()->findAll($criteria);
            //分页结束
            
            $this->render('taobaoInTask',array(
                'proInfo' => $proreg,
                'pages' => $pages
            ));
            Yii::app()->end();
        }
        //我接手的任务
	    $criteria = new CDbCriteria;
        $criteria->condition='taskerid='.Yii::app()->user->getId().' and status<>6 and complian_status<>3 and taskCompleteStatus<>1';//不查询已完成的任务
        $criteria->order ="status asc";
    
        //分页开始
        $total =Companytasklist::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Companytasklist::model()->findAll($criteria);
        //分页结束
        
        $this->render('taobaoInTask',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    /*
        已接任务-等待对商品付款
    */ 
    public function actionTaobaoInTaskWaitPay()
    {
        //关键词搜索
        if(isset($_POST['keywords']) && $_POST['keywords']!="")
        {
            $keywordsArr=explode('*',$_POST['keywords']);//分解关键词
            //任务大厅
    	    $criteria = new CDbCriteria;
            if(is_array($keywordsArr) && count($keywordsArr)==2)
                $criteria->condition='status=0 and time='.trim($keywordsArr[0]).' and id='.trim($keywordsArr[1]);
            else
                $criteria->condition='status=-1';//给出不存在的条件
            $criteria->order ="tasksecondTime desc";
        
            //分页开始
            $total =Companytasklist::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=10;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Companytasklist::model()->findAll($criteria);
            //分页结束
            
            $this->render('taobaoInTaskWaitPay',array(
                'proInfo' => $proreg,
                'pages' => $pages
            ));
            Yii::app()->end();
        }
        //我接手的任务
	    $criteria = new CDbCriteria;
        $criteria->condition='taskerid='.Yii::app()->user->getId().' and status<>6 and status=2';//不查询已完成的任务
        $criteria->order ="tasksecondTime desc";
    
        //分页开始
        $total =Companytasklist::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Companytasklist::model()->findAll($criteria);
        //分页结束
        
        $this->render('taobaoInTaskWaitPay',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    /*
        已接任务-等待收货好评
    */ 
    public function actionTaobaoInTaskWaitSHHP()
    {
        //关键词搜索
        if(isset($_POST['keywords']) && $_POST['keywords']!="")
        {
            $keywordsArr=explode('*',$_POST['keywords']);//分解关键词
            //任务大厅
    	    $criteria = new CDbCriteria;
            if(is_array($keywordsArr) && count($keywordsArr)==2)
                $criteria->condition='status=0 and time='.trim($keywordsArr[0]).' and id='.trim($keywordsArr[1]);
            else
                $criteria->condition='status=-1';//给出不存在的条件
            $criteria->order ="taskthirdTime desc";
        
            //分页开始
            $total =Companytasklist::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=10;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Companytasklist::model()->findAll($criteria);
            //分页结束
            
            $this->render('taobaoInTaskWaitSHHP',array(
                'proInfo' => $proreg,
                'pages' => $pages
            ));
            Yii::app()->end();
        }
        //我接手的任务
	    $criteria = new CDbCriteria;
        $criteria->condition='taskerid='.Yii::app()->user->getId().' and status<>6 and status=4';//不查询已完成的任务
        $criteria->order ="taskthirdTime desc";
    
        //分页开始
        $total =Companytasklist::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Companytasklist::model()->findAll($criteria);//分页结束
        
        $this->render('taobaoInTaskWaitSHHP',array(
            'proInfo' => $proreg,
        
            'pages' => $pages
        ));
    }
    
    /*
        已接任务-已完成任务
    */ 
    public function actionTaobaoInTaskComplete()
    {
        //关键词搜索
        if(isset($_POST['keywords']) && $_POST['keywords']!="")
        {
            $keywordsArr=explode('*',$_POST['keywords']);//分解关键词
            //任务大厅
    	    $criteria = new CDbCriteria;
            if(is_array($keywordsArr) && count($keywordsArr)==2)
                $criteria->condition='status=0 and time='.trim($keywordsArr[0]).' and id='.trim($keywordsArr[1]);
            else
                $criteria->condition='status=-1';//给出不存在的条件
            $criteria->order ="taskcompleteTime desc";
        
            //分页开始
            $total =Companytasklist::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=10;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Companytasklist::model()->findAll($criteria);
            //分页结束
            
            $this->render('taobaoInTaskComplete',array(
                'proInfo' => $proreg,
                'pages' => $pages
            ));
            Yii::app()->end();
        }
        //我接手的任务
	    $criteria = new CDbCriteria;
        $criteria->condition='taskerid='.Yii::app()->user->getId().' and taskCompleteStatus=1';//不查询已完成的任务
        $criteria->order ="taskcompleteTime desc";
    
        //分页开始
        $total =Companytasklist::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Companytasklist::model()->findAll($criteria);
        //分页结束
        
        $this->render('taobaoInTaskComplete',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    /*
        已接任务-全部任务
    */
    public function actionTaobaoInTaskAllList()
    {
        //关键词搜索
        if(isset($_POST['keywords']) && $_POST['keywords']!="")
        {
            $keywordsArr=explode('*',$_POST['keywords']);//分解关键词
            //任务大厅
    	    $criteria = new CDbCriteria;
            if(is_array($keywordsArr) && count($keywordsArr)==2)
                $criteria->condition='status=0 and time='.trim($keywordsArr[0]).' and id='.trim($keywordsArr[1]);
            else
                $criteria->condition='status=-1';//给出不存在的条件
            $criteria->order ="taskcompleteTime desc";
        
            //分页开始
            $total =Companytasklist::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=10;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Companytasklist::model()->findAll($criteria);
            //分页结束
            
            $this->render('taobaoInTaskAllList',array(
                'proInfo' => $proreg,
                'pages' => $pages
            ));
            Yii::app()->end();
        }
        //我接手的任务
	    $criteria = new CDbCriteria;
        $criteria->condition='taskerid='.Yii::app()->user->getId();//不查询已完成的任务
        $criteria->order ="taskcompleteTime desc";
    
        //分页开始
        $total =Companytasklist::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Companytasklist::model()->findAll($criteria);
        //分页结束
        
        $this->render('taobaoInTaskAllList',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    
     /*
        用户中心-淘宝大厅-已发任务
    */
    public function actionTaobaoOutTask()
    {
        //关键词搜索
        if(isset($_POST['keywords']) && $_POST['keywords']!="")
        {
            $keywordsArr=explode('*',$_POST['keywords']);//分解关键词
            //任务大厅
    	    $criteria = new CDbCriteria;
            if(is_array($keywordsArr) && count($keywordsArr)==2)
                $criteria->condition='status=0 and time='.trim($keywordsArr[0]).' and id='.trim($keywordsArr[1]);
            else
                $criteria->condition='status=-1';//给出不存在的条件
            $criteria->order ="status desc";
        
            //分页开始
            $total =Companytasklist::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=10;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Companytasklist::model()->findAll($criteria);
            //分页结束
            
            $this->render('taobaoOutTask',array(
                'proInfo' => $proreg,
                'pages' => $pages
            ));
            Yii::app()->end();
        }
        //发布的任务
	    $criteria = new CDbCriteria;
        $criteria->condition='publishid='.Yii::app()->user->getId().' and complian_status<>3 and taskCompleteStatus<>1';//不查询已完成的任务
        $criteria->order ="status desc";
    
        //分页开始
        $total =Companytasklist::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Companytasklist::model()->findAll($criteria);
        //分页结束
        
        $this->render('taobaoOutTask',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    /*
        用户中心-淘宝大厅-已发任务-暂停的任务
    */
    public function actionTaobaoOutTaskStop()
    {
        //关键词搜索
        if(isset($_POST['keywords']) && $_POST['keywords']!="")
        {
            $keywordsArr=explode('*',$_POST['keywords']);//分解关键词
            //任务大厅
    	    $criteria = new CDbCriteria;
            if(is_array($keywordsArr) && count($keywordsArr)==2)
                $criteria->condition='status=0 and time='.trim($keywordsArr[0]).' and id='.trim($keywordsArr[1]);
            else
                $criteria->condition='status=-1';//给出不存在的条件
            $criteria->order ="time desc";
        
            //分页开始
            $total =Companytasklist::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=10;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Companytasklist::model()->findAll($criteria);
            //分页结束
            
            $this->render('taobaoOutTaskStop',array(
                'proInfo' => $proreg,
                'pages' => $pages
            ));
            Yii::app()->end();
        }
        //发布的任务
	    $criteria = new CDbCriteria;
        $criteria->condition='publishid='.Yii::app()->user->getId().' and status=6';//商家暂停的任务
        $criteria->order ="time desc";
    
        //分页开始
        $total =Companytasklist::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Companytasklist::model()->findAll($criteria);
        //分页结束
        
        $this->render('taobaoOutTaskStop',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    /*
        用户中心-淘宝大厅-已发任务-已完成的任务
    */
    public function actionTaobaoOutTaskComplete()
    {
        //关键词搜索
        if(isset($_POST['keywords']) && $_POST['keywords']!="")
        {
            $keywordsArr=explode('*',$_POST['keywords']);//分解关键词
            //任务大厅
    	    $criteria = new CDbCriteria;
            if(is_array($keywordsArr) && count($keywordsArr)==2)
                $criteria->condition='status=0 and time='.trim($keywordsArr[0]).' and id='.trim($keywordsArr[1]);
            else
                $criteria->condition='status=-1';//给出不存在的条件
            $criteria->order ="time desc";
        
            //分页开始
            $total =Companytasklist::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=10;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Companytasklist::model()->findAll($criteria);
            //分页结束
            
            $this->render('taobaoOutTaskComplete',array(
                'proInfo' => $proreg,
                'pages' => $pages
            ));
            Yii::app()->end();
        }
        //发布的任务
	    $criteria = new CDbCriteria;
        $criteria->condition='publishid='.Yii::app()->user->getId().' and taskCompleteStatus=1';//商家暂停的任务
        $criteria->order ="time desc";
    
        //分页开始
        $total =Companytasklist::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Companytasklist::model()->findAll($criteria);
        //分页结束
        
        $this->render('taobaoOutTaskComplete',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    /*
        用户中心-淘宝大厅-已发任务-已完成的任务
    */
    public function actionTaobaoOutTaskAllList()
    {
        //关键词搜索
        if(isset($_POST['keywords']) && $_POST['keywords']!="")
        {
            $keywordsArr=explode('*',$_POST['keywords']);//分解关键词
            //任务大厅
    	    $criteria = new CDbCriteria;
            if(is_array($keywordsArr) && count($keywordsArr)==2)
                $criteria->condition='status=0 and time='.trim($keywordsArr[0]).' and id='.trim($keywordsArr[1]);
            else
                $criteria->condition='status=-1';//给出不存在的条件
            $criteria->order ="status asc";
        
            //分页开始
            $total =Companytasklist::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=10;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Companytasklist::model()->findAll($criteria);
            //分页结束
            
            $this->render('taobaoOutTaskAllList',array(
                'proInfo' => $proreg,
                'pages' => $pages
            ));
            Yii::app()->end();
        }
        //发布的任务
	    $criteria = new CDbCriteria;
        $criteria->condition='publishid='.Yii::app()->user->getId();//商家暂停的任务
        $criteria->order ="status asc";
    
        //分页开始
        $total =Companytasklist::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Companytasklist::model()->findAll($criteria);
        //分页结束
        
        $this->render('taobaoOutTaskAllList',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    /*
        用户中心-任务完成-任务好中差评价
    */
    public function actionTaskAppraise()
    {
        if(isset($_POST['taskid']) && $_POST['taskid']!="" && isset($_POST['pjstatus']) && $_POST['pjstatus']!="")
        {
            $taskinfo=Companytasklist::model()->findByPk($_POST['taskid']);
            $appraise=new Appraise;
            $appraise->uid=$taskinfo->taskerid;//威客id
            $appraise->douid=$taskinfo->publishid;//评价人id即商家id
            $appraise->status=$_POST['pjstatus'];//评价状态：0-差评，1-中评，2-好评
            $appraise->taskid=$_POST['taskid'];//任务id
            $appraise->time=time();//评价时间
            if($appraise->save())
                echo "SUCCESS";
            else
                echo "FAIL";  
        }
    }
    
    /*
        用户中心-淘宝大厅-淘宝绑定买号
    */
    public function actionTaobaoBindBuyer()
    {
        if(isset($_POST['bdmh']))
        {   
            $checkBlindwangwang=Blindwangwang::model()->find(array(
                'condition'=>"wangwang='".$_POST['bdmh']."' and statue <>3"
            ));
            
            
            if(count($checkBlindwangwang)>0)//买号已存在
            {
                $warning="该买号已经被绑定过";
            }
            else
            {
                $checkBlindwangwang=Blindwangwang::model()->find(array(
                    'condition'=>"wangwang='".$_POST['bdmh']."' and userid=".Yii::app()->user->getId().' and statue=3'
                ));
                if(count($checkBlindwangwang)>0)//如果该用户绑定号已经存在，只是被系统取消了，也就是statue状态为3的情况下
                {
                    $checkBlindwangwang->statue=1;
                    if($checkBlindwangwang->save())
                    {
                        $this->redirect('blindBuyCount');
                    }
                    Yii::app()->end();
                }
                
                
                $blindwangwang=new Blindwangwang;
                $blindwangwang->userid=Yii::app()->user->getId();//用户id
                $blindwangwang->wangwang=$_POST['bdmh'];//淘宝买家帐号
                $blindwangwang->wangwanginfo=$_POST['wangwanginfo'];//淘宝帐号等级信息
                $blindwangwang->taotaorz=$_POST['taotaorz'];//是否通过淘宝实名认证
                $blindwangwang->ip=XUtils::getClientIP();//操作ip
                $blindwangwang->blindtime=time();//绑定时间
                $blindwangwang->platform=$_POST['platform'];
                
                if($blindwangwang->save())
                    $warning="恭喜您，买号绑定成功！";
                else
                    $warning="买号绑定失败";
            }
            $criteria = new CDbCriteria;
            $criteria->order ="blindtime desc";
            $criteria->addCondition('userid='.Yii::app()->user->getId().' and catalog=1');//查询绑定的买号
        
            //分页开始
            $total = Blindwangwang::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=5;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Blindwangwang::model()->findAll($criteria);
            //分页结束
            
            $this->render('taobaoBindBuyer',array(
                "warning"=>$warning,
                'proInfo' => $proreg,
                'pages' => $pages
            ));
            Yii::app()->end();
        }
        
        $criteria = new CDbCriteria;
        $criteria->order ="blindtime desc";
        $criteria->addCondition('userid='.Yii::app()->user->getId().' and catalog=1');//查询绑定的买号
    
        //分页开始
        $total = Blindwangwang::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=5;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Blindwangwang::model()->findAll($criteria);
        //分页结束
        
        $this->render('taobaoBindBuyer',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    /*
        用户中心-淘宝大厅-删除买号
    */
    public function actionTaobaoBindBuyerDel()
    {
        if(isset($_GET['id']))
        {
            $blindInfo=Blindwangwang::model()->findByAttributes(array(
                'userid'=>Yii::app()->user->getId(),
                'id'=>$_GET['id']
            ));
            if($blindInfo)//检查要删除的买号是否属于当前登录用户
            {
                $blindInfo->delete();
                $this->redirect(array('user/taobaoBindBuyer'));
            }
            else
            {
                $this->redirect_message('您无权删除','success',3,$this->createUrl('user/taobaoBindBuyer'));
            }
        }
        else
            $this->redirect_message('您无权删除','success',3,$this->createUrl('user/taobaoBindBuyer'));
    }
    
     /*
        用户中心-淘宝大厅-修改买号信息
    */
    public function actionTaobaoBindBuyerChangeInfo()
    {
        if(isset($_POST['id']) || isset($_POST['value']) || isset($_POST['action']))
        {
            $blindInfo=Blindwangwang::model()->findByPk($_POST['id']);
            if($_POST['action']=="realnameOn")//修改淘宝实名认证信息
            {
                $blindInfo->taotaorz=$_POST['value'];
            }
            
            if($_POST['action']=="changeStatusOn")//修改是否启用买号
            {
                $statue=$_POST['value']==1?0:1;
                $blindInfo->statue=$statue;
            }
            
            if($_POST['action']=="taobaoScoreOn")//修改淘宝信誉
            {
                $blindInfo->wangwanginfo=$_POST['value'];
            }
            if($blindInfo->save())
                echo 1;
            else
                echo 0;
        }
    }
    
    
    
    /*
        用户中心-淘宝大厅-淘宝绑定掌柜
    */
    public function actionTaobaoBindSeller()
    {
        if(isset($_POST['bdmh']))
        {   
            $checkBlindwangwang=Blindwangwang::model()->find(array(
                'condition'=>"wangwang='".$_POST['bdmh']."' and statue <>3"
            ));
            
            
            if(count($checkBlindwangwang)>0)//买号已存在
            {
                $warning="该买号已经被绑定过";
            }
            else
            {
                $checkBlindwangwang=Blindwangwang::model()->find(array(
                    'condition'=>"wangwang='".$_POST['bdmh']."' and userid=".Yii::app()->user->getId().' and statue=3'
                ));
                if(count($checkBlindwangwang)>0)//如果该用户绑定号已经存在，只是被系统取消了，也就是statue状态为3的情况下
                {
                    $checkBlindwangwang->statue=1;
                    if($checkBlindwangwang->save())
                    {
                        $this->redirect('blindBuyCount');
                    }
                    Yii::app()->end();
                }
                
                
                $blindwangwang=new Blindwangwang;
                $blindwangwang->userid=Yii::app()->user->getId();//用户id
                $blindwangwang->wangwang=$_POST['bdmh'];//淘宝掌柜帐号
                $blindwangwang->catalog=2;//帐号类型为2即掌柜帐号
                $blindwangwang->ip=XUtils::getClientIP();//操作ip
                $blindwangwang->blindtime=time();//绑定时间
                $blindwangwang->platform=$_POST['platform'];//掌柜号所属平台
                
                if($blindwangwang->save())
                    $warning="恭喜您，买号绑定成功！";
                else
                    $warning="买号绑定失败";
            }
            $criteria = new CDbCriteria;
            $criteria->order ="blindtime desc";
            $criteria->addCondition('userid='.Yii::app()->user->getId().' and catalog=2');//查询绑定的买号
        
            //分页开始
            $total = Blindwangwang::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=5;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Blindwangwang::model()->findAll($criteria);
            //分页结束
            
            $this->render('taobaoBindSeller',array(
                "warning"=>$warning,
                'proInfo' => $proreg,
                'pages' => $pages
            ));
            Yii::app()->end();
        }
        $criteria = new CDbCriteria;
        $criteria->order ="blindtime desc";
        $criteria->addCondition('userid='.Yii::app()->user->getId().' and catalog=2');//查询绑定的掌柜号
    
        //分页开始
        $total = Blindwangwang::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=5;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Blindwangwang::model()->findAll($criteria);
        //分页结束
        
        $this->render('taobaoBindSeller',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    /*
        用户中心-淘宝大厅-删除掌柜号
    */
    public function actionTaobaoBindSellerDel()
    {
        if(isset($_GET['id']))
        {
            $blindInfo=Blindwangwang::model()->findByAttributes(array(
                'userid'=>Yii::app()->user->getId(),
                'id'=>$_GET['id']
            ));
            if($blindInfo)//检查要删除的买号是否属于当前登录用户
            {
                $blindInfo->delete();
                $this->redirect(array('user/taobaoBindSeller'));
            }
            else
            {
                $this->redirect_message('您无权删除','success',3,$this->createUrl('user/taobaoBindSeller'));
            }
        }
        else
            $this->redirect_message('您无权删除','success',3,$this->createUrl('user/taobaoBindSeller'));
    }
    
    /*
        用户中心-发布任务-ajax检查米粒
    */
    public function actiontaskCheckMinLi()
    {
        if(isset($_POST))
        {
            //米粒初始化
            $MinLi=0;
            
            //对应操作所需要的米粒
            $jdfsMinLi=System::model()->findByAttributes(array("varname"=>"jdfsMinLi"));
            $ltMinLi=System::model()->findByAttributes(array("varname"=>"ltMinLi"));
            $gwscMinLi=System::model()->findByAttributes(array("varname"=>"gwscMinLi"));
            $phoneMinLi=System::model()->findByAttributes(array("varname"=>"phoneMinLi"));
            $wwshMinLi=System::model()->findByAttributes(array("varname"=>"wwshMinLi"));
            $llddMinLi=System::model()->findByAttributes(array("varname"=>"llddMinLi"));
            $hpMinLi=System::model()->findByAttributes(array("varname"=>"hpMinLi"));
            $tlsjoneMinLi=System::model()->findByAttributes(array("varname"=>"tlsjoneMinLi"));
            $tlsjtwoMinLi=System::model()->findByAttributes(array("varname"=>"tlsjtwoMinLi"));
            $tlsjthreeMinLi=System::model()->findByAttributes(array("varname"=>"tlsjthreeMinLi"));
            $hpnrMinLi=System::model()->findByAttributes(array("varname"=>"hpnrMinLi"));
            $shjsMinLin=System::model()->findByAttributes(array("varname"=>"shjsMinLin"));
            $smrzMinLi=System::model()->findByAttributes(array("varname"=>"smrzMinLi"));
            $sbyhMinLi=System::model()->findByAttributes(array("varname"=>"sbyhMinLi"));
            $xzjsoneMinLi=System::model()->findByAttributes(array("varname"=>"xzjsoneMinLi"));
            $xzjstwoMinLi=System::model()->findByAttributes(array("varname"=>"xzjstwoMinLi"));
            $xzjsthreeMinLi=System::model()->findByAttributes(array("varname"=>"xzjsthreeMinLi"));
            $zddqMinLi=System::model()->findByAttributes(array("varname"=>"zddqMinLi"));
            
            $xzdj1MinLi=System::model()->findByAttributes(array("varname"=>"xzdj1MinLi"));
            $xzdj2MinLi=System::model()->findByAttributes(array("varname"=>"xzdj2MinLi"));
            $xzdj3MinLi=System::model()->findByAttributes(array("varname"=>"xzdj3MinLi"));
            $xzdj4MinLi=System::model()->findByAttributes(array("varname"=>"xzdj4MinLi"));
            $xzdj5MinLi=System::model()->findByAttributes(array("varname"=>"xzdj5MinLi"));
            $xzdj6MinLi=System::model()->findByAttributes(array("varname"=>"xzdj6MinLi"));
            $xzdj7MinLi=System::model()->findByAttributes(array("varname"=>"xzdj7MinLi"));
            $xzdj8MinLi=System::model()->findByAttributes(array("varname"=>"xzdj8MinLi"));
            $xzdj9MinLi=System::model()->findByAttributes(array("varname"=>"xzdj9MinLi"));
            $xzdj10MinLi=System::model()->findByAttributes(array("varname"=>"xzdj10MinLi"));
            $gljsMinLi=System::model()->findByAttributes(array("varname"=>"gljsMinLi"));
            $zsqsMinLi=System::model()->findByAttributes(array("varname"=>"zsqsMinLi"));
            $shdzMinLi=System::model()->findByAttributes(array("varname"=>"shdzMinLi"));
            $buyMinLiPrice=System::model()->findByAttributes(array("varname"=>"buyMinLiPrice"));
            
            $lgoods1=System::model()->findByAttributes(array("varname"=>"lgoods1"));
            $lgoods2=System::model()->findByAttributes(array("varname"=>"lgoods2"));
            
            $contrast1=System::model()->findByAttributes(array("varname"=>"contrast1"));
            $contrast2=System::model()->findByAttributes(array("varname"=>"contrast2"));
            $contrast3=System::model()->findByAttributes(array("varname"=>"contrast3"));
            
            
            //判断是否为来路搜索任务
            if(isset($_POST['taskCatalog']) && $_POST['taskCatalog']==1)
            {
                
                ($_POST['shopBrGoods']+$_POST['lgoods'])==2?$MinLi=$MinLi+$lgoods1->value:$MinLi=$MinLi+0;//浏览店里其他1件商品
                ($_POST['shopBrGoods']+$_POST['lgoods'])==3?$MinLi=$MinLi+$lgoods2->value:$MinLi=$MinLi+0;//浏览店里其他2件商品
                
                ($_POST['isCompare']+$_POST['contrast'])==2?$MinLi=$MinLi+$contrast1->value:$MinLi=$MinLi+0;//货比1家
                ($_POST['isCompare']+$_POST['contrast'])==3?$MinLi=$MinLi+$contrast2->value:$MinLi=$MinLi+0;//货比2家
                ($_POST['isCompare']+$_POST['contrast'])==4?$MinLi=$MinLi+$contrast3->value:$MinLi=$MinLi+0;//货比3家
            }
            
            //第一步：商品信息
            $txtMinMPrice=(float)$_POST['txtMinMPrice'];//基本米粒
            $MinLi=$MinLi+$txtMinMPrice;//增加基本米粒
            if($_POST['ddlOKDay']>3)//根据确认时间增加米粒
            {
                $MinLi=$MinLi+($_POST['ddlOKDay']-3);
            }
            
            //第二步：增值服务
            $_POST['cbxIsWW']==1?$MinLi=$MinLi+$ltMinLi->value:$MinLi=$MinLi+0;//选中旺旺聊天米粒基数加1

            $_POST['shopcoller']==1?$MinLi=$MinLi+$gwscMinLi->value:$MinLi=$MinLi+0;//选中购物收藏米粒基数加0.5

            $_POST['isMobile']==1?$MinLi=$MinLi+$phoneMinLi->value:$MinLi=$MinLi+0;//选中手机订单米粒基数加2.0
                
            $_POST['cbxIsLHS']==1?$MinLi=$MinLi+$wwshMinLi->value:$MinLi=$MinLi+0;//选中旺旺收货米粒基数加0.5
                
            $_POST['isViewEnd']==1?$MinLi=$MinLi+$llddMinLi->value:$MinLi=$MinLi+0;//选中浏览到底米粒基数加0.5
                
            $_POST['pinimage']==1?$MinLi=$MinLi+$hpMinLi->value:$MinLi=$MinLi+0;//选中好评截图米粒基数加0.5
                
            if($_POST['stopDsTime']==1)//根据停留时间增加对应的米粒
            {
                switch($_POST['stopTime'])
                {
                    case 1://停留1分钟增加0.1米粒
                        $MinLi=$MinLi+$tlsjoneMinLi->value;
                        break;
                    case 2://停留2分钟增加0.3米粒
                        $MinLi=$MinLi+$tlsjtwoMinLi->value; 
                        break;
                    case 3://停留3分钟增加0.5米粒
                        $MinLi=$MinLi+$tlsjthreeMinLi->value;
                        break;
                }
            }
            $_POST['cbxIsMsg']==1?$MinLi=$MinLi+$hpnrMinLi->value:$MinLi=$MinLi+0;//选中好评内容米粒基数加0.5
            
            //第三步：筛选接手$_POST['cbxIsAudit']==1?$MinLi=$MinLi+$shjsMinLin->value:$MinLi=$MinLi+0;//选中审核接手米粒基数加0.5
                
            $_POST['isReal']==1?$MinLi=$MinLi+$smrzMinLi->value:$MinLi=$MinLi+0;//选中实名认证米粒基数加0.5
                
            $_POST['cbxIsSB']==1?$MinLi=$MinLi+$sbyhMinLi->value:$MinLi=$MinLi+0;//选中商保用户米粒基数加0.5
                
            if($_POST['cbxIsFMaxMCount']==1)//根据限制接手要求增加对应的米粒
            {
                switch($_POST['fmaxmc'])
                {
                    case 1://1天接1个增加0.5米粒
                        $MinLi=$MinLi+$xzjsoneMinLi->value;
                        break;
                    case 2://1天接2个增加0.2米粒
                        $MinLi=$MinLi+$xzjstwoMinLi->value; 
                        break;
                    case 3://1周接1个增加1米粒
                        $MinLi=$MinLi+$xzjsthreeMinLi->value;
                        break;
                }
            }
            $_POST['isLimitCity']==1?$MinLi=$MinLi+$zddqMinLi->value:$MinLi=$MinLi+0;//选中指定区域米粒基数加2
            if($_POST['isBuyerFen']==1)//根据限制接手要求增加对应的米粒
            {
                switch($_POST['BuyerJifen'])
                {
                    case 1://一心及以上增加0.5米粒
                        $MinLi=$MinLi+$xzdj1MinLi->value;
                        break;
                    case 2://二心及以上 增加1.0米粒
                        $MinLi=$MinLi+$xzdj2MinLi->value; 
                        break;
                    case 3://三心及以上增加2.0米粒
                        $MinLi=$MinLi+$xzdj3MinLi->value;
                        break;
                    case 4://四心及以上增加3.0米粒
                        $MinLi=$MinLi+$xzdj4MinLi->value; 
                        break;
                    case 5://五心及以上增加4.0米粒
                        $MinLi=$MinLi+$xzdj5MinLi->value;
                        break;
                    case 6://一钻及以上增加5.0米粒
                        $MinLi=$MinLi+$xzdj6MinLi->value; 
                        break;
                    case 7://二钻及以上增加6.0米粒
                        $MinLi=$MinLi+$xzdj7MinLi->value;
                        break;
                    case 8://三钻及以上增加7.0米粒
                        $MinLi=$MinLi+$xzdj8MinLi->value; 
                        break;
                    case 9://四钻及以上增加8.0米粒
                        $MinLi=$MinLi+$xzdj9MinLi->value;
                        break;
                    case 10://五钻及以上增加支付9.0米粒
                        $MinLi=$MinLi+$xzdj10MinLi->value; 
                        break;
                }
            }
            $_POST['filtertasker']==1?$MinLi=$MinLi+$gljsMinLi->value:$MinLi=$MinLi+0;//选中过滤接手米粒基数加0.5
            
            //第四步：快递空包
            $_POST['isSign']==1?$MinLi=$MinLi+$zsqsMinLi->value:$MinLi=$MinLi+0;//选中真实签收米粒基数加2
                
            $_POST['cbxIsAddress']==1?$MinLi=$MinLi+$shdzMinLi->value:$MinLi=$MinLi+0;//选中收货地址米粒基数加0.5
            echo $MinLi;
        }
    }
    
    /*
        用户中心-任务发布操作
    */
    public function actionTaskPublistHandle()
    {
        if(isset($_POST))
        {
			$time=time();
            $task=new Companytasklist();
            $task->publishid=Yii::app()->user->getId();//发布人id
            $task->time=$time;//发布任务时间
            $task->taskCatalog=$_POST['taskCatalog'];//任务类别（0-普通任务，1-来路来搜索任务）
            $task->platform=$_POST['platform'];//任务所属平台
            $task->payWay=$_POST['payWay'];//任务支付方式
            //判断手机验证码是否正确
			if($_POST['txtPrice']>10){
				    if(isset($_POST['phone']) && isset($_POST['phoneCode'])){
                        if($_POST['phoneCode']==Yii::app()->session['codepublish']){
                            if($_POST['phone']==Yii::app()->session['phonepublish']){
                                unset(Yii::app()->session['codepublish']);//清除验证码
                                unset(Yii::app()->session['phonepublish']);//清除手机号
                            }
                            else{
                                echo "PHONEFAIL";
                            }
                        }else{
                            echo "CODEFAIL";//验证码不正确
                        }
                    }else{
                        echo "FAIL";
                    }
			}
			//判断手机验证码是否正确
            //米粒初始化
            $MinLi=0;
            
            //判断是否为来路搜索任务
            if(isset($_POST['taskCatalog']) && $_POST['taskCatalog']==1)
            {
                $task->visitWay=$_POST['visitWay'];//搜索方式(1-搜商品,2-搜店铺,3- 直通车,4信用评价)
                $task->divKey=$_POST['divKey'];//搜商品关键字
                $task->txtSearchDes=$_POST['txtSearchDes'];//商品搜索提示
                $task->goodsImgPosition=$_POST['goodsImgPosition'];//商品位置截图
                
                $lgoods1=System::model()->findByAttributes(array("varname"=>"lgoods1"));
                $lgoods2=System::model()->findByAttributes(array("varname"=>"lgoods2"));
                
                $contrast1=System::model()->findByAttributes(array("varname"=>"contrast1"));
                $contrast2=System::model()->findByAttributes(array("varname"=>"contrast2"));
                $contrast3=System::model()->findByAttributes(array("varname"=>"contrast3"));
                
                $task->shopBrGoods=$_POST['shopBrGoods'];//是否要求浏览店内其他商品
                $task->lgoods=$_POST['lgoods'];//要求浏览店里几件其他商品
                ($_POST['shopBrGoods']+$_POST['lgoods'])==2?$MinLi=$MinLi+$lgoods1->value:$MinLi=$MinLi+0;//浏览店里其他1件商品
                ($_POST['shopBrGoods']+$_POST['lgoods'])==3?$MinLi=$MinLi+$lgoods2->value:$MinLi=$MinLi+0;//浏览店里其他2件商品
                
                $task->isCompare=$_POST['isCompare'];//是否要求货比
                $task->contrast=$_POST['contrast'];//要求货比几家
                ($_POST['isCompare']+$_POST['contrast'])==2?$MinLi=$MinLi+$contrast1->value:$MinLi=$MinLi+0;//货比1家
                ($_POST['isCompare']+$_POST['contrast'])==3?$MinLi=$MinLi+$contrast2->value:$MinLi=$MinLi+0;//货比2家
                ($_POST['isCompare']+$_POST['contrast'])==4?$MinLi=$MinLi+$contrast3->value:$MinLi=$MinLi+0;//货比3家
				
				$appendMinLi=System::model()->findByAttributes(array("varname"=>"appendMinLi"));
				$MinLi=$MinLi+$appendMinLi->value;
            }
            
            //对应操作所需要的米粒
            $jdfsMinLi=System::model()->findByAttributes(array("varname"=>"jdfsMinLi"));
            $ltMinLi=System::model()->findByAttributes(array("varname"=>"ltMinLi"));
            $gwscMinLi=System::model()->findByAttributes(array("varname"=>"gwscMinLi"));
            $phoneMinLi=System::model()->findByAttributes(array("varname"=>"phoneMinLi"));
            $wwshMinLi=System::model()->findByAttributes(array("varname"=>"wwshMinLi"));
            $llddMinLi=System::model()->findByAttributes(array("varname"=>"llddMinLi"));
            $hpMinLi=System::model()->findByAttributes(array("varname"=>"hpMinLi"));
            $tlsjoneMinLi=System::model()->findByAttributes(array("varname"=>"tlsjoneMinLi"));
            $tlsjtwoMinLi=System::model()->findByAttributes(array("varname"=>"tlsjtwoMinLi"));
            $tlsjthreeMinLi=System::model()->findByAttributes(array("varname"=>"tlsjthreeMinLi"));
            $hpnrMinLi=System::model()->findByAttributes(array("varname"=>"hpnrMinLi"));
            $shjsMinLin=System::model()->findByAttributes(array("varname"=>"shjsMinLin"));
            $smrzMinLi=System::model()->findByAttributes(array("varname"=>"smrzMinLi"));
            $sbyhMinLi=System::model()->findByAttributes(array("varname"=>"sbyhMinLi"));
            $xzjsoneMinLi=System::model()->findByAttributes(array("varname"=>"xzjsoneMinLi"));
            $xzjstwoMinLi=System::model()->findByAttributes(array("varname"=>"xzjstwoMinLi"));
            $xzjsthreeMinLi=System::model()->findByAttributes(array("varname"=>"xzjsthreeMinLi"));
            $zddqMinLi=System::model()->findByAttributes(array("varname"=>"zddqMinLi"));
			$gaijiaMinLi=System::model()->findByAttributes(array("varname"=>"gaijiaMinLi"));
            
            $xzdj1MinLi=System::model()->findByAttributes(array("varname"=>"xzdj1MinLi"));
            $xzdj2MinLi=System::model()->findByAttributes(array("varname"=>"xzdj2MinLi"));
            $xzdj3MinLi=System::model()->findByAttributes(array("varname"=>"xzdj3MinLi"));
            $xzdj4MinLi=System::model()->findByAttributes(array("varname"=>"xzdj4MinLi"));
            $xzdj5MinLi=System::model()->findByAttributes(array("varname"=>"xzdj5MinLi"));
            $xzdj6MinLi=System::model()->findByAttributes(array("varname"=>"xzdj6MinLi"));
            $xzdj7MinLi=System::model()->findByAttributes(array("varname"=>"xzdj7MinLi"));
            $xzdj8MinLi=System::model()->findByAttributes(array("varname"=>"xzdj8MinLi"));
            $xzdj9MinLi=System::model()->findByAttributes(array("varname"=>"xzdj9MinLi"));
            $xzdj10MinLi=System::model()->findByAttributes(array("varname"=>"xzdj10MinLi"));
            $gljsMinLi=System::model()->findByAttributes(array("varname"=>"gljsMinLi"));
            $zsqsMinLi=System::model()->findByAttributes(array("varname"=>"zsqsMinLi"));
            $shdzMinLi=System::model()->findByAttributes(array("varname"=>"shdzMinLi"));
            $buyMinLiPrice=System::model()->findByAttributes(array("varname"=>"buyMinLiPrice"));
            
            //第一步：商品信息
            $task->task_type=$_POST['task_type'];//任务类型
            $task->ddlZGAccount=$_POST['ddlZGAccount'];//淘宝掌柜名
            $task->ddlOKDay=$_POST['ddlOKDay'];//要求确认时间
            $task->txtGoodsUrl=$_POST['txtGoodsUrl'];//商品链接地址
            $task->txtPrice=$_POST['txtPrice'];//商品价格：(包含邮费)
			$expiretime=floatval($_POST['expiretime']);
			if($expiretime==0){
				$endtime=0;
			}else{
				$endtime=$time+$expiretime*60*60;
			}
			$task->expiretime=$expiretime;//任务有效期
			$task->endtime=$endtime;
            $txtMinMPrice=(float)$_POST['txtMinMPrice'];//基本米粒
            $MinLi=$MinLi+$txtMinMPrice;//增加基本米粒
			if(isset($_POST['gaijia'])){
				$MinLi=$MinLi+$gaijiaMinLi->value;
				$task->isGaijia=1;
			}else{
				$task->isGaijia=0;
			}
            if($_POST['ddlOKDay']>3)//根据确认时间增加米粒
            {
                $MinLi=$MinLi+($_POST['ddlOKDay']-3);
            }
                //$_POST['ddlOKDay']!=0?$MinLi=$MinLi+($txtMinMPrice*1.5+($_POST['ddlOKDay']-1)):$MinLi=$MinLi+0;//根据确认时间增加对应米粒
            
            //第二步：增值服务
            $task->cbxIsWW=$_POST['cbxIsWW'];//是否选中旺旺聊天，1选中，0未选中
                $_POST['cbxIsWW']==1?$MinLi=$MinLi+$ltMinLi->value:$MinLi=$MinLi+0;//选中旺旺聊天米粒基数加1
                
            $task->shopcoller=$_POST['shopcoller'];//是否选中购物收藏，1选中，0未选中
                $_POST['shopcoller']==1?$MinLi=$MinLi+$gwscMinLi->value:$MinLi=$MinLi+0;//选中购物收藏米粒基数加0.5
                
            $task->isMobile=$_POST['isMobile'];//是否选中手机订单，1选中，0未选中
                $_POST['isMobile']==1?$MinLi=$MinLi+$phoneMinLi->value:$MinLi=$MinLi+0;//选中手机订单米粒基数加2.0
                
            $task->cbxIsLHS=$_POST['cbxIsLHS'];//是否选中旺旺收货，1选中，0未选中
                $_POST['cbxIsLHS']==1?$MinLi=$MinLi+$wwshMinLi->value:$MinLi=$MinLi+0;//选中旺旺收货米粒基数加0.5
                
            $task->isViewEnd=$_POST['isViewEnd'];//是否选中浏览到底，1选中，0未选中
                $_POST['isViewEnd']==1?$MinLi=$MinLi+$llddMinLi->value:$MinLi=$MinLi+0;//选中浏览到底米粒基数加0.5
                
            $task->pinimage=$_POST['pinimage'];//是否选中好评截图，1选中，0未选中
                $_POST['pinimage']==1?$MinLi=$MinLi+$hpMinLi->value:$MinLi=$MinLi+0;//选中好评截图米粒基数加0.5
                
            $task->stopDsTime=$_POST['stopDsTime'];//是否选中停留时间，1选中，0未选中
                if($_POST['stopDsTime']==1)//根据停留时间增加对应的米粒
                {
                    switch($_POST['stopTime'])
                    {
                        case 1://停留1分钟增加0.1米粒
                            $MinLi=$MinLi+$tlsjoneMinLi->value;
                            break;
                        case 2://停留2分钟增加0.3米粒
                            $MinLi=$MinLi+$tlsjtwoMinLi->value; 
                            break;
                        case 3://停留3分钟增加0.5米粒
                            $MinLi=$MinLi+$tlsjthreeMinLi->value;
                            break;
                    }
                }
            $task->stopTime=$_POST['stopTime'];//停留时间长度
              
            $task->cbxIsMsg=$_POST['cbxIsMsg'];//是否选中好评内容，1选中，0未选中
            $task->txtMessage=$_POST['txtMessage'];//好评内容
                $_POST['cbxIsMsg']==1?$MinLi=$MinLi+$hpnrMinLi->value:$MinLi=$MinLi+0;//选中好评内容米粒基数加0.5
                
            $task->cbxIsTip=$_POST['cbxIsTip'];//是否选中留言提醒，1选中，0未选中
            $task->txtRemind=$_POST['txtRemind'];//留言提醒内容
            
            
            //第三步：筛选接手
            $task->cbxIsAudit=$_POST['cbxIsAudit'];//是否选中审核接手，1选中，0未选中
                $_POST['cbxIsAudit']==1?$MinLi=$MinLi+$shjsMinLin->value:$MinLi=$MinLi+0;//选中审核接手米粒基数加0.5
                
            $task->isReal=$_POST['isReal'];//是否选中实名认证，1选中，0未选中
                $_POST['isReal']==1?$MinLi=$MinLi+$smrzMinLi->value:$MinLi=$MinLi+0;//选中实名认证米粒基数加0.5
                
            $task->cbxIsSB=$_POST['cbxIsSB'];//是否选中商保用户，1选中，0未选中
                $_POST['cbxIsSB']==1?$MinLi=$MinLi+$sbyhMinLi->value:$MinLi=$MinLi+0;//选中商保用户米粒基数加0.5
                
            $task->cbxIsFMaxMCount=$_POST['cbxIsFMaxMCount'];//是否选中限制接手，1选中，0未选中
                if($_POST['cbxIsFMaxMCount']==1)//根据限制接手要求增加对应的米粒
                {
                    switch($_POST['fmaxmc'])
                    {
                        case 1://1天接1个增加0.5米粒
                            $MinLi=$MinLi+$xzjsoneMinLi->value;
                            break;
                        case 2://1天接2个增加0.2米粒
                            $MinLi=$MinLi+$xzjstwoMinLi->value; 
                            break;
                        case 3://1周接1个增加1米粒
                            $MinLi=$MinLi+$xzjsthreeMinLi->value;
                            break;
                    }
                }
            $task->fmaxmc=$_POST['fmaxmc'];//限制的具体要求
                
            $task->isLimitCity=$_POST['isLimitCity'];//是否选中指定区域，1选中，0未选中
                $_POST['isLimitCity']==1?$MinLi=$MinLi+$zddqMinLi->value:$MinLi=$MinLi+0;//选中指定区域米粒基数加2
            $task->Province=$_POST['Province'];//限制接手所属区域
                
            $task->isBuyerFen=$_POST['isBuyerFen'];//是否选中限制等级，1选中，0未选中
                if($_POST['isBuyerFen']==1)//根据限制接手要求增加对应的米粒
                {
                    switch($_POST['BuyerJifen'])
                    {
                        case 1://一心及以上增加0.5米粒
                            $MinLi=$MinLi+$xzdj1MinLi->value;
                            break;
                        case 2://二心及以上 增加1.0米粒
                            $MinLi=$MinLi+$xzdj2MinLi->value; 
                            break;
                        case 3://三心及以上增加2.0米粒
                            $MinLi=$MinLi+$xzdj3MinLi->value;
                            break;
                        case 4://四心及以上增加3.0米粒
                            $MinLi=$MinLi+$xzdj4MinLi->value; 
                            break;
                        case 5://五心及以上增加4.0米粒
                            $MinLi=$MinLi+$xzdj5MinLi->value;
                            break;
                        case 6://一钻及以上增加5.0米粒
                            $MinLi=$MinLi+$xzdj6MinLi->value; 
                            break;
                        case 7://二钻及以上增加6.0米粒
                            $MinLi=$MinLi+$xzdj7MinLi->value;
                            break;
                        case 8://三钻及以上增加7.0米粒
                            $MinLi=$MinLi+$xzdj8MinLi->value; 
                            break;
                        case 9://四钻及以上增加8.0米粒
                            $MinLi=$MinLi+$xzdj9MinLi->value;
                            break;
                        case 10://五钻及以上增加支付9.0米粒
                            $MinLi=$MinLi+$xzdj10MinLi->value; 
                            break;
                    }
                    $task->BuyerJifen=$_POST['BuyerJifen'];//限制接手等级具体要求
                }
            
            
            $task->filtertasker=$_POST['filtertasker'];//是否选中过滤接手，1选中，0未选中
                $_POST['filtertasker']==1?$MinLi=$MinLi+$gljsMinLi->value:$MinLi=$MinLi+0;//选中过滤接手米粒基数加0.5
                
            $task->fmaxabc=$_POST['fmaxabc']!=false?$_POST['fmaxabc']:0;//好评率,0表示未选择
            
            $task->fmaxbbc=$_POST['fmaxbbc']!=false?$_POST['fmaxbbc']:0;//接手被拉黑次数不大于,0表示未选择
            
            $task->fmaxbtsc=$_POST['fmaxbtsc']!=false?$_POST['fmaxbtsc']:0;//接手被有效投诉次数不大于,0表示未选择
            
            //第四步：快递空包
            $task->isSign=$_POST['isSign'];//是否选中真实签收，1选中，0未选中
                $_POST['isSign']==1?$MinLi=$MinLi+$zsqsMinLi->value:$MinLi=$MinLi+0;//选中真实签收米粒基数加2
                
            $task->cbxIsAddress=$_POST['cbxIsAddress'];//是否选中收货地址，1选中，0未选中
                $_POST['cbxIsAddress']==1?$MinLi=$MinLi+$shdzMinLi->value:$MinLi=$MinLi+0;//选中收货地址米粒基数加0.5
                
            //具体的收货地址信息
            $task->cbxIsAddressContent="".$_POST['cbxName'].'|'.$_POST['cbxMobile'].'|'.$_POST['cbxcode'].'|'.$_POST['cbxAddress']."";
            
            $task->isTpl=$_POST['isTpl'];////是否选中收货地址，1选中，0未选中
            $task->tplTo=$_POST['isTpl']==1?"".$_POST['tplTo']."":"0*#";//模板名称如果为0*#则为不保存模板
            
            $task->MinLi=$MinLi;//消耗总米粒
            
            $taskPublistStatus=0;
            $taskmoreArr=$task->attributes;
            if($_POST['txtFCount']<2)//单任务
            {
                $userinfoDone=User::model()->findByPk(Yii::app()->user->getId());
                //前提条件判断一.帐户余额充足，同时米粒充足
                //判断为垫付还是远程付
                if($_POST['payWay']==1)//垫付，金额与米粒都要检查
                {
                    if($_POST['txtPrice']>$userinfoDone->Money || $MinLi>$userinfoDone->MinLi)
                    {
                        $this->redirect_message('您的余额或者米粒不足','success',3,$this->createUrl('user/index'));
                        Yii::app()->end();
                    }
                }
                
                if($_POST['payWay']==1)//远程代，只检查米粒
                {
                    if($MinLi>$userinfoDone->MinLi)
                    {
                        $this->redirect_message('您的余额或者米粒不足','success',3,$this->createUrl('user/index'));
                        Yii::app()->end();
                    }
                }
                
                //添加流水
                if($_POST['payWay']==1)//垫付，则添加金额流水，否则不添加
                {
                    //1.保存金额流水
                    $record=new Recordlist();
                    $record->userid=Yii::app()->user->getId();//用户id
                    $record->catalog=3;//发布任务使用金额
                    $record->number=$_POST['txtPrice'];//操作数量
                    $record->tasknum=$_POST['txtFCount'];//1个任务
                    $record->time=time();//操作时间
                    $record->save();//保存金额流水
                }
                
                //2.保存米粒流水
                $recordMinLi=new Recordlist();
                $recordMinLi->userid=Yii::app()->user->getId();//用户id
                $recordMinLi->catalog=4;//发布任务使用米粒
                $recordMinLi->number=$MinLi;//操作数量
                $recordMinLi->tasknum=$_POST['txtFCount'];//1个任务
                $recordMinLi->time=time();//操作时间
                $recordMinLi->save();//保存米粒流水
                
                //3.改变发任务后帐户的余额
                if($_POST['payWay']==1)//垫付，则金额发生变化，否则金额不作变动
                {
                    $userinfoDone->Money=$userinfoDone->Money-$_POST['txtPrice'];//在原有余额基本上减去任务需要的金额
                }
                $userinfoDone->MinLi=$userinfoDone->MinLi-$MinLi;//在原有米粒基本上减去任务需要的米粒
                $userinfoDone->save();
                
                //4.发布任务
                if($task->save())//任务发布成功
                    $taskPublistStatus=1;
                else//任务发布失败
                    $taskPublistStatus=0;
            }else//批量发布任务
            {
                
                $userinfoDone=User::model()->findByPk(Yii::app()->user->getId());
                //前提条件判断一.帐户余额充足，同时米粒充足
                if($_POST['payWay']==1)//垫付，金额与米粒都要检查
                {
                    if(($_POST['txtPrice']*$_POST['txtFCount'])>$userinfoDone->Money || ($MinLi*$_POST['txtFCount'])>$userinfoDone->MinLi)
                    {
                        $this->redirect_message('您的余额或者米粒不足','success',3,$this->createUrl('user/index'));
                        Yii::app()->end();
                    }
                }
                
                
                if($_POST['payWay']==2)//远程单，只检查米粒
                {
                    if(($MinLi*$_POST['txtFCount'])>$userinfoDone->MinLi)
                    {
                        $this->redirect_message('您的余额或者米粒不足','success',3,$this->createUrl('user/index'));
                        Yii::app()->end();
                    }
                }
                //添加流水
                if($_POST['payWay']==1)//垫付，则添加金额流水
                {
                    //1.保存金额流水
                    $record=new Recordlist();
                    $record->userid=Yii::app()->user->getId();//用户id
                    $record->catalog=3;//发布任务使用金额
                    $record->number=$_POST['txtPrice']*$_POST['txtFCount'];//操作数量
                    $record->tasknum=$_POST['txtFCount'];//1个任务
                    $record->time=time();//操作时间
                    $record->save();//保存金额流水
                }
                
                //2.保存米粒流水
                $recordMinLi=new Recordlist();
                $recordMinLi->userid=Yii::app()->user->getId();//用户id
                $recordMinLi->catalog=4;//发布任务使用米粒
                $recordMinLi->number=$MinLi*$_POST['txtFCount'];//操作数量
                $recordMinLi->tasknum=$_POST['txtFCount'];//1个任务
                $recordMinLi->time=time();//操作时间
                $recordMinLi->save();//保存米粒流水
                
                //3.改变充值后帐户的余额
                if($_POST['payWay']==1)//垫付，则金额发生变化
                {
                    $userinfoDone->Money=$userinfoDone->Money-($_POST['txtPrice']*$_POST['txtFCount']);//在原有余额基本上减去任务需要的金额
                }
                $userinfoDone->MinLi=$userinfoDone->MinLi-($MinLi*$_POST['txtFCount']);//在原有米粒基本上减去任务需要的米粒
                $userinfoDone->save();
                
                for($i=0;$i<$_POST['txtFCount'];$i++)
                {
                    $taskMore=new Companytasklist();
                    foreach($taskmoreArr as $k=>$v)
                    $taskMore->$k=$v;
                    $taskMore->save();
                }
                $taskPublistStatus=1;
            }
            
            $task_typeUrl='taskPublishPT';
            switch($_POST['taskCatalog'])
            {
                case 0://普通任务
                    $task_typeUrl="taskPublishPT";
                    break;
                case 1://来路任务
                    $task_typeUrl="taskPublishLU";
                    break;
            }
            $this->redirect($this->createUrl('user/'.$task_typeUrl.'',array('taskPublistStatus'=>$taskPublistStatus,'task_typeUrl'=>$task_typeUrl)));
            /*echo "<pre/>";
            var_dump($MinLi);*/
        }
    }
    
    /*
        用户中心-发布任务-普通任务
    */
    public function actionTaskPublishPT()
    {
        //获取掌柜号
        $sellerInfo=Blindwangwang::model()->findAll(array(
            'condition'=>'userid='.Yii::app()->user->getId().' and authStoreStatus=1 and catalog=2',
            'select'=>'id,wangwang',
            'order'=>'id desc'
        ));
        
        //淘宝掌柜号
        $sellerInfoTB=Blindwangwang::model()->findAll(array(
            'condition'=>'userid='.Yii::app()->user->getId().' and authStoreStatus=1 and catalog=2 and platform=1',
            'select'=>'id,wangwang',
            'order'=>'id desc'
        ));
        
        //京东掌柜号
        $sellerInfoJD=Blindwangwang::model()->findAll(array(
            'condition'=>'userid='.Yii::app()->user->getId().' and authStoreStatus=1 and catalog=2 and platform=2',
            'select'=>'id,wangwang',
            'order'=>'id desc'
        ));
        //如果选择模板
        if(isset($_GET['templete']))
        {
            $teminfo=Companytasklist::model()->findByPk($_GET['templete']);
            if($teminfo && $teminfo->isTpl && $teminfo->publishid==Yii::app()->user->getId())//检查是否为模板，同时是自己的记录
            {
                $this->render('taskPublishPT',array(
                    'sellerInfo'=>$sellerInfo,
                    'sellerInfoTB'=>$sellerInfoTB,
                    'sellerInfoJD'=>$sellerInfoJD,
                    'teminfo'=>$teminfo
                ));
            }else
            {
                $this->redirect_message('参数错误','success',3,$this->createUrl("user/taskPublishLU"));
            }
        }
        else
        {
            $this->render('taskPublishPT',array(
                'sellerInfo'=>$sellerInfo,
                'sellerInfoTB'=>$sellerInfoTB,
                'sellerInfoJD'=>$sellerInfoJD
            ));
        }
    }
    
    /*
        用户中心-发布任务-来路任务
    */
    public function actionTaskPublishLU()
    { 
        //获取掌柜号
        $sellerInfo=Blindwangwang::model()->findAll(array(
            'condition'=>'userid='.Yii::app()->user->getId().' and authStoreStatus=1 and catalog=2',
            'select'=>'id,wangwang',
            'order'=>'id desc'
        ));
        
        //淘宝掌柜号
        $sellerInfoTB=Blindwangwang::model()->findAll(array(
            'condition'=>'userid='.Yii::app()->user->getId().' and authStoreStatus=1 and catalog=2 and platform=1',
            'select'=>'id,wangwang',
            'order'=>'id desc'
        ));
        
        //京东掌柜号
        $sellerInfoJD=Blindwangwang::model()->findAll(array(
            'condition'=>'userid='.Yii::app()->user->getId().' and authStoreStatus=1 and catalog=2 and platform=2',
            'select'=>'id,wangwang',
            'order'=>'id desc'
        ));
        
        //如果选择模板
        if(isset($_GET['templete']))
        {
            $teminfo=Companytasklist::model()->findByPk($_GET['templete']);
            if($teminfo && $teminfo->isTpl && $teminfo->publishid==Yii::app()->user->getId())//检查是否为模板，同时是自己的记录
            {
                $this->render('taskPublishLU',array(
                    'sellerInfo'=>$sellerInfo,
                    'sellerInfoTB'=>$sellerInfoTB,
                    'sellerInfoJD'=>$sellerInfoJD,
                    'teminfo'=>$teminfo
                ));
            }else
            {
                $this->redirect_message('参数错误','success',3,$this->createUrl("user/taskPublishLU"));
            }
        }
        else
        {
            $this->render('taskPublishLU',array(
                'sellerInfo'=>$sellerInfo,
                'sellerInfoTB'=>$sellerInfoTB,
                'sellerInfoJD'=>$sellerInfoJD
            ));
        }
    }
    
    
    /*
        用户中心-发布任务-套餐任务
    */
    public function actionTaskPublishTC()
    {
        $this->render('taskPublishTC');
    }
    
    
    /*
        用户中心-发布任务-购物车任务
    */
    public function actionTaskPublishGWC()
    {
        $this->render('taskPublishGWC');
    }
    
    /*
        用户中心-发布任务-任务模板
    */
    public function actionTaskPublishTemplete()
    {
        //查询用户充值记录
        $criteria = new CDbCriteria;
        $criteria->condition='publishid='.Yii::app()->user->getId().' and isTpl=1';
        $criteria->order ="id desc";
    
        //分页开始
        $total = Companytasklist::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Companytasklist::model()->findAll($criteria);
        //分页结束
        
        $this->render('taskPublishTemplete',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    /*
        用户中心-删除任务模板
    */
    public function actionDeltemplete()
    {
        if(isset($_GET['temid']) && $_GET['temid'])
        {
            $teminfo=Companytasklist::model()->findByPk($_GET['temid']);
            $teminfo->isTpl=0;//不保存为模板
            $teminfo->tplTo="0*#";//改为默认值
            $teminfo->save();
            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }
    
    
    /*
        用户中心-维护资料密码
    */
    public function actionUserAccountCenter()
    {
        if(isset($_POST['headImg']))
        {
            $userinfo=User::model()->findByPk(Yii::app()->user->getId());
            $userinfo->MyPhoto=$_POST['headImg'];//头像
            //$userinfo->QQToken=$_POST['qq'];//QQ号码
			//$userinfo->Email=$_POST['email'];//Email
            $userinfo->TrueName=$_POST['truename'];//真实姓名
            $userinfo->Sex=$_POST['sex'];//性别
            $userinfo->PlaceOtherLogin=$_POST['PlaceOtherLogin'];//异地登录
            if($userinfo->save())
                echo "SUCCESS";
            else
                echo "FAIL";
            Yii::app()->end();
        }
        else
        {
            $userinfo=User::model()->findByPk(Yii::app()->user->getId());
            $this->render('userAccountCenter',array(
                'userinfo'=>$userinfo
            ));
        }
    }
    
    /*
        用户中心-修改密码
    */
    public function actionChangPassword()
    {
        if(isset($_POST['newpassword']) && $_POST['newpassword']!="")
        {
            $userinfo=User::model()->findByPk(Yii::app()->user->getId());
            $userinfo->PassWord=md5($_POST['newpassword']);//修改密码
            if($userinfo->save())
                echo "SUCCESS";
            else
                echo "FAIL";
        }
        else
            echo "FAIL";
        
    }
    
    
     /*
        用户中心-修改安全操作码
    */
    public function actionChangSafepwd()
    {
        if(isset($_POST['newSafepwd']) && $_POST['newSafepwd']!="")
        {
            $userinfo=User::model()->findByPk(Yii::app()->user->getId());
            $userinfo->SafePwd=md5($_POST['newSafepwd']);//修改安全操作码
            if($userinfo->save())
                echo "SUCCESS";
            else
                echo "FAIL";
        }
        else
            echo "FAIL";
        
    }
    
    /*
        用户找回安全操作码
    */
    public function actionUsergetBackSafePwd()
    {
        $this->renderPartial('usergetBackSafePwd');
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
        用户中心-帐号充值
    */
    public function actionUserPayCenter()
    {
		if(isset($_POST['businessRecord']) && $_POST['businessRecord']!="")
        {
            /*echo $_POST['businessRecord'];//交易号
            exit;*/
            //根据交易号进行查找
			if($_POST['type']==2){
				$kcbOrder=Kcborder::model()->findByAttributes(array("tno"=>$_POST['businessRecord'],"type"=>$_POST['type']));
			}else if($_POST['type']==3){
				$kcbOrder=Kcborder::model()->findByAttributes(array("tno"=>$_POST['businessRecord'],"type"=>array(3,4)));
			}
            
            if(count($kcbOrder)==1)//交易号存在则进行检查
            {
                if($kcbOrder->status==0 && $kcbOrder->uid==0)//如果存在符合条件
                {
                    $nowNumber=$kcbOrder->money;//本次操作的金额数量，即通过交易号查询出来的匹配金额
                    
                    $currentTime=time();//统一时间
                    
                    //改变当前交易号所在记录的状态
                    $kcbOrder->uid=Yii::app()->user->getId();//用户id
                    $kcbOrder->status=1;//是否完成支付，变状态为1
                    $kcbOrder->completetime=$currentTime;//完成充值时间
                    $kcbOrder->save();//更新记录信息
                    
					//更新平台余额
					$criteria = new CDbCriteria;
                    $criteria->condition='catalog=1 or (catalog=8 and txStatus=2)';
                    $criteria->order ="id desc";
					$yuerow = Recordlist::model()->find($criteria);
					if($yuerow){
						$yue=$yuerow['yue']+$nowNumber;
					}else{
						$yue=$nowNumber;
					}
					//更新平台余额结束
                    //添加流水
                    $record=new Recordlist();
                    $record->userid=Yii::app()->user->getId();//用户id
                    $record->catalog=1;//充值类型
                    $record->number=$nowNumber;//操作数量
					$record->yue=$yue;//平台余额
                    $record->time=$currentTime;//操作时间
                    $record->save();//保存流水
					
					
                    
                    //改变充值后帐户的余额
                    $userinfo=User::model()->findByPk(Yii::app()->user->getId());
                    $userinfo->Money=$userinfo->Money+$nowNumber;//在原有的基本上增加本次操作的金额数量
                    $userinfo->save();
                    
                    echo "SUCCESS";
                    Yii::app()->end();   
                }
                else//已经被使用过
                {
                    echo "EXIST";
                    Yii::app()->end();
                }
            }
            else//该交易号不存在
            {
                echo "NOPNO";
                Yii::app()->end();
            }
            
        }
        $this->render('userPayCenter');
    }
    
    
    /*
        用户中心-帐号充值
    */
    public function actionUserPayCenterCFT()
    {
        if(isset($_POST['businessRecord']) && $_POST['businessRecord']!="")
        {
            /*echo $_POST['businessRecord'];//交易号
            exit;*/
            //根据交易号进行查找
            $kcbOrder=Kcborder::model()->findByAttributes(array("tno"=>$_POST['businessRecord']));
            if(count($kcbOrder)==1)//交易号存在则进行检查
            {
                if($kcbOrder->status==0 && $kcbOrder->uid==0)//如果存在符合条件
                {
                    $nowNumber=$kcbOrder->money;//本次操作的金额数量，即通过交易号查询出来的匹配金额
                    
                    $currentTime=time();//统一时间
                    
                    //改变当前交易号所在记录的状态
                    $kcbOrder->uid=Yii::app()->user->getId();//用户id
                    $kcbOrder->status=1;//是否完成支付，变状态为1
                    $kcbOrder->completetime=$currentTime;//完成充值时间
                    $kcbOrder->save();//更新记录信息
                    
                    //添加流水
                    $record=new Recordlist();
                    $record->userid=Yii::app()->user->getId();//用户id
                    $record->catalog=1;//充值类型
                    $record->number=$nowNumber;//操作数量
                    $record->time=$currentTime;//操作时间
                    $record->save();//保存流水
                    
                    //改变充值后帐户的余额
                    $userinfo=User::model()->findByPk(Yii::app()->user->getId());
                    $userinfo->Money=$userinfo->Money+$nowNumber;//在原有的基本上增加本次操作的金额数量
                    $userinfo->save();
                    
                    echo "SUCCESS";
                    Yii::app()->end();   
                }
                else//已经被使用过
                {
                    echo "EXIST";
                    Yii::app()->end();
                }
            }
            else//该交易号不存在
            {
                echo "NOPNO";
                Yii::app()->end();
            }
            
        }
        $this->render('userPayCenterCFT');
    }
    
    
    /*
        用户中心-帐号充值明细
    */
    public function actionUserPayDetail()
    {
        //查询用户充值记录
        $criteria = new CDbCriteria;
        $criteria->condition='userid='.Yii::app()->user->getId().' and catalog in(1,7)';
        $criteria->order ="id desc";
    
        //分页开始
        $total = Recordlist::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Recordlist::model()->findAll($criteria);
        //分页结束
        $this->render('userPayDetail',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    /*
        用户中心-推广奖励明细
    */
    public function actionUserSpreadDetail()
    {
        //查询用户推广奖励记录
        $criteria = new CDbCriteria;
        $criteria->condition='userid='.Yii::app()->user->getId().' and catalog=18';
        $criteria->order ="id desc";
    
        //分页开始
        $total = Recordlist::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Recordlist::model()->findAll($criteria);
        //分页结束
        $this->render('userSpreadDetail',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    /*
        用户中心-米粒明细
    */
    public function actionUserPayDetailMinLi()
    {
        //查询用户充值记录
        $criteria = new CDbCriteria;
        $criteria->condition='userid='.Yii::app()->user->getId().' and catalog in(2,9)';
        $criteria->order ="id desc";
    
        //分页开始
        $total = Recordlist::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Recordlist::model()->findAll($criteria);
        //分页结束
        
        $this->render('userPayDetailMinLi',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    /*
        用户中心-任务明细
    */
    public function actionuserPayDetailTask()
    {
        //查询用户充值记录
        $criteria = new CDbCriteria;
        $criteria->condition='userid='.Yii::app()->user->getId().' and catalog in(3,4,5,6,16,17,13,14,15)';
        $criteria->order ="id desc";
    
        //分页开始
        $total = Recordlist::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Recordlist::model()->findAll($criteria);
        //分页结束
        
        $this->render('userPayDetailTask',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    /*
        用户中心-明细-提现明细
    */
    public function actionUserPayDetailTX()
    {
        //查询用户提现记录
        $criteria = new CDbCriteria;
        $criteria->condition='userid='.Yii::app()->user->getId().' and catalog=8';
        $criteria->order ="id desc";
    
        //分页开始
        $total = Recordlist::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Recordlist::model()->findAll($criteria);
        //分页结束
        
        $this->render('userPayDetailTX',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    /*
        用户中心-明细-登录明细
    */
    public function actionUserLoginDetail()
    {
        //查询用户提现记录
        $criteria = new CDbCriteria;
        $criteria->condition='userid='.Yii::app()->user->getId();
        $criteria->order ="id desc";
    
        //分页开始
        $total = Loginlog::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Loginlog::model()->findAll($criteria);
        //分页结束
        
        $this->render('userLoginDetail',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    
    /*
        用户中心-申请提现
    */
    public function actionUserCashToBank()
    {
        if(isset($_POST['txMoneyNum']) && $_POST['txMoneyNum']!="" && isset($_POST['bankid']) && $_POST['bankid']!="")
        {
            $userinfo=User::model()->findByPk(Yii::app()->user->getId());
            if($_POST['txMoneyNum']<$userinfo->Money)//提现金额正常
            {
                //添加流水
                $record=new Recordlist();
                $record->userid=Yii::app()->user->getId();//用户id
                $record->catalog=8;//提现类型
                $record->number=$_POST['txMoneyNum'];//提现的金额
                $record->time=time();//操作时间
                $record->bankid=$_POST['bankid'];//银行卡id
                $record->txStatus=1;//提现申请中
                $record->save();//保存流水
                
                $userinfo->Money=$userinfo->Money-$_POST['txMoneyNum'];//余额等于原有金额减去提现金额
                if($userinfo->save())
                    echo "SUCCESS";
                else
                    echo "FAIL";
            }
            else//提现金额大于余额
                echo "MONEYTOOMATCH";
        }
        else
            $this->render('userCashToBank');
    }
    
    /*
        用户中心-用户提现列表
    */
    public function actionUserTxList()
    {
        //查询用户提现记录
        $criteria = new CDbCriteria;
        $criteria->condition='userid='.Yii::app()->user->getId().' and catalog=8';
        $criteria->order ="id desc";
    
        //分页开始
        $total = Recordlist::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Recordlist::model()->findAll($criteria);
        //分页结束
        
        $this->render('userTxList',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    
    /*
        用户中心-米粒回收
    */
    public function actionUserMiliToCash()
    {
        if(isset($_POST['MinLi']) && $_POST['MinLi']!="")
        {
            //根据VIP等级回收米粒的价格不同
            $backMinLiPriceVIP0=System::model()->findByAttributes(array("varname"=>"backMinLiPriceVIP0"));
            $backMinLiPriceVIP1=System::model()->findByAttributes(array("varname"=>"backMinLiPriceVIP1"));
            $backMinLiPriceVIP2=System::model()->findByAttributes(array("varname"=>"backMinLiPriceVIP2"));
            $backMinLiPriceVIP3=System::model()->findByAttributes(array("varname"=>"backMinLiPriceVIP3"));
            $userinfo=User::model()->findByPk(Yii::app()->user->getId());
            if($userinfo || $userinfo->MinLi>$_POST['MinLi'])
            {
                switch($userinfo->VipLv)
                {
                    case 0:
                        $toMoneyRes=$_POST['MinLi']*$backMinLiPriceVIP0->value;//新手会员0.42元一个米粒
                        break;
                    case 1:
                        $toMoneyRes=$_POST['MinLi']*$backMinLiPriceVIP1->value;//vip1会员0.42元一个米粒
                        break;
                    case 2:
                        $toMoneyRes=$_POST['MinLi']*$backMinLiPriceVIP2->value;//vip2会员0.42元一个米粒
                        break;
                    case 3:
                        $toMoneyRes=$_POST['MinLi']*$backMinLiPriceVIP3->value;//vip3会员0.42元一个米粒
                        break;
                }
                //更新平台余额
				$criteria = new CDbCriteria;
                $criteria->condition='catalog in (2,7)';
                $criteria->order ="id desc";
			    $yuerow = Recordlist::model()->find($criteria);
				if($yuerow){
					$yue=$yuerow['yue']-$_POST['MinLi'];
				}else{
					$yue=0;
				}
				//更新平台余额结束
                //添加流水
                //1.保存米粒回收流水
                $record=new Recordlist();
                $record->userid=Yii::app()->user->getId();//用户id
                $record->catalog=7;//米粒回收类型
                $record->number=$toMoneyRes;//回收后的金额
                $record->MinLi=$_POST['MinLi'];//回收使用的米粒
				$record->yue=$yue;
                $record->time=time();//操作时间
                $record->save();//保存流水
                
                //2.改变回收米粒后帐户的余额与米粒数量
                $userinfo->Money=$userinfo->Money+$toMoneyRes;//在原有余额基本上加米粒回收转换成的金额
                $userinfo->MinLi=$userinfo->MinLi-$_POST['MinLi'];//在原有米粒基础上加上回收用掉的米粒
                $userinfo->save();
                
                echo "SUCCESS";
                Yii::app()->end();
                
            }else
            {
                echo "FAIL";
                Yii::app()->end();
            }
        }
        $this->render('userMiliToCash');
    }
    
    /*
        用户中心-黑名单
    */
    public function actionUserBlackAccountList()
    {
        if(isset($_POST['reason']) && $_POST['reason']!="" && isset($_POST['blackerusername']) && $_POST['blackerusername']!="")
        {
            $blackinfo=Myblackerlist::model()->findByAttributes(array('userid'=>Yii::app()->user->getId(),'blackerusername'=>$_POST['blackerusername']));
            if($blackinfo)//黑名单已存在
            {
                echo "EXIST";
            }
            else
            {
                $newBlack=new Myblackerlist();
                $newBlack->userid=Yii::app()->user->getId();
                $newBlack->blackerusername=$_POST['blackerusername'];
                $newBlack->reason=$_POST['reason'];
                $newBlack->time=time();
                if($newBlack->save())
                    echo "SUCCESS";
                else
                    echo "FAIL";
            }
        }
        else
        {
            $criteria = new CDbCriteria;
            $criteria->condition='userid='.Yii::app()->user->getId();
            $criteria->order ="id desc";
        
            //分页开始
            $total = Myblackerlist::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=10;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Myblackerlist::model()->findAll($criteria);
            //分页结束
            
            $this->render('userBlackAccountList',array(
                'proInfo' => $proreg,
                'pages' => $pages
            ));
        }
    }
    
    /*
        用户中心-删除黑名单
    */
    public function actionUserBlackDel()
    {
        if(isset($_POST['blackid']) && $_POST['blackid']!="")
        {
            $blackInfo=Myblackerlist::model()->findByPk($_POST['blackid']);
            if($blackInfo->userid==Yii::app()->user->getId())
            {
                if($blackInfo->delete())
                    echo "SUCCESS";
                else
                    echo "FAIL";
            }else
            {
                echo "FAIL";
            }
        }
    }
    
    /*
        用户中心-官方收件箱
    */
    public function actionUserMessage()
    {
        $criteria = new CDbCriteria;
        $criteria->condition='cat_id=42 and is_delete=0';
        $criteria->select='add_time,goods_id,goods_name,cat_id';
        $criteria->order ="add_time desc";
    
        //分页开始
        $total =Article::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Article::model()->findAll($criteria);
        //分页结束
        
        $this->render('userMessage',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    
    /*
        用户中心-站内提醒
    */
    public function actionUserMessageWarning()
    {
        $criteria = new CDbCriteria;
        $criteria->condition='cat_id=43 and is_delete=0';
        $criteria->select='add_time,goods_id,goods_name,cat_id';
        $criteria->order ="add_time desc";
    
        //分页开始
        $total =Article::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Article::model()->findAll($criteria);
        //分页结束
        
        $this->render('userMessageWarning',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    /*
        用户中心-发布任务-获取掌柜号
    */
    public function actionGetSeller()
    {
        $sellerInfo=Blindwangwang::model()->findAll(array(
            'condition'=>'userid='.Yii::app()->user->getId().' and authStoreStatus=1 and catalog=2 and platform='.$_POST['platform'],
            'select'=>'id,wangwang',
            'order'=>'id desc'
        ));
        if(count($sellerInfo)==0)//没有相应的掌柜号
        {
            echo "NOSELLER";
        }else
        {
            $optionStr="";
            foreach($sellerInfo as $val)
            {
                $optionStr.="<option value='".$val->wangwang."'>".$val->wangwang."</option>";
            }
            echo $optionStr;
        }
    }
    
     /*
        绑定认证掌柜号-删除掌柜号
    */
    public function actionDeleteWangwang()
    {
        if(isset($_GET['id']))
        {
            $wangwang=Blindwangwang::model()->findByPk($_GET['id']);
            $wangwang->delete();
            $this->redirect(Yii::app()->request->urlReferrer);
        }
    }
}