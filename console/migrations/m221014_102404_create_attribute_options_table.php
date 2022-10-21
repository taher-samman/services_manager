<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%attribute_options}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%attributes}}`
 */
class m221014_102404_create_attribute_options_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%attribute_options}}', [
            'id' => $this->primaryKey(),
            'attribute' => $this->integer()->notNull(),
            'value' => $this->string()->notNull(),
        ]);

        // creates index for column `attribute`
        $this->createIndex(
            '{{%idx-attribute_options-attribute}}',
            '{{%attribute_options}}',
            'attribute'
        );

        // add foreign key for table `{{%attributes}}`
        $this->addForeignKey(
            '{{%fk-attribute_options-attribute}}',
            '{{%attribute_options}}',
            'attribute',
            '{{%attributes}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%attributes}}`
        $this->dropForeignKey(
            '{{%fk-attribute_options-attribute}}',
            '{{%attribute_options}}'
        );

        // drops index for column `attribute`
        $this->dropIndex(
            '{{%idx-attribute_options-attribute}}',
            '{{%attribute_options}}'
        );

        $this->dropTable('{{%attribute_options}}');
    }
}
