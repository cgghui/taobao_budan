<?php

/**
 * This is the model class for table "{{_companyrealname}}".
 *
 * The followings are the available columns in table '{{_companyrealname}}':
 * @property integer $id
 * @property string $telphone
 * @property integer $userid
 * @property string $taobaoname
 * @property string $productcatlog
 * @property string $wangwang
 * @property string $taobaourl
 * @property integer $time
 * @property integer $check
 * @property integer $checkuserid
 * @property integer $checktime
 */
class Companyrealname extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Companyrealname the static model class
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
		return '{{_companyrealname}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('userid, taobaoname, productcatlog, wangwang, taobaourl, time', 'required'),
			array('userid, time, check, checkuserid, checktime', 'numerical', 'integerOnly'=>true),
			array('telphone, taobaoname, productcatlog, wangwang', 'length', 'max'=>100),
			array('taobaourl', 'length', 'max'=>2000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, telphone, userid, taobaoname, productcatlog, wangwang, taobaourl, time, check, checkuserid, checktime', 'safe', 'on'=>'search'),
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
			'telphone' => 'Telphone',
			'userid' => 'Userid',
			'taobaoname' => 'Taobaoname',
			'productcatlog' => 'Productcatlog',
			'wangwang' => 'Wangwang',
			'taobaourl' => 'Taobaourl',
			'time' => 'Time',
			'check' => 'Check',
			'checkuserid' => 'Checkuserid',
			'checktime' => 'Checktime',
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
		$criteria->compare('telphone',$this->telphone,true);
		$criteria->compare('userid',$this->userid);
		$criteria->compare('taobaoname',$this->taobaoname,true);
		$criteria->compare('productcatlog',$this->productcatlog,true);
		$criteria->compare('wangwang',$this->wangwang,true);
		$criteria->compare('taobaourl',$this->taobaourl,true);
		$criteria->compare('time',$this->time);
		$criteria->compare('check',$this->check);
		$criteria->compare('checkuserid',$this->checkuserid);
		$criteria->compare('checktime',$this->checktime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}