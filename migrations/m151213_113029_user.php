<?php

use yii\db\Schema;
use yii\db\Migration;

class m151213_113029_user extends Migration
{
    public function up()
    {
        $this->createTable('User', [
            'userId' => Schema::TYPE_PK,
            'email' => Schema::TYPE_STRING . ' NOT NULL',
            'firstName' => 'varchar(50) NOT NULL',
            'lastName' => 'varchar(50) NOT NULL',
            'birthDay' => 'DATE',
            'password' => 'varchar(100)',
            'info' => Schema::TYPE_TEXT,
        ]);
    }

    public function down()
    {
        $this->dropTable('User');
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
