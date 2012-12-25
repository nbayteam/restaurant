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

<h1>View Menu #<?php echo $model->id; ?></h1>

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
            $this->widget( 'xupload.XUpload', array(
                'url' => Yii::app( )->createUrl( "/photo/uploadPhotos"),
                //our XUploadForm
                'model' => $photos,
                //We set this for the widget to be able to target our own form
                'htmlOptions' => array('id'=>'upload-photos-form', "class"=>"span7"),
                'attribute' => 'file',
                'multiple' => true,
                //Note that we are using a custom view for our widget
                //Thats becase the default widget includes the 'form'
                //which we don't want here
                'formView' => 'application.views.photo.xup',
                )
            );
            ?>
            <?php $this->endWidget(); ?>
        </div>
    </div>
</div>

<div class="modal-footer">
    <?php $this->widget('bootstrap.widgets.TbButton', array(
        'label'=>'Close',
        'url'=>'#',
        'htmlOptions'=>array(
            'data-dismiss'=>'modal',
        ),
    )); ?>
</div>

<?php $this->endWidget(); ?>
