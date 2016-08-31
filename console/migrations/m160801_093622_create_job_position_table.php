<?php

use yii\db\Migration;

/**
 * Handles the creation for table `job_position`.
 */
class m160801_093622_create_job_position_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('job_position', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'icon_path' => $this->string()
        ]);
        
        $this->createIndex('idx-user_data_position_id', '{{%user_data}}', '[[position_id]]');
        $this->addForeignKey('fk-user_data-position_id', '{{%user_data}}', '[[position_id]]', '{{%job_position}}', '[[id]]', 'SET NULL');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-user_data-position_id', '{{%user_data}}');
        $this->dropIndex('idx-user_data_position_id', '{{%user_data}}');
        $this->dropTable('job_position');
    }
}
