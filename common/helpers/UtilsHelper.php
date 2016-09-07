<?php

namespace common\helpers;

use Yii;

/**
 * Description of UtilsHelper
 *
 * @author AlexR
 */
class UtilsHelper {
    
    const STATUS_ACTIVE = 1;
    const STATUS_NOT_ACTIVE = 0;
    
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
    
    public static function getStatusGridLabel($data){
        return [
            'label' => 'Status',
            'format' => 'raw',
            'value' => function($data){
                $isActive = $data->status == UtilsHelper::STATUS_ACTIVE;
                return '<span class="label label-'.($isActive ? 'success' : 'danger').'">'.($isActive ? Yii::t('status', "Active") : Yii::t('status', "Disabled")).'</span>';
            }
        ];
    }
}
