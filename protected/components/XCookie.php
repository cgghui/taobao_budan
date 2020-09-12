<?php
/**
 * Cookies工具
 * 
 * @author        shuguang <5565907@qq.com>
 * @copyright     Copyright (c) 2007-2013 bagesoft. All rights reserved.
 * @link          http://www.bagecms.com
 * @package       BageCMS.Tools
 * @license       http://www.bagecms.com/license
 * @version       v3.1.0
 */

class XCookie
{
    /**
	 * 设置cookie
	 * name 名称
	 * value 值
	 * expire 保存时间
	 * path 路径
	 * domain 域
	 */
    public static function set ($name = '', $value = '', $expire = 3600, $path = '', $domain = '', $secure = false)
    {
        $cookieSet = new CHttpCookie($name, $value);
        $expire && $cookieSet->expire = $expire;
        $path && $cookieSet->path = $path;
        $domain && $cookieSet->domain = $domain;
        $secure && $cookieSet->secure = $secure;
        Yii::app()->request->cookies[$name] = $cookieSet;
    }

    /**
	 * 获取cookie
	 * once 只取一次后删除值
	 */
    public static function get ($name, $once = false)
    {
        $cookie = Yii::app()->request->getCookies();
        $data = $cookie[$name]->value;
        if ($once)
            unset($cookie[$name]);
        return $data;
    }

    /**
     * 清理cookie
     * @param unknown_type $name
     */
    public static function remove ($name)
    {
        $cookie = Yii::app()->request->getCookies();
        unset($cookie[$name]);
    }

}

?>