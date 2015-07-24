<?php

use yii\db\Schema;
use yii\db\Migration;
//kjbhjhb
class m150724_101722_group extends Migration
{
    public function up()
    {
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('groups', [
            'id' => Schema::TYPE_INTEGER. "(11) AUTO_INCREMENT",
            'owner_id' => Schema::TYPE_INTEGER,
            'name' => Schema::TYPE_STRING. '(64) NOT NULL',
            'PRIMARY KEY (id)',
        ]);
    }

    public function down()
    {
        $this->dropTable('groups');
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
