<?php
/* @var $this ArtistController */
/* @var $model Artist */

$this->breadcrumbs=array(
	'Artists'=>array('index'),
	$model->aid,
);

if($follows){
    $followButton = array('label'=>'Unfollow Artist', 'url'=>array('unfollow?thisArtist='.$model->aid));
}else{
    $followButton = array('label'=>'Become a Fan', 'url'=>array('follow?thisArtist='.$model->aid));
}
$this->menu=array();
if(Yii::app()->user->id != $model->aid){
        $this->menu=array(
                          $followButton,
	/*array('label'=>'List Artist', 'url'=>array('index')),
	array('label'=>'Create Artist', 'url'=>array('create')),
	array('label'=>'Update Artist', 'url'=>array('update', 'id'=>$model->aid)),
	array('label'=>'Delete Artist', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->aid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Artist', 'url'=>array('admin')),*/
                          );
    }
    else{
        $this->menu=array(array('label'=>'Edit Your Profile', 'url'=>array('//user/update?id='.$model->aid)));

    }
?>

<h1><?php if($model->aid == Yii::app()->user->id) {echo "Your";} else{echo $model->aname."'s";} ?> Profile</h1>



<?php
    $types = array();
    foreach ($model->musictypes as $i => $value) {
        $types[$i] = $value->type_name;
    }
    $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        array ( 'label'=>'Contact', 'value'=>$model->aemail ),
        array ( 'label'=>'Website', 'value'=>$model->alink ),
        array ( 'label'=>'Band Bio', 'value'=>$model->abio ),
        array ( 'label'=>'Playing Music Type', 'type'=>'text', 'value'=>implode(", ", $types)),
		//'last_login_tp',
	),
)); ?>
<br/>
<h1><?php if($model->aid == Yii::app()->user->id) {echo "Your";} else{echo $model->aname."'s";} ?> Upcoming Concerts</h1>
<?php $this->widget('zii.widgets.CListView',array(

    'dataProvider'=>$dataProviderUpcomingConcerts,
    /* 'columns'=>array( // this array should include the attributes you want to display
         'aname',
         'cdate',
         'vname',
     ),*/
    'itemView'=>'//concert/_view_with_names',

)); ?>
<h1><?php if($model->aid == Yii::app()->user->id) {echo "Your";} else{echo CHtml::encode($model->aname."'s");} ?> Recent Concert Reviews</h1>
<?php
if($artist){
    $itemView = '//concert/_review_artists';
}else{
    $itemView = '//concert/_review_with_names';
}
$this->widget('zii.widgets.CListView',array(

    'dataProvider'=>$dataProviderRecentReviews,
    /* 'columns'=>array( // this array should include the attributes you want to display
         'aname',
         'cdate',
         'vname',
     ),*/
    'itemView'=>$itemView,

)); ?>
