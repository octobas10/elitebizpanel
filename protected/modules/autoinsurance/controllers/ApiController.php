<?php
class ApiController extends Controller{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public $layout='/layouts/api_layout';
	
	public function actionIndex(){
		$this->render('index');
	}
	public function actionPingpost(){
		$this->render('pingpost');
	}
}
