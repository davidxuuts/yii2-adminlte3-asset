<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\web\View;

/* @var $this View */
/* @var $model <?= ltrim($generator->searchModelClass, '\\') ?> */
/* @var $form yii\bootstrap4\ActiveForm */
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-search card card-outline card-secondary">

    <?= "<?php " ?>$form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'layout' => 'horizontal',
        'fieldConfig' => [
            'horizontalCssClasses' => [
                'label' => 'col-sm-3 text-right',
                'offset' => 'offset-sm-3',
                'wrapper' => 'col-sm-9',
            ],
        ],
<?php if ($generator->enablePjax): ?>
        'options' => [
            'data-pjax' => 1
        ],
<?php endif; ?>
    ]); ?>
    <div class="card-body pt-3 pl-0 pr-0">
    <?php
    $count = 0;
    foreach ($generator->getColumnNames() as $attribute) {
        if (++$count < 6) {
            echo "    <?= " . $generator->generateActiveSearchField($attribute) . " ?>\n\n";
        } else {
            echo "    <?php // echo " . $generator->generateActiveSearchField($attribute) . " ?>\n\n";
        }
    }
    ?>
        <div class="form-group">
            <?= "<?= " ?>Html::submitButton(<?= '\'<i class="fas fa-search"></i> \' . ' . $generator->generateString('Search') ?>, ['class' => 'btn btn-xs btn-primary']) ?>
            <?= "<?= " ?>Html::resetButton(<?= '\'<i class="fas fa-reply"></i> \' . ' . $generator->generateString('Reset') ?>, ['class' => 'btn btn-xs btn-default']) ?>
        </div>
    </div>
    <?= "<?php " ?>ActiveForm::end(); ?>

</div>
