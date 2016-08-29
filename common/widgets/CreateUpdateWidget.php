<?php

namespace common\widgets;
use yii\base\Widget;

/**
 * Description of CreateUpdateWidget
 *
 * @author AlexR
 */
class CreateUpdateWidget extends Widget{
    
    public $params;

    public function init()
    {
        parent::init();
        if ($this->params === null) {
            $this->params = [];
        }
    }

    public function run()
    {
        return $this->render('createUpdate', ['params' => $this->params]);
    }
}
