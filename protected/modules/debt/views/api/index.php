<?php
$this->pageTitle = Yii::app()->name . ' : elitedebtcleaners.com Direct Post Instruction';
$promo_code = Yii::app()->user->id; ?>
<h2>Elite debt Ping Post Specifications</h2>
<br>
<br>
<!-- ======= Post : ======= -->
<h2>Post : </h2>
<h3>Field names and acceptable values</h3>
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
                0 = TEST LEAD<br>
                1 = LIVE LEAD<br>
                <a href="#testing">Click here for full testing instructions.</a></td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">promo_code</td>
            <td>EliteDebt Promo Code provided after registration<br>
                Please ensure you are using the correct code, otherwise your leads may be credited to another partner!</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
		<tr>
            <td class="mono">sub_id</td>
            <td>Code of your choosing for your own tracking purposes - Ex. 123-ABC</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
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
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">tcpa_text</td>
            <td>TCPA Text - first 200 characters of TCPA message presented to user.</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">universal_leadid</td>
            <td>36 character unique lead_id - Ex. - 4D1CG7Y3-3E6C-AT96-U88W-J56N7FY881V1</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
		<tr>
            <td class="mono">trustedformcerturl</td>
            <td>Trusted form URL.</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">ipaddress</td>
            <td>Applicants IP address</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">user_agent</td>
            <td>The user agent string for the browser used by the applicant when their information was submitted,<br>
                e.g. 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36'</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/preferred.gif" width="16" height="16" alt="Preferred" title="Preferred"></td>
        </tr>
        <tr>
            <td class="mono">vendor_lead_id</td>
            <td>Your internal ID for this lead (useful if we need to contact you about a specific lead and when processing returns)</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/preferred.gif" width="16" height="16" alt="Preferred" title="Preferred"></td>
        </tr>
        <tr>
            <td class="mono">url</td>
            <td>URL of form where lead was generated</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/preferred.gif" width="16" height="16" alt="Preferred" title="Preferred"></td>
        </tr>

        <tr>
            <td class="mono">first_name</td>
            <td>Applicants first name.</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Rreferred" title="Preferred"></td>
        </tr>
        <tr>
            <td class="mono">last_name</td>
            <td>Applicants last name.</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Preferred"></td>
        </tr>
        <tr>
            <td class="mono">email</td>
            <td>Applicants Email Address.</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Rreferred" title="Preferred"></td>
        </tr>
        <tr>
            <td class="mono">address</td>
            <td>Applicants Street Address.</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Rreferred" title="Preferred"></td>
        </tr>
        <tr>
            <td class="mono">phone</td>
            <td>Applicants Primary Phone.</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">zip</td>
            <td>Valid 5-digit US Zip Code.<br>
                Can be used when lead_mode=0 in order to influence test results</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">ssn</td>
            <td>Applicants Social Security Number.</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">employment_type</td>
            <td>Main source of income.<br>
                1 = Full time employed<br>
                2 = Part time employed<br>
                3 = Self employed<br>
                4 = Not employed<br>
                5 = Retried<br>
                6 = Military<br>
                7 = Other</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">income</td>
            <td>Annual Verifiable Income, no $, commas, or decimals</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">credit_rating</td>
            <td>Primary applicants credit rating.<br>
                1 = Excellent<br>
                2 = Good<br>
                3 = Fair<br>
                4 = Poor<br>
                5 = Limited - No History</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">dob</td>
            <td>Applicants date of birth, in the format YYYY-MM-DD</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/preferred.gif" width="16" height="16" alt="Preferred" title="Preferred"></td>
        </tr>
        <tr>
            <td class="mono">is_rented</td>
            <td>Primary applicants residence status.<br>
                0 = Rent<br>
                1 = Own With Mortgage<br>
                2 = Own</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">debt_amount</td>
            <td>Debt Amount, Should not contain [$,commmas or decimals]
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">comments</td>
            <td>Please pass any extra comments in this field.</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/optional.gif" width="16" height="16" alt="Optional" title="Optional"></td>
        </tr>
        
    </tbody>
</table>
<h3>Common Mistakes</h3>
<ul>
    <li>Values must be URL encoded. For example, <span class="mono">james.doe@example.com</span> should be <span class="mono">james.doe%40example.com</span> and <span class="mono">4 Pennsylvania Plaza</span> should be <span class="mono">4+Pennsylvania+Plaza</span>.</li>
    <li>All field names and explicitly allowed values (<span class="mono">is_rented</span> etc...) are case-sensitive.</li>
    <li>Out-of-range or logically impossible values, like <span class="mono">stay_in_month=100</span>, or <span class="mono">stay_in_year=100</span> when <span class="mono">dob=1980</span>, will fail.</li>
</ul>
<h3>Post Request Using  HTTP/1.1 POST </h3>
Please <strong>do not</strong> begin posting to the live address until our tech has manually verified your test data (in addition to our automatic validation process), <em>and</em> we've explicitly notified you that your campaign has been activated within our system. Any leads posted to the live address while your campaign is still in test mode will return an error and neither be counted nor returned.</p>
<h3>Example Request</h3>
<code style="height: 9.5em;">
    POST URL: https://elitebizpanel.com/debt/postprocess<br>
    Accept: text/html<br>
    Content-Type: application/x-www-form-urlencoded; charset=utf-8<br>
    <br>
    lead_mode=1&promo_code=1&sub_id=123&tcpa_optin=1&tcpa_text=By clicking Get My Quotes, I agree to the Terms of Service and Privacy Policy...... &universal_leadid=B900B2E2-770A-2E4D-007C-07A8488AE963&ipaddress=107.150.30.112&user_agent=Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36&vendor_lead_id=667597661&url=https://elitedebtcleaners.com&first_name=Joe&last_name=Deo&email=joe.deo@example.com&address=4+Pennsylvania+Plaza&phone=6105551212&phone2=7495215689&zip=22942&dob=1992-07-06&ssn=023811492&employment_type=1&income=3700&credit_rating=1&is_rented=1&debt_amount=10000&comments=nocomments
</code>
<h3>Responses</h3>
<p><span class="mono" style="color: #fff; background-color: #444; padding: 3px;">This</span> is exact text that will definitely be present. <span class="mono" style="color: #777; background-color: #444; padding: 3px;">...</span> indicates variable data, and may not be present.</p>
<hr>
<p>Accept : </p>
<pre style="background-color: #444444;color: #FFFFFF;">&lt;?xml version="1.0"?&gt;
&lt;PostResponse&gt;
  &lt;Response&gt;ACCEPTED&lt;/Response&gt;
  &lt;Price&gt;1.00&lt;/Price&gt;
  &lt;URL&gt;https://elitebizpanel.com/debt/leads/postaccept?affiliate_trans_id=1234&lt;/URL&gt;
&lt;/PostResponse&gt;</pre>
<hr>
<p>Reject : </p>
<pre style="background-color: #444444;color: #FFFFFF;">&lt;?xml version="1.0"?&gt;
&lt;PostResponse&gt;
  &lt;Response&gt;REJECTED&lt;/Response&gt;
  &lt;Reason&gt;No Lender Found&lt;/Reason&gt;
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
