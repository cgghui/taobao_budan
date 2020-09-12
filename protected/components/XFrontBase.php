<?php
/**
 * 控制器基类，前台控制器必须继承此类
 * 
 * @author        shuguang <5565907@qq.com>
 * @copyright     Copyright (c) 2007-2013 bagesoft. All rights reserved.
 * @link          http://www.bagecms.com
 * @package       BageCMS.Controller
 * @license       http://www.bagecms.com/license
 * @version       v3.1.0
 */

class XFrontBase extends Controller
{
    public $layout = '';
    protected $_conf;
    protected $_catalog;
    protected $_seoTitle;
    protected $_seoKeywords;
    protected $_seoDescription;
    
    /**
	 * 初始化
	 * @see CController::init()
	 */
    public function init ()
    {
        parent::init();
        //检测系统是否已经安装
        if(!is_file(WWWPATH.DS.'data'.DS.'install.lock'))
            $this->redirect(array('/install'));
        //系统配置
        $this->_conf = XXcache::system('_config');
        $this->_catalog = Catalog::get(0, XXcache::system('_catalog'));
        $this->_seoTitle = $this->_conf['seo_title'];
        $this->_seoKeywords = $this->_conf['seo_keywords'];
        $this->_seoDescription = $this->_conf['seo_description'];
        if($this->_conf['site_status'] == 'close')
            self::_closed();
    }

    /**
     * 生成导航链接
     */
    protected function _navLink($catalog){
        if($catalog['redirect_url'])
            return $catalog['redirect_url'];
        else
            return $this->createUrl('post/index',array('catalog'=>$catalog['catalog_name_alias']));
    }

    /**
     * 关闭状态
     */
    protected function _closed(){
        $this->render('/error/close', array('message'=>$this->_conf['site_status_intro']));
        exit;
    }
}