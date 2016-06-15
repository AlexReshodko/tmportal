<?php
use yii\helpers\Html;
use common\helpers\AvatarHelper;?>
<div class="avatar border-white" style="background-image:url(<?=AvatarHelper::getAvatarUrl($photo)?>)"></div>
<h4 class="title">Hello, <?=$name?></h4>