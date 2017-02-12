<?php

namespace common\assets;

use yii\web\AssetBundle;
use yii\helpers\ArrayHelper;

/**
 * Main backend application asset bundle.
 */
class AceAsset extends AssetBundle
{

	public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [];

    public $js = [];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];

    public static function initAcePage($view) {
    	// bootstrap & fontawesome
    	AceAsset::addPageCss($view, 'ace/css/bootstrap.min.css');
    	AceAsset::addPageCss($view, 'ace/font-awesome/4.5.0/css/font-awesome.min.css');

    	// page specific plugin styles
		// -- text fonts
    	AceAsset::addPageCss($view, 'ace/css/fonts.googleapis.com.css');
    	// ace styles
    	AceAsset::addPageCss($view, 'ace/css/ace.min.css', ['class'=>'ace-main-stylesheet', 'id'=>'main-ace-style']);
		AceAsset::addPageCss($view, 'ace/css/ace-part2.min.css', ['class'=>'ace-main-stylesheet', 'condition'=>'lte IE9']);
		AceAsset::addPageCss($view, 'ace/css/ace-skins.min.css');
		AceAsset::addPageCss($view, 'ace/css/ace-rtl.min.css');
		AceAsset::addPageCss($view, 'ace/css/ace-rtl.min.css', ['class'=>'ace-main-stylesheet', 'condition'=>'lte IE9']);

		// ace settings handler
		AceAsset::addPageJs($view, 'ace/js/ace-extra.min.js', ['position' => \yii\web\View::POS_HEAD]);

		// HTML5shiv and Respond.js for IE8 to support HTML5 elements and media queries
		AceAsset::addPageJs($view, 'ace/js/html5shiv.min.js', ['position' => \yii\web\View::POS_HEAD, 'condition'=>'lte IE8']);
		AceAsset::addPageJs($view, 'ace/js/respond.min.js', ['position' => \yii\web\View::POS_HEAD, 'condition'=>'lte IE8']);

		// basic scripts
		AceAsset::addPageJs($view, 'ace/js/jquery-2.1.4.min.js', ['condition'=>'!IE']);
		AceAsset::addPageJs($view, 'ace/js/jquery-1.11.3.min.js', ['condition'=>'IE']);
		AceAsset::addPageJs($view, 'ace/js/jquery.mobile.custom.min.js');
		AceAsset::addPageJs($view, 'ace/js/bootstrap.min.js');

		// page specific plugin scripts
		AceAsset::addPageJs($view, 'ace/js/excanvas.min.js', ['condition'=>'lte IE8']);
		AceAsset::addPageJs($view, 'ace/js/jquery-ui.custom.min.js');
		AceAsset::addPageJs($view, 'ace/js/jquery.ui.touch-punch.min.js');
		AceAsset::addPageJs($view, 'ace/js/jquery.easypiechart.min.js');
		AceAsset::addPageJs($view, 'ace/js/jquery.sparkline.index.min.js');
		AceAsset::addPageJs($view, 'ace/js/jquery.flot.min.js');
		AceAsset::addPageJs($view, 'ace/js/jquery.flot.pie.min.js');
		AceAsset::addPageJs($view, 'ace/js/jquery.flot.resize.min.js');
		AceAsset::addPageJs($view, 'ace/js/ace-elements.min.js');
		AceAsset::addPageJs($view, 'ace/js/ace.min.js');
    } 


    public static function options($opt) {
    	return ArrayHelper::merge([AceAsset::className(), 'depends'=>'common\assets\AceAsset'], $opt);
    }


    //导入当前页的功能js文件
    public static function addPageCss($view, $cssfile, $opt = []) {
        $view->registerCssFile($cssfile, AceAsset::options($opt));
    }

    //导入当前页的功能js文件
    public static function addPageJs($view, $jsfile, $opt = []) {
        $view->registerJsFile($jsfile, AceAsset::options($opt));
    }

    //导入编辑器
    public static function addCkeditor($view) {
        $view->registerJsFile('/public/js/utility/ckeditor/ckeditor.js', [AceAsset::className(), 'depends'=>'common\assets\AceAsset']);
    }






}
