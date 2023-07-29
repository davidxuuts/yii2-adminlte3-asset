<?php
/*
 * Copyright (c) 2023.
 * @author David Xu <david.xu.uts@163.com>
 * All rights reserved.
 */

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
