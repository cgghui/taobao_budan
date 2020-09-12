<?php
    class Aclfilter extends Controller
    {
        /*
            初始化方法
        */
        public function init()
        {
            /*
                判断用户是否登录
            */
            if (Yii::app()->user->getId()=="")
            {
                $this->redirect(array ('user/login' ));
                Yii::app()->end();
            }
        }
        
        //判断用户权限
        public function acl(){
            $aclstatue=false;//初始化赋值状态为没有权限
            
            /*
                判断用户是否有权限给$aclstatue进行bool类型赋值，如果
            */
             $admininfo=Admin::model()->findByPk(Yii::app()->user->getId());
             $groupid=$admininfo->groupid;
             
             if($groupid!=0)//groupid不为0时表示不是超级管理员需要进行权限判断
             {
                 /*
                    验证条件，即访问页面的控制器ID与方法ID，格式如default/index
                 */
                 $aclsign=Yii::app()->controller->id."/".$this->getAction()->getId();
                 /*
                    查询当前用户所有用户组的信息
                 */
                 $acllistArr=explode(',',@Aclgroup::model()->findByPk($groupid)->acllist);
                 array_pop($acllistArr);//数组出椎即将最后一个空元素移除
                 /*
                    in_array($aclsign,$acllistArr,true)为1表示该用户所在的用户组拥有权限，null则表示该用户组没有权限执行该操作
                 */
                 if(in_array(strtolower($aclsign),$acllistArr,true)==null)
                 {
                     /*
                        没有权限执行提示操作
                     */
                     $this->redirect(array('acl/passfail'));
                 }
             }
        }
    }
?>