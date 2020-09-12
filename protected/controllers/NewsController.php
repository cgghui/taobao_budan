<?php

class NewsController extends Controller
{
    /*
        文章列表页
    */
    public function actionList()
    {
        $criteria = new CDbCriteria;
        $criteria->condition='cat_id='.$_GET['catlogid'].' and is_delete=0';
        $criteria->select='add_time,goods_id,goods_name,cat_id';
        $criteria->order ="add_time desc";
    
        //分页开始
        $total =Article::model()->count($criteria);
        $pages = new CPagination($total);
        $pages->pageSize=10;//分页大小
        $pages->applyLimit($criteria);
        
        $proreg = Article::model()->findAll($criteria);
        //分页结束
        
        $this->render('list',array(
            'proInfo' => $proreg,
            'pages' => $pages
        ));
    }
    
    /*文档详细页*/
    public function actionDeatailInfo()
    {
        if(isset($_GET['catlogid']) && $_GET['catlogid']!="" && isset($_GET['id']) && $_GET['id']!="")
        {
            $articleInfo=Article::model()->findByAttributes(array("goods_id"=>$_GET['id']));
            if($articleInfo)
            {
                $arcType=Articlecatlog::model()->findByPk($articleInfo->cat_id);
                $this->render('deatailInfo',array(
                    'articleInfo'=>$articleInfo,
                    'typename'=>$arcType->name,
                ));
            }
            else
            {
                $this->redirect_message('参数不正确','success',3,$this->createUrl('site/index'));
            }
        }
    }
}