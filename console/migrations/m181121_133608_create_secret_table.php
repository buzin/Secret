<?php

use yii\db\Migration;

/**
 * Handles the creation of table `secret`.
 */
class m181121_133608_create_secret_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('secret', [
            'alias' => $this->string(94)->notNull()->unique(),
            'password' => $this->string(255)->notNull(),
            'body' => $this->text()->notNull(),
        ]);
        $this->addPrimaryKey('alias', 'secret', 'alias');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('secret');
    }
}
