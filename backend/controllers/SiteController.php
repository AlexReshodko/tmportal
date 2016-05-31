<?php
namespace backend\controllers;

use common\models\LoginForm;
use common\models\UserData;
use common\models\Office;
use frontend\models\SignupForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\helpers\Json;
use yii\web\Controller;

/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['login', 'error', 'add-users'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        $this->layout = 'login';
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
        
    public function actionAddUsers(){
        $filename = Yii::getAlias('@common').'/data/users.json';
        $addedUsers = [];
        if(file_exists($filename)){
            $json = file_get_contents($filename);
            $users = Json::decode($json);
            foreach ($users as $key => $user) {
                $model = new SignupForm();
                $model->username = $user['username'];
                $model->password = $user['password'];
                $model->email = $user['email'];
                $model->role = $user['role'];
                if ($savedUser = $model->signup()) {
                    if(isset($user['data'])){
                        $data = $user['data'];
                        $userDataModel = new UserData();
                        $userDataModel->user_id = $savedUser->id;
                        $userDataModel->office_id = Office::find()->where(['code'=>$data['office']])->one()->id;
                        $userDataModel->first_name = $data['first_name'];
                        $userDataModel->last_name = $data['last_name'];
                        $userDataModel->work_start_date = $data['work_start_date'];
                        $userDataModel->birthday = $data['birthday'];
                        if(!$userDataModel->save()){
                            throw new Exception($userDataModel->getErrors());
                        }
                    }
                    array_push($addedUsers, $user['username']);
                }else{
                    print_r($model->errors);
                }
            }
            echo '<pre>';
            print_r($addedUsers);
            echo '</pre>';
        }  else {
            throw new Exception("File doesn't exists: " . $filename);
        }
    }
}
