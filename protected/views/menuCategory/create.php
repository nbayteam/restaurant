<?php
/* @var $this MenuCategoryController */
/* @var $model MenuCategory */

$this->breadcrumbs=array(
	'Menu Categories'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List MenuCategory', 'url'=>array('index')),
	array('label'=>'Manage MenuCategory', 'url'=>array('admin')),
);
?>

<h1>Create MenuCategory</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>