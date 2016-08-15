<?php

namespace backend\controllers;

use Yii;
use common\models\CompanyEvents;
use common\models\CompanyEventsSearch;
use common\models\UploadForm;
use yii\web\UploadedFile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EventsController implements the CRUD actions for CompanyEvents model.
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
     * Lists all CompanyEvents models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new CompanyEventsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single CompanyEvents model.
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
     * Creates a new CompanyEvents model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new CompanyEvents();

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
     * Updates an existing CompanyEvents model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
//        $tmpThumbnail = $model->thumbnail;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            $model->thumbnail = $tmpThumbnail;
            $photo = UploadedFile::getInstance($model, 'thumbnail');
            $hasPhoto = $photo && $photo->tempName;
//            \common\helpers\Logger::warn($hasPhoto);
            if ($hasPhoto) {
                $model->thumbnail = $photo;
            }
//            \common\helpers\Logger::warn($model);
            if ($model->validate() && $model->save()) {
                if($hasPhoto)$model->uploadPreview();
                return $this->redirect(['view', 'id' => $model->id]);
            }else{
                var_dump($model->getErrors());exit;
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing CompanyEvents model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionAddPhotos($id){
        $model = new UploadForm();
        $eventModel = $this->findModel($id);
        
        if (Yii::$app->request->isPost) {
            $model->eventID = $eventModel->id;
            $model->imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            if ($model->upload()) {
                // file is uploaded successfully
                return $this->redirect(['index']);
            }
        }

        return $this->render('addPhotos', ['model' => $model]);
    }

    /**
     * Finds the CompanyEvents model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CompanyEvents the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CompanyEvents::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
