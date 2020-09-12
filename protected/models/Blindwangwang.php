<?php

/**
 * This is the model class for table "{{_blindwangwang}}".
 *
 * The followings are the available columns in table '{{_blindwangwang}}':
 * @property integer $id
 * @property integer $userid
 * @property string $wangwang
 * @property string $wangwanginfo
 * @property integer $statue
 * @property string $ip
 * @property integer $blindtime
 * @property integer $updatetime
 */
class Blindwangwang extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Blindwangwang the static model class
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
		return '{{_blindwangwang}}';
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
			array('id, userid, wangwang, wangwanginfo, statue, ip, blindtime, updatetime', 'safe', 'on'=>'search'),
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
			'wangwang' => 'Wangwang',
			'wangwanginfo' => 'Wangwanginfo',
			'statue' => 'Statue',
			'ip' => 'Ip',
			'blindtime' => 'Blindtime',
			'updatetime' => 'Updatetime',
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
		$criteria->compare('wangwang',$this->wangwang,true);
		$criteria->compare('wangwanginfo',$this->wangwanginfo,true);
		$criteria->compare('statue',$this->statue);
		$criteria->compare('ip',$this->ip,true);
		$criteria->compare('blindtime',$this->blindtime);
		$criteria->compare('updatetime',$this->updatetime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}