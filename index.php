<?php

// change the following paths if necessary
$pathinfo = pathinfo(dirname(__FILE__));
$pathinfo = explode("/", $pathinfo['dirname']);
$host = '';
if (count($pathinfo) >= 3) {
    $host = $pathinfo[2];
}
if ($host == "niko") {
    $yii=dirname(__FILE__).'/../framework/yii.php';
}
else{
    $yii=dirname(__FILE__).'/../../framework/yii.php';
}

$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();
