<?php

namespace davidxu\adminlte3\components;

use yii\filters\VerbFilter;
use yii\web\Controller;

class BaseController extends Controller
{
    use Crud;
    /**
     * @inheritdoc
     */
    public function behaviors(): array
    {
        return [
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'delete' => ['POST'],
                    'destroy' => ['POST'],
                ],
            ],
        ];
    }
}
