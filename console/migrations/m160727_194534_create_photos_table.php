<?php

use yii\db\Migration;

/**
 * Handles the creation for table `photos`.
 */
class m160727_194534_create_photos_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('photos', [
            'id' => $this->primaryKey(),
            'event_id' => $this->integer(),
            'name' => $this->string(),
            'description' => $this->text(),
            'path' => $this->string(),
            'thumb_path' => $this->string(),
        ]);
        
        $this->createIndex('idx-photos-event_id', 'photos', '[[event_id]]');
        $this->addForeignKey('fk-photos-event_id', 'photos', '[[event_id]]', 'company_events', '[[id]]', 'CASCADE');
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropForeignKey('fk-photos-event_id', 'photos');
        $this->dropIndex('idx-photos-event_id', 'photos');
        $this->dropTable('photos');
    }
}
