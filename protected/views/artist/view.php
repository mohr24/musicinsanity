<?php
/* @var $this ArtistController */
/* @var $model Artist */

$this->breadcrumbs=array(
	'Artists'=>array('index'),
	$model->aid,
);

$this->menu=array(
	array('label'=>'List Artist', 'url'=>array('index')),
	array('label'=>'Create Artist', 'url'=>array('create')),
	array('label'=>'Update Artist', 'url'=>array('update', 'id'=>$model->aid)),
	array('label'=>'Delete Artist', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->aid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Artist', 'url'=>array('admin')),
);
?>

<h1>View Artist #<?php echo $model->aid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'aid',
		'ausername',
		'apassword',
		'aname',
		'aemail',
		'alink',
		'abio',
		'last_login_tp',
	),
)); ?>
