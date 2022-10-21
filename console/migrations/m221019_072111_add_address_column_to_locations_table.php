<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%locations}}`.
 */
class m221019_072111_add_address_column_to_locations_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%locations}}', 'address', $this->string());
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%locations}}', 'address');
    }
}
