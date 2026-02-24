<?php $promo_code = Yii::app()->user->id; ?>
<h2>Elite Autoinsurance Ping Post Specifications</h2>
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
<!--        <tr>
            <td class="mono">ping_id</td>
            <td></td>
            <td><span class="mono">Pass ping_id received in ping response</span> <em>&nbsp;&nbsp;</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
        </tr>-->
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
            <td>EliteAutoinsurance Promo Code provided after registration<br>
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
            <td class="mono">email</td>
            <td>Valid Email Address</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
		<tr>
            <td class="mono">address</td>
            <td>Valid Postal Address</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
		<tr>
            <td class="mono">phone</td>
            <td>10 digit long valid phone number - Exactly 10 digits, no (), -, or spaces</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
		<tr>
            <td class="mono">phone2</td>
            <td>10 digit long valid phone number - Exactly 10 digits, no (), -, or spaces</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/optional.gif" width="16" height="16" alt="Optional" title="Optional"></td>
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
            <td>URL of form where lead was generated, e.g. 'https://elitebizpanel.com'</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/preferred.gif" width="16" height="16" alt="Preferred" title="Preferred"></td>
        </tr>
        <tr>
            <td class="mono">zip</td>
            <td>Valid 5-digit US Zip Code.<br>
                Can be used when lead_mode=0 to influence test results.<br>
                <a href="#testing">Click here for full testing instructions.</a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">is_rented</td>
            <td>Primary applicants residence status.<br>
                own = Own <br>
				rent = Rent
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">stay_in_year</td>
            <td>Primary applicants years at residence.<br>
                0 = 0 Years<br>
                1 = 1 Year<br>
                2 = 2 Years<br>
                3 = 3 Years<br>
                4 = 4 Years<br>
                5 = 5 Years<br>
                6 = 6 Years<br>
                7 = 7 Years<br>
                8 = 8 Years<br>
                9 = 9 Years<br>
                10 = 10 or more Years</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">stay_in_month</td>
            <td>Primary applicants months at residence.<br>
                0 = 0 Months<br>
                1 = 1 Month<br>
                2 = 2 Months<br>
                3 = 3 Months<br>
                4 = 4 Months<br>
                5 = 5 Months<br>
                6 = 6 Months<br>
                7 = 7 Months<br>
                8 = 8 Months<br>
                9 = 9 Months<br>
                10 = 10 Months<br>
                11 = 11 Months</td>
            <!--<td class="txtcenter">0</td>-->
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">credit_rating</td>
            <td>Primary applicants credit rating.<br>
                1 = Excellent<br>
                2 = Good<br>
                3 = Fair<br>
                4 = Poor</td>
            <!--<td class="txtcenter">2</td>-->
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">bankruptcy</td>
            <td>Has primary applicant filed for bankruptcy in the past 7 years?<br>
                0 = No<br>
                1 = Yes</td>
            <!--<td class="txtcenter">0</td>-->
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">coverage_type</td>
            <td>Coverage Type.<br>
                1 = Superior ($250k/$500k Injury, $100k Property)<br>
                2 = Standard ($100k/$300k Injury, $50k Property)<br>
                3 = Basic ($50k/$100k Injury, $25k Property)<br>
                4 = State Minimum</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">vehicle_deductibles</td>
            <td>Comprehensive Deductible for policy.<br>
                1 = $0<br>
                2 = $50<br>
                3 = $100<br>
                4 = $250<br>
                5 = $500<br>
                6 = $1,000<br>
                7 = $2,500<br>
                8 = $5,000</td>
            <!--<td class="txtcenter">4</td>-->
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">vehicle_collision_deductibles</td>
            <td>Collision Deductible for policy.<br>
                1 = $0<br>
                2 = $50<br>
                3 = $100<br>
                4 = $250<br>
                5 = $500<br>
                6 = $1,000<br>
                7 = $2,500<br>
                8 = $5,000</td>
            <!--<td class="txtcenter">4</td>-->
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">medical_pay</td>
            <td>Amount of Medical Coverage.<br>
                1 = $0<br>
                2 = $500<br>
                3 = $1,000<br>
                4 = $2,000<br>
                5 = $5,000<br>
                6 = $25,000<br>
                7 = $50,000<br>
                8 = $100,000</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">insurance_policy</td>
            <td>Indicates whether driver1 has a current auto insurance policy or not.<br>
                <strong style="color:red;">Note: May include auto insurance policies that have expired no more than 30 days in the past.</strong><br>
                0 = No<br>
                1 = Yes</td>
            <!--<td class="txtcenter">0</td>-->
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <b>insurance_policy</b> = <b>1</b>  then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">insurance_company</td>
            <td>Driver1's current insurance company - see <a href="#current_insurance_company">Insurance Company Values</a><br>
                Note that we do NOT recommend a default mapping of '1' (Company Not Listed) for this field as doing so will result in very few leads being accepted.</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">insurance_start_date</td>
            <td>Driver1's current policy start date, in the format YYYY-MM-DD<br>
                <strong style="color:red;">Note: Must be a past date</strong></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">insurance_expiration_date</td>
            <td>Driver1's current policy expiration date, in the format YYYY-MM-DD<br>
                <strong style="color:red;">Note: Could be a date no more than 30 days in the past, the current date, or a future date.</strong></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">continuously_insured_period</td>
            <td>Driver1's period of continuous auto insurance coverage.<br>
                1 = Less than 6 Months<br>
                2 = 6 Months to 1 Year<br>
                3 = 1 Year<br>
                4 = 2 Years<br>
                5 = 3 Years<br>
                6 = 4 Years<br>
                7 = 5 Years<br>
                8 = 6+ Years</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3><strong>Driver 1 Information</strong></h3></td>
        </tr>
        <tr>
            <td class="mono">driver1_first_name</td>
            <td>Driver1 first name.</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">driver1_last_name</td>
            <td>Driver1 last name.</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">driver1_gender</td>
            <td>Driver1 gender.<br>
                M = Male<br>
                F = Female</td>
            <!--<td class="txtcenter">0</td>-->
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">dob</td>
            <td>Driver1 date of birth, in the format YYYY-MM-DD</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">driver1_marital_status</td>
            <td>Driver1 marital status.<br>
                1 = Single<br>
                2 = Married<br>
                3 = Separated<br>
                4 = Divorced<br>
                5 = Domestic Partner<br>
                6 = Widowed</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">driver1_education</td>
            <td>Driver1 education level<br>
                <a href="#driver_education">Appendix : Driver Education Level </a></td>
            <!--<td class="txtcenter">123</td>-->
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">driver1_occupation</td>
            <td>Driver1 occupation<br>
                <a href="#driver_occupation">Appendix : Driver Occupation </a></td>
            <!--<td class="txtcenter">123</td>-->
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">driver1_required_SR22</td>
            <td>Driver1 SR22 status.<br>
                0 = SR22 NOT required<br>
                1 = SR22 Required</td>
            <!--<td class="txtcenter">0</td>-->
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>							<tr style="background:#666;">
            <td class="mono" colspan="3"><h3><strong>Driver 1 Tickets, Accidents, Violations and Claims</strong></h3></td>
        </tr>
        <tr>
            <td class="mono">driver1_hasTAVCs</td>
            <td>Does Driver1 have any Tickets, Accidents, Violations or Claims?<br>
                0 = No<br>
                1 = Yes</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>hasTAVCs</strong> = <strong>1</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_num_of_incidents</td>
            <td>The number of incidents to report for driver1.<br>
                1 = 1 incident<br>
                2 = 2 incidents<br>
                3 = 3 incidents<br>
                4 = 4 incidents</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>


        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3><strong>Driver 1, Incident 1:</strong> If <strong>driver1_num_of_incidents</strong> &gt;= <strong>1</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_incident1_type</td>
            <td>The type of incident to report for driver1.<br>
                1 = Ticket<br>
                2 = Accident<br>
                3 = Violation<br>
                4 = Claim</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_incident1_date</td>
            <td>Date of Driver1 Incident1, in the format YYYY-MM-DD<br>
                <strong style="color:red;">Note: Must be a past date</strong></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>incident1_type</strong> = <strong>1</strong> (Ticket) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_ticket1_description</td>
            <td>Driver1 Ticket1 Description<br>
                <a href="#driver_ticket1Description">Appendix : Driver Ticket Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>incident1_type</strong> = <strong>2</strong> (Accident) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_accident1_description</td>
            <td>Driver1 Accident1 Description<br>
                <a href="#driver_accident1Description">Appendix : Driver Accident Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_accident1_damage</td>
            <td>What was damaged?<br>
                1 = People<br>
                2 = Property<br>
                3 = Both<br>
                4 = Not Applicable</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_accident1_at_fault</td>
            <td>Was Driver1 at fault?<br>
                0 = No<br>
                1 = Yes</td>
            <!--<td class="txtcenter">0</td>-->
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_accident1_amount</td>
            <td>Total claim amount - no commas or dollar symbol</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>incident1_type</strong> = <strong>3</strong> (Violation) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_violation1_description</td>
            <td>Driver1 Violation1 Description<br>
                <a href="#driver_violation1Description">Appendix : Driver Violation Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_violation1_state</td>
            <td>State in which violation was committed.<br>
                Two captial letters (NY, CA, etc).</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>incident1_type</strong> = <strong>4</strong> (Claim) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_claim1_description</td>
            <td>Driver1 Claim1 Description<br>
                <a href="#driver_claim1Description">Appendix : Driver Claim Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_claim1_paid_amount</td>
            <td>Total claim amount to nearest dollar - no commas, dollar symbol or decimal point</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>


        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3><strong>Driver 1, Incident 2:</strong> If <strong>driver1_num_of_incidents</strong> &gt;= <strong>2</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_incident2_type</td>
            <td>The type of incident to report for driver1.<br>
                1 = Ticket<br>
                2 = Accident<br>
                3 = Violation<br>
                4 = Claim</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_incident2_date</td>
            <td>Date of Driver1 Incident1, in the format YYYY-MM-DD<br>
                <strong style="color:red;">Note: Must be a past date</strong></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver1_incident2_type</strong> = <strong>1</strong> (Ticket) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_ticket2_description</td>
            <td>Driver1 Ticket1 Description<br>
                <a href="#driver_ticket1Description">Appendix : Driver Ticket Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver1_incident2_type</strong> = <strong>2</strong> (Accident) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_accident2_description</td>
            <td>Driver1 Accident1 Description<br>
                <a href="#driver_accident1Description">Appendix : Driver Accident Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_accident2_damage</td>
            <td>What was damaged?<br>
                1 = People<br>
                2 = Property<br>
                3 = Both<br>
                4 = Not Applicable</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_accident2_at_fault</td>
            <td>Was Driver1 at fault?<br>
                0 = No<br>
                1 = Yes</td>
            <!--<td class="txtcenter">0</td>-->
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_accident2_amount</td>
            <td>Total claim amount - no commas or dollar symbol</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver1_incident2_type</strong> = <strong>3</strong> (Violation) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_violation2_description</td>
            <td>Driver1 Violation1 Description<br>
                <a href="#driver_violation1Description">Appendix : Driver Violation Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_violation2_state</td>
            <td>State in which violation was committed.<br>
                Two captial letters (NY, CA, etc).</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver1_incident2_type</strong> = <strong>4</strong> (Claim) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_claim2_description</td>
            <td>Driver1 Claim1 Description<br>
                <a href="#driver_claim1Description">Appendix : Driver Claim Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_claim2_paid_amount</td>
            <td>Total claim amount to nearest dollar - no commas, dollar symbol or decimal point</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>


        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3><strong>Driver 1, Incident 3:</strong> If <strong>driver1_num_of_incidents</strong> &gt;= <strong>3</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_incident3_type</td>
            <td>The type of incident to report for driver1.<br>
                1 = Ticket<br>
                2 = Accident<br>
                3 = Violation<br>
                4 = Claim</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_incident3_date</td>
            <td>Date of Driver1 Incident1, in the format YYYY-MM-DD<br>
                <strong style="color:red;">Note: Must be a past date</strong></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver1_incident3_type</strong> = <strong>1</strong> (Ticket) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_ticket3_description</td>
            <td>Driver1 Ticket1 Description<br>
                <a href="#driver_ticket1Description">Appendix : Driver Ticket Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver1_incident3_type</strong> = <strong>2</strong> (Accident) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_accident3_description</td>
            <td>Driver1 Accident1 Description<br>
                <a href="#driver_accident1Description">Appendix : Driver Accident Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_accident3_damage</td>
            <td>What was damaged?<br>
                1 = People<br>
                2 = Property<br>
                3 = Both<br>
                4 = Not Applicable</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_accident3_at_fault</td>
            <td>Was Driver1 at fault?<br>
                0 = No<br>
                1 = Yes</td>
            <!--<td class="txtcenter">0</td>-->
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_accident3_amount</td>
            <td>Total claim amount - no commas or dollar symbol</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver1_incident3_type</strong> = <strong>3</strong> (Violation) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_violation3_description</td>
            <td>Driver1 Violation1 Description<br>
                <a href="#driver_violation1Description">Appendix : Driver Violation Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_violation3_state</td>
            <td>State in which violation was committed.<br>
                Two captial letters (NY, CA, etc).</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver1_incident3_type</strong> = <strong>4</strong> (Claim) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_claim3_description</td>
            <td>Driver1 Claim1 Description<br>
                <a href="#driver_claim1Description">Appendix : Driver Claim Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_claim3_paid_amount</td>
            <td>Total claim amount to nearest dollar - no commas, dollar symbol or decimal point</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>


        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3><strong>Driver 1, Incident 4:</strong> If <strong>driver1_num_of_incidents</strong> &gt;= <strong>4</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_incident4_type</td>
            <td>The type of incident to report for driver1.<br>
                1 = Ticket<br>
                2 = Accident<br>
                3 = Violation<br>
                4 = Claim</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">incident4_date</td>
            <td>Date of Driver1 Incident1, in the format YYYY-MM-DD<br>
                <strong style="color:red;">Note: Must be a past date</strong></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver1_incident4_type</strong> = <strong>1</strong> (Ticket) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_ticket4_description</td>
            <td>Driver1 Ticket1 Description<br>
                <a href="#driver_ticket1Description">Appendix : Driver Ticket Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver1_incident4_type</strong> = <strong>2</strong> (Accident) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_accident4_description</td>
            <td>Driver1 Accident1 Description<br>
                <a href="#driver_accident1Description">Appendix : Driver Accident Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_accident4_damage</td>
            <td>What was damaged?<br>
                1 = People<br>
                2 = Property<br>
                3 = Both<br>
                4 = Not Applicable</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_accident4_at_fault</td>
            <td>Was Driver1 at fault?<br>
                0 = No<br>
                1 = Yes</td>
            <!--<td class="txtcenter">0</td>-->
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_accident4_amount</td>
            <td>Total claim amount - no commas or dollar symbol</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver1_incident4_type</strong> = <strong>3</strong> (Violation) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_violation4_description</td>
            <td>Driver1 Violation1 Description<br>
                <a href="#driver_violation1Description">Appendix : Driver Violation Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_violation4_state</td>
            <td>State in which violation was committed.<br>
                Two captial letters (NY, CA, etc).</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver1_incident4_type</strong> = <strong>4</strong> (Claim) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_claim4_description</td>
            <td>Driver1 Claim1 Description<br>
                <a href="#driver_claim1Description">Appendix : Driver Claim Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver1_claim4_paid_amount</td>
            <td>Total claim amount to nearest dollar - no commas, dollar symbol or decimal point</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3><strong>Driver 2 Information - This section is Preferred if <strong>maritalStatus</strong> = <strong>2</strong> (Married), skip if not collected</strong></h3></td>
        </tr>
        <tr>
            <td class="mono">driver2_first_name</td>
            <td>Driver2 first name.</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">driver2_last_name</td>
            <td>Driver2 last name.</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">driver2_gender</td>
            <td>Driver2 gender.<br>
                M = Male<br>
                F = Female</td>
            <!--<td class="txtcenter">0</td>-->
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">driver2_dob</td>
            <td>Driver2 date of birth, in the format YYYY-MM-DD</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">driver2_marital_status</td>
            <td>Driver2 marital status.<br>
                1 = Single<br>
                2 = Married<br>
                3 = Separated<br>
                4 = Divorced<br>
                5 = Domestic Partner<br>
                6 = Widowed</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">driver2_education</td>
            <td>Driver2 education level<br>
                <a href="#driver_education">Appendix : Driver Education Level </a></td>
            <!--<td class="txtcenter">123</td>-->
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">driver2_occupation</td>
            <td>Driver2 occupation<br>
                <a href="#driver_occupation">Appendix : Driver Occupation </a></td>
            <!--<td class="txtcenter">123</td>-->
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">driver2_required_SR22</td>
            <td>Driver2 SR22 status.<br>
                0 = SR22 NOT required<br>
                1 = SR22 Required</td>
            <!--<td class="txtcenter">0</td>-->
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>							<tr style="background:#666;">
            <td class="mono" colspan="3"><h3><strong>Driver 2 Tickets, Accidents, Violations and Claims</strong></h3></td>
        </tr>
        <tr>
            <td class="mono">driver2_hasTAVCs</td>
            <td>Does Driver2 have any Tickets, Accidents, Violations or Claims?<br>
                0 = No<br>
                1 = Yes</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver2_hasTAVCs</strong> = <strong>1</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_num_of_incidents</td>
            <td>The number of incidents to report for driver1.<br>
                1 = 1 incident<br>
                2 = 2 incidents<br>
                3 = 3 incidents<br>
                4 = 4 incidents</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3><strong>Driver 2, Incident 1:</strong> If <strong>driver2_num_of_incidents</strong> &gt;= <strong>1</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_incident1_type</td>
            <td>The type of incident to report for driver1.<br>
                1 = Ticket<br>
                2 = Accident<br>
                3 = Violation<br>
                4 = Claim</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_incident1_date</td>
            <td>Date of Driver2 Incident1, in the format YYYY-MM-DD<br>
                <strong style="color:red;">Note: Must be a past date</strong></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver2_incident1_type</strong> = <strong>1</strong> (Ticket) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_ticket1_description</td>
            <td>Driver2 Ticket1 Description<br>
                <a href="#driver_ticket1Description">Appendix : Driver Ticket Description </a></td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver2_incident1_type</strong> = <strong>2</strong> (Accident) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">adriver2_ccident1_description</td>
            <td>Driver2 Accident1 Description<br>
                <a href="#driver_accident1Description">Appendix : Driver Accident Description </a></td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_accident1_damage</td>
            <td>What was damaged?<br>
                1 = People<br>
                2 = Property<br>
                3 = Both<br>
                4 = Not Applicable</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_accident1_at_fault</td>
            <td>Was Driver2 at fault?<br>
                0 = No<br>
                1 = Yes</td>
            <!--<td class="txtcenter">0</td>-->
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_accident1_amount</td>
            <td>Total claim amount - no commas or dollar symbol</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver2_incident1_type</strong> = <strong>3</strong> (Violation) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_violation1_description</td>
            <td>Driver2 Violation1 Description<br>
                <a href="#driver_violation1Description">Appendix : Driver Violation Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_violation1_state</td>
            <td>State in which violation was committed.<br>
                Two captial letters (NY, CA, etc).</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver2_incident1_type</strong> = <strong>4</strong> (Claim) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_claim1_description</td>
            <td>Driver2 Claim1 Description<br>
                <a href="#driver_claim1Description">Appendix : Driver Claim Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_claim1_paid_amount</td>
            <td>Total claim amount to nearest dollar - no commas, dollar symbol or decimal point</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>


        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3><strong>Driver 2, Incident 2:</strong> If <strong>driver2_num_of_incidents</strong> &gt;= <strong>2</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_incident2_type</td>
            <td>The type of incident to report for driver1.<br>
                1 = Ticket<br>
                2 = Accident<br>
                3 = Violation<br>
                4 = Claim</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_incident2_date</td>
            <td>Date of Driver2 Incident1, in the format YYYY-MM-DD<br>
                <strong style="color:red;">Note: Must be a past date</strong></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver2_incident2_type</strong> = <strong>1</strong> (Ticket) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_ticket2_description</td>
            <td>Driver2 Ticket1 Description<br>
                <a href="#driver_ticket1Description">Appendix : Driver Ticket Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver2_incident2_type</strong> = <strong>2</strong> (Accident) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_accident2_description</td>
            <td>Driver2 Accident1 Description<br>
                <a href="#driver_accident1Description">Appendix : Driver Accident Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_accident2_damage</td>
            <td>What was damaged?<br>
                1 = People<br>
                2 = Property<br>
                3 = Both<br>
                4 = Not Applicable</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_accident2_at_fault</td>
            <td>Was Driver2 at fault?<br>
                0 = No<br>
                1 = Yes</td>
            <!--<td class="txtcenter">0</td>-->
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_accident2_amount</td>
            <td>Total claim amount - no commas or dollar symbol</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver2_incident2_type</strong> = <strong>3</strong> (Violation) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_violation2_description</td>
            <td>Driver2 Violation1 Description<br>
                <a href="#driver_violation1Description">Appendix : Driver Violation Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_violation2_state</td>
            <td>State in which violation was committed.<br>
                Two captial letters (NY, CA, etc).</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver2_incident2_type</strong> = <strong>4</strong> (Claim) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_claim2_description</td>
            <td>Driver2 Claim2 Description<br>
                <a href="#driver_claim1Description">Appendix : Driver Claim Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_claim2_paid_amount</td>
            <td>Total claim amount to nearest dollar - no commas, dollar symbol or decimal point</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>


        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3><strong>Driver 2, Incident 3:</strong> If <strong>driver2_num_of_incidents</strong> &gt;= <strong>3</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_incident3_type</td>
            <td>The type of incident to report for driver1.<br>
                1 = Ticket<br>
                2 = Accident<br>
                3 = Violation<br>
                4 = Claim</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_incident3_date</td>
            <td>Date of Driver2 Incident1, in the format YYYY-MM-DD<br>
                <strong style="color:red;">Note: Must be a past date</strong></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver2_incident3_type</strong> = <strong>1</strong> (Ticket) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_ticket3_description</td>
            <td>Driver2 Ticket1 Description<br>
                <a href="#driver_ticket1Description">Appendix : Driver Ticket Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver2_incident3_type</strong> = <strong>2</strong> (Accident) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_accident3_description</td>
            <td>Driver2 Accident1 Description<br>
                <a href="#driver_accident1Description">Appendix : Driver Accident Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_accident3_damage</td>
            <td>What was damaged?<br>
                1 = People<br>
                2 = Property<br>
                3 = Both<br>
                4 = Not Applicable</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_accident3_at_fault</td>
            <td>Was Driver2 at fault?<br>
                0 = No<br>
                1 = Yes</td>
            <!--<td class="txtcenter">0</td>-->
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_accident3_amount</td>
            <td>Total claim amount - no commas or dollar symbol</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver2_incident3_type</strong> = <strong>3</strong> (Violation) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_violation3_description</td>
            <td>Driver2 Violation1 Description<br>
                <a href="#driver_violation1Description">Appendix : Driver Violation Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_violation3_state</td>
            <td>State in which violation was committed.<br>
                Two captial letters (NY, CA, etc).</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver2_incident3_type</strong> = <strong>4</strong> (Claim) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_claim3_description</td>
            <td>Driver2 Claim1 Description<br>
                <a href="#driver_claim1Description">Appendix : Driver Claim Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_claim3_paid_amount</td>
            <td>Total claim amount to nearest dollar - no commas, dollar symbol or decimal point</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>


        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3><strong>Driver 2, Incident 4:</strong> If <strong>driver2_num_of_incidents</strong> &gt;= <strong>4</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_incident4_type</td>
            <td>The type of incident to report for driver1.<br>
                1 = Ticket<br>
                2 = Accident<br>
                3 = Violation<br>
                4 = Claim</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_incident4_date</td>
            <td>Date of Driver2 Incident1, in the format YYYY-MM-DD<br>
                <strong style="color:red;">Note: Must be a past date</strong></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver2_incident4_type</strong> = <strong>1</strong> (Ticket) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_ticket4_description</td>
            <td>Driver2 Ticket1 Description<br>
                <a href="#driver_ticket1Description">Appendix : Driver Ticket Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver2_incident4_type</strong> = <strong>2</strong> (Accident) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_accident4_description</td>
            <td>Driver2 Accident1 Description<br>
                <a href="#driver_accident1Description">Appendix : Driver Accident Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_accident4_damage</td>
            <td>What was damaged?<br>
                1 = People<br>
                2 = Property<br>
                3 = Both<br>
                4 = Not Applicable</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_accident4_at_fault</td>
            <td>Was Driver2 at fault?<br>
                0 = No<br>
                1 = Yes</td>
            <!--<td class="txtcenter">0</td>-->
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_accident4_amount</td>
            <td>Total claim amount - no commas or dollar symbol</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver2_incident4_type</strong> = <strong>3</strong> (Violation) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_violation4_description</td>
            <td>Driver2 Violation1 Description<br>
                <a href="#driver_violation1Description">Appendix : Driver Violation Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_violation4_state</td>
            <td>State in which violation was committed.<br>
                Two captial letters (NY, CA, etc).</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3>If <strong>driver2_incident4_type</strong> = <strong>4</strong> (Claim) then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_claim4_description</td>
            <td>Driver2 Claim1 Description<br>
                <a href="#driver_claim1Description">Appendix : Driver Claim Description </a></td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono">driver2_claim4_paid_amount</td>
            <td>Total claim amount to nearest dollar - no commas, dollar symbol or decimal point</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3><strong>Vehicle 1 Information - You may skip below if not collected, if there is no vehicle1</strong></h3></td>
        </tr><tr>
            <td class="mono">vehicle1_year</td>
            <td>The year of vehicle1.<br>
                From last 30 years, i.e. between 1988 and 2018, inclusive.<br>
                Note that 2019 would be acceptable from August 1st, 2018.</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">vehicle1_make</td>
            <td>The make of vehicle1<br>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">vehicle1_model</td>
            <td>The model of vehicle1<br>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">vehicle1_submodel</td>
            <td>The sub-model (or trim) of vehicle1</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/optional.gif" width="16" height="16" alt="Optional" title="Optional"></td>
        </tr>
        <tr>
            <td class="mono">vehicle1_vin</td>
            <td>The VIN of vehicle1<br>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/preferred.gif" width="16" height="16" alt="Preferred" title="Preferred"></td>
        </tr>

        <tr>
            <td class="mono">vehicle1_primary_use</td>
            <td>The primary use of vehicle1.<br>
                1 = Business<br>
                2 = Commute Work<br>
                3 = Commute School<br>
                4 = Pleasure<br>
                5 = Commute Varies</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr>
            <td class="mono">vehicle1_vehicle_ownership</td>
            <td>Ownership status of vehicle1.<br>
                1 = Owned<br>
                2 = Leased</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">vehicle1_daily_mileage</td>
            <td>Daily commute mileage (one-way) of vehicle1.<br>
                1 = up to 3 miles<br>
                2 = up to 5 miles<br>
                3 = up to 9 miles<br>
                4 = up to 19 miles<br>
                5 = up to 50 miles<br>
                6 = 51+ miles</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">vehicle1_annual_mileage</td>
            <td>Annual Mileage of vehicle1.<br>
                1 = 1 to 5,000 miles<br>
                2 = 5,001 to 7,500 miles<br>
                3 = 7,501 to 10,000 miles<br>
                4 = 10,001 to 12,500 miles<br>
                5 = 12,501 to 15,000 miles<br>
                6 = 15,001 to 18,000 miles<br>
                7 = 18,001 to 25,000 miles<br>
                8 = 25,001 to 50,000 miles<br>
                9 = 50,001+ miles</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#666;">
            <td class="mono" colspan="3"><h3><strong>Vehicle 2 Information - You may skip below if not collected, if there is no vehicle2</strong></h3></td>
        </tr><tr>
            <td class="mono">vehicle2_year</td>
            <td>The year of vehicle2.<br>
                From last 30 years, i.e. between 1988 and 2018, inclusive.<br>
                Note that 2019 would be acceptable from August 1st, 2018.</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">vehicle2_make</td>
            <td>The make of vehicle2<br>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">vehicle2_model</td>
            <td>The model of vehicle2<br>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">vehicle2_submodel</td>
            <td>The sub-model (or trim) of vehicle2</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/optional.gif" width="16" height="16" alt="Optional" title="Optional"></td>
        </tr>
        <tr>
            <td class="mono">vehicle2_vin</td>
            <td>The VIN of vehicle2<br>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/preferred.gif" width="16" height="16" alt="Preferred" title="Preferred"></td>
        </tr>

        <tr>
            <td class="mono">vehicle2_primary_use</td>
            <td>The primary use of vehicle2.<br>
                1 = Business<br>
                2 = Commute Work<br>
                3 = Commute School<br>
                4 = Pleasure<br>
                5 = Commute Varies</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>

        <tr>
            <td class="mono">vehicle2_vehicle_ownership</td>
            <td>Ownership status of vehicle2.<br>
                1 = Owned<br>
                2 = Leased</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">vehicle2_daily_mileage</td>
            <td>Daily commute mileage (one-way) of vehicle2.<br>
                1 = up to 3 miles<br>
                2 = up to 5 miles<br>
                3 = up to 9 miles<br>
                4 = up to 19 miles<br>
                5 = up to 50 miles<br>
                6 = 51+ miles</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">vehicle2_annual_mileage</td>
            <td>Annual Mileage of vehicle2.<br>
                1 = 1 to 5,000 miles<br>
                2 = 5,001 to 7,500 miles<br>
                3 = 7,501 to 10,000 miles<br>
                4 = 10,001 to 12,500 miles<br>
                5 = 12,501 to 15,000 miles<br>
                6 = 15,001 to 18,000 miles<br>
                7 = 18,001 to 25,000 miles<br>
                8 = 25,001 to 50,000 miles<br>
                9 = 50,001+ miles</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
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
    POST URL: https://elitebizpanel.com/autoinsurance/postprocess<br>
    Accept: text/html<br>
    Content-Type: application/x-www-form-urlencoded; charset=utf-8<br>
    <br>
    ping_id=1111&amp;lead_mode=0&amp;promo_code=<?php echo $promo_code; ?>&amp;sub_id=1282&amp;first_name=James&amp;last_name=Doe&amp;gender=M&amp;dob=05/07/1986&amp;email=james.doe@example.com&amp;phone=2124656741&amp;address=4+Pennsylvania+Plaza&amp;zip=12345&amp;city=Schenectady&amp;state=NY&amp;mobile=9724473839&amp;is_rented=rent&amp;stay_in_month=05&amp;stay_in_year=02&amp;home_pay=200&amp;employer=EliteCashWire&amp;job_title=Developer&amp;employment_in_month=01&amp;employment_in_year=01&amp;monthly_income=4000&amp;ssn=324234355&amp;bankruptcy=0&amp;ipaddress=127.0.0.1&amp;cosigner=1&amp;agree_credit_check=1&amp;url=https://eliteinsurers.com

</code>
<h3>Responses</h3>
<p><span class="mono" style="color: #fff; background-color: #444; padding: 3px;">This</span> is exact text that will definitely be present. <span class="mono" style="color: #777; background-color: #444; padding: 3px;">...</span> indicates variable data, and may not be present.</p>
<hr>
<p>Accept : </p>
<pre style="background-color: #444444;color: #FFFFFF;">&lt;?xml version="1.0"?&gt;
&lt;PostResponse&gt;
  &lt;Response&gt;ACCEPTED&lt;/Response&gt;
  &lt;Price&gt;1.00&lt;/Price&gt;
  &lt;URL&gt;https://elitebizpanel.com/autoinsurance/leads/postaccept?affiliate_trans_id=1234&lt;/URL&gt;
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
<table class="data" border="0" cellspacing="0">
    <tbody>
        <tr>
            <td></td>
        </tr>
    </tbody>
</table>
<h2 id="parameter_values">Parameter Values</h2>
<table border="0" cellspacing="0" class="data" id="driver_education">
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
            <td class="mono" valign="top" style="vertical-align: top;">driver_education</td>
            <td style="vertical-align: top;">Education Level</td>
            <td>1 = Less than High School  <br> 2 = Some or No High School  <br> 3 = High School Diploma  <br> 4 = Some College  <br> 5 = Associate Degree  <br> 6 = Bachelors Degree  <br> 7 = Masters Degree  <br> 8 = Doctorate Degree  <br> 9 = Other  <br>       </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required" /></td>
        </tr>
    </tbody>
</table>

<table border="0" cellspacing="0" class="data" id="driver_occupation">
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
            <td class="mono" valign="top" style="vertical-align: top;">driver_occupation</td>
            <td style="vertical-align: top;">Driver Occupation</td>
            <td>1 = Accounts Pay/Rec.  <br> 2 = Actor  <br> 3 = Administration/Management  <br> 4 = Appraiser  <br> 5 = Architect  <br> 6 = Artist  <br> 7 = Assembler  <br> 8 = Auditor  <br> 9 = Baker  <br> 10 = Bank Teller  <br> 11 = Banker  <br> 12 = Bartender  <br> 13 = Broker  <br> 14 = Cashier  <br> 15 = Casino Worker  <br> 16 = CEO  <br> 17 = Certified Public Accountant  <br> 18 = Chemist  <br> 19 = Child Care  <br> 20 = City Worker  <br> 21 = Claims Adjuster  <br> 22 = Clergy  <br> 23 = Clerical/Technical  <br> 24 = College Professor  <br> 25 = Computer Tech  <br> 26 = Construction  <br> 27 = Contractor  <br> 28 = Counselor  <br> 29 = Craftsman/Skilled Worker  <br> 30 = Customer Support Rep  <br> 31 = Custodian  <br> 32 = Dancer  <br> 33 = Decorator  <br> 34 = Delivery Driver  <br> 35 = Dentist  <br> 36 = Director  <br> 37 = Disabled  <br> 38 = Drivers  <br> 39 = Electrician  <br> 40 = Engineer-Aeronautical  <br> 41 = Engineer-Aerospace  <br> 42 = Engineer-Chemical  <br> 43 = Engineer-Civil  <br> 44 = Engineer-Electrical  <br> 45 = Engineer-Gas  <br> 46 = Engineer-Geophysical  <br> 47 = Engineer-Mechanical  <br> 48 = Engineer-Nuclear  <br> 49 = Engineer-Other  <br> 50 = Engineer-Petroleum  <br> 51 = Engineer-Structural  <br> 52 = Entertainer  <br> 53 = Farmer  <br> 54 = Fire Fighter  <br> 55 = Flight Attend.  <br> 56 = Food Service  <br> 57 = Health Care  <br> 58 = Installer  <br> 59 = Instructor  <br> 60 = Journalist  <br> 61 = Journeyman  <br> 62 = LabTech.  <br> 63 = Laborer/Unskilled Worker  <br> 64 = Lawyer  <br> 65 = Machine Operator  <br> 66 = Machinist  <br> 67 = Maintenance  <br> 68 = Manufacturer  <br> 69 = Marketing  <br> 70 = Mechanic  <br> 71 = Model  <br> 72 = Nanny  <br> 73 = Nurse/CNA  <br> 74 = Other  <br> 75 = Painter  <br> 76 = Para-Legal  <br> 77 = Paramedic  <br> 78 = Personal Trainer  <br> 79 = Photographer  <br> 80 = Physician  <br> 81 = Pilot  <br> 82 = Plumber  <br> 83 = Police Officer  <br> 84 = Postal Worker  <br> 85 = Preacher  <br> 86 = Pro Athlete  <br> 87 = Production  <br> 88 = Prof-College Degree  <br> 89 = Prof-Specialty Degree  <br> 90 = Programmer  <br> 91 = Real Estate  <br> 92 = Receptionist  <br> 93 = Reservation Agent  <br> 94 = Restaurant Manager  <br> 95 = Retail  <br> 96 = Roofer  <br> 97 = Sales  <br> 98 = Scientist  <br> 99 = Secretary  <br> 100 = Security  <br> 101 = Social Worker  <br> 102 = Stocker  <br> 103 = Store Owner  <br> 104 = Stylist  <br> 105 = Supervisor  <br> 106 = Teacher  <br> 107 = Teacher - with Credentials  <br> 108 = Technical/Supervisory  <br> 109 = Travel Agent  <br> 110 = Truck Driver  <br> 111 = Vet  <br> 112 = Waitress  <br> 113 = Welder  <br> 114 = Government  <br> 115 = Housewife/Househusband  <br> 116 = Retired  <br> 117 = Student Not Living w/Parents  <br> 118 = Unemployed  <br> 119 = Military E1 - E4  <br> 120 = Military E5 - E7  <br> 121 = Military Officer  <br> 122 = Military Other  <br> 123 = Unknown  <br> 124 = Self Employed  <br> 125 = Student Living w/Parents  <br> </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required" /></td>
        </tr>
    </tbody>
</table>


<table border="0" cellspacing="0" class="data" id="driver_ticket1Description">
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
            <td class="mono" valign="top" style="vertical-align: top;">driver_ticket_description</td>
            <td style="vertical-align: top;">Driver Ticket Description</td>
            <td>1 = Careless driving  <br> 2 = Carpool lane violation  <br> 3 = Child not in car seat  <br> 4 = Defective Equipment  <br> 5 = Defective vehicle (reduced violation)  <br> 6 = Driving too fast for conditions  <br> 7 = Driving without a license  <br> 8 = Excessive noise  <br> 9 = Exhibition driving  <br> 10 = Expired drivers license  <br> 11 = Expired emmissions  <br> 12 = Expired Registration  <br> 13 = Failure to obey traffic signal  <br> 14 = Failure to signal  <br> 15 = Failure to stop  <br> 16 = Failure to yield  <br> 17 = Following too close  <br> 18 = Illegal lane change  <br> 19 = Illegal passing  <br> 20 = Illegal turn  <br> 21 = Illegal turn on red  <br> 22 = Illegal U Turn  <br> 23 = Inattentive driving  <br> 24 = No helmet  <br> 25 = No insurance  <br> 26 = No seatbelt  <br> 27 = Passing a school bus  <br> 28 = Passing in a no-passing zone  <br> 29 = Passing on shoulder  <br> 30 = Ran a red light  <br> 31 = Ran a stop sign  <br> 32 = Wrong way on a one way  <br> 33 = Speeding  <br> 34 = Speeding less than 10 MPH over  <br> 35 = Speeding more than 10 MPH over  <br> 36 = Speeding more than 20 MPH over  <br> 37 = Other Ticket  <br>                 </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required" /></td>
        </tr>
    </tbody>
</table>


<table border="0" cellspacing="0" class="data" id="driver_accident1Description">
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
            <td class="mono" valign="top" style="vertical-align: top;">driver_accident_description</td>
            <td style="vertical-align: top;">Driver Accident Description</td>
            <td>1 = Vehicle Hit Vehicle  <br> 2 = Vehicle Hit Pedestrian  <br> 3 = Vehicle Hit Property  <br> 4 = Vehicle Damaged Avoiding Accident  <br> 5 = Other Vehicle Hit Yours  <br> 6 = Not Listed  <br>                 </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required" /></td>
        </tr>
    </tbody>
</table>


<table border="0" cellspacing="0" class="data" id="driver_violation1Description">
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
            <td class="mono" valign="top" style="vertical-align: top;">driver_violation_description</td>
            <td style="vertical-align: top;">Driver Violation Description</td>
            <td>1 = Driving While Suspended/Revoked  <br> 2 = Drunk Driving - Injury  <br> 3 = Drunk Driving - no Injury  <br> 4 = Hit and Run - Injury  <br> 5 = Hit and Run - no Injury  <br> 6 = Reckless Driving - Injury  <br> 7 = Reckless Driving - no Injury  <br> 8 = Speeding Over 100  <br>                 </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required" /></td>
        </tr>
    </tbody>
</table>


<table border="0" cellspacing="0" class="data" id="driver_claim1Description">
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
            <td class="mono" valign="top" style="vertical-align: top;">driver_claim_description</td>
            <td style="vertical-align: top;">Driver Claim Description</td>
            <td>1 = Act of Nature  <br> 2 = Car fire  <br> 3 = Flood damage  <br> 4 = Hail damage  <br> 5 = Hit an animal  <br> 6 = Theft of stereo  <br> 7 = Theft of vehicle  <br> 8 = Towing service  <br> 9 = Vandalism  <br> 10 = Windshield Replacement  <br> 11 = Other  <br>                 </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required" /></td>
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
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required" /></td>
        </tr>
    </tbody>
</table>
