<?php
/* @var $this ConcertController */
/* @var $data Concert */
?>

<div class="view">
<div class="post_box">
<div class="post_title">
<h2><?php if(isset($data['cid'])){
    echo CHtml::link(CHtml::encode($data['cname']), array('//concert/view', 'id'=>$data['cid']));
}
    else {
        echo 'An unname concert';
    }
?></h2>

<div class="post_info">On   <b> <?php echo CHtml::encode($data['cdate']); ?></b>    <?php if(isset($data['aid'])){ echo ' By '.CHtml::link(CHtml::encode($data['aname']), array('//artist/view', 'id'=>$data['aid']));}  ?></div>
</div>

<div class="cleaner"></div>

<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/music/concert.jpg" alt="image" />

<p align="justify"><b><?php echo CHtml::encode('At'); ?>:</b>
<?php echo CHtml::encode($data['vname']); ?>    <b><?php echo CHtml::encode('In'); ?></b>
<?php echo CHtml::encode($data['city']); ?>
<br/>
<?php echo CHtml::encode($data['cdescription']); ?>
</p>
<?php if(isset($data['attending'])){
    echo '<b>'.CHtml::encode("Plan to Attend? ").': </b>'.
    CHtml::encode($data['attending']).
    '<br/>';
}?>

</div>
</div>