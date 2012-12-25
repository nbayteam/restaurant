<?php
/* @var $this ProfileController */
/* @var $model Profile */

$this->breadcrumbs=array(
	'Profiles'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List Profile', 'url'=>array('index')),
	array('label'=>'Create Profile', 'url'=>array('create')),
	array('label'=>'View Profile', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage Profile', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->first_name . " " . substr($model->last_name, 0, 1); ?>.'s Profile</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>