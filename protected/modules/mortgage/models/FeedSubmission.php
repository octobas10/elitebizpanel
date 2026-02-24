<?php
/**
 * This is the model class for table "{{feed_submission}}".
 *
 * The followings are the available columns in table '{{feed_submission}}':
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $gender
 * @property string $dob
 * @property string $phone
 * @property string $cell
 * @property string $address
 * @property string $city
 * @property string $zip
 * @property string $state
 * @property string $source
 * @property string $sub_date
 */
class FeedSubmission extends MortgageActive {
    /**
     * @return string the associated database table name
     */
    public function tableName() {
        return 'mortgage_feed_submission';
    }
    
    /**
     * @return array validation rules for model attributes.
     */
    public function rules() {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array(
                'first_name, last_name, email, gender, phone, address, city, zip, state',
                'required'
            ),
            array(
                'first_name, last_name, email, address, source,feed_vendor_id',
                'length',
                'max' => 255
            ),
            array(
                'gender',
                'length',
                'max' => 1
            ),
            array(
                'sub_date',
                'default',
                'value' => new CDbExpression('NOW()'),
                'setOnEmpty' => false,
                'on' => 'insert'
            ),
            array(
                'dob, zip',
                'length',
                'max' => 10
            ),
            array(
                'phone, cell',
                'length',
                'max' => 12
            ),
            array(
                'city',
                'length',
                'max' => 30
            ),
            array(
                'state',
                'length',
                'max' => 2
            ),
            // The following rule is used by search().
            // @todo Please remove those attributes that should not be searched.
            array(
                'id, first_name, last_name, email, gender, dob, phone, cell, address, city, zip, state, source, sub_date',
                'safe',
                'on' => 'search'
            )
        );
    }
    
    /**
     * @return array relational rules.
     */
    public function relations() {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array();
    }
    
    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels() {
        return array(
            'id' => 'ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'gender' => 'Gender',
            'dob' => 'Dob',
            'phone' => 'Phone',
            'cell' => 'Cell',
            'address' => 'Address',
            'city' => 'City',
            'zip' => 'Zip',
            'state' => 'State',
            'source' => 'Source',
            'sub_date' => 'Sub Date'
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
    public function search() {
        // @todo Please modify the following code to remove attributes that should not be searched.
        
        $criteria = new CDbCriteria;
        
        $criteria->compare('id', $this->id);
        $criteria->compare('first_name', $this->first_name, true);
        $criteria->compare('last_name', $this->last_name, true);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('gender', $this->gender, true);
        $criteria->compare('dob', $this->dob, true);
        $criteria->compare('phone', $this->phone, true);
        $criteria->compare('cell', $this->cell, true);
        $criteria->compare('address', $this->address, true);
        $criteria->compare('city', $this->city, true);
        $criteria->compare('zip', $this->zip, true);
        $criteria->compare('state', $this->state, true);
        $criteria->compare('source', $this->source, true);
        $criteria->compare('sub_date', $this->sub_date, true);
        
        return new CActiveDataProvider($this, array(
            'criteria' => $criteria
        ));
    }
    /*** grap data for cronjob */
    
    public function getSubmissionData($delay, $limit, $commit_point) {
        $where = "sub_date >= DATE_ADD('" . @date('Y-m-d H:i:s') . "', INTERVAL -$delay HOUR) AND id > $commit_point";
        $feed_submissions = Yii::app()->dbMortgage->createCommand()->select('*')->from('mortgage_feed_submission')->where($where)->limit($limit)->queryAll();
        return $feed_submissions;
    }
    
    /**
     * Returns the static model of the specified AR class.
     * Please note that you should have this exact method in all your CActiveRecord descendants!
     * @param string $className active record class name.
     * @return FeedSubmission the static model class
     */
    public static function model($className = __CLASS__) {
        return parent::model($className);
    }
    
    public function add_submission_test_lender(){
    	
    }
}
