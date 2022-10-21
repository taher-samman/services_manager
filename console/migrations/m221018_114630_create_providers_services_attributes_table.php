<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%providers_services_attributes}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%providers_services}}`
 * - `{{%attributes}}`
 */
class m221018_114630_create_providers_services_attributes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%providers_services_attributes}}', [
            'id' => $this->primaryKey(),
            'entity_id' => $this->integer(),
            'attribute' => $this->integer(),
            'option' => $this->string(),
            'price' => $this->float(),
        ]);
        // unique entity_id attribute
        $this->createIndex(
            '{{%idx-unique-entity_id-attribute}}',
            '{{%providers_services_attributes}}',
            ['entity_id', 'attribute'],
            true
        );
        // creates index for column `entity_id`
        $this->createIndex(
            '{{%idx-providers_services_attributes-entity_id}}',
            '{{%providers_services_attributes}}',
            'entity_id'
        );

        // add foreign key for table `{{%providers_services}}`
        $this->addForeignKey(
            '{{%fk-providers_services_attributes-entity_id}}',
            '{{%providers_services_attributes}}',
            'entity_id',
            '{{%providers_services}}',
            'id',
            'CASCADE'
        );

        // creates index for column `attribute`
        $this->createIndex(
            '{{%idx-providers_services_attributes-attribute}}',
            '{{%providers_services_attributes}}',
            'attribute'
        );

        // add foreign key for table `{{%attributes}}`
        $this->addForeignKey(
            '{{%fk-providers_services_attributes-attribute}}',
            '{{%providers_services_attributes}}',
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
        // drops foreign key for table `{{%providers_services}}`
        $this->dropForeignKey(
            '{{%fk-providers_services_attributes-entity_id}}',
            '{{%providers_services_attributes}}'
        );

        // drops index for column `entity_id`
        $this->dropIndex(
            '{{%idx-providers_services_attributes-entity_id}}',
            '{{%providers_services_attributes}}'
        );

        // drops foreign key for table `{{%attributes}}`
        $this->dropForeignKey(
            '{{%fk-providers_services_attributes-attribute}}',
            '{{%providers_services_attributes}}'
        );

        // drops index for column `attribute`
        $this->dropIndex(
            '{{%idx-providers_services_attributes-attribute}}',
            '{{%providers_services_attributes}}'
        );

        $this->dropTable('{{%providers_services_attributes}}');
    }
}
