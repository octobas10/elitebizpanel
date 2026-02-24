<?php
$host = 'localhost';
if ($_SERVER['REMOTE_ADDR'] == '::1') {
    $user = 'root';
    $pass = '12345678';
} else {
    $user = 'axiom';
    $pass = '7anAZewE';
}
//DELETE FROM `edu_zipcodes` WHERE id>390548;
$db = 'eliteedu';
ini_set('memory_limit', '1000M');
ini_set("max_execution_time", "30000");
$link = @mysqli_connect($host, $user, $pass, $db) or die("Can not connect." . mysqli_error());

$Postal_BC = ['V2V', 'V2W', 'V4S', 'V3G', 'V2S', 'V2T', 'V4X', 'V4W', 'V2P', 'V0M', 'V2R', 'V4Z', 'V2L', 'V3L', 'V5C', 'V5A', 'V5B', 'V5E', 'V5M', 'V5G', 'V3N', 'V5H', 'V5J', 'V5R', 'V3M', 'V5W', 'V5K', 'V5P', 'V5T', 'V5Y', 'V5S', 'V6A', 'V5V', 'V5N', 'V5L', 'V3H', 'V3B', 'V3C', 'V3J', 'V3K', 'V4R', 'V3Y', 'V3E', 'V6V', 'V4G', 'V5X', 'V6P', 'V5S', 'V6N', 'V6X', 'V6W', 'V6Y', 'V7C', 'V4K', 'V7A', 'V7E', 'V4L', 'V4M', 'V3V', 'V3R', 'V1M', 'V3W', 'V4N', 'V2Y', 'V2Z', 'V3A', 'V4C', 'V4E', 'V3X', 'V4B', 'V4A', 'V4P', 'V3T', 'V3Z', 'V3S', 'V7V', 'V6K', 'V7L', 'V7G', 'V7P', 'V6A', 'V6R', 'V6S', 'V7T', 'V7N', 'V6T', 'V6B', 'V5L', 'V6C', 'V6E', 'V6G', 'V6Z', 'V5Z', 'V6H', 'V6J', 'V6M', 'V5N', 'V5V', 'V6L', 'V7X', 'V7Y', 'V5Y', 'V5T'];
$Postal_AB = ['T5H', 'T5J', 'T5K', 'T5N', 'T6A', 'T6C', 'T6G', 'T6P', 'T8B', 'T8E', 'T8H', 'T6T', 'T6E', 'T6H', 'T8A', 'T8C', 'T8G', 'T9C', 'T0G', 'T5A', 'T5C', 'T5E', 'T5L', 'T5W', 'T5X', 'T5Y', 'T5Z', 'T6V', 'T8N', 'T8R', 'T8T', 'T0A', 'T5G', 'T5B', 'T6S', 'T8L', 'T5M', 'T6J', 'T6K', 'T6L', 'T6N', 'T6R', 'T6W', 'T6X', 'T4X', 'T0C', 'T9E', 'T7Y', 'T6B', 'T9A', 'T4V', 'T9G', 'T5P', 'T5S', 'T5T', 'T0E', 'T7P', 'T7Z', 'T7X', 'T6M', 'T5R', 'T5V', 'T0B', 'T9M', 'T9N', 'T9V', 'T9W', 'T9X', 'S9V', 'S0M', ' T1L', 'T1W', 'T2G', 'T2L', 'T2N', 'T2R', 'T2S', 'T2T', 'T3B', 'T3C', 'T3G', 'T3H', 'T2M', 'T2K', 'T3Z', 'T4A', 'T1P', 'T1S', 'T3R', 'T1X', 'T2P', 'T4C', 'T3L', 'T1V', 'T0J', 'T0M', 'T1A', 'T1B', 'T1C', 'T1R', 'T1Y', 'T1Z', 'T2A', 'T2B', 'T2C', 'T2E', 'T3A', 'T3J', 'T3K', 'T3N', 'T3P', 'T4B', 'T2J', 'T2X', 'T2Y', 'T2Z', 'T3M', 'T3S', 'T2W', 'T3E', 'T2V', 'T2H', 'T4E', 'T4N', 'T4P', 'T4R', 'T4S', 'T4H', 'T4J', 'T4G', 'T4L', 'T4M', 'T4T', 'T0K', 'T0L', 'T1G', 'T1H', 'T1J', 'T1K', 'T1M'];
$Postal_MB = ['R0A', 'R0C', 'R0E', 'R0G', 'R0H', 'R1A', 'R1B', 'R1N', 'R2C', 'R2E', 'R2G', 'R2H', 'R2J', 'R2K', 'R2L', 'R2M', 'R2N', 'R2P', 'R2R', 'R2V', 'R2W', 'R2X', 'R2Y', 'R3A', 'R3B', 'R3C', 'R3E', 'R3G', 'R3H', 'R3J', 'R3K', 'R3L', 'R3M', 'R3N', 'R3P', 'R3R', 'R3S', 'R3T', 'R3V', 'R3W', 'R3X', 'R3Y', 'R4A', 'R4G', 'R4H', 'R4J', 'R4K', 'R4L', 'R5A', 'R5G', 'R5H', 'R1C'];
$Postal_ON = ['L7A', 'L6Z', 'L6R', 'L6P', 'L6X', 'L6V', 'L6S', 'L6Y', 'L6W', 'L6T', 'M9V', 'M9W', 'L4H', 'L4L', 'L7G', 'L9R', 'L0N', 'L0P', 'L4T', 'L4V', 'L4W', 'L4X', 'L4Y', 'L4Z', 'L5A', 'L5B', 'L5C', 'L5E', 'L5G', 'L5H', 'L5J', 'L5K', 'L5L', 'L5M', 'L5N', 'L5P', 'L5R', 'L5S', 'L5T', 'L5V', 'L5W', 'L6H', 'L6J', 'L6K', 'L6L', 'L6M', 'L7C', 'L7E', 'L9V', 'L9W', 'M8W', 'M8Z', 'M9B', 'M9C', 'L9T', 'L7L', 'L7M', 'L7N', 'L7P', 'L7R', 'L7S', 'L7T', 'M9L', 'M9N', 'M9P', 'M9A', 'M8Y', 'M9M', 'L0G', 'L0J', 'L7J', 'L7K', 'M6E', 'M6H', 'M6K', 'M6M', 'M6N', 'M6P', 'M6R', 'M7Y', 'M8V', 'M8X', 'M9R', 'M6S', 'L0L', 'L4J', 'L4N', 'L6A', 'L7B', 'M2K', 'M2L', 'M2M', 'M2N', 'M2P', 'M2R', 'M3H', 'M3J', 'M3K', 'M3M', 'L4G', 'L4E', 'L4S', 'L4C', 'L3T', 'M2H', 'M2J', 'L4B', 'M5M', 'M3B', 'M3C', 'M3L', 'M3N', 'M4G', 'M4H', 'M4N', 'M4P', 'M4R', 'M4S', 'M4T', 'M4V', 'M4W', 'M4X', 'M4Y', 'M5A', 'M5B', 'M5C', 'M5E', 'M5G', 'M5H', 'M5J', 'M5K', 'M5L', 'M5N', 'M5P', 'M5R', 'M5S', 'M5T', 'M5V', 'M5W', 'M5X', 'M6A', 'M6B', 'M6C', 'M6G', 'M6J', 'M6L', 'M7A', 'M4J', 'M4K', 'M4L', 'M4M', 'L3X', 'L3Y', 'L3Z', 'L4K', 'L9N', 'L9S', 'L3P', 'L3R', 'L3S', 'L6C', 'L6E', 'L6G', 'M1B', 'M1C', 'M1E', 'M1G', 'M1H', 'M1J', 'M1K', 'M1P', 'M1R', 'M1S', 'M1T', 'M1V', 'M1W', 'M1X', 'M3A', 'M4A', 'L0B', 'L0C', 'L0E', 'L0H', 'L6B', 'L1G', 'L1H', 'L1J', 'L1K', 'L1L', 'L1M', 'L1N', 'L1P', 'L1R', 'L1S', 'L1V', 'L1W', 'L1X', 'L1Y', 'M1L', 'M1M', 'M1N', 'M4B', 'M4E', 'M4C', 'L4P', 'L4A', 'L1B', 'L1C', 'L1E', 'L1T', 'L1Z', 'L9L', 'L9P'];
$Postal_QC = ['H3L', 'H3M', 'H7C', 'H7E', 'H7G', 'H7H', 'H7J', 'H7K', 'H7L', 'H7M', 'H7N', 'H7P', 'H7R', 'H7S', 'H7T', 'H7V', 'H7W', 'H7X', 'H7Y', 'J0N', 'J0R', 'J5J', 'J5K', 'J5L', 'J6X', 'J6Y', 'J6Z', 'J7A', 'J7B', 'J7C', 'J7E', 'J7G', 'J7H', 'J7J', 'J7M', 'J7N', 'J7P', 'J7R', 'J7Y', 'J7Z', 'J8A', 'J8B', 'J8G', 'J8H', 'H2B', 'H2C', 'H4J', 'H4K', 'J5M', 'J6E', 'J7K', 'J7X', 'J0P', 'J0S', 'J6T', 'J6S', 'J7T', 'J7V', 'J7W', 'J0H', 'J2N', 'J2R', 'J2S', 'J2T', 'J2W', 'J2X', 'J2Y', 'J3A', 'J3B', 'J3E', 'J3G', 'J3H', 'J3L', 'J3M', 'J3N', 'J3V', 'J3Y', 'J3Z', 'J4B', 'J4G', 'J4H', 'J4J', 'J4K', 'J4L', 'J4M', 'J4N', 'J4P', 'J4R', 'J4S', 'J4T', 'J4V', 'J4W', 'J4X', 'J4Y', 'J4Z', 'J5R', 'J3P', 'J3R', 'J0L', 'J3X', 'J6N', 'J5C', 'J5B', 'J5A', 'J6R', 'J6J', 'J6K', 'H2A', 'H2E', 'H2G', 'H2H', 'H2J', 'H2K', 'H2L', 'H2M', 'H2N', 'H2P', 'H2R', 'H2S', 'H2T', 'H2V', 'H2W', 'H2X', 'H2Y', 'H2Z', 'H3A', 'H3B', 'H3C', 'H3E', 'H3G', 'H3H', 'H3J', 'H3K', 'H3N', 'H3P', 'H3R', 'H3S', 'H3T', 'H3V', 'H3W', 'H3X', 'H3Y', 'H3Z', 'H4A', 'H4B', 'H4C', 'H4E', 'H4G', 'H4H', 'H4L', 'H4N', 'H4P', 'H4V', 'H5A', 'H5B', 'H8N', 'H8P', 'H8R', 'H1Z', 'H1V', 'H1W', 'H1X', 'H1Y', 'H4X', 'J0J', 'J0E', 'J2G', 'J2H', 'J2M', 'J2J', 'J2K', 'J2L', 'H4Z', 'H4S', 'H4Y', 'H8T', 'H8Y', 'H8Z', 'H9A', 'H9B', 'H9C', 'H9E', 'H9G', 'H9H', 'H9J', 'H9K', 'H9P', 'H9R', 'H9S', 'H9W', 'H9X', 'H4M', 'H4R', 'H4T', 'H4W', 'H8S', 'H1A', 'H1B', 'H1C', 'H1E', 'H1J', 'H1K', 'H1L', 'H1M', 'H1P', 'J5W', 'J5X', 'J5Z', 'J6A', 'H7A', 'H7B', 'J0G', 'J0K', 'J5T', 'J6V', 'J6W', 'J7L', 'H1R', 'H1S', 'H1N', 'H1G', 'H1T', 'J5Y', 'H1H'];
/* 
$Program_AB = [1022, 38376, 37499, 1010, 41261, 41437, 41171, 41182];
$Program_BC = [1017, 41436, 37253, 40245, 998, 41428];
$Program_MB = [41513, 41508, 41510, 41509, 41422, 989, 41511];
$Program_ON = [41440, 41461, 41528, 1060, 41429, 41165, 41468, 41480];
$Program_QC = [41267, 41371, 41307, 41363, 41369, 1043, 41278]; */

$Program_AB = [38376, 37499, 1010, 41261, 41437, 41171, 41182];
$Program_BC = [41436, 37253, 40245, 998, 41428];
$Program_MB = [41508, 41510, 41509, 41422, 989, 41511];
$Program_ON = [41461, 41528, 1060, 41429, 41165, 41468, 41480];
$Program_QC = [41371, 41307, 41363, 41369, 1043, 41278];

$state_code = ['AB', 'BC', 'ON', 'MB', 'QC'];

$lender_id = '29';
$sql = "UPDATE edu_zipcodes SET status=0 WHERE lender_id=$lender_id";
mysqli_query($link, $sql);
// GET ALL CAMPUSES
foreach ($state_code as $state) {
    $postal_codes = "Postal_$state";
    $program_codes = "Program_$state";
    // GET FULL LIST OF ZIPCODES
    $three_zipcode = "'" . implode("','", $$postal_codes) . "'";
    //$sql_zipcodes = 'SELECT DISTINCT zipcode,city,state,lat,lng FROM zipcodes WHERE state="' . $state . '" AND LEFT(zipcode, 3) IN (' . $three_zipcode . ')';
    $sql_zipcodes = "SELECT t.* FROM zipcodes t INNER JOIN ( SELECT LEFT(zipcode, 3) AS zip3, MIN(id) AS min_id
    FROM zipcodes WHERE state='" . $state . "' AND LEFT(zipcode, 3) IN (" . $three_zipcode . ")
    GROUP BY LEFT(zipcode, 3)) x ON t.id = x.min_id";
    $resultz = mysqli_query($link, $sql_zipcodes);
    if (mysqli_num_rows($resultz) > 0) {
        while ($row = mysqli_fetch_assoc($resultz)) {
            $full_zipcode_list[] = $row;
        }
    }
    $post_code = array_column($full_zipcode_list, 'zipcode');
    $post_codes = "'" . implode("','", $post_code) . "'";

    foreach ($$program_codes as $program_id) {
        $sql_brands = "SELECT brand_id,ecw_program_code FROM `program_of_interest_xy7elite` WHERE xy7_program_id='$program_id'";
        $resultb = mysqli_query($link, $sql_brands);
        while ($brands = mysqli_fetch_assoc($resultb)) {
            if ($brands['brand_id']) {
                $campus_brands = explode(',', $brands['brand_id']);
                $program_code = $brands['ecw_program_code'];
                foreach ($campus_brands as $brand) {
                    $sql_campus = "SELECT campus_code FROM `campuses` WHERE `campus_state_code`='$state' AND `college_id` = $brand";
                    $resultc = mysqli_query($link, $sql_campus);
                    if (mysqli_num_rows($resultc) > 0) {
                        while ($campuses = mysqli_fetch_assoc($resultc)) {
                            $campus_code = $campuses['campus_code'];
                            if ($post_codes <> '') {
                                $sql = "UPDATE edu_zipcodes as A SET A.status=1 WHERE (A.program_of_interest_code = '$program_code' AND A.zipcode IN ($post_codes) AND A.campus_code='$campuses[campus_code]' AND A.lender_id=$lender_id)";
                                $values = mysqli_query($link, $sql);
                            }
                            /*foreach ($full_zipcode_list as $zipcodes) {
                                $sql1 = "INSERT INTO edu_zipcodes (zipcode,lender_id,city,state,program_of_interest_code,campus_code,lng,lat,status) values ('$zipcodes[zipcode]','$lender_id','$zipcodes[city]','$zipcodes[state]','$program_code','$campuses[campus_code]','$zipcodes[lat]','$zipcodes[lng]',1);";
                                $values = mysqli_query($link, $sql1);
                                //echo $sql1;echo '<br>';exit;
                            }*/
                        }
                    }
                }
            }
        }
    }
}
//$values=mysql_query($sql);


//https://elitebizpanel.com/mockup/edu/xy7elite/xy7elite_campuses.php

// ===> CANADA_COLLEGES_ZIPCODES_DECEMBER_2025.txt
#	SELECT LEFT(zipcode, 3) AS zip3, `program_of_interest_code`, `campus_code` FROM `edu_zipcodes` WHERE `lender_id`=29 and `status`=1;