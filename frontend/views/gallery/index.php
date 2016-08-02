<?php if (!empty($events)): ?>
    <?php $this->title = Yii::t('pageTitle', 'Gallery'); ?>
    <div class="gallery">
        <div class="row">
            <?php foreach ($events as $event): ?>
                <div class="col-lg-3 col-sm-6">
                    <div class="card">
                        <a class="thumbnail" href="<?= \yii\helpers\Url::to(['/gallery/view/' . $event->id]) ?>">
                            <div class="thumb text-center">
                                <img src="<?= $event->thumbnail; ?>" class="img-rounded" alt="<?= $event->name ?>">
                            </div>
                            <div class="caption">
                                <h6 class="no-margin-top text-semibold"><?= $event->name ?></h6>
                                <?= $event->description ?>
                            </div>
                            <div class="card-footer">
                                <hr />
                                <div class="stats">
                                    <i class="ti-calendar"></i>&nbsp;&nbsp;<?= Yii::$app->formatter->format($event->date, 'date'); ?>&nbsp;&nbsp;
                                    <i class="ti-files"></i>&nbsp;&nbsp;<?= count($event->photos) ?>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
<?php else: ?>
    <h2 class="text-center"><?= Yii::t('emptyData', 'No albums') ?></h2>
<?php endif; ?>
