<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
        'Users'=>array('index'),
        $model->uid,
    );
if($is_user){
    $editProfile = array('label'=>'Edit your Profile', 'url'=>array('update?id='.$model->uid));
}
else if($follows){
    $followLink = array('label'=>'Unfollow User', 'url'=>array('unfollow?thisUser='.$model->uid));
}else{
    $followLink = array('label'=>'Follow User', 'url'=>array('follow?thisUser='.$model->uid));
}
$this->menu=array();
if(isset($followLink)){
    $this->menu[] = $followLink;
}
if(isset($editProfile)){
    $this->menu[] = $editProfile;
}

  /*  array('label'=>'List User', 'url'=>array('index')),
    array('label'=>'Create User', 'url'=>array('create')),
    array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->uid)),
    array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->uid),'confirm'=>'Are you sure you want to delete this item?')),
    array('label'=>'Manage User', 'url'=>array('admin')),*/

?>

    <h1><?php echo $model->uname; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
    'data'=>$model,
    'attributes'=>array(

        'uemail',
        'birthday',
        'city_residence',
        'reputation',

    ),
));?>
<br/>
<h2>Artists this user is a fan of</h2>
<?php $this->widget('zii.widgets.CListView',array(

    'dataProvider'=>$dataProviderArtists,
    /*'columns'=>array( // this array should include the attributes you want to display
        'aname',
        'abio',
    ),*/
    'itemView'=>'//artist/_view',

)); ?>

<br/>
<h1>Users this user is following</h1>
<?php $this->widget('zii.widgets.CListView',array(

    'dataProvider'=>$dataProviderFollowing,
    /*'columns'=>array( // this array should include the attributes you want to display
        'aname',
        'abio',
    ),*/
    'itemView'=>'_view',

)); ?>
<br/>
<h1>Concerts this user plans to attend</h1>
<?php $this->widget('zii.widgets.CListView',array(

    'dataProvider'=>$dataProviderFutureConcerts,
   /* 'columns'=>array( // this array should include the attributes you want to display
        'aname',
        'cdate',
        'vname',
    ),*/
    'itemView'=>'//concert/_view_with_names',

)); ?>
    <h1>Recently Attended Concerts</h1>
<?php $this->widget('zii.widgets.CListView',array(

    'dataProvider'=>$dataProviderPastConcerts,
    /* 'columns'=>array( // this array should include the attributes you want to display
         'aname',
         'cdate',
         'vname',
     ),*/
    'itemView'=>'//concert/_view_with_names',

)); ?>

    <br/>
    <h1>User's Lists</h1>
<?php $this->widget('zii.widgets.CListView',array(

    'dataProvider'=>$dataProviderLists,
    'itemView'=>'//list/_view',

)); ?>