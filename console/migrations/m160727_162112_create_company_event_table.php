<?php

use yii\db\Migration;

/**
 * Handles the creation for table `company_event`.
 */
class m160727_162112_create_company_event_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('company_event', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'date' => $this->date(),
            'thumbnail' => $this->string()
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('company_event');
    }
}
