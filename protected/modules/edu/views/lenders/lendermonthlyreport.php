<?php
$this->breadcrumbs=array('Lender Monhly Report');
$this->menu=array(array('label'=>'Lender Setup','url'=>array('index')),array('label'=>'Lender Stats','url'=>array('lenderstats')));
$promo_code = Yii::app()->getRequest()->getParam('promo_code'); 
$filter_date = Yii::app()->request->getParam('filter_date',date('n/j/Y'));
$lender = Yii::app()->request->getParam('lender');
?>
<h4>Lender Monthly Report</h4>
<div class="row-fluid">
<div class="span12">
<?php
$this->beginWidget('zii.widgets.CPortlet', array('title'=>"Search",));
$form = $this->beginWidget('CActiveForm', array('id' => 'lender_reports', 'enableAjaxValidation' => false ));
?>
<div class="table-responsive">
<table class="table table-striped table-hover table-bordered table-condensed">
<tr>
	<td style="width:100px;"><b>Year : </b><br>
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
	<td style="width:130px;"><b>Promo Code :</b><br>
	<?php echo CHtml::textField('promo_code', ''.$promo_code.'', array('style'=>'width:62px;')); ?>
	</td>
	<td><b>Action :</b><br>
	<?php echo CHtml::submitButton('Search',array('class'=>'btn btn btn-primary')); ?>
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
<div class="row">
<div class="col-sm-12">
    <div class="table-responsive">
<table class="table table-striped table-hover table-bordered table-condensed">
<thead>
	<tr>
	<th>Lender</th>
	<th>Campus</th>
	<th>Monthly Limit</th>
	<th>Leads Accepted</th>
	<th>Total Accepted</th>
	<th>Returned</th>
	<th>Valid</th>
	<th>Grand Total</th>
	<th>Turn Over / Profit Sum</th>
	</tr>
</thead>
<tbody>
<?php
$start_date = $searched_data['filter_date']['start_date'];
$end_date = $searched_data['filter_date']['end_date']; 
$promo_code = $searched_data['promo_code']; 
$total_leads=0;$total_returned=0;$total_profit=0;$total_turn_over=0;
foreach ($lender_array as $lender => $lender_lead_price) {
	$rowspan = '';$i=0;
	$count = count($lender_lead_price);
	if($count > 1){
		$rowspan = 'rowspan="'.$count.'" style="vertical-align: middle;"';
	}
	$buyer_leads = 0;$buyer_lead_price=0;$buyer_lead_margin=0;$buyer_leads_return=0;$buyer_turn_over=0;$buyer_profit=0;
	foreach ($lender_lead_price as $lead_prices){
		// MONTHLY CAP
		$monthly_cap = ($campus_details[$lead_prices['campus_code']]['monthly_limit']) == '-1' ? 'No Cap' : ($campus_details[$lead_prices['campus_code']]['monthly_limit']);
		$style =  ($campus_details[$lead_prices['campus_code']]['active_campus']) == '0' ? '"text-decoration:line-through;"' : '';
		// MONTHLY CAP
		echo '<tr>';
		if($i == 0){
			echo '<td '.$rowspan.' width="100px;">'.$lender.'</td>';
		}
		echo '<td width="120px;"><span style='.$style.'>'.$lead_prices['campus_code'].' ('.$lead_prices['campus_id'].')</span></td>';
		echo '<td width="120px;">'.$monthly_cap.'</td>';
		echo '<td width="120px;"><a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/leads/lead_info?&lender='.$lender.'&start_date='.$start_date.'&end_date='.$end_date.'&promo_code='.$promo_code.'&campus='.$lead_prices['campus_code'].'">'.$lead_prices['leads'].'</a></td>';
		if($i==0){
			$buyer_leads = $lender_total[$lender]['leads'];
			echo '<td '.$rowspan.' width="200px;"><a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/leads/lead_info?&lender='.$lender.'&start_date='.$start_date.'&end_date='.$end_date.'&promo_code='.$promo_code.'">'.$buyer_leads.'</a></td>';
			$buyer_leads_return = $lender_total[$lender]['returned'];
			echo '<td '.$rowspan.' width="120px;"><a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/leads/lead_info?&lender='.$lender.'&start_date='.$start_date.'&end_date='.$end_date.'&promo_code='.$promo_code.'&is_returned=1">'.$buyer_leads_return.'</a></td>';
		}
		$buyer_lead_valid = $lead_prices['valid'];
		echo '<td width="120px;"><a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/leads/lead_info?&lender='.$lender.'&start_date='.$start_date.'&end_date='.$end_date.'&promo_code='.$promo_code.'&campus='.$lead_prices['campus_code'].'&valid=1">'.$buyer_lead_valid.'</a></td>';
		if($i==0){
			$column_vise_grand_total += $lender_lead_price['grand_total'];
			echo '<td '.$rowspan.' width="120px;"><a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/leads/lead_info?&lender='.$lender.'&start_date='.$start_date.'&end_date='.$end_date.'&promo_code='.$promo_code.'&final=1">'.($buyer_leads-$buyer_leads_return).'</a></td>';
			// LAST COLUMN
			$buyer_turn_over = (($buyer_leads-$buyer_leads_return)*$lead_prices['lead_price']);
			$buyer_profit = (($buyer_leads-$buyer_leads_return)*$lead_prices['lead_price'])/50;
			echo '<td '.$rowspan.' width="120px;">$'.number_format($buyer_turn_over,2).' / $'.number_format($buyer_profit,2).'</td>';
		}
		echo '</tr>';
		$i++;
	}
	//$total_leads += $column_vise_grand_total;
	$total_accepted += round($buyer_leads,2);
	$total_returned += round($buyer_leads_return,2);
	$grand_total += round($buyer_leads-$buyer_leads_return,2);
	$total_profit += round($buyer_profit,2);
	$total_turn_over += round($buyer_turn_over,2);
}
	echo '<tr>'
		.'<td><b>Total</b></td>'
		.'<td></td><td></td>'
		.'<td><b></b></td>'
		.'<td><b>'.$total_accepted.'</b></td>'
		.'<td><b>'.$total_returned.'</b></td>'
		.'<td><b>'.$grand_total.'</b></td><td></td>'
    	.'<td><b>$'.$total_turn_over.' / $'.$total_profit.'</b></td>'
	.'</tr>';
 ?>
</tbody>
</table>
</div>
</div></div>
<style>
.morecontent span { display: none; }
.comment { width: 400px; }
table{ vertical-align: middle;}
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