<?php

namespace app\assets;

use yii\web\AssetBundle;

class TestAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/test';

    public $js = ['test.js'];

    public $depends = [
        'app\assets\AppAsset'
    ];
}