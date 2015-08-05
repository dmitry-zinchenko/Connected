<?php

use yii\db\Schema;
use yii\db\Migration;

class m150805_100341_charset_notice_word extends Migration
{
    public function up()
    {
        $this->db->createCommand('ALTER TABLE notices CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci')->execute();
        $this->db->createCommand('ALTER TABLE words CONVERT TO CHARACTER SET utf8 COLLATE utf8_unicode_ci')->execute();
    }

    public function down()
    {
        echo "m150805_100341_charset_notice_word cannot be reverted.\n";

        return false;
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
