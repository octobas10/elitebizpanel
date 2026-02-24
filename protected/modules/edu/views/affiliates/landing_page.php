<?php
if((isset($_REQUEST['promo_code']) && !empty($_REQUEST['promo_code'])) || (isset($_SESSION['promo_code']) && !empty($_SESSION['promo_code']))) {
	if (!preg_match('/^[1-9][0-9]*$/', $_REQUEST['promo_code'])) {
		if (!preg_match('/^[1-9][0-9]*$/', $_SESSION['promo_code'])) {
			$this->redirect('login');
		}else{
			$promo_code = $_SESSION['promo_code'];
		}
    } else {
        $promo_code = $_REQUEST['promo_code'];
    }
}else {
	$this->redirect('login');
}
?>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Berkeley University Admission &amp; Programs</title>

    <!-- Bootstrap Core CSS -->
    <link href="<?php echo Yii::app()->baseUrl; ?>/themes/neon/landing_page/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- Select 2 CSS -->
    <link href="<?php echo Yii::app()->baseUrl; ?>/themes/neon/landing_page/vendor/select2/css/select2.min.css" rel="stylesheet">

    <!-- Theme CSS -->
    <link href="<?php echo Yii::app()->baseUrl; ?>/themes/neon/landing_page/css/stylesheet.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?php echo Yii::app()->baseUrl; ?>/themes/neon/landing_page/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body id="page-top" class="index">

    <!-- Navigation -->
    <nav id="mainNav" class="navbar navbar-default navbar-fixed-top navbar-custom">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header page-scroll">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span> Menu <i class="fa fa-bars"></i>
                </button>
                <a class="navbar-brand" href="#page-top"><img src="<?php echo Yii::app()->baseUrl; ?>/images/img/berkeley-logo-white.png" alt="Berkeley University"></a>
            </div>

            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">
                    <li class="hidden">
                        <a href="#page-top"></a>
                    </li>
                    <li class="page-scroll">
                        <a href="#programs">Programs</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#about">About</a>
                    </li>
                    <li class="page-scroll">
                        <a href="#campus">Campuses</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container-fluid -->
    </nav>

    <!-- Header -->
    <header image-src="<?php echo Yii::app()->baseUrl; ?>/images/img/student.jpg">
        <div class="quote-wrap">
            <div class="display-table">
                <div class="table-cell">
                    <div class="intro-text">
                        <span class="name">Graduate To A Better Future</span>
                        <hr>
                        <span class="skills">Berkeley College has been preparing students for successful career since 1931. Time have changed but our "Student First" commitment hasn't.</span>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- About Section -->
    <section id="programs">
        <div class="container">
			<div class="clearfix">
			<form name="landing_page_form" id="landing_page_form" class="landing_page_form" method="post" action="searchcampus">
            <div class="row">
                <div class="col-sm-12 text-center">
				<input type="hidden" name="promo_code" value="<?php echo $promo_code; ?>" />
                    <h3>Select Program of Interest</h3>
                </div>
            </div>
            <div class="row">
                <div class="custom_padding col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                    <select name="program_of_interest[]" id="explore_programs" class="select_box select_program" multiple="multiple">
			<?php
				if(isset($program_posts) && !empty($program_posts)){
					foreach($program_posts as $program_post){
						if(isset($_SESSION['program_code']) && !empty($_SESSION['program_code'])){
							if(in_array($program_post['code'],$_SESSION['program_code'])){
								echo "<option value='".$program_post['code']."' selected='selected'>".$program_post['name']."</option>";
							}else{
								echo "<option value='".$program_post['code']."'>".$program_post['name']."</option>";}
						}else{
						echo "<option value='".$program_post['code']."'>".$program_post['name']."</option>";
						}
					}
				}
			?>
                    </select>                    
                </div>
                <div class="col-sm-8 col-sm-offset-2 col-xs-12 text-center">
                    <input type="submit" class="btn btn-primary btn-lg" value="Explore" />
                </div>
            </div>
			</form>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Search Result</h2>
                    <hr class="star-primary">
                </div>
            </div>
			</div>
			<div class="clearfix">
				<!--Explore Result-->
<?php
if(isset($posts) && !empty($posts))
{
	$conuter_for_popup = 1;
foreach ($posts as $campus)
{
?>
<div class="col-sm-3 col-xs-6 campus-item">
	<a href="#campusDetails<?php echo $conuter_for_popup; ?>" class="portfolio-link" data-toggle="modal">
		<img src="<?php echo Yii::app()->baseUrl; ?>/images/campus_img/<?php echo $campus['lender_id']; ?>" class="img-responsive" alt="">
	</a>
<h4 class="text-center campus_name_container">
	<?php echo $campus['zipcode']; ?>
</h4>
	<?php
    /**
     ** author : vatsal gadhia
     ** modification : program of interest will be fetch on the basis of campus code only
     ** modified date : 19-08-2016
     */
		$model = new EduZipCodes();
		$data = $model->getProgramFromCampusCityState($campus['campus_code']);
		$prog_name_array = explode(",",$data['prog_name']);
		$prog_code_array = explode(",",$data['prog_code']);

		$prog_code_name = array_combine($prog_code_array,$prog_name_array);
		?>
</div>
				<!--
				 ** author : vatsal gadhia
				 ** description : tabindex="-1" removed (select2 search is not working because of it)
				 ** date : 04-08-2016
				-->
				<div class="campus-modal modal fade" id="campusDetails<?php echo $conuter_for_popup; ?>" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="clearfix">
                        <div class="modal-body">
                            <h2 class="text-center"><?php echo $campus['zipcode']; ?></h2>
                            <hr class="star-primary">
                            <div class="row">
                                <div class="col-sm-3 text-center">
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/campus_img/<?php echo $campus['lender_id']; ?>" class="img-responsive img-centered" alt="">
                                    <div class="clearfix campus_list">
                                        <a href="#fillDetailsModal" class="btn btn-primary btn-lg open-DetailsDialog btn_get_ad_details" data-toggle="modal" data-dismiss="modal">Request Information</a>
        <input type="text" name="poi_val" value='<?php echo json_encode($prog_code_name); ?>' id="poi_val" class="hidden" />
        <input type="number" value="<?php echo $campus['id']; ?>" id="id_val" class="hidden" />
        <input type="text" value="<?php echo $campus['zipcode']; ?>" id="campus_val" class="hidden" />
        <input type="text" value="<?php echo $campus['campus_code']; ?>" id="campus_code" class="hidden" />
        <input type="text" value="<?php echo $campus['city']; ?>" id="city_val" class="hidden" />
        <input type="text" value="<?php echo $campus['state']; ?>" id="state_val" class="hidden" />
                                    </div>
                                </div>
                                <div class="col-sm-9">
								<!--
								 ** author : vatsal gadhia
								 ** description : Get description of program_of_interest dynamically
								 ** date : 04-08-2016
								-->
                                    <p>
										<?php echo $campus['program_of_interest_code']; ?>
									</p>
                                </div>
                            </div>
                            <div class="clearfix">
                                <h3 class="text-center">Programs</h3>
                                <hr class="star-secondary">
                                <div class="program-block clearfix">
                                    <!--<h4>Larry L. Luing School of Business® Degree Programs</h4>-->
                                    <hr>
                                    <ul>
<?php foreach($prog_name_array as $prog_name) { ?>
<li><p><?php echo $prog_name; ?></p></li>
<?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $conuter_for_popup++; ?>
<?php } } ?>
    
			</div>
        </div>
    </section>
		

    <!-- About Section -->
    <section class="success" id="about">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>About</h2>
                    <hr class="star-light">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12 text-center">
                    <p>Everything we do is designed to help students achieve professional and personal success. Berkeley college offers career-focused programs, supportive professors with real-world industry knowledge, hands-on learning through our internship program, and a variety of supplemental programs and activities. Graduate also receive lifelong career assistance.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Portfolio Grid Section -->
    <section id="campus">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <h2>Campuses</h2>
                    <hr class="star-primary">
                </div>
            </div>
            <div class="row">
				<?php
if(isset($all_posts) && !empty($all_posts))
{
	$conuter_for_popup = 1;
foreach ($all_posts as $all_post)
{
?>
<div class="col-sm-3 col-xs-6 campus-item">
	<a href="#all_campusDetails<?php echo $conuter_for_popup; ?>" class="portfolio-link" data-toggle="modal">
		<img src="<?php echo Yii::app()->baseUrl; ?>/images/campus_img/<?php echo $all_post['lender_id']; ?>" class="img-responsive" alt="">
	</a>
<h4 class="text-center campus_name_container">
	<?php echo $all_post['zipcode']; ?>
</h4>
	<?php
    /**
     ** author : vatsal gadhia
     ** modification : program of interest will be fetch on the basis of campus code only
     ** modified date : 19-08-2016
     */
		$model = new EduZipCodes();
		$data = $model->getProgramFromCampusCityState($all_post['campus_code']);
		$prog_name_array = explode(",",$data['prog_name']);
		$prog_code_array = explode(",",$data['prog_code']);

		$prog_code_name = array_combine($prog_code_array,$prog_name_array);
		?>
</div>
				<!--
				 ** author : vatsal gadhia
				 ** description : tabindex="-1" removed (select2 search is not working because of it)
				 ** date : 04-08-2016
				-->
				<div class="campus-modal modal fade" id="all_campusDetails<?php echo $conuter_for_popup; ?>" role="dialog" aria-hidden="true">
        <div class="modal-content">
            <div class="close-modal" data-dismiss="modal">
                <div class="lr">
                    <div class="rl">
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row">
                    <div class="clearfix">
                        <div class="modal-body">
                            <h2 class="text-center"><?php echo $all_post['zipcode']; ?></h2>
                            <hr class="star-primary">
                            <div class="row">
                                <div class="col-sm-3 text-center">
                                    <img src="<?php echo Yii::app()->baseUrl; ?>/images/campus_img/<?php echo $all_post['lender_id']; ?>" class="img-responsive img-centered" alt="">
                                    
                                <div class="clearfix campus_list">
                                    <a href="#fillDetailsModal" class="btn btn-primary btn-lg open-DetailsDialog" data-toggle="modal" data-dismiss="modal">Request Information</a>
                                    <input type="text" name="poi_val" value='<?php echo json_encode($prog_code_name); ?>' id="poi_val" class="hidden" />
                                    <input type="number" value="<?php echo $all_post['id']; ?>" id="id_val" class="hidden" />
                                    <input type="text" value="<?php echo $all_post['zipcode']; ?>" id="campus_val" class="hidden" />
                                    <input type="text" value="<?php echo $all_post['campus_code']; ?>" id="campus_code" class="hidden" />
                                    <input type="text" value="<?php echo $all_post['city']; ?>" id="city_val" class="hidden" />
                                    <input type="text" value="<?php echo $all_post['state']; ?>" id="state_val" class="hidden" />
                                </div>
                                </div>
                                <div class="col-sm-9">
								<!--
								 ** author : vatsal gadhia
								 ** description : get description for program_of_interest dynamically
								 ** date : 04-08-2016
								-->
                                    <p>
										<?php echo $all_post['program_of_interest_code']; ?>
									</p>
                                </div>
                            </div>
                            <div class="clearfix">
                                <h3 class="text-center">Programs</h3>
                                <hr class="star-secondary">
                                <div class="program-block clearfix">
                                    <!--<h4>Larry L. Luing School of Business® Degree Programs</h4>-->
                                    <hr>
                                    <ul>
<?php foreach($prog_name_array as $prog_name) { ?>
<li><p><?php echo $prog_name; ?></p></li>
<?php } ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $conuter_for_popup++; ?>
<?php } } ?>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="text-center">
        <div class="footer-below">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        Maintained &amp; Copyright &copy; 2016 - Higher Learning App
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- Scroll to Top Button (Only visible on small and extra-small screen sizes) -->
    <div class="scroll-top page-scroll hidden-sm hidden-xs hidden-lg hidden-md">
        <a class="btn btn-primary" href="#page-top">
            <i class="fa fa-chevron-up"></i>
        </a>
    </div>

    <!-- Campus Modals -->
	<!--
	 ** author : vatsal gadhia
	 ** description : tabindex="-1" removed (select2 search is not working because of it)
	 ** date : 04-08-2016
	-->
    <div class="campus-modal modal fade student-detail-modal" id="submitMessage" role="dialog" aria-hidden="true">
        <div class="modal-content">
<!--
            <div class="display-table">
                <div class="table-cell">
-->
                <div class="modal_wrapper">
                <div class="close-modal" data-dismiss="modal">
                    <div class="lr">
                        <div class="rl">
                        </div>
                    </div>
                </div>
                <div class="container">
                    <div class="row">
                        <div class="clearfix">
                            <div class="modal-body">
                                <h4 class="text-center">Thank You for Using Higher Learning App</h4>
                                <hr class="star-primary">
                                <div class="row">

                                    <div class="col-sm-12">
                                        <p>Based on the information provided by you we have sent your information to appropriate colleges. Most colleges will call, email or send an information through email within 2 weeks.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
<!--
                </div>
                </div>
-->
            </div>
        </div>
    </div>

    <!-- Student Detail Modal -->
	<!--
	 ** author : vatsal gadhia
	 ** description : tabindex="-1" removed (select2 search is not working because of it)
	 ** date : 04-08-2016
	-->
    <div class="student-detail-modal campus-modal modal fade" id="fillDetailsModal" role="dialog" aria-hidden="true">
        <div class="modal-content">
<!--
            <div class="display-table">
                <div class="table-cell">
-->
                    <div class="modal_wrapper">
                        <div class="close-modal" data-dismiss="modal">
                            <div class="lr">
                                <div class="rl">
                                </div>
                            </div>
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="clearfix">
                                    <div class="modal-body">
                                        <h3 class="text-center modal-title"></h3>
                                        <hr>
                                        <form id="student_detail_form" data-parsley-validate>
                                            <div class="form-section current clearfix">
                                                <input type="text" id="modal-campus-hidden" name="sel_campus" value="" disabled="disabled" readonly="readonly" class="form-control hidden" required />
                                                <input type="text" id="modal-city-hidden" name="city" value="<?php echo $campus['city']; ?>" disabled="disabled" readonly="readonly" class="form-control hidden" required />
                                                <input type="text" id="modal-state-hidden" name="state" value="<?php echo $campus['state']; ?>" disabled="disabled" readonly="readonly" class="form-control hidden" required />
                                                <input type="text" id="modal-promo-code-hidden" name="promo_code" value="<?php echo $promo_code; ?>" disabled="disabled" readonly="readonly" class="form-control hidden" required />
                                                <div class="form-group clearfix">
                                                    <label for="first_name">First Name</label>
                                                    <input type="text" class="form-control" id="first_name" placeholder="First Name" required="">
                                                </div>
                                                <div class="form-group clearfix">
                                                    <label for="last_name">Last Name</label>
                                                    <input type="text" class="form-control" id="last_name" placeholder="Last Name" required="">
                                                </div>
                                                <div class="form-group clearfix">
                                                    <label for="email">Email</label>
                                                    <input type="text" class="form-control" id="email" placeholder="Email" data-parsley-type="email" required="">
                                                </div>
                                                <div class="form-group clearfix">
                                                    <label for="address">Address</label>
                                                    <input type="text" class="form-control" id="address" placeholder="Address" required="">
                                                </div>
                                                <div class="form-group clearfix">
                                                    <label for="zip_code">Zip Code</label>
                                                    <input type="text" class="form-control" id="zip_code" placeholder="Zip Code" data-parsley-type="digits" data-parsley-minlength="5" data-parsley-maxlength="5" required="">
                                                </div>
                                                <!--
                                                 * @author : vatsal gadhia
                                                 * @description : military field added
                                                 * @since : 20-08-2016
                                                 -->
                                                <div class="form-group clearfix">
                                                    <div class="checkbox">
                                                        <label>
                                                          <input type="checkbox" id="military_personnel">
                                                            Please check this box if you are in the military or if your parent/spouse is a member of the military or a veteran.
                                                        </label>
                                                      </div>
                                                    <!--<label for="military_personnel">Military Personnel</label>-->
                                                    
                                                </div>
                                            </div>
											<!--
											 ** author : vatsal gadhia
											 ** description : validation added for phone and mobile (min and max val)
											 ** date : 02-08-2016
                                             ** modification : pattern added to validate phone and mobile
                                             ** modification date : 20-08-2016
											-->
                                            <div class="form-section clearfix">
                                                <div class="form-group clearfix">
                                                    <label for="phone">Phone Number</label>
                                                    <input type="text" class="form-control" id="phone" placeholder="Phone Number"  pattern="[0-9]{10,20}" data-parsley-type="digits" data-parsley-minlength="10" data-parsley-maxlength="20" required="">
                                                </div>
                                                <div class="form-group clearfix">
                                                    <label for="mobile">Mobile Number</label>
                                                    <input type="text" class="form-control" id="mobile" placeholder="Mobile Number"  pattern="[0-9]{10,20}" data-parsley-type="digits" data-parsley-minlength="10" data-parsley-maxlength="20" required="">
                                                </div>
                                                <div class="form-group clearfix">
                                                    <label for="grad_year">Graduation Year</label>
                                                    <select id="grad_year" name="graduation_year">
                                                        <?php for($year=date("Y");$year>=1950;$year--) { ?>
                                                            <option value="<?php echo $year; ?>">
                                                                <?php echo $year; ?>
                                                            </option>
                                                            <?php } ?>
                                                                <option value="1949">1949 or earlier</option>
                                                    </select>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <label for="interested_campus">Campus</label>
                                                    <select id="interested_campus">
                                                    </select>
                                                </div>
                                                <div class="form-group clearfix">
                                                    <label for="interested_course">Interested Course</label>
                                                    <select id="interested_course">
                                                    </select>
                                                </div>
                                                <div class="form-group clearfix disclaimer">
                                                    <label>Disclaimer</label>
                                                    <p>Find out how Berkeley College can help you get started on your new career. By pressing Submit on this page, I give Berkeley College permission to call and/or text me about its programs or services at the phone number provided, including a wireless number, using automated means. Please note that such consent is not required to attend Berkeley College.</p>

                                                    <p>Berkeley College reserves the right to add, discontinue, or modify its programs and policies at any time. Modification subsequent to the original publication of this information may not be reflected here. For the most up-to-date information, please visit <a target="_blank" href="http://berkeleycollege.edu/">BerkeleyCollege.edu</a>.</p>

                                                    <p>For more information about Berkeley College graduation rates, the median debt of students who completed programs, and other important disclosures, please visit <a target="_blank" href="http://berkeleycollege.edu/disclosures/">BerkeleyCollege.edu/disclosures</a>.</p>
                                                </div>
                                            </div>
                                            <div class="form-navigation clearfix">
                                                <button type="button" class="previous btn btn-default pull-left" style="display: none;">Back</button>
                                                <button type="button" class="next btn btn-success pull-right"><span>Next</span></button>
                                                <button href="#submitMessage" type="button" class="btn btn-primary pull-right submit_btn" style="display: none;" ><span>Submit</span></button>
                                                <span class="clearfix"></span>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
<!--
                        </div>
                    </div>
-->
                </div>
            </div>
        </div>
    </div>
    
    <!-- jQuery -->
    <script src="<?php echo Yii::app()->baseUrl; ?>/themes/neon/landing_page/vendor/jquery/jquery.min.js"></script>
    
    <!-- Bootstrap Core JavaScript -->
    <script src="<?php echo Yii::app()->baseUrl; ?>/themes/neon/landing_page/vendor/bootstrap/js/bootstrap.min.js"></script>
    
    <!-- Select 2 JavaScript -->
    <script src="<?php echo Yii::app()->baseUrl; ?>/themes/neon/landing_page/vendor/select2/js/select2.min.js"></script>
    
    <!-- Parsley JavaScript -->
    <script src="<?php echo Yii::app()->baseUrl; ?>/themes/neon/landing_page/vendor/parsley/parsley.min.js"></script>

    <!-- Plugin JavaScript -->
    <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script>

    <!-- Contact Form JavaScript -->
    <script src="<?php echo Yii::app()->baseUrl; ?>/themes/neon/landing_page/js/jqBootstrapValidation.js"></script>
    <script src="<?php echo Yii::app()->baseUrl; ?>/themes/neon/landing_page/js/contact_me.js"></script>

    <!-- Theme JavaScript -->
    <script src="<?php echo Yii::app()->baseUrl; ?>/themes/neon/landing_page/js/main.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            // Script set background image
            var img = $('header').attr('image-src');
            $('header').css('background','url(' + img + ') no-repeat left top');
            
            // Select 2 scripts
            $("#grad_year").select2();
            $("#interested_course").select2();
            $("#interested_campus").select2();
            $("#explore_programs").select2();
       
            $('#fillDetailsModal').on('hidden.bs.modal', function () {
              $('body').removeClass('modal_open');
            });

            $('.btn_get_ad_details').click(function(){
            /**
             ** author : vatsal gadhia
             ** description : form fields blank before form loads
             ** date : 22-08-2016
             */
                $("#fillDetailsModal").closest('div.student-detail-modal').find('input[id=first_name],input[id=last_name],input[id=email],input[id=address],input[id=zip_code],input[id=phone],input[id=mobile]').val('');
                $('body').addClass('modal_open');
            });
            // Form validation for student details
            $(function () {
                var $sections = $('.form-section');

                function navigateTo(index) {
                    // Mark the current section with the class 'current'
                    $sections
                    .removeClass('current')
                    .eq(index)
                    .addClass('current');
                    // Show only the navigation buttons that make sense for the current section:
                    $('.form-navigation .previous').toggle(index > 0);
                    var atTheEnd = index >= $sections.length - 1;
                    $('.form-navigation .next').toggle(!atTheEnd);
                    $('.form-navigation .submit_btn').toggle(atTheEnd);
                }

                function curIndex() {
                    // Return the current index by looking at which section has the class 'current'
                    return $sections.index($sections.filter('.current'));
                }

                // Previous button is easy, just go back
                $('.form-navigation .previous').click(function() {
                    navigateTo(curIndex() - 1);
                });

                // Next button goes forward if current block validates
                $('.form-navigation .next').click(function() {
                    if ($('#student_detail_form').parsley().validate({group: 'block-' + curIndex()})) {
                    $(this).addClass('btn_loader').append('<div class="loader"></div>');
					var zip_code = $("#zip_code").val();
					$("#modal-zip-code-hidden").val(zip_code);	
					$.ajax({

					type: "POST",
					url: "<?php echo Yii::app()->createUrl('edu/affiliates/checkzipcode'); ?>",
					data: {
						zip_code: zip_code
					},
					dataType: 'json',
					cache: false,
					success: function(response) {
							if(response.message){
								//set city and state
								$("#modal-city-hidden").val(response.city);
								$("#modal-state-hidden").val(response.state);
                                $('.next').removeClass('btn_loader');
                                $('.next').find('.loader').remove();
                    navigateTo(curIndex() + 1);
							}else{
								alert("Invalid Zip Code");
                                $('#zip_code').removeClass('parsley-success').addClass('parsley-error');
                                $('.next').removeClass('btn_loader');
                                $('.next').find('.loader').remove();
								return false;
							}
						}
					});
			}
                });

                // Next button goes forward if current block validates
                $('.form-navigation .submit_btn').click(function() {
					
                    if ($('#student_detail_form').parsley().validate({group: 'block-' + curIndex()})) {
                    $(this).addClass('btn_loader').append('<div class="loader"></div>');
						var first_name = $(this).closest('div.student-detail-modal').find('input[id=first_name]').val();
					var last_name = $(this).closest('div.student-detail-modal').find('input[id=last_name]').val();
					var email = $(this).closest('div.student-detail-modal').find('input[id=email]').val();
					var address = $(this).closest('div.student-detail-modal').find('input[id=address]').val();
                    var zip = $(this).closest('div.student-detail-modal').find('input[id=zip_code]').val();
                    /**
                     * @author : vatsal gadhia
                     * @description : military field checked
                     * @since : 20-08-2016
                     */
					var military_personnel = $(this).closest('div.student-detail-modal').find('input[id=military_personnel]').is(':checked');
					var phone = $(this).closest('div.student-detail-modal').find('input[id=phone]').val();
					var phonecell = $(this).closest('div.student-detail-modal').find('input[id=mobile]').val();
					var promo_code = $(this).closest('div.student-detail-modal').find('input[id=modal-promo-code-hidden]').val();
					var campus = $(this).closest('div.student-detail-modal').find('input[id=modal-campus-hidden]').val();
					var city = $(this).closest('div.student-detail-modal').find('input[id=modal-city-hidden]').val();
					var state = $(this).closest('div.student-detail-modal').find('input[id=modal-state-hidden]').val();
					var grad_year = $(this).closest('div.student-detail-modal').find('select[id=grad_year]').val();
					var program_of_interest = document.getElementById("interested_course");
                    /**
                     * @author : vatsal gadhia
                     * @description : military field value assigned
                     * @since : 20-08-2016
                     */
                    var military = 0;
                    if(military_personnel) { military = 1; } else { military = 0; }
					/**
					 ** author : vatsal gadhia
                     ** description : validation added for phone and mobile
                     ** date : 02-08-2016
                     ** modification : validation conditions modified for phone and phonecell
                     ** modification date : 20-08-2016
					 */
					if(phone.length<10 || phone.length>20) {
						alert("Phone Number Should Be Between 10-20 Digits");
						return false;
					}
					if(phonecell.length<10 || phonecell.length>20) {
						alert("Mobile Number Should Be Between 10-20 Digits");
						return false;
					}
					/*window.open(window.location.protocol+"//"+window.location.host+"/index.php/edu/IndexProcess?promo_code="+promo_code+"&lead_mode=0&password=testleadonly&zip="+zip+"&first_name="+first_name+"&last_name="+last_name+"&email="+email+"&sub_id=1883&gender="+''+"&dob="+''+"&phone="+phone+"&address="+address+"&program_of_interest="+program_of_interest.value+"&campus="+campus+"&grad_year="+grad_year+"&highest_education=1&start_date=1&learning_peference=2&enrollment_time=0&outstanding_loan=0&military=1&city="+city+"&state="+state+"&phonecell="+phonecell, '_blank');*/
						$.ajax({

						type: "POST",
						url: "<?php echo Yii::app()->createUrl('edu/IndexProcess?'); ?>",
						data: {
							promo_code: promo_code,
							lead_mode: 0,
							password: 'testleadonly',
							zip: zip,
							first_name: first_name,
							last_name: last_name,
							email: email,
							sub_id: 1883,
							gender: '',
							dob: '',
							phone: phone,
							address: address,
							program_of_interest: program_of_interest.value,
							campus: campus,
							grad_year: grad_year,
							highest_education: 1,
							start_date: 1,
							learning_peference: 2,
							enrollment_time: 0,
							outstanding_loan: 0,
							military: military,
							city: city,
							state: state,
							phonecell: phonecell
						},
						dataType: 'json',
						cache: false,
						success: function(response) {
								//alert("Process Completed");
							}
						});
                        /**
                         ** author : vatsal gadhia
                         ** description : form fields blank after submitting data
                         ** date : 22-08-2016
                         */
                        $(this).closest('div.student-detail-modal').find('input[id=first_name],input[id=last_name],input[id=email],input[id=address],input[id=zip_code],input[id=phone],input[id=mobile]').val('');
						$('#fillDetailsModal').modal('hide');
                        $('.submit_btn').removeClass('btn_loader');
                        $('.submit_btn').find('.loader').remove();
                        $('#student_detail_form').parsley().reset(); // reset parsley
                        navigateTo(0); // Start at the beginning
						$('#submitMessage').modal('show');
					}
                });

                // Prepare sections by setting the `data-parsley-group` attribute to 'block-0', 'block-1', etc.
                $sections.each(function(index, section) {
                    $(section).find(':input').attr('data-parsley-group', 'block-' + index);
                });
            });
        });        
    </script>
<script type="text/javascript">

		
		//Script To set values in modal
		$(document).on("click", ".open-DetailsDialog", function () {		
		 /**
		 * author : vatsal gadhia
		 * modification : get details like campus code and campus name
		 * modification date : 15-july-2016
		 */
			var campus_name = $( this ).parent( ".campus_list" ).find('input[id=campus_val]').val();
			var campus_code = $( this ).parent( ".campus_list" ).find('input[id=campus_code]').val();
			var city_val = $( this ).parent( ".campus_list" ).find('input[id=city_val]').val();
			var state_val = $( this ).parent( ".campus_list" ).find('input[id=state_val]').val();
			var poi_val = $( this ).parent( ".campus_list" ).find('input[id=poi_val]').val();
			var id_val = $( this ).parent( ".campus_list" ).find('input[type=number]').val();
			var t_avail_programs = JSON.parse(poi_val);
			
			/**
			 ** author : vatsal gadhia
			 ** description : interested_course value reset on pop-up open
			 ** date : 04-08-2016
             ** modification : interested_course will be selected automatically as per the search result
             ** modified date : 19-08-2016
			*/
			$("#interested_course").html("<option value='' disabled>- Select One -</option>");
            var select_counter = 0;
			for(var t_avail_program in t_avail_programs) {
                if(jQuery.inArray( t_avail_program, $("#explore_programs").val())>=0 && select_counter==0) {
				    $("#interested_course").append("<option selected='selected' value='"+t_avail_program+"'>"+t_avail_programs[t_avail_program]+"</option>");
                    select_counter = 1;
                } else {
                    $("#interested_course").append("<option value='"+t_avail_program+"'>"+t_avail_programs[t_avail_program]+"</option>");
                }
			}
			$(".modal-title").html("Get Admission Details of<br>" + campus_name);
			$("#interested_campus").html("<option value='"+campus_code+"'>"+campus_name+"</option>")
			$("#modal-campus-hidden").val(campus_code);
			$("#modal-city-hidden").val(city_val);
			$("#modal-state-hidden").val(state_val);
		});	
</script>

</body>

</html>
