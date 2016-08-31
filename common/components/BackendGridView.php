<?php

namespace common\components;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BackendGridView
 *
 * @author AlexR
 */
class BackendGridView extends \yii\grid\GridView{
    
    public $tableOptions = ['class'=>'table datatable-basic table-bordered table-striped table-hover'];
    
    public $layout = '{items}';
    
    public $options = [];

}
