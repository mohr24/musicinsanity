<?php
/* @var $this ConcertController */
/* @var $model Concert */

$this->breadcrumbs=array(
	'Concerts'=>array('index'),
	$model->cid,
);

$this->menu=array(
	array('label'=>'List Concert', 'url'=>array('index')),
	array('label'=>'Create Concert', 'url'=>array('create')),
	array('label'=>'Update Concert', 'url'=>array('update', 'id'=>$model->cid)),
	array('label'=>'Delete Concert', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Concert', 'url'=>array('admin')),
);
?>

<h1>View Concert #<?php echo $model->cid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'cid',
		'aid',
		'cdate',
		'vid',
		'price',
		'availability',
		'clink',
		'cdescription',
		'concert_tp',
	),
)); ?>
