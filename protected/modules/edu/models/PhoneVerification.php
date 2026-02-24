<?php
/**
 * This is the model class for table "edu_phoneverification_list".
 *
 * The followings are the available columns in table 'edu_phoneverification_list':
 * @property integer $id
 * @property bigint $phone
 * @property integer $is_valid
 * @property text $response
 * @property verification_datetime $datetime
 */
/**
* @since : 03-12-2016 08:57 AM
* @author : Siddharajsinh Maharaul
* @functionality : Made new class for edu_phoneverification_list
*/
class PhoneVerification extends EModuleActiveRecord
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
		return 'edu_phoneverification_list';
	}

  /**
  * @since : 02-12-2016 01:04 PM
  * @author : Siddharajsinh Maharaul
  * @functionality : Added function to get phone_verification detalis
  */
  /**
  * @since : 03-12-2016 08:59 AM
  * @author : Siddharajsinh Maharaul
  * @functionality : Shifted function from AffiliateUser to PhoneVerification Model
  */
  function getPhoneVerificationDates($s_filter_date){
      if(!empty($s_filter_date)){
          $t_filter = explode(' - ',$s_filter_date);
          if(!empty($t_filter)){
              if(count($t_filter) == 2){
                  $where[] =  ' "'.date("Y-m-d", strtotime(trim(str_replace('|','-',$t_filter[0])))).'" <= date(verification_datetime) ';
                  $where[] =  ' "'.date("Y-m-d", strtotime(trim(str_replace('|','-',$t_filter[1])))).'" >= date(verification_datetime) ';
              }else{
                  $where[] =  ' "'.date("Y-m-d", strtotime(trim(str_replace('|','-',$t_filter[0])))).'" <= date(verification_datetime) ';
                  $where[] =  ' "'.date("Y-m-d", strtotime(trim(str_replace('|','-',$t_filter[0])))).'" >= date(verification_datetime) ';
              }
              $where = array_filter($where);
              $where = (count($where) > 0) ? ''.implode(' AND ', $where) : '';

              $criteria=new CDbCriteria();
              $criteria->select = 'phone,is_valid,date_format(verification_datetime,"%Y-%m-%d %H:%i:%s") as verification_datetime';
              $criteria->condition = $where;
              return $criteria;
            //	$t_data = parent::getDbConnection()->createCommand()->select('phone,is_valid,date_format(verification_datetime,"%Y-%m-%d %H:%i:%s") as verification_datetime')->from('edu_phoneverification_list')->where('"'.$date1.'" <= date(verification_datetime) and "'.$date2.'" >= date(verification_datetime) ')->queryAll();
          }
      }
      return '';
  }


}
?>
