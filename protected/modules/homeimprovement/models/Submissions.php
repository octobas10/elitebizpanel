<?php
class Submissions extends HomeimprovementActive {
    public $dob_month, $dob_day, $dob_year;
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    public function tableName() {
        return 'homeimprovement_submissions';
    }
    public function attributeLabels() {
        return array('id' => 'Customer ID');
    }
    public function rules() {
        $required_data = [];
        $required_data[] = array('lead_mode', 'required', 'message' => 'Lead Mode is required');
        $required_data[] = array('lead_mode', 'in', 'range'=>array('1', '0'),'message'=>'lead_mode should be 0 or 1');
        $required_data[] = array('promo_code', 'required', 'message' => 'Promo Code is required');
        //$required_data[] = array('sub_id', 'required', 'message' => 'Sub Id is required');
        $required_data[] = array('tcpa_optin', 'required', 'message' => 'TCPA Optin is required');
        $required_data[] = array('tcpa_text', 'required', 'message' => 'Tcpa Text is required');
        $required_data[] = array('universal_leadid', 'required', 'message' => 'Universal Lead Id is required');
        $required_data[] = array('zip', 'required', 'message' => 'Zip is required');
        $required_data[] = array('zip', 'numerical', 'integerOnly' => true, 'message' => 'Zip should be numeric');
        $required_data[] = array('zip', 'length', 'min' => 5, 'max' => 5, 'message' => 'Zip should be numeric');
        $required_data[] = array('zip', 'match', 'pattern' => '/^[\-+]?[0-9]*\.?[0-9]+$/','message' => 'Invalid Zip');
        $required_data[] = array('ipaddress', 'required', 'message' => 'Ipaddress is required');
        $required_data[] = array('bankruptcy', 'length');
        $required_data[] = array('bankruptcy','in','range'=>array('1', '0'),'message'=>'Bankruptcy should be 1 or 0');
        /*$required_data[] = array('loan_amount', 'required', 'message'=>'Loan amount is required');
        $required_data[] = array('loan_amount', 'match', 'pattern' => '/^([0-9]*)$/', 'message' => 'Invalid Loan amount');*/
        $required_data[] = array('project_type','required','message'=>'Project Type is reqiured');
        $required_data[] = array('project_type', 'in', 'range' => range('10','52'), 'message' => 'project_type should be between 10, 52');
        $required_data[] = array('task', 'match', 'pattern' => '/^([0-9]*)_([0-9]*)$/', 'message' => 'Invalid task value');
        $required_data[] = array('project_type','project_validation','message'=>'Project Type should be between given range, With respective Task');
        $required_data[] = array('task','task_validation','message'=>'Task Value should be between given range');
        if (Yii::app()->request->getParam('project_type') == 26) { // Fencing
            $required_data[] = array('fence_type','required','message'=>'Fencing type is reqiured');
            $required_data[] = array('fence_type', 'in', 'range' => range('1','5'), 'message' => 'Fencing Type should be between 1, 5');
        }
        if (Yii::app()->request->getParam('project_type') == 27) { // Flooring
            $required_data[] = array('flooring_type','required','message'=>'Flooring type is reqiured');
            $required_data[] = array('flooring_type', 'in', 'range' => range('1','5'), 'message' => 'Flooring Type should be between 1, 5');
            $required_data[] = array('room_type','required','message'=>'Room type is reqiured');
            $required_data[] = array('room_type', 'in', 'range' => range('1','4'), 'message' => 'Room Type should be between 1, 4');
            $required_data[] = array('number_of_rooms', 'match', 'pattern' => '/^([0-9]*)$/', 'message' => 'Invalid # of rooms');
            $required_data[] = array('property_type','required','message'=>'Property type is reqiured');
            $required_data[] = array('property_type', 'in', 'range' => range('1','7'), 'message' => 'Property Type should be between 1, 5');
        }
        if (Yii::app()->request->getParam('project_type') == 33) { // HVAC
            $required_data[] = array('air_type','required','message'=>'Air type is reqiured');
            $required_data[] = array('air_type', 'in', 'range' => range('1','3'), 'message' => 'Air type should be between 1, 3');
            $required_data[] = array('air_sub_type','required','message'=>'Air sub type is reqiured');
            $required_data[] = array('air_sub_type', 'in', 'range' => range('1','13'), 'message' => 'Air sub Type should be between 1, 13');
            $required_data[] = array('number_of_rooms', 'match', 'pattern' => '/^([0-9]*)$/', 'message' => 'Invalid # of rooms');
            $required_data[] = array('number_of_floors', 'match', 'pattern' => '/^([0-9]*)$/', 'message' => 'Invalid # of Floors');
        }
        if (Yii::app()->request->getParam('project_type') == 40) { // PLUMING
            $required_data[] = array('plumbing_type','required','message'=>'Plumbing type is reqiured');
            $required_data[] = array('plumbing_type', 'in', 'range' => range('1','14'), 'message' => 'Plumbing type should be between 1, 14');
        }
        if (Yii::app()->request->getParam('project_type') == 42) { // ROOFING
            $required_data[] = array('roofing_type','required','message'=>'Roofing type is reqiured');
            $required_data[] = array('roofing_type', 'in', 'range' => range('1','6'), 'message' => 'Roofing Type should be between 1, 6');
            $required_data[] = array('property_type','required','message'=>'Property type is reqiured');
            $required_data[] = array('property_type', 'in', 'range' => range('1','7'), 'message' => 'Property Type should be between 1, 4');
        }
        if (Yii::app()->request->getParam('project_type') == 43) { // SIDING
            $required_data[] = array('siding_type','required','message'=>'Siding type is reqiured');
            $required_data[] = array('siding_type', 'in', 'range' => range('1','4'), 'message' => 'Siding Type should be between 1, 4');
            $required_data[] = array('job_type','required','message'=>'Job type is reqiured');
            $required_data[] = array('job_type', 'in', 'range' => range('1','3'), 'message' => 'Job Type should be between 1, 3');
            $required_data[] = array('number_of_floors', 'match', 'pattern' => '/^([0-9]*)$/', 'message' => 'Invalid # of Floors');
            //$required_data[] = array('property_type','required','message'=>'Property type is reqiured');
            $required_data[] = array('property_type', 'in', 'range' => range('1','7'), 'message' => 'Property Type should be between 1, 4');
        }
        if (Yii::app()->request->getParam('project_type') == 45) { // SOLAR ENERGY
            $required_data[] = array('project_provider','required','message'=>'Project provider is reqiured');
            $required_data[] = array('project_provider', 'in', 'range' => range('1','396'), 'message' => 'Project provider should be between 1, 396');
            $required_data[] = array('monthly_bill', 'required', 'message'=>'Monthly Bill is required');
            $required_data[] = array('monthly_bill', 'in', 'range' => range('1','11'), 'message' => 'Monthly Bill should be between 1, 11');
            $required_data[] = array('property_type', 'in', 'range' => range('1','7'), 'message' => 'property_type should be between 1, 7');
            $required_data[] = array('roof_type', 'required', 'message'=>'Roof type is required');
            $required_data[] = array('roof_type', 'in', 'range' => range('1','12'), 'message' => 'Roof type should be between 1, 12');
            $required_data[] = array('roof_shade', 'required', 'message'=>'Roof shade is required');
            $required_data[] = array('roof_shade', 'in', 'range' => range('0','3'), 'message' => 'Roof shade should be between 0, 3');
            $required_data[] = array('credit_rating', 'required', 'message'=>'credit_rating is required');
            $required_data[] = array('credit_rating', 'in', 'range' => range('1','4'), 'message' => 'Credit rating should be between 1, 4');
        }
        if (Yii::app()->request->getParam('project_type') == 52) { // WINDOWS
            $required_data[] = array('number_of_windows', 'required', 'message'=>'Number of Windows is required');
            $required_data[] = array('number_of_windows', 'match', 'pattern' => '/^([0-9]*)$/', 'message' => 'Invalid # of Windows');
            $required_data[] = array('window_style', 'required', 'message'=>'Window style is required');
            $required_data[] = array('window_style', 'in', 'range' => range('1','11'), 'message' => 'Window style should be between 1, 11');
            $required_data[] = array('window_age', 'required', 'message'=>'Window age is required');
            $required_data[] = array('window_age', 'in', 'range' => range('1','3'), 'message' => 'Window age should be between 1, 3');
            $required_data[] = array('window_condition', 'required', 'message'=>'Window condition is required');
            $required_data[] = array('window_condition', 'in', 'range' => range('1','3'), 'message' => 'Window condition should be between 1, 3');
        }
        //$required_data[] = array('dob', 'type', 'type' =>'date','message'=>'{attribute}: is not a date! It should be YYYY-mm-dd format','dateFormat'=>'YYYY-mm-dd');
        $required_data[] = array('time_frame','required','message'=>'Time frame is required');
        $required_data[] = array('time_frame', 'in', 'range' => range('1','6'), 'message' => 'Time frame should be between 1, 6');
        $required_data[] = array('home_owner','required','message'=>'Home owner is required');
        $required_data[] = array('home_owner', 'in','range'=>range('0','1'),'message'=>'Home owner should be 0 or 1');
        $required_data[] = array('project_status','required','message'=>'Project status is required');
        $required_data[] = array('project_status', 'in', 'range' => array('1','2'), 'message' => 'Project status should be 1 or 2');
        $required_data[] = array('url', 'length');
        $required_data[] = array('trustedformcerturl', 'length');
        $required_data[] = array('sub_date','default','on'=>'insert','value'=>date('Y-m-d H:i:s'),'setOnEmpty'=>false);
        if (Yii::app()->session['ping_type'] == 'post' || Yii::app()->session['ping_type'] == 'directpost') {
            $required_data[] = array('first_name', 'required', 'message' => 'First name is required');
            $required_data[] = array('last_name', 'required', 'message' => 'Last name is required');
            $required_data[] = array('email', 'required', 'message' => 'email address is Required');
            $required_data[] = array('email', 'match', 'pattern' => '/^[A-Za-z0-9-+_\.]+@[A-Za-z0-9-\.]+$/', 'message' => 'Invalid Email address');
            $required_data[] = array('phone', 'required', 'message' => 'Phone is required');
            $required_data[] = array('phone', 'length', 'min' => 10, 'max' => 10, 'message' => 'Phone should be numeric');
            $required_data[] = array('phone', 'match', 'pattern' => '/^(\+?1-?)?(\([2-9]([02-9]\d|1[02-9])\)|[2-9]([02-9]\d|1[02-9]))-?[2-9]([02-9]\d|1[02-9])-?\d{4}$/', 'message' => 'Invalid Phone');
            $required_data[] = array('address', 'required', 'message' => 'Address is required');
        }
        /*echo '<pre>';
        print_r($required_data);
        exit;*/
        return $required_data;
    }

    public function getMonthsArray() {
        for ($monthNum = 1; $monthNum <= 12; $monthNum++) {
            $months[$monthNum] = date('F', mktime(0, 0, 0, $monthNum, 1));
        }
        return array(0 => 'Month') + $months;
    }
    public function getDaysArray() {
        for ($dayNum = 1; $dayNum <= 31; $dayNum++) {
            $days[$dayNum] = $dayNum;
        }
        return array(0 => 'Day') + $days;
    }
    public function getYearsArray() {
        $thisYear = date('Y', time()) - 18;
        for ($yearNum = $thisYear; $yearNum >= 1971; $yearNum--) {
            $years[$yearNum] = $yearNum;
        }
        return array(0 => 'Year') + $years;
    }
    public function getStayInMonthArray() {
        for ($monthNum = 1; $monthNum < 12; $monthNum++) {
            $months[$monthNum] = $monthNum;
        }
        return array(0 => 'Months') + $months;
    }
    public function getStayInYearArray() {
        for ($yearNum = 0; $yearNum < 21; $yearNum++) {
            $years[$yearNum] = $yearNum;
        }
        return array(0 => 'Years') + $years;
    }
    public function getEmpInMonthArray() {
        for ($monthNum = 1; $monthNum < 12; $monthNum++) {
            $months[$monthNum] = $monthNum;
        }
        return array(0 => 'Months') + $months;
    }
    public function getEmpInYearArray() {
        for ($yearNum = 0; $yearNum < 21; $yearNum++) {
            $years[$yearNum] = $yearNum;
        }
        return array(0 => 'Years') + $years;
    }
    /*public static function valid_dob($attribute,$params){
        if(($params['dob_month'] == "") && ($params['dob_day'] == "") && ($params['dob_year'] == "")){
            return false;
        }else{
            return true;
        }
    }*/
    public static function valid_zip($zip) {
        if (strlen(trim($zip)) < 5 || !preg_match('/^[\-+]?[0-9]*\.?[0-9]+$/', trim($zip))) {
            return false;
        } else {
            return true;
        }
    }
    public static $AirTypeJangl = [
		1=>'Cooling',
		2=>'Heating',
		3=>'Heating and Cooling',
	];
    public static $RoofingProjectTypeJangl = [
		1=>'New roof for new home',
		2=>'New roof for an existing home',
		3=>'Repair',
        4=>'Shingle over existing roof',
	];
    public static $SidingProjectTypeJangl = [
        1=>'New siding for new home',
        2=>'Siding repair',
		3=>'Replace siding',
	];
    public static $FenceTypeJangl = [
        1=>'Wood',
        2=>'Metal',
		3=>'Composite',
        3=>'Electric',
        3=>'Other',
	];
    public function getProjectVariables($project_type,$task_id=null){
        switch ($project_type) {
            case '10': // Additions
                $project_variable = [
                    'addition_type' => '',
                    'square_footage' => ['300','350','400','450','500'][rand(0,4)],
                ];
                break;
            case '11': // Appraisers and Home Inspectors
                $project_variable = [];
                break;
            case '12': //Architects
                $project_variable = [];
                break;
            case '13':// Bathroom Remodeling
                $project_variable = [
                    'project_type' => '',
                ];
                break;
            case '14': //Cabinets and Countertops
                $project_variable = [
                    'project_type' => '',
                    'location_in_house' => ['Kitchen','Bathroom','Utility room','Garage','Other'][rand(0,5)],
                    'current_materials' => ['Composite','Wood','Other'][rand(0,2)],
                    'reface' => ['Composite','Metal','Wood','Other'][rand(0,3)],
                ];
                break;
            case '15'://Carpentry
                $project_variable = [];
                break;
            case '16'://carpet
                $project_variable = [];
                break;
            case '17': //Cleaning   
                $project_variable = [];
                break;
            case '18': //Concrete and Masonry
                $project_variable = [];
                break;
            case '19': //Custom Homes
                $project_variable = [];
                break;
            case '20': //Decks and Porches
                $project_variable = [
                    'material' => ['Composite','Wood','Other'][rand(0,2)],
                    'length' => rand(5,15),
                    'width' => rand(10,20),
                ];
                break;
            case '21': //Decorators and Designers
                $project_variable = [];
                break;
            case '22'://Doors
                $project_variable = [
                    'project_type' => ['Install','Repair'][rand(0,1)],
                    'material' => ['Composite','Metal','Wood','Other'][rand(0,3)],
                    'pre_hung' => rand(0,1),
                ];
                break;
            case '23'://Drywall
                $project_variable = [];
                break;
            case '24'://Electrical
                $project_variable = [
                    'service_type' => '',
                    'project_type' => ['Install','Repair'][rand(0,1)],
                ];
                break;
            case '25'://Engineers
                $project_variable = [];
                break;
            case '26'://fencing
                $project_variable = [
                    'fence_type' => self::$FenceTypeJangl[Yii::app()->request->getParam('fence_type',rand(1,2))],
                    'length' => rand(5,15),
                    'width' => rand(10,20),
                ];
                break;
            case '27'://Flooring
                $project_variable = [
                    'flooring_type' => '',
                    'inquiry_type' => ['Installation','Repair'][rand(0,1)],
                ];
                break;
            case '28'://Foundations
                $project_variable = [];
                break;
            case '29':// Garage Doors
                $project_variable = [
                    'project_type' => '',
                    'num_doors' => rand(1,5),
                    'openers' => rand(0,1),
                ];
                break;
            case '30':// Gutter 
                $project_variable = [
                    'protection' => rand(0,1),
                    'project_type' => ['Installation','Repair','Replace,Gutter Protection'][rand(0,2)],
                    'material_type' => ['Copper','Galvanized Steel','PVC','Seamless Aluminium','Wood','Not Sure'][rand(0,5)]
                ];
                break;  
            case '31'://Handyman
                $project_variable = [
                    'location_in_home' => ['Kitchen','Bathroom','Utility room','Garage','Other'][rand(0,4)],
                    'service_type' => ['Residential','Commercial'][rand(0,1)],
                ];
                break;
            case '32'://Home Security
                $project_variable = [
                    'building_type' => '',
                    'usage' => ['Residential','Commercial'][rand(0,1)]];
                break;
            case '33'://HVAC
                $project_variable = [
                    'system_type' => '',
                    'project_type' => ['New unit installed','Repair'][rand(0,1)],
                    'air_type' => self::$AirTypeJangl[Yii::app()->request->getParam('air_type',rand(1,2))] 
                ];
                break;
            case '34'://Insulation
                $project_variable = [
                    'service_type' => '',
                ];
                break;
            case '35'://Kitchen
                $project_variable = [
                    'project_type' => '',
                    'cabinet_job' => ['Install new custom cabinets','Install new pre-made cabinets','Repair existing cabinets','Reface existing cabinets'][rand(0,4)],
                ];
                break;
            case '36'://Landscaping
                $project_variable = [
                    'project_type' => '',
                    'service_type' => ['Front Yard','Back Yard'][rand(0,1)],
                ];
                break;
            case '37'://Moving
                $project_variable = [];
                break;
            case '38'://Painting
                $project_variable = [
                    'project_type' => '',
                ];
                break;
            case '39'://Pest Control
                $project_variable = [
                    'project_type' => '',
                ];
                break;
            case '40'://Plumbing
                $project_variable = [
                    'service_type' => '',
                    'project_type' => ['Install','Repair'][rand(0,1)],
                ];
                break;
            case '41'://Remodeling
                $project_variable = [
                    'location_in_home' => '',
                    'project_type' => ['Multiple Rooms','Single Room'][rand(0,1)],
                ];
                break;
            case '42'://Roofing
                $project_variable = [
                    'roofing_type' => '',
                    'project_type' => self::$RoofingProjectTypeJangl[Yii::app()->request->getParam('property_type',rand(1,2))]
                ];
                break;
            case '43'://Siding
                $project_variable = [
                    'siding_type' => '',
                    'project_type' => self::$SidingProjectTypeJangl[Yii::app()->request->getParam('property_type',rand(1,2))],
                ];
                break;
            case '44'://Small Projects and Repairs
                $project_variable = [];
                break;
            case '45'://Solar Energy
                $project_variable = [];
                break;
            case '46'://Stair and Lift
                $project_variable = [
                    'stair_type' => '',
                    'project_type' => ['Private','Public'][rand(0,1)],
                    'carry_weight' => ['100','200','200'][rand(0,2)],
                    'num_stairs' => rand(1,2),
                    'num_floors' => rand(1,2),
                    'outdoor_stairs' => rand(1,2),
                    'stair_material' => ['Concrete','Metal'][rand(0,1)],
                ];
                break;
            case '47'://Sunrooms
                $project_variable = [
                    'num_rooms' => rand(1,3),
                    'length' => rand(5,15),
                    'width' => rand(10,20),
                ];
                break;
            case '48'://Swimming Pools
                $project_variable = [
                    'pool_type' => '',
                    'project_type' => ['Indoor','Outdoor'][rand(0,1)],
                    'service_type' => ['Repair','Install'][rand(0,1)],
                ];
                break;
            case '49'://Tile Work
                $project_variable = [
                    'project_type' => '',
                    'square_footage' => '',
                ];
                break;
            case '50'://Tree
                $project_variable = [
                    'project_type' => '',
                ];
                break;
            case '51'://Walls
                $project_variable = [
                    'project_type' => '',
                ];
                break;
            case '52'://Windows
                $project_variable = [
                    'project_type' => '',
                    'num_windows' => rand(1,3),
                ];
                break;
            default://Small Projects and Repairs
                $project_variable = [
                    'project_type' => '',
                    'num_windows' => rand(1,7),
                ];
                break;
        }
        $jangl_variables = $this->getJanglVariables($project_type,$task_id);
        if(!$jangl_variables){
            $jangl_variables = $this->getJanglVariables($project_type);
        }
        if($jangl_variables){
            $jungl_variables = $jangl_variables['jungl_variables'];
            $project_variable[$jungl_variables] = $jangl_variables['jungl_task_data'];
            $jungl_tasks = $jangl_variables['jungl_tasks'];
            $variable_array = array($jungl_tasks=>$project_variable);
            if($variable_array){
                return $variable_array;
            }else{
                return [];
            }
        }else{
            return [];
        }
    }
    /*public function getProjectVariables($project_type,$task_id=null){
        switch ($project_type) {
            case '10': // Additions
                $project_variable = [
                    'addition_type' => '',
                    'square_footage' => ['300','350','400','450','500'][rand(0,4)],
                ];
                break;
            case '11': // Appraisers and Home Inspectors
                $project_variable = [];
                break;
            case '12': //Architects
                $project_variable = [];
                break;
            case '13':// Bathroom Remodeling
                $project_variable = [
                    'project_type' => '',
                ];
                break;
            case '14': //Cabinets and Countertops
                $project_variable = [
                    'project_type' => '',
                    'location_in_house' => ['Kitchen','Bathroom','Utility room','Garage','Other'][rand(0,5)],
                    'current_materials' => '',
                    'reface' => '',
                ];
                break;
            case '15'://Carpentry
                $project_variable = [];
                break;
            case '16'://carpet
                $project_variable = [];
                break;
            case '17': //Cleaning   
                $project_variable = [];
                break;
            case '18': //Concrete and Masonry
                $project_variable = [];
                break;
            case '19': //Custom Homes
                $project_variable = [];
                break;
            case '20': //Decks and Porches
                $project_variable = [
                    'material' => ['Composite','Wood','Other'][rand(0,2)],
                    'length' => rand(5,15),
                    'width' => rand(10,20),
                ];
                break;
            case '21': //Decorators and Designers
                $project_variable = [];
                break;
            case '22'://Doors
                $project_variable = [
                    'project_type' => ['Install','Repair'][rand(0,1)],
                    'material' => ['Composite','Metal','Wood','Other'][rand(0,3)],
                    'pre_hung' => rand(0,1),
                ];
                break;
            case '23'://Drywall
                $project_variable = [];
                break;
            case '24'://Electrical
                $project_variable = [
                    'service_type' => '',
                    'project_type' => ['Install','Repair'][rand(0,1)],
                ];
                break;
            case '25'://Engineers
                $project_variable = [];
                break;
            case '26'://fencing
                $project_variable = [
                    'fence_type' => ['Wood','Metal','Composite','Electric','Other'][rand(0,4)],
                    'length' => rand(5,15),
                    'width' => rand(10,20),
                ];
                break;
            case '27'://Flooring
                $project_variable = [
                    'flooring_type' => '',
                    'inquiry_type' => ['Installation','Repair'][rand(0,1)],
                ];
                break;
            case '28'://Foundations
                $project_variable = [];
                break;
            case '29':// Garage Doors
                $project_variable = [
                    'project_type' => '',
                    'num_doors' => rand(1,5),
                    'openers' => rand(0,1),
                ];
                break;
            case '30':// Gutter 
                $project_variable = [
                    'protection' => rand(0,1),
                ];
                break;  
            case '31'://Handyman
                $project_variable = [
                    'location_in_home' => ['Kitchen','Bathroom','Utility room','Garage','Other'][rand(0,4)],
                    'service_type' => ['Residential','Commercial'][rand(0,1)],
                ];
                break;
            case '32'://Home Security
                $project_variable = [
                    'building_type' => '',
                    'usage' => ['Residential','Commercial'][rand(0,1)]];
                break;
            case '33'://HVAC
                $project_variable = [
                    'system_type' => '',
                    'project_type' => ['New unit installed','Repair'][rand(0,1)],
                    'air_type' => ['Cooling','Heating','Heating and cooling'][rand(0,2)],       
                ];
                break;
            case '34'://Insulation
                $project_variable = [
                    'service_type' => '',
                ];
                break;
            case '35'://Kitchen
                $project_variable = [
                    'project_type' => '',
                    'cabinet_job' => ['Install new custom cabinets','Install new pre-made cabinets','Repair existing cabinets','Reface existing cabinets'][rand(0,4)],
                ];
                break;
            case '36'://Landscaping
                $project_variable = [
                    'project_type' => '',
                    'service_type' => ['Front Yard','Back Yard'][rand(0,1)],
                ];
                break;
            case '37'://Moving
                $project_variable = [];
                break;
            case '38'://Painting
                $project_variable = [
                    'project_type' => '',
                ];
                break;
            case '39'://Pest Control
                $project_variable = [
                    'project_type' => '',
                ];
                break;
            case '40'://Plumbing
                $project_variable = [
                    'service_type' => '',
                    'project_type' => ['Install','Repair'][rand(0,1)],
                ];
                break;
            case '41'://Remodeling
                $project_variable = [
                    'project_type' => ['Install','Repair'][rand(0,1)],
                    'location_in_home' => '',
                ];
                break;
            case '42'://Roofing
                $project_variable = [
                    'roofing_type' => '',
                    'project_type' => ['New roof for new home','New roof for an existing home','Repair','Shingle over existing roof'][rand(0,3)],
                ];
                break;
            case '43'://Siding
                $project_variable = [
                    'siding_type' => '',
                    'project_type' => ['Replace siding','Siding repair'][rand(0,1)],
                ];
                break;
            case '44'://Small Projects and Repairs
                $project_variable = [];
                break;
            case '45'://Solar Energy
                $project_variable = [];
                break;
            case '46'://Stair and Lift
                $project_variable = [
                    'stair_type' => '',
                    'project_type' => ['Private','Public'][rand(0,1)],
                    'carry_weight' => ['100','200','200'][rand(0,2)],
                    'num_stairs' => rand(1,2),
                    'num_floors' => rand(1,2),
                    'outdoor_stairs' => rand(1,2),
                    'stair_material' => ['Concrete','Metal'][rand(0,1)],
                ];
                break;
            case '47'://Sunrooms
                $project_variable = [
                    'num_rooms' => rand(1,3),
                    'length' => rand(5,15),
                    'width' => rand(10,20),
                ];
                break;
            case '48'://Swimming Pools
                $project_variable = [
                    'project_type' => ['Indoor','Outdoor'][rand(0,1)],
                    'service_type' => ['Repair','Install'][rand(0,1)],
                    'pool_type' => '',
                ];
                break;
            case '49'://Tile Work
                $project_variable = [
                    'project_type' => '',
                    'square_footage' => '',
                ];
                break;
            case '50'://Tree
                $project_variable = [
                    'project_type' => '',
                ];
                break;
            case '51'://Walls
                $project_variable = [
                    'project_type' => '',
                ];
                break;
            case '52'://Windows
                $project_variable = [
                    'project_type' => '',
                    'num_windows' => rand(1,3),
                ];
                break;
            default://Small Projects and Repairs
                $project_variable = [
                    'project_type' => '',
                    'num_windows' => rand(1,7),
                ];
                break;
        }
        $jangl_variables = $this->getJanglVariables($project_type,$task_id);
        if($jangl_variables){
            $jungl_variable = $jangl_variables['jungl_variables'];
            $project_variable[$jungl_variable] = $jangl_variables['jungl_task_data'];
            $jungl_tasks = $jangl_variables['jungl_tasks'];
            $variable = array($jungl_tasks=>$project_variable);
            if($variable){
                return $variable;
            }else{
                return [];
            }
        }else{
            return [];
        }
    }*/
    
    public function project_validation($attribute, $params) {
        $attribute_value = Yii::app()->request->getParam($attribute);
        if (!empty($attribute_value)) {
            $result = $this->getProjectTypeById($attribute_value);
            if (!$result) {
                $this->addError($attribute, $params['message']);
                return false;
            }
        }
    }
    public function task_validation($attribute, $params) {
        $attribute_value = Yii::app()->request->getParam($attribute);
        if (!empty($attribute_value)) {
            $project_task = explode('_',$attribute_value);
            $result = $this->getTasksById($project_task[0],$project_task[1]);
            $project_type = Yii::app()->request->getParam('project_type');
            if (!$result) {
                $this->addError($attribute, $params['message']);
                return false;
            }else if($result['project_id'] != $project_type){
                $this->addError('project_type', 'Project Type and Task do not match for :'.$project_type);
                return false;
            }
        }else{
            $project_type = Yii::app()->request->getParam('project_type');
            $result = $this->getTasksById($project_type);
            if($result){
                if($result['project_id'].'_'.$result['task_id'] != $attribute_value){
                    $this->addError('task', 'Task should not be emtpy for Project type:'.$project_type);
                    return false;
                }
            }
        }
    }
    public function USPS_Validation($attribute, $params) {
        $zip = ($this->zip) ? $this->zip : $attribute;
        $flag = 0;
        if (!empty($zip)) {
            $response = file_get_contents('http://maps.googleapis.com/maps/api/geocode/json?address=' . $zip . '&sensor=true');
            $resjs = json_decode($response);
            foreach ($resjs->results[0]->address_components as $address_component) {
                if ($address_component->short_name == 'US') {
                    $flag = 1;
                }
            }
        }
        if ($flag == 1) {
            return true;
        } else {
            $this->addError('zip', 'Invalid Zip Code');
            return false;
        }
    }
    public function getJanglVariables($project_id,$task_id=null) {
        //echo 'i am here 470';exit;
        $dbCommand = Yii::app()->dbHomeimprovement->createCommand()
        ->select('jungl_tasks,jungl_variables,jungl_task_data')
        ->from('jungl_project_variables')
        ->where('ecw_project_id=:ecw_project_id',[':ecw_project_id'=>$project_id]);
        if(!empty($task_id)){
            $dbCommand->andWhere('ecw_task_id=:ecw_task_id',[':ecw_task_id'=>$task_id]);
        }
        $dataReader = $dbCommand->queryRow();
        return $dataReader;
    }
    public function getHomeYouVariables($project_id,$task_id=null) {
        $dbCommand = Yii::app()->dbHomeimprovement->createCommand()
        ->select('id_service')
        ->from('homeyou_attributes')
        ->where('project_id=:project_id',[':project_id'=>$project_id]);
        if(!empty($task_id)){
            $dbCommand->andWhere('task_id=:task_id',[':task_id'=>$task_id]);
        }
        $dataReader = $dbCommand->queryAll();
         if(!empty($dataReader)){
            $record_count = count($dataReader);
            if($record_count >= 6){
                $number = (int) date('w',time());
            }else if($record_count >= 12){
                $number = (int) date('g',time());
            }else if($record_count >= 23){
                $number = (int) date('G',time());
            }else if($record_count >= 31){
                $number = (int) date('j',time());
            }else {
                $number = rand(0,$record_count-1);
            }
            return $dataReader[$number]['need_id'];
        }else{
            return false;
        }
    }
    public function getELocalVariables($project_id,$task_id=null) {
        $dbCommand = Yii::app()->dbHomeimprovement->createCommand()
        ->select('need_id,category_list_id')
        ->from('elocal_attributes')
        ->where('project_id=:project_id',[':project_id'=>$project_id]);
        if(!empty($task_id)){
            $dbCommand->andWhere('task_id=:task_id',[':task_id'=>$task_id]);
        }
        $dataReader = $dbCommand->queryAll();
        //echo $project_id.'----'.$task_id;$dbCommand->getText();exit;
        if(!empty($dataReader)){
            $record_count = count($dataReader);
            if($record_count >= 6){
                $number = (int) date('w',time());
            }else if($record_count >= 12){
                $number = (int) date('g',time());
            }else if($record_count >= 23){
                $number = (int) date('G',time());
            }else if($record_count >= 31){
                $number = (int) date('j',time());
            }else {
                $number = rand(0,$record_count-1);
            }
            return $dataReader[$number];
        }else{
            return false;
        }
    }
    public function getProviderDetailsById($provider_id) {
        $dbCommand = Yii::app()->dbHomeimprovement->createCommand()
                ->select('provider_id,provider_name')
                ->from('providers')
                ->where('provider_id = "' . $provider_id . '"');
        $dataReader = $dbCommand->queryRow();
        //echo $queri = $dbCommand->getText();
        return $dataReader;
    }
    /*public function getSunshineUtilityProviderById($provider_name) {
        $dbCommand = Yii::app()->dbHomeimprovement->createCommand()
                ->select('provider')
                ->from('sunshine_utilityproviders order by abs(provider - "'.$provider_name.'") LIMIT 1');
        $dataReader = $dbCommand->queryRow();
        return $dataReader;
    }
    public function getPXUtilityProviderById($provider_name) {
        $dbCommand = Yii::app()->dbHomeimprovement->createCommand()
                ->select('provider')
                ->from('px_utilityproviders order by abs(provider - "'.$provider_name.'") LIMIT 1');
        //echo $queri = $dbCommand->getText();
        $dataReader = $dbCommand->queryRow();
        return $dataReader;
    }
    public function getDMSUtilityProviderById($provider_name) {
        $dbCommand = Yii::app()->dbHomeimprovement->createCommand()
                ->select('provider')
                ->from('dms_utilityproviders order by abs(provider - "'.$provider_name.'") LIMIT 1');
        //echo $queri = $dbCommand->getText();
        $dataReader = $dbCommand->queryRow();
        return $dataReader;
    }*/
    public function getSunshineUtilityProviderById($provider_name) {
        $provider = explode(" ", $provider_name);
        $dbCommand = Yii::app()->dbHomeimprovement->createCommand()
                ->select('provider,LENGTH(provider)-LENGTH("'.$provider_name.'")')
                ->from('sunshine_utilityproviders')
                ->where('provider LIKE "%' .$provider[0].'%"')
                ->order('ABS(LENGTH(provider) - LENGTH("'.$provider_name.'"))');
        $dataReader = $dbCommand->queryRow();
        return $dataReader;
    }
    public function getPXUtilityProviderById($provider_name) {
        $provider = explode(" ", $provider_name);
        $dbCommand = Yii::app()->dbHomeimprovement->createCommand()
                ->select('provider,LENGTH(provider)-LENGTH("'.$provider_name.'")')
                ->from('px_utilityproviders')
                ->where('provider LIKE "%' .$provider[0].'%"')
                ->order('ABS(LENGTH(provider) - LENGTH("'.$provider_name.'"))');
        $dataReader = $dbCommand->queryRow();
        return $dataReader;
    }
    public function getDMSUtilityProviderById($provider_name) {
        $provider = explode(" ", $provider_name);
        $dbCommand = Yii::app()->dbHomeimprovement->createCommand()
                ->select('provider,LENGTH(provider)-LENGTH("'.$provider_name.'")')
                ->from('dms_utilityproviders')
                ->where('provider LIKE "%' .$provider[0].'%"')
                ->order('ABS(LENGTH(provider) - LENGTH("'.$provider_name.'"))');
        $dataReader = $dbCommand->queryRow();
        return $dataReader;
    }
    public function getCityStateFromZip($zip) {
        $dbCommand = Yii::app()->dbHomeimprovement->createCommand()
                ->select('zipcode,city,UPPER(state) AS state')
                ->from('zipcodes')
                ->where('zipcode = "' . $zip . '"');
        //echo $queri = $dbCommand->getText();
        $dataReader = $dbCommand->queryRow();
        return $dataReader;
    }
    public function checkDuplicate($data) {
        $dbCommand = Yii::app()->dbHomeimprovement->createCommand()
                ->select('id')
                ->from('homeimprovement_submissions')
                ->where("email='" . $data['email'] . "' AND phone=" . $data['phone'] . " AND last_name='" . $data['last_name'] . "' AND UNIX_TIMESTAMP(sub_date)>" . @strtotime('-1 month'))
                ->limit('1');
        $dataReader = $dbCommand->query();
        return $count = count($dataReader);
    }
    public function checkPingDuplicate($data) {
        $dbCommand = Yii::app()->dbHomeimprovement->createCommand()
                ->select('dup_days')
                ->from('homeimprovement_affiliate_user')
                ->where("id = " . $data['promo_code']);
        $dataReader = $dbCommand->queryRow();
        $dup_days = $dataReader['dup_days'];
        $dup_days = (isset($dup_days) && !empty($dup_days)) ? '-' . $dup_days . ' days' : '-6 months';
        $dbCommand = Yii::app()->dbHomeimprovement->createCommand()
                ->select('id')
                ->from('homeimprovement_submissions')
                ->where("email = '" . $data['email'] . "' AND `sub_date` > '" . date('Y-m-d', strtotime($dup_days)) . " 00:00:00'")
                ->limit('1');
        return false;
    }
    public function afterSave() {
        $id = Yii::app()->dbHomeimprovement->getLastInsertId();
        if ($id != 0)
            AffiliateTransactions::model()->updateByPk(Yii::app()->session['affiliate_trans_id'], array("customer_id" => $id));
    }
    public $cnt = 0;
    /**
     * Valid Pings of Last 15 Days 
     */
    public function submission15days() {
        $criteria = new CDbCriteria();
        $criteria->select = "count(*) AS cnt , sub_date";
        $criteria->group = "date(`sub_date`)";
        $criteria->order = "date(`sub_date`) DESC";
        $criteria->limit = "15";
        $days15 = $this->findAll($criteria);
        $xml_cat = "";
        $xml_cat .= "<graph counttion='Total submissions of last 15 days' rotateNames='1' xAxisName='Last 15 days' yAxisName='Units' decimalPrecision='0' formatNumberScale='0'>";
        foreach ($days15 as $row) {
            $rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
            $color = '#' . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)] . $rand[rand(0, 15)];
            $xml_cat .= '<set name="' . substr($row['sub_date'], 0, 10) . '" value="' . $row['cnt'] . '" color="' . $color . '"/>';
        }
        return $xml_cat .= "</graph>";
    }

    public $counterror = "";
    public $countdupli = "";
    public $count = "";
    public function exportleads() {
        $orderby = "";
        if ($promo_code = Yii::app()->request->getParam("promo_code")) {
            $promo_codes = implode(",", $promo_code);
            if ($promo_codes) {
                $where[] = "a_sub.promo_code IN (" . $promo_codes . ")";
            }
        }
        if ($stay_in_month = Yii::app()->request->getParam("stay_in_month")) {
            $where[] = "a_sub.stay_in_month = " . $stay_in_month;
        }
        if ($stay_in_year = Yii::app()->request->getParam("stay_in_year")) {
            $where[] = "a_sub.stay_in_year = " . $stay_in_year;
        }
        if ($employment_in_month = Yii::app()->request->getParam("employment_in_month")) {
            $where[] = "a_sub.employment_in_month = " . $employment_in_month;
        }
        if ($employment_in_year = Yii::app()->request->getParam("employment_in_year")) {
            $where[] = "a_sub.employment_in_year = " . $employment_in_year;
        }
        /*if($monthly_income = Yii::app()->request->getParam("monthly_income")){
            $where[] = "a_sub.monthly_income = ".$monthly_income;
        }*/
        if ($state = Yii::app()->request->getParam("state")) {
            $states = implode("','", $state);
            if ($states) {
                $where[] = "a_sub.state IN ('" . $states . "')";
            }
        }
        if (Yii::app()->request->getParam("status") != '-1') {
            $status = Yii::app()->getRequest()->getParam("status");
            $where[] = "a_sub.lead_status = '" . $status . "'";
        }
        /*if(Yii::app()->request->getParam("gender")!='-1'){
            $gender = Yii::app()->getRequest()->getParam("gender");
            $gender = ($gender=='1') ? 'M' : 'F';
            $where[] = "a_sub.gender = '".$gender."'";
        }*/
        if (Yii::app()->request->getParam("lead_type") != '-1') {
            $lead_type = Yii::app()->getRequest()->getParam("lead_type");
            $where[] = "a_sub.is_organic = '" . $lead_type . "'";
        }
        if ($filter = Yii::app()->request->getParam('filter_date', date("Y-m-d"))) {
            $time_condition = '';
            $filter = explode(' - ', $filter);
            $count = count($filter);
            if ($count == 2) {
                $date1 = date("Y-m-d", strtotime($filter[0])) . ' 00:00:00';
                $date2 = date("Y-m-d", strtotime($filter[1])) . ' 23:59:59';
                $time_condition .= "sub_date BETWEEN '" . $date1 . "' AND '" . $date2 . "' ";
            } else {
                $date = date("Y-m-d", strtotime($filter[0]));
                $time_condition .= "sub_date BETWEEN '" . $date . " 00:00:00' AND '" . $date . " 23:59:59' ";
            }
            $where[] = $time_condition;
        }
        if ($age = Yii::app()->request->getParam('age')) {
            $where[] = 'YEAR(CURDATE())-YEAR(date_format(str_to_date(dob,"%d/%m/%Y"),"%Y-%m-%d")) > "' . $age . '"';
        }
        if (Yii::app()->request->getParam('order') != '-1') {
            $order = Yii::app()->request->getParam('order');
            $orderby = 'a_sub.id ' . $order;
        }
        if ($fields_requested = Yii::app()->request->getParam('fields')) {
            $fields = "a_sub." . implode(",a_sub.", $fields_requested);
        } else {
            $fields_request = array("id", "promo_code", "first_name", "last_name", "sub_date", "email");
            $fields = '';
            foreach ($fields_request as $value) {
                $fields .= "a_sub." . $value . ',';
            }
        }
        $where = array_filter($where);
        $where = (count($where) > 0) ? '' . implode(' AND ', $where) : '';
        //echo'<pre>';print_r($where);echo'</pre>';
        $rawData = Yii::app()->dbHomeimprovement->createCommand()
                ->select($fields)
                ->from("homeimprovement_submissions a_sub")
                ->where($where)
                ->order($orderby)
                ->queryAll();
        return $rawData;
    }

    public function browseleads() {
        $criteria = new CDbCriteria();
        if ($promo_code = Yii::app()->getRequest()->getParam('promo_code')) {
            $promo_codes = implode(',', $promo_code);
            if ($promo_codes) {
                $where[] = 'promo_code IN (' . $promo_codes . ')';
            }
        }
        if ($lenders = Yii::app()->getRequest()->getParam('lender_name')) {
            $lenders = implode("','", $lenders);
            $rs = LenderDetails::model()->findAll(array('select' => 'id', 'condition' => 'name IN ("' . $lenders . '") '));
            $lender_ids = '';
            foreach ($rs as $sub_row) {
                $lender_ids .= $sub_row->id . ",";
            }
            $lender_ids = substr($lender_ids, 0, strlen($lender_ids) - 1);
            if ($lender_ids) {
                $where[] = 'lender_id IN (' . $lender_ids . ')';
            }
        }
        if (Yii::app()->getRequest()->getParam('lead_status') != '' && Yii::app()->getRequest()->getParam('lead_status') != '2') {
            $lead_status = Yii::app()->getRequest()->getParam('lead_status');
            $where[] = "lead_status = " . $lead_status;
        }
        if (Yii::app()->getRequest()->getParam('lead_status') == '2') {
            $where[] = "is_returned = 1";
        }
        if ($filter = Yii::app()->getRequest()->getParam('filter_date', date("Y-m-d"))) {
            $time_condition = '';
            $filter = explode(' - ', $filter);
            $count = count($filter);
            if ($count == 2) {
                $date1 = date("Y-m-d", strtotime($filter[0])) . ' 00:00:00';
                $date2 = date("Y-m-d", strtotime($filter[1])) . ' 23:59:59';
                $time_condition = " sub_date BETWEEN '" . $date1 . "' AND '" . $date2 . "' ";
            } else {
                $date = date("Y-m-d", strtotime($filter[0]));
                $time_condition .= " sub_date >= '" . $date . " 00:00:00' AND sub_date <= '" . $date . " 23:59:59'";
            }
            $where[] = $time_condition;
        }
        $where = array_filter($where);
        $where = (count($where) > 0) ? '' . implode(' AND ', $where) : '';
        $criteria->condition = $where;
        $criteria->order = 'sub_date DESC';
        return $criteria;
    }

    public function getDurationSubmissions() {
        /* $combine_data_query = 'SELECT SUM(if(sub_date >= DATE_SUB(CURDATE(),INTERVAL 1 WEEK) , 1, 0)) as week_submission, SUM(if(sub_date >= DATE_SUB(CURDATE(),INTERVAL 1 MONTH) , 1, 0)) as month_submission FROM homeimprovement_submissions'; */
        $combine_data_query = 'SELECT t1.week_submission, t2.month_submission
            FROM (SELECT count(*) AS week_submission
            FROM homeimprovement_submissions
            WHERE sub_date >= DATE_SUB(CURDATE(),INTERVAL 1 WEEK)) t1,
            (SELECT count(*) AS month_submission
            FROM homeimprovement_submissions
            WHERE sub_date >= DATE_SUB(CURDATE(),INTERVAL 1 MONTH)) t2';

        $command = Yii::app()->dbHomeimprovement->createCommand($combine_data_query);
        return $row = $command->queryRow();
    }

    public function lead_info_reports() {
        $promo_code = Yii::app()->getRequest()->getParam('promo_code');
        $lender_lead_price = Yii::app()->getRequest()->getParam('lead_price');
        $lender = Yii::app()->getRequest()->getParam('lender');
        $start_date = Yii::app()->getRequest()->getParam('start_date');
        $end_date = Yii::app()->getRequest()->getParam('end_date');
        $is_returned = Yii::app()->getRequest()->getParam('is_returned');
        $final = Yii::app()->getRequest()->getParam('final');
        $posting_type = Yii::app()->getRequest()->getParam('posting_type');
        $lender_id = '';
        if ($lender) {
            $lender_details_model = new LenderDetails();
            $lender_detail = $lender_details_model->find(array('condition' => "name='" . $lender . "'"));
            $lender_id = isset($lender_detail->id) ? $lender_detail->id : '';
        }
        $where[] = $promo_code ? "promo_code = " . $promo_code : '';
        $where[] = $lender_lead_price ? "lender_lead_price = " . $lender_lead_price : '';
        $where[] = $lender_id ? "lender_id = '" . $lender_id . "'" : '';
        $where[] = $start_date ? "sub_date >= '" . $start_date . " 00:00:00'" : '';
        $where[] = $end_date ? "sub_date <= '" . $end_date . " 23:59:59'" : '';
        $where[] = "lead_status = 1";
        $where[] = isset($posting_type) ? "posting_type = $posting_type" : '';
        $where[] = ($is_returned == 1) ? "is_returned=1" : "";
        $where[] = ($final == 1) ? " (is_returned=0 or is_returned IS NULL)" : "";
        $where = array_filter($where);
        $where = (count($where) > 0) ? '' . implode(' AND ', $where) : '';
        //echo '';print_r($where);exit;
        $rawData = Yii::app()->dbHomeimprovement->createCommand()
                ->select('promo_code,first_name,last_name,email,phone,zip,ipaddress,lender_id,sub_date,lender_lead_price,vendor_lead_price')
                ->from('homeimprovement_submissions')
                ->where($where)
                ->order('')
                ->queryAll();
        return $rawData;
    }
    public function affiliate_revenue_statistics(){
        $days = 7;
        $sdate = date('Y-m-d',mktime(0,0,0,date('m'),date('d')-$days,date('Y')));
        $edate = date('Y-m-d');
        $date_filter = Yii::app()->request->getParam('date_filter');
        if(!empty($date_filter)){
            $filter = explode(" - ",$date_filter);
            $count =  count($filter);
            if($count == 2){
                $sdate = date('Y-m-d',strtotime($filter[0]));
                $edate = date('Y-m-d',strtotime($filter[1]));
            }else{
                $sdate = date('Y-m-d',strtotime($filter[0]));
                $edate = date('Y-m-d',strtotime($filter[0]));
            }
        }
        $fields = 'SUM(IF(`is_returned` = "0", `vendor_lead_price`,0)) as total_vendor_price,SUM(`is_returned`) AS returned, DATE(sub_date) as date,promo_code';
        $where = "lead_status=1 AND `sub_date` BETWEEN '".$sdate."' AND '".$edate."'";
        $groupby = 'DATE(sub_date),promo_code';
        $orderby = 'sub_date desc';
        $dbCommand = Yii::app()->dbHomeimprovement->createCommand()
        ->select($fields)
        ->from("homeimprovement_submissions as A")
        ->where($where)
        ->order($orderby)
        ->group($groupby);
        //echo $dbCommand->getText();exit;
        return $rawData = $dbCommand->queryAll();
    }
    public function lender_revenue_statistics(){
        $days = 7;
        $sdate = date('Y-m-d',mktime(0,0,0,date('m'),date('d')-$days,date('Y')));
        $edate = date('Y-m-d');
        $date_filter = Yii::app()->request->getParam('date_filter');
        if(!empty($date_filter)){
            $filter = explode(" - ",$date_filter);
            $count =  count($filter);
            if($count == 2){
                $sdate = date('Y-m-d',strtotime($filter[0]));
                $edate = date('Y-m-d',strtotime($filter[1]));
            }else{
                $sdate = date('Y-m-d',strtotime($filter[0]));
                $edate = date('Y-m-d',strtotime($filter[0]));
            }
        }
        $fields = 'SUM(IF(`is_returned` = "0", `lender_lead_price`,0)) as total_buyer_price,SUM(`is_returned`) AS returned, DATE(sub_date) as date,user_name as lender';
        $where = "lead_status=1 AND  `sub_date` BETWEEN '".$sdate."' AND '".$edate."'";
        $groupby = 'DATE(sub_date),lender_id';
        $orderby = 'sub_date desc';
        $dbCommand = Yii::app()->dbHomeimprovement->createCommand()
        ->select($fields)
        ->from("homeimprovement_submissions as A")
        ->join('homeimprovement_lender_details B','A.lender_id = B.id')
        ->where($where)
        ->order($orderby)
        ->group($groupby);
        //echo $dbCommand->getText();exit;
        return $dbCommand->queryAll();
    }
    public function lead_info_posted_leads() {
        $promo_code = Yii::app()->getRequest()->getParam('promo_code');
        $ping_status = Yii::app()->getRequest()->getParam('ping_status');
        $post_sent = Yii::app()->getRequest()->getParam('post_sent');
        $post_status = Yii::app()->getRequest()->getParam('post_status');
        $lead_price = Yii::app()->getRequest()->getParam('lead_price');
        $start_date = Yii::app()->getRequest()->getParam('start_date');
        $end_date = Yii::app()->getRequest()->getParam('end_date');
        $is_returned = Yii::app()->getRequest()->getParam('is_returned');
        $posting_type = Yii::app()->getRequest()->getParam('posting_type');
        $where[] = $promo_code ? "promo_code = " . $promo_code : '';
        $where[] = $lead_price ? "ping_price = " . $lead_price . " AND post_status=1" : '';
        $where[] = ($ping_status == 1) ? "ping_status = 1" : '';
        $where[] = ($post_sent == 1) ? "post_request != '' " : '';
        $where[] = ($post_status == 1) ? "post_status = 1" : '';
        $where[] = $start_date ? "date >= '" . $start_date . " 00:00:00'" : '';
        $where[] = $end_date ? "date <= '" . $end_date . " 23:59:59'" : '';
        $where[] = isset($posting_type) ? "posting_type = $posting_type" : '';
        $where[] = $is_returned=='0' ? "(is_returned=0 OR is_returned IS NULL)" : $is_returned;
        $where = array_filter($where);
        $where = (count($where) > 0) ? '' . implode(' AND ', $where) : '';
        $rawData = Yii::app()->dbHomeimprovement->createCommand()
                ->select('customer_id')
                ->from('homeimprovement_affiliate_transactions')
                ->where($where)
                ->queryAll();
        $customer_id = [1];$subData = [];
        if($rawData){
            foreach ($rawData as $row) {
                $customer_id[] = $row['customer_id'];
            }
            $customer_id = array_filter($customer_id);
            $customer_id = implode(',', $customer_id);
            $subData = Submissions::model()->findAll(["condition" => "id IN ($customer_id) AND promo_code=$promo_code"]);
        }
        return $subData;
    }
    public function campain_performance() {
        $days = 7;
        $sdate = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - $days, date('Y'))) . ' 00:00:00';
        $edate = date('Y-m-d') . ' 23:59:59';
        $date_filter = Yii::app()->request->getParam('date_filter');
        if (!empty($date_filter)) {
            $filter = explode(" - ", $date_filter);
            $count = count($filter);
            if ($count == 2) {
                $sdate = date('Y-m-d', strtotime($filter[0])) . ' 00:00:00';
                $edate = date('Y-m-d', strtotime($filter[1])) . ' 23:59:59';
            } else {
                $sdate = date('Y-m-d', strtotime($filter[0])) . ' 00:00:00';
                $edate = date('Y-m-d', strtotime($filter[0])) . ' 23:59:59';
            }
        }
        $fields = 'COUNT(id) as total,SUM(vendor_lead_price) as vendor_price,SUM(lender_lead_price) as buyer_price, DATE(sub_date) as date';
        $where = 'lead_status=1 AND sub_date BETWEEN "'.$sdate.'" AND "'.$edate.'"';
        $groupby = 'DATE(sub_date)';
        $orderby = 'sub_date desc';
        $dbCommand = Yii::app()->dbHomeimprovement->createCommand()
                ->select($fields)
                ->from("homeimprovement_submissions a_sub")
                ->where($where)
                ->order($orderby)
                ->group($groupby);
        //echo $dbCommand->getText();exit;
        $rawData = $dbCommand->queryAll();
        $revenue_seller = [];$revenue_buyers =[];$leads = [];$profit = [];
        foreach ($rawData as $row) {
            $revenue_seller[$row['date']]   = ($row['vendor_price']);
            $revenue_buyers[$row['date']]   = ($row['buyer_price']);
            $profit[$row['date']] = ($row['buyer_price'] - $row['vendor_price']);
            $leads[$row['date']] = $row['total'];
        }
        //echo '<pre>';print_r($leads);exit;
        return array(
            'profit' => $profit, 
            'revenue_buyer' => $revenue_buyers, 
            'revenue_seller' => $revenue_seller, 
            'leads' => $leads
        );
    }
    public function search_return_leads() {
        $criteria = new CDbCriteria();
        $criteria->select = 'id,promo_code,first_name,last_name,email,ipaddress,lead_status,lender_id,lender_lead_price,is_returned,sub_date,return_reason';
        if ($field_value = Yii::app()->getRequest()->getParam('field_value')) {
            $field = Yii::app()->getRequest()->getParam('field');
            $field_value = preg_split('/[\s,]+/', $field_value, -1, PREG_SPLIT_NO_EMPTY);
            $field_value = "'" . implode("','", $field_value) . "'";
            if ($field_value) {
                $where[] = $field . ' IN (' . $field_value . ')';
            }
        }
        if ($promo_code = Yii::app()->getRequest()->getParam('promo_code')) {
            $promo_code = preg_split('/[\s,]+/', $promo_code, -1, PREG_SPLIT_NO_EMPTY);
            $promo_codes = implode(',', $promo_code);
            if ($promo_codes) {
                $where[] = 'promo_code IN (' . $promo_codes . ')';
            }
        }
        if ($lenders = Yii::app()->getRequest()->getParam('lenders')) {
            $lenders = implode("','", $lenders);
            $rs = LenderDetails::model()->findAll(array('select' => 'id', 'condition' => 'name IN ("' . $lenders . '") '));
            $lender_id = '';
            foreach ($rs as $lender_row) {
                $lender_id .= $lender_row->id . ",";
            }
            $lender_id = substr($lender_id, 0, strlen($lender_id) - 1);
            if ($lender_id) {
                $where[] = 'lender_id IN (' . $lender_id . ')';
            }
        }
        if ($lead_status = Yii::app()->getRequest()->getParam('lead_status', '1')) {
            $where[] = ($lead_status != 'returned') ? "lead_status = '" . $lead_status . "'" : "is_returned = 1";
        }
        if ($time = Yii::app()->getRequest()->getParam('time', 'hour')) {
            switch ($time) {
                case 'hour':
                    $time_condition = " t.sub_date >=DATE_ADD('" . date('Y-m-d H:i:s') . "', INTERVAL -1 HOUR)";
                    break;
                case 'day':
                    $time_condition = " t.sub_date >=DATE_ADD('" . date('Y-m-d H:i:s') . "', INTERVAL -1 DAY)";
                    break;
                case 'week':
                    $time_condition = " t.sub_date >=DATE_ADD('" . date('Y-m-d H:i:s') . "', INTERVAL -1 WEEK)";
                    break;
                case 'month':
                    $time_condition = " t.sub_date >= DATE_ADD('" . date('Y-m-d H:i:s') . "', INTERVAL -1 MONTH)";
                    break;
                case 'quarter':
                    $time_condition = " t.sub_date >= DATE_ADD('" . date('Y-m-d H:i:s') . "', INTERVAL -3 MONTH)";
                    break;
                case 'specific_date':
                    $filter = Yii::app()->getRequest()->getParam('filter');
                    $filter = explode(' - ', $filter);
                    $count = count($filter);
                    if ($count == 2) {
                        $date1 = date("Y-m-d", strtotime($filter[0])) . ' 00:00:00';
                        $date2 = date("Y-m-d", strtotime($filter[1])) . ' 23:59:59';
                        $time_condition = " t.sub_date BETWEEN '" . $date1 . "' AND '" . $date2 . "' ";
                    } else {
                        $date = date("Y-m-d", strtotime($filter[0]));
                        $time_condition = " t.sub_date >= '" . $date . " 00:00:00' AND t.sub_date <= '" . $date . " 23:59:59'";
                    }
                    break;
                default:
                    $time_condition = " t.sub_date >= DATE_ADD('" . date('Y-m-d H:i:s') . "', INTERVAL -1 HOUR)";
            }
            $where[] = $time_condition;
        }
        $where = array_filter($where);
        $where = (count($where) > 0) ? '' . implode(' AND ', $where) : '';
        $criteria->condition = $where;
        $criteria->order = 'sub_date DESC';
        return $criteria;
    }
    /** ====== PROVIDER RELATED FUNCTION======= **/
    public function getProvidersById($provider_id) {
        if(!empty($provider_id)){
            $dbCommand = Yii::app()->dbHomeimprovement->createCommand()
                    ->select('provider_id,provider_name')
                    ->from('providers')
                    ->where('provider_id='.$provider_id);
            $dataReader = $dbCommand->queryRow();
        return $dataReader;
        }else{
            return [];
        }
    }
    public function getMatchingProviderFromPublisher($providerListFromBuyer,$default_provider='Unsure') {
        $provider_id = Yii::app()->request->getParam('project_provider');
        if($provider_id){
            $EBP_provider = $this->getProvidersById($provider_id);
            $pub_provider = trim(preg_quote($EBP_provider['provider_name'], '~'));
            $matching_provider = preg_grep('~' . $pub_provider . '~', $providerListFromBuyer);
            $matching_provider_name = is_array($matching_provider) ? array_shift($matching_provider) : $matching_provider;
            $matching_provider_name = $matching_provider_name == '' ? $default_provider : $matching_provider_name;
            $matching_provider = [
                'provider_id' => array_search($matching_provider_name,$providerListFromBuyer),
                'provider_name' => $matching_provider_name,
            ];
            return $matching_provider;
        }else{
            return null;
        }
    }
    public function getAstoriaTasksById($project_id,$task_id=null) {
        if(!empty($project_id)){
            $dbCommand = Yii::app()->dbHomeimprovement->createCommand()
                    ->select('astoria_project_id as project_id,astoria_task_id as task_id')
                    ->from('astoria_projects_tasks')
                    ->where('ecw_project_id=:project_id',[':project_id'=>$project_id]);
                    if(!empty($task_id)){
                        $dbCommand->andWhere('ecw_task_id=:task_id',[':task_id'=>$task_id]);
                    }
            //echo $dbCommand->getText();echo '<br>';exit;
            $dataReader = $dbCommand->queryRow();
            return $dataReader;    
        }else{
            return false;
        }
    }
    /** ====== PROVIDER RELATED FUNCTION======= **/
    /** ====== TASKS RELATED FUNCTION======= **/
    public function getTasksById($project_id,$task_id=null) {
        if(!empty($project_id)){
            $dbCommand = Yii::app()->dbHomeimprovement->createCommand()
                    ->select('project_id,task_id,task_name')
                    ->from('tasks')
                    ->where('project_id=:project_id',[':project_id'=>$project_id]);
                    if(!empty($task_id)){
                        $dbCommand->andWhere('task_id=:task_id',[':task_id'=>$task_id]);
                    }
            //echo $dbCommand->getText();echo '<br>';exit;
            $dataReader = $dbCommand->queryRow();
            return $dataReader;    
        }else{
            return false;
        }
    }
    public function getProjectTypeById($project_id) {
        if(!empty($project_id)){
            $dbCommand = Yii::app()->dbHomeimprovement->createCommand()
                    ->select('project_id,project_type')
                    ->from('projects')
                    ->where('project_id=:project_id',[':project_id'=>$project_id]);
                    $dbCommand->andWhere('status = 1');                    
            //echo $dbCommand->getText();echo '<br>';exit;
            $dataReader = $dbCommand->queryRow();
            return $dataReader;    
        }else{
            return false;
        }
    }
    public function getMatchingTaskFromPublisher($taskListFromBuyer,$default_task='Unsure') {
        $task = explode('_',Yii::app()->request->getParam('task'));
        $EBP_task = $this->getTasksById($task[0],$task[1]);
        $pub_task = trim(preg_quote($EBP_task['task_name'], '~'));
        $matching_task = preg_grep('~' . $pub_task . '~', $taskListFromBuyer);
        $matching_task_name = is_array($matching_task) ? array_shift($matching_task) : $matching_task;
        $matching_task_name = $matching_task_name == '' ? $default_task : $matching_task_name;
        $matching_task = [
            'task_id' => array_search($matching_task_name,$taskListFromBuyer),
            'task_name' => $matching_task_name,
        ];
        return $matching_task;
    }
    /** ====== TASKS RELATED FUNCTION======= **/
    public function getMatchingProjectFromPublisher($projectListFromBuyer,$default_project='Unsure') {
        $project_type_id = Yii::app()->request->getParam('project_type');
        $EBP_projects = $this->getProjectTypeById($project_type_id);
        $project_type = trim(preg_quote($EBP_projects['project_type'], '~'));
        $matching_project = preg_grep('~' . $project_type . '~', $projectListFromBuyer);
        $matching_project_type = is_array($matching_project) ? array_shift($matching_project) : $matching_project;
        $matching_project_type = $matching_project_type == '' ? $default_project : $matching_project_type;
        $matching_project = [
            'project_id' => array_search($matching_project_type,$projectListFromBuyer),
            'project_type' => $matching_project_type,
        ];
        return $matching_project;
    }
    /** ====== PROJECT TYPE RELATED FUNCTION======= **/

    /** ====== PROJECT TYPE RELATED FUNCTION======= **/
    public function update_returned_leads($returns){
        $retuned_ids = implode(',', $returns);
        $dbCommand = Yii::app()->dbHomeimprovement->createCommand();
        $affiliate_trans_ids_array = $dbCommand->select('id')->from('homeimprovement_affiliate_transactions')->where('customer_id IN ('.$retuned_ids.')')->queryAll();
        //echo $dbCommand->getText();echo '<br>';
        foreach($affiliate_trans_ids_array as $row){
            $aff_trans_ids[] = $row['id'];
        }
        $affiliate_trans_ids = implode(',', $aff_trans_ids);
        //echo $_POST['reason'];
        //$dbCommand->update('homeimprovement_submissions', array('is_returned'=>'1'), 'id IN ('.$retuned_ids.')');
        $dbCommand->update('homeimprovement_submissions', array('is_returned'=>'1','return_reason'=>$_POST['reason']), 'id IN ('.$retuned_ids.')');
        //echo $dbCommand->getText();exit;
        $dbCommand->update('homeimprovement_affiliate_transactions', array('is_returned'=>'1'), 'id IN ('.$affiliate_trans_ids.')');
        $dbCommand->update('homeimprovement_lender_transactions', array('is_returned'=>'1'), 'affiliate_transactions_id IN ('.$affiliate_trans_ids.') AND post_status=1');
        // DISABLED EMAIL TO AFFILIATE WHEN LEAD IS RETURN , ON REQUEST FROM GEOFF(ATOMIC)
        Yii::app()->user->setFlash('success','Leads Returned Successfully.');
    }
    public function warn_affiliate($affname, $affemail, $leadname, $leademail, $leadip, $leadtime, $promo_code = false) {
        $emails = preg_split('/,|;/', $affemail, -1, PREG_SPLIT_NO_EMPTY);
        $to = implode(',', $emails);
        $headers = 'From: support@elitehomeimprovers.com' . "\r\n" .
                'Bcc: ' . VIPUL . ', ' . DEVANG;
        $subject = 'Please remove this returned lead from your Elitehomeimprovement client tally';
        $message = wordwrap('Hello Elitehomeimprovement Affiliate: ' . $affname . '(Promo Code:' . $promo_code . '),
                
    This lead returned (see below). Please subtract this returned lead from your billing report and/or invoice. Please be sure to keep your client redirect rate over 85%. Please inform your clients to wait for the confirmation page to come up on their browser for their loan details. They must wait for the lender\'s URL so we can get compensated. You can log into your Elitehomeimprovement affiliate account at http://elitebizpanel.com/index.php/homeimprovement/default/login. Thanks and all the best!

        Name:      ' . $leadname . '
        Email:     ' . $leademail . '
        IP:        ' . $leadip . '
        Time/Date: ' . $leadtime . '
                
Have a great day!
                
Sincerely,
support@elitehomeimprovers.com
elitehomeimprovers.com Support Team
                
www.elitehomeimprovers.com
We Simplify Your Finances
                
Opt Out
elitehomeimprovers.com
138-07 82nd Drive
Briarwood, NY 11435
http://elitebizpanel.com/index.php/homeimprovement/default/removeme', 70);

        /** Unset the returned ids from post and session */
        unset($_POST['return']);
        if (isset(Yii::app()->session['returned_leads_searched_parameters']['return'])) {
            $session = Yii::app()->session;
            $vars = $session['returned_leads_searched_parameters'];
            $arraylen = count($vars);
            foreach ($vars as $key => $var) {
                if ($key == 'return') {
                    unset($vars[$key]);
                }
            }
            $session['returned_leads_searched_parameters'] = $vars;
        }
        /** Unset End */
        mail($to, $subject, $message, $headers);
    }
    public function check_accept_by_lender($lender_name,$lead_type=false) {
        $cmd = Yii::app()->dbHomeimprovement->createCommand()
            ->select('COUNT(b.id) accepted_cap')
            ->from('homeimprovement_lender_details a')
            ->join('homeimprovement_submissions b', 'a.id = b.lender_id')
            ->where('user_name=:lender_name', array(':lender_name'=>$lender_name));
            $cmd->andWhere('lead_status = 1');
            if(!empty($lead_type)){
                $cmd->andWhere('homeimprovement_lead_type=:lead_type', array(':lead_type'=>$lead_type));
            }
            $cmd->andWhere('DATE(sub_date)=:date', array(':date'=>date('Y-m-d')))
            ->limit('1');
            $AcceptedCapCount = $cmd->queryScalar();
            //mail('octobas@gmail.com','homeimprovement : multiple ping accepted lenders',$qry);
            return $AcceptedCapCount;
    }

    public function getGender($first_name) {
        $cmd = Yii::app()->dbHomeimprovement->createCommand()
            ->select('firstname')
            ->from('usa_females')
            ->where('firstname = "'.$first_name.'"')
            ->limit('1');
            $rs = $cmd->queryScalar();
            if(empty($rs)){
                $gender ='M';
            }else{
                $gender ='F';
            }
            return $gender;
    }
    public function checkPXSolarZipcode($zipcode) {
        $dbCommand = Yii::app()->dbHomeimprovement->createCommand()
                ->select('id')
                ->from('px_solar_zipcodes')
                ->where("zipcode='" .$zipcode. "'")
                ->limit('1');
        $dataReader = $dbCommand->query();
        if(count($dataReader) >= 1){
            return true;
        }else{
            return false;
        }
    }
    public function checkELocalZipcode($zipcode, $category_list_id)
    {
        $dbCommand = Yii::app()->dbHomeimprovement->createCommand()
            ->select('category_list_id')
            ->from('elocal_zipcode_list')
            ->where("zipcode='" . $zipcode . "' AND category_list_id='" . $category_list_id . "'")
            ->limit('1');
        $dataReader = $dbCommand->query();
        if (count($dataReader) >= 1) {
            return true;
        } else {
            return false;
        }
    }
}
