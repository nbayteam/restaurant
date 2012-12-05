<?php
/**
 * This is the bootstrap file for test application.
 * This file should be removed when the application is deployed for production.
 */

// change the following paths if necessary
$pathinfo = pathinfo(dirname(__FILE__));
$pathinfo = explode("/", $pathinfo['dirname']);
$host = '';
if (count($pathinfo) >= 3) {
    $host = $pathinfo[2];
}
if ($host == "niko") {
    // niko settings
    $yii=dirname(__FILE__).'/../../../source/yii-1.1.12.b600af/framework/yii.php';
}
else{
    // yuyu settings
    $yii=dirname(__FILE__).'/../../framework/yii.php';
}

$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following line when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);

require_once($yii);
Yii::createWebApplication($config)->run();
