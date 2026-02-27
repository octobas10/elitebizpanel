<?php
$filter_date = Yii::app()->getRequest()->getParam('filter_date','Today');
$promo_code = Yii::app()->getRequest()->getParam('promo_code');
?>
<h4>Posted Leads Report</h4>
<div class="row-fluid">
<div class="span12">
<?php
$this->beginWidget('zii.widgets.CPortlet', array('title'=>"Search",));
$form=$this->beginWidget('CActiveForm', array('id' => 'return_leads_search', 'enableAjaxValidation' => false ));
?>
<table class="table table-striped table-hover table-bordered table-condensed">
<tr>
	<td style="min-width:auto;"><b>Date Range : </b>
	<?php 
		$this->widget('ext.EDateRangePicker.EDateRangePicker',array(
	    	'id'=>'Filter_date',
	    	'name'=>'filter_date',
	    	'value'=>''.$filter_date.'',
	    	'options'=>array('arrows'=>true,'closeOnSelect'=>true),
	    	'htmlOptions'=>array('class'=>'inputClass'),
    	));
		?>
	</td>
	<td style="width:130px;"><b>Affiliate :</b><br>
	<?php echo Chtml::dropDownList('promo_code', $promo_code, get_affiliate_name_and_promocode(), array('style'=>'width:auto;','empty'=>'All Affiliates','size'=>'6')); ?>
	</td>
	<td><b>Action :</b><br>
	<?php echo CHtml::submitButton('Search',array('class'=>'btn btn btn-primary')); ?><br><br>
	<?php echo CHtml::button('Reset',array('class'=>'btn btn btn-primary','id'=>'reset')); ?>
	</td>
</tr>
</table>
<?php
$this->endWidget();
$this->endWidget();
?>
</div>
</div>
<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="success_msg">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>
<div class="row-fluid">
<div class="span12">
<?php
$start_date = $searched_data['filter_date']['start_date'];
$end_date = $searched_data['filter_date']['end_date'];
$form=$this->beginWidget('CActiveForm', array('id' => 'posted_leads'));
?>
<div class="summary">Total Result: <?php echo count($posts['postedleads_result']); ?></div>
<table id="posts" class="table table-striped table-hover table-bordered table-condensed">
<thead>
<tr>
   <th rowspan="2">Affiliate Name</th>
	<th rowspan="2">Ping Sent</th>
	<th rowspan="2">Ping Accepted</th>
	<th rowspan="2">Post Sent</th>
	<?php if(!empty($posts['postedleads_ping_prices'])){?>
	<th colspan="<?php echo count($posts['postedleads_ping_prices']);?>" style="text-align: center;">Lead Prices</th>
	<?php }?>
	<th rowspan="2">Post Accepted</th>
	<th rowspan="2">Returned</th>
	<th rowspan="2">Final</th>
</tr>
<tr>
	<?php foreach($posts['postedleads_ping_prices'] as $price){?>
   <th>$<?php echo $price;?></th>
	<?php } ?>
</tr>
</thead>
<tbody>
<?php
$column_wise_total_ping_sent = $column_wise_total_ping_accepted = $colum_wise_total_post_sent = $column_wise_total_post_accepted = $column_wise_returned = $column_wise_final_total = 0;$sum = array();
foreach($posts['postedleads_result'] as $promo_code=>$value) {
	$column_wise_total_ping_sent += $value['total_ping_sent'];
	$column_wise_total_ping_accepted += $value['total_ping_accepted'];
	$colum_wise_total_post_sent += $value['total_post_sent'];
	$column_wise_total_post_accepted += $value['total_post_accepted'];
	$column_wise_returned += $value['returned'];
	$column_wise_final_total += ($value['total_post_accepted'])-($value['returned']);
?>
<tr>
<td><?php echo $posts['postedleads_promo_codes'][$promo_code].' ('.$promo_code.')';?></td>

<td><?php if(!empty($value['total_ping_sent'])){?><a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/leads/lead_info?posting_type=0&promo_code='.$promo_code.'&start_date='.$start_date.'&end_date='.$end_date;?>"><?php } echo $value['total_ping_sent'];?></a></td>
	
<td><?php if(!empty($value['total_ping_accepted'])){?><a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/leads/lead_info?posting_type=0&promo_code='.$promo_code.'&start_date='.$start_date.'&end_date='.$end_date.'&ping_status=1';?>"><?php } echo $value['total_ping_accepted'];?></a></td>
	
<td><?php if(!empty($value['total_post_sent'])){?><a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/leads/lead_info?posting_type=0&promo_code='.$promo_code.'&start_date='.$start_date.'&end_date='.$end_date.'&post_sent=1';?>"><?php } echo $value['total_post_sent'];?></a></td>
	
<?php
foreach($posts['postedleads_ping_prices'] as $price){
$sum[$price] += $value[$price]['post_accepted'];?>
<td><?php if(!empty($value[$price]['post_accepted'])){?><a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/leads/lead_info?posting_type=0&lead_price='.$price.'&promo_code='.$promo_code.'&start_date='.$start_date.'&end_date='.$end_date;?>"><?php } echo (($value[$price]['post_accepted'])!='' ? $value[$price]['post_accepted'] : 0); ?></a></td>
<?php } ?>

<td><?php if(!empty($value['total_post_accepted'])){?><a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/leads/lead_info?posting_type=0&promo_code='.$promo_code.'&start_date='.$start_date.'&end_date='.$end_date.'&post_status=1';?>"><?php } echo $value['total_post_accepted'];?></a></td>

<td><?php if(!empty($value['returned'])){?><a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/leads/lead_info?posting_type=0&promo_code='.$promo_code.'&start_date='.$start_date.'&end_date='.$end_date.'&is_returned=1';?>"><?php } echo $value['returned'];?></a></td>

<td><?php $final = $value['total_post_accepted']-$value['returned']; if(!empty($final)){?><a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/leads/lead_info?posting_type=0&promo_code='.$promo_code.'&start_date='.$start_date.'&end_date='.$end_date.'&post_status=1&is_returned=0';?>"><?php } echo $final;?></a></td>
</tr> 
<?php } ?>
</tbody>
<tfoot>
	<tr>
		<th>Total</th>
		<th><?php echo $column_wise_total_ping_sent;?></th>
		<th><?php echo $column_wise_total_ping_accepted;?></th>
		<th><?php echo $colum_wise_total_post_sent;?></th>
		<?php foreach($posts['postedleads_ping_prices'] as $price){?>
	   <th><?php echo $sum[$price];?></th>
		<?php } ?>
		<th><?php echo $column_wise_total_post_accepted;?></th>
		<th><?php echo $column_wise_returned;?></th>
		<th><?php echo $column_wise_final_total;?></th>
	</tr>
</tfoot>
</table>
<?php
$this->endWidget();
?>
</div>
</div>
<?php
/**Generate Paggination Link*/
//$this->widget('CLinkPager', array('pages' => $pages));
?>
<style>
.morecontent span { display: none; }
.comment { width: 400px; }
textarea#field_value {width: 250px;}
#reset { width: 78px;}
.datehide{display:none;}
.infinite_navigation{display: none;}
.summary {font-size: 14px; margin: 0 0 5px 5px;font-weight: bold;}
input[type="text"].reason{margin: 0;width: 500px;}
p.reson_and_submit{text-align: center;}
.error{color:red;}
div#error {
	display:none;
	background: none repeat scroll 0 0 lightyellow;
   border: 1px solid red;
   margin-bottom: 15px;
   width: 50%;
   margin-left: 35px;
}
p.error {
   margin: 0;
   padding: 1px 13px;
   font-size: 15px;
}
.success_msg{font-size: 16px;color:green;margin: 10px 0;}
</style>
<?php
Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".success_msg").animate({opacity: 1.0}, 2000).fadeOut("slow");',
   CClientScript::POS_READY
);
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
		var atLeastOneIsChecked = $('input[name="return[]"]:checked').length;
		var reason = $("#reason").val();
		var error_msg = [];
		var error = 1;
		
		if(atLeastOneIsChecked=='0'){
			error_msg.push("<p class='error'>Please select any checkbox(s) from above results</p>");
			error = 0;
		}
		if(reason==''){
			error_msg.push("<p class='error'>Please specify reason to return the lead(s)</p>");
			error = 0;
		}
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
