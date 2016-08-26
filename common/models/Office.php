<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "office".
 *
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property string $address
 * @property string $open_date
 * @property string $photo
 *
 * @property UserData[] $userDatas
 */
class Office extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'office';
    }
    
    public function afterFind() {
        parent::afterFind();
        $this->name = \Yii::t('officeName', $this->name);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'name'], 'required'],
            [['address'], 'string'],
            [['open_date'], 'safe'],
            [['code', 'name', 'photo'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('Office', 'ID'),
            'code' => Yii::t('Office', 'Code'),
            'name' => Yii::t('Office', 'Name'),
            'address' => Yii::t('Office', 'Address'),
            'open_date' => Yii::t('Office', 'Open Date'),
            'photo' => Yii::t('Office', 'Photo'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserDatas()
    {
        return $this->hasMany(UserData::className(), ['office_id' => 'id']);
    }
}
