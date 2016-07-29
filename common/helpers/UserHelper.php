<?php
namespace common\helpers;
/**
 * Description of UserHelper
 *
 * @author AlexR
 */
class UserHelper {
    
    public static $defaultAvatar = '/images/default-avatar.jpg';

    public static function getAvatarUrl($photoUrl = ''){
        return ($photoUrl && file_exists(\Yii::getAlias('@app/web').$photoUrl)) ? $photoUrl : self::$defaultAvatar; 
    }
}
