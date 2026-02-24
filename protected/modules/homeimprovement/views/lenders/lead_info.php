<h4 style="text-align: center;">Lender Reports : Lead Infomation</h4>
<div class="row-fluid">
<div class="span12"></div>
</div>
<div class="row-fluid">
<div class="span12">
<div class="searched_data">
<p>Lender: <?php echo $_REQUEST['lender'];?></p> 
<?php if(isset($_REQUEST['lead_price'])){?>
<p>Lender Price: <?php echo $_REQUEST['lead_price'];?></p>
<?php }?>
<p>From Date: <?php echo date('Y-m-d',strtotime($_REQUEST['start_date']));?></p>
<p>To Date: <?php echo date('Y-m-d',strtotime($_REQUEST['end_date']));?></p>
</div>
<table class="table table-striped table-hover table-bordered table-condensed">
<thead>
    <tr>
    <th>Sr.</th>
    <th>Promo Code</th>
    <th>FirstName</th>
    <th>LastName</th>
	<th>Email</th>
	<th>Phone</th>
	<th>ZIP Code</th>
	<th>IP Address</th>
	<th>Date</th>
	</tr>
</thead>
<tbody>
<?php 
//echo '<pre>';print_r($lead_info_reports);echo '</pre>';
//echo '<pre>';print_r($_REQUEST);echo '</pre>';
$i=1;
foreach ($lead_info_reports as $lead_info_report){
	echo '<tr><td>'.$i.'</td><td>'.$lead_info_report['promo_code'].'</td><td>'.$lead_info_report['first_name'].'</td><td>'.$lead_info_report['last_name'].'</td><td>'.$lead_info_report['email'].'</td><td>'.$lead_info_report['phone'].'</td><td>'.$lead_info_report['zip'].'</td><td>'.$lead_info_report['ipaddress'].'</td><td>'.$lead_info_report['sub_date'].'</td>';
	$i++;
}
?>

</tbody>
</table>
</div>
</div>
<style>
.morecontent span { display: none; }
.comment { width: 400px; }
table{ text-align: center;vertical-align: middle;}
.searched_data { margin-bottom: 10px; float: left; width: 100%;}
.searched_data p {float: left; margin-left: 79px; font-weight: bold; font-size: 16px;}
</style>
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
});
</script>