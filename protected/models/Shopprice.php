<?php

/**
 * This is the model class for table "{{_shopprice}}".
 *
 * The followings are the available columns in table '{{_shopprice}}':
 * @property integer $id
 * @property string $title
 * @property string $pic
 * @property integer $price
 * @property string $info
 * @property string $teacher
 * @property integer $cat_id
 */
class Shopprice extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Shopprice the static model class
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
		return '{{_shopprice}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, pic, price, info, teacher, cat_id', 'required'),
			array('price, cat_id', 'numerical', 'integerOnly'=>true),
			array('title,teacher', 'length', 'max'=>100),
			array('info', 'length', 'max'=>10000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, pic, price, info, teacher, cat_id', 'safe', 'on'=>'search'),
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
			'title' => '课程名称',
			'pic' => '缩略图',
			'price' => '课程价格',
			'info' => '课程介绍',
			'teacher' => '主讲老师',
			'cat_id' => '栏目ID',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('pic',$this->pic,true);
		$criteria->compare('price',$this->price);
		$criteria->compare('info',$this->info,true);
		$criteria->compare('teacher',$this->teacher,true);
		$criteria->compare('cat_id',$this->cat_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}