<style>
    .odd>td {
        width: 78px;
    }
    .table_wrapper {
        overflow: hidden;
        overflow-x: auto;
    }
    #auto-affiliate-user-grid {
        width: 1080px;
    }
    #auto-affiliate-user-grid table th {
        min-width: 100px;
    }
    #auto-affiliate-user-grid table #auto-affiliate-user-grid_c2 {
        min-width: 180px;
    }
</style>
<?php
$this->breadcrumbs = array(
	'Affiliate User List'
);
$this->menu = array(
	array(
		'label' => 'Create New Affiliate User',
		'url' => array(
			'create',
		),
	),
	array(
		'label' => 'Affiliate Stats',
		'url' => array(
			'affiliatestats',
		),
	),
);
?>
<h4>Affiliate Users</h4>
    <div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">Affiliate User List</div>
</div>
<div class="portlet-content table_wrapper">
<?php
$this->widget('zii.widgets.grid.CGridView',array(
	'id' => 'auto-affiliate-user-grid',
	/*'dataProvider' => $dataProvider_affiliate,*/
	'dataProvider' => $model->search(),
	'filter' => $model,
	'columns' => array(
		'id',
		array(
			'name' => 'user_name',
			'value' => 'CHtml::link($data->user_name, "
http://www.higherlearningapp.com/?promo_code=".$data->id, array("target" => "_blank","style" => "border-bottom: dashed 1px #0088cc; text-decoration:none;"))',
			'type' => 'raw'
		),
		/*array(
			'class' => 'ext.editable.EditableColumn',
			'name' => 'password',
			'value' => '****',
			'editable' => array(
				'url' => $this->createUrl('affiliates/UpdateMd5Password'),
				'type' => 'text',
			)
		),*/
		array(
			'class' => 'ext.editable.EditableColumn',
			'name' => 'status',
			'filter' => $GLOBALS['status'],
			'editable' => array(
				'url' => $this->createUrl('affiliates/UpdateByData'),
				'type' => 'select',
				'source' => $GLOBALS['status']
			)
		),
		array(
			'class' => 'ext.editable.EditableColumn',
			'name' => 'cap_limit',
			'editable' => array(
				'url' => $this->createUrl('affiliates/UpdateByData')
			)
		),
		array(
			'class' => 'ext.editable.EditableColumn',
			'name' => 'margin',
			'editable' => array(
				'url' => $this->createUrl('affiliates/UpdateByData'),
				'type' => 'select',
				'source' => $model->margin_percent()
			)
		),
		array(
			'class' => 'ext.editable.EditableColumn',
			'name' => 'is_inorganic',
			'headerHtmlOptions' => array(
				'style' => 'width: 110px;'
			),
			'filter' => $GLOBALS['affiliate_type'],
			'editable' => array(
				'url' => $this->createUrl('affiliates/UpdateByData'),
				'type' => 'select',
				'source' => $GLOBALS['affiliate_type']
			)
		),
		array(
			'name' => 'bucket',
			'value' => function ($data){
				if($data['is_inorganic']){
					echo '-';
				}else{
					echo round($data['bucket'],2);
				}
			}
		),
		array(
			'class' => 'ext.editable.EditableColumn',
			'name' => 'bucket_limit',
			'editable' => array(
				'url' => $this->createUrl('affiliates/UpdateByData')
			)
		),
		array(
			'class' => 'CButtonColumn'
		)
	)
));
?>
        </div>
</div>

