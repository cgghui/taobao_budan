<?php

/**
 * This is the model class for table "{{_commission}}".
 *
 * The followings are the available columns in table '{{_commission}}':
 * @property integer $id
 * @property integer $userid
 * @property integer $style
 * @property double $fbdnum
 * @property integer $time
 * @property integer $taskid
 */
class Commission extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Commission the static model class
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
		return '{{_commission}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid, fbdnum, time, taskid', 'required'),
			array('userid, style, time, taskid', 'numerical', 'integerOnly'=>true),
			array('fbdnum', 'numerical'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userid, style, fbdnum, time, taskid', 'safe', 'on'=>'search'),
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
			'style' => 'Style',
			'fbdnum' => 'Fbdnum',
			'time' => 'Time',
			'taskid' => 'Taskid',
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
		$criteria->compare('style',$this->style);
		$criteria->compare('fbdnum',$this->fbdnum);
		$criteria->compare('time',$this->time);
		$criteria->compare('taskid',$this->taskid);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}