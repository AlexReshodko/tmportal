<?php

use yii\db\Migration;

/**
 * Handles the creation for table `user_poll_value`.
 */
class m160906_132537_create_user_poll_value_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user_poll_value', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'poll_value_id' => $this->integer()->notNull()
        ]);
        
        $this->createIndex('idx-user_poll_value-user_id', 'user_poll_value', 'user_id');
        $this->createIndex('idx-user_poll_value-poll_value_id', 'user_poll_value', 'poll_value_id');
        $this->addForeignKey('fk-user_poll_value-user_id', 'user_poll_value', 'user_id', 'user', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-user_poll_value-poll_value_id', 'user_poll_value', 'poll_value_id', 'poll_value', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-user_poll_value-user_id', 'user_poll_value');
        $this->dropForeignKey('fk-user_poll_value-poll_value_id', 'user_poll_value');
        $this->dropIndex('idx-user_poll_value-user_id', 'user_poll_value');
        $this->dropIndex('idx-user_poll_value-poll_value_id', 'user_poll_value');
        $this->dropTable('user_poll_value');
    }
}
