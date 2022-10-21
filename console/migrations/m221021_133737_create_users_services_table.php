<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users_services}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%providers_services}}`
 * - `{{%user}}`
 */
class m221021_133737_create_users_services_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users_services}}', [
            'id' => $this->primaryKey(),
            'entity_id' => $this->integer()->notNull(),
            'user' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);

        // creates index for column `entity_id`
        $this->createIndex(
            '{{%idx-users_services-entity_id}}',
            '{{%users_services}}',
            'entity_id'
        );

        // add foreign key for table `{{%providers_services}}`
        $this->addForeignKey(
            '{{%fk-users_services-entity_id}}',
            '{{%users_services}}',
            'entity_id',
            '{{%providers_services}}',
            'id',
            'CASCADE'
        );

        // creates index for column `user`
        $this->createIndex(
            '{{%idx-users_services-user}}',
            '{{%users_services}}',
            'user'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-users_services-user}}',
            '{{%users_services}}',
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
        // drops foreign key for table `{{%providers_services}}`
        $this->dropForeignKey(
            '{{%fk-users_services-entity_id}}',
            '{{%users_services}}'
        );

        // drops index for column `entity_id`
        $this->dropIndex(
            '{{%idx-users_services-entity_id}}',
            '{{%users_services}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-users_services-user}}',
            '{{%users_services}}'
        );

        // drops index for column `user`
        $this->dropIndex(
            '{{%idx-users_services-user}}',
            '{{%users_services}}'
        );

        $this->dropTable('{{%users_services}}');
    }
}
