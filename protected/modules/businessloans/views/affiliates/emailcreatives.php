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
	display: inline-block;
	margin-right: 5px; 
}
.creatives input[type="text"] {
    width: 22%;
}
.creatives input {
   margin: 7px;
}
.creatives input[type="submit"] {
	padding: 2px 9px;
}
.error{
	color:red;
}
div#error {
	display:none;
	background: none repeat scroll 0 0 lightyellow;
   border: 1px solid red;
   margin-bottom: 15px;
   width: 50%;
}
p.error {
   margin: 0;
   padding: 1px 13px;
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
.txtright {
  text-align: right;
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
div.email_creatives_form {
  width: 33%;
  float: left;
}
.title{
	font-size: 14px;
	font-weight: bold;
}
.banner-img-list li{
	float: left;
	margin: 8px;
	border: 3px solid #ccc;
	height: 100px;
	list-style: none;
}
.banner-img-list img{
	width: 100px;
	height: 100px;
}
</style>
<script>
$(document).ready(function(){
	$("#upload").click(function(){
		var promotional_image = $("#promotional_image").val();
		var error_msg = [];
		var error = 1;
		if(promotional_image == ''){
			error_msg.push("<p class='error'>Select Promotional Image Banner</p>");
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
			error_msg.push("<p class='error'>Enter Subject Line</p>");
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
			error_msg.push("<p class='error'>Enter From Line</p>");
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
<?php if(Yii::app()->user->getState('roles')==1){?>
<div class="creatives">
<?php if(isset($errors) && !empty($errors)){?>
	<div id="error" style="display: block !important;">
	<?php foreach($errors as $error){?>
		<p class='error'><?php echo $error;?></p>
	<?php }?>
	</div>
<?php } ?>
<div id="error"></div>

<div class="email_creatives_form add_banner_form">
<?php echo CHtml::beginForm($action='',$method='post',$htmlOptions=array('id'=>'creatives','enctype'=>'multipart/form-data'));?>
<table>
<tr>
<td><?php echo CHtml::label($label='Add Banner Image', $for='promotional_image', $htmlOptions=array());?></td>
</tr>
<tr>
<td><?php echo CHtml::fileField($name='promotional_image','',$htmlOptions=array());?></td>
</tr>
<tr>
<td colspan="2"><?php echo CHtml::submitButton($label='Upload Banner', $htmlOptions=array('name'=>'upload','id'=>'upload'));?></td>
</tr>
</table>
<?php echo CHtml::endForm();?>
</div>

<div class="email_creatives_form add_subjectlines_form">
<?php echo CHtml::beginForm($action='',$method='post',$htmlOptions=array('id'=>'creatives','enctype'=>'multipart/form-data'));?>
<table>
<tr>
<td><?php echo CHtml::label($label='Add Email Subject Line', $for='email_creatives_subject_line', $htmlOptions=array());?></td>
</tr>
<tr>
<td><?php echo CHtml::textField($name='email_creatives_subject_line',$value='',$htmlOptions=array('style'=>'width:204px;margin-left:0px'));?></td>
</tr>
<tr>
<td colspan="2"><?php echo CHtml::submitButton($label='Save', $htmlOptions=array('name'=>'add_subjectlines','id'=>'add_subjectlines'));?></td>
</tr>
</table>
<?php echo CHtml::endForm();?>
</div>

<div class="email_creatives_form add_fromlines_form">
<?php echo CHtml::beginForm($action='',$method='post',$htmlOptions=array('id'=>'creatives','enctype'=>'multipart/form-data'));?>
<table>
<tr>
<td><?php echo CHtml::label($label='Add Email From Line', $for='email_creatives_from_line', $htmlOptions=array());?></td>
</tr>
<tr>
<td><?php echo CHtml::textField($name='email_creatives_from_line',$value='',$htmlOptions=array('style'=>'width:204px;margin-left:0px'));?></td>
</tr>
<tr>
<td colspan="2"><?php echo CHtml::submitButton($label='Save', $htmlOptions=array('name'=>'add_fromlines','id'=>'add_fromlines'));?></td>
</tr>
</table>
<?php echo CHtml::endForm();?>
</div>

</div>
<?php }?>

<div style="clear: both;"></div>

<div class="row display_creatives">
<p class="title">elitebusinessloanscleaners Email Creatives:</p>


<?php
if(count($creatives)){?>
<ul class="banner-img-list">
<?php 
	foreach($creatives as $creative){
		//echo '<pre>';print_r($creative);echo '</pre>';
		?>
		<li><a href="viewemailcreatives?id=<?php echo $creative['id']?>" target="_blank">
			<img alt="" src="<?php echo Yii::app()->params['httphost'].Yii::app()->params['backEnd']?>/email_creatives/<?php echo $creative['image_name']?>">
			</a>
		</li>
<?php } ?>
</ul>
<?php }else{
	echo 'No Email Banners Availables.';
}
?>

</div>
<div class="row display_creatives">
<p class="title">elitebusinessloanscleaners Email Creatives Subject Lines:</p>
<?php 
if(count($email_creatives_subject_lines)){
foreach($email_creatives_subject_lines as $key=>$subject_line){
	$key++;
	//echo '<pre>';print_r($subject_line);echo '</pre>';
	?>
	<div class="subject_lines">
	<p><?php echo $key.'. '.$subject_line['subject_lines']?></p>
	<?php if(Yii::app()->user->getState('roles')==1){?>
	<!-- 
	<form action="" method="post">
	<input type="hidden" name="remove_id" value="<?php echo $subject_line['id'];?>">
	<p class="txtright"><input type="submit" value="Remove This Subject Line" onclick="return confirm('Are you sure? This can not be undone.');" style="border-radius:5px;padding: 5px;"></p>
	</form>
	 -->
	<?php }?>
	</div>
<?php }
}else{
	echo 'No Email Subject Lines.';
} ?>
</div>
<div class="row display_creatives">
<p class="title">elitebusinessloanscleaners Email Creatives From Lines:</p>
<?php
if(count($email_creatives_from_lines)){
foreach($email_creatives_from_lines as $key=>$from_lines){
	$key++;
	//echo '<pre>';print_r($from_lines);echo '</pre>';
	?>
	<div class="subject_lines">
	<p><?php echo $key.'. '.$from_lines['from_lines']?></p>
	<?php if(Yii::app()->user->getState('roles')==1){?>
	<!--
	<form action="" method="post">
	<input type="hidden" name="remove_id" value="<?php echo $from_lines['id'];?>">
	<p class="txtright"><input type="submit" value="Remove This Subject Line" onclick="return confirm('Are you sure? This can not be undone.');" style="border-radius:5px;padding: 5px;"></p>
	</form>
	 -->
	<?php }?>
	</div>
<?php }
}else{
	echo 'No Email From Lines Availables.';
} ?>
</div>
