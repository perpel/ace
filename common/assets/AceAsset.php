<?php

namespace common\assets;

use yii\web\AssetBundle;
use yii\helpers\ArrayHelper;

/**
 * Main backend application asset bundle.
 */
class AceAsset extends AssetBundle
{
	public $basePath = '@webroot/ace';
    public $baseUrl = '@web/ace';

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'common\assets\AceBaseAsset',
    ];


}
