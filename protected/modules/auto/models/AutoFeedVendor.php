<?php

/**
 * This is the model class for table "auto_feed_vendor".
 *
 * The followings are the available columns in table 'auto_feed_vendor':
 * @property integer $id
 * @property string $username
 * @property integer $uniqueness
 * @property integer $dup_days
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $company_name
 * @property string $phone
 * @property string $createdAt
 */
class AutoFeedVendor extends CActiveRecord {
    /**
     * @return string the associated database table name
     */
    public function tableName(){
        return 'auto_feed_vendor';
    }
    /**
     * @return array validation rules for model attributes.
     */
    public function rules(){
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(
                'username,uniqueness,dup_days,status,first_name,last_name,email,company_name,phone',
                'required'
            ),
            array(
                'username',
                'unique'
            ),
            array(
                'uniqueness, dup_days',
                'numerical',
                'integerOnly' => true
            ),
            array(
                'username, email, company_name',
                'length',
                'max' => 255
            ),
            array(
                'first_name, last_name',
                'length',
                'max' => 55
            ),
            array(
                'phone',
                'length',
                'max' => 12
            ),
            array(
                'email',
                'email'
            ),
            array(
                'phone',
                'length',
                'min' => 10
            ),
            array(
                'phone',
                'numerical',
                'integerOnly' => true
            ),
            array(
                'createdAt',
                'default',
                'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false,
                'on' => 'insert'
            ),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'id, username,status, uniqueness, dup_days, first_name, last_name, email, company_name, phone, createdAt',
                'safe',
                'on' => 'search'
            )
        );
    }
    /**	
     * @return array relational rules.
     */
    public function relations(){
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels(){
        return array(
            'id' => 'Code',
            'username' => 'Username',
            'uniqueness' => 'Unique',
            'dup_days' => 'Duplicate Days',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'company_name' => 'Company Name',
            'phone' => 'Phone',
            'status' => 'Status',
            'createdAt' => 'Created At'
        );
    }
    /**
     * Retrieves a list of models based on the current search/filter conditions.
     *
     * Typical usecase:
     * - Initialize the model fields with values from filter form.
     * - Execute this method to get CActiveDataProvider instance which will filter
     * models according to data in model fields.
     * - Pass data provider to CGridView, CListView or any similar widget.
     *
     * @return CActiveDataProvider the data provider that can return the models
     * based on the search/filter conditions.
     */
    public function search(){
        // @todo Please modify the following code to remove attributes that should not be searched.
        $criteria = new CDbCriteria;
        $criteria->compare('id', $this->id);
        $criteria->compare('username', $this->username, true);
        $criteria->compare('uniqueness', $this->uniqueness);
        $criteria->compare('dup_days', $this->dup_days);
        $criteria->compare('first_name', $this->first_name, true);
        $criteria->compare('last_name', $this->last_name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('company_name', $this->company_name, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('createdAt', $this->createdAt, true);
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria
        ));
    }
    
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return AutoFeedVendor the static model class
     */
    public static function model($className = __CLASS__){
        return parent::model($className);
    }
    
    public function listfeedbrowseleads(){
        $where = "1";
        if(!empty($_REQUEST['feed_vendor_id'])){
            $where .= " AND a_sub.feed_vendor_id ='" . $_REQUEST['feed_vendor_id'] . "'";
        }
        if(!empty($_REQUEST['lenders'])){
            $lenders = implode(",", (array) $_REQUEST['lenders']);
            $where .= " AND a_lts.feed_lender_name = '" . $lenders . "'";
        }
        if(!empty($_REQUEST['status'])){
            $where .= " AND a_lts.status='" . $_REQUEST['status'] . "'";
        }
        if(!empty($_REQUEST['filter'])){
            $filter = explode('-', $_REQUEST['filter']);
            $count = count($filter);
            if($count == 2){
                $date1 = @date("Y-m-d", strtotime($filter[0]));
                $date2 = @date("Y-m-d", strtotime($filter[1]));
                $where .= " AND a_sub.sub_date BETWEEN '" . $date1 . "' AND '" . $date2 . "' ";
            }else{
                $date = @date("Y-m-d", strtotime($filter[0]));
                $where .= " AND  a_sub.sub_date  = '" . $date . "'";
            }
        }
        $string = "a_sub.id,a_sub.feed_vendor_id ,a_sub.first_name,a_sub.last_name,a_sub.sub_date,a_sub.email";
        
        $string = "a_sub.*";
        
        $rawData = Yii::app()->db->createCommand()->select($string)->from('auto_feed_submission a_sub')->join('auto_feed_vendor_transactions a_ft', 'a_sub.id=a_ft.customer_id')->join('auto_feed_vendor a_afu', 'a_ft.feed_vendor_id  = a_afu.id')->join('auto_feed_lender_transactions a_lts', 'a_lts.feed_vendor_transactions_id   =  a_ft.id')->where($where)->queryAll();
        return $rawData;
    }
    
    public function listfeedbrowseallleads(){
        $string = "a_sub.*";
        $rawData = Yii::app()->db->createCommand()->select($string)->from('auto_feed_submission a_sub')->join('auto_feed_vendor_transactions a_ft', 'a_sub.id=a_ft.customer_id')->join('auto_feed_vendor a_afu', 'a_ft.feed_vendor_id  = a_afu.id')->join('auto_feed_lender_transactions a_lts', 'a_lts.feed_vendor_transactions_id   =  a_ft.id')->queryAll();
        //echo Yii::app()->db->get_query();exit;
        return $rawData;
    }
    
    public function checkVendorStatus(){
        $id = $_POST['vendor_id'];
        $criteria = new CDbCriteria;
        $criteria->select = 'status';
        $criteria->condition = 'id=' . $id;
        $row = AutoFeedVendor::model()->find($criteria);
        if($row['status'] != '1'){
            $cm = new CommonMethods();
            $cm->setRespondFeedSubmissionsError('', 'vendor_inactive');
        }
    }
}
