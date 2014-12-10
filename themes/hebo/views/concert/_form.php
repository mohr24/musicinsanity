<?php
/* @var $this ConcertController */
/* @var $model Concert */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'concert-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'Concert Name'); ?>
        <?php echo $form->textField($model,'cname'); ?>
        <?php echo $form->error($model,'cname'); ?>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'Concert Date'); ?>
		<?php echo $form->textField($model,'cdate'); ?>
		<?php echo $form->error($model,'cdate'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Location'); ?>
		<?php echo $form->dropDownList($model,'vid', CHtml::listData(Venue::model()->findAll(array('order' => 'vname ASC')), 'vid', 'vname'), array('empty'=>'Select location')); ?>
		<?php echo $form->error($model,'vid'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Ticket Price'); ?>
		<?php echo $form->textField($model,'price'); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'availability'); ?>
		<?php echo $form->textField($model,'availability'); ?>
		<?php echo $form->error($model,'availability'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Ticket Link'); ?>
		<?php echo $form->textField($model,'clink',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'clink'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'About Concert'); ?>
		<?php echo $form->textField($model,'cdescription',array('size'=>40,'maxlength'=>40)); ?>
		<?php echo $form->error($model,'cdescription'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->