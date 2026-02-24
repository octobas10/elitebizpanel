<html>
    <head>

    </head>
    <body>
    <?php
        if($_SERVER['HTTP_HOST'] == 'elitebizpanel.com'){
            $link = '';$channel='https';
        }else if($_SERVER['HTTP_HOST'] =='192.168.1.163'){
            $link = '/ElitePanel.com';$channel='http';
        }elseif($_SERVER['HTTP_HOST'] =='staging.axiombpm.com'){
            $link = '/elitepanel.com';$channel='http';
        }else{
            $link = '/ecw/elitebizpanel.com';$channel='http';
        }
        ?>
        Action : <?php echo $channel;?>://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/index.php/autoinsurance/pingpostprocess

        <form method="POST" action="http://<?php echo $_SERVER['HTTP_HOST'] .$link;?>/index.php/autoinsurance/pingpostprocess" enctype="multipart/form-data" target="_blank">
            <input type="submit" name="submit" value="Ping/Post to Elite Auto Insurance"> 
            <b>Please use this simulation to test any lender Post/Ping by giving your onw values.</b><br>
            <table>
				<tr>
                    <td>ping_id</td>
                    <td><input type="text" value="" name="ping_id" /></td>
                </tr>
                <tr>
                    <td>lead_mode</td>
                    <td>
                        <select name="lead_mode">
                            <option value="0">Test Lead</option>
                            <option selected value="1">Live Lead</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>lender</td>
                    <td><input type="text" value="Sunshine" name="lender" /></td>
                </tr>
                <tr>
                    <td>ipaddress</td>
                    <td><input type="text" value="74.205.70.188" name="ipaddress" /></td>
                </tr>
                <tr>
                    <td>promo_code</td>
                    <td><input type="text" value="1" name="promo_code" /></td>
                </tr>
                <tr>
                    <td>sub_id</td>
                    <td><input type="text" value="123" name="sub_id" /></td>
                </tr>
				<tr>
                    <td>tcpa_optin</td>
                    <td><input type="text" value="1" name="tcpa_optin" /></td>
                </tr>
				<tr>
                    <td>tcpa_text</td>
                    <td><input type="text" value="By submitting this form...." name="tcpa_text" /></td>
                </tr>
				<tr>
                    <td>universal_leadid</td>
                    <td><input type="text" value="4D1CG7Y3-3E6C-AT96-U88W-J56N7FY881V1" name="universal_leadid" /></td>
                </tr>
                <tr>
                    <td>trustedformcerturl</td>
                    <td><input type="text" value="https://cert.trustedform.com/e1f90db30e5233566b2b6329c784ab1ed71adf20" name="trustedformcerturl" /></td>
                </tr>
                <tr>
                    <td>zip</td>
                    <td><input type="text" value="90100" name="zip" /></td>
                </tr>
                <tr>
                    <td>email</td>
                    <td><input type="text" value="tonyd@elitecashwire.com" name="email" /></td>
                </tr>
                <tr>
                    <td>address</td>
                    <td><input type="text" value="1239 avenue road" name="address" /></td>
                </tr>
                <tr>
                    <td>phone</td>
                    <td><input type="text" value="7123981233" name="phone" /></td>
                </tr>
                <tr>
                    <td>mobile</td>
                    <td><input type="text" value="5046287320" name="mobile" /></td>
                </tr>
                <tr>
                    <td>sub_id2</td>
                    <td><input type="text" value="ABC" name="sub_id2" /></td>
                </tr>
                <tr>
                    <td>is_rented</td>
                    <td>
                        <select name="is_rented">
                            <option value="rent">rent</option>
                            <option value="own">own</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>stay_in_year</td>
                    <td>
                        <select name="stay_in_year">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>stay_in_month</td>
                    <td>
                        <select name="stay_in_month">
                            <option value="0">0</option>
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="10">10</option>
                            <option value="11">11</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>credit_rating</td>
                    <td>
                        <select name="credit_rating">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>bankruptcy</td>
                    <td>
                        <select name="bankruptcy">
                            <option value="0">0</option>
                            <option value="1">1</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>coverage_type</td>
                    <td>
                        <select name="coverage_type">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </td>
                <tr>
                    <td>vehicle_deductibles</td>
                    <td>
                        <select name="vehicle_deductibles">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>vehicle_collision_deductibles</td>
                    <td>
                        <select name="vehicle_collision_deductibles">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>medical_pay</td>
                    <td>
                        <select name="medical_pay">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>insurance_policy</td>
                    <td>
                        <select name="insurance_policy">
                            <option value="0">0</option>
                            <option selected="selected" value="1">1</option>
                        </select>
                    </td>
                </tr>
				<tr>
                    <td>first_name</td>
                    <td><input type="text" value="Chris" name="driver1_first_name" /></td>
                </tr>
                <tr>
                    <td>last_name</td>
                    <td><input type="text" value="Thomas" name="driver1_last_name" /></td>
                </tr>          
                <tr>
                    <td>gender</td>
                    <td>
                        <select name="driver1_gender">
                            <option value="M">M</option>
                            <option value="F">F</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>driver1_dob</td>
                    <td><input type="text" value="1970-10-10" name="driver1_dob" placeholder="YYYY-MM-DD" /></td>
                </tr>
                <tr>
                    <td>marital_status</td>
                    <td>
                        <select name="driver1_marital_status">
                            <option value="1">1</option>
                            <option selected value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>education</td>
                    <td><input type="text" value="3" name="driver1_education" /></td>
                </tr>
                <tr>
                    <td>occupation</td>
                    <td><input type="text" value="40" name="driver1_occupation" /></td>
                </tr>
                <tr>
                    <td>requiredSR22</td>
                    <td>
                        <select name="driver1_required_SR22">
                            <option value="0">0</option>
                            <option selected value="1">1</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>hasTAVCs</td>
                    <td>
                        <input type="text" name="driver1_hasTAVCs" value="1" />
                    </td>
                </tr>

                <tr>
                    <td>driver1_num_of_incidents</td>
                    <td>
                        <input type="text" name="driver1_num_of_incidents" value="2" />
                    </td>
                </tr>

                <tr>
                    <td>driver1_incident1_type</td>
                    <td>
                        <input type="text" name="driver1_incident1_type" value="1" />
                    </td>
                </tr>
                <tr>
                    <td>driver1_incident1_date</td>
                    <td>
                        <input type="text" name="driver1_incident1_date" value="<?php echo date('Y-m-d')?>" />
                    </td>
                </tr>
                <tr>
                    <td>driver1_ticket1_description</td>
                    <td>
                        <input type="text" name="driver1_ticket1_description" value="1" />
                    </td>
                </tr>
                <tr>
                    <td>driver1_incident1_date</td>
                    <td>
                        <input type="text" name="driver1_incident1_date" value="<?= date('Y-m-d',time()-(86400-30)) ?>" />
                    </td>
                </tr>

                <tr>
                    <td>driver1_accident1_at_fault</td>
                    <td>
                        <input type="text" name="driver1_accident1_at_fault" value="1" />
                    </td>
                </tr>
                
                <tr>
                    <td>driver1_accident1_damage</td>
                    <td>
                        <input type="text" name="driver1_accident1_damage" value="1" />
                    </td>
                </tr>
                <tr>
                    <td>driver1_accident1_amount</td>
                    <td>
                        <input type="text" name="driver1_accident1_amount" value="25000" />
                    </td>
                </tr>
                <tr>
                    <td>driver1_accident1_description</td>
                    <td>
                        <input type="text" name="driver1_accident1_description" value="1" />
                    </td>
                </tr>
                <tr>
                    <td>driver1_claim1_description</td>
                    <td>
                        <input type="text" name="driver1_claim1_description" value="1" />
                    </td>
                </tr>
                <tr>
                    <td>driver1_claim1_paid_amount</td>
                    <td>
                        <input type="text" name="driver1_claim1_paid_amount" value="15000" />
                    </td>
                </tr>
                <tr>
                    <td>driver1_occupation</td>
                    <td>
                        <input type="text" name="driver1_occupation" value="9" />
                    </td>
                </tr>

                <tr>
                    <td>driver1_incident2_type</td>
                    <td>
                        <input type="text" name="driver1_incident2_type" value="1" />
                    </td>
                </tr>
                <tr>
                    <td>driver1_incident2_date</td>
                    <td>
                        <input type="text" name="driver1_incident2_date" value="<?php echo date('Y-m-d')?>" />
                    </td>
                </tr>
                <tr>
                    <td>driver1_ticket2_description</td>
                    <td>
                        <input type="text" name="driver1_ticket2_description" value="5" />
                    </td>
                </tr>
                 <tr>
                    <td>driver2_claim1_description</td>
                    <td>
                        <input type="text" name="driver2_claim1_description" value="2" />
                    </td>
                </tr>
                <tr>
                    <td>driver2_claim1_paid_amount</td>
                    <td>
                        <input type="text" name="driver2_claim1_paid_amount" value="17000" />
                    </td>
                </tr>
                <!-- driver 2 -->
                <tr>
                    <td>first_name</td>
                    <td><input type="text" value="Vic" name="driver2_first_name" /></td>
                </tr>
                <tr>
                    <td>last_name</td>
                    <td><input type="text" value="Daniel" name="driver2_last_name" /></td>
                </tr>
                <tr>
                    <td>gender</td>
                    <td>
                        <select name="driver2_gender">
                            <option value="M">M</option>
                            <option selected value="F">F</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>driver2_dob</td>
                    <td><input type="text" value="1986-02-03" name="driver2_dob" placeholder="YYYY-MM-DD" /></td>
                </tr>
                <tr>
                    <td>marital_status</td>
                    <td>
                        <select name="driver2_marital_status">
                            <option value="1">1</option>
                            <option selected value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>education</td>
                    <td><input type="text" value="5" name="driver2_education" /></td>
                </tr>
                <tr>
                    <td>occupation</td>
                    <td><input type="text" value="51" name="driver2_occupation" /></td>
                </tr>






                <tr>
                    <td>requiredSR22</td>
                    <td>
                        <select name="driver2_required_SR22">
                            <option value="0">0</option>
                            <option selected value="1">1</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>hasTAVCs</td>
                    <td>
                        <input type="text" name="driver2_hasTAVCs" value="1" />
                    </td>
                </tr>
                <tr>
                    <td>driver2_num_of_incidents</td>
                    <td>
                        <input type="text" name="driver2_num_of_incidents" value="1" />
                    </td>
                </tr>
                <tr>
                    <td>driver2_incident1_type</td>
                    <td>
                        <input type="text" name="driver2_incident1_type" value="1" />
                    </td>
                </tr>
                <tr>
                    <td>driver2_incident1_date</td>
                    <td>
                        <input type="text" name="driver2_incident1_date" value="<?php echo date('Y-m-d')?>" />
                    </td>
                </tr>
                <tr>
                    <td>driver2_ticket1_description</td>
                    <td>
                        <input type="text" name="driver2_ticket1_description" value="4" />
                    </td>
                </tr>
                <tr>
                    <td>driver2_occupation</td>
                    <td>
                        <input type="text" name="driver2_occupation" value="9" />
                    </td>
                </tr>
                <!-- driver 2 -->
                <tr>
                    <td>vehicle1_year</td>
                    <td>
                        <input type="text" name="vehicle1_year" value="2018" />
                    </td>
                </tr>
                <tr>
                    <td>vehicle1_make</td>
                    <td>
                        <input type="text" name="vehicle1_make" value="Audi" />
                    </td>
                </tr>
                <tr>
                    <td>vehicle1_model</td>
                    <td>
                        <input type="text" name="vehicle1_model" value="A4" />
                    </td>
                </tr>
                <tr>
                    <td>vehicle1_vin</td>
                    <td>
                        <input type="text" name="vehicle1_vin" value="8YUBC535*B*******" />
                    </td>
                </tr>
                <tr>
                    <td>vehicle1_submodel</td>
                    <td>
                        <input type="text" name="vehicle1_submodel" value="3.2 Sedan" />
                    </td>
                </tr>
                <tr>
                    <td>vehicle1_primary_use</td>
                    <td>
                        <input type="text" name="vehicle1_primary_use" value="3" />
                    </td>
                </tr>
                <tr>
                    <td>vehicle1_vehicle_ownership</td>
                    <td>
                        <input type="text" name="vehicle1_vehicle_ownership" value="2" />
                    </td>
                </tr>
                <tr>
                    <td>vehicle1_daily_mileage</td>
                    <td>
                        <input type="text" name="vehicle1_daily_mileage" value="4" />
                    </td>
                </tr>
                <tr>
                    <td>vehicle1_annual_mileage</td>
                    <td>
                        <input type="text" name="vehicle1_annual_mileage" value="2" />
                    </td>
                </tr>
                <!-- vehical 2 -->
                <tr>
                    <td>vehicle2_year</td>
                    <td>
                        <input type="text" name="vehicle2_year" value="2019" />
                    </td>
                </tr>
                <tr>
                    <td>vehicle2_make</td>
                    <td>
                        <input type="text" name="vehicle2_make" value="Acura" />
                    </td>
                </tr>
                <tr>
                    <td>vehicle2_model</td>
                    <td>
                        <input type="text" name="vehicle2_model" value="MDX" />
                    </td>
                </tr>
                <tr>
                    <td>vehicle2_vin</td>
                    <td>
                        <input type="text" name="vehicle2_vin" value="9YDJH32D*B*******" />
                    </td>
                </tr>
                <tr>
                    <td>vehicle2_submodel</td>
                    <td>
                        <input type="text" name="vehicle2_submodel" value="4.5 Non Sedan" />
                    </td>
                </tr>
                <tr>
                    <td>vehicle2_primary_use</td>
                    <td>
                        <input type="text" name="vehicle2_primary_use" value="2" />
                    </td>
                </tr>
                <tr>
                    <td>vehicle2_vehicle_ownership</td>
                    <td>
                        <input type="text" name="vehicle2_vehicle_ownership" value="2" />
                    </td>
                </tr>
                <tr>
                    <td>vehicle2_daily_mileage</td>
                    <td>
                        <input type="text" name="vehicle2_daily_mileage" value="4" />
                    </td>
                </tr>
                <tr>
                    <td>vehicle2_annual_mileage</td>
                    <td>
                        <input type="text" name="vehicle2_annual_mileage" value="2" />
                    </td>
                </tr>
                <!-- vehical 2 -->
                <tr>
                    <td>insurance_company</td>
                    <td>
                        <input type="text" name="insurance_company" value="40" />
                    </td>
                </tr>
                <tr>
                    <td>insurance_start_date</td>
                    <td>
                        <input type="text" name="insurance_start_date" value="2017-01-10" />
                    </td>
                </tr>
                <tr>
                    <td>insurance_expiration_date</td>
                    <td>
                        <input type="text" name="insurance_expiration_date" value="2020-12-31" />
                    </td>
                </tr>
                 <tr>
                    <td>continuously_insured_period</td>
                    <td>
                        <input type="text" name="continuously_insured_period" value="2" />
                    </td>
                </tr>
            </table>
            <input type="submit" value="Ping/Post to Elite Auto Insurance"> 
        </form>
        <!--$this->respond($context, 'Rejected'-->
    </body>
</html>
