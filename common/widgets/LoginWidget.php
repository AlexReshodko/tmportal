<?php
namespace common\widgets;

use Yii;
//use yii\web\Controller;
//use yii\filters\VerbFilter;
//use yii\filters\AccessControl;
use common\models\LoginForm;
/**
 * Description of LoginWidget
 *
 * @author AlexR
 */
class LoginWidget extends \yii\base\Widget{
    
    public function init(){
        parent::init();
        
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        Yii::setAlias('loginWidget', '@common/themes/frontend-theme');
    }
    public function run()
    {
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
}
