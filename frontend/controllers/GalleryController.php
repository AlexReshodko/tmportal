<?php

namespace frontend\controllers;

use common\models\CompanyEvents;
use yii\web\NotFoundHttpException;

class GalleryController extends \yii\web\Controller
{
    public function actionDelete()
    {
        return $this->render('delete');
    }

    public function actionIndex()
    {
        $events = CompanyEvents::find()->active()->innerJoinWith('photos')->all();
        return $this->render('index',[
            'events' => $events
        ]);
    }

    public function actionView($id)
    {
        $event = $this->findModel($id);
        $eventPhotos = $event->photos;
        $photos = [];
        foreach ($eventPhotos as $photo) {
            array_push($photos, [
                'url' => $photo->path,
                'src' => $photo->thumb_path,
                'options' => array('title' => $photo->name)
            ]);
        }
        return $this->render('view', [
            'event' => $this->findModel($id),
            'photos' => $photos
        ]);
    }
    
    protected function findModel($id)
    {
        if (($model = CompanyEvents::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

}
