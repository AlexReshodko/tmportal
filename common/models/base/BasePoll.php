<?php

namespace common\models\base;

use Yii;

/**
 * This is the model class for table "poll".
 *
 * @property integer $id
 * @property string $title
 * @property integer $status
 *
 * @property PollValue[] $pollValues
 */
class BasePoll extends \yii\db\ActiveRecord
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
            [['status'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('Poll', 'ID'),
            'title' => Yii::t('Poll', 'Title'),
            'status' => Yii::t('Poll', 'Status'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPollValues()
    {
        return $this->hasMany(\common\models\PollValue::className(), ['poll_id' => 'id']);
    }
}
