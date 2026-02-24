<?php

/**
 * This is the model class for table "homeimprovement_lender_user".
 *
 * The followings are the available columns in table 'homeimprovement_lender_user':
 * @property string $id
 * @property string $status
 * @property string $user_name
 * @property string $password
 * @property string $email
 * @property string $first_name
 * @property string $last_name
 * @property string $company_name
 * @property string $phone
 * @property string $work_phone
 * @property string $address
 * @property string $state
 * @property string $zip
 * @property string $createdAt
 */
class LenderUser extends HomeimprovementActive{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return LenderUser the static model class
	 */
	public static function model($className=__CLASS__){
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName(){
		return 'homeimprovement_lender_user';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules(){
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
		    array('user_name,password,email','required'),
			array('user_name','unique'),
			array('status, phone', 'length', 'max'=>32),
			array('user_name, password, first_name, last_name', 'length', 'max'=>50),
			array('email, company_name', 'length', 'max'=>255),
			array('createdAt','default','value'=>new CDbExpression('NOW()')),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, status, user_name, password, email, first_name, last_name, company_name, phone,address, createdAt', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations(){
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels(){
		return array(
			'id' => 'ID',
			'status' => 'Status',
			'user_name' => 'Lender Name',
			'password' => 'Password',
			'email' => 'Email',
			'first_name' => 'First Name',
			'last_name' => 'Last Name',
			'company_name' => 'Company Name',
			'phone' => 'Telephone',
			'createdAt' => 'Created At',
		);
	}
	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search(){
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.
		$criteria=new CDbCriteria;
		$criteria->compare('id',$this->id,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('user_name',$this->user_name,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('first_name',$this->first_name,true);
		$criteria->compare('last_name',$this->last_name,true);
		$criteria->compare('company_name',$this->company_name,true);
		$criteria->compare('phone',$this->phone,true);
		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	public function beforeSave(){
		if(parent::beforeSave() && $this->isNewRecord){
			$this->password = md5($this->password);
		}
	    return true;
	}
}
