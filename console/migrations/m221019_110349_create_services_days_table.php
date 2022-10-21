<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%services_days}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%providers_services}}`
 */
class m221019_110349_create_services_days_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%services_days}}', [
            'id' => $this->primaryKey(),
            'entity_id' => $this->integer()->notNull(),
            'day' => $this->date()->notNull(),
            'duration' => $this->integer()->notNull(),
            'from' => $this->time()->notNull(),
            'to' => $this->time()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);

        // creates index for column `entity_id`
        $this->createIndex(
            '{{%idx-services_days-entity_id}}',
            '{{%services_days}}',
            'entity_id'
        );

        // add foreign key for table `{{%providers_services}}`
        $this->addForeignKey(
            '{{%fk-services_days-entity_id}}',
            '{{%services_days}}',
            'entity_id',
            '{{%providers_services}}',
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
            '{{%fk-services_days-entity_id}}',
            '{{%services_days}}'
        );

        // drops index for column `entity_id`
        $this->dropIndex(
            '{{%idx-services_days-entity_id}}',
            '{{%services_days}}'
        );

        $this->dropTable('{{%services_days}}');
    }
}
