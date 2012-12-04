<?php

// change the following paths if necessary
$pathinfo = pathinfo(dirname(__FILE__));
$pathinfo = explode("/", $pathinfo['dirname']);
$host = '';
if (count($pathinfo) >= 3) {
    $host = $pathinfo[2];
}
if ($host == "niko") {
    $yiic=dirname(__FILE__).'/../../framework/yiic.php';
}
else{
    $yiic=dirname(__FILE__).'/../../../framework/yiic.php';
}

$config=dirname(__FILE__).'/config/console.php';

require_once($yiic);
