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

<div class="post_info">On   <b> <?php echo CHtml::encode($data['cdate']); ?></b>    By    <?php if($data['aid'] != null){ echo CHtml::link(CHtml::encode($data['aname']), array('//artist/view', 'id'=>$data['aid']));} else {echo CHtml::encode($data['aname']);} ?></div>
</div>

<div class="cleaner"></div>

<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/music/concert.jpg" alt="image" />

<p align="justify"><b><?php echo CHtml::encode('Venue'); ?>:</b>
<?php echo CHtml::encode($data['vname']); ?>
<br /> <b><?php echo CHtml::encode('City'); ?>:</b>
<?php echo CHtml::encode($data['city']); ?>
<br />
<?php echo CHtml::encode($data['cdescription']); ?>
</p>
<div class="accordion" id="accordion2">
<div class="accordion-group">
<div class="accordion-heading">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
Collapsible Group Item #1
</a>
</div>
<div id="collapseOne" class="accordion-body collapse in">
<div class="accordion-inner">
Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
</div>
</div>
</div>
<div class="accordion-group">
<div class="accordion-heading">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
Collapsible Group Item #2
</a>
</div>
<div id="collapseTwo" class="accordion-body collapse">
<div class="accordion-inner">
Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
</div>
</div>
</div>
<div class="accordion-group">
<div class="accordion-heading">
<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
Collapsible Group Item #3
</a>
</div>
<div id="collapseThree" class="accordion-body collapse">
<div class="accordion-inner">
Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad squid. 3 wolf moon officia aute, non cupidatat skateboard dolor brunch.
</div>
</div>
</div>
</div>
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