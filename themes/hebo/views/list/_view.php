<?php
/* @var $this ListController */
/* @var $data ListModel */
?>

<div class="view">
	<h3><?php echo CHtml::encode("List Name: "); ?>
	<?php echo CHtml::link(CHtml::encode($data['lname']), array ('//list/view', 'id'=>$data['lid'])); ?>
    </h3>
</div>