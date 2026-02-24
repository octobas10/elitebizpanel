<html>
    <head>

    </head>
    <body>
        Action : index.php/autoinsurance/pingpostprocess

        <form method="POST" action="/../../index.php/autoinsurance/pingpostprocess" enctype="multipart/form-data" target="_blank">
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
                    <td>zip</td>
                    <td><input type="text" value="10001" name="zip" /></td>
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
                            <option value="1">1</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>first_name</td>
                    <td><input type="text" value="Chris" name="first_name" /></td>
                </tr>
                <tr>
                    <td>last_name</td>
                    <td><input type="text" value="Thomas" name="last_name" /></td>
                </tr>
                <tr>
                    <td>gender</td>
                    <td>
                        <select name="gender">
                            <option value="M">M</option>
                            <option value="F">F</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>dob</td>
                    <td><input type="text" value="1985-01-25" name="dob" placeholder="YYYY-MM-DD" /></td>
                </tr>
                <tr>
                    <td>marital_status</td>
                    <td>
                        <select name="marital_status">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>education</td>
                    <td><input type="text" value="4" name="education" /><input type="hidden" name="driver2_education" value="1" /></td>
                </tr>
                <tr>
                    <td>occupation</td>
                    <td><input type="text" value="Administrator" name="occupation" /></td>
                </tr
                <tr>
                    <td>requiredSR22</td>
                    <td>
                        <select name="required_SR22">
                            <option value="0">0</option>
                            <option selected value="1">1</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td>hasTAVCs</td>
                    <td>
                        <input type="text" name="hasTAVCs" value="1" />
                    </td>
                </tr>
                <tr>
                    <td>vehicle1_year</td>
                    <td>
                        <input type="text" name="vehicle1_year" value="2013" />
                    </td>
                </tr>
                <tr>
                    <td>vehicle1_make</td>
                    <td>
                        <input type="text" name="vehicle1_make" value="ACURA" />
                    </td>
                </tr>
                <tr>
                    <td>vehicle1_model</td>
                    <td>
                        <input type="text" name="vehicle1_model" value="PREMIUM" />
                    </td>
                </tr>
                <tr>
                    <td>vehicle1_vin</td>
                    <td>
                        <input type="text" name="vehicle1_vin" value="8YUBC535*B*******'" />
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
            </table>

            <input type="submit" value="Ping/Post to Elite Auto"> 
            <!--<a target="_blank" href="pingpost_post.php?ssn=">Send Post For this Ping, If you get success response on ping</a>-->
        </form>
        <!--$this->respond($context, 'Rejected'-->


    </body>
</html>
