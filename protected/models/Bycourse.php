<?php

/**
 * This is the model class for table "{{_bycourse}}".
 *
 * The followings are the available columns in table '{{_bycourse}}':
 * @property integer $id
 * @property integer $userid
 * @property integer $catid
 * @property integer $money
 * @property string $title
 * @property integer $order
 * @property integer $statue
 * @property integer $addtime
 * @property integer $paytime
 */
class Bycourse extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Bycourse the static model class
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
		return '{{_bycourse}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid, catid, money, title, order, addtime', 'required'),
			array('userid, catid, money, order, statue, addtime, paytime', 'numerical', 'integerOnly'=>true),
			array('title', 'length', 'max'=>100),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, userid, catid, money, title, order, statue, addtime, paytime', 'safe', 'on'=>'search'),
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
			'catid' => 'Catid',
			'money' => 'Money',
			'title' => 'Title',
			'order' => 'Order',
			'statue' => 'Statue',
			'addtime' => 'Addtime',
			'paytime' => 'Paytime',
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
		$criteria->compare('catid',$this->catid);
		$criteria->compare('money',$this->money);
		$criteria->compare('title',$this->title,true);
		$criteria->compare('order',$this->order);
		$criteria->compare('statue',$this->statue);
		$criteria->compare('addtime',$this->addtime);
		$criteria->compare('paytime',$this->paytime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}