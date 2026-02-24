<?php
/* @var $this FeedController */
/* @var $model AutoFeedVendor */

$this->breadcrumbs=array(
	'Auto Feed Vendors',
);
$this->menu=array(
	array('label'=>'Create List vendor', 'url'=>array('createvendor')),
);
?>
<h4>List Vendors</h4>
<?php
$buttons = array(
			'header'=>'Options',
			'class'=>'CButtonColumn','template'=>'{view} {update} {delete}',
			'buttons'=>array(
				'view'=>
					array(					
						'url'=>'Yii::app()->createUrl("businessloans/feeds/viewvendor", array("id"=>$data->id))',								
					),
				'update'=>
					array(
						'url'=>'Yii::app()->createUrl("businessloans/feeds/updatevendor", array("id"=>$data->id))',
					),
				'delete'=>
					array(
						'url'=>'Yii::app()->createUrl("businessloans/feeds/deletevendor", array("id"=>$data->id))',
					),
			),
		);
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'auto-feed-vendor-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'username',
		array(
			'class' => 'ext.editable.EditableColumn',
			 'filter' => array(1 =>'Global',0 => 'Local'),
			'name' => 'uniqueness',
			'editable' => array(
			'type' => 'select',
			'url' => $this->createUrl('autoFeedVendor/updateByData'),
			'source' => array(1 => 'Global', 0 => 'Local'),
			)
		),
		'dup_days',
		$buttons
	),
)); ?>
