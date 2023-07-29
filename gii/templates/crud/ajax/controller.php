<?php
/*
 * Copyright (c) 2023.
 * @author David Xu <david.xu.uts@163.com>
 * All rights reserved.
 */

/**
 * This is the template for generating a AJAX CRUD controller class file.
 */

use yii\db\ActiveRecordInterface;
use yii\helpers\StringHelper;


/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$controllerClass = StringHelper::basename($generator->controllerClass);
$modelClass = StringHelper::basename($generator->modelClass);
$searchModelClass = StringHelper::basename($generator->searchModelClass);
if ($modelClass === $searchModelClass) {
    $searchModelAlias = $searchModelClass . 'Search';
}

/* @var $class ActiveRecordInterface */
$class = $generator->modelClass;
$pks = $class::primaryKey();
$urlParams = $generator->generateUrlParams();
$actionParams = $generator->generateActionParams();
$actionParamComments = $generator->generateActionParamComments();

echo "<?php\n";
?>

namespace <?= StringHelper::dirname(ltrim($generator->controllerClass, '\\')) ?>;

use Yii;
use <?= ltrim($generator->modelClass, '\\') ?>;
<?php if (!empty($generator->searchModelClass)): ?>
use <?= ltrim($generator->searchModelClass, '\\') . (isset($searchModelAlias) ? " as $searchModelAlias" : "") ?>;
<?php else: ?>
use yii\data\ActiveDataProvider;
use davidxu\adminlte3\components\BaseController;
//use davidxu\adminlte3\components\Crud;
<?php endif; ?>
use <?= ltrim($generator->baseControllerClass, '\\') ?>;

/**
 * You should have Basic BaseController Class and Crud Traits exist.
 * You can copy these two files from @vendor/davidxu/yii2-adminlte3-asset/components to any path and change namespace.
 * Also, you can extends davidxu\adminlte3\components\BaseController
 * and use davidxu\adminlte3\components\Crud directly.
 *
 * <?= $controllerClass ?> implements the CRUD actions for <?= $modelClass ?> model.
 */
class <?= $controllerClass ?> extends BaseController . "\n" ?>
{
    //use Crud;
    public $modelClass = <?= $modelClass ?>::class;
}
