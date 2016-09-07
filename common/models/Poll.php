<?php

namespace common\models;

use common\helpers\UtilsHelper;

/**
 * This is the model class for table "poll".
 *
 * @property integer $id
 * @property string $title
 * @property integer $active
 *
 * @property PollValue[] $pollValues
 */
class Poll extends base\BasePoll
{
    
    public static function find()
    {
        return new PollQuery(get_called_class());
    }
}

class PollQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['active' => UtilsHelper::STATUS_TRUE]);
    }
}