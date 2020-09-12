<?php

/**
 * This is the model class for table "{{_translatecontrollerid}}".
 *
 * The followings are the available columns in table '{{_translatecontrollerid}}':
 * @property integer $id
 * @property string $controllerid
 * @property string $controlleridChinaese
 */
class Translatecontrollerid extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Translatecontrollerid the static model class
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
		return '{{_translatecontrollerid}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('controllerid, controlleridChinaese', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, controllerid, controlleridChinaese', 'safe', 'on'=>'search'),
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
			'controllerid' => 'Controllerid',
			'controlleridChinaese' => 'Controllerid Chinaese',
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
		$criteria->compare('controllerid',$this->controllerid,true);
		$criteria->compare('controlleridChinaese',$this->controlleridChinaese,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}