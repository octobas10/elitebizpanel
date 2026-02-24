<?php
/*
	** 
	** modification : extend class changed from CActiveRecord to EModuleActiveRecord
	** modification date : 02-08-2016
	*/

/**
 ** 
 ** Modification Description : way of getting connection changed (Reason - previous way gives default database connection instead of a database connection set for specific "EDU" module)
 ** Previous Way :- Yii::app()->db
 ** New Way      :- parent::getDbConnection()
 ** Modification Date : 02-08-2016
 **/
class EduZipCodes extends EModuleActiveRecord
{
	public static function model($className = __CLASS__)
	{
		return parent::model($className);
	}
	public function tableName()
	{
		return 'edu_zipcodes';
	}

	public function checkZipCampusProgram($zip_code, $campus_code = null, $program_of_intereset = null, $lender_id)
	{
		/*
		** 
		** modification : campus_code and program_of_interest removed from condition of checking "outside Geo Footprint"
		** modification date : 26-08-2016
		*/
		/*$dbCommand = parent::getDbConnection()->createCommand()
		->select('*')
		->from('edu_zipcodes')
		->where("lender_id = ".$lender_id." AND zipcode = ".$zip_code." AND campus_code = '".$campus_code."' AND program_of_interest_code ='".$program_of_intereset."'");
		$dataReader=$dbCommand->queryRow();
		if(isset($dataReader) && !empty($dataReader['id']>0)){
			return true;
		}else{
			return false;
		}*/
		$dbCommand = parent::getDbConnection()->createCommand()
			->select('*')
			->from('edu_zipcodes')
			//->where("zipcode = ".$zip_code." AND campus_code = '".$campus_code."' AND program_of_interest_code ='".$program_of_intereset."'");
			->where("zipcode = ".$zip_code." ");
		$dataReader = $dbCommand->queryRow();
		if (isset($dataReader) && !empty($dataReader['id'])) {
			return true;
		} else {
			return false;
		}
	}

	public function getCampusCityStateFromProgram($program_of_intereset = null)
	{
		//$program_of_intereset = join("','",$program_of_intereset);
		$criteria = new CDbCriteria();
		//Due to some issues campus_name stored as zipcode, img_path stored as lender_id, description as program_of_interest_code
		/**
		 ** 
		 ** description : query to get campus and its related data to display them on landing page
		 ** date : 04-08-2016
		 */
		$criteria->select = 't.id as id,t.city as city,t.state as state,t.campus_code as campus_code,ca.campus_name as zipcode,ca.img_path as lender_id,ca.description as program_of_interest_code';
		//$criteria->select = 'ca.*,t.*';
		$criteria->join = 'INNER JOIN campuses ca ON t.campus_code = ca.campus_code';
		if (isset($program_of_intereset) && !empty($program_of_intereset)) {
			//$criteria->condition = "t.program_of_interest_code IN ('".$program_of_intereset."')";
			$criteria->addInCondition('program_of_interest_code',$program_of_intereset);
		}
		$criteria->order = 't.id ASC';
		$criteria->group = 't.campus_code';
		/*echo EduZipCodes::model()->
getCommandBuilder()->
createFindCommand('edu_zipcodes', $criteria)->text;*/
		return $criteria;
	}

	public function getProgramFromCampusCityState($campus, $city = null, $state = null)
	{
		$where = "ez.campus_code ='".$campus."'";
		if (isset($city) && !empty($city)) {
			$where .= " AND ez.city = '".$city."'";
		}
		if (isset($state) && !empty($state)) {
			$where .= " AND ez.state = '".$state."'";
		}
		$where .= " AND ez.status = '1' AND ez.lender_id <> '15'";
		$dbCommand = parent::getDbConnection()->createCommand()
			->select("code as prog_code,name as prog_name,cam.college_name")
			->from("program_of_interest poi")
			->join("edu_zipcodes ez", "ez.program_of_interest_code = poi.code")
			->join("campuses cam", "cam.lender = ez.lender_id")
			->where($where)
			->group('code');
		$dataReader = $dbCommand->queryAll();
		//echo $qry = $dbCommand->getText();
		return $dataReader;
	}

	public function checkzipcode($zip_code)
	{
		$dbCommand = parent::getDbConnection()->createCommand()
			->select('*')
			->from('edu_zipcodes')
			->where("zipcode = ".$zip_code." LIMIT 1");
		$dataReader = $dbCommand->queryRow();
		if (isset($dataReader) && !empty($dataReader['id'])) {
			return $dataReader;
		} else {
			return $dataReader;
		}
	}
	public function checkzipcodedatabase($zip_code)
	{
		$dbCommand = parent::getDbConnection()->createCommand()
			->select('*')->from('zipcodes')->where("zipcode = ".$zip_code." LIMIT 1");
		$dataReader = $dbCommand->queryRow();
		if (isset($dataReader) && !empty($dataReader['id'])) {
			return $dataReader;
		} else {
			return $dataReader;
		}
	}

	public function getCampusDetails()
	{
		$dbCommand = parent::getDbConnection()->createCommand()
			->select("DISTINCT(ca.campus_code) as campus_code,ca.campus_name as campus_name,ca.id as id,ca.monthly_limit as monthly_limit,ca. active_campus as active_campus")
			->from("campuses ca")
			->join("edu_zipcodes ez", "ez.campus_code = ca.campus_code")
			->order('ca.id asc');
		$dataReader = $dbCommand->queryAll();
		return $dataReader;
	}
	public function checkgeofootprint($zip_code = '', $program_of_interest = '', $campus = '')
	{
		$campus_code_monthly_limit = '';
		$state_canada = "'AB', 'BC', 'ON', 'MB', 'QC'";
		$dbCommand = parent::getDbConnection()->createCommand()
			->select('edu_zipcodes.lender_id,edu_zipcodes.zipcode,edu_zipcodes.city,edu_zipcodes.state,program_of_interest_code,edu_zipcodes.campus_code,monthly_limit,SUM(if(DATE(sub_date) BETWEEN "'.date("Y-m-01").'" AND "'.date("Y-m-t").'", 1, 0) AND edu_submissions.lead_status=1) as month_submission')
			->from('edu_zipcodes')
			->join("campuses", "edu_zipcodes.campus_code = campuses.campus_code")
			->leftjoin("edu_submissions", "edu_zipcodes.campus_code = edu_submissions.campus")
			->join("edu_lender_details", "edu_lender_details.id = edu_zipcodes.lender_id")
			->where("edu_zipcodes.status =1 AND active_campus=1 AND (zipcode = '$zip_code' OR (LEFT(zipcode,3) = '".trim(substr($zip_code,0,3))."' AND edu_zipcodes.state IN ($state_canada))) AND edu_zipcodes.campus_code = '$campus' AND  program_of_interest_code = '$program_of_interest' AND edu_lender_details.status = 1 ")->having('monthly_limit = -1 OR month_submission <  monthly_limit');
		// print query
		//echo '<br><br>...A..'.$dbCommand->getText();
		$dataReader = $dbCommand->queryRow();
		if (isset($dataReader) && !empty($dataReader)) {
			return $dataReader;
		} else {
			$dbCommand = parent::getDbConnection()->createCommand()
				->select('lat,lng')
				->from('zipcodes')
				->where("zipcode = '".trim($zip_code)."'");
			$dataReaderlanglat = $dbCommand->queryRow();
			if ($dataReaderlanglat['lat'] && $dataReaderlanglat['lng']) {
				$sLatitude = $dataReaderlanglat['lat'];
				$sLongitude = $dataReaderlanglat['lng'];
				$sRadius = '5';
				$fRadius = (float)$sRadius;
				$fLatitude = (float)$sLatitude;
				$fLongitude = (float)$sLongitude;
				$sXprDistance =  "SQRT(POWER(($fLatitude-lat)*110.7,2)+POWER(($fLongitude-lng)*75.6,2))";
				$dbCommand = parent::getDbConnection()->createCommand()
					->select('program_of_interest_code,edu_zipcodes.campus_code,edu_zipcodes.lender_id,edu_zipcodes.city,edu_zipcodes.state,edu_zipcodes.zipcode,monthly_limit,SUM(if(DATE(sub_date) BETWEEN "'.date("Y-m-01").'" AND "'.date("Y-m-t").' AND lead_status=1", 1, 0)) as month_submission')
					->from('edu_zipcodes')
					->join("campuses", "edu_zipcodes.campus_code = campuses.campus_code")
					->join("edu_lender_details", "edu_lender_details.id = edu_zipcodes.lender_id")
					->leftjoin("edu_submissions", "edu_zipcodes.campus_code = edu_submissions.campus")
					->where("monthly_limit <> -1 AND edu_zipcodes.status = 1 AND active_campus=1 AND edu_zipcodes.campus_code = '$campus' AND  program_of_interest_code = '$program_of_interest' AND edu_lender_details.status =1 AND $sXprDistance <= '$fRadius'")
					->having('monthly_limit = -1 OR month_submission <  monthly_limit');
				$dataReadernewzip = $dbCommand->queryRow();
				//echo '<br><br>...B......'. $dbCommand->getText();
				if (isset($dataReadernewzip) && !empty($dataReadernewzip)) {
					return $dataReadernewzip;
				}
			}
			// REGULAR FLOW FROM HERE (APPLY ONLY "ground_campus_grad_year" IF ground_campus=1)
			//echo '<pre>';print_r($_REQUEST);exit;
			$dbCommand = parent::getDbConnection()->createCommand()
				->select('ground_campus,ground_campus_grad_year,campus_code,monthly_limit,SUM(if(DATE(sub_date) BETWEEN "'.date("Y-m-01").'" AND "'.date("Y-m-t").'" AND lead_status=1,1,0)) as month_submission')
				->from('edu_submissions,campuses')
				->where("monthly_limit <> -1 AND campuses.active_campus=1 AND campus=campus_code ")
				->andWhere("(ground_campus_grad_year<>'".$_REQUEST['grad_year']."' OR ground_campus<>'1')")
				->group('campus')
				->having('month_submission >= monthly_limit');
			$dataReadermonthlylimit = $dbCommand->queryAll();
			//echo '<br><br>00..'. $dbCommand->getText();exit;
			/*if($_SERVER['REMOTE_ADDR']=='81.96.154.57'){
				echo '<br><br>0.0000..'. $dbCommand->getText();
			}*/
			foreach ($dataReadermonthlylimit as $row) {
				$campus_code_monthly_limit .= ",'".$row['campus_code']."'";
			}
			$campus_code_monthly_limit = substr($campus_code_monthly_limit, 1);
			$campus_code_monthly_limit = $campus_code_monthly_limit == '' ? "'ABC'" : $campus_code_monthly_limit;
			// START HERE
			$dbCommand = parent::getDbConnection()->createCommand()
				->select('program_of_interest_code,edu_zipcodes.campus_code,lender_id,city,state')
				->from('edu_zipcodes')
				->join("campuses", "edu_zipcodes.campus_code = campuses.campus_code")
				->join("edu_lender_details", "edu_lender_details.id = edu_zipcodes.lender_id")
				->where("edu_zipcodes.status=1 AND (zipcode = '$zip_code' OR (LEFT(zipcode,3) = '".trim(substr($zip_code,0,3))."' AND edu_zipcodes.state IN ($state_canada))) AND program_of_interest_code='".$program_of_interest."' AND edu_lender_details.status =1 AND edu_zipcodes.campus_code NOT IN (".$campus_code_monthly_limit.") AND active_campus=1 LIMIT 1");
			$dataReaderpoi = $dbCommand->queryRow();
			//echo '<br><br>11..'. $dbCommand->getText();
			/*if($_SERVER['REMOTE_ADDR']=='81.96.154.57'){
				echo '<br><br>'. $dbCommand->getText();
			}*/
			if (isset($dataReaderpoi) && !empty($dataReaderpoi)) {
				return $dataReaderpoi;
			} else {
				// FROM POSTPROCESS ->EDUZIPCODES -> HERE.
				/*  GETTING NEW PROCESS IMPLEMENTED TO GET SIMILLAR PROGRAMS */
				// GET PROGRAM NAME FROM PROGRAM CODE
				$program_name = '';
				$dbCommand = parent::getDbConnection()->createCommand()->select('name')->from('program_of_interest')->where("code='".$program_of_interest."'");
				$dataReader = $dbCommand->queryRow();
				if (isset($dataReader)) {
					$program_name = $dataReader['name'];
				}
				// GET SIMILLAR PROGRAM FOR THE NAME OF THE PROGRAM
				$dbCommand = parent::getDbConnection()->createCommand()->select('code')->from('program_of_interest')->where(" MATCH(`name`) AGAINST ( '".$program_name."' )");
				$dataReader = $dbCommand->queryAll();
				$matching_codes = '';
				foreach ($dataReader as $row) {
					$matching_codes .= ",'".$row['code']."'";
				}
				$matching_codes = substr($matching_codes, 1);
				/*  GETTING NEW PROCESS IMPLEMENTED TO GET SIMILLAR PROGRAMS */
				if ($matching_codes != "") {
					$dbCommand = parent::getDbConnection()->createCommand()
						->select('program_of_interest_code,edu_zipcodes.campus_code,lender_id,city,state,zipcode')
						->from('edu_zipcodes')
						->join("campuses", "edu_zipcodes.campus_code = campuses.campus_code")
						->join("edu_lender_details", "edu_lender_details.id = edu_zipcodes.lender_id")
						->where("edu_zipcodes.status=1 AND zipcode = '$zip_code' AND active_campus=1 AND program_of_interest_code IN (".$matching_codes.") AND edu_zipcodes.campus_code = '$campus' AND edu_lender_details.status =1 ORDER BY edu_zipcodes.id DESC LIMIT 1");
					//echo '<br><br>22..'. $dbCommand->getText();
					/*if($_SERVER['REMOTE_ADDR']=='81.96.154.57'){
						echo '<br><br>22'. $dbCommand->getText();
					}*/
					$dataReader = $dbCommand->queryRow();
					if (isset($dataReader) && !empty($dataReader)) {
						return $dataReader;
					} else {
						$dbCommand = parent::getDbConnection()->createCommand()
							->select('program_of_interest_code,edu_zipcodes.campus_code,lender_id,city,state,zipcode')
							->from('edu_zipcodes')
							->join("campuses", "edu_zipcodes.campus_code = campuses.campus_code")
							->join("edu_lender_details", "edu_lender_details.id = edu_zipcodes.lender_id")
							->where("edu_lender_details.status=1 AND edu_zipcodes.status=1 AND active_campus=1 AND ((program_of_interest_code='".$program_of_interest."' AND edu_zipcodes.campus_code = '$campus') OR (program_of_interest_code IN (".$matching_codes.") AND edu_lender_details.no_check_geo_footprint=1)) ORDER BY ABS(zipcode-'".$zip_code."'),zipcode DESC LIMIT 1");
						$dataReadercwz = $dbCommand->queryRow();
						//echo '<br><br>33...'.$dbCommand->getText();
						/*if($_SERVER['REMOTE_ADDR']=='81.96.154.57'){
							echo '<br><br>33...'. $dbCommand->getText();
						}*/
						if (isset($dataReadercwz) && !empty($dataReadercwz)) {
							return $dataReadercwz;
						} else {
							$dbCommand = parent::getDbConnection()->createCommand()
								->select('program_of_interest_code,edu_zipcodes.campus_code,lender_id,city,state,zipcode')
								->from('edu_zipcodes')
								->join("campuses", "edu_zipcodes.campus_code = campuses.campus_code")
								->join("edu_lender_details", "edu_lender_details.id = edu_zipcodes.lender_id")
								->where("edu_zipcodes.status=1 AND zipcode = '$zip_code' AND active_campus=1 AND program_of_interest_code IN (".$matching_codes.") AND edu_lender_details.status=1 ORDER BY edu_zipcodes.id DESC LIMIT 1");
							/*if($_SERVER['REMOTE_ADDR']=='81.96.154.57'){
								echo '<br><br>44'. $dbCommand->getText();
							}*/
							$dataReader1 = $dbCommand->queryRow();
							if (isset($dataReader1) && !empty($dataReader1)) {
								return $dataReader1;
							} else {
								$dbCommand = parent::getDbConnection()->createCommand()
									->select('program_of_interest_code,edu_zipcodes.campus_code,lender_id,city,state,zipcode')
									->from('edu_zipcodes')
									->join("campuses", "edu_zipcodes.campus_code = campuses.campus_code")
									->join("edu_lender_details", "edu_lender_details.id = edu_zipcodes.lender_id")
									->where("edu_zipcodes.status=1 AND zipcode = '$zip_code' AND active_campus=1 AND edu_lender_details.status =1 AND edu_zipcodes.campus_code NOT IN (".$campus_code_monthly_limit.") ORDER BY edu_zipcodes.id DESC LIMIT 1");
								$dataReader2 = $dbCommand->queryRow();
								/*if($_SERVER['REMOTE_ADDR']=='81.96.154.57'){
									echo '<br><br>55'. $dbCommand->getText();
								}*/
								if (isset($dataReader2) && !empty($dataReader2)) {
									return $dataReader2;
								} else {
									$sub_model = new Submissions();
									$city_state = $sub_model->getCityStateFromZip($zip_code);
									$onl_state = $city_state['state'];
									if ($onl_state == 'NY' || $onl_state == 'NJ' || $onl_state == 'CT' || $onl_state == 'PA') {
										$dbCommand = parent::getDbConnection()->createCommand()
											->select('program_of_interest_code,edu_zipcodes.campus_code,lender_id,city,state,zipcode')
											->from('edu_zipcodes')
											->join("campuses", "edu_zipcodes.campus_code = campuses.campus_code")
											->join("edu_lender_details", "edu_lender_details.id = edu_zipcodes.lender_id")
											->where("edu_zipcodes.status=1 AND edu_zipcodes.campus_code = 'ONL' AND active_campus=1 AND edu_lender_details.status =1 AND edu_zipcodes.campus_code NOT IN (".$campus_code_monthly_limit.") ORDER BY edu_zipcodes.id DESC LIMIT 1");
										$dataReader3 = $dbCommand->queryRow();
									} else {
										$dbCommand = parent::getDbConnection()->createCommand()
											->select('program_of_interest_code,edu_zipcodes.campus_code,lender_id,city,state,zipcode')
											->from('edu_zipcodes')
											->join("campuses", "edu_zipcodes.campus_code = campuses.campus_code")
											->join("edu_lender_details", "edu_lender_details.id = edu_zipcodes.lender_id")
											->where("edu_zipcodes.status=1 AND zipcode = '$zip_code' AND edu_zipcodes.campus_code = 'ONL' AND active_campus=1 AND edu_lender_details.status =1 AND edu_zipcodes.campus_code NOT IN (".$campus_code_monthly_limit.") ORDER BY edu_zipcodes.id DESC LIMIT 1");
										$dataReader3 = $dbCommand->queryRow();
									}
									//echo '<br><br>66'. $dbCommand->getText();exit;
									/*if($_SERVER['REMOTE_ADDR']=='81.96.154.57'){
										echo '<br><br>66'. $dbCommand->getText();
									}*/
									if (isset($dataReader3) && !empty($dataReader3)) {
										return $dataReader3;
									} else {
										$dbCommand = parent::getDbConnection()->createCommand()
											->select('program_of_interest_code,edu_zipcodes.campus_code,lender_id,city,state,zipcode')
											->from('edu_zipcodes')
											->join("campuses", "edu_zipcodes.campus_code = campuses.campus_code")
											->join("edu_lender_details", "edu_lender_details.id = edu_zipcodes.lender_id")
											->where("edu_zipcodes.status=1 AND no_check_geo_footprint=1 AND active_campus=1 AND edu_lender_details.status=1 ORDER BY edu_zipcodes.id DESC LIMIT 1");
										$dataReader4 = $dbCommand->queryRow();
										//echo $qry = $dbCommand->getText();exit;
										/*if($_SERVER['REMOTE_ADDR']=='81.96.154.57'){
											echo '<br><br>77'. $dbCommand->getText();
										}*/
										//echo '<br><br>77'.$dbCommand->getText();
										if (isset($dataReader4) && !empty($dataReader4)) {
											return $dataReader4;
										} else {
											return false;
										}
									}
								}
							}
						}
					}
				} else {
					$dbCommand = parent::getDbConnection()->createCommand()
						->select('program_of_interest_code,edu_zipcodes.campus_code,lender_id,city,state,zipcode')
						->from('edu_zipcodes')
						->join("campuses", "edu_zipcodes.campus_code = campuses.campus_code")
						->join("edu_lender_details", "edu_lender_details.id = edu_zipcodes.lender_id")
						->where("zipcode = '$zip_code' AND active_campus=1 AND edu_zipcodes.campus_code = '".trim($campus)."' AND edu_lender_details.status =1 ORDER BY edu_zipcodes.id DESC LIMIT 1");
					//echo $qry = $dbCommand->getText();exit;
					$dataReader = $dbCommand->queryRow();
					if (isset($dataReader) && !empty($dataReader)) {
						return $dataReader;
					} else {
						return false;
					}
				}
			}
		}
	}
	public function getCampusProgramFromZip($zip_code = '', $condition = '')
	{
		$zip_code =  $zip_code == '' ? $_REQUEST['zip_code']  : $zip_code;
		if (isset($condition) && !empty($condition)) {
			$dbCommand = parent::getDbConnection()->createCommand()
				->select("distinct(campus_code),program_of_interest_code,lender_id")
				->from('edu_zipcodes')
				->where("edu_zipcodes.status=1 AND zipcode = '$zip_code' ".$condition)
				->group("campus_code");
			//echo $qry = $dbCommand->getText();exit;
			return $dataReader = $dbCommand->queryAll();
		} else {
			$campus_code_monthly_limit = '';
			$dbCommand = parent::getDbConnection()->createCommand()
				->select('campus_code,monthly_limit,SUM(if(DATE(sub_date) BETWEEN "'.date("Y-m-01").'" AND "'.date("Y-m-t").'", 1, 0)) as month_submission')
				->from('edu_submissions,campuses')
				->where("monthly_limit <> -1 AND campus=campus_code AND (ground_campus_grad_year='".$_REQUEST['grad_year']."' AND ground_campus=0)")
				->group('campus')
				->having('month_submission >=  monthly_limit');
			$dataReadermonthlylimit = $dbCommand->queryAll();
			foreach ($dataReadermonthlylimit as $row) {
				$campus_code_monthly_limit .= ",'".$row['campus_code']."'";
			}
			$campus_code_monthly_limit = substr($campus_code_monthly_limit, 1);
			$campus_code_monthly_limit = $campus_code_monthly_limit == '' ? "'ABC'" : $campus_code_monthly_limit;
			// START HERE
			$dbCommand = parent::getDbConnection()->createCommand()
				->select('program_of_interest_code,edu_zipcodes.campus_code,lender_id,city,state')
				->from('edu_zipcodes')
				->join("campuses", "edu_zipcodes.campus_code = campuses.campus_code")
				->join("edu_lender_details", "edu_lender_details.id = edu_zipcodes.lender_id")
				->where("edu_zipcodes.status=1 AND zipcode = '$zip_code' AND program_of_interest_code='".$_REQUEST['program_of_interest']."' AND edu_lender_details.status =1 AND edu_zipcodes.campus_code NOT IN (".$campus_code_monthly_limit.") LIMIT 1");
			$dataReaderpoi = $dbCommand->queryRow();
			/*if($_SERVER['REMOTE_ADDR']=='81.96.154.57'){
				echo '<br><br>'. $dbCommand->getText();exit;
			}*/
			if (isset($dataReaderpoi) && !empty($dataReaderpoi)) {
				return $dataReaderpoi;
			} else {
				// FROM POSTPROCESS ->EDUZIPCODES -> HERE.
				/*  GETTING NEW PROCESS IMPLEMENTED TO GET SIMILLAR PROGRAMS */
				// GET PROGRAM NAME FROM PROGRAM CODE
				$program_name = '';
				$dbCommand = parent::getDbConnection()->createCommand()->select('name')->from('program_of_interest')->where("code = '".$_REQUEST['program_of_interest']."'");
				$dataReader = $dbCommand->queryRow();
				if (isset($dataReader)) {
					$program_name = $dataReader['name'];
				}
				// GET SIMILLAR PROGRAM FOR THE NAME OF THE PROGRAM
				$dbCommand = parent::getDbConnection()->createCommand()->select('code')->from('program_of_interest')->where(" MATCH(`name`) AGAINST ( '".$program_name."' )");
				$dataReader = $dbCommand->queryAll();
				$matching_codes = '';
				foreach ($dataReader as $row) {
					$matching_codes .= ",'".$row['code']."'";
				}
				$matching_codes = substr($matching_codes, 1);
				/*  GETTING NEW PROCESS IMPLEMENTED TO GET SIMILLAR PROGRAMS */
				if ($matching_codes != "") {
					$dbCommand = parent::getDbConnection()->createCommand()
						->select('program_of_interest_code,edu_zipcodes.campus_code,lender_id,city,state')
						->from('edu_zipcodes')
						->join("campuses", "edu_zipcodes.campus_code = campuses.campus_code")
						->join("edu_lender_details", "edu_lender_details.id = edu_zipcodes.lender_id")
						->where("edu_zipcodes.status=1 AND zipcode = '$zip_code' AND active_campus=1 AND program_of_interest_code IN (".$matching_codes.") AND edu_zipcodes.campus_code = '".trim($_REQUEST['campus'])."' AND edu_lender_details.status =1 ORDER BY edu_zipcodes.id DESC LIMIT 1");
					//echo $qry = $dbCommand->getText();exit;
					/*if($_SERVER['REMOTE_ADDR']=='81.96.154.57'){
						echo '<pre>';print_r($dtRead4);print_r($_REQUEST);
					}*/
					$dataReader = $dbCommand->queryRow();
					if (isset($dataReader) && !empty($dataReader)) {
						return $dataReader;
					} else {
						$dbCommand = parent::getDbConnection()->createCommand()
							->select('program_of_interest_code,edu_zipcodes.campus_code,lender_id')
							->from('edu_zipcodes')
							->join("campuses", "edu_zipcodes.campus_code = campuses.campus_code")
							->join("edu_lender_details", "edu_lender_details.id = edu_zipcodes.lender_id")
							->where("edu_zipcodes.status=1 AND active_campus=1 AND program_of_interest_code='".$_REQUEST['program_of_interest']."' AND edu_zipcodes.campus_code = '".trim($_REQUEST['campus'])."' AND edu_lender_details.status =1 and no_check_geo_footprint=1 ORDER BY edu_zipcodes.id DESC LIMIT 1");
						$dataReadercwz = $dbCommand->queryRow();
						//ECHO '<br>'.$qry = $dbCommand->getText();exit;
						if (isset($dataReadercwz) && !empty($dataReadercwz)) {
							return $dataReadercwz;
						} else {
							$dbCommand = parent::getDbConnection()->createCommand()
								->select('program_of_interest_code,edu_zipcodes.campus_code,lender_id,city,state')
								->from('edu_zipcodes')
								->join("campuses", "edu_zipcodes.campus_code = campuses.campus_code")
								->join("edu_lender_details", "edu_lender_details.id = edu_zipcodes.lender_id")
								->where("edu_zipcodes.status=1 AND zipcode = '$zip_code' AND active_campus=1 AND program_of_interest_code IN (".$matching_codes.") AND edu_lender_details.status =1 ORDER BY edu_zipcodes.id DESC LIMIT 1");
							/*if($_SERVER['REMOTE_ADDR']=='81.96.154.57'){
								echo '<pre>';print_r($dtRead4);print_r($_REQUEST);
							}*/
							$dataReader1 = $dbCommand->queryRow();
							if (isset($dataReader1) && !empty($dataReader1)) {
								return $dataReader1;
							} else {
								$dbCommand = parent::getDbConnection()->createCommand()
									->select('program_of_interest_code,edu_zipcodes.campus_code,lender_id,city,state')
									->from('edu_zipcodes')
									->join("campuses", "edu_zipcodes.campus_code = campuses.campus_code")
									->join("edu_lender_details", "edu_lender_details.id = edu_zipcodes.lender_id")
									->where("edu_zipcodes.status=1 AND zipcode = '$zip_code' AND active_campus=1 AND edu_lender_details.status =1 AND edu_zipcodes.campus_code NOT IN (".$campus_code_monthly_limit.") ORDER BY edu_zipcodes.id DESC LIMIT 1");
								$dataReader2 = $dbCommand->queryRow();
								/*if($_SERVER['REMOTE_ADDR']=='81.96.154.57'){
										ECHO '<br>.'.$qry = $dbCommand->getText();
								}*/
								if (isset($dataReader2) && !empty($dataReader2)) {
									return $dataReader2;
								} else {
									$dbCommand = parent::getDbConnection()->createCommand()
										->select('program_of_interest_code,edu_zipcodes.campus_code,lender_id,city,state')
										->from('edu_zipcodes')
										->join("campuses", "edu_zipcodes.campus_code = campuses.campus_code")
										->join("edu_lender_details", "edu_lender_details.id = edu_zipcodes.lender_id")
										->where("edu_zipcodes.status=1 AND zipcode = '$zip_code' AND edu_zipcodes.campus_code = 'ONL' AND active_campus=1 AND edu_lender_details.status =1 AND edu_zipcodes.campus_code NOT IN (".$campus_code_monthly_limit.") ORDER BY edu_zipcodes.id DESC LIMIT 1");
									$dataReader3 = $dbCommand->queryRow();
									/*if($_SERVER['REMOTE_ADDR']=='81.96.154.57'){
										echo '<pre>';print_r($dtRead4);print_r($_REQUEST);
									}*/
									if (isset($dataReader3) && !empty($dataReader3)) {
										return $dataReader3;
									} else {
										$dbCommand = parent::getDbConnection()->createCommand()
											->select('id')
											->from('edu_lender_details')
											->where("edu_lender_details.status =1 AND no_check_geo_footprint=1 ORDER BY id DESC LIMIT 1");
										$dataReader4 = $dbCommand->queryRow();
										//echo $qry = $dbCommand->getText();exit;
										/*if($_SERVER['REMOTE_ADDR']=='81.96.154.57'){
												echo '<pre>';print_r($dtRead4);print_r($_REQUEST);exit;
										}*/
										if (isset($dataReader4) && !empty($dataReader4)) {
											$dtRead4 = array(
												'program_of_interest_code' => $_REQUEST['program_of_interest'],
												'campus_code' => $_REQUEST['campus'],
												'lender_id' => $dataReader4['id'],
												'city' => $_REQUEST['city'],
												'state' => $_REQUEST['state'],
											);
											/*if($_SERVER['REMOTE_ADDR']=='81.96.154.57'){
												echo '<pre>';print_r($dtRead4);print_r($_REQUEST);
											}*/
											return $dtRead4;
										} else {
											return false;
										}
									}
								}
							}
						}
					}
				} else {
					$dbCommand = parent::getDbConnection()->createCommand()
						->select('program_of_interest_code,edu_zipcodes.campus_code,lender_id')
						->from('edu_zipcodes')
						->join("campuses", "edu_zipcodes.campus_code = campuses.campus_code")
						->join("edu_lender_details", "edu_lender_details.id = edu_zipcodes.lender_id")
						->where("zipcode = '$zip_code' AND active_campus=1 AND edu_zipcodes.campus_code = '".trim($_REQUEST['campus'])."' AND edu_lender_details.status =1 ORDER BY edu_zipcodes.id DESC LIMIT 1");
					//echo $qry = $dbCommand->getText();exit;
					$dataReader = $dbCommand->queryRow();
					if (isset($dataReader) && !empty($dataReader)) {
						return $dataReader;
					} else {
						return false;
					}
				}
			}
		}
	}

	public function getCampusesZip($zip_code = '')
	{
		/*$dbCommand = parent::getDbConnection()->createCommand()
		->select('DISTINCT(campus_code),program_of_interest_code')
		->from('edu_zipcodes')
		->where("zipcode = ".$zip_code)
		->group('campus_code');
		return $dbCommand->queryAll();*/
		$dbCommand = parent::getDbConnection()->createCommand()
			->select('DISTINCT(ez.campus_code) as campus_code,ez.program_of_interest_code')
			->from('edu_zipcodes ez')
			->join("campuses cam", "ez.campus_code = cam.campus_code")
			->where("ez.zipcode = ".$zip_code)
			->group('ez.campus_code');
		return $dbCommand->queryAll();
	}

	public function getCampusLenderDetails($campus_code = '')
	{
		$dbCommand = parent::getDbConnection()->createCommand()
			->select('*')
			->from('campuses')
			->join("edu_lender_details", "edu_lender_details.id = campuses.lender")
			->where("active_campus=1 AND campuses.campus_code = '".trim($campus_code)."' AND edu_lender_details.status=1 LIMIT 1");
		//echo $qry = $dbCommand->getText();exit;
		$dataReader = $dbCommand->queryRow();
		if (isset($dataReader) && !empty($dataReader)) {
			return $dataReader;
		} else {
			return false;
		}
	}
}
