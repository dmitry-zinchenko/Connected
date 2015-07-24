<?php

use yii\db\Schema;
use yii\db\Migration;

class m150724_105212_word_notices extends Migration
{
     public function up()
    {
        $this->createTable('word_notices', [
            'id' => Schema::TYPE_PK,
            'word_id' => 'int NOT NULL',
            'notice_id' => 'int NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('word_notices');
        
       /* echo "m150724_103554_word_notices cannot be reverted.\n";

        return false; */
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
