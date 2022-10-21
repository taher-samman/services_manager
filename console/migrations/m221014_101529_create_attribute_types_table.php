<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%attribute_types}}`.
 */
class m221014_101529_create_attribute_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%attribute_types}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'html_value' => $this->string()->notNull()->unique(),
            'has_options' => $this->integer(1),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%attribute_types}}');
    }
}
