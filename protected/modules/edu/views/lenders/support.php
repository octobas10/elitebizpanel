<style type="text/css">
.success_msg{font-size: 16px;color:green;margin: 10px 0;}
.error_msg{font-size: 16px;color:red;margin: 10px 0;}	
</style>
<script type="text/javascript">
$(document).ready(function(){
	$(".alert").animate({opacity: 1.0}, 3000).fadeOut("slow");
	if($("textarea").val())
	{
		$("textarea").html($("textarea").val().replace(/\s+/g, ''));
	}
});
</script>

<?php
$this->breadcrumbs = array(
	'Support'
);
?>
<?php
//used for lenders when they try to send question
if(isset($_POST['support_submit']) && $_POST['support_question']!=''){
	if(ltrim($_POST['support_question'])!=''){
		extract($_POST);
		$name = Yii::app()->user->name;
		$user_email = $model['email'];
		$to = Yii::app()->params['adminEmail'];

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: EliteBizPanel <support@elitebizpanel.com>' . "\r\n";

		$subject = "New Support Query in EliteBizPanel";

		$mailmessage = "Hello Admin, We have new support query from following lender.<br><br>";
		$mailmessage = $mailmessage."<b>Name : </b>".$name."<br><br>";
		$mailmessage = $mailmessage."<b>Support Question : </b>".$_POST['support_question']."<br><br>";

		$email = mail($to, $subject, $mailmessage, $headers);

		if($email)
		{
			Yii::app()->user->setFlash('success','Thank you for contacting us. We will respond to you as soon as possible.');
			$email = mail($user_email, 'Thank you for contacting us', 'We will respond to you as soon as possible.', $headers);
			$this->refresh();
		}
		else
		{
			Yii::app()->user->setFlash('error','Error Occured. Try Again');
			$this->refresh();
		}
		unset($_POST['support_submit']);
	}
	else{
		Yii::app()->user->setFlash('error','Subject is blank. Try Again');
		$this->refresh();
	}
}
?>
<h4>Support :</h4>
 <div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">Lender Support Details</div>
</div>
<div class="portlet-content">
<?php if(Yii::app()->user->hasFlash('success')): ?>
<div class="alert alert-success" role="alert">
	<?php echo Yii::app()->user->getFlash('success'); ?>
</div>
<?php elseif(Yii::app()->user->hasFlash('error')): ?>
<div class="alert alert-danger" role="alert">
	<?php echo Yii::app()->user->getFlash('error'); ?>
</div>
<?php endif; ?>
<form name="support_form" id="support_form" class="support_form" method="post">
     <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
	<label style="font-size: 18px;">Your Question : </label>
		<textarea name="support_question" style="width:100%; height:100px; resize: none;" required class="form-control"><?php if(isset($_POST['support_subject']) && !empty($_POST['support_subject'])){ echo ltrim($_POST['support_subject']); } ?></textarea>
            </div>
         </div>
           <div class="col-sm-12">
	<input type="submit" name="support_submit" value="Submit Question" class="btn btn-primary">
         </div>
    </div>
</form>
     </div>
</div>
