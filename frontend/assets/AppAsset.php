<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'libs/bootstrap.css',
        'css/fonts.css',
        'css/main1.css',
        'css/media2.css',
    ];
    public $js = [
        //'jquery-3.3.1.min.js',
        'js/wow.min.js',
        'js/common.js',
      //  'js\map.js'
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
