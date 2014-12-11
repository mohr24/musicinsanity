<?php
/* @var $this UserController */
/* @var $data User */
?>

<div class="view">

<div class="lbox">
<h2><span class="yellow">
<?php if($data->reputation < 3) {echo "Junior User: ";}  elseif ($data->reputation < 7) {echo "Senior User: ";} else {echo "Insane User: ";}?></span>
<?php echo CHtml::link(CHtml::encode($data->uname), array('view', 'id'=>$data->uid)); ?><?php
    if(isset($data['following'])){
        if(strcmp($data['following'], "No")){
        echo CHtml::button('Follow', array ('class'=>'btn btn-primary','style' => "margin-top: 20px", 'submit'=>$this->createUrl('follow',array('id'=>$data['cid']))));
        }
        else{
        echo CHtml::button('Unfollow', array ('class'=>'btn btn-primary','style' => "margin-top: 20px", 'submit'=>$this->createUrl('unfollow',array('id'=>$data['cid']))));
        }
    }?></h2>

<div class="thumb">
<img src="<?php echo Yii::app()->theme->baseUrl;?>/img/music/user.png" alt="user image" />
</div>

<p><b><?php echo CHtml::encode("Gender: "); ?></b><?php if($data->gender != null){ if($data->gender == 1){echo CHtml::encode("Female");} else{echo CHtml::encode("Female");} }else {echo CHtml::encode("Secret");} ?> &nbsp <b><?php echo CHtml::encode("Born At: "); ?></b><?php if($data->birthday) {echo CHtml::encode($data->birthday);} else {echo CHtml::encode("Secret");}?><b>&nbsp&nbsp

<?php echo CHtml::encode("From City: "); ?></b><?php if($data->city_residence){ echo CHtml::encode($data->city_residence);} else { echo CHtml::encode("Secret");}?> </br>
<b><?php echo CHtml::encode("Contact"); ?>:</b>
<?php echo CHtml::encode($data->uemail); ?>
<br/>
<b><?php echo CHtml::encode($data->uname); ?> Music Types: </b>
<div id=<?php echo $data->uid; ?>>
<ul class="nav nav-list">
<?php
    if(isset($data->musictypes)){
    foreach ($data->musictypes as $i=>$value) {
        //echo $value["label"];
        //echo "Key: $i; Value: $value['label']<br />\n";
        if ($i < 3){
        //echo "<li><a href=/musicinsanity/index.php/list/" . $value['lid'] . ">" . $value['lname'] . "</a></li>";
            echo "<li>" . $value->type_name . "</li>";
        }
    }
    }
    ?>
</ul>
</div>
</p>
</div>
<b><?php echo CHtml::encode("Last Online: "); ?>:</b>
<?php echo CHtml::encode($data->last_login_tp); ?>
<br />
<br/>
</div>