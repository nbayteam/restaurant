<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$this->pagetitle = Yii::app()->name . ' - Forgot Password';

$this->menu = array(
    array('label'=>'Back to Homepage', 'url'=>array('view')),
);

?>

<h1>Enter your email address</h1>
<?php if(Yii::app()->user->hasFlash('success')): ?>
<div class="successMessage">
    <?php echo Yii::app()->user->getFlash('success'); ?>
</div>
<?php else: ?>
<div class="successMessage">
    <?php echo Yii::app()->user->getFlash('fail'); ?>
</div>
<?php endif; ?>

<div class="form">
<?php $form = $this->beginWidget('CActiveForm'); ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'username'); ?>
        <?php echo $form->textField($model, 'username'); ?>
        <?php echo $form->error($model, 'username'); ?>
    </div>
    <div class="row buttons">
        <?php //echo CHtml::submitButton('Submit Email'); ?>
        <?php $this->widget('bootstrap.widgets.TbButton', array(
            'buttonType'=>'submit',
            'label'=>'Submit Email',
            'type'=>null, // null, 'primary', 'info', 'success', 'warning', 'danger' or 'inverse'
            'size'=>null, // null, 'large', 'small' or 'mini'
        )); ?>
    </div>
<?php $this->endWidget(); ?>
</div>
