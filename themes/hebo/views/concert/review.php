<?php
/* @var $this ConcertController */
/* @var $model Concert */

$this->menu=array(
//    array('label'=>'List Concert', 'url'=>array('index')),
//    array('label'=>'Create Concert', 'url'=>array('create')),
//    array('label'=>'View Concert', 'url'=>array('view', 'id'=>$model->cid)),
//    array('label'=>'Manage Concert', 'url'=>array('admin')),
);
?>

    <h1>Review <?php echo "'".$cname."'"; ?></h1>

<?php $this->renderPartial('_form_review', array('model'=>$model)); ?>