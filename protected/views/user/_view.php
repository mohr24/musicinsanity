<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('uid')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->uid), array('view', 'id'=>$data->uid)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uusername')); ?>:</b>
	<?php echo CHtml::encode($data->uusername); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('upassword')); ?>:</b>
	<?php echo CHtml::encode($data->upassword); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uname')); ?>:</b>
	<?php echo CHtml::encode($data->uname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('uemail')); ?>:</b>
	<?php echo CHtml::encode($data->uemail); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('birthday')); ?>:</b>
	<?php echo CHtml::encode($data->birthday); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('city_residence')); ?>:</b>
	<?php echo CHtml::encode($data->city_residence); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('reputation')); ?>:</b>
	<?php echo CHtml::encode($data->reputation); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_login_tp')); ?>:</b>
	<?php echo CHtml::encode($data->last_login_tp); ?>
	<br />

	*/ ?>

</div>