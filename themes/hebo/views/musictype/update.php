<?php
/* @var $this MusictypeController */
/* @var $model Musictype */

$this->breadcrumbs=array(
	'Musictypes'=>array('index'),
	$model->type_name=>array('view','id'=>$model->type_name),
	'Update',
);

$this->menu=array(
	array('label'=>'List Musictype', 'url'=>array('index')),
	array('label'=>'Create Musictype', 'url'=>array('create')),
	array('label'=>'View Musictype', 'url'=>array('view', 'id'=>$model->type_name)),
	array('label'=>'Manage Musictype', 'url'=>array('admin')),
);
?>

<h1>Update Musictype <?php echo $model->type_name; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>