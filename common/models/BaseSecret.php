<?php

namespace common\models;

use Yii;
use yii\base\InvalidArgumentException;
use yii\db\ActiveRecord;

/**
 * This is the base model class for table "secret".
 *
 * @property string $alias
 * @property string $password
 * @property string $content
 */
class BaseSecret extends ActiveRecord
{
    const ALIAS_LENGTH = 8;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'secret';
    }

    public static function verifyPassword($password, $hash)
    {
        $isValid = false;
        try {
            $isValid = Yii::$app->security->validatePassword($password, $hash);
        }
        catch (InvalidArgumentException $e) {}

        return $isValid;
    }

    /**
     * Generates new unique identity.
     *
     * @return bool|string
     */
    public function generateNewAlias()
    {
        $alias = false;
        try {
            do {
                $alias = Yii::$app->security->generateRandomString(self::ALIAS_LENGTH);
            } while (self::findOne($alias));
            $this->alias = $alias;
        }
        catch (Exception $e) {}

        return $alias;
    }

    public function hashPassword()
    {
        $success = true;
        try {
            $this->password = Yii::$app->security->generatePasswordHash($this->password);
        }
        catch (Exception $e) {
            $success = false;
        }

        return $success;
    }

    public function encrypt($password)
    {
        if ($content = utf8_encode(Yii::$app->security->encryptByPassword($this->content, $password))) {
            $this->content = $content;
        }

        return $content;
    }

    public function decrypt($password)
    {
        if ($content = Yii::$app->security->decryptByPassword(utf8_decode($this->content), $password)) {
            $this->content = $content;
        }

        return $content;
    }
}
