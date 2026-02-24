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
<?php $form = $this->beginWidget ('CActiveForm',array ('id' => 'list_leads_id','enableAjaxValidation' => false )); ?>
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
   	$promo_code = Yii::app()->getRequest()->getParam('promo_code');
   	$promo_code = isset($promo_code) ? implode(',', $promo_code) : '';
		echo CHtml::dropDownList('promo_code[]', ''.$promo_code.'', get_affiliate_name_and_promocode(), 
				array('empty'=>'All Affiliates', 'multiple'=>false, 'size'=>'8'));
		?>
	</td>
	<td><b>Lenders :</b>
   	<br>
   	<?php
   	$lender_name = Yii::app()->getRequest()->getParam('lender_name');
   	$lender_name = implode("','",$lender_name);
      echo Chtml::listBox('lender_name[]', ''.$lender_name. '', 
      		CHtml::listData(LenderDetails::model()->findAll(),'name','name'), 
      		array('empty'=>'All Lenders', 'multiple'=>false, 'size'=>'8'));
      ?>
   </td>
   <td style="width:150px;"><b>Post Status :</b>
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
$dataProvider = new CArrayDataProvider($posts); 
$this->widget('zii.widgets.grid.CGridView', array(
    'id' => 'browse_leads',
    'dataProvider' => $dataProvider,
    'columns' => array(
        array(
            'name' => 'sub_date',
            'header' => 'Date Time',
            'htmlOptions' => array(
            	'style' => 'width:150px;'
            )
        ),
        array(
            'name' => 'first_name',
            'header' => 'First Name',
            'htmlOptions' => array(
            	'style' => 'width:150px;'
            )
        ),
        array(
            'name' => 'last_name',
            'header' => 'Last Name',
            'htmlOptions' => array(
            	'style' => 'width:150px;'
            )
        ),
        array(
            'name' => 'email',
            'header' => 'Email',
            'htmlOptions' => array(
            	'style' => 'width:150px;'
            )
        ),
        array(
            'name' => 'ssn',
            'header' => 'SSN',
            'htmlOptions' => array(
            	'style' => 'width:150px;'
            )
        ),
        array(
            'name' => 'ipaddress',
            'header' => 'IP Address',
            'htmlOptions' => array(
            	'style' => 'width:150px;'
            )
        ),
        array(
            'name' => 'promo_code',
            'header' => 'Affiliate',
        		'value' => function($row){
        			$aff_data = get_affiliate_name_and_promocode();
        			echo $aff_data[$row['promo_code']];
				},
            'htmlOptions' => array(
            	'style' => 'width:150px;'
            )
        ),
        array(
            'name' => 'lead_status',
            'header' => 'Lead Status',
            'value' => function($row){
                echo ($row['is_returned']==1) ? RETURNED : setResponseText($row['lead_status']);
            },
            'htmlOptions' => array(
            	'style' => 'width:150px;'
            )
        ),
        array(
            'name' => 'lender_id',
            'header' => 'Lender',
	        	'value' => function($row){
	        		$lender_data = get_lender_name_and_lender_id();
        			echo $lender_data[$row['lender_id']];
            },
            'htmlOptions' => array(
            	'style' => 'width:150px;'
            )
        ),
        array(
        	'name' => 'lender_lead_price',
        	'header' => 'Price',
        	'htmlOptions' => array(
        		'style' => 'width:150px;'
        	)
       )
    )
));
print_r($lender_data);
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
