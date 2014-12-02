<?php
/* @var $this ConcertController */
/* @var $model Concert */

$this->breadcrumbs=array(
	'Concerts'=>array('index'),
	$model->cid=>array('view','id'=>$model->cid),
	'Update',
);

$this->menu=array(
	array('label'=>'List Concert', 'url'=>array('index')),
	array('label'=>'Create Concert', 'url'=>array('create')),
	array('label'=>'View Concert', 'url'=>array('view', 'id'=>$model->cid)),
	array('label'=>'Manage Concert', 'url'=>array('admin')),
);
?>

<h1>Update Concert <?php echo $model->cid; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>