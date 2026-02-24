<?php
$this->breadcrumbs=array('Lender Report');
$this->menu=array(array('label'=>'Lender Setup','url'=>array('index')),array('label'=>'Lender Report','url'=>array('lenderreport')));
$filter_date = Yii::app()->request->getParam('filter_date',date('Y-m-d'));
$lender_id = Yii::app()->request->getParam('lender_id');
?>
<h4>Lender Stats</h4>
<div class="row-fluid">
	<div class="span12">
		<?php
		$this->beginWidget('zii.widgets.CPortlet', array('title'=>"Lender Stats",));
		$form=$this->beginWidget('CActiveForm',array('id' => 'lender_stats','enableAjaxValidation' => false));
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
					<td style="width:130px;"><b>Lender :</b><br>
					<?php echo Chtml::dropDownList('lender_id', $lender_id,
							CHtml::listData(LenderDetails::model()->findAll(),'id','name'),
							array('style'=>'width:auto;','empty'=>'--Select Lender--'));
					?>
					</td>
					<td><b>Action :</b><br>
						<?php echo CHtml::submitButton('Get Lender Stats',array('name'=>'lenderstats_search','id'=>'lenderstats_search','class'=>'btn btn btn-primary')); ?>
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
					<th>Ping Accepted</th>
					<th>Post Sent</th>
					<th>Post Accepted</th>
					<th>Lead Returned</th>
					<th>Final Leads</th>
					<th>Revenue</th>
					<th>Average Ping Price</th>
				</tr>
			</thead>
			<tbody>
				<?php
					$i = 0;
					$ping_sent_total=0;$ping_accepted_total=0;$post_sent_total=0;$post_accepted_total=0;$lead_returned_total=0;$final_leads_total=0;$avg_ping_price=0;$revenue_total=0;
					foreach($lenderstats as $k => $lenderstat){
						$date = date('Y-m-d',strtotime(trim($lenderstat['date'])));
						$final_leads = ($lenderstat['post_accepted']-$lenderstat['lead_returned']);
					?>
				<tr>
					<td align="right"><?php echo $date;?></td>
					<td align="right"><?php echo ($lenderstat['ping_sent']) ? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/lenders/leadinfo?date='.$date.'&lender_id='.$lender_id.'">'.$lenderstat['ping_sent'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($lenderstat['ping_accepted']) ? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/lenders/leadinfo?date='.$date.'&ping_status=1&lender_id='.$lender_id.'">'.$lenderstat['ping_accepted'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($lenderstat['post_sent']) ? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/lenders/leadinfo?date='.$date.'&post_sent=1&lender_id='.$lender_id.'">'.$lenderstat['post_sent'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($lenderstat['post_accepted'])? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/lenders/leadinfo?date='.$date.'&post_status=1&lender_id='.$lender_id.'">'.$lenderstat['post_accepted'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($lenderstat['lead_returned'])? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/lenders/leadinfo?date='.$date.'&lead_returned=1&lender_id='.$lender_id.'">'.$lenderstat['lead_returned'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($final_leads)? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/lenders/leadinfo?date='.$date.'&final=1&lender_id='.$lender_id.'">'.$final_leads.'</a>' : 0;?></td>
					<td align="right">$<?php echo ($lenderstat['revenue']=='') ? '0.00' : round($lenderstat['revenue'],2);?></td>
					<td align="right">$<?php echo ($lenderstat['average_ping_price']=='') ? '0.00' : round($lenderstat['average_ping_price'],2);?></td>
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
				if($average_ping_price_total > 0){
					$avg_ping_price = round($average_ping_price_total/$i,2);
				}
				?>
			</tbody>
			<tfoot>
				<tr>
					<th class="header" colspan="">Total</th>
					<th class="header" align="right"><?php echo $ping_sent_total;?></th>
					<th class="header" align="right"><?php echo $ping_accepted_total;?></th>
					<th class="header" align="right"><?php echo $post_sent_total;?></th>
					<th class="header" align="right"><?php echo $post_accepted_total;?></th>
					<th class="header" align="right"><?php echo $lead_returned_total;?></th>
					<th class="header" align="right"><?php echo ($final_leads_total)? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/lenders/leadinfo?date='.$date_filter.'&final=1&lender_id='.$lender_id.'">'.$final_leads_total.'</a>' : 0;?></th>
					<th class="header" align="right">$<?php echo $revenue_total;?></th>
					<th class="header" align="right">$<?php echo $avg_ping_price;?></th>
				</tr>
			</tfoot>
		</table>
	</div>
	<?php $this->endWidget(); ?>
</div>
<script>
$(document).ready(function(){
	$("#lenderstats_search").click(function(){
		var lender_id = $("#lender_id");
		if(lender_id.val()==''){
			/*if($(".error").length==0){
				$('<span class="error">Please Select Lender</span>').insertAfter(lender_id);
			}else{
				$('<span class="error">Please Select Lender</span>').show();
			}*/
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
