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
use app\models\Sms;


class SmsController extends ZoodelAdminController
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
        $query = Sms::find()->with(['request', 'provider']);
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

    public function actionAdd()
    {
        //Random request
        $collection = \Yii::$app->mongodb->getCollection(Request::collectionName());
        $result = $collection->aggregate([
            [
                "\$sample" => ["size"=>20]
            ]
          ]);
        $request_id = $result[0]['_id'];

        //Random provider
        $collection = \Yii::$app->mongodb->getCollection(Provider::collectionName());
        $result = $collection->aggregate([
            [
                "\$sample" => ["size"=>20]
            ]
          ]);
        $provider_id = $result[0]['_id'];

        $sms = new Sms();
        $sms->phone = '+98 0911-111-2222';

        $sms->message = "Hello! RequestID{$request_id} ProviderID #{$provider_id}";
        $sms->provider_id = $provider_id;
        $sms->request_id = $request_id;
        $result = $sms->save();

        var_dump($result);
        var_dump($sms->errors);
    }

}