<?php
namespace common\models;

use yii\base\Model;
use yii\web\UploadedFile;

class UploadPhotoForm extends Model
{
    /**
     * @var UploadedFile
     */
    public $imageFile;
    public $userID;
    public $savedFilePath;

    public function rules()
    {
        return [
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }
    
    public function upload()
    {
        if ($this->validate()) {
            $userDir = 'uploads/avatars/' . $this->userID . '/';
            if(!is_dir($userDir)){
                mkdir($userDir);
            }
            $this->savedFilePath = $userDir . 'avatar' . '.jpg';
            move_uploaded_file($this->imageFile["tmp_name"], $this->savedFilePath);
//            $this->imageFile->saveAs($this->savedFilePath);
            $image = \Yii::$app->image->load($this->savedFilePath);
            $image->resize(200,200)->save($this->savedFilePath);
            return true;
        } else {
            return false;
        }
    }
}