<?php

namespace app\controllers;

use app\components\zoodel\ZoodelAdminController;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;


use MaxMind\Db\Reader;



class ManagerController extends ZoodelAdminController
{

    public $layout = 'manager';

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }



    /**
     * @return string
     */
    public function actionIndex(){
        $this->layout = 'manager';
        return $this->render('index');

    }



}