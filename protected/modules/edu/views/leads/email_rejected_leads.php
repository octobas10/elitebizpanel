<h4>Rejected Leads</h4>
<div class="row-fluid">
<div class="span12">
<?php
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
<style>
	body {
	overflow-x:hidden;
	overflow-y: auto;
}
.table-bordered>thead>tr>th,.table-condensed>tbody>tr>td {
	padding: 2px !important;
	font-size: 11.5px !important;
}
</style>
</div>
</div>
<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="success_msg">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>
<div class="row-fluid">
<div class="span12">
<?php $form=$this->beginWidget('CActiveForm', array('id' => 'return_leads')); ?>
<div class="summary">Total Result: <?php echo $total; ?></div>
     
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
	<th><input type="checkbox" id="selectall" title="Select All"></th>
	<th>Date Time</th>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Email</th>
	<th>Postal Address</th>
	<th>Campus</th>
	<th>Affiliate</th>
	<th>Lead Status</th>
	<th>Phone</th>
	<th>Ip Address</th>
	<th>Action</th>
</tr>
</thead>
<tbody>
<?php
if(isset($posts) && !empty($posts)){
foreach ($posts as $sub_leads) { ?>
	<tr class="post">
	<td>
	<?php
		if(isset($supression_emails) && !empty($supression_emails)) {
			if(in_array($sub_leads['email'], $supression_emails)) { }
			else {
				?>
					<input type="checkbox" class="return" name="returns[]" title="Return this lead" value="<?php echo $sub_leads['id'];?>">
				<?php
			}
		} else {
			?>
				<input type="checkbox" class="return" name="returns[]" title="Return this lead" value="<?php echo $sub_leads['id'];?>">
			<?php
		}
	?>
	</td>
	<td style="width:150px;"><?php echo $sub_leads['sub_date']; ?></td>
	<td style="width:150px;"><?php echo $sub_leads['first_name']; ?></td>
	<td style="width:150px;"><?php echo $sub_leads['last_name']; ?></td>
	<td style="width:150px;"><?php echo $sub_leads['email']; ?></td>
	<td style="width:150px;"><?php echo $sub_leads['address']."<br/><b>City :</b>".$sub_leads['city']."<br><b>State :</b>".$sub_leads['state']."<br><b>Zipcode :</b> ".$sub_leads['zip']; ?></td>
	<td style="width:150px;"><?php echo $sub_leads['campus']; ?></td>
	<td style="width:150px;"><?php print_r($aff_data[$sub_leads['promo_code']]); ?></td>
	<td style="width:150px;">
		<?php if($sub_leads['lead_status']=='1'){
				echo "ACCEPTED";
			}
			else if($sub_leads['lead_status']=='0'){
				echo "REJECTED";
			}
			else if($sub_leads['lead_status']=='-1'){
				echo "ERROR";
			}
			else if($sub_leads['lead_status']=='2'){
				echo "RETURNED";
			}
			else{
				echo "ERROR";
			}
			echo "<br><b style='color:red;'>Reason : </b>";
			echo $sub_leads['military'];
		?>
	</td>
	<td><?php echo $sub_leads['phone']; ?></td>
	<td><?php echo $sub_leads['ipaddress']; ?></td>
	<td>
	<?php
		if(isset($supression_emails) && !empty($supression_emails)) {
			if(in_array($sub_leads['email'], $supression_emails)) { }
			else {
				?>
					<a href="?id=<?php echo $sub_leads['id']; ?>">Send Email</a>
				<?php
			}
		} else {
			?>
				<a href="?id=<?php echo $sub_leads['id']; ?>">Send Email</a>
			<?php
		}
	?>
	</td>
</tr>
<?php }
}
	else{
		if(empty($posts)){ echo '<tr><td colspan="12" align="center"><div class="alert alert-danger" align="center"><h4>No data found for this criteria.</h4></div></td></tr>'; }
	}	
?>
</tbody>
</table>

    <?php
/**Generate Paggination Link*/
$this->widget('CLinkPager', array('pages' => $pages));
?>
<?php if(count($posts)) { ?>
<div class="notify form-inline">
	<p class="reson_and_submit form-group">
		<?php echo CHtml::submitButton('Notify Affiliate Thorugh Email',array('class'=>'btn btn btn-primary','id'=>'return_leads_submit')); ?><br><br>
	</p>
	<!-- Display PHP Errors -->
	<?php if(isset($errors) && !empty($errors)) { ?>
		<div id="error" style="display: block !important;">
		<?php foreach($errors as $error) { ?>
			<p class='error'><?php echo $error;?></p>
		<?php } ?>
		</div>
	<?php } ?>

	<!-- Display Jquery Validation Errors -->
	<div id="error"></div>
</div>
<?php }
$this->endWidget();
?>
</div>
</div>
<?php
/**Generate Paggination Link*/
/* $this->widget('CLinkPager', array('pages' => $pages)); */
?>
<style>
.morecontent span { display: none; }
.comment { width: 400px; }
textarea#field_value {width: 220px;}
#reset { width: 78px;}
.datehide{display:none;}
.infinite_navigation{display: none;}
.summary {font-size: 14px; margin: 0 0 5px 5px;font-weight: bold;}
input[type="text"].reason{margin: 0 0 10px;width: 100%; max-width: 500px;vertical-align: top;}
p.reson_and_submit{text-align: center;width: 100%;}
.error{color:red;}
div#error {display:none;background: none repeat scroll 0 0 lightyellow;border: 1px solid red;margin-bottom: 15px;width: 50%;margin-left: 35px;}
p.error {margin: 0;padding: 1px 13px;font-size: 15px;}
.success_msg{font-size: 16px;color:green;margin: 10px 0;}
</style>
<?php
Yii::app()->clientScript->registerScript('myHideEffect','$(".success_msg").animate({opacity: 1.0}, 2000).fadeOut("slow");',CClientScript::POS_READY);
?>
<script>
$(document).ready(function() {
	var showChar = 120;
	var ellipsestext = "...";
	var moretext = "more";
	var lesstext = "less";
	$('.more').each(function() {
		var content = $(this).html();
		if(content.length > showChar) {
			var c = content.substr(0, showChar);
			var h = content.substr(showChar-1, content.length - showChar);
			var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
			$(this).html(html);
		}
	});
	$(".morelink").click(function(){
		if($(this).hasClass("less")) {
		$(this).removeClass("less");
			$(this).html(moretext);
		} else {
			$(this).addClass("less");
			$(this).html(lesstext);
		}
		$(this).parent().prev().toggle();
		$(this).prev().toggle();
		return false;
	});
	if('<?php echo $time;?>'=='specific_date') $('.datehide').show();
	$("input[name=time]").click(function(){
		if(jQuery(this).val()=='specific_date'){
			$('.datehide').show();
		}else{
			$('.datehide').hide();
		}
	});
	$("#reset").click(function(){
		$.ajax({
			url: '<?php echo Yii::app()->createUrl('ajax'); ?>/?reset=returned_leads_searched_parameters',
			success: function(data) {
				window.location = window.location.pathname;
			}
		});
	});
	$('#selectall').click(function(event) {  //on click
        if(this.checked) { // check select status
            $('.return').each(function() { //loop through each checkbox
                this.checked = true;  //select all checkboxes with class "checkbox1"              
            });
        }else{
            $('.return').each(function() { //loop through each checkbox
                this.checked = false; //deselect all checkboxes with class "checkbox1"                      
            });        
        }
    });

	$("#return_leads_submit").click(function(){
		var atLeastOneIsChecked = $('input[name="returns[]"]:checked').length;
		// var reason = $("#reason").val();
		var error_msg = [];
		var error = 1;
		
		if(atLeastOneIsChecked=='0'){
			error_msg.push("<p class='error'>Please select any checkbox(s) from above results</p>");
			error = 0;
		}
		/*if(reason==''){
			error_msg.push("<p class='error'>Please specify reason to return the lead(s)</p>");
			error = 0;
		}*/
		if(error == 0){
			var error_msg_str = '';
			$.each(error_msg, function( index, value ) {
				error_msg_str = error_msg_str + value;
			});
			$("#error").show();
			$("#error").html(error_msg_str);
			return false;
		}
	});
});
</script>
