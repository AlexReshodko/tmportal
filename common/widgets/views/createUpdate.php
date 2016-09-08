<?php use yii\helpers\Html; ?>
<div class="row">
    <div class="col-md-8 col-md-offset-2">
        <div class="panel panel-flat">
            <div class="panel-heading text-center">
                <h1><?= Html::encode($params['title']) ?></h1>
            </div>
            <div class="panel-body">
                <?= $this->renderFile(Yii::getAlias('@backend/views/'.$params['view'].'/').'_form.php', $params['viewParams']) ?>
            </div>
        </div>
    </div>
</div>