<?php
$this->breadcrumbs = array(
	'Add Email Creative' 
);
$this->menu = array(
	array(
		'label' => 'Banner Creative',
		'url' => array('creatives'),
	)
);
?>
<style>
.content{
	min-height: 680px;
}
.creatives label {
	display: block;
	margin-bottom: 5px; 
}
.promo_image{
	border: 2px solid #999;
	padding: 5px;
	margin-bottom: 10px;
}
code {
  display: block;
  white-space: nowrap;
  color: #fff;
  background-color: #444;
  padding: 1em;
  border: 1px solid #d1d1d1;
  overflow: auto;
}
    input[type="file"]{
        margin: 9px 0;
    }
.txtright {
  text-align: right;
}
    .txtcenter {
  text-align: center;
}
.display_creatives{
	width: 100%;
	border: 1px solid #ccc;
	padding: 5px;
	margin-bottom: 5px;
}
.display_creatives p {
  color: black;
  margin-bottom: 5px;
}
.display_creatives a {
  text-decoration: underline;
  color: black;
}
    .btn {
        margin-top: 10px;
    }
.title{
	font-size: 14px;
	font-weight: bold;
}
    .margin_bottom_40 {
        margin-bottom: 40px;
    }
.banner-img-list li{
	float: left;
	margin: 8px;
	border: 3px solid #ccc;
/*	height: 100px;*/
    height:auto;
	list-style: none;
}
.banner-img-list img{
	width: 100px;
	height: 100px;
}
    .alert {
        display: inline-block;
        min-width: 400px;
        margin-top: 20px;
    }
</style>


<script>
$(document).ready(function(){
	$("#upload").click(function(){
		var promotional_image = $("#promotional_image").val();
		var error_msg = [];
		var error = 1;
		if(promotional_image == ''){
			error_msg.push("<div class='alert alert-danger' role='alert'>Select Promotional Image Banner</div>");
			error = 0;
		}
		if(error == 0){
			var error_msg_str = '';
			$.each(error_msg, function( index, value ) {
				error_msg_str = error_msg_str + value;
			});
			$("#error").show();
			$("#error").html(error_msg_str);
			return false;
		}
	});

	$("#add_subjectlines").click(function(){
		var email_creatives_subject_line = $("#email_creatives_subject_line").val();
		var error_msg = [];
		var error = 1;

		if(email_creatives_subject_line == ''){
			error_msg.push("<div class='alert alert-danger' role='alert'>Enter Subject Line</div>");
			error = 0;
		}
		if(error == 0){
			var error_msg_str = '';
			$.each(error_msg, function( index, value ) {
				error_msg_str = error_msg_str + value;
			});
			$("#error").show();
			$("#error").html(error_msg_str);
			return false;
		}
	});

	$("#add_fromlines").click(function(){
		var email_creatives_from_line = $("#email_creatives_from_line").val();
		var error_msg = [];
		var error = 1;

		if(email_creatives_from_line == ''){
			error_msg.push("<div class='alert alert-danger' role='alert'>Enter From Line</div>");
			error = 0;
		}
		if(error == 0){
			var error_msg_str = '';
			$.each(error_msg, function( index, value ) {
				error_msg_str = error_msg_str + value;
			});
			$("#error").show();
			$("#error").html(error_msg_str);
			return false;
		}
	});
});
</script>
<h4>Email Creatives</h4>
 <div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">Email Detail</div>
</div>
<div class="portlet-content">
<?php if(Yii::app()->user->getState('roles')==1){?>
<div class="creatives">
<?php if(isset($errors) && !empty($errors)){?>
	<div id="error" style="display: block !important;">
	<?php foreach($errors as $error){?>
		<p class='error'><?php echo $error;?></p>
	<?php }?>
	</div>
<?php } ?>
<?php
Yii::app()->clientScript->registerScript(
   'myHideEffect',
   '$("#error").animate({opacity: 1.0}, 2000).fadeOut("slow");',
   CClientScript::POS_READY
);
?>
    
    
<div class="row margin_bottom_40">
<div class="clearfix">

    <div class="col-sm-4 form-group">
<div class="add_subjectlines_form">
<?php echo CHtml::beginForm($action='',$method='post',$htmlOptions=array('id'=>'creatives','enctype'=>'multipart/form-data'));?>
<?php echo CHtml::label($label='Add Email Subject Line', $for='email_creatives_subject_line', $htmlOptions=array());?><?php echo CHtml::textField($name='email_creatives_subject_line',$value='',$htmlOptions=array('class'=>'form-control'));?><?php echo 
'</div>
</div>

    <div class="col-sm-4 form-group">
<div class="add_fromlines_form">'; ?>

<?php echo CHtml::label($label='Add Email From Line', $for='email_creatives_from_line', $htmlOptions=array());?><?php echo CHtml::textField($name='email_creatives_from_line',$value='',$htmlOptions=array('class'=>'form-control'));?><?php echo 
'</div>

</div>
    <div class="col-sm-4 form-group">
<div class="add_banner_form">'; ?>

    <?php echo CHtml::label($label='Add Banner Image', $for='promotional_image', $htmlOptions=array());?><?php echo CHtml::fileField($name='promotional_image','',$htmlOptions=array());?>
<?php echo CHtml::submitButton($label='Upload Banner', $htmlOptions=array('name'=>'upload','class'=>'btn btn-primary','id'=>'upload'));?>

<?php echo CHtml::endForm();?>
</div>
</div>
</div>
 <div class="clearfix">   
<div class="col-sm-12" id="error"></div>
</div>
</div>
<?php }?>


<div class="clearfix display_creatives">
<p class="title">Higher Learning Marketers Email Creatives:</p>


<?php if(count($creatives)) { ?>
	<ul class="banner-img-list">
		<?php 
		foreach($creatives as $creative) {
			$filename=Yii::app()->params['httphost'].Yii::app()->params['backEnd']."/edu_email_creatives/".$creative['image_name'];
			$defaultfile=Yii::app()->params['httphost'].Yii::app()->params['backEnd']."/edu_email_creatives/eac430x600c_1434093356.jpg";
			if (getimagesize($filename) !== false) {
			?>
				<li>
					<a href="viewemailcreatives?id=<?php echo $creative['id']?>" target="_blank">
						<img alt="" class="img-responsive" src="<?php echo $filename; ?>" class="img-responsive">
					</a>
					<?php if(Yii::app()->user->getState('roles')==1) { ?>
						<form action="" method="post">
							<input type="hidden" name="remove_id" value="<?php echo $creative['id'];?>">
							<p class="txtcenter"><input type="submit" value="Delete" class="btn btn-danger" onclick="return confirm('Are you sure? This can not be undone.');" style="border-radius:5px;padding: 5px;"></p>
						</form>
					<?php } ?>
				</li>
			<?php
			} else{
			?>
				<li>
					<a href="viewemailcreatives?id=<?php echo $creative['id']?>" target="_blank">
						<img alt="" class="img-responsive" src="<?php echo $defaultfile; ?>">
					</a>
					<?php if(Yii::app()->user->getState('roles')==1) { ?>
						<form action="" method="post">
							<input type="hidden" name="remove_id" value="<?php echo $creative['id'];?>">
							<p class="txtcenter"><input type="submit" class="btn btn-danger" value="Delete" onclick="return confirm('Are you sure? This can not be undone.');" style="border-radius:5px;padding: 5px;"></p>
						</form>
					<?php } ?>
				</li>
			<?php
			}
			?>
		<?php } ?>
	</ul>
<?php } else {
	echo 'No Email Banners Available.';
}
?>

</div>
<div class="clearfix display_creatives">
<p class="title">Higher Learning Marketers Email Creatives Subject Lines:</p>
<?php 
if(count($email_creatives_subject_lines)) {
	foreach($email_creatives_subject_lines as $key=>$subject_line) {
	$key++;
?>
	<div class="subject_lines">
		<p><?php echo $key.'. '.$subject_line['subject_lines']?></p>
		<?php if(Yii::app()->user->getState('roles')==1) { ?>
			<!--<form action="" method="post">-->
				<!--<input type="hidden" name="remove_id" value="<?php //echo $subject_line['id'];?>">-->
				<!--<p class="txtright"><input type="submit" value="Remove This Subject Line" onclick="return confirm('Are you sure? This can not be undone.');" style="border-radius:5px;padding: 5px;"></p>-->
			<!--</form>-->
		<?php } ?>
	</div>
	<?php }
} else {
	echo 'No Email Subject Lines.';
} ?>
</div>
<div class="clearfix display_creatives">
<p class="title">Higher Learning Marketers Email Creatives From Lines:</p>
<?php
if(count($email_creatives_from_lines)) {
	foreach($email_creatives_from_lines as $key=>$from_lines) {
	$key++;
?>
	<div class="subject_lines">
		<p><?php echo $key.'. '.$from_lines['from_lines']?></p>
		<?php if(Yii::app()->user->getState('roles')==1) { ?>
			<!--<form action="" method="post">-->
				<!--<input type="hidden" name="remove_id" value="<?php //echo $from_lines['id']; ?>">-->
				<!--<p class="txtright"><input type="submit" value="Remove This Subject Line" onclick="return confirm('Are you sure? This can not be undone.');" style="border-radius:5px;padding: 5px;"></p>-->
			
			<!--</form>-->
		<?php } ?>
	</div>
	<?php }
} else {
	echo 'No Email From Lines Availables.';
} ?>
</div>
    </div>
     </div>