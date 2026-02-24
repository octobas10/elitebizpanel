<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of HomeimprovementActive
 *
 * @author BPD
 */
class HomeimprovementActive extends CActiveRecord {

    public static $dbHomeimprovement;

    public function getDbConnection() {

        if (self::$dbHomeimprovement !== null)
            return self::$dbHomeimprovement;
        else {
            self::$dbHomeimprovement = Yii::app()->dbHomeimprovement;
            self::$dbHomeimprovement->connectionString;

            if (self::$dbHomeimprovement instanceof CDbConnection) {
                self::$dbHomeimprovement->setActive(true);
                return self::$dbHomeimprovement;
            } else {
                throw new CDbException(Yii::t('yii', 'Active Record requires a "db" CDbConnection application component.'));
            }
        }
    }

}
