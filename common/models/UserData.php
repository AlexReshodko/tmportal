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
 * @property string $work_start_date
 * @property string $comment
 * @property string $photo
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
            [['user_id', 'office_id', 'work_start_date'], 'required'],
            [['user_id', 'office_id'], 'integer'],
            [['work_start_date'], 'safe'],
            [['comment'], 'string'],
            [['first_name', 'last_name', 'position', 'photo'], 'string', 'max' => 255],
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
            'id' => 'ID',
            'user_id' => 'User ID',
            'office_id' => 'Office ID',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'position' => 'Position',
            'work_start_date' => 'Work Start Date',
            'comment' => 'Comment',
            'photo' => 'Photo',
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
