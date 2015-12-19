<?php

use yii\db\Schema;
use yii\db\Migration;

class m151219_103920_updateUserTable extends Migration
{
    public function up()
    {
        $this->alterColumn('User','firstName','varchar(50) NULL DEFAULT NULL');
        $this->alterColumn('User','lastName','varchar(50) NULL DEFAULT NULL');
    }

    public function down()
    {
        $this->alterColumn('User','firstName','varchar(50) NOT NULL');
        $this->alterColumn('User','lastName','varchar(50) NOT NULL');
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
