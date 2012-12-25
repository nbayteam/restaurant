<?php
/* @var $this BusinessController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Businesses',
);

$this->menu=array(
	array('label'=>'Create Business', 'url'=>array('create')),
	array('label'=>'Manage Business', 'url'=>array('admin')),
);
?>

<h1>Businesses</h1>

<?php $this->widget('bootstrap.widgets.TbListView', array(
   'dataProvider'=>$dataProvider,
   'itemView'=>'_view',
   'pagerCssClass'=>'pagination pagination-centered pagination-small',
)); ?>