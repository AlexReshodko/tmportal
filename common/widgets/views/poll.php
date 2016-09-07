<?php 
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\Pjax;
//\common\helpers\Logger::warn(ArrayHelper::map($widget->poll->pollValues, 'id', 'value'));
?>
<?php if(!empty($widget->poll)):?>

    <?php Pjax::begin([
        'id'=>'pjax-poll',
        'enablePushState' => false
    ]); ?>
        <span class="text-center"><?= $widget->poll->title?></span>

        <?php if($widget->isVoted): ?>

            <?= $widget->getResults()?>
            <span class="text-muted"><?= Yii::t('poll', 'Your variant: ')?> <?= $widget->getVotedValue()?></span>

        <?php else: ?>

                <?php $form = ActiveForm::begin([
                    'action' => '/site/vote',
                    'options' => ['data-pjax' => true ]
                ])?>

                    <?= $form->field($model, 'poll_value_id')->radioList(ArrayHelper::map($widget->poll->pollValues, 'id', 'value'),[
                        'item' => function ($index, $label, $name, $checked, $value) {
                            return
                            '<label class="radio">' . Html::radio($name, $checked, ['value' => $value, 'data-toggle'=>'radio']) . $label . '</label>';
                        },
                    ])->label(false)?>

                    <div class="text-center">
                        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'hash-button']) ?>
                    </div>

                <?php ActiveForm::end()?>



        <?php endif; ?>
        
    <?php Pjax::end(); ?>
<?php else: ?>
        
    <?= Yii::t('poll', 'No polls')?>
        
<?php endif; ?>