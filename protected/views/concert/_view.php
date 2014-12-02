<?php
/* @var $this ConcertController */
/* @var $data Concert */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('cid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->cid), array('view', 'id'=>$data->cid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aid')); ?>:</b>
	<?php echo CHtml::encode($data->aid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('cdate')); ?>:</b>
	<?php echo CHtml::encode($data->cdate); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('vid')); ?>:</b>
	<?php echo CHtml::encode($data->vid); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('price')); ?>:</b>
	<?php echo CHtml::encode($data->price); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('availability')); ?>:</b>
	<?php echo CHtml::encode($data->availability); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('clink')); ?>:</b>
	<?php echo CHtml::encode($data->clink); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('cdescription')); ?>:</b>
	<?php echo CHtml::encode($data->cdescription); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('concert_tp')); ?>:</b>
	<?php echo CHtml::encode($data->concert_tp); ?>
	<br />

	*/ ?>

</div>