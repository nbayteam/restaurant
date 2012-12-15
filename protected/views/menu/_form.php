<?php
/* @var $this MenuController */
/* @var $model Menu */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'menu-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->hiddenField($model,'business_id'); ?>
	<?php echo $form->textFieldRow($model,'category',array('class'=>'input-xlarge','size'=>25,'maxlength'=>25)); ?>
	<?php echo $form->textFieldRow($model,'name',array('class'=>'input-xlarge','size'=>60,'maxlength'=>100)); ?>
	<?php echo $form->textAreaRow($model,'description',array('class'=>'input-xxlarge','rows'=>5)); ?>
	<?php echo $form->textFieldRow($model,'price',array('class'=>'input-medium','prepend'=>'$','append'=>'.00','maxlength'=>6)); ?>


	<div class="row buttons">
		<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>$model->isNewRecord ? 'Create' : 'Save',
            'type'=>null, // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>null, // null, 'large', 'small' or 'mini'
        )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->