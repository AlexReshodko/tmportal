<?php
namespace common\widgets;

use common\models\User;
/**
 * Description of LoginWidget
 *
 * @author AlexR
 */
class UsersListWidget extends \yii\base\Widget{
    
    public function init(){
        parent::init();
    }
    public function run()
    {
        $users = User::getUsers();
        return $this->render('usersList',[
            'users'=>$users
        ]);
    }
}