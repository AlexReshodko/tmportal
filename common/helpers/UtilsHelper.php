<?php

namespace common\helpers;

/**
 * Description of UtilsHelper
 *
 * @author AlexR
 */
class UtilsHelper {
    
    public static function getFormattedDate($date = null){
        return \Yii::$app->formatter->format($date, 'date');
    }
}
