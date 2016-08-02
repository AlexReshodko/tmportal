<?php 
use common\helpers\UserHelper;
?>
<div class="card card-header">
    <div class="header text-center">
        <h4 class="title"><?=  Yii::t('app', 'Users')?></h4>
    </div>
    <div class="form-horizontal">
        <fieldset>
            <div>
                <div class="col-sm-2"></div>
                <div class="col-sm-8">
                    <input type="text" placeholder="Search" class="form-control" id="list-search">
                </div>
                <div class="col-sm-2"></div>
            </div>
        </fieldset>
    </div>
</div>
<div class="card users-list">
    <div class="content">
        <ul id="office-workers" class="list-unstyled team-members">
            <?php foreach ($users as $user): ?>
                <label class="user" for="<?='user_'.$user->id?>">
                    <li>
                        <div class="row">
                            <div class="col-xs-3">
                                <div class="avatar">
                                    <img src="<?= UserHelper::getAvatarUrl($user->userData->photo)?>" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                </div>
                            </div>
                            <div class="col-xs-9 name"><?= $user->userData->getFullName()?></div>
                            <?=  yii\helpers\Html::checkbox('user_'.$user->id, false, [
                                'id' => 'user_'.$user->id,
                                'class' => 'user-cb',
                                'hidden' => true,
                                'data-fname' => $user->userData->first_name,
                                'data-lname' => $user->userData->last_name,
                                'data-photo' => UserHelper::getAvatarUrl($user->userData->photo),
                                'data-place' => $user->userData->map_place
                            ])?>
                        </div>
                    </li>
                </label>
            <?php endforeach;?>
        </ul>
    </div>
</div>
<script>
$("#list-search").on('input', function(){
    var search = $(this).val();
    $('.name:not(:containsi('+search+'))').parents('.user').hide();
    $('.name:containsi('+search+')').parents('.user').show();
});
</script>