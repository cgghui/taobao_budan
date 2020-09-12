<?php

/**
 * This is the model class for table "{{_askanswer}}".
 *
 * The followings are the available columns in table '{{_askanswer}}':
 * @property integer $id
 * @property integer $askid
 * @property string $answerinfo
 * @property integer $certainanswer
 * @property integer $answertime
 * @property string $answerip
 */
class Askanswer extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Askanswer the static model class
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
		return '{{_askanswer}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('askid, answerinfo, certainanswer, answertime, answerip', 'required'),
			array('askid, certainanswer, answertime', 'numerical', 'integerOnly'=>true),
			array('answerip', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, askid, answerinfo, certainanswer, answertime, answerip', 'safe', 'on'=>'search'),
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
			'askid' => 'Askid',
			'answerinfo' => 'Answerinfo',
			'certainanswer' => 'Certainanswer',
			'answertime' => 'Answertime',
			'answerip' => 'Answerip',
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
		$criteria->compare('askid',$this->askid);
		$criteria->compare('answerinfo',$this->answerinfo,true);
		$criteria->compare('certainanswer',$this->certainanswer);
		$criteria->compare('answertime',$this->answertime);
		$criteria->compare('answerip',$this->answerip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}