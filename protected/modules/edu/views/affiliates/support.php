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
//used for affiliates when they try to send question
if(isset($_POST['support_submit']) && isset($_POST['support_question']) && $_POST['support_question']!=''){
	if(ltrim($_POST['support_question'])!=''){
		extract($_POST);
		$promo_code = Yii::app()->user->id;
		$user_email = $model['email'];
		$to = Yii::app()->params['adminEmail'];

		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$headers .= 'From: EliteBizPanel <support@elitebizpanel.com>' . "\r\n";

		$subject = "New Support Query in EliteBizPanel";

		$mailmessage = "Hello Admin, We have new support query from following affiliate.<br><br>";
		$mailmessage = $mailmessage."<b>Promo Code : </b>".$promo_code."<br><br>";
		$mailmessage = $mailmessage."<b>Support Question : </b><pre>".$_POST['support_question']."</pre><br><br>";

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


//used for admin when they try to send support
if(isset($_POST['support_submit_aff_len']) && $_POST['support_submit_aff_len']!=''){
	if(ltrim($_POST['support_subject'])!='' && ltrim($_POST['support_message'])) {
		$to='';
		foreach($_POST['sel_aff'] as $sel_aff)
		{
			if (filter_var($sel_aff, FILTER_VALIDATE_EMAIL)) {
				$to.=$sel_aff.",";
			}
		}
		foreach($_POST['sel_len'] as $sel_len)
		{
			if (filter_var($sel_len, FILTER_VALIDATE_EMAIL)) {
				$to.=$sel_len.",";
			}
		}
		if(!empty($to))
		{	
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			$headers .= 'From: HigherLearningMarketers <support@higherlearningmarketers.com>' . "\r\n";

			$subject = $_POST['support_subject'];

			
			$mailmessage = $mailmessage."<pre>".$_POST['support_message']."</pre><br><br>";
			$email = mail($to, $subject, $mailmessage, $headers);

			if($email)
			{
				Yii::app()->user->setFlash('success','Email Sent to selected Recipient(s).');
				$this->refresh();
			}
			else
			{
				Yii::app()->user->setFlash('error','Error Occured. Try Again');
				$this->refresh();
			}
			unset($_POST['support_submit_aff_len']);
		}
		else
		{
			Yii::app()->user->setFlash('error','No Valid Affiliate or Lender Selected');
		}
		unset($_POST['support_submit_aff_len']);
	}
	else{
		Yii::app()->user->setFlash('error','Subject and/or Message is blank. Try Again');
		$this->refresh();
	}
}
?>
<h4>Support :</h4>
 <div class="portlet">
<div class="portlet-decoration">
<div class="portlet-title">Affiliate Support Details</div>
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
<?php
if(Yii::app()->user->getState('roles')==1)
{
?>

<form name="admin_support_form_aff_len" id="admin_support_form_aff_len" class="admin_support_form_aff_len" method="post">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
            <label>Enter Subject : </label>
	<textarea class="form-control" name="support_subject" style="width:100%; height:100px; resize: none;" required>
		<?php if(isset($_POST['support_subject']) && !empty($_POST['support_subject'])){ echo ltrim($_POST['support_subject']); } ?></textarea>
            </div>
        </div>
        <div class="col-sm-12">
            <div class="form-group">
            <label>Enter Message : </label>
    <!--
    /**
      * @author : vatsal gadhia
      * @description : support message field added
      * @since : 31-08-2016
    */
    -->
	<textarea class="form-control" name="support_message" style="width:100%; height:100px; resize: none;" required>
		<?php if(isset($_POST['support_message']) && !empty($_POST['support_message'])){ echo ltrim($_POST['support_message']); } ?></textarea>
            </div>
        </div>
        <div class="col-sm-6">
             <div class="form-group">
	<label>Select Affiliate's Email(s) :</label>
		<select name="sel_aff[]" multiple="mulitple" size="4" class="form-control">
			<option value="0">Select Affiliate(s)</option>
				<?php
					if(isset($aff_emails) && !empty($aff_emails))
					{
						for($i=0;$i<sizeof($aff_emails);$i++)
						{
							?>
								<option value="<?php print_r($aff_emails[$i]['email']); ?>"><?php print_r($aff_emails[$i]['email']); ?></option>
							<?php
						}
					}
					else
					{
						echo "<option value='0'>No Affiliates Found</option>";
					}
 				?>
		</select>
            </div>
        </div>
        <div class="col-sm-6">
             <div class="form-group">
	<label>Select Lender's Email(s) :</label>
		<select name="sel_len[]" multiple="mulitple" size="4" class="form-control">
			<option value="0">Select Lender(s)</option>
				<?php
					if(isset($len_emails) && !empty($len_emails))
					{
						for($i=0;$i<sizeof($len_emails);$i++)
						{
							?>
								<option value="<?php print_r($len_emails[$i]['email']); ?>"><?php print_r($len_emails[$i]['email']); ?></option>
							<?php
						}
					}
					else
					{
						echo "<option value='0'>No Lenders Found</option>";
					}
 				?>
		</select>
            </div>
        </div>
        <div class="col-sm-12">
             <div class="">
	<input type="submit" name="support_submit_aff_len" value="Send Mail" class="btn btn-primary">
            </div>
        </div>
    </div>
</form>
<?php } else {
?>
<form name="support_form" id="support_form" class="support_form" method="post">
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
	<label style="font-size: 18px;">Your Question : </label>
		<textarea name="support_question" style="width:100%; height:100px; resize: none;" required class="form-control"></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <input type="submit" name="support_submit" value="Submit Question" class="btn btn-primary">
        </div>
    </div>
	
            
</form>
<?php } ?>
     </div>
</div>