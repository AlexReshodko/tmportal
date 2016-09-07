<?php

namespace common\models;

/**
 * Description of UserPollValue
 *
 * @author AlexR
 */
class UserPollValue extends base\BaseUserPollValue{
    
    public function rules() {
        return [
            [['user_id', 'poll_value_id'], 'required', 'message' => \Yii::t('errors', 'Please select your variant')],
            [['user_id', 'poll_value_id'], 'integer'],
            [['poll_value_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\PollValue::className(), 'targetAttribute' => ['poll_value_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => \common\models\User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }
}
