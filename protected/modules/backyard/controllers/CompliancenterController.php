<?php
    class CompliancenterController extends Aclfilter{
        
        public $layout='//layouts/backyard';//定义布局以便加载kindeditor文本编辑器的css与js
        
        /*
            投诉管理中心-投诉列表
        */
        public function actionComplianlist()
        {
            parent::acl();
            if(isset($_POST['keyword']))//搜索投诉信息
            {
                $criteria = new CDbCriteria;
                if($_POST['keyword']!="" && is_numeric($_POST['keyword']))
                    $criteria->condition='id='.$_POST['keyword'];
                $criteria->order='time desc';
                //分页开始
                $total = Complianlist::model()->count($criteria);
                $pages = new CPagination($total);
                $pages->pageSize=10;//分页大小
                $pages->applyLimit($criteria);
                
                $proreg = Complianlist::model()->findAll($criteria);
                //分页结束
                $this->renderPartial('complianlist',array(
                    'proInfo' => $proreg,
                    'pages' => $pages
                ));
            }
            else
            {
                $criteria = new CDbCriteria;
                $criteria->order='time desc';
                //分页开始
                $total = Complianlist::model()->count($criteria);
                $pages = new CPagination($total);
                $pages->pageSize=10;//分页大小
                $pages->applyLimit($criteria);
                
                $proreg = Complianlist::model()->findAll($criteria);
                //分页结束
                $this->renderPartial('complianlist',array(
                    'proInfo' => $proreg,
                    'pages' => $pages
                ));
            }
        }
        
        /*
            投诉管理-开始处理-改变投诉状态
        */
        public function actionStartHandle()
        {
            parent::acl();
            if(isset($_POST['id']) && $_POST['id']!="")
            {
                $complianinfo=Complianlist::model()->findByPk($_POST['id']);
                $complianinfo->status=1;//改变状态为处理中
                $complianinfo->handleBeginTime=time();//更新开始处理时间
                
                //任务状态发生改变
                $taskinfo=Companytasklist::model()->findByPk($complianinfo->taskid);
                $taskinfo->complian_status=2;//改变状态为处理中
                if($complianinfo->save() && $taskinfo->save())
                    echo "SUCCESS";
                else
                    echo "FAIL";
            }else
                echo "FAIL";
        }
        
        /*
            投诉管理-开始处理-进行最终的仲裁-发起人胜利
        */
        public function actionEndHandle()
        {
            parent::acl();
            //商家发起投诉-商家胜诉
            if(isset($_POST['id']) && $_POST['id']!="" && isset($_POST['complianStyle']) && $_POST['complianStyle']==2 && isset($_POST['publishid']) && $_POST['publishid']!="")
            {
                //投诉记录的状态
                $complianinfoOth=Complianlist::model()->findByPk($_POST['id']);
                $complianinfoOth->status=2;//改变状态为处理完成
                $complianinfoOth->winid=$_POST['publishid'];//胜诉方id
                $complianinfoOth->handleCompleteTime=time();//处理完成时间
                
                //改变任务状态
                $taskInfo=Companytasklist::model()->findByPk($complianinfoOth->taskid);
                $taskInfo->taskcompleteTime=time();//商家审核即任务完成时间
                $taskInfo->taskCompleteStatus=1;//任务完成，改变状态
                $taskInfo->save();
                
                //
				//执行退款操作
				if($taskInfo->payWay==1){//退金额
					    //进行加款操作
						//1.保存金额流水
                        $record=new Recordlist();
                        $record->userid=$taskInfo->publishid;//用户id
                        $record->catalog=14;//发布任务使用金额
                        $record->number=$taskInfo->txtPrice;//操作数量
                        $record->tasknum=1;//1个任务
						$record->taskid=$taskInfo->id;
                        $record->time=time();//操作时间
                        $record->save();//保存金额流水
				}
				//2.保存米粒流水
                $recordMinLi=new Recordlist();
                $recordMinLi->userid=$taskInfo->publishid;//用户id
                $recordMinLi->catalog=14;//发布任务使用米粒
                $recordMinLi->number=$taskInfo->MinLi;//操作数量
                $recordMinLi->tasknum=1;//1个任务
			    $recordMinLi->taskid=$taskInfo->id;
                $recordMinLi->time=time();//操作时间
                $recordMinLi->save();//保存米粒流水
					
				$userinfo=User::model()->findByPk($taskInfo->publishid);
				if($taskInfo->payWay==1){
					$userinfo->Money=$userinfo->Money+$taskInfo->txtPrice;//在原有余额基本上加上任务需要的金额
				}
				$userinfo->MinLi=$userinfo->MinLi+$taskInfo->MinLi;//在原有米粒基本上加上任务需要的米粒
				$userinfoBack->save();
				/*
                $userinfo=User::model()->findByPk($taskInfo->taskerid);//获取接手信息
                $userinfo->Experience=$userinfo->Experience+1;//接手每完成一个任务，经验值增加一个
                $userinfo->save();
				$publishinfo=User::model()->findByPk($taskInfo->publishid);//获取发布方信息
                $publishinfo->Experience=$publishinfo->Experience+1;//商家每有一个任务被完成，经验值增加一个
                $publishinfo->save();
				*/
                if($complianinfoOth->save())
                    echo "SUCCESS";
                else
                    echo "FAIL";
            }
            
            //威客发起投诉-威客胜诉
            if(isset($_POST['id']) && $_POST['id']!="" && isset($_POST['complianStyle']) && $_POST['complianStyle']==1 && isset($_POST['taskerid']) && $_POST['taskerid']!="")
            {
                //改变投诉状态
                $complianinfoOth=Complianlist::model()->findByPk($_POST['id']);
                $complianinfoOth->status=2;//改变状态为处理完成
                $complianinfoOth->winid=$_POST['taskerid'];//胜诉方id
                $complianinfoOth->handleCompleteTime=time();//处理完成时间
                
                //改变任务状态
                $taskInfo=Companytasklist::model()->findByPk($complianinfoOth->taskid);
                $taskInfo->taskcompleteTime=time();//商家审核即任务完成时间
                $taskInfo->taskCompleteStatus=1;//任务完成，改变状态
                $taskInfo->save();
                
                //对威客进行加款操作
				if($taskInfo->payWay==1){//加金额
					    //进行加款操作
						//1.保存金额流水
                        $record=new Recordlist();
                        $record->userid=$taskInfo->taskerid;//用户id
                        $record->catalog=5;//发布任务使用金额
                        $record->number=$taskInfo->txtPrice;//操作数量
                        $record->tasknum=1;//1个任务
						$record->taskid=$taskInfo->id;
                        $record->time=time();//操作时间
                        $record->save();//保存金额流水
				}
				//2.保存米粒流水
                $recordMinLi=new Recordlist();
                $recordMinLi->userid=$taskInfo->taskerid;//用户id
                $recordMinLi->catalog=6;//发布任务使用米粒
                $recordMinLi->number=$taskInfo->MinLi;//操作数量
                $recordMinLi->tasknum=1;//1个任务
			    $recordMinLi->taskid=$taskInfo->id;
                $recordMinLi->time=time();//操作时间
                $recordMinLi->save();//保存米粒流水
					
				$userinfo=User::model()->findByPk($taskInfo->taskerid);
				if($taskInfo->payWay==1){
					$userinfo->Money=$userinfo->Money+$taskInfo->txtPrice;//在原有余额基本上加上任务需要的金额
				}
				$userinfo=User::model()->findByPk($taskInfo->taskerid);
				if($taskInfo->payWay==1){
					$userinfo->Money=$userinfo->Money+$taskInfo->txtPrice;//在原有余额基本上加上任务需要的金额
				}
				//完成任务消耗米粒即给平台的佣金米粒的比例
                switch($userinfo->VipLv)
                {
                    case 0:
                        $taskMinliToPlatformPercent=System::model()->findByAttributes(array("varname"=>"taskMinliToPlatform"));
                        break;
                    case 1:
                        $taskMinliToPlatformPercent=System::model()->findByAttributes(array("varname"=>"taskMinliToPlatformVIP1"));
                        break;
                    case 2:
                        $taskMinliToPlatformPercent=System::model()->findByAttributes(array("varname"=>"taskMinliToPlatformVIP2"));
                        break;
                    case 3:
                        $taskMinliToPlatformPercent=System::model()->findByAttributes(array("varname"=>"taskMinliToPlatformVIP3"));
                        break;
                }
                $platMinLi=$taskInfo->MinLi*($taskMinliToPlatformPercent->value/100);//平台消耗米粒
                $userinfo->MinLi=$userinfo->MinLi+($taskInfo->MinLi-$platMinLi);//在原有金额基础上增加任务金额
                $userinfo->Experience=$userinfo->Experience+1;//接手每完成一个任务，经验值增加一个
                $publishinfo=User::model()->findByPk($taskInfo->publishid);//获取发布方信息
                $publishinfo->Experience=$publishinfo->Experience+1;//商家每有一个任务被完成，经验值增加一个

			   if($userinfo->save() && $publishinfo->save())
                {
                    //推广奖励-给接任务者上线返点
                    $spreadid=$taskInfo->taskerid;//接任务者id为下线
                    if($userinfo->IdNumber && $userAddMoney=User::model()->findByPk($userinfo->IdNumber))
                    {
                        $uid=$userinfo->IdNumber;//上线id
                        $recordCheck=Recordlist::model()->findByAttributes(array(
                            'userid'=>$userinfo->IdNumber,
                            'spreadid'=>$spreadid,
							'taskid'=>$taskInfo->id
                        ));
                        if($recordCheck==false)//如果没给过上线的奖励记录，则进行相关判断操作
                        {
                            $sxtcMoney=System::model()->findByAttributes(array("varname"=>"sxtcMoney"));
                            //推广奖励返现流水
                            $recordSpreak=new Recordlist();
                            $recordSpreak->userid=$uid;//上家id
                            $recordSpreak->catalog=18;//推广返现类型
                            $recordSpreak->number=$sxtcMoney->value;//返现金额
                            $recordSpreak->time=time();//操作时间
                            $recordSpreak->spreadid=$spreadid;//下线即接任务者的id
							$recordMinLi->taskid=$taskInfo->id;//任务id
                            $recordSpreak->save();//保存米粒流水
                            //改变上家余额
                            $userAddMoney->Money=$userAddMoney->Money+$sxtcMoney->value;//达到要求奖励18元
                            $userAddMoney->SpreadMoney=$userAddMoney->SpreadMoney+$sxtcMoney->value;//累加推广获得的返现金额
                            $userAddMoney->save();
                        }
                    }
                    //给接任务者上线返点结束
                }
                if($complianinfoOth->save())
                    echo "SUCCESS";
                else
                    echo "FAIL";
            }
        }
        
        
        /*
            投诉管理-开始处理-进行最终的仲裁-发起人失败
        */
        public function actionEndHandleFail()
        {
            parent::acl();
            //商家发起投诉-商家失败
            if(isset($_POST['id']) && $_POST['id']!="" && isset($_POST['complianStyle']) && $_POST['complianStyle']==2 && isset($_POST['taskerid']) && $_POST['taskerid']!="")
            {
                //改变投诉状态
                $complianinfoOth=Complianlist::model()->findByPk($_POST['id']);
                $complianinfoOth->status=2;//改变状态为处理完成
                $complianinfoOth->winid=$_POST['taskerid'];//胜诉方id
                $complianinfoOth->handleCompleteTime=time();//处理完成时间
                
                //改变任务状态
                $taskInfo=Companytasklist::model()->findByPk($complianinfoOth->taskid);
                $taskInfo->taskcompleteTime=time();//商家审核即任务完成时间
                $taskInfo->taskCompleteStatus=1;//任务完成，改变状态
                $taskInfo->save();
                
                //对威客进行加款操作
				if($taskInfo->payWay==1){//加金额
					    //进行加款操作
						//1.保存金额流水
                        $record=new Recordlist();
                        $record->userid=$taskInfo->taskerid;//用户id
                        $record->catalog=5;//发布任务使用金额
                        $record->number=$taskInfo->txtPrice;//操作数量
                        $record->tasknum=1;//1个任务
						$record->taskid=$taskInfo->id;
                        $record->time=time();//操作时间
                        $record->save();//保存金额流水
				}
				//2.保存米粒流水
                $recordMinLi=new Recordlist();
                $recordMinLi->userid=$taskInfo->taskerid;//用户id
                $recordMinLi->catalog=6;//发布任务使用米粒
                $recordMinLi->number=$taskInfo->MinLi;//操作数量
                $recordMinLi->tasknum=1;//1个任务
			    $recordMinLi->taskid=$taskInfo->id;
                $recordMinLi->time=time();//操作时间
                $recordMinLi->save();//保存米粒流水
					
				$userinfo=User::model()->findByPk($taskInfo->taskerid);
				if($taskInfo->payWay==1){
					$userinfo->Money=$userinfo->Money+$taskInfo->txtPrice;//在原有余额基本上加上任务需要的金额
				}
				$userinfo=User::model()->findByPk($taskInfo->taskerid);
				if($taskInfo->payWay==1){
					$userinfo->Money=$userinfo->Money+$taskInfo->txtPrice;//在原有余额基本上加上任务需要的金额
				}
				//完成任务消耗米粒即给平台的佣金米粒的比例
                switch($userinfo->VipLv)
                {
                    case 0:
                        $taskMinliToPlatformPercent=System::model()->findByAttributes(array("varname"=>"taskMinliToPlatform"));
                        break;
                    case 1:
                        $taskMinliToPlatformPercent=System::model()->findByAttributes(array("varname"=>"taskMinliToPlatformVIP1"));
                        break;
                    case 2:
                        $taskMinliToPlatformPercent=System::model()->findByAttributes(array("varname"=>"taskMinliToPlatformVIP2"));
                        break;
                    case 3:
                        $taskMinliToPlatformPercent=System::model()->findByAttributes(array("varname"=>"taskMinliToPlatformVIP3"));
                        break;
                }
                $platMinLi=$taskInfo->MinLi*($taskMinliToPlatformPercent->value/100);//平台消耗米粒
                $userinfo->MinLi=$userinfo->MinLi+($taskInfo->MinLi-$platMinLi);//在原有金额基础上增加任务金额
                $userinfo->Experience=$userinfo->Experience+1;//接手每完成一个任务，经验值增加一个
                $publishinfo=User::model()->findByPk($taskInfo->publishid);//获取发布方信息
                $publishinfo->Experience=$publishinfo->Experience+1;//商家每有一个任务被完成，经验值增加一个

			    if($userinfo->save() && $publishinfo->save())
                {
                    //推广奖励-给接任务者上线返点
                    $spreadid=$taskInfo->taskerid;//接任务者id为下线
                    if($userinfo->IdNumber && $userAddMoney=User::model()->findByPk($userinfo->IdNumber))
                    {
                        $uid=$userinfo->IdNumber;//上线id
                        $recordCheck=Recordlist::model()->findByAttributes(array(
                            'userid'=>$userinfo->IdNumber,
                            'spreadid'=>$spreadid,
							'taskid'=>$taskInfo->id
                        ));
                        if($recordCheck==false)//如果没给过上线的奖励记录，则进行相关判断操作
                        {
                            $sxtcMoney=System::model()->findByAttributes(array("varname"=>"sxtcMoney"));
                            //推广奖励返现流水
                            $recordSpreak=new Recordlist();
                            $recordSpreak->userid=$uid;//上家id
                            $recordSpreak->catalog=18;//推广返现类型
                            $recordSpreak->number=$sxtcMoney->value;//返现金额
                            $recordSpreak->time=time();//操作时间
                            $recordSpreak->spreadid=$spreadid;//下线即接任务者的id
							$recordMinLi->taskid=$taskInfo->id;//任务id
                            $recordSpreak->save();//保存米粒流水
                            //改变上家余额
                            $userAddMoney->Money=$userAddMoney->Money+$sxtcMoney->value;//达到要求奖励18元
                            $userAddMoney->SpreadMoney=$userAddMoney->SpreadMoney+$sxtcMoney->value;//累加推广获得的返现金额
                            $userAddMoney->save();
                        }
                    }
                    //给接任务者上线返点结束
                }
                
                if($complianinfoOth->save())
                    echo "SUCCESS";
                else
                    echo "FAIL";
            }
            
            
            //接手发起投诉-商家胜诉
            if(isset($_POST['id']) && $_POST['id']!="" && isset($_POST['complianStyle']) && $_POST['complianStyle']==1 && isset($_POST['publishid']) && $_POST['publishid']!="")
            {
                //投诉记录的状态
                $complianinfoOth=Complianlist::model()->findByPk($_POST['id']);
                $complianinfoOth->status=2;//改变状态为处理完成
                $complianinfoOth->winid=$_POST['publishid'];//胜诉方id
                $complianinfoOth->handleCompleteTime=time();//处理完成时间
                
                //改变任务状态
                $taskInfo=Companytasklist::model()->findByPk($complianinfoOth->taskid);
                $taskInfo->taskcompleteTime=time();//商家审核即任务完成时间
                $taskInfo->taskCompleteStatus=1;//任务完成，改变状态
                $taskInfo->save();
                
                //执行退款操作
				if($taskInfo->payWay==1){//退金额
					    //进行加款操作
						//1.保存金额流水
                        $record=new Recordlist();
                        $record->userid=$taskInfo->publishid;//用户id
                        $record->catalog=14;//发布任务使用金额
                        $record->number=$taskInfo->txtPrice;//操作数量
                        $record->tasknum=1;//1个任务
						$record->taskid=$taskInfo->id;
                        $record->time=time();//操作时间
                        $record->save();//保存金额流水
				}
				//2.保存米粒流水
                $recordMinLi=new Recordlist();
                $recordMinLi->userid=$taskInfo->publishid;//用户id
                $recordMinLi->catalog=15;//发布任务使用米粒
                $recordMinLi->number=$taskInfo->MinLi;//操作数量
                $recordMinLi->tasknum=1;//1个任务
			    $recordMinLi->taskid=$taskInfo->id;
                $recordMinLi->time=time();//操作时间
                $recordMinLi->save();//保存米粒流水
					
				$userinfo=User::model()->findByPk($taskInfo->publishid);
				if($taskInfo->payWay==1){
					$userinfo->Money=$userinfo->Money+$taskInfo->txtPrice;//在原有余额基本上加上任务需要的金额
				}
				$userinfo->MinLi=$userinfo->MinLi+$taskInfo->MinLi;//在原有米粒基本上加上任务需要的米粒
				$userinfo->save();
				/*
                $userinfo=User::model()->findByPk($taskInfo->taskerid);//获取接手信息
                $userinfo->Experience=$userinfo->Experience+1;//接手每完成一个任务，经验值增加一个
                $userinfo->save();
				$publishinfo=User::model()->findByPk($taskInfo->publishid);//获取发布方信息
                $publishinfo->Experience=$publishinfo->Experience+1;//商家每有一个任务被完成，经验值增加一个
                $publishinfo->save();
                */
                if($complianinfoOth->save())
                    echo "SUCCESS";
                else
                    echo "FAIL";
            }
        }
        
    }
?>