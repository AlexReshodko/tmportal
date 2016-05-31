<?php
namespace common\widgets;

use Yii;
use common\models\User;
/**
 * Description of LoginWidget
 *
 * @author AlexR
 */
class GreetingsWidget extends \yii\bootstrap\Widget{
    
    public function init(){
        parent::init();
    }
    public function run()
    {
        $userID = Yii::$app->user->id;
        $user = User::find()->joinWith('userData')->where(['user.id' => $userID])->one();
        if($user && $user->userData && $user->userData->first_name){
            $name = $user->userData->first_name;
        }else{
            $name = $user->username;
        }
        return $this->render('greet', [
            'name' => $name,
        ]);
    }
}
