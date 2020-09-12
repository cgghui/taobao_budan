<?php
    class SystemController extends Aclfilter{
        
        public $layout='//layouts/backyard';//定义布局以便加载kindeditor文本编辑器的css与js
        
        
        
        /*
            新手考试管理
        */
        public function actionExam()
        {
            parent::acl();
            if(isset($_POST['Question']))
            {
                $exam=new Exam();
                //添加题目
                $exam->is_question=1;//题目
                $exam->text=$_POST['Question'];//题目标题
                $exam->time=time();//添加时间
                if($exam->save())
                {
                    $q_id=$exam->attributes['id'];//返回插入的id
                    
                    if(isset($_POST['answerA']) && $_POST['answerA']!=="")//存入答案A
                    {
                        $examA=new Exam();
                        $examA->is_question=0;//类型为答案
                        if($_POST['answer']==1)
                            $examA->answer=1;//如果正确答案为第一个选项，则该选项为正确答案标记为1
                        $examA->q_id=$q_id;//答案属于哪个题目
                        $examA->text=$_POST['answerA'];//答案内容
                        $examA->time=time();//添加时间
                        $examA->save();
                    }
                    
                    
                    if(isset($_POST['answerB']) && $_POST['answerB']!=="")//存入答案B
                    {
                        $examB=new Exam();
                        $examB->is_question=0;//类型为答案
                        if($_POST['answer']==2)
                            $examB->answer=1;//如果正确答案为第一个选项，则该选项为正确答案标记为1
                        $examB->q_id=$q_id;//答案属于哪个题目
                        $examB->text=$_POST['answerB'];//答案内容
                        $examB->time=time();//添加时间
                        $examB->save();
                    }
                    
                    if(isset($_POST['answerC']) && $_POST['answerC']!=="")//存入答案C
                    {
                        $examC=new Exam();
                        $examC->is_question=0;//类型为答案
                        if($_POST['answer']==3)
                            $examC->answer=1;//如果正确答案为第一个选项，则该选项为正确答案标记为1
                        $examC->q_id=$q_id;//答案属于哪个题目
                        $examC->text=$_POST['answerC'];//答案内容
                        $examC->time=time();//添加时间
                        $examC->save();
                    }
                    
                    
                    if(isset($_POST['answerD']) && $_POST['answerD']!=="")//存入答案D
                    {
                        $examD=new Exam();
                        $examD->is_question=0;//类型为答案
                        if($_POST['answer']==4)
                            $examD->answer=1;//如果正确答案为第一个选项，则该选项为正确答案标记为1
                        $examD->q_id=$q_id;//答案属于哪个题目
                        $examD->text=$_POST['answerD'];//答案内容
                        $examD->time=time();//添加时间
                        $examD->save();
                    }
                    
                    $this->redirect(array('system/exam'));
                    
                }
                Yii::app()->end();
            }
            
            $criteria = new CDbCriteria;
            $criteria->condition='is_question=1';//查询考试题目
            $criteria->order ="id desc";
        
            //分页开始
            $total = Exam::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=10;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Exam::model()->findAll($criteria);
            //分页结束
            
            $this->renderPartial('exam',array(
                'total'=>$total,
                'proInfo' => $proreg,
                'pages' => $pages
            ));
        }
        
        
        /*
            考试系统-删除考题
        */
        public function actionExamDel()
        {
            if(isset($_GET['examid']) && $_GET['examid']!="")
            {
                $examinfo=Exam::model()->findByPk($_GET['examid']);
                $examinfo->delete();
                $this->redirect(Yii::app()->request->urlReferrer);
            }
        }
        /*
            ***注册黑名单管理
        */
        public function actionBlackaccount()
        {
            parent::acl();
            if(isset($_POST['blackaccountinfo']))
            {
                if($_POST['blackaccountinfo']=="")//黑名单信息不能为
                {
                    $criteria = new CDbCriteria;
                    $criteria->order ="time desc";
                
                    //分页开始
                    $total = Blackaccount::model()->count($criteria);
                    $pages = new CPagination($total);
                    $pages->pageSize=10;//分页大小
                    $pages->applyLimit($criteria);
                    
                    $proreg = Blackaccount::model()->findAll($criteria);
                    //分页结束
                    
                    $this->renderPartial('blackaccount',array(
                        'total'=>$total,
                        'proInfo' => $proreg,
                        'pages' => $pages,
                        'addWarning'=>'黑名单信息不能为空'
                    ));
                    Yii::app()->end();
                }
                else{
                    $checkBlack=Blackaccount::model()->findByAttributes(array('blackaccountinfo'=>$_POST['blackaccountinfo']));
                    if($checkBlack)
                    {
                        $criteria = new CDbCriteria;
                        $criteria->order ="time desc";
                    
                        //分页开始
                        $total = Blackaccount::model()->count($criteria);
                        $pages = new CPagination($total);
                        $pages->pageSize=10;//分页大小
                        $pages->applyLimit($criteria);
                        
                        $proreg = Blackaccount::model()->findAll($criteria);
                        //分页结束
                        
                        $this->renderPartial('blackaccount',array(
                            'total'=>$total,
                            'proInfo' => $proreg,
                            'pages' => $pages,
                            'addWarning'=>'此信息已经添加过'
                        ));
                        Yii::app()->end();
                    }
                    else
                    {
                        $blackInfo=new Blackaccount();
                        $blackInfo->blackaccountinfo=$_POST['blackaccountinfo'];
                        $blackInfo->time=time();
                        $blackInfo->adderid=Yii::app()->user->getId();
                        $blackInfo->adder=Yii::app()->user->getName();
                        $blackInfo->save();
                        
                        $criteria = new CDbCriteria;
                        $criteria->order ="time desc";
                    
                        //分页开始
                        $total = Blackaccount::model()->count($criteria);
                        $pages = new CPagination($total);
                        $pages->pageSize=10;//分页大小
                        $pages->applyLimit($criteria);
                        
                        $proreg = Blackaccount::model()->findAll($criteria);
                        //分页结束
                        
                        $this->renderPartial('blackaccount',array(
                            'total'=>$total,
                            'proInfo' => $proreg,
                            'pages' => $pages,
                            'addWarning'=>'添加成功'
                        ));
                        Yii::app()->end();
                    }
                }
            }
            
            //模糊查询黑名单信息
            if(isset($_POST['keyword']))
            {
                $criteria = new CDbCriteria;
                $criteria->condition = "blackaccountinfo like '%".$_POST['keyword']."%'";
                $criteria->order ="time desc";
            
                //分页开始
                $total = Blackaccount::model()->count($criteria);
                $pages = new CPagination($total);
                $pages->pageSize=10;//分页大小
                $pages->applyLimit($criteria);
                
                $proreg = Blackaccount::model()->findAll($criteria);
                //分页结束
                
                $this->renderPartial('blackaccount',array(
                    'total'=>$total,
                    'proInfo' => $proreg,
                    'pages' => $pages
                ));
                Yii::app()->end();
            }
            
            //继续封杀
            if(@$_POST['doAction']=="start")
            {
                $blackInfo=Blackaccount::model()->findByPk($_POST['id']);
                $blackInfo->status=1;
                $blackInfo->save();
                Yii::app()->end();
            }
            
            //停止封杀
            if(@$_POST['doAction']=="stop")
            {
                $blackInfo=Blackaccount::model()->findByPk($_POST['id']);
                $blackInfo->status=0;
                $blackInfo->save();
                Yii::app()->end();
            }
            
            $criteria = new CDbCriteria;
            $criteria->order ="time desc";
        
            //分页开始
            $total = Blackaccount::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=10;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Blackaccount::model()->findAll($criteria);
            //分页结束
            
            $this->renderPartial('blackaccount',array(
                'total'=>$total,
                'proInfo' => $proreg,
                'pages' => $pages
            ));
        }
        
        /*
            系统基本参数
        */
        public function actionBaseset()
        {
            //修改系统基本参数
            if(count($_POST)>0)
            {
                if(isset($_POST['webtitle']))//网站标题
                {
                    $webtitle=System::model()->findByAttributes(array("varname"=>"webtitle"));
                    $webtitle->value=$_POST['webtitle'];
                    $webtitle->save();
                }
                
                if(isset($_POST['webkeywords']))//网站关键字
                {
                    $webkeywords=System::model()->findByAttributes(array("varname"=>"webkeywords"));
                    $webkeywords->value=$_POST['webkeywords'];
                    $webkeywords->save();
                }
                
                if(isset($_POST['webdes']))//网站描述
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"webdes"));
                    $webdes->value=$_POST['webdes'];
                    $webdes->save();
                }
                
                if(isset($_POST['registneedToKnow']))//注册协议
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"registneedToKnow"));
                    $webdes->value=$_POST['registneedToKnow'];
                    $webdes->save();
                }
                
                if(isset($_POST['ltMinLi']))//聊天需要麦粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"ltMinLi"));
                    $webdes->value=$_POST['ltMinLi'];
                    $webdes->save();
                }
                
				if(isset($_POST['appendMinLi']))//发布来路搜素任务时附加的麦粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"appendMinLi"));
                    $webdes->value=$_POST['appendMinLi'];
                    $webdes->save();
                }
                
				if(isset($_POST['gaijiaMinLi']))//改价麦粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"gaijiaMinLi"));
                    $webdes->value=$_POST['gaijiaMinLi'];
                    $webdes->save();
                }
				
                if(isset($_POST['gwscMinLi']))//购物收藏需要麦粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"gwscMinLi"));
                    $webdes->value=$_POST['gwscMinLi'];
                    $webdes->save();
                }
                
				 if(isset($_POST['sxtcMoney']))//上线提成金币
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"sxtcMoney"));
                    $webdes->value=$_POST['sxtcMoney'];
                    $webdes->save();
                }
				
                if(isset($_POST['phoneMinLi']))//手机订单需要麦粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"phoneMinLi"));
                    $webdes->value=$_POST['phoneMinLi'];
                    $webdes->save();
                }
                
                if(isset($_POST['wwshMinLi']))//旺旺收货需要麦粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"wwshMinLi"));
                    $webdes->value=$_POST['wwshMinLi'];
                    $webdes->save();
                }
                
                if(isset($_POST['llddMinLi']))//浏览到底需要麦粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"llddMinLi"));
                    $webdes->value=$_POST['llddMinLi'];
                    $webdes->save();
                }
                
                if(isset($_POST['hpMinLi']))//好评截图需要麦粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"hpMinLi"));
                    $webdes->value=$_POST['hpMinLi'];
                    $webdes->save();
                }
                
                if(isset($_POST['tlsjoneMinLi']))//停留时间1分钟需要麦粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"tlsjoneMinLi"));
                    $webdes->value=$_POST['tlsjoneMinLi'];
                    $webdes->save();
                }
                
                if(isset($_POST['tlsjtwoMinLi']))//停留时间2分钟需要麦粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"tlsjtwoMinLi"));
                    $webdes->value=$_POST['tlsjtwoMinLi'];
                    $webdes->save();
                }
                
                if(isset($_POST['tlsjthreeMinLi']))//停留时间3分钟需要麦粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"tlsjthreeMinLi"));
                    $webdes->value=$_POST['tlsjthreeMinLi'];
                    $webdes->save();
                }
                
                if(isset($_POST['hpnrMinLi']))//指定好评内容需要麦粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"hpnrMinLi"));
                    $webdes->value=$_POST['hpnrMinLi'];
                    $webdes->save();
                }
                
                if(isset($_POST['shjsMinLin']))//审核接手需要麦粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"shjsMinLin"));
                    $webdes->value=$_POST['shjsMinLin'];
                    $webdes->save();
                }
                
                if(isset($_POST['smrzMinLi']))//实名认证需要麦粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"smrzMinLi"));
                    $webdes->value=$_POST['smrzMinLi'];
                    $webdes->save();
                }
                
                if(isset($_POST['sbyhMinLi']))//商保用户需要麦粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"sbyhMinLi"));
                    $webdes->value=$_POST['sbyhMinLi'];
                    $webdes->save();
                }
                
                if(isset($_POST['xzjsoneMinLi']))//限制接手一天接1单需要麦粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"xzjsoneMinLi"));
                    $webdes->value=$_POST['xzjsoneMinLi'];
                    $webdes->save();
                }
                
                
                if(isset($_POST['xzjstwoMinLi']))//限制接手一天接2单需要麦粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"xzjstwoMinLi"));
                    $webdes->value=$_POST['xzjstwoMinLi'];
                    $webdes->save();
                }
                
                
                if(isset($_POST['xzjsthreeMinLi']))//限制接手一周接1单需要麦粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"xzjsthreeMinLi"));
                    $webdes->value=$_POST['xzjsthreeMinLi'];
                    $webdes->save();
                }
                
                if(isset($_POST['zddqMinLi']))//指定地区需要麦粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"zddqMinLi"));
                    $webdes->value=$_POST['zddqMinLi'];
                    $webdes->save();
                }
                
                if(isset($_POST['xzdj1MinLi']))//淘宝一心会员，京东注册会员需要米粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"xzdj1MinLi"));
                    $webdes->value=$_POST['xzdj1MinLi'];
                    $webdes->save();
                }
                
                if(isset($_POST['xzdj2MinLi']))//淘宝二心会员，京东铜牌会员需要米粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"xzdj2MinLi"));
                    $webdes->value=$_POST['xzdj2MinLi'];
                    $webdes->save();
                }
                
                if(isset($_POST['xzdj3MinLi']))//淘宝三心会员，京东银牌会员需要米粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"xzdj3MinLi"));
                    $webdes->value=$_POST['xzdj3MinLi'];
                    $webdes->save();
                }
                
                if(isset($_POST['xzdj4MinLi']))//淘宝四心会员，京东金牌会员需要米粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"xzdj4MinLi"));
                    $webdes->value=$_POST['xzdj4MinLi'];
                    $webdes->save();
                }
                
                if(isset($_POST['xzdj5MinLi']))//淘宝五心会员，京东钻石会员需要米粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"xzdj5MinLi"));
                    $webdes->value=$_POST['xzdj5MinLi'];
                    $webdes->save();
                }
                
                if(isset($_POST['xzdj6MinLi']))//淘宝一钻会员需要米粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"xzdj6MinLi"));
                    $webdes->value=$_POST['xzdj6MinLi'];
                    $webdes->save();
                }
                
                if(isset($_POST['xzdj7MinLi']))//淘宝二钻会员需要米粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"xzdj7MinLi"));
                    $webdes->value=$_POST['xzdj7MinLi'];
                    $webdes->save();
                }
                
                if(isset($_POST['xzdj8MinLi']))//淘宝三钻会员需要米粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"xzdj8MinLi"));
                    $webdes->value=$_POST['xzdj8MinLi'];
                    $webdes->save();
                }
                
                if(isset($_POST['xzdj9MinLi']))//淘宝四钻会员需要米粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"xzdj9MinLi"));
                    $webdes->value=$_POST['xzdj9MinLi'];
                    $webdes->save();
                }
                
                
                if(isset($_POST['xzdj10MinLi']))//淘宝五钻会员需要米粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"xzdj10MinLi"));
                    $webdes->value=$_POST['xzdj10MinLi'];
                    $webdes->save();
                }
                
                if(isset($_POST['gljsMinLi']))//过滤接手需要米粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"gljsMinLi"));
                    $webdes->value=$_POST['gljsMinLi'];
                    $webdes->save();
                }
                
                if(isset($_POST['zsqsMinLi']))//真实签收需要米粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"zsqsMinLi"));
                    $webdes->value=$_POST['zsqsMinLi'];
                    $webdes->save();
                }
                
                if(isset($_POST['shdzMinLi']))//真实签收需要米粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"shdzMinLi"));
                    $webdes->value=$_POST['shdzMinLi'];
                    $webdes->save();
                }
                
                if(isset($_POST['buyMinLiPrice']))//购买米粒价格即多少钱一个
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"buyMinLiPrice"));
                    $webdes->value=$_POST['buyMinLiPrice'];
                    $webdes->save();
                }
                
                if(isset($_POST['backMinLiPriceVIP0']))//普通会员回收米粒价格即多少钱一个
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"backMinLiPriceVIP0"));
                    $webdes->value=$_POST['backMinLiPriceVIP0'];
                    $webdes->save();
                }
                
                if(isset($_POST['backMinLiPriceVIP1']))//VIP1回收米粒价格即多少钱一个
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"backMinLiPriceVIP1"));
                    $webdes->value=$_POST['backMinLiPriceVIP1'];
                    $webdes->save();
                }
                
                if(isset($_POST['backMinLiPriceVIP2']))//VIP2回收米粒价格即多少钱一个
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"backMinLiPriceVIP2"));
                    $webdes->value=$_POST['backMinLiPriceVIP2'];
                    $webdes->save();
                }
                
                if(isset($_POST['backMinLiPriceVIP3']))//VIP3回收米粒价格即多少钱一个
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"backMinLiPriceVIP3"));
                    $webdes->value=$_POST['backMinLiPriceVIP3'];
                    $webdes->save();
                }
                
                
                if(isset($_POST['VIP1price1month']))//VIP1会员1个月会费价格
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"VIP1price1month"));
                    $webdes->value=$_POST['VIP1price1month'];
                    $webdes->save();
                }
                
                if(isset($_POST['VIP1price3month']))//VIP1会员3个月会费价格
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"VIP1price3month"));
                    $webdes->value=$_POST['VIP1price3month'];
                    $webdes->save();
                }
                
                if(isset($_POST['VIP1price6month']))//VIP1会员6个月会费价格
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"VIP1price6month"));
                    $webdes->value=$_POST['VIP1price6month'];
                    $webdes->save();
                }
                
                if(isset($_POST['VIP1price12month']))//VIP1会员12个月会费价格
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"VIP1price12month"));
                    $webdes->value=$_POST['VIP1price12month'];
                    $webdes->save();
                }
                
                
                if(isset($_POST['VIP2price1month']))//VIP12会员1个月会费价格
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"VIP2price1month"));
                    $webdes->value=$_POST['VIP2price1month'];
                    $webdes->save();
                }
                
                if(isset($_POST['VIP2price3month']))//VIP2会员3个月会费价格
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"VIP2price3month"));
                    $webdes->value=$_POST['VIP2price3month'];
                    $webdes->save();
                }
                
                if(isset($_POST['VIP2price6month']))//VIP2会员6个月会费价格
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"VIP2price6month"));
                    $webdes->value=$_POST['VIP2price6month'];
                    $webdes->save();
                }
                
                if(isset($_POST['VIP2price12month']))//VIP2会员12个月会费价格
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"VIP2price12month"));
                    $webdes->value=$_POST['VIP2price12month'];
                    $webdes->save();
                }
                
                if(isset($_POST['VIP3price1month']))//VIP3会员1个月会费价格
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"VIP3price1month"));
                    $webdes->value=$_POST['VIP3price1month'];
                    $webdes->save();
                }
                
                if(isset($_POST['VIP3price3month']))//VIP3会员3个月会费价格
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"VIP3price3month"));
                    $webdes->value=$_POST['VIP3price3month'];
                    $webdes->save();
                }
                
                if(isset($_POST['VIP3price6month']))//VIP3会员6个月会费价格
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"VIP3price6month"));
                    $webdes->value=$_POST['VIP3price6month'];
                    $webdes->save();
                }
                
                if(isset($_POST['VIP3price12month']))//VIP3会员12个月会费价格
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"VIP3price12month"));
                    $webdes->value=$_POST['VIP3price12month'];
                    $webdes->save();
                }
                
                if(isset($_POST['taskMinliToPlatform']))//普通会员完成任务消耗米粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"taskMinliToPlatform"));
                    $webdes->value=$_POST['taskMinliToPlatform'];
                    $webdes->save();
                }
                
                if(isset($_POST['taskMinliToPlatformVIP1']))//VIP1会员完成任务消耗米粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"taskMinliToPlatformVIP1"));
                    $webdes->value=$_POST['taskMinliToPlatformVIP1'];
                    $webdes->save();
                }
                
                if(isset($_POST['taskMinliToPlatformVIP2']))//VIP2会员完成任务消耗米粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"taskMinliToPlatformVIP2"));
                    $webdes->value=$_POST['taskMinliToPlatformVIP2'];
                    $webdes->save();
                }
                
                if(isset($_POST['taskMinliToPlatformVIP3']))//VIP3会员完成任务消耗米粒
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"taskMinliToPlatformVIP3"));
                    $webdes->value=$_POST['taskMinliToPlatformVIP3'];
                    $webdes->save();
                }
                
                if(isset($_POST['spreadPrice']))//推广返现金额
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"spreadPrice"));
                    $webdes->value=$_POST['spreadPrice'];
                    $webdes->save();
                }
                
                if(isset($_POST['copyright']))// 网站底部版权说明
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"copyright"));
                    $webdes->value=$_POST['copyright'];
                    $webdes->save();
                }
                
                if(isset($_POST['reglock']))// 新注册会员是否为冻结锁定状态
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"reglock"));
                    $webdes->value=$_POST['reglock'];
                    $webdes->save();
                }
                
                if(isset($_POST['authperson']))// 是否要求威客绑定买号前实名认证
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"authperson"));
                    $webdes->value=$_POST['authperson'];
                    $webdes->save();
                }
                
                if(isset($_POST['lgoods1']))// （浏览店里其他1件商品）
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"lgoods1"));
                    $webdes->value=$_POST['lgoods1'];
                    $webdes->save();
                }
                
                if(isset($_POST['lgoods2']))// （浏览店里其他2件商品）
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"lgoods2"));
                    $webdes->value=$_POST['lgoods2'];
                    $webdes->save();
                }
                
                if(isset($_POST['contrast1']))// （货比1家）
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"contrast1"));
                    $webdes->value=$_POST['contrast1'];
                    $webdes->save();
                }
                
                if(isset($_POST['contrast2']))// （货比2家）
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"contrast2"));
                    $webdes->value=$_POST['contrast2'];
                    $webdes->save();
                }
                
                if(isset($_POST['contrast3']))// （货比3家）
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"contrast3"));
                    $webdes->value=$_POST['contrast3'];
                    $webdes->save();
                }
				
				if(isset($_POST['taskUpMoney']))// 发布任务时需要验证短信的限额
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"taskUpMoney"));
                    $webdes->value=$_POST['taskUpMoney'];
                    $webdes->save();
                }
				
				if(isset($_POST['taskUpSmsMoney']))// 发布任务时的短信费用
                {
                    $webdes=System::model()->findByAttributes(array("varname"=>"taskUpSmsMoney"));
                    $webdes->value=$_POST['taskUpSmsMoney'];
                    $webdes->save();
                }
                
            }
            $this->renderPartial("baseset");
        }
    }
?>