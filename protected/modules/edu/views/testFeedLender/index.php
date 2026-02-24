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
<h4>Test Feed Lender</h4>
<div class="row">
    <div class="col-sm-12" id="top">
        <?php
		$this->beginWidget('zii.widgets.CPortlet', array(
		    'title' => 'Search'
		));
		$form = $this->beginWidget('CActiveForm', array(
		    'id' => 'testfeedlender',
		    'enableAjaxValidation' => true,
		    'clientOptions' => array(
		        'validateOnSubmit' => true,
		        'validateOnChange' => true
		    )
		));
		echo $form->hiddenField($Submission_model, 'city', array(
		    'value' => ($city ? $city : 'NEWTON FALLS')
		));
		echo $form->hiddenField($Submission_model, 'state', array(
		    'value' => ($state ? $state : 'OH')
		));
		$Submission_model->dob_month           = 4;
		$Submission_model->dob_day             = 7;
		$Submission_model->dob_year            = 1982;
		?>
        <div class="row">
            <div class="col-sm-4">
                <div class="widget-box">
                    <div class="widget-body">
                        <div class="widget-main">
                            <div class="form-group">
                            	<label for="form-field-8">Feed Vendor</label>
                                <?php //echo $form->dropDownList($FeedLenders_model,'feed_lender_name',$feed_lender_name,array()); ?>
								<select name="vendor_id" class="form-control">
										<!--<option value="0">--Select--</option>-->
									<?php foreach($feed_vendors as $feed_vendor){
										?>
											<option value="<?php echo $feed_vendor['id']; ?>"><?php echo $feed_vendor['username']; ?></option>
										<?php
									}?>
								</select>
                            </div>
                              <div class="form-group">
                            	<label for="form-field-8">First Name</label>
                            	<input type="text" class="t3InputText required form-control" maxlength="128" value="<?php echo trim($firstname); ?>" id="first_name" name="first_name">
                            </div>
                              <div class="form-group">
                            	<label for="form-field-9">Last Name</label>
                            	<input type="text" class="t3InputText required form-control" maxlength="128" value="<?php echo trim($lastname);?>" id="last_name" name="last_name">
                            </div>
                            </div>
                            
                        </div>
                    </div>
             
            </div>
            <!--/span-->

            <div class="col-sm-4">
                <div class="widget-box">
                    <div class="widget-body">
                        <div class="widget-main">
                           
                             <div class="form-group">
                                <label for="form-field-9">Email</label>
                                <input type="text" class="t3InputText required email form-control" maxlength="255" value="<?php echo trim($email);?>" id="email" name="email">
                            </div>
                              <div class="form-group">
                                <label for="form-field-9">Primary Phone</label>
                                <input type="text" value="<?php echo trim($homephoneNumber); ?>" class="t3InputText required form-control" name="phone" id="phone">
                            </div>
                              <div class="form-group">
                                <label for="form-field-9">Zip Code</label>
                                <input type="text" class="t3InputText required form-control" maxlength="5" value="<?php echo trim($zip);?>" id="zip" name="zip">
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="col-sm-4">
                <div class="widget-box">
                    <div class="widget-body">
                        <div class="widget-main">
                             <div class="form-group">
                            	
                                <label for="form-field-9">Address</label>
                                <input type="text" class="t3InputText required form-control" maxlength="100" value="Macrae Road" id="address" name="address">
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
                                <?php echo $form->dropDownList($Submission_model,'dob_day', $Submission_model->getDaysArray(),array('class'=>'date  form-control'),array('options' => array($dob_day=>array('selected'=>'selected')))); ?>
                                      </div>
                                      <div class="col-sm-4">
                                <?php echo $form->dropDownList($Submission_model,'dob_year', $Submission_model->getYearsArray(),array('class'=>'date form-control'),array('options' => array($dob_year=>array('selected'=>'selected')))); ?>
                                      </div>
                                  </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <!--/span-->
        </div>
        <div class="row">
            <div class="col-sm-12">
            <?php echo CHtml::submitButton( 'Run Test',array( 'class'=>'btn btn btn-primary','name'=>'testformsubmit')); ?>
        </div>
        </div>
        <div style="clear: both;"></div>
		<?php $this->endWidget(); ?>
		<?php $this->endWidget(); ?>
    </div>
</div>


<div class="row">
    <div class="col-sm-12">
        <div class="table-responsive">
        <table id="posts" class="table table-striped table-hover table-bordered table-condensed">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Lender name</th>
                    <th>Lender Transaction</th>
                </tr>
            </thead>
            <tbody>
            <?php //echo '<pre>';print_r($posts);echo '</pre>';exit;?>
                <?php foreach ($posts as $row){ ?>
                <tr class="post">
                    <td>
                        <?php echo $row[ 'date']; ?>
                    </td>
                    <td>
                        <?php echo htmlentities($row['feed_lender_name']); ?>
                    </td>
                    <td>
                        <p><b>Request :-</b></p>
                        <p class="comment more" style="word-wrap:break-word;">
                        <?php echo htmlentities($row['request']); ?>
                        </p>
                        
                        <p><b>Full Response :-</b></p>
                        <p class="comment more" style="word-wrap:break-word;">
                        <?php echo htmlentities($row['full_response']); ?>
                        </p>
                        
                        <p><b>Response :-</b></p>
                        <p style="word-wrap:break-word;">
                        <?php if(htmlentities($row['response'])=='1'){echo ACCEPTED;}elseif(htmlentities($row['response'])=='0'){echo REJECTED;}elseif(htmlentities($row['response'])=='-1'){echo ERROR;} ?>
                        </p>
                    </td>
                </tr>
                <?php } ?>

            </tbody>
        </table>
        </div>
        <div class="form-group">
        <a href="#top" style="float:right" class="btn btn-primary">top</a>
      

<?php
$this->widget('ext.yiinfinite-scroll.YiinfiniteScroller', array(
    'contentSelector' => '#posts',
    'itemSelector' => 'tr.post',
    'loadingText' => 'Loading...',
    'donetext' => 'No more records',
    'pages' => $pages
));
?>
              </div>
            </div>
</div>
<style>
.morecontent span {display: none;}
.comment {width: 900px;}
select.address_length {width: 29.5%;}
select.emp_duration {width: 29.5%;}
      @media screen and (max-width: 767px){
        .table-responsive>.table>tbody>tr>td .comment{
            width:100%;
        }
    }
</style>
<script>
    $(document).ready(function(){
        $('.infinite_navigation').css('float','left');
        $('.infinite_navigation').css('margin-bottom','20px');
        $('.infinite_navigation a').addClass('btn btn-primary');
        var showChar = 120;
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
