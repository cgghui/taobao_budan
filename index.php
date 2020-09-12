<?php
// change the following paths if necessary
$yii=dirname(__FILE__).'/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode（在上线时删除下面这一行代码）
defined('YII_DEBUG') or define('YII_DEBUG',true);//defined('YII_DEBUG') or define('YII_DEBUG',ture);改成defined('YII_DEBUG') or define('YII_DEBUG',false);使用了weidgt的页面会加快加载速度
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once(dirname(__FILE__).'/protected/config/defined.php');//加载全局变量
require_once($yii);//加载yii框架核心文件
Yii::createWebApplication($config)->run(); //运行显示最终结果
