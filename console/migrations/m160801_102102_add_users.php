<?php

use common\models\Office;
use common\models\UserData;
use frontend\models\SignupForm;
use yii\helpers\Json;

use yii\db\Migration;

class m160801_102102_add_users extends Migration
{
    public function up()
    {
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
                    $userDataModel = new UserData();
                    $userDataModel->user_id = $savedUser->id;
                    $officeCode = 'CK';
                    if(isset($user['data']) && isset($user['data']['office'])){
                        $officeCode = $user['data']['office'];
                    }
                    $userDataModel->office_id = Office::find()->where(['code'=>$officeCode])->one()->id;
                    if(isset($user['data'])){
                        $userDataModel->setAttributes($user['data']);
                    }
                    if(!$userDataModel->save()){
                        common\helpers\Logger::warn($userDataModel->getErrors());
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
            
            echo "\r\n";
            echo "Execute RBAC... \r\n";
            exec('yii rbac/init');
            echo "RBAC roles assigned \r\n";
        }  else {
            throw new Exception("File doesn't exists: " . $filename);
        }
    }

    public function down()
    {
//        echo "m160801_102102_add_users cannot be reverted.\n";
        $this->execute('DELETE FROM user_data');
        $this->execute('DELETE FROM user');
//        return true;
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
