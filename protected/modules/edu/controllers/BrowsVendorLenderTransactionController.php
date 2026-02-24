<?php
class BrowsVendorLenderTransactionController extends Controller{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='column1';

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
				'actions'=>array('index','view'),
				'users'=>array('admin'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}
	
	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id){
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}
	

	/**
	 * Lists all models.
	 */
	public function actionIndex(){	
		$model = new FeedLenderVendorTransaction();
		$model1 = new EduFeedVendors();
		$criteria = new CDbCriteria();
		$criteria = $model->browse_lender_vendor_transactions();
		$total = $model->count($criteria);
		$pages = new CPagination($total);
		$pages->pageSize = 10;
		$pages->applyLimit($criteria);
		$posts = $model->findAll($criteria);
		$vendor_data = $model1->findAll(array("select"=>array('id','first_name'), "order"=>"id DESC"));
		$this->render('index',array(
			'rawData' => $posts,
			'vendor_rawData' => $vendor_data,
			'pages' => $pages,
			'total' => $total
		));
	}
	
}
