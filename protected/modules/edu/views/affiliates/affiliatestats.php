<?php
$this->breadcrumbs=array('Affiliate Stats');
$this->menu=array(array('label'=>'List Affiliate User','url'=>array('index')));

$filter_date = Yii::app()->request->getParam('filter_date',date('n/j/Y'));
$promo_code = Yii::app()->request->getParam('promo_code');

/**
* @since : 29-11-2016 06:43 PM
* @author : Siddharajsinh Maharaul
* @functionality : Added variable for passed_promocde
*/
$passed_promo_code = Yii::app()->request->getParam('promo_code');
?>
<h4>Affiliate Stats</h4>
<div class="row-fluid">
	<div class="span12">
		<?php
		$this->beginWidget('zii.widgets.CPortlet', array('title'=>"Affiliate Stats",));
		$form=$this->beginWidget('CActiveForm',array('id' => 'affiliate_stats','enableAjaxValidation' => false));
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
					echo Chtml::dropDownList('promo_code', $promo_code, get_affiliate_name_and_promocode(), array('style'=>'width:auto;','empty'=>'All Active Affiliates'));
					?>
					</td>
					<td><b>Action :</b><br>
						<?php echo CHtml::submitButton('Get Affiliate Stats',array('name'=>'affiliatestats_search','id'=>'affiliatestats_search','class'=>'btn btn btn-primary')); ?>
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
					<!--
					  /**
					   * @since : 29-11-2016 06:45 PM
					   * @author : Siddharajsinh Maharaul
					   * @functionality : Added column of affiliate name
					  */
					-->
					<th>Affiliate Name</th>
					<th>Date</th>
					<!--
					 * author : vatsal gadhia
					 * modification : Ping Fields Commented
					 * modification date : 22-07-2016 5:45 pm
					 -->
					<!--<th>Ping Sent</th>
					<th>Duplicate Ping</th>
					<th>Ping Accepted</th>-->
					<th style="text-align:right;">Post Sent</th>
					<th style="text-align:right;">Post Accepted</th>
					<th style="text-align:right;">Lead Returned</th>
					<th style="text-align:right;">Final Leads</th>
                    <th style="text-align:right;">Affiliate Final Leads</th>
					<th style="text-align:right;">Revenue</th>
				</tr>
			</thead>
			<tbody>
				<?php
					/**
					 * @since : 29-11-2016 06:46 PM
					 * @author : Siddharajsinh Maharaul
					 * @functionality : Added start date and end date for total number of leads display
					*/
					$start_date = '';
					$end_date = '';
					foreach($affiliatestats as $k => $affiliatestat){
						$date = date('Y-m-d',strtotime(trim($affiliatestat['date'])));
						$final_leads = ($affiliatestat['post_accepted']-$affiliatestat['lead_returned']);
                         $affiliate_final_leads=($affiliatestat['affiliate_post_accepted']-$affiliatestat['affiliate_lead_returned']);
						/**
						 * @since : 30-11-2016 10:28 AM
						 * @author : Siddharajsinh Maharaul
						 * @functionality : Added promo code fetch from query to use in lead info url
					 	*/
						$promo_code = $affiliatestat['promo_code'];
					/**
					 * @since : 29-11-2016 06:47 PM
					 * @author : Siddharajsinh Maharaul
					 * @functionality : Added start date and end date for total number of leads display
					 */
					if($k == 0){
						$end_date = $date;
					}
					if($k == count($affiliatestats)-1){
						$start_date = $date;
					}
					?>
				<tr>
					<!--
					  /**
					   * @since : 29-11-2016 06:45 PM
					   * @author : Siddharajsinh Maharaul
					   * @functionality : Added column of affiliate name
					  */
					 -->
					<th><?php echo $affiliatestat['affiliate_name']; ?></th>
					<td><?php echo $date;?></td>
					<!--
					 * author : vatsal gadhia
					 * modification : Ping Fields Commented
					 * modification date : 22-07-2016 5:45 pm
					 -->
					<!--<td align="right">--><?php //echo ($affiliatestat['ping_sent']) ? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'&promo_code='.$promo_code.'">'.$affiliatestat['ping_sent'].'</a>' : 0;?><!--</td>-->
					<!--<td align="right">--><?php //echo ($affiliatestat['duplicate_ping']) ? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'&duplicate_ping=1&promo_code='.$promo_code.'">'.$affiliatestat['duplicate_ping'].'</a>' : 0;?><!--</td>-->
					<!--<td align="right">--><?php //echo ($affiliatestat['ping_accepted']) ? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'&ping_status=1&promo_code='.$promo_code.'">'.$affiliatestat['ping_accepted'].'</a>' : 0;?><!--</td>-->
					<td align="right"><?php echo ($affiliatestat['post_sent']) ? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'&post_sent=1&promo_code='.$promo_code.'">'.$affiliatestat['post_sent'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($affiliatestat['post_accepted'])? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'&post_status=1&promo_code='.$promo_code.'">'.$affiliatestat['post_accepted'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($affiliatestat['lead_returned'])? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'&lead_returned=1&promo_code='.$promo_code.'">'.$affiliatestat['lead_returned'].'</a>' : 0;?></td>
					<td align="right"><?php echo ($final_leads)? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'&final=1&promo_code='.$promo_code.'">'.$final_leads.'</a>' : 0;?></td>
                     <!--
					 * author : Nupoor Patel
					 * modification : Added counter for accepted leads shown in affiliate portal
					 * modification date : 17-04-2017 11:57 pm
					 -->
                    <td align="right"><?php echo ($affiliate_final_leads)? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?date='.$date.'&final=1&AdminAffiliateReport=1&promo_code='.$promo_code.'">'.$affiliate_final_leads.'</a>' : 0;?></td>
					<td align="right">$<?php echo ($affiliatestat['revenue']=='') ? '0.00' : round($affiliatestat['revenue'],2);?></td>
				</tr>
				<?php
					$ping_sent_total += ($affiliatestat['ping_sent']=='') ? 0 : $affiliatestat['ping_sent'];
					$duplicate_ping_total += ($affiliatestat['duplicate_ping']=='') ? 0 : $affiliatestat['duplicate_ping'];
					$ping_accepted_total += ($affiliatestat['ping_accepted']=='') ? 0 : $affiliatestat['ping_accepted'];
					$post_sent_total += ($affiliatestat['post_sent']=='') ? 0 : $affiliatestat['post_sent'];
					$post_accepted_total += ($affiliatestat['post_accepted']=='') ? 0 : $affiliatestat['post_accepted'];
					$lead_returned_total += ($affiliatestat['lead_returned']=='') ? 0 : $affiliatestat['lead_returned'];
                      
					$final_leads_total += $final_leads;
                    $affiliate_post_accepted_total += $affiliate_final_leads;
					$revenue_total += ($affiliatestat['revenue']=='') ? 0 : round($affiliatestat['revenue'],2);
					}
					?>
			</tbody>
			<tfoot>
				<tr>
					<!--
					  /**
					   * @since : 29-11-2016 06:45 PM
					   * @author : Siddharajsinh Maharaul
					   * @functionality : Changed colspan to 2
					  */
					  -->
					<th class="header" colspan="2">Total</th>
					<!--
					 * author : vatsal gadhia
					 * modification : Ping Fields Commented
					 * modification date : 22-07-2016 5:45 pm
					 -->
					<!--<th class="header" align="right"><?php //echo $ping_sent_total;?></th>
					<th class="header" align="right"><?php //echo $duplicate_ping_total;?></th>
					<th class="header" align="right"><?php //echo $ping_accepted_total;?></th>-->
					<!--
					  /**
					   * @since : 30-11-2016 10:30 AM
					   * @author : Siddharajsinh Maharaul
					   * @functionality : Removed Promocode from total number of particular lead counter URL
					  */
					  -->
					<?php 
          				/**
						 * @since : 12-12-2016 11:28 AM
						 * @author : Siddharajsinh Maharaul
						 * @functionality : Added promo_code in total redirect url if result is for particular promo code
						 */
          				$s_url_string = '';
          				/**
						 * @since : 12-12-2016 11:28 AM
						 * @author : Siddharajsinh Maharaul
						 * @functionality : Changed variable from $promo_code to $passed_promo_code
						 */
          				if(!empty($passed_promo_code)){
          					$s_url_string = '&promo_code='.$passed_promo_code;
          				}
          			?>
					<th class="header" style="text-align:right;"><?php echo ($post_sent_total ? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?start_date='.$start_date.'&end_date='.$end_date.'&post_sent=1'.$s_url_string.'">'.$post_sent_total.'</a>' : $post_sent_total);?></th>
					<th class="header" style="text-align:right;"><?php echo ($post_accepted_total ? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?start_date='.$start_date.'&end_date='.$end_date.'&post_status=1'.$s_url_string.'">'.$post_accepted_total.'</a>' : $post_accepted_total);?></th>
					<th class="header" style="text-align:right;"><?php echo ($lead_returned_total ? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?start_date='.$start_date.'&end_date='.$end_date.'&lead_returned=1'.$s_url_string.'">'.$lead_returned_total.'</a>' : $lead_returned_total);?></th>
					<th class="header" style="text-align:right;"><?php echo ($final_leads_total ? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?start_date='.$start_date.'&end_date='.$end_date.'&final=1'.$s_url_string.'">'.$final_leads_total.'</a>' : $final_leads_total);?></th>
                       <th class="header" style="text-align:right;"><?php echo ($affiliate_post_accepted_total ? '<a target="_blank" href="'.Yii::app()->createAbsoluteUrl(Yii::app()->params['campaign']).'/affiliates/leadinfo?start_date='.$start_date.'&end_date='.$end_date.'&final=1&AdminAffiliateReport=1'.$s_url_string.'">'.$affiliate_post_accepted_total.'</a>' : $affiliate_post_accepted_total);?></th>
					<th class="header" style="text-align:right;">$<?php echo $revenue_total;?></th>
				</tr>
			</tfoot>
		</table>
        </div>
	</div>
	<?php $this->endWidget(); ?>
</div>
<script>
$(document).ready(function(){
	$("#affiliatestats_search").click(function(){
		/*var promo_code = $("#promo_code");
		if(promo_code.val()==''){
			if($(".error").length==0){
				$('<span class="error">Please Select Affiliate</span>').insertAfter(promo_code);
			}else{
				$('<span class="error">Please Select Affiliate</span>').show();
			}
			return false;
		}else{
			return true;
		}*/
	});
});
</script>
<style>
.error{color: red;}					
</style>
