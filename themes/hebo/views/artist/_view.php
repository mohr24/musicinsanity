<?php
/* @var $this ArtistController */
/* @var $data Artist */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('aid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->aid), array('view', 'id'=>$data->aid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ausername')); ?>:</b>
	<?php echo CHtml::encode($data->ausername); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('apassword')); ?>:</b>
	<?php echo CHtml::encode($data->apassword); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aname')); ?>:</b>
	<?php echo CHtml::encode($data->aname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('aemail')); ?>:</b>
	<?php echo CHtml::encode($data->aemail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('alink')); ?>:</b>
	<?php echo CHtml::encode($data->alink); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('abio')); ?>:</b>
	<?php echo CHtml::encode($data->abio); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('last_login_tp')); ?>:</b>
	<?php echo CHtml::encode($data->last_login_tp); ?>
	<br />

	*/ ?>

</div>