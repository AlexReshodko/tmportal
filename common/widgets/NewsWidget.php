<?php

namespace common\widgets;
use yii\base\Widget;

/**
 * Description of NewsWidget
 *
 * @author AlexR
 */
class NewsWidget extends Widget{
    
    public $news;

    public function init()
    {
        parent::init();
        if ($this->news === null) {
            $this->news = [];
        }
    }

    public function run()
    {
        return $this->render('news', ['news' => $this->news]);
    }
}
