<?php
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
class FeedLendersController extends Controller{
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
			// allow all users to perform these actions
			array(
				'allow',
				'actions' => array('login','forgotPassword'),
				'users' => array('*') 
			),
			// allow authenticated user to perform these actions
			array(
				'allow',
				'actions' => array(
					'profile',
				),
				'users' => array('@')
			),
			// deny all users
			array(
				'deny',
				'users' => array('*') 
			) 
		);
	}
	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id){
		$this->loadModel($id)->delete();
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array(
				'admin' 
			));
	}
	/**
	 * Lists all models.
	 */
	public function actionIndex(){
		$model = new EduFeedLenders('search');
		$model->unsetAttributes(); // clear any default values
		if(isset($_GET['feedlender']))
			$model->attributes = $_GET['feedlender'];
		
		$dataProvider_affiliate=new CActiveDataProvider('feedlender',array(
			'criteria'=>array('order'=>'id DESC'),'pagination'=>array('pageSize'=>15)));
		
		$this->render('index',array(
			'model' => $model,
			'dataProvider_affiliate' => $dataProvider_affiliate
		));
	}
	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id){
		$model = EduFeedLenders::model()->findByPk($id);
		if($model === null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
	/**
	 * Affiliate Login Personal Profile View
	 */
	public function actionProfile(){
		$promo_code = Yii::app()->user->id;
		$model = $this->loadModel($promo_code);
		if(isset($_POST['EduFeedLenders'])){
			$model->attributes = $_POST['EduFeedLenders'];
			if($model->save()){
				Yii::app()->user->setFlash('success','Data Updated Successfully');
			}else{
				Yii::app()->user->setFlash('error','Error Occured. Try Again');
			}
		}
		$this->render('profile',array(
			'model' => $model,
		));
	}
	/**
	 * Feed Lender Login
	 */
	public function actionLogin(){
		$this->layout = '/layouts/column1';
		$model = new LoginForm();
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'login-form'){
			echo CActiveForm::validate ($model);
			Yii::app()->end();
		}
		if(isset($_POST['LoginForm'])){
			$model->attributes = $_POST['LoginForm'];
			if($model->validate() && $model->feedlenderlogin()){
				$url = explode ( "/", Yii::app()->request->urlReferrer);
				if(end($url) == 'login'){
					Yii::app()->user->setReturnUrl('../default/index');
					$this->redirect(Yii::app()->user->returnUrl);
				}else{
					$this->redirect(Yii::app()->user->returnUrl);
				}
			}
		}
		$this->render('login', array(
			'model' => $model
		) );
	}

	/**
	 * @author : Vatsal Gadhia
	 * @description : forgot password
	 * @since : 19-10-2016
	*/
	public function actionForgotPassword(){
		$model = new EduFeedLenders();
		if(isset($_POST['ajax']) && $_POST['ajax'] === 'login-form'){
			echo CActiveForm::validate ($model);
			Yii::app()->end();
		}
        
		if(isset($_POST['EduFeedLenders']['email'])){
           
 			$res=$model->actionCheckFeedLenderEmail($_POST['EduFeedLenders']['email']);
 			
            if(isset($res['success']) && $res['success']=='1'){
               
                $this->render('forgotPassword', array(
			         'model' => $model,
                    'email'=>$_POST['EduFeedLenders']['email'],
                    'pass'=>$res['pass']
		          ) );
            }else{
                 $this->render('forgotPassword', array(
			         'model' => $model,
                    'error'=>$res
		          ) );
            }
		}else{
		$this->render('forgotPassword', array(
			'model' => $model,
             'email'=>''
		) );
        }
    }
}
