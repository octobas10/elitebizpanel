<?php
$this->breadcrumbs = array(
	'Campus Setting' => array('index'), 
);
$this->beginWidget('zii.widgets.jui.CJuiDialog',array(
	'id' => 'update-dialog',
	'options' => array(
		'title' => 'Paused Vendor',
		'autoOpen' => false,
		'width' => '585px'
	)
));
?>
<div class="update-dialog-content"></div>
<?php
$this->endWidget('zii.widgets.jui.CJuiDialog');
$updateJS = CHtml::ajax(array(
	'url' => "js:url",
	'data' => "js:form.serialize() + action",
	'type' => 'post',
	'dataType' => 'html',
	'success' => "function( data ){
		$( 'div.update-dialog-content' ).html( data );
	}"
));
Yii::app()->clientScript->registerScript('updateDialog',"
	function updateDialog(url,act){
		var action = '';
	  	var form = $('div.update-dialog-content form');
	  	if(url == false){
	  		action = '&action=' + act;
	    	url = form.attr('action');
	  	}
		{$updateJS}
	}");
?>
<h4>Campus Settings</h4>
<div class="portlet">
	<div class="portlet-decoration">
		<div class="portlet-title">Cap Settings</div>
	</div>
	<div class="portlet-content">
		<form name="campus_settings" class="campus_settings" method="post" action="savecap">
		    <?php if(Yii::app()->user->hasFlash('success')): ?>
				<div class="alert alert-success" role="alert">
		    		<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<?php echo Yii::app()->user->getFlash('success'); ?>
					</a>
				</div>
			<?php elseif(Yii::app()->user->hasFlash('error')): ?>
				<div class="alert alert-danger" role="alert">
					<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
					<?php echo Yii::app()->user->getFlash('error'); ?>
					</a>
				</div>
			<?php endif; ?>
		    <div class="row">
		        <div class="col-sm-3 form-group">
		            <label>Campus : </label><br />
		            <select name="campus_id" class="form-control" required="">
		            	<?php foreach ($campuses as $campus_key=>$campus_value) {
		            		?>
		            			<option value="<?php echo $campus_key; ?>"><?php echo $campus_value; ?></option>
		            		<?php
		            	} ?>
		            </select>
		        </div>
		        <div class="col-sm-3 form-group">
		            <label>Cap Type : </label><br />
		            <select name="cap_type[]" class="form-control" required="">
		            	<?php foreach ($cap_types as $cap_key=>$cap_value) { ?>
		            			<option value="<?php echo $cap_key; ?>"><?php echo $cap_value; ?></option>
		            		<?php
		            	} ?>
		            </select>
		        </div>
		        <div class="col-sm-3 form-group">
		            <label>Cap : </label><br />
		            <input type="number" size="5" maxlength="5" min="-1" max="99999" name="cap" class="form-control" required="">
		        </div>
		        <div class="col-sm-3 form-group"><br />
		            <input type="submit" name="submit" value="Save" class="btn btn btn-primary">
		            &nbsp;
		            <input type="reset" name="reset" value="Reset" class="btn btn btn-primary">
		        </div>
		    </div>
		</form>
    </div>
</div>
<div class="portlet-content table_wrapper">
<?php
$this->widget('zii.widgets.grid.CGridView',array(
	'id' => 'campus-grid',
	'dataProvider' => $model->search(),
	'pager'=>array(
        'firstPageLabel' => '&lt;&lt;',
        'prevPageLabel'  => '<img src="https://elitebizpanel.com/images/pagination/left.png">',
        'nextPageLabel'  => '<img src="https://elitebizpanel.com/images/pagination/right.png">',
        'lastPageLabel'  => '&gt;&gt;',
    ),
	'filter' => $model,
	'columns' => array(
		'id',
		array(
			'name' => 'campus_name',
			'value' => $data->user_name,
			'type' => 'raw'
		),
		array(
			'name' => 'campus_code',
			'value' => $data->campus_code,
			'type' => 'raw'
		),
		array(
			'class' => 'ext.editable.EditableColumn',
			'name' => 'daily_limit',
			'value' => $data->daily_limit,
			'editable' => array(
				'url' => $this->createUrl('campusSettings/UpdateByData'),
				'type' => 'text',
				'placement' => 'top',
			)
		),
		array(
			'class' => 'ext.editable.EditableColumn',
			'name' => 'weekly_limit',
			'editable' => array(
				'url' => $this->createUrl('campusSettings/UpdateByData'),
				'type' => 'text',
				'placement' => 'top',
			)
		),
		array(
			'class' => 'ext.editable.EditableColumn',
			'name' => 'monthly_limit',
			'editable' => array(
				'url' => $this->createUrl('campusSettings/UpdateByData'),
				'type' => 'text',
				'placement' => 'top',
			)
		),
		array(
			'class' => 'ext.editable.EditableColumn',
			'headerHtmlOptions' => array(
				'style' => 'width: 80px'
			),
			'name' => 'ground_campus',
			'editable' => array(
				'type' => 'select',
				'value' => 'LenderDetails::getStatus($data->ground_campus)',
				'url' => $this->createUrl('campusSettings/UpdateByValue'),
				'source' => $GLOBALS['ground_campus']
			)
		),
		array(
			'class' => 'ext.editable.EditableColumn',
			'headerHtmlOptions' => array(
				'style' => 'width: 80px'
			),
			'name' => 'lender',
			'editable' => array(
				'type' => 'select',
				'value' => 'LenderDetails::getStatus($data->lender_id)',
				'url' => $this->createUrl('campusSettings/UpdateByValue'),
				'source' => $lenders
			)
		),
		array(
			'class' => 'ext.editable.EditableColumn',
			'headerHtmlOptions' => array(
				'style' => 'width: 80px'
			),
			'name' => 'active_campus',
			'editable' => array(
				'type' => 'select',
				'value' => 'LenderDetails::getStatus($data->active_campus)',
				'url' => $this->createUrl('campusSettings/UpdateByValue'),
				'source' => $GLOBALS['active_campus']
			)
		),
		array(
			'class' => 'ext.editable.EditableColumn',
			'headerHtmlOptions' => array(
				'style' => 'width: 80px'
			),
			'name' => 'ground_campus',
			'editable' => array(
				'type' => 'select',
				'value' => 'LenderDetails::getStatus($data->ground_campus)',
				'url' => $this->createUrl('campusSettings/UpdateByValue'),
				'source' => $GLOBALS['ground_campus']
			)
		),
		array(
			'class' => 'ext.editable.EditableColumn',
			'name' => 'ground_campus_grad_year',
			'editable' => array(
				'url' => $this->createUrl('campusSettings/UpdateByValue'),
				'type' => 'text',
				'placement' => 'top',
			)
		),
		
		array(
			'template' => '{reply}',
			'header' => 'Manage Programs',
			'headerHtmlOptions' => array(
				'style' => 'width: 102px'
			),
			'class' => 'CButtonColumn',
			'buttons' => array(
				'reply' => array(
					'label' => 'Update Programs',
					'url' => 'Yii::app()->createUrl("edu/CampusSettings/data",array( "campus_code" => $data->campus_code,"lender_id" => $data->lender, ) )',
					'click' => "function( e ){
						e.preventDefault();
						$('#update-dialog').children( ':eq(0)' ).empty(); // Stop auto POST
				    	updateDialog( $(this).attr( 'href' ) );
				    	$('#update-dialog').dialog( { title: 'Manage Programs' } ).dialog( 'open' );
					}"
				)
			)
		),
		array(
			'class' => 'CButtonColumn',
    		//'template'=>'{view}{delete}'
		)
	)
));
?>
    </div>
</div>
<style>
    .ms2side__options, .ms2side__updown{
        min-width:40px;
        width:auto !important;
    }
    .table_wrapper {
        overflow: hidden;
        overflow-x: auto;
    }
    #lender-details-grid {
        width: 1080px;
    }
    #lender-details-grid table th {
        min-width: 120px;
    }
</style>
<script>
$(document).ready(function () {
	$(".alert").animate({opacity: 1.0}, 3000).fadeOut("slow");
});
</script>