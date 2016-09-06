<?php

namespace common\models;

use Yii;

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
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'poll';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string'],
            [['active'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('UserData', 'ID'),
            'title' => Yii::t('UserData', 'Title'),
            'active' => Yii::t('UserData', 'Active'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPollValues()
    {
        return $this->hasMany(PollValue::className(), ['poll_id' => 'id']);
    }
}
