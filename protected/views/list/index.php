<?php
/* @var $this ListController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'List Models',
);

$this->menu=array(
	array('label'=>'Create ListModel', 'url'=>array('create')),
	array('label'=>'Manage ListModel', 'url'=>array('admin')),
);
?>

<h1>List Models</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
