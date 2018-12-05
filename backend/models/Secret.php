<?php

namespace backend\models;

use common\models\BaseSecret;
use  yii\helpers\Url;


class Secret extends BaseSecret
{

    public function fields()
    {
        return [
            'id' => 'alias',
            'link' => function () {
                return Url::to($this->alias, 'https');
            },
//            'content',
//            'password'
        ];
    }

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

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'content' => 'Secret Text',
        ];
    }
}