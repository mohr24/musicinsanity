<?php
/* @var $this ListController */
/* @var $model ListModel */

$this->breadcrumbs=array(
	'List Models'=>array('index'),
	$model->lid,
);

$this->menu=array(
//	array('label'=>'List ListModel', 'url'=>array('index')),
//	array('label'=>'Create ListModel', 'url'=>array('create')),
//	array('label'=>'Update ListModel', 'url'=>array('update', 'id'=>$model->lid)),
//	array('label'=>'Delete ListModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->lid),'confirm'=>'Are you sure you want to delete this item?')),
//	array('label'=>'Manage ListModel', 'url'=>array('admin')),
);
?>

<h1>List: <?php  echo $model->lname; ?></h1>

<h3>Created by <?php  echo $model->user->uname; ?></h3>
<?php $this->widget('zii.widgets.CListView',array(

    'dataProvider'=>$dataProviderConcerts,
    /* 'columns'=>array( // this array should include the attributes you want to display
         'aname',
         'cdate',
         'vname',
     ),*/
    'itemView'=>'//concert/_view_with_names',

)); ?>
<?php
    echo CHtml::button('Add concerts to this list', array ('class'=>'btn btn-primary','style' => "margin-top: 20px;", 'submit'=>$this->createUrl('concert/index?future=true')));?>