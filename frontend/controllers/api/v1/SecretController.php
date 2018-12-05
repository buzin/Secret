<?php

namespace frontend\controllers\api\v1;

use frontend\models\SecretAPI;
use Yii;
use yii\rest\ActiveController;
use yii\filters\auth\HttpBasicAuth;


class SecretController extends ActiveController
{
    public $modelClass = 'frontend\models\SecretAPI';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => HttpBasicAuth::className(),
            'auth' => function ($username, $password) {

                $hash = '';

                // Найти запись по псевдониму и проверить пароль.
                if ($secret = SecretAPI::findOne($username)) {
                    $hash = $secret->password;
                    if (!SecretAPI::verifyPassword($password, $hash)) {
                        // Пароль не подходит.
                        $username = '';
                    }
                }

                return SecretAPI::findOne([
                    'alias' => $username,
                    'password' => $hash,
                ]);
            }
        ];
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();

        // С этими действиями не работаем.
        unset($actions['index'], $actions['create'], $actions['update'], $actions['options']);

        return $actions;
    }
}