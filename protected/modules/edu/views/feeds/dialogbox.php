<script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.multiselect2side/js/jquery.multiselect2side.js" ></script>
<link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.multiselect2side/css/jquery.multiselect2side.css" type="text/css" media="screen" />
<script type="text/javascript">
/*$().ready(function() {
	$('#searchable').multiselect2side({
		selectedPosition: 'right',
		moveOptions: true,
		labelTop: '+ +',
		labelBottom: '- -',
		search: "Find: ",
		labelsx :"Available Vendors",
        labeldx :"Selected Vendors",
});
});*/
</script>
<?php
	$Criteria = new CDbCriteria();
	$Criteria->condition = "status = '1'";
	$feevendor = EduFeedVendors::model()->findAll($Criteria);
//print_r($feevendor);
	$Criteria->select = "id,paused_vendor";
	$Criteria->condition = "id = ".$id;
	$lendor_pausedvendor = EduFeedLenders::model()->findAll($Criteria);
//print_r($lendor_pausedvendor);
	$lendor_pausedvendor_arr = explode(',',$lendor_pausedvendor[0]['paused_vendor']);
?>
<div class="alert alert-info" align="center" id="sucess" style="display:none;"><b>Record saved sucessfully !</b></div>
<div class="alert alert-danger" align="center" id="failure" style="display:none;"><b>Error occured. Please try again !</b></div>

<?php
$form=$this->beginWidget('CActiveForm', array(
    'id'=>'pausedvendorfrm',
    'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
			'align'=>'center',
			'onsubmit'=>"return false;",/* Disable normal form submit */
            'onkeypress'=>" if(event.keyCode == 13){ send(); } " /* Do ajax call when user presses enter key */
	),
	));
?>
<input type="hidden" value="<?=$id ?>" id="hiddenLender" >
<h4>Vendor List</h4>
<select name="searchable[]" id='searchable' multiple='multiple' size='8'>
<?php foreach($feevendor as $record) {$selected = in_array($record->id, $lendor_pausedvendor_arr) ? "selected='selected'" : '';?>
<option value='<?=$record->id; ?>' <?=$selected?> ><?=$record->username."(".$record->id.")"; ?></option>
<?php } ?>
</select><br>
<?php echo CHtml::Button('SUBMIT',array('onclick'=>'send();','class'=>'btn btn-primary')); ?> 
<?php $this->endWidget(); ?>
<script>
function send()
{
//var values = $("#searchablems2side__dx>option").map(function() { return $(this).val(); });
//alert(values);
var options = $('#searchable option:selected');
var values = $.map(options ,function(option) {return option.value; });
$.ajax({
   type: 'GET',
   url: '<?php echo Yii::app()->createAbsoluteUrl("edu/feeds/pausevendorAjax"); ?>',
   data: "val=" + $.map(options ,function(option) {return option.value;})+"& id="+$('#hiddenLender').val(),
   success:function(data){
//	   $( "#sucess" ).show( "fast" );
//	   $( "#sucess" ).css( "color" , "red" );
//	   $( "#sucess" ).hide( 2000 );
//	   $("#showJuiDialog").html(data);
	   $( "#sucess" ).animate({opacity: 1.0},10).fadeIn("fast");
	   $( "#sucess" ).animate({opacity: 1.0}, 2000).fadeOut("slow");
   },
   error: function(data){ // if error occured
//	   alert("Error occured.please try again");
	   $( "#failure" ).animate({opacity: 1.0},10).fadeIn("fast");
	   $( "#failure" ).animate({opacity: 1.0}, 2000).fadeOut("slow");
    },
  dataType:'html'
  });
}
</script>
