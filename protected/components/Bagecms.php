<?php
/**
 * 数据调用,带缓存功能
 *
 * @author        shuguang <5565907@qq.com>
 * @copyright     Copyright (c) 2007-2013 bagesoft. All rights reserved.
 * @link          http://www.bagecms.com
 * @package       BageCMS.Tools
 * @license       http://www.bagecms.com/license
 * @version       v3.1.0
 */

class Bagecms {

    /**
     * 获取单条记录
     * @param  [type] $model  [description]
     * @param  string $id     [description]
     * @param  array  $params [description]
     * @return [type]         [description]
     */
    public static function getItem( $model, $id = '', $params = array() ) {
        if ( isset( $params['cache'] ) ) {
            $value = Yii::app()->cache->get( $id );
            if ( $value === false ) 
                return self::_getItem( $model, $id, $params );
            else 
                return $value;
        } else {
            return self::_getItem( $model, $id, $params );
        }
    }

    /**
     * 获取多条数据
     * @param  [type] $model  [description]
     * @param  string $id     [description]
     * @param  array  $params [description]
     * @return [type]         [description]
     */
    public static function getList( $model, $id = '', $params = array() ) {
        if ( isset( $params['cache'] ) ) {
            $value = Yii::app()->cache->get( $id );
            if ( $value === false ) 
                return self::_getList( $model, $id, $params );
             else 
                return $value;
        } else {
            return self::_getList( $model, $id, $params );
        }
    }


    /**
     * 获取单条记录数据
     *
     * @param  $model
     * @param  $id
     * @param  $params
     * @return array
     */
    protected function _getItem( $model = '', $id, $params = '' ) {
        $model = ucfirst( $model );
        $xmodel = new $model();
        try {
            if ( empty( $params['where'] ) )
                throw new Exception( '查询条件必须' );
            $array['limit'] = 1;
            $array['condition'] = $params['where'];
            $params['select'] && $array['select'] = $params['select'];
            $params['with'] && $array['with'] = $params['with'];
            $params['alias'] && $array['alias'] = $params['alias'];
            $params['params'] && $array['params'] = $params['params'];
            $params['joinType'] && $array['joinType'] = $params['joinType'];
           if ( $params['xsql'] ) {
                $dataGet = Yii::app()->db->createCommand( $params['xsql'] )->queryRow();
           } else {
                $dataGet = $xmodel->find( $array );
	   }
            if ( $dataGet ) {
                foreach ( (array) self::_attributes( $params['select'], $xmodel ) as $attr ){
                    $returnData[$attr] = $dataGet->$attr;
               }
                if ( $params['cache'] ) {
                    $cacheTime = empty( $params['cacheTime'] ) ? 3600 : $params['cacheTime'];
                    Yii::app()->cache->set( $id, $returnData, $cacheTime );
                }
                return (array) $returnData;
            }else 
                return ;
        } catch ( Exception $error ) {
            echo __CLASS__.' 调用错误 -->  表名称： '. $model . '&nbsp;&nbsp;标识：' . $id  ;
        }
    }
    
    /**
     * 获取多条数据记录
     * @param  string $model  [description]
     * @param  [type] $id     [description]
     * @param  string $params [description]
     * @return [type]         [description]
     */
    protected function _getList( $model = '', $id, $params = '' ) {
        $model = ucfirst( $model );
        $bagecmsModel = new $model();
        $params['limit'] && $array['limit'] = $params['limit'];
        $params['where'] && $array['condition'] = $params['where'];
        $params['order'] && $array['order'] = $params['order'];
        $params['select'] && $array['select'] = $params['select'];
        $params['offset'] && $array['offset'] = $params['offset'];
        $params['with'] && $array['with'] = $params['with'];
        $params['alias'] && $array['alias'] = $params['alias'];
        $params['params'] && $array['params'] = $params['params'];
        $params['joinType'] && $array['joinType'] = $params['joinType'];
        $params['group'] && $array['group'] = $params['group'];
        try {
            if ( $params['xsql'] ) {
                $dataGet = Yii::app()->db->createCommand( $params['xsql'] )->queryAll();
            } else {
                $dataGet = $bagecmsModel->findAll( $array );
            }
            if ( $dataGet ) {
                foreach ( (array) $dataGet as $key => $row ) {
                    foreach ( (array) self::_attributes( $params['select'], $bagecmsModel ) as $attr ) {
                        $returnData[$key][$attr] = $row->$attr;
                    }
                }
                if ( $params['cache'] ) {
                    $cacheTime = empty( $params['cacheTime'] ) ? 3600 : $params['cacheTime'];
                    Yii::app()->cache->set( $id, $returnData, $cacheTime );
                }
                return (array) $returnData;
            }else
                return ;
        } catch ( Exception $error ) {
            echo __CLASS__.' 调用错误 -->  表名称： '. $model . '&nbsp;&nbsp;标识：' . $id  ;
        }
    }

    /**
     * 取模型字段
     * @param  string $fields [description]
     * @param  string $model  [description]
     * @return [type]         [description]
     */
    protected function _attributes( $fields = '', $model = '' ) {
        if ( empty( $fields ) || trim( $fields ) == '*' ) {
            return $model->attributeNames();
        } else {
            $fields = str_replace( '，', ',', $fields );
            return explode( ',', $fields );
        }
    }
}
