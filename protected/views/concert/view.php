<?php
/* @var $this ConcertController */
/* @var $model Concert */

$this->breadcrumbs=array(
	'Concerts'=>array('index'),
	$model->cid,
);

if($is_artist){
    $editConcert = array('label'=>'Edit this concert', 'url'=>array('update?id='.$model->cid));
}
else if($attending){
    $attendLink = array('label'=>'Attend this concert', 'url'=>array('attend?id='.$model->cid.'&return=page'));
}else{
    $attendLink = array('label'=>'Don\'t attend this concert', 'url'=>array('unattend?id='.$model->cid.'&return=page'));
}
$this->menu=array();
if(isset($attendLink)){
    $this->menu[] = $attendLink;
}
if(isset($editConcert)){
    $this->menu[] = $editConcert;
}
if($past){
    $this->menu[] = array('label'=>'Review this concert', 'url'=>array('review?id='.$model->cid.'&return=page'));;
}
/*
$this->menu=array(
	array('label'=>'List Concert', 'url'=>array('index')),
	array('label'=>'Create Concert', 'url'=>array('create')),
	array('label'=>'Update Concert', 'url'=>array('update', 'id'=>$model->cid)),
	array('label'=>'Delete Concert', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->cid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Concert', 'url'=>array('admin')),
);*/
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
