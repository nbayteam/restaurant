<?php
/* @var $this MenuController */
/* @var $model Menu */

$this->breadcrumbs=array(
    'Menus'=>array('index', 'bid'=>$model->business_id),
    $model->name,
);

$this->menu=array(
    array('label'=>'List Menu', 'url'=>array('index', 'bid'=>$model->business_id)),
    array('label'=>'Create Menu', 'url'=>array('create', 'bid'=>$model->business_id)),
    array('label'=>'Update Menu', 'url'=>array('update', 'id'=>$model->id)),
    array('label'=>'Delete Menu', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Manage Menu', 'url'=>array('admin')),
);
?>

<h1>Menu: <?php echo $model->name; ?></h1>

<?php $this->widget('bootstrap.widgets.TbDetailView', array(
    'data'=>$model,
    'attributes'=>array(
        'id',
        'business_id',
        array(
            'name'=>'Category',
            'value'=>$model->getCategoryText(),
        ),
        'name',
        'description',
        'price',
        'status',
        'update_date',
        'create_date',
    ),
)); ?>


<div class="row">
<?php
$this->widget('bootstrap.widgets.TbButton', array(
    'label'=>'Add Photos',
    'type'=>'primary',
    'size'=>'small',
    'htmlOptions'=>array(
        'class'=>'pull-right',
        'data-toggle'=>'modal',
        'data-target'=>'#add-photos-modal',
    ),
));
?>

<?php
    // Declare Post Photo URL
    $menuUrl = Yii::app()->createUrl("photo/postPhotos", array("bid"=>$model->business_id));
?>
</div>

<br>

<ul class="thumbnails">
    <?php foreach ($model->photosMenus as $photoMenu): ?>
    <?php $photoRecord = $photoMenu->photo ?>
    <li class="span4" id='photomenu_<?php echo $photoRecord->id ?>'>
        <div class="well">
            <a href="#" class="thumbnail" rel="tooltip" data-title="<?php echo $photoRecord->description ?>">
                <?php echo CHtml::image(Yii::app()->params['menuImageRoot'].$model->id.'/thumbs/'.$photoRecord->picture, $photoRecord->description, array()); ?>
            </a>
            <p><?php echo $photoRecord->description ?></p>
            <div class='row'>
                <?php
                $this->widget('bootstrap.widgets.TbButton', array(
                    'buttonType'=>'ajaxButton',
                    'label'=>'Remove',
                    'type'=>'danger',
                    'size'=>'small',
                    'htmlOptions'=>array(
                        'class'=>'pull-right',
                    ),
                    'url' => Yii::app()->createUrl("photo/removePhoto"),
                    'ajaxOptions'=>array(
                        'type' => 'post',
                        //'url' => Yii::app()->createUrl("photo/removePhoto"),
                        'dataType'=>'json',
                        'data' =>array(
                            '_method'=>'delete',
                            'removePhotoFrom'=>'menu',
                            'photoId'=>$photoRecord->id
                            ),
                        'success' => 'js:function(data,textStatus,jqXHR ) {
                                            if (data.response === "OK") {
                                                $("#photomenu_"+data.photoId).remove();
                                            }

                                        }',
                    ),
                ));
                ?>
            </div>
        </div>
    </li>
    <?php endforeach ?>

</ul>

<script>
    // Declare Post Photo URL
    var menuUrl = "<?php echo $menuUrl; ?>";
    var photoCounter = 0;
</script>

<?php
$this->beginWidget('bootstrap.widgets.TbModal',
    array(
        'id'=>'add-photos-modal',
        "htmlOptions"=>array("class"=>"container",),
    )
);
?>

<div class="modal-header">
    <a class="close" data-dismiss="modal">&times;</a>
    <h4>Add Photos of <?php echo $model->name; ?></h4>
</div>

<div class="modal-body">
    <div>
        <?php
        $form = $this->beginWidget('bootstrap.widgets.TbActiveForm', array(
              'id' => 'upload-photos-form',
              'enableAjaxValidation' => false,
                //This is very important when uploading files
              'htmlOptions' => array('enctype' => 'multipart/form-data'),
            ));
        ?>
        <div>
            <?php
            $this->widget('xupload.XUpload', array(
                'url' => Yii::app()->createUrl("photo/uploadPhotos"),
                'model' => $photos,
                //We set this for the widget to be able to target our own form
                'htmlOptions' => array('id'=>'upload-photos-form', "class"=>"span7"),
                'attribute' => 'file',
                'multiple' => true,
                //Note that we are using a custom view for our widget
                //Thats becase the default widget includes the 'form'
                //which we don't want here
                'uploadView' => 'application.views.photo.upload',
                'downloadView' => 'application.views.photo.download',
                'options' => array(
                    'maxNumberOfFiles'=>5,
                    'singleFileUploads'=>'true',
                    'maxFileSize'=>10000000,
                    'previewSourceMaxFileSize'=>5000000,
                    'acceptFileTypes' => "js:/(\.|\/)(jpe?g|png)$/i",
                    'submit' => "js:function (e, data) {
                        var inputs = data.context.find(':input');
                        data.formData = inputs.serializeArray();
                        return true;
                    }",
                    'destroyed'=>'js:function(event, files, index, xhr, handler) {
                        photoCounter--;
                        if(photoCounter < 1) {
                            $("#post").addClass("disabled");
                            $("#post").attr("href", "#");
                        }

                    }',
                    'completed'=>'js:function(event, files, index, xhr, handler) {
                        photoCounter++;
                        if(photoCounter > 0) {
                            $("#post").removeClass("disabled");
                            $("#post").attr("href", menuUrl);
                        }
                    }',
                ),
            ));
            ?>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>

<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'type'=>'submit',
        'label'=>'Post Photos',
        'url'=>'#',
        'htmlOptions'=>array(
            'class'=>'disabled',
            'id'=>'post',
        ),
    )); ?>
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Cancel',
        'htmlOptions'=>array(
            "data-dismiss"=>"modal",
        ),
    )); ?>
</div>

<?php $this->endWidget(); ?>
