<?php

use yii\db\Schema;
use yii\db\Migration;

class m151219_110611_addLoginFieldsForUser extends Migration
{
    public function up()
    {
        $this->addColumn('User','authKey',Schema::TYPE_STRING);
        $this->addColumn('User','token',Schema::TYPE_STRING);
    }

    public function down()
    {
        $this->dropColumn('User','authKey');
        $this->dropColumn('User','token');
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
