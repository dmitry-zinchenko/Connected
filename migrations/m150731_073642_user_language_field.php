<?php

use yii\db\Schema;
use yii\db\Migration;

class m150731_073642_user_language_field extends Migration
{
    public function up()
    {
        $this->addColumn('users', 'language', 'varchar(10) not null default \'en-US\'');
    }

    public function down()
    {
        $this->dropColumn('users', 'language');
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
