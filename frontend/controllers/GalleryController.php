<?php

namespace frontend\controllers;

class GalleryController extends \yii\web\Controller
{
    public function actionDelete()
    {
        return $this->render('delete');
    }

    public function actionIndex()
    {
        $events = \common\models\CompanyEvents::find()->joinWith('photos')->all();
        return $this->render('index',[
            'events' => $events
        ]);
    }

    public function actionView()
    {
        return $this->render('view');
    }

}
