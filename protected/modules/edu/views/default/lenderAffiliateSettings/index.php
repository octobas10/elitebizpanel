<?php
/* @var $this LenderAffiliateSettingsController */
/* @var $dataProvider CActiveDataProvider */
$this->breadcrumbs=array(
	'Lender Affiliate Setting',
);
$this->menu=array(
		array('label'=>'Create Lender Affiliate Setting', 'url'=>array('create')),
	);

$this->beginWidget('zii.widgets.CPortlet', array('title'=>"Affiliate Lender Setting List",));
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'lender-affiliate-settings-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		array('name'=>'id','headerHtmlOptions' => array('style' => 'width: 60px')),
		array(
            'name' => 'affiliate_user_id',
            'value' => '$data->affiliate->user_name',
	    ),
		array(
            'name' => 'lender_details_id',
            'value' => '$data->lender_details->user_name',
	    ),
		array(
			'class' => 'ext.editable.EditableColumn',
			'name' => 'cap',
			//we need not to set value, it will be auto-taken from source
			'headerHtmlOptions' => array('style' => 'width: 60px'),
			'editable' => array(
				'url' => $this->createUrl('lenderAffiliateSettings/updateByData'),
			)
		),
		/*array(
			'class' => 'ext.editable.EditableColumn',
			'name' => 'orderby',
			//we need not to set value, it will be auto-taken from source
			'headerHtmlOptions' => array('style' => 'width: 60px'),
			'editable' => array(
				'url' => $this->createUrl('lenderAffiliateSettings/updateByData'),
			)
		),*/
		/*array(
			'class' => 'ext.editable.EditableColumn',
			'name' => 'status',
			//we need not to set value, it will be auto-taken from source
			'headerHtmlOptions' => array('style' => 'width: 60px'),
			'editable' => array(
			'type' => 'select',
			'url' => $this->createUrl('lenderAffiliateSettings/updateByData'),
			'source' => array(1 => 'Active', 0 => 'Inactive'),
			)
		),*/
		/*array(
			'class' => 'ext.editable.EditableColumn',
			'name' => 'intervals',
			//we need not to set value, it will be auto-taken from source
			'headerHtmlOptions' => array('style' => 'width: 20px'),
			'editable' => array(
				'url' => $this->createUrl('lenderAffiliateSettings/updateByData'),
			)
		),*/
		//'intervals',
		//'count',
		//'orderby',
		/*
		'status',
		'isRoundRobin',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
));
$this->endWidget();?>
