<?php
/* @var $this ConcertController */
/* @var $data Concert */
?>

<div class="view">

    <b><?php echo CHtml::encode('Date'); ?>:</b>
    <?php echo CHtml::link(CHtml::encode($data['cdate']), array('//concert/view', 'id'=>$data['cid'])); ?>
    <br />

    <?php if(isset($data['aname'])){
        echo '<b>'.CHtml::encode("Artist").': </b>'.
        CHtml::link(CHtml::encode($data['aname']), array('//artist/view', 'id'=>$data['aid'])).
        '<br/>';
    }?>


    <b><?php echo CHtml::encode('Venue'); ?>:</b>
    <?php echo CHtml::encode($data['vname']); ?>
    <br />

    <b><?php echo CHtml::encode('City'); ?>:</b>
    <?php echo CHtml::encode($data['city']); ?>
    <br />

    <?php if(isset($data['uname'])){
        echo '<b>'.CHtml::encode("Name").': </b>'.
            CHtml::link(CHtml::encode($data['uname']), array('//user/view', 'id'=>$data['uid'])).
            '<br/>';
    }?>

    <?php if(isset($data['rate'])){
        echo '<b>'.CHtml::encode("Rating").': </b>'.
            CHtml::encode($data['rate']).
            '<br/>';
    }?>

    <?php if(isset($data['review'])){
        echo '<b>'.CHtml::encode("Review").': </b>'.
            CHtml::encode($data['review']).
            '<br/>';
    }?>

    <?php if(isset($data['attending'])){
        echo '<b>'.CHtml::encode("Attending?").': </b>'.
            CHtml::encode($data['attending']).
            '<br/>';
    }?>

    <br />
</div>