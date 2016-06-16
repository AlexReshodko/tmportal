<?php
use common\helpers\AvatarHelper;
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="header text-center">
                    <h4 class="title"><?=Yii::t('app', 'Office map')?></h4>
                    <!--<p class="category">Last Campaign Performance</p>-->
                </div>
                <div class="content text-center">
                    <svg id="svg"
                         width="100%"
                         height="100%"
                         viewBox="0 0 799.98339 599.99578"
                         ></svg>
                    <!--<object data="<?='/data/office_scheme_clear_op.svg'?>" type="image/svg+xml" id="officemap" style="width: 100%;height:100%"></object>-->
                    <div class="footer">
                        <hr>
                        <div class="stats">
                            <i class="ti-timer"></i> Campaign sent 2 days ago
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card ">
                <div class="header text-center">
                    <h4 class="title"><?=  Yii::t('app', 'Users')?></h4>
                    <!--<p class="category">All products including Taxes</p>-->
                </div>
                <div class="content">
                    <ul id="office-map-workers" class="list-unstyled team-members">
                        <?php foreach ($users as $user): ?>
                            <label class="user" for="<?='user_'.$user->id?>">
                                <li>
                                    <div class="row">
                                        <div class="col-xs-3">
                                            <div class="avatar">
                                                <img src="<?= AvatarHelper::getAvatarUrl($user->userData->photo)?>" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                            </div>
                                        </div>
                                        <div class="col-xs-9 name">
                                            <?= $user->userData->first_name?>
                                            <?= $user->userData->last_name?>
                                        </div>
                                        <?=  yii\helpers\Html::checkbox('user_'.$user->id, false, [
                                            'id' => 'user_'.$user->id,
                                            'class' => 'user-cb',
                                            'hidden' => true,
                                            'data-fname' => $user->userData->first_name,
                                            'data-lname' => $user->userData->last_name,
                                            'data-photo' => AvatarHelper::getAvatarUrl($user->userData->photo),
                                            'data-place' => $user->userData->map_place
                                        ])?>
                                    </div>
                                </li>
                            </label>
                        <?php endforeach;?>
                        </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
// Office map object
OMap = {
    tooltips: {},
    svgURL: '/data/office_scheme_clear_op.svg',
    svg: Snap("#svg"),
    mainLayer: null,
    init: function(callback_fn){
        Snap.load(OMap.svgURL, function(svg){
            OMap.svg.append(svg);
            OMap.mainLayer = OMap.svg.select('#layer1');
            if(typeof callback_fn == "function"){
                callback_fn();
            }else{
                throw new Error("Provide callback function");
                return;
            }
        });
    },
    showTooltip: function(e){
        if(!OMap.tooltips[this.attr('id')]){
            var bb = this.getBBox(),
                tooltip = null,
                placeID = Utils.getID(this.attr('id')),
                tbb = OMap.svg.select("#tooltip-template").getBBox(),
                userInfo = $("#office-map-workers .user-cb[data-place="+placeID+"]").data();
            if(userInfo){
                var x = bb.x > 0 ? bb.x - tbb.w/2 + bb.w/2 : bb.x - tbb.w/2 + bb.w/2;
                var y = bb.y > 0 ? bb.y - (tbb.h+5): bb.y - (tbb.h+5);

                tooltip = OMap.svg.select("#tooltip-template").clone();
                tooltip.transform("t"+(x-tbb.x)+","+(y-tbb.y + 5));
                tooltip.select('.fname').node.innerHTML = userInfo.fname || '';
                tooltip.select('.lname').node.innerHTML = userInfo.lname || '';
                tooltip.select('.user-image').attr({'xlink:href':userInfo.photo});
                OMap.tooltips[this.attr('id')] = tooltip;
                OMap.svg.add(tooltip);
                tooltip.animate({opacity:1}, 200);
            }
        }
    },
    hideTooltip: function(e){
        var tooltip = OMap.tooltips[this.attr('id')];
        if(!tooltip) return;
        var placeID = Utils.getID(this.attr('id'));
        if($("#office-map-workers .user-cb[data-place="+placeID+"]").is(':checked')){
            return;
        }
        if(e === "cb" || (e && e !== "cb" && !Snap(e.toElement).hasClass('user-element'))){
            tooltip.remove();
            delete OMap.tooltips[this.attr('id')];
        }
    }
}
OMap.init(function(){
    $.each(OMap.svg.selectAll(".user"), function(){
        this.hover(OMap.showTooltip,OMap.hideTooltip);
    });
});
$('.user-cb').on('change',function(){
    console.log(this.getAttribute('data-place'));
    if (!this.getAttribute('data-place')) return;
    if (this.checked) {
        OMap.showTooltip.call(OMap.svg.select("#place_"+this.getAttribute('data-place')))
    } else {
        OMap.hideTooltip.call(OMap.svg.select("#place_"+this.getAttribute('data-place')), 'cb');
    }
    $(this).parents('li').toggleClass('selected', this.checked);
});
</script>