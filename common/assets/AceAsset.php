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
        'common\assets\AceBaseAsset',
        'common\assets\AceYiiAsset',
    ];


}
