<?php
/* @var $this SiteController */

$this->pageTitle=Yii::app()->name;
?>

<h1>Upcoming Concerts</h1>
<?php $this->widget('zii.widgets.grid.CGridView',array(

    'dataProvider'=>$dataProviderConcerts,
    'columns'=>array( // this array should include the attributes you want to display
        'aname',
        'cdate',
        'vname',
        'attending',
    ),

)); ?>
<br/>
<h1>Recent Concert Reviews</h1>
<?php $this->widget('zii.widgets.grid.CGridView',array(

    'dataProvider'=>$dataProviderReviews,
    'columns'=>array( // this array should include the attributes you want to display
        'aname',
        'cdate',
        'vname',
        'uname',
        'rate',
        'review',
    ),

)); ?>
<br/>
<h1>Artists You Might Like</h1>
<?php $this->widget('zii.widgets.CListView',array(

    'dataProvider'=>$dataProviderArtists,
    /*'columns'=>array( // this array should include the attributes you want to display
        'aname',
        'abio',
    ),*/
    'itemView'=>'//artist/_view',

)); ?>
