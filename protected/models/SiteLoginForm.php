<?php

/**
 * LoginForm class.
 * LoginForm is the data structure for keeping
 * user login form data. It is used by the 'login' action of 'SiteController'.
 */
class SiteLoginForm extends CFormModel
{
	public $username;//用户名
	public $password;//密码
	public $rememberMe;//记住我
    public $verifyCode;//验证码

	private $_identity;

	/**
	 * Declares the validation rules.
	 * The rules state that username and password are required,
	 * and password needs to be authenticated.
	 */
	public function rules()
	{
		return array(
			// username and password are required
			array('username', 'required', 'message'=>'用户名必填'),
            array('password', 'required', 'message'=>'密码必填'),
            //array('verifyCode', 'required', 'message'=>'验证码必填'),
			// rememberMe needs to be a boolean
			array('rememberMe', 'boolean'),
			// password needs to be authenticated
            //array('verifyCode', 'captcha', 'allowEmpty'=>!CCaptcha::checkRequirements(), 'message'=>'验证码错误'),
		    array('password', 'authenticate'),//通过authenticate方法进行检查
		);
	}

	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()//标签属性
	{
		return array(
            'username'=>'用户名',
            'password'=>'密　码',
            'verifyCode'=>'验证码',
			/*'rememberMe'=>'Remember me next time',*/
		);
	}

	/**
	 * Authenticates the password.
	 * This is the 'authenticate' validator as declared in rules().
	 */
	public function authenticate($attribute,$params)
	{
		if(!$this->hasErrors())
		{
			$this->_identity=new SiteUserIdentity($this->username,md5($this->password));//实例化并且传递接收的参数
			if(!$this->_identity->authenticate())//调用UserIdentity组件的authenticate方法与数据库进行校验
				$this->addError('password','用户名或者密码不正确.');
		}
	}

	/**
	 * Logs in the user using the given username and password in the model.
	 * @return boolean whether login is successful
	 */
	public function login()
	{
		if($this->_identity===null)
		{
			$this->_identity=new SiteUserIdentity($this->username,$this->password);
			$this->_identity->authenticate();
		}
		if($this->_identity->errorCode===SiteUserIdentity::ERROR_NONE)
		{
			/*$duration=$this->rememberMe ? 3600*24*30 : 0; 30 days*/
			/*Yii::app()->user->login($this->_identity,$duration);*/
            $duration=$this->rememberMe ? 3600*24*30 : 0; // 30 天
            Yii::app()->user->login($this->_identity,$duration);
			return true;
		}
		else
			return false; 
	}
}
