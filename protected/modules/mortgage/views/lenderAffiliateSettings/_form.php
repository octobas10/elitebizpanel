<?php
/* @var $this LenderAffiliateSettingsController */
/* @var $model LenderAffiliateSettings */
/* @var $form CActiveForm */
?>
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
foreach (Yii::app()->user->getFlashes() as $key => $message) {
	echo '<div class="alert alert-' . CHtml::encode($key) . '">'
		. '<button type="button" class="close" data-dismiss="alert">×</button>'
		. CHtml::encode($message) . "</div>\n";
}
?>

<div class="settings-form-card portlet">
	<div class="portlet-decoration">
		<span class="portlet-title">Lender Affiliate Cap Settings</span>
	</div>
	<div class="portlet-content">
		<?php
		$form = $this->beginWidget('CActiveForm', array(
			'id' => 'lender-affiliate-settings-form',
			'enableAjaxValidation' => false,
		));
		?>
		<?php echo $form->errorSummary($model); ?>
		<p class="settings-form-note">(Only active affiliates are shown.)</p>
		<div class="stats-filter-grid settings-form-grid">
			<div class="stats-filter-group">
				<?php echo $form->labelEx($model, 'affiliate_user_id', array('class' => 'stats-filter-label')); ?>
				<div class="stats-filter-field">
					<?php echo $form->dropDownList($model, 'affiliate_user_id', $affiliate, array('class' => 'inputClass', 'empty' => 'Select Affiliate')); ?>
					<?php echo $form->error($model, 'affiliate_user_id'); ?>
				</div>
			</div>
			<div class="stats-filter-group">
				<?php echo $form->labelEx($model, 'lender_details_id', array('class' => 'stats-filter-label')); ?>
				<div class="stats-filter-field">
					<?php echo $form->dropDownList($model, 'lender_details_id', $lender, array('multiple' => 'multiple', 'class' => 'inputClass', 'size' => 5)); ?>
					<?php echo $form->error($model, 'lender_details_id'); ?>
				</div>
			</div>
			<div class="stats-filter-group">
				<?php echo $form->labelEx($model, 'cap', array('class' => 'stats-filter-label')); ?>
				<div class="stats-filter-field">
					<?php echo $form->textField($model, 'cap', array('size' => 5, 'class' => 'inputClass settings-cap-input')); ?>
					<?php echo $form->error($model, 'cap'); ?>
				</div>
			</div>
			<div class="stats-filter-group stats-filter-actions">
				<label class="stats-filter-label">&nbsp;</label>
				<?php echo CHtml::submitButton($model->isNewRecord ? 'Save' : 'Update', array('class' => 'btn btn-primary')); ?>
			</div>
		</div>
		<?php $this->endWidget(); ?>
	</div>
</div>

<?php
$this->beginWidget('zii.widgets.jui.CJuiDialog', array(
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

$updateJS = CHtml::ajax(array(
	'url' => 'js:url',
	'data' => 'js:form.serialize() + action',
	'type' => 'post',
	'dataType' => 'html',
	'success' => "function(data){
		$('div.update-dialog-content').html(data);
	}",
));
Yii::app()->clientScript->registerScript('updateDialog', "
	function updateDialog(url,act){
		var action = '';
		var form = $('div.update-dialog-content form');
		if(url == false){
			action = '&action=' + act;
			url = form.attr('action');
		}
		{$updateJS}
	}
");
?>

<div class="settings-list-card portlet">
	<div class="portlet-decoration">
		<span class="portlet-title">Lender Affiliate Setting List</span>
	</div>
	<div class="portlet-content dashboard-table-wrap">
		<?php
		$this->widget('zii.widgets.grid.CGridView', array(
			'id' => 'lender-affiliate-settings-grid',
			'dataProvider' => $model->search(),
			'filter' => $model,
			'htmlOptions' => array('class' => 'grid-view'),
			'itemsCssClass' => 'table table-bordered table-striped table-condensed table-hover',
			'columns' => array(
				array('name' => 'id', 'headerHtmlOptions' => array('style' => 'width: 60px')),
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
					'editable' => array('url' => $this->createUrl('lenderAffiliateSettings/updateByData')),
				),
				array(
					'class' => 'CButtonColumn',
					'htmlOptions' => array('class' => 'button-column'),
					'viewButtonOptions' => array('class' => 'view'),
					'updateButtonOptions' => array('class' => 'update'),
					'deleteButtonOptions' => array('class' => 'delete'),
				),
			),
		));
		?>
	</div>
</div>
