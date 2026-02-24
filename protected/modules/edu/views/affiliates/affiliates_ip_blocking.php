<?php
$this->breadcrumbs=array('Duplicate IP Block/Allow');
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
<h4>Duplicate IP Block/Allow</h4>
<?php if(Yii::app()->user->hasFlash('success')): ?>
<div class="alert alert-success" role="alert">
	<?php echo Yii::app()->user->getFlash('success'); ?>
</div>
<?php elseif(Yii::app()->user->hasFlash('error')): ?>
<div class="alert alert-danger" role="alert">
	<?php echo Yii::app()->user->getFlash('error'); ?>
</div>
<?php endif; ?>
<div class="row-fluid">
	<div class="span12">
		<?php
		$this->beginWidget('zii.widgets.CPortlet', array('title'=>"Block/Allow Duplicate IP For affiliates",));
		?>
        <div class="table-responsive">
		<table id="myTable" class="tablesorter table table-striped table-hover table-bordered table-condensed affiliate_report" style="text-align:center;">
			<thead>
				<tr>
					<th style="text-align:center;">Affiliate</th>
					<th style="text-align:center;">Status</th>
					<th style="text-align:center;">Block/Allow</th>
				</tr>
			</thead>
			<tbody>
				<?php
				$t_affiliate_details = AffiliateUser::model()->findAll(array("select"=>"id, user_name, CASE status when '-1' then 'Inactive' when '1' then 'Active' when '0' then 'TestMode' END as status,if(allow_duplicate_ip=1,'Allow','Block') as allow_duplicate_ip"));
				// print_r($t_affiliate_details);
				if(isset($t_affiliate_details) && !empty($t_affiliate_details)) {
					foreach ($t_affiliate_details as $t_affiliate_detail_key => $t_affiliate_detail_value) {
						$id = $t_affiliate_details[$t_affiliate_detail_key]["id"];
						$name = $t_affiliate_details[$t_affiliate_detail_key]["user_name"];
						$status = $t_affiliate_details[$t_affiliate_detail_key]["status"];
						$duplicate = $t_affiliate_details[$t_affiliate_detail_key]["allow_duplicate_ip"];
						echo '<tr><td>'.$name.'</td>
						<td>'.$status.'</td>
						<td><a href="?id='.$id.'&duplicate='.$duplicate.'" class='.$duplicate.'>'.$duplicate.'</a></td></tr>';
					}
				} else {
					echo '<tr><td>No Affiliates Found</td></tr>';
				}
				?>
			</tbody>
		</table>
        </div>
	</div>
	<?php $this->endWidget(); ?>
</div>
<style>
.table.table-striped.table-hover.table-bordered.table-condensed a.Block{color: red;}
.table.table-striped.table-hover.table-bordered.table-condensed a.Allow{color: green;}
</style>
<script type="text/javascript">
$(document).ready(function(){
	$(".alert").animate({opacity: 1.0}, 3000).fadeOut("slow");
});
</script>