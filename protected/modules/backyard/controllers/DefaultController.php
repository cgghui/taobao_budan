<?php

class DefaultController extends Aclfilter
{
    
    public function filters()
    {
        return array(
            'accessControl',
        );
    }
    
    public function accessRules()
    {
        return array(
				array('allow', // 允许认证用户访问所有动作
					'users'=>array('@'),
				),
                array('deny',  // 拒绝所有的用户。
					'users'=>array('*'),
				),
			);
    }
    
    /*后台首页*/
    public function actionIndex()
    {
        $this->renderPartial('index');
    }
    
    //报错页面
    public function actionError()
    {
        $this->renderPartial('error');
    }
    
    
    //用户退出
    public function actionLoginout(){
        Yii::app()->user->logout(false); //当前应用用户退出
        $this->redirect(array('user/login'));
    }
    
}