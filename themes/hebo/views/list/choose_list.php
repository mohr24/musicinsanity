<?php
/* @var $this ListController */
/* @var $model ListModel */

$this->breadcrumbs=array(
    'List Models'=>array('index'),
    'Chose List',
);

/*$this->menu=array(
    array('label'=>'List ListModel', 'url'=>array('index')),
    array('label'=>'Manage ListModel', 'url'=>array('admin')),
);*/
?>

    <h1>Choose List</h1>

<?php $this->renderPartial('_form_choose', array('concertList'=>$concertList,'lists'=>$lists)); ?>