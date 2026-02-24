<?php
/**
 * @since : 08-12-2016 06:56 PM
 * @author : Siddharajsinh Maharaul
 * @functionality : Created Page To Edit Lead Details
 */
$this->breadcrumbs = array(
	'Edit Lead Details' 
);
?>
<style>
.creatives {
	//min-height: 680px;
}
.content{
	min-height: 680px;
}
.creatives label {
	display: inline-block;
    width: 120px;
	margin-right: 10px;
    line-height: 36px;
    vertical-align: top;
}
.creatives .form-control, input[type='file'] {
/*    width: 300px;*/
    display: inline-block;
}
    input[type='file'] {
        margin-top: 8px;
    }

.error{
	color:red;
}
div#error {
	display:none;
	background: none repeat scroll 0 0 lightyellow;
   border: 1px solid red;
   margin-bottom: 15px;
   width: 50%;
}
p.error {
   margin: 0;
   padding: 1px 13px;
}
.promo_image{
	border: 2px solid #999;
	padding: 5px;
	margin-bottom: 10px;
}
code {
  display: block;
  white-space: nowrap;
  color: #fff;
  background-color: #444;
  padding: 1em;
  border: 1px solid #d1d1d1;
  overflow: auto;
}
.txtright {
  text-align: right;
}
</style>
<?php if(Yii::app()->user->getState('roles')==1){?>
 <div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">Edit Lead Details <?php echo (isset($t_details) && !empty($t_details) ? '- (<b>Reason</b> : '.$t_details[0] -> outstanding_loan.')' : '' ) ?></div>
</div>
<div class="portlet-content">
<div class="creatives">
<?php if(isset($errors) && !empty($errors)){?>
	<div id="error" style="display: block !important;">
	<?php foreach($errors as $error){?>
		<p class='error'><?php echo $error;?></p>
	<?php }?>
	</div>
<?php } ?>
<div id="error"></div>
<?php 
	if(!isset($t_details) || empty($t_details)){
		echo '<div id="error">No details Found</div>';
	}else{ 
		/**
		 * @since : 12-12-2016 04:28 PM
		 * @author : Siddharajsinh Maharaul
		 * @functionality : Got redirect page from URL and added in form action
		 */
		/**
		 * @since : 13-12-2016 10:00 AM
		 * @author : Siddharajsinh Maharaul
		 * @functionality : Changed parameter for redirect page and page value
		 */
		$page = Yii::app()->request->getParam('pv');
		$rp = Yii::app()->request->getParam('rp');
		echo CHtml::beginForm($action='?id='.$i_submission_id.'&is_reposted=1&rp='.$rp.'&pv='.$page,$method='post');?>
	    <div class="row">
	        <div class="col-sm-4">
	        <?php echo CHtml::label($label='First Name', $for='first_name', $htmlOptions=array());?>
	        <?php echo CHtml::textField($name='first_name',$value=$t_details[0] -> first_name,$htmlOptions=array('class'=>'form-control'));?>
	        </div>
	        <div class="col-sm-4">
	        <?php echo CHtml::label($label='Last Name', $for='last_name', $htmlOptions=array());?>
	        <?php echo CHtml::textField($name='last_name',$value=$t_details[0] -> last_name,$htmlOptions=array('class'=>'form-control'));?>
	        </div>
	        <div class="col-sm-4">
	        <?php echo CHtml::label($label='Email', $for='email', $htmlOptions=array());?>
	        <?php echo CHtml::textField($name='email',$value=$t_details[0] -> email,$htmlOptions=array('class'=>'form-control'));?>
	        </div>
	    </div>
	    <div class="row">
 			<div class="col-sm-4">
	        <?php echo CHtml::label($label='City', $for='city', $htmlOptions=array());?>
	        <?php echo CHtml::textField($name='city',$value=$t_details[0] -> city,$htmlOptions=array('class'=>'form-control'));?>
	        </div>
	        <div class="col-sm-4">
	        <?php echo CHtml::label($label='Postal Address', $for='address', $htmlOptions=array());?>
	        <?php echo CHtml::textArea($name='address',$value=$t_details[0] -> address,$htmlOptions=array('class'=>'form-control'));?>
	        </div>

   			<div class="col-sm-4">
	        <?php echo CHtml::label($label='State', $for='state', $htmlOptions=array());?>
	        <?php echo CHtml::textField($name='state',$value=$t_details[0] -> state,$htmlOptions=array('class'=>'form-control'));?>
	        </div>
	    </div>
	    <div class="row">

	        <div class="col-sm-4">
	        <?php echo CHtml::label($label='Zipcode', $for='zip', $htmlOptions=array());?>
	        <?php echo CHtml::textField($name='zip',$value=$t_details[0] -> zip,$htmlOptions=array('class'=>'form-control'));?>
	        </div>
	        <div class="col-sm-4">
	        <?php echo CHtml::label($label='Phone', $for='phone', $htmlOptions=array());?>
	        <?php echo CHtml::textField($name='phone',$value=$t_details[0] -> phone,$htmlOptions=array('class'=>'form-control'));?>
	        </div>
	        <div class="col-sm-4">
	        <?php echo CHtml::label($label='Mobile', $for='mobile', $htmlOptions=array());?>
	        <?php echo CHtml::textField($name='mobile',$value=$t_details[0] -> mobile,$htmlOptions=array('class'=>'form-control'));?>
	        </div>
	    </div>
	    <div class="row">
			<?php 
				/**
				 * @since : 12-12-2016 12:32 PM
				 * @author : Siddharajsinh Maharaul
				 * @functionality : Added option to select promo code
				 */
				$aff_datas = AffiliateUser::model()->findAll(array('select'=>'id,user_name,status'));
				$aff_data = $active_aff_data = array();
				foreach($aff_datas as $value){
					$aff_data[$value->id] = $value->user_name.'('.$value->id.')';
					if($value->status==1) {
						$active_aff_data[$value->id] = $value->user_name.'('.$value->id.')';
					}
				}
				natcasesort($aff_data);
				natcasesort($active_aff_data);
			?>
	        <div class="col-sm-4">
	        <?php echo CHtml::label($label='Promo Code', $for='promo_code', $htmlOptions=array());?>
	       	<select id="promo_code" name="promo_code" class="form-control active_affs affs_for">
			<?php
				if(isset($active_aff_data) && !empty($active_aff_data)) {
					foreach ($active_aff_data as $key => $value) {
						if($t_details[0] -> promo_code == $key) {
							echo '<option value='.$key.' selected>'.$active_aff_data[$key].'</option>';
						} else {
							echo '<option value='.$key.'>'.$active_aff_data[$key].'</option>';
						}
					}
				} else {
					echo '<option value='.$len_trans['promo_code'].'>'.$aff_data[$len_trans['promo_code']].'</option>';
				}
			?>
			</select>
	        </div>

	        <div class="col-sm-4">
	        <?php echo CHtml::label($label='Campus', $for='campus', $htmlOptions=array());?>
	       	<select name="campus" class="form-control avail_campus">
			<?php
				$t_campuses = LeadsController::actionGetCampuses($t_details[0] -> zip);
				if(isset($t_campuses) && !empty($t_campuses)) {
					foreach ($t_campuses as $t_campus) {
						if($t_details[0] -> campus==$t_campus['campus_code']) {
							echo '<option value='.$t_campus['campus_code']."@".$t_campus['program_of_interest_code'].' selected>'.$t_campus['campus_code'].'</option>';
						} else {
							echo '<option value='.$t_campus['campus_code']."@".$t_campus['program_of_interest_code'].'>'.$t_campus['campus_code'].'</option>';
						}
					}
				} else {
					echo '<option value='.$len_trans['campus']."@".$len_trans['program_of_interest'].'>'.$len_trans['campus'].'</option>';
				}
			?>
			</select>
	        </div>
	      
	    </div>
		<div class="row">
			<div class="col-sm-4">
			<?php echo CHtml::submitButton($label='Repost', $htmlOptions=array('class'=>'btn btn-primary','name'=>'upload','id'=>'upload'));?>
			</div>
		</div>
<?php
	 echo CHtml::endForm();
	}
?>
</div>
</div>
</div>
<?php }?>

<!-- 
/**
 * @since : 12-12-2016 12:52 PM
 * @author : Siddharajsinh Maharaul
 * @functionality : Added script to check for campus cap 2 and reason is for duplicate ip
 */
 -->
<script type="text/javascript">
	var i_flag = 0;
	is_campus_cap = '<?php echo (!empty($t_details) ? $t_details[0] -> is_campus_cap : "" ) ?>';
	promo_code = '<?php echo (!empty($t_details) ? $t_details[0] -> promo_code : "" ) ?>';
	$(document).on('submit','form',function(e){
		if(i_flag == 0){
			e.preventDefault();
		}else{
			return true;
		}
		if(is_campus_cap==2) {			
			selected_promo_code = $('#promo_code').val();
			var confirm_msg = "You Haven't Changed The Promo_Code. Would You Like To Proceed?";
			if(promo_code!=selected_promo_code) {
				confirm_msg = "Would You Like To Proceed With The Changed Promo_Code?";
			}
			if(confirm(confirm_msg) == true) {
				i_flag = 1;
				$('form').submit();
			}
		} else {
			if(confirm("Are You Sure You Want To Repost?") == true) {
				i_flag = 1;
				$('form').submit();
			}
		}
	});
</script>