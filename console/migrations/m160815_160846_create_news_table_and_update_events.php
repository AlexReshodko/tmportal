<?php

use yii\db\Migration;

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
            'published' => $this->integer(2)->defaultValue(0),
            'deleted' => $this->integer(2)->defaultValue(0)
        ]);
        $this->createIndex('idx-news-author_id', 'news', '[[author_id]]');
        $this->addForeignKey('fk-news-author_id', 'news', '[[author_id]]', 'user', '[[id]]', 'CASCADE', 'CASCADE');
        $this->addColumn('company_events', 'published', $this->integer(2)->defaultValue(0));
        $this->addColumn('company_events', 'deleted', $this->integer(2)->defaultValue(0));
    }

    public function down()
    {
        $this->dropForeignKey('fk-news-author_id', 'news');
        $this->dropIndex('idx-news-author_id', 'news');
        $this->dropColumn('company_events', 'published');
        $this->dropColumn('company_events', 'deleted');
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
