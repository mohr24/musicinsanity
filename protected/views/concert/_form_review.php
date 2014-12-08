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

  <!--  <p class="note">Fields with <span class="required">*</span> are required.</p>-->

    <?php echo $form->errorSummary($model); ?>

    <div class="row">
        <?php echo $form->labelEx($model,'rate'); ?>
        <?php echo $form->textField($model,'rate'); ?>
        <?php echo $form->error($model,'rate'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($model,'review'); ?>
        <?php echo $form->textField($model,'review',array('size'=>40,'maxlength'=>40)); ?>
        <?php echo $form->error($model,'review'); ?>
    </div>


    <div class="row buttons">
        <?php echo CHtml::submitButton('Save'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->