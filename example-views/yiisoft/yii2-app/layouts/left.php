<?php

use yii\helpers\Html;
use yii\web\View;
use davidxu\adminlte3\widgets\Menu;

/** @var View $this */
/** @var string $directoryAsset */
?>

<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <?= Html::a('<img class="brand-image img-circle elevation-3" src="' . ($directoryAsset . '/img/AdminLTELogo.png') . '" alt="APP"><span class="brand-text font-weight-light">' . Yii::$app->name . '</span>', Yii::$app->homeUrl, ['class' => 'brand-link']) ?>
    <div class="sidebar">

        <nav class="mt-2">
            <?php try {
                echo Menu::widget([
                    'options' => ['class' => 'nav nav-pills nav-sidebar flex-column', 'data-widget' => 'preview'],
                    'items' => [
                        ['label' => 'Menu Yii2', 'header' => true],
                        ['label' => 'Gii', 'iconType' => 'far', 'icon' => 'file-code', 'url' => ['/gii']],
                        ['label' => 'Debug', 'icon' => 'tachometer-alt', 'url' => ['/debug']],
                        ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
                        [
                            'label' => 'Some tools',
                            'icon' => 'share',
                            'url' => '#',
                            'items' => [
                                ['label' => 'Gii', 'iconType' => 'far', 'icon' => 'file-code', 'url' => ['/gii'],],
                                ['label' => 'Debug', 'icon' => 'tachometer-alt', 'url' => ['/debug'],],
                                [
                                    'label' => 'Level One',
                                    'iconType' => 'far',
                                    'icon' => 'circle',
                                    'url' => '#',
                                    'items' => [
                                        ['label' => 'Level Two', 'iconType' => 'far', 'icon' => 'dot-circle', 'url' => '#',],
                                        [
                                            'label' => 'Level Two',
                                            'iconType' => 'far',
                                            'icon' => 'dot-circle',
                                            'url' => '#',
                                            'items' => [
                                                ['label' => 'Level Three', 'icon' => 'dot-circle', 'url' => '#',],
                                                ['label' => 'Level Three', 'icon' => 'dot-circle', 'url' => '#',],
                                            ],
                                        ],
                                    ],
                                ],
                            ],
                        ],
                    ],
                ]);
            } catch (Exception $e) {
                echo YII_DEBUG ? $e->getMessage() : null;
            } ?>
        </nav>

    </div>

</aside>
