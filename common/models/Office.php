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
            'id' => 'ID',
            'code' => 'Code',
            'name' => 'Name',
            'address' => 'Address',
            'open_date' => 'Open Date',
            'photo' => 'Photo',
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
