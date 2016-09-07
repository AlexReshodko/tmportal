<?php

namespace common\widgets;

use yii\helpers\ArrayHelper;

/**
 * Description of PollWidget
 *
 * @author AlexR
 */
class PollWidget extends \yii\base\Widget{
    
    public $poll;
    public $isVoted = false;
    
    public function init()
    {
        parent::init();
        $this->poll = \common\models\Poll::find()->with('pollValues')->active()->one();
        if(!empty($this->poll)){
            $pollIDs = ArrayHelper::getColumn($this->poll->pollValues, 'id');
            $this->isVoted = !empty(\common\models\UserPollValue::find()->where(['user_id'=>\Yii::$app->user->id, 'poll_value_id'=>$pollIDs])->one());
        }
    }

    public function run()
    {
        $model = new \common\models\UserPollValue();
        return $this->render('poll', [
            'widget' => $this,
            'model' => $model
        ]);
    }
    
    public function getResults(){
        $max = \common\models\User::find()->where(['status'=>\common\models\User::STATUS_ACTIVE])->count();
        foreach ($this->poll->pollValues as $pollValue) {
            $cnt = count($pollValue->userPollValues);
            $percent = round(($cnt / $max) * 100);
            echo $this->render('_pollResults', [
                'label' => $pollValue->value,
                'cnt' => $cnt,
                'max' => $max,
                'percent' => $percent,
            ]);
        }
    }
    
    public function getVotedValue(){
        $votedPollValue = \common\models\PollValue::find()->joinWith([
            'userPollValues' => function ($query) {
                $query->andWhere(['user_id' => \Yii::$app->user->id]);
            },
        ])->one();
        return $votedPollValue->value;
    }
}
