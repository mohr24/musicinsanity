<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Search Concerts',
);

$this->menu=array(
//	array('label'=>'Create User', 'url'=>array('create')),
//	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>Search Concerts</h1>

<form method="get">
    <input type="search" placeholder="concert name" name="name" value="<?php echo isset($_GET['name']) ? CHtml::encode($_GET['name']) : '' ; ?>" /><br/>
    <input type="search" placeholder="artist name" name="artist" value="<?php echo isset($_GET['artist']) ? CHtml::encode($_GET['artist']) : '' ; ?>" /><br/>
    <input type="search" placeholder="city" name="city" value="<?php echo isset($_GET['city']) ? CHtml::encode($_GET['city']) : '' ; ?>" /><br/>
    <br/>
    Between:<br/>
    <input type="search" placeholder="start date (yyyy-mm-dd)" name="startdate" value="<?php echo isset($_GET['startdate']) ? CHtml::encode($_GET['startdate']) : '' ; ?>" /><br/>
    <input type="search" placeholder="end date (yyyy-mm-dd)" name="enddate" value="<?php echo isset($_GET['enddate']) ? CHtml::encode($_GET['enddate']) : '' ; ?>" /><br/>
    <input type="submit" value="search" />
</form>


<?php if(isset($dataProvider)){
    if($artist){
        $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'//concert/_view_artists',
        ));
    }else{
        $this->widget('zii.widgets.CListView', array(
            'dataProvider'=>$dataProvider,
            'itemView'=>'//concert/_view_with_names',
        ));
    }

}?>
