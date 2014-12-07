<?php
/* @var $this ConcertController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Concerts',
);

$this->menu=array(
	array('label'=>'Create Concert', 'url'=>array('create')),
	array('label'=>'Manage Concert', 'url'=>array('admin')),
);
?>

<h1>Concerts</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
