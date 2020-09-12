<?php

/**
 * This is the model class for table "{{_banklist}}".
 *
 * The followings are the available columns in table '{{_banklist}}':
 * @property integer $id
 * @property integer $userid
 * @property string $truename
 * @property integer $phone
 * @property integer $bankCatalog
 * @property string $bankAccount
 * @property integer $status
 * @property integer $time
 */
class Banklist extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Banklist the static model class
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
		return '{{_banklist}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userid, truename, phone, bankCatalog, bankAccount, status, time', 'safe', 'on'=>'search'),
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
			'truename' => 'Truename',
			'phone' => 'Phone',
			'bankCatalog' => 'Bank Catalog',
			'bankAccount' => 'Bank Account',
			'status' => 'Status',
			'time' => 'Time',
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
		$criteria->compare('truename',$this->truename,true);
		$criteria->compare('phone',$this->phone);
		$criteria->compare('bankCatalog',$this->bankCatalog);
		$criteria->compare('bankAccount',$this->bankAccount,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('time',$this->time);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}