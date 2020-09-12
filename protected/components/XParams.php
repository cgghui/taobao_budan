<?php
/**
 * 静态参数
 * 
 * @author        shuguang <5565907@qq.com>
 * @copyright     Copyright (c) 2007-2013 bagesoft. All rights reserved.
 * @link          http://www.bagecms.com
 * @package       BageCMS.Tools
 * @license       http://www.bagecms.com/license
 * @version       v3.1.0
 */

class XParams{
	static $adminiLoggerType = array('login'=>'登录','create'=>'录入','delete'=>'删除','update'=>'编辑');
	static $attrScope = array('post'=>'内容','config'=>'系统配置','page'=>'单页');
	static $attrItemType = array('input'=>'文本输入','select'=>'下拉选择','checkbox'=>'多选','textarea'=>'大段内容','radio'=>'单选');
	/**
	 * 取参数值
	 */
	static public function get($val, $type){
		switch ($type) {
			case 'adminiLoggerType': return self::$adminiLoggerType[$val]; break;
			default: break;
		}
	}
}
