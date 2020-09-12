<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public $layout='//layouts/layout';
    
	
    public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
        $this->render('index');
	}
    
    /*
        ***快充宝充值api，即将用户充值到支付宝之后将数据存入到kcborder表，方便用户通过提交交易号完成平台充值
    */
    public function actionKcbApi()
    {   
        if(isset($_GET["tno"]) && $_GET["tno"]!="" && isset($_GET["money"]) && $_GET["money"]!="")
        {
            //检查订单号是否已存在
            $checkExist=Kcborder::model()->findByAttributes(array("tno"=>$_GET["tno"]));
            if($checkExist)//订单已存在
            {
                //做错误存储信息，以便日后查问题帐户
                exit('订单已存在');   
            }else//订单不存在
            {
                //密钥检测
                $MD5key = "kinsgvretmNow#%@#%";	//MD5私钥，用于复制到快充宝软件中的MD5加密字符串
                $key="siue5fertgU";//key
                $tno=$_GET["tno"];//支付宝订单号 
                $payno=$_GET["payno"];//编号备注 一般是用户名
                $money=$_GET["money"];//金额
                
                $md5src = $tno.$payno.$money.$MD5key;//生成签名准备
                $md5sign = strtoupper(md5($md5src));//生成签名
                
                $SignMD5info = $_GET["sign"];//通过get方式获得密钥用于比较
                
                if($md5sign==strtoupper($SignMD5info))//检查签名
                {
					
                    $kcbOrder=new Kcborder();
                    $kcbOrder->tno=$_GET["tno"];//支付宝订单号 
                    $kcbOrder->payno=$_GET["payno"];//编号备注 一般是用户名
                    $kcbOrder->money=$_GET["money"];//金额
					$kcbOrder->type=$_GET['type'];//支付类型
                    $kcbOrder->addtime=time();//加入时间，快充宝软件通过接口将充值充值的数据添加到kcborder表的时间
                    if($kcbOrder->save())//充值成功
                    {
                        exit('1');//成功
                    }
                    else//充值失败
                    {
                        exit('充值失败');
                    } 
                }else
                {
                    exit('密钥不正确');    
                }   
            }
        }
    }
    
    /*
        会员等级说明
    */
    public function actionUserLeveldoc()
    {
        $this->render('userLeveldoc');
    }
    
    /*淘宝大厅
    */
    public function actionTaobaoTask()
    {
		$currenttime=time();
        if(Yii::app()->user->getIsGuest())
        {
            $this->redirect($this->createUrl('passport/login'));
        }
        //关键词搜索
        if(isset($_POST['keywords']) && $_POST['keywords']!="")
        {
            $keywordsArr=explode('*',$_POST['keywords']);//分解关键词
            //任务大厅
    	    $criteria = new CDbCriteria;
            if(is_array($keywordsArr) && count($keywordsArr)==2)
                $criteria->condition='status=0 and time='.trim($keywordsArr[0]).' and id='.trim($keywordsArr[1]).' and (endtime>='.$currenttime.' or endtime=0)';
            else
                $criteria->condition='status=-1 and (endtime>='.$currenttime.' or endtime=0)';//给出不存在的条件
            $criteria->order ="time desc";
        
            //分页开始
            $total =Companytasklist::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=15;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Companytasklist::model()->findAll($criteria);
            //分页结束
            
            $this->render('taobaoTask',array(
                'proInfo' => $proreg,
                'pages' => $pages
            ));
            Yii::app()->end();
        }
        //多条件搜索
        if(count($_GET)<>0)//判断是否有get传值
        {
            //var_dump($_GET['platform']);
            //exit;
            //echo 1;
            $condition='status=0 and (endtime>='.$currenttime.' or endtime=0)';//定义搜索条件
            foreach($_GET as $k=>$v)
            {
                if($k=='platform' && $v!='noVal' && $v!='')//所属平台
                {
                    $condition=$condition.' and '.$k.'='.$v;
                }
                
                if($k=='payWay' && $v!='noVal' && $v!='')//星级要求
                {
                    $condition=$condition.' and '.$k.'='.$v;
                }
                
                if($k=='BuyerJifen' && $v!='noVal' && $v!='')//星级要求
                {
                    $condition=$condition.' and '.$k.'='.$v;
                }
                
                if($k=='isMobile' && $v!='noVal' && $v!='')//任务类型
                {
                    $condition=$condition.' and '.$k.'='.$v;
                }
                
                if($k=='task_type' && $v!='noVal' && $v!='')//商品类型
                {
                    $condition=$condition.' and '.$k.'='.$v;
                }
                
                if($k=='MinLi' && $v!='noVal' && $v!='')//商品类型
                {
                    $condition=$condition.' and '.$k.'>'.(($v-1)*10).' and '.$k.'<'.$v*10;
                }
                
                if($k=='txtPrice' && $v!='noVal' && $v!='')//任务金额
                {
                    if($v==10)
                        $condition=$condition.' and '.$k.'>'.(($v-1)*100);
                    else
                        $condition=$condition.' and '.$k.'>'.(($v-1)*100).' and '.$k.'<'.(($v*100)+1);
                }
                
                if($k=='ddlOKDay' && $v!='noVal' && $v!='')//收货时长
                {
                    if($v==5)
                        $condition=$condition.' and '.$k.'>'.($v-2);
                    else
                        $condition=$condition.' and '.$k.'='.($v-1);
                }
            }
            
            $criteria = new CDbCriteria;
            $criteria->condition=$condition;
            $criteria->order ="time desc";
        
            //分页开始
            $total =Companytasklist::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=15;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Companytasklist::model()->findAll($criteria);
            //分页结束
            
            $this->render('taobaoTask',array(
                'proInfo' => $proreg,
                'pages' => $pages
            ));
            Yii::app()->end();
        }
        //任务大厅
	    $criteria = new CDbCriteria;
        $criteria->condition='status=0 and (endtime>='.$currenttime.' or endtime=0)';
        $criteria->order ="time desc";
    
        //分页开始
        $total =Companytasklist::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=15;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Companytasklist::model()->findAll($criteria);
        //分页结束
        
        $this->render('taobaoTask',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    /*
        淘宝大厅-抢任务-检查用户是否登录以及绑定买号
    */
    public function actionTakeTask()
    {
        //接手选择并绑定买号
        if(isset($_POST['taskerWangwang']) && isset($_POST['taskid']) && Yii::app()->user->getId())
        {
            $taskInfo=Companytasklist::model()->findByPk($_POST['taskid']);//查询任务基本信息
            if($taskInfo->status!=6 && $taskInfo->status==0)//任务处于可接状态
            {
                $userinfo=User::model()->findByPk(Yii::app()->user->getId());
                //首先检查用户帐号是否符合任务的要求
                //1.检查商保
                if($taskInfo->cbxIsSB==1)//任务要求商保
                {
                    if($userinfo->JoinProtectPlan<>1)//没有加入商保
                    {
                        echo "NOJoinProtectPlan";
                        Yii::app()->end();
                    }
                }
                
                $wangwanginfo=Blindwangwang::model()->findByAttributes(array('wangwang'=>$_POST['taskerWangwang']));
                //2.检测买号等级要求是否符合任务要求
                if($taskInfo->BuyerJifen>$wangwanginfo->wangwanginfo)
                {
                    echo "NOBuyerJifen";
                    Yii::app()->end();
                }
                
                //3.地区限制
                if($taskInfo->isLimitCity==1)//任务要求做接手区域限制
                {
                    $loginip=XUtils::getClientIP();//登录ip
                    //登录地址
                    $ipinfo=file_get_contents('http://ip.taobao.com/service/getIpInfo.php?ip='.$loginip);
                    $placeinfo=json_decode($ipinfo,true);
                    if(XUtils::cutstr($taskInfo->Province,4)!=XUtils::cutstr($placeinfo['data']['region'],4))//地区的前两个字
                    {
                        echo "NOProvince";
                        Yii::app()->end();
                    }
                }
                
                //4.检查接手是否在对方的黑名单中
                $blackinfo=Myblackerlist::model()->findByAttributes(array('blackerusername'=>$userinfo->Username,"userid"=>$taskInfo->publishid));
                if($blackinfo)//在商家的黑名单中
                {
                    echo "INBlack";
                    Yii::app()->end();
                }
                
                //5.限制接手任务数量
                if($taskInfo->cbxIsFMaxMCount){//如果任务对接手接任务数量有限制则进行过滤
                    $t = time();
                    $start = mktime(0,0,0,date("m",$t),date("d",$t),date("Y",$t));
                    $end = mktime(23,59,59,date("m",$t),date("d",$t),date("Y",$t)); 
                    $limitTaskNumOneDay=Companytasklist::model()->findAll(array(
                        'condition'=>'taskerid='.Yii::app()->user->getId().' and publishid='.$taskInfo->publishid.' and tasksecondTime>'.$start.' and tasksecondTime<'.$end
                    ));
                    
                    $weekstart = mktime(0,0,0,date("m",$t),(date("d",$t)-7),date("Y",$t));
                    $limitTaskNumOneWeek=Companytasklist::model()->findAll(array(
                        'condition'=>'taskerid='.Yii::app()->user->getId().' and publishid='.$taskInfo->publishid.' and tasksecondTime>'.$weekstart.' and tasksecondTime<'.$end
                    ));
                    
					$y=date("Y",time());
                    $m=date("m",time());
                    $d=date("d",time());
                    $t0=date('t');           // 本月一共有几天
                    $monthstart=mktime(0,0,0,$m,1,$y);        // 创建本月开始时间 
                    $monthend=mktime(23,59,59,$m,$t0,$y);       // 创建本月结束时间
					$weekstart = mktime(0,0,0,date("m",$t),(date("d",$t)-7),date("Y",$t));
                    $limitTaskNumOneMonth=Companytasklist::model()->findAll(array(
                        'condition'=>'taskerid='.Yii::app()->user->getId().' and publishid='.$taskInfo->publishid.' and tasksecondTime>'.$monthstart.' and tasksecondTime<'.$monthend
                    ));
					
                    if($taskInfo->fmaxmc==1 && count($limitTaskNumOneDay)>0)//一天接不超过1单
                    {
                        echo "MAXNUM";//不符合一天接不超过1单要求
                        Yii::app()->end();
                    }
                    
                    if($taskInfo->fmaxmc==2 && count($limitTaskNumOneMonth)>0)//一周接不超过1单
                    {
                        echo "MAXNUM";//不符合一天接不超过2单要求
                        Yii::app()->end();
                    }
                    
                    if($taskInfo->fmaxmc==3 && count($limitTaskNumOneWeek)>0)//一周不超过1单
                    {
                        echo "MAXNUM";//不符合一周不超过1单要求
                        Yii::app()->end();
                    }
                }
                //符合要求
                $taskInfo->taskerid=Yii::app()->user->getId();//接手id
                $taskInfo->taskerWangwang=$_POST['taskerWangwang'];//接手买号旺旺
                $taskInfo->taskfristTime=time();//接手接任务时间
                
                //判断商家是否要求审核
                if($taskInfo->cbxIsAudit)
                    $taskInfo->status=1;//任务状态变1，等待商家审核
                else//不需要商家审核
                {
                    $taskInfo->status=2;//由于商家没有选择要求审核，因此直接进入接手付款阶段跳过商家审核
                    $taskInfo->tasksecondTime=time();//任务开始时间
                }
                if($taskInfo->save())
                {
                    //短信通知 start
                    /*$url = "http://www.zf.com/site/smsMessage.html";
                    $post_data = array ("phone" => "18221791657");
                    $ch = curl_init();
                    curl_setopt($ch, CURLOPT_URL, $url);
                    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
                    curl_setopt($ch, CURLOPT_POST, 1);
                    curl_setopt($ch, CURLOPT_POSTFIELDS, $post_data);
                    $output = curl_exec($ch);
                    curl_close($ch);
                    //短信通知 end*/
                    
                    echo "SUCCESS";
                    Yii::app()->end();
                }
                else
                {
                    echo "FAIL";
                    Yii::app()->end();
                }
            }
            else
            {
                echo "TASKSTOP";
                Yii::app()->end();
            }
        }
        
        //检查是否登录以及返回符合条件的买号
        if($_POST['checkBase']=="DOIT" && Yii::app()->user->getId())
        {
            if($_POST['platform']==3)//如果是阿巴巴平台则调用淘宝买号
            {
                $_POST['platform']=1;
            }
            //查询符合条件的买号 
            $buyerInfo=Blindwangwang::model()->findAll(array(
                'condition'=>'userid='.Yii::app()->user->getId().' and statue=1 and catalog=1 and platform='.$_POST['platform'],
                'order'=>'id desc'
            ));
            if($buyerInfo)//返回符合条件的买号
            {
                $divStart="<div class='choseBuyer'><div style='font-size:14px; line-height:35px;'>选择接此任务的买号：</div>";
                $divEnd="</div>";
                $radioItemStr="";
                $buyerNum=count($buyerInfo);
                foreach($buyerInfo as $k=>$v)
                {
                    if($k==0)
                    {
                        if($_POST['platform']!=2)//淘宝与阿里巴巴
                        {
                            if($v['wangwanginfo']==false)
                                $radioItemStr=$radioItemStr."<li><input type='radio' name='buyerSelected' checked='checked' value='".$v['wangwang']."' /> ".$v['wangwang'].'<span style="color:red;">(掌柜号)</span>';
                            else
                                $radioItemStr=$radioItemStr."<li><input type='radio' name='buyerSelected' checked='checked' value='".$v['wangwang']."' /> ".$v['wangwang']."　<img src='".VERSION2."img/level/".$v['wangwanginfo'].".gif' /></li>";
                        }
                        else//京东
                        {
                            if($v['wangwanginfo']==false)
                                $radioItemStr=$radioItemStr."<li><input type='radio' name='buyerSelected' checked='checked' value='".$v['wangwang']."' /> ".$v['wangwang'].'<span style="color:red;">(掌柜号)</span>';
                            else
                                $radioItemStr=$radioItemStr."<li><input type='radio' name='buyerSelected' checked='checked' value='".$v['wangwang']."' /> ".$v['wangwang']."　<img src='".VERSION2."img/level/jd".$v['wangwanginfo'].".png' /></li>";
                        }
                    }
                    else
                    {
                        if($_POST['platform']!=2)//淘宝与阿里巴巴
                        {
                            if($v['wangwanginfo']==false)
                                $radioItemStr=$radioItemStr."<li><input type='radio' name='buyerSelected' value='".$v['wangwang']."' /> ".$v['wangwang'].'<span style="color:red;">(掌柜号)</span>';
                            else
                                $radioItemStr=$radioItemStr."<li><input type='radio' name='buyerSelected' value='".$v['wangwang']."' /> ".$v['wangwang']."　<img src='".VERSION2."img/level/".$v['wangwanginfo'].".gif' /></li>";
                        }
                        else//京东
                        {
                            if($v['wangwanginfo']==false)//如果掌柜号没有等级，就不显示图片
                                $radioItemStr=$radioItemStr."<li><input type='radio' name='buyerSelected' value='".$v['wangwang']."' /> ".$v['wangwang'].'<span style="color:red;">(掌柜号)</span>';
                            else
                                $radioItemStr=$radioItemStr."<li><input type='radio' name='buyerSelected' value='".$v['wangwang']."' /> ".$v['wangwang']."　<img src='".VERSION2."img/level/jd".$v['wangwanginfo'].".png' /></li>";
                        }
                    }
                }
                echo $divStart.$radioItemStr.$divEnd;
            }
            else
            {
                echo "NOBUYSER";
            }
        }else
        {
            echo "GUEST";
        }
    }
    
    //接手接任务-等待商家审核-商家审核通过
    public function actionBuyerPass()
    {
        if(isset($_POST['taskerid']) && isset($_POST['id']))
        {
            $taskInfo=Companytasklist::model()->findByPk($_POST['id']);
            if($taskInfo->taskerid==$_POST['taskerid'] && $taskInfo->status==1)//只有任务状态处理1-等待商家审核，商家才权审核通过，否则无权操作
            {
                $taskInfo->status=2;//任务状态变2，即暂停通过审核，等待接手付款
                $taskInfo->tasksecondTime=time();//商家审核通过，即设置任务开始时间
                if($taskInfo->save())
                    echo "SUCCESS";
                else
                {
                    echo "FAIL";
                }
            }
            else//暂停失败
                echo 'FAIL';
        }
        else
            echo 'nothing';
    }
    
    //接手接任务-等接手付款-第一步
    public function actionBuyerToPay()
    {
        if(isset($_POST['txtGoodsUrl']) && isset($_POST['id']) && Yii::app()->user->getId())
        {
            $taskInfo=Companytasklist::model()->findByPk($_POST['id']);
            if($taskInfo->txtGoodsUrl==$_POST['txtGoodsUrl'])
            {
                echo "SUCCESS";
            }else{
                echo "FAIL";
            }
            Yii::app()->end();
        }
        
        if(isset($_GET['taskid']) && Yii::app()->user->getId())
        {
            $taskInfo=Companytasklist::model()->findByPk($_GET['taskid']);
            $this->renderPartial('buyerToPay',array(
                'taskInfo'=>$taskInfo
            ));
        }
        else
            echo "nothing";
    }
    
    //接手接任务-等接手付款-第二步全部完成确认并提交
    public function actionBuyerToPayCertain()
    {
		if($_POST['txtGoodsUrlIsRight']!=1){
			echo "FAIL";
			Yii::app()->end();
		}
        if(isset($_POST['url3']) && isset($_POST['url4']) && isset($_POST['url55']) && isset($_POST['url5']) && isset($_POST['url6']) && isset($_POST['url7']) && isset($_POST['url8']) && isset($_POST['taskid']) && isset($_POST['orderNumber']) && Yii::app()->user->getId())
        {
			 $taskInfo=Companytasklist::model()->findByPk($_POST['taskid']);
             $taskInfo->taskthirdTime=time();//接手完成付款的时间
             $taskInfo->status=3;//接手付款成功
             
             $taskInfo->taskerHBoneImg=$_POST['url3'];//货比3家1截图
             $taskInfo->taskerHBsecondImg=$_POST['url4'];//货比3家2截图
             $taskInfo->taskerHBthirdImg=$_POST['url55'];//货比3家3截图
             $taskInfo->taskerBottomImg=$_POST['url5'];//浏览底部截图
             $taskInfo->taskerSCImg=$_POST['url6'];//收藏截图
             $taskInfo->taskerOtheroneImg=$_POST['url7'];//店内其他商品1截图
             $taskInfo->taskerOthersecondImg=$_POST['url8'];//店内其他商品2截图
             $taskInfo->orderNumber=$_POST['orderNumber'];//商品订单编号
             
             if($taskInfo->save())
             {
                echo "SUCCESS";
             }else{
                echo "FAIL";
             }
        }
        else
        {
            echo "FAIL";
        }
    }
    
     //接手接任务-等接商家发货-商家确认发货
    public function actionSellerCertainSendGood()
    {
        if(isset($_POST['taskid']) && Yii::app()->user->getId())//登录的情况下操作操作
        {
             $taskInfo=Companytasklist::model()->findByPk($_POST['taskid']);
             $taskInfo->taskforthTime=time();//接手完成付款的时间
             $taskInfo->status=4;//确认发货（可能是倒计时自动完成或者商家点击发货确认）
             if($taskInfo->save())
             {
                echo "SUCCESS";
             }else{
                echo "FAIL";
             }
        }
        else
        {
            echo "FAIL";
        }
    }
    
     //接手接任务-等接接手收货好评
    public function actionWaitBuyerHP()
    {
		//渲染页面
        if(isset($_GET['taskid']) && Yii::app()->user->getId())
        {
            $taskInfo=Companytasklist::model()->findByPk($_GET['taskid']);
            $this->renderPartial('waitBuyerHP',array(
                'taskInfo'=>$taskInfo
            ));
        }
        else
            echo "nothing";
    }
    
    //接手接任务-等接接手收货好评-完成收货好评
    public function actionWaitBuyerHPDone()
    {
        //保存好评截图数据
        if(isset($_POST['url3']) && $_POST['url3']!="" && isset($_POST['taskid']) && Yii::app()->user->getId())
        {
            $taskInfo=Companytasklist::model()->findByPk($_POST['taskid']);
			//判断时间是否已到
			$hourarr=array("0" => 0,"1" => 24,"2" => 48,"3" => 72,"4" => 96,"5" => 120,"6" => 144,"7" => 168,);
			$needhour=$hourarr[$taskInfo->ddlOKDay];
			$querenshouhuotime=$taskInfo->taskforthTime+$needhour*3600;
			$lasttime=time()-$querenshouhuotime;
			if($lasttime<0){
				echo "FAIL";
				Yii::app()->end();
			}
			//判断结束
            $taskInfo->taskfifthTime=time();//接手确认收货好评时间
            $taskInfo->status=5;//收货好评完成，等待商家确认完成任务
            $taskInfo->taskerHPingImg=$_POST['url3'];//收货好评截图
            if($taskInfo->save())
            {
                echo "SUCCESS";
            }
            else
                echo "FAIL";
        }
        else
        {
            echo "FAIL"; 
        }
    }
    
    //商家确定-任务完成
    public function actionTaskCompleteDone()
    {
        if(isset($_POST['taskid']) && Yii::app()->user->getId())
        {
            
            $taskInfo=Companytasklist::model()->findByPk($_POST['taskid']);
            $taskInfo->taskcompleteTime=time();//商家审核即任务完成时间
            $taskInfo->taskCompleteStatus=1;//任务完成，改变状态
            if($taskInfo->save())
            {
                //任务完成，将金额与米粒加到接手帐户
                //添加流水
                //1.保存金额流水
                $record=new Recordlist();
                $record->userid=$taskInfo->taskerid;//接手id
                $record->catalog=5;//发布任务使用金额
                $record->number=$taskInfo->txtPrice;//操作金额
                $record->time=time();//操作时间
                $record->taskid=$taskInfo->id;//任务id
                $record->save();//保存金额流水
                
                //2.保存米粒流水
                $recordMinLi=new Recordlist();
                $recordMinLi->userid=$taskInfo->taskerid;//接手id
                $recordMinLi->catalog=6;//发布任务使用米粒
                $recordMinLi->number=$taskInfo->MinLi;//操作数量
                $recordMinLi->time=time();//操作时间
                $recordMinLi->taskid=$taskInfo->id;//任务id
                $recordMinLi->save();//保存米粒流水
                
                //3.改变接手帐户中的金额与米粒
                $userinfo=User::model()->findByPk($taskInfo->taskerid);//获取接手信息
                if($taskInfo->payWay==1)//如果任务为垫付则增加商品金额，否则只增加米粒
                {
                    $userinfo->Money=$userinfo->Money+$taskInfo->txtPrice;//在原有金额基础上增加任务金额
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
                
                //4.改变发布方经验值
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
							'taskid'=>$_POST['taskid']
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
							$recordSpreak->taskid=$_POST['taskid'];//下线即接任务者的id
                            $recordSpreak->save();//保存米粒流水
                            //改变上家余额
                            $userAddMoney->Money=$userAddMoney->Money+$sxtcMoney->value;//达到要求奖励18元
                            $userAddMoney->SpreadMoney=$userAddMoney->SpreadMoney+$sxtcMoney->value;//累加推广获得的返现金额
                            $userAddMoney->save();
                        }
                    }
                    //给接任务者上线返点结束
					echo "SUCCESS";
                }
                else
                    echo "FAIL";
                    
            }
            else
                echo "FAIL";
        }else
            echo "FAIL";
    }
    
    //推广链接debug
    public function ActionTest()
    {
        $spreadid=303;//Yii::app()->user->getid();
        $uid=13;//上线id
        if($uid && $userFatherinfo=User::model()->findByPk($uid))
        {
            $recordCheck=Recordlist::model()->findByAttributes(array(
                'userid'=>$uid,
                'spreadid'=>$spreadid
            ));
            if($recordCheck==false)//如果没给过上线的奖励记录，则进行相关判断操作
            {
                $TakeTaskWcCount=Companytasklist::model()->findAll(array(
                    'condition'=>'taskerid='.$spreadid.' and status=5'
                ));
                $PublishTaskWcCount=Companytasklist::model()->findAll(array(
                    'condition'=>'publishid='.$spreadid.' and status=5'
                ));
                if($TakeTaskWcCount>9 || $PublishTaskWcCount>10)//接手的任务或者发布的任务完成10个即奖励
                {
                    //推广奖励返现流水
                    $recordSpreak=new Recordlist();
                    $recordSpreak->userid=$uid;//上家id
                    $recordSpreak->catalog=12;//推广返现类型
                    $recordSpreak->number=18;//返现18
                    $recordSpreak->time=time();//操作时间
                    $recordSpreak->spreadid=$spreadid;//任务id
                    $recordSpreak->save();//保存米粒流水
                    
                    //改变上家余额
                    $userAddMoney=User::model()->findByPk($uid);
                    $userAddMoney->Money=$userAddMoney->Money+18;//达到要求奖励18元
                    $userAddMoney->SpreadMoney=(int)$userAddMoney->SpreadMoney+18;//累加推广获得的返现金额
                    $userAddMoney->save();
                }
            }
        }
    }
    
    //接手接任务-等待商家审核-商家审核不通过且任务返回任务大厅
    public function actionBuyerFail()
    {
        if(isset($_POST['taskerid']) && isset($_POST['id']))
        {
            $taskInfo=Companytasklist::model()->findByPk($_POST['id']);
            if($taskInfo->taskerid==$_POST['taskerid'] && $taskInfo->status==1)//只有任务状态处理1-等待商家审核，商家才权审核通过，否则无权操作
            {
                $taskInfo->taskerid=null;//清除接手id
                $taskInfo->taskerWangwang=null;//清除接手买号旺旺
                $taskInfo->taskfristTime=null;//清除接手接任务时间
                $taskInfo->status=0;//任务状态变0，等待商家审核
                if($taskInfo->save())
                    echo "SUCCESS";
                else
                {
                    echo "FAIL";
                }
            }
            else//暂停失败
                echo 'FAIL';
        }
        else
            echo 'nothing';
    }
    
    //接手接任务-等待商家审核-审核时间超时自动取消
    public function actionTaskAutoBack()
    {
        if(isset($_POST['taskerid']) && isset($_POST['id']))
        {
            $taskInfo=Companytasklist::model()->findByPk($_POST['id']);
            if($taskInfo->taskerid==$_POST['taskerid'] && ($taskInfo->status==1 || $taskInfo->status==2))//只有任务状态处理1-待商家审核阶段，接手才有退出任务权限，商家有更换威客权限，否则无权操作
            {
                $taskInfo->taskerid=null;//清除接手id
                $taskInfo->taskerWangwang=null;//清除接手买号旺旺
                $taskInfo->taskfristTime=null;//清除接手接任务时间
                $taskInfo->status=0;//任务状态变0，等待商家审核
                if($taskInfo->save())
                    echo "SUCCESS";
                else
                {
                    echo "FAIL";
                }
            }
            else
                echo 'SELLERPASS';
        }
        else
            echo 'nothing';
    }
    
    
    //接手接任务-等待商家审核-审核时间超时自动取消
    public function actionTaskAutoBackWaitBueryPay()
    {
        if(isset($_POST['taskerid']) && isset($_POST['id']))
        {
            $taskInfo=Companytasklist::model()->findByPk($_POST['id']);
            if($taskInfo->taskerid==$_POST['taskerid'] && $taskInfo->status==2)//只有任务状态处理2-等待买家付款倒计时结束，任务重置
            {
                $taskInfo->taskerid=null;//清除接手id
                $taskInfo->taskerWangwang=null;//清除接手买号旺旺
                $taskInfo->taskfristTime=null;//清除接手接任务时间
                $taskInfo->status=0;//任务状态变0，等待商家审核
                $taskInfo->tasksecondTime=null;//清除商家审核通过，任务开始时间
                if($taskInfo->save())
                    echo "SUCCESS";
                else
                {
                    echo "FAIL";
                }
            }
            else
                echo 'SUCCESS';
        }
        else
            echo 'nothing';
    }
    //商家删除任务
    public function actionDeleteTask()
    {
        if(isset($_POST['taskerid']) && isset($_POST['id']))
        {
            $taskInfo=Companytasklist::model()->findByPk($_POST['id']);
			//echo '<pre>';
			//print_r($taskInfo);
			//echo '</pre>';
            if($taskInfo->taskerid==$_POST['taskerid'] && $taskInfo->status==0)//只有任务状态处理0-等待接手阶段，商家才权删除任务，否则无权操作
            {
                //$taskInfo->status=6;//任务状态变6，即暂停任务状态
                if($taskInfo->delete()){//执行删除操作
				    //执行退款操作
					if($taskInfo->payWay==1){//退金额
					    //进行加款操作
						//1.保存金额流水
                        $record=new Recordlist();
                        $record->userid=$taskInfo->publishid;//用户id
                        $record->catalog=16;//发布任务使用金额
                        $record->number=$taskInfo->txtPrice;//操作数量
                        $record->tasknum=1;//1个任务
						$record->taskid=$taskInfo->id;
                        $record->time=time();//操作时间
                        $record->save();//保存金额流水
					}
					//2.保存米粒流水
                    $recordMinLi=new Recordlist();
                    $recordMinLi->userid=$taskInfo->publishid;//用户id
                    $recordMinLi->catalog=17;//发布任务使用米粒
                    $recordMinLi->number=$taskInfo->MinLi;//操作数量
                    $recordMinLi->tasknum=1;//1个任务
					$recordMinLi->taskid=$taskInfo->id;
                    $recordMinLi->time=time();//操作时间
                    $recordMinLi->save();//保存米粒流水
					
					$userinfoBack=User::model()->findByPk($taskInfo->publishid);
					if($taskInfo->payWay==1){
						$userinfoBack->Money=$userinfoBack->Money+$taskInfo->txtPrice;//在原有余额基本上加上任务需要的金额
					}
					$userinfoBack->MinLi=$userinfoBack->MinLi+$taskInfo->MinLi;//在原有米粒基本上加上任务需要的米粒
					$userinfoBack->save();
					//执行退款操作结束
                    echo "SUCCESS";
			    }
                else
                {
                    echo "FAIL";
                }
            }
            else//删除失败
                echo 'FAIL';
        }
        else
            echo 'nothing';
    }
    
    //接手接任务-等待商家审核-商家暂停任务
    public function actionStopTask()
    {
        if(isset($_POST['taskerid']) && isset($_POST['id']))
        {
            $taskInfo=Companytasklist::model()->findByPk($_POST['id']);
            if($taskInfo->taskerid==$_POST['taskerid'] && $taskInfo->status==0)//只有任务状态处理0-等待接手阶段，商家才权暂停任务，否则无权操作
            {
                $taskInfo->status=6;//任务状态变6，即暂停任务状态
                if($taskInfo->save())
                    echo "SUCCESS";
                else
                {
                    echo "FAIL";
                }
            }
            else//暂停失败
                echo 'FAIL';
        }
        else
            echo 'nothing';
    }
    
    //接手接任务-等待商家审核-商家取消暂停任务
    public function actionStartTask()
    {
        if(isset($_POST['taskerid']) && isset($_POST['id']))
        {
            $taskInfo=Companytasklist::model()->findByPk($_POST['id']);
            if($taskInfo->taskerid==$_POST['taskerid'] && $taskInfo->status==6)//只有任务状态处理0-等待接手阶段，商家才权暂停任务，否则无权操作
            {
                $taskInfo->status=0;//任务状态变0，即等待接手状态
                if($taskInfo->save())
                    echo "SUCCESS";
                else
                {
                    echo "FAIL";
                }
            }
            else//取消暂停失败
                echo 'FAIL';
        }
        else
            echo 'nothing';
    }
    
    //商家追加米粒
    public function actionAddMinLi()
    {
        if(isset($_POST['addMinLiNum']) && isset($_POST['id']) && Yii::app()->user->getId())
        {
            $taskInfo=Companytasklist::model()->findByPk($_POST['id']);
            $userinfo=User::model()->findByPk(Yii::app()->user->getId());
            if($taskInfo->publishid==Yii::app()->user->getId())//是否为本人操作
            {
                //检查米粒数量是否充足
                if($_POST['addMinLiNum']>$taskInfo->MinLi)//米粒不足
                {
                    echo "MINLINOTENOUGH";
                }else//米粒充足
                {
                    //添加流水
                    //1.保存米粒回收流水
                    $record=new Recordlist();
                    $record->userid=Yii::app()->user->getId();//用户id
                    $record->catalog=9;//追加米粒类型
                    $record->number=$_POST['addMinLiNum'];//追加米粒数量
                    $record->taskid=$_POST['id'];//任务id
                    $record->time=time();//操作时间
                    $record->save();//保存流水
                    
                    //2.改变米粒的数量
                    $userinfo->MinLi=$userinfo->MinLi-$_POST['addMinLiNum'];//原有米粒减去追加的米粒
                    $userinfo->save();
                    
                    //3.任务追加米粒
                    $taskInfo->MinLi=$taskInfo->MinLi+$_POST['addMinLiNum'];
                    $taskInfo->save();
                    echo "SUCCESS";
                }
            }
            else//取消暂停失败
                echo 'FAIL';
        }
    }
    
    //商家修改好评内容
    public function actionChangeTxtMessage()
    {
        if(isset($_POST['txtMessage']) && isset($_POST['id']) && Yii::app()->user->getId())
        {
            $taskInfo=Companytasklist::model()->findByPk($_POST['id']);
            $userinfo=User::model()->findByPk(Yii::app()->user->getId());
            if($taskInfo->status<5)//如果接手已经接手，则不允许商家修改好评内容
            {
                if($taskInfo->publishid==Yii::app()->user->getId())//是否为本人操作
                {
                    $taskInfo->txtMessage=$_POST['txtMessage'];
                    if($taskInfo->save())
                        echo "SUCCESS";
                    else
                        echo "FAIL";
                }
                else
                    echo "FAIL";
            }
            else
                echo "NOTALLOW";
        }else
        {
            echo "NOLOGIN";
        }
    }
    
    //商家修改收货地址
    public function actionChangeCbxIsAddressContent()
    {
        if(isset($_POST['addName']) && isset($_POST['addTel']) && isset($_POST['addCode']) && isset($_POST['addAddress']) && isset($_POST['id']) && Yii::app()->user->getId())
        {
            $address=$_POST['addName']."|".$_POST['addTel']."|".$_POST['addCode']."|".$_POST['addAddress'];
            $taskInfo=Companytasklist::model()->findByPk($_POST['id']);
            $userinfo=User::model()->findByPk(Yii::app()->user->getId());
            if($taskInfo->status<2)//如果处理等待接手状态或者待商家审核状态，则允许商家修改收货地址
            {
                if($taskInfo->publishid==Yii::app()->user->getId())//是否为本人操作
                {
                    $taskInfo->cbxIsAddressContent=$address;//收货地址
                    if($taskInfo->save())
                        echo "SUCCESS";
                    else
                        echo "SUCCESS";
                }
                else
                    echo "FAIL";
            }
            else//不允许修改收货地址
                echo "NOTALLOW";
        }else
        {
            echo "NOLOGIN";
        }
    }
    
    

    //阿里巴巴大厅
    public function actionJdTask()
    {
        $this->render('jdTask');
    }
    
    //京东大厅
    public function action1688Task()
    {
        $this->render('1688Task');
    }
    
    //新手帮助
    public function actionHelp()
    {
        if(Yii::app()->user->getIsGuest())
        {
            $this->redirect($this->createUrl('passport/login'));
        }
        $this->render('help');
    }
    
    /*
        ***YOU麦宣传页
    */
    public function actionIntroduce()
    {
        $this->render('introduce');
    }
    
    /*
        ***淘宝任务大厅
    */
    public function actionTaobaoList()
    {
        if(Yii::app()->user->getIsGuest())
       {
            $this->redirect(array("passport/login"));
            Yii::app()->end();
       }
	   else
       {
            /*
                ***调取商家商家任务信息
            */
            /*$taskList=Companytasklistaddon::model()->findAll(array(
                'condition'=>'statue=0',
                'select'=>'id,taskid,productprice,getfbd,addfbd',
                'order'=>'id desc',
                'limit'=>20
            ));*/
            
            
            
            $criteria = new CDbCriteria;
            $criteria->condition='statue=0';
            $criteria->select='id,taskid,productprice,getfbd,addfbd';
            $criteria->order ="id desc";
        
            //分页开始
            $total = Companytasklistaddon::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=20;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Companytasklistaddon::model()->findAll($criteria);
            //分页结束
            
            $this->render('taobaolist',array(
                'taskList' => $proreg,
                'pages' => $pages
            ));
       }
    }
    
    public function actionStudy()
    {
        if(Yii::app()->user->getIsGuest())
        {
            $this->renderPartial('study');
        }
        else
            $this->render('study');
    }
    
    public function actionStudyA()
    {
        if(Yii::app()->user->getIsGuest())
        {
            $this->renderPartial('studyA');
        }
        else
            $this->render('studyA');
    }
    
    /*
        ***客服中心
    */
    public function actionServices()
    {
        $this->render('services');
    }
    
    /*
        ***开始接任务
    */
    public function actionTakeTaskOth()
    {
        if(Yii::app()->user->getIsGuest())
        {
            $this->redirect(array("passport/login"));
            Yii::app()->end();
        }
        
        if(isset($_POST['wangwangid']) && isset($_POST['taskid']))
        {
            /*
                ***检查不允许自己接自己任务
            */
            $checkismytask=companytasklistaddon::model()->findByPk($_POST['taskid']);
            if(Yii::app()->user->getId()==$checkismytask->fbrid)
            {
                $this->redirect_message('系统不允许用户接自己发布的任务','success','3',$this->createUrl('site/index'));
                Yii::app()->end();
            }
            
            
            /*
                ***
                限制14天以内
                （1）杜绝同一IP，不同旺旺，只能接同一商家的一次任务
                （2）杜绝同一IP，同一旺旺，只能接同一商家一次任务
                （3）杜绝同一IP，多旺旺只能接同一商家的一次任务
            */
            
            $getIp=XUtils::getClientIP();//获取接手当前IP
            $wangwangid=$_POST['wangwangid'];//买号
            $taskid=$_POST['taskid'];//任务id
            
            
            @$myLastTask=Companytasklistaddon::model()->find(array(
                'condition'=>'userid='.Yii::app()->user->getId()." and fbrid=".$checkismytask->fbrid,
                'order'=>'id desc'
            ));//获取我接的该商家的最近的一个任务，从而获取最近接该商家任务的时间
            
            /*
                ***检查IP情况
            */
            @$ipLastTask=Companytasklistaddon::model()->find(array(
                'condition'=>"fbrid=".$checkismytask->fbrid." and ip='$getIp'",
            ));
            
            //echo count($myTaskLimitInfo);
            //exit;
            if(count($myLastTask)>0)
            {
                if(@time()<($myLastTask->time+14*24*3600))//离最近接该商家的一次到往后14天内该不能再接同一商家任务
                {
                    $this->redirect_message('根据规则，到'.date('Y-m-d H:i:s',@$myLastTask->time+14*24*3600)."您才可以接该商家任务");
                    Yii::app()->end();
                }
            }
            
            /*
                ***IP检测
            */
            if(count($ipLastTask)>0)
            {
                if(@time()<($ipLastTask->time+14*24*3600))//同一IP离最近接该商家的一次到往后14天内该不能再接同一商家任务
                {
                    $this->redirect_message('根据规则，跟您同一IP的用户接了该商家的任务，建议您更换IP再接该商家任务');
                    Yii::app()->end();
                }
            }
            
            
            
            
            
            /*
                ***同一用户接手但是没有付款的任务不能超过三个
            */
            $findMyTask=Companytasklistaddon::model()->findAll(array(
                'condition'=>'userid='.Yii::app()->user->getId().' and statue=1',
                'select'=>'id'
            ));
            
            if(count($findMyTask)>2)
            {
                $this->redirect_message('接手但是没有付款的任务不能超过3个','success','3',$this->createUrl('site/index'));
                Yii::app()->end();
            }
            
            
            if($checkismytask->statue!=0)
            {
                $this->redirect_message('该任务已经在进行中，请刷新您的页面','success','3',$this->createUrl('site/index'));
                Yii::app()->end();
            }
            
            /*
                ***检测用户是否实名制
            */
            $personReal=Personrealname::model()->findByAttributes(array(
                "userid"=>Yii::app()->user->getId()
            ));
            
            if(@$personReal && @$personReal->check==1)//如果通过实名认证开始接任务
            {
                /*
                    ***添加个人任务列表
                */
                $personTaskInfo=new Persontasklist;
                $personTaskInfo->userid=Yii::app()->user->getId();
                $personTaskInfo->taskid=$_POST['taskid'];
                $personTaskInfo->wangwangid=$_POST['wangwangid'];
                $personTaskInfo->ip=XUtils::getClientIP();
                $personTaskInfo->time=time();
                $personTaskInfo->save();
                if($personTaskInfo->save())
                {
                    /*
                        ***修改任务该任务的状态
                    */
                    $companyTaskListAddon=Companytasklistaddon::model()->findByPk($_POST['taskid']);
                    $companyTaskListAddon->userid=Yii::app()->user->getId();
                    $companyTaskListAddon->statue=1;
                    $companyTaskListAddon->ip=XUtils::getClientIP();
                    $companyTaskListAddon->time=$personTaskInfo->time;
                    $companyTaskListAddon->save();
                    
                    $this->redirect(array('site/mytaskstatueA'));
                }
                else
                    echo "no";
            }
            else
            {
                $this->redirect_message('您还没有通过个人信息实名认证,请先认证','success',4,$this->createUrl('user/personRealName'));
            }
        }
        else//没有旺旺情况下进行的提交
        {
            $this->redirect(array('site/index'));
        }
    }
    
    /*
        ***任务确认付款倒计时
    */
    public function actionTaskback()
    {
        if(isset($_POST['userid']) && isset($_POST['id']))
        {
            $taskAddon=Companytasklistaddon::model()->findByPk($_POST['id']);
            
            $taskAddon->userid="";
            $taskAddon->statue=0;
            $taskAddon->ip=null;
            $taskAddon->time="";
            
            $taskAddon->dfstatue=0;
            $taskAddon->dftime=null;
            $taskAddon->dfcomplete=0;
            
            $persontasklist=Persontasklist::model()->find(array(
                'condition'=>'taskid='.$_POST['id']
            ));
            
            $taskAddon->save();
            $persontasklist->delete();
        }
    }
    
    
    /*
        ***我的任务列表
    */
    public function actionMytasklist()
    {
        if(Yii::app()->user->getIsGuest())
        {
            $this->redirect(array("passport/login"));
            Yii::app()->end();
        }
        
        /*
            ***查询出用户充值交易信息
        */
        $criteria = new CDbCriteria;
        $criteria->condition='userid='.Yii::app()->user->getId();
        $criteria->order ="id desc";
    
        //分页开始
        $total = Persontasklist::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Persontasklist::model()->findAll($criteria);
        //分页结束
        
        $this->render('mytasklist',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    
    /*
        ***我的任务列表-等待付款列表
    */
    public function actionMytaskstatueA()
    {
        if(Yii::app()->user->getIsGuest())
        {
            $this->redirect(array("passport/login"));
            Yii::app()->end();
        }
        
        /*
            ***查询出用户充值交易信息
        */
        $criteria = new CDbCriteria;
        $criteria->condition='userid='.Yii::app()->user->getId().' and statue=1';
        $criteria->order ="id desc";
    
        //分页开始
        $total = companytasklistaddon::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = companytasklistaddon::model()->findAll($criteria);
        //分页结束
        
        $this->render('mytaskstatueA',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    
    /*
        ***接手取消接了但是没有付款的任务
    */
    public function actionTaskBackList()
    {
        if(isset($_GET['id']))
        {
            $taskAdd=Companytasklistaddon::model()->findByPk($_GET['id']);
            if($taskAdd->userid==Yii::app()->user->getId() && $taskAdd->statue==1)
            {
                $taskAdd->userid=null;
                $taskAdd->statue=0;//退出任务，将该任务记录的状态改为0
                $taskAdd->ip=null;
                $taskAdd->time=null;
                
                $taskAddon->dfstatue=0;
                $taskAddon->dftime=null;
                $taskAddon->dfcomplete=0;
                
                if($taskAdd->save())
                {
                    $personTaskInfo=Persontasklist::model()->find(array(
                        'condition'=>'taskid='.$_GET['id']
                    ));
                    if($personTaskInfo->delete())//将退出的任务从个人任务列表中删除
                    {
                        $this->redirect(array('site/mytaskstatueA'));
                    }
                }
                else
                    $this->redirect_message('退出任务失败，请联系网站客服',3,$this->createUrl('site/mytaskstatueA'));
            }
            else
                $this->redirect(array('site/index'));
        }
    }
    
    
    /*
        ***商家取消接了但是没有付款的任务
    */
    public function actionCompanytaskBackList()
    {
        if(isset($_GET['id']))
        {
            $taskAdd=Companytasklistaddon::model()->findByPk($_GET['id']);
            if($taskAdd->fbrid==Yii::app()->user->getId() && $taskAdd->statue==1)
            {
                $taskAdd->userid=null;
                $taskAdd->statue=0;//退出任务，将该任务记录的状态改为0
                $taskAdd->ip=null;
                $taskAdd->time=null;
                
                $taskAdd->dfstatue=0;
                $taskAdd->dftime=null;
                $taskAdd->dfcomplete=0;
                
                if($taskAdd->save())
                {
                    $personTaskInfo=Persontasklist::model()->find(array(
                        'condition'=>'taskid='.$_GET['id']
                    ));
                    if($personTaskInfo->delete())//将退出的任务从接手任务列表中删除
                    {
                        $this->redirect(array('site/mytaskstatueA'));
                    }
                }
                else
                    $this->redirect_message('取消任务失败，请联系网站客服',3,$this->createUrl('site/mytaskstatueA'));
            }
            else
                $this->redirect(array('site/index'));
        }
    }
    
    /*
        ***我的任务列表-等待商家发货列表
    */
    public function actionMytaskstatueB()
    {
        if(Yii::app()->user->getIsGuest())
        {
            $this->redirect(array("passport/login"));
            Yii::app()->end();
        }
        
        /*
            ***查询出用户充值交易信息
        */
        $criteria = new CDbCriteria;
        $criteria->condition='userid='.Yii::app()->user->getId().' and statue=2';
        $criteria->order ="id desc";
    
        //分页开始
        $total = companytasklistaddon::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = companytasklistaddon::model()->findAll($criteria);
        //分页结束
        
        $this->render('mytaskstatueB',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    /*
        ***我的任务列表-等待商家发货列表
    */
    public function actionMytaskstatueC()
    {
        if(Yii::app()->user->getIsGuest())
        {
            $this->redirect(array("passport/login"));
            Yii::app()->end();
        }
        
        /*
            ***查询出用户充值交易信息
        */
        $criteria = new CDbCriteria;
        $criteria->condition='userid='.Yii::app()->user->getId().' and statue=3';
        $criteria->order ="id desc";
    
        //分页开始
        $total = companytasklistaddon::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=20;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = companytasklistaddon::model()->findAll($criteria);
        //分页结束
        
        $this->render('mytaskstatueC',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    
    /*
        ***我的任务列表-等待商家确认列表
    */
    public function actionMytaskstatueD()
    {
        if(Yii::app()->user->getIsGuest())
        {
            $this->redirect(array("passport/login"));
            Yii::app()->end();
        }
        
        /*
            ***查询出用户充值交易信息
        */
        $criteria = new CDbCriteria;
        $criteria->condition='userid='.Yii::app()->user->getId().' and statue=4';
        $criteria->order ="id desc";
    
        //分页开始
        $total = companytasklistaddon::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = companytasklistaddon::model()->findAll($criteria);
        //分页结束
        
        $this->render('mytaskstatueD',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    /*
        ***我的任务列表-已完成任务列表
    */
    public function actionMytaskstatueE()
    {
        if(Yii::app()->user->getIsGuest())
        {
            $this->redirect(array("passport/login"));
            Yii::app()->end();
        }
        
        /*
            ***查询出用户充值交易信息
        */
        $criteria = new CDbCriteria;
        $criteria->condition='userid='.Yii::app()->user->getId().' and statue=5';
        $criteria->order ="id desc";
    
        //分页开始
        $total = companytasklistaddon::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = companytasklistaddon::model()->findAll($criteria);
        //分页结束
        
        $this->render('mytaskstatueE',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    /*
        ***申请平台代付及申请平台代付列表
    */
    public function actionMytaskstatueF()
    {
        if(isset($_GET['id']))
        {
            $checkTask=Companytasklistaddon::model()->findByPk($_GET['id']);
            if($checkTask->userid==Yii::app()->user->getId() && $checkTask->statue==1 && $checkTask->dfstatue==0 && $checkTask->dftime==false && $checkTask->dfcomplete==0)
            {
                $checkTask->dfstatue=1;//改变任务的代付状态
                $checkTask->dftime=time();//添加用户申请代付的时间
                if($checkTask->save())
                {
                    $this->redirect_message('已加入申请，请联系我们的客服人员，协助代付','success',3,$this->createUrl('site/mytaskstatueF'));
                }
            }
            else
                $this->redirect_message('该任务不具备申请平台代付的条件','success',3,$this->createUrl('site/mytaskstatueF'));
        }
        
        $criteria = new CDbCriteria;
        $criteria->condition='userid='.Yii::app()->user->getId().' and dfstatue=1';
        $criteria->order ="dftime desc";
    
        //分页开始
        $total = companytasklistaddon::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = companytasklistaddon::model()->findAll($criteria);
        //分页结束
        
        $this->render('mytaskstatueF',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    
    /*
        ***我发布的任务列表-等待接手付款
    */
    public function actionMypublishtaskA()
    {
        if(Yii::app()->user->getIsGuest())
        {
            $this->redirect(array("passport/login"));
            Yii::app()->end();
        }
        
        /*
            ***查询出用户充值交易信息
        */
        $criteria = new CDbCriteria;
        $criteria->condition='fbrid='.Yii::app()->user->getId().' and statue=1';
        $criteria->order ="id desc";
    
        //分页开始
        $total = companytasklistaddon::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = companytasklistaddon::model()->findAll($criteria);
        //分页结束
        
        $this->render('mypublishtaskA',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    
    /*
        ***我发布的任务列表-等待我发货
    */
    public function actionMypublishtaskB()
    {
        if(Yii::app()->user->getIsGuest())
        {
            $this->redirect(array("passport/login"));
            Yii::app()->end();
        }
        
        /*
            ***查询出用户充值交易信息
        */
        $criteria = new CDbCriteria;
        $criteria->condition='fbrid='.Yii::app()->user->getId().' and statue=2';
        $criteria->order ="id desc";
    
        //分页开始
        $total = companytasklistaddon::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = companytasklistaddon::model()->findAll($criteria);
        //分页结束
        
        $this->render('mypublishtaskB',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    /*
        ***我发布的任务列表-等待接手收货
    */
    public function actionMypublishtaskC()
    {
        if(Yii::app()->user->getIsGuest())
        {
            $this->redirect(array("passport/login"));
            Yii::app()->end();
        }
        
        /*
            ***查询出用户充值交易信息
        */
        $criteria = new CDbCriteria;
        $criteria->condition='fbrid='.Yii::app()->user->getId().' and statue=3';
        $criteria->order ="id desc";
    
        //分页开始
        $total = companytasklistaddon::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = companytasklistaddon::model()->findAll($criteria);
        //分页结束
        
        $this->render('mypublishtaskC',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    /*
        ***我发布的任务列表-等待我确认
    */
    public function actionMypublishtaskD()
    {
        if(Yii::app()->user->getIsGuest())
        {
            $this->redirect(array("passport/login"));
            Yii::app()->end();
        }
        
        /*
            ***查询出用户充值交易信息
        */
        $criteria = new CDbCriteria;
        $criteria->condition='fbrid='.Yii::app()->user->getId().' and statue=4';
        $criteria->order ="id desc";
    
        //分页开始
        $total = companytasklistaddon::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = companytasklistaddon::model()->findAll($criteria);
        //分页结束
        
        $this->render('mypublishtaskD',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    
    /*
        ***我发布的任务列表-已完成任务
    */
    public function actionMypublishtaskE()
    {
        if(Yii::app()->user->getIsGuest())
        {
            $this->redirect(array("passport/login"));
            Yii::app()->end();
        }
        
        /*
            ***查询出用户充值交易信息
        */
        $criteria = new CDbCriteria;
        $criteria->condition='fbrid='.Yii::app()->user->getId().' and statue=5';
        $criteria->order ="id desc";
    
        //分页开始
        $total = companytasklistaddon::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = companytasklistaddon::model()->findAll($criteria);
        //分页结束
        
        $this->render('mypublishtaskE',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    
    
    /*
        ***我发布的任务
    */
    public function actionMypublishtasklist()
    {
        if(Yii::app()->user->getIsGuest())
        {
            $this->redirect(array("passport/login"));
            Yii::app()->end();
        }
        
        /*
            ***查询出用户充值交易信息
        */
        $criteria = new CDbCriteria;
        $criteria->condition='fbrid='.Yii::app()->user->getId();
        $criteria->order ="time desc,statue asc";
    
        //分页开始
        $total = companytasklistaddon::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = companytasklistaddon::model()->findAll($criteria);
        //分页结束
        
        $this->render('mypublishtasklist',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    /*
        ***YOU麦历史任务
    */
    public function actionHistorytasklist()
    {
        if(Yii::app()->user->getIsGuest())
        {
            $this->redirect(array("passport/login"));
            Yii::app()->end();
        }
        
        /*
            ***查询出用户充值交易信息
        */
        $criteria = new CDbCriteria;
        $criteria->condition='statue>0';
        $criteria->order ="time desc,statue asc";
    
        //分页开始
        $total = companytasklistaddon::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = companytasklistaddon::model()->findAll($criteria);
        //分页结束
        
        $this->render('historytasklist',array(
            'total'=>$total,
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    
    
    /*
        ***接手确认付款
    */
    public function actionPersonStepFK()
    {
        if(Yii::app()->user->getIsGuest())
        {
            $this->redirect(array("passport/login"));
            Yii::app()->end();
        }
        
        
        if(isset($_POST['fktaskid']))
        {
            /*
                ***首先确认此任务是不是该接手接的
            */
            $checkTask=Companytasklistaddon::model()->findByPk($_POST['fktaskid']);
            
            $companyTask=Companytasklist::model()->findByPk($checkTask->taskid);
            if($companyTask->prourl!=$_POST['prourl'])
            {
                $this->redirect_message("商品地址与商家要求的商品地址不一致，无法确认付款!",'success',3,$this->createUrl('site/mytaskstatueA'));
                Yii::app()->end();
            }
            
            
            if($checkTask)
            {
                $checkTask->statue=2;//改变该任务状态
                $checkTask->fktime=time();//接手付款时间
                if($checkTask->save())
                {
                    $this->redirect(array('site/mytaskstatueB'));
                }
                else
                    $this->redirect_message("出现异常，请联系网站客服",'success',4,$this->createUrl('site/mytasklist'));
            }
            else//如果不是则可能存在恶意试探
            {
                $this->redirect("http://www.baidu.com");
            }
        }
    }
    
    /*
        ***商家确认发货
    */
    public function actionCompanyStepFH()
    {
        if(Yii::app()->user->getIsGuest())
        {
            $this->redirect(array("passport/login"));
            Yii::app()->end();
        }
        if(isset($_GET['fhtaskid']))
        {
            
            $checkTask=Companytasklistaddon::model()->findByPk($_GET['fhtaskid']);
            $checkTask->statue=3;
            $checkTask->fhtime=time();
            if($checkTask->save())
            {
                $this->redirect(array('site/mypublishtaskC'));
            }
            else
                $this->redirect_message("出现异常，请联系网站客服",'success',4,$this->createUrl('site/mypublishtasklist'));
        }
    }
    
    /*
        ***接手确认收货
    */
    public function actionPersonStepSH()
    {
        if(Yii::app()->user->getIsGuest())
        {
            $this->redirect(array("passport/login"));
            Yii::app()->end();
        }
        
        if(isset($_GET['shtaskid']))
        {
            /*
                ***首先确认此任务是不是该接手接的
            */
            $checkTask=Companytasklistaddon::model()->findByPk($_GET['shtaskid']);
            if($checkTask)
            {
                $checkTask->statue=4;//改变该任务状态
                $checkTask->shtime=time();
                if($checkTask->save())
                {
                    $this->redirect(array('site/mytaskstatueD'));
                }
                else
                    $this->redirect_message("出现异常，请联系网站客服",'success',4,$this->createUrl('site/mytasklist'));
            }
            else//如果不是则可能存在恶意试探
            {
                $this->redirect("http://www.baidu.com");
            }
        }
    }
    
    /*
        ***商家确认完成操作
    */
    public function actionCompanyStepWC()
    {
        if(Yii::app()->user->getIsGuest())
        {
            $this->redirect(array("passport/login"));
            Yii::app()->end();
        }
        if(isset($_GET['wctaskid']))
        {
            
            $checkTask=Companytasklistaddon::model()->findByPk($_GET['wctaskid']);
            
            if($checkTask->fbrid!=Yii::app()->user->getId())//检查该任务是不是点击确认完成时的商家发布的，如果不是可能是恶意操作
            {
                $this->redirect_message('您无权操作，您的IP与用户ID已被记录，如务操作请联系客服','success',20,$this->createUrl('site/index'));
                Yii::app()->end();
            }
            
            $checkTask->statue=5;
            $checkTask->wctime=time();
            
            if($checkTask->save())//商家确认完成
            {
                /*
                    ***商家确认完成后将项目金额与发布点转移到接手帐号中
                */
                $accountList=Accountlist::model()->findByAttributes(array(
                    "userid"=>$checkTask->userid
                ));
                
                if($checkTask->dfcomplete==1)//如果该任务申请平台代付则对发布点与金额进行处理
                {
                    $accountList->fbdnum=$accountList->fbdnum+($checkTask->getfbd+$checkTask->addfbd)*0.5;//平台代付则获得50%的发布点
                    $accountList->money=$accountList->money+0;//增加的金额为0
                }
                
                if($checkTask->dfcomplete==0)//该任务没有申请平台代付
                {
                    $accountList->fbdnum=$accountList->fbdnum+$checkTask->getfbd+$checkTask->addfbd;
                    $accountList->money=$accountList->money+$checkTask->productprice;
                }
                $accountList->save();
                
                /*
                    寻找该接手的推荐人，如果存在则进行发布点分配
                */
                $checktjr=User::model()->findByPk($checkTask->userid);
                if($checktjr->IdNumber==false)
                    $this->redirect(array('site/mypublishtaskE'));
                else
                {
                    /*
                        ***对介绍人进行提成业务逻辑
                    */
                    $tjrid=$checktjr->IdNumber;//推荐人ID
                    $tjrinfo=Accountlist::model()->findByAttributes(array(
                        "userid"=>$tjrid
                    ));//获取推荐人帐户信息
                    
                    //检查个人实名制
                    $checkpersonrealname=Personrealname::model()->findByAttributes(array(
                         "userid"=>$checkTask->userid,
                         "check"=>1
                    ));
                    
                    //检查商家实名制
                    $checkcompanyrealname=Companyrealname::model()->findByAttributes(array(
                         "userid"=>$checkTask->userid,
                         "check"=>1
                    ));
                    
                    if(count(@$checkpersonrealname)>0 && count($checkcompanyrealname)==false)//只是接手不是商家
                    {
                        if($checktjr->VipLv==0)
                        {
                            $checktjr->VipLv=1;
                        }
                        $tjfbd=($checkTask->getfbd+$checkTask->addfbd)*(($checktjr->VipLv+3)/100);//根据介绍人不同的等级进行不两同的比例提成
                        $tjrstyle=1;
                    }
                    
                    if(count(@$checkpersonrealname)==false && count($checkcompanyrealname)>0)//只是商家不是接手
                    {
                        if($checktjr->VipLv==0)
                        {
                            $checktjr->VipLv=1;
                        }
                        $tjfbd=($checkTask->getfbd+$checkTask->addfbd)*(($checktjr->VipLv+5)/100);//根据介绍人不同的等级进行不两同的比例提成
                        $tjrstyle=2;
                    }
                    
                    if(count(@$checkpersonrealname)>0 && count($checkcompanyrealname)>0)//该用户既是接手也是商家
                    {
                        $tjfbd=($checkTask->getfbd+$checkTask->addfbd)*0.1;
                        $tjrstyle=3;
                    }
                    
                    $tjrinfo->fbdnum=$tjrinfo->fbdnum+$tjfbd;
                    
                    if($tjrinfo->save())//提成增加到推荐人的帐户中
                    {
                        //将提成信息存储到提成记录表中
                        $CommissionInfo=new Commission;
                        
                        $CommissionInfo->userid=$tjrid;
                        $CommissionInfo->style=$tjrstyle;
                        $CommissionInfo->fbdnum=$tjfbd;
                        $CommissionInfo->time=$checkTask->wctime;
                        $CommissionInfo->taskid=$_GET['wctaskid'];
                        if($CommissionInfo->save())
                        {
                            $this->redirect(array('site/mypublishtaskE'));
                        }
                        else
                        {
                            $this->redirect_message('任务完成时，介绍人提成出现异常，请联系网站管理员','success',3,$this->createUrl('site/mypublishtaskE'));
                        }
                    }
                }
            }
            else
                $this->redirect_message("出现异常，请联系网站客服",'success',4,$this->createUrl('site/mypublishtasklist'));
        }
    }
    
    
    
	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	//用户退出
    public function actionLoginout(){
        Yii::app()->user->logout(false); //当前应用用户退出 
        echo $this->redirect('index');
    }
    /*
	    用户发布任务时进行手机短信验证
	*/
	public function actionTaskPublistCode(){
		$_POST['phone']='15150678327';
		if(isset($_POST['phone']))
        {
			$userid=Yii::app()->user->getId();
			$suerid=intval($userid);
			if($userid<=0){
				echo "非法操作";
				Yii::app()->end();
			}
			$currenttime=time();
			$starttime=date("Y-m-d 00:00:00",$currenttime);
			$starttime=strtotime($starttime);
			$endtime=date("Y-m-d 23:59:59",$currenttime);
			$endtime=strtotime($endtime);
			
			$criteria = new CDbCriteria;
            $criteria->condition='userid='.$userid.' and time>='.$starttime.' and time<='.$endtime;
            $criteria->order ="id desc";
            $number = Smslist::model()->count($criteria);
			if($number>30){
				echo "每个用户每天最多只能发送30条短信";
                Yii::app()->end();
			}
            //检查时间
			if(isset(Yii::app()->session['currenttimepublish'])){
				$lasttime=Yii::app()->session['currenttimepublish'];
				if(time()-$lasttime<180){
					echo "180秒内只能发送一次";
                    Yii::app()->end();
				}
			}
			//检查手机号在数据库中是否存在
            $checkphone=User::model()->findByAttributes(array('Phon'=>$_POST['phone']));
            if($checkphone==false)//手机号不存在
            {
                echo "FAIL";
                Yii::app()->end();
            }
            //生成验证码
            $randStr = str_shuffle('1234567890');//短信验证码由数字组成
            $code = substr($randStr,0,6);
            
            $content=$this->newSms($_POST['phone'],'【优美】您的短信验证码为'.$code.'，若非本人操作，请忽略！');
             
            if($content == '000'){
				$num=System::model()->findByAttributes(array("varname"=>"taskUpSmsMoney"));
				//插入短信发送记录
				$record=new Smslist();
                $record->userid=$userid;//用户id
                $record->type=1;//购买米粒类型
                $record->phone=$_POST['phone'];//购买米粒数量
                $record->time=time();//操作时间
                $record->save();//
				
				//每发一条短信，扣一条短信的钱
				$record=new Recordlist();
                $record->userid=$userid;//用户id
                $record->catalog=13;//13代表短信费
                $record->number=$num;//费用
                $record->time=time();//操作时间
                $record->save();//保存流水
				
				//对用户进行减钱操作
				$userinfo=User::model()->findByPk($userid);
				$userinfo->Money=$userinfo->Money-$num;//在原有余额基本上减去购买米粒使用掉的金额
                $userinfo->save();
                //状态为0，说明短信发送成功
                Yii::app()->session['codepublish']=$code;//session存储code用于检验
                Yii::app()->session['phonepublish']=$_POST['phone'];//session存储手机号码用于检验
				Yii::app()->session['currenttimepublish']=time();//session存储手机号码用于检验
                echo "SUCCESS";
            }else{
                //状态非0，说明失败
                echo "FAIL";
            }
        }
	}
    
    public function actionSms()
    {
        if(isset($_POST['phone']) && isset($_POST['phoneCode']))
        {
            //检查时间
			if(isset(Yii::app()->session['currenttime'])){
				$lasttime=Yii::app()->session['currenttime'];
				if(time()-$lasttime<300){
					echo "300秒内只能发送一次";
                    Yii::app()->end();
				}
			}
			//检查手机号在数据库中是否存在
            $checkphone=User::model()->findByAttributes(array('Phon'=>$_POST['phone']));
            if($checkphone==false)//手机号不存在
            {
                echo "FAIL";
                Yii::app()->end();
            }
            //生成验证码
            $randStr = str_shuffle('1234567890');//短信验证码由数字组成
            $code = substr($randStr,0,6);
            
            $content=$this->newSms($_POST['phone'],'【桔子威客电商平台】您的短信验证码为'.$code.'，请5分钟内完成验证，若非本人操作，请忽略此短信。');
             
            if($content == '000'){
                //状态为0，说明短信发送成功
                Yii::app()->session['code']=$code;//session存储code用于检验
                Yii::app()->session['phone']=$_POST['phone'];//session存储手机号码用于检验
				Yii::app()->session['currenttime']=time();//session存储手机号码用于检验
                echo "SUCCESS";
            }else{
                //状态非0，说明失败
                echo "FAIL";
            }
        }
    }
    
    public function NewSms($Mobile,$Content)
    {
        $url="http://service.winic.org:8009/sys_port/gateway/index.asp";
    	$data = "id=%s&pwd=%s&to=%s&content=%s&otime=";
    	$id = iconv("UTF-8","GB2312",'a70919342');
    	$pwd = 'a64582143';
    	$to = $Mobile; 
    	$content = iconv("UTF-8","GB2312",$Content);
    	$rdata = sprintf($data, $id, $pwd, $to, $content);
    	
    	$ch = curl_init();
    	curl_setopt($ch, CURLOPT_POST,1);
    	curl_setopt($ch, CURLOPT_POSTFIELDS,$rdata);
    	curl_setopt($ch, CURLOPT_URL,$url);
    	curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
    	$result = curl_exec($ch);
    	curl_close($ch);
    	$result = substr($result,0,3);
        return $result;
	    /*if ($result == '000')
    	{
    		return  "短信发送成功";
    	}
    	else if ($result == '-01')
    	{
    		return "短信余额不足";
    	}
    	else if ($result == '-02')
    	{
    		return "用户ID错误";
    	}
    	else if ($result == '-03')
    	{
    		return "密码错误";
    	}
    	else
    	{
    		return "未知错误";
    	}*/
    }
}