<?php

namespace frontend\components;

use frontend\models\Secret;
use yii\web\UrlRuleInterface;
use yii\base\BaseObject;
use yii\helpers\StringHelper;

class SecretUrlRule extends BaseObject implements UrlRuleInterface
{
    public $aliasLength = 8;

    public function createUrl($manager, $route, $params)
    {
        if ($route === 'secret/view') {
            if (isset($params['id'])) {
                return $params['id'];
            }
        }
        return false;
    }

    public function parseRequest($manager, $request)
    {
        $pathInfo = $request->getPathInfo();
        // Для оптимизации искать секретный URL, только когда длина запроса равна длине псевдонима.
        if (StringHelper::byteLength($pathInfo) == $this->aliasLength) {
            // Это секретный URL?
            if ($secret = Secret::find()->where(['alias' => $pathInfo])->one()) {
                return ['secret/view', ['id' => $secret->alias]];
            }
        }
        return false;
    }
}