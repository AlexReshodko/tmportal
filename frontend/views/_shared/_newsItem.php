<li class="card">
    <div class="news-heading text-center">
        <h4 class="header"><a href="<?= \yii\helpers\Url::to('/news/view/'.$model->id)?>"><?= $model->title ?></a></h4>
    </div>
    <div class="content">
        <p><?= $model->text_preview?></p>
    </div>
    <div class="card-footer">
        <hr/>
        <div class="stats">
            <div class="row">
                <div class="col-md-9">
                    <div class="text-left">
                        <i class="ti-user"></i>&nbsp;<?= $model->author->username?>&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="ti-calendar"></i>&nbsp;<?= common\helpers\UtilsHelper::getFormattedDate($model->date)?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-right">
                        <a href="<?= \yii\helpers\Url::to('/news/view/'.$model->id)?>">
                            <?= Yii::t('app-news', 'Read more...')?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>