<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary(array($user, $profile)); ?>

        <div class="row">
		<?php echo $form->labelEx($profile,'first_name'); ?>
		<?php echo $form->textField($profile,'first_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($profile,'first_name'); ?>
	</div>

        <div class="row">
		<?php echo $form->labelEx($profile,'last_name'); ?>
		<?php echo $form->textField($profile,'last_name',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($profile,'last_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user,'username'); ?>
		<?php echo $form->textField($user,'username',array('size'=>45,'maxlength'=>45)); ?>
		<?php echo $form->error($user,'username'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($user,'password'); ?>
		<?php echo $form->passwordField($user,'password',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($user,'password'); ?>
	</div>


	<div class="row buttons">
		<?php //echo CHtml::submitButton($user->isNewRecord ? 'Create' : 'Save'); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>$user->isNewRecord ? 'Create' : 'Save',
            'type'=>null, // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>null, // null, 'large', 'small' or 'mini'
        )); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
