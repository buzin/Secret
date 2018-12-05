<?php

namespace frontend\models;

use common\models\BaseSecret;

class Secret extends BaseSecret
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['alias', 'password', 'content'], 'required'],
            [['alias'], 'string', 'max' => 94],
            [['password'], 'string', 'max' => 255],
            [['content'], 'string'],
            [['alias'], 'unique'],
        ];
    }
}