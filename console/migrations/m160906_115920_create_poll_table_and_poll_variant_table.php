<?php

use yii\db\Migration;

class m160906_115920_create_poll_table_and_poll_variant_table extends Migration
{
    public function up()
    {
        $this->createTable('poll', [
            'id' => $this->primaryKey(),
            'title' => $this->text(),
            'active' => $this->integer(2)
        ]);
        
        $this->createTable('poll_value', [
            'id' => $this->primaryKey(),
            'poll_id' => $this->integer(),
            'value' => $this->string()
        ]);
        
        $this->createIndex('idx-poll_value-poll_id', 'poll_value', '[[poll_id]]');
        $this->addForeignKey('fk-poll_value-poll_id', 'poll_value', '[[poll_id]]', 'poll', '[[id]]', 'CASCADE', 'CASCADE');
    }

    public function down()
    {
        $this->dropForeignKey('fk-poll_value-poll_id', 'poll_value');
        $this->dropIndex('idx-poll_value-poll_id', 'poll_value');
        $this->dropTable('poll_value');
        $this->dropTable('poll');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
