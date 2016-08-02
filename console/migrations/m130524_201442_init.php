<?php

use common\models\User;
use yii\db\Migration;

class m130524_201442_init extends Migration
{
    public function safeUp()
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
            'office_id' => $this->integer(),
            'position_id' => $this->integer(),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
            'gender' => $this->integer(2),
            'address' => $this->string(),
            'phone' => $this->string(),
            'skype' => $this->string(),
            'hire_date' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'birthday' => $this->date(),
            'comment' => $this->text(),
            'photo' => $this->string(),
            'map_place' => $this->integer()
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
        $this->addForeignKey('fk-user_data-user_id', '{{%user_data}}', '[[user_id]]', '{{%user}}', '[[id]]', 'CASCADE', 'CASCADE');
        
        $this->createIndex('idx-user_data_office_id', '{{%user_data}}', '[[office_id]]');
        $this->addForeignKey('fk-user_data-office_id', '{{%user_data}}', '[[office_id]]', '{{%office}}', '[[id]]', 'SET NULL', 'CASCADE');
        
        $this->insert('{{%office}}', ['name'=>'Черкассы','code'=>'CK']);
        $this->insert('{{%office}}', ['name'=>'Кривой Рог','code'=>'KR']);
        $this->insert('{{%office}}', ['name'=>'Полтава','code'=>'PL']);
    }

    public function safeDown()
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
