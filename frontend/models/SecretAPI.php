<?php

namespace frontend\models;

use common\models\BaseSecret;
use Yii;
use yii\web\UnauthorizedHttpException;
use yii\web\IdentityInterface;
use  yii\helpers\Url;

class SecretAPI extends BaseSecret implements IdentityInterface
{
    /**
     * IdentityInterface
     * @param int|string $id
     * @return null|static
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        // Не используется в HTTP Basic.
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->alias;
    }

    public function getAuthKey()
    {
        // Не используется.
        return null;
    }

    public function validateAuthKey($authKey)
    {
        // Не используется.
        return false;
    }

    public function fields()
    {
        $isUnauthorized = false;

        // Найти заголовок Authorization: Basic base64(login:password)
        $headers = Yii::$app->getRequest()->getHeaders();
        $authorization = $headers->get('Authorization');
        if ($authorization && Yii\helpers\StringHelper::startsWith($authorization, 'Basic', false)) {

            // Выбрать пароль из заголовка Authorization.
            $start = Yii\helpers\StringHelper::byteLength('Basic');
            $base64 = Yii\helpers\StringHelper::byteSubstr($authorization, $start);
            $credentials = base64_decode($base64);
            $pair = Yii\helpers\StringHelper::explode($credentials, ':');
            if (count($pair) == 2) {
                $password = $pair[1];

                // Расшифровать текст.
                if (!$content = $this->decrypt($password)) {
                    $isUnauthorized = true;
                }
            }
            else {
                $isUnauthorized = true;
            }
        }
        else {
            $isUnauthorized = true;
        }
        // Пароль не найден или не подходит.
        if ($isUnauthorized) {
            throw new UnauthorizedHttpException('Your request was made with invalid credentials.', 401);
        }
        
        return [
            'id' => 'alias',
            'link' => function () {
                return Url::to($this->alias, 'https');
            },
            'content' => function() {
                return $this->content;
            }
        ];
    }
}