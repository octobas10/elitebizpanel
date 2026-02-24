<style>
.left-column, .right-column{
  float:left;
}
.left-column{
  width:30%; 
}
.right-column{
  width:100%; 
}
</style>

<div class="row-fluid">
<div class="span12">
<?php $this->beginWidget('zii.widgets.CPortlet', array('title'=>"Search",)); ?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'list_leads_id',
	'enableAjaxValidation'=>false,
)); ?>
<table class="table table-striped table-hover table-bordered table-condensed">
      <thead>
        <tr>
		<td style="width:100px"><b>Date range : </b>
<?php 

$date = !empty($_REQUEST['filter'])?$_REQUEST['filter']:'';
$this->widget('ext.EDateRangePicker.EDateRangePicker',array(
    'id'=>'Filter_date',
    'name'=>'filter',
    'value'=>''.$date.'',
    'options'=>array('arrows'=>true),
    'htmlOptions'=>array('class'=>'inputClass'),
    ));
?>
</td>
<?php 
$promocode = !empty($_REQUEST['feed_vendor_id']) ? $_REQUEST['feed_vendor_id'] : '';
$lender = !empty($_REQUEST['lenders']) ? $_REQUEST['lenders'] : '';
$status = !empty($_REQUEST['status']) ? $_REQUEST['status'] : '';
?>
        <td style="width:100px"><b>Vendor code :</b><br>
		<?php echo Chtml::dropDownList('feed_vendor_id','',CHtml::listData(AutoFeedVendor::model()->findAll(),'id','username'),array('multiple'=>'multiple','style'=>'width:auto;')); ?>
		<?php //echo(CHtml::textField('feed_vendor_id',''.$promocode.'')); ?></td>
		<td style="width:100px"><b>Lenders :</b><br>
		<?php echo Chtml::dropDownList('lenders','',CHtml::listData(AutoFeedLenders::model()->findAll(),'feed_lender_name','feed_lender_name'),array('multiple'=>'multiple','style'=>'width:auto;')); ?></td>
		<td style="width:100px"><b>Response :</b><br><?php echo CHtml::dropDownList('status', ''.$status.'', 
			array('Accepted' => 'Accepted', 'Rejected' => 'Rejected'),
			array('empty' => 'Select Status')); ?> </td>
		<td><b>Action :</b><br><?php echo CHtml::submitButton('search',array('class'=>'btn btn btn-primary')); ?>&nbsp;<?php echo CHtml::submitButton('Export',array('class'=>'btn btn btn-primary')); ?></td></tr>
</table><?php $this->endWidget();?>
<?php $this->endWidget(); ?>
</div>
</div>
<?php
$dataProvider = new CArrayDataProvider($rawData,array('keyField' =>'id','keyField' => 'first_name','keyField' => 'last_name','keyField' => 'sub_date','keyField' => 'email','keyField' =>'feed_vendor_id','keyField' =>'response')
);
$this->widget('zii.widgets.grid.CGridView', array('dataProvider' => $dataProvider,
	'columns'=>array(
	            array('name'=>'id', 'header'=>'Lead ID'),
				array('name'=>'feed_vendor_id', 'header'=>'Vendor code'),
				array('name'=>'first_name', 'header'=>'First name'),
				array('name'=>'last_name', 'header'=>'Last name'),
				array('name'=>'email', 'header'=>'Email'),
			    array('name'=>'sub_date', 'header'=>'Date'),
				array('name'=>'response', 'header'=>'Status'),
	),
));
?>
