<?php

namespace common\helpers;

/**
 * Description of UtilsHelper
 *
 * @author AlexR
 */
class UtilsHelper {
    
    public static $defaultImage = '/images/placeholder-s.jpg';
    
    public static function getFormattedDate($date = null){
        return \Yii::$app->formatter->format($date, 'date');
    }
    
    public static function getImageUrl($imageUrl = ''){
        $filePath = \Yii::getAlias('@frontend/web').$imageUrl;
        return (file_exists($filePath) && is_file($filePath)) ? $imageUrl : self::$defaultImage; 
    }
}
