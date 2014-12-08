<?php
/* @var $this ListController */
/* @var $model ListModel */

$this->breadcrumbs=array(
	'List Models'=>array('index'),
	$model->lid,
);

$this->menu=array(
	array('label'=>'List ListModel', 'url'=>array('index')),
	array('label'=>'Create ListModel', 'url'=>array('create')),
	array('label'=>'Update ListModel', 'url'=>array('update', 'id'=>$model->lid)),
	array('label'=>'Delete ListModel', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->lid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage ListModel', 'url'=>array('admin')),
);
?>

<h1> <?php echo $model->lname; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'lid',
		'lname',
		'uid',
	),
)); ?>
<br/>
<h1>Concerts in this List:</h1>
<?php $this->widget('zii.widgets.CListView',array(

    'dataProvider'=>$dataProviderConcerts,
    /* 'columns'=>array( // this array should include the attributes you want to display
         'aname',
         'cdate',
         'vname',
     ),*/
    'itemView'=>'//concert/_view_with_names',

)); ?>
<a href="<?php echo Yii::app()->getBaseUrl(true);?>/concert/index">Add concerts to this list</a>
