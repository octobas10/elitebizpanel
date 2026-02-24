<?php
$this->breadcrumbs=array('Pause Affiliates');
$this->menu=array(array('label'=>'Lender Setup','url'=>array('index')),array('label'=>'Lender Stats','url'=>array('lenderstats')));
?>
<h4>Pause Affiliates</h4>
<div class="row-fluid">
	<div class="span12">
		<?php
			$this->beginWidget('zii.widgets.CPortlet', array('title'=>"Select Affiliates",));
				$form=$this->beginWidget('CActiveForm', array('id' => 'paused_affiliates', 'enableAjaxValidation' => false ));
				$t_affiliate_datas = AffiliateUser::model()->findAll(array('select'=>'id,user_name','condition'=>'id!=1'));
				$aff_datas = array();
				foreach($t_affiliate_datas as $value){
					// $aff_datas[$value->id] = $value->user_name.'('.$value->id.')';
					$aff_datas[$value->id] = $value->id;
				}
				natcasesort($aff_datas);
				$t_lender_datas = LenderDetails::model()->findAll(array('select'=>'id,paused_vendor','condition'=>'id='.Yii::app()->user->id));
				if(isset($t_lender_datas) && !empty($t_lender_datas) && isset($t_lender_datas[0]) && isset($t_lender_datas[0]['paused_vendor']) && !empty($t_lender_datas[0]['paused_vendor'])) {
					$t_paused_aff_ids = explode(',',$t_lender_datas[0]['paused_vendor']);
				}
				
				if(Yii::app()->user->hasFlash('success')): ?>
					<div class="alert alert-success" role="alert">
						<?php echo Yii::app()->user->getFlash('success'); ?>
					</div>
				<?php elseif(Yii::app()->user->hasFlash('error')): ?>
					<div class="alert alert-danger" role="alert">
						<?php echo Yii::app()->user->getFlash('error'); ?>
					</div>
				<?php endif;
		?>
		    <div class="table-responsive">
				<table class="table table-striped table-hover table-bordered table-condensed">
					<tr>
						<td style="width:150px;"><b>Paused Affiliates : </b><br>
							<Select name="pausedaffiliates[]" size="8" multiple="multiple" style="width:150px;">
							<?php
							if(isset($t_paused_aff_ids) && !empty($t_paused_aff_ids)) {
								foreach ($aff_datas as $aff_data_key=>$aff_data_value) {
									if(in_array($aff_data_key, $t_paused_aff_ids)) {
										echo '<option value="'.$aff_data_key.'" selected disabled>'.$aff_datas[$aff_data_key].'</option>';
									}
								}
							} else {
								echo '<option value="0" disabled>No Affiliate is Paused</option>';
							} ?>
							</Select>
						</td>
						<td style="width:150px;"><b>Select Affiliates : </b><br>
							<Select name="affiliates[]" size="8" multiple="multiple" id="affiliates" style="width:150px;">
							<?php foreach ($aff_datas as $aff_data_key=>$aff_data_value) {
								if(in_array($aff_data_key, $t_paused_aff_ids)) {
									echo '<option value="'.$aff_data_key.'" selected>'.$aff_datas[$aff_data_key].'</option>';
								} else {
									echo '<option value="'.$aff_data_key.'">'.$aff_datas[$aff_data_key].'</option>';
								}
							} ?>
							</Select>
						</td>
						<td><b>Action :</b><br>
						<?php
							echo CHtml::submitButton('Pause',array('name'=>'pause_affiliates','id'=>'pause_affiliates','class'=>'btn btn btn-primary'));
							if(isset($t_paused_aff_ids) && !empty($t_paused_aff_ids)) {
								echo '&nbsp';
								echo CHtml::submitButton('Resume All Affiliates',array('name'=>'resume_affiliates','id'=>'resume_affiliates','class'=>'btn btn btn-primary'));
							}
						?>
						</td>
					</tr>
				</table>
		    </div>
		<?php
				$this->endWidget();
			$this->endWidget();
		?>
	</div>
</div>
<style>
.morecontent span { display: none; }
.comment { width: 400px; }
table{ vertical-align: middle;}
</style>
<script>
$(document).ready(function() {
	$(".alert").animate({opacity: 1.0}, 3000).fadeOut("slow");
	$("#pause_affiliates").click(function(){
		var affiliates = $("#affiliates");
		if(affiliates.val()=='' || affiliates.val()==null){
			if($(".error").length==0){
				$(".alert").hide();
				$('<br><span class="error">Please Select Affiliate</span>').insertAfter(affiliates);
			}else{
				$('<span class="error">Please Select Affiliate</span>').show();
			}
			return false;
		}else{
			return true;
		}
	});
});
</script>
<style>
.error{color: red;}		
    .affiliate_report tr th{
        text-align:right;
    }
</style>