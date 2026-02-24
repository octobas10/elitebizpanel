<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DebtActive
 *
 * @author BPD
 */
class DebtActive extends CActiveRecord {

    public static $dbDebt;

    public function getDbConnection() {

        if (self::$dbDebt !== null)
            return self::$dbDebt;
        else {
            self::$dbDebt = Yii::app()->dbDebt;
            self::$dbDebt->connectionString;

            if (self::$dbDebt instanceof CDbConnection) {
                self::$dbDebt->setActive(true);
                return self::$dbDebt;
            } else {
                throw new CDbException(Yii::t('yii', 'Active Record requires a "db" CDbConnection application component.'));
            }
        }
    }

}
