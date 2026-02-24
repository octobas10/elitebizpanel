<?php
class TurboController extends Controller
{
    public function __construct() {}
    /**
     * Create Ping Request for Lender
     */
    public static function getHost($url, $accept_www = false)
    {
        $url = str_replace(["%3A", "%2F"], [':', '/'], $url);
        $URIs = parse_url(trim($url));
        $host = !empty($URIs['host']) ? $URIs['host'] : explode('/', $URIs['path'])[0];
        return $accept_www == false ? str_ireplace('www.', '', $host) : $host;
    }
    public static $not_allowed = [];
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0, $ping_url = null)
    {
        $promo_code = Yii::app()->request->getParam('promo_code');
        $submission_model = new Submissions();
        $zip_code = Yii::app()->request->getParam('zip');
        $city_state = $submission_model->getCityStateFromZip($zip_code);
        $state = $city_state['state'];
        if ($promo_code != 0) {
            $pingData = [];
            $fields = [
                'ping_post' => 'ping',
                "token" => $p1 ? $p1 : "98b352d3e67de1cdf489313b5004bfc6",
                "firstname" => Yii::app()->request->getParam('first_name',null),
                "lastname" => Yii::app()->request->getParam('last_name',null),
                "email" => Yii::app()->request->getParam('email',null),
                "phone" => Yii::app()->request->getParam('phone',null),
                "debt_amount" => Yii::app()->request->getParam('debt_amount'),
                "state" => $city_state['state'],
                "ip" => Yii::app()->request->getParam('ipaddress', 0),
                "unique_id" => Yii::app()->session['affiliate_trans_id'],
                "sub1" => Yii::app()->request->getParam('promo_code', 0),
                "sub2" => Yii::app()->request->getParam('sub_id', 0),
                "sub3" => '',
                "sub4" => '',
                "sub5" => '',
                "sourceid" => '',
                "zip" => Yii::app()->request->getParam('zip', 0),
                "age" => date('Y') - date('Y',strtotime(Yii::app()->request->getParam('dob'))),
            ];
            $purchase = true;
            $exluded_states = ['WI','MN','OR','VT','WV'];
            $exluded_days = ['Thursday','Friday','Saturday'];
            $url = Yii::app()->request->getParam('url');
            $day = date('l', time());
            $time = date('H', time());
            if (in_array(self::getHost($url), self::$not_allowed)) {
                $purchase = false;
                $pingData['ping_request'] = 'URL Not allowed';
            }else if(in_array($state,$exluded_states)){
               $purchase = false;   
               $pingData['ping_request'] = 'State: ' . $state.' Not allowed';
            }else if(in_array($day,$exluded_days)){
                $purchase = false;   
                $pingData['ping_request'] = 'Posting Not allowd on '.$day;
            }else if($time < '8' OR $time > '21'){
                $purchase = false;   
                $pingData['ping_request'] = ' Posting Not allowd at '.$time;
            }
            if ($purchase == true) {
                $pingData['ping_request'] = http_build_query($fields);
                $pingData['ping_url'] = $ping_url;
                $pingData['header'] = ["application/x-www-form-urlencoded"];
            }
            return $pingData;
        }
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response) {
    	$result = json_decode($ping_response,TRUE);
        if (isset($result['status']) && $result['status']=='success') {
            $lender_details_model = new LenderDetails();
            $user_name =  str_replace('Controller','',@get_class());
            $lender_details = $lender_details_model->getLenderDetails($user_name);
            $ping_price = $lender_details['static_lead_price'];
            $ping_response_info['ping_price'] = trim($ping_price);
            $ping_response_info['ping_status'] = '1';
            $ping_response_info['confirmation_id'] = base64_encode(openssl_random_pseudo_bytes(30));
        } else {
            $ping_response_info['ping_price'] = 0;
            $ping_response_info['ping_status'] = '0';
            $ping_response_info['confirmation_id'] = '';
        }
        return $ping_response_info;
    }
    /**
     * Send Post Data to Lender
     */
    public static function sendPostData($p1, $p2, $p3, $ping_response, $post_url, $status)
    {
        $promo_code = Yii::app()->request->getParam('promo_code');
        $submission_model = new Submissions();
        $zip_code = Yii::app()->request->getParam('zip');
        $city_state = $submission_model->getCityStateFromZip($zip_code);
        if ($promo_code != 0) {
            $ping_result = json_decode($ping_response,TRUE);
            $fields = [
                "token" => $p1 ? $p1 : "98b352d3e67de1cdf489313b5004bfc6",
                "firstname" => Yii::app()->request->getParam('first_name',null),
                "lastname" => Yii::app()->request->getParam('last_name',null),
                "email" => Yii::app()->request->getParam('email',null),
                "phone" => Yii::app()->request->getParam('phone',null),
                "debt_amount" => Yii::app()->request->getParam('debt_amount'),
                "state" => $city_state['state'],
                "ip" => Yii::app()->request->getParam('ipaddress', 0),
                "unique_id" => Yii::app()->request->getParam('affiliate_trans_id'),
                "sub1" => Yii::app()->request->getParam('promo_code', 0),
                "sub2" => Yii::app()->request->getParam('sub_id', 0),
                "sub3" => '',
                "sub4" => '',
                "sub5" => '',
                "sourceid" => '',
                "zip" => Yii::app()->request->getParam('zip', 0),
                "age" => date('Y') - date('Y',strtotime(Yii::app()->request->getParam('dob'))),
            ];
            //$post_request = json_encode($fields);
            $post_request = http_build_query($fields);
            //echo '<pre>';print_r($post_request);
            $cm = new CommonMethods();
            $start_time = CommonToolsMethods::stopwatch();
            $header = ["application/x-www-form-urlencoded"];
            //$header = ["Content-Type: application/json"];
            $post_response = $cm->curl($post_url, $post_request, $header);
            //$post_response = '{ "status":"success", "redirect_url":"https://secure.livechatinc.com/licence/11927073/v2/open_chat.cgi?groups=2&params=" }';
            $time_end = CommonToolsMethods::stopwatch();
            //mail('octobas@gmail.com', 'Turbo Post new', $post_request.'===='.$post_response );
            $result = json_decode($post_response,TRUE);
            if (isset($result['status']) && $result['status']=='success') {
                $post_status = '1';
                $post_price = '0.00';
                $redirect_url = $result['redirect_url'];
            } else {
                $post_status = '0';
                $post_price = '0.00';
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
