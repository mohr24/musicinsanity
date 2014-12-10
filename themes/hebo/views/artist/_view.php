<?php
    /* @var $this UserController */
    /* @var $data */
    ?>

<div class="view">

<div class="lbox">
<h2><span class="yellow">
<?php echo "Featured Artist: "; ?></span>
<?php echo CHtml::link(CHtml::encode($data->aname), array('//artist/view', 'id'=>$data->aid)); ?><?php
    if(isset($data['fan'])){
        if(strcmp($data['fan'], "No")){
            echo CHtml::button('Become Fan', array ('class'=>'btn btn-primary','style' => "margin-top: 20px", 'submit'=>$this->createUrl('fan',array('id'=>$data['aid']))));
        }
        else{
            echo CHtml::button('Not A Fan', array ('class'=>'btn btn-primary','style' => "margin-top: 20px", 'submit'=>$this->createUrl('unfan',array('id'=>$data['aid']))));
        }
    }?></h2>

<div class="thumb">
<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/music/artist.png" alt="user image" />
</div>

<p>
<b><?php echo CHtml::encode("Contact"); ?>:</b>
<?php echo CHtml::encode($data->aemail); ?>
<br/>
<b><?php echo CHtml::encode("About"); ?>:</b>
<?php echo CHtml::encode($data->abio); ?>
<br/>
<b><?php echo CHtml::encode($data->aname); ?> Music Types: </b>
<div id=<?php echo $data->aid; ?>>
<ul class="nav nav-list">
<?php
    if(isset($data->musictypes)){
        foreach ($data->musictypes as $i=>$value) {
            //echo $value["label"];
            //echo "Key: $i; Value: $value['label']<br />\n";
            if($i < 3){
            //echo "<li><a href=/musicinsanity/index.php/concert/" . $value['cid'] . ">" . $value['cdate'] . "</a></li>";
              echo "<li>" . $value->type_name . "</li>";
            }
        }
    }
    ?>
</ul>
</div>
</p>
</div>
<b><?php echo CHtml::encode("Band Website: "); ?>:</b>
<?php echo CHtml::encode($data->alink); ?>
<br />
<br/>
</div>