<?php
$this->breadcrumbs=array('Lender Report');
$this->menu=array(array('label'=>'Lender Setup','url'=>array('index')),array('label'=>'Lender Stats','url'=>array('lenderstats')));

$filter_date = Yii::app()->request->getParam('filter_date',date('Y-m-d'));
$lender = Yii::app()->request->getParam('lender');
?>
<h4>Lender Report</h4>
<div class="row-fluid">
<div class="span12">
<?php
$this->beginWidget('zii.widgets.CPortlet', array('title'=>"Search",));
$form=$this->beginWidget('CActiveForm', array('id' => 'lender_reports', 'enableAjaxValidation' => false ));
?>
<table class="table table-striped table-hover table-bordered table-condensed">
<tr>
	<td style="width:100px;"><b>Date Range : </b>
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
	<td style="width:130px;"><b>Lender :</b><br>
	<?php echo Chtml::dropDownList('lender', $lender,
			CHtml::listData(LenderDetails::model()->findAll(),'id','name'),
			array('style'=>'width:auto;','empty'=>'All Lenders'));
	?>
	</td>
	<td><b>Action :</b><br>
	<?php echo CHtml::submitButton('Search',array('class'=>'btn btn btn-primary')); ?>
	</td>
</tr>
</table>
<?php
$this->endWidget();
$this->endWidget();
?>
</div>
</div>
<div class="row-fluid">
<div class="span12">
<table class="table table-striped table-hover table-bordered table-condensed">
<thead>
	<tr>
	<th>Lender</th>
	<th>Lead Price</th>
	<th>Leads Accepted</th>
	<th>Total Accepted</th>
	<th>Returned</th>
	<th>Grand Total</th>
	<th>Turn Over / Profit Sum</th>
	</tr>
</thead>
<tbody>
<?php
$start_date = $searched_data['filter_date']['start_date'];
$end_date = $searched_data['filter_date']['end_date']; 

$column_vise_leads_sum = 0;$column_vise_total_accepted_sum = 0;$column_vise_total_returned_leads = 0;$total_turn_over = 0;$total_profit = 0;$column_vise_grand_total=0;
foreach ($lender_array as $lender => $lender_lead_price) {
	$rowspan = '';
	$count = count($lender_lead_price['transactions']);
	if($count > 1){
		$rowspan = 'rowspan="'.$count.'"  style="vertical-align: middle;"';
	}
	echo '<tr><td '.$rowspan.' width="120px;">'.$lender.'</td>';
	$i=1;
	
	foreach ($lender_lead_price['transactions'] as $lead_prices){
		$lead_price = $lead_prices['lead_price'];
		$leads = $lead_prices['leads'];
		$column_vise_leads_sum +=$leads;
		echo '<td width="120px;">$'.$lead_price.'</td>';
		echo '<td width="120px;"><a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/leads/lead_info?lead_price='.$lead_price.'&lender='.$lender.'&start_date='.$start_date.'&end_date='.$end_date.'">'.$leads.'</a></td>';
		
		if($i==1){
			$column_vise_total_accepted_sum += $lender_lead_price['total_accepted_leads'];
			echo '<td '.$rowspan.'  width="120px;"><a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/leads/lead_info?&lender='.$lender.'&start_date='.$start_date.'&end_date='.$end_date.'">'.$lender_lead_price['total_accepted_leads'].'</a></td>';

			$column_vise_total_returned_leads += $lender_lead_price['total_returned_leads'];
			echo '<td '.$rowspan.'  width="120px;"><a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/leads/lead_info?&lender='.$lender.'&start_date='.$start_date.'&end_date='.$end_date.'&is_returned=1">'.$lender_lead_price['total_returned_leads'].'</td>';
			
			$column_vise_grand_total += $lender_lead_price['grand_total'];
			echo '<td '.$rowspan.'  width="120px;"><a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/leads/lead_info?&lender='.$lender.'&start_date='.$start_date.'&end_date='.$end_date.'&final=1">'.$lender_lead_price['grand_total'].'</a></td>';
			
			$total_turn_over += round($lender_lead_price['turn_over'],2);
			$total_profit += round($lender_lead_price['total_profit_per_lender'],2);
			echo '<td '.$rowspan.'  width="120px;">$'.round($lender_lead_price['turn_over'],2).'</td>';
		}
		echo '</tr>';
		$i++;
	}
	
}
echo '<tr>'
		.'<td><b>Total</b></td>'
		.'<td></td>'
		.'<td><b>'.$column_vise_leads_sum.'</b></td>'
		.'<td><b>'.$column_vise_total_accepted_sum.'</b></td>'
		.'<td><b>'.$column_vise_total_returned_leads.'</b></td>'
		.'<td><b>'.$column_vise_grand_total.'</b></td>'
    	.'<td><b>$'.$total_turn_over.'</b></td>'
	.'</tr>';
 ?>
</tbody>
</table>
</div></div>
<style>
.morecontent span { display: none; }
.comment { width: 400px; }
table{ text-align: center; vertical-align: middle;}
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
