<?php
/* @var $this ConcertController */
/* @var $data Concert */
?>

<div class="view">
<div class="post_box">
<div class="post_title">
<h2><?php if(isset($data['cname'])){
    echo CHtml::link(CHtml::encode($data['cname']), array('//concert/view', 'id'=>$data['cid']));
}
    else {
        echo 'An unname concert';
    }
?></h2>

<button class="btn" type="button" onclick="location.href='/musicinsanity/index.php/concert/attend?id=<?php echo $data[\'cid\']>&returl=home'">Attend</button>

<button class="btn" type="button" onclick="location.href='/musicinsanity/index.php/concert/attend?id=<?php echo $data[\'cid\']>&returl=home'">Add To List</button>

<div class="post_info">On   <b> <?php echo CHtml::encode($data['cdate']); ?></b>    By    <?php if($data['aid'] != null){ echo CHtml::link(CHtml::encode($data['aname']), array('//artist/view', 'id'=>$data['aid']));} else {echo CHtml::encode($data['aname']);} ?></div>
</div>

<div class="cleaner"></div>

<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/music/concert.jpg" alt="image" />

<p align="justify"><b><?php echo CHtml::encode('At'); ?>:</b>
<?php echo CHtml::encode($data['vname']); ?>    <b><?php echo CHtml::encode('In'); ?></b>
<?php echo CHtml::encode($data['city']); ?>
<br />
<?php if($data['clink'] != null){
    echo '<b>'.CHtml::encode("Buy Tick Here").': </b>'.
    CHtml::link(CHtml::encode($data['clink']), CHtml::encode($data['clink'])).
    '<br/>';
}?>
<?php echo CHtml::encode($data['cdescription']); ?>
</p>
<?php if(isset($data['attending'])){
    echo '<b>'.CHtml::encode("Attending?").': </b>'.
    CHtml::encode($data['attending']).
    '<br/>';
}?>
</div>

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
</div>