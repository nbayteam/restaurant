<?php
/* @var $this MenuController */
/* @var $model Menu */

$this->breadcrumbs=array(
	'Menus'=>array('index', 'bid'=>$model->business_id),
	$model->name,
);

$this->menu=array(
	array('label'=>'List Menu', 'url'=>array('index', 'bid'=>$model->business_id)),
	array('label'=>'Create Menu', 'url'=>array('create', 'bid'=>$model->business_id)),
	array('label'=>'Update Menu', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'Delete Menu', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Menu', 'url'=>array('admin')),
);
?>

<h1>View Menu #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'business_id',
		array(
			'name'=>'Category',
			'value'=>$model->getCategoryText(),
		),
		'name',
		'description',
		'price',
		'status',
		'update_date',
		'create_date',
	),
)); ?>

<div class="row">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'link',
		    'label'=>'Add Photo',
		    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		    'size'=>'small', // null, 'large', 'small' or 'mini'
		    'htmlOptions'=>array('class'=>'pull-right', 'style'=>'margin-top: 10px;'),
		)); ?>
	</div>