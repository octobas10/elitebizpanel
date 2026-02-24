<?php
class Submissions extends autoInsuranceActive {
    public $dob_month, $dob_day, $dob_year, $new_car;
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    public function tableName() {
        return 'autoinsurance_submissions';
    }
    public function attributeLabels() {
        return array('id' => 'Customer ID');
    }
    public function rules() {
        $required_data = array();
        $required_data[] = array('lead_mode', 'required', 'message' => 'Lead Mode is required');
        $required_data[] = array('lead_mode', 'in', 'range'=>array('1', '0'), 'message'=>'lead_mode should be 0 or 1');
        $required_data[] = array('promo_code', 'required', 'message' => 'Promo Code is required');
        $required_data[] = array('sub_id', 'required', 'message' => 'Sub Id is required');
        $required_data[] = array('tcpa_optin', 'required', 'message' => 'TCPA Optin is required');
        $required_data[] = array('tcpa_text', 'required', 'message' => 'Tcpa Text is required');
        $required_data[] = array('universal_leadid', 'required', 'message' => 'Universal Lead Id is required');
        //$required_data[] = array('zip','USPS_Validation','message'=>'Invalid Zip');
        $required_data[] = array('zip', 'required', 'message' => 'Zip is required');
        $required_data[] = array('zip', 'numerical', 'integerOnly' => true, 'message' => 'Zip should be numeric');
        $required_data[] = array('zip', 'length', 'min' => 5, 'max' => 5, 'message' => 'Zip should be numeric');
        $required_data[] = array('zip', 'match', 'pattern' => '/^[\-+]?[0-9]*\.?[0-9]+$/', 'message' => 'Invalid Zip');
		$required_data[] = array('ipaddress', 'required', 'message' => 'ipaddress is required');
        $required_data[] = array('is_rented', 'required', 'message' => 'Residence type is required');
        $required_data[] = array('is_rented', 'in', 'range' => array('rent', 'own'), 'message' => 'is_rented should be rent or own');
        $required_data[] = array('stay_in_year', 'required', 'message' => 'Years at current address is required');
        $required_data[] = array('stay_in_year', 'in', 'range' => range('0', '50'), 'message' => 'stay_in_year should be between 0, 50');
        $required_data[] = array('stay_in_month', 'required', 'message' => 'Months at current address required');
        //$required_data[] = array('stay_in_month', 'in', 'range' => range('0', '11'), 'message' => 'stay_in_month should be between 0, 11');
        $required_data[] = array('bankruptcy', 'length');
        $required_data[] = array('bankruptcy', 'in', 'range' => array('1', '0'), 'message' => 'bankruptcy should be 1 or 0');
        $required_data[] = array('coverage_type', 'required', 'message' => 'Coverage Type is required');
        $required_data[] = array('coverage_type', 'in', 'range' => range('1', '4'), 'message' => 'coverage_type should be between 1, 4');
        $required_data[] = array('vehicle_deductibles', 'required', 'message' => 'Comprehensive Deductible for policy is required');
        $required_data[] = array('vehicle_deductibles', 'in', 'range' => range('1', '8'), 'message' => 'vehicle_deductibles should be between 1, 8');
        $required_data[] = array('vehicle_collision_deductibles', 'required', 'message' => 'Collision Deductible for policy is required');
        $required_data[] = array('vehicle_collision_deductibles', 'in', 'range' => range('1', '8'), 'message' => 'vehicle_collision_deductibles should be between 1, 8');
        $required_data[] = array('medical_pay', 'required', 'message' => 'Amount of Medical Coverage is required');
        $required_data[] = array('medical_pay', 'in', 'range' => range('1', '8'), 'message' => 'medical_pay should be between 1, 8');
        $required_data[] = array('insurance_policy', 'required', 'message' => 'driver1 has a current auto insurance policy or not is required');
        $required_data[] = array('insurance_policy', 'in', 'range' => array('1', '0'), 'message' => 'insurance_policy should be 1 or 0');
        
        if (Yii::app()->request->getParam('insurance_policy') == 1) {
            $required_data[] = array('insurance_company', 'required', 'message' => 'current insurance company is required');
            $required_data[] = array('insurance_start_date', 'required', 'message' => 'current policy start date is required');
            $required_data[] = array('insurance_expiration_date', 'required', 'message' => 'current policy expiration date is required');
            $required_data[] = array('continuously_insured_period', 'required', 'message' => 'period of continuous auto insurance coverage is required');
            $required_data[] = array('continuously_insured_period', 'in', 'range' => range('1', '8'), 'message' => 'continuously_insured_period should be between 1, 8');
        }
        $required_data[] = array('driver1_gender', 'required', 'message' => 'Driver1 Gender is Required');
        $required_data[] = array('driver1_gender', 'in', 'range' => array('M', 'F'), 'message' => 'Driver1 gender should be M or F');
        $required_data[] = array('driver1_dob', 'required', 'message' => 'Driver1 Date of birth is required');
        $required_data[] = array('driver1_marital_status', 'required', 'message' => 'Driver1 Marital Status is reqiured');
        $required_data[] = array('driver1_marital_status', 'in', 'range' => range('1', '6'), 'message' => 'marital_status should be between 1, 6');
        $required_data[] = array('driver1_education', 'required', 'message' => 'Driver1 education level is reqiured');
        $required_data[] = array('driver1_education', 'in', 'range' => range('1', '9'), 'message' => 'education should be between 1, 9');
        $required_data[] = array('driver1_occupation', 'required', 'message' => 'Driver1 occupation is reqiured');
        $required_data[] = array('driver1_occupation', 'in', 'range' => range('1', '125'), 'message' => 'occupation should be between 1, 125');
        $required_data[] = array('driver1_required_SR22', 'required', 'message' => 'Driver1 SR22 is reqiured');
        $required_data[] = array('driver1_required_SR22', 'in', 'range' => array('1', '0'), 'message' => 'Driver1 SR22 should be 0 = SR22 NOT required , 1 = SR22 Required');
        $required_data[] = array('driver1_hasTAVCs', 'required', 'message' => 'Driver1 have any Tickets, Accidents, Violations or Claims is reqiured');
        $required_data[] = array('driver1_hasTAVCs', 'in', 'range' => array('1', '0'), 'message' => 'Driver1 have any Tickets should be 0 = No , 1 = Yes');
        if (Yii::app()->request->getParam('driver1_hasTAVCs')) {
            $required_data[] = array('driver1_num_of_incidents', 'required', 'message' => 'The number of incidents to report for driver1 is reqiured');
            $required_data[] = array('driver1_num_of_incidents', 'in', 'range' => range('1', '4'), 'message' => 'num_of_incidents should be between 1, 4');
            if (Yii::app()->request->getParam('driver1_num_of_incidents') >= 1) {
                $required_data[] = array('driver1_incident1_type', 'required', 'message' => 'The type of incident1 to report for driver1 is reqiured');
                $required_data[] = array('driver1_incident1_type', 'in', 'range' => range('1', '4'), 'message' => 'incident1_type should be between 1, 4');
                $required_data[] = array('driver1_incident1_date', 'required', 'message' => 'Date of Driver1 Incident1, in the format YYYY-MM-DD is reqiured');
                switch (Yii::app()->request->getParam('driver1_incident1_type')) {
                    case 1:
                        $required_data[] = array('driver1_ticket1_description', 'required', 'message' => 'Driver1 Ticket1 Description is reqiured');
                        break;
                    case 2:
                        $required_data[] = array('driver1_accident1_description', 'required', 'message' => 'Driver1 Accident1 Description is reqiured');
                        $required_data[] = array('driver1_accident1_damage', 'required', 'message' => 'Driver1 What was damaged is reqiured');
			            $required_data[] = array('driver1_accident1_damage', 'in', 'range' => range('1', '4'), 'message' => 'driver1_accident1_damage should be between 1, 4');
                        $required_data[] = array('driver1_accident1_at_fault', 'required', 'message' => 'Was Driver1 at fault is reqiured');
                        $required_data[] = array('driver1_accident1_amount', 'required', 'message' => 'Driver1 Total claim amount is reqiured');
                        break;
                    case 3:
                        $required_data[] = array('driver1_violation1_description', 'required', 'message' => 'Driver1 Violation1 Description is reqiured');
                        $required_data[] = array('driver1_violation1_state', 'required', 'message' => 'Driver1 State in which violation1 was committed is reqiured');
                        break;
                    case 4:
                        $required_data[] = array('driver1_claim1_description', 'required', 'message' => 'Driver1 Claim1 Description is reqiured');
                        $required_data[] = array('driver1_claim1_paid_amount', 'required', 'message' => 'Driver1 claim1_paid_amount is reqiured');
                        break;
                }
            }
            if (Yii::app()->request->getParam('driver1_num_of_incidents') >= 2) {
                $required_data[] = array('driver1_incident2_type', 'required', 'message' => 'The type of incident2 to report for driver1 is reqiured');
                $required_data[] = array('driver1_incident2_type', 'in', 'range' => range('1', '4'), 'message' => 'incident2_type should be between 1, 4');
                $required_data[] = array('driver1_incident2_date', 'required', 'message' => 'Date of Driver1 Incident2, in the format YYYY-MM-DD is reqiured');

                switch (Yii::app()->request->getParam('driver1_incident1_type')) {
                    case 1:
                        $required_data[] = array('driver1_ticket2_description', 'required', 'message' => 'Driver1 Ticket2 Description is reqiured');
                        break;
                    case 2:
                        $required_data[] = array('driver1_accident2_description', 'required', 'message' => 'Driver1 Accident2 Description is reqiured');
                        $required_data[] = array('driver1_accident2_damage', 'required', 'message' => 'Driver1 What was damaged2 is reqiured');
			$required_data[] = array('driver1_accident2_damage', 'in', 'range' => range('1', '4'), 'message' => 'driver1_accident2_damage should be between 1, 4');
                        $required_data[] = array('driver1_accident2_at_fault', 'required', 'message' => 'Driver1 accident2_at_faultt is reqiured');
                        $required_data[] = array('driver1_accident2_amount', 'required', 'message' => 'Driver1 accident2_amount is reqiured');
                        break;
                    case 3:
                        $required_data[] = array('driver1_violation2_description', 'required', 'message' => 'Driver1 Violation2 Description is reqiured');
                        $required_data[] = array('driver1_violation2_state', 'required', 'message' => 'Driver1 State in which violation2 was committed is reqiured');
                        break;
                    case 4:
                        $required_data[] = array('driver1_claim2_description', 'required', 'message' => 'Driver1 Claim2 Description is reqiured');
                        $required_data[] = array('driver1_claim2_paid_amount', 'required', 'message' => 'Driver1 claim2_paid_amount is reqiured');
                        break;
                }
            }
            if (Yii::app()->request->getParam('driver1_num_of_incidents') >= 3) {
                $required_data[] = array('driver1_incident3_type', 'required', 'message' => 'The type of incident3 to report for driver1 is reqiured');
                $required_data[] = array('driver1_incident3_type', 'in', 'range' => range('1', '4'), 'message' => 'incident3_type should be between 1, 4');
                $required_data[] = array('driver1_incident3_date', 'required', 'message' => 'Date of Driver1 Incident3, in the format YYYY-MM-DD is reqiured');

                switch (Yii::app()->request->getParam('driver1_incident1_type')) {
                    case 1:
                        $required_data[] = array('driver1_ticket3_description', 'required', 'message' => 'Driver1 Ticket3 Description is reqiured');
                        break;
                    case 2:
                        $required_data[] = array('driver1_accident3_description', 'required', 'message' => 'Driver1 Accident3 Description is reqiured');
                        $required_data[] = array('driver1_accident3_damage', 'required', 'message' => 'Driver1 What was damaged3 is reqiured');
			$required_data[] = array('driver1_accident3_damage', 'in', 'range' => range('1', '4'), 'message' => 'driver1_accident3_damage should be between 1, 4');
                        $required_data[] = array('driver1_accident3_at_fault', 'required', 'message' => 'Driver1 accident3_at_faultt is reqiured');
                        $required_data[] = array('driver1_accident3_amount', 'required', 'message' => 'Driver1 accident3_amount is reqiured');
                        break;
                    case 3:
                        $required_data[] = array('driver1_violation3_description', 'required', 'message' => 'Driver1 Violation3 Description is reqiured');
                        $required_data[] = array('driver1_violation3_state', 'required', 'message' => 'Driver1 State in which violation3 was committed is reqiured');
                        break;
                    case 4:
                        $required_data[] = array('driver1_claim3_description', 'required', 'message' => 'Driver1 Claim3 Description is reqiured');
                        $required_data[] = array('driver1_claim3_paid_amount', 'required', 'message' => 'Driver1 claim3_paid_amount is reqiured');
                        break;
                }
            }
            if (Yii::app()->request->getParam('driver1_num_of_incidents') == 4) {
                $required_data[] = array('driver1_incident4_type', 'required', 'message' => 'The type of incident4 to report for driver1 is reqiured');
                $required_data[] = array('driver1_incident4_type', 'in', 'range' => range('1', '4'), 'message' => 'incident4_type should be between 1, 4');
                $required_data[] = array('driver1_incident4_date', 'required', 'message' => 'Date of Driver1 Incident4, in the format YYYY-MM-DD is reqiured');
                switch (Yii::app()->request->getParam('driver1_incident1_type')) {
                    case 1:
                        $required_data[] = array('driver1_ticket4_description', 'required', 'message' => 'Driver1 Ticket4 Description is reqiured');
                        break;
                    case 2:
                        $required_data[] = array('driver1_accident4_description', 'required', 'message' => 'Driver1 Accident4 Description is reqiured');
                        $required_data[] = array('driver1_accident4_damage', 'required', 'message' => 'Driver1 What was damaged4 is reqiured');
			$required_data[] = array('driver1_accident4_damage', 'in', 'range' => range('1', '4'), 'message' => 'driver1_accident4_damage should be between 1, 4');
                        $required_data[] = array('driver1_accident4_at_fault', 'required', 'message' => 'Driver1 accident4_at_faultt is reqiured');
                        $required_data[] = array('driver1_accident4_amount', 'required', 'message' => 'Driver1 accident4_amount is reqiured');
                        break;
                    case 3:
                        $required_data[] = array('driver1_violation4_description', 'required', 'message' => 'Driver1 Violation4 Description is reqiured');
                        $required_data[] = array('driver1_violation4_state', 'required', 'message' => 'Driver1 State in which violation4 was committed is reqiured');
                        break;
                    case 4:
                        $required_data[] = array('driver1_claim4_description', 'required', 'message' => 'Driver1 Claim4 Description is reqiured');
                        $required_data[] = array('driver1_claim4_paid_amount', 'required', 'message' => 'Driver1 claim4_paid_amount is reqiured');
                        break;
                }
            }
        }
        if (Yii::app()->request->getParam('driver2_hasTAVCs')) {
            $required_data[] = array('driver2_num_of_incidents', 'required', 'message' => 'The number of incidents to report for driver1 is reqiured');
            $required_data[] = array('driver2_num_of_incidents', 'in', 'range' => range('1', '4'), 'message' => 'driver2_num_of_incidents should be between 1, 4');

            if (Yii::app()->request->getParam('driver2_num_of_incidents') >= 1) {
                $required_data[] = array('driver2_incident1_type', 'required', 'message' => 'The type of incident1 to report for driver1 is reqiured');
                $required_data[] = array('driver2_incident1_type', 'in', 'range' => range('1', '4'), 'message' => 'driver2_incident1_type should be between 1, 4');
                $required_data[] = array('driver2_incident1_date', 'required', 'message' => 'Date of Driver1 Incident1, in the format YYYY-MM-DD is reqiured');
                switch (Yii::app()->request->getParam('driver2_incident1_type')) {
                    case 1:
                        $required_data[] = array('driver2_ticket1_description', 'required', 'message' => 'Driver1 Ticket1 Description is reqiured');
                        break;
                    case 2:
                        $required_data[] = array('driver2_accident1_description', 'required', 'message' => 'Driver1 Accident1 Description is reqiured');
                        $required_data[] = array('driver2_accident1_damage', 'required', 'message' => 'Driver1 What was damaged is reqiured');
			$required_data[] = array('driver2_accident1_damage', 'in', 'range' => range('1', '4'), 'message' => 'driver2_accident1_damage should be between 1, 4');
                        $required_data[] = array('driver2_accident1_at_fault', 'required', 'message' => 'Was Driver1 at fault is reqiured');
                        $required_data[] = array('driver2_accident1_amount', 'required', 'message' => 'Driver1 Total claim amount is reqiured');
                        break;
                    case 3:
                        $required_data[] = array('driver2_violation1_description', 'required', 'message' => 'Driver1 Violation1 Description is reqiured');
                        $required_data[] = array('driver2_violation1_state', 'required', 'message' => 'Driver1 State in which violation1 was committed is reqiured');
                        break;
                    case 4:
                        $required_data[] = array('driver2_claim1_description', 'required', 'message' => 'Driver1 Claim1 Description is reqiured');
                        $required_data[] = array('driver2_claim1_paid_amount', 'required', 'message' => 'Driver1 claim1_paid_amount is reqiured');
                        break;
                }
            }
            if (Yii::app()->request->getParam('driver2_num_of_incidents') >= 2) {
                $required_data[] = array('driver2_incident2_type', 'required', 'message' => 'The type of incident2 to report for driver1 is reqiured');
                $required_data[] = array('driver2_incident2_type', 'in', 'range' => range('1', '4'), 'message' => 'driver2_incident2_type should be between 1, 4');
                $required_data[] = array('driver2_incident2_date', 'required', 'message' => 'Date of Driver1 Incident2, in the format YYYY-MM-DD is reqiured');
                
                switch (Yii::app()->request->getParam('incident1_type')) {
                    case 1:
                        $required_data[] = array('driver2_ticket2_description', 'required', 'message' => 'Driver1 Ticket2 Description is reqiured');
                        break;
                    case 2:
                        $required_data[] = array('driver2_accident2_description', 'required', 'message' => 'Driver1 Accident2 Description is reqiured');
                        $required_data[] = array('driver2_accident2_damage', 'required', 'message' => 'Driver1 What was damaged2 is reqiured');
			$required_data[] = array('driver2_accident2_damage', 'in', 'range' => range('1', '4'), 'message' => 'driver2_accident2_damage should be between 1, 4');
                        $required_data[] = array('driver2_accident2_at_fault', 'required', 'message' => 'Driver1 accident2_at_faultt is reqiured');
                        $required_data[] = array('driver2_accident2_amount', 'required', 'message' => 'Driver1 accident2_amount is reqiured');
                        break;
                    case 3:
                        $required_data[] = array('driver2_violation2_description', 'required', 'message' => 'Driver1 Violation2 Description is reqiured');
                        $required_data[] = array('driver2_violation2_state', 'required', 'message' => 'Driver1 State in which violation2 was committed is reqiured');
                        break;
                    case 4:
                        $required_data[] = array('driver2_claim2_description', 'required', 'message' => 'Driver1 Claim2 Description is reqiured');
                        $required_data[] = array('driver2_claim2_paid_amount', 'required', 'message' => 'Driver1 claim2_paid_amount is reqiured');
                        break;
                }
            }
            if (Yii::app()->request->getParam('driver2_num_of_incidents') >= 3) {
                $required_data[] = array('driver2_incident3_type', 'required', 'message' => 'The type of incident3 to report for driver1 is reqiured');
                $required_data[] = array('driver2_incident3_type', 'in', 'range' => range('1', '4'), 'message' => 'driver2_incident3_type should be between 1, 4');
                $required_data[] = array('driver2_incident3_date', 'required', 'message' => 'Date of Driver1 Incident3, in the format YYYY-MM-DD is reqiured');
                switch (Yii::app()->request->getParam('incident1_type')) {
                    case 1:
                        $required_data[] = array('driver2_ticket3_description', 'required', 'message' => 'Driver1 Ticket3 Description is reqiured');
                        break;
                    case 2:
                        $required_data[] = array('driver2_accident3_description', 'required', 'message' => 'Driver1 Accident3 Description is reqiured');
                        $required_data[] = array('driver2_accident3_damage', 'required', 'message' => 'Driver1 What was damaged3 is reqiured');
			$required_data[] = array('driver2_accident3_damage', 'in', 'range' => range('1', '4'), 'message' => 'driver2_accident3_damage should be between 1, 4');
                        $required_data[] = array('driver2_accident3_at_fault', 'required', 'message' => 'Driver1 accident3_at_faultt is reqiured');
                        $required_data[] = array('driver2_accident3_amount', 'required', 'message' => 'Driver1 accident3_amount is reqiured');
                        break;
                    case 3:
                        $required_data[] = array('driver2_violation3_description', 'required', 'message' => 'Driver1 Violation3 Description is reqiured');
                        $required_data[] = array('driver2_violation3_state', 'required', 'message' => 'Driver1 State in which violation3 was committed is reqiured');
                        break;
                    case 4:
                        $required_data[] = array('driver2_claim3_description', 'required', 'message' => 'Driver1 Claim3 Description is reqiured');
                        $required_data[] = array('driver2_claim3_paid_amount', 'required', 'message' => 'Driver1 claim3_paid_amount is reqiured');
                        break;
                }
            }
            if (Yii::app()->request->getParam('driver2_num_of_incidents') == 4) {
                $required_data[] = array('driver2_incident4_type', 'required', 'message' => 'The type of incident4 to report for driver1 is reqiured');
                $required_data[] = array('driver2_incident4_type', 'in', 'range' => range('1', '4'), 'message' => 'driver2_incident4_type should be between 1, 4');
                $required_data[] = array('driver2_incident4_date', 'required', 'message' => 'Date of Driver1 Incident4, in the format YYYY-MM-DD is reqiured');

                switch (Yii::app()->request->getParam('incident1_type')) {
                    case 1:
                        $required_data[] = array('driver2_ticket4_description', 'required', 'message' => 'Driver1 Ticket4 Description is reqiured');
                        break;
                    case 2:
                        $required_data[] = array('driver2_accident4_description', 'required', 'message' => 'Driver1 Accident4 Description is reqiured');
                        $required_data[] = array('driver2_accident4_damage', 'required', 'message' => 'Driver1 What was damaged4 is reqiured');
			$required_data[] = array('driver2_accident4_damage', 'in', 'range' => range('1', '4'), 'message' => 'driver2_accident4_damage should be between 1, 4');
                        $required_data[] = array('driver2_accident4_at_fault', 'required', 'message' => 'Driver1 accident4_at_faultt is reqiured');
                        $required_data[] = array('driver2_accident4_amount', 'required', 'message' => 'Driver1 accident4_amount is reqiured');
                        break;
                    case 3:
                        $required_data[] = array('driver2_violation4_description', 'required', 'message' => 'Driver1 Violation4 Description is reqiured');
                        $required_data[] = array('driver2_violation4_state', 'required', 'message' => 'Driver1 State in which violation4 was committed is reqiured');
                        break;
                    case 4:
                        $required_data[] = array('driver2_claim4_description', 'required', 'message' => 'Driver1 Claim4 Description is reqiured');
                        $required_data[] = array('driver2_claim4_paid_amount', 'required', 'message' => 'Driver1 claim4_paid_amount is reqiured');
                        break;
                }
            }
        }
        $required_data[] = array('vehicle1_year', 'required', 'message' => 'vehicle1_year is required');
        $required_data[] = array('vehicle1_make', 'required', 'message' => 'vehicle1_make is required');
        $required_data[] = array('vehicle1_model', 'required', 'message' => 'vehicle1_model is required');
        //$required_data[] = array('vehicle1_submodel', 'required', 'message' => 'vehicle1_submodel is required');
        //$required_data[] = array('vehicle1_vin', 'required', 'message' => 'vehicle1_vin is required');
        $required_data[] = array('vehicle1_primary_use', 'required', 'message' => 'vehicle1_primary_use is required');
        $required_data[] = array('vehicle1_primary_use', 'in', 'range' => range('1', '5'), 'message' => 'vehicle1_primary_use should be between 1, 5');
        $required_data[] = array('vehicle1_vehicle_ownership', 'required', 'message' => 'vehicle1_vehicle_ownership is required');
        $required_data[] = array('vehicle1_vehicle_ownership', 'in', 'range' => range('1', '2'), 'message' => 'vehicle1_vehicle_ownership should be between 1, 4');
        $required_data[] = array('vehicle1_daily_mileage', 'required', 'message' => 'vehicle1_daily_mileage is required');
        $required_data[] = array('vehicle1_daily_mileage', 'in', 'range' => range('1', '6'), 'message' => 'vehicle1_daily_mileage should be between 1, 6');
        $required_data[] = array('vehicle1_annual_mileage', 'required', 'message' => 'vehicle1_annual_mileage is required');
        $required_data[] = array('vehicle1_annual_mileage', 'in', 'range' => range('1', '9'), 'message' => 'vehicle1_annual_mileage should be between 1, 9');

        $required_data[] = array('vehicle2_primary_use', 'in', 'range' => range('1', '5'), 'message' => 'vehicle2_primary_use should be between 1, 4');
        $required_data[] = array('vehicle2_vehicle_ownership', 'in', 'range' => range('1', '2'), 'message' => 'vehicle2_vehicle_ownership should be between 1, 4');
        $required_data[] = array('vehicle2_daily_mileage', 'in', 'range' => range('1', '6'), 'message' => 'vehicle2_daily_mileage should be between 1, 6');
        $required_data[] = array('vehicle2_annual_mileage', 'in', 'range' => range('1', '9'), 'message' => 'vehicle2_annual_mileage should be between 1, 9');

		$required_data[] = array('sub_date','default','on'=>'insert','value'=>date('Y-m-d H:i:s'),'setOnEmpty'=>false);
        if (Yii::app()->session['ping_type'] == 'post' || Yii::app()->session['ping_type'] == 'directpost') {
            $required_data[] = array('driver1_first_name', 'required', 'message' => 'Driver1 First name is required');
            $required_data[] = array('driver1_last_name', 'required', 'message' => 'Driver1 Last name is required');
            $required_data[] = array('email', 'required', 'message' => 'email address is Required');
            $required_data[] = array('email', 'match', 'pattern' => '/^[A-Za-z0-9-+_\.]+@[A-Za-z0-9-\.]+$/', 'message' => 'Invalid Email address');
            $required_data[] = array('phone', 'required', 'message' => 'Phone is required');
            $required_data[] = array('phone', 'length', 'min' => 10, 'max' => 10, 'message' => 'phone should be numeric');
            $required_data[] = array('phone', 'match', 'pattern' => '/^(\+?1-?)?(\([2-9]([02-9]\d|1[02-9])\)|[2-9]([02-9]\d|1[02-9]))-?[2-9]([02-9]\d|1[02-9])-?\d{4}$/', 'message' => 'Invalid Phone');
            $required_data[] = array('address', 'required', 'message' => 'Address is required');
        }
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

//	public static function valid_dob($attribute,$params){
//		if(($params['dob_month'] == "") && ($params['dob_day'] == "") && ($params['dob_year'] == "")){
//			return false;
//		}else{
//			return true;
//		}
//	}
    public static function valid_zip($zip) {
        if (strlen(trim($zip)) < 5 || !preg_match('/^[\-+]?[0-9]*\.?[0-9]+$/', trim($zip))) {
            return false;
        } else {
            return true;
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

    public function getCityStateFromZip($zip) {
        $dbCommand = Yii::app()->dbAutoinsurance->createCommand()
                ->select('zipcode,city,UPPER(state) AS state')
                ->from('zipcodes')
                ->where('zipcode = "' . $zip . '"');
		//echo $queri = $dbCommand->getText();
        $dataReader = $dbCommand->queryRow();
        return $dataReader;
    }
	
	public function getInsuranceCompanyDetailsById($insurance_company_id) {
        $dbCommand = Yii::app()->dbAutoinsurance->createCommand()
                ->select('insurance_company_id, insurance_company_name')
                ->from('insurance_companies')
                ->where('insurance_company_id = "' . $insurance_company_id . '"');
		//echo $queri = $dbCommand->getText();
        $dataReader = $dbCommand->queryRow();
        return $dataReader;
    }
	public function getMatchingCompanyFromPublisher($companyListFromBuyer,$default_company='Company Not Listed') {
        $insurance_company_id = Yii::app()->request->getParam('insurance_company');
        $InsuranceComapany = $this->getInsuranceCompanyDetailsById($insurance_company_id);
        $pub_company = trim(preg_quote($InsuranceComapany['insurance_company_name'], '~'));
        //$matching_company = preg_grep ('/^'.$pub_company.' (\w+)/i',$companyListFromBuyer);
		$matching_company = preg_grep('~' . $pub_company . '~', $companyListFromBuyer);
        $matching_company_one = is_array($matching_company) ? array_shift($matching_company) : $matching_company;
         $matching_company_one = $matching_company_one == '' ? $default_company : $matching_company_one;
        return $matching_company_one;
    }
    public function getOccupationById($occupation_id) {
        $dbCommand = Yii::app()->dbAutoinsurance->createCommand()
                ->select('occupation_id, occupation_name')
                ->from('driver_occupation')
                ->where('occupation_id = "' . $occupation_id . '"');
        $dataReader = $dbCommand->queryRow();
        return $dataReader;
    }
    public function getMatchingOccupationFromPublisher($occupationListFromBuyer,$default_occupation='Other',$occupation_id = 123) {
        $Occupations = $this->getOccupationById($occupation_id);
        $pub_occupation = trim(preg_quote($Occupations['occupation_name'], '~'));
        $matching_occupation = preg_grep('~' . $pub_occupation . '~', $occupationListFromBuyer);
        $matching_occupation_one = is_array($matching_occupation) ? array_shift($matching_occupation) : $matching_occupation;
        $matching_occupation_one = $matching_occupation_one == '' ? $default_occupation : $matching_occupation_one;
        return $matching_occupation_one;
    }
    public function getDriverTicketDescriptionById($descrtion_id) {
        $dbCommand = Yii::app()->dbAutoinsurance->createCommand()
                ->select('descrtion_id, descrtion_name')
                ->from('driver_ticket_description')
                ->where('descrtion_id = "' . $descrtion_id . '"');
        $dataReader = $dbCommand->queryRow();
        return $dataReader;
    }
    public function checkDuplicate($data) {
        $dbCommand = Yii::app()->dbAutoinsurance->createCommand()
                ->select('id')
                ->from('autoinsurance_submissions')
                ->where("email='" . $data['email'] . "' AND phone=" . $data['phone'] . " AND driver1_last_name='" . $data['driver1_last_name'] . "' AND UNIX_TIMESTAMP(sub_date)>" . @strtotime('-1 month'))
                ->limit('1');
        $dataReader = $dbCommand->query();
        return $count = count($dataReader);
    }

    public function checkPingDuplicate($data) {
        $dbCommand = Yii::app()->dbAutoinsurance->createCommand()
                ->select('dup_days')
                ->from('autoinsurance_affiliate_user')
                ->where("id = " . $data['promo_code']);
        $dataReader = $dbCommand->queryRow();
        $dup_days = $dataReader['dup_days'];
        $dup_days = (isset($dup_days) && !empty($dup_days)) ? '-' . $dup_days . ' days' : '-6 months';
        
        $dbCommand = Yii::app()->dbAutoinsurance->createCommand()
                ->select('id')
                ->from('autoinsurance_submissions')
                ->where("email = '" . $data['email'] . "' AND `sub_date` > '" . date('Y-m-d', strtotime($dup_days)) . " 00:00:00'")
                ->limit('1');
				//$dataReader = $dbCommand->query();
				//$queri = $dbCommand->getText();
				//mail('octobas@gmail.com','The count submission.php 184',$queri.'-'.count($dataReader));
				//return $count = count($dataReader);
        return 0;
    }

    public function afterSave() {
        $id = Yii::app()->dbAutoinsurance->getLastInsertId();
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
//		if($monthly_income = Yii::app()->request->getParam("monthly_income")){
//			$where[] = "a_sub.monthly_income = ".$monthly_income;
//		}
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
//		if(Yii::app()->request->getParam("gender")!='-1'){
//			$gender = Yii::app()->getRequest()->getParam("gender");
//			$gender = ($gender=='1') ? 'M' : 'F';
//			$where[] = "a_sub.gender = '".$gender."'";
//		}
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
            $fields_request = array("id", "promo_code", "driver1_first_name", "driver1_last_name", "sub_date", "email");
            $fields = '';
            foreach ($fields_request as $value) {
                $fields .= "a_sub." . $value . ',';
            }
        }
        $where = array_filter($where);
        $where = (count($where) > 0) ? '' . implode(' AND ', $where) : '';
        //echo'<pre>';print_r($where);echo'</pre>';
        $rawData = Yii::app()->dbAutoinsurance->createCommand()
                ->select($fields)
                ->from("autoinsurance_submissions a_sub")
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
        /* $combine_data_query = 'SELECT SUM(if(sub_date >= DATE_SUB(CURDATE(),INTERVAL 1 WEEK) , 1, 0)) as week_submission, SUM(if(sub_date >= DATE_SUB(CURDATE(),INTERVAL 1 MONTH) , 1, 0)) as month_submission FROM autoinsurance_submissions'; */
        $combine_data_query = 'SELECT t1.week_submission, t2.month_submission
			FROM (SELECT count(*) AS week_submission
			FROM autoinsurance_submissions
			WHERE sub_date >= DATE_SUB(CURDATE(),INTERVAL 1 WEEK)) t1,
			(SELECT count(*) AS month_submission
			FROM autoinsurance_submissions
			WHERE sub_date >= DATE_SUB(CURDATE(),INTERVAL 1 MONTH)) t2';

        $command = Yii::app()->dbAutoinsurance->createCommand($combine_data_query);
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
        $rawData = Yii::app()->dbAutoinsurance->createCommand()
                ->select('promo_code,driver1_first_name,driver1_last_name,email,phone,zip,ipaddress,lender_id,sub_date,lender_lead_price,vendor_lead_price')
                ->from('autoinsurance_submissions')
                ->where($where)
                ->order('')
                ->queryAll();
        return $rawData;
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
        $rawData = Yii::app()->dbAutoinsurance->createCommand()
                ->select('customer_id')
                ->from('autoinsurance_affiliate_transactions')
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
        $where = 'lead_status=1 AND sub_date >= "' . $sdate . '" and sub_date <= "' . $edate . '"';
        $groupby = 'DATE(sub_date)';
        $orderby = 'sub_date desc';
        $dbCommand = Yii::app()->dbAutoinsurance->createCommand()
                ->select($fields)
                ->from("autoinsurance_submissions a_sub")
                ->where($where)
                ->order($orderby)
                ->group($groupby);
		//echo $dbCommand->getText();exit;
        $rawData = $dbCommand->queryAll();
        $revenue_seller = [];$revenue_buyers =[];$leads = [];$profit = [];
        foreach ($rawData as $row) {
			$revenue_seller[$row['date']] 	= ($row['vendor_price']);
			$revenue_buyers[$row['date']] 	= ($row['buyer_price']);
			$profit[$row['date']] = (($row['buyer_price'] - $row['vendor_price']));
			$leads[$row['date']] = $row['total'];
        }
        return array(
			'profit' => $profit, 
			'revenue_buyer' => $revenue_buyers, 
			'revenue_seller' => $revenue_seller, 
			'leads' => $leads
		);
    }

    public function search_return_leads() {
        $criteria = new CDbCriteria();
        $criteria->select = 'id,promo_code,driver1_first_name,driver1_last_name,email,ipaddress,lead_status,lender_id,lender_lead_price,is_returned,sub_date,return_reason';
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
	public function update_returned_leads($returns){
		$retuned_ids = implode(',', $returns);
		$dbCommand = Yii::app()->dbAutoinsurance->createCommand();
		$affiliate_trans_ids_array = $dbCommand->select('id')->from('autoinsurance_affiliate_transactions')->where('customer_id IN ('.$retuned_ids.')')->queryAll();
		//echo $dbCommand->getText();echo '<br>';
		foreach($affiliate_trans_ids_array as $row){
			$aff_trans_ids[] = $row['id'];
		}
		$affiliate_trans_ids = implode(',', $aff_trans_ids);
		//echo $_POST['reason'];
		//$dbCommand->update('autoinsurance_submissions', array('is_returned'=>'1'), 'id IN ('.$retuned_ids.')');
		$dbCommand->update('autoinsurance_submissions', array('is_returned'=>'1','return_reason'=>$_POST['reason']), 'id IN ('.$retuned_ids.')');
		//echo $dbCommand->getText();exit;
		$dbCommand->update('autoinsurance_affiliate_transactions', array('is_returned'=>'1'), 'id IN ('.$affiliate_trans_ids.')');
		$dbCommand->update('autoinsurance_lender_transactions', array('is_returned'=>'1'), 'affiliate_transactions_id IN ('.$affiliate_trans_ids.') AND post_status=1');
		// DISABLED EMAIL TO AFFILIATE WHEN LEAD IS RETURN , ON REQUEST FROM GEOFF(ATOMIC)

		Yii::app()->user->setFlash('success','Leads Returned Successfully.');
	}
    

    public function warn_affiliate($affname, $affemail, $leadname, $leademail, $leadip, $leadtime, $promo_code = false) {
        $emails = preg_split('/,|;/', $affemail, -1, PREG_SPLIT_NO_EMPTY);
        $to = implode(',', $emails);
        $headers = 'From: support@eliteinsurers.com' . "\r\n" .
                'Bcc: ' . VIPUL . ', ' . DEVANG;
        $subject = 'Please remove this returned lead from your Eliteinsurers client tally';
        $message = wordwrap('Hello Eliteinsurers Affiliate: ' . $affname . '(Promo Code:' . $promo_code . '),
				
	This lead returned (see below). Please subtract this returned lead from your billing report and/or invoice. Please be sure to keep your client redirect rate over 85%. Please inform your clients to wait for the confirmation page to come up on their browser for their loan details. They must wait for the lender\'s URL so we can get compensated. You can log into your Eliteinsurers affiliate account at http://elitebizpanel.com/index.php/autoinsurance/default/login. Thanks and all the best!

		Name:      ' . $leadname . '
		Email:     ' . $leademail . '
		IP:        ' . $leadip . '
		Time/Date: ' . $leadtime . '
				
Have a great day!
				
Sincerely,
support@eliteinsurers.com
Eliteinsurers.com Support Team
				
www.eliteinsurers.com
We Simplify Your Finances
				
Opt Out
Eliteinsurers.com
138-07 82nd Drive
Briarwood, NY 11435
http://elitebizpanel.com/index.php/autoinsurance/default/removeme', 70);

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

}
