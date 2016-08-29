<ul class="news">
    <?php foreach ($news as $article): ?>
    <li class="card news-panel">
        <div class="news-heading text-center">
            <h4 class="header"><a href="#"><?= $article->title ?></a></h4>
        </div>
        <div class="news-body">
            <p><?= $article->text?></p>
        </div>
        <hr/>
        <div class="stats">
            <div class="row">
                <div class="col-md-9">
                    <div class="text-left">
                        <i class="ti-user"></i>&nbsp;<?= $article->author->username?>&nbsp;&nbsp;&nbsp;&nbsp;
                        <i class="ti-calendar"></i>&nbsp;<?= common\helpers\UtilsHelper::getFormattedDate($article->date)?>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="text-right">
                        <a href="<?= \yii\helpers\Url::to('/news/view/'.$article->id)?>">
                            <?= Yii::t('app-news', 'Read more...')?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        </li>
    <?php endforeach; ?>
</ul>