<?php
$this->breadcrumbs=array('Lender Report');
$this->menu=array(array('label'=>'Lender Setup','url'=>array('index')),array('label'=>'Lender Report','url'=>array('lenderreport')));

$filter_date = Yii::app()->request->getParam('filter_date',date('n/j/Y'));
$lender_name = Yii::app()->request->getParam('lender_name');
?>
<h4>Lender Stats</h4>
<div class="row">
	<div class="col-sm-12">
		<?php
		$this->beginWidget('zii.widgets.CPortlet', array('title'=>"Lender Stats",));
		$form=$this->beginWidget('CActiveForm',array('id' => 'lender_stats','enableAjaxValidation' => false));
		?>
        <div class="table-responsive">
		<table class="table table-striped table-hover table-bordered table-condensed">
			<thead>
				<tr>
					<td style="width: 100px"><b>Date Range : </b>
						<?php
							$default_date = date('n/j/Y',strtotime("-7 day")).' - '.date('n/j/Y');
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
					<td style="width:130px;"><b>Lender :</b><br>
					<?php echo Chtml::dropDownList('lender_name', $lender_name,
							CHtml::listData(LenderDetails::model()->findAll(),'name','name'),
							array('style'=>'width:auto;','empty'=>'All Lenders'));
					?>
					</td>
					<td><b>Action :</b><br>
						<?php echo CHtml::submitButton('Get Lender Stats',array('name'=>'lenderstats_search','id'=>'lenderstats_search','class'=>'btn btn btn-primary')); ?>
					</td>
				</tr>
			</thead>
		</table>
        </div>
		<?php $this->endWidget();?>
        <div class="table-responsive">
		<table id="myTable" class="tablesorter table table-striped table-hover table-bordered table-condensed affiliate_report">
			<thead>
				<tr>
					<th align="right">Lender</th>
					<th align="right">Date</th>
		<!--
		 * author : vatsal gadhia
		 * modification : Ping Fields Commented
		 * modification date : 22-07-2016 5:45 pm
		 -->
					<!--<th align="right">Ping Sent</th>
					<th align="right">Ping Accepted</th>-->
					<th align="right">Post Sent</th>
					<th align="right">Post Accepted</th>
					<th align="right">Lead Returned</th>
					<th align="right">Final Leads</th>
					<th align="right">Revenue</th>
		<!--
		 * author : vatsal gadhia
		 * modification : Ping Fields Commented
		 * modification date : 22-07-2016 5:45 pm
		 -->
					<!--<th align="right">Average Ping Price</th>-->
				</tr>
			</thead>
			<tbody>
				<?php
					$i = 0;
					$rowspan_counter = -1;
					$previous_rowspan = 0;
					$lender_wise_count = array_count_values(array_map(function($item) {
					   return $item['lender_name'];
					}, $lenderstats));

					foreach($lenderstats as $k => $lenderstat){
						$date = date('Y-m-d',strtotime(trim($lenderstat['date'])));
						$final_leads = ($lenderstat['post_accepted']-$lenderstat['lead_returned']);
						$rowspan_counter++;
					?>
				<tr>
					<?php if($rowspan_counter>$lender_wise_count[$lenderstat['lender_name']] || $rowspan_counter==0 || $lender_wise_count[$lenderstat['lender_name']]!=$previous_rowspan) {
						$rowspan_counter=1;
						$previous_rowspan = $lender_wise_count[$lenderstat['lender_name']];
					?>
					<td align="right" rowspan='<?php echo $lender_wise_count[$lenderstat['lender_name']] ?>'><?php echo ($lenderstat['lender_name']); ?></td>
					<?php } ?>
					<td align="right"><?php echo $date; ?></td>
		<!--
		 * author : vatsal gadhia
		 * modification : Ping Fields Commented
		 * modification date : 22-07-2016 5:45 pm
		 -->
					<!--<td align="right">--><?php //echo ($lenderstat['ping_sent']) ? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/lenders/leadinfo?date='.$date.'&lender_name='.$lender_name.'">'.$lenderstat['ping_sent'].'</a>' : 0;?><!--</td>-->
					<!--<td align="right">--><?php //echo ($lenderstat['ping_accepted']) ? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/lenders/leadinfo?date='.$date.'&ping_status=1&lender_name='.$lender_name.'">'.$lenderstat['ping_accepted'].'</a>' : 0;?><!--</td>-->
					<td align="right"><?php echo ($lenderstat['post_sent']) ? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/lenders/leadinfo?date='.$date.'&post_sent=1&lender_name='.$lender_name.'">'.$lenderstat['post_sent'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($lenderstat['post_accepted'])? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/lenders/leadinfo?date='.$date.'&post_status=1&lender_name='.$lender_name.'">'.$lenderstat['post_accepted'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($lenderstat['lead_returned'])? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/lenders/leadinfo?date='.$date.'&lead_returned=1&lender_name='.$lender_name.'">'.$lenderstat['lead_returned'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($final_leads)? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/lenders/leadinfo?date='.$date.'&final=1&lender_name='.$lender_name.'">'.$final_leads.'</a>' : 0;?></td>
					<td align="right">$<?php echo ($lenderstat['revenue']=='') ? '0.00' : round($lenderstat['revenue'],2);?></td>
		<!--
		 * author : vatsal gadhia
		 * modification : Ping Fields Commented
		 * modification date : 22-07-2016 5:45 pm
		 -->
					<!--<td align="right">$--><?php //echo ($lenderstat['average_ping_price']=='') ? '0.00' : round($lenderstat['average_ping_price'],2);?><!--</td>-->
				</tr>
				<?php
					$ping_sent_total += ($lenderstat['ping_sent']=='') ? 0 : $lenderstat['ping_sent'];
					$ping_accepted_total += ($lenderstat['ping_accepted']=='') ? 0 : $lenderstat['ping_accepted'];
					$post_sent_total += ($lenderstat['post_sent']=='') ? 0 : $lenderstat['post_sent'];
					$post_accepted_total += ($lenderstat['post_accepted']=='') ? 0 : $lenderstat['post_accepted'];
					$lead_returned_total += ($lenderstat['lead_returned']=='') ? 0 : $lenderstat['lead_returned'];
					$final_leads_total += $final_leads;
					$revenue_total += ($lenderstat['revenue']=='') ? 0 : round($lenderstat['revenue'],2);
					$average_ping_price_total += ($lenderstat['average_ping_price']=='') ? 0 : round($lenderstat['average_ping_price'],2);
					$i++;
				}
				?>
			</tbody>
			<tfoot>
				<tr>
					<th class="header" colspan="2">Total</th>
		<!--
		 * author : vatsal gadhia
		 * modification : Ping Fields Commented
		 * modification date : 22-07-2016 5:45 pm
		 -->
					<!--<th class="header" align="right"><?php //echo $ping_sent_total;?></th>
					<th class="header" align="right"><?php //echo $ping_accepted_total;?></th>-->
					<th class="header" align="right"><?php echo $post_sent_total;?></th>
					<th class="header" align="right"><?php echo $post_accepted_total;?></th>
					<th class="header" align="right"><?php echo $lead_returned_total;?></th>
					<th class="header" align="right"><?php echo $final_leads_total;?></th>
					<th class="header" align="right">$<?php echo $revenue_total;?></th>
		<!--
		 * author : vatsal gadhia
		 * modification : Ping Fields Commented
		 * modification date : 22-07-2016 5:45 pm
		 -->
					<!--<th class="header" align="right">$<?php //echo round(($average_ping_price_total/$i),2);?></th>-->
				</tr>
			</tfoot>
		</table>
        </div>
	</div>
	<?php $this->endWidget(); ?>
</div>
<script>
$(document).ready(function(){
	/*$("#lenderstats_search").click(function(){
		var lender_name = $("#lender_name");
		if(lender_name.val()==''){
			if($(".error").length==0){
				$('<span class="error">Please Select Lender</span>').insertAfter(lender_name);
			}else{
				$('<span class="error">Please Select Lender</span>').show();
			}
			return false;
		}else{
			return true;
		}
	});*/
});
</script>
<style>
.error{color: red;}		
    .affiliate_report tr th{
        text-align:right;
    }
</style>
