<div class="container-fluid">
    <div class="row">
        <div class="<?= $params['showList'] ? 'col-md-9' : 'col-md-12'?>">
            <div class="card">
                <div class="header text-center">
                    <h4 class="title"><?=Yii::t('app', 'Office map')?></h4>
                </div>
                <div class="content text-center">
                    <svg id="svg"
                        width="100%"
                        height="100%"
                        viewBox="0 0 799.98339 599.99578"
                    ></svg>
                </div>
            </div>
        </div>
        <div class="col-md-3 <?php if(!$params['showList']): ?>hidden<?php endif; ?>">
            <?= common\widgets\UsersListWidget::widget();?>
        </div>
    </div>
    <?php if(!$params['showList']): ?>
        <input id="user-edit" type="hidden" value="1" />
    <?php endif; ?>
</div>
<script>
// Office map object
OMap = {
    tooltips: {},
    svgURL: '/data/office_scheme_clear_op.svg',
    svg: Snap("#svg"),
    isEdit: $('#user-edit').length,
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
    initEdit: function(){
        var placeID;
        this.click(function(){
            placeID = Utils.getID(this.attr('id'));
            if(!OMap.getUserInfo(this)){
                OMap.setPlace(placeID);
            }else{
                NotificationManager.showMessage('danger','Place used');
            }
        });
    },
    setPlace: function(placeID){
        var selected = OMap.svg.select('.selected');
        if(selected){
            selected.removeClass('selected');
        }
        OMap.svg.select('#place_'+placeID).select('.user-element.bg').addClass('selected');
        $('#userdata-map_place').val(placeID);
        NotificationManager.showMessage('success','Place #'+placeID+' selected');
    },
    getUserInfo: function(userElement){
        var placeID = Utils.getID(userElement.attr('id'));
        return $("#office-workers .user-cb[data-place="+placeID+"]").data();
    },
    setMapAvatar: function(userElement){
        var userInfo = OMap.getUserInfo(userElement),
            userElImage = userElement.select('.user-image');
        if(userInfo && userElImage){
            userElImage.attr({'xlink:href':userInfo.photo});
            userElImage.animate({opacity:1}, 200);
        }
    },
    showTooltip: function(e){
        if(!OMap.tooltips[this.attr('id')]){
            var bb = this.getBBox(),
                tooltip = null,
                tbb = OMap.svg.select("#tooltip-template").getBBox(),
                userInfo = OMap.getUserInfo(this);
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
};
OMap.init(function(){
    $.each(OMap.svg.selectAll(".user"), function(){
//        console.log(OMap.getUserInfo(this));
        OMap.setMapAvatar(this);
        this.hover(OMap.showTooltip,OMap.hideTooltip);
        if(OMap.isEdit){
            OMap.initEdit.call(this);
        }
    });
});
</script>