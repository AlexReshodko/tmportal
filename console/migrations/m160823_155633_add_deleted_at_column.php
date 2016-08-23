<?php

use yii\db\Migration;

class m160823_155633_add_deleted_at_column extends Migration
{
    public function up()
    {
        $this->addColumn('user', 'deleted_at', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('user', 'deleted_at');
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
