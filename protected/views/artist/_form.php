<?php
/* @var $this ArtistController */
/* @var $model Artist */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'artist-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'ausername'); ?>
		<?php echo $form->textField($model,'ausername',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'ausername'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'apassword'); ?>
		<?php echo $form->textField($model,'apassword',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'apassword'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'aname'); ?>
		<?php echo $form->textField($model,'aname',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'aname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'aemail'); ?>
		<?php echo $form->textField($model,'aemail',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'aemail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'alink'); ?>
		<?php echo $form->textField($model,'alink',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'alink'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'abio'); ?>
		<?php echo $form->textField($model,'abio',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'abio'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'last_login_tp'); ?>
		<?php echo $form->textField($model,'last_login_tp'); ?>
		<?php echo $form->error($model,'last_login_tp'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->