<?php

/**
 * UserIdentity represents the data needed to identity a user.
 * It contains the authentication method that checks if the provided
 * data can identity the user.
 */
class UserIdentity extends CUserIdentity
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
	public function authenticate()//�ѽ��յ��û�����������ͬ���ݿ���жԱ�
	{
		/*$users=array(
			// username => password
			'demo'=>'demo',
			'admin'=>'admin',
		);*/
        //�������ݿ��û������������ʵ��У��
        //find()����û�в�ѯ�����᷵��null
       
        
        $userModel=Admin::model()->find('username=:name',array(':name'=>$this->username));
        if($userModel===null)//�жϲ�ѯ���
        {
            //echo "�û�������ȷ";
            $this->errorCode=self::ERROR_USERNAME_INVALID;
            return false;
        }
        else if($userModel->pwd!==$this->password)//�жϲ�ѯ����������е�pwd�Ƿ��봫�ݹ���������һ��
        {
            //echo "���벻��ȷ";
            $this->errorCode=self::ERROR_PASSWORD_INVALID;
            return false;
        }
        else
        {
            $this->errorCode=self::ERROR_NONE;
            $this->_id=$userModel->id;//��$_id���и�ֵ
            return true;
        }
        
        
	}
    
    public function getId()//����getId��������ΪgetId������Yii��Ĭ�ϵ��õ����û����������û�id������Ҫ����һ��
    {
        return $this->_id;
    }
    
    
}