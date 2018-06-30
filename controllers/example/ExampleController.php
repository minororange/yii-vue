<?php
/**
 * Created by PhpStorm.
 * User: ycz
 * Date: 2018/06/30
 * Time: 17:17
 */

namespace app\controllers\example;


use app\controllers\ApiController;

class ExampleController extends ApiController
{

    public function actionIndex()
    {
        return $this->responseJson(1005, 'This is an example!');
    }
}