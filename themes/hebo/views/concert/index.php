<?php
/* @var $this ConcertController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Concerts',
);

$this->menu=array(
//	array('label'=>'Create Concert', 'url'=>array('create')),
//	array('label'=>'Manage Concert', 'url'=>array('admin')),
);
?>

<h1><?php if(isset($_GET['future'])){
        if($_GET['future']=="true"){
            echo "Future ";
        }else{
            echo "Recent ";
        }
    }?>Concerts</h1>

<?php
if($artist){
    $itemView = '_view_artists';
}else{
    $itemView = '_view_with_names';
}
$this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProviderConcerts,
	'itemView'=>$itemView,
)); ?>
