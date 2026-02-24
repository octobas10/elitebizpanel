<?php
/* @var $this AutoFeedLendersController */
/* @var $model AutoFeedLenders */
/* @var $form CActiveForm */
?>
<style>
    div.form > form .row{
        margin-left:-15px;
    }
</style>
<div class="form">
<?php $form = $this->beginWidget('CActiveForm', array(
	'id'=>'edu-feed-lenders-form',
	'enableAjaxValidation'=>false,
)); ?>
<?php 
// if($model->delay){
// 	$model_delay = explode(' ', $model->delay);
// 	$model->delay = $model_delay[0];
// 	$delaytime = $model_delay[1];
// }else {
// 	$delaytime = '';
// }
?>
        <div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">Feed Lender</div>
</div>
<div class="portlet-content">
	<div class="row">
          <div class="col-sm-6">
	<div class="form-group">
		<?php echo $form->labelEx($model,'feed_lender_name'); ?>
		<?php echo $form->textField($model,'feed_lender_name',array('class'=>'form-control','size'=>60,'maxlength'=>50,'readonly'=>'readonly')); ?>
		<?php echo $form->error($model,'feed_lender_name'); ?>
	</div>
	<?php if(!in_array("profile",explode("/",Yii::app()->request->requestUri))){ ?>
		<div class="form-group">
			<?php echo $form->labelEx($model,'password'); ?>
			<?php echo $form->passwordField($model,'password',array('class'=>'form-control','size'=>60,'maxlength'=>50)); ?>
			<?php echo $form->error($model,'password'); ?>
		</div> 
	<?php }	?>
	<div class="form-group">
		<?php echo $form->labelEx($model,'parameter1'); ?>
		<?php echo $form->textField($model,'parameter1',array('size'=>60,'class'=>'form-control',)); ?>
		<?php echo $form->error($model,'parameter1'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'parameter2'); ?>
		<?php echo $form->textField($model,'parameter2',array('size'=>60,'class'=>'form-control',)); ?>
		<?php echo $form->error($model,'parameter2'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'parameter3'); ?>
		<?php echo $form->textField($model,'parameter3',array('size'=>60,'class'=>'form-control',)); ?>
		<?php echo $form->error($model,'parameter3'); ?>
	</div>
              <div class="form-group">
		<?php echo $form->labelEx($model,'post_url'); ?>
		<?php echo $form->textField($model,'post_url',array('class'=>'form-control','size'=>60,'class'=>'form-control',)); ?>
		<?php echo $form->error($model,'post_url'); ?>
	</div>
        </div>
        <div class="col-sm-6">
	
	<div class="form-group">
		<?php echo $form->labelEx($model,'test_url'); ?>
		<?php echo $form->textField($model,'test_url',array('size'=>60,'class'=>'form-control',)); ?>
		<?php echo $form->error($model,'test_url'); ?>
	</div>
	<?php $model->submission_cap = isset($model->submission_cap) ? $model->submission_cap:'-1'; ?>	
	<div class="form-group">
		<?php echo $form->labelEx($model,'submission_cap'); ?>
		<?php echo $form->textField($model,'submission_cap',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'submission_cap'); ?>
	</div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'interval'); ?>
        <div class="row">
            <div class="col-sm-6">
		<?php echo $form->textField($model,'interval',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'interval'); ?>
            </div>
            <div class="col-sm-6">
		<?php echo CHtml::dropdownlist('intervaltime','intervaltime',array('sec'=>'Second','min'=>'Minutes'),array('class'=>'form-control'));?>
	</div>
        </div>
            </div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'delay'); ?>
         <div class="row">
            <div class="col-sm-6">
		<?php echo $form->textField($model,'delay',array('class'=>'form-control')); ?>
		<?php echo $form->error($model,'delay'); ?>
             </div>
             <div class="col-sm-6">
		<?php echo CHtml::dropdownlist('delaytime','delaytime',array('HOUR'=>'Hour','DAY'=>'Day'),array('class'=>'form-control'));?>
	</div>
        </div>
            </div>
	<div class="form-group">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->dropDownList($model,'status', array(''=>'--Select--','0'=>'Inactive','1'=>'Live','2'=>'Legacy'),array('class'=>'form-control'));?>
		<?php echo $form->error($model,'status'); ?>
	</div>
        </div>
    </div>
    <div class="row buttons">
        <div class="col-sm-12">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save',array('class'=>'btn btn btn-primary')); ?>
	</div>
    </div>
<?php $this->endWidget(); ?>
</div><!-- form -->
