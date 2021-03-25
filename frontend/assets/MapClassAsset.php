<?php

namespace frontend\assets;

use yii\web\AssetBundle;

class MapClassAsset extends AssetBundle
{
    public $basePath = '@webroot'; //алиас каталога с файлами, который соответствует @web
    public $baseUrl = '@web';//Алиас пути к файлам

    public $js = [
        'js/map.js',
        //  'js/index-map.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        //'yii\bootstrap\BootstrapAsset',
    ];
}
