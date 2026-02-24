<?php
class ListLead extends MortgageActive
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
		return 'mortgage_submissions';
	}
	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('promo_code','required','message'=>'promo_code is required'),
			array('sub_id','length'),
			array('first_name','required','message'=>'First name is required'),
			array('last_name','required','message'=>'Last name is required'),
			array('gender','length'),
			array('gender','in','range'=>array('0','1'),'allowEmpty'=>true,'message'=>'Gender should be 0 or 1'),
			array('address','required','message'=>'Address is required'),
			array('city','required','message'=>'City is required'),
			array('state','required','message'=>'State is required'),
			array('state', 'length','min'=>2,'message'=>'State should be 2 character'),
			array('zip','required','message'=>'Zip is required'),
			array('zip','numerical','integerOnly'=>true,'message'=>'Zip should be numeric'),
		    array('is_rented','required','message'=>'Residence type is required'),
			array('is_rented','in','range'=>array('0','1'),'allowEmpty'=>true,'message'=>'is_rented should be 0 or 1'),
			array('stay_in_year','required','message'=>'Years at current address is required'),
			array('stay_in_month','required','message'=>'Months at current address required'),
			array('home_pay','required','message'=>'Rent / Mortgage required'),
			array('email','email','message'=>'Invalid email address'),
			array('phone','required','message'=>'Phone is required'),
			array('zip','numerical','integerOnly'=>true,'message'=>'Zip should be numeric'),
			array('mobile','required','message'=>'Mobile is required'),
			array('dob','required','message'=>'Date of birth is required'),
			array('employer','required','message'=>'Employer is required'),
			array('job_title','required','message'=>'job title is required'),
			array('employment_in_month','required','message'=>'Months at current job is required'),
			array('employment_in_year','required','message'=>'Years at current job is required'),
			array('income_type','required','message'=>'Source of income is required'),
			array('monthly_income','required','message'=>'Monthly income is required'),
			array('ssn','required','message'=>'SSN is required'),
			array('ssn', 'length','is' => 9,'message'=>'SSN should be 9 character long'),
			array('bankruptcy','required','message'=>'Bankruptcy is required'),
			array('ipaddress','required','message'=>'ipaddress is required'),
			array('cosigner','required','message'=>'Cosigner is required'),
			array('agree_credit_check','required','message'=>'agree_credit_check is required'),
			array('sub_date','default',
			'value'=>new CDbExpression('NOW()'),
			'setOnEmpty'=>false,'on'=>'insert')
		);
	}
	public function checkDuplicate($data){
		$dbCommand = Yii::app()->dbMortgage->createCommand("
		SELECT COUNT(id) as count FROM `mortgage_submissions` WHERE email='".$data['email']."' AND first_name = '".$data['first_name']."' AND last_name ='".$data['last_name']."' AND UNIX_TIMESTAMP(sub_date) > '".@strtotime('-1 month')."' ");
		$dataReader=$dbCommand->queryRow();
		return $dataReader['count'];
	}
	public function afterSave()
	{
	   // update transaction affiliate transactions table
	   // set customer id (user id)
	   $id = Yii::app()->dbMortgage->getLastInsertId();
	   AffiliateTransactions::model()->updateByPk(Yii::app()->session['affiliate_trans_id'],array("customer_id"=>$id)); 
		
			
	}
}
