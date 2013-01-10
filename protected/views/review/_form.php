<?php
/* @var $this ReviewController */
/* @var $model Review */
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
	<?php echo $form->dropDownListRow($model,'rating',$model->getRatingOption()); ?>
	<?php echo $form->dropDownListRow($model,'rating2',$model->getRatingOption()); ?>
	<?php echo $form->dropDownListRow($model,'rating3',$model->getRatingOption()); ?>
	<?php echo $form->dropDownListRow($model,'rating4',$model->getRatingOption()); ?>
	<?php echo $form->textAreaRow($model,'description',array('class'=>'span6','rows'=>7, 'cols'=>60)); ?>
	
	
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
