<?php

use yii\db\Schema;
use yii\db\Migration;

class m151220_111908_books extends Migration
{
    public function up()
    {
        $this->createTable('Book',[
            'bookId' => 'pk',
            'name' => Schema::TYPE_STRING,
            'year' => 'int(4)',
            'userId' => 'int(11)',
        ]);

        $this->addForeignKey('Book_user_fk','Book','userId','User','userId');
    }

    public function down()
    {
        $this->dropTable('Book');
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
