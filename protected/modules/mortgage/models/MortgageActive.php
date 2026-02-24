<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MortgageActive
 *
 * @author BPD
 */
class MortgageActive extends CActiveRecord {

    public static $dbMortgage;

    public function getDbConnection() {

        if (self::$dbMortgage !== null)
            return self::$dbMortgage;
        else {
            self::$dbMortgage = Yii::app()->dbMortgage;
            self::$dbMortgage->connectionString;

            if (self::$dbMortgage instanceof CDbConnection) {
                self::$dbMortgage->setActive(true);
                return self::$dbMortgage;
            } else {
                throw new CDbException(Yii::t('yii', 'Active Record requires a "db" CDbConnection application component.'));
            }
        }
    }

}
