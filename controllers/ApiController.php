<?php
/**
 * Created by PhpStorm.
 * User: ycz
 * Date: 2018/06/30
 * Time: 17:27
 */

namespace app\controllers;


use Yii;
use yii\filters\ContentNegotiator;
use yii\web\Response;

class ApiController extends Controller
{
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['corsFilter'] = [
            'class' => \yii\filters\Cors::class,
            'cors' => [
                // restrict access to
                'Access-Control-Request-Method' => ['*'],
                // Allow only headers 'X-Wsse'
                'Access-Control-Allow-Credentials' => true,
                // Allow OPTIONS caching
                'Access-Control-Max-Age' => 3600,
                // Allow the X-Pagination-Current-Page header to be exposed to the browser.
                'Access-Control-Expose-Headers' => ['X-Pagination-Current-Page'],
            ],
        ];

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON
            ]
        ];
        return $behaviors;
    }
    /**
     * 返回json数据
     *
     * @param int $code
     * @param string $msg
     * @param array $data
     * @return array
     * @date 2018/05/10
     * @author ycz
     */
    public function responseJson($code = 0, $msg = 'success', $data = [])
    {
        Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;

        $response = [
            'code' => $code,
            'message' => $msg,
            'data' => $data
        ];
        return Yii::$app->response->data = $response;
    }
}