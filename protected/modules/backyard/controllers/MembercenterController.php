<?php
    class MembercenterController extends Aclfilter{
        
        public $layout='//layouts/backyard';//定义布局以便加载kindeditor文本编辑器的css与js
        
        /*
            会员管理-会员列表
        */
        public function actionMemberlist()
        {
            parent::acl();
            //设置白名单
            if(isset($_GET['Opend']) && isset($_GET['id']) && $_GET['id']>0)
            {
                $userinfo=User::model()->findByPk($_GET['id']);
                $userinfo->Opend=$_GET['Opend'];//修改是否为白名单
                $userinfo->save();
                $this->redirect(Yii::app()->request->urlReferrer);
                Yii::app()->end();
            }
            if(isset($_POST['keyword']))//关键词搜索
            {
                $criteria = new CDbCriteria;
                $criteria->condition='Username="'.$_POST['keyword'].'" or Phon="'.$_POST['keyword'].'"';
                //分页开始
                $total = User::model()->count($criteria);
                $pages = new CPagination($total);
                $pages->pageSize=12;//分页大小
                $pages->applyLimit($criteria);
                
                $proreg = User::model()->findAll($criteria);
                //分页结束
                $this->renderPartial('memberlist',array(
                    'proInfo' => $proreg,
                    'pages' => $pages
                ));
                Yii::app()->end();
            }
            $criteria = new CDbCriteria;
            $criteria->order ="RegTime desc";
        
            //分页开始
            $total = User::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=12;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = User::model()->findAll($criteria);
            //分页结束
            $this->renderPartial('memberlist',array(
                'proInfo' => $proreg,
                'pages' => $pages
            ));
        }
        
        
        /*
            会员管理-冻结帐号
        */
        public function actionStopaccount()
        {
            parent::acl();
            $userinfo=User::model()->findByPk($_GET['userid']);
            $userinfo->Status=1;
            $userinfo->save();
            $this->redirect(Yii::app()->request->urlReferrer);
        }
        
        /*
            会员管理-解冻帐号
        */
        public function actionStartaccount()
        {
            parent::acl();
            $userinfo=User::model()->findByPk($_GET['userid']);
            $userinfo->Status=0;
            $userinfo->save();
            $this->redirect(Yii::app()->request->urlReferrer);
        }
        
        
        /*
            会员管理-会员信息
        */
        public function actionMembeDetailInfos()
        {
            parent::acl();
            if(isset($_GET['uid']) && $_GET['uid']<>0)
            {
                $userinfo=User::model()->findByPk($_GET['uid']);			
                $this->render('membeDetailInfos',array(
                    'userinfo'=>$userinfo
                ));
            }
        }
        
        /*
            会员管理-修改会员密码
        */
        public function actionChangPassword()
        {
            parent::acl();
            if(isset($_POST['newpassword']) && $_POST['newpassword']!="" && isset($_POST['uid']) && $_POST['uid']!="")
            {
                $userinfo=User::model()->findByPk($_POST['uid']);
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
            会员管理-修改会员真实姓名
        */
        public function actionChangename()
        {
            //parent::acl();
            if(isset($_POST['changename']) && $_POST['changename']!="" && isset($_POST['uid']) && $_POST['uid']!="")
            {
                $userinfo=User::model()->findByPk($_POST['uid']);
                $userinfo->TrueName=$_POST['changename'];//修改真实姓名
                if($userinfo->save())
                    echo "SUCCESS";
                else
                    echo "FAIL";
            }
            else
                echo "FAIL";
            
        }
        
		/*
            会员管理-修改会员qq
        */
        public function actionChangeqq()
        {
            //parent::acl();
            if(isset($_POST['changeqq']) && $_POST['changeqq']!="" && isset($_POST['uid']) && $_POST['uid']!="")
            {
                $userinfo=User::model()->findByPk($_POST['uid']);
                $userinfo->QQToken=$_POST['changeqq'];//修改真实姓名
                if($userinfo->save())
                    echo "SUCCESS";
                else
                    echo "FAIL";
            }
            else
                echo "FAIL";
            
        }
		
        /*
            会员管理-手动充值
        */
        public function actionGivePay()
        {
            parent::acl();
            if(isset($_POST['Money']) && $_POST['Money']!="" && isset($_POST['uid']) && $_POST['uid']!="")
            {
                $userinfo=User::model()->findByPk($_POST['uid']);
                $userinfo->Money=$userinfo->Money+$_POST['Money'];//改变金额
                if($userinfo->save())
                    echo "SUCCESS";
                else
                    echo "FAIL";
            }
            else
                echo "FAIL";
        }
        
        /*
            会员管理-手动修改米粒
        */
        public function actionChangMinLi()
        {
            parent::acl();
            if(isset($_POST['changMinLi']) && $_POST['changMinLi']!="" && isset($_POST['uid']) && $_POST['uid']!="")
            {
                $userinfo=User::model()->findByPk($_POST['uid']);
                $userinfo->MinLi=$userinfo->MinLi+$_POST['changMinLi'];//改变米粒
                if($userinfo->save())
                    echo "SUCCESS";
                else
                    echo "FAIL";
            }
            else
                echo "FAIL";
        }
        
        /*
            会员管理-修改手机号码
        */
        public function actionChangePhone()
        {
            parent::acl();
            if(isset($_POST['phone']) && $_POST['phone']!="" && isset($_POST['uid']) && $_POST['uid']!="")
            {
                $userinfo=User::model()->findByPk($_POST['uid']);
                $userinfo->Phon=$_POST['phone'];//改变手机号码
                if($userinfo->save())
                    echo "SUCCESS";
                else
                    echo "FAIL";
            }
            else
                echo "FAIL";
        }
        
		/*
            会员管理-删除会员
        */
        public function actionMemberdelete()
        {
            parent::acl();
            if(isset($_GET['id']))
            {
				$userId=intval($_GET['id']);
                $userinfo=User::model()->findByPk($userId);
                /*
                    判断如果会员不存在，则提示无法执行删除操作
                */
                if($userinfo['id'] > 0)
                {
                    if($userinfo->delete())
                    {
                        $this->redirect(array('membercenter/memberlist'));
                    }
                    else
                    {
                        $this->redirect_message('用户删除失败，请重试','success',3,$this->createUrl('membercenter/memberlist'));
                    }
                }
                else
                    $this->redirect_message('用户不存在','success',3,$this->createUrl('membercenter/memberlist'));
            }
        }
		
        /*
            会员管理-威客实名认证审核
        */
        public function actionAuthperson()
        {
            parent::acl();
            if(isset($_POST['keyword']) && $_POST['keyword']!="")
            {
                $userinfo=User::model()->findByAttributes(array("Username"=>$_POST['keyword']));
                if($userinfo)
                {
                    $uid=$userinfo->id;
                }
                else
                {
                    $uid=0;
                }
                $criteria = new CDbCriteria;
                $criteria->condition='uid='.$uid;
                $criteria->order ="id desc";
            
                //分页开始
                $total = Authperson::model()->count($criteria);
                $pages = new CPagination($total);
                $pages->pageSize=12;//分页大小
                $pages->applyLimit($criteria);
                
                $proreg = Authperson::model()->findAll($criteria);
                //分页结束
                $this->renderPartial('authperson',array(
                    'proInfo' => $proreg,
                    'pages' => $pages
                ));
            }
            //通过视频认证即认证通过
            if(isset($_GET['authid']) && $_GET['uid'] && !isset($_GET['nopass']))
            {
                $authinfo=Authperson::model()->findByPk($_GET['authid']);
                $authinfo->status=1;
                $authinfo->passtime=time();
                $authinfo->save();
                
                $userinfo=User::model()->findByPk($_GET['uid']);
                $userinfo->AuthPersonStep2=1;
                $userinfo->AuthPerson=1;
                $userinfo->save();
                
                $this->redirect(Yii::app()->request->urlReferrer);
                Yii::app()->end();
            }
            
            //取消通过
            if(isset($_GET['nopass']) && isset($_GET['authid']) && $_GET['uid'])//通过视频认证
            {
                $authinfo=Authperson::model()->findByPk($_GET['authid']);
                $authinfo->delete();
                
                $userinfo=User::model()->findByPk($authinfo->uid);
                $userinfo->AuthPerson=0;//取消认证
                $userinfo->AuthPersonStep2=0;
                $userinfo->AuthPersonStep1=0;
                $userinfo->save();
                
                $this->redirect(Yii::app()->request->urlReferrer);
                Yii::app()->end();
            }
            
            $criteria = new CDbCriteria;
            $criteria->order ="id desc";
        
            //分页开始
            $total = Authperson::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=12;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Authperson::model()->findAll($criteria);
            //分页结束
            $this->renderPartial('authperson',array(
                'proInfo' => $proreg,
                'pages' => $pages
            ));
        }
        
        /*
            会员管理-买号管理
        */
        public function actionBuyerlist()
        {
            parent::acl();
            if(isset($_POST['keyword']))
            {
                $criteria = new CDbCriteria;
                $criteria->condition="catalog=1 and wangwang like '%".$_POST['keyword']."%'";
                $criteria->order ="id desc";
            
                //分页开始
                $total = Blindwangwang::model()->count($criteria);
                $pages = new CPagination($total);
                $pages->pageSize=12;//分页大小
                $pages->applyLimit($criteria);
                
                $proreg = Blindwangwang::model()->findAll($criteria);
                //分页结束
                $this->renderPartial('buyerlist',array(
                    'proInfo' => $proreg,
                    'pages' => $pages
                ));
            }else
            {
                $criteria = new CDbCriteria;
                $criteria->condition="catalog=1";
                $criteria->order ="id desc";
            
                //分页开始
                $total = Blindwangwang::model()->count($criteria);
                $pages = new CPagination($total);
                $pages->pageSize=12;//分页大小
                $pages->applyLimit($criteria);
                
                $proreg = Blindwangwang::model()->findAll($criteria);
                //分页结束
                $this->renderPartial('buyerlist',array(
                    'proInfo' => $proreg,
                    'pages' => $pages
                ));
            }
        }
        
        /*
            会员管理-买号管理
        */
        public function actionSellerlist()
        {
            parent::acl();
            if(isset($_POST['keyword']))
            {
                $criteria = new CDbCriteria;
                $criteria->condition="catalog=2 and wangwang like '%".$_POST['keyword']."%'";
                $criteria->order ="id desc";
            
                //分页开始
                $total = Blindwangwang::model()->count($criteria);
                $pages = new CPagination($total);
                $pages->pageSize=12;//分页大小
                $pages->applyLimit($criteria);
                
                $proreg = Blindwangwang::model()->findAll($criteria);
                //分页结束
                $this->renderPartial('sellerlist',array(
                    'proInfo' => $proreg,
                    'pages' => $pages
                ));
            }else
            {
                $criteria = new CDbCriteria;
                $criteria->condition="catalog=2";
                $criteria->order ="id desc";
            
                //分页开始
                $total = Blindwangwang::model()->count($criteria);
                $pages = new CPagination($total);
                $pages->pageSize=12;//分页大小
                $pages->applyLimit($criteria);
                
                $proreg = Blindwangwang::model()->findAll($criteria);
                //分页结束
                $this->renderPartial('sellerlist',array(
                    'proInfo' => $proreg,
                    'pages' => $pages
                ));
            }
        }
        
        /*
            ***手动通过掌柜号认证
        */
        public function actionLetSellerPass()
        {
            if(isset($_GET['authid']) && $_GET['authid']!="")
            {
                $wangwanginfo=Blindwangwang::model()->findByPk($_GET['authid']);
                $wangwanginfo->authStoreUrl="管理员手动通过";
                $wangwanginfo->authStoreStep2=1;
                $wangwanginfo->authStoreStatus=1;//审核通过
                $wangwanginfo->authStorepasstime=time();
                $wangwanginfo->save();
                $this->redirect(Yii::app()->request->urlReferrer);
            }
        }
        
        /*
            会员管理-删除买号或者掌柜号
        */
        public function actionWangwangdel()
        {
            parent::acl();
            if(isset($_GET['id']))
            {
                $wangwanginfo=Blindwangwang::model()->findByPk($_GET['id']);
                $wangwanginfo->delete();
                $this->redirect(Yii::app()->request->urlReferrer);
            }
        }
    }
?>