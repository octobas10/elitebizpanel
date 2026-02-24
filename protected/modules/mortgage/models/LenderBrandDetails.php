<?php
/**
 * This is the model class for table "homeimprovement_lender_transactions".
 *
 * The followings are the available columns in table 'homeimprovement_lender_transactions':
 * @property integer $id
 * @property string $date
 * @property string $name
 * @property string $tier
 * @property string $request
 * @property string $response
 * @property string $full_response
 * @property double $time
 * @property integer $count
 */
class LenderBrandDetails extends MortgageActive{
	/**
	 * Returns the static model of the specified AR class.
	 * 
	 * @param string $className active record class name.
	 * @return LenderTransactions the static model class
	 */
	public static function model($className = __CLASS__){
		return parent::model($className);
	}
	/**
	 *
	 * @return string the associated database table name
	 */
	public function tableName(){
		return 'mortgage_lender_brand_details';
	}
	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels(){
		return array(
			'id' => 'Promo Code',
			'lender_id' => 'Lender Id',
			'affiliate_transactions_id' => 'Affiliate Transaction Id',
			'customer_id' => 'Customer Id',
			'brand_id' => 'Brand Id',
			'brand_name' => 'Brand Name',
			'bid_price' => 'Bid Price',
			'date' => 'Date',
		);
	}
	/**
	 *
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array(
				'id, lender_id, promo_code, affiliate_transactions_id, customer_id, brand_id, brand_name, bid_price, date',
				'safe',
				'on' => 'search' 
			) 
		);
	}
	/**
	 *
	 * @return array relational rules.
	 */
	public function relations(){
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'affiliate_transactions' => array(self::BELONGS_TO,'AffiliateTransactions','affiliate_transactions_id') 
		);
	}
	
	
	
}
