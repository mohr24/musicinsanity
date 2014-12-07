<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
$this->menu=array(array('label'=>'View Your List', 'url'=>array('/musicinsanity/index.php/list/index')));
?>
<h1>Upcoming Concerts</h1>
<?php $this->widget('zii.widgets.CListView',array(

    'dataProvider'=>$dataProviderConcerts,
    'itemView'=>'//concert/_view_with_names',

)); ?>
<br/>
<h1>Recent Concert Reviews</h1>
<?php $this->widget('zii.widgets.CListView',array(

    'dataProvider'=>$dataProviderReviews,
    'itemView'=>'//concert/_view_with_names',

)); ?>
<br/>
<h1>Artists You Might Like</h1>
<?php $this->widget('zii.widgets.CListView',array(

    'dataProvider'=>$dataProviderArtists,
    /*'columns'=>array( // this array should include the attributes you want to display
        'aname',
        'abio',
    ),*/
    'itemView'=>'//artist/_view_short',

)); ?>
