<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\News */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'News', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-view">

    <h1 class="text-center"><?= Html::encode($this->title) ?></h1>

    <div class="card full-page">
        <div class="content">
            <?= $model->text ?>
        </div>
    </div>
</div>
