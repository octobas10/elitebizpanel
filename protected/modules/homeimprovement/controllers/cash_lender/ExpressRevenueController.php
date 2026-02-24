<?php
class ExpressRevenueController extends Controller {
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
    public static $not_allowed = ['casautilities.com','contractorscan.com','findmywindowpro.com','homeappointments.com','home-revivals.us','homewindowsurvey.com','homewindows.net','netwayi.com','nationwidewindows.online','nationalwindows.online','simplehome-quotes.com','adopt-a-contractor.com','casautilities.com','findmyroofingpro.com','homefixwiz.com','helloprojectusa.com','home-improvements.co','homepros123.com','homequote.io','quotewallet.com','nationwideroofing.net','nationalroofing.online','parasolleads.com','top10us.com','thequotematch.com','asksolar.com','go4solarsavings.com','nationwidesolar.energy','smart-solar-savings-center.com','ready4solar.com','bathremodelspecialists.com','homelix.co','nationwidebathrooms.online','Freshhammer.com','Fixerjoe.com','upgrades4myhome.com','betterhomeupgrade.com','smarthouseupgrades.com','nationalgutterupgrades.com','nationalbathroomupgrades.com','nationalsidingupgrades.com','nationalwindowsupgrades.com','nationalroofingupgrades.com','nationalsolarupgrades.com','nationalpaintingupgrades.com','nationalhvacupgrades.com','nationalkitchenupgrades.com','solaronlinesurvey.com','ready4solar.com','go4solarsavings.com','solarsurveyquote.com','gowithsolarenergy.com','Ehomeimprovementquotes.com','Billy.com','Buyerlink.com','Remodelwell.com','Thedoorstepservices.com','contractors99.com'];
    public static $creditRating = [
        1 => 'excellent',
        2 => 'good',
        3 => 'fair',
        4 => 'poor',
    ];
    public static function getElectricityBill($electricity_bill){
    	switch ($electricity_bill) {
			case '1':
				$ele_bill = '50';
				break;
			case '2':
				$ele_bill = '100';
				break;
			case '3':
				$ele_bill = '150';
				break;
			case '4':
				$ele_bill = '200';
				break;
			case '5':
				$ele_bill = '300';
				break;
			case '6':
				$ele_bill = '400';
				break;
			case '7':
				$ele_bill = '500';
				break;
			case '8':
				$ele_bill = '600';
				break;
			case '9':
				$ele_bill = '700';
				break;
			case '10':
				$ele_bill = '800';
				break;
			case '11':
				$ele_bill = '1000';
				break;
		}
		return $ele_bill;
    }

    public static function getRoofingCategory($category_type){
    	switch ($category_type) {
			case '1':
				$category = 'asphalt';
				break;
			case '2':
				$category = 'wood';
				break;
			case '3':
				$category = 'metal';
				break;
			case '4':
				$category = 'clay';
				break;
			case '5':
				$category = 'Tile';
				break;
			case '6':
				$category = 'slate';
				break;
			default:
				$category = 'unsure';
				break;
		}
		return $category;
    }
    public static function getBathroomProjectType($category_type){
    	switch ($category_type) {
			case '13_1':
				$bath_type = 'new bath';
				break;
			case '13_2':
				$bath_type = 'new bath';
				break;
			case '13_3':
				$bath_type = 'walk-in bath';
				break;
			case '13_4':
				$bath_type = 'complete remodel';
				break;
			case '13_5':
				$bath_type = 'shower_upgrade';
				break;
			case '13_6':
				$bath_type = 'walk-in bath';
				break;
			case '13_7':
				$bath_type = 'new shower';
				break;
			case '13_8':
				$bath_type = 'walk-in bath';
				break;
			case '13_9':
				$bath_type = 'new bath';
				break;
			case '13_10':
				$bath_type = 'new shower';
				break;
			default:
				$bath_type = 'complete_remodel';
				break;
		}
		return $bath_type;
    }
	public static function getUserAgent(){
		return 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Ubuntu Chromium/37.0.2062.94 Chrome/37.0.2062.94 Safari/537.36';
	}
	public static $BuildingType = [
		1=>'single family',
		2=>'condominium',
		3=>'townhome',
		4=>'condominium',
		5=>'manufactured',
		6=>'mobile home',
		7=>'single family',
	];
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0, $ping_url = null) {
		$promo_code = Yii::app()->request->getParam('promo_code');
		$submission_model = new Submissions();
		$zip_code = Yii::app()->request->getParam('zip');
		$city_state = $submission_model->getCityStateFromZip($zip_code);
		$project_type = Yii::app()->request->getParam('project_type');
        $task = Yii::app()->request->getParam('task');
		if($promo_code != 0){
			$pingData = [];
            if($project_type == 13){ //BATHROOM
				$campaign['project_type'] = self::getBathroomProjectType($task);
                $campaign['home_owner'] = Yii::app()->request->getParam('home_owner')=='1' ? 'yes' : 'no';
				$campaign['add_remove_walls'] = 'unsure';
				$campaign['zip_code'] = Yii::app()->request->getParam('zip');
				$campaign['tcpa_text'] = Yii::app()->request->getParam('tcpa_text');
				$campaign['ip_address'] = Yii::app()->request->getParam('ipaddress');
				$campaign['sourceURL'] = Yii::app()->request->getParam('url','https://elitehomeimprovers.com');
                $lp_campaign_id = '22662';
				$lp_supplier_id = '75242';
                $lp_key = 'jnkpaky6lu06ov';
			}
			if($project_type == 42){//ROOFING
				$campaign['roof_material'] =  self::getRoofingCategory(Yii::app()->request->getParam('roofing_type',rand(1,2)));
                $campaign['project_type'] = date('N')%2 == 0 ? 'repair' : 'replace';
                $campaign['home_owner'] = Yii::app()->request->getParam('home_owner')=='1' ? 'yes' : 'no';
				$campaign['zip_code'] = Yii::app()->request->getParam('zip');
				$campaign['tcpa_text'] = Yii::app()->request->getParam('tcpa_text');
				$campaign['ip_address'] = Yii::app()->request->getParam('ipaddress');
				$campaign['sourceURL'] = Yii::app()->request->getParam('url','https://elitehomeimprovers.com');
				$lp_campaign_id = '22408';
				$lp_supplier_id = '75239';
                $lp_key = '0ez7f1vk6brg6p';
			}
			if($project_type == 45){//SOLAR
				$project_provider = $submission_model->getProvidersById(Yii::app()->request->getParam('project_provider'));
				$campaign['homeowner'] = Yii::app()->request->getParam('home_owner')=='1' ?  'true' : 'false';
                $campaign['submissionURL'] = 'https://elitehomeimprovers.com';
                $campaign['installORrepair'] = date('N')%2 == 0 ? 'install' : 'repair';
				$campaign['electricProvider'] = $project_provider['provider_name'];
				$campaign['shade'] = Yii::app()->request->getParam('roof_shade');
				$campaign['avgElectricBill'] = self::getElectricityBill(Yii::app()->request->getParam('monthly_bill'));
				$campaign['creditscore'] = self::$creditRating[Yii::app()->request->getParam('credit_rating','2')];
				$campaign['zipCode'] = Yii::app()->request->getParam('zip');
				$campaign['consentLang'] = Yii::app()->request->getParam('tcpa_text');
				$campaign['sourceIP'] = Yii::app()->request->getParam('ipaddress');
				$campaign['contact_time'] = 'Any Time';
				$campaign['propertytype'] = self::$BuildingType[Yii::app()->request->getParam('property_type','2')];
				$lp_campaign_id = '22682';
				$lp_supplier_id = '75241';
                $lp_key = 'lpd7ien5oclq36';
			}
			if($project_type == 52){//WINDOWS
				$campaign['home_owner'] = Yii::app()->request->getParam('home_owner')=='1' ? 'yes' : 'no';
				$campaign['project_type'] = date('N')%2 == 0 ? 'repair' : 'replace';
				$campaign['window_count'] = Yii::app()->request->getParam('number_of_windows','2');
				$campaign['zip_code'] = Yii::app()->request->getParam('zip');
				$campaign['consentLang'] = Yii::app()->request->getParam('tcpa_text');
				$campaign['sourceURL'] = Yii::app()->request->getParam('url','https://elitehomeimprovers.com');
				$lp_campaign_id = '22438';
				$lp_supplier_id = '75240';
                $lp_key = 'jnkpaknmmh06op';
			}
			$fields = [
				'lp_campaign_id' => $lp_campaign_id,
				'lp_supplier_id' => $lp_supplier_id,
                'lp_key' => $lp_key,
				'lp_subid1' => $promo_code,
				'lp_subid2'=>Yii::app()->request->getParam('sub_id'),
				//'lp_action'=>'testing',
				'city'=>$city_state['city']?$city_state['city']:'New York',
				'state'=>$city_state['state']?$city_state['state']:'NY',
				'email'=>Yii::app()->request->getParam('email'),
                'tcpa_text'=>Yii::app()->request->getParam('tcpa_text'),
				'userAgent'=>Yii::app()->request->getParam('user_agent',self::getUserAgent()),
				'leadBornOnDateTime' => date('Y-m-d').'T'.date('H:i:s.B').'Z',
                'residential' => date('N')%2 == 0 ? 'true' : 'false',
				'timeframe' => Yii::app()->request->getParam('time_frame',rand(1,2)),
				'Lead_ID_Token'=>Yii::app()->request->getParam('universal_leadid'),
				'Trusted_Form_Token'=>Yii::app()->request->getParam('trustedformcerturl'),
				'leadId'=>Yii::app()->request->getParam('universal_leadid'),
				'xxTrustedFormCertUrl'=>Yii::app()->request->getParam('trustedformcerturl'),
                'comments' => Yii::app()->request->getParam('comments'),
			];
			$fields += $campaign;
			//echo '<pre>';print_r($fields);exit;
			$purchase = true;
	        $url = Yii::app()->request->getParam('url');
	        if(in_array(self::getHost($url),self::$not_allowed)){
	        	$purchase = false;
	        }
	        if($purchase == true){
                $pingData['ping_request'] = http_build_query($fields);
				$pingData['header'] = ["application/x-www-form-urlencoded"];
	        }else{
	            $pingData['ping_request'] = false;
	        }
			//echo '<pre>';print_r($fields);
			//print_r($pingData);
			//exit;
	        return $pingData;
		}
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
        $result = json_decode($ping_response);
		if($result->status == 'ACCEPTED'){
			$ping_response_info['ping_status'] = '1';
			$ping_response_info['confirmation_id'] = $result->ping_id;
			if($result->bids){
				$i=0;
				$brands = (array) $result->bids;
				$ping_price = max(array_column($brands, "payout"));
				$ping_response_info['ping_price'] = trim($ping_price);
				foreach ($result->brands as $brands) {
					$ping_response_info['brands'][$i]['brand_name'] = $brands->bid_id;
					$ping_response_info['brands'][$i]['bid_price'] = $brands->payout;
					$i++;
				}
			}
		}else {
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
		$result = json_decode($ping_response);
		$confirmation_id = $result->ping_id;
		if($project_type == 13){ //BATHROOM
			$campaign['project_type'] = self::getBathroomProjectType($task);
			$campaign['home_owner'] = Yii::app()->request->getParam('home_owner')=='1' ? 'yes' : 'no';
			$campaign['add_remove_walls'] = 'unsure';
			$campaign['zip_code'] = Yii::app()->request->getParam('zip');
			$campaign['first_name'] = Yii::app()->request->getParam('first_name');
			$campaign['last_name'] = Yii::app()->request->getParam('last_name');
			$campaign['tcpa_text'] = Yii::app()->request->getParam('tcpa_text');
			$campaign['ip_address'] = Yii::app()->request->getParam('ipaddress');
			$campaign['sourceURL'] = Yii::app()->request->getParam('url','https://elitehomeimprovers.com');
			$lp_campaign_id = '22662';
			$lp_supplier_id = '75242';
			$lp_key = 'jnkpaky6lu06ov';
		}
		if($project_type == 42){//ROOFING
			$campaign['roof_material'] =  self::getRoofingCategory(Yii::app()->request->getParam('roofing_type',rand(1,2)));
			$campaign['project_type'] = date('N')%2 == 0 ? 'repair' : 'replace';
			$campaign['home_owner'] = Yii::app()->request->getParam('home_owner')=='1' ? 'yes' : 'no';
			$campaign['zip_code'] = Yii::app()->request->getParam('zip');
			$campaign['first_name'] = Yii::app()->request->getParam('first_name');
			$campaign['last_name'] = Yii::app()->request->getParam('last_name');
			$campaign['tcpa_text'] = Yii::app()->request->getParam('tcpa_text');
			$campaign['ip_address'] = Yii::app()->request->getParam('ipaddress');
			$campaign['sourceURL'] = Yii::app()->request->getParam('url','https://elitehomeimprovers.com');
			$lp_campaign_id = '22408';
			$lp_supplier_id = '75239';
			$lp_key = '0ez7f1vk6brg6p';
		}
		if($project_type == 45){//SOLAR
			$project_provider = $submission_model->getProvidersById(Yii::app()->request->getParam('project_provider'));
			$campaign['homeowner'] = Yii::app()->request->getParam('home_owner')=='1' ? 'true' : 'false';
			$campaign['submissionURL'] = 'https://elitehomeimprovers.com';
			$campaign['installORrepair'] = date('N')%2 == 0 ? 'install' : 'repair';
			$campaign['electricProvider'] = $project_provider['provider_name'];
			$campaign['shade'] = Yii::app()->request->getParam('roof_shade');
			$campaign['avgElectricBill'] = self::getElectricityBill(Yii::app()->request->getParam('monthly_bill'));
			$campaign['creditscore'] = self::$creditRating[Yii::app()->request->getParam('credit_rating','2')];
			$campaign['zipCode'] = Yii::app()->request->getParam('zip');
			$campaign['firstName'] = Yii::app()->request->getParam('first_name');
			$campaign['lastName'] = Yii::app()->request->getParam('last_name');
			$campaign['consentLang'] = Yii::app()->request->getParam('tcpa_text');
			$campaign['sourceIP'] = Yii::app()->request->getParam('ipaddress');
			$campaign['contact_time'] = 'Any Time';
			$campaign['propertytype'] = self::$BuildingType[Yii::app()->request->getParam('property_type','2')];
			$lp_campaign_id = '22682';
			$lp_supplier_id = '75241';
			$lp_key = 'lpd7ien5oclq36';
		}
		if($project_type == 52){//WINDOWS
			$campaign['home_owner'] = Yii::app()->request->getParam('home_owner')=='1' ?  'yes' : 'no';
			$campaign['project_type'] = date('N')%2 == 0 ? 'repair' : 'replace';
			$campaign['window_count'] = Yii::app()->request->getParam('number_of_windows','2');
			$campaign['zip_code'] = Yii::app()->request->getParam('zip');
			$campaign['first_name'] = Yii::app()->request->getParam('first_name');
			$campaign['last_name'] = Yii::app()->request->getParam('last_name');
			$campaign['tcpa_text'] = Yii::app()->request->getParam('tcpa_text');
			$campaign['ip_address'] = Yii::app()->request->getParam('ipaddress');
			$campaign['sourceURL'] = Yii::app()->request->getParam('url','https://elitehomeimprovers.com');
			$lp_campaign_id = '22438';
			$lp_supplier_id = '75240';
			$lp_key = 'jnkpaknmmh06op';
		}
		$fields = [
			'lp_ping_id' => $confirmation_id,
			'lp_campaign_id' => $lp_campaign_id,
			'lp_supplier_id' => $lp_supplier_id,
			'lp_key' => $lp_key,
			'lp_subid1' => $promo_code,
			'lp_subid2'=>Yii::app()->request->getParam('sub_id'),
			//'lp_action'=>'testing',
			'city'=>$city_state['city']?$city_state['city']:'New York',
			'state'=>$city_state['state']?$city_state['state']:'NY',
			'phone'=>Yii::app()->request->getParam('phone'),
			'email'=>Yii::app()->request->getParam('email'),
			'address'=>Yii::app()->request->getParam('address'),
			'userAgent'=>Yii::app()->request->getParam('user_agent',self::getUserAgent()),
			'leadBornOnDateTime' => date('Y-m-d').'T'.date('H:i:s.B').'Z',
			'residential' => date('N')%2 == 0 ? 'true' : 'false',
			'timeframe' => Yii::app()->request->getParam('time_frame',rand(1,2)),
			'Lead_ID_Token'=>Yii::app()->request->getParam('universal_leadid'),
			'Trusted_Form_Token'=>Yii::app()->request->getParam('trustedformcerturl'),
			'leadId'=>Yii::app()->request->getParam('universal_leadid'),
			'xxTrustedFormCertUrl'=>Yii::app()->request->getParam('trustedformcerturl'),
			'comments' => Yii::app()->request->getParam('comments'),
		];
		$fields += $campaign;
		//echo '<pre>';print_r($fields);exit;
		//$fields += $campaign;
		$post_request = http_build_query($fields);
		$cm = new CommonMethods();
		$start_time = CommonToolsMethods::stopwatch();
		$header = ["application/x-www-form-urlencoded"];
		$post_response = $cm->curl($post_url,$post_request,$header);
		$time_end = CommonToolsMethods::stopwatch();
		$result = json_decode($post_response);
		//echo '<pre>';print_r();die();
		if($result->status=='ACCEPTED'){
			$postPrice = $result->payout;
			$post_status = '1';
			$post_price = isset($postPrice) ? $postPrice : '0.00';
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