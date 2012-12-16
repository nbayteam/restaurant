<?php
/* @var $this MenuCategoryController */
/* @var $model MenuCategory */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'menu-category-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span6','size'=>50,'maxlength'=>50)); ?>
	<?php echo $form->textAreaRow($model,'description',array('class'=>'span6','rows'=>7, 'cols'=>60)); ?>


	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->