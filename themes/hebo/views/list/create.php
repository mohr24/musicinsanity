<?php
/* @var $this ListController */
/* @var $model ListModel */

$this->breadcrumbs=array(
	'List Models'=>array('index'),
	'Create',
);

$this->menu=array(
//	array('label'=>'List ListModel', 'url'=>array('index')),
//	array('label'=>'Manage ListModel', 'url'=>array('admin')),
);
?>

<h1>Create A New List</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>