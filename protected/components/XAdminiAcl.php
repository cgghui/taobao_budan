<?php
/**
 * 后台菜单及权限
 * 
 * @author        shuguang <5565907@qq.com>
 * @copyright     Copyright (c) 2007-2013 bagesoft. All rights reserved.
 * @link          http://www.bagecms.com
 * @package       BageCMS.Acl
 * @license       http://www.bagecms.com/license
 * @version       v3.1.0
 */

class XAdminiAcl
{
    //权限配制数据
	public static $aclList = array(
    	'首页' => array(
    	   'controller'=>'home', 'url'=>'default/home', 'acl'=>'home','action'=>array(
                array('name'=>'系统首页','url'=>'default/home','acl'=>'home_index','list_acl'=>array()),
                array('name'=>'栏目管理','url'=>'catalog/index','acl'=>'config_catalog','list_acl'=>array(
                        '录入'=>'catalog_create', '编辑'=>'catalog_update','删除'=>'catalog_delete','排序'=>'catalog_sort_order'
                        )),
        	)
          ),
    	'设置' => array(
    	   'controller'=>'config', 'url'=>'config/index', 'acl'=>'config','action'=>array(
                array('name'=>'站点设置','url'=>'config/index','acl'=>'config_index','list_acl'=>array()),
                array('name'=>'SEO设置','url'=>'config/seo','acl'=>'config_seo','list_acl'=>array()),
                array('name'=>'上传设置','url'=>'config/upload','acl'=>'config_upload','list_acl'=>array()),
        		array('name'=>'自定义设置','url'=>'config/custom','acl'=>'config_custom','list_acl'=>array()),
        	)
          ),
    	'内容' => array(
    	   'controller'=>'post', 'url'=>'post/index', 'acl'=>'post','action'=>array(
                array('name'=>'内容管理','url'=>'post/index','acl'=>'post_index','list_acl'=>array(
                        '录入'=>'post_create', '编辑'=>'post_update', '批量审核'=>'post_verify', '批量推荐'=>'post_commend', '删除'=>'post_delete'
                        )),
                array('name'=>'评论管理','url'=>'post/comment','acl'=>'post_comment','list_acl'=>array(
                        '回复'=>'post_comment_update',  '删除'=>'post_comment_delete'
                        )),
                array('name'=>'专题管理','url'=>'post/special','acl'=>'post_special','list_acl'=>array(
                        '录入'=>'post_special_create', '编辑'=>'post_special_update',  '删除'=>'post_special_delete'
                        )),
                array('name'=>'单页管理','url'=>'page/index','acl'=>'page_index','list_acl'=>array(
                        '录入'=>'page_create', '编辑'=>'page_update', '删除'=>'page_delete'
                        )),
        	)
          ),
        '用户' => array(
           'controller'=>'user', 'url'=>'admin/index', 'acl'=>'user','action'=>array(
                array('name'=>'管理员列表','url'=>'admin/index','acl'=>'admin_index','list_acl'=>array(
                        '录入'=>'admin_create', '编辑'=>'admin_update', '删除'=>'admin_delete'
                        )),
                array('name'=>'管理员权限','url'=>'admin/group','acl'=>'admin_group','list_acl'=>array(
                        '录入'=>'admin_group_create', '编辑'=>'admin_group_update', '删除'=>'admin_group_delete'
                        )),
                array('name'=>'管理员日志','url'=>'logger/admin','acl'=>'admin_logger','list_acl'=>array(
                        '删除'=>'admin_logger_delete'
                        )),
                array('name'=>'留言反馈','url'=>'question/index','acl'=>'question_index','list_acl'=>array(
                        '回复'=>'question_update', '删除'=>'question_delete'
                        )),
            )
          ),
        '模板' => array(
           'controller'=>'template', 'url'=>'template/index', 'acl'=>'template','action'=>array(
                array('name'=>'网站模板','url'=>'template/index','acl'=>'template_index','list_acl'=>array(
                        '创建'=>'template_create', '编辑'=>'template_update','删除'=>'template_delete','创建文件夹'=>'template_folder_create','删除文件夹'=>'template_folder_delete'
                )),
             )
          ),
        '组件' => array(
           'controller'=>'tools', 'url'=>'attr/index', 'acl'=>'tools','action'=>array(
                array('name'=>'属性管理','url'=>'attr/index','acl'=>'attr_index','list_acl'=>array(
                        '录入'=>'attr_create', '编辑'=>'attr_update', '删除'=>'attr_delete'
                        )),
                array('name'=>'附件管理','url'=>'other/attach','acl'=>'attach_index','list_acl'=>array(
                         '删除'=>'attach_delete'
                        )),
                array('name'=>'链接管理','url'=>'operation/link','acl'=>'link_index','list_acl'=>array(
                        '录入'=>'link_create', '编辑'=>'link_update', '批量变更状态'=>'link_verify', '删除'=>'link_delete'
                        )),
                array('name'=>'广告管理','url'=>'operation/ad','acl'=>'ad_index','list_acl'=>array(
                        '录入'=>'ad_create', '编辑'=>'ad_update', '批量变更状态'=>'ad_verify', '删除'=>'ad_delete'
                        )),
            )
          ),
        '工具' => array(
           'controller'=>'tools', 'url'=>'database/index', 'acl'=>'tools','action'=>array(
                array('name'=>'数据库管理','url'=>'database/index','acl'=>'database_index','list_acl'=>array(
                        '执行sql'=>'database_query','数据库备份'=>'database_export','数据库还原'=>'database_import','备份文件下载'=>'database_download','删除备份文件'=>'database_delete',
                )),
                array('name'=>'缓存管理','url'=>'tools/cache','acl'=>'tools_cache','list_acl'=>array()),
                //array('name'=>'程序升级','url'=>'upgrade/index','acl'=>'upgrade/index','list_acl'=>array()),
            )
          )
    );
    
    /**
     * 后台菜单过滤
     *
     */
    static public function filterMenu($append = ',home,home_index')
    {
        $session = new XSession();
        $adminiGroupId = $session->get('_adminiGroupId');
        if($adminiGroupId != 1){
            $aclModel = AdminGroup::model()->findByPk($adminiGroupId);
            $acl = $aclModel->acl.$append;
            $aclArr = explode(',', $acl);
            foreach (self::$aclList as $k=>$r){
                if(!in_array($r['acl'], $aclArr)){
                   unset(self::$aclList[$k]);
                }else{
                    self::$aclList[$k]['url'] = self::_parentRouter($k, $aclArr);
                    foreach($r['action'] as $kk=>$rr){
                        if(!in_array($rr['acl'], explode(',', $acl)))
                            unset(self::$aclList[$k]['action'][$kk]);
                    }
                }
            }
        }
       return self::$aclList;
    }

    /**
     * 取大类链接，防止有未授权情况
     * @param string $n
     * @param array $acl
     * @return string
     */
    private function _parentRouter($n, $acl){
        $one = 0;
        foreach((array)self::$aclList[$n]['action'] as $key=>$row){
            if(in_array($row['acl'], $acl)){
                if($one == 0)
                    return $row['url'];
            }
        }
        return 'home';
    }
}