<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of autoInsuranceActive
 *
 * @author BPD
 */
class autoInsuranceActive extends CActiveRecord {

    public static $dbAutoinsurance;

    public function getDbConnection() {

        if (self::$dbAutoinsurance !== null)
            return self::$dbAutoinsurance;
        else {
            self::$dbAutoinsurance = Yii::app()->dbAutoinsurance;
            self::$dbAutoinsurance->connectionString;

            if (self::$dbAutoinsurance instanceof CDbConnection) {
                self::$dbAutoinsurance->setActive(true);
                return self::$dbAutoinsurance;
            } else {
                throw new CDbException(Yii::t('yii', 'Active Record requires a "db" CDbConnection application component.'));
            }
        }
    }

}
