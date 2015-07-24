<?php

use yii\db\Schema;
use yii\db\Migration;

class m150724_101714_words extends Migration
{
    public function up()
    {
        $this->createTable('words', [
            'id' => Schema::TYPE_PK,
            'name' => Schema::TYPE_STRING . '(60) NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('words');
        
        /*echo "m150724_101714_word cannot be reverted.\n";

        return false;*/
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
