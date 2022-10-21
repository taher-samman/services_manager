<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%schedules}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%services_days}}`
 * - `{{%user}}`
 */
class m221019_111001_create_schedules_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%schedules}}', [
            'id' => $this->primaryKey(),
            'day' => $this->integer()->notNull(),
            'from' => $this->time()->notNull(),
            'to' => $this->time()->notNull(),
            'duration' => $this->integer()->notNull(),
            'user' => $this->integer()->null(),
            'status' => $this->string(),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime()->notNull(),
        ]);

        // creates index for column `day`
        $this->createIndex(
            '{{%idx-schedules-day}}',
            '{{%schedules}}',
            'day'
        );

        // add foreign key for table `{{%services_days}}`
        $this->addForeignKey(
            '{{%fk-schedules-day}}',
            '{{%schedules}}',
            'day',
            '{{%services_days}}',
            'id',
            'CASCADE'
        );

        // creates index for column `user`
        $this->createIndex(
            '{{%idx-schedules-user}}',
            '{{%schedules}}',
            'user'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-schedules-user}}',
            '{{%schedules}}',
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
        // drops foreign key for table `{{%services_days}}`
        $this->dropForeignKey(
            '{{%fk-schedules-day}}',
            '{{%schedules}}'
        );

        // drops index for column `day`
        $this->dropIndex(
            '{{%idx-schedules-day}}',
            '{{%schedules}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-schedules-user}}',
            '{{%schedules}}'
        );

        // drops index for column `user`
        $this->dropIndex(
            '{{%idx-schedules-user}}',
            '{{%schedules}}'
        );

        $this->dropTable('{{%schedules}}');
    }
}
