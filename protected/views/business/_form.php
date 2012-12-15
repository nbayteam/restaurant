<?php
/* @var $this BusinessController */
/* @var $model Business */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('bootstrap.widgets.TbActiveForm', array(
	'id'=>'business-form',
	'enableAjaxValidation'=>false,
	'type'=>'horizontal',
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<?php echo $form->textFieldRow($model,'name',array('class'=>'span6','size'=>60,'maxlength'=>100)); ?>
	<?php echo $form->textAreaRow($model,'description',array('class'=>'span6','rows'=>5)); ?>
	<?php echo $form->dropDownListRow($model,'type', CHtml::listData(BusinessType::model()->findAll(), 'id', 'name'), array('empty'=>'Select a type')); ?>
	<?php echo $form->textFieldRow($model,'address',array('class'=>'span6','size'=>60,'maxlength'=>255)); ?>
	<?php echo $form->textFieldRow($model,'zipcode',array('class'=>'span6','size'=>60,'maxlength'=>6)); ?>
	<?php echo $form->textFieldRow($model,'phone',array('class'=>'span6','size'=>60,'maxlength'=>8)); ?>
	<?php echo $form->dropDownListRow($model,'price', CHtml::listData(PriceType::model()->findAll(), 'id', 'name'), array('empty'=>'Select a type')); ?>
	<?php echo $form->dropDownListRow($model,'category', CHtml::listData(CategoryType::model()->findAll(), 'id', 'name'), array('empty'=>'Select a category')); ?>
	<?php echo $form->dropDownListRow($model,'cuisine', CHtml::listData(CuisineType::model()->findAll(), 'id', 'name'), array('empty'=>'Select a cuisine type')); ?>
	<?php echo $form->textFieldRow($model,'opening_hours',array('class'=>'span6','size'=>60,'maxlength'=>100)); ?>
	<?php echo $form->checkBoxListRow($model,'payment',$paymentMethods); ?>
	<?php echo $form->dropDownListRow($model,'attire', CHtml::listData(AttireType::model()->findAll(), 'id', 'name'), array('empty'=>'Select an attire type')); ?>
	<?php echo $form->dropDownListRow($model,'ambience', CHtml::listData(AmbienceType::model()->findAll(), 'id', 'name'), array('empty'=>'Select an ambience type')); ?>
	<?php echo $form->dropDownListRow($model,'groups_option', array('empty'=>'Select one', 'Yes'=>'Yes', 'No'=>'No')); ?>  
	<?php echo $form->dropDownListRow($model,'kids_option', array('empty'=>'Select one', 'Yes'=>'Yes', 'No'=>'No')); ?>  
	<?php echo $form->textFieldRow($model,'website',array('class'=>'span6','size'=>60,'maxlength'=>100)); ?>
	<?php echo $form->textFieldRow($model,'menu',array('class'=>'span6','size'=>60,'maxlength'=>100)); ?>
	<?php echo $form->textFieldRow($model,'facebook',array('class'=>'span6','size'=>60,'maxlength'=>100)); ?>
	<?php echo $form->textFieldRow($model,'twitter',array('class'=>'span6','size'=>60,'maxlength'=>100)); ?>
	<?php echo $form->textFieldRow($model,'geolocation',array('class'=>'span6','size'=>50,'maxlength'=>50)); ?>
	<?php echo $form->textFieldRow($model,'rating',array('class'=>'span6','size'=>50,'maxlength'=>50)); ?>


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
