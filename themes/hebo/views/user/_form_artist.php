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

    <?php echo $form->errorSummary($usermodel); ?>

    <div class="row">
        <?php echo $form->labelEx($usermodel,'Username'); ?>
        <?php echo $form->textField($usermodel,'uusername',array('size'=>20,'maxlength'=>20)); ?>
        <?php echo $form->error($usermodel,'uusername'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($usermodel,'Password'); ?>
        <?php echo $form->textField($usermodel,'upassword',array('size'=>10,'maxlength'=>10)); ?>
        <?php echo $form->error($usermodel,'upassword'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($artistmodel,'Band/Artist Name'); ?>
        <?php echo $form->textField($artistmodel,'aname',array('size'=>20,'maxlength'=>20)); ?>
        <?php echo $form->error($artistmodel,'aname'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($usermodel,'Email'); ?>
        <?php echo $form->textField($usermodel,'uemail',array('size'=>30,'maxlength'=>30)); ?>
        <?php echo $form->error($usermodel,'uemail'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($artistmodel,'Band Website'); ?>
        <?php echo $form->textField($artistmodel,'alink',array('size'=>40,'maxlength'=>40)); ?>
        <?php echo $form->error($artistmodel,'alink'); ?>
    </div>

    <div class="row">
        <?php echo $form->labelEx($artistmodel,'Biography'); ?>
        <?php echo $form->textField($artistmodel,'abio',array('size'=>100,'maxlength'=>100)); ?>
        <?php echo $form->error($artistmodel,'abio'); ?>
    </div>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Create'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->