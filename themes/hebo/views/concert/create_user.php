<?php
/* @var $this ConcertController */
/* @var $model Concert */

$this->breadcrumbs=array(
	'Concerts'=>array('index'),
	'Create',
);

$this->menu=array(
//	array('label'=>'List Concert', 'url'=>array('index')),
//	array('label'=>'Manage Concert', 'url'=>array('admin')),
);
?>

<h1>Create User Concert</h1>

<?php $this->renderPartial('_form_user', array('model'=>$model)); ?>