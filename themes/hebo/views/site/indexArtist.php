<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$this->menu[]=array('label'=>'Edit the musicType', 'url'=>array('/musicinsanity/index.php/musictype/chooseArtist?aid='.Yii::app()->user->id));
    ?>
<h1>Upcoming Concerts</h1>
<?php $this->widget('zii.widgets.CListView',array(

    'dataProvider'=>$dataProviderConcerts,
    'itemView'=>'//concert/_view_artists',

)); ?>
<h5 style='float:right'><a href="/musicinsanity/index.php/concert/index?future=true"> View All Upcoming Concerts</a></h5>
<br/>
<h1>Recent Concert Reviews</h1>
<?php $this->widget('zii.widgets.CListView',array(

    'dataProvider'=>$dataProviderReviews,
    'itemView'=>'//concert/_review_artists',

)); ?>
<h5 style='float:right'><a href="/musicinsanity/index.php/concert/index?future=false"> View All Recent Concerts</a></h5>
<br/>
<h1>Artists your fans also liked</h1>
<?php $this->widget('zii.widgets.CListView',array(

    'dataProvider'=>$dataProviderArtists,
    /*'columns'=>array( // this array should include the attributes you want to display
        'aname',
        'abio',
    ),*/
    'itemView'=>'//artist/_view',

)); ?>
