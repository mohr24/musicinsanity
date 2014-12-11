<?php
/* @var $this UserController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Search MusicTypes',
);

$this->menu=array(
//	array('label'=>'Create User', 'url'=>array('create')),
//	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>
    <h1>Search Music Types</h1>
<form method="get">

    <?php

    foreach($allMusictypes as $type){
        echo '<input  style="margin-top:-1px" type="radio" name="type" value="'.$type->type_name.'"';
        if(isset($_GET['type']) && $_GET['type']== $type->type_name){
            echo ' checked';
        }
        echo ">   <b>".$type->type_name.'</b><br>';
    }?>
    <input type="submit" value="search" />
</form>

<?php if(isset($musictype)){?>

    <?php if($dataProviderArtists) { ?>
        <br/>
        <h1><?php echo $musictype->type_name; ?> Artists</h1>
        <?php $this->widget('zii.widgets.CListView', array(

            'dataProvider' => $dataProviderArtists,

            'itemView' => '//artist/_view',

        ));
    }?>
    <?php if($dataProviderConcerts) { ?>
        <br/>
        <h1><?php echo $musictype->type_name; ?> Concerts</h1>
        <?php $this->widget('zii.widgets.CListView',array(

            'dataProvider'=>$dataProviderConcerts,

            'itemView'=>'//concert/_view_with_names',

        ));
    }?>
<?php } ?>