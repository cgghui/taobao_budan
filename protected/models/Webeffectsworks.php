<?php

/**
 * This is the model class for table "{{_webeffectsworks}}".
 *
 * The followings are the available columns in table '{{_webeffectsworks}}':
 * @property integer $id
 * @property string $workname
 * @property string $img
 * @property string $link
 * @property integer $cat_id
 * @property string $codeinfos
 * @property string $sourcecode
 * @property integer $hit
 * @property string $adder
 * @property integer $addtime
 * @property integer $is_delete
 */
class Webeffectsworks extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Webeffectsworks the static model class
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
		return '{{_webeffectsworks}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('workname, img, link, codeinfos, sourcecode, hit, adder, addtime', 'required'),
			array('cat_id, hit, is_delete', 'numerical', 'integerOnly'=>true),
			array('workname, img, link, adder', 'length', 'max'=>100),
			array('codeinfos', 'length', 'max'=>10000),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, workname, img, link, cat_id, codeinfos, sourcecode, hit, adder, addtime, is_delete', 'safe', 'on'=>'search'),
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
			'workname' => '特效名称',
			'img' => '缩略图',
			'link' => '下载地址',
			'cat_id' => '栏目名称',
			'codeinfos' => '源码说明',
			'sourcecode' => '源代码',
			'hit' => '点击次数',
			'adder' => '添加作者',
			'addtime' => '添加时间',
			'is_delete' => '是否删除',
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
		$criteria->compare('workname',$this->workname,true);
		$criteria->compare('img',$this->img,true);
		$criteria->compare('link',$this->link,true);
		$criteria->compare('cat_id',$this->cat_id);
		$criteria->compare('codeinfos',$this->codeinfos,true);
		$criteria->compare('sourcecode',$this->sourcecode,true);
		$criteria->compare('hit',$this->hit);
		$criteria->compare('adder',$this->adder,true);
		$criteria->compare('addtime',$this->addtime);
		$criteria->compare('is_delete',$this->is_delete);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}