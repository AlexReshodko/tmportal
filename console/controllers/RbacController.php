<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;
use common\models\User;

class RbacController extends Controller
{
    public function actionInit()
    {
        $auth = Yii::$app->authManager;
        $auth->removeAll();

        $adminRole = $auth->createRole('admin');
        $auth->add($adminRole);
        
        $moderRole = $auth->createRole('moder');
        $auth->add($moderRole);
        
        $userRole = $auth->createRole('user');
        $auth->add($userRole);
        
        $users = User::find()->all();
        foreach ($users as $user){
            $userID = $user->id;
            switch ($user->role) {
                case User::ROLE_ADMIN:
                    $auth->assign($adminRole, $userID);
                    break;
                case User::ROLE_MODER:
                    $auth->assign($moderRole, $userID);
                    break;
                default:
                    $auth->assign($userRole, $userID);
                    break;
            }
        }
    }
}