<?php

namespace app\controllers;

use Yii;
use yii\base\Exception;
use yii\mongodb\Query;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use app\components\zoodel\TranslateW;
use app\components\zoodel\ZoodelAdminController;
use app\models\Provider;
use app\models\Request;
use app\models\Email;
use app\models\MailCron;



class EmailsController extends ZoodelAdminController
{
    public $layout = 'manager';

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
    public function actionIndex()
    {
        $this->layout = 'manager';
        $query = MailCron::find()->with(['email']);
        $dataProvider = new ActiveDataProvider([
            'key'=>'_id',
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ],
            'sort'=>[
                'defaultOrder' => ['no'=>SORT_DESC],
                'attributes' => [
                    'no' => [
                        'asc' => ['no' => SORT_ASC],
                        'desc' => ['no' => SORT_DESC],
                        'label' => TranslateW::tc('No'),
                        'default' => SORT_DESC
                    ],
                    'created_at' => [
                        'asc' => ['created_at' => SORT_ASC],
                        'desc' => ['created_at' => SORT_DESC],
                        'label' => TranslateW::tc('Date'),
                        'default' => SORT_DESC
                    ],
                ]
            ]
        ]);
        return $this->render('index', compact('dataProvider'));
    }

}