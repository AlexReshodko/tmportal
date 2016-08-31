<?php

use yii\db\Migration;

/**
 * Handles the creation for table `photo`.
 */
class m160727_194534_create_photo_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('photo', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer(),
            'name' => $this->string(),
            'description' => $this->text(),
            'path' => $this->string(),
            'thumb_path' => $this->string(),
        ]);
        
        $this->createIndex('idx-photo-event_id', 'photo', '[[event_id]]');
        $this->addForeignKey('fk-photo-event_id', 'photo', '[[event_id]]', 'company_event', '[[id]]', 'CASCADE', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-photo-event_id', 'photo');
        $this->dropIndex('idx-photo-event_id', 'photo');
        $this->dropTable('photo');
    }
}
