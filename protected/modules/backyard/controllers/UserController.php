<?php
    class UserController extends Controller{
          /*  
            	声明所有基于类的动作。
    	 */
    	public function actions()
    	{
    		return array(  
               'captcha'=> array(  
                       'class'=>'CCaptchaAction',
                       'width'=>80,    //默认120
                       'height'=>35,    //默认50
                       'padding'=>2,    //文字周边填充大小
                       'backColor'=>0xFFFFFF,      //背景颜色
                       'foreColor'=>0x2040A0,     //字体颜色
                       'minLength'=>2,      //设置最短为6位
                       'maxLength'=>3,       //设置最长为7位,生成的code在6-7直接rand了
                       'transparent'=>true,      //显示为透明,默认中可以看到为false
                       'offset'=>-2,        //设置字符偏移量
           ));  
    	}
        
        
        //用户登录
        public function actionLogin(){
            if(Yii::app()->user->getId())//判断如果用户已经登录
            {
                $this->redirect_message("您已登录","success",2,$this->createUrl('default/index'));
                //$this->redirect(array('default/index'));//跳转到后台的首页
                Yii::app()->end();
            }
            
            $userLogin=new LoginForm;//实例化表单模型
            
            if(isset($_POST['LoginForm']))
            {
                //收集表单信息
                $userLogin->attributes=$_POST['LoginForm'];
                
                //1.$userLogin->validate()用户于校验数据
                //2.$userLogin->login()用于判断用户登录，并且进行session存储持久化用户信息全用$userLogin->login()
                if($userLogin->validate() && $userLogin->login())
                {
                    //$this->redirect_message("登录成功","success",2,$this->createUrl('default/index'));
                    $this->redirect(array('default/index'));//成功后进行跳转
                    //Yii::app()->end();
                }
            }
            $this->renderPartial('login',array(
                'userLoginObj'=>$userLogin
            ));
        }
    }
?>