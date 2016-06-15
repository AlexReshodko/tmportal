<?php
namespace common\helpers;
/**
 * Description of AvatarHelper
 *
 * @author AlexR
 */
class AvatarHelper {
    
    public static $defaultAvatar = '/images/default-avatar.jpg';

    public static function getAvatarUrl($photoUrl = ''){
        return $photoUrl ? $photoUrl : self::$defaultAvatar; 
    }
}
