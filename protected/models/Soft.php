<?php

/**
 * This is the model class for table "{{_soft}}".
 *
 * The followings are the available columns in table '{{_soft}}':
 * @property integer $id
 * @property string $softname
 * @property string $softpic
 * @property string $downloadlink
 * @property string $softinfo
 * @property integer $adddtime
 */
class Soft extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Soft the static model class
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
		return '{{_soft}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('softname, softpic, downloadlink, softinfo', 'required'),
			array('adddtime', 'numerical', 'integerOnly'=>true),
			array('softname, softpic', 'length', 'max'=>100),
			array('downloadlink', 'length', 'max'=>1000),
			array('softinfo', 'length', 'max'=>10000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, softname, softpic, downloadlink, softinfo, adddtime', 'safe', 'on'=>'search'),
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
			'softname' => '软件名称',
			'softpic' => '软件缩略图',
			'downloadlink' => '下载地址',
			'softinfo' => '软件简介',
			'adddtime' => '添加时间',
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
		$criteria->compare('softname',$this->softname,true);
		$criteria->compare('softpic',$this->softpic,true);
		$criteria->compare('downloadlink',$this->downloadlink,true);
		$criteria->compare('softinfo',$this->softinfo,true);
		$criteria->compare('adddtime',$this->adddtime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}