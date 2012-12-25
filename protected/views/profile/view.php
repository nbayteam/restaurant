<?php
/* @var $this ProfileController */
/* @var $model Profile */

$this->breadcrumbs=array(
	'Profiles'=>array('index'),
	$model->id,
);

$this->menu=array(
	array('label'=>'List Profile', 'url'=>array('index')),
	//array('label'=>'Create Profile', 'url'=>array('create')),
	array('label'=>'Update Profile', 'url'=>array('update', 'id'=>$model->id)),
	//array('label'=>'Delete Profile', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
	//array('label'=>'Manage Profile', 'url'=>array('admin')),
);
?>

<h1><?php echo $model->first_name . " " . substr($model->last_name, 0, 1); ?>.'s Profile</h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'first_name',
		'last_name',
		'picture',
		'email',
		array(
			'name'=>'phone',
			'value'=> $model->getCountryCodeText() . $model->phone,
		),
		'gender',
		'address',
		'zipcode',
		'birthdate',
		'gplus',
		'facebook',
		'twitter',
	),
)); ?>
