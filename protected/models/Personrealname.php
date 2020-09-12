<?php

/**
 * This is the model class for table "{{_personrealname}}".
 *
 * The followings are the available columns in table '{{_personrealname}}':
 * @property integer $id
 * @property integer $userid
 * @property integer $telphone
 * @property string $qq
 * @property string $wangwang
 * @property string $realname
 * @property string $alipay
 * @property string $bankcount
 * @property string $bankplace
 * @property integer $time
 * @property integer $check
 * @property integer $checkuserid
 * @property integer $checktime
 */
class Personrealname extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Personrealname the static model class
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
		return '{{_personrealname}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid, telphone, qq, wangwang, realname, alipay, bankcount, bankplace, time', 'required'),
			array('userid, telphone, time, check, checkuserid, checktime', 'numerical', 'integerOnly'=>true),
			array('qq, wangwang, realname, alipay, bankcount, bankplace', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userid, telphone, qq, wangwang, realname, alipay, bankcount, bankplace, time, check, checkuserid, checktime', 'safe', 'on'=>'search'),
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
			'userid' => 'Userid',
			'telphone' => 'Telphone',
			'qq' => 'Qq',
			'wangwang' => 'Wangwang',
			'realname' => 'Realname',
			'alipay' => 'Alipay',
			'bankcount' => 'Bankcount',
			'bankplace' => 'Bankplace',
			'time' => 'Time',
			'check' => 'Check',
			'checkuserid' => 'Checkuserid',
			'checktime' => 'Checktime',
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
		$criteria->compare('userid',$this->userid);
		$criteria->compare('telphone',$this->telphone);
		$criteria->compare('qq',$this->qq,true);
		$criteria->compare('wangwang',$this->wangwang,true);
		$criteria->compare('realname',$this->realname,true);
		$criteria->compare('alipay',$this->alipay,true);
		$criteria->compare('bankcount',$this->bankcount,true);
		$criteria->compare('bankplace',$this->bankplace,true);
		$criteria->compare('time',$this->time);
		$criteria->compare('check',$this->check);
		$criteria->compare('checkuserid',$this->checkuserid);
		$criteria->compare('checktime',$this->checktime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}