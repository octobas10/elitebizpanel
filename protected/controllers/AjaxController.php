<?php
class AjaxController extends Controller{	
	public function actionIndex(){
		$connection=Yii::app()->db; 
		//$year  = @date('Y'); 
		if((Yii::app()->request->getParam('fetch')) && Yii::app()->request->getParam('fetch') =='year'){
			$result_year = "SELECT year FROM car_data GROUP BY year"; 
			$command=$connection->createCommand($result_year);
			$res_year = $command->queryAll();
			foreach($res_year as $row){
				$arr[$row['year']] =  $row['year'];
			}
			$arr = json_encode($arr);
			echo $arr;
		}
		elseif((Yii::app()->request->getParam('fetch')) && Yii::app()->request->getParam('fetch') =='make' && (Yii::app()->request->getParam('year')!="")){
			$year=Yii::app()->request->getParam('year');
			$result_make = "SELECT make FROM car_data WHERE year='".$year."' GROUP BY make"; 
			$command=$connection->createCommand($result_make);
			$res_make = $command->queryAll();
			foreach($res_make as $row){
				$arr[$row['make']] =  $row['make'];
			}
			$arr = json_encode($arr);
			echo $arr;
		}
		elseif((Yii::app()->request->getParam('fetch')) && Yii::app()->request->getParam('fetch') =='model' && (Yii::app()->request->getParam('make')!="")){
			$year=Yii::app()->request->getParam('year');
			$make=Yii::app()->request->getParam('make');
			$result_model = "SELECT model FROM car_data WHERE year='".$year."' AND make='".$make."' GROUP BY model";
			$command=$connection->createCommand($result_model);
			$res_model = $command->queryAll();
			foreach($res_model as $row){
				$arr[$row['model']] =  $row['model']; 
			}
			$arr = json_encode($arr);
			echo $arr;
		}
		elseif((Yii::app()->request->getParam('fetch')) && Yii::app()->request->getParam('fetch') =='trim' && (Yii::app()->request->getParam('model')!="")){
			$year=Yii::app()->request->getParam('year');
			$make=Yii::app()->request->getParam('make');
			$model=Yii::app()->request->getParam('model');
		 	$result_trim = "SELECT trim FROM car_data WHERE year='".$year."' AND make='".$make."' AND model='".$model."' GROUP BY trim";
		  	$command=$connection->createCommand($result_trim);
		  	$res_trim = $command->queryAll();
			foreach($res_trim as $row){
				$arr[$row['trim']] =  $row['trim']; 
			}
			$arr = json_encode($arr);
		  	echo $arr;
		 }
		 elseif(Yii::app()->request->getParam('fetch') && Yii::app()->request->getParam('fetch') =='city_state'){
			 $zip=Yii::app()->request->getParam('Submissions_zip');
			 $result_trim = "SELECT city,state FROM zipcodes WHERE zipcode='".$zip."'";
			 $command=$connection->createCommand($result_trim);
			 $city_state = $command->queryRow();
			 $arr = json_encode($city_state);
			 echo $arr;
		}elseif(Yii::app()->request->getParam('reset')){
			unset(Yii::app()->session[Yii::app()->request->getParam('reset')]);
			echo "success";
		}
	}
}	
