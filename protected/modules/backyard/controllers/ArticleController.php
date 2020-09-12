<?php

class ArticleController extends Aclfilter
{
    public $layout='//layouts/backyard';//定义布局以便加载kindeditor文本编辑器的css与js
    
    /*
        商品分类
    */
    public function actionArticlecatalog()
    {
        parent::acl();
        $class_arr=array();
        $criteria = new CDbCriteria;//实例化
        $criteria->order="sort asc,id asc";
        $catModel=Articlecatlog::model()->findAll($criteria);
        for($i=0;$i<count($catModel);$i++)
        {
            $class_arr[] =array($catModel[$i]['id'],$catModel[$i]['name'],$catModel[$i]['classid'],$catModel[$i]['sort'],$catModel[$i]['type']);
        }
        //$adminModel=Admin::model();//实例化以便调用模型中的方法
        /*echo '<div class="CataLog" id="theCataTop">
            	<div class="CataLeft" style="background:none;"><span>文档分类名称</span>　<a href="'.$this->createUrl('article/articleCatlogAdd').'" style="color:#666;">[添加文档顶级分类]</a>　<a href="'.$this->createUrl('article/articleCatlogAddMore').'" style="color:#666;">[批量添加文档顶级分类]</a></div>
                <div class="CataOperation">操作</div>
             </div>';
        $this->CatlogTree_arr(0,0,$class_arr);*/
        $this->renderPartial('articlecatalog',array(
            'class_arr'=>$class_arr,
        ));
    }
    
    /*
        用于栏目分类查询无限分类方法开始
    */
    public function CatlogTree_arr($m,$id,$class_arr)
    {
    	$class_arr=$class_arr;
		if($id=="") $id=0;
		$n = str_pad('',$m,'-',STR_PAD_RIGHT);
		$n = str_replace("-","&nbsp;&nbsp;&nbsp;",$n);
        $h="-";
		for($i=0;$i<count($class_arr);$i++){
			if($class_arr[$i][2]==$id){
                if($class_arr[$i][2]==0){
                    echo '<div class="CataLog CataTop" id="CataTop" style="background:#dbe3ff; border-radius:5px; font-weight:normal;">
                        	<div class="CataLeft" style="background:#dbe3ff; color:#000;">　'.$n.'<a class="topMenu" id="topMenuTrue" alt="'.$class_arr[$i][0].'" style="cursor:pointer;"><img src="'.IMG_URL.'plus.gif"></a><span><a href="'.$this->createUrl('article/articleList',array('Cataid'=>$class_arr[$i][0],"type"=>$class_arr[$i][4])).'" style="color:#000;text-decoration:none">'.$class_arr[$i][1].'</a></span>　[ID:<font>'.$class_arr[$i][0].'</font>]</div>
                            <div class="Catacenter1" style="background:#dbe3ff"><a style="color:#000; cursor:pointer;" class="AddSonType">添加子类</a></div>
                            <div class="Catacenter" style="background:#dbe3ff"><a style="color:#000; cursor:pointer;" class="ChangeInfo"><i class="fa fa-edit"></i></a></div>
                            <div class="CataRight" return true;else return false;" style="background:#dbe3ff"><a class="cataLogDel" href="'.$this->createUrl('article/articleCatlogDel',array('delid'=>$class_arr[$i][0])).'" style="color:#585b66" ><i class="fa fa-times"></i></a></div>
                          </div>';
                    $this->CatlogTree_arr($m+1,$class_arr[$i][0],$class_arr);//调用函数自身
			     }
                 else//如果不是顶级栏目则加|--标记
                 {
                    echo '<div class="CataLog '.$class_arr[$i][2].'" style=" border-radius:5px; font-weight:normal; display:none;">
                        	<div class="CataLeft" style="color:#5B5E5E">　'.$n.'<a class="topMenu" alt="'.$class_arr[$i][0].'" style="cursor:pointer;"><img src="'.IMG_URL.'plus.gif"></a><span><a href="'.$this->createUrl('article/articleList',array('Cataid'=>$class_arr[$i][0],"type"=>$class_arr[$i][4])).'" style="color:#5B5E5E;text-decoration:none">'.$class_arr[$i][1].'</a></span>　[ID:<font>'.$class_arr[$i][0].'</font>]</div>
                            <div class="Catacenter1"><a style="color:#5B5E5E; cursor:pointer;" class="AddSonType">添加子类</a></div>
                            <div class="Catacenter"><a style="color:#5B5E5E; cursor:pointer" class="ChangeInfo"><i class="fa fa-edit"></i></a></div>
                            <div class="CataRight"><a class="cataLogDel" href="'.$this->createUrl('article/articleCatlogDel',array('delid'=>$class_arr[$i][0])).'" style="color:#5B5E5E" ><i class="fa fa-times"></i></a></div>
                          </div>';
                    $this->CatlogTree_arr($m+1,$class_arr[$i][0],$class_arr);//调用函数自身
                }
            }
		}
    	
    }
    /*
        用于栏目分类查询无限级分类方法结束
    */
    
    
    /*
        用于文档查询无限分类方法开始
    */
    public function Arc_CatlogTree_arr($m,$id,$class_arr)
    {
        //var_dump($class_arr);exit;
    	$class_arr=$class_arr;
		if($id=="") $id=0;
		$n = str_pad('',$m,'-',STR_PAD_RIGHT);
		$n = str_replace("-","&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$n);
		for($i=0;$i<count($class_arr);$i++){
			if($class_arr[$i][2]==$id){
                if($class_arr[$i][2]==0){
                    echo '<option value="'.$class_arr[$i][0].'">　'.$n.$class_arr[$i][1].'</option>';
                    //echo $n.$class_arr[$i][1];
                    $this->Arc_CatlogTree_arr($m+1,$class_arr[$i][0],$class_arr);//调用函数自身
			     }
                 else
                 {
                    echo '<option value="'.$class_arr[$i][0].'">　'.$n.'|--'.$class_arr[$i][1].'</option>';
                    // echo $class_arr[$i][1];
                    $this->Arc_CatlogTree_arr($m+1,$class_arr[$i][0],$class_arr);//调用函数自身
                }
            }
		}	
    	
    }
    /*
        用于文档查询无限级分类方法结束
    */
    
    
    /*
        添加文档顶级分类
    */
    public function actionArticleCatlogAdd()
    {
        parent::acl();
        if(count($_POST)<>0)
        {
            $cataModel=new Articlecatlog();
            $cataModel->name=trim($_POST['name']);
            $cataModel->classid=0;
            $cataModel->type=$_POST['type'];
            if($cataModel->save())
            {
                $this->redirect($this->createUrl('article/articlecatalog'));
                //$this->redirect_message("分类添加成功","success",3,$this->createUrl('article/articlecatalog'));//成功后进行跳转
            }
            else
            {
                $this->redirect_message("分类添加失败","fail",3,$this->createUrl('article/articlecatalog'));//失败后进行跳转
            }
        }
        $this->renderPartial('articleCatlogAdd');
    }
    /*
        添加文档顶级分类结束
    */
    
    /*
        批量添加文档顶级分类开始
    */
    public function actionArticleCatlogAddMore()
    {
        parent::acl();
        if(count($_POST)<>0)
        {
            $cataNameStr=str_replace("，",",",trim($_POST['name']));
            $cataNameArr=explode(",",$cataNameStr);
            for($i=0;$i<count($cataNameArr);$i++)
            {
                $cataMode=new Articlecatlog();
                $cataMode->name=$cataNameArr[$i];
                $cataMode->classid=0;
                $cataAddStaue=$cataMode->save();
            }
            if($cataAddStaue)
            {
                $this->redirect($this->createUrl('article/articlecatalog'));
                //$this->redirect_message("栏目批量添加成功","success",3,$this->createUrl('article/articlecatalog'));
            }
            else
                $this->redirect_message("栏目批量添加失败","fail",3,$this->createUrl('article/articlecatalog'));
        }
        $this->renderPartial('articleCatlogAddMore');
    }
    
    /*
        文档顶级分类删除
    */
    public function actionArticleCatlogDel()
    {
        parent::acl();
        if(isset($_GET['delid']))
        {
            $cataModel=Articlecatlog::model();//实例化
            $cataDelInfo=$cataModel->findByPk($_GET['delid']);
            $articleInfo=Article::model()->deleteAll('cat_id='.$_GET['delid']);//删除当前栏目的文档
            if($cataDelInfo->delete())//删除自身成功后执行删除子类
            {
                /*删除子栏目开始*/
                $class_arr=array();
                $cataAll=$cataModel->findAll();
                for($i=0;$i<count($cataAll);$i++)
                {
                    $class_arr[] =array($cataAll[$i]['id'],$cataAll[$i]['name'],$cataAll[$i]['classid'],$cataAll[$i]['sort']);
                }
                $this->CatlogTree_arrDelSon(0,$_GET['delid'],$class_arr);//调用删除子栏目方法
                /*删除子栏目结束*/
                $this->redirect($this->createUrl('article/articlecatalog'));
                //$this->redirect_message("分类删除成功","success",3,$this->createUrl('article/articlecatalog'));//成功后进行跳转
            }
            else
            {
                $this->redirect($this->createUrl('article/articlecatalog'));
                //$this->redirect_message("分类删除成功","fail",3,$this->createUrl('article/articlecatalog'));//成功后进行跳转
            }
        }
        else
        {
            $this->redirect_message("参数出错","fail",3,$this->createUrl('article/articlecatalog'));//成功后进行跳转
        }
    }
    
    /*
        	删除无限级分类辅助方法开始
    */
    public function CatlogTree_arrDelSon($m,$id,$class_arr)
	{
	    //$goodsObj=M('Shopgoods');
        $articleCatlogDelObj=Articlecatlog::model();
	    $class_arr=$class_arr;
		if($id=="") $id=0;
		$n = str_pad('',$m,'-',STR_PAD_RIGHT);
		$n = str_replace("-","&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;",$n);
        $h="|";
		for($i=0;$i<count($class_arr);$i++){
			if($class_arr[$i][2]==$id){
	            $cataLogInfo=$articleCatlogDelObj->findByPk($class_arr[$i][0])->delete();
                $articleInfo=Article::model()->deleteAll('cat_id='.$class_arr[$i][0]);
                $this->CatlogTree_arrDelSon($m+1,$class_arr[$i][0],$class_arr);//调用函数自身
            }
		}
	} 
    /*
        删除无限级分类辅助方法结束
    */
    
    /*
        修改分类名称开始
    */
    public function actionArticleCatlogChangeInfo()
    {
        parent::acl();
        if(count($_POST)<>0)
        {
            $cataModel=Articlecatlog::model()->findByPk($_POST['id']);
            $cataModel->name=trim($_POST['name']);
            if($cataModel->save())
            {
                $this->redirect($this->createUrl('article/articlecatalog'));
                //$this->redirect_message("栏目名称修改成功","success",3,$this->createUrl('article/articlecatalog'));
            }
            Yii::app()->end();
        }
        else
            $this->redirect_message("参数出错","success",3,$this->createUrl('article/articlecatalog'));
    }
    /*
        修改分类名称结束
    */
    
    /*
        添加子分类开始
    */
    public function actionArticleCatlogAddSonType()
    {
        parent::acl();
        if(count($_POST)<>0)
        {
            $cataModel=new Articlecatlog();
            $cataModel->classid=$_POST['id'];
            $cataModel->name=trim($_POST['name']);
            $cataModel->type=$_POST['type'];
            if($cataModel->save())
            {
                $this->redirect($this->createUrl('article/articlecatalog'));
                //$this->redirect_message("子栏目添加成功","success",3,$this->createUrl('article/articlecatalog'));
            }
            else    
                $this->redirect_message("子栏目添加失败","fail",3,$this->createUrl('article/articlecatalog'));
        }
    }
    /*
        添加子分类结束
    */
    
    /*
        添加商品开始
    */
    public function actionArticleAdd()
    {
        parent::acl();
        $goodsModel=new Article();
        
        if(count($_POST)<>0)
        {
            foreach($_POST['Article'] as $key=>$value)
            {
                $goodsModel->$key=$value;
            }
            $goodsModel->add_time=strtotime($_POST['Article']['add_time']);
            if($goodsModel->save())
            {  
                $this->redirect($this->createUrl('article/articlecatalog'));
                //$this->redirect_message("文章添加成功","success",3,$this->createUrl('article/articlecatalog'));
                Yii::app()->end();
            }
        }
        
        foreach($goodsModel->attributes as $key=>$value)
        {
            $goodsModel->$key="";
        }
        
        /*
            	获取无限分类开始 
        */       
        $class_arr=array();
        $criteria = new CDbCriteria;
        $criteria->order="sort asc,id asc";
        $catModel=Articlecatlog::model()->findAll($criteria);
        for($i=0;$i<count($catModel);$i++)
        {
            $class_arr[] =array($catModel[$i]['id'],$catModel[$i]['name'],$catModel[$i]['classid'],$catModel[$i]['sort']);
        }
        /*
          	  获取无限分类结束
        */
        
        if(isset($_GET['cataid']))//如果是添加某个栏目的分类
        {
            $getCataModel=Articlecatlog::model()->findByPk($_GET['cataid']);
            $optionStr='<option value='.$getCataModel->id.'>　'.$getCataModel->name.'</option>';
            $this->render('articleAdd',array(
                'model'=>$goodsModel,
                'class_arr'=>$class_arr,
                'cataName'=>$getCataModel->name,
                'optionStr'=>$optionStr,
            ));
            Yii::app()->end();
        }
        
        $this->render('articleAdd',array(
            'model'=>$goodsModel,
            'class_arr'=>$class_arr,
        ));
    }   
    /*
        添加商品结束
    *
    

    /*
        全部商品列表开始
    */
    public function actionArticleList()
    {
        parent::acl();
        if(isset($_GET['Cataid']) && isset($_GET['type']))
        {
            if($_GET['type']==1)//如果该栏目类型为列表
            {
                $criteria = new CDbCriteria;
                $criteria->order ="sort_order asc,goods_id desc";
                $criteria->addCondition('cat_id='.$_GET['Cataid'].' and is_delete=0');//查询没有放入回首点的商品
    
                //分页开始
                $total = Article::model()->count($criteria);
                $pages = new CPagination($total);
                $pages->pageSize=10;//分页大小
                $pages->applyLimit($criteria);
                
                $proreg = Article::model()->findAll($criteria);
                //分页结束
                
                $this->renderPartial('articleList',array(
                    'proInfo' => $proreg,
                    'pages' => $pages,
                ));
            }
            else//如果该栏目类型为单页
            {
                $this->redirect(array('article/articleDyEdit',"Cataid"=>$_GET['Cataid'],"type"=>$_GET['type']));
            }
        }
        else
        {
            $criteria = new CDbCriteria;
            $criteria->order ="sort_order asc,goods_id desc";
            $criteria->addCondition('is_delete=0');//查询没有放入回首点的商品

            //分页开始
            $total = Article::model()->count($criteria);
            $pages = new CPagination($total);
            $pages->pageSize=10;//分页大小
            $pages->applyLimit($criteria);
            
            $proreg = Article::model()->findAll($criteria);//查询销售填写记录
            //分页结束
            
            $this->renderPartial('articleList',array(
                'proInfo' => $proreg,
                'pages' => $pages,
                'allGoods'=>"yes",
            ));
        }
    }
    /*
        全部商品列表结束
    */
    
    
    /*
        修改商品信息开始
    */
    public function actionArticleEdit()
    {
        parent::acl();
        if(count($_POST))
        {
            $model=Article::model()->findByPk($_POST['Article']['goods_id']);//收集数据信息
            foreach($_POST['Article'] as $key=>$value)
            {
                $model->$key=$value;
            }
            $model->add_time=strtotime($_POST['Article']['add_time']);
            if($model->save())
            {
                $this->redirect($this->createUrl('article/articleList',array("Cataid"=>$_POST['Article']['cat_id'],'type'=>1)));
                //$this->redirect_message("文章信息修改成功","success",3,$this->createUrl('article/articleList',array("Cataid"=>$_POST['Article']['cat_id'],'type'=>1)));
            }
            else
                $this->redirect_message("文章信息修改失败","fail",3,'');
        }
        
        if(isset($_GET['goods_id']))
        {
            $goodsModel=Article::model()->findByPk($_GET['goods_id']);
            $imgListArr=explode("|",$goodsModel->goods_thumb);//商品多图
            array_pop($imgListArr);//去掉最后一个空值
            
            /*
                获取无限分类开始 
            */       
            $class_arr=array();
            $criteria = new CDbCriteria;//
            $criteria->order="sort asc,id asc";
            $catModel=Articlecatlog::model()->findAll($criteria);
            for($i=0;$i<count($catModel);$i++)
            {
                $class_arr[] =array($catModel[$i]['id'],$catModel[$i]['name'],$catModel[$i]['classid'],$catModel[$i]['sort']);
            }
            /*
                获取无限分类结束
            */
            $getCataModel=Articlecatlog::model()->findByPk($_GET['cataid']);
            $optionStr='<option value='.$getCataModel->id.'>　'.$getCataModel->name.'</option>';
            $this->render('articleEdit',array(
                'model'=>$goodsModel,
                'class_arr'=>$class_arr,
                'cataName'=>$getCataModel->name,
                'optionStr'=>$optionStr,
                'imgListArr'=>$imgListArr,
            ));
            
            Yii::app()->end();
        }
        else
        {
            $this->redirect_message("参数出错","fail",3,$this->createUrl('default/index'));
        }
    }
    /*
        修改商品信息结束
    */
    
    /*
        修改单页内容添加开始
    */
    public function actionArticleDyAdd()
    {
        parent::acl();
        $goodsModel=new Article();
        
        if(count($_POST)<>0)//处理提交表单
        {
            foreach($_POST['Article'] as $key=>$value)
            { 
                $goodsModel->$key=$value;
            }
            if($goodsModel->save())
            {
                $this->redirect($this->createUrl('article/articlecatalog'));
                //$this->redirect_message("单页添加成功","success",3,$this->createUrl('article/articlecatalog'));
                Yii::app()->end();
            }
        }
        
        foreach($goodsModel->attributes as $key=>$value)
        {
            $goodsModel->$key="";
        }
        
        /*
            获取无限分类开始 
        */       
        $class_arr=array();
        $criteria = new CDbCriteria;//
        $criteria->order="sort asc,id asc";
        $catModel=Articlecatlog::model()->findAll($criteria);
        for($i=0;$i<count($catModel);$i++)
        {
            $class_arr[] =array($catModel[$i]['id'],$catModel[$i]['name'],$catModel[$i]['classid'],$catModel[$i]['sort']);
        }
        /*
            获取无限分类结束
        */
        
        if(isset($_GET['cataid']))//如果是添加某个栏目的分类
        {
            $getCataModel=Articlecatlog::model()->findByPk($_GET['cataid']);
            $optionStr='<option value='.$getCataModel->id.'>　'.$getCataModel->name.'</option>';
            $this->render('articleDyAdd',array(
                'model'=>$goodsModel,
                'class_arr'=>$class_arr,
                'cataName'=>$getCataModel->name,
                'optionStr'=>$optionStr,
            ));
            Yii::app()->end();
        }
        
        $this->render('articleAdd',array(
            'model'=>$goodsModel,
            'class_arr'=>$class_arr,
        ));
    }
    /*
        修改单页内容开始
    */
    public function actionArticleDyEdit()
    {
        parent::acl();
        if(count($_POST)<>0)
        {
            $articleDyModel=Article::model();//修改时使用这种实例化
            foreach($_POST['Article'] as $key=>$value)
            { 
                $articleDyModel->$key=$value;
            }
            if($articleDyModel->save())
            {
                $this->redirect($this->createUrl('article/articleCatalog'));
                //$this->redirect_message("单页修改成功",'success',3,$this->createUrl('article/articleCatalog'));
            }
        }
        else
        {
            if(isset($_GET['Cataid']) && isset($_GET['type']))
            {   
                
                $goodsModel=Article::model()->find("cat_id=:cat_id",array(":cat_id"=>$_GET['Cataid']));
                
                if(count($goodsModel)!=1)//如果没有内容则跳转到添加页面
                {
                    $this->redirect(array('article/articleDyAdd',"cataid"=>$_GET['Cataid']));
                }
    
                $imgListArr=explode("|",$goodsModel->goods_thumb);//商品多图
                array_pop($imgListArr);//去掉最后一个空值
                
                /*
                    获取无限分类开始 
                */       
                $class_arr=array();
                $criteria = new CDbCriteria;//
                $criteria->addCondition("type=0");
                $criteria->order="sort asc,id asc";
                $catModel=Articlecatlog::model()->findAll($criteria);
                for($i=0;$i<count($catModel);$i++)
                {
                    $class_arr[] =array($catModel[$i]['id'],$catModel[$i]['name'],$catModel[$i]['classid'],$catModel[$i]['sort']);
                }
                /*
                    获取无限分类结束
                */
                $getCataModel=Articlecatlog::model()->findByPk($_GET['Cataid']);
                $optionStr='<option value='.$getCataModel->id.'>　'.$getCataModel->name.'</option>';
                $this->render('articleDyEdit',array(
                    'model'=>$goodsModel,
                    'class_arr'=>$class_arr,
                    'cataName'=>$getCataModel->name,
                    'optionStr'=>$optionStr,
                    'imgListArr'=>$imgListArr,
                ));
                
                Yii::app()->end();
            }
            else
            {
                $this->redirect_message("参数出错","fail",3,'');
            }
        }
    }
    /*
        修改单页内容结束
    */
    
    /*
        商品回收站开始
    */
    public function actionArticleReserver()
    {
        parent::acl();
        if(isset($_GET['delid']))
        {
            $model=Article::model()->findByPk($_GET['delid']);
            $model->is_delete=1;
            if($model->save())
            {
                $this->redirect($this->createUrl('article/articleList',array('Cataid'=>$_GET['cataid'],'type'=>'1')));
                //$this->redirect_message("文档已经存放到回收站中","success",3,$this->createUrl('article/articleList',array('Cataid'=>$_GET['cataid'],'type'=>'1')));
                Yii::app()->end();
            }
        }
    }
    /*
        商品回收站结束
    */
    
    /*
        商品回收站列表开始
    */
    public function actionArticleReserverList()
    {
        parent::acl();
        $criteria = new CDbCriteria;
        $criteria->order ="sort_order asc,goods_id desc";
        $criteria->addCondition('is_delete=1');//查询放入回首点的商品

        //分页开始
        $total = Article::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Article::model()->findAll($criteria);//查询销售填写记录
        //分页结束
        
        $this->renderPartial('articleReserverList',array(
            'proInfo' => $proreg,
            'pages' => $pages,
        ));
    }
    /*
        商品回收站列表结束
    */
    
    /*
        回收站中删除商品即彻底删除商品开始
    */
    public function actionArticleReserverDel()
    {
        parent::acl();
        if(isset($_GET['delid']))
        {
            $model=Article::model()->findByPk($_GET['delid']);
            if($model->delete())
            {
                $this->redirect($this->createUrl("article/articleReserverList"));
                //$this->redirect_message("商品删除成功","success",3,$this->createUrl('article/articleReserverList'));
            }
        }
        else
        {
            $this->redirect_message("参数出错","fail",3,$this->createUrl('article/articleReserverList'));
        }
    }
    /*
        回收站中删除商品即彻底删除商品结束
    */
    
    /*
        商品还原开始
    */
    public function actionArticleDelBack()
    {
        parent::acl();
        if(isset($_GET['goods_id']))
        {
            $model=Article::model()->findByPk($_GET['goods_id']);
            $model->is_delete=0;
            if($model->save())
            {
                $this->redirect($this->createUrl("article/articleReserverList"));
                //$this->redirect_message("文档还原成功","success",3,$this->createUrl("article/articleReserverList"));
            }
        }
        else
            $this->redirect_message("参数出错","fail",3,$this->createUrl('article/articleReserverList'));
    }
    /*
        商品还原结束
    */
}