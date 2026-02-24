<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
class CampusSettingsController extends Controller{
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
	public function filters(){
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
	public function accessRules(){
		return array(
			// allow admin user to perform these actions
			array(
				'allow',
				'actions' => array('index','savecap','create','view','update','delete','UpdateByData','UpdateByValue','data','setProgramStatus'),
				'users' => array('admin')
			),
			// deny all users
			array(
				'deny',
				'users' => array('*') 
			) 
		);
	}
	public function loadModel($id){
		$model = CampusDetails::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * @author : 
	 * @description : load index page along with campus details and cap details
	 * @since : 09-09-2016
	 */
	public function actionIndex(){
		$model = new CampusDetails('search');
		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['CampusDetails'])){
			$model->attributes = $_GET['CampusDetails'];
		}
        $cap_types = array('1'=>'Monthly Limit','2'=>'Weekly Limit','3'=>'Daily Limit');
		$this->render('index',array(
			'campuses'=>CHtml::listData(CampusDetails::model()->with('lender_details')->findAllByAttributes(array('active_campus'=>'1')),'id','campus_name'),
			'lenders'=>CHtml::listData(LenderDetails::model()->findAllByAttributes(array()),'id','name'),
			'cap_types'=>$cap_types,
			'model' => $model
		));
		
	}
	public function actionCreate(){
		$model = new CampusDetails;
     	if(isset($_POST['CampusDetails'])){
			$model->attributes=$_POST['CampusDetails'];
			$model->ground_campus = ($_POST['CampusDetails']['ground_campus']=='on') ? 1 : 0;
			$model->ground_campus_grad_year = $model->ground_campus == 1 ? $model->ground_campus_grad_year : 0;
			if($model->save()){
				$zipcodes = explode("\r\n", $_POST['CampusDetails']['zipcode_list']);
				$programs = $_POST['selected_programs'];
				$eduZip = new EduZipCodes();
				if($zipcodes && $programs){
					foreach ($zipcodes as $zipcode) {
						$zipcodedb = $eduZip->checkzipcodedatabase($zipcode);
						foreach ($programs as $program){
							$eduZip = new EduZipCodes();
							$eduZip->zipcode = $zipcode;
							$eduZip->lender_id = $model->lender;
							$eduZip->city = $zipcodedb['city']?$zipcodedb['city']:'00000';
							$eduZip->state = $zipcodedb['state']?$zipcodedb['state']:'NY';
							$eduZip->campus_code = $model->campus_code;
							$eduZip->lng = $zipcodedb['lat']?$zipcodedb['lat']:'0';
							$eduZip->lat = $zipcodedb['lng']?$zipcodedb['lng']:'0';
							$eduZip->status = '1';
							$eduZip->program_of_interest_code = $program;
							$exists = EduZipCodes::model()->exists('zipcode ='.$zipcode.' and lender_id='.$model->lender.' and campus_code="'.$model->campus_code.'" and program_of_interest_code="'.$program.'"');
							if(!$exists){
								$eduZip->save();
							}
						}
					}
				}
				$this->redirect(array('view','id'=>$model->id));
			}
		}
		/*$all_programs = CHtml::listData(ProgramOfInterests::model()->findAllByAttributes(array()),'code','name');
		*/
      	$this->render('create',array(
      		'model'=>$model,
      		'all_programs'=>CHtml::listData(ProgramOfInterests::model()->findAllByAttributes(array()),'code','name'),
		));
	}
	public function actionUpdate($id){
		$model=$this->loadModel($id);
		$model->validate();
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['CampusDetails'])){
			$model->attributes=$_POST['CampusDetails'];
			$model->ground_campus = ($_POST['CampusDetails']['ground_campus']=='on') ? 1 : 0;
			$model->ground_campus_grad_year = $model->ground_campus == 1 ? $model->ground_campus_grad_year : 0;
			if($model->save()){
				$zipcodes = explode("\r\n", $_POST['CampusDetails']['zipcode_list']);
				$programs = $_POST['selected_programs'];
				$eduZip = new EduZipCodes();
				if($zipcodes && $programs){
					foreach ($zipcodes as $zipcode) {
						$zipcodedb = $eduZip->checkzipcodedatabase($zipcode);
						foreach ($programs as $program){
							$eduZip = new EduZipCodes();
							$eduZip->zipcode = $zipcode;
							$eduZip->lender_id = $model->lender;
							$eduZip->city = $zipcodedb['city']?$zipcodedb['city']:'00000';
							$eduZip->state = $zipcodedb['state']?$zipcodedb['state']:'NY';
							$eduZip->campus_code = $model->campus_code;
							$eduZip->lng = $zipcodedb['lat']?$zipcodedb['lat']:'0';
							$eduZip->lat = $zipcodedb['lng']?$zipcodedb['lng']:'0';
							$eduZip->status = '1';
							$eduZip->program_of_interest_code = $program;
							$exists = EduZipCodes::model()->exists('zipcode ='.$zipcode.' and lender_id='.$model->lender.' and campus_code="'.$model->campus_code.'" and program_of_interest_code="'.$program.'"');
							if(!$exists){
								$eduZip->save();
							}
						}
					}
				}
				$this->redirect(array('view','id'=>$model->id));
			}
		}
		$programsofcampus = [];
		$o_campus_details = new CampusDetails();
		$programs_of_campus = $o_campus_details->getAllProgramsOfCampus($model->campus_code,$model->lender);

		if($programs_of_campus){
			foreach ($programs_of_campus as $programs) {
				$programsofcampus[$programs['program_of_interest_code']] =  $programs['name'];
			}
		}
		$all_programs = CHtml::listData(ProgramOfInterests::model()->findAllByAttributes(array()),'code','name');
        $all_programs = array_diff($all_programs, $programsofcampus);
		$this->render('update',array(
			'model'=>$model,
			'programsofcampus' => $programsofcampus,
			'all_programs'=>$all_programs,
		));
	}
	/**
	 * @author : 
	 * @description : code to update data through editable column (works just like editable saver)
	 * @since : 09-09-2016
	 */
	public function actionUpdateByData(){
        $_REQUEST['campus_id'] = Yii::app()->request->getParam('pk');
        if(Yii::app()->request->getParam('name')=='daily_limit') {
        	$_REQUEST['cap_type'] = array('0'=>'3');
        } else if(Yii::app()->request->getParam('name')=='weekly_limit') {
        	$_REQUEST['cap_type'] = array('0'=>'2');
        } else if(Yii::app()->request->getParam('name')=='monthly_limit') {
        	$_REQUEST['cap_type'] = array('0'=>'1');
        }
        $_REQUEST['cap'] = Yii::app()->request->getParam('value');
        $o_campus_details = new CampusDetails('search');
        $cap_save = $o_campus_details->addCap($_REQUEST);
        if($cap_save) {
			echo "Cap Saved Successfully.";
			Yii::app()->end();
		} else {
			echo Yii::app()->user->getFlash('error');
		}
		unset($_REQUEST,$o_campus_details);
		Yii::app()->end();
	}
	public function actionUpdateByValue(){
		Yii::import('ext.editable.EditableSaver');
		$es = new EditableSaver('CampusDetails');
		$es->update();
	}
	/**
	 * @author : 
	 * @description : add cap in campuses table for selected campus
	 * @since : 09-09-2016
	 */
	public function actionSaveCap(){
		if(isset($_REQUEST) && !empty($_REQUEST)) {
	        $o_campus_details = new CampusDetails();
	        $cap_save = $o_campus_details->addCap($_REQUEST);
			if($cap_save) {
				Yii::app()->user->setFlash('success','Cap Saved Successfully');
			}
			unset($_REQUEST,$o_campus_details);
		}
		$this->redirect('index');
	}

	/**
	 * @author : 
	 * @description : load view page of requested campus
	 * @since : 09-09-2016
	 */
	public function actionView($id){
		$this->render('view',array(
			'model' => $this->loadModel($id) 
		));
	}
	

	/**
	 * @author : 
	 * @description : delete cap from campuses table for selected campus
	 * @since : 09-09-2016
	 */
	public function actionDelete($id){
		if(isset($id) && !empty($id)) {
	        $o_campus_details = new CampusDetails();
	        $cap_delete = $o_campus_details->deleteCap($id);
			if($cap_delete) {
				Yii::app()->user->setFlash('success','Cap Deleted Successfully');
				return true;
			} else {
				Yii::app()->user->setFlash('error','Error Occured. Try Again.');
			}
			return false;
		}
		if(!isset($_GET['ajax'])) {
			$this->redirect('index');
		}
	}
	public function actionsetProgramStatus(){
		$o_campus_details = new CampusDetails();
		$programs_of_campus = $o_campus_details->setEduZipcodeStatus($_GET);
	}
	public function actionData(){
		$this->layout='blank';
		$campus_code = $_REQUEST['campus_code'];
		$lender_id = $_REQUEST['lender_id'];
		$o_campus_details = new CampusDetails();
	    $programs_of_campus = $o_campus_details->getAllProgramsOfCampus($campus_code,$lender_id);
		$this->render('dialogbox',array(
			'campus_code'=>$campus_code,
			'programs_of_campus'=>$programs_of_campus,
		));  
	}
	
}
