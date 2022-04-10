<?php
namespace davidxu\adminlte3\web;

use davidxu\base\assets\AppAsset;
use yii\web\AssetBundle;

/**
 * AdminLteAsset
 * @since 0.1
 */
class AdminLteAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '../';
    public $css = [];
    public $js = [
        'js/dark-switch.js',
    ];
    
    public $depends = [
        AppAsset::class,
    ];
}
