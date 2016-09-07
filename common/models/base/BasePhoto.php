<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "photo".
 *
 * @property integer $id
 * @property integer $event_id
 * @property string $name
 * @property string $description
 * @property string $path
 * @property string $thumb_path
 *
 * @property \common\models\CompanyEvent $event
 */
class BasePhoto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'photo';
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
            [['event_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\CompanyEvent::className(), 'targetAttribute' => ['event_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('Photo', 'ID'),
            'event_id' => Yii::t('Photo', 'Event ID'),
            'name' => Yii::t('Photo', 'Name'),
            'description' => Yii::t('Photo', 'Description'),
            'path' => Yii::t('Photo', 'Path'),
            'thumb_path' => Yii::t('Photo', 'Thumb Path'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEvent()
    {
        return $this->hasOne(\common\models\CompanyEvent::className(), ['id' => 'event_id']);
    }
}
