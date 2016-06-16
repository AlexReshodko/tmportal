<?php

namespace frontend\controllers;

use Yii;
use yii\base\Model;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\UploadedFile;
use yii\web\NotFoundHttpException;

use common\models\Office;
use common\models\User;
use common\models\UserData;
use common\models\UploadPhotoForm;

/**
 * UserController implements the CRUD actions for UserData model.
 */
class UserController extends Controller
{
    
    public $defaultAction = 'profile';
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all UserData models.
     * @return mixed
     */
    public function actionProfile()
    {
        /*if(Yii::$app->request->post()){
            print_r(Yii::$app->request->post());exit;
        }*/
//        $model = new UploadPhotoForm();
        $user = User::find()->joinWith('userData')->where(['{{user}}.id'=>\Yii::$app->user->id])->one();
        if(!$user->userData){
            $userDataModel = new UserData();
            $userDataModel->user_id = $user->id;
            $userDataModel->office_id = Office::find()->where(['code'=>'CK'])->one()->id;
            if(!$userDataModel->save()){
                \yii\helpers\VarDumper::dump($userDataModel);
                print_r($userDataModel->getErrors());exit;
            }
            $user = User::find()->joinWith('userData')->where(['{{user}}.id'=>\Yii::$app->user->id])->one();
        }
        if($user->userData->load(Yii::$app->request->post())){
            if($user->userData->validate()){
                $user->userData->save();
            }

            /*if ($model->imageFile = UploadedFile::getInstance($user->userData, 'photo')) {
                $model->userID = $user->id;
                if ($model->upload()) {
                    $user->userData->photo = '/'.$model->savedFilePath;
                    $user->userData->save();
                    // file is uploaded successfully
                }
            }*/
        }
        return $this->render('profile', [
            'user' => $user,
            'userData' => $user->userData,
//            'photoModel' => $model
        ]);
    }
    
    public function actionUploadPhoto() {
        if(\Yii::$app->request->isAjax){
            $model = new UploadPhotoForm();
            $user = User::find()->joinWith('userData')->where(['{{user}}.id'=>\Yii::$app->user->id])->one();
            \Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
            if ($model->imageFile = $_FILES['photo']) {
                $model->userID = $user->id;
                if ($model->upload()) {
                    $user->userData->photo = '/'.$model->savedFilePath;
                    $user->userData->save();
                    // file is uploaded successfully
                    return true;
                }else{
                    return false;
                }
            }
        }
    }

    /**
     * Displays a single UserData model.
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
     * Updates an existing UserData model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Finds the UserData model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return UserData the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = UserData::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
