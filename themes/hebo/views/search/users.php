<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Search User',
);

$this->menu=array(
//	array('label'=>'Create User', 'url'=>array('create')),
//	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>Search Users</h1>

<form method="get">
    <input type="search" placeholder="search" name="name" value="<?php echo isset($_GET['name']) ? CHtml::encode($_GET['name']) : '' ; ?>" />
    <input type="submit" value="search" />
</form>


<?php if(isset($dataProvider)){
    $this->widget('zii.widgets.CListView', array(
        'dataProvider'=>$dataProvider,
        'itemView'=>'//user/_view',
    ));
}?>
