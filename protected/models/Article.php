<?php

/**
 * This is the model class for table "{{_article}}".
 *
 * The followings are the available columns in table '{{_article}}':
 * @property integer $goods_id
 * @property integer $cat_id
 * @property string $goods_sn
 * @property string $goods_name
 * @property string $goods_name_style
 * @property string $click_count
 * @property integer $brand_id
 * @property string $provider_name
 * @property integer $goods_number
 * @property string $goods_weight
 * @property string $market_price
 * @property string $shop_price
 * @property string $promote_price
 * @property string $promote_start_date
 * @property string $promote_end_date
 * @property integer $warn_number
 * @property string $keywords
 * @property string $goods_brief
 * @property string $goods_desc
 * @property string $goods_thumb
 * @property string $goods_img
 * @property string $original_img
 * @property integer $is_real
 * @property string $extension_code
 * @property integer $is_on_sale
 * @property integer $is_alone_sale
 * @property string $integral
 * @property string $add_time
 * @property integer $sort_order
 * @property integer $is_delete
 * @property integer $is_best
 * @property integer $is_new
 * @property integer $is_hot
 * @property integer $is_promote
 * @property integer $bonus_type_id
 * @property string $last_update
 * @property integer $goods_type
 * @property string $seller_note
 * @property integer $give_integral
 */
class Article extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Article the static model class
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
		return '{{_article}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('goods_name','required',"message"=>"标题必填"),
            array('cat_id','required',"message"=>"栏目必选，如果没有请先添加栏目"),
			/*array('cat_id, brand_id, goods_number, warn_number, is_real, is_on_sale, is_alone_sale, sort_order, is_delete, is_best, is_new, is_hot, is_promote, bonus_type_id, goods_type, give_integral', 'numerical', 'integerOnly'=>true),
			array('goods_sn, goods_name_style', 'length', 'max'=>60),
			array('goods_name', 'length', 'max'=>120),
			array('click_count, goods_weight, market_price, shop_price, promote_price, integral, add_time, last_update', 'length', 'max'=>10),
			array('provider_name', 'length', 'max'=>100),
			array('promote_start_date, promote_end_date', 'length', 'max'=>11),
			array('keywords, goods_brief, goods_thumb, goods_img, original_img, seller_note', 'length', 'max'=>255),
			array('extension_code', 'length', 'max'=>30),*/
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('goods_id, cat_id, goods_sn, goods_name, goods_name_style, click_count, brand_id, provider_name, goods_number, goods_weight, market_price, shop_price, promote_price, promote_start_date, promote_end_date, warn_number, keywords, goods_brief, goods_desc, goods_thumb, goods_img, original_img, is_real, extension_code, is_on_sale, is_alone_sale, integral, add_time, sort_order, is_delete, is_best, is_new, is_hot, is_promote, bonus_type_id, last_update, goods_type, seller_note, give_integral', 'safe', 'on'=>'search'),
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
			'goods_id' => 'Goods',
			'cat_id' => '所属栏目',
			'goods_sn' => '商品的唯一货号',
			'goods_name' => '文档标题',
			'goods_name_style' => '标题颜色',
			'click_count' => '商品点击数',
			'brand_id' => '品牌ID',
			'provider_name' => '供货人的名称',
			'goods_number' => '商品库存数量',
			'goods_weight' => '商品的重量',
			'market_price' => '市场售价',
			'shop_price' => '本店售价',
			'promote_price' => '促销价格',
			'promote_start_date' => '促销开始日期',
			'promote_end_date' => '促销结束日期',
			'warn_number' => '商品报警数量',
			'keywords' => '栏目关键字',
			'goods_brief' => '商品简短描述',
			'goods_desc' => '正文内容',
			'goods_thumb' => '多图上传',
			'goods_img' => '缩略图',
			'original_img' => '原始图片',
			'is_real' => '是否是实物',
			'extension_code' => '虚拟卡',
			'is_on_sale' => '开放销售',
			'is_alone_sale' => '单独销售',
			'integral' => '使用的积分数量',
			'add_time' => '添加时间',
			'sort_order' => '显示顺序',
			'is_delete' => '是否删除',
			'is_best' => '是否精品',
			'is_new' => '是否新品',
			'is_hot' => '是否热销',
			'is_promote' => '是否促销',
			'bonus_type_id' => '购买该商品所能领到的红包类型',
			'last_update' => '更新时间',
			'goods_type' => '商品所属类型',
			'seller_note' => '商品的商家备注',
			'give_integral' => '赠送积分',
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

		$criteria->compare('goods_id',$this->goods_id);
		$criteria->compare('cat_id',$this->cat_id);
		$criteria->compare('goods_sn',$this->goods_sn,true);
		$criteria->compare('goods_name',$this->goods_name,true);
		$criteria->compare('goods_name_style',$this->goods_name_style,true);
		$criteria->compare('click_count',$this->click_count,true);
		$criteria->compare('brand_id',$this->brand_id);
		$criteria->compare('provider_name',$this->provider_name,true);
		$criteria->compare('goods_number',$this->goods_number);
		$criteria->compare('goods_weight',$this->goods_weight,true);
		$criteria->compare('market_price',$this->market_price,true);
		$criteria->compare('shop_price',$this->shop_price,true);
		$criteria->compare('promote_price',$this->promote_price,true);
		$criteria->compare('promote_start_date',$this->promote_start_date,true);
		$criteria->compare('promote_end_date',$this->promote_end_date,true);
		$criteria->compare('warn_number',$this->warn_number);
		$criteria->compare('keywords',$this->keywords,true);
		$criteria->compare('goods_brief',$this->goods_brief,true);
		$criteria->compare('goods_desc',$this->goods_desc,true);
		$criteria->compare('goods_thumb',$this->goods_thumb,true);
		$criteria->compare('goods_img',$this->goods_img,true);
		$criteria->compare('original_img',$this->original_img,true);
		$criteria->compare('is_real',$this->is_real);
		$criteria->compare('extension_code',$this->extension_code,true);
		$criteria->compare('is_on_sale',$this->is_on_sale);
		$criteria->compare('is_alone_sale',$this->is_alone_sale);
		$criteria->compare('integral',$this->integral,true);
		$criteria->compare('add_time',$this->add_time,true);
		$criteria->compare('sort_order',$this->sort_order);
		$criteria->compare('is_delete',$this->is_delete);
		$criteria->compare('is_best',$this->is_best);
		$criteria->compare('is_new',$this->is_new);
		$criteria->compare('is_hot',$this->is_hot);
		$criteria->compare('is_promote',$this->is_promote);
		$criteria->compare('bonus_type_id',$this->bonus_type_id);
		$criteria->compare('last_update',$this->last_update,true);
		$criteria->compare('goods_type',$this->goods_type);
		$criteria->compare('seller_note',$this->seller_note,true);
		$criteria->compare('give_integral',$this->give_integral);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}