<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">


    <b><?php echo CHtml::encode($data->getAttributeLabel('Name')); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data->uname), array('//user/view', 'id'=>$data->uid)); ?>
    <br />

    <b><?php echo CHtml::encode('City'); ?>:</b>
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
    <br />
</div>