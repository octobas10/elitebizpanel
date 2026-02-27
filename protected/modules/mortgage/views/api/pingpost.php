<?php 
$this->pageTitle = Yii::app()->name . ' : elitemortgagefinder.com Ping Post Instruction';
$promo_code = Yii::app()->user->id;
$baseUrl = Yii::app()->request->baseUrl;
$badgeRequired = '<span class="api-badge api-badge--required">Required</span>';
$badgePreferred = '<span class="api-badge api-badge--preferred">Preferred</span>';
$badgeOptional = '<span class="api-badge api-badge--optional">Optional</span>';
?>
<section class="api-section" id="ping-post-docs">
	<nav class="api-on-this-page" aria-label="On this page">
		<span class="api-on-this-page__label">On this page</span>
		<ul>
			<li><a href="#ping-spec">Ping – fields and values</a></li>
			<li><a href="#ping-request">Ping – request and responses</a></li>
			<li><a href="#post-spec">Post – fields and values</a></li>
			<li><a href="#post-request">Post – request and responses</a></li>
			<li><a href="#common-mistakes">Common mistakes</a></li>
		</ul>
	</nav>
	<h2 id="ping-spec">Ping – fields and values</h2>
	<p class="api-field-ref-intro">Field names and acceptable values. Missing required (<?php echo $badgeRequired; ?>) fields cause an error; preferred (<?php echo $badgePreferred; ?>) and optional (<?php echo $badgeOptional; ?>) may be omitted where noted.</p>
	<div class="api-legend">
		<span><?php echo $badgeRequired; ?> Must be present</span>
		<span><?php echo $badgePreferred; ?> Recommended</span>
		<span><?php echo $badgeOptional; ?> Optional</span>
	</div>
	<div class="api-table-wrap">
	<table border="0" cellspacing="0" class="data">
    <thead>
        <tr>
            <th>Field</th>
            <th>Contents</th>
            <th class="txtcenter">Required?</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="mono">lead_mode</td>
            <td>Determines if the lead should be treated as a test lead or a live lead.<br>
                0 = Test Mode<br>
                1 = Live Mode<br>
            </td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">promo_code</td>
            <td>EliteMortgage Promo Code provided after registration<br>
                Please ensure you are using the correct code, otherwise your leads may be credited to another partner!</td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
		<tr>
            <td class="mono">sub_id</td>
            <td>Code of your choosing for your own tracking purposes - Ex. 123-ABC</td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">datetime_stamp</td>
            <td>Original Date/time of the lead submitted by consumer, in format YYYY-MM-DD hh:mm:ss</td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">tcpa_optin</td>
            <td>Determines whether or not the consumer was presented with, and accepted, unambiguous consent to be contacted via automated telephone systems pursuant to TCPA requirements.<br>
                0 = No<br>
                1 = Yes<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
		<tr>
            <td class="mono">tcpa_text</td>
            <td>TCPA Text - first 200 characters of TCPA message presented to user.</td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">universal_leadid</td>
            <td>36 character unique lead_id - Ex. - 4D1CG7Y3-3E6C-AT96-U88W-J56N7FY881V1</td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
		<tr>
            <td class="mono">trustedformcerturl</td>
            <td>Trusted form URL.</td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">ipaddress</td>
            <td>Applicants IP address</td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">user_agent</td>
            <td>The user agent string for the browser used by the applicant when their information was submitted,<br>
                e.g. 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36'</td>
            <td class="txtcenter"><?php echo $badgePreferred; ?></td>
        </tr>
        <tr>
            <td class="mono">vendor_lead_id</td>
            <td>Your internal ID for this lead (useful if we need to contact you about a specific lead and when processing returns)</td>
            <td class="txtcenter"><?php echo $badgePreferred; ?></td>
        </tr>
        <tr>
            <td class="mono">url</td>
            <td>URL of form where lead was generated</td>
            <td class="txtcenter"><?php echo $badgePreferred; ?></td>
        </tr>
        <tr>
            <td class="mono">zip</td>
            <td>Valid 5-digit US Zip Code.<br>
                Can be used when lead_mode=0 in order to influence test results</td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">employment_type</td>
            <td>Main source of income.<br>
                1 = Employed<br>
                2 = Self Employed<br>
                3 = Fixed Income<br>
                4 = Benefits</td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">income</td>
            <td>Annual Verifiable Income, no $, commas, or decimals</td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">credit_rating</td>
            <td>Primary applicants credit rating.<br>
                1 = Excellent<br>
                2 = Good<br>
                3 = Fair<br>
                4 = Poor</td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">bankruptcy</td>
            <td>Has primary applicant filed for bankruptcy in the past 7 years?<br>
                0 = No<br>
                1 = Yes</td>
            <!--<td class="txtcenter">0</td>-->
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">loan_amount</td>
            <td>Required Loan Amount, Should not contain [$, commas or decimals]</td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">property_value</td>
            <td>Required Home Value, Should not contain [$, commas or decimals]</td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">mortgage_lead_type</td>
            <td>What type of mortgage lead is this?<br>
                1 = New Purchase<br>
                2 = Refinance<br>
                3 = Home Equity Loan<br>
                4 = Reverse Mortgage<br>
            </td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <!-- mortgage_lead_type =1  -->
        <tr class="api-table-group">
            <td colspan="3"><h3><strong>[New Purchase] If mortgage_lead_type</strong> = <strong>1</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">down_payment</td>
            <td>Applicants available down payment amount, as a percentage of home value (no % sign), e.g. 10 = 10%, 15 = 15%, etc.</td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">spec_home</td>
            <td>Is this loan to purchase a spec home?<br>
                0 = No<br>
                1 = Yes<br>
               </td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">buy_timeframe</td>
            <td>What is the timeframe for purchasing this home?<br>
                1 = Immediately<br>
                2 = Up to 30 days<br>
                3 = Up to 60 days<br>
                4 = Up to 90 days<br>
                5 = No time constraint<br>
               </td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">agent_found</td>
            <td>Has applicant already found an agent?<br>
                0 = No<br>
                1 = Yes<br>
               </td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">property_state</td>
            <td>State of Property<br></td>
            <td class="txtcenter"><?php echo $badgePreferred; ?></td>
        </tr>    
        <tr class="api-table-sub">
            <td class="mono">property_zip</td>
            <td>Zip of Property, valid 5-digit US Zip Code.<br></td>
            <td class="txtcenter"><?php echo $badgePreferred; ?></td>
        </tr>
        <!-- mortgage_lead_type = 2  -->
        <tr class="api-table-group">
            <td colspan="3"><h3><strong>[Refinance] If mortgage_lead_type</strong> = <strong>2</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">first_balance</td>
            <td>Balance of first mortgage, Should not contain [$,commmas or decimals]<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>     
        <tr class="api-table-sub">
            <td class="mono">first_interest_rate</td>
            <td>Interest rate of first mortgage, decimals are allowed, e.g. 1, 5.0, 10.25, etc.<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">second_balance</td>
            <td>Balance of first mortgage, Should not contain [$,commmas or decimals]<br></td>
            <td class="txtcenter"><?php echo $badgeOptional; ?></td>
        </tr>    
        <tr class="api-table-sub">
            <td class="mono">second_interest_rate</td>
            <td>Interest rate of second mortgage, decimals are allowed, e.g. 1, 5.0, 10.25, etc.<br></td>
            <td class="txtcenter"><?php echo $badgeOptional; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">additional_cash</td>
            <td>Amount of additional cash consumer would like to take out of property, Should not contain [$,commmas or decimals]<br></td>
            <td class="txtcenter"><?php echo $badgePreferred; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">property_state</td>
            <td>State of Property<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">property_zip</td>
            <td>Zip of Property, valid 5-digit US Zip Code.<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <!-- mortgage_lead_type = 3  -->
        <tr class="api-table-group">
            <td colspan="3"><h3><strong>[Home Equity Loan] If mortgage_lead_type</strong> = <strong>3</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">home_equity_type</td>
            <td>What type of home equity loan is being requested?<br>
                1 = Second Mortgage<br>
                2 = HELOC<br>
                3 = Not Sure<br>
            </td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">first_balance</td>
            <td>Balance of first mortgage, Should not contain [$,commmas or decimals]<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>    
        <tr class="api-table-sub">
            <td class="mono">first_interest_rate</td>
            <td>Interest rate of first mortgage, decimals are allowed, e.g. 1, 5.0, 10.25, etc.<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">second_balance</td>
            <td>Balance of first mortgage, Should not contain [$,commmas or decimals]<br></td>
            <td class="txtcenter"><?php echo $badgeOptional; ?></td>
        </tr>    
        <tr class="api-table-sub">
            <td class="mono">second_interest_rate</td>
            <td>Interest rate of second mortgage, decimals are allowed, e.g. 1, 5.0, 10.25, etc.<br></td>
            <td class="txtcenter"><?php echo $badgeOptional; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">additional_cash</td>
            <td>Amount of additional cash consumer would like to take out of property, Should not contain [$,commmas or decimals]<br></td>
            <td class="txtcenter"><?php echo $badgePreferred; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">property_state</td>
            <td>State of Property<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">property_zip</td>
            <td>Zip of Property, valid 5-digit US Zip Code.<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <!-- mortgage_lead_type = 4  -->
        <tr class="api-table-group">
            <td colspan="3"><h3><strong>[Reverse Mortgage] If mortgage_lead_type</strong> = <strong>4</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">first_balance</td>
            <td>Balance of first mortgage, Should not contain [$,commmas or decimals]<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>    
        <tr class="api-table-sub">
            <td class="mono">first_interest_rate</td>
            <td>Interest rate of first mortgage, decimals are allowed, e.g. 1, 5.0, 10.25, etc.<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">second_balance</td>
            <td>Balance of first mortgage, Should not contain [$,commmas or decimals]<br></td>
            <td class="txtcenter"><?php echo $badgeOptional; ?></td>
        </tr>    
        <tr class="api-table-sub">
            <td class="mono">second_interest_rate</td>
            <td>Interest rate of second mortgage, decimals are allowed, e.g. 1, 5.0, 10.25, etc.<br></td>
            <td class="txtcenter"><?php echo $badgeOptional; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">additional_cash</td>
            <td>Amount of additional cash consumer would like to take out of property, Should not contain [$,commmas or decimals]<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">property_state</td>
            <td>State of Property<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">property_zip</td>
            <td>Zip of Property, valid 5-digit US Zip Code.<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">property_use</td>
            <td>What is the intended property use?<br>
                1 = Primary Residence<br>
                2 = Second Home<br>
                3 = Investment Property<br>
            </td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">property_desc</td>
            <td>What is the best description of this property?<br>
                1 = Single Family<br>
                2 = Multi Family<br>
                3 = Town House<br>
                4 = Condominium<br>
                5 = Mobile Home<br>
            </td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
         <tr>
            <td class="mono">estimate_value</td>
            <td>Estimated value of property, Should not contain [$,commmas or decimals]<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">rate_type</td>
            <td>What is the intended property use?<br>
                1 = Fixed Rate<br>
                2 = Adjustable Rate<br>
                3 = Fixed/Adjustable<br>
            </td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">ltv_percentage</td>
            <td>Loan To Value (LTV) as a percentage (no % sign), e.g. 100 = 100% etc.<br>
            </td>
            <td class="txtcenter"><?php echo $badgeOptional; ?></td>
        </tr>
        <tr>
            <td class="mono">bank_foreclosure</td>
            <td>Is this property a bank foreclosure?<br>
                0 = No<br>
                1 = Yes<br>
               </td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">num_mortgage_lates</td>
            <td>How many mortgage lates has this applicant had previously?
            </td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">va_loan</td>
            <td>Is this a VA loan?<br>
                0 = No<br>
                1 = Yes<br>
               </td>
            <td class="txtcenter"><?php echo $badgeOptional; ?></td>
        </tr>
        <tr>
            <td class="mono">loan_type</td>
            <td>What is the loan type for the Lead?<br>
                1 = VA Loan<br>
                2 = FHA Loan<br>
                3 = Con Loan<br>
                4 = Other
            </td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">comments</td>
            <td>Please pass any extra comments in this field.</td>
            <td class="txtcenter"><?php echo $badgeOptional; ?></td>
        </tr>
    </tbody>
</table>
</div>
<!-- ================ Ping request and responses ================== -->
<div id="ping-request">
<h3>Ping request using HTTP/1.1 POST</h3>
<p>Endpoint: <span class="mono">https://elitebizpanel.com/mortgage/pingprocess</span> (test and live). Please <strong>do not</strong> post to live until our tech has verified your test data and we have notified you that your campaign is activated. Leads posted to live while still in test mode will return an error and will not be counted.</p>

<h4>Example request</h4>
<div class="api-code-block api-code-block--copyable">
<code>PING URL: https://elitebizpanel.com/mortgage/pingprocess
Accept: text/html
Content-Type: application/x-www-form-urlencoded

<?php $promo_code = isset($promo_code) ? $promo_code : '123'; ?>
lead_mode=1&promo_code=1&sub_id=123&tcpa_optin=1&tcpa_text=By clicking Get My Quotes, I agree to the Terms of Service and Privacy Policy...... &universal_leadid=B900B2E2-770A-2E4D-007C-07A8488AE963&ipaddress=107.150.30.112&user_agent=Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36&vendor_lead_id=667597661&url=https://elitemortgagefinder.com&zip=22942&employment_type=1&income=3700&credit_rating=1&bankruptcy=0&loan_amount=10000&property_value=50000&mortgage_lead_type=1&down_payment=10&spec_home=1&buy_timeframe=1&agent_found=0&property_state=NY&property_zip=10002&property_use=1&property_desc=1&estimate_value=1500000&rate_type=1&ltv_percentage=100&bank_foreclosure=1&num_mortgage_lates=1&va_loan=0&loan_type=1&comments=nocomments</code>
</div>

<h4>Responses</h4>
<p class="api-field-ref-intro"><span class="api-response-legend api-response-legend--exact">Exact</span> text is fixed. <span class="api-response-legend api-response-legend--variable">Variable</span> data may differ.</p>

<div class="api-response-card api-response-card--reject">
	<p>Reject</p>
	<pre>&lt;?xml version="1.0"?&gt;
&lt;PingResponse&gt;
   &lt;Response&gt;REJECTED&lt;/Response&gt;
   &lt;Reason&gt;No Coverage&lt;/Reason&gt;
&lt;/PingResponse&gt;</pre>
</div>

<div class="api-response-card api-response-card--accept">
	<p>Accept</p>
	<pre>&lt;?xml version="1.0"?&gt;
&lt;PingResponse&gt;
   &lt;Response&gt;ACCEPTED&lt;/Response&gt;
   &lt;Ping_Id&gt;111111222333&lt;/Ping_Id&gt;
   &lt;Price&gt;21.105&lt;/Price&gt;
   &lt;Brands&gt;
    &lt;brand&gt;
        &lt;bid_id&gt;33&lt;/bid_id&gt;
        &lt;brand_seller_id&gt;1&lt;/brand_seller_id&gt;
        &lt;brand_id&gt;678EB6274834E&lt;/brand_id&gt;
        &lt;brand_name&gt;Brand 1&lt;/brand_name&gt;
        &lt;bid_price&gt;11.106&lt;/bid_price&gt;
    &lt;/brand&gt;
    &lt;brand&gt;
        &lt;bid_id&gt;34&lt;/bid_id&gt;
        &lt;brand_seller_id&gt;1&lt;/brand_seller_id&gt;
        &lt;brand_id&gt;678EB6274835E&lt;/brand_id&gt;
        &lt;brand_name&gt;Brand 2&lt;/brand_name&gt;
        &lt;bid_price&gt;21.105&lt;/bid_price&gt;
    &lt;/brand&gt;
  &lt;/Brands&gt;
&lt;/PingResponse&gt;</pre>
</div>
</div>

<h2 id="post-spec">Post – Field names and values</h2>
<p>The absence of any required field (<?php echo $badgeRequired; ?>) will result in an error. Preferred (<?php echo $badgePreferred; ?>) and optional (<?php echo $badgeOptional; ?>) fields may be omitted where noted.</p>
	<div class="api-table-wrap">
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
            <td class="mono">ping_id</td>
            <!--<td></td>-->
            <td><span class="mono">Pass ping_id received in ping response</span> <em>&nbsp;&nbsp;</td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">lead_mode</td>
            <td>Determines if the lead should be treated as a test lead or a live lead.<br>
                0 = TEST LEAD<br>
                1 = LIVE LEAD<br>
                <a href="#testing">Click here for full testing instructions.</a></td>
            
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">promo_code</td>
            <td>EliteMortgage Promo Code provided after registration<br>
                Please ensure you are using the correct code, otherwise your leads may be credited to another partner!</td>
            
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
		<tr>
            <td class="mono">sub_id</td>
            <td>Code of your choosing for your own tracking purposes - Ex. 123-ABC</td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">datetime_stamp</td>
            <td>Original Date/time of the lead submitted by consumer, in format YYYY-MM-DD hh:mm:ss</td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">tcpa_optin</td>
            <td>Determines whether or not the consumer was presented with, and accepted, unambiguous consent to be contacted via automated telephone systems pursuant to TCPA requirements.<br>
                0 = No<br>
                1 = Yes<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">tcpa_text</td>
            <td>TCPA Text - first 200 characters of TCPA message presented to user.</td>
            
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">universal_leadid</td>
            <td>36 character unique lead_id - Ex. - 4D1CG7Y3-3E6C-AT96-U88W-J56N7FY881V1</td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
		<tr>
            <td class="mono">trustedformcerturl</td>
            <td>Trusted form URL.</td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">ipaddress</td>
            <td>Applicants IP address</td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">user_agent</td>
            <td>The user agent string for the browser used by the applicant when their information was submitted,<br>
                e.g. 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36'</td>
            <td class="txtcenter"><?php echo $badgePreferred; ?></td>
        </tr>
        <tr>
            <td class="mono">vendor_lead_id</td>
            <td>Your internal ID for this lead (useful if we need to contact you about a specific lead and when processing returns)</td>
            
            <td class="txtcenter"><?php echo $badgePreferred; ?></td>
        </tr>
        <tr>
            <td class="mono">url</td>
            <td>URL of form where lead was generated</td>
            <td class="txtcenter"><?php echo $badgePreferred; ?></td>
        </tr>

        <tr>
            <td class="mono">first_name</td>
            <td>Applicants first name.</td>
            <td class="txtcenter"><?php echo $badgePreferred; ?></td>
        </tr>
        <tr>
            <td class="mono">last_name</td>
            <td>Applicants last name.</td>
            <td class="txtcenter"><?php echo $badgePreferred; ?></td>
        </tr>
        <tr>
            <td class="mono">email</td>
            <td>Applicants Email Address.</td>
            <td class="txtcenter"><?php echo $badgePreferred; ?></td>
        </tr>
        <tr>
            <td class="mono">address</td>
            <td>Applicants Street Address.</td>
            <td class="txtcenter"><?php echo $badgePreferred; ?></td>
        </tr>
        <tr>
            <td class="mono">zip</td>
            <td>Valid 5-digit US Zip Code.<br>
                Can be used when lead_mode=0 in order to influence test results</td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">phone</td>
            <td>Applicants Primary Phone.</td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">phone2</td>
            <td>Applicants Secondary Phone.</td>
            <td class="txtcenter"><?php echo $badgePreferred; ?></td>
        </tr>
        <tr>
            <td class="mono">dob</td>
            <td>Applicants date of birth, in the format YYYY-MM-DD</td>
            <td class="txtcenter"><?php echo $badgePreferred; ?></td>
        </tr>
        <tr>
            <td class="mono">credit_rating</td>
            <td>Primary applicants credit rating.<br>
                1 = Excellent<br>
                2 = Good<br>
                3 = Fair<br>
                4 = Poor</td>
            <!--<td class="txtcenter">2</td>-->
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">bankruptcy</td>
            <td>Has primary applicant filed for bankruptcy in the past 7 years?<br>
                0 = No<br>
                1 = Yes</td>
            <!--<td class="txtcenter">0</td>-->
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
         <tr>
            <td class="mono">loan_amount</td>
            <td>Required Loan Amount, Should not contain [$, commas or decimals]</td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">property_value</td>
            <td>Required Home Value, Should not contain [$, commas or decimals]</td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">mortgage_lead_type</td>
            <td>What type of mortgage lead is this?<br>
                1 = New Purchase<br>
                2 = Refinance<br>
                3 = Home Equity Loan<br>
                4 = Reverse Mortgage<br>
            </td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <!-- mortgage_lead_type =1  -->
        <tr class="api-table-group">
            <td colspan="3"><h3><strong>[New Purchase] If mortgage_lead_type</strong> = <strong>1</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">down_payment</td>
            <td>Applicants available down payment amount, as a percentage of home value (no % sign), e.g. 10 = 10%, 15 = 15%, etc.</td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">spec_home</td>
            <td>Is this loan to purchase a spec home?<br>
                0 = No<br>
                1 = Yes<br>
               </td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">buy_timeframe</td>
            <td>What is the timeframe for purchasing this home?<br>
                1 = Immediately<br>
                2 = Up to 30 days<br>
                3 = Up to 60 days<br>
                4 = Up to 90 days<br>
                5 = No time constraint<br>
               </td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">agent_found</td>
            <td>Has applicant already found an agent?<br>
                0 = No<br>
                1 = Yes<br>
               </td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">property_state</td>
            <td>State of Property<br></td>
            <td class="txtcenter"><?php echo $badgePreferred; ?></td>
        </tr>    
        <tr class="api-table-sub">
            <td class="mono">property_zip</td>
            <td>Zip of Property, valid 5-digit US Zip Code.<br></td>
            <td class="txtcenter"><?php echo $badgePreferred; ?></td>
        </tr>
        <!-- mortgage_lead_type = 2  -->
        <tr class="api-table-group">
            <td colspan="3"><h3><strong>[Refinance] If mortgage_lead_type</strong> = <strong>2</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">first_balance</td>
            <td>Balance of first mortgage, Should not contain [$,commmas or decimals]<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>     
        <tr class="api-table-sub">
            <td class="mono">first_interest_rate</td>
            <td>Interest rate of first mortgage, decimals are allowed, e.g. 1, 5.0, 10.25, etc.<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">second_balance</td>
            <td>Balance of first mortgage, Should not contain [$,commmas or decimals]<br></td>
            <td class="txtcenter"><?php echo $badgeOptional; ?></td>
        </tr>    
        <tr class="api-table-sub">
            <td class="mono">second_interest_rate</td>
            <td>Interest rate of second mortgage, decimals are allowed, e.g. 1, 5.0, 10.25, etc.<br></td>
            <td class="txtcenter"><?php echo $badgeOptional; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">additional_cash</td>
            <td>Amount of additional cash consumer would like to take out of property, Should not contain [$,commmas or decimals]<br></td>
            <td class="txtcenter"><?php echo $badgePreferred; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">property_state</td>
            <td>State of Property<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">property_zip</td>
            <td>Zip of Property, valid 5-digit US Zip Code.<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>    
        <!-- mortgage_lead_type = 3  -->
        <tr class="api-table-group">
            <td colspan="3"><h3><strong>[Home Equity Loan] If mortgage_lead_type</strong> = <strong>3</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">home_equity_type</td>
            <td>What type of home equity loan is being requested?<br>
                1 = Second Mortgage<br>
                2 = HELOC<br>
                3 = Not Sure<br>
            </td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">first_balance</td>
            <td>Balance of first mortgage, Should not contain [$,commmas or decimals]<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>    
        <tr class="api-table-sub">
            <td class="mono">first_interest_rate</td>
            <td>Interest rate of first mortgage, decimals are allowed, e.g. 1, 5.0, 10.25, etc.<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">second_balance</td>
            <td>Balance of first mortgage, Should not contain [$,commmas or decimals]<br></td>
            <td class="txtcenter"><?php echo $badgeOptional; ?></td>
        </tr>    
        <tr class="api-table-sub">
            <td class="mono">second_interest_rate</td>
            <td>Interest rate of second mortgage, decimals are allowed, e.g. 1, 5.0, 10.25, etc.<br></td>
            <td class="txtcenter"><?php echo $badgeOptional; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">additional_cash</td>
            <td>Amount of additional cash consumer would like to take out of property, Should not contain [$,commmas or decimals]<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">property_state</td>
            <td>State of Property<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">property_zip</td>
            <td>Zip of Property, valid 5-digit US Zip Code.<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>


        <!-- mortgage_lead_type = 4  -->
        <tr class="api-table-group">
            <td colspan="3"><h3><strong>[Reverse Mortgage] If mortgage_lead_type</strong> = <strong>4</strong> then these fields are mandatory</h3></td>
        </tr>       
        <tr class="api-table-sub">
            <td class="mono">first_balance</td>
            <td>Balance of first mortgage, Should not contain [$,commmas or decimals]<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>    
        <tr class="api-table-sub">
            <td class="mono">first_interest_rate</td>
            <td>Interest rate of first mortgage, decimals are allowed, e.g. 1, 5.0, 10.25, etc.<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">second_balance</td>
            <td>Balance of first mortgage, Should not contain [$,commmas or decimals]<br></td>
            <td class="txtcenter"><?php echo $badgeOptional; ?></td>
        </tr>    
        <tr class="api-table-sub">
            <td class="mono">second_interest_rate</td>
            <td>Interest rate of second mortgage, decimals are allowed, e.g. 1, 5.0, 10.25, etc.<br></td>
            <td class="txtcenter"><?php echo $badgeOptional; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">additional_cash</td>
            <td>Amount of additional cash consumer would like to take out of property, Should not contain [$,commmas or decimals]<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">property_state</td>
            <td>State of Property<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr class="api-table-sub">
            <td class="mono">property_zip</td>
            <td>Zip of Property, valid 5-digit US Zip Code.<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">property_use</td>
            <td>What is the intended property use?<br>
                1 = Primary Residence<br>
                2 = Second Home<br>
                3 = Investment Property<br>
            </td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">property_desc</td>
            <td>What is the best description of this property?<br>
                1 = Single Family<br>
                2 = Multi Family<br>
                3 = Town House<br>
                4 = Condominium<br>
                5 = Mobile Home<br>
            </td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
         <tr>
            <td class="mono">estimate_value</td>
            <td>Estimated value of property, Should not contain [$,commmas or decimals]<br></td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">rate_type</td>
            <td>What is the intended property use?<br>
                1 = Fixed Rate<br>
                2 = Adjustable Rate<br>
                3 = Fixed/Adjustable<br>
            </td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">ltv_percentage</td>
            <td>Loan To Value (LTV) as a percentage (no % sign), e.g. 100 = 100% etc.<br>
            </td>
            <td class="txtcenter"><?php echo $badgeOptional; ?></td>
        </tr>
        <tr>
            <td class="mono">bank_foreclosure</td>
            <td>Is this property a bank foreclosure?<br>
                0 = No<br>
                1 = Yes<br>
               </td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">num_mortgage_lates</td>
            <td>How many mortgage lates has this applicant had previously?
            </td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">va_loan</td>
            <td>Is this a VA loan?<br>
                0 = No<br>
                1 = Yes<br>
               </td>
            <td class="txtcenter"><?php echo $badgeOptional; ?></td>
        </tr>
        <tr>
            <td class="mono">loan_type</td>
            <td>What is the loan type for the Lead?<br>
                1 = VA Loan<br>
                2 = FHA Loan<br>
                3 = Con Loan<br>
                4 = Other
            </td>
            <td class="txtcenter"><?php echo $badgeRequired; ?></td>
        </tr>
        <tr>
            <td class="mono">comments</td>
            <td>Please pass any extra comments in this field.</td>
            <td class="txtcenter"><?php echo $badgeOptional; ?></td>
        </tr>
    </tbody>
</table>
</div>
<h3 id="common-mistakes">Common mistakes</h3>
<ul>
    <li>Values must be URL encoded. For example, <span class="mono">james.doe@example.com</span> → <span class="mono">james.doe%40example.com</span>, <span class="mono">4 Pennsylvania Plaza</span> → <span class="mono">4+Pennsylvania+Plaza</span>.</li>
    <li>Field names and allowed values (e.g. <span class="mono">is_rented</span>) are case-sensitive.</li>
    <li>Out-of-range values (e.g. <span class="mono">stay_in_month=100</span>) will fail.</li>
</ul>

<div id="post-request">
<h3>Post request using HTTP/1.1 POST</h3>
<p>Do not post to live until your campaign is activated. Endpoint: <span class="mono">https://elitebizpanel.com/mortgage/pingpostprocess</span>.</p>
<h4>Example request</h4>
<div class="api-code-block api-code-block--copyable">
<code>POST URL: https://elitebizpanel.com/mortgage/pingpostprocess
Accept: text/html
Content-Type: application/x-www-form-urlencoded; charset=utf-8

ping_id=1234567&lead_mode=1&promo_code=1&sub_id=123&tcpa_optin=1&tcpa_text=By clicking Get My Quotes, I agree to the Terms of Service and Privacy Policy...... &universal_leadid=B900B2E2-770A-2E4D-007C-07A8488AE963&ipaddress=107.150.30.112&user_agent=Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36&vendor_lead_id=667597661&url=https://elitemortgagefinder.com&first_name=Joe&last_name=Deo&email=joe.deo@example.com&address=4+Pennsylvania+Plaza&phone=6105551212&phone2=7495215689&zip=22942&dob=1992-07-06&employment_type=1&income=3700&credit_rating=1&bankruptcy=0&loan_amount=10000&property_value=50000&mortgage_lead_type=1&down_payment=10&spec_home=1&buy_timeframe=1&agent_found=0&property_state=NY&property_zip=10002&property_use=1&property_desc=1&estimate_value=1500000&rate_type=1&ltv_percentage=100&bank_foreclosure=1&num_mortgage_lates=1&va_loan=0&loan_type=1&comments=nocomments</code>
</div>
<h4>Responses</h4>
<p class="api-field-ref-intro"><span class="api-response-legend api-response-legend--exact">Exact</span> text is fixed. <span class="api-response-legend api-response-legend--variable">Variable</span> data may differ.</p>

<div class="api-response-card api-response-card--accept">
	<p>Accept</p>
	<pre>&lt;?xml version="1.0"?&gt;
&lt;PostResponse&gt;
  &lt;Response&gt;ACCEPTED&lt;/Response&gt;
  &lt;Price&gt;1.00&lt;/Price&gt;
  &lt;URL&gt;https://elitebizpanel.com/mortgage/leads/postaccept?affiliate_trans_id=1234&lt;/URL&gt;
&lt;/PostResponse&gt;</pre>
</div>

<div class="api-response-card api-response-card--reject">
	<p>Reject – No lender found</p>
	<pre>&lt;?xml version="1.0"?&gt;
&lt;PostResponse&gt;
  &lt;Response&gt;REJECTED&lt;/Response&gt;
  &lt;Reason&gt;No Lender Found&lt;/Reason&gt;
&lt;/PostResponse&gt;</pre>
</div>

<div class="api-response-card api-response-card--reject">
	<p>Reject – Duplicate lead</p>
	<pre>&lt;?xml version="1.0"?&gt;
&lt;PostResponse&gt;
  &lt;Response&gt;REJECTED&lt;/Response&gt;
  &lt;Reason&gt;Duplicate lead&lt;/Reason&gt;
&lt;/PostResponse&gt;</pre>
	<p class="api-response-card__note">Same customer applied within the past month (accepted or denied on this tier). Re-submit on a different tier if applicable.</p>
</div>

<div class="api-response-card api-response-card--reject">
	<p>Reject – Validation error(s)</p>
	<pre>&lt;?xml version="1.0"?&gt;
&lt;PostResponse&gt;
  &lt;Response&gt;REJECTED&lt;/Response&gt;
  &lt;Errors&gt;
    &lt;Error&gt;email is invalid&lt;/Error&gt;
  &lt;/Errors&gt;
&lt;/PostResponse&gt;</pre>
	<p class="api-response-card__note">Required fields that are empty or malformed are listed in <code>&lt;Errors&gt;</code>.</p>
</div>

<div class="api-response-card api-response-card--reject">
	<p>Reject – Inactive campaign</p>
	<pre>&lt;?xml version="1.0"?&gt;
&lt;PostResult&gt;
  &lt;Response&gt;REJECTED&lt;/Response&gt;
  &lt;Reason&gt;Inactive campaign&lt;/Reason&gt;
&lt;/PostResult&gt;</pre>
	<p class="api-response-card__note">Campaign is paused. Contact us to resolve.</p>
</div>
</div>
</section>
