<?php
    class BaseLayoutController extends Aclfilter
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
      /*  
        	声明所有基于类的动作。
	 */
     
        //后台公共顶部
    	public function actionHeader()
        {
            $this->renderPartial('header');
        }
        
        //后台公共左侧菜单
    	public function actionMainmenu()
        {
            $this->renderPartial('mainmenu');
        }
    }
?>