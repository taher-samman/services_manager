<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%categories}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%categories}}`
 */
class m221014_072552_add_parent_column_to_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%categories}}', 'parent', $this->integer());

        // creates index for column `parent`
        $this->createIndex(
            '{{%idx-categories-parent}}',
            '{{%categories}}',
            'parent'
        );

        // add foreign key for table `{{%categories}}`
        $this->addForeignKey(
            '{{%fk-categories-parent}}',
            '{{%categories}}',
            'parent',
            '{{%categories}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%categories}}`
        $this->dropForeignKey(
            '{{%fk-categories-parent}}',
            '{{%categories}}'
        );

        // drops index for column `parent`
        $this->dropIndex(
            '{{%idx-categories-parent}}',
            '{{%categories}}'
        );

        $this->dropColumn('{{%categories}}', 'parent');
    }
}
