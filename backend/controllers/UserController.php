<?php

namespace backend\controllers;

use Yii;
use common\models\User;
use yii\data\ActiveDataProvider;
use common\components\BackendController;
use yii\web\NotFoundHttpException;
use common\models\UserData;
use common\helpers\Logger;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends BackendController
{

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => User::find()->joinWith('userData'),
            'sort' => ['attributes' => ['']],
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $user = new \frontend\models\SignupForm();
        
        $userData = new UserData(['scenario' => UserData::SCENARIO_CREATE]);
        
        if (Yii::$app->request->isAjax && $user->load(Yii::$app->request->post()) && $userData->load(Yii::$app->request->post())) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validateMultiple([$user, $userData]);
        }
        if ($user->load(Yii::$app->request->post()) && $userData->load(Yii::$app->request->post())) {
            $isValid = $user->validate();
            $isValid = $userData->validate() && $isValid;
            if($isValid){
                if ($savedUser = $user->signup()) {
                    $userData->user_id = $savedUser->id;
                    if (!$userData->save()) {
                        Logger::warn($userData->getErrors());
                    }
                } else {
                    Logger::warn($user->errors);
                }
                return $this->redirect(['view', 'id' => $savedUser->id]);
            }else{
                return $this->render('create', [
                    'user' => $user,
                    'userData' => $userData,
                ]);
            }
        } else {
            return $this->render('create', [
                'user' => $user,
                'userData' => $userData,
            ]);
        }
    }

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $user = $this->findModel($id);
        $userData = $user->userData;
        $userData->scenario = UserData::SCENARIO_CREATE;
        if (Yii::$app->request->isAjax && $user->load(Yii::$app->request->post()) && $userData->load(Yii::$app->request->post())) {
            Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            return \yii\widgets\ActiveForm::validate($user);
        }

        if ($user->load(Yii::$app->request->post()) && $userData->load(Yii::$app->request->post())) {
            $isValid = $user->validate();
            $isValid = $userData->validate() && $isValid;
            if ($isValid) {
                $user->save(false);
                $userData->save(false);
//                return $this->redirect(['view', 'id' => $user->id]);
            }
        }
        return $this->render('update', [
            'user' => $user,
        ]);
    }

    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $user = $this->findModel($id);
        if(!$user){
            throw new Exception('Wrong user ID');
        }
        $user->status = \common\helpers\UtilsHelper::STATUS_NOT_ACTIVE;
        if(!$user->save()){
            Logger::warn($user->getErrors());
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::getUser($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
