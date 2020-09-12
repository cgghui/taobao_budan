<?php
    class AclController extends Aclfilter
    {   
        /*权限管理控制界面*/
        public function actionAclmanager()
        {
            parent::acl();
            $this->renderPartial('aclmanager');
        }
        
        /*权限管理翻译界面*/
        public function actionAcltranslate()
        {
            parent::acl();
            $this->renderPartial('acltranslate');
        }
        
        /*
            权限不足提示信息
        */
        public function actionPassfail()
        {
            $this->renderPartial('passfail');
        }
        
        /*
            控制器翻译信息存储与修改
        */
        public function actionTranslatecontroller()
        {
            parent::acl();
            if(isset($_POST['controllerid']) && isset($_POST['controlleridChinaese']))
            {
                $translate=Translatecontrollerid::model()->findByAttributes(array("controllerid"=>$_POST['controllerid']));
                if(count($translate)==0)//如果数据库中不存在该控制器的翻译信息执行修改操作
                {
                    $translateAdd=new Translatecontrollerid;
                    $translateAdd->controllerid=$_POST['controllerid'];
                    $translateAdd->controlleridChinaese=$_POST['controlleridChinaese'];
                    $translateAdd->save();
                }
                else
                {
                    $translate->controlleridChinaese=$_POST['controlleridChinaese'];
                    $translate->save();
                }
            }
        }
        
        /*
            方法翻译信息存储与修改
        */
        public function actionTranslateaction()
        {
            parent::acl();
            if(isset($_POST['actionid']) && isset($_POST['actionidChinaese']) && isset($_POST['controllerid']))
            {
                $translate=Translateactionid::model()->findByAttributes(array("actionid"=>$_POST['actionid'],"controllerid"=>$_POST['controllerid']));
                if(count($translate)==0)//如果数据库中不存在该控制器的翻译信息执行修改操作
                {
                    $translateAdd=new Translateactionid;
                    $translateAdd->actionid=$_POST['actionid'];
                    $translateAdd->actionidChinaese=$_POST['actionidChinaese'];
                    $translateAdd->controllerid=$_POST['controllerid'];
                    $translateAdd->save();
                }
                else
                {
                    if(empty($translate->controllerid))
                    {
                        $translate->controllerid=$_POST['controllerid'];
                    }
                    $translate->actionidChinaese=$_POST['actionidChinaese'];
                    $translate->save();
                }
            }
        }
        
        /*
            控制中心添加用户组
        */
        public function actionAddaclgroup()
        {
            parent::acl();
            if(isset($_POST['acllist']) && isset($_POST['groupname']))
            {
                $aclgroup=Aclgroup::model()->findByAttributes(array("groupname"=>$_POST['groupname']));
                if(count($aclgroup)!=0)
                {
                    echo "groupnameexist";
                }
                else
                {
                    $addaclgroup=new Aclgroup;
                    $addaclgroup->acllist=$_POST['acllist'];
                    $addaclgroup->groupname=$_POST['groupname'];
                    if($addaclgroup->save())
                    {
                        echo "save";
                    }
                    else
                        echo "savefail";
                }
            }
        }
        
        /*
            用户组列表管理
        */
        public function actionAclgrouplist()
        {
            parent::acl();
            $criteria = new CDbCriteria;
            $criteria->order ="id asc";

            //分页开始
            $total = Aclgroup::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=5;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Aclgroup::model()->findAll($criteria);//查询销售填写记录
            
            $this->renderPartial('aclgrouplist',array(
                'proInfo' => $proreg,
                'pages' => $pages,
            ));
        }
        
        /*
            修改用户组权限
        */
        public function actionAclgroupeditpower()
        {
            parent::acl();
            if(isset($_GET['groupid']))
            {
                $aclgroupinfo=Aclgroup::model()->findByPk($_GET['groupid']);
                $this->renderPartial('aclgroupeditpower',array(
                    'aclgroupinfo'=>$aclgroupinfo,
                ));
            }
            
            /*
                修改用户组权限
            */
            if(isset($_POST['acllist']) && isset($_POST['groupname']) && isset($_POST['groupid']))
            {
                $aclgroup=Aclgroup::model()->findAllByAttributes(array("groupname"=>$_POST['groupname']));
                if(count($aclgroup)>1)
                {
                    echo "groupnameexist";
                }
                else
                {
                    $aclgroupchange=Aclgroup::model()->findByPk($_POST['groupid']);
                    $aclgroupchange->acllist=$_POST['acllist'];
                    $aclgroupchange->groupname=$_POST['groupname'];
                    if($aclgroupchange->save())
                    {
                        echo "save";
                    }
                    else
                        echo "savefail";
                }
            }
        }
        
        /*
            用户列表
        */
        public function actionManagerlist()
        {
            parent::acl();
            $criteria = new CDbCriteria;
            $criteria->order ="groupid asc";

            //分页开始
            $total = Admin::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=5;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Admin::model()->findAll($criteria);//查询销售填写记录
            
            $this->renderPartial('managerlist',array(
                'proInfo' => $proreg,
                'pages' => $pages,
            ));
        }
        
        /*
            修改用户信息
        */
        public function actionManagerinfochange()
        {
            parent::acl();
            /*
                根据传递过来的用户id进行业务逻辑操作
            */
            if(isset($_GET['id']))
            {
                /*
                    如果是系统管理员或者用户本人则可以执行修改操作
                */
                if(Admin::model()->findByPk(Yii::app()->user->getId())->groupid==0 || Yii::app()->user->getId()==$_GET['id'])
                {
                    /*
                        渲染用户信息候页面
                    */
                    $managerinfo=Admin::model()->findByPk($_GET['id']);
                    //var_dump($managerinfo);exit;
                    $this->renderPartial('managerinfochange',array(
                        "managerinfo"=>$managerinfo,
                    ));
                    Yii::app()->end();
                }
                else
                {
                    $this->redirect(array('acl/passfail'));
                }
            }
                
            /*
                接收参数修改用户信息
            */
            if(isset($_POST['newpwd'])  && isset($_POST['id']) && $_POST['newpwd']!="")
            {
                $managerinfochange=Admin::model()->findByPk($_POST['id']);
                $managerinfochange->pwd=md5($_POST['newpwd']);
                if($managerinfochange->save())
                {
                    $this->redirect_message("密码修改成功，请重新登录","success",3,$this->createUrl('default/loginout'));
                }
                else
                    $this->redirect_message("密码修改失败请联系管理员","success",3,$this->createUrl('acl/managerlist'));
            }
            else
            {
                $managerinfo=Admin::model()->findByPk($_POST['id']);
                    //var_dump($managerinfo);exit;
                $this->renderPartial('managerinfochange',array(
                    "managerinfo"=>$managerinfo,
                    "emptywarning"=>"密码不能为空",
                    "id"=>$_POST['id'],
                ));
            }
        }
        
        /*
            删除用户
        */
        public function actionManagerdelete()
        {
            parent::acl();
            if(isset($_GET['id']))
            {
                $parentuserinfo=Admin::model()->findByPk(Yii::app()->user->getId());
                /*
                    判断如果当前的用户不是超级管理员，同时删除的用户不是当前登录的用户，则提示无法执行删除操作
                */
                if($parentuserinfo->groupid==0 && $_GET['id']!=Yii::app()->user->getId())
                {
                    $delinfo=Admin::model()->findByPk($_GET['id']);
                    if($delinfo->delete())
                    {
                        $this->redirect(array('acl/managerlist'));
                    }
                    else
                    {
                        $this->redirect_message('用户删除失败，请联系管员','success',3,$this->createUrl('acl/managerlist'));
                    }
                }
                else
                    $this->redirect(array('acl/passfail'));
            }
        }
        
        /*
            添加管理员
        */
        public function actionManageradd()
        {
            parent::acl();
            if(isset($_POST['username']) && isset($_POST['newpwd']))
            {
                $addadmin=new Admin;
                $addadmin->username=$_POST['username'];
                $addadmin->pwd=md5($_POST['newpwd']);
                $addadmin->groupid=$_POST['groupid'];
                if($addadmin->save())
                {
                    $this->redirect(array('acl/managerlist'));
                }
                else
                    $this->redirect_message("添加管理员失败，请联系网站管理员","success",3,$this->createUrl('acl/managerlist'));
            }
            $groupinfo=Aclgroup::model()->findAll();
            $this->renderPartial('manageradd',array(
                "groupinfo"=>$groupinfo,
            ));
        }
    }
?>