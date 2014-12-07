<?php
/* @var $this ListController */
/* @var $model ListModel */

$this->breadcrumbs=array(
	'List Models'=>array('index'),
	$model->lid=>array('view','id'=>$model->lid),
	'Update',
);

$this->menu=array(
	array('label'=>'List ListModel', 'url'=>array('index')),
	array('label'=>'Create ListModel', 'url'=>array('create')),
	array('label'=>'View ListModel', 'url'=>array('view', 'id'=>$model->lid)),
	array('label'=>'Manage ListModel', 'url'=>array('admin')),
);
?>

<h1>Update ListModel <?php echo $model->lid; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>