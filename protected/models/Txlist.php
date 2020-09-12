<?php

/**
 * This is the model class for table "{{_txlist}}".
 *
 * The followings are the available columns in table '{{_txlist}}':
 * @property integer $id
 * @property integer $userid
 * @property integer $money
 * @property integer $txstyle
 * @property integer $time
 * @property integer $checkuserid
 * @property integer $check
 * @property integer $checktime
 * @property integer $bankdo
 */
class Txlist extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Txlist the static model class
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
		return '{{_txlist}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid, txstyle, time, checkuserid, check, checktime, bankdo', 'numerical', 'integerOnly'=>true),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userid, money, txstyle, time, checkuserid, check, checktime, bankdo', 'safe', 'on'=>'search'),
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
			'money' => 'Money',
			'txstyle' => 'Txstyle',
			'time' => 'Time',
			'checkuserid' => 'Checkuserid',
			'check' => 'Check',
			'checktime' => 'Checktime',
			'bankdo' => 'Bankdo',
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
		$criteria->compare('money',$this->money);
		$criteria->compare('txstyle',$this->txstyle);
		$criteria->compare('time',$this->time);
		$criteria->compare('checkuserid',$this->checkuserid);
		$criteria->compare('check',$this->check);
		$criteria->compare('checktime',$this->checktime);
		$criteria->compare('bankdo',$this->bankdo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}