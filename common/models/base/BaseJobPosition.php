<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "job_position".
 *
 * @property integer $id
 * @property string $name
 * @property string $description
 * @property string $icon_path
 *
 * @property UserData[] $userDatas
 */
class BaseJobPosition extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'job_position';
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
            'id' => Yii::t('JobPosition', 'ID'),
            'name' => Yii::t('JobPosition', 'Name'),
            'description' => Yii::t('JobPosition', 'Description'),
            'icon_path' => Yii::t('JobPosition', 'Icon Path'),
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
