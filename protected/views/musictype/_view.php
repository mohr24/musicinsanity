<?php
/* @var $this MusictypeController */
/* @var $data Musictype */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('type_name')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->type_name), array('view', 'id'=>$data->type_name)); ?>
	<br />
<!--
	<b><?php// echo CHtml::encode($data->getAttributeLabel('major')); ?>:</b>
	<?php //echo CHtml::encode($data->major); ?>
	<br />

	<b><?php// echo CHtml::encode($data->getAttributeLabel('description')); ?>:</b>
	<?php// echo CHtml::encode($data->description); ?>
	<br />-->


</div>