<?php

use yii\db\Migration;

/**
 * Handles the creation for table `job_positions`.
 */
class m160801_093622_create_job_positions_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('job_positions', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'icon_path' => $this->string()
        ]);
        
        $this->createIndex('idx-user_data_position_id', '{{%user_data}}', '[[position_id]]');
        $this->addForeignKey('fk-user_data-position_id', '{{%user_data}}', '[[position_id]]', '{{%job_positions}}', '[[id]]', 'SET NULL');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-user_data-position_id', '{{%user_data}}');
        $this->dropIndex('idx-user_data_position_id', '{{%user_data}}');
        $this->dropTable('job_positions');
    }
}
