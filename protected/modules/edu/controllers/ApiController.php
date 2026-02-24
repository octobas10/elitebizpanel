<?php
class ApiController extends Controller{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public $layout='/layouts/api_layout';
	
	public function actionIndex(){
		$AllPrograms = CHtml::listData(ProgramOfInterests::model()->findAllByAttributes(array(),array('order'=>'code ASC')),'code','name');
		//echo '<pre>';print_r($AllPrograms);exit;
		$campus_details = new CampusDetails();
		$campus_programs = $campus_details->getAPIDataEDU();
		$this->render('index',array(
			'programs'=>$AllPrograms,
			'campus_programs'=>$campus_programs,
		));
	}
	/*public function actionPingpost(){
		$this->render('pingpost');
	}*/
	public function actionPostrequest(){
		$this->render('pr');
	}
}
