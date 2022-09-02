<?php
namespace davidxu\adminlte3\web;

use yii\web\AssetBundle;

/**
 * AdminLteAsset
 * @since 0.1
 */
class AdminLteAsset extends AssetBundle
{
    public $sourcePath = '@davidxu/adminlte3/';
    public $css = [
        'css/adminlte.css',
    ];
    public $js = [
        'js/dark-switch.js',
        'js/adminlte.js',
    ];
    
    public $depends = [
        BaseAdminLteAsset::class,
    ];
}
