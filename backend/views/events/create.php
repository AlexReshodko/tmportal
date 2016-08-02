<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\CompanyEvents */

$this->title = Yii::t('app', 'Create Company Events');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Company Events'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="company-events-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
