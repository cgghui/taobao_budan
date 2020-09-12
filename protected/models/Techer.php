<?php

/**
 * This is the model class for table "{{_techer}}".
 *
 * The followings are the available columns in table '{{_techer}}':
 * @property integer $id
 * @property string $techername
 * @property string $headpic
 * @property string $called
 * @property string $techerinfo
 */
class Techer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Techer the static model class
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
		return '{{_techer}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('techername, headpic, called, techerinfo', 'required'),
			array('techername, headpic, called', 'length', 'max'=>100),
			array('techerinfo', 'length', 'max'=>10000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, techername, headpic, called, techerinfo', 'safe', 'on'=>'search'),
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
			'id' => '索引ID',
			'techername' => '讲师名称',
			'headpic' => '讲师照片',
			'called' => '讲师职称',
			'techerinfo' => '讲师信息',
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
		$criteria->compare('techername',$this->techername,true);
		$criteria->compare('headpic',$this->headpic,true);
		$criteria->compare('called',$this->called,true);
		$criteria->compare('techerinfo',$this->techerinfo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}