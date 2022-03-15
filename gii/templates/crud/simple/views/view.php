<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$urlParams = $generator->generateUrlParams();

echo "<?php\n";
?>

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\web\View;

/* @var $this View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$this->title = $model-><?= $generator->getNameAttribute() ?>;
$this->params['breadcrumbs'][] = ['label' => <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-view card card-outline card-secondary">
    <div class="card-header">
        <div class="card-tools">
        <?= "<?= " ?>Html::a(<?= '\'<i class="fas fa-edit"></i> \' . ' . $generator->generateString('Update') ?>, ['update', <?= $urlParams ?>], ['class' => 'btn btn-xs btn-primary']) ?>
        <?= "<?= " ?>Html::a(<?= '\'<i class="fas fa-trash-alt"></i> \' . ' . $generator->generateString('Delete') ?>, ['delete', <?= $urlParams ?>], [
            'class' => 'btn btn-xs btn-danger',
            'data' => [
                'confirm' => <?= $generator->generateString('Are you sure you want to delete this item?') ?>,
                'method' => 'post',
            ],
        ]) ?>
        </div>
    </div>
    <div class="card-body pt-3 pl-0 pr-0">
        <div class="container">
            <?= "<?php try {\n " ?>
            <?= "    echo " ?>DetailView::widget([
                    'model' => $model,
                    'options' => [
                        'class' => 'table table-bordered detail-view',
                    ],
                    'attributes' => [
<?php
if (($tableSchema = $generator->getTableSchema()) === false) {
    foreach ($generator->getColumnNames() as $name) {
        echo "                        '" . $name . "',\n";
    }
} else {
    foreach ($generator->getTableSchema()->columns as $column) {
        $format = stripos($column->name, 'created_at') !== false || stripos($column->name, 'updated_at') !== false ? 'datetime' : $generator->generateColumnFormat($column);
        echo "                        '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
    }
}
?>
                    ],
                ]);
            } catch (Exception $e) {
                echo YII_DEBUG ? $e->getMessage() : null;
            } ?>
        </div>
    </div>
</div>
