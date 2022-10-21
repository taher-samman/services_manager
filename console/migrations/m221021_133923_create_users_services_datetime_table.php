<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users_services_datetime}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%users_services}}`
 * - `{{%services_days}}`
 * - `{{%schedules}}`
 */
class m221021_133923_create_users_services_datetime_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users_services_datetime}}', [
            'id' => $this->primaryKey(),
            'entity_id' => $this->integer()->notNull(),
            'day' => $this->integer()->notNull(),
            'schedule' => $this->integer()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);

        // creates index for column `entity_id`
        $this->createIndex(
            '{{%idx-users_services_datetime-entity_id}}',
            '{{%users_services_datetime}}',
            'entity_id'
        );

        // add foreign key for table `{{%users_services}}`
        $this->addForeignKey(
            '{{%fk-users_services_datetime-entity_id}}',
            '{{%users_services_datetime}}',
            'entity_id',
            '{{%users_services}}',
            'id',
            'CASCADE'
        );

        // creates index for column `day`
        $this->createIndex(
            '{{%idx-users_services_datetime-day}}',
            '{{%users_services_datetime}}',
            'day'
        );

        // add foreign key for table `{{%services_days}}`
        $this->addForeignKey(
            '{{%fk-users_services_datetime-day}}',
            '{{%users_services_datetime}}',
            'day',
            '{{%services_days}}',
            'id',
            'CASCADE'
        );

        // creates index for column `schedule`
        $this->createIndex(
            '{{%idx-users_services_datetime-schedule}}',
            '{{%users_services_datetime}}',
            'schedule'
        );

        // add foreign key for table `{{%schedules}}`
        $this->addForeignKey(
            '{{%fk-users_services_datetime-schedule}}',
            '{{%users_services_datetime}}',
            'schedule',
            '{{%schedules}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%users_services}}`
        $this->dropForeignKey(
            '{{%fk-users_services_datetime-entity_id}}',
            '{{%users_services_datetime}}'
        );

        // drops index for column `entity_id`
        $this->dropIndex(
            '{{%idx-users_services_datetime-entity_id}}',
            '{{%users_services_datetime}}'
        );

        // drops foreign key for table `{{%services_days}}`
        $this->dropForeignKey(
            '{{%fk-users_services_datetime-day}}',
            '{{%users_services_datetime}}'
        );

        // drops index for column `day`
        $this->dropIndex(
            '{{%idx-users_services_datetime-day}}',
            '{{%users_services_datetime}}'
        );

        // drops foreign key for table `{{%schedules}}`
        $this->dropForeignKey(
            '{{%fk-users_services_datetime-schedule}}',
            '{{%users_services_datetime}}'
        );

        // drops index for column `schedule`
        $this->dropIndex(
            '{{%idx-users_services_datetime-schedule}}',
            '{{%users_services_datetime}}'
        );

        $this->dropTable('{{%users_services_datetime}}');
    }
}
