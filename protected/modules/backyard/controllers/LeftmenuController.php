<?php
    class LeftmenuController extends Aclfilter
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
    	public function actionMenu()
        {
            $this->renderPartial('menu');
        }
    }
?>