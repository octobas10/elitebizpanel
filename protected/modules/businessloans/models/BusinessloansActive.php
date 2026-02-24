<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BusinessloansActive
 *
 * @author BPD
 */
class BusinessloansActive extends CActiveRecord {

    public static $dbBusinessLoans;

    public function getDbConnection() {

        if (self::$dbBusinessLoans !== null)
            return self::$dbBusinessLoans;
        else {
            self::$dbBusinessLoans = Yii::app()->dbBusinessLoans;
            self::$dbBusinessLoans->connectionString;

            if (self::$dbBusinessLoans instanceof CDbConnection) {
                self::$dbBusinessLoans->setActive(true);
                return self::$dbBusinessLoans;
            } else {
                throw new CDbException(Yii::t('yii', 'Active Record requires a "db" CDbConnection application component.'));
            }
        }
    }

}
