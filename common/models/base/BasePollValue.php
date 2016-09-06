<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "poll_value".
 *
 * @property integer $id
 * @property integer $poll_id
 * @property string $value
 *
 * @property \common\models\Poll $poll
 * @property UserPollValue[] $userPollValues
 */
class BasePollValue extends \yii\db\ActiveRecord
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
            'id' => Yii::t('PollValue', 'ID'),
            'poll_id' => Yii::t('PollValue', 'Poll ID'),
            'value' => Yii::t('PollValue', 'Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPoll()
    {
        return $this->hasOne(\common\models\Poll::className(), ['id' => 'poll_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPollValues()
    {
        return $this->hasMany(\common\models\UserPollValue::className(), ['poll_value_id' => 'id']);
    }
}
