<?php
/* @var $this AutoFeedVendorController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Auto Feed Vendors',
);
$this->menu=array(
	array('label'=>'Create List vendor', 'url'=>array('createlender')),
);
?>
<h4>List Vendors</h4>
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
			//we need not to set value, it will be auto-taken from source
			//'headerHtmlOptions' => array('style' => 'width: 60px'),
			'editable' => array(
			'type' => 'select',
			'url' => $this->createUrl('autoFeedVendor/updateByData'),
			'source' => array(1 => 'Global', 0 => 'Local'),
			)
		),
		'dup_days',
		/*'first_name',
		'last_name',
		
		'email',
		'company_name',
		'phone',
		'createdAt',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
