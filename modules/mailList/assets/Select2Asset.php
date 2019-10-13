<?php

namespace app\modules\mailList\assets;

use yii\web\AssetBundle;

class Select2Asset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/select2';

    public $css = [
        'css/select2.min.css'
    ];
    public $js = [
        'js/select2.full.min.js',
        'js/i18n/ru.js'
    ];

    public $depends = [
        'app\assets\AppAsset'
    ];
}