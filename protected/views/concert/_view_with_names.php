<?php
/* @var $this ConcertController */
/* @var $data Concert */
?>

<div class="view">

    <b><?php echo CHtml::encode('Date'); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data['cdate']), array('//concert/view', 'id'=>$data['cid'])); ?>
    <br />

    <b><?php echo CHtml::encode('Artist'); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data['aname']), array('//artist/view', 'id'=>$data['aid'])); ?>
    <br />

    <b><?php echo CHtml::encode('Venue'); ?>:</b>
    <?php echo CHtml::encode($data['vname']); ?>
    <br />

</div>