<?php
/* @var $this MenuCategoryController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Menu Categories',
);

$this->menu=array(
	array('label'=>'Create MenuCategory', 'url'=>array('create')),
	array('label'=>'Manage MenuCategory', 'url'=>array('admin')),
);
?>

<h1>Menu Categories</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
