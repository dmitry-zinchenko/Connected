<?php

use yii\db\Schema;
use yii\db\Migration;

class m150724_101738_notice extends Migration
{
    public function up()
    {
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('notices', [
            'id' => Schema::TYPE_INTEGER. "(11) AUTO_INCREMENT",
            'title' => Schema::TYPE_STRING. '(100) NOT NULL',
            'text' => Schema::TYPE_TEXT,
            'create_at' => Schema::TYPE_DATETIME,
            'group_id' => Schema::TYPE_INTEGER,
            'author_id' => Schema::TYPE_INTEGER,
            'PRIMARY KEY (id)',
        ]);    }

    public function down()
    {
        $this->dropTable('notices');
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
