<?php
/* @var $this MusictypeController */
/* @var $model Musictype */

$this->breadcrumbs=array(
	'Musictypes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Musictype', 'url'=>array('index')),
	array('label'=>'Manage Musictype', 'url'=>array('admin')),
);
?>

<h1>Create Musictype</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>