<?php
namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;
use common\models\CompanyEvent;

class UploadForm extends Model
{
    /**
     * @var UploadedFile[]
     */
    public $eventID;
    public $imageFiles;
    public $saveFilename;

    public function rules()
    {
        return [
            [['imageFiles'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg', 'maxFiles' => 20],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $eventsDir = CompanyEvent::getEventsDirPath();
            if(!is_dir($eventsDir . $this->eventID . '/photos/thumb/')){
                mkdir($eventsDir . $this->eventID . '/photos/thumb/', 0777, true);
            }
            foreach ($this->imageFiles as $file) {
                    $this->saveFilename = $file->baseName . '.' . $file->extension;
                if(!file_exists($eventsDir . $this->eventID . '/photos/' . $this->saveFilename)){
                    $file->saveAs($eventsDir . $this->eventID . '/photos/' . $this->saveFilename);
                    $image = \Yii::$app->image->load($eventsDir . $this->eventID . '/photos/' . $this->saveFilename);
                    $image->resize(
                        \Yii::$app->params['thumbnail']['width'],
                        \Yii::$app->params['thumbnail']['height']
                    )->save($eventsDir . $this->eventID . '/photos/thumb/' . $this->saveFilename);
                
                    $photoModel = new \common\models\Photo();
                    $photoModel->setAttributes([
                        'event_id' => $this->eventID,
                        'name' => $this->saveFilename,
                        'path' => CompanyEvent::getEventPhotosRelPath($this->eventID).$this->saveFilename,
                        'thumb_path' => CompanyEvent::getEventPhotosRelPath($this->eventID, true).$this->saveFilename
                    ]);
                    if(!$photoModel->save()){
                        echo $photoModel->getErrors();
                    }
                }
            }
            return true;
        } else {
            return false;
        }
    }
}