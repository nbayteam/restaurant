<?php
/* @var $this MenuCategoryController */
/* @var $model MenuCategory */

$this->breadcrumbs=array(
	'Menu Categories'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List MenuCategory', 'url'=>array('index')),
	array('label'=>'Create MenuCategory', 'url'=>array('create')),
	array('label'=>'Update MenuCategory', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete MenuCategory', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage MenuCategory', 'url'=>array('admin')),
);
?>

<h1>View MenuCategory #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		'create_date',
	),
)); ?>
