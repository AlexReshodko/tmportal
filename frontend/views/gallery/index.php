<?php
/* @var $this yii\web\View */
?>
<h1>gallery/index</h1>

<p>
    You may change the content of this page by modifying
    the file <code><?= __FILE__; ?></code>.
</p>
<?php foreach ($events as $event): ?>
<div class="col-xs-3">
    <div class="card">
        <div class="content text-center">
            <?= yii\helpers\Html::a($event->name, ['/gallery/view/'.$event->id]) ?>
        </div>
    </div>
</div>
<?php endforeach; ?>
