<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
    'Users'=>array('index'),
    'Create',
);

$this->menu=array(
//    array('label'=>'List User', 'url'=>array('index')),
//    array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

    <h1>Create Artist Account</h1>

<?php $this->renderPartial('_form_artist', array('usermodel'=>$usermodel, 'artistmodel'=>$artistmodel)); ?>