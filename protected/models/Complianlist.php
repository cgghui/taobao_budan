<?php

/**
 * This is the model class for table "{{_complianlist}}".
 *
 * The followings are the available columns in table '{{_complianlist}}':
 * @property integer $id
 * @property integer $uid
 * @property integer $douid
 * @property integer $taskid
 * @property integer $status
 * @property string $reason
 * @property integer $time
 * @property integer $winid
 * @property integer $handleBeginTime
 * @property integer $handleCompleteTime
 * @property string $handleResultIntroduce
 */
class Complianlist extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Complianlist the static model class
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
		return '{{_complianlist}}';
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
			array('id, uid, douid, taskid, status, reason, time, winid, handleBeginTime, handleCompleteTime, handleResultIntroduce', 'safe', 'on'=>'search'),
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
			'uid' => 'Uid',
			'douid' => 'Douid',
			'taskid' => 'Taskid',
			'status' => 'Status',
			'reason' => 'Reason',
			'time' => 'Time',
			'winid' => 'Winid',
			'handleBeginTime' => 'Handle Begin Time',
			'handleCompleteTime' => 'Handle Complete Time',
			'handleResultIntroduce' => 'Handle Result Introduce',
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
		$criteria->compare('uid',$this->uid);
		$criteria->compare('douid',$this->douid);
		$criteria->compare('taskid',$this->taskid);
		$criteria->compare('status',$this->status);
		$criteria->compare('reason',$this->reason,true);
		$criteria->compare('time',$this->time);
		$criteria->compare('winid',$this->winid);
		$criteria->compare('handleBeginTime',$this->handleBeginTime);
		$criteria->compare('handleCompleteTime',$this->handleCompleteTime);
		$criteria->compare('handleResultIntroduce',$this->handleResultIntroduce,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}