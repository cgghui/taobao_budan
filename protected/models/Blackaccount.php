<?php

/**
 * This is the model class for table "{{_blackaccount}}".
 *
 * The followings are the available columns in table '{{_blackaccount}}':
 * @property integer $id
 * @property string $blackaccountinfo
 * @property integer $status
 * @property integer $time
 * @property integer $adderid
 * @property string $adder
 */
class Blackaccount extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Blackaccount the static model class
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
		return '{{_blackaccount}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('status, time, adderid', 'numerical', 'integerOnly'=>true),
			array('blackaccountinfo, adder', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, blackaccountinfo, status, time, adderid, adder', 'safe', 'on'=>'search'),
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
			'blackaccountinfo' => 'Blackaccountinfo',
			'status' => 'Status',
			'time' => 'Time',
			'adderid' => 'Adderid',
			'adder' => 'Adder',
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
		$criteria->compare('blackaccountinfo',$this->blackaccountinfo,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('time',$this->time);
		$criteria->compare('adderid',$this->adderid);
		$criteria->compare('adder',$this->adder,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}