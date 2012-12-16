<?php
/* @var $this BusinessController */
/* @var $model Business */

$this->breadcrumbs=array(
	'Businesses'=>array('index'),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Business', 'url'=>array('index')),
	array('label'=>'Create Business', 'url'=>array('create')),
	array('label'=>'Update Business', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Business', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Business', 'url'=>array('admin')),
	array('label'=>'Add Review', 'url'=>array('menu/create', 'bid'=>$model->id)),
	array('label'=>'Add Review', 'url'=>array('review/create', 'bid'=>$model->id)),
);
?>

<h1><?php echo $model->name; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
	//$this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'name',
		'description',
		array(
			'name'=>'type',
			'value'=>CHtml::encode($model->getTypeText())
		),
		'picture',
		'address',
		'zipcode',
		'phone',
		'geolocation',
		array(
			'name'=>'price',
			'value'=>CHtml::encode($model->getPriceText())
		),
		array(
			'name'=>'category',
			'value'=>CHtml::encode($model->getCategoryText())
		),
		array(
			'name'=>'cuisine',
			'value'=>CHtml::encode($model->getCuisineText())
		),
		'opening_hours',
		'payment',
		array(
			'name'=>'attire',
			'value'=>CHtml::encode($model->getAttireText())
		),
		array(
			'name'=>'ambience',
			'value'=>CHtml::encode($model->getAmbienceText())
		),
		'groups_option',
		'kids_option',
		'website',
		'menu',
		'facebook',
		'twitter',
		'rating',
	),
)); ?>

<br>
<h1>Review</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$reviewDataProvider,
	'itemView'=>'/review/_view',
)); ?>
