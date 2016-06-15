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
                    <ul id="office-workers" class="list-unstyled team-members">
                        <?php foreach ($users as $user): ?>
                            <li>
                                <div class="row">
                                    <div class="col-xs-3">
                                        <div class="avatar">
                                            <img src="<?=$user->userData->photo?>" alt="Circle Image" class="img-circle img-no-padding img-responsive">
                                        </div>
                                    </div>
                                    <div class="col-xs-6">
                                        <?= $user->userData->first_name?>
                                        <br />
                                        <?= $user->userData->last_name?>
                                    </div>

                                    <div class="col-xs-3 text-right">
                                        <?=  yii\helpers\Html::checkbox('user_'.$user->id, false, [
                                            'id' => 'user_'.$user->id,
                                            'class' => 'user-cb',
                                            'data-fname' => $user->userData->first_name,
                                            'data-lname' => $user->userData->last_name,
                                            'data-photo' => $user->userData->photo,
                                            'data-place' => $user->userData->map_place
                                        ])?>
                                    </div>
                                </div>
                            </li>
                        <?php endforeach;?>
                        </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
jQuery.fn.myAddClass = function (classTitle) {
  return this.each(function() {
    var oldClass = jQuery(this).attr("class");
    oldClass = oldClass ? oldClass : '';
    jQuery(this).attr("class", (oldClass+" "+classTitle).trim());
  });
}
jQuery.fn.myRemoveClass = function (classTitle) {
  return this.each(function() {
      var oldClass = jQuery(this).attr("class");
      var startpos = oldClass.indexOf(classTitle);
      var endpos = startpos + classTitle.length;
      var newClass = oldClass.substring(0, startpos).trim() + " " + oldClass.substring(endpos).trim();
      if (!newClass.trim())
        jQuery(this).removeAttr("class");
      else
        jQuery(this).attr("class", newClass.trim());
  });
}
var svgobject = document.getElementById('officemap');
//var s = Snap(svgobject.contentDocument);
var s = Snap("#svg");
var url = '/data/office_scheme_clear_op.svg';
// SnapObject
SO = {
    tooltip: null,
    tooltipShown: false,
    svgURL: '/data/office_scheme_clear_op.svg',
    svg: Snap("#svg"),
    mainLayer: null,
    init: function(callback_fn){
        Snap.load(SO.svgURL, function(svg){
            SO.svg.append(svg);
            SO.mainLayer = SO.svg.select('#layer1');
            if(typeof callback_fn == "function"){
                callback_fn();
            }else{
                throw new Error("Provide callback function");
                return;
            }
        });
    },
    showTooltip: function(e){
        console.log('in');
        if(!SO.tooltipShown){
            var bb = this.getBBox(),
                tbb = SO.svg.select("#tooltip-template").getBBox(),
                userInfo = $("#office-workers .user-cb[data-place="+Utils.getID(this.attr('id'))+"]").data();
                console.log(userInfo);
            if(userInfo){
                var x = bb.x > 0 ? bb.x - tbb.w/2 + bb.w/2 : bb.x - tbb.w/2 + bb.w/2;
                var y = bb.y > 0 ? bb.y - (tbb.h+5): bb.y - (tbb.h+5);

                SO.tooltip = SO.svg.select("#tooltip-template").clone();
                SO.tooltip.transform("t"+(x-tbb.x - 2)+","+(y-tbb.y + 4));
                SO.tooltip.select('.fname').node.innerHTML = userInfo.fname;
                SO.tooltip.select('.lname').node.innerHTML = userInfo.lname;
                SO.tooltip.select('.user-image').attr({'xlink:href':userInfo.photo});
                SO.svg.add(SO.tooltip);
                SO.tooltip.animate({opacity:1}, 500);
                SO.tooltipShown = true;
            }
        }
    },
    hideTooltip: function(e, forceClose){
        forceClose = forceClose || false;
        console.log('out');
        if((e && !Snap(e.toElement).hasClass('user-element')) || forceClose){
            SO.tooltip.remove();
            SO.tooltipShown = false;
        }
    }
}
SO.init(function(){
    console.log(SO.svg.selectAll("ellipse"));
    $.each(SO.svg.selectAll(".user"), function(){
        this.hover(SO.showTooltip,SO.hideTooltip);
    });
});
$('.user-cb').on('change',function(){
    console.log(this.getAttribute('data-place'));
    if(!this.getAttribute('data-place'))return;
    if (this.checked) {
        SO.showTooltip.call(SO.svg.select("#place_"+this.getAttribute('data-place')))
    } else {
        SO.hideTooltip(null, true);
    }
});
/*jQuery(window).load(function () { // Нам нужно дождаться, пока вся графика (и наша карта тоже) загрузится, поэтому используем window.onload,
    var svgobject = document.getElementById('officemap'); // Находим тег <object>
    console.log(svgobject);
    if ('contentDocument' in svgobject) {              // У нас действительно там что-то есть?
      var svgdom = jQuery(svgobject.contentDocument);  // Получаем доступ к объектной модели SVG-файла
      console.log(svgdom);
      // Теперь делаем свою работу, например:
  //    jQuery("#Place_1", svgdom).css("fill", "red");  // Находим тег с id="figure1" в SVG DOM и заливаем его красным
      console.log(jQuery("#Place_1", svgdom));
    }
    $("#office-workers input[type=checkbox]").on('change', function() {
        var id = Utils.getID($(this).attr("id"));
        if (this.checked) {
          $("#Place_"+id, svgdom).myAddClass("selected");
        } else {
          $("#Place_"+id, svgdom).myRemoveClass("selected");
        }
    });
    svgdom.find("#Place_2").hover(
        function () {
            var id = $(this).attr("id");
            $("#areas #"+id).addClass("highlight");
        }, 
        function () {
            var id = $(this).attr("id");
            $("#areas #"+id).removeClass("highlight");
        }
    );
    console.log(svgdom.getElementsByClassName);
});*/
</script>