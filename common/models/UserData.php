<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "user_data".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $office_id
 * @property string $first_name
 * @property string $last_name
 * @property string $position
 * @property string $phone
 * @property string $skype
 * @property string $work_start_date
 * @property string $birthday
 * @property string $comment
 * @property string $photo
 * @property integer $map_place
 *
 * @property Office $office
 * @property User $user
 */
class UserData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_data';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'required'],
            [['user_id', 'office_id', 'map_place'], 'integer'],
            [['work_start_date', 'birthday'], 'safe'],
            [['comment'], 'string'],
            [['first_name', 'last_name', 'position', 'phone', 'skype', 'photo'], 'string', 'max' => 255],
            [['office_id'], 'exist', 'skipOnError' => true, 'targetClass' => Office::className(), 'targetAttribute' => ['office_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('UserData', 'ID'),
            'user_id' => Yii::t('UserData', 'User ID'),
            'office_id' => Yii::t('UserData', 'Office ID'),
            'first_name' => Yii::t('UserData', 'First Name'),
            'last_name' => Yii::t('UserData', 'Last Name'),
            'position' => Yii::t('UserData', 'Position'),
            'phone' => Yii::t('UserData', 'Phone'),
            'skype' => Yii::t('UserData', 'Skype'),
            'work_start_date' => Yii::t('UserData', 'Work Start Date'),
            'birthday' => Yii::t('UserData', 'Birthday'),
            'comment' => Yii::t('UserData', 'Comment'),
            'photo' => Yii::t('UserData', 'Photo'),
            'map_place' => Yii::t('UserData', 'Map Place'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOffice()
    {
        return $this->hasOne(Office::className(), ['id' => 'office_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
