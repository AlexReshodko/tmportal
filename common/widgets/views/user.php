<?php
use yii\helpers\Html;
use common\helpers\AvatarHelper;?>
<div class="user">
    <div class="photo">
        <img src="<?=AvatarHelper::getAvatarUrl($photo)?>"  />
    </div>
    <div class="info text-center">
        <?=$name?>
    </div>
</div>