<?php

namespace backend\controllers;

use Yii;
use common\models\CompanyEvent;
use common\models\UploadForm;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EventsController implements the CRUD actions for CompanyEvent model.
 */
class EventsController extends Controller
{
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
     * Lists all CompanyEvent models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new \yii\data\ActiveDataProvider([
            'query' => CompanyEvent::find()->active(),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CompanyEvent model.
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
     * Creates a new CompanyEvent model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CompanyEvent();

        if ($model->load(Yii::$app->request->post())) {

            $photo = UploadedFile::getInstance($model, 'thumbnail');
            $hasPhoto = $photo && $photo->tempName;
            if ($hasPhoto) {
                $model->thumbnail = $photo;
            }
            if ($model->validate() && $model->save()) {
                if($hasPhoto)$model->uploadPreview();
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                var_dump($model->getErrors());exit;
            }
            return $this->redirect(['create', 'model' => $model]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing CompanyEvent model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            $photo = UploadedFile::getInstance($model, 'thumbnail');
            $hasPhoto = $photo && $photo->tempName;
            if ($hasPhoto) {
                $model->thumbnail = $photo;
            }
            if ($model->validate() && $model->save()) {
                if($hasPhoto)$model->uploadPreview();
            }else{
                \common\helpers\Logger::warn($model->getErrors());
            }
            return $this->redirect(['index']);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CompanyEvent model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $event = $this->findModel($id);
        if(!$event){
            throw new NotFoundHttpException('Wrong event ID');
        }
        $event->deleted = CompanyEvent::STATUS_DELETED;
        if(!$event->save()){
            \common\helpers\Logger::warn($event->getErrors());
        }

        return $this->redirect(['index']);
    }
    
    /**
     * Add photos to event
     * @param type $id
     * @return type
     */
    public function actionAddPhotos($id){
        $model = new UploadForm();
        $eventModel = $this->findModel($id);
        
        if (Yii::$app->request->isPost) {
            $model->eventID = $eventModel->id;
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if ($model->upload()) {
                return $this->redirect(['index']);
            }
        }

        return $this->render('addPhotos', ['model' => $model]);
    }

    /**
     * Finds the CompanyEvent model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CompanyEvent the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CompanyEvent::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
