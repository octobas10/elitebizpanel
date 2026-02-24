<?php
class ApiController extends Controller{
	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public $layout='/layouts/api_layout';
	
	public function actionIndex(){
		$projects = CHtml::listData(Projects::model()->findAllByAttributes([],['order'=>'project_type ASC']),'project_id','project_type');
		$task = new Tasks();
		$task_details = $task->getTasksbyProject();
		$providers = CHtml::listData(Providers::model()->findAllByAttributes([],['order'=>'provider_id ASC']),'provider_id','provider_name');
		$this->render('index',[
			'projects'=> $projects,
			'task_details' => $task_details,
			'providers'   => $providers,
		]);
	}
	public function actionPingpost(){
		$projects = CHtml::listData(Projects::model()->findAllByAttributes([],['order'=>'project_type ASC']),'project_id','project_type');
		$task = new Tasks();
		$task_details = $task->getTasksbyProject();
		$providers = CHtml::listData(Providers::model()->findAllByAttributes([],['order'=>'provider_id ASC']),'provider_id','provider_name');
		$this->render('pingpost',[
			'projects'=> $projects,
			'task_details' => $task_details,
			'providers'   => $providers,
		]);
	}
	public function actionPostrequest(){
		$this->render('pr');
	}

	/**
	 * Get Home Projects in private labeled site.
	 */
	public function actionHomeprojects(){
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$projects = CHtml::listData(Projects::model()->findAllByAttributes([],['order'=>'project_type ASC']),'project_id','project_type');
		if(!empty($projects)){	
			$data =  json_encode($projects);
		}else{
			$data = json_encode(['message' => 'No Record Found.', 'status' => false]);
		}
		echo $data;
	}
	/**
	 * Get Project providers labeled site.
	 */
	public function actionProjectproviders(){	
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$providers = CHtml::listData(Providers::model()->findAllByAttributes([],['order'=>'provider_name ASC']),'provider_id','provider_name');
		if(!empty($providers)){
			$data =  json_encode($providers);
		}else{
			$data = json_encode(['message' => 'No Record Found.','status' => false]);
		}
		echo $data;
	}
	public function actionTasksbyprojecttype(){
		header('Content-Type: application/json');
		header('Access-Control-Allow-Origin: *');
		$project_type = Yii::app()->request->getParam('project_type');
		$task = new Tasks();
		$task_details = $task->getTasksbyProject($project_type,1);
		if($task_details){
			$data = json_encode(['task_details' => $task_details, 'status' => true]);
		}else{
			$data = json_encode(['message' => 'No Record Found.', 'status' => false]);
		}
		echo $data;
	}
	
}
