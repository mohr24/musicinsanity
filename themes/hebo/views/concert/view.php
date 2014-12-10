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
    $attendLink = array('label'=>'Don\'t attend this concert', 'url'=>array('unattend?id='.$model->cid.'&return=page'));
}else{

    $attendLink = array('label'=>'Attend this concert', 'url'=>array('attend?id='.$model->cid.'&return=page'));
}
$this->menu=array();
if($past){
    $this->menu[] = array('label'=>'Review this concert', 'url'=>array('review?id='.$model->cid.'&return=page'));;
}
if(isset($attendLink)){
    $this->menu[] = $attendLink;
}
if(isset($editConcert)){
    $this->menu[] = $editConcert;
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

<h1><?php echo $model->cname; ?></h1>

<?php
    $types = array();
    foreach ($model->musictypes as $i => $value) {
        $types[$i] = $value->type_name;
    }
    $a = "No";
    if($model->availability){
        $a="Yes";
    }

    $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        array ( 'label'=>'Concert Time', 'value'=>$model->cdate ),
        array ( 'label'=>'Concert Location', 'value'=>$model->v->vname ),
        array ( 'label'=>'Ticket Price', 'value'=>$model->price ),
        array ( 'label'=>'Availability', 'value'=>$a ),
		array ( 'label'=>'Website', 'value'=>$model->clink ),
		array ( 'label'=>'About Concert', 'value'=>$model->cdescription ),
        array ( 'label'=>'Concert Music Type', 'type'=>'text', 'value'=>implode(", ", $types)),
		//'concert_tp',
	),
)); ?>
