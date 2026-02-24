<?php
$this->breadcrumbs=array('Campus Cap - Rejected Leads');
?><style>
.left-column, .right-column {float: left;}
.left-column {width: 30%;}
.right-column {width: 100%;}
.nodatafound{color: red;font-family: sans-serif;font-size: 14px;text-align: center;}
.summary {font-size: 14px; margin: 0 0 5px 5px;font-weight: bold;}
/**
 * @since : 13-12-2016 01:46 PM;
 * @author : Siddharajsinh Maharaul
 * @functionality : Added class for make lead resposted in display
 */
.reposted_lead{background-color: bisque !important;}
.datehide{display:none;}
body {
	overflow-x:hidden;
	overflow-y: auto;
}
.table-bordered>thead>tr>th,.table-condensed>tbody>tr>td {
	padding: 2px !important;
	font-size: 11.5px !important;
}
</style>
<?php 
	$questionable_lead = Yii::app()->request->getParam('ltype');
	$table_title = 'Rejected Leads';
	if($questionable_lead == 1){
		$table_title = 'Questionable Leads';
	}
/**
 * @since : 05-12-2016 05:42 PM
 * @author : Siddharajsinh Maharaul
 * @functionality : Added title and export button inside div for placement
 */
echo '<div class="clearfix">';
?>
<h4 class="pull-left">Campus Cap - <?php echo $table_title; ?></h4>
<?php

echo '</div>';
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
$promo_code = Yii::app()->request->getParam('promo_code');

$len_datas = LenderDetails::model()->findAll(array('select'=>'id,name'));
$len_data = array();
foreach($len_datas as $value){
	$len_data[$value->id] = $value->name.'('.$value->id.')';
}
natcasesort($len_data);
$lender_name = Yii::app()->request->getParam('lender_name');
?>

<!--
/**
  * @author : Vatsal Gadhia
  * @description : Search Form Provided
  * @since : 26-12-2016 11:10 AM
 */
-->
<div class="row-fluid">
<div class="span12">
<?php 
$this->beginWidget('zii.widgets.CPortlet', array('title'=>"Search",)); 
$form=$this->beginWidget('CActiveForm', array('id' => 'list_leads_id', 'enableAjaxValidation' => false ));
$filter = Yii::app()->getRequest()->getParam('filter');
$promo_code = Yii::app()->getRequest()->getParam('promo_code'); 
$field = Yii::app()->getRequest()->getParam('field');
$field_value = Yii::app()->getRequest()->getParam('field_value');
$time = Yii::app()->getRequest()->getParam('time');
$post_request = Yii::app()->getRequest()->getParam('post_request');
$campus = Yii::app()->getRequest()->getParam('campus');
if(isset($promo_code) && !empty($promo_code)) {
} else if(isset($_SESSION['browse_searched_campus_cap'])) {
	$promo_code = $_SESSION['browse_searched_campus_cap']['promo_code'];
}

if(isset($time) && !empty($time)) {
} else if(isset($_SESSION['browse_searched_campus_cap'])) {
	$time = $_SESSION['browse_searched_campus_cap']['time'];
} else {
	$time = Yii::app()->getRequest()->getParam('time','hour');
}

if(isset($field) && !empty($field)) {
} else if(isset($_SESSION['browse_searched_campus_cap'])) {
	$field = $_SESSION['browse_searched_campus_cap']['field'];
} else {
	$field = Yii::app()->getRequest()->getParam('field','email');
}

if(isset($filter) && !empty($filter)) {
} else if(isset($_SESSION['browse_searched_campus_cap'])) {
	$filter = $_SESSION['browse_searched_campus_cap']['filter'];
} else {
	$filter = Yii::app()->getRequest()->getParam('filter',date('m/d/Y'));
}

if(isset($campus) && !empty($campus)) {
} else if(isset($_SESSION['browse_searched_campus_cap'])) {
	$campus = $_SESSION['browse_searched_campus_cap']['campus'];
} else {
	$campus = Yii::app()->getRequest()->getParam('campus','all');
}

if(isset($field_value) && !empty($field_value)) {
} else if(isset($_SESSION['browse_searched_campus_cap'])) {
	$field_value = $_SESSION['browse_searched_campus_cap']['field_value'];
}
?>
    <div class="table-responsive">
<table class="table table-striped table-hover table-bordered table-condensed">
<tr>
	<td style="line-height:0px;width:150px;"><br/>
	<?php echo CHtml::radioButtonList(
			'time',''.$time.'',array(
				'hour'=>'1 hour',
				'day'=>'1 day',
				'week'=>'1 week',
				'month'=>'1 month',
				'quarter'=>'3 months',
				'specific_date'=>'Specific Date'
			),array('labelOptions'=>array('style'=>'display:inline'))
		);
	?>
	</td>
	<td style="width:100px;" class="datehide"><b>Date Range : </b>
	<?php
		$this->widget('ext.EDateRangePicker.EDateRangePicker',array(
	    	'id'=>'Filter_date',
	    	'name'=>'filter',
	    	'value'=>$filter,
	    	'options'=>array('arrows'=>true,'closeOnSelect'=>true),
	    	'htmlOptions'=>array('class'=>'inputClass'),
    	));
	?>
	</td>
	<td style="width:94px;"><b>Promo code :</b><br>
	<?php echo CHtml::textField('promo_code', ''.$promo_code.'', array('style'=>'width:62px;','class'=>'form-control')); ?>
	</td>
	<td style="width:130px;"><b>Campus :</b><br>
	<?php
		$o_edu_zip_codes = new EduZipCodes();
		$t_campuses = $o_edu_zip_codes->getCampusDetails();
		if(isset($t_campuses) && !empty($t_campuses)) {
			echo '<select class="form-control" name="campus">';
			echo '<option value="all">All</option>';
			foreach ($t_campuses as $t_campus) {
				if($campus==$t_campus['campus_code']) {
					echo '<option value="'.$t_campus['campus_code'].'" selected>'.$t_campus['campus_name'].'</option>';
				} else {
					echo '<option value="'.$t_campus['campus_code'].'">'.$t_campus['campus_name'].'</option>';
				}
			}
			echo '</select>';
		}
	?>
	</td>
	<td style="width:130px;"><b>Fields :</b><br>
	<?php echo CHtml::dropDownList('field',$field,array('email'=>'Email','first_name' => 'First Name', 'last_name' => 'Last Name', 'ipaddress' => 'IP Address', 'ssn' => 'SS#'),array('multiple'=>false,'class'=>'form-control'));
	?>
	</td>
	<td><b>Field Value:<b></b></b><br>
	<?php echo(CHtml::textArea('field_value',''.$field_value.'',array('class'=>'form-control'))); ?>
	</td>
	<td><b>Action :</b><br>
	<!--
	/**
	  * @author : Vatsal Gadhia
	  * @description : Export Button Added
	  * @since : 26-12-2016 15:02 PM
	 */
	-->
	<?php echo CHtml::submitButton('Search',array('class'=>'btn btn btn-primary','name'=>'search_leads')); ?>
	<?php echo CHtml::submitButton('Reset',array('class'=>'btn btn btn-primary','id'=>'reset','name'=>'reset_leads')); ?>
	<?php echo CHtml::submitButton('Export CSV',array('class'=>'btn btn btn-primary','name'=>'export','id'=>'exportcsv')); ?>
	</td>
</tr>
        </table></div><?php $this->endWidget(); $this->endWidget(); ?>
</div>
</div>

<div class="row-fluid">
<div class="span12">
<div class="summary">Total <?php echo ($questionable_lead == 1 ? 'Questionable' : 'Rejected' ) ?> Leads: <?php if(isset($NoDataFound)) { echo "0"; } else { echo $total; } ?></div>
<?php if(Yii::app()->user->hasFlash('success')): ?>
<div class="alert alert-success" role="alert">
	<?php echo Yii::app()->user->getFlash('success'); ?>
</div>
<?php elseif(Yii::app()->user->hasFlash('error')): ?>
<div class="alert alert-danger" role="alert">
	<?php echo Yii::app()->user->getFlash('error'); ?>
</div>
<?php endif; ?>
<table id="posts" class="table table-striped table-hover table-bordered table-condensed">
<thead>
	<tr>
		<th>Date Time</th>
		<th>Name</th>
		<th>Email</th>
		<!--<th>Postal Address</th>-->
		<th>Campus</th>
		<!--<th>Affiliate</th>-->
		<th>Lead Status</th>
		<th>Phone</th>
		<th>Ip Address</th>
		<th>Sub Id</th>
		<th>Change PromoCode</th>
		<th>Change Campus</th>
		<th>Action</th>
	</tr>
</thead>
<tbody>
<?php
if(isset($posts) && !empty($posts)){
foreach ($posts as $len_trans) {?>
	<tr class="post">
		<td style="width:150px;"><?php echo $len_trans['sub_date']; ?></td>
		<td style="width:150px;"><?php echo $len_trans['first_name'].' '.$len_trans['last_name']; ?></td>
		<td style="width:150px;"><?php echo $len_trans['email']; ?></td>
		<!--<td style="width:150px;"><?php echo $len_trans['address']."<br/><b>City :</b>".$len_trans['city']."<br><b>State :</b>".$len_trans['state']."<br><b>Zipcode :</b> ".$len_trans['zip']; ?></td>-->
		<td style="width:150px;"><?php echo $len_trans['campus']; ?></td>
		<!--<td style="width:150px;"><?php print_r($aff_data[$len_trans['promo_code']]); ?></td>-->
		<td style="width:150px;">
			<?php if($len_trans['lead_status']=='1'){
					echo "ACCEPTED";
				}
				else if($len_trans['lead_status']=='0'){
					echo "REJECTED";
				}
				else if($len_trans['lead_status']=='-1'){
					echo "ERROR";
				}
				else if($len_trans['lead_status']=='2'){
					echo "RETURNED";
				}
				else{
					echo "ERROR";
				}
				echo ($len_trans['is_questionable'] == '1' && $questionable_lead != 1 ? '<br/>(Questionable)' : '' );
				echo "<br><b style='color:red;'>Reason : </b>";
				echo $len_trans['military'];
			?>
		</td>
		<td><?php echo $len_trans['phone']; ?></td>
		<th><?php echo $len_trans['ipaddress']; ?>
		<?php 
			/*$t_ip_location = json_decode(file_get_contents("https://ipinfo.io/{$len_trans['ipaddress']}/geo"));
			if(!empty($t_ip_location) && isset($t_ip_location->city) && isset($t_ip_location->region)){
				echo '<br/><b>City :</b>'.$t_ip_location -> city.'<br/><b>State : </b>'.$t_ip_location -> region;
			}else{
				$t_ip_location = json_decode(file_get_contents("https://ipinfo.io/{$len_trans['ipaddress']}/geo"));
				if(!empty($t_ip_location) && isset($t_ip_location->city) && isset($t_ip_location->region)){
					echo '<br/><b>City :</b>'.$t_ip_location -> city.'<br/><b>State : </b>'.$t_ip_location -> region;
				}
			}*/
			$t_ip_location = json_decode(file_get_contents("http://freegeoip.net/json/".$len_trans['ipaddress']));
			if(!empty($t_ip_location) && isset($t_ip_location -> city) && isset($t_ip_location -> region_name)){
				echo '<br/><b>City :</b>'.$t_ip_location -> city.'<br/><b>State : </b>'.$t_ip_location -> region_name;
			}
		 ?>
		</td>
		<th><?php echo $len_trans['sub_id']; ?></td>
		<td>
			<select name="active_affs" class="active_affs affs_for_<?php echo $len_trans['id']; ?>">
			<?php
				if(isset($active_aff_data) && !empty($active_aff_data)) {
					foreach ($active_aff_data as $key => $value) {
						if($len_trans['promo_code']==$key) {
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
		</td>
		<td>
			<select name="avail_campus" class="avail_campus">
			<?php
				$t_campuses = LeadsController::actionGetCampuses($len_trans['zip']);
				if(isset($t_campuses) && !empty($t_campuses)) {
					foreach ($t_campuses as $t_campus) {
						if($len_trans['campus']==$t_campus['campus_code']) {
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
		</td>
		<td style="width:150px;">
			<?php 
			$page_value = Yii::app()->request->getParam('page');
			$page_value = (!empty($page_value) ? $page_value : 1 );
				
			//if($len_trans['lead_status']=='0') { echo '<a href="?id='.$len_trans['id'].'&campus='.$len_trans['campus'].'&program_of_interest='.$len_trans['program_of_interest'].'&zip='.$len_trans['zip'].'">Repost</a>'; }
			if($len_trans['lead_status']=='0') { echo '<a class="redirect" href="?id='.$len_trans['id'].'&campus='.$len_trans['campus'].'&program_of_interest='.$len_trans['program_of_interest'].'&zip='.$len_trans['zip'].'&promo_code='.$len_trans['promo_code'].'&new_promo_code='.$len_trans['promo_code'].'&new_campus='.$len_trans['campus'].'&new_program_of_interest='.$len_trans['program_of_interest'].($questionable_lead == 1 ? '&rp=ql&pv='.$page_value : '&pv='.$page_value).'" onclick="return confirmsubmission('.$len_trans['is_campus_cap'].','.$len_trans['promo_code'].','.$len_trans['id'].')">Repost</a>'; }
			if($len_trans['is_questionable']=='0'){
				echo ' | <a href="?qid='.$len_trans['id'].'" onclick="return confirm(\'Are You Sure?\')">Mark Questionable</a> | ';
			}
				echo ' <a href="'.Yii::app()->getBaseUrl(true).'/index.php/edu/leads/EditLeadDetails?id='.$len_trans['id'].($questionable_lead == 1 ? '&rp=ql&pv='.$page_value : '&pv='.$page_value).'">Edit</a>';

			 ?>
		</td>
	</tr>
<?php }
}
	else{
		/**
		 * @since : 05-12-2016 05:36 PM
		 * @author : Siddharajsinh Maharaul
		 * @functionality : Changed colspan from 9 to 13 due to newly added columns
		 */
		/**
		 * @since : 09-12-2016 03:35 PM
		 * @author : Siddharajsinh Maharaul
		 * @functionality : Changed colspan from 13 to 14 due to newly added column sub id
		 */
		if(empty($posts) || isset($NoDataFound)){ echo '<tr><td colspan="14" align="center"><div class="alert alert-danger" align="center"><h4>No Leads Found.</h4></div></td></tr>'; }
	}
?>
</tbody>
</table>
</div>
</div>
<div class="hidden" style="display:none;">
<?php if(Yii::app()->user->hasFlash('repost_response')) {
	print_r(Yii::app()->user->getFlash('repost_response'));
} ?>
</div>
<?php
/**Generate Paggination Link*/
$this->widget('CLinkPager', array('pages' => $pages));
?>

<script>
$(document).ready(function(){
	$("#reset").click(function(){
		$.ajax({
			url: '<?php echo Yii::app()->createUrl('ajax'); ?>/?reset=browse_searched_parameters',
			success: function(data) {
				window.location = window.location.pathname;
			}
		});
	});
});

$(document).on('change','.active_affs',function() {
	var aff_id = $(this).val();
	var redirect = $(this).closest('td').next().next().find('a.redirect').attr('href');
	var t_redirect = redirect.split("new_promo_code=");
	var redirect_url_second_half = t_redirect[1].split("&");
	var new_redirect = t_redirect[0]+"new_promo_code="+aff_id+"&"+redirect_url_second_half[1]+"&"+redirect_url_second_half[2];
	$(this).closest('td').next().next().find('a.redirect').attr('href',new_redirect);
});

$(document).on('change','.avail_campus',function() {
	var avail_campus = $(this).val().split("@");
	var redirect = $(this).closest('td').next().find('a.redirect').attr('href');
	var t_redirect = redirect.split("new_campus=");
	var new_redirect = t_redirect[0]+"new_campus="+avail_campus[0]+"&new_program_of_interest="+avail_campus[1];
	$(this).closest('td').next().find('a.redirect').attr('href',new_redirect);
});

function confirmsubmission(is_campus_cap,promo_code,id) {
	if(is_campus_cap==2) {
		var selected_promo_code = $('.affs_for_'+id).val();
		var confirm_msg = "You Haven't Changed The Promo_Code. Would You Like To Proceed?";
		if(promo_code!=selected_promo_code) {
			confirm_msg = "Would You Like To Proceed With The Changed Promo_Code?";
		}
		if(confirm(confirm_msg) == true) {
			return true;
		} else {
			return false;
		}
	} else {
		if(confirm("Are You Sure You Want To Repost?") == true) {
			return true;
		} else {
			return false;
		}
	}
	return false;
}

/**
 * @since : 05-12-2016 04:22 PM
 * @author : Siddharajsinh Maharaul
 * @functionality : Added export csv click for download csv for rejected leads
 */
$("#exportcsv").click(function(){
    var att_name =  $(this).prop('name');
    var att_value = $(this).prop('value');
		/**
		 * @since : 30-11-2016 11:49 AM
		 * @author : Siddharajsinh Maharaul
		 * @functionality : Checked URL contain get parameters or not if not then add "?" or add "&" for export csv get parameter
		 */
		var get_parameters = window.location.href.split('?');
		var symbol = '&';
		if(get_parameters.length < 2){
			symbol = '?';
		}
  		window.location = window.location.href+symbol+att_name+'='+att_value
});

if('<?php echo $time;?>'=='specific_date') $('.datehide').show();
    
	$("input[name=time]").click(function(){
		if(jQuery(this).val()=='specific_date'){
			$('.datehide').show();
		}else{
			$('.datehide').hide();
		}
	});

</script>
