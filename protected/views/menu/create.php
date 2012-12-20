<?php
/* @var $this MenuController */
/* @var $model Menu */

$this->breadcrumbs=array(
	'Menus'=>array('index', 'bid'=>$bid),
	'Create',
);

$this->menu=array(
	array('label'=>'List Menu', 'url'=>array('index','bid'=>$bid)),
	array('label'=>'Manage Menu', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->business->name; ?></h1>
<h3>Add Menu</h3>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>