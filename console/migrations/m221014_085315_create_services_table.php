<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%services}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%categories}}`
 */
class m221014_085315_create_services_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%services}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'category' => $this->integer()->notNull(),
            'created_at' => $this->datetime(),
            'updated_at' => $this->datetime(),
        ]);

        // creates index for column `category`
        $this->createIndex(
            '{{%idx-services-category}}',
            '{{%services}}',
            'category'
        );

        // add foreign key for table `{{%categories}}`
        $this->addForeignKey(
            '{{%fk-services-category}}',
            '{{%services}}',
            'category',
            '{{%categories}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%categories}}`
        $this->dropForeignKey(
            '{{%fk-services-category}}',
            '{{%services}}'
        );

        // drops index for column `category`
        $this->dropIndex(
            '{{%idx-services-category}}',
            '{{%services}}'
        );

        $this->dropTable('{{%services}}');
    }
}
