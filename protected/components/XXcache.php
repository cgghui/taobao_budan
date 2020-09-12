<?php
/**
 * 缓存工具
 * 
 * @author        shuguang <5565907@qq.com>
 * @copyright     Copyright (c) 2007-2013 bagesoft. All rights reserved.
 * @link          http://www.bagecms.com
 * @package       BageCMS.Tools
 * @license       http://www.bagecms.com/license
 * @version       v3.1.0
 */

class XXcache {

    /**
     * 取缓存
     *
     * @param $id
     */
    public static function get( $id ) {
        $value = Yii::app()->cache->get( $id );
        if ( $value === false ) 
            return '';
         else 
            return $value;
    }

    /**
     * 设置缓存
     */
    public static function set( $id = '', $data = '', $expirse = 3600 ) {
        Yii::app()->cache->set( $id, $data, $expirse );
    }

    /**
     * 基础
     *
     * @param $id
     * @param $fields
     * @param $expirse
     * @return |Ambigous <mixed, boolean>
     */
    public static function system( $id, $expirse = 600, $fields = '', $params = array() ) {
        $value = Yii::app()->cache->get( $id );
        if ( $value === false ) 
            return self::_refresh( $id, $expirse, $fields, $params );
        else 
            return $value;
    }

    /**
     * 刷新缓存
     *
     * @param $id
     * @param $fields
     * @param $expirse
     * @return unknown
     */
    public static function refresh( $id, $expirse = 600, $fields = '', $params = array() ) {
        return self::_refresh( $id, $expirse, $fields, $params );
    }

    /**
     * 刷新缓存
     *
     * @param $id
     */
    public function _refresh( $id, $expirse, $fields, $params ) {
        try {
            switch ( $id ) {
            case '_link':
                $data = (array) self::_base( 'Link', $fields, array ( 'condition' => 'status_is=1' , 'order' => 'sort_order DESC,id DESC' ) );
                self::set( $id, $data, $expirse );
                break;
            case '_pca':
                $data = (array) self::_base( 'Pca', $fields, array ( 'condition' => "status_is='Y'" , 'order' => 'id ASC' ) );
                self::set( $id, $data, $expirse );
                break;
            case '_userGroup':
                $data = (array) self::_base( 'UserGroup', $fields );
                self::set( $id, $data, $expirse );
                break;
            case '_ad':
                $data = (array) self::_base( 'Ad', $fields, array ( 'condition' => 'status_is=1' , 'order' => 'sort_order DESC,id DESC' ) );
                self::set( $id, $data, $expirse );
                break;
            case '_config':
                $data = (array) self::_config( $params );
                self::set( $id, $data, $expirse );
                break;
            case '_catalog':
                $data = (array) self::_base( 'Catalog', $fields, array ( 'condition' => 'status_is=1' , 'order' => 'sort_order DESC,id DESC' ) );
                self::set( $id, $data, $expirse );
                break;
            default:
                throw new Exception( '数据不在接受范围' );
                break;
            }

            return $data;
        } catch ( Exception $error ) {
            exit( $error->getMessage() );
        }
    }

    /**
     * 基础数据
     *
     * @param unknown_type $id
     * @param unknown_type $fields
     * @return unknown
     */
    protected function _base( $id = '', $fields = '', $condition = '' ) {
        $mod = ucfirst( $id );
        $model = new $mod();
        $dataGet = $model->findAll( $condition );
        foreach ( (array) $dataGet as $key => $row ) {
            foreach ( (array) self::_attributes( $fields, $model ) as $attr ) 
                $returnData[$key][$attr] = $row->$attr;
        }
        return $returnData;
    }

    /**
     * 属性附值
     *
     * @param $data
     * @param $model
     */
    protected function _attr2val( $data, $model, $fields = '' ) {
        foreach ( (array) $data as $key => $row ) {
            foreach ( (array) self::_attributes( $fields, $model ) as $attr )
                $returnData[$key][$attr] = $row->$attr;
        }
        return $returnData;
    }

    /**
     * 系统配置
     *
     * @param $id
     * @param $data
     * @param $expirse
     */
    protected function _config( $params = '' ) {
        $configModel = Config::model()->findAll();
        foreach ( (array) $configModel as $key => $row ) {
            if ( $params['scope'] ) {
                if ( in_array( $row['scope'], $params['scope'] ) )
                    $returnData[$row['variable']] = $row['value'];
            }else {
                $returnData[$row['variable']] = $row['value'];
            }
        }
        return $returnData;
    }

    /**
     * 取字段
     * @param $model
     */
    protected function _attributes( $fields, $model = '' ) {
        if ( empty( $fields ) || trim( $fields ) == '*' ) {
            return $model->attributeNames();
        } else {
            $fields = str_replace( '，', ',', $fields );
            return explode( ',', $fields );
        }
    }
}
