<?php
$this->breadcrumbs = array(
	'Add Banner Creative' 
);
$this->menu = array(
	array(
		'label' => 'Email Creative',
		'url' => array('emailcreatives') 
	) 
);
?>
<style>
.creatives {
	//min-height: 680px;
}
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
</style>
<script>
$(document).ready(function(){
	$("#upload").click(function(){
		//var private_label = $("#private_label").val();
		var private_label = jQuery.trim($("#private_label").val());
		var promotional_text = $("#promotional_text").val();
		var promotional_image = $("#promotional_image").val();
		var error_msg = [];
		var error = 1;
		
		if(private_label == ''){
			error_msg.push("<p class='error'>Enter Private Label URL</p>");
			error = 0;
		}
		if(private_label!=''){
			var pattern = /^(http|https)?:\/\/[a-zA-Z0-9-\.]+\.[a-z]{2,4}/;
			if(!pattern.test(private_label)){
				error_msg.push("<p class='error'>Enter Valid Private Label URL staring with http://</p>");
				error = 0;
		    }
		}
		if(promotional_text == ''){
			error_msg.push("<p class='error'>Enter Promotional Text</p>");
			error = 0;
		}
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
});
</script>
<h4>Banner Creatives</h4>
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
<?php echo CHtml::beginForm($action='',$method='post',$htmlOptions=array('id'=>'creatives','enctype'=>'multipart/form-data'));?>
<table>
<!--
<tr>
<td><?php //echo CHtml::label($label='Private Label', $for='private_label', $htmlOptions=array());?></td>
<td><?php //echo CHtml::dropDownList($name='private_label','',$data=$private_label);?></td>
</tr>
-->
<tr>
<td><?php echo CHtml::label($label='Private Label URL', $for='private_label', $htmlOptions=array());?></td>
<td><?php echo CHtml::textField($name='private_label',$value='',$htmlOptions=array('style'=>'width:204px;margin-left:0px'));?></td>
</tr>
<tr>
<td><?php echo CHtml::label($label='Promotional Text', $for='promotional_text', $htmlOptions=array());?></td>
<td><?php echo CHtml::textArea($name='promotional_text','',$htmlOptions=array());?></td>
</tr>
<tr>
<td><?php echo CHtml::label($label='Promotional Image', $for='promotional_image', $htmlOptions=array());?></td>
<td><?php echo CHtml::fileField($name='promotional_image','',$htmlOptions=array());?></td>
</tr>
<tr>
<td colspan="2"><?php echo CHtml::submitButton($label='Add Creative', $htmlOptions=array('name'=>'upload','id'=>'upload'));?></td>
</tr>
</table>
<?php echo CHtml::endForm();?>
</div>
<?php }?>

<div class="display_creatives">
<?php
if(isset($creatives)){}
foreach($creatives as $creative){?>
	<div class="promo_image">
	<p><a href="<?php echo $creative['private_label'].'?promo_code='.Yii::app()->user->id?>" target="_blank"><img alt="Get a payday advance up to $1500" src="<?php echo Yii::app()->params['httphost'].Yii::app()->params['backEnd']?>/promotional_creatives/<?php echo $creative['image_name']?>"></a></p>
	<p>Copy and paste this code on your website or click on the banner : <?php echo $creative['private_label'].'?promo_code='.Yii::app()->user->id?></p>
	<p class="cut_and_paste"><code>
	
	
	&lt;a title="<?php echo $creative['promotional_text']?>" href="<?php echo $creative['private_label'].'?promo_code='.Yii::app()->user->id?>"&gt;&lt;img src="<?php echo Yii::app()->params['httphost'].Yii::app()->params['backEnd']?>/promotional_creatives/<?php echo $creative['image_name']?>" alt="<?php echo $creative['promotional_text']?>" border="0"&gt;&lt;/a&gt;


	
	</code></p>
	<?php if(Yii::app()->user->getState('roles')==1){?>
	<form action="" method="post">
	<input type="hidden" name="remove_id" value="<?php echo $creative['id'];?>">
	<p class="txtright"><input type="submit" value="Remove This Ad" onclick="return confirm('Are you sure? This can not be undone.');"></p>
	</form>
	<?php }?>
	</div>
<?php }
?>
</div>
