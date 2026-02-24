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
<h4>Test Edu Lenders</h4>
<div class="row">
	<div class="col-sm-12" id="top">
		<?php
		$this->beginWidget('zii.widgets.CPortlet', array(
		    'title' => 'Search'
		));
		$form = $this->beginWidget('CActiveForm', array(
		    'id' => 'testcashlender',
		    'enableAjaxValidation' => true,
		    'clientOptions' => array(
		        'validateOnSubmit' => true,
		        'validateOnChange' => true
		    )
		));
		echo $form->hiddenField($Submission_model, 'lead_mode', array(
		    'value' => ($lead_mode ? $lead_mode : '0')
		));
		echo $form->hiddenField($Submission_model, 'sub_id', array(
		    'value' => ($sub_id ? $sub_id : '')
		));
		echo $form->hiddenField($Submission_model, 'city', array(
		    'value' => ($city ? $city : 'NEWTON FALLS')
		));
		echo $form->hiddenField($Submission_model, 'state', array(
		    'value' => ($state ? $state : 'OH')
		));
		$Submission_model->dob_month = 4;
		$Submission_model->dob_day = 7;
		$Submission_model->dob_year = 1982;
		/*$Submission_model->stay_in_year = 2;
		$Submission_model->stay_in_month = 5;
		$Submission_model->employment_in_year = 4;
		$Submission_model->employment_in_month = 8;
		$Submission_model->home_pay = 1500;*/
		?>
		<div class="row">
			<div class="col-sm-4">
				<div class="widget-box">
					<div class="widget-header"></div>
					<div class="widget-body">
						<div class="widget-main">
							<div class="form-group">
								<label for="form-field-8">Affiliate</label>
								<?php echo $form->dropDownList($AffiliateUser_model,'id',CHtml::listData(AffiliateUser::model()->findAll(),'id','id'),array('class'=>'form-control'),array('--Select-')); ?>
							</div>
							<div class="form-group">
								<label for="form-field-8">Lender <span class="testcash_lender_label">(Only Test Mode Status Lenders)</span></label>
								<?php echo $form->dropDownList($LenderDetails_model, 'name', CHtml::listData(LenderDetails::model()->findAll(array("condition"=>"status = 0")), 'id', 'name'),array('class'=>'form-control')); ?>
							</div>
							<div class="form-group">
								<label for="form-field-8">First Name</label>
								<input type="text" class="t3InputText required form-control" maxlength="128" value="<?php echo trim($firstname); ?>" id="first_name" name="first_name">
							</div>
							<div class="form-group">
								<label for="form-field-9">Last Name</label>
								<input type="text" class="t3InputText required form-control" maxlength="128" value="<?php echo trim($lastname);?>" id="last_name" name="last_name">
							</div>
							<div class="form-group">
								<label for="form-field-9">Gender</label>
								<select name="gender" class="required form-control">
									<option value='M'>Male</option>
									<option value='F'>Female</option>
								</select>
							</div>
							<div class="form-group">
								<label for="form-field-11">Date of Birth</label>
                                <div class="row">
                                    <div class="col-sm-4">
								<?php echo $form->dropDownList($Submission_model,'dob_month', $Submission_model->getMonthsArray(),array('class'=>'date form-control'),array('options' => array($dob_month=>array('selected'=>'selected')))); ?>
                                    </div>
                                    <div class="col-sm-4">
								<?php echo $form->dropDownList($Submission_model,'dob_day', $Submission_model->getDaysArray(),array('class'=>'date form-control '),array('options' => array($dob_day=>array('selected'=>'selected')))); ?>
                                    </div>
                                    <div class="col-sm-4">
								<?php echo $form->dropDownList($Submission_model,'dob_year', $Submission_model->getYearsArray(),array('class'=>'date form-control '),array('options' => array($dob_year=>array('selected'=>'selected')))); ?>
                                    </div>
                                </div>
							</div>
							<div class="form-group">
								<label for="form-field-9">Email</label>
								<input type="text" class="t3InputText required email form-control" maxlength="255" value="<?php echo trim($email);?>" id="email" name="email">
							</div>
							
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="widget-box">
					<div class="widget-header"></div>
					<div class="widget-body">
						<div class="widget-main">
                            <div class="form-group">
								<label for="form-field-9">Zip Code</label>
								<input type="text" class="t3InputText required form-control" maxlength="5" value="<?php echo trim($zip);?>" id="zip" name="zip">
							</div>

							<div class="form-group">
								<label for="form-field-9">Primary Phone</label>
								<input type="text" value="<?php echo trim($homephoneNumber); ?>" class="t3InputText required form-control" name="phone" id="phone">
							</div>
							<div class="form-group">
								<label for="form-field-9">SSN</label>
								<input type="text" value="<?php echo trim($ssn);?>" class="t3InputText required form-control" name="ssn" id="ssn">
							</div>
							<!--<div class="">
								<label for="form-field-9">Home Payment</label>
								<?php //echo $form->dropDownList($Submission_model,'home_pay',array(''=>'--Select Mortage / Rent---','150'=>'$100-200','300'=>'$200-400','500'=>'$400-600','700'=>'$601-800','900'=>'$801-1000','1100'=>'$1001-$1200','1350'=>'$1201-$1500','1500'=>'$1500+'),array('options' => array($home_pay=>array('selected'=>'selected')))); ?>
							</div>-->
							<div class="form-group">
								<label for="form-field-9">Cell</label>
								<input type="text" class="t3InputText form-control" value="<?php echo trim($mobile);?>" name="mobile" id="mobile">
							</div>
							<div class="form-group">
								<label for="form-field-9">Street Address</label>
								<input type="text" class="t3InputText required form-control" maxlength="100" value="Macrae Road" id="address" name="address">
							</div>
							<div class="form-group">
								<label for="form-field-9">Program Of Interest</label>
								<input type="text" name="program_of_interest" class="t3InputText required form-control" maxlength="100" value="Computer" id="program_of_interest">
							</div>
							<div class="form-group">
								<label for="form-field-9">Master Degree</label>
									<select name="master_degree" class="form-control">
										<option value="0" selected>No</option>
										<option value="1">Yes</option>
									</select>
							</div>
							
					
							<!--<div class="">
								<label for="form-field-9">Length at Address</label>
								<?php //echo $form->dropDownList($Submission_model,'stay_in_year', $Submission_model->getStayInYearArray(),array('class'=>'address_length'),array('options' => array($stay_in_year=>array('selected'=>'selected')))); ?>
								<?php //echo $form->dropDownList($Submission_model,'stay_in_month', $Submission_model->getStayInMonthArray(),array('class'=>'address_length'),array('options' => array($stay_in_month=>array('selected'=>'selected')))); ?>
							</div>-->
							<!--<div class="">
								<label for="form-field-9">Rent or Own?</label>
								<input type="radio" name="is_rented" value="rent" checked="checked">Rent
								<input type="radio" name="is_rented" value="own">Own
							</div>-->
							<!--<div class="">
								<label for="form-field-9">Income Type</label>
								<select id="income_type" name="income_type" class="t3InputText required">
									<option value="">Select</option>
									<option value="1" selected="selected">Employed Full Time</option>
									<option value="2">Employed Part Time</option>
									<option value="3">Employed Temporary</option>
									<option value="4">Self Employed</option>
									<option value="5">Retired</option>
									<option value="6">On Benefits</option>
									<option value="7">Unemployed</option>
								</select>
							</div>-->
							<!--<div class="">
								<label for="form-field-9">Monthly Net Income</label>
								<select id="monthly_income" name="monthly_income" class="t3InputText required">
									<option value="">Select</option>
									<option value="200">Less than 500</option>
									<option value="500">500 - 749</option>
									<option value="750">750 - 999</option>
									<option value="1000">1,000 - 1,125</option>
									<option value="1126">1,126 - 1,375</option>
									<option value="1376">1,376 - 1,625</option>
									<option value="1626">1,626 - 1,875</option>
									<option value="1876" selected="selected">1,876 - 2,125</option>
									<option value="2126">2,126 - 2,375</option>
									<option value="2376">2,376 - 2,625</option>
									<option value="2626">2,626 - 2,875</option>
									<option value="2876">2,876 - 3,125</option>
									<option value="3126">3,126 - 3,375</option>
									<option value="3376">3,376 - 3,625</option>
									<option value="3626">3,626 - 3,875</option>
									<option value="3876">3,876 - 4,125</option>
									<option value="4126">4,126 - 4,375</option>
									<option value="4376">4,376 - 4,625</option>
									<option value="4626">4,626 - 4,875</option>
									<option value="5000">More than 5,000</option>
								</select>
							</div>-->
						</div>
					</div>
				</div>
			</div>
			<div class="col-sm-4">
				<div class="widget-box">
					<div class="widget-header"></div>
					<div class="widget-body">
						<div class="widget-main">
                            <div class="form-group">
								<label for="form-field-9">Ged</label>
								<input type="number" min="01" max="99" class="t3InputText required form-control" maxlength="2" value="01" id="ged" name="ged">
							</div>
                            		<div class="form-group">
								<label for="form-field-9">Speak English</label>
									<select name="speak_english" class="form-control">
										<option value="0" selected>No</option>
										<option value="1">Yes</option>
									</select>
							</div>
							<div class="form-group">
								<label for="form-field-9">Campus</label>
								<input type="text" class="t3InputText required form-control" maxlength="100" value="EliteCash" id="campus" name="campus">
							</div>
							<!--<div class="">
								<label for="form-field-9">Employer Name</label>
								<input type="text" maxlength="128" class="t3InputText required" value="Datacentric" id="employer" name="employer">
							</div>-->
							<!--<div class="">
								<label for="form-field-9">Job Title</label>
								<input type="text" maxlength="128" class="t3InputText required" value="Chef" id="job_title" name="job_title">
							</div>-->
							<!--<div class="">
								<label for="form-field-9">Employment Duration</label>
								<?php //echo $form->dropDownList($Submission_model,'employment_in_year', $Submission_model->getEmpInYearArray(),array('class'=>'emp_duration'),array('options' => array($stay_in_year=>array('selected'=>'selected')))); ?>
								<?php //echo $form->dropDownList($Submission_model,'employment_in_month', $Submission_model->getEmpInMonthArray(),array('class'=>'emp_duration'),array('options' => array($stay_in_month=>array('selected'=>'selected')))); ?>
							</div>-->
							<!--<div class="">
								<label for="form-field-8">Request Your Loan Amount</label>
								<select id="loan_amount" name="loan_amount" class="t3InputText required">
									<option value="">Select</option>
									<option value="100">$100</option>
									<option value="200">$200</option>
									<option value="300">$300</option>
									<option value="400" selected="selected">$400</option>
									<option value="500">$500</option>
									<option value="600">$600</option>
									<option value="700">$700</option>
									<option value="800">$800</option>
									<option value="900">$900</option>
									<option value="1000">$1,000</option>
								</select>
							</div>-->
							<!--<div class="">
								<label for="form-field-9">Year</label>
								<?php //echo $form->dropDownList($Submission_model,'car_year',array(''=>'--Select Year--'),array('options' => array($car_year=>array('selected'=>true)))); ?>
							</div>-->
							<!--<div class="">
								<label for="form-field-9">Make</label>
								<?php //echo $form->dropDownList($Submission_model,'car_make',array(''=>'--Select Make--'),array('options' => array($car_make=>array('selected'=>'selected')))); ?>
							</div>-->
							<!--<div class="">
								<label for="form-field-9">Model</label>
								<?php //echo $form->dropDownList($Submission_model,'car_model',array(''=>'--Select Model--'),array('options' => array($car_model=>array('selected'=>'selected')))); ?>
							</div>-->
							<!--<div class="">
								<label for="form-field-9">Trim</label>
								<?php //echo $form->dropDownList($Submission_model,'car_trim',array(''=>'--Select Trim--'),array('options' => array($car_trim=>array('selected'=>'selected')))); ?>
							</div>-->
							<div class="form-group">
                                <label for="form-field-9">Ping Post Method</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="pingpost" value="ping" id="ping">Only Ping</label></div>
                                <div class="radio"><label>
                                    <input type="radio" name="pingpost" value="post" id="post">Only Post</label></div>
                                <div class="radio"><label>
                                    <input type="radio" name="pingpost" value="both" id="both" checked="checked">Both</label></div>
                            </div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div style="clear: both;"></div>
        <div class="row">
            <div class="col-sm-12">
		<?php echo CHtml::submitButton('Run Test',array('class'=>'btn btn btn-primary','name'=>'testformsubmit')); ?>
		<?php $this->endWidget(); ?>
		<?php $this->endWidget(); ?>
            </div>
        </div>
	</div>
</div>

<div class="row">
<div class="col-sm-12 table-responsive">
<!--
 ** author : vatsal gadhia
 ** description : Total transaction's way of display changed
 ** date : 02-08-2016
-->
<div class="summary">Total Transactions: <?php echo count($posts); ?></div>
<table id="posts" class="table table-striped table-hover table-bordered table-condensed">
<thead>
    <tr>
    <!-- <th>Sr#</th> -->
    <th>Date</th>
    <th>Affiliate(Code)</th>
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
	<td><?php $model = AffiliateUser::model()->findByPk($aff_trans['promo_code']); echo $model->user_name.' ('.$aff_trans['promo_code'].')'; ?></td>
	<td>
		<?php if($aff_trans['ping_request']){?>
		<p><b>Ping Request</b></p>
		<p class="comment more" style="word-wrap:break-word;width:400px"><?php echo urldecode($aff_trans['ping_request']);?></p>
		<?php }?>
		
		<?php if($aff_trans['ping_response']){?>
		<p><b>Ping Response</b></p>
		<p class="comment more" style="word-wrap:break-word;width:400px"><?php echo htmlentities($aff_trans['ping_response']); ?>	</p>
		<?php }?>
		
		<?php if($aff_trans['ping_request']){?>
		<p><b>Ping Status</b></p>
		<p class="comment more" style="word-wrap:break-word;width:400px"><?php if($aff_trans['ping_status']=='1'){echo ACCEPTED;}elseif($aff_trans['ping_status']=='0'){echo REJECTED;}elseif($aff_trans['ping_status']=='-1'){echo ERROR;} ?></p>
		<?php }?>
		
		<?php if($aff_trans['post_request']){?>
		<p><b>Post Request</b></p>
		<p class="comment more" style="word-wrap:break-word;width:400px"><?php echo urldecode($aff_trans['post_request']);?></p>
		<?php }?>
		
		<?php if($aff_trans['post_response']){?>
		<p><b>Post Response</b></p>
		<p class="comment more" style="word-wrap:break-word;width:400px"><?php echo htmlentities($aff_trans['post_response']); ?>	</p>
		<?php }?>
		
		<?php if($aff_trans['post_request']){?>
		<p><b>Post Status</b></p>
		<?php if($aff_trans['post_request']){ ?>
		<p class="comment more" style="word-wrap:break-word;width:400px"><?php if($aff_trans['post_status']=='1'){echo ACCEPTED;}elseif($aff_trans['post_status']=='0'){echo REJECTED;}elseif($aff_trans['post_status']=='-1'){echo ERROR;} ?></p>
		<?php }} ?>
	</td>
	<td>
	<?php foreach ($aff_trans->lender_trnas as $len_trans) { ?>
	<table class="table table-striped table-hover table-bordered table-condensed">
	<tr>
	<td><?php echo $len_trans['lender_name']; ?></td>
	<td>
		<?php if($len_trans['ping_request']){?>
		<p><b>Ping Data</b></p>
		<p class="comment more" style="word-wrap:break-word;width:400px">
		<?php echo $len_trans['ping_request']; ?>
		</p>
		<?php }?>
		
		<?php if($len_trans['ping_response']){?>
		<p><b>Ping Response</b></p>
		<p class="comment more" style="word-wrap:break-word;width:400px">
		<?php echo htmlentities($len_trans['ping_response']); ?>
		</p>
		<?php }?>
		
		<?php if($len_trans['ping_response']){?>
		<p><b>Ping Status</b></p>
		<p class="comment more" style="word-wrap:break-word;width:400px">
		<?php if($len_trans['ping_status']=='1'){echo ACCEPTED;}elseif($len_trans['ping_status']=='0'){echo REJECTED;}elseif($len_trans['ping_status']=='-1'){echo ERROR;} ?>
		</p>
		<?php }?>
		
		<?php if($len_trans['post_request']!=''){?>
		<p><b>Post Data</b></p>
		<p class="comment more" style="word-wrap:break-word;width:400px">
		<?php echo urldecode($len_trans['post_request']); ?>
		</p>
		<?php }?>
		
		<?php if($len_trans['post_response']!=''){?>
		<p><b>Post Response</b></p>
		<p class="comment more" style="word-wrap:break-word;width:400px"><?php echo htmlentities($len_trans['post_response']); ?>
		</p>
		<?php }?>
		
		<?php if(($len_trans['post_status']!='') && ($len_trans['post_request']!='')){?>
		<p><b>Post Status</b></p>
		<p class="comment more" style="word-wrap:break-word;width:400px">
		<?php if($len_trans['post_status']=='1'){echo ACCEPTED;}elseif($len_trans['post_status']=='0'){echo REJECTED;}elseif($len_trans['post_status']=='-1'){echo ERROR;} ?>
		</p>
		<?php }?>
		
		<?php if($len_trans['exit_url']){?>
			<p><b>Exit Url(Redirect URL)</b></p>
			<p class="comment more" style="word-wrap:break-word;width:400px">
			<?php echo htmlentities($len_trans['exit_url']); ?>
			</p>
		<?php } ?>
	</td>
	<td>
	<p><b>Price</b></p>
	<?php echo '$'.$len_trans['ping_price']; ?><br>
	<?php //echo 'Lead Processing Time='.sprintf('%03d', $len_trans['time']); ?>
	</td>
	</tr>
	</table>
	<?php } ?>
	</td>
	</tr>
<?php $i++; } ?>
</tbody>
</table>
</div>
</div>

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
				<?php $connection=Yii::app()->db; foreach ($posts as $row) { ?>
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
						<?php $command=$connection->createCommand('SELECT * FROM edu_lender_transactions WHERE affiliate_transactions_id ='.$row['id']); $res = $command->queryAll(); foreach ($res as $row) { ?>
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





<?php $this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array('contentSelector' => '#posts', 'itemSelector' => 'tr.post', 'loadingText' => 'Loading...', 'donetext' => 'No more records', 'pages' => $pages )); ?>
<style>
    .infinite_navigation{
      text-align:right;
        margin:0 10px 15px 15px;
    }
.morecontent span {display: none;}
.comment {width: 400px;}
/*select.date {width: 19.5%;}*/
select.address_length {width: 29.5%;}
select.emp_duration {width: 29.5%;}
.testcash_lender_label{color: maroon;font-size: 12px;}
.summary {font-size: 14px; margin: 0 0 5px 5px;font-weight: bold;}
	 @media screen and (max-width: 767px){
        .table-responsive>.table>tbody>tr>td .comment{
            width:100% !important;
        }
    }
</style>
<script>
	$(document).ready(function() {
        $(' .infinite_navigation a').addClass('btn').addClass('btn-primary');
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
		if ($('#ssn').length > 0) {
			$('#ssn').mask("999-99-9999");
		}
		if ($('#phone').length > 0) {
			$('#phone').mask("999-999-9999");
		}
		/*$('.trigger').click(function() {
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
		}*/
		/* Commented because zip,city and state get from included file*/
		/*
		$("#zip").blur(function() {
		    zip = $("#zip");
		    if (zip.val() == '') return false;
		    var respo = $.ajax({
		        url: "check_zip.php",
		        url: "<?php //echo  Yii::app()->createUrl('ajax'); ?>/?fetch=city_state",
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
