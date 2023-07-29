<?php
/*
 * Copyright (c) 2023.
 * @author David Xu <david.xu.uts@163.com>
 * All rights reserved.
 */

use davidxu\adminlte3\widgets\Alert;
use yii\helpers\Html;
use yii\web\View;
use davidxu\adminlte3\web\AdminLteAsset;

/** @var View $this */
/** @var string $content */

AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<head>
    <meta charset="<?= Yii::$app->charset ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="login-page">

    <?php $this->beginBody() ?>

    <div class="login-box">
        <div class="login-logo">
            <?= Html::a('<b>Admin</b>LTE', ['/site/login']); ?>
        </div>

        <?php try {
            echo Alert::widget();
        } catch (Exception $e) {
            echo YII_DEBUG ? $e->getMessage() : null;
        } ?>

        <?= $content ?>
    </div>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage() ?>
<?php
