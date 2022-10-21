<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%services}}`.
 */
class m221014_111041_add_active_column_to_services_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%services}}', 'active', $this->integer(1)->defaultValue(1));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%services}}', 'active');
    }
}
