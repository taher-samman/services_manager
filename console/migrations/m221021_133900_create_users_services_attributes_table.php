<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users_services_attributes}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%providers_services_attributes}}`
 * - `{{%user}}`
 */
class m221021_133900_create_users_services_attributes_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users_services_attributes}}', [
            'id' => $this->primaryKey(),
            'entity_id' => $this->integer()->notNull(),
            'user' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);

        // creates index for column `entity_id`
        $this->createIndex(
            '{{%idx-users_services_attributes-entity_id}}',
            '{{%users_services_attributes}}',
            'entity_id'
        );

        // add foreign key for table `{{%providers_services_attributes}}`
        $this->addForeignKey(
            '{{%fk-users_services_attributes-entity_id}}',
            '{{%users_services_attributes}}',
            'entity_id',
            '{{%providers_services_attributes}}',
            'id',
            'CASCADE'
        );

        // creates index for column `user`
        $this->createIndex(
            '{{%idx-users_services_attributes-user}}',
            '{{%users_services_attributes}}',
            'user'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-users_services_attributes-user}}',
            '{{%users_services_attributes}}',
            'user',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%providers_services_attributes}}`
        $this->dropForeignKey(
            '{{%fk-users_services_attributes-entity_id}}',
            '{{%users_services_attributes}}'
        );

        // drops index for column `entity_id`
        $this->dropIndex(
            '{{%idx-users_services_attributes-entity_id}}',
            '{{%users_services_attributes}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-users_services_attributes-user}}',
            '{{%users_services_attributes}}'
        );

        // drops index for column `user`
        $this->dropIndex(
            '{{%idx-users_services_attributes-user}}',
            '{{%users_services_attributes}}'
        );

        $this->dropTable('{{%users_services_attributes}}');
    }
}
