<?php

use yii\db\Migration;
use common\models\User;

class m130524_201442_init extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string()->notNull()->unique(),
            'auth_key' => $this->string(32)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string()->unique(),
            'email' => $this->string()->notNull()->unique(),

            'role' => $this->integer()->notNull()->defaultValue(User::ROLE_USER),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
        ], $tableOptions);
        
        $this->createTable('{{%user_data}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'office_id' => $this->integer()->notNull(),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
            'position' => $this->string(),
            'work_start_date' => $this->date()->notNull(),
            'comment' => $this->text(),
            'photo' => $this->string(),
        ]);
        
        $this->createTable('{{%office}}', [
            'id' => $this->primaryKey(),
            'code' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'address' => $this->text(),
            'open_date' => $this->date(),
            'photo' => $this->string(),
        ]);
        
        $this->createIndex('idx-user_data-user_id', '{{%user_data}}', '[[user_id]]');
        $this->addForeignKey('fk-user_data-user_id', '{{%user_data}}', '[[user_id]]', '{{%user}}', '[[id]]', 'CASCADE');
        
        $this->createIndex('idx-user_data_office_id', '{{%user_data}}', '[[office_id]]');
        $this->addForeignKey('fk-user_data-office_id', '{{%user_data}}', '[[office_id]]', '{{%office}}', '[[id]]', 'CASCADE');
        
        $this->insert('{{%office}}', ['name'=>'Черкассы','code'=>'CK']);
    }

    public function down()
    {
        $this->dropForeignKey('fk-user_data-user_id', '{{%user_data}}');
        $this->dropIndex('idx-user_data-user_id', '{{%user_data}}');
        $this->dropForeignKey('fk-user_data-office_id', '{{%user_data}}');
        $this->dropIndex('idx-user_data_office_id', '{{%user_data}}');
        $this->dropTable('{{%office}}');
        $this->dropTable('{{%user_data}}');
        $this->dropTable('{{%user}}');
    }
}
