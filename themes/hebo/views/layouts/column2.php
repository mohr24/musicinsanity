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
<li><a href= <?php echo $this->menu[0]['url'][0] ?> ><?php echo $this->menu[0]['label'] ?></a></li>
</ul>

</div><!-- sidebar -->
    
  </div><!--/row-->
</div>
</section>


<?php $this->endContent(); ?>