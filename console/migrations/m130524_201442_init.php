<?php

use common\models\Office;
use common\models\User;
use common\models\UserData;
use frontend\models\SignupForm;
use yii\db\Migration;
use yii\helpers\Json;

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
            'office_id' => $this->integer()->notNull(),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
            'position' => $this->string(),
            'phone' => $this->string(),
            'skype' => $this->string(),
            'work_start_date' => $this->dateTime()->notNull()->defaultExpression('NOW()'),
            'birthday' => $this->date(),
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
        $this->insert('{{%office}}', ['name'=>'Кривой Рог','code'=>'KR']);
        
        $filename = Yii::getAlias('@common').'/data/users.json';
        $addedUsers = [];
        if(file_exists($filename)){
            $json = file_get_contents($filename);
            $users = Json::decode($json);
            foreach ($users as $key => $user) {
                $model = new SignupForm();
                $model->username = $user['username'];
                $model->password = $user['password'];
                $model->email = $user['email'];
                $model->role = $user['role'];
                if ($savedUser = $model->signup()) {
                    if(isset($user['data'])){
                        $data = $user['data'];
                        $userDataModel = new UserData();
                        $userDataModel->user_id = $savedUser->id;
                        $userDataModel->office_id = Office::find()->where(['code'=>$data['office']])->one()->id;
                        $userDataModel->first_name = $data['first_name'];
                        $userDataModel->last_name = $data['last_name'];
                        $userDataModel->work_start_date = $data['work_start_date'];
                        $userDataModel->birthday = $data['birthday'];
                        if(!$userDataModel->save()){
                            throw new Exception($userDataModel->getErrors());
                        }
                    }
                    echo "User '".$user['username']."' added successfully \r\n";
                    array_push($addedUsers, $user['username']);
                }else{
                    print_r($model->errors);
                }
            }
            echo '<pre>';
            print_r($addedUsers);
            echo '</pre>';
        }  else {
            throw new Exception("File doesn't exists: " . $filename);
        }
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
