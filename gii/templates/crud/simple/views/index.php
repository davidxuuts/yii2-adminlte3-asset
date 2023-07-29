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

$urlParams = $generator->generateUrlParams();
$nameAttribute = $generator->getNameAttribute();

echo "<?php\n";
?>

use yii\data\ActiveDataProvider;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\web\View;
use <?= $generator->indexWidgetType === 'grid' ? "yii\\grid\\GridView" : "yii\\widgets\\ListView" ?>;
<?= $generator->enablePjax ? 'use yii\widgets\Pjax;' : '' ?>

/* @var $this View */
<?= !empty($generator->searchModelClass) ? "/* @var \$searchModel " . ltrim($generator->searchModelClass, '\\') . " */\n" : '' ?>
/* @var $dataProvider ActiveDataProvider */

$this->title = <?= $generator->generateString(Inflector::pluralize(Inflector::camel2words(StringHelper::basename($generator->modelClass)))) ?>;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-index card card-outline card-secondary">
    <?= $generator->enablePjax ? "<?php Pjax::begin(); ?>\n" : ''
    ?>    <div class="card-header">
        <h4 class="card-title"><?= "<?= Html::encode(\$this->title); ?>" ?> </h4>
        <div class="card-tools">
            <?= "<?= " ?>Html::a(<?= '\'<i class="fas fa-plus-circle"></i> \' . ' . $generator->generateString('Create') ?>, ['create'], ['class' => 'btn btn-xs btn-success']) ?>
        </div>
    </div>
    <div class="card-body pt-3 pl-0 pr-0">
        <div class="container">
            <?php if(!empty($generator->searchModelClass)): ?>
                <?= "        <?php " . ($generator->indexWidgetType === 'grid' ? "// " : "") ?>echo $this->render('_search', ['model' => $searchModel]); ?>
            <?php endif;

            if ($generator->indexWidgetType === 'grid'):
                echo "<?php try {\n";
                echo "                echo " ?>GridView::widget([
                    'dataProvider' => $dataProvider,
                    <?= !empty($generator->searchModelClass) ? "'filterModel' => \$searchModel,\n            'layout' => \"{items}\\n{summary}\\n{pager}\",\n                'columns' => [\n" : "'layout' => \"{items}\\n{summary}\\n{pager}\",\n                    'columns' => [\n"; ?>
                        ['class' => 'yii\grid\SerialColumn'],
                <?php
                $count = 0;
                if (($tableSchema = $generator->getTableSchema()) === false) {
                    foreach ($generator->getColumnNames() as $name) {
                        if (++$count < 6) {
                            echo "                        '" . $name . "',\n";
                        } else {
                            echo "                        // '" . $name . "',\n";
                        }
                    }
                } else {
                    foreach ($tableSchema->columns as $column) {
                        $format = $generator->generateColumnFormat($column);
                        if (++$count < 6) {
                            echo "                        '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                        } else {
                            echo "                        // '" . $column->name . ($format === 'text' ? "" : ":" . $format) . "',\n";
                        }
                    }
                }
                ?>
                        [
                            'class' => ActionColumn::class,
                            'header' => Yii::t('app', 'Operate'),
                        ],
                    ],
                ]);
                } catch (Exception $e) {
                    echo YII_DEBUG ? $e->getMessage() : null;
                } ?>
            <?php else: ?><?= "<?php try {\n"; ?>
                <?= "echo " ?>ListView::widget([
                    'dataProvider' => $dataProvider,
                    'itemOptions' => ['class' => 'item'],
                    'itemView' => function ($model, $key, $index, $widget) {
                        return Html::a(Html::encode($model-><?= $nameAttribute ?>), ['view', <?= $urlParams ?>]);
                    },
                ]);
            } catch (Exception $e) {
                echo YII_DEBUG ? $e->getMessage() : null;
            } ?>
            <?php endif; ?>
</div>
    </div>
<?= $generator->enablePjax ? "    <?php Pjax::end(); ?>\n" : '' ?>
</div>
