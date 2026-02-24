<?php
	/*
	** 
	** modification : extend class changed from CActiveRecord to EModuleActiveRecord
	** modification date : 25-07-2016
	*/
	/**
	 ** 
	 ** Modification Description : way of getting connection changed (Reason - previous way gives default database connection instead of a database connection set for specific "EDU" module)
		** Previous Way :- Yii::app()->db
		** New Way      :- parent::getDbConnection()
	 ** Modification Date : 02-08-2016
	**/
class ProgramOfInterests extends EModuleActiveRecord{
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	public function tableName(){
		return 'program_of_interest';
	}
	
	public function checkProgramOfIntereset($program_of_intereset){
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('*')
		->from('program_of_interest')
		->where("code = '".$program_of_intereset."'");
		$dataReader=$dbCommand->queryRow();
		if(isset($dataReader) && !empty($dataReader['id'])){
			return true;
		}else{
			return false;
		}
	}
	public function checkProgramOfInteresetBerkeley($program_of_intereset){
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('*')
		->from('program_of_interest_berkeley')
		->where("code = '".$program_of_intereset."' AND status=1");
		$dataReader=$dbCommand->queryRow();
		if(isset($dataReader) && !empty($dataReader['id'])){
			return true;
		}else{
			return false;
		}
	}
	public function checkProgramOfInteresetRoninRevenues($program_of_intereset){
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('*')
		->from('program_of_interest_ronin_revenue')
		->where("code = '".$program_of_intereset."' AND status=1");
		$dataReader = $dbCommand->queryRow();
		if(isset($dataReader) && !empty($dataReader['id'])){
			return $dataReader;
		}else{
			return false;
		}
	}
	public function checkProgramOfInteresetRoninRevenuesACMC($program_of_intereset){
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('*')
		->from('program_of_interest_ronin_revenue_acmc')
		->where("code = '".$program_of_intereset."' AND status=1");
		$dataReader = $dbCommand->queryRow();
		if(isset($dataReader) && !empty($dataReader['id'])){
			return $dataReader;
		}else{
			return false;
		}
	}
	public function checkProgramOfInteresetRoninRevenuesBrandfordSchool($program_of_intereset){
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('*')
		->from('program_of_interest_ronin_revenue_brandford')
		->where("code = '".$program_of_intereset."' AND status=1");
		$dataReader = $dbCommand->queryRow();
		if(isset($dataReader) && !empty($dataReader['id'])){
			return $dataReader;
		}else{
			return false;
		}
	}
	public function checkProgramOfInteresetRoninRevenuesHarrisSchool($program_of_intereset){
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('*')
		->from('program_of_interest_ronin_revenue_harris')
		->where("code = '".$program_of_intereset."' AND status=1");
		$dataReader = $dbCommand->queryRow();
		if(isset($dataReader) && !empty($dataReader['id'])){
			return $dataReader;
		}else{
			return false;
		}
	}
	public function checkProgramOfInteresetRoninRevenuesUMASchool($program_of_intereset){
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('*')
		->from('program_of_interest_ronin_revenue_uma_school')
		->where("code = '".$program_of_intereset."' AND status=1");
		$dataReader = $dbCommand->queryRow();
		if(isset($dataReader) && !empty($dataReader['id'])){
			return $dataReader;
		}else{
			return false;
		}
	}
	public function checkProgramOfInteresetTribecaMarketing($program_of_intereset){
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('*')
		->from('program_of_interest_tribeca')
		->where("code = '".$program_of_intereset."' AND status=1");
		$dataReader = $dbCommand->queryRow();
		if(isset($dataReader) && !empty($dataReader['id'])){
			return $dataReader;
		}else{
			return false;
		}
	}
	public function checkProgramOfInteresetDML($program_of_intereset){
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('*')
		->from('program_of_interest_dml')
		->where("code = '".$program_of_intereset."' AND status=1");
		$dataReader = $dbCommand->queryRow();
		if(isset($dataReader) && !empty($dataReader['id'])){
			return $dataReader;
		}else{
			return false;
		}
	}
	public function checkProgramOfInteresetDaymar($program_of_intereset){
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('*')
		->from('program_of_interest_daymar')
		->where("code = '".$program_of_intereset."' AND status=1");
		$dataReader = $dbCommand->queryRow();
		if(isset($dataReader) && !empty($dataReader['id'])){
			return $dataReader;
		}else{
			return false;
		}
	}
	public function checkProgramOfInteresetQuinStreet($program_of_intereset){
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('*')
		->from('program_of_interest_quinstreet')
		->where("code = '".$program_of_intereset."' AND status=1");
		$dataReader = $dbCommand->queryRow();
		//echo $dbCommand->getText();exit;
		if(isset($dataReader) && !empty($dataReader['id'])){
			return $dataReader;
		}else{
			return false;
		}
	}
	public function checkProgramOfInteresetQuinStreetECPI($program_of_intereset){
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('*')
		->from('program_of_interest_quinstreet_ecpi')
		->where("code = '".$program_of_intereset."' AND status=1");
		$dataReader = $dbCommand->queryRow();
		//echo $dbCommand->getText();exit;
		if(isset($dataReader) && !empty($dataReader['id'])){
			return $dataReader;
		}else{
			return false;
		}
	}
	public function checkProgramOfInteresetQuinStreetACU($program_of_intereset){
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('*')
		->from('program_of_interest_quinstreet_acu')
		->where("code = '".$program_of_intereset."' AND status=1");
		$dataReader = $dbCommand->queryRow();
		//echo $dbCommand->getText();exit;
		if(isset($dataReader) && !empty($dataReader['id'])){
			return $dataReader;
		}else{
			return false;
		}
	}
	public function checkProgramOfInteresetTracsion($program_of_intereset){
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('*')
		->from('program_of_interest_tracsion')
		->where("program_code = '".$program_of_intereset."' AND status=1");
		$dataReader = $dbCommand->queryRow();
		if(isset($dataReader) && !empty($dataReader['id'])){
			return $dataReader;
		}else{
			return false;
		}
	}
	public function checkProgramOfInteresetDegreeAmerica($program_of_intereset){
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('CONCAT_WS ("^", `subject1`, `subject2`, `subject3`) as dm_subject,interest as dm_interest')
		->from('program_of_interest_degreeamerica')
		->where("edu_code = '".$program_of_intereset."'");
		///echo $dbCommand->getText();exit;
		$dataReader = $dbCommand->queryRow();
		if(isset($dataReader) && !empty($dataReader)){
			return $dataReader;
		}else{
			return false;
		}
	}
	public function getProgramOfInteresetByCode($program_of_intereset)
	{
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('name')
		->from('program_of_interest')
		->where("code = '".$program_of_intereset."'");
		$dataReader=$dbCommand->queryRow();
		if(isset($dataReader) && !empty($dataReader)){
			return $dataReader;
		}else{
			return false;
		}
	}
	public function checkProgramOfInteresetUniversities($program_of_intereset)
	{
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('category_id,category_name')
		->from('program_of_interest_universities')
		->where("FIND_IN_SET('".$program_of_intereset."',programs)");
		$dataReader=$dbCommand->queryRow();
		//echo $dbCommand->getText();exit;
		if(isset($dataReader) && !empty($dataReader)){
			return $dataReader;
		}else{
			return false;
		}
	}
	public function checkProgramOfInteresetXy7elite($program_of_intereset)
	{
		$dbCommand = parent::getDbConnection()->createCommand()
		->select('*')
		->from('program_of_interest_xy7elite')
		->where("ecw_program_code = '".$program_of_intereset."'");
		$dataReader = $dbCommand->queryRow();
		//echo $dbCommand->getText();exit;
		if(isset($dataReader) && !empty($dataReader['id'])){
			return $dataReader;
		}else{
			return false;
		}
	}
}
