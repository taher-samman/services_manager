<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%attributes}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%services}}`
 * - `{{%attribute_types}}`
 */
class m221014_102059_create_attributes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%attributes}}', [
            'id' => $this->primaryKey(),
            'service' => $this->integer()->notNull(),
            'type' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
        ]);

        // creates index for column `service`
        $this->createIndex(
            '{{%idx-attributes-service}}',
            '{{%attributes}}',
            'service'
        );

        // add foreign key for table `{{%services}}`
        $this->addForeignKey(
            '{{%fk-attributes-service}}',
            '{{%attributes}}',
            'service',
            '{{%services}}',
            'id',
            'CASCADE'
        );

        // creates index for column `type`
        $this->createIndex(
            '{{%idx-attributes-type}}',
            '{{%attributes}}',
            'type'
        );

        // add foreign key for table `{{%attribute_types}}`
        $this->addForeignKey(
            '{{%fk-attributes-type}}',
            '{{%attributes}}',
            'type',
            '{{%attribute_types}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%services}}`
        $this->dropForeignKey(
            '{{%fk-attributes-service}}',
            '{{%attributes}}'
        );

        // drops index for column `service`
        $this->dropIndex(
            '{{%idx-attributes-service}}',
            '{{%attributes}}'
        );

        // drops foreign key for table `{{%attribute_types}}`
        $this->dropForeignKey(
            '{{%fk-attributes-type}}',
            '{{%attributes}}'
        );

        // drops index for column `type`
        $this->dropIndex(
            '{{%idx-attributes-type}}',
            '{{%attributes}}'
        );

        $this->dropTable('{{%attributes}}');
    }
}
