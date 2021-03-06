<?php

use yii\db\Migration;
use common\helpers\UtilsHelper;

class m160815_160846_create_news_table_and_update_events extends Migration
{
    public function up()
    {
        $this->createTable('news', [
            'id' => $this->primaryKey(),
            'author_id' => $this->integer()->notNull(),
            'title' => $this->string()->notNull(),
            'text_preview' => $this->string(),
            'text' => $this->text(),
            'date' => $this->date(),
            'views' => $this->integer(),
            'status' => $this->smallInteger()->defaultValue(UtilsHelper::STATUS_ACTIVE),
        ]);
        $this->createIndex('idx-news-author_id', 'news', '[[author_id]]');
        $this->addForeignKey('fk-news-author_id', 'news', '[[author_id]]', 'user', '[[id]]', 'CASCADE', 'CASCADE');
        $this->addColumn('company_event', 'status', $this->smallInteger()->defaultValue(UtilsHelper::STATUS_ACTIVE));
    }

    public function down()
    {
        $this->dropForeignKey('fk-news-author_id', 'news');
        $this->dropIndex('idx-news-author_id', 'news');
        $this->dropColumn('company_event', 'status');
        $this->dropTable('news');
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
