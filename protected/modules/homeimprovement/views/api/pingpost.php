<?php $promo_code = Yii::app()->user->id; ?>
<h2>Elite homeimprovement Ping Post Specifications</h2>
<br>
<br>
<!-- ======= Ping: ======= -->
<h2>Ping : </h2>
<br>
<br>
<h3>Field names and acceptable values</h3>
<p>The absence of any required field (<img class="inline_icon" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16">) will result in an error. If you don't collect the data needed by a required field, contact us for instructions.</p>
<table border="0" cellspacing="0" class="data">
    <thead>
        <tr>
            <th>Field</th>
            <th>Contents</th>
            <th>Values</th>
            <th class="txtcenter">Required?</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="mono">lead_mode</td>
            <td colspan="2">Determines if the lead should be treated as a test lead or a live lead.<br>
                0 = Test Mode<br>
                1 = Live Mode<br>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">promo_code</td>
            <td colspan="2">https://www.elitehomeimprovers.com Promo Code provided after registration<br>
                Please ensure you are using the correct code, otherwise your leads may be credited to another partner!</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
		<tr>
            <td class="mono">sub_id</td>
            <td colspan="2">Code of your choosing for your own tracking purposes - Ex. 123-ABC</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">datetime_stamp</td>
            <td colspan="2">Original Date/time of the lead submitted by consumer, in format YYYY-MM-DD hh:mm:ss</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">tcpa_optin</td>
            <td colspan="2">Determines whether or not the consumer was presented with, and accepted, unambiguous consent to be contacted via automated telephone systems pursuant to TCPA requirements.<br>
                0 = No<br>
                1 = Yes<br></td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
		<tr>
            <td class="mono">tcpa_text</td>
            <td colspan="2">TCPA Text - first 200 characters of TCPA message presented to user.</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">universal_leadid</td>
            <td colspan="2">36 character unique lead_id - Ex. - 4D1CG7Y3-3E6C-AT96-U88W-J56N7FY881V1</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">ipaddress</td>
            <td colspan="2">Applicants IP address</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">user_agent</td>
            <td colspan="2">The user agent string for the browser used by the applicant when their information was submitted,<br>
                e.g. 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36'</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/preferred.gif" width="16" height="16" alt="Preferred" title="Preferred"></td>
        </tr>
        <tr>
            <td class="mono">vendor_lead_id</td>
            <td colspan="2">Your internal ID for this lead (useful if we need to contact you about a specific lead and when processing returns)</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/preferred.gif" width="16" height="16" alt="Preferred" title="Preferred"></td>
        </tr>
        <tr>
            <td class="mono">url</td>
            <td colspan="2">URL of form where lead was generated</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/preferred.gif" width="16" height="16" alt="Preferred" title="Preferred"></td>
        </tr>
        <tr>
            <td class="mono">zip</td>
            <td colspan="2">Valid 5-digit US Zip Code.<br>
                Can be used when lead_mode=0 in order to influence test results</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono" style="vertical-align: top;">project_type</td>
            <td style="vertical-align: top;">Project Type</td>
            <td>Project Code - see <a href="#project_type">See Current Project Types</a></td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono" style="vertical-align: top;">task</td>
            <td style="vertical-align: top;">Task Description</td>
            <td>Task Code - see <a href="#task_value">See Current Task Values</a></td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/preferred.gif" width="16" height="16" alt="Preferred" title="Preferred"></td>
        </tr>
        <!-- FENCING STARTS HERE -->
        <tr style="background:#666;">
            <td class="mono" colspan="4"><h3><strong>If project_type</strong> = <strong>26 (Fencing)</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">fence_type</td>
            <td style="vertical-align: top;">Type of fence on the propery</td>
            <td>
                1 = Wood<br>
                2 = Metal<br>
                3 = Composite<br>
                4 = Electric<br>
                5 = Other
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <!-- FENCING ENDS HERE -->
        <!-- FLOORING STARTS HERE -->
        <tr style="background:#666;">
            <td class="mono" colspan="4"><h3><strong>If project_type</strong> = <strong>27 (Flooring)</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">flooring_type</td>
            <td style="vertical-align: top;">Type of flooring on the propery</td>
            <td>
                1 = Hardwood<br>
                2 = Vinyl / Linoleum<br>
                3 = Carpet<br>
                4 = Tile / Stone<br>
                5 = Composite<br>
                6 = Laminate
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">room_type</td>
            <td style="vertical-align: top;">Type of room on the propery</td>
            <td>
                1 = Bedroom<br>
                2 = Bathroom<br>
                3 = Basement<br>
                4 = Kitchen
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">number_of_rooms</td>
            <td style="vertical-align: top;">Number of rooms on the propery</td>
            <td>1 or more ex. 2 or 3 or 4 etc.</td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">property_type</td>
            <td style="vertical-align: top;">Property Type.</td>
            <td>
                1 => Single Family<br>
                2 => Multi-Family<br>
                3 => Townhome<br>
                4 => Condominium<br>
                5 => Duplex<br>
                6 => Mobile Home<br>
                7 => Other<br>
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <!-- FLOORING ENDS HERE -->
        <!-- HVAC STARTS HERE -->
        <tr style="background:#666;">
            <td class="mono" colspan="4"><h3><strong>If project_type</strong> = <strong>33 (HVAC)</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">air_type</td>
            <td style="vertical-align: top;">Type of Air</td>
            <td>
                1 = Cooling<br>
                2 = Heating<br>
                3 = Heating and cooling
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">air_sub_type</td>
            <td style="vertical-align: top;">Type of Sub Air</td>
            <td>
                1 = Gas Furnace<br>
                2 = Propane Furnace<br>
                3 = Oil Furnace<br>
                4 = Electric Furnace<br>
                5 = Gas Boiler<br>
                6 = Propane Boiler<br>
                7 = Oil Boiler<br>
                8 = Electric Boiler<br>
                9 = Central Air<br>
                10 = Heat Pump<br>
                11 = Water Heater<br>
                12 = Furnace<br>
                13 = Boiler            
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">number_of_rooms</td>
            <td style="vertical-align: top;">Number of rooms on the propery</td>
            <td>1 or more ex. 2 or 3 or 4 etc.</td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">number_of_floors</td>
            <td style="vertical-align: top;">Number of floors on the propery</td>
            <td>1 or more ex. 2 or 3 or 4 etc.</td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <!-- HVAC ENDS HERE -->
        <!-- PLUMBING ENDS HERE -->
        <tr style="background:#666;">
            <td class="mono" colspan="4"><h3><strong>If project_type</strong> = <strong>40 (Plumbing)</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">plumbing_type</td>
            <td style="vertical-align: top;">Plumbing Type</td>
            <td>
                1=>Drains<br>
                2=>Faucets<br>
                3=>Fixture<br>
                4=>Pipe<br>
                5=>Sprinkler systems<br>
                6=>Septic system<br>
                7=>Water heater<br>
                9=>Sewer main<br>
                10=>Gutters<br>
                11=>Water main<br>
                12=>Plumbing for an addition or remodel<br>
                13=>Other<br>
                14=>Plumbing<br>
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">job_type</td>
            <td style="vertical-align: top;">Type of Job</td>
            <td>
                1 = New <br>
                2 = Repair<br>
                3 = Replace
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <!-- PLUMBING ENDS HERE -->
        <!-- ROOFING STARTS HERE -->
        <tr style="background:#666;">
            <td class="mono" colspan="4"><h3><strong>If project_type</strong> = <strong>42 (ROOFING)</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">property_type</td>
            <td style="vertical-align: top;">Type of Property</td>
            <td>
                1 = New roof for new home<br>
                2 = New roof for an existing home<br>
                3 = Repair<br>
                4 = Shingle over existing roof
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">roofing_type</td>
            <td style="vertical-align: top;">Type of roofing on the propery</td>
            <td>
                1 = Asphalt shingle<br>
                2 = Cedar shake<br>
                3 = Metal<br>
                4 = Tar<br>
                5 = Tile<br>
                6 = Natural slate</td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <!-- ROOFING ENDS HERE -->
        <!-- SIDING STARTS HERE -->
        <tr style="background:#666;">
            <td class="mono" colspan="4"><h3><strong>If project_type</strong> = <strong>43 (SIDING)</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">siding_type</td>
            <td style="vertical-align: top;">Type of Sidings</td>
            <td>
                1 = Vinyl Siding<br>
                2 = Wood / Fiber / Cement Siding<br>
                3 = Stucco Siding<br>
                4 = Unsure/Other
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">job_type</td>
            <td style="vertical-align: top;">Type of Job</td>
            <td>
                1 = New <br>
                2 = Repair<br>
                3 = Replace
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
         <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">number_of_floors</td>
            <td style="vertical-align: top;">Number of floors on the propery</td>
            <td>1 or more ex. 2 or 3 or 4 etc.</td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">property_type</td>
            <td style="vertical-align: top;">Property Type.</td>
            <td>
                1 => Single Family<br>
                2 => Multi-Family<br>
                3 => Townhome<br>
                4 => Condominium<br>
                5 => Duplex<br>
                6 => Mobile Home<br>
                7 => Other<br>
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <!-- SIDING ENDS HERE -->
        <tr style="background:#666;">
            <td class="mono" colspan="4"><h3><strong>If project_type</strong> = <strong>45 (Solar Energy)</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">project_provider</td>
            <td style="vertical-align: top;">Project Provider</td>
            <td>Consumers current electricity providers <a href="#current_provider">See Current Providers</a></td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">monthly_bill</td>
            <td style="vertical-align: top;">Consumers current monthly bills</td>
            <td>
                1 => $0-50 <br>
                2 => $51-100 <br>
                3 => $101-150 <br>
                4 => $151-200 <br>
                5 => $201-300 <br>
                6 => $301-400 <br>
                7 => $401-500 <br>
                8 => $501-600 <br>
                9 => $601-700 <br>
                10 => $701-800 <br>
                11 => $801+
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">property_type</td>
            <td style="vertical-align: top;">Property Type.</td>
            <td>
                1 => Single Family<br>
                2 => Multi-Family<br>
                3 => Townhome<br>
                4 => Condominium<br>
                5 => Duplex<br>
                6 => Mobile Home<br>
                7 => Other<br>
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">roof_type</td>
            <td style="vertical-align: top;">Type of roof on the propery</td>
            <td>
                1 => Unsure/Other<br>
                2 => Clay Or Slate Tile<br>
                3 => Composite Shingle<br>
                4 => Curved Tile - Concrete<br>
                5 => Flat Tile - Concrete<br>
                6 => Flat - Rolled Composite / Tar And Gravel<br>
                7 => Ground Mount<br>
                8 => Membrane Or Foam<br>
                9 => Metal Shingle<br>
                10 => Shake - Wood; Fiber; Plastic<br>
                11 => Sheet Metal<br>
                12 => Standing Seam Metal<br>
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">roof_shade</td>
            <td style="vertical-align: top;">How much shade is typical for this roof?</td>
            <td>
                0 = No Shade<br>
                1 = A Little Shade<br>
                2 = A Lot Of Shade<br>
                3 = Uncertain<br>
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <!-- SOLAR ENERGY ENDS HERE -->
        <!-- WINDOWS STARTS HERE -->
        <tr style="background:#666;">
            <td class="mono" colspan="4"><h3><strong>If project_type</strong> = <strong>52 (Windows)</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">number_of_windows</td>
            <td style="vertical-align: top;">How many widnows on the property?</td>
            <td>
                1 = 1 window<br>
                2 = 2 windows<br>
                3 = 3 to 5 windows<br>
                4 = 6 to 9 windows<br>
                5 = 10+ Windows
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">window_style</td>
            <td style="vertical-align: top;">What type of shade is typical for this roof?</td>
            <td>
                1 = Bay or Bow<br>
                2 = Fixed<br>
                3 = Sliding Glass Window<br>
                4 = Garden window<br>
                5 = Casement<br>
                6 = Sliding Glass Door<br>
                7 = Double Hung<br>
                8 = French Door<br>
                9 = Single Hung<br>
                10 = Awning (hined at the top)<br>
                11 = Unsure
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">window_age</td>
            <td style="vertical-align: top;">How old the windows are?</td>
            <td>
                1 = Less than a year<br>
                2 = 1 to 5 years<br>
                3 = 6+ years
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">window_condition</td>
            <td style="vertical-align: top;">Condition of the windows</td>
            <td>
                1 = Poor<br>
                2 = Average<br>
                3 = Good
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <!-- WINDOWS ENDS HERE -->
        <tr>
            <td class="mono" style="vertical-align: top;">credit_rating</td>
            <td style="vertical-align: top;">The consumers self-assessed credit rating</td>
            <td>
                1 = Excellent<br>
                2 = Good<br>
                3 = Fair<br>
                4 = Poor<br>
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono" style="vertical-align: top;">time_frame</td>
            <td style="vertical-align: top;">Timeframe Code</td>
            <td>
                1 => Timing is Flexible<br>
                2 => 1 to 2 Weeks<br>
                3 => 3 to 4 Weeks<br>
                4 => 5 to 6 Weeks<br>
                5 => 7 to 8 Weeks<br>
                6 => 9 to 12 Weeks<br>
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono" style="vertical-align: top;">home_owner</td>
            <td style="vertical-align: top;">Does consumer own their home?</td>
            <td>
                0 => No<br>
                1 => Yes<br>
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono" style="vertical-align: top;">project_status</td>
            <td style="vertical-align: top;">Project Status Code</td>
            <td>
                1 => Ready to Hire<br>
                2 = Planning and Budgeting<br>
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <!--<tr>
            <td class="mono">loan_amount</td>
            <td>Required Loan Amount, Should not contain [$,commmas or decimals]</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>-->
        <tr>
            <td class="mono" style="vertical-align: top;">comments</td>
            <td style="vertical-align: top;">Any additional information provided by the consumer.</td>
            <td>&nbsp;</td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono" style="vertical-align: top;">trustedformcerturl</td>
            <td style="vertical-align: top;">Trusted form URL.</td>
            <td>&nbsp;</td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
    </tbody>
</table>
<!-- ================ Lead Posting Using CURL Technology ================== -->
<h3>Ping Request Using  HTTP/1.1 POST </h3>
<p>Our testing address is <span class="mono">https://elitebizpanel.com/pingprocess</span>, and our live address is <span class="mono">https://elitebizpanel.com/pingprocess</span>. Please <strong>do not</strong> begin posting to the live address until our tech has manually verified your test data (in addition to our automatic validation process), <em>and</em> we've explicitly notified you that your campaign has been activated within our system. Any leads posted to the live address while your campaign is still in test mode will return an error and neither be counted nor returned.</p>

<h3>Example Request</h3>

<code style="height: 9.5em;">
    PING URL: https://elitebizpanel.com/homeimprovement/pingprocess<br>
    Accept: text/html<br>
    Content-Type: application/x-www-form-urlencoded<br>
    <br>
    <?php $promo_code = isset($promo_code) ? $promo_code : '123'; ?>
	lead_mode=1&promo_code=1&sub_id=123&tcpa_optin=1&tcpa_text=By clicking Get My Quotes, I agree to the Terms of Service and Privacy Policy...... &universal_leadid=B900B2E2-770A-2E4D-007C-07A8488AE963&ipaddress=107.150.30.112&user_agent==Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36&vendor_lead_id=667597661&url=https://elitehomeimprovers.com&zip=22942&project_type=1&task=1_5&project_provider=5&&monthly_bill=5&property_type=&roof_type=2&roof_shade=3&credit_rating=1&time_frame=0&home_owner=1&project_status=1&loan_amount=100000&comments=nocomments
</code>

<h3>Responses</h3>
<p><span class="mono" style="color: #fff; background-color: #444; padding: 3px;">This</span> is exact text that will definitely be present. <span class="mono" style="color: #777; background-color: #444; padding: 3px;">...</span> indicates variable data, and may not be present.</p>

<hr>

<p>Reject:</p>
<pre style="background-color: #444444;color: #FFFFFF;">&lt;?xml version="1.0"?&gt;
&lt;PingResponse&gt;
   &lt;Response&gt;REJECTED&lt;/Response&gt;
   &lt;Reason&gt;No Coverage&lt;/Reason&gt;
&lt;/PingResponse&gt;</pre>

<hr>
<p>Accept:</p>
<pre style="background-color: #444444;color: #FFFFFF;">&lt;?xml version="1.0"?&gt;
&lt;PingResponse&gt;
   &lt;Response&gt;ACCEPTED&lt;/Response&gt;
   &lt;Ping_Id&gt;111111222333&lt;/Ping_Id&gt;
   &lt;Price&gt;21.105&lt;/Price&gt;
&lt;/PingResponse&gt;</pre>

<p>Accept Only for One 2 One Consent Campaign:</p>
<pre style="background-color: #444444;color: #FFFFFF;">&lt;?xml version="1.0"?&gt;
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
<br>
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
            <th>Values</th>
            <th class="txtcenter">Required?</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="mono">ping_id</td>
            <td colspan="2"><span class="mono">Pass ping_id received in ping response</span> <em>&nbsp;&nbsp;</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" alt="Required" title="Required" height="16" width="16"></td>
        </tr>
        <tr>
            <td class="mono">lead_mode</td>
            <td colspan="2">Determines if the lead should be treated as a test lead or a live lead.<br>
                0 = TEST LEAD<br>
                1 = LIVE LEAD<br></td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">promo_code</td>
            <td colspan="2">Elitehomeimprovement Promo Code provided after registration<br>
                Please ensure you are using the correct code, otherwise your leads may be credited to another partner!</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
		<tr>
            <td class="mono">sub_id</td>
            <td colspan="2">Code of your choosing for your own tracking purposes - Ex. 123-ABC</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">datetime_stamp</td>
            <td colspan="2">Original Date/time of the lead submitted by consumer, in format YYYY-MM-DD hh:mm:ss</td>
            <td class="txtcenter"><img class="inline" src="<?php echo Yii::app()->request->baseUrl; ?>/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">tcpa_optin</td>
            <td colspan="2">Determines whether or not the consumer was presented with, and accepted, unambiguous consent to be contacted via automated telephone systems pursuant to TCPA requirements.<br>
                0 = No<br>
                1 = Yes<br></td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">tcpa_text</td>
            <td colspan="2">TCPA Text - first 200 characters of TCPA message presented to user.</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">universal_leadid</td>
            <td colspan="2">36 character unique lead_id - Ex. - 4D1CG7Y3-3E6C-AT96-U88W-J56N7FY881V1</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">ipaddress</td>
            <td colspan="2">Applicants IP address</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">user_agent</td>
            <td colspan="2">The user agent string for the browser used by the applicant when their information was submitted,<br>
                e.g. 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/70.0.3538.77 Safari/537.36'</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/preferred.gif" width="16" height="16" alt="Preferred" title="Preferred"></td>
        </tr>
        <tr>
            <td class="mono">vendor_lead_id</td>
            <td colspan="2">Your internal ID for this lead (useful if we need to contact you about a specific lead and when processing returns)</td>
            
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/preferred.gif" width="16" height="16" alt="Preferred" title="Preferred"></td>
        </tr>
        <tr>
            <td class="mono">url</td>
            <td colspan="2">URL of form where lead was generated</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/preferred.gif" width="16" height="16" alt="Preferred" title="Preferred"></td>
        </tr>

        <tr>
            <td class="mono">first_name</td>
            <td colspan="2">Applicants first name.</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Rreferred" title="Preferred"></td>
        </tr>
        <tr>
            <td class="mono">last_name</td>
            <td colspan="2">Applicants last name.</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Preferred"></td>
        </tr>
        <tr>
            <td class="mono">email</td>
            <td colspan="2">Applicants Email Address.</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Rreferred" title="Preferred"></td>
        </tr>
        <tr>
            <td class="mono">address</td>
            <td colspan="2">Applicants Email Address.</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Rreferred" title="Preferred"></td>
        </tr>
        <tr>
            <td class="mono">zip</td>
            <td colspan="2">Valid 5-digit US Zip Code.<br>
                Can be used when lead_mode=0 in order to influence test results</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">phone</td>
            <td colspan="2">Applicants Primary Phone.</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono">phone2</td>
            <td colspan="2">Applicants Secondary Phone.</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/preferred.gif" width="16" height="16" alt="Preferred" title="Preferred"></td>
        </tr>
        <tr>
            <td class="mono">dob</td>
            <td colspan="2">Applicants date of birth, in the format YYYY-MM-DD</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/preferred.gif" width="16" height="16" alt="Preferred" title="Preferred"></td>
        </tr>
        <tr>
            <td class="mono" style="vertical-align: top;">project_type</td>
            <td style="vertical-align: top;">Project Type</td>
            <td>Project Code - see <a href="#project_type">See Current Project Types</a></td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono" style="vertical-align: top;">task</td>
            <td style="vertical-align: top;">Task Description</td>
            <td>Task Code - see <a href="#task_value">See Current Task Values</a></td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/preferred.gif" width="16" height="16" alt="Preferred" title="Preferred"></td>
        </tr>
        <!-- FENCING STARTS HERE -->
        <tr style="background:#666;">
            <td class="mono" colspan="4"><h3><strong>If project_type</strong> = <strong>26 (Fencing)</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">fence_type</td>
            <td style="vertical-align: top;">Type of fence on the propery</td>
            <td>
                1 = Wood<br>
                2 = Metal<br>
                3 = Composite<br>
                4 = Electric<br>
                5 = Other
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <!-- FENCING ENDS HERE -->
        <!-- FLOORING STARTS HERE -->
        <tr style="background:#666;">
            <td class="mono" colspan="4"><h3><strong>If project_type</strong> = <strong>27 (Flooring)</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">flooring_type</td>
            <td style="vertical-align: top;">Type of flooring on the propery</td>
            <td>
                1 = Hardwood<br>
                2 = Vinyl / Linoleum<br>
                3 = Carpet<br>
                4 = Tile / Stone<br>
                5 = Composite<br>
                6 = Laminate
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">room_type</td>
            <td style="vertical-align: top;">Type of room on the propery</td>
            <td>
                1 = Bedroom<br>
                2 = Bathroom<br>
                3 = Basement<br>
                4 = Kitchen
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">number_of_rooms</td>
            <td style="vertical-align: top;">Number of rooms on the propery</td>
            <td>1 or more ex. 2 or 3 or 4 etc.</td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">property_type</td>
            <td style="vertical-align: top;">Property Type.</td>
            <td>
                1 => Single Family<br>
                2 => Multi-Family<br>
                3 => Townhome<br>
                4 => Condominium<br>
                5 => Duplex<br>
                6 => Mobile Home<br>
                7 => Other<br>
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <!-- FLOORING ENDS HERE -->
        <!-- HVAC STARTS HERE -->
        <tr style="background:#666;">
            <td class="mono" colspan="4"><h3><strong>If project_type</strong> = <strong>33 (HVAC)</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">air_type</td>
            <td style="vertical-align: top;">Type of Air</td>
            <td>
                1 = Cooling<br>
                2 = Heating<br>
                3 = Heating and cooling
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">air_sub_type</td>
            <td style="vertical-align: top;">Type of Sub Air</td>
            <td>
                1 = Gas Furnace<br>
                2 = Propane Furnace<br>
                3 = Oil Furnace<br>
                4 = Electric Furnace<br>
                5 = Gas Boiler<br>
                6 = Propane Boiler<br>
                7 = Oil Boiler<br>
                8 = Electric Boiler<br>
                9 = Central Air<br>
                10 = Heat Pump<br>
                11 = Water Heater<br>
                12 = Furnace<br>
                13 = Boiler            
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">number_of_rooms</td>
            <td style="vertical-align: top;">Number of rooms on the propery</td>
            <td>1 or more ex. 2 or 3 or 4 etc.</td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">number_of_floors</td>
            <td style="vertical-align: top;">Number of floors on the propery</td>
            <td>1 or more ex. 2 or 3 or 4 etc.</td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <!-- HVAC ENDS HERE -->
        <!-- PLUMBING ENDS HERE -->
        <tr style="background:#666;">
            <td class="mono" colspan="4"><h3><strong>If project_type</strong> = <strong>40 (Plumbing)</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">plumbing_type</td>
            <td style="vertical-align: top;">Plumbing Type</td>
            <td>
                1=>Drains<br>
                2=>Faucets<br>
                3=>Fixture<br>
                4=>Pipe<br>
                5=>Sprinkler systems<br>
                6=>Septic system<br>
                7=>Water heater<br>
                9=>Sewer main<br>
                10=>Gutters<br>
                11=>Water main<br>
                12=>Plumbing for an addition or remodel<br>
                13=>Other<br>
                14=>Plumbing<br>
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">job_type</td>
            <td style="vertical-align: top;">Type of Job</td>
            <td>
                1 = New <br>
                2 = Repair<br>
                3 = Replace
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <!-- PLUMBING ENDS HERE -->
        <!-- ROOFING STARTS HERE -->
        <tr style="background:#666;">
            <td class="mono" colspan="4"><h3><strong>If project_type</strong> = <strong>42 (ROOFING)</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">property_type</td>
            <td style="vertical-align: top;">Type of Property</td>
            <td>
                1 = New roof for new home<br>
                2 = New roof for an existing home<br>
                3 = Repair<br>
                4 = Shingle over existing roof
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">roofing_type</td>
            <td style="vertical-align: top;">Type of roofing on the propery</td>
            <td>
                1 = Asphalt shingle<br>
                2 = Cedar shake<br>
                3 = Metal<br>
                4 = Tar<br>
                5 = Tile<br>
                6 = Natural slate</td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <!-- ROOFING ENDS HERE -->
        <!-- SIDING STARTS HERE -->
        <tr style="background:#666;">
            <td class="mono" colspan="4"><h3><strong>If project_type</strong> = <strong>43 (SIDING)</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">siding_type</td>
            <td style="vertical-align: top;">Type of Sidings</td>
            <td>
                1 = Vinyl Siding<br>
                2 = Wood / Fiber / Cement Siding<br>
                3 = Stucco Siding<br>
                4 = Unsure/Other
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">job_type</td>
            <td style="vertical-align: top;">Type of Job</td>
            <td>
                1 = New <br>
                2 = Repair<br>
                3 = Replace
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
         <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">number_of_floors</td>
            <td style="vertical-align: top;">Number of floors on the propery</td>
            <td>1 or more ex. 2 or 3 or 4 etc.</td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">property_type</td>
            <td style="vertical-align: top;">Property Type.</td>
            <td>
                1 => Single Family<br>
                2 => Multi-Family<br>
                3 => Townhome<br>
                4 => Condominium<br>
                5 => Duplex<br>
                6 => Mobile Home<br>
                7 => Other<br>
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <!-- SIDING ENDS HERE -->
        <tr style="background:#666;">
            <td class="mono" colspan="4"><h3><strong>If project_type</strong> = <strong>45 (Solar Energy)</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">project_provider</td>
            <td style="vertical-align: top;">Project Provider</td>
            <td>Consumers current electricity providers <a href="#current_provider">See Current Providers</a></td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">monthly_bill</td>
            <td style="vertical-align: top;">Consumers current monthly bills</td>
            <td>
                1 => $0-50 <br>
                2 => $51-100 <br>
                3 => $101-150 <br>
                4 => $151-200 <br>
                5 => $201-300 <br>
                6 => $301-400 <br>
                7 => $401-500 <br>
                8 => $501-600 <br>
                9 => $601-700 <br>
                10 => $701-800 <br>
                11 => $801+
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">property_type</td>
            <td style="vertical-align: top;">Property Type.</td>
            <td>
                1 => Single Family<br>
                2 => Multi-Family<br>
                3 => Townhome<br>
                4 => Condominium<br>
                5 => Duplex<br>
                6 => Mobile Home<br>
                7 => Other<br>
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">roof_type</td>
            <td style="vertical-align: top;">Type of roof on the propery</td>
            <td>
                1 => Unsure/Other<br>
                2 => Clay Or Slate Tile<br>
                3 => Composite Shingle<br>
                4 => Curved Tile - Concrete<br>
                5 => Flat Tile - Concrete<br>
                6 => Flat - Rolled Composite / Tar And Gravel<br>
                7 => Ground Mount<br>
                8 => Membrane Or Foam<br>
                9 => Metal Shingle<br>
                10 => Shake - Wood; Fiber; Plastic<br>
                11 => Sheet Metal<br>
                12 => Standing Seam Metal<br>
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">roof_shade</td>
            <td style="vertical-align: top;">How much shade is typical for this roof?</td>
            <td>
                0 = No Shade<br>
                1 = A Little Shade<br>
                2 = A Lot Of Shade<br>
                3 = Uncertain<br>
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <!-- SOLAR ENERGY ENDS HERE -->
        <!-- WINDOWS STARTS HERE -->
        <tr style="background:#666;">
            <td class="mono" colspan="4"><h3><strong>If project_type</strong> = <strong>52 (Windows)</strong> then these fields are mandatory</h3></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">number_of_windows</td>
            <td style="vertical-align: top;">How many widnows on the property?</td>
            <td>
                1 = 1 window<br>
                2 = 2 windows<br>
                3 = 3 to 5 windows<br>
                4 = 6 to 9 windows<br>
                5 = 10+ Windows
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">window_style</td>
            <td style="vertical-align: top;">What type of shade is typical for this roof?</td>
            <td>
                1 = Bay or Bow<br>
                2 = Fixed<br>
                3 = Sliding Glass Window<br>
                4 = Garden window<br>
                5 = Casement<br>
                6 = Sliding Glass Door<br>
                7 = Double Hung<br>
                8 = French Door<br>
                9 = Single Hung<br>
                10 = Awning (hined at the top)<br>
                11 = Unsure
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">window_age</td>
            <td style="vertical-align: top;">How old the windows are?</td>
            <td>
                1 = Less than a year<br>
                2 = 1 to 5 years<br>
                3 = 6+ years
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr style="background:#EAF1F3;">
            <td class="mono" style="vertical-align: top;">window_condition</td>
            <td style="vertical-align: top;">Condition of the windows</td>
            <td>
                1 = Poor<br>
                2 = Average<br>
                3 = Good
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <!-- WINDOWS ENDS HERE -->
        <tr>
            <td class="mono" style="vertical-align: top;">credit_rating</td>
            <td style="vertical-align: top;">The consumers self-assessed credit rating</td>
            <td>
                1 = Excellent<br>
                2 = Good<br>
                3 = Fair<br>
                4 = Poor<br>
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono" style="vertical-align: top;">time_frame</td>
            <td style="vertical-align: top;">Timeframe Code</td>
            <td>
                1 => Timing is Flexible<br>
                2 => 1 to 2 Weeks<br>
                3 => 3 to 4 Weeks<br>
                4 => 5 to 6 Weeks<br>
                5 => 7 to 8 Weeks<br>
                6 => 9 to 12 Weeks<br>
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono" style="vertical-align: top;">home_owner</td>
            <td style="vertical-align: top;">Does consumer own their home?</td>
            <td>
                0 => No<br>
                1 => Yes<br>
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono" style="vertical-align: top;">project_status</td>
            <td style="vertical-align: top;">Project Status Code</td>
            <td>
                1 => Ready to Hire<br>
                2 = Planning and Budgeting<br>
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <!--<tr>
            <td class="mono">loan_amount</td>
            <td>Required Loan Amount, Should not contain [$,commmas or decimals]</td>
            <td class="txtcenter"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>-->
        <tr>
            <td class="mono" style="vertical-align: top;">comments</td>
            <td style="vertical-align: top;">Any additional information provided by the consumer.</td>
            <td>&nbsp;</td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr>
            <td class="mono" style="vertical-align: top;">trustedformcerturl</td>
            <td style="vertical-align: top;">Link for trusted form url.</td>
            <td>&nbsp;</td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
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
    POST URL: https://elitebizpanel.com/homeimprovement/pingpostprocess<br>
    Accept: text/html<br>
    Content-Type: application/x-www-form-urlencoded; charset=utf-8<br>
    <br>
    ping_id=1234567&lead_mode=1&promo_code=1&sub_id=123&tcpa_optin=1&tcpa_text=By clicking Get My Quotes, I agree to the Terms of Service and Privacy Policy...... &universal_leadid=B900B2E2-770A-2E4D-007C-07A8488AE963&ipaddress=107.150.30.112&user_agent==Mozilla/5.0 (Windows NT 6.3; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/74.0.3729.131 Safari/537.36&vendor_lead_id=667597661&url=https://elitehomeimprovers.com&first_name=Joe&last_name=Deo&email=joe.deo@example.com&address=4+Pennsylvania+Plaza&phone=6105551212&phone2=7495215689&zip=22942&project_type=1&task=1_5&project_provider=5&&monthly_bill=5&property_type=&roof_type=2&roof_shade=3&credit_rating=1&time_frame=0&home_owner=1&project_status=1&loan_amount=100000&comments=nocomments
</code>
<h3>Responses</h3>
<p><span class="mono" style="color: #fff; background-color: #444; padding: 3px;">This</span> is exact text that will definitely be present. <span class="mono" style="color: #777; background-color: #444; padding: 3px;">...</span> indicates variable data, and may not be present.</p>
<hr>
<p>Accept : </p>
<pre style="background-color: #444444;color: #FFFFFF;">&lt;?xml version="1.0"?&gt;
&lt;PostResponse&gt;
  &lt;Response&gt;ACCEPTED&lt;/Response&gt;
  &lt;Price&gt;1.00&lt;/Price&gt;
  &lt;URL&gt;https://elitebizpanel.com/homeimprovement/leads/postaccept?affiliate_trans_id=1234&lt;/URL&gt;
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
<hr>
<p>PARAMETER VALUES</p>
<table border="0" cellspacing="0" class="data">
    <thead>
        <tr>
            <th>Field</th>
            <th>Contents</th>
            <th>Values Allowed </th>
            <th class="txtcenter">Required?</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td class="mono" id="project_type" style="vertical-align: top;">project_type</td>
            <td style="vertical-align: top;">Project Type</td>
            <td>
                <?php foreach ($projects as $project_id=>$project_type) { ?>
                    <?php echo $project_id .' => '.  $project_type .'</br>';
                } ?>
               </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
        <tr >
            <td class="mono" id="task_value" style="vertical-align: top;">task</td>
            <td style="vertical-align: top;">Task Description</td>
            <td>
                <?php 
                $html ='';
                foreach ($task_details as $project_type => $project_tasks) {
                    $html .= '<div style="border:1px solid #c8d9e9;margin-top:1px;">';
                        $html .= $project_type.' <br>';
                        foreach ($project_tasks as $task) {
                            if($task != ""){
                                $html .= '<div style="margin-left:50px;background-color:yellow">';
                                $html .= $task.'</br>';
                                $html .= '</div>';
                            }
                        }
                        $html .= '</div>';
                } 
                echo $html;
                ?>
            </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/preferred.gif" width="16" height="16" alt="Preferred" title="Preferred"></td>
        </tr>
        <tr>
            <td class="mono" id="current_provider" style="vertical-align: top;">project_provider</td>
            <td style="vertical-align: top;">Project Provider</td>
            <td>
                <?php foreach ($providers as $provider_id=>$provider) { ?>
                    <?php echo $provider_id .' => '.  $provider .'</br>';
                } ?>
               </td>
            <td class="txtcenter" style="vertical-align: top;"><img class="inline" src="//elitebizpanel.com/images/required.gif" width="16" height="16" alt="Required" title="Required"></td>
        </tr>
    </tbody>
</table>