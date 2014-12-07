<?php
/* @var $this ListController */
/* @var $data ListModel */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('lid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->lid), array('view', 'id'=>$data->lid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('lname')); ?>:</b>
	<?php echo CHtml::encode($data->lname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::encode($data->uid); ?>
	<br />


</div>