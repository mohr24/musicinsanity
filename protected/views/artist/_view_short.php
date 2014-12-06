<?php
/* @var $this ArtistController */
/* @var $data Artist */
?>

<div class="view">


    <b><?php echo CHtml::encode($data->getAttributeLabel('aname')); ?>:</b>
    <?php echo CHtml::encode($data->aname); ?>
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