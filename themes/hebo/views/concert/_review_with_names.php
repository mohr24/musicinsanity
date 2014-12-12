<?php
/* @var $this ConcertController */
/* @var $data Concert */
?>

<div class="view">
<div class="post_box">
<div class="post_title">
<h2><?php if(isset($data['cname'])){
    echo CHtml::link(CHtml::encode($data['cname']), array('//concert/view', 'id'=>$data['cid']));
        echo "<i style='float:right; margin-right: 10px; color: #CC0000; font-size: 60%;'>".CHtml::encode("Rating").": ". CHtml::encode($data['rate']) ."/10</i>";
}
    else {
        echo "An unname concert";
        echo "<i style='float:right; margin-right: 10px; color: #CC0000; font-size: 60%;'>".CHtml::encode("Rating").": ". CHtml::encode($data['rate']) ."/10</i>";
    }
?></h2>

<div class="post_info">   On   <b><?php echo CHtml::encode($data['cdate']); ?></b>   By   <?php if($data['uid'] != null){ echo CHtml::link(CHtml::encode($data['uname']), array('//user/view', 'id'=>$data['uid']));} else {echo CHtml::encode($data['uname']);} ?>     With    <?php if($data['aid'] != null){ echo CHtml::link(CHtml::encode($data['aname']), array('//artist/view', 'id'=>$data['aid']));} else {echo CHtml::encode($data['aname']);} ?></div>
</div>

<?php
    //echo $data['cid'];
    if(isset($data['reviewed'])){
        if(strcmp ( $data['reviewed'], "Yes" )){
            echo CHtml::button('Add My Review', array ('class'=>'btn btn-primary','style' => "margin-top: 20px;", 'submit'=>$this->createUrl('concert/review',array('id'=>$data['cid'], 'return'=>substr(Yii::app()->request->url, strlen(Yii::app()->baseUrl))))));
        }
        else {
        }
    }
    ?>

<div class="cleaner"></div>

<p align="justify"><b><?php echo CHtml::encode('At'); ?>:</b>
<?php echo CHtml::encode($data['vname']); ?>    <b><?php echo CHtml::encode('In'); ?></b>
<?php echo CHtml::encode($data['city']); ?>
<br/>
<br/>
<?php if(isset($data['review'])){
    echo '<b>'.CHtml::encode("How is the concert").': </b>'.
    CHtml::encode($data['review']);
}?>
</p>

</div>

</div>