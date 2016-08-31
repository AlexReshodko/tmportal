<ul class="news">
    <?php foreach ($news as $article): ?>
    <li class="card">
        <div class="news-heading text-center">
            <h4 class="header"><a href="#"><?= $article->title ?></a></h4>
        </div>
        <div class="content">
            <p><?= $article->text_preview?></p>
        </div>
        <div class="card-footer">
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
        </div>
    </li>
    <?php endforeach; ?>
</ul>
<?php if(empty($news)):?>
    <h3 class="text-center">No articles</h3>
<?php elseif (Yii::$app->controller->id == 'site'): ?>
    <h6 class="text-right">
        <a href="<?= \yii\helpers\Url::to('/news')?>">
            All news <i class="ti-angle-double-right"></i>
        </a>
    </h6>
<?php endif; ?>