<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "user_poll_value".
 *
 * @property integer $id
 * @property integer $user_id
 * @property integer $poll_value_id
 *
 * @property PollValue $pollValue
 * @property User $user
 */
class BaseUserPollValue extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user_poll_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'poll_value_id'], 'integer'],
            [['poll_value_id'], 'exist', 'skipOnError' => true, 'targetClass' => PollValue::className(), 'targetAttribute' => ['poll_value_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('UserPollValue', 'ID'),
            'user_id' => Yii::t('UserPollValue', 'User ID'),
            'poll_value_id' => Yii::t('UserPollValue', 'Poll Value ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPollValue()
    {
        return $this->hasOne(PollValue::className(), ['id' => 'poll_value_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
