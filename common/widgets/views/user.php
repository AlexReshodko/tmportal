<?php
use yii\helpers\Html;
use common\helpers\UserHelper; ?>
<div class="user">
    <div class="photo">
        <img src="<?= UserHelper::getAvatarUrl($photo) ?>"  />
    </div>
    <div class="info text-center">
        <?=$name?>
    </div>
</div>