<?php

class BackyardModule extends CWebModule
{
	public function init()
	{
		// this method is called when the module is being created
		// you may place code here to customize the module or the application

		// import the module-level models and components
		$this->setImport(array(
			'backyard.models.*',
			'backyard.components.*',
		));
        
        
        /*重写组件开始*/
        Yii::app()->setComponents(array(
               'errorHandler'=>array(
                       'class'=>'CErrorHandler',
                       'errorAction'=>'backyard/default/error',//报错显示的页面
               ),
               'user'=>array(
                       'stateKeyPrefix'=>'backyardMan',//后台session前缀
                       'loginUrl'=>'/',//在没有登录情况下访问后台则跳转到网站首页
               ),
               
       ), true);
       /*重写组件结束*/
	}

	public function beforeControllerAction($controller, $action)
	{
		if(parent::beforeControllerAction($controller, $action))
		{
			// this method is called before any module controller action is performed
			// you may place customized code here
			return true;
		}
		else
			return false;
	}
}
