<?php
/* @var $this MenuCategoryController */
/* @var $model MenuCategory */

$this->breadcrumbs=array(
	'Menu Categories'=>array('index'),
	$model->name=>array('view','id'=>$model->id),
	'Update',
);

$this->menu=array(
	array('label'=>'List MenuCategory', 'url'=>array('index')),
	array('label'=>'Create MenuCategory', 'url'=>array('create')),
	array('label'=>'View MenuCategory', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'Manage MenuCategory', 'url'=>array('admin')),
);
?>

<h1>Update MenuCategory <?php echo $model->id; ?></h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>