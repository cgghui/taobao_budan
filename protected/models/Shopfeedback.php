<?php

/**
 * This is the model class for table "{{_shopfeedback}}".
 *
 * The followings are the available columns in table '{{_shopfeedback}}':
 * @property integer $msg_id
 * @property integer $parent_id
 * @property integer $user_id
 * @property string $user_name
 * @property string $user_email
 * @property string $msg_title
 * @property integer $msg_type
 * @property string $msg_content
 * @property string $msg_time
 * @property string $message_img
 * @property string $order_id
 */
class Shopfeedback extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Shopfeedback the static model class
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
		return '{{_shopfeedback}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_name, user_email, msg_title, msg_content', 'required'),
			array('parent_id, user_id, msg_type', 'numerical', 'integerOnly'=>true),
			array('user_name, user_email', 'length', 'max'=>60),
			array('msg_title', 'length', 'max'=>200),
			array('msg_time', 'length', 'max'=>10),
			array('message_img', 'length', 'max'=>255),
			array('order_id', 'length', 'max'=>11),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('msg_id, parent_id, user_id, user_name, user_email, msg_title, msg_type, msg_content, msg_time, message_img, order_id', 'safe', 'on'=>'search'),
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
			'msg_id' => 'Msg',
			'parent_id' => 'Parent',
			'user_id' => 'User',
			'user_name' => 'User Name',
			'user_email' => 'User Email',
			'msg_title' => 'Msg Title',
			'msg_type' => 'Msg Type',
			'msg_content' => 'Msg Content',
			'msg_time' => 'Msg Time',
			'message_img' => 'Message Img',
			'order_id' => 'Order',
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

		$criteria->compare('msg_id',$this->msg_id);
		$criteria->compare('parent_id',$this->parent_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('user_email',$this->user_email,true);
		$criteria->compare('msg_title',$this->msg_title,true);
		$criteria->compare('msg_type',$this->msg_type);
		$criteria->compare('msg_content',$this->msg_content,true);
		$criteria->compare('msg_time',$this->msg_time,true);
		$criteria->compare('message_img',$this->message_img,true);
		$criteria->compare('order_id',$this->order_id,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}