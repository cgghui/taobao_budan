<?php
    class TaskcenterController extends Aclfilter{
        
        public $layout='//layouts/backyard';//定义布局以便加载kindeditor文本编辑器的css与js
        
        /*
            ***冻结帐号
        */
        public function actionTasklist()
        {
            parent::acl();
            if(isset($_GET['Username']) && $_GET['Username']!="")
            {
                $userinfo=User::model()->findByAttributes(array('Username'=>$_GET['Username']));
                $criteria = new CDbCriteria;
                $criteria->condition='publishid='.$userinfo->id.' or taskerid='.$userinfo->id;
                $criteria->order ="time desc";
            
                //分页开始
                $total = Companytasklist::model()->count($criteria);
                $pages = new CPagination($total);
                $pages->pageSize=10;//分页大小
                $pages->applyLimit($criteria);
                
                $proreg = Companytasklist::model()->findAll($criteria);
                //分页结束
                
                $this->renderPartial('tasklist',array(
                    'total'=>$total,
                    'proInfo' => $proreg,
                    'pages' => $pages
                ));
                Yii::app()->end();
            }
            if(isset($_GET['act_start_time']) && isset($_GET['act_stop_time']) && isset($_GET['status']))//查询
            {
                if(isset($_GET['taskNumber']) && $_GET['taskNumber']!="")//任务编号搜索
                {
                    $conArr=explode('*',$_GET['taskNumber']);
                    $criteria = new CDbCriteria;
                    $criteria->condition='id='.$conArr[1];
                    $criteria->order ="time desc";
                
                    //分页开始
                    $total = Companytasklist::model()->count($criteria);
                    $pages = new CPagination($total);
                    $pages->pageSize=10;//分页大小
                    $pages->applyLimit($criteria);
                    
                    $proreg = Companytasklist::model()->findAll($criteria);
                    //分页结束
                    
                    $this->renderPartial('tasklist',array(
                        'total'=>$total,
                        'proInfo' => $proreg,
                        'pages' => $pages
                    ));
                    Yii::app()->end();
                }
                $_GET['status']!=8?$condition='status='.$_GET['status']:$condition='status<'.$_GET['status'];
                if($_GET['act_start_time']!="")
                    $condition.=' and taskfristTime>'.strtotime($_GET['act_start_time']);
                if($_GET['act_stop_time']!="")
                    $condition.=' and taskfristTime<'.strtotime($_GET['act_stop_time']);
                
                $criteria = new CDbCriteria;
                $criteria->condition=$condition;
                $criteria->order ="time desc";
            
                //分页开始
                $total = Companytasklist::model()->count($criteria);
                $pages = new CPagination($total);
                $pages->pageSize=10;//分页大小
                $pages->applyLimit($criteria);
                
                $proreg = Companytasklist::model()->findAll($criteria);
                //分页结束
                
                $this->renderPartial('tasklist',array(
                    'total'=>$total,
                    'proInfo' => $proreg,
                    'pages' => $pages
                ));
                Yii::app()->end();
            }
            
            $criteria = new CDbCriteria;
            $criteria->order ="time desc";
        
            //分页开始
            $total = Companytasklist::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=10;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Companytasklist::model()->findAll($criteria);
            //分页结束
            
            $this->renderPartial('tasklist',array(
                'total'=>$total,
                'proInfo' => $proreg,
                'pages' => $pages
            ));
        }
        
        /*
            任务详情
        */
        public function actionTaskdetail()
        {
            $taskinfo=Companytasklist::model()->findByPk($_GET['taskid']);
            $this->renderPartial('taskdetail',array(
                'item'=>$taskinfo
            ));
        }
        
        /*
            ***任务删除
        */
        public function actionTaskdel()
        {
            parent::acl();
            if(isset($_GET['id']))
            {
                $taskinfo=Companytasklist::model()->findByPk($_GET['id']);
                $taskinfo->delete();
                $this->redirect(Yii::app()->request->urlReferrer);
            }
        }
    }
?>