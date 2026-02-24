<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HealthinsuranceActive
 *
 * @author BPD
 */
class HealthinsuranceActive extends CActiveRecord {

    public static $dbHealthinsurance;

    public function getDbConnection() {

        if (self::$dbHealthinsurance !== null)
            return self::$dbHealthinsurance;
        else {
            self::$dbHealthinsurance = Yii::app()->dbHealthinsurance;
            self::$dbHealthinsurance->connectionString;

            if (self::$dbHealthinsurance instanceof CDbConnection) {
                self::$dbHealthinsurance->setActive(true);
                return self::$dbHealthinsurance;
            } else {
                throw new CDbException(Yii::t('yii', 'Active Record requires a "db" CDbConnection application component.'));
            }
        }
    }

}
