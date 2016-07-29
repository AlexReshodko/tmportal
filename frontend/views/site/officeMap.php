<?php
$this->title = Yii::t('pageTitle', 'Office map');
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
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <?= common\widgets\UsersListWidget::widget();?>
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
                userInfo = $("#office-workers .user-cb[data-place="+placeID+"]").data();
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
        if($("#office-workers .user-cb[data-place="+placeID+"]").is(':checked')){
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