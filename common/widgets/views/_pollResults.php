<div class="row">
    <div class="col-sm-12"><?= $label?> (<?= $percent?>%)</div>
    <div class="col-sm-12">
        <div class="progress">
            <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="<?= $cnt?>" aria-valuemin="0" aria-valuemax="<?= $max?>" style="width: <?= $percent?>%;">
                <span class="sr-only"><?= $percent?>% <?= Yii::t('poll', 'Complete')?></span>
            </div>
        </div>
    </div>
</div>