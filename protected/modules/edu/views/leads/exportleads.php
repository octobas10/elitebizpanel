<style>
.left-column, .right-column {float: left;}
.left-column {width: 30%;}
.right-column {width: 100%;}
.nodatafound{color: red;font-family: sans-serif;font-size: 14px;text-align: center;}
</style>
<?php
$data = AffiliateUser::model()->findAll(array('select'=>'id,user_name'));
$aff_data = array();
foreach($data as $value){
	$aff_data[$value->id] = $value->user_name.'('.$value->id.')';
}
natcasesort($aff_data);
$date = Yii::app()->request->getParam('filter_date',date('n/j/Y'));
$promocode = Yii::app()->request->getParam('promo_code');
$lender = Yii::app()->request->getParam('lenders');
$state = Yii::app()->request->getParam('state');
$status = Yii::app()->request->getParam('status','-1');
//$monthly_income = Yii::app()->request->getParam('monthly_income');
//$stay_in_month = Yii::app()->request->getParam('stay_in_month');
//$stay_in_year = Yii::app()->request->getParam('stay_in_year');
//$employment_in_month = Yii::app()->request->getParam('employment_in_month');
//$employment_in_year = Yii::app()->request->getParam('employment_in_year');
$age = Yii::app()->request->getParam('age');
$order = Yii::app()->request->getParam('order','-1');
$fields = Yii::app()->request->getParam('fields',Yii::app()->params['field_edu']);
$gender = Yii::app()->request->getParam('gender','-1');
$lead_type = Yii::app()->request->getParam('lead_type','-1');
?>
<h4>Export Leads</h4>
<div class="row-fluid">
<div class="span12">
<?php
$this->beginWidget('zii.widgets.CPortlet',array('title'=>"Search"));
$form = $this->beginWidget('CActiveForm',array ('id' => 'list_leads_id','enableAjaxValidation' => false ));
?>
<table class="table table-striped table-hover table-bordered table-condensed">
<tr>
<td><b>Date Range : </b>
<?php
$this->widget('ext.EDateRangePicker.EDateRangePicker', array(
	'id' => 'Filter_date',
	'name' => 'filter_date',
	'value' => '' . $date . '',
	'options' => array('arrows' => true,'closeOnSelect'=>true),
	'htmlOptions' => array('class' => 'inputClass')
));
?>
</td>
<td><b>Response :</b><br>
<?php
/**
* @since : 18-11-2016 04:58 PM
* @author : Siddharajsinh Maharaul 
* @functionality : Added Lead Returned Status For Export Lead
*/
echo CHtml::radioButtonList('status',$status,array('-1' => 'ANYTHING', '1' => 'ACCEPTED', '0' => 'REJECTED', '-2' => 'RETURNED'),array('empty' => 'ANYTHING','labelOptions'=>array('style'=>'display:inline')));
?>
</td>
<!-- <td><b>Gender :</b><br> -->
<?php
//echo CHtml::radioButtonList('gender',$gender,array('' => 'ANYTHING', '1' => 'Male', '0' => 'Female'),array('labelOptions'=>array('style'=>'display:inline')));
?>
<!-- </td> -->
<!-- <td><b>Min. Monthly Pay :</b><br> -->
<?php
//echo CHtml::textField('monthly_income',$monthly_income,array('placeholder'=>'500','style'=>'width:100px','maxlength'=>'6'));
?>
<!-- </td> -->
<td><b>Lead Type :</b><br>
<?php
echo CHtml::radioButtonList('lead_type',$lead_type,array('-1' => 'ANYTHING', '1' => 'Organic', '0' => 'Inorganic'),array('empty' => 'ANYTHING','labelOptions'=>array('style'=>'display:inline')));
?>
</td>
</tr>
<td><b>Promo code :</b><br>
<?php echo CHtml::dropDownList('promo_code[]',$promocode,$aff_data,array('multiple'=>true,'size'=>'8'));?>
</td>
<!-- <td><b>State :</b><br> -->
<?php //echo CHtml::dropDownList('state[]',$state,Yii::app()->params['state'],array('multiple' => 'true','size' => '8')); ?>
<!-- </td> -->
<!-- <td><b>Time at address :</b><br> -->
<?php 
//echo CHtml::dropDownList('stay_in_month',$stay_in_month,getMonthsArray(),array('style'=>'margin-left: 10px;width: 75px;margin-top: 10px;'));
//echo CHtml::dropDownList('stay_in_year',$stay_in_year,getYearsArray(),array('style'=>'margin-left: 10px;width: 75px;margin-top: 10px;'));
?>
<!-- </td> -->
<!-- <td><b>Time at Job :</b><br> -->
<?php
//echo CHtml::dropDownList('employment_in_month',$employment_in_month,getMonthsArray(),array('style'=>'margin-left: 10px;width: 75px;margin-top: 10px;'));
//echo CHtml::dropDownList('employment_in_year',$employment_in_year,getYearsArray(),array('style'=>'margin-left: 10px;width: 75px;margin-top: 10px;'));
?>
<!-- </td> -->
<!-- <td><b>Min. Age :</b><br> -->
 <!-- >= --> <?php //echo CHtml::textField('age',$age,array('placeholder'=>'18','style'=>'width:100px;')); ?>
<!-- </td> -->
<td><b>Order :</b><br>
<?php
echo CHtml::radioButtonList('order',$order,array('-1' => 'ANYTHING','Asc'=>'Ascending','DESC'=>'Descending'),array('labelOptions'=>array('style'=>'display:inline')));
?>
</td>
<td colspan="3"><b>Fields to be downloaded :</b><br>
<?php echo CHtml::dropDownList('fields[]',$fields,Yii::app()->params['field_edu'],array('multiple'=>'true','size'=>'8')); ?>
</td>
</tr>
<tr>
<td colspan="5">&nbsp;
<?php echo CHtml::submitButton('Export',array('class'=>'btn btn btn-primary','name'=>'export')); ?>
&nbsp;&nbsp;&nbsp;<span class="csvfileinfo"> [Attention : Use " (Double Quotes) as Text delimiter while opning the file.]</span>
</td>
</tr>
</table>
<?php
$this->endWidget();
if(isset($NoDataFound)){ echo '<div class="alert alert-danger" align="center"><h4>No data found for this criteria.</h4></div>'; }
$this->endWidget();
?>
</div>
</div>
<?php 
function getMonthsArray(){
	for($i=0;$i<=11;$i++){
		$months[] = $i;
	}
	return array(0 => 'Month:') + $months;
}
function getYearsArray(){
	for($i=0;$i<=14;$i++){
		$years[] = $i;
	}
	return array(0 => 'Year:') + $years;
}
?>
