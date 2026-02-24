<link href="<?php echo Yii::app()->baseUrl;?>/css/bootstrap2-toggle.min.css" rel="stylesheet">
<script src="<?php echo Yii::app()->baseUrl; ?>/js/bootstrap2-toggle.min.js"></script>
<p style="display: none;color:red;" id="sucess" ><b>Record saved sucessfully !<b></p>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'pausedvendorfrm',
    'enableAjaxValidation'=>false,
	'htmlOptions'=>array(
		'onsubmit'=>"return false;",
        'onkeypress'=>" if(event.keyCode == 13){ } "
	),
	)); 
?>
<input type="hidden" value="<?=$campus_code ?>" id="campus_code" >
<div class="row">
	<div class="col-sm-12">
		<div class="table-responsive">
			<table class="table table-striped table-hover table-bordered table-condensed">
			<thead>
				<tr>
				<th>Sr.</th>
				<th>Program Code</th>
				<th>Program Name</th>
				<th>Status</th>
				</tr>
			</thead>
			<tbody>
			<?php $i=0;foreach($programs_of_campus as $program) { $i++;?>
			<tr style="height:60px;">
				<td><?=$i;?></td>
				<td><?=$program['program_of_interest_code'];?></td>
				<td><b><?=$program['name'];?></b></td>
				<?php $checked = ($program['status'] == '1') ? 'checked=checked' : '';?>
				<td style="width:150px;"><div class="form-group"><input type="checkbox" id="<?=$program['program_of_interest_code'];?>" class="zipcode_status" <?php echo $checked;?> data-toggle="toggle" data-on="ACTIVE" data-off="INACTIVE" data-onstyle="success" data-offstyle="info"></div></td>
			</tr>
			<?php } ?>
			</tbody>
			</table>
		</div>
	</div>
</div>
<?php $this->endWidget(); ?>
<style>
[data-toggle=buttons]>.btn>input[type=radio], [data-toggle=buttons]>.btn>input[type=checkbox] {
  display: none;
}
.btn-group {
   width:100%;
}
.toggle.btn{
	width:150px !important;
	display:block;
	height:34px !important;
}
</style>
<script>
jQuery(document).ready(function($) {
	$('#multiselect').multiselect();
});	
$('.zipcode_status').change(function(){
	if($(this).prop('checked')==true){
		manageprograms("1",$(this).attr('id'));
	}else{
		manageprograms("0",$(this).attr('id'));
	}
});
function manageprograms(status,program_code){
	var status = status;
	var program_code = program_code;
	var campus_code = $('#campus_code').val();
	$.ajax({
		type: 'GET',
		url: '<?php echo Yii::app()->createAbsoluteUrl("edu/CampusSettings/setProgramStatus"); ?>',
		data: "status="+status+"&program_code="+program_code+"&campus_code="+campus_code,
		success:function(data){
			//alert(data);
			$( "#sucess" ).show( "SLOW" );
			$( "#sucess" ).hide( 2000 );
			//$("#showJuiDialog").html(data);
		},
		error: function(data){
			alert("Error occured.please try again");
		},
		dataType:'html'
	});
}
</script>
