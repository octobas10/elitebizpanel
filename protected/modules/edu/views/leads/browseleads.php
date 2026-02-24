<style>
.left-column, .right-column {float: left;}
.left-column {width: 30%;}
.right-column {width: 100%;}
.nodatafound{color: red;font-family: sans-serif;font-size: 14px;text-align: center;}
.summary {font-size: 14px; margin: 0 0 5px 5px;font-weight: bold;}
</style>
<h4>Browse Leads</h4>
<div class="row-fluid">
<div class="span12">
<?php $this->beginWidget('zii.widgets.CPortlet',array('title'=>"Search")); ?>
<?php $form = $this->beginWidget ('CActiveForm',array ('id' => 'list_leads_id','enableAjaxValidation' => false ));
$aff_datas = AffiliateUser::model()->findAll(array('select'=>'id,user_name'));
$aff_data = array();
foreach($aff_datas as $value){
	$aff_data[$value->id] = $value->user_name.'('.$value->id.')';
}
natcasesort($aff_data);
$promo_code = Yii::app()->request->getParam('promo_code');

$len_datas = LenderDetails::model()->findAll(array('select'=>'id,name'));
$len_data = array();
foreach($len_datas as $value){
	$len_data[$value->id] = $value->name.'('.$value->id.')';
}
natcasesort($len_data);
$lender_name = Yii::app()->request->getParam('lender_name');
?>
<table class="table table-striped table-hover table-bordered table-condensed">
<tr>
	<td><b>Date Range : </b>
	   <?php
		$date = Yii::app()->getRequest()->getParam('filter_date', 'Today');
		$this->widget('ext.EDateRangePicker.EDateRangePicker', array(
			'id' => 'Filter_date',
		   'name' => 'filter_date',
		   'value' => '' . $date . '',
		   'options' => array(
		   	'arrows' => true,
	    		'closeOnSelect'=>true
		   ),
		   'htmlOptions' => array(
		   	'class' => 'inputClass'
		   )
		));
		?>
   </td>
   <td><b>Affiliate(Promo code) :</b><br>
   	<?php
	/*if(!empty(Yii::app()->getRequest()->getParam('promo_code')))
	{
   	$promo_code = Yii::app()->getRequest()->getParam('promo_code');
   	$promo_code = isset($promo_code) ? implode(',', $promo_code) : '';
		echo CHtml::dropDownList('promo_code[]', ''.$promo_code.'', get_affiliate_name_and_promocode(), 
				array('empty'=>'All Affiliates', 'multiple'=>false, 'size'=>'8'));
	}*/
		echo CHtml::dropDownList('promo_code[]',$promo_code,$aff_data,array('multiple'=>true,'size'=>'8'));
	?>
	</td>
	<td><b>Lenders :</b>
   	<br>
   	<?php
	/*if(!empty(Yii::app()->getRequest()->getParam('lender_name')))
	{
   	$lender_name = Yii::app()->getRequest()->getParam('lender_name');
   	$lender_name = implode(",",$lender_name);
      echo Chtml::listBox('lender_name[]', ''.$lender_name. '', 
      		CHtml::listData(LenderDetails::model()->findAll(),'name','name'), 
      		array('empty'=>'All Lenders', 'multiple'=>false, 'size'=>'8'));
	}*/
		echo CHtml::dropDownList('lender_name[]',$lender_name,$len_data,array('multiple'=>true,'size'=>'8'));
      ?>
   </td>
   <td style="width:150px;"><b>Lead Status :</b>
   	<br>
	   <?php $lead_status = Yii::app()->getRequest()->getParam('lead_status');
		echo CHtml::radioButtonList('lead_status', ''.$lead_status.'', 
				array(''=>'ANYTHING', '1' => ACCEPTED, '0' => REJECTED, '-1' => ERROR, '2' => RETURNED), 
				array('labelOptions' => array('style' => 'display:inline')));
		?>
   </td>
   <td style="text-align: center;"><b>Action :</b>
	   <br>
	   <?php echo CHtml::submitButton('Search',array('class'=>'btn btn btn-primary','name'=>'search')); ?>
	   <?php echo CHtml::submitButton('Export',array('class'=>'btn btn btn-primary','name'=>'export')); ?>
	   <?php echo CHtml::button('Reset',array('class'=>'btn btn btn-primary','id'=>'reset')); ?>
	</td>
</tr>
</table>
<?php $this->endWidget();?>
<?php $this->endWidget(); ?>
</div>
</div>

<?php
//$dataProvider = new CArrayDataProvider($posts); 
//$this->widget('zii.widgets.grid.CGridView', array(
//    'id' => 'browse_leads',
//    'dataProvider' => $dataProvider,
//    'columns' => array(
//        array(
//            'name' => 'sub_date',
//            'header' => 'Date Time',
//            'htmlOptions' => array(
//            	'style' => 'width:150px;'
//            )
//        ),
//        array(
//            'name' => 'first_name',
//            'header' => 'First Name',
//            'htmlOptions' => array(
//            	'style' => 'width:150px;'
//            )
//        ),
//        array(
//            'name' => 'last_name',
//            'header' => 'Last Name',
//            'htmlOptions' => array(
//            	'style' => 'width:150px;'
//            )
//        ),
//        array(
//            'name' => 'email',
//            'header' => 'Email',
//            'htmlOptions' => array(
//            	'style' => 'width:150px;'
//            )
//        ),
//        array(
//            'name' => 'ssn',
//            'header' => 'SSN',
//            'htmlOptions' => array(
//            	'style' => 'width:150px;'
//            )
//        ),
//        array(
//            'name' => 'ipaddress',
//            'header' => 'IP Address',
//            'htmlOptions' => array(
//            	'style' => 'width:150px;'
//            )
//        ),
//        array(
//            'name' => 'promo_code',
//            'header' => 'Affiliate',
//        		'value' => function($row){
//        			$aff_data = get_affiliate_name_and_promocode();
//        			echo $aff_data[$row['promo_code']];
//				},
//            'htmlOptions' => array(
//            	'style' => 'width:150px;'
//            )
//        ),
//        array(
//            'name' => 'lead_status',
//            'header' => 'Lead Status',
//            'value' => function($row){
//                echo ($row['is_returned']==1) ? RETURNED : setResponseText($row['lead_status']);
//            },
//            'htmlOptions' => array(
//            	'style' => 'width:150px;'
//            )
//        ),
//        array(
//            'name' => 'lender_id',
//            'header' => 'Lender',
//	        	'value' => function($row){
//	        		$lender_data = get_lender_name_and_lender_id();
//        			echo $lender_data[$row['lender_id']];
//            },
//            'htmlOptions' => array(
//            	'style' => 'width:150px;'
//            )
//        ),
//        array(
//        	'name' => 'lender_lead_price',
//        	'header' => 'Price',
//        	'htmlOptions' => array(
//        		'style' => 'width:150px;'
//        	)
//       )
//    )
//));
///exit();
//$this->widget('CLinkPager', array('pages' => $pages));
?>

<div class="row-fluid">
<div class="span12">
<div class="summary">Total Transactions: <?php if(isset($NoDataFound)) { echo "0"; } else { echo $total; } ?></div>
<table id="posts" class="table table-striped table-hover table-bordered table-condensed">
<thead>
	<tr>
		<th>Date Time</th>
		<th>First Name</th>
		<th>Last Name</th>
		<th>Email</th>
		<!-- <th>SSN</th> -->
		<th>IP Address</th>
		<th>Affiliate</th>
		<th>Lead Status</th>
		<th>Lender</th>
		<th>Price</th>
	</tr>
</thead>
<tbody>	
<?php
if(isset($posts) && !empty($posts)){
foreach ($posts as $len_trans) {?>
	<tr class="post">
		<td style="width:150px;"><?php echo $len_trans['sub_date']; ?></td>
		<td style="width:150px;"><?php echo $len_trans['first_name']; ?></td>
		<td style="width:150px;"><?php echo $len_trans['last_name']; ?></td>
		<td style="width:150px;"><?php echo $len_trans['email']; ?></td>
		<!--<td style="width:150px;">-->
			<?php //echo $len_trans['ssn']; ?>
		<!--</td>-->
		<td style="width:150px;"><?php echo $len_trans['ipaddress']; ?>
		<?php 
			/**
			 * @since : 22-12-2016 04:20 PM
			 * @author : Siddharajsinh Maharaul
			 * @functionality : Link fired to get city and state from ip address
			 */
			$t_ip_location = json_decode(file_get_contents("https://ipinfo.io/{$len_trans['ipaddress']}/geo"));
			if(!empty($t_ip_location) && isset($t_ip_location->city) && isset($t_ip_location->region)){
				echo '<br/><b>City :</b>'.$t_ip_location -> city.'<br/><b>State : </b>'.$t_ip_location -> region;
			}
		 ?>
		</td>
		<td style="width:150px;"><?php print_r($aff_data[$len_trans['promo_code']]); ?></td>
		<td style="width:150px;"><?php if($len_trans['lead_status']=='1'){
					echo "ACCEPTED";
				}
				else if($len_trans['lead_status']=='0'){
					echo "REJECTED";
				}
				else if($len_trans['lead_status']=='-1'){
					echo "ERROR";
				}
				else if($len_trans['lead_status']=='2'){
					echo "RETURNED";
				}
				else{
					echo "ERROR";
				}
			?>
		</td>
		<td style="width:150px;">
		<?php print_r($len_data[$len_trans['lender_id']]); ?>
		<?php
			/*foreach ($len_data as $len_details) {
				// print_r($len_details);
				if(strpos($len_details, '('.$len_trans['lender_id'].')') !== false){
					echo $len_details;
				}
			}*/
		?>
		</td>
		<td style="width:150px;"><?php echo $len_trans['lender_lead_price']; ?></td>
	</tr>
<?php }
}
	else{
		if(empty($posts) || isset($NoDataFound)){ echo '<tr><td colspan="10" align="center"><div class="alert alert-danger" align="center"><h4>No data found for this criteria.</h4></div></td></tr>'; }
	}
?>
</tbody>
</table>
</div>
</div>
<?php
/**Generate Paggination Link*/
$this->widget('CLinkPager', array('pages' => $pages));
?>

<script>
$(document).ready(function(){
	$("#reset").click(function(){
		$.ajax({
			url: '<?php echo Yii::app()->createUrl('ajax'); ?>/?reset=browse_searched_parameters',
			success: function(data) {
				window.location = window.location.pathname;
			}
		});
	});
});
</script>
