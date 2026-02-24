<?php include 'header.php'; ?>	
  <!-- Logo Holder Section End -->
  <?php //echo @file_get_contents("https://elitecashwire.com/persistentid.php?impression=1"); ?>
  <section class="hero">
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-md-offset-0 col-sm-offset-1 col-sm-10">
          <div class="hero-text">
            <h1>BE INSURED & <span class="big-title">SECURE </span> </h1>
            <h2>100% PRIVATE SECURE & SIMPLE</h2>
            <h6>Committed to Finding our customers the Right Insurance.</h6>
          </div>
        </div>
        <div class="col-sm-1">
          <div class="arrow"> <img src="images/arrow.png" alt="arrow"> </div>
        </div>
        <div class="col-md-7 col-sm-12">
          <div class="hero-form">
            <h2>Over a million Insurance Policies Sold</h2>
            <h6>Our customers save an average of $560/yr*!</h6>
			<?php
			$promo_code = isset($_REQUEST['promo_code']) ? $_REQUEST['promo_code'] : '';
			$sub_id = isset($_REQUEST['sub_id']) ? $_REQUEST['sub_id'] : '';
			$subid = isset($_REQUEST['subid']) ? $_REQUEST['subid'] : '';
			$sub_id = !empty($sub_id) ? $sub_id : $subid;
			$sub_id2 = isset($_REQUEST['sub_id2']) ? $_REQUEST['sub_id2'] : '';
			$subid2 = isset($_REQUEST['subid2']) ? $_REQUEST['subid2'] : '';
			$sub_id2 = !empty($sub_id2) ? $sub_id2 : $subid2;

      $clickid = isset($_REQUEST['clickid']) ? $_REQUEST['clickid'] : '';
			$click_id = isset($_REQUEST['click_id']) ? $_REQUEST['click_id'] : '';
      $click_id = !empty($clickid) ? $clickid : $click_id;

      $transactionid = isset($_REQUEST['transactionid']) ? $_REQUEST['transactionid'] : '';
			$transaction_id = isset($_REQUEST['transaction_id']) ? $_REQUEST['transaction_id'] : '';
      $transaction_id = !empty($transactionid) ? $transactionid : $transaction_id;
			?>
      <form method="post" id="contactform">
			<input type="hidden" name="promo_code" value="<?php echo $promo_code;?>" id="promo_code" />
			<input type="hidden" name="sub_id" value="<?php echo $sub_id;?>" id="sub_id" />
			<input type="hidden" name="sub_id2" value="<?php echo $sub_id2;?>" id="sub_id2" />
      <input type="hidden" name="click_id" value="<?php echo $click_id;?>" id="click_id" />
      <input type="hidden" name="transaction_id" value="<?php echo $transaction_id;?>" id="transaction_id" />
      <input type="hidden" name="ipaddress" id="ipaddress" value="<?= $_SERVER['REMOTE_ADDR'] ?>" />
      <input id="leadid_token" name="universal_leadid" value="" type="hidden"/>
      <input type="hidden" name="xxTrustedFormCertUrl" id="xxTrustedFormCertUrl_0" value="">
              <div class="form-group form-group-lg">
                <label class="sr-only" >First Name</label>
                <input type="text" class="form-control mxlen_30" id="first_name" name="first_name" placeholder="First Name" required="required">
              </div>
              <div class="form-group form-group-lg">
                <label class="sr-only" >Last Name</label>
                <input type="text" class="form-control mxlen_30" id="last_name" name="last_name" placeholder="Last Name" required="required">
              </div>
              <div class="form-group form-group-lg">
                <label class="sr-only">Email</label>
                <input type="email" class="form-control mxlen_60" id="email" name="email" placeholder="Email Address" required="required">
              </div>
              <div class="form-group form-group-lg">
                <label class="sr-only" >Phone #</label>
                <input type="phone" class="form-control number_only mxlen_10" id="phone" name="phone" placeholder="Phone" required="required">
              </div>
              <div class="form-group form-group-lg">
                <label class="sr-only">Zip Code</label>
                <input type="text" class="form-control number_only mxlen_5" id="zip" name="zip" placeholder="Zip Code" required="required">
              </div>
              <div class="form-group form-group-lg">
                <label class="sr-only">Address</label>
                <input type="text" class="form-control mxlen_100" id="address" name="address" placeholder="Address" required="required">
              </div>
              <div class="form-group form-group-lg">
                <label class="sr-only" >Current Insurance</label>
                <select class="form-control clsdob" id="dob_month" name="dob_month" placeholder="Month DOB" required>
                  <?php echo Tools::options(1, 12, 2, @$dob_month,false,'Date') ?>
                </select>
                <select class="form-control clsdob clsdobcenter" id="dob_day" name="dob_day"  placeholder="Day DOB" required>
                   <?php echo Tools::options(1, 31, 2, @$dob_day,false,'Of') ?>
                </select>
                <?php $start_year = date('Y') - 18;$end_year = date('Y') - 80;
                ?>
                <select class="form-control clsdob" id="dob_year" name="dob_year" placeholder="Year DOB" required>
                  <?php echo Tools::options($start_year, $end_year, 4, @$dob_year,1,'Birth') ?>
                </select>
              </div>
              <div class="clear"></div>
               <?php /*
              <div class="form-group form-group-lg has-feedback radiobtn" style="margin-top:10px;">
                <label style="float: left;">Are you Insured?</label>
                <input name="is_insured" value="1" type="radio"><span style="padding: 0 5px;">Yes</span> 
                <input name="is_insured" value="0" type="radio"><span style="padding: 0 5px;">NO</span>
              </div>
			  
              <div class="form-group form-group-lg">
                <label class="sr-only">SS#</label>
                <input type="text" class="form-control mxlen_9" id="ssn" name="ssn" placeholder="SSN" required="required">
              </div>
			  */ ?>
			  <div class="form-group form-group-lg">
                <label style="float: left;color:black;text-align:justify;padding-bottom:10px;">By entering my information, I have read and agree to the practices set forth in the EliteInsurers.com <a style="color:red;" href="privacy_policy.php">Privacy Policy</a> and <a style="color:red;" href="terms.php">Terms of Use Agreement</a>, which includes receiving newsletters and/or emails from us or third party advertisers and/or a phone call, pre-recorded call from us or trusted third-parties <a style="color:red;" href="partners.php">marketing partners</a> . I also confirm and certify that I am at least 18 years of age and all the information I entered is correct. I understand your partners may obtain a credit report <a style="color:red;" href="privacy_policy.php">Click to View Terms</a>. By submitting this form, I am providing my electronic signature and giving consent to be contacted for sales purposes by EliteInsurers.com and/or its lenders, and/or participating auto insurance providers and other third parties at the telephone numbers I have listed in my application. I understand and consent that these calls may use an automated telephone dialing system, email, text and/or prerecorded message to expedite my request. I understand that consent to these methods is not required in order to submit an application. <a style="color:red;" href="privacy_policy.php">Click here</a> to view a list of partners.</label>
              </div>
              <button type="submit" class="btn btn-primary btn-lg btn-block">GET QUOTE</button>
            </form>
            <p class="form-message"></p>
          </div>
        </div>
      </div>
      <!-- Hero Row End --> 
    </div>
    <!-- Hero Container End --> 
  </section>
  <!-- Hero Section End --> 
</header>
<!-- Header End -->
<section class="clients">
  <article class="container">
    <div class="row">
      <aside class="col-md-4 col-sm-12">
        <h6>Get the right protection...</h6>
      </aside>
      <aside class="push-right">
        <h2 class="tag_line2">Your Trusted Partner and AutoMobile Insurance Expert.</h2>
      </aside>
      <!-- <aside class="push-right">
        <div class="col-md-2 col-sm-3"> <img src="images/client-logos/client-1.png" class="img-responsive" alt="Client Logo"> </div>
        <div class="col-md-2 col-sm-3"> <img src="images/client-logos/client-2.png" class="img-responsive" alt="Client Logo"> </div>
        <div class="col-md-2 col-sm-3"> <img src="images/client-logos/client-3.png" class="img-responsive" alt="Client Logo"> </div>
        <div class="col-md-2 col-sm-3"> <img src="images/client-logos/client-4.png" class="img-responsive" alt="Client Logo"> </div>
      </aside> -->
    </div>
  </article>
</section>
<section class="features">
  <article class="container">
    <div class="row">
      <aside class="col-lg-7 col-md-6">
        <div class="features-title">
          <h2>Key Features :-</h2>
          <h5>Special features only with Elite Insurers</h5>
        </div>
        <!-- End Features Title -->
        <div class="features-list">
          <h4>Pay Now & Save Later</h4>
          <p><img src="images/icons/tick-icon.png" alt="tick">Automobile insurance is essential. It not only protects your interests if you are in a collision with aother vehicle or it is stolen, it covers your liability to others if an accident is deemed to be your fault. That is why auto insurance is compulsory in  every state in USA. It’s the most straightforward way to meet the requirements and obligations imposed on drivers by the authorities.</p>
        </div>
        <!-- End Features List 1 -->
        <div class="features-list">
          <h4>Protect Yourself and Others</h4>
          <p><img src="images/icons/tick-icon.png" alt="tick">The right car insurance can help protect you, your family members, your passengers and other drivers. If an accident happens, you want to know you have the right coverage to take care of any property or bodily injury costs that may arise. Get a car insurance quote online or speak with an agent today to learn how you can help protect yourself and your family.</p>
        </div>
        <!-- End Features List 2 -->
        <div class="features-list">
          <h4>Hasslefree Mind</h4>
          <p><img src="images/icons/tick-icon.png" alt="tick">Everyone makes mistakes but sometimes another driver’s mistake can become your problem. With the right type of car insurance you can feel confident that you’re protected if an uninsured or under-insured driver hits you. </p>
        </div>
        <!-- End Features List 3 --> 
      </aside>
    </div>
    <!-- End Features Row --> 
  </article>
  <!-- End Features Container --> 
</section>
<!-- End Features Section -->

<section class="contact">
  <article class="container">
    <div class="row">
      <aside class="col-md-12">
        <h4>Our Promise</h4>
        <h2>Your Trusted Source For Insurance</h2>
        <h3>Reach Out to us if you have any questions - We are happy to help you</h3>
      </aside>
    </div>
  </article>
</section>
<section class="services">
  <article class="container">
    <div class="row">
      <aside class="col-md-offset-1 col-md-10">
        <div class="services-title" style="margin-bottom:20px;">
          <h2>Our Best Services</h2>
          <h5>We are providing a fantastic price quote Insurance finding service.</h5>
          <p>We will help you find automobile insurance that best suits your needs and budget.</p>
        </div>
      </aside>
    </div>
	<div style="text-align:center;">
	<script language='JavaScript' type='text/javascript' src='https://ads.elitemate.com/adx.js'></script>
	<script language='JavaScript' type='text/javascript'>
	<!--
	   if (!document.phpAds_used) document.phpAds_used = ',';
	   phpAds_random = new String (Math.random()); phpAds_random = phpAds_random.substring(2,11);
	   document.write ("<" + "script language='JavaScript' type='text/javascript' src='");
	   document.write ("https://ads.elitemate.com/adjs.php?n=" + phpAds_random);
	   document.write ("&amp;what=zone:289&amp;target=_blank");
	   document.write ("&amp;exclude=" + document.phpAds_used);
	   if (document.referrer)
		  document.write ("&amp;referer=" + escape(document.referrer));
	   document.write ("'><" + "/script>");
	//-->
	</script><noscript>
	<a href='https://ads.elitemate.com/adclick.php?n=a6520b7d' target='_blank'><img src='https://ads.elitemate.com/adview.php?what=zone:289&amp;n=a6520b7d' border='0' alt=''></a></noscript>
	</div>
    <div class="services-list">
      <aside class="col-md-4  col-sm-6">
        <div class="list"> <img src="images/icons/car-icon-1.png" alt="car icon">
          <h4>Compare and Save</h4>
          <p>We deal with top insurance providers in the business to find you the best rates.</p>
        </div>
      </aside>
      <aside class="col-md-4 col-sm-6">
        <div class="list"> <img src="images/icons/car-icon-2.png" alt="car icon">
          <h4>Personalized Coverage</h4>
          <p>We help you find a policy that fits your requirements and your life.</p>
        </div>
      </aside>
      <aside class="col-md-4 col-sm-6">
        <div class="list"> <img src="images/icons/car-icon-3.png" alt="car icon">
          <h4>Simple and Fast</h4>
          <p>Connect with insurers online or by phone to receive your quotation on your Automobile Insurance.</p>
        </div>
      </aside>
      <aside class="col-md-4 col-sm-6">
        <div class="list"> <img src="images/icons/car-icon-4.png" alt="car icon">
          <h4>Dial Our Agents 24/7</h4>
          <p>Our licensed agents are available everyday to answer your questions after you submit the GET QUOTE form above.</p>
        </div>
      </aside>
      <aside class="col-md-4 col-sm-6">
        <div class="list"> <img src="images/icons/car-icon-5.png" alt="car icon">
          <h4>Find best prices on various insurance plans</h4>
          <p>Our insurance plans are priced the same everywhere else, We just make them easier for you to find.</p>
        </div>
      </aside>
      <aside class="col-md-4 col-sm-6">
        <div class="list"> <img src="images/icons/car-icon-6.png" alt="car icon">
          <h4>We make selection simple</h4>
          <p>With over 10,000 plans from over hundreds of insurance companies, you can't find a bigger deal of insurance products online better than Us.</p>
        </div>
      </aside>
    </div>
  </article>
</section>
<section class="offer">
  <article class="container">
    <h2>Discounts On Your Auto Insurance Annual Renewals</h2>
    <aside class="col-lg-offset-4 col-md-offset-3 col-lg-4 col-md-6"> <a class="btn btn-primary btn-lg btn-block" href="#home">GET IT NOW <br>
      <span>Before its gone</span></a> </aside>
  </article>
</section>
<!-- Jornaya lead id -->
<script id="LeadiDscript" type="text/javascript">
(function() {
var s = document.createElement('script');
s.id = 'LeadiDscript_campaign';
s.type = 'text/javascript';
s.async = true;
s.src = '//create.lidstatic.com/campaign/ae5930fe-c6f1-07d4-b122-6d6919779e3e.js?snippet_version=2';
var LeadiDscript = document.getElementById('LeadiDscript');
LeadiDscript.parentNode.insertBefore(s, LeadiDscript);
})();
</script>
<noscript><img src='//create.leadid.com/noscript.gif?lac=F62EBA6C-F3C6-0CB9-5D06-AF659B9EB87F&lck=ae5930fe-c6f1-07d4-b122-6d6919779e3e&snippet_version=2' /></noscript>
<!-- End Jornaya Lead Id -->
<!-- TrustedForm -->
<script type="text/javascript">
(function() {
var tf = document.createElement('script');
tf.type = 'text/javascript'; tf.async = true;
tf.src = ("https:" == document.location.protocol ? 'https' : 'http') + "://api.trustedform.com/trustedform.js?field=xxTrustedFormCertUrl&ping_field=xxTrustedFormPingUrl&l=" + new Date().getTime() + Math.random();
var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(tf, s);
})();
</script>
<noscript>
<img src="https://api.trustedform.com/ns.gif" />
</noscript>
<!-- End TrustedForm -->







<?php include 'footer.php'; ?>