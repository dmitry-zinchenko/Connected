<?php

use yii\db\Schema;
use yii\db\Migration;

class m150724_105534_user_groups extends Migration
{
    public function up()
    {
        $this->createTable('user_groups', [
            'id' => Schema::TYPE_PK,
            'user_id' => 'int NOT NULL',
            'group_id' => 'int NOT NULL',
            'role_id' => 'int NOT NULL',
        ]);
    }

    public function down()
    {
        $this->dropTable('user_groups');
        
       /* echo "m150724_105534_user_groups cannot be reverted.\n";

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
