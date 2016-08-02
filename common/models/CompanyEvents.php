<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "company_events".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $date
 * @property string $thumbnail
 *
 * @property Photos[] $photos
 */
class CompanyEvents extends \yii\db\ActiveRecord
{
    public $imageFile;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'company_events';
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhotos()
    {
        return $this->hasMany(Photos::className(), ['event_id' => 'id']);
    }
}
