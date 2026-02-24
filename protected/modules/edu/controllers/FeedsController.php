<?php
class FeedsController extends Controller{
	public $layout ='column1';
	 /**
	 * @return array action filters
	 */
	public function filters(){
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}
	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules(){
		return array(
			array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('listvendor','updatevendor','createvendor','viewvendor','deletevendor','listlender','updatelender','createlendor','viewlender','deletelender','managelender','UpdateByData','createlender','data','pausevendorAjax','feedlendertransaction','feed','leadinfo'),
				'users'=>array('admin'),
			),
			// allow authenticated users to perform these actions
			array('allow',
				'actions'=>array('leadinfo'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	public function loadModelFeedVendor($id){
		$model=EduFeedVendors::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	public function loadModelFeedLender($id){
		$model=EduFeedLenders::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreatevendor(){
		$model=new EduFeedVendors;
		if(isset($_POST['EduFeedVendors'])){
			$_POST['EduFeedVendors']['status']=1;
			$model->attributes=$_POST['EduFeedVendors'];
			if($model->save())
				$this->redirect(array('Viewvendor','id'=>$model->id));
			/*else
				print_r($model->getErrors());
			exit();*/
		}
		$this->render('createvendor',array('model'=>$model));
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdatevendor($id){
		$model=$this->loadModelFeedVendor($id);
		if(isset($_POST['EduFeedVendors'])){           
			$model->attributes=$_POST['EduFeedVendors'];
			if($model->save())
				$this->redirect(array('viewvendor','id'=>$model->id));
			/*else
				print_r($model->getErrors());
			exit();*/
		}
		$this->render('updatevendor',array('model'=>$model));
	}
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeletevendor($id){
		$this->loadModelFeedVendor($id)->delete();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	public function actionViewvendor($id){
		$this->render('viewvendor',array(
			'model' => $this->loadModelFeedVendor($id) 
		));
	}
	public function actionListvendor(){
		$model=new EduFeedVendors('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['EduFeedVendors']))
			$model->attributes=$_GET['EduFeedVendors'];
		$this->render('listvendor',array('model'=>$model));
	}
	public function actionIndex(){
		$this->render('index',array('model'=>$model));
	}
	/*====================================================*/
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionViewlender($id){
		$this->render('viewlender',array(
			'model'=>$this->loadModelFeedLender($id),
		));
	}
	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreatelender(){
		$model=new EduFeedLenders;
		if(isset($_POST['EduFeedLenders'])){
			$_POST['EduFeedLenders']['password']=md5($_POST['EduFeedLenders']['password']);
			$_POST['EduFeedLenders']['paused_vendor']=0;
			$model->attributes=$_POST['EduFeedLenders'];
			$delay = $_POST['EduFeedLenders']['delay'];
			$delaytime = $_POST['delaytime'];
			if($delaytime=='DAY'){
				$delay = $delay * 24;
			}
		    $interval = $_POST['EduFeedLenders']['interval'];
			$intervaltime = $_POST['intervaltime'];
			if($intervaltime == 'min'){
			 $interval = $interval *60;
			}
			$model->interval = $interval;
			$model->delay = $delay;
			if($model->save())
				$this->redirect(array('viewlender','id'=>$model->id));
			/*else
				print_r($model->getErrors());
			exit();*/
		}
		$this->render('createlender',array('model'=>$model));
	}
	public function actionData($id){
		$this->layout='blank';
		$this->render('dialogbox',array('id'=>$id));  
	}
	public function actionPausevendorAjax(){
		$model=new EduFeedLenders();
		$xml_cat = $model->getvendorslist(); 
		echo $xml_cat; 
	}
	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated 
	 */
	public function actionUpdatelender($id){
		$model=$this->loadModelFeedLender($id);
		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);
		if(isset($_POST['EduFeedLenders'])){
             if($model->password != $_POST['EduFeedLenders']['password']){
                $_POST['EduFeedLenders']['password']=md5($_POST['EduFeedLenders']['password']);
            }
			$model->attributes=$_POST['EduFeedLenders'];
			$delay = $_POST['EduFeedLenders']['delay'];
			$delaytime = $_POST['delaytime'];
			if($delaytime=='DAY'){
				$delay = $delay * 24;
			}
			//$delays = $delay.' '.$delaytime; 
		    $interval = $_POST['EduFeedLenders']['interval'];
			$intervaltime = $_POST['intervaltime'];
			if($intervaltime == 'min'){
			 $interval = $interval *60;
			}
			$model->interval = $interval;
			$model->delay = $delay;
			if($model->save())
				$this->redirect(array('viewlender','id'=>$model->id));
		}
		$this->render('updatelender',array('model'=>$model));
	}
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDeletelender($id){
		$this->loadModelFeedLender($id)->delete();
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}
	/**
	 * Lists all models.
	 */
	public function actionListlender(){
	   $model=new EduFeedLenders('search');
		$model->unsetAttributes();
		if(isset($_GET['EduFeedLenders']))
			$model->attributes=$_GET['EduFeedLenders'];

		$this->render('listlender',array('model'=>$model));
	}
	/**
	 * Manages all models.
	 */
	public function actionManagelender(){
		$model=new EduFeedLenders('search');
		$model->unsetAttributes();
		if(isset($_GET['EduFeedLenders']))
			$model->attributes=$_GET['EduFeedLenders'];

		$this->render('managelender',array(
			'model'=>$model,
		));
	}
	public function actionUpdateByData(){
	    $id = $_POST['pk'] ; 
		$link_parts = explode("/",$_SERVER['HTTP_REFERER']);
		if(in_array("listlender",$link_parts))
		{
			$model=$this->loadModelFeedLender($id);
			if(isset($id)){
			  EduFeedLenders::model()->updateByPk($id,array($_POST['name']=>$_POST['value'])); 
			}
		}
		else if(in_array("listvendor",$link_parts))
		{
			$model=$this->loadModelFeedVendor($id);
			if(isset($id)){
			  EduFeedVendors::model()->updateByPk($id,array($_POST['name']=>$_POST['value'])); 
			}
		}
		else
		{
				echo "Error Occured";
		}
	}
	
	public function actionFeedLenderTransaction()
	{
		$model = new FeedLenderTransactions();
		$criteria = new CDbCriteria();
		$criteria = $model->browsefeedlendertransction();
		$total = $model->count($criteria);
		$pages = new CPagination($total);
		$pages->pageSize = 10;
		$pages->applyLimit($criteria);
		$posts = $model->findAll($criteria);
		$this->render('feedlendertransaction',array(
			'rawData' => $posts,
			'pages' => $pages,
			'total' => $total
		));
	}
	
	public function actionFeed(){
		$this->layout='/layouts/api_layout';
		$this->render('feed');
	}
	public function actionLeadinfo(){
		$model = new FeedLenderTransactions();
		$criteria = $model->leadinfo_for_specfic_lender();
		if(Yii::app()->request->getParam('export')=='Export CSV'){
			$posts = $model->findAll($criteria);
			if(!empty($posts)){
				header('Content-Type: text/csv; charset=utf-8');
				header('Content-Disposition: attachment; filename=data.csv');
				$output = fopen('php://output', 'w');
				fputcsv($output, array('date','request','full_response'));
				foreach($posts as $row){
					$data = array(
						$row->date,
						$row->request,
						$row->full_response,
					);
					fputcsv($output, $data);
				}
				exit;
			}else{
				$this->render('leadinfo',array("NoDataFound"=>true));
			}
		}else{
			$total = $model->count($criteria);
			$pages = new CPagination($total);
			$pages->pageSize = 10;
			$pages->applyLimit($criteria);
			$posts = $model->findAll($criteria);
			
			$this->render('leadinfo',array('posts' => $posts,'pages' => $pages,'total' => $total));
		}
	}
	
}
?>
