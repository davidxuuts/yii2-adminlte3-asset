<?php
/*
 * Copyright (c) 2023.
 * @author David Xu <david.xu.uts@163.com>
 * All rights reserved.
 */

use yii\helpers\Html;

/** @var \yii\web\View $this */
/** @var string $content */

\dmstr\adminlte\web\AdminLteAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="login-page">

<?php $this->beginBody() ?>

    <div class="login-box">
        <div class="login-logo">
            <?= Html::a('<b>AdminUser</b>LTE', Yii::$app->homeUrl); ?>
        </div>

        <?= \dmstr\adminlte\widgets\Alert::widget(); ?>
        
        <?= $content ?>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
