<?php
/* @var $this MusictypeController */
/* @var $model Musictype */

$this->breadcrumbs=array(
	'Musictypes'=>array('index'),
	$model->type_name,
);

$this->menu=array(
	array('label'=>'List Musictype', 'url'=>array('index')),
	array('label'=>'Create Musictype', 'url'=>array('create')),
	array('label'=>'Update Musictype', 'url'=>array('update', 'id'=>$model->type_name)),
	array('label'=>'Delete Musictype', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->type_name),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Musictype', 'url'=>array('admin')),
);
?>

<h1>View Musictype #<?php echo $model->type_name; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'type_name',
		'major',
		'description',
	),
)); ?>
<br/>
<h1><?php echo $model->type_name; ?> Artists</h1>
<?php $this->widget('zii.widgets.CListView',array(

    'dataProvider'=>$dataProviderArtists,

    'itemView'=>'//artist/_view',

)); ?>
<br/>
<h1><?php echo $model->type_name; ?> Concerts</h1>
<?php $this->widget('zii.widgets.CListView',array(

    'dataProvider'=>$dataProviderConcerts,

    'itemView'=>'//concert/_view_with_names',

)); ?>

