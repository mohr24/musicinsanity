<?php
/* @var $this ListController */
/* @var $model ListModel */
$this->breadcrumbs=array(
    'List Models'=>array('index'),
    'Chose List',
);

/*$this->menu=array(
    array('label'=>'List ListModel', 'url'=>array('index')),
    array('label'=>'Manage ListModel', 'url'=>array('admin')),
);*/
?>

<h1>Choose Music Types</h1>

<div class="form">
<?php echo CHtml::beginForm(); ?>
<?php foreach($types as $i=>$type): ?>
<?php
    //echo $form->labelEx($type,$type->type_name);
    echo "<div class='row'>";
    $check=false;
    foreach ($lists as $list) {
        if($list->type_name == $type->type_name){
            echo CHtml::activeCheckBox($type,'type_name',array('value'=>$type['type_name'], 'name'=>'Musictype['.$i.'][type_name]', 'checked'=>true, 'uncheckValue'=>"No", 'style'=>"margin-top: -3px; margin-right: 10px;"));
            echo CHtml::encode($type->type_name);
            echo "<br/>";
            $check=true;
            break;
        }
    }
    if($check == false){
        echo CHtml::activeCheckBox($type,'type_name',array('value'=>$type['type_name'], 'name'=>'Musictype['.$i.'][type_name]', 'checked'=>false, 'uncheckValue'=>"No",'style'=>"margin-top: -3px; margin-right: 10px;"));
        echo CHtml::encode($type->type_name);
        echo "<br/>";
        $check=true;
    }
    echo "</div>";
    ?>

<?php endforeach; ?>

<?php echo CHtml::submitButton('Save'); ?>
<?php echo CHtml::endForm(); ?>
</div><!-- form -->

