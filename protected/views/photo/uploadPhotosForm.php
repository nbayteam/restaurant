<fieldset>
    <?php
    $form = $this->beginWidget('CActiveForm', array(
          'id' => 'upload-photos-form',
          'enableAjaxValidation' => false,
            //This is very important when uploading files
          'htmlOptions' => array('enctype' => 'multipart/form-data'),
        ));
      ?>
        <div class="row">
            <?php echo $form->labelEx($model,'Photos'); ?>
            <?php
            $this->widget( 'xupload.XUpload', array(
                'url' => Yii::app( )->createUrl( "/photo/uploadPhotos"),
                //our XUploadForm
                'model' => $photos,
                //We set this for the widget to be able to target our own form
                'htmlOptions' => array('id'=>'upload-photos-form'),
                'attribute' => 'file',
                'multiple' => true,
                //Note that we are using a custom view for our widget
                //Thats becase the default widget includes the 'form'
                //which we don't want here
                'formView' => 'application.views.photo.xup',
                )
            );
            ?>
        </div>
    <?php $this->endWidget(); ?>
</fieldset>
