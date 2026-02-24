<?php
class FeedVendorTransactionsController extends Controller
{	/**
	 * This action invoked for insert record in affiliate_transaction table
	*/
	public static function actionCreate()
	{  
	     $data = $_POST;
	     $request = ''; 
	     //$model = new FeedVendorTransactions;
	     $model = new AutoFeedVendorTransactions;
		 $model->createdAt =  date('Y-m-d H:i:s');
		 //$model->ip = Yii::app()->request->userHostAddress;
		 $model->feed_vendor_id = $feed_vendor_id = isset($data['vendor_id']) ? $data['vendor_id'] : '';
		 $model->request = http_build_query($data);  
	  	 $model->insert();
		 // Last inserted ID in affiliate_transaction table
			
		/**
		 ** Author : Vatsal Gadhia
		 ** Modification : db_edu component replaced by db so that data can be access from new db of edu module
		 ** Modification Date : 01-08-2016
		**/
//		 Yii::app()->session['vendor_trans_id'] = Yii::app()->db->lastInsertID;
		 Yii::app()->session['vendor_trans_id'] = $model->id;;
    }
	public function loadModel($id)
	{
		//$model = FeedVendorTransactions::model()->findByPk($id);
		$model = AutoFeedVendorTransactions::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404, "Couldn't complete the operation");
		return $model;
	}
}	
