<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class SiteUserIdentity extends CUserIdentity
{
	/**
	 * Authenticates a user.
	 * The example implementation makes sure if the username and password
	 * are both 'demo'.
	 * In practical applications, this should be changed to authenticate
	 * against some persistent user identity storage (e.g. database).
	 * @return boolean whether authentication succeeds.
	 */
    private $_id;
	public function authenticate()//把接收的用户名名与密码同数据库进行对比
	{
		/*$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);*/
        //进行数据库用户名与密码的真实性校验
        //find()方法没有查询出来会返回null
       
        
        $userModel=User::model()->find('Username=:name',array(':name'=>$this->username));
        if($userModel===null)//判断查询结果
        {
            //echo "用户名不正确";
            $this->errorCode=self::ERROR_USERNAME_INVALID;
            return false;
        }
        else if($userModel->PassWord!==$this->password)//判断查询出来结果集中的pwd是否与传递过来的密码一致
        {
            //echo "密码不正确";
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
            return false;
        }
        else
        {
            $this->errorCode=self::ERROR_NONE;
            $this->_id=$userModel->id;//对$_id进行赋值
            foreach($userModel->attributes as $key=>$value)//对当前登录用户的信息进行存储
            {
                Yii::app()->session[$key]=$value;
            }
            return true;
        }
        
        
	}
    
    public function getId()//重载getId方法，因为getId方法在Yii中默认调用的是用户名而不是用户id所以需要重载一下
    {
        return $this->_id;
    }
    
    
}