<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
class AffiliatesController extends Controller
{
	/**
	 *
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 *      using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $db;
	public $layout = 'column1';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete'  // we only allow deletion via POST request
		);
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * 
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			// allow all users to perform these actions
			array(
				'allow',
				'actions' => array('login', 'affiliateRegister', 'forgotPassword', 'pixelCodeDisplay', 'programofinterestusingcampuscode', 'landingpage',/*'landingpagee',*/ 'searchcampus', 'checkzipcode', 'phoneverify', 'USPSPostalAddressVerification', 'checkgeofootprint'),
				'users' => array('*')
			),
			// allow authenticated user to perform these actions
			array(
				'allow',
				'actions' => array(
					'supression_list',
					'creatives',
					'support',
					'profile',
					'emailcreatives',
					'viewemailcreatives',
					'leadinfo',
					'affiliatestatlogs',
					'USPSPostalAddressVerification'
				),
				'users' => array('@')
			),
			// allow admin user to perform these actions
			array(
				'allow',
				'actions' => array('index', 'create', 'update', 'delete', 'updateMd5Password', 'updateByData', 'getLast15DaysSubmissionPerAffiliate', 'supression_list', 'creatives', 'support', 'affiliatestats', 'getaffstatus', 'view', 'affiliatestatlogs', 'checkgeofootprint', 'getcampusporgramfromzipcode', 'EmailToLeadUsers', 'SendEmailToLeadUsers', 'duplicateipblockallow', 'USPSPostalAddressVerification', 'affiliatevalidations', 'AffiliateReport'),
				'users' => array('admin')
			),
			// deny all users
			array(
				'deny',
				'users' => array('*')
			)
		);
	}
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view', array(
			'model' => $this->loadModel($id)
		));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model = new AffiliateUser();
		if (Yii::app()->user->checkAccess('admin')) {
			$model->scenario = 'adminrole';
		}

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if (isset($_POST['AffiliateUser'])) {
			$errors = '';
			$model->attributes = $_POST['AffiliateUser'];
			$model->is_inorganic = ($_POST['AffiliateUser']['is_inorganic'] == 'on') ? 1 : 0;
			$model->isAdmin = ($_POST['AffiliateUser']['isAdmin'] == 'on') ? 1 : 0;
			$model->pixel_type = ($_POST['AffiliateUser']['pixel_type'] == 'on') ? 1 : 0;
			if ($model->save())
				$this->redirect(array('view', 'id' => $model->id));
			else
				$errors = $model->errors;
		}
		$this->render('create', array(
			'model' => $model,
			'errors' => $errors
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if (isset($_POST['AffiliateUser'])) {
			$is_verify_phone = '1';
			$is_verify_email = '1';
			$is_verify_address = '1';
			$i_reg_error = '0';
			$o_affiliate_user = new AffiliateUser();
			$allowed_verifications = $o_affiliate_user->getAllowedVerification();
			if (isset($allowed_verifications) && !empty($allowed_verifications)) {
				$is_verify_phone = $allowed_verifications[0]['verify_phone'];
				$is_verify_email = $allowed_verifications[0]['verify_email'];
				$is_verify_address = $allowed_verifications[0]['verify_address'];
			}

			//========================Verify Phone Only If Required STARTS========================
			if (isset($_POST['AffiliateUser']['phone']) && !empty($_POST['AffiliateUser']['phone']) && $is_verify_phone == '1') {
				$o_affiliate_user = new AffiliateUser();
				$msg = $o_affiliate_user->checkPhone($_POST['AffiliateUser']['phone']);
				if ($msg != 1) {
					$i_reg_error = '1';
					Yii::app()->user->setFlash('error', 'Invalid Phone Number.');
				}
			}
			//=========================Verify Phone Only If Required ENDS=========================

			//========================Verify Email Only If Required STARTS========================
			if (isset($_POST['AffiliateUser']['email']) && !empty($_POST['AffiliateUser']['email']) && $is_verify_email == '1') {
				require 'cash_lender/XverifyClientAPI.php';
				$api_key = '1000018-2917DC1B'; //'09ASXD-9E0B1F9C'; // Your API Key
				$options = array();
				$options['type'] = 'json'; // API response type
				$options['domain'] = 'higherlearningapp.com'; // Reruired your domain name 
				$options['catch_all'] = 'no'; // Reruired your domain name 
				$client = new XverifyClientAPI($api_key, $options);
				$data = array();
				$data['email'] = $_POST['AffiliateUser']['email'];
				$client->verify('email', $data);
				// print_r($client->response);
				$t_response = explode('jQuery22402469638349049722_1480935238606(', $client->response);
				if (isset($t_response) && !empty($t_response)) {
					$t_response = explode(')', $t_response[1]);
					if (isset($t_response) && !empty($t_response)) {
						$json_response = json_decode($t_response[0]);
						if ($json_response->email->status == 'valid') {
						} else {
							$i_reg_error = '1';
							Yii::app()->user->setFlash('error', 'Invalid Email Address.');
						}
					} else {
						$i_reg_error = '1';
						Yii::app()->user->setFlash('error', 'Invalid Email Address.');
					}
				} else {
					$i_reg_error = '1';
					Yii::app()->user->setFlash('error', 'Invalid Email Address.');
				}
			}
			//=========================Verify Email Only If Required ENDS=========================

			//=======================Verify Address Only If Required STARTS=======================
			if (isset($_POST['AffiliateUser']['street']) && !empty($_POST['AffiliateUser']['street']) && isset($_POST['AffiliateUser']['city']) && !empty($_POST['AffiliateUser']['city']) && isset($_POST['AffiliateUser']['state']) && !empty($_POST['AffiliateUser']['state']) && isset($_POST['AffiliateUser']['zip_code']) && !empty($_POST['AffiliateUser']['zip_code']) && $is_verify_address == '1') {
				if (!$this->actionUSPSPostalAddressVerification($_POST['AffiliateUser']['street'], $_POST['AffiliateUser']['city'], $_POST['AffiliateUser']['state'], $_POST['AffiliateUser']['zip_code'])) {
					$i_reg_error = '1';
					Yii::app()->user->setFlash('error', 'Invalid Postal Address.');
				}
			}
			//========================Verify Address Only If Required ENDS========================
			if ($i_reg_error != '1') {

				$model->attributes = $_POST['AffiliateUser'];
				$o_affiliate_user = new AffiliateUser();
				$t_affiliate_details = $o_affiliate_user->actionCheckPassword($_POST['AffiliateUser']['password'], $model->id);
				if ($t_affiliate_details) {
					$model->password = md5($_POST['AffiliateUser']['password']);
				}
				$model->is_inorganic = ($_POST['AffiliateUser']['is_inorganic'] == 'on') ? 1 : 0;
				$model->isAdmin = ($_POST['AffiliateUser']['isAdmin'] == 'on') ? 1 : 0;
				$model->pixel_type = ($_POST['AffiliateUser']['pixel_type'] == 'on') ? 1 : 0;
				$model->street = (isset($_POST['AffiliateUser']['street']) && !empty($_POST['AffiliateUser']['street'])) ? $_POST['AffiliateUser']['street'] : '';
				$model->city = (isset($_POST['AffiliateUser']['city']) && !empty($_POST['AffiliateUser']['city'])) ? $_POST['AffiliateUser']['city'] : '';
				$model->state = (isset($_POST['AffiliateUser']['state']) && !empty($_POST['AffiliateUser']['state'])) ? $_POST['AffiliateUser']['state'] : '';
				$model->zip_code = (isset($_POST['AffiliateUser']['zip_code']) && !empty($_POST['AffiliateUser']['zip_code'])) ? $_POST['AffiliateUser']['zip_code'] : '';
				$model->website = (isset($_POST['AffiliateUser']['website']) && !empty($_POST['AffiliateUser']['website'])) ? $_POST['AffiliateUser']['website'] : '';
				$model->tax_id = (isset($_POST['AffiliateUser']['tax_id']) && !empty($_POST['AffiliateUser']['tax_id'])) ? $_POST['AffiliateUser']['tax_id'] : '';
				$model->updatedAt = date('Y-m-d H:i:s');
				if ($model->save())
					$this->redirect(array(
						'view',
						'id' => $model->id
					));
			}
		}
		$this->render('update', array(
			'model' => $model
		));
	}
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if (!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array(
				'admin'
			));
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$model = new AffiliateUser('search');
		$model->unsetAttributes(); // clear any default values
		if (isset($_GET['AffiliateUser']))
			$model->attributes = $_GET['AffiliateUser'];

		$dataProvider_affiliate = new CActiveDataProvider('AffiliateUser', array(
			'criteria' => array('order' => 'id DESC'),
			'pagination' => array('pageSize' => 15)
		));

		$this->render('index', array(
			'model' => $model,
			'dataProvider_affiliate' => $dataProvider_affiliate
		));
	}
	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model = new AffiliateUser('search');
		$model->unsetAttributes(); // clear any default values
		if (isset($_GET['AffiliateUser']))
			$model->attributes = $_GET['AffiliateUser'];

		$this->render('admin', array(
			'model' => $model
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model = AffiliateUser::model()->findByPk($id);
		if ($model === null)
			throw new CHttpException(404, 'The requested page does not exist.');
		return $model;
	}
	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'affiliate-user-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	public function actionUpdateByData()
	{
		Yii::import('ext.editable.EditableSaver');
		$es = new EditableSaver('AffiliateUser');
		$es->update();
		$model = new AffiliateUser();
		$model->unsetAttributes(); // clear any default values
		$model->actionAffiliateUpdatedat(yii::app()->request->getParam('pk'));
	}
	public function actionUpdateMd5Password()
	{
		Yii::import('ext.editable.EditableSaver');
		$es = new EditableSaver('AffiliateUser');
		$es->onBeforeUpdate = function ($event) {
			$event->sender->setAttribute('password', md5(yii::app()->request->getParam('value')));
		};
		$es->update();
	}
	public function actionGetLast15DaysSubmissionPerAffiliate()
	{
		$model = new AffiliateTransactions();
		return $model->leads_submitted_per_affiliate_last15days();
	}
	/**
	 * Display Affiliate Pixel Code
	 */
	public function actionPixelCodeDisplay()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods:GET,POST,JSONP');
		header("Access-Control-Allow-Headers:HTTP-X-REQUESTED-WITH");
		$this->layout = 'pixel_code_display_layout';
		$affiliate_trans_id = Yii::app()->request->getParam('affiliate_trans_id');
		$pixel = Yii::app()->request->getParam('pixel');
		if (!empty($affiliate_trans_id) && $pixel != '') {
			$model1 = new AffiliateTransactions();
			$aff = $model1->findAffiliatetransaction($affiliate_trans_id);

			if ($aff) {
				$aff_user_obj = new AffiliateUser();
				$pixel_type = $aff_user_obj->getAffiliatePixelType($affiliate_trans_id);
				$pixel_code = $aff_user_obj->get_pixel($affiliate_trans_id);
				$lender_exit_url = LenderTransactions::model()->exit_url($affiliate_trans_id);
				$this->layout = 'blank';
				if ($pixel > 0) {
					// display pixel code as many times of pixel fire and every time decrease pixel
					$this->render('pixel_code_display', array('pixel_type' => $pixel_type, 'pixel_code' => $pixel_code, 'pixel' => $pixel, 'customer_id' => $aff->customer_id, 'sub_id' => $aff->sub_id, 'sub_id2' => $aff->sub_id2, 'affiliate_trans_id' => $affiliate_trans_id, 'lead_id' => $aff->lead_id));
				} else {
					// pixel decressed to zero then redirect to exit url if lender provide othervise redirect to private labeled homepage
					/**
					 * 
					 * description : redirection to "thankyou" page removed
					 * date : 22-08-2016
					 */
					$exit_url = (isset($lender_exit_url) && $lender_exit_url != '') ? $lender_exit_url : Yii::app()->params['httphost'] . Yii::app()->params['frontEndAuto'] . '/index.php';
					$this->render('pixel_code_display', array('pixel_type' => $pixel_type, 'pixel_code' => $pixel_code, 'pixel' => $pixel, 'exit_url' => $exit_url, 'customer_id' => $aff->customer_id, 'sub_id' => $aff->sub_id, 'sub_id2' => $aff->sub_id2, 'affiliate_trans_id' => $affiliate_trans_id, 'lead_id' => $aff->lead_id));
				}
			} else {
				echo "Invalid Request";
			}
		} else {
			echo "Invalid Request";
		}
	}
	/**
	 * Create suppression list for affiliates.
	 * Affiliate can only download the suppression list file.
	 * Admin can add new emails and phones to suppression list.
	 */
	public function actionSupression_list()
	{
		$o_affiliate_user = new AffiliateUser();
		$o_affiliate_user->unsetAttributes(); // clear any default values
		$message = '';
		if (Yii::app()->request->getParam('email_suprression_list') || Yii::app()->request->getParam('phone_supression_list')) {
			$table = 'edu_email_supression_list';
			$fields = 'email';

			if (Yii::app()->request->getParam('email_suprression_list')) {
				$table = 'edu_email_supression_list';
				$fields = 'email';
				$filename = 'email_suprression_list-' . date('Y-m-d');
			} elseif (Yii::app()->request->getParam('phone_supression_list')) {
				$table = 'edu_phone_supression_list';
				$fields = 'phone';
				$filename = 'phone_suprression_list-' . date('Y-m-d');
			}

			/**
			 ** 
			 ** Description : query removed from controller and placed in AffiliateUser model (code to download supression list as per the request)
			 ** Date : 02-08-2016
			 **/
			$query_data = $o_affiliate_user->downloadSupressionList($fields, $table);

			if (empty($query_data)) {
				Yii::app()->user->setFlash('error', ucfirst($fields) . ' Supression List is Empty');
				header('Content-Type: text/html');
				//redirect is used instead of render because render will contain params in url and we don't need them
				$this->redirect('supression_list');
			}

			//code to download csv
			header('Content-Type: text/csv');
			header('Content-Disposition: attachment;filename="' . $filename . '.csv"');
			foreach ($query_data as $row) {
				foreach ($row as $data) {
					echo $data;
					echo "\r\n";
				}
			}
			exit;
		} elseif (Yii::app()->request->getParam('emails')) {
			$emails = Yii::app()->request->getParam('emails_text');
			if (!empty($emails)) {
				$name_emails = preg_split("/[\s,]+/", $emails, -1, PREG_SPLIT_NO_EMPTY);
				foreach ($name_emails as $email) {
					$email = addslashes($email);
					if (@eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email)) {
						/**
						 ** 
						 ** Description : query removed from controller and placed in AffiliateUser model (code to check email is already available or not and if not insert)
						 ** Date : 02-08-2016
						 **/
						$o_affiliate_user->checkSupressionEmailExist($email);
					} else {
						Yii::app()->user->setFlash('error', 'Error Occured. Emails Not Added');
					}
				}
				//Yii::app()->user->setFlash('success','Emails added successfully');
			}
		} elseif (Yii::app()->request->getParam('phones')) {
			$phones = Yii::app()->request->getParam('phones_text');
			if (!empty($phones)) {
				$name_phones = preg_split("/[\s,]+/", $phones, -1, PREG_SPLIT_NO_EMPTY);
				foreach ($name_phones as $phone) {
					$phone = addslashes($phone);
					if (preg_match('/^[0-9]{10}$/', $phone)) {
						/**
						 ** 
						 ** Description : query removed from controller and placed in AffiliateUser model (code to check email is already available or not and if not insert)
						 ** Date : 02-08-2016
						 **/
						$o_affiliate_user->checkSupressionPhoneExist($phone);
					} else {
						Yii::app()->user->setFlash('error', 'Error Occured. Phone Not Added');
					}
				}
				//Yii::app()->user->setFlash('success','Phone added successfully');
			}
		}
		$this->render('supression_list');
	}
	/**
	 * Banner Creatives
	 */
	public function actionCreatives()
	{
		$o_affiliate_user = new AffiliateUser();
		$o_affiliate_user->unsetAttributes(); // clear any default values
		$promo_code = Yii::app()->user->id;
		$errors = array();
		if (Yii::app()->request->getParam('upload')) {
			extract($_POST);

			$filename = $_FILES["promotional_image"]["name"];
			$file_tmp_name = $_FILES["promotional_image"]["tmp_name"];
			$file_size = $_FILES["promotional_image"]["size"];
			$target_dir = 'edu_promotional_creatives/';
			$target_file = $target_dir . basename($filename);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
			$check = getimagesize($file_tmp_name);
			if (!empty($check)) {
				$uploadOk = 1;
			} else {
				$errors[] = "File is not an image.";
				$uploadOk = 0;
			}
			if (file_exists($target_file)) {
				$errors[] = "Sorry, file already exists.";
				$uploadOk = 0;
			}
			if ($file_size > 500000) {
				$errors[] = "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
				$errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
			if ($uploadOk == 0) {
				$errors[] = "Sorry, your file was not uploaded.";
			} else {
				$pos = strrpos($filename, ".");
				$filename_without_extension = substr($filename, 0, $pos);
				$save_name =  $filename_without_extension . '_' . time() . '.' . $imageFileType;
				if (move_uploaded_file($file_tmp_name, $target_dir . $save_name)) {
					/**
					 ** 
					 ** Description : query removed from controller and placed in AffiliateUser model (code to add creatives as per the request)
					 ** Date : 02-08-2016
					 **/
					$res = $o_affiliate_user->actionAddCreatives($private_label, $promotional_text, $save_name, $promo_code);
					$this->redirect('creatives');
				} else {
					$errors[] = "Sorry, there was an error uploading your file.";
				}
			}
		}
		if (Yii::app()->request->getParam('remove_id') != '') {
			extract($_POST);
			/** 
			 ** Description : query removed from controller and placed in AffiliateUser model (code to delete creatives)
			 ** Date : 02-08-2016
			 **/
			$condition = 'id=' . $remove_id;
			$res = $o_affiliate_user->actionRemoveCreatives($condition);
			$this->redirect('creatives');
		}

		/** 
		 ** Description : query removed from controller and placed in AffiliateUser model (code to view all creatives)
		 ** Date : 02-08-2016
		 **/
		$creatives = $o_affiliate_user->actionCreatives();

		$this->render('creatives', array('creatives' => $creatives, 'errors' => $errors));
	}
	/**
	 * Email Creatives
	 */
	public function actionEmailcreatives()
	{
		$o_affiliate_user = new AffiliateUser();
		$o_affiliate_user->unsetAttributes(); // clear any default values
		$promo_code = Yii::app()->user->id;
		$errors = array();
		if (Yii::app()->request->getParam('upload')) {
			extract($_POST);
			$filename = $_FILES["promotional_image"]["name"];
			$file_tmp_name = $_FILES["promotional_image"]["tmp_name"];
			$file_size = $_FILES["promotional_image"]["size"];
			$target_dir = 'edu_email_creatives/';
			$target_file = $target_dir . basename($filename);
			$uploadOk = 1;
			$imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
			$check = getimagesize($file_tmp_name);
			if ($check !== false) {
				$uploadOk = 1;
			} else {
				$errors[] = "File is not an image.";
				$uploadOk = 0;
			}
			if (file_exists($target_file)) {
				$errors[] = "Sorry, file already exists.";
				$uploadOk = 0;
			}
			if ($file_size > 500000) {
				$errors[] = "Sorry, your file is too large.";
				$uploadOk = 0;
			}
			if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
				$errors[] = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
				$uploadOk = 0;
			}
			if (!is_dir($target_dir)) {
				mkdir($target_dir, 0777, true);
			}
			if ($uploadOk == 0) {
				$errors[] = "Sorry, your file was not uploaded.";
			} else {
				$pos = strrpos($filename, ".");
				$filename_without_extension = substr($filename, 0, $pos);
				$save_name =  $filename_without_extension . '_' . time() . '.' . $imageFileType;
				if (move_uploaded_file($file_tmp_name, $target_dir . $save_name)) {
					/**
					 ** 
					 ** Description : query removed from controller and placed in AffiliateUser model (code to add email creatives banner)
					 ** Date : 02-08-2016
					 **/
					$res = $o_affiliate_user->actionAddEmailCreatives($save_name, $promo_code, $email_creatives_subject_line, $email_creatives_from_line);
					$this->redirect('emailcreatives');
				} else {
					$errors[] = "Sorry, there was an error uploading your file.";
				}
			}
		}

		if (Yii::app()->request->getParam('remove_id') != '') {
			extract($_POST);
			/**
			 ** 
			 ** Description : query removed from controller and placed in AffiliateUser model (code to remove email creatives)
			 ** Date : 02-08-2016
			 **/
			$condition = 'id=' . $remove_id;
			$res = $o_affiliate_user->actionRemoveEmailCreatives($condition);
			$this->redirect('emailcreatives');
		}

		/**
		 ** 
		 ** Description : query removed from controller and placed in AffiliateUser model (code to view all email creatives)
		 ** Date : 02-08-2016
		 **/
		$creatives = $o_affiliate_user->actionEmailCreatives();

		/**
		 ** 
		 ** Description : query removed from controller and placed in AffiliateUser model (code to view all email creatives subject lines)
		 ** Date : 02-08-2016
		 **/
		$email_creatives_subject_lines = $o_affiliate_user->actionEmailCreativesSubject();

		/**
		 ** 
		 ** Description : query removed from controller and placed in AffiliateUser model (code to view all email creatives from lines)
		 ** Date : 02-08-2016
		 **/
		$email_creatives_from_lines = $o_affiliate_user->actionEmailCreativesFrom();

		$this->render('emailcreatives', array('creatives' => $creatives, 'email_creatives_subject_lines' => $email_creatives_subject_lines, 'email_creatives_from_lines' => $email_creatives_from_lines, 'errors' => $errors));
	}
	/**
	 * View HTML code file for Email Creatives
	 */
	public function actionViewEmailCreatives()
	{
		$o_affiliate_user = new AffiliateUser();
		$o_affiliate_user->unsetAttributes(); // clear any default values
		$where = 'id=' . Yii::app()->request->getParam('id');
		$creatives = $o_affiliate_user->actionViewEmailCreatives($where);
		$this->render('viewemailcreatives', array('creatives' => $creatives));
	}
	/**
	 * Support for query
	 */
	public function actionSupport()
	{
		if (Yii::app()->user->getState('roles') == 1) {
			//Affiliate
			$o_affiliate_user = new AffiliateUser();
			$o_affiliate_user->unsetAttributes(); // clear any default values
			$aff_emails = $o_affiliate_user->findAllBySql('select email from edu_affiliate_user order by email asc');
			//Lender
			$o_lender_user = new LenderUser();
			$o_lender_user->unsetAttributes(); // clear any default values
			$len_emails = $o_lender_user->findAllBySql('select email from edu_lender_details order by email asc');
			$this->render('support', array('aff_emails' => $aff_emails, 'len_emails' => $len_emails,));
		} else {
			$promo_code = Yii::app()->user->id;
			$model = $this->loadModel($promo_code);
			$this->render('support', array('model' => $model,));
		}
	}

	/**
	 * Get all program_of_interest on page load
	 */
	public function getAllProgramOfIntereset()
	{
		$program_model = new ProgramOfInterests();
		$program_posts = $program_model->findAll(array('order' => 'name'));
		return $program_posts;
	}
	/**
	 * Landing Page
	 */
	public function actionLandingpage()
	{
		unset($_SESSION['program_code']);
		unset($_SESSION['promo_code']);
		$this->layout = 'blank';
		//$this->render('landing_page');

		//Get all program_of_interest on page load
		$program_posts = $this->getAllProgramOfIntereset();

		//get all campus details on page load
		$criteria = new CDbCriteria();
		$model = new EduZipCodes();
		$criteria = $model->getCampusCityStateFromProgram();
		$posts = $model->findAll($criteria);
		/*
		** 
		** description : $all_posts added to get all the campus on page load
		** date : 01-08-2016
		*/
		$all_posts = $model->findAll($criteria);
		$total = $model->count($criteria);
		$pages = new CPagination($total);
		$pages->pageSize = 10;
		$pages->applyLimit($criteria);
		$posts = $model->findAll($criteria);
		if (!empty($posts)) {
			$this->render('landing_page', array(
				'posts' => $posts,
				'all_posts' => $all_posts,
				'program_posts' => $program_posts,
				'pages' => $pages,
				'total' => $total
			));
		} else {
			$this->render('landing_page', array(
				'NoDataFound' => true,
				'program_posts' => $program_posts
			));
		}
		//$this->render('landing_page');
	}
	/**
	 * Landing Page
	 */
	/*public function actionLandingpagee(){
		unset($_SESSION['promo_code']);
		$this->layout='blank';
		$this->render('lp');
	}*/
	/**
	 * Landing Page
	 */
	public function actionSearchcampus()
	{
		$this->layout = 'blank';
		if (isset($_POST['program_of_interest']) && !empty($_POST['program_of_interest'])) {
			$_SESSION['program_code'] = $_POST['program_of_interest'];
			$_SESSION['promo_code'] = $_REQUEST['promo_code'];
		}
		//Get all program_of_interest on page load
		$program_posts = $this->getAllProgramOfIntereset();

		//get all campus details on page load
		$criteria = new CDbCriteria();
		$model = new EduZipCodes();
		/*
		** 
		** description : $all_criteria and $all_posts added to get all the campus on page load
		** date : 01-08-2016
		*/
		$all_criteria = $model->getCampusCityStateFromProgram();
		$all_posts = $model->findAll($all_criteria);
		$criteria = $model->getCampusCityStateFromProgram($_SESSION['program_code']);
		$posts = $model->findAll($criteria);
		$total = $model->count($criteria);
		$pages = new CPagination($total);
		$pages->pageSize = 10;
		$pages->applyLimit($criteria);
		$posts = $model->findAll($criteria);
		if (!empty($posts)) {
			$this->render('landing_page', array(
				'posts' => $posts,
				'all_posts' => $all_posts,
				'program_posts' => $program_posts,
				'pages' => $pages,
				'total' => $total
			));
		} else {
			$this->render('landing_page', array(
				'NoDataFound' => true,
				'program_posts' => $program_posts
			));
		}
	}
	/**
	 * Check zip
	 */
	public function actionCheckzipcode()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods:GET,POST,JSONP');
		header("Access-Control-Allow-Headers:HTTP-X-REQUESTED-WITH");
		$model = new EduZipCodes();
		$zip_values = $model->checkzipcode($_REQUEST['zip_code']);
		$pixel = 0;
		if (!empty($zip_values)) {
			print json_encode(array('message' => true, 'city' => $zip_values['city'], 'state' => $zip_values['state'], 'pixel' => $pixel));
		} else {
			print json_encode(array('message' => false));
		}
		Yii::app()->end();
	}

	/**
	 * Affiliate Login Personal Profile View
	 */
	public function actionProfile()
	{
		$promo_code = Yii::app()->user->id;
		$model = $this->loadModel($promo_code);
		if (isset($_POST['AffiliateUser'])) {
			$is_verify_phone = '1';
			$is_verify_email = '1';
			$is_verify_address = '1';
			$i_reg_error = '0';
			$o_affiliate_user = new AffiliateUser();
			$allowed_verifications = $o_affiliate_user->getAllowedVerification();
			if (isset($allowed_verifications) && !empty($allowed_verifications)) {
				$is_verify_phone = $allowed_verifications[0]['verify_phone'];
				$is_verify_email = $allowed_verifications[0]['verify_email'];
				$is_verify_address = $allowed_verifications[0]['verify_address'];
			}

			//========================Verify Phone Only If Required STARTS========================
			if (isset($_POST['AffiliateUser']['phone']) && !empty($_POST['AffiliateUser']['phone']) && $is_verify_phone == '1') {
				$o_affiliate_user = new AffiliateUser();
				$msg = $o_affiliate_user->checkPhone($_POST['AffiliateUser']['phone']);
				if ($msg != 1) {
					$i_reg_error = '1';
					Yii::app()->user->setFlash('error', 'Invalid Phone Number.');
				}
			}
			//=========================Verify Phone Only If Required ENDS=========================

			//========================Verify Email Only If Required STARTS========================
			if (isset($_POST['AffiliateUser']['email']) && !empty($_POST['AffiliateUser']['email']) && $is_verify_email == '1') {
				require 'cash_lender/XverifyClientAPI.php';
				$api_key = '1000018-2917DC1B'; //'09ASXD-9E0B1F9C'; // Your API Key
				$options = array();
				$options['type'] = 'json'; // API response type
				$options['domain'] = 'higherlearningapp.com'; // Reruired your domain name 
				$options['catch_all'] = 'no'; // Reruired your domain name 
				$client = new XverifyClientAPI($api_key, $options);
				$data = array();
				$data['email'] = $_POST['AffiliateUser']['email'];
				$client->verify('email', $data);
				// print_r($client->response);
				$t_response = explode('jQuery22402469638349049722_1480935238606(', $client->response);
				if (isset($t_response) && !empty($t_response)) {
					$t_response = explode(')', $t_response[1]);
					if (isset($t_response) && !empty($t_response)) {
						$json_response = json_decode($t_response[0]);
						if ($json_response->email->status == 'valid') {
						} else {
							$i_reg_error = '1';
							Yii::app()->user->setFlash('error', 'Invalid Email Address.');
						}
					} else {
						$i_reg_error = '1';
						Yii::app()->user->setFlash('error', 'Invalid Email Address.');
					}
				} else {
					$i_reg_error = '1';
					Yii::app()->user->setFlash('error', 'Invalid Email Address.');
				}
			}
			//=========================Verify Email Only If Required ENDS=========================

			//=======================Verify Address Only If Required STARTS=======================
			if (isset($_POST['AffiliateUser']['street']) && !empty($_POST['AffiliateUser']['street']) && isset($_POST['AffiliateUser']['city']) && !empty($_POST['AffiliateUser']['city']) && isset($_POST['AffiliateUser']['state']) && !empty($_POST['AffiliateUser']['state']) && isset($_POST['AffiliateUser']['zip_code']) && !empty($_POST['AffiliateUser']['zip_code']) && $is_verify_address == '1') {
				if (!$this->actionUSPSPostalAddressVerification($_POST['AffiliateUser']['street'], $_POST['AffiliateUser']['city'], $_POST['AffiliateUser']['state'], $_POST['AffiliateUser']['zip_code'])) {
					$i_reg_error = '1';
					Yii::app()->user->setFlash('error', 'Invalid Postal Address.');
				}
			}
			//========================Verify Address Only If Required ENDS========================
			if ($i_reg_error != '1') {
				$model->attributes = $_POST['AffiliateUser'];
				$o_affiliate_user = new AffiliateUser();
				$t_affiliate_details = $o_affiliate_user->actionCheckPassword($_POST['AffiliateUser']['password'], $model->id);
				if ($t_affiliate_details) {
					$model->password = md5($_POST['AffiliateUser']['password']);
				}
				$model->street = (isset($_POST['AffiliateUser']['street']) && !empty($_POST['AffiliateUser']['street'])) ? $_POST['AffiliateUser']['street'] : '';
				$model->city = (isset($_POST['AffiliateUser']['city']) && !empty($_POST['AffiliateUser']['city'])) ? $_POST['AffiliateUser']['city'] : '';
				$model->state = (isset($_POST['AffiliateUser']['state']) && !empty($_POST['AffiliateUser']['state'])) ? $_POST['AffiliateUser']['state'] : '';
				$model->zip_code = (isset($_POST['AffiliateUser']['zip_code']) && !empty($_POST['AffiliateUser']['zip_code'])) ? $_POST['AffiliateUser']['zip_code'] : '';
				$model->website = (isset($_POST['AffiliateUser']['website']) && !empty($_POST['AffiliateUser']['website'])) ? $_POST['AffiliateUser']['website'] : '';
				$model->tax_id = (isset($_POST['AffiliateUser']['tax_id']) && !empty($_POST['AffiliateUser']['tax_id'])) ? $_POST['AffiliateUser']['tax_id'] : '';
				$model->updatedAt = date('Y-m-d H:i:s');
				if ($model->save()) {
					Yii::app()->user->setFlash('success', 'Data Updated Successfully');
				} else {
					Yii::app()->user->setFlash('error', 'Error Occured. Try Again');
				}
			}
		}
		$this->render('profile', array(
			'model' => $model,
		));
	}
	/**
	 * Get affiliate status to check test pixel fire in private labeled site.
	 */
	public function actionGetaffstatus($i_promo_code = '', $i_sub_id = '')
	{
		$_POST = $_REQUEST;
		if (isset($i_promo_code) && !empty($i_promo_code)) {
			$promo_code = $i_promo_code;
		} else {
			$promo_code = Yii::app()->request->getParam('promo_code');
		}
		if (isset($i_sub_id) && !empty($i_sub_id)) {
			$sub_id = $i_sub_id;
		} else {
			$sub_id = Yii::app()->request->getParam('sub_id');
		}
		$subid2 = Yii::app()->request->getParam('subid2');
		$sub_id2 = !empty($sub_id2) ? $sub_id2 : $subid2;
		$click_id = Yii::app()->request->getParam('click_id');
		$transaction_id = Yii::app()->request->getParam('transaction_id');
		$pixel_code = '';
		if ($promo_code) {
			$row = AffiliateUser::model()->findbyPk($promo_code);

			if ($row['status'] == '0' && $row['is_inorganic'] == '0') {
				// affiliate is in test mode and organic promo code then fired test pixel
				$process = 'organic';
				//Yii::app()->session['ping_type'] = 'directpost';
				/** Add affiliate transaction in the affiliate transaction table */
				//				LeadsController::actionAffiliateTransaction($_POST,$process); 
				//				/** Validation check function check required field and other validation */
				//				LeadsController::actionValidationCheck($_POST,$process);
				//				/** Give duplicate lead error if lead is dublicate else insert new data */
				//				LeadsController::actionCheckDuplicate($_POST,$process);
				$pixel_code = $row['pixel_code'];
				if (strlen($pixel_code) > 0 && $pixel_code != 'NULL' && $pixel_code != '') {
					$patterns = array('/ebpclickid/', '/ebpleadid/', '/ebpsubid/', '/ebptransid/', '/ebpsub2id/');
					$replacements = array($click_id, rand(1111, 9999), $sub_id, $transaction_id, $sub_id2);
					$pixel_code = urldecode($pixel_code);
					$pixel_code = preg_replace($patterns, $replacements, $pixel_code);
				}

				if ($row['pixel_type'] == 1) {
					file_get_contents($pixel_code);
					//	echo $pixel_code;
					// print_r($pixel_code);
					// print_r(file_get_contents($pixel_code));
				} else {
					return ($pixel_code);
					// echo html_entity_decode($pixel_code);
					// echo $pixel;
				}
			} elseif ($row['status'] == '1' && $row['is_inorganic'] == '1') {
				// if promo code is inorganic promo code then take his traffic.
				return 341;
			} else {
				// this promo code is active and organic promo code
				return 1;
			}
		} else {
			return 'Provide promo_code';
		}
		$process = '';
		//Yii::app()->session['ping_type'] = '';
	}
	/**
	 * Lead info for affiliates when they login
	 */
	public function actionLeadinfo()
	{
		$model = new AffiliateTransactions();
		$criteria = $model->leadinfo_for_affiliate();
		if (Yii::app()->request->getParam('export') == 'Export CSV') {
			$posts = $model->findAll($criteria);
			if (!empty($posts)) {
				header('Content-Type: text/csv; charset=utf-8');
				header('Content-Disposition: attachment; filename=data.csv');
				$output = fopen('php://output', 'w');
				//fputcsv($output, array('Date','Ping Request','Ping Response','Post Request','Post Response'));
				$value = Yii::app()->getRequest()->getParam('lead_returned');
				if (!empty($value)) {
					fputcsv($output, array('Date', 'Promo Code', 'First Name', 'Last Name', 'Email', 'Address', 'Zip', 'Phone', 'Mobile', 'Phone Cell', 'Campus', 'Program Of Intrest', 'Post Response', 'Sub Id', 'Return Reason'));
				} else {
					fputcsv($output, array('Date', 'Promo Code', 'First Name', 'Last Name', 'Email', 'Address', 'Zip', 'Phone', 'Mobile', 'Phone Cell', 'Campus', 'Program Of Intrest', 'Post Response', 'Sub Id'));
				}
				foreach ($posts as $row) {
					parse_str($row->post_request, $t_request);
					$xml = simplexml_load_string($row->post_response, "SimpleXMLElement", LIBXML_NOCDATA);
					$json = json_encode($xml);
					$t_response = json_decode($json, TRUE);
					$s_response = '';
					if (!empty($t_response)) {
						if (isset($t_response['Response'])) {
							$s_response = $t_response['Response'];
						}
						if (isset($t_response['Errors']['Error']) && !empty($t_response['Errors']['Error'])) {
							if (is_array($t_response['Errors']['Error'])) {
								$s_response .= ' , Errors : ' . implode(',', $t_response['Errors']['Error']);
							} else {
								$s_response .= ' , Errors : ' . $t_response['Errors']['Error'];
							}
						}
					}
					$data = array(
						$row->date,
						$t_request['promo_code'],
						$t_request['first_name'],
						$t_request['last_name'],
						$t_request['email'],
						$t_request['address'],
						$t_request['zip'],
						$t_request['phone'],
						$t_request['mobile'],
						$t_request['phonecell'],
						$t_request['campus'],
						$t_request['program_of_interest'],
						$s_response,
						$row->sub_id
					);
					if (!empty($value)) {
						$data[] = $row->return_reason;
					}
					fputcsv($output, $data);
				}
				exit;
			} else {
				$this->render('leadinfo', array("NoDataFound" => true));
			}
		} else {
			$total = $model->count($criteria);
			$pages = new CPagination($total);
			$pages->pageSize = 10;
			$pages->applyLimit($criteria);
			$posts = $model->findAll($criteria);
			$value = (Yii::app()->getRequest()->getParam('lead_returned') ? Yii::app()->getRequest()->getParam('lead_returned') : '');
			$this->render('leadinfo', array('posts' => $posts, 'pages' => $pages, 'total' => $total, 'is_returned' => (!empty($value) ? Yii::app()->getRequest()->getParam('lead_returned') : '')));
		}
	}
	/**
	 * Affiliate Login
	 */
	public function actionLogin()
	{
		$this->layout = '/layouts/column1';
		$model = new LoginForm();
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
		if (isset($_POST['LoginForm'])) {
			$model->attributes = $_POST['LoginForm'];
			if ($model->validate() && $model->affiliatelogin()) {
				$url = explode("/", Yii::app()->request->urlReferrer);
				if (end($url) == 'login') {
					Yii::app()->user->setReturnUrl('../default/index');
					$this->redirect(Yii::app()->user->returnUrl);
				} else {
					$this->redirect(Yii::app()->user->returnUrl);
				}
			}
		}
		$this->render('login', array(
			'model' => $model
		));
	}
	public function actionForgotPassword()
	{
		$this->layout = '/layouts/column1';
		$model = new AffiliateUser();
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'login-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if (isset($_POST['AffiliateUser']['email'])) {

			$res = $model->actionCheckAffiliateEmail($_POST['AffiliateUser']['email']);
			if ($res['success'] == '1') {

				$this->render('forgotPassword', array(
					'model' => $model,
					'email' => $_POST['AffiliateUser']['email'],
					'pass' => $res['pass']
				));
			} else {
				$this->render('forgotPassword', array(
					'model' => $model,
					'error' => $res
				));
			}
		} else {
			$this->render('forgotPassword', array(
				'model' => $model,
				'email' => ''
			));
		}
	}
	/**
	 * Affiliate Registration
	 */
	public function actionAffiliateRegister()
	{
		$this->layout = '/layouts/column1';
		$model = new AffiliateUser();
		if (Yii::app()->user->checkAccess('admin')) {
			$model->scenario = 'adminrole';
		}
		if (isset($_POST['ajax']) && $_POST['ajax'] === 'auto-affiliate-register-form') {
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		if (isset($_POST['AffiliateUser'])) {
			/**
			 * @
			 * @description : trim whitespace from user_name and email
			 * @since : 31-01-2017 10:50
			 */
			$_POST['AffiliateUser']['user_name'] = trim($_POST['AffiliateUser']['user_name']);
			$_POST['AffiliateUser']['email'] = trim($_POST['AffiliateUser']['email']);
			$is_verify_phone = '1';
			$is_verify_email = '1';
			$is_verify_address = '1';
			$i_reg_error = '0';
			$o_affiliate_user = new AffiliateUser();
			$allowed_verifications = $o_affiliate_user->getAllowedVerification();
			if (isset($allowed_verifications) && !empty($allowed_verifications)) {
				$is_verify_phone = $allowed_verifications[0]['verify_phone'];
				$is_verify_email = $allowed_verifications[0]['verify_email'];
				$is_verify_address = $allowed_verifications[0]['verify_address'];
			}

			//========================Verify Phone Only If Required STARTS========================
			if (isset($_POST['AffiliateUser']['phone']) && !empty($_POST['AffiliateUser']['phone']) && $is_verify_phone == '1') {
				$o_affiliate_user = new AffiliateUser();
				$msg = $o_affiliate_user->checkPhone($_POST['AffiliateUser']['phone']);
				if ($msg != 1) {
					$i_reg_error = '1';
					Yii::app()->user->setFlash('error', 'Invalid Phone Number.');
				}
			}
			//=========================Verify Phone Only If Required ENDS=========================

			//========================Verify Email Only If Required STARTS========================
			if (isset($_POST['AffiliateUser']['email']) && !empty($_POST['AffiliateUser']['email']) && $is_verify_email == '1') {
				require 'cash_lender/XverifyClientAPI.php';
				$api_key = '1000018-2917DC1B'; //'09ASXD-9E0B1F9C'; // Your API Key
				$options = array();
				$options['type'] = 'json'; // API response type
				$options['domain'] = 'higherlearningapp.com'; // Reruired your domain name 
				$options['catch_all'] = 'no'; // Reruired your domain name 
				$client = new XverifyClientAPI($api_key, $options);
				$data = array();
				$data['email'] = $_POST['AffiliateUser']['email'];
				$client->verify('email', $data);
				// print_r($client->response);
				$t_response = explode('jQuery22402469638349049722_1480935238606(', $client->response);
				if (isset($t_response) && !empty($t_response)) {
					$t_response = explode(')', $t_response[1]);
					if (isset($t_response) && !empty($t_response)) {
						$json_response = json_decode($t_response[0]);
						if ($json_response->email->status == 'valid') {
						} else {
							$i_reg_error = '1';
							Yii::app()->user->setFlash('error', 'Invalid Email Address.');
						}
					} else {
						$i_reg_error = '1';
						Yii::app()->user->setFlash('error', 'Invalid Email Address.');
					}
				} else {
					$i_reg_error = '1';
					Yii::app()->user->setFlash('error', 'Invalid Email Address.');
				}
			}
			//=========================Verify Email Only If Required ENDS=========================

			//=======================Verify Address Only If Required STARTS=======================
			if (isset($_POST['AffiliateUser']['street']) && !empty($_POST['AffiliateUser']['street']) && isset($_POST['AffiliateUser']['city']) && !empty($_POST['AffiliateUser']['city']) && isset($_POST['AffiliateUser']['state']) && !empty($_POST['AffiliateUser']['state']) && isset($_POST['AffiliateUser']['zip_code']) && !empty($_POST['AffiliateUser']['zip_code']) && $is_verify_address == '1') {
				if (!$this->actionUSPSPostalAddressVerification($_POST['AffiliateUser']['street'], $_POST['AffiliateUser']['city'], $_POST['AffiliateUser']['state'], $_POST['AffiliateUser']['zip_code'])) {
					$i_reg_error = '1';
					Yii::app()->user->setFlash('error', 'Invalid Postal Address.');
				}
			}
			//========================Verify Address Only If Required ENDS========================
			if ($i_reg_error != '1') {
				$last_inserted_id = '';
				$_POST['AffiliateUser']['isAdmin'] = '0';
				$_POST['AffiliateUser']['status'] = '-1';
				$model->attributes = $_POST['AffiliateUser'];
				$model->bucket_limit = 100;
				$model->margin = 10;
				$model->is_inorganic = 0;
				$model->bucket = 0;
				$model->bucket_limit = 0;
				$model->pixel_type = 0;
				$model->pixel_code = '';
				$model->pixel_count = 0;
				$model->isAdmin  = 0;
				if ($model->save()) {
					$last_inserted_id = $model->id;
				} else { /*echo '<pre>Model Errors=';print_r($model->errors);echo '</pre>';*/
				}
			}
		}
		$this->render('affiliateRegister', array(
			'model' => $model,
			'last_inserted_id' => $last_inserted_id
		));
	}
	/**
	 * 
	 */
	public function actionAffiliatestats()
	{
		$affiliatestats = array();
		if (Yii::app()->request->getParam('affiliatestats_search') == 'Get Affiliate Stats') {
			$model = new AffiliateTransactions();
			$affiliatestats = $model->affiliate_stats();
		}
		$this->render('affiliatestats', array('affiliatestats' => $affiliatestats));
	}

	public function actionAffiliatestatlogs()
	{
		$affiliatestats = array();
		if (Yii::app()->request->getParam('affiliatestats_search') == 'Get Affiliate Stat Logs') {
			$o_affiliate_stat_logs = new AffiliateStatLogs();
			$affiliatestats = $o_affiliate_stat_logs->affiliate_stat_logs();
		}
		$this->render('affiliatestatlogs', array('affiliatestats' => $affiliatestats));
	}

	/**
	 * @since : 09-12-2016 02:11 PM
	 * @author : 
	 * @functionality : Added static keyword for calling from lead controller.
	 */

	public static function actionCheckGeoFootPrint($is_inorganic = false)
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods:GET,POST,JSONP');
		header("Access-Control-Allow-Headers:HTTP-X-REQUESTED-WITH");
		$zip = $_REQUEST['zip'];
		$program_of_interest = $_REQUEST['program_of_interest'];
		$campus = $_REQUEST['campus'];
		$model = new EduZipCodes();
		if (isset($zip) && isset($program_of_interest) && isset($campus)) {
			$t_campus_program = $model->checkgeofootprint($zip, $program_of_interest, $campus);
			/* if($_SERVER['REMOTE_ADDR']=='90.197.125.231'){
				echo '<pre>'; print_r($t_campus_program);exit;
			} */
			if ($is_inorganic == 1) {
				$t_campus_program_from_zip = array('program' => $t_campus_program['program_of_interest_code'], 'campus' => $t_campus_program['campus_code'], 'lender_id' => $t_campus_program['lender_id'], 'zipcode' => $t_campus_program['zipcode'], 'city' => $t_campus_program['city'], 'state' => $t_campus_program['state']);
				return $t_campus_program_from_zip;
			} else {
				$prog_of_int = new ProgramOfInterests();
				$program_list = $prog_of_int->getProgramOfInteresetByCode($t_campus_program['program_of_interest_code']);
				$submission = new Submissions();
				$campus_list = $submission->getCampusByCampusCode($t_campus_program['campus_code']);
				print json_encode(array(
					'message' => true,
					'program' => $t_campus_program['program_of_interest_code'],
					'campus' => $t_campus_program['campus_code'],
					'lender_id' => $t_campus_program['lender_id'],
					'program_name' => $program_list['name'],
					'campus_name' => $campus_list['campus_name'],
				));
			}
		} else {
			if ($is_inorganic == 1) {
				return array('message' => false);
			} else {
				print json_encode(array('message' => false));
			}
		}
		Yii::app()->end();
	}
	/**
	 * @since : 09-12-2016 02:11 PM
	 * @author : 
	 * @functionality : Added static keyword for calling from lead controller.
	 */
	public static function actionGetCampusPorgramFromZipcode($is_not_ajax_req = '')
	{
		$model = new EduZipCodes();
		$t_campus_program = $model->getCampusProgramFromZip($_REQUEST['zip']);
		if (isset($t_campus_program) && !empty($t_campus_program)) {
			if ($is_not_ajax_req == 1) {
				$t_campus_program_from_zip = array('program' => $t_campus_program['program_of_interest_code'], 'campus' => $t_campus_program['campus_code'], 'lender_id' => $t_campus_program['lender_id']);
				return $t_campus_program_from_zip;
			} else {
				print json_encode(array('message' => true, 'program' => $t_campus_program['program_of_interest_code'], 'campus' => $t_campus_program['campus_code'], 'lender_id' => $t_campus_program['lender_id']));
			}
		} else {
			if ($is_not_ajax_req == 1) {
				return false;
			} else {
				print json_encode(array('message' => false));
			}
		}
		Yii::app()->end();
	}

	public function actionPhoneverify()
	{
		// $o_affiliate_user = new AffiliateUser();
		$o_affiliate_user = new AffiliateUser();
		$msg = $o_affiliate_user->checkPhone($_REQUEST['phone']);
		echo json_encode(array('message' => $msg));
	}

	public function actionEmailToLeadUsers()
	{
		// Get States,Zipcode details
		$o_affiliate_transacton = new AffiliateTransactions;
		$t_states = $o_affiliate_transacton->getStates();
		$t_zipcodes = $o_affiliate_transacton->getZipcodes();

		// Check for report generate
		$t_response = $this->getRequestDetails($o_affiliate_transacton);
		if (isset($t_response['found']) && ($t_response['found'] == '1')) {
			$this->render('emailToLeadUsers', array('t_states' => $t_states, 't_zipcodes' => $t_zipcodes, 't_result' => $t_response['data'], 'lead_status' => $t_response['lead_status'], 's_state' => $t_response['s_state'], 'zip_code' => $t_response['zip_code']));
		} else {
			$this->render('emailToLeadUsers', array('t_states' => $t_states, 't_zipcodes' => $t_zipcodes));
		}
	}

	public function actionSendEmailToLeadUsers()
	{
		$o_affiliate_transacton = new AffiliateTransactions;
		// Check for report generate
		$f_mail = 0;
		$t_response = $this->getRequestDetails($o_affiliate_transacton);
		if (isset($t_response['found']) && ($t_response['found'] == '1')) {
			if (!empty($t_response['data'])) {
				$subject = Yii::app()->request->getPost('subject');
				$message = Yii::app()->request->getPost('message');
				$s_emails = '';
				foreach ($t_response['data'] as $t_data) {
					$s_emails .= $t_data['email'] . ',';
				}
				$s_emails = rtrim($s_emails, ',');
				$headers  = "From: no-reply@edu.com\r\n" .
					"X-Mailer: php\r\n";
				$headers .= "MIME-Version: 1.0\r\n";
				$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
				$headers .= "Bcc: $s_emails\r\n";
				$email = mail($to, $subject, $mailmessage, $headers);
				/**
				 * @since : 08-12-2016 02:29 PM
				 * @author : 
				 * @functionality : Removed static email and replaced with admin email
				 */
				//send email copy to admin
				$to = Yii::app()->params['adminEmail'];
				$email = mail($to, $subject, $message, $headers);
				$f_mail = 1;
				if ($email) {
					Yii::app()->user->setFlash('success', 'Email Sent.');
				} else {
					Yii::app()->user->setFlash('error', 'Email Not Sent.');
				}
			}
		}
		if ($f_mail == 0) {
			Yii::app()->user->setFlash('error', 'Email Not Sent.');
		}
		$this->redirect(array('affiliates/EmailToLeadUsers'));
	}

	private function getRequestDetails($o_affiliate_transacton)
	{
		// Check for report generate
		$t_response = array('found' => '', 'data' => '');
		$lead_status = Yii::app()->request->getParam('lead_status');
		$s_state = Yii::app()->request->getParam('state');
		$zip_code = Yii::app()->request->getParam('zipcode');
		if (!empty($lead_status) || !empty($s_state) || !empty($zip_code)) {
			$t_result = $o_affiliate_transacton->getLeadsWithFilter();
			$t_response = array('found' => '1', 'data' => $t_result, 'lead_status' => $lead_status, 's_state' => $s_state, 'zip_code' => $zip_code);
		}
		return $t_response;
	}


	public function actionDuplicateIPBlockAllow()
	{
		if (isset($_REQUEST['id']) && !empty($_REQUEST['id']) && isset($_REQUEST['duplicate']) && !empty($_REQUEST['duplicate'])) {
			$o_affiliate_user = new AffiliateUser();
			$msg = '0';
			if ($_REQUEST['duplicate'] == 'Allow') {
				if ($o_affiliate_user->changeDuplicateIP($_REQUEST['id'], '0')) {
					$msg = '1';
					Yii::app()->user->setFlash('success', 'Duplicate IP Blocked.');
				}
			} else {
				if ($o_affiliate_user->changeDuplicateIP($_REQUEST['id'], '1')) {
					$msg = '1';
					Yii::app()->user->setFlash('success', 'Duplicate IP Allowed.');
				}
			}
			if ($msg == 0) {
				Yii::app()->user->setFlash('error', 'Error Occured. Try Again.');
			}
			$this->redirect('DuplicateIPBlockAllow');
		}
		$this->render('affiliates_ip_blocking');
	}

	public static function actionUSPSPostalAddressVerification($address, $city, $state, $zip)
	{
		$postalAddr['address'] = $address;
		$postalAddr['city'] = $city;
		$postalAddr['state'] = $state;
		$postalAddr['zip'] = $zip;
		if (is_array($postalAddr)) {
			$o_affiliate_user = new AffiliateUser();
			$msg = $o_affiliate_user->checkUSPSPostalAddress($address, $city, $state, $zip);
			if ($msg == '1') {
				return true;
			} else if ($msg == '2') {
				return false;
			} else {
				//check using api starts
				$address = $postalAddr['address'];
				$city = $postalAddr['city'];
				$state = $postalAddr['state'];
				$zip = $postalAddr['zip'];
				$AddressValidateRequest = '<AddressValidateRequest USERID="238ELITE1679">';
				$AddressValidateRequest .= '<Address ID="1"><Address1></Address1><Address2>' . $address . '</Address2><City>' . $city . '</City><State>' . $state . '</State><Zip5>' . $zip . '</Zip5><Zip4></Zip4></Address>';
				$AddressValidateRequest .= "</AddressValidateRequest>";
				// print_r($AddressValidateRequest);
				$ch = curl_init("http://production.shippingapis.com/ShippingAPI.dll?API=Verify&XML=" . urlencode($AddressValidateRequest));
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
				curl_setopt($ch, CURLOPT_POST, false);
				curl_setopt($ch, CURLOPT_TIMEOUT, 2);
				$AddressValidateResponse = curl_exec($ch);
				curl_close($ch);
				$response = simplexml_load_string($AddressValidateResponse);
				if (isset($response) && !empty($response)) {
					if (isset($response->Address->Error->Description)) {
						$o_affiliate_user->checkUSPSPostalAddress($address, $city, $state, $zip, '1', '0', json_encode($AddressValidateResponse));
						return false;
					}/* else if (stripos($AddressValidateResponse, "Address Not Found") !== false) {
						$o_affiliate_user->checkUSPSPostalAddress($address,$city,$state,$zip,'1','0',json_encode($AddressValidateResponse));
						return false;
					} else if(stripos($AddressValidateResponse, "but more information is needed") !== false) {
						$o_affiliate_user->checkUSPSPostalAddress($address,$city,$state,$zip,'1','0',json_encode($AddressValidateResponse));
					} else if(stripos($response, "but more information is needed") !== false) {
						$o_affiliate_user->checkUSPSPostalAddress($address,$city,$state,$zip,'1','0',json_encode($AddressValidateResponse));
					} */ else {
						$o_affiliate_user->checkUSPSPostalAddress($address, $city, $state, $zip, '1', '1', json_encode($AddressValidateResponse));
						return true;
					}
				} else {
					return false;
				}
			}
			//check using api ends
		} else {
			return false;
		}
	}

	public function actionAffiliateValidations()
	{
		if (isset($_POST['save_validations']) && !empty($_POST['save_validations'])) {
			$verify_phone = $verify_email = $verify_address = '0';
			if (isset($_POST['verify_phone'])) {
				$verify_phone = '1';
			}
			if (isset($_POST['verify_email'])) {
				$verify_email = '1';
			}
			if (isset($_POST['verify_address'])) {
				$verify_address = '1';
			}

			if ($_POST['save_validations'] == 'Submit') {
				$is_update = '0';
			} else {
				$is_update = '1';
			}
			$o_affiliate_user = new AffiliateUser();
			if ($o_affiliate_user->updateAllowedVerification($verify_phone, $verify_email, $verify_address, $is_update)) {
				Yii::app()->user->setFlash('success', 'Validations Saved.');
			}
			$_POST['save_validations'] = '';
			unset($_POST['save_validations'], $_POST);
		}
		$o_affiliate_user = new AffiliateUser();
		$allowed_verifications = $o_affiliate_user->getAllowedVerification();
		$this->render('affiliates_registration_validation', array('allowed_verifications' => $allowed_verifications));
	}

	/**
	 * @since : 14-12-2016 05:00 PM
	 * @author : 
	 * @functionality : Display affiliate report as displayed in affiliate login - Dashboard
	 */
	public function actionAffiliateReport()
	{
		$o_affiliate_trans_model = new AffiliateTransactions;
		$t_affiliate_reports = array();
		if (Yii::app()->request->getParam('affiliate_report') == 'Get Affiliates Report') {
			$t_affiliate_reports = $o_affiliate_trans_model->getAffiliateReport();
		}
		unset($o_affiliate_trans_model);
		$this->render('affiliateReport', array('t_affiliate_reports' => $t_affiliate_reports));
	}

	public function actionProgramOfInterestUsingCampusCode()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Methods:GET,POST,JSONP');
		header("Access-Control-Allow-Headers:HTTP-X-REQUESTED-WITH");
		$model = new EduZipCodes();
		$t_programs = $model->getProgramFromCampusCityState($_REQUEST['campus_code']);
		//echo '<pre>';print_r($t_programs);exit;
		if (!empty($t_programs)) {
			foreach ($t_programs as $t_programs) {
				$t_programs_details[$t_programs['prog_code']] = $t_programs['college_name'] . ' : ' . $t_programs['prog_name'];
			}
			$program_count = sizeof($t_programs_details);
			print json_encode(array('message' => true, 'programs' => $t_programs_details, 'program_count' => $program_count));
		} else {
			print json_encode(array('message' => false));
		}
		Yii::app()->end();
	}
}
