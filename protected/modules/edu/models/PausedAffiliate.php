<?php
/**
 * This is the model class for table "edu_paused_affiliates".
 *
 */
/**
* @since : 03-12-2016 08:57 AM
* @author : Siddharajsinh Maharaul
* @functionality : Made new class for edu_paused_affiliates
*/
class PausedAffiliate extends EModuleActiveRecord
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
		return 'edu_paused_affiliates';
	}

  /**
   * @since : 26-12-2016 10:31 AM
   * @author : Siddharajsinh Maharaul
   * @functionality : Get paused affiliate by passing condition as parameter
   */
  public function getPausedAffiliate($s_condition='delete_status != 1'){
    $dbCommand = parent::getDbConnection()->createCommand()
    ->select("id,promo_code")
    ->from('edu_paused_affiliates')
    ->where($s_condition);
    return $dbCommand->queryAll();
  }

  /**
   * @since : 26-12-2016 11:30 AM
   * @author : Siddharajsinh Maharaul
   * @functionality : Check for paused affiliate and sub id pair
   */
  public function checkPausedAffiliateSubIdPair($s_condition = 'pa.delete_status != 1'){
      $dbCommand = parent::getDbConnection()->createCommand();
      return $dbCommand->select('pa.id')->from('edu_paused_affiliates pa')->join('edu_paused_affiliate_details pad', 'pad.paused_affiliate_id = pa.id')->where($s_condition)->queryAll();
  }

}
?>
