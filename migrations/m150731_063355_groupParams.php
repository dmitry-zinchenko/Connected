<?php

use yii\db\Schema;
use yii\db\Migration;

class m150731_063355_groupParams extends Migration
{
    public function up()
    {
        $this->addColumn('groups','description',Schema::TYPE_TEXT. ' COLLATE utf8_unicode_ci');
        $this->addColumn('groups','disabled',Schema::TYPE_BOOLEAN.' NOT NULL DEFAULT false');
    }

    public function down()
    {
        $this->dropColumn('groups','description');
        $this->dropColumn('groups','disabled');
//        return false;
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
