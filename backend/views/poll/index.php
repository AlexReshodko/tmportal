<?php

use yii\helpers\Html;
use common\components\BackendGridView;
use common\helpers\UtilsHelper;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Polls');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="poll-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('app', 'Create Poll'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= BackendGridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            'id',
            'title:raw',
            UtilsHelper::getStatusGridLabel($dataProvider),

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
