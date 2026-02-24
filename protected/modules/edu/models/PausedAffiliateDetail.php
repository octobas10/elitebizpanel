<?php
/**
 * This is the model class for table "edu_paused_affiliate_details".
 *
 */
/**
* @since : 03-12-2016 08:57 AM
* @author : Siddharajsinh Maharaul
* @functionality : Made new class for edu_paused_affiliate_details
*/
class PausedAffiliateDetail extends EModuleActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Country the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'edu_paused_affiliate_details';
	}

	/**
	 * @since : 26-12-2016 10:31 AM
	 * @author : Siddharajsinh Maharaul
	 * @functionality : Get paused sub ids by passing condition as parameter
	 */
	public function getPausedSubIds($s_condition='delete_status != 1'){
		$dbCommand = parent::getDbConnection()->createCommand()
		->select("sub_id")
		->from('edu_paused_affiliate_details')
		->where($s_condition);
		return $dbCommand->queryAll();
	}

}
?>
