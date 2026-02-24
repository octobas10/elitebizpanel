<?php
$aff_data = get_affiliate_name_and_promocode();
$lender_data = get_lender_name_and_lender_id();
?>
<h4>
Lead Infomation Report for 
<?php
if($lender = Yii::app()->getRequest()->getParam('lender')){echo 'Lender '.$lender;}
elseif($promo_code = Yii::app()->getRequest()->getParam('promo_code')){echo 'Affiliate '.$aff_data[$promo_code];}
?>
</h4>
<div class="row-fluid">
<div class="span12">
<div class="searched_data">
<br>
<?php if($lender_lead_price = Yii::app()->getRequest()->getParam('lead_price')){?>
<p>Lender Price: <?php echo $lender_lead_price;?></p>
<?php }?>
<p>From Date: <?php echo date('Y-m-d',strtotime($_REQUEST['start_date']));?></p>
<p>To Date: <?php echo date('Y-m-d',strtotime($_REQUEST['end_date']));?></p>
</div>
<table class="table table-striped table-hover table-bordered table-condensed">
<thead>
	<tr>
	<th>Sr.</th>
	<?php if(!$promo_code){?>
	<th>Promo Code</th>
	<?php }else{?>
	<th>Lender Name</th>
	<?php }?>
	<th>FirstName</th>
	<th>LastName</th>
	<th>Email</th>
	<th>Phone</th>
	<th>SSN</th>
	<th>ZIP Code</th>
	<th>IP Address</th>
	<th>Date</th>
	<?php if(!$lender){?>
	<th>Vendor Price</th>
	<?php }else{?>
	<th>Lender Price</th>
	<?php }?>
	</tr>
</thead>
<tbody>
<?php 
$i=1;
$vendor_lead_price=0;
foreach($lead_info_reports as $lead_info_report){
	if(!$lender){
		$lead_price += $lead_info_report['vendor_lead_price'];
	}else{
		$lead_price += $lead_info_report['lender_lead_price'];
	}
	?>
	<tr>
	<td><?php echo $i;?></td>
	<td><?php if(!$promo_code){echo $lead_info_report['promo_code'];}else{echo $lender_data[$lead_info_report['lender_id']];}?></td>
	<td><?php echo $lead_info_report['first_name'];?></td>
	<td><?php echo $lead_info_report['last_name'];?></td>
	<td><?php echo $lead_info_report['email'];?></td>
	<td><?php echo $lead_info_report['campus'];?></td>
	<td><?php echo $lead_info_report['program_of_interest'];?></td>
	<td><?php echo $lead_info_report['zip'];?></td>
	<td><?php echo $lead_info_report['ipaddress'];?></td>
	<td><?php echo $lead_info_report['sub_date'];?></td>
	<?php if(!$lender){?>
	<td><?php echo $lead_info_report['vendor_lead_price'];?></td>
	<?php }else{?>
	<td><?php echo $lead_info_report['lender_lead_price'];?></td>
	<?php }?>
	</tr>
	<?php $i++;
}
?>
</tbody>
<tfoot>
<tr>
<td colspan="10"><b>Total:</b></td>
<td><b><?php echo $lead_price;?></b></td>
</tr>
</tfoot>
</table>
</div>
</div>
<?php //echo'<pre>';print_r($_REQUEST);echo'</pre>'; ?>
<style>
.morecontent span { display: none; }
.comment { width: 400px; }
table{ text-align: center;vertical-align: middle;}
.searched_data { margin-bottom: 10px; float: left; width: 100%;}
.searched_data p {float: left; margin-right: 79px; font-weight: bold; font-size: 16px;}
</style>
<script>
$(document).ready(function(){
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
        if($(this).hasClass("less")){
            $(this).removeClass("less");
            $(this).html(moretext);
        }else{
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});
</script>
