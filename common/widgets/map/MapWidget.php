<?php
namespace common\widgets\map;

/**
 * Description of MapWidget
 *
 * @author AlexR
 */
class MapWidget extends \yii\base\Widget{

    public $params;
    
    public function init(){
        parent::init();
        if ($this->params === null) {
            $this->params = [];
        }
    }
    
    public function run() {
        MapWidgetAssets::register($this->getView());
        return $this->render('@common/widgets/views/map', ['params' => $this->params]);
    }
}

class MapWidgetAssets extends \yii\web\AssetBundle{
    
    public $sourcePath = '@common/themes/frontend-theme';

	public $css = [
	];
	
	public $js = [
    	'js/snap.svg-min.js',
	];

    public $jsOptions = [
        'position' => \yii\web\View::POS_HEAD
    ];
}
