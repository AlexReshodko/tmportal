<?php

namespace common\models;

use Yii;
use common\helpers\UtilsHelper;

/**
 * This is the model class for table "company_events".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $date
 * @property string $thumbnail
 * @property integer $published 
 * @property integer $deleted 
 *
 * @property Photos[] $photos
 */
class CompanyEvents extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = NULL;
    const STATUS_DELETED = 1;

    public $imageFile;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_events';
    }
    
    public function scenarios()
    {
        return array(
            self::SCENARIO_DEFAULT => array('name','description','date','published','!thumbnail'),
        );
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['date'], 'safe'],
            [['name'], 'string', 'max' => 255],
            [['published', 'deleted'], 'integer'],
            [['thumbnail'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('CompanyEvents', 'ID'),
            'name' => Yii::t('CompanyEvents', 'Name'),
            'description' => Yii::t('CompanyEvents', 'Description'),
            'date' => Yii::t('CompanyEvents', 'Date'),
            'thumbnail' => Yii::t('CompanyEvents', 'Thumbnail'),
            'published' => Yii::t('UserData', 'Published'),
            'deleted' => Yii::t('UserData', 'Deleted'),
        ];
    }
    
    public static function find()
    {
        return new CompanyEventsQuery(get_called_class());
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(Photos::className(), ['event_id' => 'id']);
    }
    
    public static function getEventsDirPath(){
        $dir = Yii::getAlias('@frontend/web/uploads/events/');
        if (!is_dir($dir)) {
            mkdir($dir);
        }
        return $dir;
    }
    
    public static function getEventsRelPath(){
        return '/uploads/events/';
    }
    
    public static function getEventRelPath($id){
        if(!is_dir(self::getEventsDirPath().$id)){
            mkdir(self::getEventsDirPath().$id);
        }
        return '/uploads/events/' . $id . '/';
    }

    /**
    * Returns event photos relative path
     * @param integer $id event id
     * @param boolean $thumb is thumb path
     * @return string '/uploads/events/' . $id . '/photos/'
     */
    public static function getEventPhotosRelPath($id, $thumb = false){
        if(!is_dir(self::getEventsDirPath(). $id . '/photos/')){
            mkdir(self::getEventsDirPath(). $id . '/photos/');
        }
        return '/uploads/events/' . $id . '/photos/' . ($thumb ? 'thumb/' : '');
    }
    
    public function uploadPreview(){
        $dir = self::getEventsDirPath();
        $fileName = 'thumbnail' . '.' . $this->thumbnail->extension;
        if(!is_dir($dir . $this->id)){
            mkdir($dir . $this->id);
        }
        $this->thumbnail->saveAs($dir . $this->id . '/' . $fileName);
        $image = \Yii::$app->image->load($dir . $this->id . '/' . $fileName);
        $image->resize(Yii::$app->params['thumbnail']['width'], Yii::$app->params['thumbnail']['height'])->save($dir . $this->id . '/' . $fileName);
        $this->thumbnail = self::getEventRelPath($this->id) . $fileName;
        $this->update();
    }
}

class CompanyEventsQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['published' => UtilsHelper::STATUS_PUBLISHED, 'deleted' => UtilsHelper::STATUS_NOT_DELETED]);
    }
}