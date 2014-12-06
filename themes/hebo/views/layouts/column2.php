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
<div id="sidebar">
<ul class="nav nav-list">
<li><a href="#">Home</a></li>
<li><a href= <?php echo $this->menu[0]['url'][0] ?> ><?php echo $this->menu[0]['label'] ?></a></li>
<li><a href="#">Edit Your Profile</a></li>
<li><a href="#">Search What You Want</a></li>
</ul>

<?php
    $this->beginWidget('zii.widgets.CPortlet', array(
                                                     'title'=>'Operations',
                                                     ));
    $this->widget('zii.widgets.CMenu', array(
                                             'items'=>$this->menu,
                                             'htmlOptions'=>array('class'=>'operations'),
                                             ));
    $this->endWidget();
    ?>
</div><!-- sidebar -->
    
  </div><!--/row-->
</div>
</section>


<?php $this->endContent(); ?>