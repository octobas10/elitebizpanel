<style>
.odd>td {
	width: 78px;
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
<?php
$this->widget('zii.widgets.grid.CGridView',array(
	'id' => 'auto-affiliate-user-grid',
	'dataProvider' => $dataProvider_affiliate,
	'columns' => array(
		'id',
		array(
			'name' => 'user_name',
			'value' => 'CHtml::link($data->user_name, "http://www.elitehealthinsurers.com?promo_code=".$data->id, array("target" => "_blank","style" => "border-bottom: dashed 1px #0088cc; text-decoration:none;"))',
			'type' => 'raw'
		),
		array(
			'class' => 'ext.editable.EditableColumn',
			'name' => 'password',
			'value' => 'Password',
			'editable' => array(
				'url' => $this->createUrl('affiliates/UpdateMd5Password'),
				'type' => 'text',
			)
		),
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
