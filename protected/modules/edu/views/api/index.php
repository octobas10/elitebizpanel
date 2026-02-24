<?php
$promo_code = Yii::app()->user->id;
?>
<h2>Higher Learning Marketers Post Only Specifications</h2>
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
      <!-- <tr>
         <td class="mono">universal_leadid</td>
         <td></td>
         <td>36 characters</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>-->
      <tr>
         <td class="mono">promo_code</td>
         <?php if($promo_code){?>
         <td></td>
         <td><span style="color: red;"><b>Your Promo Code : <?php echo $promo_code;?></b></span></td>
         <?php }else{?>
         <td>Highereducationmarketers Promo Code provided after registration</td>
         <td><em>ex.</em> <span class="mono">123</span></td>
         <?php }?>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">sub_id</td>
         <td>Code of your choosing for your own tracking purposes</td>
         <td>Ex. <span class="mono">123-ABC</span></td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/optional.gif" alt="Optional" title="Optional" height="16" width="16"></td>
      </tr>
      <tr>
            <td class="mono">datetime_stamp</td>
            <td>Original Date/time of the lead submitted by consumer, in format YYYY-MM-DD hh:mm:ss</td>
            <td>Ex. <span class="mono"><?php echo date('Y-m-d h:i:s'); ?> </span></td>
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
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/optional.gif" alt="Optional" title="Optional" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">dob</td>
         <td>Date of Birth - (MM/DD/YYYY)</td>
         <td>Ex. - (07/05/1986)</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Optional" title="Optional" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">mobile</td>
         <td>Mobile Number</td>
         <td>No (), -, or spaces</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">program_of_interest</td>
         <td>Program of your own interest</td>
         <td>
			<?php foreach ($programs as $code=>$program) { ?>
				<?php echo $code .' => '.  $program .'</br>';
			} ?>
		  </td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
	  <tr>
         <td class="mono">education_level</td>
         <td>Higest Level of Education?</td>
         <td>1 => GED</br>
			 2 => High School</br>
			 3 => 1-23 Credits</br>
			 4 => 24-47 Credits</br>
			 5 => 48+ Credits</br>
			 6 => Associate Degree</br>
			 7 => Bachelors Degree</br>
			 8 => Masters Degree</br>
			 9 => Doctorate Degree</br>
			</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">desired_degree</td>
         <td>Desired Degree Interest?</td>
         <td>1 = Diploma</br>
			 2 = Associates</br>
			 3 = Bachelors</br>
			 4 = Masters</br>
			 5 = Doctorate</br>
			 6 = Certificate
			</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">master_degree</td>
         <td>Do you have any "Master Degree"?</td>
         <td>0 =&gt; No<br/>
            1 =&gt; Yes</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/optional.gif" alt="Optional" title="Optional" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">ged</td>
         <td>Did you cleared "General Educational Development" test?</td>
         <td>0 =&gt; No<br/>
            1 =&gt; Yes</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/optional.gif" alt="Optional" title="Optional" height="16" width="16"></td>
      </tr>
      
       <tr>
         <td class="mono">speak_english</td>
         <td>Speak English</td>
         <td>0 =&gt; No<br/>
            1 =&gt; Yes</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/optional.gif" alt="Optional" title="Optional" height="16" width="16"></td>
      </tr>
	  <tr>
         <td class="mono">are_you_a_registered_nurse</td>
         <td>Are You a Registered Nurse?</td>
         <td>0 =&gt; No<br/>
            1 =&gt; Yes</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/optional.gif" alt="Optional" title="Optional" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">do_you_have_a_teaching_certificate</td>
         <td>Do You have a Teaching Certificate?</td>
         <td>0 =&gt; No<br/>
            1 =&gt; Yes</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/optional.gif" alt="Optional" title="Optional" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">trustedformcerturl</td>
         <td>Trusted form URL.</td>
         <td></td>
         <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
     </tr>
      <tr>
         <td class="mono">campus</td>
         <td>Name of Campus & (Related Programs)</td>
         <td>
		<?php 
			$html ='';
			foreach ($campus_programs as $university => $campus_program) {
			$html .= '<div style="border:1px solid #c8d9e9">'.$university.'<a href='.Yii::app()->request->baseUrl.'/docs/edu/'.str_replace(' ','',$university).'.xlsx> Download Zipcodes </a></div>';
				foreach ($campus_program as $college_name_code => $college_deails) {
				$html .= '<div style="border:1px solid #c8d9e9;margin-top:1px;">';
				$coll_code = explode(':',$college_name_code);
				$html .= $coll_code[0] .' => '.$coll_code[1].' <br>';
					foreach ($college_deails as $data) {
						$html .= '<div style="margin-left:50px;background-color:yellow">';
						$html .= $data['program_of_interest_code'].' => '.$data['name'].'</br>';
						$html .= '</div>';
					}
				$html .= '</div>';
				}
			}
			echo $html;
		 ?>
		  </td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">military</td>
         <td>Military</td>
         <td>0 =&gt; No<br/>
            1 =&gt; Yes</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/optional.gif" alt="Optional" title="Optional" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">grad_year</td>
         <td>Your Graduation Year - 4 digits</td>
         <td>The Gradution Years should be between <?php echo date('Y')-20 .' to '.  date('Y')?></td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required" /></td>
      </tr>
      <tr>
         <td class="mono">ipaddress</td>
         <td>IP Address of Customer</td>
         <td>Ex. - 180.120.88.120</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">url</td>
         <td>URL of Lead Generated Website</td>
         <td>Ex. - https://www.higherlearningmarketers.com</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/optional.gif" alt="Optional" title="Optional" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">universal_leadid</td>
         <td>36 character unique lead_id, You will have to inject a JS script into your page to get leadid_token. For more information visit https://app.leadid.com</td>
         <td>Ex. - 4D1CG7Y3-3E6C-AT96-U88W-J56N7FY881V1</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
	  <tr>
         <td class="mono">tcpa_text</td>
         <td>TCPA Text</td>
         <td>first 200 characters of TCPA message presented to user.</td>
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
   <!--<li>All field names and explicitly allowed values (<span class="mono">is_rented</span> etc...) are case-sensitive.</li>
   <li>Out-of-range or logically impossible values, like <span class="mono">stay_in_month=100</span>, or <span class="mono">stay_in_year=100</span> when <span class="mono">dob=1980</span>, will fail.</li>-->
</ul>
<h3>Post Request Using  HTTP/1.1 POST </h3>
<p>Our testing address is <span class="mono"><?php echo Yii::app()->params['httphost'].Yii::app()->params['frontEndAuto']; ?>/edu/postprocess</span>, and our live address is <span class="mono"><?php echo Yii::app()->params['httphost'].Yii::app()->params['frontEndAuto']; ?>/edu/postprocess</span>. Please <strong>do not</strong> begin posting to the live address until our tech has manually verified your test data (in addition to our automatic validation process), <em>and</em> we've explicitly notified you that your campaign has been activated within our system. Any leads posted to the live address while your campaign is still in test mode will return an error and neither be counted nor returned.</p>
<h3>Example Request</h3>
<code style="height:auto;">
POST URL: <?php echo Yii::app()->params['httphost'].Yii::app()->params['frontEndAuto']; ?>/edu/postprocess<br>
Accept: text/html<br>
Content-Type: application/x-www-form-urlencoded; charset=utf-8<br>
<br>


</code>
<div style="word-break: break-all; display: block;color: #000;color: #fff;background-color: #444;padding: 1em;border: 1px solid #d1d1d1;
    margin-bottom: 20px;">
	lead_mode=0&promo_code=1115&sub_id=1282&first_name=James&last_name=Doe&gender=M&dob=05/07/1986&email=james.doe@example.com&phone=2124656741&address=4+Pennsylvania+Plaza&zip=12345&city=Schenectady&state=NY&mobile=9724473839&program_of_interest=MG&education_level=6&desired_degree=3&master_degree=0&ged=1&speak_english=0&are_you_a_registered_nurse=0&do_you_have_a_teaching_certificate=0&campus=BGN&military=0&&grad_year=<?php echo date('Y')-1; ?>&universal_leadid=4D1CG7Y3-3E6C-AT96-U88W-J56N7FY881V1&tcpa_text=text&ipaddress=202.131.100.105&url=https://higherlearningapp.com
	</div>

<h3>Responses</h3>
<p><span class="mono" style="color: #fff; background-color: #444; padding: 3px;">This</span> is exact text that will definitely be present. <span class="mono" style="color: #777; background-color: #444; padding: 3px;">...</span> indicates variable data, and may not be present.</p>
<hr>
<p>Accept : </p>
<pre style="background-color: #444444;color: #FFFFFF;">&lt;?xml version="1.0"?&gt;
&lt;PostResponse&gt;
  &lt;Response&gt;ACCEPTED&lt;/Response&gt;
  &lt;redirectURL&gt;&lt;URL&gt;<?php echo Yii::app()->params['httphost'].Yii::app()->params['frontEndAuto']; ?>/edu/leads/postaccept?affiliate_trans_id=9999&lt;/URL&gt;&lt;/redirectURL&gt;
&lt;/PostResponse&gt;</pre>
<hr>
<p>Reject : </p>
<pre style="background-color: #444444;color: #FFFFFF;">&lt;?xml version="1.0"?&gt;
&lt;PostResponse&gt;
  &lt;Response&gt;REJECTED&lt;/Response&gt;
  &lt;Reason&gt;No Coverage&lt;/Reason&gt;
&lt;/PostResponse&gt;</pre>
<!--<hr>
<p>Reject : </p>
<pre style="background-color: #444444;color: #FFFFFF;">&lt;?xml version="1.0"?&gt;
&lt;PostResponse&gt;
  &lt;Response&gt;REJECTED&lt;/Response&gt;
  &lt;Reason&gt;Monthly income is too low&lt;/Reason&gt;
&lt;/PostResponse&gt;</pre>-->
<hr>
<p>Reject : Duplicate lead.</p>
<pre style="background-color: #444444;color: #FFFFFF;">&lt;?xml version="1.0"?&gt;
&lt;PostResponse&gt;
  &lt;Response&gt;REJECTED&lt;/Response&gt;
  &lt;Reason&gt;Duplicate lead&lt;/Reason&gt;
&lt;/PostResponse&gt;</pre>
<p>The same customer has applied within the past month and was either accepted (any tier), or denied on this tier. Try re-submitting on a different tier.</p>
<hr>
<p>Reject : Inactive campaign</p>
<pre style="background-color: #444444;color: #FFFFFF;">&lt;?xml version="1.0"?&gt;
&lt;PostResult&gt;
  &lt;Response&gt;REJECTED&lt;/Response&gt;
  &lt;Reason&gt;Outside Geo Footprint&lt;/Reason&gt;
&lt;/PostResult&gt;</pre>
<p>Entered zipcode, campus and program of interest didn't match.</p>
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
