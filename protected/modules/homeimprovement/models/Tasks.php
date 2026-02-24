<?php
	/*
	** 
	** modification : extend class changed from CActiveRecord to EModuleActiveRecord
	** modification date : 25-07-2016
	*/
	/**
	 ** 
	**/
class Tasks extends HomeimprovementActive{
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	public function tableName(){
		return 'tasks';
	}
	public function getTasksbyProject($project_type = null,$from_landing_page = 0){
		$Api_Data = [];
		$rawData = parent::getDbConnection()->createCommand()
		->select('B.project_type,B.project_id,A.task_id,A.task_name')
		->from('tasks as A');
		if(!empty($project_type)){
            $rawData->andWhere('A.project_id=:project_type',[':project_type'=>$project_type]);
        }
		$rawData->rightjoin('projects as B', 'B.project_id = A.project_id')
		->order('B.project_id,A.task_id');
		$dataReader = $rawData->queryAll();
		if($from_landing_page == 1){
			return $dataReader;
		}else{
			$i=1;$project_type='';
			foreach ($dataReader as $data){
				if($project_type <> $data['project_type']){
					$i=1;	
				}else{
					$i++;
				}
				$project_type = $data['project_type']; 
				if($data['task_name']){
					$Api_Data[$data['project_type']][] = $data['project_id'].'_'.$i.' => '.$data['task_name'];
				}else{
					$Api_Data[$data['project_type']][] = '';
				}
			}
			return $Api_Data;
		}
	}
	/*public function getTasksbyProject(){
		$Api_Data = [];
		$rawData = parent::getDbConnection()->createCommand()
		->select('B.project_type,B.project_id,A.task_name')
		->from('tasks as A')
		->rightjoin('projects as B', 'B.project_id = A.project_id')
		->order('B.project_id,A.task_id');
		//echo $qry = $rawData->getText();exit;
		$dataReader = $rawData->queryAll();
		$i=1;$project_type='';
		foreach ($dataReader as $data){
			if($project_type <> $data['project_type']){
				$i=1;	
			}else{
				$i++;
			}
			$project_type = $data['project_type']; 
			if($data['task_name']){
				$Api_Data[$data['project_type']][] = $data['project_id'].'_'.$i.' => '.$data['task_name'];
			}else{
				$Api_Data[$data['project_type']][] = '';
			}
			
		}
		return $Api_Data;
	}*/
}
