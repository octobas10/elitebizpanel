<?php
$promo_code = Yii::app()->user->id;
?>
<h2>Feed Specifications</h2>
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
         <td class="mono">vendor_id</td>
         <td></td>
         <td><em>ex.</em> <span class="mono">1,2,3</span></td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
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
         <td>Ex. - (07/05/1986)</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
      </tr>
      <tr>
         <td class="mono">url</td>
         <td>URL of Lead Generated Website</td>
         <td>Ex. - 
http://www.higherlearningmarketers.com</td>
         <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/optional.gif" alt="Optional" title="Optional" height="16" width="16"></td>
      </tr>
   </tbody>
</table>
<h3>Common Mistakes</h3>
<ul>
   <li>Values must be URL encoded. For example, <span class="mono">james.doe@example.com</span> should be <span class="mono">james.doe%40example.com</span> and <span class="mono">4 Pennsylvania Plaza</span> should be <span class="mono">4+Pennsylvania+Plaza</span>.</li>
   <!--<li>All field names and explicitly allowed values (<span class="mono">is_rented</span> etc...) are case-sensitive.</li>
   <li>Out-of-range or logically impossible values, like <span class="mono">stay_in_month=100</span>, or <span class="mono">stay_in_year=100</span> when <span class="mono">dob=1980</span>, will fail.</li>-->
</ul>
<h3>Post Request Using  HTTP/1.1 POST </h3>
<p>Our testing address is <span class="mono"><?php echo Yii::app()->params['httphost'].Yii::app()->params['frontEndAuto']; ?>/index.php/edu/feedprocess</span>, and our live address is <span class="mono"><?php echo Yii::app()->params['httphost'].Yii::app()->params['frontEndAuto']; ?>/index.php/edu/feedprocess</span>. Please <strong>do not</strong> begin posting to the live address until our tech has manually verified your test data (in addition to our automatic validation process), <em>and</em> we've explicitly notified you that your campaign has been activated within our system. Any leads posted to the live address while your campaign is still in test mode will return an error and neither be counted nor returned.</p>
<h3>Example Request</h3>
<code style="height: 9.5em;">
POST URL: <?php echo Yii::app()->params['httphost'].Yii::app()->params['frontEndAuto']; ?>/index.php/edu/feedprocess<br>
Accept: text/html<br>
Content-Type: application/x-www-form-urlencoded; charset=utf-8<br>
<br>
vendor_id=2&amp;first_name=James&amp;last_name=Doe&amp;gender=M&amp;dob=05/07/1986&amp;email=james.doe@example.com&amp;phone=2124656741&amp;address=4+Pennsylvania+Plaza&amp;zip=12345&amp;city=Schenectady&amp;state=NY&amp;ipaddress=127.0.0.1

</code>
<h3>Responses</h3>
<p><span class="mono" style="color: #fff; background-color: #444; padding: 3px;">This</span> is exact text that will definitely be present. <span class="mono" style="color: #777; background-color: #444; padding: 3px;">...</span> indicates variable data, and may not be present.</p>
<hr>
<p>Accept : </p>
<pre style="background-color: #444444;color: #FFFFFF;">&lt;?xml version="1.0"?&gt;
&lt;PostResponse&gt;
  &lt;Response&gt;ACCEPTED&lt;/Response&gt;
  &lt;Connfirmation&gt;1437197110&lt;/Connfirmation&gt;
  &lt;URL&gt;<?php echo Yii::app()->params['httphost'].Yii::app()->params['frontEndAuto']; ?>&lt;/URL&gt;
&lt;/PostResponse&gt;</pre>
<hr>
<p>Reject : </p>
<pre style="background-color: #444444;color: #FFFFFF;">&lt;?xml version="1.0"?&gt;
&lt;PostResponse&gt;
  &lt;Response&gt;FEED REJECTED&lt;/Response&gt;
  &lt;Reason&gt;No Lender Found&lt;/Reason&gt;
&lt;/PostResponse&gt;</pre>
<table class="data" border="0" cellspacing="0">
   <tbody>
      <tr>
         <td></td>
      </tr>
   </tbody>
</table>
