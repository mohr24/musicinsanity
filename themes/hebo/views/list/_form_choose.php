<?php
/* @var $this ListController */
/* @var $model ListModel */
/* @var $form CActiveForm */
?>

<div class="form">

    <?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'choose-list-form',
        // Please note: When you enable ajax validation, make sure the corresponding
        // controller action is handling ajax validation correctly.
        // There is a call to performAjaxValidation() commented in generated controller code.
        // See class documentation of CActiveForm for details on this.
        'enableAjaxValidation'=>false,
    )); ?>

    <?php echo $form->errorSummary($concertList); ?>
    <?php foreach($lists as $list){?>
        <div class="row">
            <?php echo $form->labelEx($concertList,$list->lname); ?>
            <?php echo $form->radioButton($concertList,'lid',array('value'=>$list->lid,'uncheckValue'=>null));?>
            <?php echo $form->error($concertList,'lid'); ?>
        </div>
</br>
    <?php } ?>

    <div class="row buttons">
        <?php echo CHtml::submitButton('Choose'); ?>
    </div>

    <?php $this->endWidget(); ?>

</div><!-- form -->