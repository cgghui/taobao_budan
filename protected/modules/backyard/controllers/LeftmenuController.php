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
    				array('allow', // ������֤�û��������ж���
    					'users'=>array('@'),
    				),
    				array('deny',  // �ܾ����е��û���
    					'users'=>array('*'),
    				),
    			);
        }
      /*  
        	�������л�����Ķ�����
	 */
    	public function actionMenu()
        {
            $this->renderPartial('menu');
        }
    }
?>