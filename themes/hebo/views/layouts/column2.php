<?php /* @var $this Controller */ ?>
<?php $this->beginContent('//layouts/main'); ?>
<section class="main-body">
  <div class="container">
  <div class="row-fluid">
	
    <div class="span8">
        <!-- Include content pages -->
        <?php echo $content; ?>
	</div><!--/span-->

<div class="span3">
<h3>Operation Bar</h3>
<div id="sidebar">
<ul class="nav nav-list">
<?php
    foreach ($this->menu as $i=>$value) {
        //echo $value["label"];
        //echo "Key: $i; Value: $value['label']<br />\n";
      echo "<li><a href=" . $value['url'][0] . ">" . $value["label"] . "</a></li>";
    }
    if(isset(Yii::app()->user->id)){
    if(isset(Yii::app()->user->artist) and Yii::app()->user->artist){
        echo "<li><a href=".Yii::app()->getBaseUrl(true) . "/index.php/concert/create?aid=". Yii::app()->user->aid . ">Create a concert</a></li>";
    }else{
        echo "<li><a href=".Yii::app()->getBaseUrl(true) . "/index.php/list/create?uid=". Yii::app()->user->getId() . ">Create a List</a></li>";

    }
    if(isset(Yii::app()->user->artist) and Yii::app()->user->artist){
        echo "<li><a href=".Yii::app()->getBaseUrl(true) . "/index.php/artist/". Yii::app()->user->aid . ">View Your Profile</a></li>";
    }else{
        echo "<li><a href=".Yii::app()->getBaseUrl(true) . "/index.php/user/". Yii::app()->user->getId() . ">View Your Profile</a></li>";
        
    }
    }
    ?>

</ul>
</div><!-- sidebar -->
    
  </div><!--/row-->
</div>
</section>


<?php $this->endContent(); ?>