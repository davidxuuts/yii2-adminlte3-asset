<?php
/*
 * Copyright (c) 2023.
 * @author David Xu <david.xu.uts@163.com>
 * All rights reserved.
 */

namespace davidxu\adminlte3\web;

use davidxu\base\assets\BaseAppAsset;
use yii\web\AssetBundle;

/**
 * BaseAdminLteAsset
 * @since 0.1
 */
class BaseAdminLteAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/dist';
    public $css = [
        'css/adminlte.min.css',
    ];
    public $js = [
        'js/adminlte.min.js'
    ];
    public $depends = [
        BaseAppAsset::class,
    ];
}
