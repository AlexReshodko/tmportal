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
    
    public function getValuesNames(){
        $values = [];
        foreach ($this->pollValues as $pollValue) {
            array_push($values, $pollValue->value);
        }
        return join("\n", $values);
    }
}

class PollQuery extends \yii\db\ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['status' => UtilsHelper::STATUS_ACTIVE]);
    }
}