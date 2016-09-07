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

}
