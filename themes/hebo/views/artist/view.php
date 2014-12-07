<?php
/* @var $this ArtistController */
/* @var $model Artist */

$this->breadcrumbs=array(
	'Artists'=>array('index'),
	$model->aid,
);

if($follows){
    $followButton = array('label'=>'Unfollow Artist', 'url'=>array('unfollow','thisArtist'=>$model->aid));
}else{
    $followButton = array('label'=>'Become a Fan', 'url'=>array('follow','thisArtist'=>$model->aid));
}
$this->menu=array(
    $followButton,
	/*array('label'=>'List Artist', 'url'=>array('index')),
	array('label'=>'Create Artist', 'url'=>array('create')),
	array('label'=>'Update Artist', 'url'=>array('update', 'id'=>$model->aid)),
	array('label'=>'Delete Artist', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->aid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Artist', 'url'=>array('admin')),*/
);
?>

<h1><?php echo $model->aname; ?></h1>


<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(

		'aemail',
		'alink',
		'abio',
		//'last_login_tp',
	),
)); ?>
<br/>
<h1>Music Styles</h1>
<?php foreach($model->musictypes as $type){
    echo $type->type_name."\n";
}?>
<br/>
<h1>Upcoming Concerts</h1>
<?php $this->widget('zii.widgets.CListView',array(

    'dataProvider'=>$dataProviderUpcomingConcerts,
    /* 'columns'=>array( // this array should include the attributes you want to display
         'aname',
         'cdate',
         'vname',
     ),*/
    'itemView'=>'//concert/_view_with_names',

)); ?>
<h1>Recent Concert Reviews</h1>
<?php $this->widget('zii.widgets.CListView',array(

    'dataProvider'=>$dataProviderRecentReviews,
    /* 'columns'=>array( // this array should include the attributes you want to display
         'aname',
         'cdate',
         'vname',
     ),*/
    'itemView'=>'//concert/_view_with_names',

)); ?>
