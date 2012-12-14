<?php
/* @var $this BusinessController */
/* @var $model Business */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'business-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('class'=>'input-xxlarge','size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('class'=>'input-xxlarge','rows'=>7, 'cols'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->dropDownList($model,'type', CHtml::listData(BusinessType::model()->findAll(), 'id', 'name'), array('empty'=>'Select a type')); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'address'); ?>
		<?php echo $form->textField($model,'address',array('class'=>'input-xxlarge','size'=>60,'maxlength'=>255)); ?>
		<?php echo $form->error($model,'address'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'zipcode'); ?>
		<?php echo $form->textField($model,'zipcode',array('class'=>'input-xxlarge','size'=>60,'maxlength'=>6)); ?>
		<?php echo $form->error($model,'zipcode'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('class'=>'input-xxlarge','size'=>60,'maxlength'=>8)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->dropDownList($model,'price', CHtml::listData(PriceType::model()->findAll(), 'id', 'name'), array('empty'=>'Select a type')); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'category'); ?>
		<?php echo $form->dropDownList($model,'category', CHtml::listData(CategoryType::model()->findAll(), 'id', 'name'), array('empty'=>'Select a category')); ?>
		<?php echo $form->error($model,'category'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'cuisine'); ?>
		<?php echo $form->dropDownList($model,'cuisine', CHtml::listData(CuisineType::model()->findAll(), 'id', 'name'), array('empty'=>'Select a cuisine type')); ?>
		<?php echo $form->error($model,'cuisine'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'opening_hours'); ?>
		<?php echo $form->textField($model,'opening_hours',array('class'=>'input-xxlarge','size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'opening_hours'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'payment'); ?>
		<?php echo $form->textField($model,'payment',array('class'=>'input-xxlarge','size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'payment'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'attire'); ?>
		<?php echo $form->dropDownList($model,'attire', CHtml::listData(AttireType::model()->findAll(), 'id', 'name'), array('empty'=>'Select an attire type')); ?>
		<?php echo $form->error($model,'attire'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ambience'); ?>
		<?php echo $form->dropDownList($model,'ambience', CHtml::listData(AmbienceType::model()->findAll(), 'id', 'name'), array('empty'=>'Select an ambience type')); ?>
		<?php echo $form->error($model,'ambience'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'groups_option'); ?>
		<?php echo $form->dropDownList($model,'groups_option', array('empty'=>'Select one', 'Yes'=>'Yes', 'No'=>'No')); ?>  
		<?php echo $form->error($model,'groups_option'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'kids_option'); ?>
		<?php echo $form->dropDownList($model,'kids_option', array('empty'=>'Select one', 'Yes'=>'Yes', 'No'=>'No')); ?>  
		<?php echo $form->error($model,'kids_option'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'website'); ?>
		<?php echo $form->textField($model,'website',array('class'=>'input-xxlarge','size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'website'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'menu'); ?>
		<?php echo $form->textField($model,'menu',array('class'=>'input-xxlarge','size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'menu'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'facebook'); ?>
		<?php echo $form->textField($model,'facebook',array('class'=>'input-xxlarge','size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'facebook'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'twitter'); ?>
		<?php echo $form->textField($model,'twitter',array('class'=>'input-xxlarge','size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'twitter'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'geolocation'); ?>
		<?php echo $form->textField($model,'geolocation',array('class'=>'input-xxlarge','size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'geolocation'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'rating'); ?>
		<?php echo $form->textField($model,'rating',array('class'=>'input-xxlarge','size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'rating'); ?>
	</div>

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
