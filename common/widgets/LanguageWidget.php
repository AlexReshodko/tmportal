<?php
namespace common\widgets;
use Yii;
use yii\bootstrap\Dropdown;

class LanguageWidget extends \yii\bootstrap\Widget
{
    private static $_labels;
    public $items;

    private $_isError;

    public function init()
    {
        $route = Yii::$app->controller->route;
        $appLanguage = Yii::$app->language;
        $params = $_GET;
        $this->_isError = $route === Yii::$app->errorHandler->errorAction;

        array_unshift($params, '/'.$route);

        foreach (Yii::$app->urlManager->languages as $language) {
            $isWildcard = substr($language, -2)==='-*';
            if (
                $language===$appLanguage ||
                // Also check for wildcard language
                $isWildcard && substr($appLanguage,0,2)===substr($language,0,2)
            ) {
                continue;   // Exclude the current language
            }
            if ($isWildcard) {
                $language = substr($language,0,2);
            }
            $params['language'] = $language;
            $this->items[] = [
                'label' => self::label($language),
                'url' => $params,
            ];
        }
        parent::init();
    }

    public function run()
    {
        // Only show this widget if we're not on the error page
        if ($this->_isError) {
            return '';
        }
        return $this->render('language', [
            'items' => $this->items,
        ]);
    }

    public static function label($code)
    {
        if (self::$_labels===null) {
            self::$_labels = [
                'en' => 'English',
                'ru' => 'Русский',
                'ua' => 'Українська',
            ];
        }

        return isset(self::$_labels[$code]) ? self::$_labels[$code] : null;
    }
    
    public static function getCurrentLanguage(){
        $appLanguage = Yii::$app->language;
        
        foreach (Yii::$app->urlManager->languages as $language) {
            if ($language===$appLanguage){
                echo self::label($language);
            }
        }
    }
}