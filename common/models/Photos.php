<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "photos".
 *
 * @property integer $id
 * @property integer $event_id
 * @property string $name
 * @property string $description
 * @property string $path
 * @property string $thumb_path
 *
 * @property CompanyEvents $event
 */
class Photos extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['event_id'], 'integer'],
            [['description'], 'string'],
            [['name', 'path', 'thumb_path'], 'string', 'max' => 255],
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => CompanyEvents::className(), 'targetAttribute' => ['event_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('Photos', 'ID'),
            'event_id' => Yii::t('Photos', 'Event ID'),
            'name' => Yii::t('Photos', 'Name'),
            'description' => Yii::t('Photos', 'Description'),
            'path' => Yii::t('Photos', 'Path'),
            'thumb_path' => Yii::t('Photos', 'Thumb Path'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(CompanyEvents::className(), ['id' => 'event_id']);
    }
}
