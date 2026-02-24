<?php
class ELocalController extends Controller
{
    public function __construct() {}
    /**
     * Create Ping Request for Lender
     */
    public static function returnPingData($p1 = false, $p2 = false, $p3 = false, $status = 0, $domain_url = null)
    {
        $promo_code = Yii::app()->request->getParam('promo_code');
        $zip_code = Yii::app()->request->getParam('zip');
        $project_type = Yii::app()->request->getParam('project_type');
        if ($promo_code != '0') {
            $submission_model = new Submissions();
            $task_name = Yii::app()->request->getParam('task');
            $project_task = explode('_', $task_name);
            $elocal_data = $submission_model->getELocalVariables($project_type,$project_task[1]);
            $need_id = $elocal_data['need_id'];
            $category_list_id = $submission_model->checkELocalZipcode($zip_code, $elocal_data['category_list_id']);
            if (!empty($need_id) && $category_list_id) {
                $fields = [
                    'ping' => [
                        'key' => isset($p1) ? $p1 : '53f45aad5fd49c27592affc89934ea454453ff7e',
                        "zip_code" => $zip_code,
                        "need_id" => $need_id,
                        "tcpa_consent" => Yii::app()->request->getParam('tcpa_optin') == 1 ? true : false,
                        "sender_id" => Yii::app()->request->getParam('promo_code'),
                        "sender_origin_key" => Yii::app()->request->getParam('subid'),
                        "exclusive" => false,
                        "slots_available" => "0",
                        "certificate_type" => Yii::app()->request->getParam('trustedformcerturl'),
                        "leadid_identifier" => Yii::app()->request->getParam('universal_leadid'),
                        "trusted_form_cert_id" => Yii::app()->request->getParam('trustedformcerturl'),
                        "web_lead_source_url" => Yii::app()->request->getParam('url'),
                    ],
                ];
                //echo '<pre>';print_r($fields);exit;
                $purchase = true;
                $header = ["content-type: application/json"];
                $purchase = true;
                if ($purchase == true) {
                    $pingData['ping_request'] = json_encode($fields);
                    //mail('octobas@gmail.com','ELocal Ping Request',$pingData['ping_request']);
                    $pingData['header'] = $header;
                    $pingData['ping_url'] = 'https://api.elocal.com/lead/ping';
                    return $pingData;
                } else {
                    $pingData['ping_request'] = false;
                    return $pingData;
                }
            } else {
                $pingData['ping_request'] = false;
                return $pingData;
            }
        }
    }
    /**
     * Preg Match the Lender Ping Full XML/JSON Response.
     */
    public static function returnPingResponse($ping_response)
    {
        $result = json_decode($ping_response, TRUE);
        if (isset($result['response']['status']) && $result['response']['status'] == 'success') {
            $ping_price = isset($result['response']['price']) ? $result['response']['price'] : 0;
            $ping_response_info['ping_price'] = trim($ping_price);
            $ping_response_info['ping_status'] = '1';
            $ping_response_info['confirmation_id'] = $result['response']['token'];
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
    public static function sendPostData($p1, $p2, $p3, $ping_response, $post_url, $status)
    {
        $promo_code = Yii::app()->request->getParam('promo_code');
        $zip_code = Yii::app()->request->getParam('zip');
        $project_type = Yii::app()->request->getParam('project_type');
        if ($promo_code != '0') {
            $submission_model = new Submissions();
            $task_name = Yii::app()->request->getParam('task');
            $project_task = explode('_', $task_name);
            $elocal_data = $submission_model->getELocalVariables($project_type, $project_task[1]);
            $need_id = $elocal_data['need_id'];
            $category_list_id = $submission_model->checkELocalZipcode($zip_code, $elocal_data['category_list_id']);
            if (!empty($need_id) && $category_list_id) {
                $ping_result = json_decode($ping_response, TRUE);
                $fields = [
                    'post' => [
                        "key" => isset($p1) ? $p1 : '53f45aad5fd49c27592affc89934ea454453ff7e',
                        "ping_token" => isset($ping_result['response']['token']) ? $ping_result['response']['token'] : '',
                        "zip_code" => $zip_code,
                        "need_id" => Yii::app()->session['affiliate_trans_id'],
                        "tcpa_consent" => Yii::app()->request->getParam('tcpa_optin') == 1 ? true : false,
                        "sender_id" =>  Yii::app()->request->getParam('promo_code'),
                        "sender_origin_key" => Yii::app()->request->getParam('subid'),
                        "first_name" => Yii::app()->request->getParam('firstname'),
                        "last_name" => Yii::app()->request->getParam('lastname'),
                        "phone" => Yii::app()->request->getParam('phone'),
                        "email" => Yii::app()->request->getParam('email'),
                        "address" => Yii::app()->request->getParam('address'),
                        "description" => Yii::app()->request->getParam('subid'),
                        "exclusive" => false,
                        "slots_available" => "0",
                        "trusted_form_cert_id" => Yii::app()->request->getParam('trustedformcerturl'),
                        /* "hashed_contacts" => [
                        "[value]",
                        "[value]"
                    ], */
                        "leadid_identifier" => Yii::app()->request->getParam('universal_leadid'),
                        /* "questions" => [
                        [
                            "question_text" => "question-1",
                            "answer_text" => "answer-1"
                        ],
                        [
                            "question_text" => "question-2",
                            "answer_text" => "answer-2"
                        ],
                        [
                            "question_text" => "question-3",
                            "answer_text" => "answer -3"
                        ]
                    ],
                    "query_string" => "[value]", */
                        "web_lead_source_url" => Yii::app()->request->getParam('url'),
                    ],
                ];
                //echo '<pre>';print_r($fields);exit;
                $post_request = json_encode($fields);
                $cm = new CommonMethods();
                $start_time = CommonToolsMethods::stopwatch();
                $header = ["content-type: application/json"];
                $post_url = 'https://api.elocal.com/lead/post';
                $post_response = $cm->curl($post_url, $post_request, $header);
                $time_end = CommonToolsMethods::stopwatch();
                $result = json_decode($post_response);
                if ($result->response->status == 'success') {
                    $post_status = '1';
                    $post_price = isset($result->response->price) ? $result->response->price : 0;
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
}
