<?php
class ClickthesisController extends Controller {
    public function __construct() {
    }
    /**
     * Create Ping Request for Lender
     */
    public static function getHost($url, $accept_www=false){
	    $url = str_replace(["%3A","%2F"],[':','/'],$url);
	    $URIs = parse_url(trim($url)); 
	    $host = !empty($URIs['host'])? $URIs['host'] : explode('/', $URIs['path'])[0];
	    return $accept_www == false? str_ireplace('www.', '', $host) : $host;  
	} 
    public static $not_allowed = ['roofingquote.io','myhomequote.com','homeupgradepros.us','bathremodel.io','quotewallet.com','findmywindowpro.com','remodelwell.com','topwindows.com','intentlab.com','homefixxer.net','localbathadvisor.com','nationwidebathrooms.online','24hrbathroomremodel.com','hotwindows.io','renovate.co','bath-and-shower-remodel.find-a-quote.io','homeupgradeprofessionals.com','trustedroofingresource.com','services.remodeling.com','nationwideroofing.net','homewindowcost.com','koalatybath.com','one-day-bathroom-renovation.com','koalatywindows.com','wp.remodeling.com','gutterprotection.io','remodelingservice.net','homesolutions.com','mclaughlin.com','home-improvements.co','homeiq.io','windowquotes.com','homeupgradeprofessionals.com','homerenovationexperts.org','adopt-a-contractor.com','getwindowstoday.com','epathdigital.com','gethomecontractors.com','myquotewallet.com','nationwidewindows.online','bathremodelspecialists.com','housewindows.net','homeiq.expert','helloprojectusa.com','secure.homeservice.live','home.contractors'];
	// ============== 
	public static function getPurchaseTimeFrame($time_frame){
    	switch ($time_frame) {
			case '1':
				$purchase_time_frame = '7';
				break;
			case '2':
				$purchase_time_frame = '30';
				break;
			case '3':
				$purchase_time_frame = '90';
				break;
			case '4':
				$purchase_time_frame = '120';
				break;
			case '5':
				$purchase_time_frame = '120';
				break;
			default:
				$purchase_time_frame = '7';
				break;
		}
		return $purchase_time_frame;
    }
	public static function getRoofingMatirialType($rooting_type){
    	switch ($rooting_type) {
			case '1':
				$roof_type = 'shingles';
				break;
			case '2':
				$roof_type = 'flat';
				break;
			case '3':
				$roof_type = 'metal';
				break;
			case '4':
				$roof_type = 'wood';
				break;
			case '5':
				$roof_type = 'tile';
				break;
			case '6':
				$roof_type = 'slate';
				break;
			default:
				$roof_type = 'shingles';
				break;
		}
		return $roof_type;
    }
	public static function getBathroomProjectType($category_type){
    	switch ($category_type) {
			case '13_1':
				$bath_type = 'walkin_tub';
				break;
			case '13_2':
				$bath_type = 'bathtub_upgrade';
				break;
			case '13_3':
				$bath_type = 'shower_upgrade';
				break;
			case '13_4':
				$bath_type = 'bathtub_upgrade';
				break;
			case '13_5':
				$bath_type = 'shower_upgrade';
				break;
			case '13_6':
				$bath_type = 'complete_remodel';
				break;
			case '13_7':
				$bath_type = 'bath_to_shower';
				break;
			default:
				$bath_type = 'complete_remodel';
				break;
		}
		return $bath_type;
    }
	public static function getPropertyType($property_type){
    	switch ($property_type) {
			case '1':
				$propertytype = 'single_family';
				break;
			case '2':
				$propertytype = 'single_family';
				break;
			case '3':
				$propertytype = 'townhome';
				break;
			case '4':
				$propertytype = 'condo';
				break;
			case '5':
				$propertytype = 'condo';
				break;
			case '6':
				$propertytype = 'mobile';
				break;
			default:
				$propertytype = 'single_family';
				break;
		}
		return $propertytype;
    }
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0, $ping_url = null) {
		$promo_code = Yii::app()->request->getParam('promo_code');
		$submission_model = new Submissions();
		$zip_code = Yii::app()->request->getParam('zip');
		$city_state = $submission_model->getCityStateFromZip($zip_code);
		$project_type = Yii::app()->request->getParam('project_type');
		$task = Yii::app()->request->getParam('task');
		if($promo_code != 0){
			$pingData = [];
			$campaign = [];
			$project_type_name = '';
			// REMODEL WELL
			if($project_type == 13){ //BATHROOM
				$project_type_name = 'bathroom';
				$property_type_name = 'Residential';
				$campaign['remodel_type'] = self::getBathroomProjectType($task);
				$campaign['home_type'] = self::getPropertyType(Yii::app()->request->getParam('property_type'));
			}
			if($project_type == 30){ //GUTTERS
				$project_type_name = 'gutters';
				$property_type_name = 'Residential';
				$campaign['gutter_service'] = "install";
			}
			if($project_type == 42){ //ROOFING
				$project_type_name = 'roofing';
				$property_type_name = 'Residential';
				$campaign['product_type'] = self::getRoofingMatirialType(Yii::app()->request->getParam('roofing_type'));
				$campaign['install_repair'] = "Install";
			}
			if($project_type == 52){ //WINDOWS
				$project_type_name = 'windows';
				$property_type_name = 'Residential';
				$campaign['install_repair'] = "Install";
				$campaign['product_count'] = Yii::app()->request->getParam('number_of_windows');
			}
			if($project_type_name !=''){
				$fields = [
					"sub_id"=> Yii::app()->request->getParam('promo_code'),
					"unique_id"=> Yii::app()->session['affiliate_trans_id'],
					"client_ip_address"=> Yii::app()->request->getParam('ipaddress'),
					"trusted_form_cert_url"=> Yii::app()->request->getParam('trustedformcerturl'),
					"website_url"=> Yii::app()->request->getParam('url'),
					"city"=> Yii::app()->request->getParam('city',$city_state['city']),
					"state"=> Yii::app()->request->getParam('state',$city_state['state']),
					"zip_code"=> Yii::app()->request->getParam('zip'),
					"home_owner"=> Yii::app()->request->getParam('home_owner')=='1' ? 'True' : 'False',
					"tcpa_statement"=> Yii::app()->request->getParam('tcpa_text'),
					"user_agent"=> Yii::app()->request->getParam('user_agent'),
					"project_type"=> $project_type_name,
					"property_type"=> $property_type_name,
					"project_start"=> self::getPurchaseTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2))),
					"project_start"=> "30",
					"need_finance"=> "True",
					"test_lead"=> "false",
				];
				$fields += $campaign;
				//echo '<pre>....';print_r($fields);exit;
				$purchase = true;
				$url = Yii::app()->request->getParam('url');
				if(in_array(self::getHost($url),self::$not_allowed)){
					$purchase = false;
				}
				if($purchase == true){
					$pingData['ping_request'] = json_encode($fields);
					$pingData['ping_url'] = $ping_url;
					$pingData['header'] = ["x-api-key: 433710ed-adad-4dbf-aca3-e9291ea6fb08","Content-Type: application/json"];
				}else{
					$pingData['ping_request'] = false;
					$pingData['ping_response_filtered'] = 'URL Filter applied';
				}
				//echo '<pre>...';print_r($pingData);exit;
				return $pingData;
			}else{
				$pingData['ping_request'] = false;
				$pingData['ping_response_filtered'] = 'Out of Given Categories';
				return $pingData;
			}
			
			
		}
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
        $success = json_decode($ping_response,TRUE);
        if(trim($success['accepted']) == 'true' || trim($success['accepted']) == true ){
        	$ping_price = isset($success['bidPrice']) ? $success['bidPrice'] : 0;
            $confirmation_id = $success['pingId'];
            $ping_response_info['ping_price'] = trim($ping_price);
            $ping_response_info['ping_status'] = '1';
            $ping_response_info['confirmation_id'] = $confirmation_id;
        } else {
            $ping_price = 0;
            $ping_response_info['ping_price'] = $ping_price;
            $ping_response_info['ping_status'] = '0';
            $ping_response_info['confirmation_id'] = '';
        }
        return $ping_response_info;
    }
    /**
     * Send Post Data to Lender
     */
    public static function sendPostData($p1, $p2, $p3, $ping_response, $post_url, $status) {
		$promo_code = Yii::app()->request->getParam('promo_code');
		$submission_model = new Submissions();
		$zip_code = Yii::app()->request->getParam('zip');
		$city_state = $submission_model->getCityStateFromZip($zip_code);
		$project_type = Yii::app()->request->getParam('project_type');
		$task = Yii::app()->request->getParam('task');
		//echo '<pre>';print_r($ping_response);exit;
		if($promo_code != 0){
			$success = json_decode($ping_response,TRUE);
			$confirmation_id = $success['pingId'];
			$campaign = [];
			if($project_type == 13){ //BATHROOM
				$project_type_name = 'bathroom';
				$property_type_name = 'Residential';
				$campaign['remodel_type'] = self::getBathroomProjectType($task);
				$campaign['home_type'] = self::getPropertyType(Yii::app()->request->getParam('property_type'));
			}
			if($project_type == 30){ //GUTTERS
				$project_type_name = 'gutters';
				$property_type_name = 'Residential';
				$campaign['gutter_service'] = "install";
			}
			if($project_type == 42){ //ROOFING
				$project_type_name = 'roofing';
				$property_type_name = 'Residential';
				$campaign['product_type'] = self::getRoofingMatirialType(Yii::app()->request->getParam('roofing_type'));
				$campaign['install_repair'] = "Install";
			}
			if($project_type == 52){ //WINDOWS
				$project_type_name = 'windows';
				$property_type_name = 'Residential';
				$campaign['install_repair'] = "Install";
				$campaign['product_count'] = Yii::app()->request->getParam('number_of_windows');
			}
			
			$fields = [
			    "ping_id"=> $confirmation_id,
				"sub_id"=> Yii::app()->request->getParam('promo_code'),
				"unique_id"=> Yii::app()->session['affiliate_trans_id'],
				"client_ip_address"=> Yii::app()->request->getParam('ipaddress'),
				"test_lead"=> "True",
				"trusted_form_cert_url"=> Yii::app()->request->getParam('trustedformcerturl'),
				"website_url"=> Yii::app()->request->getParam('url'),
				"first_name"=> Yii::app()->request->getParam('first_name'),
				"last_name"=> Yii::app()->request->getParam('last_name'),
				"email"=> Yii::app()->request->getParam('email'),
				"phone"=> Yii::app()->request->getParam('phone'),
				"street_address"=> Yii::app()->request->getParam('address'),
				"city"=> Yii::app()->request->getParam('city',$city_state['city']),
				"state"=> Yii::app()->request->getParam('state',$city_state['state']),
				"zip_code"=> Yii::app()->request->getParam('zip'),
				"home_owner"=> Yii::app()->request->getParam('home_owner')=='1' ? 'True' : 'False',
				"tcpa_statement"=> Yii::app()->request->getParam('tcpa_text'),
				"user_agent"=> Yii::app()->request->getParam('user_agent'),
				"project_type"=> $project_type_name,
				"property_type"=> $property_type_name,
				"project_start"=> self::getPurchaseTimeFrame(Yii::app()->request->getParam('time_frame',rand(1,2))),
				"need_finance"=> "True",
				"test_lead"=> "false",
			];
			$fields += $campaign;
			$post_request = json_encode($fields);
			//echo $post_url;echo '<pre>';print_r($post_request);exit;
			$cm = new CommonMethods();
			$start_time = CommonToolsMethods::stopwatch();
			$header = ["x-api-key: 433710ed-adad-4dbf-aca3-e9291ea6fb08","Content-Type: application/json"];
        	$post_response = $cm->curl($post_url,$post_request,$header,'post');
			//echo '<pre>Post Response:';print_r($post_response);exit;
			$time_end = CommonToolsMethods::stopwatch();
			$result = json_decode($post_response,TRUE);
			if(trim($result['accepted']) == 'true' || trim($result['accepted']) == true){
				$post_status = '1';
                $ping_price = isset($success['bidPrice']) ? $success['bidPrice'] : 0;
                $post_price = isset($result['bidPrice']) ? $result['bidPrice'] : 0;
                $post_price = isset($ping_price) ? $ping_price : $post_price;
				$redirect_url = '';
			} else {
				$post_status = '0';
				$post_price = 0;
				$redirect_url = '';
			}
			$post_time = ($time_end - $start_time);
			$post_responses['post_request'] = $post_request;
			$post_responses['post_response'] = $post_response;
			$post_responses['post_status'] = $post_status;
			$post_responses['post_price'] = $post_price;
			$post_responses['redirect_url'] = $redirect_url;
			$post_responses['post_time'] = $post_time;
			return $post_responses;
		}
    }
}