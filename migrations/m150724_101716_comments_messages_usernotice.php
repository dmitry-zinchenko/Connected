<?php

use yii\db\Schema;
use yii\db\Migration;

class m150724_101716_comments_messages_usernotice extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('comments', [
            'id' => Schema::TYPE_PK,
            'author_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'text' => Schema::TYPE_TEXT . ' NOT NULL',
            'notice_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
        ], $tableOptions);

        $this->createTable('messages', [
            'id' => Schema::TYPE_PK,
            'author_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'text' => Schema::TYPE_TEXT . ' NOT NULL',
            'created_at' => Schema::TYPE_DATETIME . ' NOT NULL',
            'group_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
        ], $tableOptions);

        $this->createTable('user_notice', [
            'id' => Schema::TYPE_PK,
            'notice_id' => Schema::TYPE_INTEGER . '(11) NOT NULL',
            'user_at' => Schema::TYPE_INTEGER . '(11) NOT NULL',
        ], $tableOptions);
    }

    public function down()
    {
        $this->dropTable('comments');
        $this->dropTable('messages');
        $this->dropTable('user_notice');
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
