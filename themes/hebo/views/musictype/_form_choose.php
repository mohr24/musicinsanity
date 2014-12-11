<div class="form">

<?php
    $i=0;
    $form=$this->beginWidget('CActiveForm', array('id'=>'choose-form','enableAjaxValidation'=>false));
    ?>
<?php
    foreach ($types as $type) {
        $this->renderPartial('_form_choose', array('type'=>$type, 'lists'=>$lists,'form'=>$form, 'i'=>++$i));
        
    }
    
    ?>
<div class="row buttons">
<?php echo CHtml::submitButton('Choose'); ?>
</div>
<?php $this->endWidget(); ?>
</div><!-- form -->
<?php
        echo $form->labelEx($type,$type->type_name);
                $check=false;
                foreach ($lists as $list) {
                    if($list->type_name == $type->type_name){
                        echo $form->checkBox($type,'type_name',array('value'=>$type['type_name'], 'checked'=>true, 'uncheckValue'=>null));
                        $check=true;
                        break;
                    }
                }
                if($check == false){
                    echo $form->checkBox($type,'type_name',array('value'=>$type['type_name'], 'checked'=>false, 'uncheckValue'=>null));
                }
    ?>