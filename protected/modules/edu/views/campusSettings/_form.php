<?php
$this->breadcrumbs = array(
	'Campus Setting' => array('index'), 
);

?>
<link href="<?php echo Yii::app()->baseUrl;?>/css/bootstrap2-toggle.min.css" rel="stylesheet">
<script src="<?php echo Yii::app()->baseUrl; ?>/js/bootstrap2-toggle.min.js"></script>
<div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">Create Campus header</div>
</div>
<div class="portlet-content">
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'lender-user-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation' => true,
	'clientOptions' => array('validateOnSubmit' => true,'validateOnChange' => false )
)); ?>
<?php echo $form->errorSummary($model); ?>
<div class="row">
<div class="col-sm-6">
	<div class="form-group">
		<?php echo $form->labelEx($model,'campus_name'); ?>
		<?php echo $form->textField($model,'campus_name',array('size'=>50,'class'=>'form-control','maxlength'=>50,'readonly'=>($model->isNewRecord)? false : true)); ?>
		<?php echo $form->error($model,'campus_name'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'campus_code'); ?>
		<?php echo $form->textField($model,'campus_code',array('size'=>50,'class'=>'form-control','maxlength'=>50)); ?>
		<?php echo $form->error($model,'campus_code'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'lender_name'); ?>
		<?php  echo Chtml::dropDownList('CampusDetails[lender]', $model->lender, get_lender_name_and_lender_id(), array('class'=>'form-control','empty'=>'All Lenders'));
		?>
		<?php echo $form->error($model,'lender'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'Lender Campus Id'); ?>
		<?php echo $form->textField($model,'campus_id',array('size'=>50,'class'=>'form-control','maxlength'=>50)); ?>
		<?php //echo $form->error($model,'campus_id'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'active_campus',$htmlOptions=array()); ?>
		<div class="btn-group" data-toggle="buttons">
		<?php
			foreach($GLOBALS['active_campus'] as $status_key=>$status){?>
				<a class="btn btn-default status <?php echo ($model->active_campus == $status_key) ? 'btn-primary' : '';?>">
				<input type="radio" name="CampusDetails[active_campus]" value="<?php echo $status_key;?>" <?php echo ($model->active_campus == $status_key) ? 'checked="checked"' : '';?>><?php echo $status; ?>
				</a>
			<?php } ?>
		</div>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'ground_campus'); ?>
		<?php $checked = ($model->ground_campus == '1') ? 'checked=checked' : '';?>
		<input type="checkbox" name="CampusDetails[ground_campus]" <?php echo $checked;?> id="ground_campus" data-toggle="toggle" data-on="Yes" data-off="No" data-onstyle="success" data-offstyle="info">
	</div>
	<div class="form-group ground_campus_grad_year">
		<?php echo $form->labelEx($model,'ground_campus_grad_year'); ?>
		<?php echo $form->textField($model,'ground_campus_grad_year',array('class'=>'form-control','size'=>32,'maxlength'=>32)); ?>
		<?php //echo $form->error($model,'ground_campus_grad_year'); ?>
	</div>
	
</div>

<div class="col-sm-6">
	<div class="form-group">
		<?php echo $form->labelEx($model,'daily_limit'); ?>
		<?php echo $form->textField($model,'daily_limit',array('class'=>'form-control','size'=>32)); ?>
		<?php echo $form->error($model,'daily_limit'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'weekly_limit'); ?>
		<?php echo $form->textField($model,'weekly_limit',array('class'=>'form-control','size'=>32)); ?>
		<?php echo $form->error($model,'weekly_limit'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'monthly_limit'); ?>
		<?php echo $form->textField($model,'monthly_limit',array('class'=>'form-control','size'=>32)); ?>
		<?php echo $form->error($model,'monthly_limit'); ?>
	</div>
	<!-- <div style="clear: both;margin-bottom: 10px;"></div> -->
	<div class="form-group">
		<?php echo $form->labelEx($model,'description'); ?>
		<?php echo $form->textArea($model,'description',array('class'=>'form-control','rows'=>6)); ?>
		<?php echo $form->error($model,'description'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'zipcode_list'); ?>
		<?php echo $form->textArea($model,'zipcode_list',array('class'=>'form-control','rows'=>6)); ?>
		<?php echo $form->error($model,'zipcode_list'); ?>
	</div>
	<!-- <div style="clear: both;"></div> -->
</div>
</div>
<div class="row">
	<div class="col-sm-12">
		<div class="form-group">
		<?php echo $form->labelEx($model,'add_removes_programs_for_campus'); ?>
		<script src="https://cdn.rawgit.com/crlcu/multiselect/v2.5.1/dist/js/multiselect.min.js"></script>
		<!-- <p style="display: none;color:red;" id="sucess" ><b>Record saved sucessfully !<b></p> -->
		<div class="row">
		    <div class="col-sm-5">
		        <select id="multiselect" class="form-control" size="8" multiple="multiple">
		        	<?php foreach ($all_programs as $code => $program_name) { ?>
		            <option value="<?php echo $code;?>"><?php echo '[ '.$code.' ] '.$program_name;?></option>
		        	<?php } ?>
		        </select>
		    </div>
		    <div class="col-sm-2">
		        <button type="button" id="multiselect_rightAll" class="btn btn-block"><i class="glyphicon glyphicon-forward"></i></button>
		        <button type="button" id="multiselect_rightSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-right"></i></button>
		        <button type="button" id="multiselect_leftSelected" class="btn btn-block"><i class="glyphicon glyphicon-chevron-left"></i></button>
		        <button type="button" id="multiselect_leftAll" class="btn btn-block"><i class="glyphicon glyphicon-backward"></i></button>
		    </div>
		    <div class="col-sm-5">
		        <select name="selected_programs[]" id="multiselect_to" class="form-control" size="8" multiple="multiple">
		        	<?php foreach ($programsofcampus as $code => $program_name) { ?>
		        	<option value="<?php echo $code;?>"><?php echo '[ '.$code.' ] '.$program_name;?></option>
		            <?php } ?>
		        </select>
		        <div class="row">
		            <!--<div class="col-sm-6">
		                <button type="button" id="multiselect_move_up" class="btn btn-block"><i class="glyphicon glyphicon-arrow-up"></i></button>
		            </div>
		            <div class="col-sm-6">
		                <button type="button" id="multiselect_move_down" class="btn btn-block col-sm-6"><i class="glyphicon glyphicon-arrow-down"></i></button>
		            </div>-->
		        </div>
		    </div>
		</div>
	</div>
	</div>
</div>
<div class="row buttons">
    <div class="col col-sm-12">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn btn-primary save','id'=>'campus_submit')); ?>
    </div>
</div>
</div>
</div>
<?php $this->endWidget(); ?>
</div>
<style>
.errorMessage{
	display: none !important;
}
.radiobutton{
    float: left;
}
#LenderDetails_status > label {
    float: left;
    padding: 0 5px;
}
[data-toggle=buttons]>.btn>input[type=radio], [data-toggle=buttons]>.btn>input[type=checkbox] {
  display: none;
}
.btn-group {
   width:100%;
}
 .form{
    margin:0;
}
div.form > form .row{
    margin-left:-15px;
}
    .toggle-handle{
    width:50px;
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
//$(".ground_campus_grad_year").hide();
$('#ground_campus').change(function(){
	if($(this).prop('checked')==true){
		$(".ground_campus_grad_year").show();
	}else{
   		$(".ground_campus_grad_year").hide();
	}
});
$("#campus_submit").click(function(){
	if($('#ground_campus').prop('checked')==true){
		var ground_campus_grad_year = $("#CampusDetails_ground_campus_grad_year").val();
		if(ground_campus_grad_year==undefined){
			$("#CampusDetails_ground_campus_grad_year").css('border','1px solid red');
			return false;
		}else{
			return true;
		}
	}
});
</script>