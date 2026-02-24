<?php
/**
 * @since : 23-12-2016 01:27 PM
 * @author : Siddharajsinh Maharaul
 * @functionality : Created page of questionable leads
 */
$this->breadcrumbs=array('Questionable Leads Report');

$sub_id = Yii::app()->request->getParam('sub_id');
$promo_code = Yii::app()->request->getParam('promo_code');
?>
<div class="row-fluid">
	<div class="span12">
		<?php
		$this->beginWidget('zii.widgets.CPortlet', array('title'=>"Questionable Leads Report"));
		$form=$this->beginWidget('CActiveForm',array('id' => 'questionale_leads','enableAjaxValidation' => false));
		?>
        <div class="table-responsive">
		<table class="table table-striped table-hover table-bordered table-condensed">
			<thead>
				<tr>					
					<td style="width:130px;"><b>Affiliate :</b><br>
					<?php
					echo Chtml::dropDownList('promo_code', $promo_code,get_affiliate_name_and_promocode(), array('style'=>'width:auto;','empty'=>'All Active Affiliates'));
					?>
					</td>
					<td style="width:130px;"><b>Sub Id :</b><br>
						<select name="sub_id">
							<option value="">All</option>
							<?php 
								if(isset($t_sub_ids) && !empty($t_sub_ids)){
									$t_sub_idsa = CHtml::listData( $t_sub_ids, 'sub_id' , 'sub_id');
									foreach($t_sub_idsa as $i_sub_id){
										echo '<option value="'.$i_sub_id.'" '.($sub_id == $i_sub_id ? 'selected' : '' ).' >'.$i_sub_id.'</option>';
									}
								}
							?>
						</select>
					</td>
					<td><b>Action :</b><br>
						<?php echo CHtml::submitButton('Get Questionable Leads',array('name'=>'questionale_leads','id'=>'questionale_leads','class'=>'btn btn btn-primary')); ?>
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
					<th>Questionable Leads</th>
				</tr>
			</thead>
			<tbody>
					<?php 
						$i_total_leads = '';
						if(isset($t_questionable_leads) && !empty($t_questionable_leads)){
							foreach($t_questionable_leads as $t_lead){
								$i_total_leads+=intval($t_lead['questionable_leads']);
								echo '<tr>';
									echo '<td>'.$t_lead['affiliate_name'].'</td>';
									echo '<td>'.$t_lead['questionable_leads'].'</td>';
								echo '</tr>';
							}
						}else{
							echo '<tr><td colspan="2">No Record Found.</td></tr>';
						}
					?>
			</tbody>
			<tfoot>
				<tr>
					<td>Total</td>
					<td><b><?php echo $i_total_leads; ?></b></td>
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
