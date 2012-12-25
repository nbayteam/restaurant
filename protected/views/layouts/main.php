<?php /* @var $this Controller */ ?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- blueprint CSS framework -->
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
    <!--[if lt IE 8]>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
    <![endif]-->

    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />


    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/extra_library/bootstrap-modal-master/css/bootstrap-modal.css" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/extra_library/bootstrap-modal-master/js/bootstrap-modal.js" />
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/extra_library/bootstrap-modal-master/js/bootstrap-modalmanager.js" />


    <title><?php echo CHtml::encode($this->pageTitle); ?></title>
  </head>

  <body>

    <?php $this->widget('bootstrap.widgets.TbNavbar',array(
        'type'=>'inverse', // null or 'inverse'
        'brand'=>CHtml::encode(Yii::app()->name),
        'brandUrl'=>'#',
        'collapse'=>true, // requires bootstrap-responsive.css
        'items'=>array(
                array(
                    'class'=>'bootstrap.widgets.TbMenu',
                    'items'=>array(
                        array('label'=>'Home', 'url'=>array('/business')),
                        array('label'=>'About', 'url'=>array('/site/page', 'view'=>'about')),
                        array('label'=>'Contact', 'url'=>array('/site/contact')),
                        array('label'=>'Login', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest),
                    ),
                ),
        ),
    )); ?>


    <br><br><br>

    <div class="container">

        <?php if(isset($this->breadcrumbs)):?>
            <?php $this->widget('bootstrap.widgets.TbBreadcrumbs', array(
                'links'=>$this->breadcrumbs,
                'separator'=>' - ',
            )); ?><!-- breadcrumbs -->
        <?php endif?>

        <div class="row">
            <?php echo $content; ?>
        </div>

        <hr>

        <footer>
            Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
            All Rights Reserved.<br/>
            <?php echo Yii::powered(); ?>
        </footer>

    </div> <!-- /container -->


  </body>
</html>

