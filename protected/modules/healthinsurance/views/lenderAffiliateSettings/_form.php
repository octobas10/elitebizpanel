<?php
/* @var $this LenderAffiliateSettingsController */
/* @var $model LenderAffiliateSettings */
/* @var $form CActiveForm */
?>
<style>
.ui-dialog.ui-widget.ui-widget-content.ui-corner-all.ui-draggable {
    width: 590px !important;
}
</style>
<?php
Yii::app()->clientScript->registerScript('search', "
	$('.search-form form').submit(function(){
		$.fn.yiiGridView.update('lender-affiliate-settings-grid', {
			data: $(this).serialize()
		});
		return false;
	});
	$(function(){
	   $('.alert').delay(1500).fadeOut('slow'); 
	});
");
foreach(Yii::app()->user->getFlashes() as $key => $message){
	echo  '<div class="alert alert-' . $key . '">'
		.'<button type="button" class="close" data-dismiss="alert">×</button>'
		. $message . "</div>\n";
}
?>
<div class="row-fluid">
	<div class="">
	    <?php
			$this->beginWidget('zii.widgets.CPortlet', array(
				'title'=>'Lender Affiliate Cap Settings',
			));
			$form=$this->beginWidget('CActiveForm', array(
				'id'=>'lender-affiliate-settings-form',
				'enableAjaxValidation'=>false,
			));	
		?>
		<?php echo $form->errorSummary($model); ?>
		<div style="height:100%;width:100%;">
		    <div style="display: inline-block;vertical-align:top; padding-right: 9px;">
		    	(Only Active Affiliate)
				<?php echo $form->labelEx($model,'affiliate_user_id',array('style'=>'font-weight:bolder')); ?>
				<?php echo $form->dropDownList($model,'affiliate_user_id',$affiliate,array('style'=>'width:auto;','empty'=>'Select Affiliate')); ?>
				<?php echo $form->error($model,'affiliate_user_id'); ?>
			</div>
		    <div style="display: inline-block;vertical-align:top;padding-right: 9px;">
				<?php echo $form->labelEx($model,'lender_details_id',array('style'=>'font-weight:bolder')); ?>
				<?php echo $form->dropDownList($model,'lender_details_id',$lender,array('multiple'=>'multiple','style'=>'width:auto;')); ?>
				<?php echo $form->error($model,'lender_details_id'); ?>
			</div>
			<div style="display: inline-block;vertical-align:top; padding-right: 9px;">
				<?php echo $form->labelEx($model,'cap',array('style'=>'font-weight:bolder')); ?>
				<?php echo $form->textField($model,'cap',array('size'=>5,'style'=>'width:40px;')); ?>
				<?php echo $form->error($model,'cap'); ?>
			</div>
			<div style="display: inline-block;vertical-align:top;">
				<label  style="font-weight:bolder">&nbsp;</label>
				<?php echo CHtml::submitButton($model->isNewRecord ? 'GO' : 'GO',array('class'=>'btn btn btn-primary'));  ?>
			</div>
		</div>
		<?php $this->endWidget();?>
		<?php $this->endWidget(); ?>
	</div>
</div>
<div class="row-fluid">
<div class="span12">
<?php
$this->beginWidget( 'zii.widgets.jui.CJuiDialog', array(
	'id' => 'update-dialog',
	'options' => array(
		'title' => 'Dialog',
		'autoOpen' => false,
		'modal' => true,
		'width' => 550,
		'resizable' => false,
	),
));
?>
<div class="update-dialog-content"></div>
<?php 
$this->endWidget('zii.widgets.jui.CJuiDialog');
?>
<?php
$updateJS = CHtml::ajax(array(
	'url' => "js:url",
	'data' => "js:form.serialize() + action",
	'type' => 'post',
	'dataType' => 'html',
	'success' => "function(data){
		$('div.update-dialog-content').html(data);
	}"
));
Yii::app()->clientScript->registerScript('updateDialog',"
	function updateDialog(url,act){
		var action = '';
		var form = $('div.update-dialog-content form' );
		if(url == false ){
			action = '&action=' + act;
			url = form.attr('action');
		}
		{$updateJS}
	}"
);
?>
<?php $this->beginWidget('zii.widgets.CPortlet', array('title'=>"Lender Affiliate Setting List"));?>
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'lender-affiliate-settings-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
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
			'headerHtmlOptions' => array('style' => 'width: 60px'),
			'editable' => array('url' => $this->createUrl('lenderAffiliateSettings/updateByData'))
		),
		/*array(
			'class' => 'ext.editable.EditableColumn',
			'name' => 'orderby',
			'headerHtmlOptions' => array('style' => 'width: 60px'),
			'editable' => array('url' => $this->createUrl('lenderAffiliateSettings/updateByData'))
		),*/
		/*array(
			'class' => 'ext.editable.EditableColumn',
			'name' => 'status',
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
			'headerHtmlOptions' => array('style' => 'width: 60px'),
			'editable' => array('url' => $this->createUrl('lenderAffiliateSettings/updateByData'))
		),*/
		array(
			'class'=>'CButtonColumn',
		)
	)
)); ?>
<?php $this->endWidget();?>
</div>
</div>
