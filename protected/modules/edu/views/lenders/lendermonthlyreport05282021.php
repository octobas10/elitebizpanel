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
			CHtml::listData(LenderDetails::model()->findAll(),'name','name'),
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
$column_vise_leads_sum = 0;$column_vise_total_accepted_sum = 0;$column_vise_total_returned_leads = 0;$total_turn_over = 0;$total_profit = 0;$column_vise_grand_total=0;
//echo '<pre>';print_r($campus_details);exit;
foreach ($lender_array as $lender => $lender_lead_price) {
	$rowspan = '';
	$count = count($lender_lead_price['transactions']);
	if($count > 1){
		$rowspan = 'rowspan="'.$count.'"  style="vertical-align: middle;"';
	}
	echo '<tr><td '.$rowspan.' width="120px;">'.$lender.'</td>';
	$i=1;
	//echo '<pre>';print_r($lender_lead_price);
	foreach ($lender_lead_price['transactions'] as $lead_prices){
		$lead_price = $lead_prices['lead_price'];
		$leads = $lead_prices['leads'];$valid = $lead_prices['valid'];
		$column_vise_leads_sum +=$leads;
		$monthly_cap = ($campus_details[$lead_prices['campus_code']]['monthly_limit']) == '-1' ? 'No Cap' : ($campus_details[$lead_prices['campus_code']]['monthly_limit']);
		$style =  ($campus_details[$lead_prices['campus_code']]['active_campus']) == '0' ? '"text-decoration:line-through;"' : '';
		echo '<td width="120px;"><span style='.$style.'>'.$lead_prices['campus_code'].'</span></td>';
		echo '<td width="120px;">'.$monthly_cap.'</td>';
		echo '<td width="120px;"><a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/leads/lead_info?&lender='.$lender.'&start_date='.$start_date.'&end_date='.$end_date.'&promo_code='.$promo_code.'&campus='.$lead_prices['campus_code'].'">'.$leads.'</a></td>';
		if($i==1){
			$column_vise_total_accepted_sum += $lender_lead_price['total_accepted_leads'];
			echo '<td '.$rowspan.' width="120px;"><a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/leads/lead_info?&lender='.$lender.'&start_date='.$start_date.'&end_date='.$end_date.'&promo_code='.$promo_code.'">'.$lender_lead_price['total_accepted_leads'].'</a></td>';

			$column_vise_total_returned_leads += $lender_lead_price['total_returned_leads'];
			echo '<td '.$rowspan.' width="120px;"><a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/leads/lead_info?&lender='.$lender.'&start_date='.$start_date.'&end_date='.$end_date.'&promo_code='.$promo_code.'&is_returned=1">'.$lender_lead_price['total_returned_leads'].'</a></td>';
		}
		echo '<td width="120px;"><a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/leads/lead_info?&lender='.$lender.'&start_date='.$start_date.'&end_date='.$end_date.'&promo_code='.$promo_code.'&campus='.$lead_prices['campus_code'].'&valid=1">'.$valid.'</a></td>';
		if($i==1){
			$column_vise_grand_total += $lender_lead_price['grand_total'];
			echo '<td '.$rowspan.' width="120px;"><a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/leads/lead_info?&lender='.$lender.'&start_date='.$start_date.'&end_date='.$end_date.'&promo_code='.$promo_code.'&final=1">'.$lender_lead_price['grand_total'].'</a></td>';
			
			$total_turn_over += round($lender_lead_price['turn_over'],2);
			//$total_profit += round($lender_lead_price['total_profit_per_lender'],2);
			echo '<td '.$rowspan.'  width="120px;">$'.round($lender_lead_price['turn_over'],2).'</td>';
		}
		echo '</tr>';
		$i++;
	}
}
echo '<tr>'
		.'<td><b>Total</b></td>'
		.'<td></td>'.'<td></td>'
		.'<td><b>'.$column_vise_leads_sum.'</b></td>'
		.'<td><b>'.$column_vise_total_accepted_sum.'</b></td>'
		.'<td><b>'.$column_vise_total_returned_leads.'</b></td>'
		.'<td><b>'.$column_vise_grand_total.'</b></td>'
    	.'<td><b>$'.$total_turn_over.'</b></td>'
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