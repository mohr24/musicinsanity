<?php
/* @var $this UserController */
/* @var $model User */

$this->breadcrumbs=array(
	'Users'=>array('index'),
	$model->uid,
);

$this->menu=array(
	array('label'=>'List User', 'url'=>array('index')),
	array('label'=>'Create User', 'url'=>array('create')),
	array('label'=>'Update User', 'url'=>array('update', 'id'=>$model->uid)),
	array('label'=>'Delete User', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->uid),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage User', 'url'=>array('admin')),
);
?>

<h1>View User #<?php echo $model->uid; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'uid',
		'uusername',
		'upassword',
		'uname',
		'uemail',
		'birthday',
		'city_residence',
		'reputation',
		'last_login_tp',
	),
));?>
<br/>
<h1>Artists this user is a fan of</h1>
<?php $this->widget('zii.widgets.CListView',array(

    'dataProvider'=>$dataProviderArtists,
    /*'columns'=>array( // this array should include the attributes you want to display
        'aname',
        'abio',
    ),*/
    'itemView'=>'//artist/_view',

)); ?>
<?php $this->widget('zii.widgets.grid.CGridView',array(

    'dataProvider'=>$dataProviderArtists,
    'columns'=>array( // this array should include the attributes you want to display
        'aname',
        'abio',
    ),


)); ?>
<table width = 500>
    <tr>
        <th> Artist Name</th>
        <th> Bio</th>
    </tr>

    <?php foreach ($model->artists as $artist): ?>
        <tr>
            <td><?= CHtml::encode("{$artist->aname}") ?></td>
            <td><?= CHtml::encode("{$artist->abio}") ?></td>
        </tr>
    <?php endforeach; ?>
</table>
<br/>
<h1>Users this user is following</h1>
<?php $this->widget('zii.widgets.CListView',array(

    'dataProvider'=>$dataProviderFollowing,
    /*'columns'=>array( // this array should include the attributes you want to display
        'aname',
        'abio',
    ),*/
    'itemView'=>'_view',

)); ?>
<br/>
<h1>Concerts this user plans to attend</h1>
<?php $this->widget('zii.widgets.grid.CGridView',array(

    'dataProvider'=>$dataProviderConcerts,
    'columns'=>array( // this array should include the attributes you want to display
        'cid',
        'aname',
        'cdate',
        'vname',
    ),

)); ?>
