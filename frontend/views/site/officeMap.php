<?php
$this->title = Yii::t('page-title', 'Office map');?>

<?= common\widgets\map\MapWidget::widget(['params' => [
    'showList' => true
]]); ?>

<script>
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