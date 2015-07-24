<?php

use yii\db\Schema;
use yii\db\Migration;

class m150724_101656_user extends Migration
{
    public function up()
    {
        if ($this->db->driverName === 'mysql') {
            // http://stackoverflow.com/questions/766809/whats-the-difference-between-utf8-general-ci-and-utf8-unicode-ci
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        $this->createTable('users', [
            'id' => Schema::TYPE_INTEGER,
            'username' => Schema::TYPE_STRING. '(64) NOT NULL',
            'password' => Schema::TYPE_STRING. '(64) NOT NULL',
            'first_name' => Schema::TYPE_STRING. '(64) NOT NULL',
            'last_name' => Schema::TYPE_STRING. '(64) NOT NULL',
            'email' => Schema::TYPE_STRING. '(64) NOT NULL',
            'PRIMARY KEY (id)',
        ]);
    }

    public function down()
    {
        $authManager = $this->getAuthManager();
        $this->db = $authManager->db;

        $this->dropTable($authManager->users);
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
