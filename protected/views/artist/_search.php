<?php
/* @var $this ArtistController */
/* @var $model Artist */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'aid'); ?>
		<?php echo $form->textField($model,'aid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'ausername'); ?>
		<?php echo $form->textField($model,'ausername',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'aname'); ?>
		<?php echo $form->textField($model,'aname',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'aemail'); ?>
		<?php echo $form->textField($model,'aemail',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'alink'); ?>
		<?php echo $form->textField($model,'alink',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'abio'); ?>
		<?php echo $form->textField($model,'abio',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'last_login_tp'); ?>
		<?php echo $form->textField($model,'last_login_tp'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->