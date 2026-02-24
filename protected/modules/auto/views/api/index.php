<?php
$promo_code = Yii::app()->user->id;
?>
<h2>Elite Auto Post Only Specifications</h2>
<br><br>
<h2>Post : </h2>
<h3>Field names and acceptable values</h3>
<p>The absence of any required field (<img class="inline_icon" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16">) will result in an error.
   If you don't collect the data needed by a required field, contact us for instructions. 
   Preferred fields (<img class="inline_icon" src="<?php echo Yii::app()->request->baseUrl; ?>/images/preferred.gif" alt="Preferred" title="Preferred" height="16" width="16">) may be omitted, but doing so could reduce a lead's chances of finding a buyer.
   Optional fields (<img class="inline_icon" src="<?php echo Yii::app()->request->baseUrl; ?>/images/optional.gif" alt="Optional" title="Optional" height="16" width="16">) can be omitted without effect.
</p>
<table class="data" border="0" cellspacing="0">
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
         <td class="mono">lead_mode</td>
         <td></td>
         <td><span class="mono">0</span> <em>or</em> <span class="mono">1</span> &nbsp;&nbsp;(<span class="mono">0 : TEST LEAD</span> <em>&nbsp;&nbsp; or &nbsp;&nbsp;</em> <span class="mono">1 : LIVE LEAD</span>)</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">promo_code</td>
         <?php if($promo_code){?>
         <td></td>
         <td><span style="color: red;"><b>Your Promo Code : <?php echo $promo_code;?></b></span></td>
         <?php }else{?>
         <td>EliteAutoCash Promo Code provided after registration</td>
         <td><em>ex.</em> <span class="mono">123</span></td>
         <?php }?>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">sub_id</td>
         <td>Code of your choosing for your own tracking purposes</td>
         <td><em>ex.</em> <span class="mono">123-ABC</span></td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/optional.gif" alt="Optional" title="Optional" height="16" width="16"></td>
      </tr>
      <tr>
            <td class="mono">datetime_stamp</td>
            <td>Original Date/time of the lead submitted by consumer, in format YYYY-MM-DD hh:mm:ss</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
      <tr>
         <td class="mono">first_name</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">last_name</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">email</td>
         <td>Email Address</td>
         <td>&nbsp;</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">phone</td>
         <td>Home Phone Number</td>
         <td>Exactly 10 digits, no (), -, or spaces</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">address</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">city</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">state</td>
         <td>&nbsp;</td>
         <td>Two Captial Letters (NY, CA, etc)</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">zip</td>
         <td>&nbsp;</td>
         <td>&nbsp;</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">gender</td>
         <td>&nbsp;</td>
         <td>M =&gt; Male<br/>
            F =&gt; Female
         </td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">dob</td>
         <td>Date of Birth - (MM/DD/YYYY)</td>
         <td>E.x. - (07/05/1986)</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">mobile</td>
         <td>Mobile Number</td>
         <td>No (), -, or spaces</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/optional.gif" alt="optional" title="optional" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">ssn</td>
         <td>Social Security Number</td>
         <td>Exactly 9 digits, no dashes or spaces</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">is_rented</td>
         <td>Residence Type</td>
         <td>rent or own</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">stay_in_year</td>
         <td>Residence Duration in Years</td>
         <td>00 or more ex. 10 or 12 or 15 etc.</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">stay_in_month</td>
         <td>Residence Duration in Months</td>
         <td>01 ... 11</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">home_pay</td>
         <td>Rent / Mortgage</td>
         <td>No $, commas, or decimals</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">employer</td>
         <td>Name of Employing Company</td>
         <td>E.x. - EliteAutoCash.com</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">job_title</td>
         <td>Job Title</td>
         <td>&nbsp;</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required" /></td>
      </tr>
      <tr>
         <td class="mono">employment_in_month</td>
         <td>Employment Duration in Month</td>
         <td>01 ... 11</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required" /></td>
      </tr>
      <tr>
         <td class="mono">employment_in_year</td>
         <td>Employment Duration in Year</td>
         <td>00 or more</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required" /></td>
      </tr>
      <tr>
         <td class="mono">work_phone</td>
         <td>Work Phone Number</td>
         <td>Exactly 10 digits, no (), -, or spaces</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/optional.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">monthly_income</td>
         <td>Monthly Income</td>
         <td>1500=&gt;<$1500<br/>
            2000=&gt;$1,800 - $2,000<br/>
            2200=&gt;$2,000 - $2,200<br/>
            2400=&gt;$2,200 - $2,400<br/>
            2600=&gt;$2,400 - $2,600<br/>
            2800=&gt;$2,600 - $2,800<br/>
            3000=&gt;$2,800 - $3,000<br/>
            3200=&gt;$3,000 - $3,200 <br/>
            3400=&gt;$3,200 - $3,400<br/>
            3600=&gt;$3,400 - $3,600<br/>
            3800=&gt;$3,600 - $3,800<br/>
            4000=&gt;$3,800 - $4,000<br/>
			4001=&gt;$4000 and above
         </td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">bankruptcy</td>
         <td>Bankruptcy</td>
         <td>0 =&gt; No<br/>
            1 =&gt; Yes</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/optional.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">cosigner</td>
         <td>Cosigner</td>
         <td>0 =&gt; No<br/>
            1 =&gt; Yes</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">car_year</td>
         <td>Car Year</td>
         <td> </td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/optional.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">car_make</td>
         <td>Car Make</td>
         <td></td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/optional.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">car_model</td>
         <td>Car Model</td>
         <td></td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/optional.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">car_trim</td>
         <td>Car Trim</td>
         <td></td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/optional.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">agree_credit_check</td>
         <td>Agree Credit Check</td>
         <td>0 =&gt; No<br/>
            1 =&gt; Yes</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">ipaddress</td>
         <td>IPAddress of Customer</td>
         <td>Ex. - 180.120.88.120</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
	  <tr>
		<td class="mono">universal_leadid</td>
            <td>36 character unique lead_id</td>
            <td>Ex. - 4D1CG7Y3-3E6C-AT96-U88W-J56N7FY881V1</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Optional" title="Required" height="16" width="16"></td>
        </tr>
		<tr>
            <td class="mono">tcpa_text</td>
            <td>TCPA Text</td>
            <td>first 200 characters of TCPA message presented to user.</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/optional.gif" alt="Optional" title="Optional" height="16" width="16"></td>
        </tr>
      <tr>
         <td class="mono">url</td>
         <td>URL of Lead Generated Website</td>
         <td>Ex. - https://elitebizpanel.com</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/optional.gif" alt="Optional" title="Optional" height="16" width="16"></td>
      </tr>
   </tbody>
</table>
<!--   <h3>Additional Requirements</h3>
   <p>To be considered for a loan, a customer must:</p>
   <ul>
     <li>Reside in the United States</li>
     <li>Be employed</li>
     <li>Make $1000+ per month</li>
     <li>Have a bank account, except for those in: Arkansas, Connecticut, Georgia, Maine, Maryland, Massachusetts, New Jersey, New York, North Carolina, Ohio, Pennsylvania, Vermont, Virginia, or West Virginia</li>
   </ul>!-->
<h3>Common Mistakes</h3>
<ul>
   <li>Values must be URL encoded. For example, <span class="mono">james.doe@example.com</span> should be <span class="mono">james.doe%40example.com</span> and <span class="mono">4 Pennsylvania Plaza</span> should be <span class="mono">4+Pennsylvania+Plaza</span>.</li>
   <li>All field names and explicitly allowed values (<span class="mono">is_rented</span> etc...) are case-sensitive.</li>
   <li>Out-of-range or logically impossible values, like <span class="mono">stay_in_month=100</span>, or <span class="mono">stay_in_year=100</span> when <span class="mono">dob=1980</span>, will fail.</li>
</ul>
<h3>Post Request Using  HTTP/1.1 POST </h3>

<h3>Example Request</h3>
<code style="height: 9.5em;">
POST URL: https://elitebizpanel.com/auto/postprocess<br>
Accept: text/html<br>
Content-Type: application/x-www-form-urlencoded; charset=utf-8<br>
<br>
lead_mode=0&amp;promo_code=1115&amp;sub_id=1282&amp;first_name=James&amp;last_name=Doe&amp;gender=M&amp;dob=05/07/1986&amp;email=james.doe@example.com&amp;phone=2124656741&amp;address=4+Pennsylvania+Plaza&amp;zip=12345&amp;city=Schenectady&amp;state=NY&amp;mobile=9724473839&amp;is_rented=rent&amp;stay_in_month=05&amp;stay_in_year=02&amp;home_pay=200&amp;employer=EliteCashWire&amp;job_title=Developer&amp;employment_in_month=01&amp;empl	oyment_in_year=01&amp;monthly_income=15000&amp;ssn=324234355&amp;loan_amount=5555&amp;bankruptcy=0&amp;ipaddress=127.0.0.1&amp;cosigner=1&amp;agree_credit_check=1&amp;url=https://elitecashwire.com

</code>
<h3>Responses</h3>
<p><span class="mono" style="color: #fff; background-color: #444; padding: 3px;">This</span> is exact text that will definitely be present. <span class="mono" style="color: #777; background-color: #444; padding: 3px;">...</span> indicates variable data, and may not be present.</p>
<hr>
<p>Accept : </p>
<pre style="background-color: #444444;color: #FFFFFF;">&lt;?xml version="1.0"?&gt;
&lt;PostResponse&gt;
  &lt;Response&gt;ACCEPTED&lt;/Response&gt;
  &lt;Price&gt;1.00&lt;/Price&gt;
  &lt;URL&gt;https://elitebizpanel.com/auto/leads/postaccept?affiliate_trans_id=1234&lt;/URL&gt;
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
    &lt;Error&gt;Email is invalid&lt;/Error&gt;
  &lt;/Errors&gt;
&lt;/PostResponse&gt;</pre>
<p>Validation error(s). The names of required fields that are empty, and any field containing malformed data, are enumerated.</p>
<hr>
<p>Reject : Inactive campaign</p>
<pre style="background-color: #444444;color: #FFFFFF;">&lt;?xml version="1.0"?&gt;
&lt;PostResult&gt;
  &lt;Response&gt;REJECTED&lt;/Response&gt;
  &lt;Reason&gt;Inactive campaign&lt;/Reason&gt;
&lt;/PostResult&gt;</pre>
<p>Your campaign has been paused. Please contact us to find out why and resolve the matter.</p>
<table class="data" border="0" cellspacing="0">
   <tbody>
      <tr>
         <td></td>
      </tr>
   </tbody>
</table>
