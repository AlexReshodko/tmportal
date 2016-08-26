<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

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
