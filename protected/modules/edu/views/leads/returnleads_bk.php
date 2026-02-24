<h4>Return Leads</h4>
<div class="row-fluid">
<div class="span12">
<?php 
$promo_code = Yii::app()->getRequest()->getParam('promo_code'); 
$lenders = Yii::app()->getRequest()->getParam('lenders');
$lead_status = Yii::app()->getRequest()->getParam('lead_status',1);
$field = Yii::app()->getRequest()->getParam('field','email');
$field_value = Yii::app()->getRequest()->getParam('field_value');
$time = Yii::app()->getRequest()->getParam('time','hour');
$filter = Yii::app()->getRequest()->getParam('filter',date('m/d/Y'));

$this->beginWidget('zii.widgets.CPortlet', array('title'=>"Search",));
$form=$this->beginWidget('CActiveForm', array('id' => 'return_leads_search', 'enableAjaxValidation' => false ));
?>
     <div class="table-responsive">
<table class="table table-striped table-hover table-bordered table-condensed">
<tr>
	<td style="width:150px;"><br/>
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
	<td style="display:none;" class="datehide"><b>Date Range : </b>
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
	<?php echo CHtml::textField('promo_code', ''.$promo_code.'', array('style'=>'width:62px;')); ?>
	</td>
	<td><b>Lenders :</b><br>
	<?php echo Chtml::listBox('lenders[]', $lenders,
			CHtml::listData(LenderDetails::model()->findAll(),'name','name'),
			array('style'=>'width: 190px;','empty'=>'All Lenders'));
	?>
	</td>
	<td style="width:145px;"><b>Lead Status :</b><br>
	<?php echo CHtml::radioButtonList('lead_status', ''.$lead_status.'', 
			array('1' => ACCEPTED , 'returned' => RETURNED),
			array('labelOptions'=>array('style'=>'display:inline')));
	?>
	</td>
	<td style="width:130px;"><b>Fields :</b><br>
	<?php echo CHtml::radioButtonList('field',''.$field.'', 
			array('email'=>'Email','first_name' => 'First Name', 'last_name' => 'Last Name', 'ipaddress' => 'IP Address', 'ssn' => 'SS#'),	
			array('labelOptions' => array('style'=>'display:inline')));
	?>
	</td>	
	<td><b>Field Value:<b></b></b><br>
	<?php echo(CHtml::textArea('field_value',''.$field_value.'')); ?>
	</td>
	<td><b>Action :</b><br>
	<?php echo CHtml::submitButton('Search',array('class'=>'btn btn btn-primary')); ?><br><br>
	<?php echo CHtml::button('Reset',array('class'=>'btn btn btn-primary','id'=>'reset')); ?>
	</td>
</tr>
         </table></div><?php $this->endWidget();?>
<?php $this->endWidget(); ?>
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
     <div class="table-responsive">
<table id="posts" class="table table-striped table-hover table-bordered table-condensed">
<thead>
<tr>
	<th><input type="checkbox" id="selectall" title="Select All"></th>
   <th>IP Address</th>
	<th>First Name</th>
	<th>Last Name</th>
	<th>Email</th>
	<th>Affiliate</th>
	<th>Lead Status</th>
	<th>Lender</th>
	<th>Price</th>
	<th>Date</th>
</tr>
</thead>
<tbody>
<?php
if(isset($posts) && !empty($posts)){
foreach ($posts as $sub_leads) { ?>
	<tr class="post">
	<td><input type="checkbox" class="return" name="returns[]" title="Return this lead" value="<?php echo $sub_leads['id'];?>"></td>
	<td><?php echo urldecode($sub_leads['ipaddress']);?></td>
	<td><?php echo urldecode($sub_leads['first_name']);?></td>
	<td><?php echo urldecode($sub_leads['last_name']);?></td>
	<td><?php echo urldecode($sub_leads['email']);?></td>
	<td><?php $model = AffiliateUser::model()->findByPk($sub_leads['promo_code']); echo $model->user_name.' ('.$sub_leads['promo_code'].')';?></td>
	<td><?php echo ($sub_leads['is_returned']==1) ? RETURNED : setResponseText($sub_leads['lead_status'])?></td>
	<td><?php $model = LenderDetails::model()->findByPk($sub_leads['lender_id']);	echo $model->name;?></td>
	<td><?php echo urldecode($sub_leads['lender_lead_price']); ?></td>
	<td><?php echo $sub_leads['sub_date'];?></td>
	</tr>
<?php }
}
	else{
		if(empty($posts)){ echo '<tr><td colspan="10" align="center"><div class="alert alert-danger" align="center"><h4>No data found for this criteria.</h4></div></td></tr>'; }
	}	
?>
</tbody>
</table>
    </div>
<?php if(count($posts)){?>
<div class="notify form-inline text-center">
<p class="reson_and_submit form-group">Reason for Returned Lead : <input type="text" name="reason" class="reason form-control" id="reason">&nbsp;&nbsp;
<?php echo CHtml::submitButton('Notify Affiliate of Bad Lead(s)',array('class'=>'btn btn btn-primary','id'=>'return_leads_submit')); ?><br><br>
</p>
<!-- Display PHP Errors -->
<?php if(isset($errors) && !empty($errors)){?>
	<div id="error" style="display: block !important;">
	<?php foreach($errors as $error){?>
		<p class='error'><?php echo $error;?></p>
	<?php }?>
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
