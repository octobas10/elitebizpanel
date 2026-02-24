<?php
/**
* @since : 14-12-2016 05:21 PM
* @author : Siddharajsinh Maharaul
* @functionality : Created Affiliate Report 
*/
$this->breadcrumbs=array('Affiliates Report');
$this->menu=array(array('label'=>'List Affiliate User','url'=>array('index')));
$filter_date = Yii::app()->request->getParam('filter_date',date('n/j/Y'));
$promo_code = Yii::app()->request->getParam('promo_code');
$passed_promo_code = Yii::app()->request->getParam('promo_code');
?>
<h4>Affiliates Report</h4>
<div class="row-fluid">
	<div class="span12">
		<?php
		$this->beginWidget('zii.widgets.CPortlet', array('title'=>"Affiliates Report",));
		$form=$this->beginWidget('CActiveForm',array('id' => 'affiliate_report','enableAjaxValidation' => false));
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
					<td style="width:130px;"><b>Affiliate :</b><br>
					<?php
					echo Chtml::dropDownList('promo_code', $promo_code,get_affiliate_name_and_promocode(), array('style'=>'width:auto;','empty'=>'All Active Affiliates'));
					?>
					</td>
					<td><b>Action :</b><br>
						<?php echo CHtml::submitButton('Get Affiliates Report',array('name'=>'affiliate_report','id'=>'affiliate_report','class'=>'btn btn btn-primary')); ?>
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
					<th>Affiliate Name</th>
					<th>Date</th>
					<th style="text-align:right;">Post Sent</th>
					<th style="text-align:right;">Post Accepted</th>
					<th style="text-align:right;">Lead Returned</th>
					<th style="text-align:right">Lead Rejected</th>
					<th style="text-align:right">Lead Duplicate</th>
					<th style="text-align:right;">Final Leads</th>
				</tr>
			</thead>
			<tbody>
				<?php
		          	$start_date = '';
		          	$end_date = '';
		          	$post_sent_total = $post_accepted_total = $lead_returned_total = $lead_duplicated_total = $i_rejected_leads = $final_leads_total = $final_leads = '';
					foreach($t_affiliate_reports as $k => $affiliate_report){
						$date = date('Y-m-d',strtotime(trim($affiliate_report['date'])));
						$final_leads = ($affiliate_report['post_accepted']-$affiliate_report['lead_returned']);
						$current_promo_code = $affiliate_report['promo_code'];
					?>
					<tr>
						<!-- 
						/**
						 * @since : 14-12-2016 06:50 PM
						 * @author : Siddharajsinh Maharaul
						 * @functionality : Passed flag in parameter as AdminAffiliateReport = 1
						 */
						 -->
						<td><?php echo $affiliate_report['affiliate_name']; ?></td>
						<td><?php echo $date;?></td>			
						<td align="right"><?php echo ($affiliate_report['post_sent']) ? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'&post_sent=1&promo_code='.$current_promo_code.'&AdminAffiliateReport=1">'.$affiliate_report['post_sent'].'</a>' : 0;?></td>
						<td align="right"><?php echo ($affiliate_report['post_accepted'])? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'&post_status=1&promo_code='.$current_promo_code.'&AdminAffiliateReport=1">'.$affiliate_report['post_accepted'].'</a>' : 0;?></td>
						<td align="right"><?php echo ($affiliate_report['lead_returned'])? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'&lead_returned=1&promo_code='.$current_promo_code.'&AdminAffiliateReport=1">'.$affiliate_report['lead_returned'].'</a>' : 0;?></td>
						<td align="right"><?php echo ($affiliate_report['lead_rejected'])? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'&lead_rejected=1&promo_code='.$current_promo_code.'&AdminAffiliateReport=1">'.$affiliate_report['lead_rejected'].'</a>' : 0;?></td>
						<td align="right"><?php echo ($affiliate_report['post_duplicate'])? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'&post_status=-1&promo_code='.$current_promo_code.'&AdminAffiliateReport=1">'.$affiliate_report['post_duplicate'].'</a>' : 0;?></td>
						<td align="right"><?php echo ($final_leads)? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'&final=1&promo_code='.$current_promo_code.'&AdminAffiliateReport=1">'.$final_leads.'</a>' : 0;?></td>
					</tr>
					<?php
						$post_sent_total += ($affiliate_report['post_sent']=='') ? 0 : $affiliate_report['post_sent'];
						$post_accepted_total += ($affiliate_report['post_accepted']=='') ? 0 : $affiliate_report['post_accepted'];
						$lead_returned_total += ($affiliate_report['lead_returned']=='') ? 0 : $affiliate_report['lead_returned'];
						$lead_duplicated_total += ($affiliate_report['post_duplicate']=='') ? 0 : $affiliate_report['post_duplicate'];
						$i_rejected_leads += ($affiliate_report['lead_rejected']=='') ? 0 : $affiliate_report['lead_rejected'];
						$final_leads_total += $final_leads;
					}
					?>
			</tbody>
			<tfoot>
				<tr>
					<th class="header" colspan="2">Total</th>
					<th class="header" style="text-align:right"><?php echo $post_sent_total;?></th>
					<th class="header" style="text-align:right"><?php echo $post_accepted_total;?></th>
					<th class="header" style="text-align:right"><?php echo $lead_returned_total;?></th>
					<th class="header" style="text-align:right"><?php echo $i_rejected_leads;?></th>
					<th class="header" style="text-align:right"><?php echo $lead_duplicated_total;?></th>
					<th class="header" style="text-align:right"><?php echo $final_leads_total;?></th>
				</tr>
			</tfoot>
		</table>
        </div>
	</div>
	<?php $this->endWidget(); ?>
</div>
<style>
.error{color: red;}
</style>
