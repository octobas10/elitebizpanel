<?php
include_once 'names.php';
include_once 'ssn.php';
include_once 'zipcode_city_state.php';
$firstname = $firstnames[array_rand($firstnames)];
$lastname = $lastnames[array_rand($lastnames)];
$homephoneNumber = '202201'.rand(1111,9999);
$mobile = '202201'.rand(1111,9999);
$email = 'jen@elitemate.com';
$ssn = $ssn[array_rand($ssn)];
$zip = array_rand($zipcode);
$city = $zipcode[$zip]['city'];
$state = $zipcode[$zip]['state'];
?>
<section class="test-auto-lender-page mortgage-dashboard-section" id="top">
	<header class="leads-page-header">
		<h1 class="leads-page-title">Test Auto Lenders</h1>
		<p class="leads-page-subtitle">Run test submissions with sample data. Select affiliate, lender and fill or adjust the form, then run the test.</p>
	</header>

	<div class="row-fluid test-auto-lender-card">
		<div class="span12">
			<?php
			$this->beginWidget('zii.widgets.CPortlet', array('title' => 'Test parameters'));
			$form = $this->beginWidget('CActiveForm', array(
				'id' => 'testcashlender',
				'enableAjaxValidation' => true,
				'clientOptions' => array(
					'validateOnSubmit' => true,
					'validateOnChange' => true
				)
			));
			echo $form->hiddenField($Submission_model, 'lead_mode', array('value' => ($lead_mode ? $lead_mode : '0')));
			echo $form->hiddenField($Submission_model, 'sub_id', array('value' => ($sub_id ? $sub_id : '')));
			echo $form->hiddenField($Submission_model, 'city', array('value' => ($city ? $city : 'NEWTON FALLS')));
			echo $form->hiddenField($Submission_model, 'state', array('value' => ($state ? $state : 'OH')));
			echo CHtml::hiddenField('pingpost', 'both');
			$Submission_model->dob_month = 4;
			$Submission_model->dob_day = 7;
			$Submission_model->dob_year = 1982;
			$Submission_model->stay_in_year = 2;
			$Submission_model->stay_in_month = 5;
			$Submission_model->employment_in_year = 4;
			$Submission_model->employment_in_month = 8;
			$Submission_model->home_pay = 1500;
			?>
			<div class="test-auto-lender-form">
				<div class="test-auto-lender-grid">
					<div class="test-auto-lender-col">
						<div class="test-auto-lender-group"><label for="AffiliateUser_id">Affiliate</label><?php echo $form->dropDownList($AffiliateUser_model, 'id', CHtml::listData(AffiliateUser::model()->findAll(), 'id', 'id'), array('empty' => '--Select--', 'class' => 'inputClass')); ?></div>
						<div class="test-auto-lender-group"><label>Lender <span class="testcash_lender_label">(Only Test Mode Status Lenders)</span></label><?php echo $form->dropDownList($LenderDetails_model, 'name', CHtml::listData(LenderDetails::model()->findAll(array("condition" => "status = 0")), 'id', 'name'), array('class' => 'inputClass')); ?></div>
						<div class="test-auto-lender-group"><label for="first_name">First Name</label><input type="text" class="inputClass t3InputText required" maxlength="128" value="<?php echo trim($firstname); ?>" id="first_name" name="first_name"></div>
						<div class="test-auto-lender-group"><label for="last_name">Last Name</label><input type="text" class="inputClass t3InputText required" maxlength="128" value="<?php echo trim($lastname); ?>" id="last_name" name="last_name"></div>
						<div class="test-auto-lender-group"><label for="gender">Gender</label><select name="gender" class="inputClass required"><option value="M">Male</option><option value="F">Female</option></select></div>
						<div class="test-auto-lender-group"><label>Date of Birth</label><span class="test-auto-lender-inline"><?php echo $form->dropDownList($Submission_model, 'dob_month', $Submission_model->getMonthsArray(), array('class' => 'date'), array('options' => array($dob_month => array('selected' => 'selected')))); ?><?php echo $form->dropDownList($Submission_model, 'dob_day', $Submission_model->getDaysArray(), array('class' => 'date'), array('options' => array($dob_day => array('selected' => 'selected')))); ?><?php echo $form->dropDownList($Submission_model, 'dob_year', $Submission_model->getYearsArray(), array('class' => 'date'), array('options' => array($dob_year => array('selected' => 'selected')))); ?></span></div>
						<div class="test-auto-lender-group"><label for="email">Email</label><input type="text" class="inputClass t3InputText required email" maxlength="255" value="<?php echo trim($email); ?>" id="email" name="email"></div>
						<div class="test-auto-lender-group"><label for="zip">Zip Code</label><input type="text" class="inputClass t3InputText required" maxlength="5" value="<?php echo trim($zip); ?>" id="zip" name="zip"></div>
					</div>
					<div class="test-auto-lender-col">
						<div class="test-auto-lender-group"><label for="phone">Primary Phone</label><input type="text" value="<?php echo trim($homephoneNumber); ?>" class="inputClass t3InputText required" name="phone" id="phone"></div>
						<div class="test-auto-lender-group"><label for="ssn">SSN</label><input type="text" value="<?php echo trim($ssn); ?>" class="inputClass t3InputText required" name="ssn" id="ssn"></div>
						<div class="test-auto-lender-group"><label>Home Payment</label><?php echo $form->dropDownList($Submission_model, 'home_pay', array('' => '--Select Mortgage / Rent--', '150' => '$100-200', '300' => '$200-400', '500' => '$400-600', '700' => '$601-800', '900' => '$801-1000', '1100' => '$1001-$1200', '1350' => '$1201-$1500', '1500' => '$1500+'), array('class' => 'inputClass', 'options' => array($home_pay => array('selected' => 'selected')))); ?></div>
						<div class="test-auto-lender-group"><label for="mobile">Cell</label><input type="text" class="inputClass t3InputText" value="<?php echo trim($mobile); ?>" name="mobile" id="mobile"></div>
						<div class="test-auto-lender-group"><label for="address">Street Address</label><input type="text" class="inputClass t3InputText required" maxlength="100" value="Macrae Road" id="address" name="address"></div>
						<div class="test-auto-lender-group"><label>Length at Address</label><span class="test-auto-lender-inline"><?php echo $form->dropDownList($Submission_model, 'stay_in_year', $Submission_model->getStayInYearArray(), array('class' => 'address_length'), array('options' => array($stay_in_year => array('selected' => 'selected')))); ?><?php echo $form->dropDownList($Submission_model, 'stay_in_month', $Submission_model->getStayInMonthArray(), array('class' => 'address_length'), array('options' => array($stay_in_month => array('selected' => 'selected')))); ?></span></div>
						<div class="test-auto-lender-group"><label>Rent or Own?</label><span class="test-auto-lender-radios"><label class="radio-inline"><input type="radio" name="is_rented" value="rent" checked="checked"> Rent</label><label class="radio-inline"><input type="radio" name="is_rented" value="own"> Own</label></span></div>
						<div class="test-auto-lender-group"><label for="income_type">Income Type</label><select id="income_type" name="income_type" class="inputClass t3InputText required"><?php foreach (array('' => 'Select', '1' => 'Employed Full Time', '2' => 'Employed Part Time', '3' => 'Employed Temporary', '4' => 'Self Employed', '5' => 'Retired', '6' => 'On Benefits', '7' => 'Unemployed') as $v => $l) { ?><option value="<?php echo $v; ?>"<?php echo $v === '1' ? ' selected="selected"' : ''; ?>><?php echo $l; ?></option><?php } ?></select></div>
						<div class="test-auto-lender-group"><label for="monthly_income">Monthly Net Income</label><select id="monthly_income" name="monthly_income" class="inputClass t3InputText required"><?php $mi_opts = array('' => 'Select', '200' => 'Less than 500', '500' => '500 - 749', '750' => '750 - 999', '1000' => '1,000 - 1,125', '1126' => '1,126 - 1,375', '1376' => '1,376 - 1,625', '1626' => '1,626 - 1,875', '1876' => '1,876 - 2,125', '2126' => '2,126 - 2,375', '2376' => '2,376 - 2,625', '2626' => '2,626 - 2,875', '2876' => '2,876 - 3,125', '3126' => '3,126 - 3,375', '3376' => '3,376 - 3,625', '3626' => '3,626 - 3,875', '3876' => '3,876 - 4,125', '4126' => '4,126 - 4,375', '4376' => '4,376 - 4,625', '4626' => '4,626 - 4,875', '5000' => 'More than 5,000'); foreach ($mi_opts as $v => $l) { ?><option value="<?php echo $v; ?>"<?php echo $v === '1876' ? ' selected="selected"' : ''; ?>><?php echo $l; ?></option><?php } ?></select></div>
					</div>
					<div class="test-auto-lender-col">
						<div class="test-auto-lender-group"><label for="employer">Employer Name</label><input type="text" maxlength="128" class="inputClass t3InputText required" value="Datacentric" id="employer" name="employer"></div>
						<div class="test-auto-lender-group"><label for="job_title">Job Title</label><input type="text" maxlength="128" class="inputClass t3InputText required" value="Chef" id="job_title" name="job_title"></div>
						<div class="test-auto-lender-group"><label>Employment Duration</label><span class="test-auto-lender-inline"><?php echo $form->dropDownList($Submission_model, 'employment_in_year', $Submission_model->getEmpInYearArray(), array('class' => 'emp_duration'), array('options' => array($stay_in_year => array('selected' => 'selected')))); ?><?php echo $form->dropDownList($Submission_model, 'employment_in_month', $Submission_model->getEmpInMonthArray(), array('class' => 'emp_duration'), array('options' => array($stay_in_month => array('selected' => 'selected')))); ?></span></div>
						<div class="test-auto-lender-group"><label for="loan_amount">Request Your Loan Amount</label><select id="loan_amount" name="loan_amount" class="inputClass t3InputText required"><?php foreach (array('' => 'Select', '100' => '$100', '200' => '$200', '300' => '$300', '400' => '$400', '500' => '$500', '600' => '$600', '700' => '$700', '800' => '$800', '900' => '$900', '1000' => '$1,000') as $v => $l) { ?><option value="<?php echo $v; ?>"<?php echo $v === '400' ? ' selected="selected"' : ''; ?>><?php echo $l; ?></option><?php } ?></select></div>
						<div class="test-auto-lender-group"><label>Year</label><?php echo $form->dropDownList($Submission_model, 'car_year', array('' => '--Select Year--'), array('class' => 'inputClass', 'options' => array($car_year => array('selected' => true)))); ?></div>
						<div class="test-auto-lender-group"><label>Make</label><?php echo $form->dropDownList($Submission_model, 'car_make', array('' => '--Select Make--'), array('class' => 'inputClass', 'options' => array($car_make => array('selected' => 'selected')))); ?></div>
						<div class="test-auto-lender-group"><label>Model</label><?php echo $form->dropDownList($Submission_model, 'car_model', array('' => '--Select Model--'), array('class' => 'inputClass', 'options' => array($car_model => array('selected' => 'selected')))); ?></div>
						<div class="test-auto-lender-group"><label>Trim</label><?php echo $form->dropDownList($Submission_model, 'car_trim', array('' => '--Select Trim--'), array('class' => 'inputClass', 'options' => array($car_trim => array('selected' => 'selected')))); ?></div>
					</div>
				</div>
				<div class="test-auto-lender-actions">
					<?php echo CHtml::submitButton('Run Test', array('class' => 'btn btn-primary', 'name' => 'testformsubmit')); ?>
				</div>
			</div>
			<?php $this->endWidget(); ?>
			<?php $this->endWidget(); ?>
		</div>
	</div>

	<div class="leads-table-wrap">
		<table id="posts" class="table table-striped table-hover test-auto-lender-results">
<thead>
	<tr><th colspan="4" class="test-auto-lender-count"><?php echo count($posts); ?> record(s)</th></tr>
    <tr>
    <th>Date</th>
    <th>Affiliate (Code)</th>
	<th>Affiliate Transaction</th>
	<th>Lender Transaction</th>
	</tr>
</thead>
<tbody>

<?php
//echo '<pre>';print_r($posts);echo '</pre>';
//$dataProvider = new CArrayDataProvider($posts);
//echo '<pre>';print_r($dataProvider);echo '</pre>';
?>

<?php $i=1; foreach ($posts as $aff_trans) {?>
	<tr class="post">
	<!-- <td><?php //echo $i; ?></td> -->
	<td><?php echo $aff_trans['date']; ?></td>   
	<td><?php
		$model = AffiliateUser::model()->findByPk($aff_trans['promo_code']);
		$name = $model ? CHtml::encode($model->user_name) : '—';
		$code = CHtml::encode($aff_trans['promo_code']);
		?><span class="txn-affiliate-name"><?php echo $name; ?></span> <span class="txn-promo-code">(<?php echo $code; ?>)</span></td>
	<td>
		<div class="txn-block txn-block--affiliate">
			<?php
			$s = isset($aff_trans['ping_status']) ? $aff_trans['ping_status'] : '';
			$p_cls = $s=='1' ? 'leads-status--accepted' : ($s=='0' ? 'leads-status--rejected' : 'leads-status--error');
			$p_lbl = $s=='1' ? ACCEPTED : ($s=='0' ? REJECTED : ($s=='-1' ? ERROR : '—'));
			$s2 = isset($aff_trans['post_status']) ? $aff_trans['post_status'] : '';
			$po_cls = $s2=='1' ? 'leads-status--accepted' : ($s2=='0' ? 'leads-status--rejected' : 'leads-status--error');
			$po_lbl = $s2=='1' ? ACCEPTED : ($s2=='0' ? REJECTED : ($s2=='-1' ? ERROR : '—'));
			?>
			<div class="txn-status-row">
				<span class="txn-status-item"><strong>Ping</strong> <span class="leads-status <?php echo $p_cls; ?>"><?php echo CHtml::encode($p_lbl); ?></span></span>
				<span class="txn-status-item"><strong>Post</strong> <span class="leads-status <?php echo $po_cls; ?>"><?php echo CHtml::encode($po_lbl); ?></span></span>
			</div>
			<?php if ($aff_trans['ping_request']) { ?>
			<details class="txn-detail">
				<summary>Ping Request</summary>
				<div class="txn-payload txn-payload--code"><?php echo htmlspecialchars(urldecode($aff_trans['ping_request']), ENT_QUOTES, 'UTF-8'); ?></div>
			</details>
			<?php } ?>
			<?php if ($aff_trans['ping_response']) { ?>
			<details class="txn-detail">
				<summary>Ping Response</summary>
				<div class="txn-payload txn-payload--code"><?php echo htmlspecialchars($aff_trans['ping_response'], ENT_QUOTES, 'UTF-8'); ?></div>
			</details>
			<?php } ?>
			<?php if ($aff_trans['post_request']) { ?>
			<details class="txn-detail">
				<summary>Post Request</summary>
				<div class="txn-payload txn-payload--code"><?php echo htmlspecialchars(urldecode($aff_trans['post_request']), ENT_QUOTES, 'UTF-8'); ?></div>
			</details>
			<?php } ?>
			<?php if ($aff_trans['post_response']) { ?>
			<details class="txn-detail">
				<summary>Post Response</summary>
				<div class="txn-payload txn-payload--code"><?php echo htmlspecialchars($aff_trans['post_response'], ENT_QUOTES, 'UTF-8'); ?></div>
			</details>
			<?php } ?>
		</div>
	</td>
	<td>
		<div class="txn-lenders">
		<?php foreach ($aff_trans->lender_trnas as $len_trans) {
			$ls = isset($len_trans['ping_status']) ? $len_trans['ping_status'] : '';
			$lp_cls = $ls=='1' ? 'leads-status--accepted' : ($ls=='0' ? 'leads-status--rejected' : 'leads-status--error');
			$lp_lbl = $ls=='1' ? ACCEPTED : ($ls=='0' ? REJECTED : ($ls=='-1' ? ERROR : '—'));
			$ls2 = isset($len_trans['post_status']) ? $len_trans['post_status'] : '';
			$lpo_cls = $ls2=='1' ? 'leads-status--accepted' : ($ls2=='0' ? 'leads-status--rejected' : 'leads-status--error');
			$lpo_lbl = $ls2=='1' ? ACCEPTED : ($ls2=='0' ? REJECTED : ($ls2=='-1' ? ERROR : '—'));
		?>
			<div class="txn-lender-card">
				<div class="txn-lender-header">
					<div class="txn-lender-header-main">
						<span class="txn-lender-name"><?php echo CHtml::encode($len_trans['lender_name']); ?></span>
						<span class="txn-lender-badges">
							<span class="txn-status-item"><strong>Ping</strong> <span class="leads-status <?php echo $lp_cls; ?>"><?php echo CHtml::encode($lp_lbl); ?></span></span>
							<span class="txn-status-item"><strong>Post</strong> <span class="leads-status <?php echo $lpo_cls; ?>"><?php echo CHtml::encode($lpo_lbl); ?></span></span>
						</span>
					</div>
					<span class="txn-lender-price"><?php echo '$' . CHtml::encode($len_trans['ping_price']); ?></span>
				</div>
				<div class="txn-lender-details">
					<?php if (!empty($len_trans['ping_request'])) { ?>
					<details class="txn-detail">
						<summary>Ping Data</summary>
						<div class="txn-payload txn-payload--code"><?php echo htmlspecialchars($len_trans['ping_request'], ENT_QUOTES, 'UTF-8'); ?></div>
					</details>
					<?php } ?>
					<?php if (!empty($len_trans['ping_response'])) { ?>
					<details class="txn-detail">
						<summary>Ping Response</summary>
						<div class="txn-payload txn-payload--code"><?php echo htmlspecialchars($len_trans['ping_response'], ENT_QUOTES, 'UTF-8'); ?></div>
					</details>
					<?php } ?>
					<?php if (!empty($len_trans['post_request'])) { ?>
					<details class="txn-detail">
						<summary>Post Data</summary>
						<div class="txn-payload txn-payload--code"><?php echo htmlspecialchars(urldecode($len_trans['post_request']), ENT_QUOTES, 'UTF-8'); ?></div>
					</details>
					<?php } ?>
					<?php if (!empty($len_trans['post_response'])) { ?>
					<details class="txn-detail">
						<summary>Post Response</summary>
						<div class="txn-payload txn-payload--code"><?php echo htmlspecialchars($len_trans['post_response'], ENT_QUOTES, 'UTF-8'); ?></div>
					</details>
					<?php } ?>
					<?php if (!empty($len_trans['exit_url'])) { ?>
					<details class="txn-detail">
						<summary>Exit URL</summary>
						<div class="txn-payload txn-payload--code"><?php echo htmlspecialchars($len_trans['exit_url'], ENT_QUOTES, 'UTF-8'); ?></div>
					</details>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
		</div>
	</td>
	</tr>
<?php $i++; } ?>
</tbody>
</table>
		<?php if ($pages->pageCount > 1): ?>
		<div class="pager">
			<?php $this->widget('CLinkPager', array('pages' => $pages)); ?>
		</div>
		<?php endif; ?>
	</div>
</section>

<?php /*
<div class="row-fluid">
	<div class="span12">
		<table id="posts" class="table table-striped table-hover table-bordered table-condensed">
			<thead>
				<tr>
					<th>Date</th>
					<th>Affiliate name</th>
					<th>Affiliate Transaction</th>
					<th>Lender Transaction</th>
				</tr>
			</thead>
			<tbody>
				<?php $connection=Yii::app()->dbMortgage; foreach ($posts as $row) { ?>
				<tr class="post">
					<td>
						<?php echo $row['date']; ?>
					</td>
					<td>
						<?php $model=AffiliateUser::model()->findByPk($row['promo_code']!=471 ? $row['promo_code'] : 1); echo isset($model->user_name)?$model->user_name : 'Inactive campagin'; ?>
					</td>
					<td>
						<p><b>Request :-</b></p>
						<p class="comment more" style="word-wrap: break-word; width: 400px">
							<?php echo urldecode($row[ 'post_request']); ?>
						</p>
						<p><b>Full Response :-</b></p>
						<p style="word-wrap: break-word; width: 400px">
							<?php echo htmlentities($row[ 'post_response']); ?>
						</p>
						<p><b>Response :-</b></p>
						<p style="word-wrap: break-word; width: 400px">
							<?php if(htmlentities($row[ 'post_response'])=='1' ){echo ACCEPTED;}elseif(htmlentities($row[ 'post_response'])=='0' ){echo REJECTED;}elseif(htmlentities($row[ 'post_response'])=='-1' ){echo ERROR;} ?>
						</p>
					</td>
					<td>
						<?php $command=$connection->createCommand('SELECT * FROM mortgage_lender_transactions WHERE affiliate_transactions_id ='.$row['id']); $res = $command->queryAll(); foreach ($res as $row) { ?>
						<table class="table table-striped table-hover table-bordered table-condensed">
							<tr>
								<td>
									<?php echo $row[ 'name']; ?>
								</td>
								<td>
									<?php if($row[ 'ping_request']){?>
									<p><b>Ping Data :-</b></p>
									<p style="word-wrap: break-word; width: 400px">
										<?php echo urldecode($row[ 'ping_request']); ?>
									</p>
									<?php }?>
									<?php if($row[ 'ping_response']){?>
									<p><b>Ping Response :-</b></p>
									<p style="word-wrap: break-word; width: 400px">
										<?php echo htmlentities($row[ 'ping_response']); ?>
									</p>
									<?php }?>
									<?php if(isset($row[ 'ping_status'])){?>
									<p><b>Ping Status :-</b></p>
									<p style="word-wrap: break-word; width: 400px">
										<?php if(htmlentities($row[ 'ping_status'])=='1' ){echo ACCEPTED;}elseif(htmlentities($row[ 'ping_status'])=='0' ){echo REJECTED;}elseif(htmlentities($row[ 'ping_status'])=='-1' ){echo ERROR;} ?>
									</p>
									<?php }?>
									<?php if($row[ 'post_request']){?>
									<p><b>Post Data :-</b></p>
									<p class="comment more" style="word-wrap: break-word; width: 400px">
										<?php echo urldecode($row[ 'post_request']); ?>
									</p>
									<?php }?>
									<?php if($row[ 'post_response']){?>
									<p><b>Post Response :-</b></p>
									<p style="word-wrap: break-word; width: 400px">
										<?php echo htmlentities($row[ 'post_response']); ?>
									</p>
									<?php }?>
									<?php if((isset($row[ 'post_status'])) && ($row[ 'post_request']!='' )){?>
									<p><b>Post Status :-</b></p>
									<p style="word-wrap: break-word; width: 400px">
										<?php if(htmlentities($row[ 'post_status'])=='1' ){echo ACCEPTED;}elseif(htmlentities($row[ 'post_status'])=='0' ){echo REJECTED;}elseif(htmlentities($row[ 'post_status'])=='-1' ){echo ERROR;} ?>
									</p>
									<?php }?>
								</td>
								<td>
									<p><b>Price</b></p>
									<?php //echo '$'.$row[ 'lead_price']; ?>
									<?php //echo sprintf( '%03d', $row[ 'time']); ?>
								</td>
							</tr>
						</table>
						<?php } ?>
					</td>
				</tr>
				<?php } ?>

			</tbody>
		</table>
		<a href="#top" style="float: right">top</a>
	</div>
</div>
*/
?>





<style>
.morecontent span {display: none;}
.comment {width: 400px;}
select.date {width: 19.5%;}
select.address_length {width: 29.5%;}
select.emp_duration {width: 29.5%;}
.testcash_lender_label{color: maroon;font-size: 12px;}
</style>
<script>
	$(document).ready(function() {
		var showChar = 120;
		var ellipsestext = "...";
		var moretext = "more";
		var lesstext = "less";
		$('.more').each(function() {
			var content = $(this).html();
			if (content.length > showChar) {
				var c = content.substr(0, showChar);
				var h = content.substr(showChar - 1, content.length - showChar);
				var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
				$(this).html(html);
			}
		});
		$(".morelink").click(function() {
			if ($(this).hasClass("less")) {
				$(this).removeClass("less");
				$(this).html(moretext);
			} else {
				$(this).addClass("less");
				$(this).html(lesstext);
			}
			$(this).parent().prev().toggle();
			$(this).prev().toggle();
			return false;
		});
		if ($('#Submissions_ssn').length > 0) {
			$('#Submissions_ssn').mask("999-99-9999");
		}
		if ($('#Submissions_work_phone').length > 0) {
			$('#Submissions_work_phone').mask("999-999-9999");
		}
		$('.trigger').click(function() {
			if ($(this).attr('id') == 'new_car') {
				$(this).addClass("active");
				$("#used_car").removeClass("active");
				$('#Submissions_new_car').val("1");
				$("#cardata").show();
			} else {
				$(this).addClass("active");
				$("#Submissions_car_make").parent().removeClass("error");
				$("#new_car").removeClass("active");
				$('#Submissions_new_car').val("0");
				$("#cardata").hide();
			}
		});

		make_model_trim('<?php echo Yii::app()->createUrl('ajax'); ?>/?fetch=year', $("#Submissions_car_year"));

		$("#Submissions_car_year").change(function() {
			if ($("#Submissions_car_year").val() == '') return false;
			make_model_trim('<?php echo Yii::app()->createUrl('ajax'); ?>/?fetch=make&year=' + escape($("#Submissions_car_year").val()) + '', $("#Submissions_car_make"));
		});
		$("#Submissions_car_make").change(function() {
			if ($("#Submissions_car_make").val() == '') return false;
			make_model_trim('<?php echo Yii::app()->createUrl('ajax'); ?>/?fetch=model&make=' + escape($("#Submissions_car_make").val()) + '&year=' + $("#Submissions_car_year").val(), $("#Submissions_car_model"));
		});
		$("#Submissions_car_model").change(function() {
			if ($("#Submissions_car_model").val() == '') return false;
			make_model_trim('<?php echo Yii::app()->createUrl('ajax'); ?>?fetch=trim&model=' + escape($("#Submissions_car_model").val()) + '&make=' + escape($("#Submissions_car_make").val()) + '&year=' + $("#Submissions_car_year").val(), $("#Submissions_car_trim"));
		});

		/* Test parameters: hidden by default in CSS (no flicker); JS toggles .test-params--expanded */
		(function() {
			var card = document.querySelector('.mortgage-portal .test-auto-lender-card .portlet');
			if (!card) return;
			var content = card.querySelector('.portlet-content');
			var header = card.querySelector('.portlet-decoration');
			if (!content || !header) return;
			var id = 'test-params-content-' + Math.random().toString(36).substr(2, 9);
			content.id = id;
			header.setAttribute('role', 'button');
			header.setAttribute('tabindex', '0');
			header.setAttribute('aria-expanded', 'false');
			header.setAttribute('aria-controls', id);
			header.setAttribute('aria-label', 'Test parameters. Click to expand or collapse.');
			function toggle() {
				var expanded = card.classList.toggle('test-params--expanded');
				header.setAttribute('aria-expanded', expanded ? 'true' : 'false');
				header.setAttribute('aria-label', expanded ? 'Test parameters. Click to collapse.' : 'Test parameters. Click to expand or collapse.');
			}
			header.addEventListener('click', function(e) {
				e.preventDefault();
				toggle();
			});
			header.addEventListener('keydown', function(e) {
				if (e.key === 'Enter' || e.key === ' ') {
					e.preventDefault();
					toggle();
				}
			});
		})();

		function make_model_trim(url, ele) {
			$.ajax({
				url: url,
				dataType: 'json',
				beforeSend: function() {
					ele.addClass("loading");
				},
				success: function(data) {
					$('option', ele).remove();
					ele.append('<option value="">Select</option>');
					$.each(data, function(val, text) {
						ele.append('<option value="' + val + '">' + text + '</option>');
					});
					ele.removeClass("loading");
				}
			});
		}
		/* Commented because zip,city and state get from included file*/
		/*
		$("#zip").blur(function() {
		    zip = $("#zip");
		    if (zip.val() == '') return false;
		    var respo = $.ajax({
		        url: "check_zip.php",
		        url: "<?php echo  Yii::app()->createUrl('ajax'); ?>/?fetch=city_state",
		        type: 'POST',
		        datatype: 'json',
		        async: false,
		        data: "Submissions_zip=" + zip.val()
		    }).responseText;
		    var data = jQuery.parseJSON(respo);
		    $("#Submissions_city").val(data.city);
		    $("#Submissions_state").val(data.state);
		    if (data.city) {
		        return true;
		    } else {
		        zip.removeClass('valid').addClass('errorloan');
		        return false;
		    }
		});
		*/
	});
</script>
