<?php
/*
 * Copyright (c) 2023.
 * @author David Xu <david.xu.uts@163.com>
 * All rights reserved.
 */

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

/* @var $model \yii\db\ActiveRecord */
$model = new $generator->modelClass();
$safeAttributes = $model->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $model->attributes();
}

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\bootstrap4\ActiveForm;
use yii\web\View;

/* @var $this View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form card">
    <?= "<?php " ?>$form = ActiveForm::begin([
    'layout' => 'horizontal',
        'fieldConfig' => [
            'horizontalCssClasses' => [
                'label' => 'col-sm-3 text-right',
                'offset' => 'offset-sm-3',
                'wrapper' => 'col-sm-9',
            ],
        ]
    ]); ?>
    <div class="card-body pt-3 pl-0 pr-0">
        <div class="container">
        <?php foreach ($generator->getColumnNames() as $attribute) {
            if (in_array($attribute, $safeAttributes)) {
                echo "        <?= " . $generator->generateActiveField($attribute) . " ?>\n\n";
            }
        } ?>
        </div>
    </div>
    <div class="card-footer">
        <?= "<?= " ?>Html::submitButton(<?= '\'<i class="fas fa-save"></i> \' . ' . $generator->generateString('Save') ?>, ['class' => 'btn btn-xs btn-success']) ?>
    </div>
    <?= "<?php " ?>ActiveForm::end(); ?>
</div>
