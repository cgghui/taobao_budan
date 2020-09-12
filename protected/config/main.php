<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',

	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'application.alipay.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		/*'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'gongyan2014',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),*/
        
        //引入我们创建的后台模�&#65533;
        'backyard',//添加backyard模块
        //'admin',//添加admin模块
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
            'stateKeyPrefix'=>'website', //session前缀，当前台退出时，后台不会退�&#65533;
            'loginUrl'=>array('site/index'),
			'allowAutoLogin'=>true,
		),
        
        'localtime'=>array(
            'class'=> date_default_timezone_set('ASIA/SHANGHAI'),
        ),
		// uncomment the following to enable URLs in path-format
		
		'urlManager'=>array(
			'urlFormat'=>'path',
            'urlSuffix'=>'.html',
            'showScriptName'=>false,
			/*'rules'=>array(
				/*'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),*/
		),
	   /*'db'=>array(
			'connectionString' => 'sqlite:'.dirname(__FILE__).'/../data/testdrive.db',
		),*/
		// uncomment the following to use a MySQL database
		
		'db'=>array(
			'connectionString' => 'mysql:host=127.0.0.1;dbname=taobao_budan',
			'emulatePrepare' => true,
			'username' => 'taobao_budan',
			'password' => 'CAcSeceFPxPCAxBR',
			'charset' => 'utf8',
            'tablePrefix' => 'zxjy',
		), 
	
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter', 
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
       /*'cache' => array (
         'class' => 'system.caching.CFileCache',//设置缓存类型为文件缓�&#65533;
         'directoryLevel' => 2,//设置缓存的目录层�&#65533;
        ),*/
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
    
    'language'=>'zh_cn', //设置语言
    'timeZone'=>'Asia/Shanghai',//设置时区
);