<?php

// change the following paths if necessary
<<<<<<< HEAD
$yiic=dirname(__FILE__).'/../../../framework/yiic.php';
//$yiic=dirname(__FILE__).'/../../../framework/yiic.php';
=======
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
    $yiic=dirname(__FILE__).'/../../../framework/yiic.php';
}

>>>>>>> 6da7ba7219a6e30564c92ed91b20dfcd40557dd2
$config=dirname(__FILE__).'/config/console.php';

require_once($yiic);
