<?php
$this->breadcrumbs=array('Lender Report');
$this->menu=array(array('label'=>'List Affiliate User','url'=>array('index')));

$filter_date = Yii::app()->request->getParam('filter_date',date('Y-m-d'));
$promo_code = Yii::app()->request->getParam('promo_code');
?>
<h4>Affiliate Stats</h4>
<div class="row-fluid">
	<div class="span12">
		<?php
		$this->beginWidget('zii.widgets.CPortlet', array('title'=>"Affiliate Stats",));
		$form=$this->beginWidget('CActiveForm',array('id' => 'affiliate_stats','enableAjaxValidation' => false));
		$start_date = $searched_data['filter_date']['start_date'];
		$end_date = $searched_data['filter_date']['end_date'];
		?>
		<table class="table table-striped table-hover table-bordered table-condensed">
			<thead>
				<tr>
					<td style="width: 100px"><b>Date Range : </b>
						<?php
							$default_date = date('Y-m-d',strtotime("-7 day")).' - '.date('Y-m-d');
							$date_filter = Yii::app()->getRequest()->getParam('date_filter',$default_date);
							$this->widget('ext.EDateRangePicker.EDateRangePicker',array(
								'id' => 'Filter_date',
								'name' => 'date_filter',
								'value' => ''.$date_filter.'',
								'options' => array(
									'arrows' => true,
									'closeOnSelect' => true
								),
								'htmlOptions' => array(
									'class' => 'inputClass'
								)
							));
							?>
					</td>
					<td style="width:130px;"><b>Affiliate :</b><br>
					<?php
					echo Chtml::dropDownList('promo_code', $promo_code, get_affiliate_name_and_promocode(), array('style'=>'width:auto;','empty'=>'--Select Affiliate--'));
					?>
					</td>
					<td><b>Action :</b><br>
						<?php echo CHtml::submitButton('Get Affiliate Stats',array('name'=>'affiliatestats_search','id'=>'affiliatestats_search','class'=>'btn btn btn-primary')); ?>
					</td>
				</tr>
			</thead>
		</table>
		<?php $this->endWidget();?>
		<table id="myTable" class="tablesorter table table-striped table-hover table-bordered table-condensed affiliate_report">
			<thead>
				<tr>
					<th>Date</th>
					<th>Ping Sent</th>
					<th>Duplicate Ping</th>
					<th>Ping Accepted</th>
					<th>Post Sent</th>
					<th>Post Accepted</th>
					<th>Lead Returned</th>
					<th>Final Leads</th>
					<th>Revenue</th>
					<th>return$</th>
				</tr>
			</thead>
			<tbody>
				<?php
					foreach($affiliatestats as $k => $affiliatestat){
						$date = date('Y-m-d',strtotime(trim($affiliatestat['date'])));
						$final_leads = ($affiliatestat['post_accepted']-$affiliatestat['lead_returned']);
					?>
				<tr>
					<td align="right"><?php echo $date;?></td>
					<td align="right"><?php echo ($affiliatestat['ping_sent']) ? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'&promo_code='.$promo_code.'">'.$affiliatestat['ping_sent'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($affiliatestat['duplicate_ping']) ? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'&duplicate_ping=1&promo_code='.$promo_code.'">'.$affiliatestat['duplicate_ping'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($affiliatestat['ping_accepted']) ? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'&ping_status=1&promo_code='.$promo_code.'">'.$affiliatestat['ping_accepted'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($affiliatestat['post_sent']) ? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'&post_sent=1&promo_code='.$promo_code.'">'.$affiliatestat['post_sent'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($affiliatestat['post_accepted'])? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'&post_status=1&promo_code='.$promo_code.'">'.$affiliatestat['post_accepted'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($affiliatestat['lead_returned'])? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'&lead_returned=1&promo_code='.$promo_code.'">'.$affiliatestat['lead_returned'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($final_leads)? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'&final=1&promo_code='.$promo_code.'">'.$final_leads.'</a>' : 0;?></td>
					<td align="right">$<?php echo ($affiliatestat['revenue']=='') ? '0.00' : round($affiliatestat['revenue'],2);?></td><td align="right">$<?php echo ($affiliatestat['returndollar']=='') ? '0.00' : round($affiliatestat['returndollar'],2);?></td>
				</tr>
				<?php
					$ping_sent_total += ($affiliatestat['ping_sent']=='') ? 0 : $affiliatestat['ping_sent'];
					$duplicate_ping_total += ($affiliatestat['duplicate_ping']=='') ? 0 : $affiliatestat['duplicate_ping'];
					$ping_accepted_total += ($affiliatestat['ping_accepted']=='') ? 0 : $affiliatestat['ping_accepted'];
					$post_sent_total += ($affiliatestat['post_sent']=='') ? 0 : $affiliatestat['post_sent'];
					$post_accepted_total += ($affiliatestat['post_accepted']=='') ? 0 : $affiliatestat['post_accepted'];
					$lead_returned_total += ($affiliatestat['lead_returned']=='') ? 0 : $affiliatestat['lead_returned'];
					$final_leads_total += $final_leads;
					$revenue_total += ($affiliatestat['revenue']=='') ? 0 : round($affiliatestat['revenue'],2);
					$returndollar_total += ($affiliatestat['returndollar']=='') ? 0 : round($affiliatestat['returndollar'],2);
					}
					?>
			</tbody>
			<tfoot>
				<tr>
					<th class="header" colspan="">Total</th>
					<th class="header" align="right"><?php echo $ping_sent_total;?></th>
					<th class="header" align="right"><?php echo $duplicate_ping_total;?></th>
					<th class="header" align="right"><?php echo $ping_accepted_total;?></th>
					<th class="header" align="right"><?php echo $post_sent_total;?></th>
					<th class="header" align="right"><?php echo $post_accepted_total;?></th>
					<th class="header" align="right"><?php echo $lead_returned_total;?></th>
					<th class="header" align="right"><a target="_blank" href="<?php echo Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/leads/lead_info?final=1&posting_type=0&promo_code='.$promo_code.'&start_date='.$start_date.'&end_date='.$end_date;?>"><?php echo $final_leads_total;?></a></th>
					<th class="header" align="right">$<?php echo $revenue_total;?></th>
					<th class="header" align="right">$<?php echo $returndollar_total;?></th>
				</tr>
			</tfoot>
		</table>
	</div>
	<?php $this->endWidget(); ?>
</div>
<script>
$(document).ready(function(){
	$("#affiliatestats_search").click(function(){
		var promo_code = $("#promo_code");
		if(promo_code.val()==''){
			// if($(".error").length==0){
			// 	$('<span class="error">Please Select Affiliate</span>').insertAfter(promo_code);
			// }else{
			// 	$('<span class="error">Please Select Affiliate</span>').show();
			// }
			return true;
		}else{
			return true;
		}
	});
});
</script>
<style>
.error{color: red;}					
</style>
