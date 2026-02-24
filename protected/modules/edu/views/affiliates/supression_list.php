<?php
$this->breadcrumbs = array(
	'Supression List' 
);
?>
<style>
    .main-body {
        min-height: 70vh;
    }
    * {
        box-sizing: border-box;
    }
    textarea.form-control {
        height: 80px;
        resize: none;
        margin-bottom: 20px;
    }
    .alert {
        max-width: 400px;
    }
    .add_supression_list_form {
        margin-bottom: 20px;
    }
	.btn{
			white-space:normal;
	}
</style>
<?php
//Yii::app()->clientScript->registerScript(
//   'myHideEffect',
//   '$(".success_msg").animate({opacity: 1.0}, 2000).fadeOut("slow");',
//   CClientScript::POS_READY
//);
Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$(".alert").animate({opacity: 1.0}, 5000).fadeOut("slow");',
   CClientScript::POS_READY
);
?>
<h4>Supression List</h4>
 <div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">Supression list</div>
</div>
<div class="portlet-content">
<div class="content">
<div class="supression">
<!--Additional code added for users only not for admin-->
<?php if(Yii::app()->user->getState('roles')!=1){?>
<?php if(Yii::app()->user->hasFlash('error')) : ?>
    <div class="alert alert-danger">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; } ?>
<a href="?email_suprression_list=1" style="margin-bottom:10px;display:inline-block"><button class="btn btn-success supression_button">Download Email Supression List</button></a>&nbsp;
<a href="?phone_supression_list=1"><button class="btn btn-success supression_button">Download Phone Supression List</button></a>
</div>
<hr>

<div class="add_supression_list_form">
<form action="" method="POST">
<!--<table border="0" cellspacing="0" class="data" style="width: 100%;">
<tr>
	<td>
	<label for="textarea"><b>Enter Email(s) to add in supression list. </b></label>
	</td>
	<td>
	<textarea name="emails_text" id="emails_text" class="round full-width-textarea" style="width:354px; height:42px;"></textarea>
	</td>
	<td>
	<input type="submit" name="emails" value="Add Email(s)" class="round blue ic-right-arrow">
	</td>
</tr>
<tr>
	<td><label for="textarea"><b>Enter Phone(s) to add in supression list. </b></label></td>
	<td><textarea name="phones_text" id="phones_text" class="round full-width-textarea" style="width:354px; height:42px;"></textarea></td>
	<td><input type="submit" name="phones" value="Add Phone(s)" class="round blue ic-right-arrow">	</td>
</tr>
</table>-->
<?php if(Yii::app()->user->getState('roles')==1){?>
 <div class="row">
    <div class="col-sm-6 form-group">
        <label for="emails_text"><strong>Enter Email(s) to add in suppression list</strong></label>
        <textarea name="emails_text" id="emails_text"  class="form-control" ></textarea>
        <input type="submit" name="emails" value="Add Email(s)" class="btn btn-primary round blue ic-right-arrow">
    </div>
        <div class="col-sm-6 form-group">
        <label for="phones_text"><strong>Enter Phone(s) to add in suppression list</strong></label>
        <textarea name="phones_text" id="phones_text" class="form-control" ></textarea>
        <input type="submit" name="phones" value="Add Phone(s)" class="btn btn-primary round blue ic-right-arrow">
    </div>
</div>
<?php } ?>
</form>
</div>
<?php if(Yii::app()->user->getState('roles')==1){?>
<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="alert alert-success" role="alert">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php elseif(Yii::app()->user->hasFlash('error')) : ?>
    <div class="alert alert-danger" role="alert">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>
<?php }?>
</div>
     </div>
</div>
