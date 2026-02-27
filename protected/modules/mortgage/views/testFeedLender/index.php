<?php
include_once 'names.php';
include_once 'zipcode_city_state.php';
$firstname = $firstnames[array_rand($firstnames)];
$lastname = $lastnames[array_rand($lastnames)];
$homephoneNumber = '202201'.rand(1111,9999);
$email = 'jen@elitemate.com';
$zip = array_rand($zipcode);
$city = $zipcode[$zip]['city'];
$state = $zipcode[$zip]['state'];
?>
<section class="test-feed-lender-page mortgage-dashboard-section" id="top">
	<header class="affiliates-page-header">
		<div class="affiliates-page-header-inner">
			<h1 class="affiliates-page-title">Test Feed Lender</h1>
			<p class="affiliates-page-subtitle">Run a test submission against a feed lender and view request/response.</p>
		</div>
	</header>

	<div class="affiliates-page-card portlet portlet--filters-collapsible">
		<div class="portlet-decoration">
			<span class="portlet-title">Filters</span>
		</div>
		<div class="portlet-content">
		<?php
		$form = $this->beginWidget('CActiveForm', array(
			'id' => 'testfeedlender',
			'enableAjaxValidation' => true,
			'clientOptions' => array(
				'validateOnSubmit' => true,
				'validateOnChange' => true,
			),
		));
		echo $form->hiddenField($Submission_model, 'city', array('value' => ($city ? $city : 'NEWTON FALLS')));
		echo $form->hiddenField($Submission_model, 'state', array('value' => ($state ? $state : 'OH')));
		$Submission_model->dob_month = 4;
		$Submission_model->dob_day   = 7;
		$Submission_model->dob_year  = 1982;
		?>
			<div class="row-fluid test-feed-lender-form">
				<div class="span4">
					<div class="form-group">
						<label for="feed-lender">Feed Lender</label>
						<?php echo $form->dropDownList($FeedLenders_model, 'feed_lender_name', $feed_lender_name, array('id' => 'feed-lender', 'class' => 'form-control')); ?>
					</div>
					<div class="form-group">
						<label for="first_name">First Name</label>
						<input type="text" class="form-control required" maxlength="128" value="<?php echo CHtml::encode(trim($firstname)); ?>" id="first_name" name="first_name">
					</div>
					<div class="form-group">
						<label for="last_name">Last Name</label>
						<input type="text" class="form-control required" maxlength="128" value="<?php echo CHtml::encode(trim($lastname)); ?>" id="last_name" name="last_name">
					</div>
				</div>
				<div class="span4">
					<div class="form-group">
						<label for="email">Email</label>
						<input type="text" class="form-control required email" maxlength="255" value="<?php echo CHtml::encode(trim($email)); ?>" id="email" name="email">
					</div>
					<div class="form-group">
						<label for="phone">Primary Phone</label>
						<input type="text" class="form-control required" value="<?php echo CHtml::encode(trim($homephoneNumber)); ?>" name="phone" id="phone">
					</div>
					<div class="form-group">
						<label for="zip">Zip Code</label>
						<input type="text" class="form-control required" maxlength="5" value="<?php echo CHtml::encode(trim($zip)); ?>" id="zip" name="zip">
					</div>
				</div>
				<div class="span4">
					<div class="form-group">
						<label for="address">Address</label>
						<input type="text" class="form-control" maxlength="100" value="Macrae Road" id="address" name="address">
					</div>
					<div class="form-group">
						<label for="gender">Gender</label>
						<select name="gender" id="gender" class="form-control required">
							<option value="M">Male</option>
							<option value="F">Female</option>
						</select>
					</div>
					<div class="form-group">
						<label>Date of Birth</label>
						<div class="dob-fields">
							<?php echo $form->dropDownList($Submission_model, 'dob_month', $Submission_model->getMonthsArray(), array('class' => 'date form-control')); ?>
							<?php echo $form->dropDownList($Submission_model, 'dob_day', $Submission_model->getDaysArray(), array('class' => 'date form-control')); ?>
							<?php echo $form->dropDownList($Submission_model, 'dob_year', $Submission_model->getYearsArray(), array('class' => 'date form-control')); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="form-actions">
				<?php echo CHtml::submitButton('Run Test', array('class' => 'btn btn-primary', 'name' => 'testformsubmit')); ?>
			</div>
		<?php $this->endWidget(); ?>
		</div>
	</div>


	<div class="affiliates-page-card portlet">
		<div class="portlet-decoration">
			<span class="portlet-title">Results</span>
		</div>
		<div class="portlet-content">
			<div class="dashboard-table-wrap">
				<table id="posts" class="table table-striped table-hover table-bordered table-condensed">
					<thead>
						<tr>
							<th>Date</th>
							<th>Lender name</th>
							<th>Lender Transaction</th>
						</tr>
					</thead>
					<tbody>
						<?php $connection = Yii::app()->dbMortgage; foreach ($posts as $row): ?>
						<tr class="post">
							<td><?php echo CHtml::encode($row['date']); ?></td>
							<td><?php echo CHtml::encode($row['feed_lender_name']); ?></td>
							<td>
								<p><strong>Request</strong></p>
								<p class="comment more test-feed-word-wrap"><?php echo CHtml::encode($row['request']); ?></p>
								<p><strong>Full Response</strong></p>
								<p class="comment more test-feed-word-wrap"><?php echo CHtml::encode($row['full_response']); ?></p>
								<p><strong>Response</strong></p>
								<p class="test-feed-word-wrap"><?php
									if (isset($row['response'])) {
										if ($row['response'] == '1') echo defined('ACCEPTED') ? ACCEPTED : 'ACCEPTED';
										elseif ($row['response'] == '0') echo defined('REJECTED') ? REJECTED : 'REJECTED';
										elseif ($row['response'] == '-1') echo defined('ERROR') ? ERROR : 'ERROR';
									}
								?></p>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
			<p class="text-right"><a href="#top" class="btn btn-default btn-sm">Back to top</a></p>
		</div>
	</div>
</section>
<?php
$this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
	'contentSelector' => '#posts',
	'itemSelector' => 'tr.post',
	'loadingText' => 'Loading...',
	'donetext' => 'No more records',
	'pages' => $pages,
));
?>
<style>
.test-feed-lender-page .morecontent span { display: none; }
.test-feed-lender-page .comment { max-width: 100%; }
.test-feed-word-wrap { word-wrap: break-word; }
.test-feed-lender-page .form-group { margin-bottom: 1rem; }
.test-feed-lender-page .form-group label { display: block; margin-bottom: 0.25rem; font-weight: 600; }
.test-feed-lender-page .dob-fields .date { display: inline-block; width: 30%; margin-right: 2%; }
.test-feed-lender-page .form-actions { margin-top: 1rem; padding-top: 1rem; border-top: 1px solid var(--portal-border, #e2e8f0); }
</style>
<script>
    $(document).ready(function(){
        var showChar = 320;
        var ellipsestext = "...";
        var moretext = "more";
        var lesstext = "less";
        $('.more').each(function(){
            var content = $(this).html();
            if(content.length > showChar){
                var c = content.substr(0, showChar);
                var h = content.substr(showChar - 1, content.length - showChar);
                var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
                $(this).html(html);
            }
        });
        $(".morelink").click(function(){
            if($(this).hasClass("less")){
                $(this).removeClass("less");
                $(this).html(moretext);
            }else{
                $(this).addClass("less");
                $(this).html(lesstext);
            }
            $(this).parent().prev().toggle();
            $(this).prev().toggle();
            return false;
        });
    });
</script>
