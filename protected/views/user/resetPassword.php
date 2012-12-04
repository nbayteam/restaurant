<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$this->pagetitle = Yii::app()->name . ' - Reset Password';

$this->menu = array(
    array('label'=>'Back to Homepage', 'url'=>array('view')),
);

?>

<h1>Enter your new password</h1>
<?php if(Yii::app()->user->hasFlash('success')): ?>
<div class="successMessage">
    <?php echo Yii::app()->user->getFlash('success'); ?>
</div>
<?php endif; ?>

<div class="form">
<?php $form = $this->beginWidget('CActiveForm'); ?>
    <div class="row">
        <?php echo $form->labelEx($model, 'password'); ?>
        <?php echo $form->textField($model, 'password'); ?>
        <?php echo $form->error($model, 'password'); ?>
    </div>
    <div class="row">
        <?php echo $form->labelEx($model, 'password_repeat'); ?>
        <?php echo $form->textField($model, 'password_repeat'); ?>
        <?php echo $form->error($model, 'password_repeat'); ?>
    </div>
    <div class="row buttons">
        <?php echo CHtml::submitButton('Reset Password'); ?>
    </div>
<?php $this->endWidget(); ?>
</div>