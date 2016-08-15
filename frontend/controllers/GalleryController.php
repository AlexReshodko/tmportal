<?php

namespace frontend\controllers;

use common\models\CompanyEvents;

class GalleryController extends \yii\web\Controller
{
    public function actionDelete()
    {
        return $this->render('delete');
    }

    public function actionIndex()
    {
        $events = CompanyEvents::find()->innerJoinWith('photos')->all();
        return $this->render('index',[
            'events' => $events
        ]);
    }
    
    public function actionCreatePreviews($id){
        if(empty($id)){
            throw new NotFoundHttpException('Please provide event ID');
        }
        $photosDir = 'uploads/photos/'.$id;
        if(is_dir($photosDir)){
            foreach (new \DirectoryIterator($photosDir) as $fileInfo) {
                if ($fileInfo->isDot() || $fileInfo->isDir())continue;
                echo $fileInfo->getFilename() . "<br>\n";
//                $ext = '.'.$fileInfo->getExtension();
                $fname = $fileInfo->getFilename();
                $fpath = $fileInfo->getPathname();
                $image = \Yii::$app->image->load($fileInfo->getRealPath());
                if(!is_dir($photosDir.'/thumb/')){
                    mkdir($photosDir.'/thumb/');
                }
                $thumbPath = $photosDir.'/thumb/'.$fname;
                $image->resize(150,150, \yii\image\drivers\Image::HEIGHT)->save($thumbPath);
                $photoModel = new \common\models\Photos();
                $photoModel->setAttributes([
                    'event_id' => $id,
                    'name' => $fname,
                    'path' => '/'.$fpath,
                    'thumb_path' => '/'.$thumbPath
                ]);
                if($photoModel->save()){
                    echo 'Success';
                }else{
                    echo $photoModel->getErrors();
                }
            }
        }else{
            echo 'Error. Directory not exists';
        }
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
