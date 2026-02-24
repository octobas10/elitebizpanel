<?php
class ApiController extends Controller{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public $layout='/layouts/api_layout';
	
	public function actionIndex(){
		$this->render('index',['title' => 'Direct Post']);
	}
	public function actionPingpost(){
		$this->render('pingpost',['title' => 'Ping Post']);
	}
}
