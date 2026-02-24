<?php
/* @var $this LenderAffiliateSettingsController */
/* @var $model LenderAffiliateSettings */
/* @var $form CActiveForm */
?>

<div class="wide form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'action'=>Yii::app()->createUrl($this->route),
	'method'=>'get',
)); ?>
<div style="height:100%;width:100%;">
    <div style="display: inline-block; *display: inline;vertical-align:top; padding-right: 9px;">
		<?php echo $form->dropDownList($model,'affiliate_user_id',$affiliate,array('style'=>'width:auto;')); ?>
		<?php echo $form->error($model,'affiliate_user_id'); ?></div>
    <div style="display: inline-block; *display: inline; padding-right: 9px;">
		<?php echo $form->dropDownList($model,'lender_details_id',$lender,array('empty'=>'--Select--'),array('style'=>'width:auto;')); ?>
		<?php echo $form->error($model,'lender_details_id'); ?></div>
		
		<div style="display: inline-block; *display: inline;vertical-align:top;">
		 <?php echo CHtml::submitButton('SEARCH',array('class'=>'btn btn btn-primary'));  ?>
		</div>
    <!--<div style="width:25%;display: inline-block; *display: inline;">
	<?php //echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn btn-primary')); ?></div> -->
</div>
<?php $this->endWidget(); ?>

</div><!-- search-form -->
