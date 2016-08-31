<?php

namespace common\helpers;

/**
 * Description of UtilsHelper
 *
 * @author AlexR
 */
class UtilsHelper {
    
    const STATUS_PUBLISHED = 1;
    const STATUS_NOT_PUBLISHED = 0;
    
    const STATUS_DELETED = 1;
    const STATUS_NOT_DELETED = 0;

    public static $defaultImage = '/images/placeholder-s.jpg';
    
    public static function getFormattedDate($date = null){
        return \Yii::$app->formatter->format($date, 'date');
    }
    
    public static function getImageUrl($imageUrl = ''){
        $filePath = \Yii::getAlias('@frontend/web').$imageUrl;
        return (file_exists($filePath) && is_file($filePath)) ? $imageUrl : self::$defaultImage; 
    }
    
    public static function getNotSetMsg(){
        return \Yii::t('app', '(not set)');
    }
}
