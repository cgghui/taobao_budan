<?php

/**
 * This is the model class for table "{{_translateactionid}}".
 *
 * The followings are the available columns in table '{{_translateactionid}}':
 * @property integer $id
 * @property string $actionid
 * @property string $actionidChinaese
 * @property string $controllerid
 */
class Translateactionid extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Translateactionid the static model class
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
		return '{{_translateactionid}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('actionid, actionidChinaese, controllerid', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, actionid, actionidChinaese, controllerid', 'safe', 'on'=>'search'),
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
			'actionid' => 'Actionid',
			'actionidChinaese' => 'Actionid Chinaese',
			'controllerid' => 'Controllerid',
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
		$criteria->compare('actionid',$this->actionid,true);
		$criteria->compare('actionidChinaese',$this->actionidChinaese,true);
		$criteria->compare('controllerid',$this->controllerid,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}