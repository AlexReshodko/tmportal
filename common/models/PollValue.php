<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "poll_value".
 *
 * @property integer $id
 * @property integer $poll_id
 * @property string $value
 *
 * @property Poll $poll
 * @property UserPollValue[] $userPollValues
 */
class PollValue extends base\BasePollValue
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'poll_value';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['poll_id'], 'integer'],
            [['value'], 'string'],
            [['poll_id'], 'exist', 'skipOnError' => true, 'targetClass' => Poll::className(), 'targetAttribute' => ['poll_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('UserData', 'ID'),
            'poll_id' => Yii::t('UserData', 'Poll ID'),
            'value' => Yii::t('UserData', 'Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPoll()
    {
        return $this->hasOne(Poll::className(), ['id' => 'poll_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPollValues()
    {
        return $this->hasMany(UserPollValue::className(), ['poll_value_id' => 'id']);
    }
}
