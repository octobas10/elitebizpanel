<?php
	/*
	** 
	** modification : extend class changed from CActiveRecord to EModuleActiveRecord
	** modification date : 25-07-2016
	*/
	/**
	 ** 
	**/
class Providers extends HomeimprovementActive{
	public static function model($className=__CLASS__){
		return parent::model($className);
	}
	public function tableName(){
		return 'providers';
	}
}
