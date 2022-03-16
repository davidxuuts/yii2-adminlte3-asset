<?php

namespace davidxu\adminlte3\components;

use Yii;
use yii\helpers\ArrayHelper;
use yii\web\Response;

/**
 * Response result helper
 *
 * Class ResponseHelper
 * @package davidxu\adminlte3\components
 */
class ResponseHelper
{
    public const BACKEND = 0;
    public const FRONTEND = 1;
    public const API = 2;
    public const HTML5 = 3;
    public const MERCHANT = 4;

    /**
     * @param int $code
     * @param string $message
     * @param array $data
     * @return array|mixed
     */
    public static function json(int $code = 404, string $message = '', array $data = [])
    {
        if ($message === '') {
            $message = Yii::t('app', 'Unknown error');
        }
        if (in_array(Yii::$app->id, [self::API], true)) {
            return static::api($code, $message, $data);
        }
        return static::baseJson($code, $message, $data);
    }

    /**
     * Return Json
     *
     * @param int $code Http status code
     * @param string $message Returned message
     * @param array|object $data Returned data array or object
     * @return array|mixed
     */
    protected static function baseJson(int $code, string $message, $data): array
    {
        Yii::$app->response->format = Response::FORMAT_JSON;

        return [
            'code' => (string)$code,
            'message' => trim($message),
            'data' => $data ? ArrayHelper::toArray($data) : [],
        ];
    }

    /**
     * Returns array data format
     * if data is api, returns json
     *
     * @param int $code Http status code
     * @param string $message Returned message
     * @param array|object $data Returned data array or object
     * @return array|array[]|mixed|object|object[]|string|string[]
     */
    protected static function api(int $code, string $message, $data)
    {
        Yii::$app->response->setStatusCode($code, $message);
        Yii::$app->response->data = $data ? ArrayHelper::toArray($data) : [];

        return Yii::$app->response->data;
    }
}
