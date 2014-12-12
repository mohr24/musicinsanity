<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
    $reputation=Yii::app()->user->reputation;
    if($reputation >= 5){
        $this->menu=array(array('label'=>'View Your Lists', 'url'=>array('/musicinsanity/index.php/list/index')), array('label'=>'Create User Concert', 'url'=>array('/musicinsanity/index.php/concert/createUser')));
    }
    else{
        $this->menu=array(array('label'=>'View Your Lists', 'url'=>array('/musicinsanity/index.php/list/index')));
    }
    //DEBUG
    $this->menu[]=array('label'=>'Choose the Genres You Like', 'url'=>array('/musicinsanity/index.php/musictype/chooseUser?uid='.Yii::app()->user->id));
?>
<h1>Upcoming Concerts</h1>
<?php $this->widget('zii.widgets.CListView',array(

    'dataProvider'=>$dataProviderConcerts,
    'itemView'=>'//concert/_view_with_names',

)); ?>
<h5 style='float:right'><a href="/musicinsanity/index.php/concert/index?future=true"> View All Upcoming Concerts</a></h5>
<br/>
<h1>Recent Concert Reviews</h1>
<?php $this->widget('zii.widgets.CListView',array(

    'dataProvider'=>$dataProviderReviews,
    'itemView'=>'//concert/_review_with_names',

)); ?>
<h5 style='float:right'><a href="/musicinsanity/index.php/concert/index?future=false"> View All Recent Concerts</a></h5>
<br/>
<h1>Recommended Concerts</h1>
<?php $this->widget('zii.widgets.CListView',array(

    'dataProvider'=>$dataProviderRecommendedConcerts,
    'itemView'=>'//concert/_view_with_names',

)); ?>
<h1>Artists You Might Like</h1>
<?php $this->widget('zii.widgets.CListView',array(

    'dataProvider'=>$dataProviderArtists,
    /*'columns'=>array( // this array should include the attributes you want to display
        'aname',
        'abio',
    ),*/
    'itemView'=>'//artist/_view',

)); ?>
