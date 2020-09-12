<?php
    class MoneymanController extends Aclfilter{
        
        public $layout='//layouts/backyard';//定义布局以便加载kindeditor文本编辑器的css与js
        
        
        /*
            会员充值管理-充值列表
        */
        public function actionMoneylist()
        {
            parent::acl();
             /*
            ***查询出用户充值交易信息
            */
            $criteria = new CDbCriteria;
            $criteria->order ="addtime desc";
        
            //分页开始
            $total = Kcborder::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=10;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Kcborder::model()->findAll($criteria);
            //分页结束
            $this->renderPartial('moneylist',array(
                'proInfo' => $proreg,
                'pages' => $pages
            ));
        }
        
        /*
            ***提现审核列表
        */
        public function actionTxlist()
        {
            parent::acl();
            
            // 改变提现状态
            if(isset($_GET['txid']) && $_GET['txid']<>0 && isset($_GET['txStatus']) && $_GET['txStatus']!="")
            {   
				$txInfo=Recordlist::model()->findByPk($_GET['txid']);
				
				//更新平台余额
					$criteria = new CDbCriteria;
                    $criteria->condition='catalog=1 or (catalog=8 and txStatus=2)';
                    $criteria->order ="id desc";
					$yuerow = Recordlist::model()->find($criteria);
					if($yuerow){
						$yue=$yuerow['yue']-$txInfo->number;
					}else{
						$yue=0;
					}
				//更新平台余额结束
				
				$txInfo->yue=$yue;
                $txInfo->txStatus=$_GET['txStatus'];//改变提现状态
                $txInfo->save();
                $this->redirect(Yii::app()->request->urlReferrer);
                Yii::app()->end();
            }
            //查询用户提现记录
            $criteria = new CDbCriteria;
            $criteria->condition='catalog=8';
            $criteria->order ="time desc";
        
            //分页开始
            $total = Recordlist::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=8;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Recordlist::model()->findAll($criteria);
            //分页结束
            $this->renderPartial('txlist',array(
                'proInfo' => $proreg,
                'pages' => $pages
            ));
        }
        
        public function actionUserDetail()
        {
            parent::acl();
            //查询用户提现记录
            $criteria = new CDbCriteria;
            $criteria->condition='catalog in(1,5,6) and userid='.$_GET['uid'];
            $criteria->order ="catalog asc,time desc";
        
            //分页开始
            $total = Recordlist::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=20;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Recordlist::model()->findAll($criteria);
            //分页结束
            $this->renderPartial('userDetail',array(
                'proInfo' => $proreg,
                'pages' => $pages
            ));
        }
		
		public function actionAddOrder(){//添加充值记录，即充值记录补单
		    header("Content-Type: text/html; charset=utf-8");
			if(isset($_POST["tno"]) && $_POST["tno"]!="" && isset($_POST["money"]) && trim($_POST["money"])!="" && isset($_POST["payno"]) && $_POST["payno"]!="" && isset($_POST["type"]) && $_POST["type"]!="")
			{
                //检查订单号是否已存在
                $checkExist=Kcborder::model()->findByAttributes(array("tno"=>$_POST["tno"]));
                if($checkExist)//订单已存在
                {
                    //做错误存储信息，以便日后查问题帐户
                    exit('<script>alert("订单已存在");window.location.href="'.$this->createUrl('moneyman/moneylist').'";</script>');					
                }else//订单不存在
                {
                    $tno=$_POST["tno"];//支付宝订单号 
                    $payno=trim($_POST["payno"]);//编号备注 一般是用户名
                    $money=$_POST["money"];//金额
                    $type=$_POST["type"];
                    //获取用户id
					$userinfo=User::model()->findByAttributes(array("Username"=>$payno));
				    if($userinfo){
						$userid=$userinfo->id;
					}else{
						exit("该用户不存在");
					}
					$time=time();
                    $kcbOrder=new Kcborder();
					$kcbOrder->uid=$userid;
                    $kcbOrder->tno=$tno;//支付宝订单号 
                    $kcbOrder->payno=$payno;//编号备注 一般是用户名
                    $kcbOrder->money=$money;//金额
					$kcbOrder->type=$type;//支付类型
                    $kcbOrder->addtime=$time;//加入时间，快充宝软件通过接口将充值充值的数据添加到kcborder表的时间
					$kcbOrder->status=1;//是否完成支付，变状态为1
                    $kcbOrder->completetime=$time;
                    if($kcbOrder->save())//充值成功
                    {
						//更新平台余额
					    $criteria = new CDbCriteria;
                        $criteria->condition='catalog=1 or (catalog=8 and txStatus=2)';
                        $criteria->order ="id desc";
					    $yuerow = Recordlist::model()->find($criteria);
					    if($yuerow){
						    $yue=$yuerow['yue']+$money;
					    }else{
						    $yue=$money;
					    }
					    //更新平台余额结束
						//添加流水
                        $record=new Recordlist();
                        $record->userid=$userid;//用户id
                        $record->catalog=1;//充值类型
                        $record->number=$money;//操作数量
						$record->yue=$yue;
                        $record->time=$time;//操作时间
                        $record->save();//保存流水
                        //改变充值后帐户的余额
                        $userinfo=User::model()->findByPk($userid);
                        $userinfo->Money=$userinfo->Money+$money;//在原有的基本上增加本次操作的金额数量
                        $userinfo->save();
                       exit('<script>alert("充值成功");window.location.href="'.$this->createUrl('moneyman/moneylist').'";</script>');	
                    }
                    else//充值失败
                   {
                       exit('<script>alert("充值失败");window.location.href="'.$this->createUrl('moneyman/moneylist').'";</script>');	
                    } 
                }
            }else{
				exit('<script>alert("信息填写有误");window.location.href="'.$this->createUrl('moneyman/moneylist').'";</script>');	
			}
		}
		
		//财务统计报表
		 public function actionFinance()
        {
            parent::acl();
            //查询用户提现记录
			if(!isset($_GET['type'])){
				$_GET['type']=1;
			}
            $criteria = new CDbCriteria;
			if($_GET['type']==1){
				$criteria->condition='catalog=1 or (catalog=8 and txStatus=2)';
			}else{
				$criteria->condition='catalog in (2,7)';
			}
            $criteria->order ="time desc";
        
            //分页开始
            $total = Recordlist::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=30;//分页大小
            $pages->applyLimit($criteria);
            
            $lists = Recordlist::model()->findAll($criteria);
            //分页结束
            $this->renderPartial('finance',array(
                'lists' => $lists,
                'pages' => $pages
            ));
        }
    }
?>