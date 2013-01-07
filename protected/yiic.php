<?php

// change the following paths if necessary
$pathinfo = pathinfo(dirname(__FILE__));
$pathinfo = explode("/", $pathinfo['dirname']);
$host = '';
if (count($pathinfo) >= 3) {
    $host = $pathinfo[2];
}
if ($host == "niko") {
    # niko settings
    $yiic=dirname(__FILE__).'/../../../../source/yii-1.1.12.b600af/framework/yiic.php';
}
else{
    # yuyu settings
    $yiic=dirname(__FILE__).'/../../../framework/yii/1.1.13/framework/yiic.php';
}

$config=dirname(__FILE__).'/config/console.php';

require_once($yiic);
