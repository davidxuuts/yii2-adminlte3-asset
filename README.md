AdminLTE Asset Bundle
=====================

[![Latest Stable Version](https://poser.pugx.org/dmstr/yii2-adminlte-asset/v/stable.svg)](https://packagist.org/packages/davidxu/yii2-adminlte3-asset) 
[![Total Downloads](https://poser.pugx.org/dmstr/yii2-adminlte-asset/downloads.svg)](https://packagist.org/packages/davidxu/yii2-adminlte3-asset)
[![License](https://poser.pugx.org/dmstr/yii2-adminlte-asset/license.svg)](https://packagist.org/packages/davidxu/yii2-adminlte3-asset)


*Backend UI for Yii2 Framework, based on [AdminLTE](https://github.com/almasaeed2010/AdminLTE)*

!["Yii2 AdminLTE Presentation"](https://cloud.githubusercontent.com/assets/874234/7603896/753228ee-f943-11e4-9d42-2a31b41eb42d.jpg)

This package contains an [Asset Bundle for Yii 2.0 Framework](http://www.yiiframework.com/doc-2.0/guide-structure-assets.html) 
which registers the CSS files for the AdminLTE user-interface.


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

To install AdminLTE v3 run:

```
composer require davidxu/yii2-adminlte3-asset "^0.1.0"
```

FAQ
---

### Upgrading

When upgrading please see the [AdminLTE upgrade guide](https://adminlte.io/docs/3.0/upgrade-guide.html) for adjustments you need to make in your views.

### Compatibility matrix

| yii2-adminlte-asset | AdminLTE 
|---------------------|----------|
| 0.1.0               | 3.2      | required

> For other [issues](https://github.com/davidxu/yii2-adminlte3-asset/issues?utf8=%E2%9C%93&q=is%3Aissue), please search GitHub first.


Quick Start
-----------

Once the extension is installed, you can have a **preview** by reconfiguring the path mappings of the view component:

For Yii 2 [Advanced Application Template](https://github.com/yiisoft/yii2-app-advanced) or [Basic Application Template](https://github.com/yiisoft/yii2-app-basic)

```php
'components' => [
    'view' => [
         'theme' => [
             'pathMap' => [
                '@app/views' => '@vendor/davidxu/yii2-adminlte3-asset/example-views/yiisoft/yii2-app'
             ],
         ],
    ],
],
```

This asset bundle provides sample files for layout and view (see folder `examples/`), they are **not meant to be customized directly in the `vendor/` folder**.

Therefore it is recommended to **copy the views into your application** and adjust them to your needs.


Customization
-------------

- Copy files from `vendor/davidxu/yii2-adminlte3-asset/example-views/yiisoft/yii2-app` (or other theme) to `@app/views`.
- Remove the custom `view` configuration from your application by deleting the path mappings, if you have made them before.
- Edit your views adhering to html markup `vendor/almasaeed2010/adminlte/pages`

### AdminLTE Plugins

Assets for [AdminLTE plugins](https://adminlte.io/docs/3.0/dependencies.html#plugins) are not included
in our `AdminLteAsset` but you can find these files in your vendor directory under `vendor/almasaeed2010/adminlte/plugins`.
So if you want to use any of them we recommend to create a custom bundle where you list the plugin files you need:


```php
use yii\web\AssetBundle;
class AdminLtePluginAsset extends AssetBundle
{
    public $sourcePath = '@vendor/almasaeed2010/adminlte/plugins';
    public $css = [
        'chart.js/Chart.min.css',
        // more plugin CSS here
    ];
    public $js = [
        'chart.js/Chart.bundle.min.js'
        // more plugin Js here
    ];
    public $depends = [
        'davidxu\adminlte3\web\AdminLteAsset',
    ];
}
```

As this asset depends on our `AdminLteAsset` it's the only asset you have to register, for example in
your `main.php` layout file.


### Custom content header

If you want to use native DOM of headers AdminLTE

```html
<h1>
    About <small>static page</small>
</h1>
```

then you can follow the code:

```php
/* @var yii\web\View $this */

$this->params['breadcrumbs'][] = 'About';

$this->beginBlock('content-header'); ?>
About <small>static page</small>
<?php $this->endBlock(); ?>

<div class="site-about">
    <p> This is the About page. You may modify the following file to customize its content: </p>
    <code><?= __FILE__ ?></code>
</div>
```

### Left sidebar menu - Widget Menu

If you need to separate sections of the menu then just add the `header` option to item in `items`
```php
    'items' => [
        ['label' => 'Gii', 'iconType' => 'far' 'icon' => 'file-code', 'url' => ['/gii']],
        ['label' => 'Debug', 'icon' => 'dashboard-alt', 'url' => ['/debug']],
        ['label' => 'MAIN NAVIGATION', 'header' => true], // here
        // ... a group items
        ['label' => '', 'header' => true],
        // ... a group items
        ['label' => '', 'header' => true],
        // ... a group items
```

To add a badge for a item:

```php
'items' => [
    [
        'label' => 'Mailbox',
        'iconType' => 'far',
        'icon' => 'envelope',
        'url' => ['/mailbox'],
        'badge' => '<span class="badge badge-info right">123</span>'
    ],
]
```

### Template for Gii CRUD generator <TBD>

Tell Gii about our template. The setting is made in the config file:

```php
if (YII_ENV_DEV) {
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'generators' => [ // HERE
            'crud' => [
                'class' => 'yii\gii\generators\crud\Generator',
                'templates' => [
                    'adminlte' => '@vendor/davdixu/yii2-adminlte3-asset/gii/templates/crud/simple',
                ]
            ]
        ],
    ];
}
```

Further Information
-------------------

For AdminLTE documentation, please read https://almsaeedstudio.com/themes/AdminLTE/documentation/index.html

> Namespacing rules follow the Yii 2.0 framework structure, eg. `davidxu\adminlte3\web` for the Asset Bundle.
 
