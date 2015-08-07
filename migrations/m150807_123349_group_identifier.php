<?php

use yii\db\Schema;
use yii\db\Migration;

class m150807_123349_group_identifier extends Migration
{
    public function up()
    {
        $this->addColumn('groups', 'identifier', 'varchar(50) not null unique');
    }
    public function down()
    {
        $this->dropColumn('groups', 'identifier');
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
