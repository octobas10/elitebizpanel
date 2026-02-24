<style>
    .table_wrapper {
        overflow: hidden;
        overflow-x: auto;
    }
    #Edu-feed-vendor-grid {
        width: 1080px;
    }
    #Edu-feed-vendor-grid table th {
        min-width: 120px;
    }
</style>
<?php
/* @var $this FeedController */
/* @var $model EduFeedVendor */

$this->breadcrumbs=array(
	'Edu Feed Vendors',
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
						'url'=>'Yii::app()->createUrl("edu/feeds/viewvendor", array("id"=>$data->id))',								
					),
				'update'=>
					array(
						'url'=>'Yii::app()->createUrl("edu/feeds/updatevendor", array("id"=>$data->id))',
					),
				'delete'=>
					array(
						'url'=>'Yii::app()->createUrl("edu/feeds/deletevendor", array("id"=>$data->id))',
					),
			),
		);
?>
    <div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">Vendor List</div>
</div>
<div class="portlet-content table_wrapper">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'Edu-feed-vendor-grid',
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
			'url' => $this->createUrl('updateByData'),
			'source' => array(1 => 'Global', 0 => 'Local'),
			)
		),
		'dup_days',
		$buttons
	),
)); ?>
        </div>
</div>
