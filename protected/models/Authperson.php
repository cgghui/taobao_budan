<?php

/**
 * This is the model class for table "{{_authperson}}".
 *
 * The followings are the available columns in table '{{_authperson}}':
 * @property integer $id
 * @property integer $uid
 * @property string $realname
 * @property string $idcardnumber
 * @property string $cftaccount
 * @property string $zfbaccount
 * @property string $QQ
 * @property string $address
 * @property string $telephone
 * @property string $zmidcard
 * @property string $handwithidcard
 * @property string $lifephoto
 * @property integer $status
 * @property integer $time
 * @property integer $passtime
 */
class Authperson extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Authperson the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{_authperson}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, uid, realname, idcardnumber, cftaccount, zfbaccount, QQ, address, telephone, zmidcard, handwithidcard, lifephoto, status, time, passtime', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'uid' => 'Uid',
			'realname' => 'Realname',
			'idcardnumber' => 'Idcardnumber',
			'cftaccount' => 'Cftaccount',
			'zfbaccount' => 'Zfbaccount',
			'QQ' => 'Qq',
			'address' => 'Address',
			'telephone' => 'Telephone',
			'zmidcard' => 'Zmidcard',
			'handwithidcard' => 'Handwithidcard',
			'lifephoto' => 'Lifephoto',
			'status' => 'Status',
			'time' => 'Time',
			'passtime' => 'Passtime',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('uid',$this->uid);
		$criteria->compare('realname',$this->realname,true);
		$criteria->compare('idcardnumber',$this->idcardnumber,true);
		$criteria->compare('cftaccount',$this->cftaccount,true);
		$criteria->compare('zfbaccount',$this->zfbaccount,true);
		$criteria->compare('QQ',$this->QQ,true);
		$criteria->compare('address',$this->address,true);
		$criteria->compare('telephone',$this->telephone,true);
		$criteria->compare('zmidcard',$this->zmidcard,true);
		$criteria->compare('handwithidcard',$this->handwithidcard,true);
		$criteria->compare('lifephoto',$this->lifephoto,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('time',$this->time);
		$criteria->compare('passtime',$this->passtime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}