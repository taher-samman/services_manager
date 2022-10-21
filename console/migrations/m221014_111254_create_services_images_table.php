<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%services_images}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%services}}`
 */
class m221014_111254_create_services_images_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%services_images}}', [
            'id' => $this->primaryKey(),
            'service' => $this->integer()->notNull(),
            'image' => $this->string()->notNull(),
        ]);

        // creates index for column `service`
        $this->createIndex(
            '{{%idx-services_images-service}}',
            '{{%services_images}}',
            'service'
        );

        // add foreign key for table `{{%services}}`
        $this->addForeignKey(
            '{{%fk-services_images-service}}',
            '{{%services_images}}',
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
        // drops foreign key for table `{{%services}}`
        $this->dropForeignKey(
            '{{%fk-services_images-service}}',
            '{{%services_images}}'
        );

        // drops index for column `service`
        $this->dropIndex(
            '{{%idx-services_images-service}}',
            '{{%services_images}}'
        );

        $this->dropTable('{{%services_images}}');
    }
}
