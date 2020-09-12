<?php

/**
 * This is the model class for table "{{_kcborder}}".
 *
 * The followings are the available columns in table '{{_kcborder}}':
 * @property integer $id
 * @property string $tno
 * @property string $payno
 * @property string $money
 * @property integer $status
 * @property integer $addtime
 * @property integer $completetime
 */
class Kcborder extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Kcborder the static model class
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
		return '{{_kcborder}}';
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
			array('id, tno, payno, money, status, addtime, completetime', 'safe', 'on'=>'search'),
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
			'tno' => 'Tno',
			'payno' => 'Payno',
			'money' => 'Money',
			'status' => 'Status',
			'addtime' => 'Addtime',
			'completetime' => 'Completetime',
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
		$criteria->compare('tno',$this->tno,true);
		$criteria->compare('payno',$this->payno,true);
		$criteria->compare('money',$this->money,true);
		$criteria->compare('status',$this->status);
		$criteria->compare('addtime',$this->addtime);
		$criteria->compare('completetime',$this->completetime);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}