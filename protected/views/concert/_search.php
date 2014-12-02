<?php
/* @var $this ConcertController */
/* @var $model Concert */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>

	<div class="row">
		<?php echo $form->label($model,'cid'); ?>
		<?php echo $form->textField($model,'cid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'aid'); ?>
		<?php echo $form->textField($model,'aid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cdate'); ?>
		<?php echo $form->textField($model,'cdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'vid'); ?>
		<?php echo $form->textField($model,'vid'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'availability'); ?>
		<?php echo $form->textField($model,'availability'); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'clink'); ?>
		<?php echo $form->textField($model,'clink',array('size'=>20,'maxlength'=>20)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'cdescription'); ?>
		<?php echo $form->textField($model,'cdescription',array('size'=>40,'maxlength'=>40)); ?>
	</div>

	<div class="row">
		<?php echo $form->label($model,'concert_tp'); ?>
		<?php echo $form->textField($model,'concert_tp'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('Search'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- search-form -->