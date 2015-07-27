<?php

use yii\db\Schema;
use yii\db\Migration;

class m150727_093703_user_auth extends Migration
{
    public function up()
    {
        $this->addColumn('users','authKey','text');
        $this->addColumn('users','accessToken','text');
        return;
    }

    public function down()
    {
        $this->dropColumn('users','authKey');
        $this->dropColumn('users','accessToken');
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
