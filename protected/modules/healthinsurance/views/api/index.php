<?php $promo_code = Yii::app()->user->id; ?>
<h2>Elite Healthinsurance Ping Post Specifications</h2>
<br>
<br>
<!-- ======= Post : ======= -->
<h2>Post : </h2>
<h4>Field names and acceptable values</h4>
<p>The absence of any required field (<img class="inline_icon" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16">) will result in an error. If you don't collect the data needed by a required field, contact us for instructions. Preferred fields (<img class="inline_icon" src="<?php echo Yii::app()->request->baseUrl; ?>/images/preferred.gif" alt="Preferred" title="Preferred" height="16" width="16">) may be omitted, but doing so could reduce a lead's chances of finding a buyer. Optional fields (<img class="inline_icon" src="<?php echo Yii::app()->request->baseUrl; ?>/images/optional.gif" alt="Optional" title="Optional" height="16" width="16">) can be omitted without effect.
</p>
<table class="data" border="0" cellspacing="0">
    <thead>
        <tr>
            <th>Field</th>
            <th>Contents</th>
            <!--<th>Suggested Default</th>-->
            <th class="txtcenter">Required?</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="mono">lead_mode</td>
            <td>Determines if the lead should be treated as a test lead or a live lead.<br>
                0 = Test Mode<br>
                1 = Live Mode<br>
            
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">promo_code</td>
            <td>EliteHealthinsurance Promo Code provided after registration<br>
                Please ensure you are using the correct code, otherwise your leads may be credited to another partner!</td>
            
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">sub_id</td>
            <td>Code of your choosing for your own tracking purposes - Ex. 123-ABC</td>
            
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">datetime_stamp</td>
            <td>Original Date/time of the lead submitted by consumer, in format YYYY-MM-DD hh:mm:ss</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">tcpa_optin</td>
            <td>Determines whether or not the consumer was presented with, and accepted, unambiguous consent to be contacted via automated telephone systems pursuant to TCPA requirements.<br>
                0 = No<br>
                1 = Yes<br></td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">tcpa_text</td>
            <td>TCPA Text - first 200 characters of TCPA message presented to user.</td>
            
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">universal_leadid</td>
            <td>36 character unique lead_id - Ex. - 4D1CG7Y3-3E6C-AT96-U88W-J56N7FY881V1</td>
            
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">ipaddress</td>
            <td>Applicants IP address</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">user_agent</td>
            <td>The user agent string for the browser used by the applicant when their information was submitted,<br>
                e.g. 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36'</td>
            
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/preferred.gif" width="16" height="16" alt="Preferred" title="Preferred"></td>
        </tr>
        <tr>
            <td class="mono">vendor_lead_id</td>
            <td>Your internal ID for this lead (useful if we need to contact you about a specific lead and when processing returns)</td>
            
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/preferred.gif" width="16" height="16" alt="Preferred" title="Preferred"></td>
        </tr>
        <tr>
            <td class="mono">url</td>
            <td>URL of form where lead was generated</td>
            
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/preferred.gif" width="16" height="16" alt="Preferred" title="Preferred"></td>
        </tr>
        <tr>
            <td class="mono">first_name</td>
            <td>Applicant's First name</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">last_name</td>
            <td>Applicant's Last name</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">email</td>
            <td>Applicant's Email</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">address</td>
            <td>Applicant's Address</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr>
            <td class="mono">zip</td>
            <td>Valid 5-digit US Zip Code.<br>
                Can be used when lead_mode=0 in order to influence test results</td><td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">phone</td>
            <td>Home Phone/Primary Phone Number</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">mobile</td>
            <td>Mobile Or Secondary Phone</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">income</td>
            <td>Annual Verifiable Income, no $, commas, or decimals</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">is_rented</td>
            <td>Residence Type [1=rent or 0=own]</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
        </tr>
        <tr>
         <td class="mono">stay_in_year</td>
         <td>Residence Duration in Years [00 or more ex. 10 or 12 or 15 etc.]</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">stay_in_month</td>
         <td>Residence Duration in Months [01 ... 11]</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
        <tr>
            <td class="mono">gender</td>
            <td>Gender.<br>
                M = Male<br>
                F = Female</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">dob</td>
            <td>Date of birth, in the format YYYY-MM-DD</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">marital_status</td>
            <td>Marital status.<br>
                1 = Single<br>
                2 = Married<br>
                3 = Separated<br>
                4 = Divorced<br>
                5 = Domestic Partner<br>
                6 = Widowed</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
         <td class="mono">education_level</td>
         <td>Higest Level of Education?</br>
                1 => Less than High School</br>
                2 => Some or No High School</br>
                3 => High School Diploma</br>
                4 => Some College</br>
                5 => Associate Degree</br>
                6 => Bachelors Degree</br>
                7 => Masters Degree</br>
                8 => Doctorate Degree</br>
                9 => Other 
            </td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
            <td class="mono">is_employed</td>
            <td>Is applicant Currently Employed? <br> [0 = No or 1 = Yes]</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
        </tr>
      <tr>
        <td class="mono">occupation</td>
        <td>Occupation<br>
            <a href="#occupation">Appendix : Occupation </a></td>
        <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
      </tr>
      <tr>
            <td class="mono">is_student</td>
            <td>Is applicant a Student? [0 = No or 1 = Yes]</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
        </tr>
       <tr>
            <td class="mono">height</td>
            <td>Applicants Height (Centimeters Only should be betwen 120 to 240 CMs)</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
        </tr> 
        <tr>
            <td class="mono">weight</td>
            <td>Applicants Weight (Lbs Only,should be in acceptable values around 100 to 500 lbs)</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
        </tr>
        <tr>
            <td class="mono">medical_condition</td>
            <td>Major medical conditions</br>
                1 => Ongoing Medical Treatment</br>
                2 => Currently Hospitalized?</br>
                3 => HIV / AIDS </br>
                4 => Alcohol Drug Abuse</br>
                5 => Alzheimers Disease </br>
                6 => Cancer </br>
                7 => Cholesterol </br>
                8 => Depression </br>
                9 => Diabetes </br>
                10 => Heart Disease </br>
                11 => High Blood Pressure </br>
                12 => Kidney Disease </br>
                13 => Liver Disease </br>
                14 => Mental Illness </br>
                15 => Pulmonary Disease </br>
                16 => Stroke </br>
                17 => Ulcer </br>
                18 => Vascular Disease </br>
                19 => Pregnancy </br>
                20 => Asthma </br>
                21 => Hepatitus B </br>
                22 => Skin Related Disease </br>
                23 => Transientes Chemic Attack </br> 
                24 => Arthritis </br>
                25 => Eye Or Sight Disorder </br>
                26 => Lupus </br>
                27 => Seizure </br> 
                28 => Neurosis </br>
                29 => Any Other </br>
            </td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
        </tr>
        <tr>
            <td class="mono">dui</td>
            <td>Is applicant ever being charged with a serious offense like DUIs or DWI? <br> [0 = No or 1 = Yes]</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
        </tr>
        <tr>
            <td class="mono">requested_coverage_type</td>
            <td>What type of health Coverage Type do need?<br>
                1 = Individual Plan<br>
                2 = Family Plan <br>
                3 = Medicare Supplement <br>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">previously_denied</td>
            <td>Is applicant Previously denied for coverage? <br> [0 = No or 1 = Yes]</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
        </tr>
        <tr>
            <td class="mono">is_smoker</td>
            <td>Is applicant smoker? <br> [0 = No or 1 = Yes]</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
        </tr>
        <tr>
            <td class="mono">expectant_parent</td>
            <td>Is applicant Expectanting a Parenthood? <br> [0 = No or 1 = Yes]</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
        </tr>
        <tr>
            <td class="mono">relative_heart</td>
            <td>Is applicant have any close relative with a Heart problem? <br> [0 = No or 1 = Yes]</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
        </tr>
         <tr>
            <td class="mono">relative_cancer</td>
            <td>Is applicant have any close relative with Cancer? <br> [0 = No or 1 = Yes]</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
        </tr>
        <tr>
            <td class="mono">number_in_household</td>
            <td>Total number in household <br> 1 or more ex. 2 or 3 or 4 etc.</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
        </tr>
        <tr>
            <td class="mono">current_coverage_type</td>
            <td>What type of health Coverage Type do you have?<br>
                1 = Individual Plan<br>
                2 = Family Plan <br>
                3 = Medicare Supplement <br>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">insurance_company</td>
            <td>Current insurance company <a href="#current_insurance_company"> Appendix : Current Insurance Companies</a><br>
                Note that we do NOT recommend a default mapping of '1' (Company Not Listed) for this field as doing so will result in very few leads being accepted.</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">insurance_expiration_date</td>
            <td>Current policy expiration date, in the format YYYY-MM-DD<br>
                <strong style="color:red;">Note: Could be a date no more than 30 days in the past, the current date, or a future date.</strong></td>
            
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">insurance_start_date</td>
            <td>Current policy start date, in the format YYYY-MM-DD<br>
                <strong style="color:red;">Note: Must be a past date</strong></td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">trustedformcerturl</td>
            <td>Trusted form URL.</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr >
            <td class="mono">comments</td>
            <td>Please pass any extra comments in this field.</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/optional.gif" width="16" height="16" alt="Optional" title="Optional"></td>
        </tr>
    </tbody>
</table>

<h4>Common Mistakes</h4>
<ul>
    <li>Values must be URL encoded. For example, <span class="mono">james.doe@example.com</span> should be <span class="mono">james.doe%40example.com</span> and <span class="mono">4 Pennsylvania Plaza</span> should be <span class="mono">4+Pennsylvania+Plaza</span>.</li>
    <li>All field names and explicitly allowed values (<span class="mono">is_rented</span> etc...) are case-sensitive.</li>
    <li>Out-of-range or logically impossible values, like <span class="mono">stay_in_month=100</span>, or <span class="mono">stay_in_year=100</span> when <span class="mono">dob=1980</span>, will fail.</li>
</ul>
<h4>Post Request Using  HTTP/1.1 POST </h4>
Please <strong>do not</strong> begin posting to the live address until our tech has manually verified your test data (in addition to our automatic validation process), <em>and</em> we've explicitly notified you that your campaign has been activated within our system. Any leads posted to the live address while your campaign is still in test mode will return an error and neither be counted nor returned.</p>
<h4>Example Request</h4>
<code style="height: 9.5em;">
    POST URL: https://elitebizpanel.com/healthinsurance/postprocess<br>
    Accept: text/html<br>
    Content-Type: application/x-www-form-urlencoded; charset=utf-8<br>
    <br>
    <?php $promo_code = isset($promo_code) ? $promo_code : '123'; 
    $ins_expire_date =  date('Y-m-d',time()+(7*84600)); 
    $ins_start_date =  date('Y-m-d',time()-(365*84600)); 
    ?>
    lead_mode=1&promo_code=<?=$promo_code?>&sub_id=123&tcpa_optin=1&tcpa_text=By clicking Get My Quotes, I agree to the Terms of Service and Privacy Policy...... &universal_leadid=B900B2E2-770A-2E4D-007C-07A8488AE963&vendor_lead_id=667597661&url=https://elitehealthinsurers.com&zip=22942&phone_last_4=0125&income=3700&ipaddress=107.150.30.112&user_agent=Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36&is_rented=1&stay_in_year=3&stay_in_month=2&gender=M&trustedformcerturl=&marital_status=2&education_level=5&is_employed=1&occupation=12&is_student=1&height=180&weight=210&medical_condition=2&dui=0&previously_denied=0&is_smoker=0&number_in_household=4&coverage_type=2&insurance_company=10&insurance_expiration_date=<?=$ins_expire_date?>&insurance_start_date=<?=$ins_start_date?>&url=https://elitehealthinsurers.com&first_name=Joe&last_name=Deo&email=joe.deo@example.com&address=4+Pennsylvania+Plaza&city=New+York&state=NY&phone=6105551212&phone2=7495215689&dob=1990-01-01&comments=nocomments
</code>
<h4>Responses</h4>
<p><span class="mono" style="color: #fff; background-color: #444; padding: 3px;">This</span> is exact text that will definitely be present. <span class="mono" style="color: #777; background-color: #444; padding: 3px;">...</span> indicates variable data, and may not be present.</p>
<hr>
<p>Accept : </p>
<pre style="background-color: #444444;color: #FFFFFF;">&lt;?xml version="1.0"?&gt;
&lt;PostResponse&gt;
  &lt;Response&gt;ACCEPTED&lt;/Response&gt;
  &lt;Price&gt;1.00&lt;/Price&gt;
  &lt;URL&gt;https://elitebizpanel.com/healthinsurance/leads/postaccept?affiliate_trans_id=1234&lt;/URL&gt;
&lt;/PostResponse&gt;</pre>
<hr>
<p>Reject : </p>
<pre style="background-color: #444444;color: #FFFFFF;">&lt;?xml version="1.0"?&gt;
&lt;PostResponse&gt;
  &lt;Response&gt;REJECTED&lt;/Response&gt;
  &lt;Reason&gt;No Coverage&lt;/Reason&gt;
&lt;/PostResponse&gt;</pre>
<hr>
<p>Reject : </p>
<pre style="background-color: #444444;color: #FFFFFF;">&lt;?xml version="1.0"?&gt;
&lt;PostResponse&gt;
  &lt;Response&gt;REJECTED&lt;/Response&gt;
  &lt;Reason&gt;Monthly income is too low&lt;/Reason&gt;
&lt;/PostResponse&gt;</pre>
<hr>
<p>Reject : Duplicate lead.</p>
<pre style="background-color: #444444;color: #FFFFFF;">&lt;?xml version="1.0"?&gt;
&lt;PostResponse&gt;
  &lt;Response&gt;REJECTED&lt;/Response&gt;
  &lt;Reason&gt;Duplicate lead&lt;/Reason&gt;
&lt;/PostResponse&gt;</pre>
<p>The same customer has applied within the past month and was either accepted (any tier), or denied on this tier. Try re-submitting on a different tier.</p>
<hr>
<p>Reject : Validation error(s).</p>
<pre style="background-color: #444444;color: #FFFFFF;">&lt;?xml version="1.0"?&gt;
&lt;PostResponse&gt;
  &lt;Response&gt;REJECTED&lt;/Response&gt;
  &lt;Errors&gt;
    &lt;Error&gt;email is invalid&lt;/Error&gt;
  &lt;/Errors&gt;
&lt;/PostResponse&gt;</pre>
<p>Validation error(s). The names of required fields that are empty, and any field containing malformed data, are enumerated.</p>
<hr>
<p>Reject : Inactive campaign.</p>
<pre style="background-color: #444444;color: #FFFFFF;">&lt;?xml version="1.0"?&gt;
&lt;PostResult&gt;
  &lt;Response&gt;REJECTED&lt;/Response&gt;
  &lt;Reason&gt;Inactive campaign&lt;/Reason&gt;
&lt;/PostResult&gt;</pre>
<p>Your campaign has been paused. Please contact us to find out why and resolve the matter.</p>

<table border="0" cellspacing="0" class="data" id="occupation">
    <thead>
        <tr>
            <th>Field</th>
            <th>Contents</th>
            <th>Values Allowed</th>
            <th class="txtcenter">Required?</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="mono" valign="top" style="vertical-align: top;">occupation</td>
            <td style="vertical-align: top;">Occupation</td>
            <td>1 = Accounts Pay/Rec.  <br> 2 = Actor  <br> 3 = Administration/Management  <br> 4 = Appraiser  <br> 5 = Architect  <br> 6 = Artist  <br> 7 = Assembler  <br> 8 = Auditor  <br> 9 = Baker  <br> 10 = Bank Teller  <br> 11 = Banker  <br> 12 = Bartender  <br> 13 = Broker  <br> 14 = Cashier  <br> 15 = Casino Worker  <br> 16 = CEO  <br> 17 = Certified Public Accountant  <br> 18 = Chemist  <br> 19 = Child Care  <br> 20 = City Worker  <br> 21 = Claims Adjuster  <br> 22 = Clergy  <br> 23 = Clerical/Technical  <br> 24 = College Professor  <br> 25 = Computer Tech  <br> 26 = Construction  <br> 27 = Contractor  <br> 28 = Counselor  <br> 29 = Craftsman/Skilled Worker  <br> 30 = Customer Support Rep  <br> 31 = Custodian  <br> 32 = Dancer  <br> 33 = Decorator  <br> 34 = Delivery Driver  <br> 35 = Dentist  <br> 36 = Director  <br> 37 = Disabled  <br> 38 = Drivers  <br> 39 = Electrician  <br> 40 = Engineer-Aeronautical  <br> 41 = Engineer-Aerospace  <br> 42 = Engineer-Chemical  <br> 43 = Engineer-Civil  <br> 44 = Engineer-Electrical  <br> 45 = Engineer-Gas  <br> 46 = Engineer-Geophysical  <br> 47 = Engineer-Mechanical  <br> 48 = Engineer-Nuclear  <br> 49 = Engineer-Other  <br> 50 = Engineer-Petroleum  <br> 51 = Engineer-Structural  <br> 52 = Entertainer  <br> 53 = Farmer  <br> 54 = Fire Fighter  <br> 55 = Flight Attend.  <br> 56 = Food Service  <br> 57 = Health Care  <br> 58 = Installer  <br> 59 = Instructor  <br> 60 = Journalist  <br> 61 = Journeyman  <br> 62 = LabTech.  <br> 63 = Laborer/Unskilled Worker  <br> 64 = Lawyer  <br> 65 = Machine Operator  <br> 66 = Machinist  <br> 67 = Maintenance  <br> 68 = Manufacturer  <br> 69 = Marketing  <br> 70 = Mechanic  <br> 71 = Model  <br> 72 = Nanny  <br> 73 = Nurse/CNA  <br> 74 = Other  <br> 75 = Painter  <br> 76 = Para-Legal  <br> 77 = Paramedic  <br> 78 = Personal Trainer  <br> 79 = Photographer  <br> 80 = Physician  <br> 81 = Pilot  <br> 82 = Plumber  <br> 83 = Police Officer  <br> 84 = Postal Worker  <br> 85 = Preacher  <br> 86 = Pro Athlete  <br> 87 = Production  <br> 88 = Prof-College Degree  <br> 89 = Prof-Specialty Degree  <br> 90 = Programmer  <br> 91 = Real Estate  <br> 92 = Receptionist  <br> 93 = Reservation Agent  <br> 94 = Restaurant Manager  <br> 95 = Retail  <br> 96 = Roofer  <br> 97 = Sales  <br> 98 = Scientist  <br> 99 = Secretary  <br> 100 = Security  <br> 101 = Social Worker  <br> 102 = Stocker  <br> 103 = Store Owner  <br> 104 = Stylist  <br> 105 = Supervisor  <br> 106 = Teacher  <br> 107 = Teacher - with Credentials  <br> 108 = Technical/Supervisory  <br> 109 = Travel Agent  <br> 110 = Truck Driver  <br> 111 = Vet  <br> 112 = Waitress  <br> 113 = Welder  <br> 114 = Government  <br> 115 = Housewife/Househusband  <br> 116 = Retired  <br> 117 = Student Not Living w/Parents  <br> 118 = Unemployed  <br> 119 = Military E1 - E4  <br> 120 = Military E5 - E7  <br> 121 = Military Officer  <br> 122 = Military Other  <br> 123 = Unknown  <br> 124 = Self Employed  <br> 125 = Student Living w/Parents  <br> </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required" /></td>
        </tr>
    </tbody>
</table>
<table border="0" cellspacing="0" class="data" id="current_insurance_company">
    <thead>
        <tr>
            <th>Field</th>
            <th>Contents</th>
            <th>Values Allowed</th>
            <th class="txtcenter">Required?</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="mono" valign="top" style="vertical-align: top;">insurance_company</td>
            <td style="vertical-align: top;"></td>
            <td>1 = Company Not Listed  <br> 2 = 21st Century Insurance  <br> 3 = AAA Insurance Co.  <br> 4 = AARP  <br> 5 = AETNA  <br> 6 = AFLAC  <br> 7 = AIG  <br> 8 = AIU Insurance  <br> 9 = Allied  <br> 10 = Allstate County Mutual  <br> 11 = Allstate Indemnity  <br> 12 = Allstate Insurance  <br> 13 = American Alliance Insurance  <br> 14 = American Automobile Insurance  <br> 15 = American Casualty  <br> 16 = American Deposit Insurance  <br> 17 = American Direct Business Insurance  <br> 18 = American Empire Insurance  <br> 19 = American Family Insurance  <br> 20 = American Family Mutual  <br> 21 = American Financial  <br> 22 = American Health Underwriters  <br> 23 = American Home Assurance  <br> 24 = American Insurance  <br> 25 = American International Ins  <br> 26 = American International Pacific  <br> 27 = American International South  <br> 28 = American Manufacturers  <br> 29 = American Mayflower Insurance  <br> 30 = American Motorists Insurance  <br> 31 = American National Insurance  <br> 32 = American Premier Insurance  <br> 33 = American Protection Insurance  <br> 34 = American Republic  <br> 35 = American Savers Plan  <br> 36 = American Service Insurance  <br> 37 = American Skyline Insurance Company  <br> 38 = American Spirit Insurance  <br> 39 = American Standard Insurance - OH  <br> 40 = American Standard Insurance - WI  <br> 41 = AmeriPlan  <br> 42 = Amica Insurance  <br> 43 = Answer Financial  <br> 44 = Arbella  <br> 45 = Associated Indemnity  <br> 46 = Assurant  <br> 47 = Atlanta Casualty  <br> 48 = Atlantic Indemnity  <br> 49 = Auto Club Insurance Company  <br> 50 = AXA Advisors  <br> 51 = Bankers Life and Casualty  <br> 52 = Banner Life  <br> 53 = Best Agency USA  <br> 54 = Blue Cross and Blue Shield  <br> 55 = Brooke Insurance  <br> 56 = Cal Farm Insurance  <br> 57 = California State Automobile Association  <br> 58 = Chubb  <br> 59 = Citizens  <br> 60 = Clarendon American Insurance  <br> 61 = Clarendon National Insurance  <br> 62 = CNA  <br> 63 = Colonial Insurance  <br> 64 = Comparison Market  <br> 65 = Continental Casualty  <br> 66 = Continental Divide Insurance  <br> 67 = Continental Insurance  <br> 68 = Cotton States Insurance  <br> 69 = Country Insurance and Financial Services  <br> 70 = Countrywide Insurance  <br> 71 = CSE Insurance Group  <br> 72 = Dairyland County Mutual Co of TX  <br> 73 = Dairyland Insurance  <br> 74 = eHealthInsurance Services  <br> 75 = Electric Insurance  <br> 76 = Erie Insurance Company  <br> 77 = Erie Insurance Exchange  <br> 78 = Erie Insurance Group  <br> 79 = Erie Insurance Property and Casualty  <br> 80 = Esurance  <br> 81 = Farm Bureau/Farm Family/Rural  <br> 82 = Farmers Insurance  <br> 83 = Farmers Insurance Exchange  <br> 84 = Farmers TX County Mutual  <br> 85 = Farmers Union  <br> 86 = FinanceBox.com  <br> 87 = Fire and Casualty Insurance Co of CT  <br> 88 = Fireman's Fund  <br> 89 = Foremost  <br> 90 = Foresters  <br> 91 = Geico Casualty  <br> 92 = Geico General Insurance  <br> 93 = Geico Indemnity  <br> 94 = GMAC Insurance  <br> 95 = Golden Rule Insurance  <br> 96 = Government Employees Insurance  <br> 97 = Guaranty National Insurance  <br> 98 = Guide One Insurance  <br> 99 = Hanover Lloyd's Insurance Company  <br> 100 = Hartford Accident and Indemnity  <br> 101 = Hartford Casualty Insurance  <br> 102 = Hartford Fire Insurance  <br> 103 = Hartford Insurance Co of Illinois  <br> 104 = Hartford Insurance Co of the Southeast  <br> 105 = Hartford Omni  <br> 106 = Hartford Underwriters Insurance  <br> 107 = Health Benefits Direct  <br> 108 = Health Choice One  <br> 109 = Health Plus of America  <br> 110 = HealthShare American  <br> 111 = Humana  <br> 112 = IFA Auto Insurance  <br> 113 = IGF Insurance  <br> 114 = Infinity Insurance  <br> 115 = Infinity National Insurance  <br> 116 = Infinity Select Insurance  <br> 117 = Insurance Insight  <br> 118 = Insurance.com  <br> 119 = InsuranceLeads.com  <br> 120 = InsWeb  <br> 121 = Integon  <br> 122 = John Hancock  <br> 123 = Kaiser Permanente  <br> 124 = Kemper Lloyds Insurance  <br> 125 = Landmark American Insurance  <br> 126 = Leader National Insurance  <br> 127 = Leader Preferred Insurance  <br> 128 = Leader Specialty Insurance  <br> 129 = Liberty Insurance Corp  <br> 130 = Liberty Mutual Fire Insurance  <br> 131 = Liberty Mutual Insurance  <br> 132 = Liberty National  <br> 133 = Liberty Northwest Insurance  <br> 134 = Lumbermens Mutual  <br> 135 = Maryland Casualty  <br> 136 = Mass Mutual  <br> 137 = Mega/Midwest  <br> 138 = Mercury  <br> 139 = MetLife Auto and Home  <br> 140 = Metropolitan Insurance Co.  <br> 141 = Mid Century Insurance  <br> 142 = Mid-Continent Casualty  <br> 143 = Middlesex Insurance  <br> 144 = Midland National Life  <br> 145 = Mutual of New York  <br> 146 = Mutual Of Omaha  <br> 147 = National Ben Franklin Insurance  <br> 148 = National Casualty  <br> 149 = National Continental Insurance  <br> 150 = National Fire Insurance Company of Hartford  <br> 151 = National Health Insurance  <br> 152 = National Indemnity  <br> 153 = National Union Fire Insurance of LA  <br> 154 = National Union Fire Insurance of PA  <br> 155 = Nationwide General Insurance  <br> 156 = Nationwide Insurance Company  <br> 157 = Nationwide Mutual Fire Insurance  <br> 158 = Nationwide Mutual Insurance  <br> 159 = Nationwide Property and Casualty  <br> 160 = New England Financial  <br> 161 = New York Life Insurance  <br> 162 = Northwestern Mutual Life  <br> 163 = Northwestern Pacific Indemnity  <br> 164 = Omni Indemnity  <br> 165 = Omni Insurance  <br> 166 = Orion Insurance  <br> 167 = Pacific Indemnity  <br> 168 = Pacific Insurance  <br> 169 = Pafco General Insurance  <br> 170 = Patriot General Insurance  <br> 171 = Peak Property and Casualty Insurance  <br> 172 = PEMCO Insurance  <br> 173 = Physicians  <br> 174 = Progressive  <br> 175 = Progressive Auto Pro  <br> 176 = Prudential Insurance Co.  <br> 177 = Reliance Insurance  <br> 178 = Reliance National Indemnity  <br> 179 = Reliance National Insurance  <br> 180 = Republic Indemnity  <br> 181 = Response Insurance  <br> 182 = SAFECO  <br> 183 = Safeway Insurance  <br> 184 = Safeway Insurance Co of AL  <br> 185 = Safeway Insurance Co of GA  <br> 186 = Safeway Insurance Co of LA  <br> 187 = Security Insurance Co of Hartford  <br> 188 = Security National Insurance Co of FL  <br> 189 = Sentinel Insurance  <br> 190 = Sentry Insurance a Mutual Company  <br> 191 = Sentry Insurance Group  <br> 192 = Shelter Insurance Co.  <br> 193 = St. Paul  <br> 194 = St. Paul Fire and Marine  <br> 195 = St. Paul Insurance  <br> 196 = Standard Fire Insurance Company  <br> 197 = State and County Mutual Fire Insurance  <br> 198 = State Farm County  <br> 199 = State Farm Fire and Cas  <br> 200 = State Farm General  <br> 201 = State Farm Indemnity  <br> 202 = State Farm Insurance Co.  <br> 203 = State Farm Lloyds Tx  <br> 204 = State Farm Mutual Auto  <br> 205 = State Fund  <br> 206 = State National Insurance  <br> 207 = Superior American Insurance  <br> 208 = Superior Guaranty Insurance  <br> 209 = Superior Insurance  <br> 210 = Sure Health Plans  <br> 211 = The Ahbe Group  <br> 212 = The General  <br> 213 = The Hartford  <br> 214 = TICO Insurance  <br> 215 = TIG Countrywide Insurance  <br> 216 = Titan  <br> 217 = TransAmerica  <br> 218 = Travelers Indemnity  <br> 219 = Travelers Insurance Company  <br> 220 = Tri-State Consumer Insurance  <br> 221 = Twin City Fire Insurance  <br> 222 = UniCare  <br> 223 = United American/Farm and Ranch  <br> 224 = United Pacific Insurance  <br> 225 = United Security  <br> 226 = United Services Automobile Association  <br> 227 = Unitrin Direct  <br> 228 = Universal Underwriters Insurance  <br> 229 = US Financial  <br> 230 = USA Benefits/Continental General  <br> 231 = USAA  <br> 232 = USF and G  <br> 233 = Viking County Mutual Insurance  <br> 234 = Viking Insurance Co of WI  <br> 235 = Western and Southern Life  <br> 236 = Western Mutual  <br> 237 = Windsor Insurance  <br> 238 = Woodlands Financial Group  <br> 239 = Zurich North America  <br>                 </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required" /></td>
        </tr>
    </tbody>
</table>
