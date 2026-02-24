<?php
$this->breadcrumbs=array('Affiliate Stat Logs');
$this->menu=array(array('label'=>'List Affiliate User','url'=>array('index')));

$filter_date = Yii::app()->request->getParam('filter_date',date('n/j/Y'));
$promo_code = Yii::app()->request->getParam('promo_code');
?>
<h4>Affiliate Stat Logs</h4>
<div class="row-fluid">
	<div class="span12">
		<?php
		$this->beginWidget('zii.widgets.CPortlet', array('title'=>"Affiliate Stat Logs",));
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
					<?php
					if(Yii::app()->user->getState('roles')=='1') {
						echo '<td style="width:130px;"><b>Affiliate :</b><br>';
						echo Chtml::dropDownList('promo_code', $promo_code, get_affiliate_name_and_promocode(), array('style'=>'width:auto;','empty'=>'--Select Affiliate--'));
						echo '</td>';
					}
					?>
					<td><b>Action :</b><br>
						<?php echo CHtml::submitButton('Get Affiliate Stat Logs',array('name'=>'affiliatestats_search','id'=>'affiliatestats_search','class'=>'btn btn btn-primary')); ?>
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
					<th>Date</th>
					<?php if(Yii::app()->user->getState('roles')=='1') { echo '<th>Link</th>'; } ?>
					<th>Count</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$total_count = 0;
					foreach($affiliatestats as $k => $affiliatestat){
						$date = date('Y-m-d',strtotime(trim($affiliatestat['date'])));
						$link = $affiliatestat['link'];
						$count = $affiliatestat['count'];
						$total_count += $count;
					?>
				<tr>
					<td><?php echo $date; ?></td>
					<?php if(Yii::app()->user->getState('roles')=='1') { echo '<td>'.$link.'</td>'; } ?>
					<td><?php echo $count; ?></td>
				</tr>
				<?php } ?>
			</tbody>
			<tfoot>
				<tr>
					<th class="header" <?php if(Yii::app()->user->getState('roles')=='1') { echo 'colspan="2"'; } ?>>Total</th>
					<th class="header" colspan="2"><?php echo $total_count; ?></th>
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
		var promo_code = $("#promo_code");
		if(promo_code.val()==''){
			if($(".error").length==0){
				$('<span class="error">Please Select Affiliate</span>').insertAfter(promo_code);
			}else{
				$('<span class="error">Please Select Affiliate</span>').show();
			}
			return false;
		}else{
			return true;
		}
	});
});
</script>
<style>
.error{color: red;}					
</style>
