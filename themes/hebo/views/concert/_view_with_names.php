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

<?php
    //echo $data['cid'];
    if(isset($data['attending'])){
    if(strcmp ( $data['attending'], "No" )){
        echo CHtml::button('Unattend', array ('class'=>'btn btn-primary','style' => "margin-top: 20px", 'submit'=>$this->createUrl('concert/unattend',array('id'=>$data['cid'], 'return'=>"home"))));
    }
    else {
        echo CHtml::button('Attend', array ('class'=>'btn btn-primary','style' => "margin-top: 20px", 'submit'=>$this->createUrl('concert/attend',array('id'=>$data['cid'], 'return'=>"home"))));
    }
    }
    if(isset($data['artist'])){}
    else{
    if(isset($data['listing']) && $data['uid']==Yii::app()->user->getId()){
        echo CHtml::button('Remove', array ('class'=>'btn btn-primary','style' => "margin-top: 20px; margin-left: 10px", 'submit'=>$this->createUrl('list/remove',array('cid'=>$data['cid'], 'lid'=>$data['lid'], 'return'=>"/list/".$data['lid']))));
    }
    else{
        echo CHtml::button('Add to List', array ('class'=>'btn btn-primary','style' => "margin-top: 20px; margin-left: 10px", 'submit'=>$this->createUrl('list/add',array('cid'=>$data['cid'], 'return'=>"home"))));
    }
    }
    ?>

<div class="cleaner"></div>

<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/music/concert.jpg" alt="image" />

<p align="justify"><b><?php echo CHtml::encode('At'); ?>:</b>
<?php echo CHtml::encode($data['vname']); ?>    <b><?php echo CHtml::encode('In'); ?></b>
<?php echo CHtml::encode($data['city']); ?>
<br/>
<?php if($data['clink'] != null){
    echo '<b>'.CHtml::encode("Buy Tick Here").': </b>'.
    CHtml::link(CHtml::encode($data['clink']), CHtml::encode($data['clink']));
}?>
<br/>
<?php echo CHtml::encode($data['cdescription']); ?>
</p>
<?php
    if(isset($data['submitted_by_uid'])){
    $criteria=new CDbCriteria;
    $criteria->select='uname';
    $criteria->condition="uid=:uid";
    $criteria->params=array(':uid'=>$data['submitted_by_uid']);
    $record=User::model()->find($criteria);
    echo "<i style='float:right; color:#FF0000'>".CHtml::encode("Recommended By User").': '.
    CHtml::encode($record->uname)."</i><br/>";
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