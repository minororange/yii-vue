<?php
/**
 * Created by PhpStorm.
 * User: ycz
 * Date: 2018/06/30
 * Time: 16:58
 */

namespace app\controllers;



class IndexController extends Controller
{

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionError()
    {
        return 'error';
    }
}