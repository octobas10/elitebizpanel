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
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.multiselect2side/css/jquery.multiselect2side.css" type="text/css" media="screen" />
<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.multiselect2side/js/jquery.multiselect2side.js" ></script>
<script type="text/javascript">
$(document).ready(function() {
	$('#searchable').multiselect2side({
		selectedPosition: 'right',
		moveOptions: true,
		labelTop: '+ +',
		labelBottom: '- -',
		search: "Find: ",
		labelsx :"Available Vendors",
        labeldx :"Selected Vendors",
	});
	$("#btn-submit").on('click',function(e){
		var options = $('#searchablems2side__dx option');
		var values = $.map(options ,function(option) {return option.value;})
		$.ajax({
			type: 'GET',
			url: '<?php echo Yii::app()->createAbsoluteUrl("edu/lenders/pausevendorAjax"); ?>',
			data: "val="+$.map(options ,function(option) {return option.value;})+"& id="+$('#hiddenLender').val(),
			success:function(data){
				$( "#sucess" ).show( "fast" );
				$( "#sucess" ).hide( 1000 );
				$("#showJuiDialog").html(data);
			},
			error: function(data){
				alert("Error occured.please try again");
			},
			dataType:'html'
		});
	});
});
</script>
<?php
	$Criteria = new CDbCriteria();
	$feedvendors = AffiliateUser::model()->findAll($Criteria);
	$Criteria->select = "id,paused_vendor";
	$Criteria->condition = "id = ".$id;
	$lendor_pausedvendor = LenderDetails::model()->findAll($Criteria);
	$lendor_pausedvendor_arr = explode(',',$lendor_pausedvendor[0]['paused_vendor']);
?>
<p style="display: none" id="sucess">Record saved sucessfully !</p>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'pausedvendorfrm',
    'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'onsubmit'=>"return false;",/* Disable normal form submit */
        'onkeypress'=>" if(event.keyCode == 13){} " /* Do ajax call when user presses enter key */
	),
	)); 
?>
<input type="hidden" value="<?=$id ?>" id="hiddenLender" >
<select name="searchable[]" id='searchable' multiple='multiple' size=8 >
<?php
	foreach($feedvendors as $record) {
		$selected = in_array($record->id, $lendor_pausedvendor_arr) ? "selected='selected'" : '';?>
		<option value='<?=$record->id; ?>' <?=$selected?> ><?=$record->user_name."(".$record->id.")"; ?></option>
<?php } ?>
</select>
<?php echo CHtml::Button('SUBMIT',array('id'=>'btn-submit','class'=>'btn btn-primary')); ?> 
<?php $this->endWidget(); ?>