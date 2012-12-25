<?php
/* @var $this ReviewController */
/* @var $model Review */
?>

<div class="view">

	<?php
	$profile = Profile::model()->findbyPk($data->user_id);
	?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($profile->first_name) . " " . CHtml::encode($profile->last_name); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('title')); ?>:</b>
	<?php echo CHtml::encode($data->title); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php echo CHtml::encode($data->description); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('rating')); ?>:</b>
	<?php echo CHtml::encode($data->rating); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('create_date')); ?>:</b>
	<?php echo CHtml::encode($data->create_date); ?>
	<br />

	<div class="row">
		<?php $this->widget('bootstrap.widgets.TbButton', array(
			'buttonType'=>'link',
			'url'=>array('review/update', 'id'=>$data->id),
		    'label'=>'Edit Review',
		    'type'=>'primary', // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
		    'size'=>'small', // null, 'large', 'small' or 'mini'
		    'htmlOptions'=>array('class'=>'pull-right'),
		)); ?>
	</div>

</div>
