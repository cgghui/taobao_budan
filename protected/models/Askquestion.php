<?php

/**
 * This is the model class for table "{{_askquestion}}".
 *
 * The followings are the available columns in table '{{_askquestion}}':
 * @property integer $id
 * @property string $title
 * @property string $infos
 * @property integer $score
 * @property integer $userid
 * @property string $username
 * @property integer $answerstatue
 * @property integer $asktime
 * @property string $askip
 */
class Askquestion extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Askquestion the static model class
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
		return '{{_askquestion}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title, infos, score, userid, username, answerstatue, asktime, askip', 'required'),
			array('score, userid, answerstatue, asktime', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>200),
			array('username, askip', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, infos, score, userid, username, answerstatue, asktime, askip', 'safe', 'on'=>'search'),
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
			'title' => 'Title',
			'infos' => 'Infos',
			'score' => 'Score',
			'userid' => 'Userid',
			'username' => 'Username',
			'answerstatue' => 'Answerstatue',
			'asktime' => 'Asktime',
			'askip' => 'Askip',
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
		$criteria->compare('infos',$this->infos,true);
		$criteria->compare('score',$this->score);
		$criteria->compare('userid',$this->userid);
		$criteria->compare('username',$this->username,true);
		$criteria->compare('answerstatue',$this->answerstatue);
		$criteria->compare('asktime',$this->asktime);
		$criteria->compare('askip',$this->askip,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}