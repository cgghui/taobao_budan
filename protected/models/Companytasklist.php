<?php

/**
 * This is the model class for table "{{_companytasklist}}".
 *
 * The followings are the available columns in table '{{_companytasklist}}':
 * @property integer $id
 * @property integer $publishid
 * @property integer $taskerid
 * @property integer $status
 * @property integer $complian_status
 * @property string $complian_introduce
 * @property string $complian_res_info
 * @property integer $tasktime
 * @property integer $time
 * @property integer $task_type
 * @property string $ddlZGAccount
 * @property integer $ddlOKDay
 * @property string $txtGoodsUrl
 * @property double $txtPrice
 * @property double $MinLi
 * @property integer $cbxIsWW
 * @property integer $shopcoller
 * @property integer $isMobile
 * @property integer $cbxIsLHS
 * @property integer $isViewEnd
 * @property integer $pinimage
 * @property integer $stopDsTime
 * @property integer $stopTime
 * @property integer $cbxIsMsg
 * @property string $txtMessage
 * @property integer $cbxIsTip
 * @property string $txtRemind
 * @property integer $cbxIsAudit
 * @property integer $isReal
 * @property integer $cbxIsSB
 * @property integer $cbxIsFMaxMCount
 * @property integer $fmaxmc
 * @property integer $isLimitCity
 * @property string $Province
 * @property integer $isBuyerFen
 * @property integer $BuyerJifen
 * @property integer $filtertasker
 * @property integer $fmaxabc
 * @property integer $fmaxbbc
 * @property integer $fmaxbtsc
 * @property integer $isSign
 * @property integer $cbxIsAddress
 * @property string $cbxIsAddressContent
 * @property integer $isTpl
 * @property string $tplTo
 */
class Companytasklist extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Companytasklist the static model class
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
		return '{{_companytasklist}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('id, publishid, taskerid, status, complian_status, complian_introduce, complian_res_info, tasktime, time, task_type, ddlZGAccount, ddlOKDay, txtGoodsUrl, txtPrice, MinLi, cbxIsWW, shopcoller, isMobile, cbxIsLHS, isViewEnd, pinimage, stopDsTime, stopTime, cbxIsMsg, txtMessage, cbxIsTip, txtRemind, cbxIsAudit, isReal, cbxIsSB, cbxIsFMaxMCount, fmaxmc, isLimitCity, Province, isBuyerFen, BuyerJifen, filtertasker, fmaxabc, fmaxbbc, fmaxbtsc, isSign, cbxIsAddress, cbxIsAddressContent, isTpl, tplTo', 'safe', 'on'=>'search'),
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
			'publishid' => 'Publishid',
			'taskerid' => 'Taskerid',
			'status' => 'Status',
			'complian_status' => 'Complian Status',
			'complian_introduce' => 'Complian Introduce',
			'complian_res_info' => 'Complian Res Info',
			'tasktime' => 'Tasktime',
			'time' => 'Time',
			'task_type' => 'Task Type',
			'ddlZGAccount' => 'Ddl Zgaccount',
			'ddlOKDay' => 'Ddl Okday',
			'txtGoodsUrl' => 'Txt Goods Url',
			'txtPrice' => 'Txt Price',
			'MinLi' => 'Min Li',
			'cbxIsWW' => 'Cbx Is Ww',
			'shopcoller' => 'Shopcoller',
			'isMobile' => 'Is Mobile',
			'cbxIsLHS' => 'Cbx Is Lhs',
			'isViewEnd' => 'Is View End',
			'pinimage' => 'Pinimage',
			'stopDsTime' => 'Stop Ds Time',
			'stopTime' => 'Stop Time',
			'cbxIsMsg' => 'Cbx Is Msg',
			'txtMessage' => 'Txt Message',
			'cbxIsTip' => 'Cbx Is Tip',
			'txtRemind' => 'Txt Remind',
			'cbxIsAudit' => 'Cbx Is Audit',
			'isReal' => 'Is Real',
			'cbxIsSB' => 'Cbx Is Sb',
			'cbxIsFMaxMCount' => 'Cbx Is Fmax Mcount',
			'fmaxmc' => 'Fmaxmc',
			'isLimitCity' => 'Is Limit City',
			'Province' => 'Province',
			'isBuyerFen' => 'Is Buyer Fen',
			'BuyerJifen' => 'Buyer Jifen',
			'filtertasker' => 'Filtertasker',
			'fmaxabc' => 'Fmaxabc',
			'fmaxbbc' => 'Fmaxbbc',
			'fmaxbtsc' => 'Fmaxbtsc',
			'isSign' => 'Is Sign',
			'cbxIsAddress' => 'Cbx Is Address',
			'cbxIsAddressContent' => 'Cbx Is Address Content',
			'isTpl' => 'Is Tpl',
			'tplTo' => 'Tpl To',
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
		$criteria->compare('publishid',$this->publishid);
		$criteria->compare('taskerid',$this->taskerid);
		$criteria->compare('status',$this->status);
		$criteria->compare('complian_status',$this->complian_status);
		$criteria->compare('complian_introduce',$this->complian_introduce,true);
		$criteria->compare('complian_res_info',$this->complian_res_info,true);
		$criteria->compare('tasktime',$this->tasktime);
		$criteria->compare('time',$this->time);
		$criteria->compare('task_type',$this->task_type);
		$criteria->compare('ddlZGAccount',$this->ddlZGAccount,true);
		$criteria->compare('ddlOKDay',$this->ddlOKDay);
		$criteria->compare('txtGoodsUrl',$this->txtGoodsUrl,true);
		$criteria->compare('txtPrice',$this->txtPrice);
		$criteria->compare('MinLi',$this->MinLi);
		$criteria->compare('cbxIsWW',$this->cbxIsWW);
		$criteria->compare('shopcoller',$this->shopcoller);
		$criteria->compare('isMobile',$this->isMobile);
		$criteria->compare('cbxIsLHS',$this->cbxIsLHS);
		$criteria->compare('isViewEnd',$this->isViewEnd);
		$criteria->compare('pinimage',$this->pinimage);
		$criteria->compare('stopDsTime',$this->stopDsTime);
		$criteria->compare('stopTime',$this->stopTime);
		$criteria->compare('cbxIsMsg',$this->cbxIsMsg);
		$criteria->compare('txtMessage',$this->txtMessage,true);
		$criteria->compare('cbxIsTip',$this->cbxIsTip);
		$criteria->compare('txtRemind',$this->txtRemind,true);
		$criteria->compare('cbxIsAudit',$this->cbxIsAudit);
		$criteria->compare('isReal',$this->isReal);
		$criteria->compare('cbxIsSB',$this->cbxIsSB);
		$criteria->compare('cbxIsFMaxMCount',$this->cbxIsFMaxMCount);
		$criteria->compare('fmaxmc',$this->fmaxmc);
		$criteria->compare('isLimitCity',$this->isLimitCity);
		$criteria->compare('Province',$this->Province,true);
		$criteria->compare('isBuyerFen',$this->isBuyerFen);
		$criteria->compare('BuyerJifen',$this->BuyerJifen);
		$criteria->compare('filtertasker',$this->filtertasker);
		$criteria->compare('fmaxabc',$this->fmaxabc);
		$criteria->compare('fmaxbbc',$this->fmaxbbc);
		$criteria->compare('fmaxbtsc',$this->fmaxbtsc);
		$criteria->compare('isSign',$this->isSign);
		$criteria->compare('cbxIsAddress',$this->cbxIsAddress);
		$criteria->compare('cbxIsAddressContent',$this->cbxIsAddressContent,true);
		$criteria->compare('isTpl',$this->isTpl);
		$criteria->compare('tplTo',$this->tplTo,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}