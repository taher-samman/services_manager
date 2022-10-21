<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%providers_services}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%service}}`
 */
class m221018_114220_create_providers_services_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%providers_services}}', [
            'id' => $this->primaryKey(),
            'user' => $this->integer(),
            'service' => $this->integer(),
            'price' => $this->float()->notNull(),
        ]);

        // creates index for column `user`
        $this->createIndex(
            '{{%idx-providers_services-user}}',
            '{{%providers_services}}',
            'user'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-providers_services-user}}',
            '{{%providers_services}}',
            'user',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // unique service user
        $this->createIndex(
            '{{%idx-unique-user-service}}',
            '{{%providers_services}}',
            ['user', 'service'],
            true
        );


        // creates index for column `service`
        $this->createIndex(
            '{{%idx-providers_services-service}}',
            '{{%providers_services}}',
            'service'
        );

        // add foreign key for table `{{%service}}`
        $this->addForeignKey(
            '{{%fk-providers_services-service}}',
            '{{%providers_services}}',
            'service',
            '{{%services}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-providers_services-user}}',
            '{{%providers_services}}'
        );

        // drops index for column `user`
        $this->dropIndex(
            '{{%idx-providers_services-user}}',
            '{{%providers_services}}'
        );

        // drops foreign key for table `{{%service}}`
        $this->dropForeignKey(
            '{{%fk-providers_services-service}}',
            '{{%providers_services}}'
        );

        // drops index for column `service`
        $this->dropIndex(
            '{{%idx-providers_services-service}}',
            '{{%providers_services}}'
        );

        $this->dropTable('{{%providers_services}}');
    }
}
