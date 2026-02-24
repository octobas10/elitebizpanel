<?php
class CampusDetails extends EModuleActiveRecord {
	/**   
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LenderDetails the static model class
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName(){
		return 'campuses';
	}
	public function relations(){
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'lender_details' => array(self::BELONGS_TO,'LenderDetails', 'lender'),
		);
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		   array('campus_name,daily_limit,weekly_limit,monthly_limit,active_campus,ground_campus,campus_code,description,lender','required'),
		   array('ground_campus_grad_year,campus_id,zipcode_list','length'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id','safe', 'on'=>'search'),
			array('updated_at','safe', 'except' => array('create', 'update')),
		);
	}
	public function search(){
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		/*$criteria = new CDbCriteria;
		$criteria->compare('id',$this->id,false);
		$criteria->compare('campus_name',$this->campus_name,true);
		$criteria->compare('daily_limit',$this->daily_limit,true);
		$criteria->compare('weekly_limit',$this->weekly_limit,true);
		$criteria->compare('monthly_limit',$this->monthly_limit,true);
		$criteria->compare('active_campus', '1');*/
		return new CActiveDataProvider($this, array(
			   'pagination'=>array(
               'pageSize'=>100,
            ),
			//'criteria'=>$criteria,
			 'criteria'=>array(
			 	'condition'=>'lender_details.status = 1',
                'with'=>array('lender_details'=>array('joinType'=>'JOIN')),
                "order" => "lender_details.id DESC",
            ),
			/*'sort'=>array(
                'defaultOrder'=>'lender_details.id DESC',
            ),*/

		));
	}

	public function margin_percent(){
		for($i = 10; $i <= 100; $i++){
			$percent[$i] = $i;
		}
		return array('' => 'Percent') + $percent;
	}

	/**
	 * @author : 
	 * @description : add cap in campuses table
	 * @since : 09-09-2016
	 * @modification : getCampusCapDetails() is modified so "and" is replaced by "where" clause
	 * @since : 09-09-2016
	 */
	public function addCap($request){
		if(isset($request) && !empty($request)) {
			$t_campus_cap_details = $this->getCampusCapDetails("where id=".$_REQUEST['campus_id']);
			$daily_limit=array();
			$weekly_limit=array();
			$monthly_limit=array();
			$updated_at=array('updated_at'=>date('Y-m-d h:i:s'));
			//'1'=>'Monthly Limit','2'=>'Weekly Limit','3'=>'Daily Limit'
			foreach ($request['cap_type'] as $cap_type) {
				if($cap_type==1) {
					$monthly_limit =  array('monthly_limit'=>$request['cap']);
					$i_monthly_limit =  $request['cap'];
				} else if($cap_type==2) {
					$weekly_limit =  array('weekly_limit'=>$request['cap']);
					$i_weekly_limit =  $request['cap'];
				} else if($cap_type==3) {
					$daily_limit =  array('daily_limit'=>$request['cap']);
					$i_daily_limit =  $request['cap'];
				}
			}
			if(isset($t_campus_cap_details) && !empty($t_campus_cap_details)) {
				if(isset($i_monthly_limit) && !empty($i_monthly_limit)) {
					if($i_monthly_limit != -1) {
						
						if($i_monthly_limit<$t_campus_cap_details[0]['weekly_limit'] || $i_monthly_limit<$t_campus_cap_details[0]['daily_limit']) {
								Yii::app()->user->setFlash('error','Monthly Limit Should Be Greater Then Weekly And Daily Limit.');
								return false;
						}
					}
				}

				if(isset($i_weekly_limit) && !empty($i_weekly_limit)) {
					if($i_weekly_limit != -1) {
						
						if($i_weekly_limit>$t_campus_cap_details[0]['monthly_limit']) {
								Yii::app()->user->setFlash('error','Weekly Limit Should Be Less Then Monthly Limit.');
								return false;
						}
						if($i_weekly_limit<$t_campus_cap_details[0]['daily_limit']) {
								Yii::app()->user->setFlash('error','Weekly Limit Should Be Greater Then Daily Limit.');
								return false;
						}
					}
				}
				if(isset($i_daily_limit) && !empty($i_daily_limit)) {
					if($i_daily_limit != -1) {
						if($t_campus_cap_details[0]['weekly_limit']!=-1) {
							if($i_daily_limit>$t_campus_cap_details[0]['weekly_limit']) {
								Yii::app()->user->setFlash('error','Daily Limit Should Be Less Then Weekly Limit.');
								return false;
							}
						}
						if($t_campus_cap_details[0]['monthly_limit']!=-1) {
							if($i_daily_limit>$t_campus_cap_details[0]['monthly_limit']) {
								Yii::app()->user->setFlash('error','Daily Limit Should Be Less Then Monthly Limit.');
								return false;
							}
						}
						
					} 
				}
			}
			$update_field = array_merge($monthly_limit,$weekly_limit,$daily_limit,$updated_at);
	        $cap_save=parent::getDbConnection()->createCommand()->update('campuses', $update_field, 'id=:id', array(':id'=>$_REQUEST['campus_id']));
			return $cap_save;
		}
		Yii::app()->user->setFlash('error','Error Occured. Try Again.');
		return false;
	}

	/**
	 * @author : 
	 * @description : remove cap from campuses table
	 * @since : 09-09-2016
	 */
	public function deleteCap($id){
		if(isset($id) && !empty($id)) {
	        $cap_delete=parent::getDbConnection()->createCommand()->update('campuses', array('monthly_limit'=>'-1','weekly_limit'=>'-1','daily_limit'=>'-1','updated_at'=>date('Y-m-d h:i:s')), 'id=:id', array(':id'=>$id));
			return $cap_delete;
		}
		return false;
	}

	/**
	 * @author : 
	 * @description : get all details of cap from campuses table
	 * @since : 09-09-2016
	 * @modification : null conditions removed
	 * @since : 09-09-2016
	 */
	public function getCampusCapDetails($condition=null){
		$campus_caps= parent::getDbConnection()->createCommand('select id,campus_id,campus_name,description,daily_limit,weekly_limit,monthly_limit,ground_campus,ground_campus_grad_year,college_id from campuses '.$condition)->queryAll();
		return $campus_caps;
	}

	/**
	 * @author : 
	 * @description : get daily, weekly and monthly transaction count for specified campus from submissions table
	 * @since : 09-09-2016
	 */
	public function getDurationTransactions($campus_code){
		//working query to no delete
		/*$combine_data_query = 'SELECT SUM(if(DATE(sub_date) = CURDATE(), 1, 0)) as day_submission, SUM(if(DATE(sub_date) >= DATE_SUB(CURDATE(),INTERVAL 1 WEEK) , 1, 0)) as week_submission, SUM(if(DATE(sub_date) >= DATE_SUB(CURDATE(),INTERVAL 1 MONTH) , 1, 0)) as month_submission FROM edu_submissions where campus="'.$campus_code.'"';*/

		//another approach and efficient approach
		$combine_data_query = 'SELECT SUM(if(DATE(sub_date) = CURDATE(), 1, 0)) as day_submission, SUM(if(DATE(sub_date) BETWEEN "'.date("Y-m-d", strtotime("monday this week")).'" AND "'.date("Y-m-d", strtotime("sunday this week")).'", 1, 0)) as week_submission, SUM(if(DATE(sub_date) BETWEEN "'.date("Y-m-01").'" AND "'.date("Y-m-t").'", 1, 0)) as month_submission FROM edu_submissions where lead_status=1 AND campus="'.$campus_code.'"';
		$command = parent::getDbConnection()->createCommand($combine_data_query);
		return $row = $command->queryRow();
	}
	
	public function getAllProgramsOfCampus($campus_code,$lender_id){
		$dbCommand = parent::getDbConnection()->createCommand()
		->select("DISTINCT(program_of_interest_code),status,name")
		->from('edu_zipcodes')
		->join("program_of_interest","edu_zipcodes.program_of_interest_code = program_of_interest.code")
		->where("campus_code = '".$campus_code."' and lender_id = '".$lender_id."'")
		->group("program_of_interest_code");
		//echo $dbCommand->getText();exit;
		return $dataReader=$dbCommand->queryAll();
	}
	public function setEduZipcodeStatus(){
		$status = $_GET['status'];$campus_code = $_GET['campus_code'];$program_code = $_GET['program_code'];
		$dbCommand = parent::getDbConnection()->createCommand()
		->update('edu_zipcodes', array('status'=>$status), 'program_of_interest_code = "'.$program_code.'" AND campus_code="'.$campus_code.'"');
		//echo $dbCommand->getText();
	}
	public function getAPIDataEDU(){
		$Api_Data = array();
		$lenders = CHtml::listData(LenderDetails::model()->findAllByAttributes(array('status'=>1)),'id','buyer_name');
		foreach ($lenders as $lender_id => $lender){
			$where = array();$dataReader = array();
			$where[] = "B.active_campus = 1";
			$where[] = "A.status = 1";
			$where[] = $lender_id ? "A.lender_id = '".$lender_id."'" : '';
			$where = array_filter($where);
			$where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';
			$groupby = "B.campus_name ,A.program_of_interest_code";
			$rawData = parent::getDbConnection()->createCommand()
			->select('B.campus_code,B.campus_name,A.program_of_interest_code,C.name')
			->from('edu_zipcodes as A')
			->join('campuses as B', 'B.campus_code = A.campus_code')
			->join('program_of_interest as C', 'C.code = A.program_of_interest_code')
			->where($where)
			->group($groupby);
			//echo $qry = $rawData->getText();
			$dataReader = $rawData->queryAll();
			foreach ($dataReader as $campuses){
				$campus_name_code = $campuses['campus_code'].':'.$campuses['campus_name'];
				$Api_Data[$lender][$campus_name_code][] = $campuses;
			}
		}
		return $Api_Data;
	}
}
