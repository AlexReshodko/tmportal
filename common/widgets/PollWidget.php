<?php

namespace common\widgets;

use yii\helpers\ArrayHelper;
use common\models\Poll;
use common\models\PollValue;
use common\models\UserPollValue;
use common\models\User;

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
        $this->poll = Poll::find()->with('pollValues')->active()->one();
        if(!empty($this->poll)){
            $pollIDs = ArrayHelper::getColumn($this->poll->pollValues, 'id');
            $this->isVoted = !empty(UserPollValue::find()->where(['user_id'=>\Yii::$app->user->id, 'poll_value_id'=>$pollIDs])->one());
        }
    }

    public function run()
    {
        $model = new UserPollValue();
        return $this->render('poll', [
            'widget' => $this,
            'model' => $model
        ]);
    }
    
    public function getResults(){
        $max = User::find()->where(['status'=>User::STATUS_ACTIVE])->count();
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
        $votedPollValue = PollValue::find()->joinWith([
            'userPollValues' => function ($query) {
                $query->andWhere(['user_id' => \Yii::$app->user->id]);
            },
        ])->one();
        return $votedPollValue->value;
    }
}
