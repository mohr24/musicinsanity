<?php
/* @var $this UserController */
/* @var $model User */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'Username'); ?>
		<?php echo $form->textField($model,'uusername',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'uusername'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Password'); ?>
		<?php echo $form->textField($model,'upassword',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'upassword'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Name'); ?>
		<?php echo $form->textField($model,'uname',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'uname'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Email'); ?>
		<?php echo $form->textField($model,'uemail',array('size'=>30,'maxlength'=>30)); ?>
		<?php echo $form->error($model,'uemail'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'Birthday'); ?>
		<?php echo $form->textField($model,'birthday'); ?>
		<?php echo $form->error($model,'birthday'); ?>
	</div>

    <div class="row">
    <?php echo $form->labelEx($model,'Gender'); ?>
    <?php echo $form->radioButton($model,'gender', array('value'=>0, 'uncheckValue'=>null)) .' Male '; ?>
    <?php echo $form->radioButton($model,'gender', array('value'=>1, 'uncheckValue'=>null)) . ' Female '; ?>
    <?php echo $form->radioButton($model,'gender', array('value'=>null, 'uncheckValue'=>null)) . ' Secret '; ?>
    <?php echo $form->error($model,'gender'); ?>
    <br>
    <br>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'City of Residence'); ?>
		<?php echo $form->textField($model,'city_residence',array('size'=>20,'maxlength'=>20)); ?>
		<?php echo $form->error($model,'city_residence'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->