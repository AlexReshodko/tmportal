<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "job_positions".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $icon_path
 *
 * @property UserData[] $userDatas
 */
class JobPositions extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job_positions';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['description'], 'string'],
            [['name', 'icon_path'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('UserData', 'ID'),
            'name' => Yii::t('UserData', 'Name'),
            'description' => Yii::t('UserData', 'Description'),
            'icon_path' => Yii::t('UserData', 'Icon Path'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserDatas()
    {
        return $this->hasMany(UserData::className(), ['position_id' => 'id']);
    }
}
